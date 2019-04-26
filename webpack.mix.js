const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.scripts('resources/js/jquery-3.3.1.min.js', 'public/js/jquery-3.3.1.min.js')
   .scripts('resources/js/jquery-ui.min.js', 'public/js/jquery-ui.min.js')
   .scripts('resources/js/popper.min.js', 'public/js/popper.min.js')
   .scripts('resources/js/bootstrap.min.js', 'public/js/bootstrap.min.js')
   .scripts('resources/js/jquery.slimscroll.js', 'public/js/jquery.slimscroll.js')
   .scripts('resources/js/pcoded.min.js', 'public/js/pcoded.min.js')
   .scripts('resources/js/waves.min.js', 'public/js/waves.min.js')
   .scripts('resources/js/vertical-layout.min.js', 'public/js/vertical-layout.min.js')
   .scripts('resources/js/custom_scripts.js', 'public/js/custom_scripts.js')
   .scripts('resources/js/pages.js', 'public/js/pages.js')
   .scripts('resources/js/alertify.min.js', 'public/js/alertify.min.js')
   .scripts('resources/js/jquery.passtrength.min.js', 'public/js/jquery.passtrength.min.js')
   .scripts('resources/js/switchery.min.js', 'public/js/switchery.min.js')
   .scripts('resources/js/amcharts.min.js', 'public/js/amcharts.min.js')
   .scripts('resources/js/serial.min.js', 'public/js/serial.min.js')
   .scripts('resources/js/light.min.js', 'public/js/light.min.js')
   .scripts('resources/js/lightbox.min.js', 'public/js/lightbox.min.js')
   .scripts('resources/js/datatable.min.js', 'public/js/datatable.min.js')
   .scripts('resources/js/scripts.js', 'public/js/scripts.js')
   .scripts('resources/js/select2.full.min.js', 'public/js/select2.full.min.js')
   .scripts('resources/js/buttons.bootstrap4.min.js', 'public/js/buttons.bootstrap4.min.js')
   .scripts('resources/js/pdfmake.min.js', 'public/js/pdfmake.min.js')
   .scripts('resources/js/jszip.min.js', 'public/js/jszip.min.js')
   .scripts('resources/js/bootstrap-datepicker.min.js', 'public/js/bootstrap-datepicker.min.js')
   .scripts('resources/js/Sortable.js', 'public/js/Sortable.js')
   .scripts('resources/js/axios.min.js', 'public/js/axios.min.js')
;

mix.styles('resources/css/bootstrap.min.css', 'public/css/bootstrap.min.css')
   .styles('resources/css/feather.css', 'public/css/feather.min.css')
   .styles('resources/css/waves.min.css', 'public/css/waves.min.css')
   .styles('resources/css/icofont.css', 'public/css/icofont.min.css')
   .styles('resources/css/custom_styles.css', 'public/css/custom_styles.min.css')
   .styles('resources/css/pages.css', 'public/css/pages.css')
   .styles('resources/css/passtrength.css', 'public/css/passtrength.css')
   .styles('resources/css/alertify.min.css', 'public/css/alertify.min.css')
   .styles('resources/css/switchery.min.css', 'public/css/switchery.min.css')
   .styles('resources/css/lightbox.min.css', 'public/css/lightbox.min.css')
   .styles('resources/css/select2.min.css', 'public/css/select2.min.css')
   .styles('resources/css/jquery.dataTables.min.css', 'public/css/jquery.dataTables.min.css')
   .styles('resources/css/widget.css', 'public/css/widget.css')
   .styles('resources/css/styles.css', 'public/css/styles.css')
   .styles('resources/css/buttons.bootstrap4.min.css', 'public/css/buttons.bootstrap4.min.css')
   .styles('resources/css/bootstrap.datepicker.css', 'public/css/bootstrap.datepicker.css')
;