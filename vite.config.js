import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/legacy-layout.css',
                'resources/css/portfolio-base.css',
                'resources/css/portfolio-public.css',
                'resources/css/portfolio-epic.css',
                'resources/css/admin-panel.css',
                'resources/js/app.js',
                'resources/js/portfolio-contact.js',
                'resources/js/portfolio-nav.js',
                'resources/js/portfolio-epic.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
