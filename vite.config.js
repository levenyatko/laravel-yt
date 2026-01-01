import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        https: false,
        strictPort: true,
        port: 3000,
        host: '0.0.0.0',
        hmr: {
            clientPort: 3000,
            host: 'localhost',
        },
        watch: {
            usePolling:true,
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
