/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {},
    },
    daisyui: {
        themes: ["nord", "light"],
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('daisyui')
    ],
}

