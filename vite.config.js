import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['public/dist/css/adminlte.css', 'public/dist/js/adminlte.js'],
            refresh: true,
        }),
    ],
});
