import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
          colors:{
            'jungle-green':'#1f3f2b',
            'jungle-yellow':'#fec00f',
            'jungle-brown':'#be945b',
            'jungle-dark-brown':'#422f25'
          },
          fontFamily: {
            caveat: ['Caveat', 'sans-serif'], 
            inter: ['Inter', 'sans-serif'],
            poppins: ['Poppins', 'sans-serif'],
          },
          height:{
            128:'32rem',
            192:'40rem',
          },
          width:{
            192:'40rem',
          },
          fontSize:{
            s:'10px'
          },
          borderWidth:{
            1:'1px'
          }
        },
      },
    plugins: [ 
        require('flowbite/plugin')
    ],
};
