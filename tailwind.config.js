/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*/*.{html,js,php,twig}",
    "./views/*.{html,js,php,twig}"
  ],
  theme: {
    extend: {
      maxWidth: {
        "8xl": "88rem",
        "9xl": "96rem"
      }
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
    require('@tailwindcss/typography')
  ],
  darkMode: 'class',
}
