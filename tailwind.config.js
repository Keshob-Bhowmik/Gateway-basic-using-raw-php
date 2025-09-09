/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{html,js}",   // all .html and .js files in root
    "./src/**/*.{html,js}" // all inside src folder
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
