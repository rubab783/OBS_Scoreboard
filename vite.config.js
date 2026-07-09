import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/match-control.js',
                 'resources/js/overlay-config.js',
                 'resources/css/overlay-theme.css',
                 'resources/js/overlay-render.js',
                 'resources/js/overlay-templates.js',
            ],
            refresh: true,
        }),
    ],
});