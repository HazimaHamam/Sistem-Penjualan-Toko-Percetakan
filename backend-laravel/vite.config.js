import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',     // WAJIB untuk Docker
        port: 5173,          // port vite
        strictPort: true,

        watch: {
            usePolling: true,   // WAJIB untuk Docker (hot reload fix)
        },

        hmr: {
            host: 'localhost',
            port: 5173,
        },
    },
});