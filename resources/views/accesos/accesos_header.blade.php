@php $data = Session::get('perfiles'); @endphp
<header class="m-grid__item m-header"  data-minimize="minimize" data-minimize-offset="200" data-minimize-mobile-offset="200" >
	<div class="m-header__top">
		<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
			<div class="m-stack m-stack--ver m-stack--desktop">
				<div class="m-stack__item m-brand">
					<div class="m-stack m-stack--ver m-stack--general m-stack--inline">
						<div class="m-stack__item m-stack__item--middle m-brand__logo">
							<a href='{!! URL::route("accesos") !!}' class="m-brand__logo-wrapper m-nav__link">
								<!-- <img alt="" src="{{ asset('theme/dist/html/demo2/assets/demo/demo2/media/img/logo/logo.png') }}"/>-->
								<img alt="" src="{{ asset('img/logo_globas.png') }}" style="width: 110px; margin-left: -20px">
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
						@if (isset($data))
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
						@endif
					</div>
					<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
						<div class="m-stack__item m-topbar__nav-wrapper">
							<ul class="m-topbar__nav m-nav m-nav--inline">
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
</header>