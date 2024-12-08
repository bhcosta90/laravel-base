import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            borderWidth: {
                '1': '1px',
                '3': '3px',
            },
            colors: {
                textColor: {
                    DEFAULT: '#4A5568',
                },
                "muted": "#CEC4C7"
            }
        },
    },
    daisyui: {
        themes: [
            {
                admin: {
                    ...require("daisyui/src/theming/themes")["light"],
                    "--rounded-box": "0.3rem",
                    "--padding-card": "1.25rem"
                }
            }
        ],
    },
    plugins: [
        require('daisyui')
    ],
};
