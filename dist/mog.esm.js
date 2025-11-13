// resources/js/mog.js
window.addEventListener("alpine:init", () => {
  Alpine.store("toasts", {
    toasts: [],
    counter: 0,
    add(type = "default", title, description = null, duration = 4e3, action = null) {
      const toast = {
        id: ++this.counter,
        type,
        title,
        description,
        duration,
        action,
        createdAt: Date.now(),
        dismissed: false
      };
      this.toasts.unshift(toast);
      if (duration > 0) {
        setTimeout(() => {
          this.dismiss(toast.id);
        }, duration);
      }
      return toast.id;
    },
    dismiss(id) {
      const index = this.toasts.findIndex((toast) => toast.id === id);
      if (index > -1) {
        this.toasts[index].dismissed = true;
        setTimeout(() => {
          this.toasts.splice(index, 1);
        }, 150);
      }
    },
    dismissAll() {
      this.toasts.forEach((toast) => toast.dismissed = true);
      setTimeout(() => {
        this.toasts = [];
      }, 150);
    },
    success(title, description = null, duration = 4e3) {
      return this.add("success", title, description, duration);
    },
    error(title, description = null, duration = 6e3) {
      return this.add("error", title, description, duration);
    },
    warning(title, description = null, duration = 5e3) {
      return this.add("warning", title, description, duration);
    },
    info(title, description = null, duration = 4e3) {
      return this.add("info", title, description, duration);
    },
    loading(title, description = null) {
      return this.add("loading", title, description, 0);
    },
    promise(promise, options = {}) {
      const loadingId = this.loading(options.loading?.title || "Loading...", options.loading?.description);
      promise.then((result) => {
        this.dismiss(loadingId);
        if (options.success) {
          this.success(
            typeof options.success === "function" ? options.success(result) : options.success.title || options.success,
            typeof options.success === "object" ? options.success.description : null
          );
        }
        return result;
      }).catch((error) => {
        this.dismiss(loadingId);
        if (options.error) {
          this.error(
            typeof options.error === "function" ? options.error(error) : options.error.title || options.error,
            typeof options.error === "object" ? options.error.description : null
          );
        }
        throw error;
      });
      return promise;
    }
  });
  window.Mog = {
    get theme() {
      return window.localStorage.getItem("mog::paint") || "system";
    },
    get coat() {
      return this.theme;
    },
    paint(theme) {
      let applyDark = () => document.documentElement.classList.add("dark");
      let applyLight = () => document.documentElement.classList.remove("dark");
      let setTheme = (theme2) => window.localStorage.setItem("mog::paint", theme2);
      if (theme === "system") {
        let scheme = window.matchMedia("(prefers-color-scheme: dark)");
        window.localStorage.removeItem("mog::paint");
        scheme.matches ? applyDark() : applyLight();
      } else if (theme === "dark") {
        setTheme("dark");
        applyDark();
      } else if (theme === "light") {
        setTheme("light");
        applyLight();
      }
    },
    dialogs: Alpine.reactive([]),
    toasts: Alpine.reactive([]),
    dialog: {
      open: (id) => {
        if (!window.Mog.dialogs.includes(id)) window.Mog.dialogs.push(id);
        document.dispatchEvent(new CustomEvent("mog::dialog-open", { detail: { id } }));
        document.dispatchEvent(new CustomEvent("mog::overlay-open", { detail: { dialog: id } }));
      },
      close: (id) => {
        if (window.Mog.dialogs.includes(id)) {
          window.Mog.dialogs = window.Mog.dialogs.filter((d) => d !== id);
        }
        document.dispatchEvent(new CustomEvent("mog::dialog-close", { detail: { id } }));
        document.dispatchEvent(new CustomEvent("mog::overlay-close", { detail: { dialog: id } }));
      },
      closeAll: () => {
        let toClose = window.Mog.dialogs;
        toClose.forEach((m) => window.Mog.dialog.close(m));
      },
      empty: () => window.Mog.dialogs.length === 0
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
      create: ({ type, title, description, action, duration, dismissable }) => {
        window.Mog.toasts.push({ type, title, description, action, duration, dismissable });
        document.dispatchEvent(new CustomEvent("mog::toast-create", { detail: { type, title, description, action, duration, dismissable } }));
      }
    }
  };
  Alpine.magic("mog", () => window.Mog);
});
//# sourceMappingURL=mog.esm.js.map
