(() => {
  // resources/js/mog.js
  window.addEventListener("alpine:init", () => {
    window.Mog = {
      get scheme() {
        let theme = this.theme;
        if (theme === "system") {
          let scheme = window.matchMedia("(prefers-color-scheme: dark)");
          return scheme.matches ? "dark" : "light";
        }
        return theme;
      },
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
      dismissedToasts: Alpine.reactive(/* @__PURE__ */ new Set()),
      getActiveToasts: () => {
        return window.Mog.toasts.filter((toast) => !window.Mog.dismissedToasts.has(toast.id));
      },
      toastsCounter: 0,
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
        create: (title, options = {}) => {
          let description = "";
          let type = "default";
          let position = "bottom-right";
          let html = "";
          let closeButton = true;
          let cancel = void 0;
          let action = void 0;
          let duration = void 0;
          if (typeof options.description != "undefined") description = options.description;
          if (typeof options.type != "undefined") type = options.type;
          if (typeof options.position != "undefined") position = options.position;
          if (typeof options.html != "undefined") html = options.html;
          if (typeof options.closeButton != "undefined") closeButton = options.closeButton;
          if (typeof options.cancel != "undefined") cancel = options.cancel;
          if (typeof options.action != "undefined") action = options.action;
          if (typeof options.duration != "undefined") duration = options.duration;
          const dismissible = options.dismissible === void 0 ? true : options.dismissible;
          const id = typeof options.id === "number" || options.id && options.id?.length > 0 ? options.id : window.Mog.toastsCounter++;
          const toast = { id, type, title, description, position, html, dismissible, closeButton, cancel, action, duration };
          const alreadyExists = window.Mog.toasts.find((toast2) => {
            return toast2.id === id;
          });
          if (window.Mog.dismissedToasts.has(id)) {
            window.Mog.dismissedToasts.delete(id);
          }
          if (alreadyExists) {
            const index = window.Mog.toasts.findIndex((toast2) => toast2.id === id);
            window.Mog.toasts[index] = {
              ...alreadyExists,
              ...options,
              id,
              dismissible,
              title
            };
          } else {
            window.Mog.toasts.unshift(toast);
          }
          window.dispatchEvent(new CustomEvent("mog::toast-show", { detail: toast }));
          return id;
        },
        message: (title, data) => {
          return window.Mog.toast.create(title, data);
        },
        error: (title, data) => {
          return window.Mog.toast.create(title, { type: "error", ...data });
        },
        success: (title, data) => {
          return window.Mog.toast.create(title, { type: "success", ...data });
        },
        info: (title, data) => {
          return window.Mog.toast.create(title, { type: "info", ...data });
        },
        warning: (title, data) => {
          return window.Mog.toast.create(title, { type: "warning", ...data });
        },
        loading: (title, data) => {
          return window.Mog.toast.create(title, { type: "loading", ...data });
        },
        dismiss: (toast) => {
          window.Mog.toasts = Alpine.reactive(window.Mog.toasts.filter((t) => t !== toast));
          document.dispatchEvent(new CustomEvent("mog::toast-dismiss", { detail: { toast } }));
        },
        dismissAll: () => {
          window.Mog.toasts.forEach((toast) => window.Mog.toast.dismiss(toast));
        }
      }
    };
    Alpine.magic("mog", () => window.Mog);
  });
})();
