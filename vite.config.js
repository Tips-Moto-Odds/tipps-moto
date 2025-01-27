import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'routes/**/*.php',  // This covers all PHP files in the routes directory
                'app/Http/Controllers/**/*.php'  // This covers all controllers
            ],
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],

    server: {
        host: '192.168.100.20',
        port: 3000
    }
});
