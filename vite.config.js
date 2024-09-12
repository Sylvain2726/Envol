import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    alias: {
        'pagedone': 'node_modules/pagedone/dist/pagedone.js'
    }

/*     server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: '192.168.100.24', // Remplacez par l'adresse IP de votre ordinateur
        },
    }, */

});
