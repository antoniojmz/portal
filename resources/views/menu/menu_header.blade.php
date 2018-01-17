@php
	$data = Session::get('perfiles');
@endphp
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	{{ csrf_field() }}
	<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
</form>
<header class="m-grid__item m-header"  data-minimize="minimize" data-minimize-offset="200" data-minimize-mobile-offset="200" >
@if (isset($data))
<div class="m-header__top">
	<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
		<div class="m-stack m-stack--ver m-stack--desktop">
			<!-- begin::Brand -->
			<div class="m-stack__item m-brand">
				<div class="m-stack m-stack--ver m-stack--general m-stack--inline">
					<div class="m-stack__item m-stack__item--middle m-brand__logo">
						<a href="/home" class="m-brand__logo-wrapper">
							<!-- logo principal de la aplicacion -->
							<img alt="" src="{{ asset('theme/dist/html/demo2/assets/demo/demo2/media/img/logo/logo.png') }}"/>
						</a>
					</div>
					<div class="m-stack__item m-stack__item--middle m-brand__tools">
						<!-- begin::Topbar Toggler-->
						<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
							<i class="flaticon-more"></i>
						</a>
						<!--end::Topbar Toggler-->
					</div>
				</div>
			</div>
			<!-- end::Brand -->
			<!-- begin::Topbar -->
			<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
				<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-topbar__nav-wrapper">
						<ul class="m-topbar__nav m-nav m-nav--inline">
							@if ($data['idPerfil']==2)
							<li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click" data-dropdown-persistent="true">
								<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
									<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
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
							<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-topbar__userpic m--hide">
										<img src="{{ asset('theme/dist/html/demo2/assets/app/media/img/users/user4.jpg') }}" class="m--img-rounded m--marginless m--img-centered" alt=""/>
									</span>
									<span class="m-topbar__welcome">
										Hello,&nbsp;
									</span>
									<span class="m-topbar__username">
										Nick
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center" style="background: url(/theme/dist/html/demo2/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
											<div class="m-card-user m-card-user--skin-dark">
												<div class="m-card-user__pic">
													@php  
														$avatarUser = Auth::user()->usrUrlimage;
														(strlen($avatarUser) > 10) ? $avatar=$avatarUser : $avatar="img/default.png";
													@endphp
													<img src="{{ asset($avatar) }}" class="m--img-rounded m--marginless" alt=""/>
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
															<i class="m-nav__link-icon flaticon-profile-1"></i>
															<span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">
																		Mi Perfíl
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
															<i class="m-nav__link-icon flaticon-chat-1"></i>
															<span class="m-nav__link-text">
																Cambiar contraseña
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__item">
														<a href="{{ route('logout') }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
			<!-- end::Topbar -->
		</div>
	</div>
</div>
<div class="m-header__bottom">
	<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
		<div class="m-stack m-stack--ver m-stack--desktop">
			<!-- begin::Horizontal Menu -->
			<div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
				<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
					<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
						<li class="m-menu__item  m-menu__item--active"  aria-haspopup="true">
							<a  href="index.html" class="m-menu__link ">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Dashboard 2
								</span>
							</a>
						</li>
						<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
							<a  href="#" class="m-menu__link m-menu__toggle">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Actions
								</span>
								<i class="m-menu__hor-arrow la la-angle-down"></i>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
								<span class="m-menu__arrow m-menu__arrow--adjust"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item "  aria-haspopup="true">
										<a  href="inner.html" class="m-menu__link ">
											<i class="m-menu__link-icon flaticon-diagram"></i>
											<span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														Generate Reports
													</span>
													<span class="m-menu__link-badge">
														<span class="m-badge m-badge--success">
															2
														</span>
													</span>
												</span>
											</span>
										</a>
									</li>
									<li class="m-menu__item  m-menu__item--submenu"  data-menu-submenu-toggle="hover" data-redirect="true" aria-haspopup="true">
										<a  href="#" class="m-menu__link m-menu__toggle">
											<i class="m-menu__link-icon flaticon-business"></i>
											<span class="m-menu__link-text">
												Manage Orders
											</span>
											<i class="m-menu__hor-arrow la la-angle-right"></i>
											<i class="m-menu__ver-arrow la la-angle-right"></i>
										</a>
										<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
											<span class="m-menu__arrow "></span>
											<ul class="m-menu__subnav">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Latest Orders
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Pending Orders
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Processed Orders
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Delivery Reports
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Payments
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Customers
														</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="m-menu__item  m-menu__item--submenu"  data-menu-submenu-toggle="hover" data-redirect="true" aria-haspopup="true">
										<a  href="#" class="m-menu__link m-menu__toggle">
											<i class="m-menu__link-icon flaticon-chat-1"></i>
											<span class="m-menu__link-text">
												Customer Feedbacks
											</span>
											<i class="m-menu__hor-arrow la la-angle-right"></i>
											<i class="m-menu__ver-arrow la la-angle-right"></i>
										</a>
										<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
											<span class="m-menu__arrow "></span>
											<ul class="m-menu__subnav">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Customer Feedbacks
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Supplier Feedbacks
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Reviewed Feedbacks
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Resolved Feedbacks
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Feedback Reports
														</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
										<a  href="inner.html" class="m-menu__link ">
											<i class="m-menu__link-icon flaticon-users"></i>
											<span class="m-menu__link-text">
												Register Member
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
							<a  href="#" class="m-menu__link m-menu__toggle">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Reports
								</span>
								<i class="m-menu__hor-arrow la la-angle-down"></i>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px">
								<span class="m-menu__arrow m-menu__arrow--adjust"></span>
								<div class="m-menu__subnav">
									<ul class="m-menu__content">
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Finance Reports
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-map"></i>
														<span class="m-menu__link-text">
															Annual Reports
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-user"></i>
														<span class="m-menu__link-text">
															HR Reports
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-clipboard"></i>
														<span class="m-menu__link-text">
															IPO Reports
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-graphic-1"></i>
														<span class="m-menu__link-text">
															Finance Margins
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-graphic-2"></i>
														<span class="m-menu__link-text">
															Revenue Reports
														</span>
													</a>
												</li>
											</ul>
										</li>
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Project Reports
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Coca Cola CRM
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Delta Airlines Booking Site
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Malibu Accounting
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Vineseed Website Rewamp
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Zircon Mobile App
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Mercury CMS
														</span>
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu"  data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
							<a  href="#" class="m-menu__link m-menu__toggle">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Orders
								</span>
								<i class="m-menu__hor-arrow la la-angle-down"></i>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
								<span class="m-menu__arrow m-menu__arrow--adjust"></span>
								<div class="m-menu__subnav">
									<ul class="m-menu__content">
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Finance Reports
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-map"></i>
														<span class="m-menu__link-text">
															Annual Reports
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-user"></i>
														<span class="m-menu__link-text">
															HR Reports
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-clipboard"></i>
														<span class="m-menu__link-text">
															IPO Reports
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-graphic-1"></i>
														<span class="m-menu__link-text">
															Finance Margins
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-graphic-2"></i>
														<span class="m-menu__link-text">
															Revenue Reports
														</span>
													</a>
												</li>
											</ul>
										</li>
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Project Reports
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Coca Cola CRM
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Delta Airlines Booking Site
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Malibu Accounting
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Vineseed Website Rewamp
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Zircon Mobile App
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Mercury CMS
														</span>
													</a>
												</li>
											</ul>
										</li>
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													HR Reports
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Staff Directory
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Client Directory
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Salary Reports
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Staff Payslips
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Corporate Expenses
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Project Expenses
														</span>
													</a>
												</li>
											</ul>
										</li>
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Reporting Apps
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Report Adjusments
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Sources & Mediums
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Reporting Settings
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Conversions
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Report Flows
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<span class="m-menu__link-text">
															Audit & Logs
														</span>
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only"  data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
							<a  href="#" class="m-menu__link m-menu__toggle">
								<span class="m-menu__item-here"></span>
								<i class="m-menu__link-icon flaticon-more-v3"></i>
								<span class="m-menu__link-text"></span>
							</a>
							<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--pull">
								<span class="m-menu__arrow m-menu__arrow--adjust"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
										<a  href="inner.html" class="m-menu__link ">
											<i class="m-menu__link-icon flaticon-business"></i>
											<span class="m-menu__link-text">
												eCommerce
											</span>
										</a>
									</li>
									<li class="m-menu__item  m-menu__item--submenu"  data-menu-submenu-toggle="hover" data-redirect="true" aria-haspopup="true">
										<a  href="crud/datatable_v1.html" class="m-menu__link m-menu__toggle">
											<i class="m-menu__link-icon flaticon-computer"></i>
											<span class="m-menu__link-text">
												Audience
											</span>
											<i class="m-menu__hor-arrow la la-angle-right"></i>
											<i class="m-menu__ver-arrow la la-angle-right"></i>
										</a>
										<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
											<span class="m-menu__arrow "></span>
											<ul class="m-menu__subnav">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-users"></i>
														<span class="m-menu__link-text">
															Active Users
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-interface-1"></i>
														<span class="m-menu__link-text">
															User Explorer
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-lifebuoy"></i>
														<span class="m-menu__link-text">
															Users Flows
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-graphic-1"></i>
														<span class="m-menu__link-text">
															Market Segments
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-graphic"></i>
														<span class="m-menu__link-text">
															User Reports
														</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
										<a  href="inner.html" class="m-menu__link ">
											<i class="m-menu__link-icon flaticon-map"></i>
											<span class="m-menu__link-text">
												Marketing
											</span>
										</a>
									</li>
									<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
										<a  href="inner.html" class="m-menu__link ">
											<i class="m-menu__link-icon flaticon-graphic-2"></i>
											<span class="m-menu__link-title">
												<span class="m-menu__link-wrap">
													<span class="m-menu__link-text">
														Campaigns
													</span>
													<span class="m-menu__link-badge">
														<span class="m-badge m-badge--success">
															3
														</span>
													</span>
												</span>
											</span>
										</a>
									</li>
									<li class="m-menu__item  m-menu__item--submenu"  data-menu-submenu-toggle="hover" data-redirect="true" aria-haspopup="true">
										<a  href="#" class="m-menu__link m-menu__toggle">
											<i class="m-menu__link-icon flaticon-infinity"></i>
											<span class="m-menu__link-text">
												Cloud Manager
											</span>
											<i class="m-menu__hor-arrow la la-angle-right"></i>
											<i class="m-menu__ver-arrow la la-angle-right"></i>
										</a>
										<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
											<span class="m-menu__arrow "></span>
											<ul class="m-menu__subnav">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-add"></i>
														<span class="m-menu__link-title">
															<span class="m-menu__link-wrap">
																<span class="m-menu__link-text">
																	File Upload
																</span>
																<span class="m-menu__link-badge">
																	<span class="m-badge m-badge--danger">
																		3
																	</span>
																</span>
															</span>
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-signs-1"></i>
														<span class="m-menu__link-text">
															File Attributes
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-folder"></i>
														<span class="m-menu__link-text">
															Folders
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="inner.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-cogwheel-2"></i>
														<span class="m-menu__link-text">
															System Settings
														</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!-- end::Horizontal Menu -->
		</div>
	</div>
</div>
@endif
</header>
