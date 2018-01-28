let mix = require('laravel-mix');

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

mix.scripts([
	'public/theme/dist/html/demo3/assets/vendors/base/vendors.bundle.js',
	'public/theme/dist/html/demo3/assets/demo/demo3/base/scripts.bundle.js',
	'public/theme/dist/html/demo3/assets/app/js/dashboard.js',
	'public/theme/dist/html/default/assets/demo/default/custom/header/actions.js',
	'public/plugins/DataTables-1.10.10/media/js/jquery.dataTables.js',
	'public/plugins/DataTables-1.10.10/dataTables.buttons.js',
	'public/plugins/DataTables-1.10.10/jszip.js',
	'public/plugins/DataTables-1.10.10/pdfmake.js',
	'public/plugins/DataTables-1.10.10/vfs_fonts.js',
	'public/plugins/DataTables-1.10.10/buttons.html5.js',
	'public/plugins/DataTables-1.10.10/buttons.print.js',
	'public/plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.js',
	'public/plugins/jquery.color/jquery.color-2.1.2.js',
	'public/plugins/daterangepicker/moment-with-locale-es.js',
	'public/plugins/daterangepicker/daterangepicker.js',
	'public/plugins/datepicker/bootstrap-datepicker.es.js',
	'public/plugins/validator/valtexto.js',
	'public/plugins/validator/formValidation.js',
	'public/plugins/validator/fvbootstrap.js',
	'public/plugins/validator/es_ES.js',
	'public/plugins/Jquery-Price-Format/jquery.priceformat.js',
	'public/plugins/Jquery.expander/jquery.expander.js',
	'public/js/utils/utils.js',
	], 'public/js/core/core.js')
.styles([
	'public/plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.css',
	'public/plugins/validator/formValidation.css',
	'public/css/app/app.css',
	], 'public/css/core/core.css');

