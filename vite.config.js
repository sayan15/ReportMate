import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/tailwind.output.css',
                'resources/js/app.js',
                'resources/js/dashboard.js',
                'resources/js/map.js',
                'resources/js/report.js',
                'resources/js/firebaseMessagingService.js',
                'resources/js/createUser.js',
            ],
            refresh: true,
        }),vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
