<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<head>
	@php
		header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', FALSE);
		header('Pragma: no-cache');
    @endphp
	<meta charset="utf-8" />
	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script language="JavaScript" type="text/javascript">
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
	</script>
	<!-- Archivos de Estilos -->
	{!! Html::style('theme/dist/html/demo2/assets/vendors/base/vendors.bundle.css') !!}
	{!! Html::style('theme/dist/html/demo2/assets/demo/demo2/base/style.bundle.css') !!}
	{!! Html::style('plugins/DataTables-1.10.10/media/css/jquery.dataTables.min.css') !!}
	{!! Html::style('css/app/app.css') !!}
	{!! Html::style('css/accesos/accesos.css') !!}
	<!-- Archivos Javascritp -->
	{{ HTML::script('theme/dist/html/demo2/assets/vendors/base/vendors.bundle.js') }}
	{{ HTML::script('theme/dist/html/demo2/assets/demo/demo2/base/scripts.bundle.js') }}
	{{ HTML::script('plugins/DataTables-1.10.10/media/js/jquery.dataTables.min.js') }}
	{{ HTML::script('js/utils/utils.js') }}
</head>
<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default" style="background-color:#F2F3F8">
	<form id="formLogout" style="display: none;"> 
		{{ csrf_field() }}
	</form>
	<div class="m-grid m-grid--hor m-grid--root m-page">
		@include('accesos.accesos_header')
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
			<div class="m-grid__item m-grid__item--fluid m-wrapper">
				@yield('content')
			</div>
		</div>
		@include('accesos.accesos_footer')
	</div>
	<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
		<i class="la la-arrow-up"></i>
	</div>
</body>
</html>