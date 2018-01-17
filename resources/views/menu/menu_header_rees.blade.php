<header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
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
				<!-- BEGIN: Horizontal Menu -->
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
				<!-- END: Horizontal Menu -->
				<!-- BEGIN: Topbar -->
				<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-topbar__nav-wrapper">
						<ul class="m-topbar__nav m-nav m-nav--inline">
							@if ($data['idPerfil']==2)
							<li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click" data-dropdown-persistent="true">
								<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
									<div id="countChat"></div>
									<span class="m-nav__link-icon">
										<i class="flaticon-alert-2"></i>
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center" style="background: url(theme/dist/html/demo3/assets/app/media/img/misc/notification_bg.jpg); background-size: cover;">
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
															<div id="divBuzon" class="m-list-timeline__items">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							@endif

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
														<a href="{{ route('perfil') }}" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-profile"></i>
															<span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">
																		Mi Perfíl
																	</span>
																	<span class="m-nav__link-badge">
																		<span class="m-badge m-badge--success">
																			2
																		</span>
																	</span>
																</span>
															</span>
														</a>
													</li>
													@php
														$nroPerfiles = Session::get('nroPerfiles');
													@endphp
													@if (isset($nroPerfiles))
														@if ($nroPerfiles>1)
															<li class="m-nav__item">
																<a href="{{ route('accesos') }}" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-infinity"></i>
																	<span class="m-nav__link-text">
																		Cambio de acceso
																	</span>
																</a>
															</li>
														@endif
													@endif
													<li class="m-nav__item">
														<a href="profile.html" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-chat-1"></i>
															<span class="m-nav__link-text">
																Messages
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="{{ route('password') }}" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-refresh"></i>
															<span class="m-nav__link-text">
																Cambiar contraseña
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__item">
														<a href="profile.html" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-info"></i>
															<span class="m-nav__link-text">
																FAQ
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="profile.html" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-lifebuoy"></i>
															<span class="m-nav__link-text">
																Support
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
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
			</div>
		</div>
	</div>
</header>
<!-- END: Header -->