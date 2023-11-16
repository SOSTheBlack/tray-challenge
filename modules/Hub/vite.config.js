import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: '../../public/build-hub',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-hub',
            input: [
                __dirname + '/resources/assets/sass/App.scss',
                __dirname + '/resources/assets/js/App.js'
            ],
            refresh: true,
        }),
    ],
});

//export const paths = [
//    'Modules/$STUDLY_NAME$/resources/assets/sass/App.scss',
//    'Modules/$STUDLY_NAME$/resources/assets/js/App.js',
//];
