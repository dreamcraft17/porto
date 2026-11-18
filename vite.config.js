import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/portfolio-base.css',
                'resources/css/portfolio-public.css',
                'resources/css/portfolio-epic.css',
                'resources/css/admin-panel.css',
                'resources/js/portfolio-contact.js',
                'resources/js/portfolio-nav.js',
                'resources/js/portfolio-epic.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
