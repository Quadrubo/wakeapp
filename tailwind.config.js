const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    safelist: [
        {
            pattern: /grid-cols-(.*)/,
            variants: ['sm', 'md', 'lg', 'xl', '2xl']
        },
        {
            pattern: /(border|text|bg|ring)-(.*)/,
            variants: ['focus', 'hover', 'active']
        },
        {
            pattern: /(pr)-\[(.*)px\]/,
            variants: []
        }
    ],

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
