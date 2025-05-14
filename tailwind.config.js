import 'tailwindcss ';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
    purge: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'], // Deprecated in newer versions; use `content` instead.
    theme: {
        darkMode: 'class',
        extend: {},
    },
    plugins: [],
};