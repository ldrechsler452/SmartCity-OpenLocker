import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // remove this line if you don't want color mode system
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.tsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                green: {
                    50: '#f9fbe7',
                    100: '#f0f4c3',
                    200: '#e6ee9c',
                    300: '#dce775',
                    400: '#d4e157',
                    500: '#afca0b',
                    600: '#c0ca33',
                    700: '#afb42b',
                    800: '#9e9d24',
                    900: '#827717',
                },
            },
        },
    },

    plugins: [forms],
}