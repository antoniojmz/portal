<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
			header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
		?>
		<meta charset="utf-8" />
		<meta http-equiv="Pragma" CONTENT="no-cache">
		<meta http-equiv="Expires" CONTENT="-1">
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'Laravel') }}</title>
    	{!! Html::style('theme/dist/html/default/assets/vendors/base/vendors.bundle.css') !!}
    	{!! Html::style('theme/dist/html/default/assets/demo/default/base/style.bundle.css') !!}
    	<link rel="icon" href="{!! asset('theme/dist/html/default/assets/demo/default/media/img/logo/favicon.ico') !!}"/>
    	<style TYPE="text/css">
    		#g-recaptcha-response-error{
        		color:#F4516C;
        		font-size:13px;
        	}
        	.rut-error{
        		color:#F4516C;
				font-size:12px;
        	}
    	</style>
		{{ HTML::script('theme/dist/html/default/assets/vendors/base/vendors.bundle.js') }}
		{{ HTML::script('theme/dist/html/default/assets/demo/default/base/scripts.bundle.js') }}
		{{ HTML::script('js/utils/utils.js') }}
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
			var widgetId1;
			var widgetId2;
			var onloadCallback = function() {
				widgetId1 = grecaptcha.render('pp-grecaptcha', {
					'sitekey' : '6LfSgz0UAAAAAGogr0cFDeQlK9J-TLP2KPiF0oUt',
					'theme' : 'light'
				});
				widgetId2 = grecaptcha.render('pp-grecaptcha-1', {
					'sitekey' : '6LfSgz0UAAAAAGogr0cFDeQlK9J-TLP2KPiF0oUt',
					'theme' : 'light'
				});	
			};
		</script>
	</head>
	<body onLoad="if ('Navigator' == navigator.appName)document.forms[0].reset();" class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		@yield('content')
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
	</body>
</html>