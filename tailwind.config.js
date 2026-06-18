import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Acento de marca: verde apagado (slate green).
                // Reservado para acciones primarias y elementos de marca.
                accent: {
                    50: '#f4f6f4',
                    100: '#e6ebe7',
                    200: '#cdd8cf',
                    300: '#a9bcad',
                    400: '#7e9884',
                    500: '#5d7a64',
                    600: '#4a6450',
                    700: '#3d5242',
                    800: '#334337',
                    900: '#2b382e',
                },
            },
        },
    },

    plugins: [forms],
};
