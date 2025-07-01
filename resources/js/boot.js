export default function boot() {
    const setTheme = () => {
        const theme = localStorage.getItem('mog::theme') ?? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
        document.documentElement.classList.toggle('dark', theme === 'dark')
    }

    document.addEventListener('livewire:navigated', () => {
        setTheme()
    })

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        setTheme()
    })

    setTheme()
}
