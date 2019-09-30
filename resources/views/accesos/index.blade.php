<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
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
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script language="JavaScript" type="text/javascript">
	        WebFont.load({
	            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
	            active: function() {
	                sessionStorage.fonts = true;
	            }
	        });
			var RutaSalir = "{{ URL::route('logout') }}";
		</script>
		<!-- Archivos de Estilos -->
		{!! Html::style('theme/dist/html/demo2/assets/vendors/base/vendors.bundle.css') !!}
		{!! Html::style('theme/dist/html/demo2/assets/demo/demo2/base/style.bundle.css') !!}
		{!! Html::style('plugins/DataTables-1.10.10/media/css/jquery.dataTables.min.css') !!}
		{!! Html::style('css/core/core.css') !!}
		<!-- Archivos Javascritp -->
		{{ HTML::script('theme/dist/html/demo3/assets/vendors/base/vendors.bundle.js') }} 
		{{ HTML::script('theme/dist/html/demo3/assets/demo/demo3/base/scripts.bundle.js') }} 
		{{ HTML::script('plugins/DataTables-1.10.10/media/js/jquery.dataTables.js') }} 
		{{ HTML::script('js/utils/utils.js') }}

		<style>
	        .modal {
	            display:    none;
	            position:   fixed;
	            z-index:    10000;
	            top:        0;
	            left:       0;
	            height:     100%;
	            width:      100%;
	            background: rgba( 255, 255, 255, .8 ) url('/icon/ajax-loader.gif') 50% 50%  no-repeat;
	        }

	        /* When the body has the loading class, we turn the scrollbar off with overflow:hidden */
	        body.loading {
	            overflow: hidden;   
	        }

	        /* Anytime the body has the loading class, our modal element will be visible */
	        body.loading .modal {
	            display: block;
	        }

	    </style>
	</head>

	<body onLoad="if ('Navigator' == navigator.appName)document.forms[0].reset();" class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default" style="background-color:#F2F3F8">
		<form id="formLogout" name="formLogout" style="display: none;" method="POST" action="/logout"> 
			{{ csrf_field() }}
		</form>
		<div class="m-grid m-grid--hor m-grid--root m-page">
			@include('accesos.accesos_header')
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					@yield('content')
				</div>
			</div>
			@include('menu.menu_footer')
		</div>
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		@if(!empty($_GET['logout'])){
			@if (isset($_GET['logout']))
				<script>
		    		Salir();
				</script>
			@endif
		@endif
	</body>
		<div class="modal" style="text-align: center; vertical-align: middle;">
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Cargando Perfil...
		</div>
</html>