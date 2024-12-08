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
                    "primary": "#007bff",
                    "primary-content": "#FFF",
                    "secondary": "#6c757d",
                    "secondary-content": "#FFF",
                    "accent": "#FFF",
                    "base-100": "#f9fafb",
                    "base-200": "#f4f5f7",
                    "base-300": "#e1e4e8",
                    "base-content": "#1f2937",
                    "neutral": "#373737",
                    "neutral-content": "#e9ecef",
                    "info": "#17a2b8",
                    "info-content": "#FFF",
                    "success": "#28a745",
                    "success-content": "#FFF",
                    "warning": "#ffc107",
                    "warning-content": "#373737",
                    "error": "#dc3545",
                    "error-content": "#FFF",
                    "--rounded-box": "0.3rem",
                    "--rounded-btn": ".25rem",
                    "--rounded-badge": ".25rem",
                    "--animation-btn": "0",
                    "--animation-input": "0",
                    "--btn-focus-scale": "1",
                    "--tab-radius": "0",
                    "--padding-card": "1.25rem"
                }
            }
        ],
    },
    plugins: [
        require('daisyui')
    ],
};
