module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      height: {
        'negative-screen': '-32rem',
      },
      fontFamily: {
        'sans': ['Helvetica', 'Arial', 'sans-serif'],
        'orbitron' : ['Orbitron', 'sans-serif'],
      },
      aspectRation: {
        '3/6': '3 / 6',
      }
    },
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}
