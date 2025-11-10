import "./bootstrap";
import Alpine from "alpinejs";

document.addEventListener("alpine:init", () => {
    Alpine.store("notifications", {
        items: [],

        add(notification) {
            notification.id = Date.now() + Math.random();
            this.items.push(notification);

            setTimeout(() => {
                this.remove(notification.id);
            }, 7000);
        },

        remove(id) {
            const index = this.items.findIndex((item) => item.id === id);

            if (index > -1) {
                this.items.splice(index, 1);
            }
        },
    });

    const notificationManager = document.querySelector("#notification-manager");
    if (notificationManager && notificationManager.dataset.notification) {
        try {
            const data = JSON.parse(notificationManager.dataset.notification);
            if (data && data.message) {
                Alpine.store("notifications").add(data);
            }
        } catch (e) {
            console.error("Gagal mem-parsing data notifikasi dari server:", e);
        }
    }
});

window.Alpine = Alpine;
Alpine.start();
