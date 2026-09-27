import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                maroon: {
                    50: '#fdf3f4',
                    100: '#fbe4e7',
                    200: '#f5c6cb',
                    800: '#6d1020',
                    900: '#4a0b16',
                },
                cream: {
                    DEFAULT: '#f9f6f0',
                    100: '#fffdf8',
                    200: '#f3ead8',
                },
                gold: {
                    DEFAULT: '#d4af37',
                    hover: '#b5952f',
                    light: '#f3e5ab'
                }
            }
        },
    },

    plugins: [forms],
};
