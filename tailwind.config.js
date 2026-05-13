/** @type {import('tailwindcss').Config} */
export default {
    darkMode: ["class", '[data-theme="dark"]'],
    content: [
        "./resources/**/*.{blade.php,js,vue,jsx}",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                display: ["Instrument Serif", "serif"],
                body: ["Inter", "sans-serif"],
            },
        },
    },
    plugins: [],
};
