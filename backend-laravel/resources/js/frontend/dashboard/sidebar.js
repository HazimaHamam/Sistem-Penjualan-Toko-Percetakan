// Sidebar Enhancement Script

document.addEventListener("DOMContentLoaded", () => {

    const menuItems = document.querySelectorAll("aside nav a");

    // =============================
    // Click Animation
    // =============================
    menuItems.forEach(item => {
        item.addEventListener("click", function (e) {

            this.classList.add("scale-95");
            setTimeout(() => {
                this.classList.remove("scale-95");
            }, 150);

        });
    });


    // =============================
    // Hover Elevation Effect
    // =============================
    menuItems.forEach(item => {
        item.addEventListener("mouseenter", function () {
            this.classList.add("shadow-sm");
        });

        item.addEventListener("mouseleave", function () {
            this.classList.remove("shadow-sm");
        });
    });


    // =============================
    // Smooth Fade-In Sidebar
    // =============================
    const sidebar = document.querySelector("aside");
    if (sidebar) {
        sidebar.classList.add("opacity-0", "translate-x-[-10px]");
        setTimeout(() => {
            sidebar.classList.remove("opacity-0", "translate-x-[-10px]");
            sidebar.classList.add("transition-all", "duration-500", "ease-out");
        }, 100);
    }

});