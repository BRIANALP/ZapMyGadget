/** @type {import('tailwindcss').Config} */
export default {
  
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  
  theme: {
    extend: {
      colors: {
        'teal':'#4fa0ab',
        'orange':'#eeba2b',
        'bluetheme': '#06061f',
        'softteal' : '#84bcc4'
      },
      fontFamily: {
         'garamond': 'EB Garamond',
         'sour' : 'Sour Gummy'
      }
    },
  },
  plugins: [],
}

