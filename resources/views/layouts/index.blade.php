<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<!-- begin::Head -->
	<head>
    	<title>{{ config('app.name', 'Laravel') }}</title>
		<meta charset="utf-8" />
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Base Styles -->
    	{!! Html::style('theme/dist/html/default/assets/vendors/base/vendors.bundle.css') !!}
    	{!! Html::style('theme/dist/html/default/assets/demo/default/base/style.bundle.css') !!}
    	<link rel="icon" href="{!! asset('theme/dist/html/default/assets/demo/default/media/img/logo/favicon.ico') !!}"/>
    	<!--begin::Base Scripts -->
		{{ HTML::script('theme/dist/html/default/assets/vendors/base/vendors.bundle.js') }}
		{{ HTML::script('theme/dist/html/default/assets/demo/default/base/scripts.bundle.js') }}
		{{ HTML::script('plugins/jquery.maskedinput/dist/jquery.maskedinput.min.js') }}

		<!--end::Base Scripts -->
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		@yield('content')
		<!-- end::Body -->
	</body>
</html>