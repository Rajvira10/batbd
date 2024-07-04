import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.jsx', 'resources/css/app.css'], // Entry points
            refresh: true,
        }),
        react(),
    ],
    // server:{
    //     host: true,
    //     hmr: {
    //         host: 'localhost',
    //     },
    // }
});