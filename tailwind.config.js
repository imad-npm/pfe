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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors :{
                primary: '#1E40AF',   // blue-900
        secondary: '#518071', // slate-500
        success: '#008b68',   // green-500
        danger: '#e13f4c',    // danger
        warning: '#F59E0B',  
            }
        },
    },

    plugins: [forms],
};
