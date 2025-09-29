window.addEventListener('alpine:init', () => {
    Alpine.magic('mog', (el, options) => ({
        get theme() {
            return localStorage.getItem('mog::theme')
        },
        set theme(value) {
            localStorage.setItem('mog::theme', value)
            document.documentElement.classList.toggle('dark', value === 'dark')
        },
        toggleTheme() {
            this.theme = this.theme === 'dark' ? 'light' : 'dark'
        },
    }))

    Alpine.store('toasts', {
        toasts: [],
        counter: 0,

        add(type = 'default', title, description = null, duration = 4000, action = null) {
            const toast = {
                id: ++this.counter,
                type,
                title,
                description,
                duration,
                action,
                createdAt: Date.now(),
                dismissed: false,
            }

            this.toasts.unshift(toast)

            if (duration > 0) {
                setTimeout(() => {
                    this.dismiss(toast.id)
                }, duration)
            }

            return toast.id
        },

        dismiss(id) {
            const index = this.toasts.findIndex((toast) => toast.id === id)
            if (index > -1) {
                this.toasts[index].dismissed = true
                setTimeout(() => {
                    this.toasts.splice(index, 1)
                }, 150) // Allow animation to complete
            }
        },

        dismissAll() {
            this.toasts.forEach((toast) => (toast.dismissed = true))
            setTimeout(() => {
                this.toasts = []
            }, 150)
        },

        success(title, description = null, duration = 4000) {
            return this.add('success', title, description, duration)
        },

        error(title, description = null, duration = 6000) {
            return this.add('error', title, description, duration)
        },

        warning(title, description = null, duration = 5000) {
            return this.add('warning', title, description, duration)
        },

        info(title, description = null, duration = 4000) {
            return this.add('info', title, description, duration)
        },

        loading(title, description = null) {
            return this.add('loading', title, description, 0) // 0 = persistent
        },

        promise(promise, options = {}) {
            const loadingId = this.loading(options.loading?.title || 'Loading...', options.loading?.description)

            promise
                .then((result) => {
                    this.dismiss(loadingId)
                    if (options.success) {
                        this.success(
                            typeof options.success === 'function' ? options.success(result) : options.success.title || options.success,
                            typeof options.success === 'object' ? options.success.description : null,
                        )
                    }
                    return result
                })
                .catch((error) => {
                    this.dismiss(loadingId)
                    if (options.error) {
                        this.error(
                            typeof options.error === 'function' ? options.error(error) : options.error.title || options.error,
                            typeof options.error === 'object' ? options.error.description : null,
                        )
                    }
                    throw error
                })

            return promise
        },
    })

    // Global toast helper
    window.toast = Alpine.store('toasts')

    Alpine.magic('toast', () => Alpine.store('toasts'))
})
