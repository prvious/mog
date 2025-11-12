let fs = require('fs')
let brotliSize = require('brotli-size')
let crypto = require('crypto')
let path = require('path')

let hash = crypto.randomBytes(4).toString('hex')

fs.existsSync(__dirname + '/../dist') || fs.mkdirSync(__dirname + '/../dist')

fs.writeFileSync(
    __dirname + '/../dist/manifest.json',
    `
{"/mog.js":"${hash}"}
`,
)

build({
    format: 'esm',
    entryPoints: [`resources/js/mog.js`],
    outfile: `dist/mog.esm.js`,
    sourcemap: 'linked',
    bundle: true,
    platform: 'node',
    define: { CDN: 'true', IS_CSP_BUILD: 'false' },
})

build({
    entryPoints: [`resources/js/mog.js`],
    outfile: `dist/mog.js`,
    bundle: true,
    platform: 'browser',
    define: { CDN: 'true', IS_CSP_BUILD: 'false' },
})

build({
    entryPoints: [`resources/js/mog.js`],
    outfile: `dist/mog.min.js`,
    sourcemap: 'linked',
    bundle: true,
    minify: true,
    platform: 'browser',
    define: { CDN: 'true', IS_CSP_BUILD: 'false' },
}).then(() => {
    outputSize(`dist/mog.min.js`)
})

function build(options) {
    options.define || (options.define = {})

    // options.define['LIVEWIRE_VERSION'] = `'${getFromPackageDotJson('alpinejs', 'version')}'`
    options.define['process.env.NODE_ENV'] = process.argv.includes('--watch') ? `'production'` : `'development'`

    const esbuildOptions = {
        // external: ['alpinejs'],
        plugins: [
            ...(options.plugins || []),
            {
                name: 'path-resolver',
                setup(build) {
                    // Resolve @/ alias to js/ directory
                    build.onResolve({ filter: /^@\// }, (args) => {
                        const relativePath = args.path.slice(2) // Remove '@/'
                        const fullPath = path.resolve(__dirname, '../resources/js', relativePath)

                        // Try different extensions if it's not found
                        const fs = require('fs')
                        const extensions = ['.js', '/index.js', '']

                        for (const ext of extensions) {
                            const testPath = fullPath + ext
                            if (fs.existsSync(testPath)) {
                                return { path: testPath }
                            }
                        }

                        // Default to the original path
                        return { path: fullPath }
                    })
                },
            },
        ],
        ...options,
    }

    if (process.argv.includes('--watch')) {
        return require('esbuild')
            .context(esbuildOptions)
            .then((ctx) => ctx.watch())
    }

    return require('esbuild')
        .build(esbuildOptions)
        .catch(() => process.exit(1))
}

function outputSize(file) {
    let size = bytesToSize(brotliSize.sync(fs.readFileSync(file)))

    console.log('\x1b[32m', `Bundle size [${file}]: ${size}`)
}

function bytesToSize(bytes) {
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
    if (bytes === 0) return 'n/a'
    const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10)
    if (i === 0) return `${bytes} ${sizes[i]}`
    return `${(bytes / 1024 ** i).toFixed(1)} ${sizes[i]}`
}
