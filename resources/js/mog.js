window.addEventListener('alpine:init', () => {
    window.Mog = {
        get scheme() {
            let theme = this.theme

            if (theme === 'system') {
                let scheme = window.matchMedia('(prefers-color-scheme: dark)')
                return scheme.matches ? 'dark' : 'light'
            }

            return theme
        },

        get theme() {
            return window.localStorage.getItem('mog::paint') || 'system'
        },

        get coat() {
            return this.theme
        },

        paint(theme) {
            let applyDark = () => document.documentElement.classList.add('dark')
            let applyLight = () => document.documentElement.classList.remove('dark')
            let setTheme = (theme) => window.localStorage.setItem('mog::paint', theme)

            if (theme === 'system') {
                let scheme = window.matchMedia('(prefers-color-scheme: dark)')
                window.localStorage.removeItem('mog::paint')
                scheme.matches ? applyDark() : applyLight()
            } else if (theme === 'dark') {
                setTheme('dark')
                applyDark()
            } else if (theme === 'light') {
                setTheme('light')
                applyLight()
            }
        },

        dialogs: Alpine.reactive([]),
        toastSubscribers: [],

        dismissedToasts: Alpine.reactive(new Set()),
        getActiveToasts: () => {
            return Alpine.store('mog').toasts.filter((toast) => !window.Mog.dismissedToasts.has(toast.id))
        },

        toastsCounter: 0,

        dialog: {
            open: (id) => {
                if (!window.Mog.dialogs.includes(id)) window.Mog.dialogs.push(id)

                document.dispatchEvent(new CustomEvent('mog::dialog-open', { detail: { id } }))
                document.dispatchEvent(new CustomEvent('mog::overlay-open', { detail: { dialog: id } }))
            },

            close: (id) => {
                if (window.Mog.dialogs.includes(id)) {
                    window.Mog.dialogs = window.Mog.dialogs.filter((d) => d !== id)
                }

                document.dispatchEvent(new CustomEvent('mog::dialog-close', { detail: { id } }))
                document.dispatchEvent(new CustomEvent('mog::overlay-close', { detail: { dialog: id } }))
            },

            closeAll: () => {
                let toClose = window.Mog.dialogs

                toClose.forEach((m) => window.Mog.dialog.close(m))
            },

            empty: () => window.Mog.dialogs.length === 0,
        },

        toast: {
            /**
             *
             * types:
             *        'default' => no icon, just text
             *        'success' => has a success icon (tick)
             *        'info' => has an info icon (i)
             *        'warning' => has a warning icon (triangle with ! in the middle)
             *        'error' => has a error icon (octagon with x in the middle)
             *        'promise' => shows loading state with spinning loading icon until resolved/rejected, then shows success/error icon accordingly
             *
             * action: idk what this will look like yet, but its a button that should perform an action once clicked
             * duration: time in ms before auto dismiss, 0 = persistent
             * dismissable: boolean, whether the toast can be dismissed by the user. if yes, show a close button at the top right of the toast
             */

            create: (title, options = {}) => {
                let description = ''
                let type = 'default'
                let position = 'bottom-right'
                let html = ''
                let closeButton = true
                let cancel = undefined
                let action = undefined
                let duration = undefined

                if (typeof options.description != 'undefined') description = options.description
                if (typeof options.type != 'undefined') type = options.type
                if (typeof options.position != 'undefined') position = options.position
                if (typeof options.html != 'undefined') html = options.html
                if (typeof options.closeButton != 'undefined') closeButton = options.closeButton
                if (typeof options.cancel != 'undefined') cancel = options.cancel
                if (typeof options.action != 'undefined') action = options.action
                if (typeof options.duration != 'undefined') duration = options.duration

                const dismissible = options.dismissible === undefined ? true : options.dismissible

                const id = typeof options.id === 'number' || (options.id && options.id?.length > 0) ? options.id : window.Mog.toastsCounter++

                const toast = { id, type, title, description, position, html, dismissible, closeButton, cancel, action, duration }

                const alreadyExists = Alpine.store('mog').toasts.find((toast) => {
                    return toast.id === id
                })

                if (window.Mog.dismissedToasts.has(id)) {
                    window.Mog.dismissedToasts.delete(id)
                }

                if (alreadyExists) {
                    const index = Alpine.store('mog').toasts.findIndex((toast) => toast.id === id)
                    if (index !== -1) {
                        window.Mog.toast.publish({ ...alreadyExists, ...options, id, title })
                        Alpine.store('mog').toasts[index] = {
                            ...alreadyExists,
                            ...options,
                            id,
                            title,
                        }
                    }
                } else {
                    window.Mog.toast.publish(toast)
                    Alpine.store('mog').toasts.unshift(toast)
                }

                return id
            },

            message: (title, data) => {
                return window.Mog.toast.create(title, data)
            },

            error: (title, data) => {
                return window.Mog.toast.create(title, { type: 'error', ...data })
            },

            success: (title, data) => {
                return window.Mog.toast.create(title, { type: 'success', ...data })
            },

            info: (title, data) => {
                return window.Mog.toast.create(title, { type: 'info', ...data })
            },

            warning: (title, data) => {
                return window.Mog.toast.create(title, { type: 'warning', ...data })
            },

            loading: (title, data) => {
                return window.Mog.toast.create(title, { type: 'loading', ...data })
            },

            dismiss: (id) => {
                if (id) {
                    window.Mog.dismissedToasts.add(id)
                    requestAnimationFrame(() => window.Mog.toastSubscribers.forEach((subscriber) => subscriber({ id, dismiss: true })))
                } else {
                    Alpine.store('mog').toasts.forEach((toast) => {
                        window.Mog.toastSubscribers.forEach((subscriber) => subscriber({ id: toast.id, dismiss: true }))
                    })
                }

                return id
            },

            dismissAll: () => {
                Alpine.store('mog').toasts.forEach((toast) => window.Mog.toast.dismiss(toast.id))
            },

            subscribe: (callback) => {
                window.Mog.toastSubscribers.push(callback)

                return () => {
                    const index = window.Mog.toastSubscribers.indexOf(callback)
                    window.Mog.toastSubscribers.splice(index, 1)
                }
            },

            publish: (toast) => {
                window.Mog.toastSubscribers.forEach((subscriber) => subscriber(toast))
            },
        },
    }

    Alpine.magic('mog', () => window.Mog)

    Alpine.store('mog', {
        toasts: [],
    })
})
