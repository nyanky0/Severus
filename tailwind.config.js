import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                venom: {
                    50: '#e6fffa',
                    100: '#b2f5ea',
                    400: '#38b2ac',
                    500: '#00e676',
                    600: '#10b981',
                    800: '#064e3b',
                    900: '#0a0f0d',
                    950: '#050806',
                },
            },
            fontFamily: {
                sans: ['Outfit', 'Inter', ...defaultTheme.fontFamily.sans],
                cinzel: ['Cinzel', 'serif'],
                gothic: ['Cinzel Decorative', 'Cinzel', 'serif'],
            },
        },
    },
    plugins: [],
};
