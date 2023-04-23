import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/vh.js',

                // Home
                'resources/js/Home/js.js',

                // NFLPlayoffs2022
                'resources/js/NFLPlayoffs2022/js.js',
                'resources/js/NFLPlayoffs2022/table.js',

                // WC2022
                'resources/js/WC2022/input.js',
                'resources/js/WC2022/table.js',
            ],
            refresh: true,
        }),
    ],
});
