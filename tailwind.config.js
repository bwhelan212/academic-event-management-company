/** @type {import('tailwindcss').Config} */
module.exports = {
  content:
   [
    './*.php',          
    './**/*.php', 
    "./**/*.{html,js}",       
  ],
  theme: {
    extend: {},
  },
  plugins: [require('@tailwindcss/forms')],
}

