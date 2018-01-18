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
	{!! Html::style('plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.min.css') !!}
	{!! Html::style('plugins/font-awesome-4.7.0/css/font-awesome.min.css') !!}
	<!-- datatables -->
	{!! Html::style('plugins/DataTables-1.10.10/media/css/jquery.dataTables.min.css') !!}
	{!! Html::style('plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.css') !!}
	{!! Html::style('plugins/validator/formValidation.min.css') !!}
	{!! Html::style('css/app/app.css') !!}
<!-- ////////////////////////////////////////////////////////////////////////////// -->
<!--begin::Base Scripts -->
<!-- ////////////////////////////////////////////////////////////////////////////// -->
{{ HTML::script('theme/dist/html/demo2/assets/vendors/base/vendors.bundle.js') }}
{{ HTML::script('theme/dist/html/demo2/assets/demo/demo2/base/scripts.bundle.js') }}
{{ HTML::script('theme/dist/html/demo2/assets/app/js/dashboard.js') }}
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
{{ HTML::script('plugins/daterangepicker/moment-with-locale-es.js') }}
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
<script src="http://code.jquery.com/color/jquery.color-2.1.2.min.js"></script>
</head>

<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default" style="background-color:#F2F3F8">
@php $data = Session::get('perfiles'); @endphp
@if (isset($data))
<input type="hidden" id="idUsertext" value="<?php echo $data['v_detalle'][0]->idUser ?>" >
<input type="hidden" id="idPerfiltext" value="<?php echo $data['idPerfil'] ?>" >
@endif
	<form id="formLogout" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
	<div id="divSeparacion" class="m-grid m-grid--hor m-grid--root m-page">
		@include('menu.menu_header')
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
			<!-- <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver	m-container m-container--responsive m-container--xxl m-page__container"> -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						@yield('content')
					</div>
				</div>
			<!-- </div> -->
		</div>
		@include('menu.menu_footer')
	</div>
	<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
		<i class="la la-arrow-up"></i>
	</div>
@if (isset($data))
	@if ($data['idPerfil']==3)
	<div id="divChatMin" class="divChats">
		<div class="row">
			<div id="divTituloMin" class="col-md-8">
				<strong class="tituloMin">
					Converse con nosotros,<br> 
				</strong>
				<strong class="tituloMin">
					Estamos en línea!
				</strong>
			</div>
			<div class="col-md-4">
				<a id="HrefMax" href="#" class="m-nav__link btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--pill">
					<i class="flaticon-comment"></i>
				</a>
			</div>
		</div>
	</div>
	<div id="divChat" class="divChats" style="display:none;">
		<div class="m-portlet" style="border-radius:10px 10px 0px 0px;">
			<div id="divButtonChat" class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 id="tituloMax" class="m-portlet__head-text">
							Por favor, escriba su mensaje
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<a id="HrefMin" href="#" class="m-nav__link btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--pill">
								<i class="flaticon-comment"></i>
							</a>
						</li>								
					</ul>
				</div>
			</div>
			<div class="m-portlet__body" style="background-color:#F2F3F8">
				<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
					<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
						<div id="ChatBody" class="m-messenger__messages"></div>
					</div>
				</div>
			</div>
			<div id="my-portlet__footer" class="m-portlet__foot">
				<form id="FormChat">
					<input type="hidden" name="caso" id="caso" value="1">
					<input type="hidden" name="idChat" id="idChat" value="0">
					<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
					<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
						<div class="m-messenger__form" style="margin-bottom: 15px;">
							<div class="m-messenger__form-controls">
								<textarea name="message" id="message" placeholder="Inicie el chat..." class="m-messenger__form-input" maxlength="990"></textarea>
							</div>
							<div class="m-messenger__form-tools">
								<a href="#" id="ChatSubmit" class="m-nav__link m-portlet__nav-link btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--pill">
									<i class="flaticon-paper-plane"></i>
								</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> 
	@endif
@endif
	<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
		<i class="la la-arrow-up"></i>
	</div>
	<script Language="Javascript">
		var rutaGetChat = "{{ URL::route('chat') }}"
		var rutaGetAllChat = "{{ URL::route('chatC') }}"
		var v = [];
		v['v_perfil'] = '';
		v['idUser'] = '';
	</script> 
</body>
</html>