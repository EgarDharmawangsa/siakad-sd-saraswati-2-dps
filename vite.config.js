import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/pages/master/siswa.js',
                'resources/js/pages/master/pegawai.js',
            ],
            refresh: true,
        }),
    ],
});
