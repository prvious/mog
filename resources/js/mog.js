window.addEventListener('alpine:init', () => {
    Alpine.magic('mog', (el, options) => ({
        get theme() {
            return localStorage.getItem('mog::theme');
        },
        set theme(value) {
            localStorage.setItem('mog::theme', value);
            document.documentElement.classList.toggle('dark', value === 'dark');
        },
        toggleTheme() {
            this.theme = this.theme === 'dark' ? 'light' : 'dark';
        },
    }));
});
