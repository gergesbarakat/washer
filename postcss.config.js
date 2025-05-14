export default {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
};
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-custom-properties')
]);