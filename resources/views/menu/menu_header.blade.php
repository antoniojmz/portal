@php
$data = Session::get('perfiles');
$nroPerfiles = Session::get('nroPerfiles');
@endphp
<header class="m-grid__item m-header"  data-minimize="minimize" data-minimize-offset="200" data-minimize-mobile-offset="200" >
	@if (isset($data))
	<div class="m-header__top">
		<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
			<div class="m-stack m-stack--ver m-stack--desktop">
				<div class="m-stack__item m-brand">
					<div class="m-stack m-stack--ver m-stack--general m-stack--inline">
						<div class="m-stack__item m-stack__item--middle m-brand__logo">
							<a href="index.html" class="m-brand__logo-wrapper">
								<img alt="" src="{{ asset('theme/dist/html/demo2/assets/demo/demo2/media/img/logo/logo.png') }}"/>
							</a>
						</div>
						<div class="m-stack__item m-stack__item--middle m-brand__tools">
							<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
								<span></span>
							</a>
							<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
								<i class="flaticon-more"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
					<div class="row m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark " id="divInfoUsuario">
						<ul class="m-menu__nav  m-menu__nav--submenu-arrow">
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<span class="m-menu__link-text">
									@if (strlen($data['v_detalle'][0]->usrNombreFull)>1)
									{{$data['v_detalle'][0]->usrNombreFull}}
									@endif
								</span>
							</li>
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel">
								<span class="m-menu__link-text">
									@if (strlen($data['desPerfil'])>1)
									{{$data['desPerfil']}}
									@endif
								</span>
							</li>
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel">
								<span class="m-menu__link-text">
									@if ($data['idPerfil']!=1)
									@if (strlen($data['v_detalle'][0]->NombreEmpresa)>1)
									{{$data['v_detalle'][0]->NombreEmpresa}}
									@endif
									@endif
								</span>
							</li>
						</ul>
					</div>
					<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
						<div class="m-stack__item m-topbar__nav-wrapper">
							<ul class="m-topbar__nav m-nav m-nav--inline">
								@if ($data['idPerfil']==2)
								<li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click" data-dropdown-persistent="true">
									<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
										<div id="notificacionPri"></div>
										<span class="m-nav__link-icon">
											<span class="m-nav__link-icon-wrapper">
												<i class="flaticon-music-2"></i>
											</span>
										</span>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__header m--align-center" style="background: url(/theme/dist/html/demo3/assets/app/media/img/misc/notification_bg.jpg); background-size: cover;">
												<span class="m-dropdown__header-title">
													Notificaciones
												</span>
												<span class="m-dropdown__header-subtitle">
													Chat con Proveedores
												</span>
											</div>
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<div class="tab-content">
														<center>
															<span style="float:left;" class="m-list-timeline__text">
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																<b>Usuario</b>
															</span>
															<span style="float:center;" class="m-list-timeline__text">
																<b>Operador</b>
															</span>
															<span style="float:right;" class="m-list-timeline__time">
																<b>Tiempo</b>
															</span>
														</center>
														<div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
															<div class="m-list-timeline m-list-timeline--skin-light">
																<div id="divBuzon" class="m-list-timeline__items"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								@endif
								<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
									<a href="#" class="m-nav__link m-dropdown__toggle">
										<span class="m-topbar__userpic">
											@php  
											$avatarUser = Auth::user()->usrUrlimage;
											(strlen($avatarUser) > 10) ? $avatar=$avatarUser : $avatar="img/default.png";
											@endphp
											<img src="{{ asset($avatar) }}" class="m--img-rounded m--marginless m--img-centered avatar" alt=""/>
										</span>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__header m--align-center" style="background: url(/theme/dist/html/demo2/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
												<div class="m-card-user m-card-user--skin-dark">
													<div class="m-card-user__pic">
														<img src="{{ asset($avatar) }}" class="m--img-rounded m--marginless avatar" alt=""/>
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
														<li class="m-nav__item">
															<a href="{{ route('perfil') }}" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-user "></i>
																<span class="m-nav__link-title">
																	<span class="m-nav__link-wrap">
																		<span class="m-nav__link-text">
																			Mi Perfíl
																		</span>
																	</span>
																</span>
															</a>
														</li>
														@if (isset($nroPerfiles))
														@if ($nroPerfiles>1)
														<li class="m-nav__item">
															<a href="{{ route('accesos') }}" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Cambio de acceso
																</span>
															</a>
														</li>
														@endif
														@endif
														<li class="m-nav__item">
															<a href="{{ route('password') }}" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-lock"></i>
																<span class="m-nav__link-text">
																	Cambiar contraseña
																</span>
															</a>
														</li>
														<li class="m-nav__separator m-nav__separator--fit"></li>
														<li class="m-nav__item">
															<a id="btn-logout" href="#" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
																Logout
															</a>
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
				</div>
			</div>
		</div>
	</div>
	<div class="m-header__bottom">
		<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
			<div class="m-stack m-stack--ver m-stack--desktop">
				<div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
					<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
						<i class="la la-close"></i>
					</button>
					<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
						<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
							<li id="LiHome" class="m-menu__item"  aria-haspopup="true">
								<a  href='{!! URL::route("home") !!}' class="m-menu__link ">
									<!-- <span class="m-menu__item-here"></span> -->
									<span class="m-menu__link-text">
										Home
									</span>
								</a>
							</li>
							<li id="LiDashboard" class="m-menu__item"  aria-haspopup="true">
								<a  href='{!! URL::route("dashboard") !!}' class="m-menu__link ">
									<!-- <span class="m-menu__item-here"></span> -->
									<span class="m-menu__link-text">
										Dashboard
									</span>
								</a>
							</li>
							@if ($data['idPerfil']==2)
							<li id="LiChatP" class="m-menu__item m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<!-- <span class="m-menu__item-here"></span> -->
									<span class="m-menu__link-text">
										Chat Proveedores
									</span>
									<i class="m-menu__hor-arrow la la-angle-down"></i>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
									<span class="m-menu__arrow m-menu__arrow--adjust"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("buzon") !!}' class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-chat-1"></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Buzon de Mensajes
														</span>
														<span id="notificacionSec" class="m-menu__link-badge"></span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							@endif
							<li id="LiClientes" class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<!-- <span class="m-menu__item-here"></span> -->
									<span class="m-menu__link-text">
										Clientes
									</span>
									<i class="m-menu__hor-arrow la la-angle-down"></i>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
									<span class="m-menu__arrow m-menu__arrow--adjust"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("clientes") !!}' class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-users"></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Listado de clientes
														</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							@if ($data['idPerfil']==1 || $data['idPerfil']==2)
							<li id="LiProveedores" class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<!-- <span class="m-menu__item-here"></span> -->
									<span class="m-menu__link-text">
										Proveedores
									</span>
									<i class="m-menu__hor-arrow la la-angle-down"></i>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
									<span class="m-menu__arrow m-menu__arrow--adjust"></span>
									<ul class="m-menu__subnav">
										@if ($data['idPerfil']==2)
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("Reg_proveedores") !!}' class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-user-add "></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Registro de proveedores
														</span>
													</span>
												</span>
											</a>
										</li>
										@endif
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("proveedores") !!}' class="m-menu__link">
												<i class="m-menu__link-icon flaticon-truck"></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Listado de proveedores
														</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							@endif
							@if ($data['idPerfil']==2 || $data['idPerfil']==3)
							<li id="LiDtes" class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<!-- <span class="m-menu__item-here"></span> -->
									<span class="m-menu__link-text">
										DTEs
									</span>
									<i class="m-menu__hor-arrow la la-angle-down"></i>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
									<span class="m-menu__arrow m-menu__arrow--adjust"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("consultas") !!}' class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-web"></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Listado de DTEs
														</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li id="LiOc" class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<!-- <span class="m-menu__item-here"></span> -->
									<span class="m-menu__link-text">
										OC
									</span>
									<i class="m-menu__hor-arrow la la-angle-down"></i>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
									<span class="m-menu__arrow m-menu__arrow--adjust"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("oc") !!}' class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-tabs"></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Listado de OC
														</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							@endif
							<li id="LiAdministracion" class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<!-- <span class="m-menu__item-here"></span> -->
									<span class="m-menu__link-text">
										Administración
									</span>
									<i class="m-menu__hor-arrow la la-angle-down"></i>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
									<span class="m-menu__arrow m-menu__arrow--adjust"></span>
									<ul class="m-menu__subnav">
										@if ($data['idPerfil']==1 || $data['idPerfil']==2)
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("usuarios") !!}' class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-user-settings"></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Listado de Usuarios
														</span>
													</span>
												</span>
											</a>
										</li>
										@endif
										@if ($data['idPerfil']==2)
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("publicaciones") !!}' class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-notes"></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Listado de Públicaciones
														</span>
													</span>
												</span>
											</a>
										</li>
										@endif
										@if ($data['idPerfil']==3)
										<li class="m-menu__item"  aria-haspopup="true">
											<a  href='{!! URL::route("Reg_proveedores") !!}' class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-user-settings"></i>
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Registro de proveedores
														</span>
													</span>
												</span>
											</a>
										</li>
										@endif
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
</header>