/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        cyb: {
          gold: '#c8942f',
          amber: '#f1c35b',
          bronze: '#7b4b1d',
          ink: '#11100d',
          paper: '#fbfaf7',
        },
      },
      boxShadow: {
        soft: '0 20px 60px -30px rgba(17, 16, 13, 0.35)',
        gold: '0 18px 50px -24px rgba(200, 148, 47, 0.75)',
      },
    },
  },
  plugins: [],
}
