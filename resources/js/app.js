import "./bootstrap";
import "flowbite";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Функция смены цветовой темы
document.addEventListener("DOMContentLoaded", (event) => {
    const themeToggleDarkIcon = document.getElementById(
        "theme-toggle-dark-icon"
    );
    const themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );

    const themeToggleBtn = document.getElementById("theme-toggle");
    const currentTheme = localStorage.getItem("color-theme");

    if (currentTheme) {
        document.documentElement.classList.add(currentTheme);
        if (currentTheme === "dark") {
            themeToggleLightIcon.classList.remove("hidden");
        } else {
            themeToggleDarkIcon.classList.remove("hidden");
        }
    } else {
        if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
            document.documentElement.classList.add("dark");
            themeToggleLightIcon.classList.remove("hidden");
            localStorage.setItem("color-theme", "dark");
        } else {
            themeToggleDarkIcon.classList.remove("hidden");
        }
    }

    themeToggleBtn.addEventListener("click", function () {
        document.documentElement.classList.toggle("dark");
        if (document.documentElement.classList.contains("dark")) {
            themeToggleLightIcon.classList.remove("hidden");
            themeToggleDarkIcon.classList.add("hidden");
            localStorage.setItem("color-theme", "dark");
        } else {
            themeToggleLightIcon.classList.add("hidden");
            themeToggleDarkIcon.classList.remove("hidden");
            localStorage.setItem("color-theme", "light");
        }
    });
});
