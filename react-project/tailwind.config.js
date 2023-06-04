/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        header: '#09090A',
        body: '#0f0f11',
        bodyLighter: '#242429',
        tile: '#17181c',        
        navbar: '#f2f4fa',
        navbarHover: '#8992ad',
        green: '#007A7A',
        red: '#85191D',
        light: '#2A2C33',
        text: '#dedede',
      },
      backgroundImage: {
        'login': "url('./assets/login-background.jpg')",
      }
    },
  },
  plugins: [],
}

