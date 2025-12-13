import "./bootstrap";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import LocomotiveScroll from "locomotive-scroll";
import "locomotive-scroll/dist/locomotive-scroll.css"; 

Alpine.plugin(collapse);

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

document.addEventListener("DOMContentLoaded", () => {
    const scrollEl = document.querySelector("[data-scroll-container]");

    if (scrollEl) {
        const scroll = new LocomotiveScroll({
            el: scrollEl,
            smooth: true,
            lerp: 0.03,
            multiplier: 1.2,
        });
        scroll.update();
    } else {
        console.warn(
            "Locomotive Scroll tidak diinisialisasi: Elemen [data-scroll-container] tidak ditemukan."
        );
    }
});
