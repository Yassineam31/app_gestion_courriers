import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/dashboard.css',
                'resources/css/sideBar.css',
                'resources/css/courrierIndex.css',
                'resources/css/formEntrant.css',
                'resources/css/formSortant.css',
                'resources/css/show.css',
                'resources/js/app.js',
                'resources/js/sideBar.js',
                'resources/js/alerts.js',
            ],
            refresh: true,
        }),
    ],
});
