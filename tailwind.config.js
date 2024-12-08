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
                "muted": "#CEC4C7",
                "primary-contrast": "#FFF",
                "secondary-contrast": "#FFF",
                "success-contrast": "#FFF",
                "warning-contrast": "#1f2d3d",
                "info-contrast": "#FFF",
                "danger-contrast": "#FFF",
                "light-contrast": "#1f2d3d",
                "dark-contrast": "#FFF"
            }
        },
    },
    daisyui: {
        themes: [
            {
                admin: {
                    ...require("daisyui/src/theming/themes")["light"],
                    "--rounded-box": "0.3rem",
                    "--padding-card": "1.25rem",
                    "neutral-content": "#e9ecef",
                    primary: "#007bff",
                    secondary: "#6c757d",
                    success: "#28a745",
                    warning: "#ffc107",
                    info: "#17a2b8",
                    danger: "#dc3545",
                    light: "#f8f9fa",
                    dark: "#343a40",
                }
            }
        ],
    },
    plugins: [
        require('daisyui')
    ],
};
