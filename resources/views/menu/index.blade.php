<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
	<head>
		<title>{{ config('app.name', 'Laravel') }}</title>
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
			var rutaGetChat = "{{ URL::route('chat') }}"
			var rutaGetAllChat = "{{ URL::route('chatC') }}"
			var rutaStatusChat = "{{ URL::route('statusChat') }}"
			var RutaSalir = "{{ URL::route('logout') }}";
			var v = [];
			v['v_perfil'] = '';
			v['idUser'] = '';
		</script>
		<!-- begin::Base Styles -->
		{!! Html::style('theme/dist/html/demo2/assets/vendors/base/vendors.bundle.css') !!}
		{!! Html::style('theme/dist/html/demo2/assets/demo/demo2/base/style.bundle.css') !!}
		{!! Html::style('plugins/DataTables-1.10.10/media/css/jquery.dataTables.min.css') !!}
		{!! Html::style('css/core/core.css') !!}
		<!--begin::Base Scripts -->
		{{ HTML::script('js/core/core.js') }}
		{{ HTML::script('js/index/index.js') }}
		<!-- Scritp Plugins -->

		<style>
	        .modal {
	            display:    none;
	            position:   fixed;
	            z-index:    10000;
	            top:        0;
	            left:       0;
	            height:     100%;
	            width:      100%;
	            background: rgba( 255, 255, 255, .8 ) url('icon/ajax-loader.gif') 50% 50%  no-repeat;
	        }

	        body.loading {
	            overflow: hidden;   
	        }

	        body.loading .modal {
	            display: block;
	        }
	    </style>
	</head>
	<body onLoad="if ('Navigator' == navigator.appName)document.forms[0].reset();" class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default" style="background-color:#F2F3F8">
	@if(!empty($_GET['logout'])){
		@if (isset($_GET['logout']))
    		<script>
        		Salir();
    		</script>
		@endif
	@endif
	@php $data = Session::get('perfiles'); @endphp
	@if (isset($data))
	<input type="hidden" id="idUsertext" value="<?php echo $data['v_detalle'][0]->idUser ?>" >
	<input type="hidden" id="idPerfiltext" value="<?php echo $data['idPerfil'] ?>" >
	@endif
		<form id="formIdChat" method="POST" action='{!! URL::route("buzon") !!}' style="display: none;">
			{{ csrf_field() }}
			<input type="hidden" id="idSubmitchat" name="idSubmitchat">
		</form>
		<form id="formLogout" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>
		<div id="divSeparacion" class="m-grid m-grid--hor m-grid--root m-page">
			@include('menu.menu_header')
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
					<div class="m-grid__item m-grid__item--fluid m-wrapper">
						<div class="m-content" style="padding-left: 10px; padding-right: 10px; padding-top:10px;">
							@yield('content')
						</div>
					</div>
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
				<div id="styleScroll" class="m-portlet__body scrollBar" style="background-color:#F2F3F8">
					<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
						<div id="ChatBody" class="m-messenger__messages"></div>
					</div>
			      	<div class="forceOverflow"></div>
				</div>
				<div id="my-portlet__footer" class="m-portlet__foot">
					<form id="FormChat">
						{{ csrf_field() }}
						<input type="hidden" name="caso" id="caso" value="1">
						<input type="hidden" name="idChat" id="idChat" value="0">
						<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
						<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
							<div class="m-messenger__form" style="margin-bottom: 15px;">
								<div class="m-messenger__form-controls">
									<textarea name="message" id="message" placeholder="Inicie el chat..." class="m-messenger__form-input" maxlength="990" autofocus></textarea>
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
	</div>
</body>

<div class="modal" style="text-align: center; vertical-align: middle;">
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Cargando información del Proveedor...
</div>

</html>