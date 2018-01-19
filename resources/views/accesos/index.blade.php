<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<!-- begin::Head -->
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
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--Begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script language="JavaScript" type="text/javascript">
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
		var v_salir = 0;
		var salir = "{{ URL::route('logout') }}";
	</script>
	<!--end::Web font -->
	<!-- ////////////////////////////////////////////////////////////////////////////// -->
	<!-- begin::Base Styles -->
	<!-- ////////////////////////////////////////////////////////////////////////////// -->
	{!! Html::style('theme/dist/html/demo2/assets/vendors/base/vendors.bundle.css') !!}
	{!! Html::style('theme/dist/html/demo2/assets/demo/demo2/base/style.bundle.css') !!}
	<!-- Estilos Plugins -->
	{!! Html::style('plugins/DataTables-1.10.10/media/css/jquery.dataTables.min.css') !!}
	{!! Html::style('plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.css') !!}
	{!! Html::style('plugins/validator/formValidation.min.css') !!}
	{!! Html::style('plugins/DataTables-1.10.10/buttons.dataTables.min.css') !!}
	{!! Html::style('css/app/app.css') !!}
	<style type="text/css" media="screen">
		@media screen and (min-width:992px){
			.m-brand{
				width: 100px;
			}
			#divInfoUsuario{
				color:#FFF;
				float: left;
				width: 80%;
				float: left;
			}
		}
		@media screen and (max-width:992px){
			#divInfoUsuario{
				display: none;
			}
		}
	</style>
	<!-- ////////////////////////////////////////////////////////////////////////////// -->
	<!--begin::Base Scripts -->
	<!-- ////////////////////////////////////////////////////////////////////////////// -->
	{{ HTML::script('theme/dist/html/demo2/assets/vendors/base/vendors.bundle.js') }}
	{{ HTML::script('theme/dist/html/demo2/assets/demo/demo2/base/scripts.bundle.js') }}
	{{ HTML::script('theme/dist/html/demo2/assets/app/js/dashboard.js') }}
	{{ HTML::script('theme/dist/html/default/assets/demo/default/custom/header/actions.js') }}
	<!-- Scritp Plugins -->
	<!-- data table -->
	{{ HTML::script('plugins/DataTables-1.10.10/media/js/jquery.dataTables.min.js') }}
	{{ HTML::script('plugins/DataTables-1.10.10/dataTables.buttons.min.js') }}
	{{ HTML::script('plugins/DataTables-1.10.10/jszip.min.js') }}
	{{ HTML::script('plugins/DataTables-1.10.10/pdfmake.min.js') }}
	{{ HTML::script('plugins/DataTables-1.10.10/vfs_fonts.js') }}
	{{ HTML::script('plugins/DataTables-1.10.10/buttons.html5.min.js') }}
	{{ HTML::script('plugins/DataTables-1.10.10/buttons.print.min.js') }}
	{{ HTML::script('plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.min.js') }}

	<!-- date-range-picker -->
	{{ HTML::script('js/utils/utils.js') }}
</head>
<!-- end::Head -->
<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default" style="background-color:#F2F3F8">
@php $data = Session::get('perfiles'); @endphp
	<div class="m-grid m-grid--hor m-grid--root m-page">
		@include('accesos.accesos_header')
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
			<div class="m-grid__item m-grid__item--fluid m-wrapper">
				<div class="m-content">
					@yield('content')
				</div>
			</div>
		</div>
		@include('accesos.accesos_footer')
	</div>
	<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
		<i class="la la-arrow-up"></i>
	</div>
</body>
</html>