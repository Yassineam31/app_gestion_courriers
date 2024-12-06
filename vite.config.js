import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/dashboard.css',
                'resources/css/sideBar.css',
                'resources/css/footer.css',
                'resources/js/app.js',
                'resources/js/sideBar.js',
                
                ],
            refresh: true,
        }),
    ],
});
