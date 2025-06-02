import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    // 👇 Ini bagian yang ditambahkan
    safelist: [
        'text-white',
        'text-black',
        'bg-white',
        'bg-opacity-20',
        'placeholder-gray-300',
        'focus:ring-2',
        'focus:ring-orange-500',
        'focus:border-orange-500',
        'rounded-md',
        'shadow-sm',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
