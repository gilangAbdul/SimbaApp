import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js",
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
    ],
    theme: {
        screens: {
            'sm': {'min': '300px', 'max': '499px'},
            // => @media (min-width: 640px and max-width: 767px) { ... }

            'md': {'min': '499px', 'max': '899px'},
            // => @media (min-width: 768px and max-width: 1023px) { ... }

            'lg': {'min': '900px'}
            // => @media (min-width: 1024px and max-width: 1279px) { ... }
        },
        extend: {},
    },
    plugins: [
        require('flowbite/plugin'),
        forms,
    ],
  };
