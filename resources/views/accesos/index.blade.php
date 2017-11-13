<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<!-- begin::Head -->
<head>
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
	{!! Html::style('plugins/DataTables-1.10.10/media/css/jquery.dataTables.min.css') !!}
	{!! Html::style('plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.css') !!}
	{!! Html::style('plugins/validator/formValidation.min.css') !!}
	{!! Html::style('plugins/DataTables-1.10.10/buttons.dataTables.min.css') !!}
	{!! Html::style('css/accesos/footer_accesos.css') !!}
	<!-- ////////////////////////////////////////////////////////////////////////////// -->
	<!--begin::Base Scripts -->
	<!-- ////////////////////////////////////////////////////////////////////////////// -->
	{{ HTML::script('theme/dist/html/demo3/assets/vendors/base/vendors.bundle.js') }}
	{{ HTML::script('theme/dist/html/demo3/assets/demo/demo3/base/scripts.bundle.js') }}
	{{ HTML::script('theme/dist/html/demo3/assets/app/js/dashboard.js') }}
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
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
	<!-- begin:: Page -->
	<form id="formLogout" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<header class="m-grid__item m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
			<div class="m-container m-container--fluid m-container--full-height">
				<div class="m-stack m-stack--ver m-stack--desktop">
					<!-- BEGIN: Brand -->
					<div class="m-stack__item m-brand  m-brand--skin-dark ">
						<div class="m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-stack__item--middle m-stack__item--center m-brand__logo">
								<a href="index.html" class="m-brand__logo-wrapper">
									<img alt="" src="{{ asset('theme/dist/html/demo3/assets/demo/demo3/media/img/logo/logo.png') }}"/>
								</a>
							</div>
							<div class="m-stack__item m-stack__item--middle m-brand__tools">
								<!-- BEGIN: Responsive Aside Left Menu Toggler -->
								<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Responsive Header Menu Toggler -->
								<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Topbar Toggler -->
								<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
									<i class="flaticon-more"></i>
								</a>
								<!-- BEGIN: Topbar Toggler -->
							</div>
						</div>
					</div>
					<!-- END: Brand -->
					<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
						<!-- BEGIN: Topbar -->
						<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-topbar__nav-wrapper">
								<ul class="m-topbar__nav m-nav m-nav--inline">
									<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
										<a href="#" class="m-nav__link m-dropdown__toggle">
											<span class="m-topbar__userpic">
												@php  
												$avatarUser = Auth::user()->usrUrlimage;
												(strlen($avatarUser) > 10) ? $avatar=$avatarUser : $avatar="img/default.png";
												@endphp
												<img class="avatar" alt="avatar" src="{{ asset($avatar) }}"/>
											</span>
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__header m--align-center" 
												style="background: url(/theme/dist/html/demo3/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">

												<div class="m-card-user m-card-user--skin-dark">
													<div class="m-card-user__pic">
														<img class="avatar" alt="avatar" src="{{ asset($avatar) }}"/>
													</div>
													<div class="m-card-user__details">
														<span class="m-card-user__name m--font-weight-500">
															@php echo Auth::user()->usrNombreFull; @endphp
														</span>
														<a href="" class="m-card-user__email m--font-weight-300 m-link">
															@php echo Auth::user()->usrEmail; @endphp
														</a>
													</div>
												</div>
											</div>
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav m-nav--skin-light">
														<li class="m-nav__section m--hide">
															<span class="m-nav__section-text">
																Section
															</span>
														</li>
														<li class="m-nav__item">
															<a href="{{ route('logout') }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
																Logout
															</a>
															<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																{{ csrf_field() }}
																<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
															</form>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- END: Topbar -->
					<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
						<i class="la la-close"></i>
					</button>
					<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
						<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<span class="m-menu__link-text">
									@php
									$data = Session::get('perfiles');
									@endphp
									@if (isset($data))
									@if (strlen($data['v_detalle'][0]->usrNombreFull)>1)
									<span>
										<img width="14" height="14" alt="avatar" src="{{ asset('img/conectado.png') }}"/>
									</span>
									{{$data['v_detalle'][0]->usrNombreFull}}
									@endif
								</span>
							</li>
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<span class="m-menu__link-text">
									@if (strlen($data['desPerfil'])>1)
									{{$data['desPerfil']}}
									@endif
								</span>
							</li>
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<span class="m-menu__link-text">
									@if ($data['idPerfil']!=1)
									@if (strlen($data['v_detalle'][0]->NombreEmpresa)>1)
									{{$data['v_detalle'][0]->NombreEmpresa}}
									@endif
									@endif
									@endif
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- END: Header -->


	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<br />
	 		@yield('content')
		</div>
	</div>
	<footer class="m-grid__item m-footer2">
		<div class="m-container m-container--fluid m-container--full-height m-page__container">
			<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
				<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
					<span class="m-footer__copyright">
						2017 &copy; Metronic theme by
						<a href="#" class="m-link">
							Keenthemes
						</a>
					</span>
				</div>
				<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
					<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
						<li class="m-nav__item">
							<a href="#" class="m-nav__link">
								<span class="m-nav__link-text">
									About
								</span>
							</a>
						</li>
						<li class="m-nav__item">
							<a href="#"  class="m-nav__link">
								<span class="m-nav__link-text">
									Privacy
								</span>
							</a>
						</li>
						<li class="m-nav__item">
							<a href="#" class="m-nav__link">
								<span class="m-nav__link-text">
									T&C
								</span>
							</a>
						</li>
						<li class="m-nav__item">
							<a href="#" class="m-nav__link">
								<span class="m-nav__link-text">
									Purchase
								</span>
							</a>
						</li>
						<li class="m-nav__item m-nav__item">
							<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
								<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
</div>
<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
	<i class="la la-arrow-up"></i>
</div>
</body>

</html>