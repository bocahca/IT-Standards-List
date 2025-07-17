import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#1E40AF',
                    light: '#3B82F6',
                    dark: '#1E3A8A',
                },
                secondary: {
                    DEFAULT: '#F59E0B',
                    light: '#FBBF24',
                    dark: '#B45309',
                },
                accent: '#10B981',
            },
            fontFamily: {
                // "Inter" di depan, baru default sans‐serif Tailwind
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                // Heading pakai Poppins, fallback ke sans bawaan
                heading: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        forms,
    ],
}
