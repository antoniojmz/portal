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
				google: {"families":["Montserrat:300,400,500,600,700","Roboto:300,400,500,600,700"]},
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
    	{!! Html::style('theme/dist/html/demo3/assets/vendors/base/vendors.bundle.css') !!}
    	{!! Html::style('theme/dist/html/demo3/assets/demo/demo3/base/style.bundle.css') !!}
    	<!-- Estilos Plugins -->
    	{!! Html::style('plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.min.css') !!}
    	{!! Html::style('plugins/font-awesome-4.7.0/css/font-awesome.min.css') !!}
    	<!-- datatables -->
    	{!! Html::style('plugins/DataTables-1.10.10/media/css/jquery.dataTables.min.css') !!}
    	{!! Html::style('plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.css') !!}
    	{!! Html::style('plugins/validator/formValidation.min.css') !!}
    	{!! Html::style('plugins/DataTables-1.10.10/buttons.dataTables.min.css') !!}
    	{!! Html::style('') !!}
    	<style TYPE="text/css">
	    	.select2-container--default .select2-selection--single .select2-selection__rendered .select2-selection__clear {
	    		margin-top:-1.0rem;
	    	}
	    	.help-block{
	    		color:#FF0000;
	    		font-size: 9px;
	    	}
	    	.gavatar{
        		display:inline-block;
        		border-radius:120px;
        		width:120px;
        		height:120px;
        		margin:20px;
        	} 
        	#spanTitulo{
        		font-size: 150%;
        	}
        	.spanSubTitulo{
        		font-size: 120%;
        	}
        	.spanDisable{
        		background-color: #F4F5F8;
        	}
	    </style>
    	<!-- ////////////////////////////////////////////////////////////////////////////// -->
    	<!--begin::Base Scripts -->
    	<!-- ////////////////////////////////////////////////////////////////////////////// -->
		{{ HTML::script('theme/dist/html/demo3/assets/vendors/base/vendors.bundle.js') }}
		{{ HTML::script('theme/dist/html/demo3/assets/demo/demo3/base/scripts.bundle.js') }}
		{{ HTML::script('theme/dist/html/demo3/assets/app/js/dashboard.js') }}
		{{ HTML::script('theme/dist/html/default/assets/demo/default/custom/header/actions.js') }}
    	<!-- Scritp Plugins -->
    	<!-- datatables -->
		{{ HTML::script('plugins/DataTables-1.10.10/media/js/jquery.dataTables.min.js') }}
		{{ HTML::script('plugins/DataTables-1.10.10/dataTables.buttons.min.js') }}
		{{ HTML::script('plugins/DataTables-1.10.10/jszip.min.js') }}
		{{ HTML::script('plugins/DataTables-1.10.10/pdfmake.min.js') }}
		{{ HTML::script('plugins/DataTables-1.10.10/vfs_fonts.js') }}
		{{ HTML::script('plugins/DataTables-1.10.10/buttons.html5.min.js') }}
		{{ HTML::script('plugins/DataTables-1.10.10/buttons.print.min.js') }}
		{{ HTML::script('plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.min.js') }}
    	<!-- date-range-picker -->
		{{ HTML::script('plugins/daterangepicker/daterangepicker.js') }}
		{{ HTML::script('plugins/datepicker/bootstrap-datepicker.es.js') }}
		{{ HTML::script('plugins/validator/valtexto.min.js') }}
		{{ HTML::script('plugins/validator/formValidation.min.js') }}
		{{ HTML::script('plugins/validator/fvbootstrap.min.js') }}
		{{ HTML::script('plugins/validator/es_ES.js') }}
		{{ HTML::script('plugins/Jquery-Price-Format/jquery.priceformat.min.js') }}
		{{ HTML::script('plugins/Jquery.expander/jquery.expander.js') }}
		{{ HTML::script('js/utils/utils.js') }}
		{{ HTML::script('js/index/index.js') }}

	</head>
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<form id="formLogout" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>
		<div id="divSeparacion" class="m-grid m-grid--hor m-grid--root m-page">
			@include('menu.menu_superior')
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				@include('menu.menu_izquierdo')
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<br />
	         		@yield('content')
				</div>
			</div>
			@include('menu.menu_footer')
		</div>
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
	</body>
</html>