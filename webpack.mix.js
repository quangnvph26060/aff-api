
  
 const mix = require('laravel-mix');


   mix.js('resources/js/app.js', 'public/js')
   .sass('resources/css/*', 'public/css')
   .copy('node_modules/bootstrap/dist/css/*', 'public/css')
      .postCss('resources/css/app.css', 'public/css', [
         require('tailwindcss'),
   ])
   .vue();