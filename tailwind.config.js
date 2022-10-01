/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: "jit",
  content: ["./resources/**/*.{html,js,ts,vue,blade.php}"],
  theme: {
    extend: {},
    fontSize: {
      xxxxs: '4px',
      xxxs: '0.2rem',
      xxs: '0.5rem',
      xs: '0.6rem',
      sm: '0.8rem',
      base: '1rem',
      xl: '1.25rem',
      '2xl': '1.563rem',
      '3xl': '1.953rem',
      '4xl': '2.441rem',
      '5xl': '3.052rem',
    }
  },
  plugins: [],
}
