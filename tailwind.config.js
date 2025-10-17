/** @type {import('tailwindcss').Config} */
export default {
    content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
    theme: {
        extend: {
            fontFamily: {
                roboto: ['Roboto', 'sans-serif'],
                chiron: ['"Chiron Hei HK"', 'sans-serif'],
            },
            keyframes: {
                marquee: {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                zoomIn: {
                    '0%': { transform: 'scale(0.8)', opacity: '0' },
                    '100%': { transform: 'scale(1)', opacity: '1' },
                },
                zoomOut: {
                    '0%': { transform: 'scale(1)', opacity: '1' },
                    '100%': { transform: 'scale(0.8)', opacity: '0' },
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeOutDown: {
                    '0%': { opacity: '1', transform: 'translateY(0)' },
                    '100%': { opacity: '0', transform: 'translateY(10px)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-12px)' },
                },
            },
            animation: {
                marquee: 'marquee 60s linear infinite',
                'zoom-in': 'zoomIn 0.3s ease forwards',
                'zoom-out': 'zoomOut 0.3s ease forwards',
                'fade-in-up': 'fadeInUp 0.3s ease-out forwards',
                'fade-out-down': 'fadeOutDown 0.3s ease-in forwards',
                float: 'float 4s ease-in-out infinite',
            },
        },
    },
    safelist: [
        ...['gray', 'red', 'yellow', 'green', 'sky', 'purple'].flatMap((color) => [
            `bg-${color}-50`,
            `bg-${color}-100`,
            `bg-${color}-200`,
            `bg-${color}-300`,
            `bg-${color}-400`,
            `bg-${color}-500`,
            `bg-${color}-600`,
            `bg-${color}-700`,
            `bg-${color}-800`,
            `bg-${color}-900`,
        ]),
        ...['gray', 'red', 'yellow', 'green', 'sky', 'purple'].flatMap((color) => [
            `border-${color}-50`,
            `border-${color}-100`,
            `border-${color}-200`,
            `border-${color}-300`,
            `border-${color}-400`,
            `border-${color}-500`,
            `border-${color}-600`,
            `border-${color}-700`,
            `border-${color}-800`,
            `border-${color}-900`,
        ]),
        ...['gray', 'red', 'yellow', 'green', 'sky', 'purple'].flatMap((color) => [
            `text-${color}-50`,
            `text-${color}-100`,
            `text-${color}-200`,
            `text-${color}-300`,
            `text-${color}-400`,
            `text-${color}-500`,
            `text-${color}-600`,
            `text-${color}-700`,
            `text-${color}-800`,
            `text-${color}-900`,
        ]),
    ],
    plugins: [],
};
