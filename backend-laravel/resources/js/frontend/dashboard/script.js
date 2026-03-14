document.addEventListener('alpine:init', () => {

    Alpine.data('dashboardLayout', () => ({
        sidebarOpen: false,
        sidebarCollapsed: false,

        init() {
            // Restore collapse state
            const savedState = localStorage.getItem('sidebarCollapsed');
            this.sidebarCollapsed = savedState === 'true';

            // Watch collapse change
            this.$watch('sidebarCollapsed', value => {
                localStorage.setItem('sidebarCollapsed', value);
            });

            // Auto close mobile sidebar when resizing to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    this.sidebarOpen = false;
                }
            });
        },

        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
        },

        toggleCollapse() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
        }
    }));

});