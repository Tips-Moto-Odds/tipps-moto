import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                inter: 'Inter',
            },
            colors: {
                primary_orange: "#D88731",
                secondary_orange: "#F4660D",
                app_white: "#F5F5F5",
                app_gray: "#1E1E1E",
                cookie_popup_grey: "#D9D9D9",
                app_red: "#E50B0B",
                app_green: "#4CBC2A",
                card_grey: "#433F3F",
            },
            borderRadius: {
                '1': '3px',
                '2': '6px',
                '3': '9px',
                '4': '12px',
                '5': '15px',
                '6': '18px',
                '7': '21px',
                '8': '24px',
            },
        },
    },

    plugins: [forms, typography],
};
