@php
	$data = Session::get('perfiles');
@endphp
@if (isset($data))
<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn">
	<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown " data-menu-vertical="true" data-menu-dropdown="true" data-menu-scrollable="true" data-menu-dropdown-timeout="500">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__item  m-menu__item--active" aria-haspopup="true" >
				<a  href='/home' class="m-menu__link ">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-dashboard"></i>
					<span class="m-menu__link-text">
						Panel de Control
					</span>
				</a>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="#" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-users"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Clientes
							</span>
						</span>
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true" >
							<a href='{!! URL::route("clientes") !!}' class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listado de clientes
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="#" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-truck"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Proveedores
							</span>
						</span>
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						@if ($data['idPerfil']==2)
						<li class="m-menu__item " aria-haspopup="true" >
							<a  href='{!! URL::route("Reg_proveedores") !!}' class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Registro de proveedores
								</span>
							</a>
						</li>
						@endif
						<li class="m-menu__item " aria-haspopup="true" >
							<a  href='{!! URL::route("proveedores") !!}' class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listado de proveedores
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			@if ($data['idPerfil']==2 || $data['idPerfil']==3)
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="#" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-search"></i>
					<span class="m-menu__link-text">
						DTEs
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item" aria-haspopup="true" >
							<a  href='{!! URL::route("consultas") !!}' class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Consultar DTE
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="#" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-search"></i>
					<span class="m-menu__link-text">
						OC
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item" aria-haspopup="true" >
							<a  href='{!! URL::route("oc") !!}' class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Consultar OC
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			@endif
			@if ($data['idPerfil']==1 || $data['idPerfil']==2)
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="#" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-cogwheel-1"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Administración
							</span>
						</span>
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true" >
							<a  href='{!! URL::route("usuarios") !!}' class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listado de usuarios
								</span>
							</a>
						</li>
						@if ($data['idPerfil']==2)
						<li class="m-menu__item " aria-haspopup="true" >
							<a  href='{!! URL::route("publicaciones") !!}' class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listado de publicaciones
								</span>
							</a>
						</li>
						@endif
					</ul>
				</div>
			</li>
			@endif
		</ul>
	</div>
</div>
@endif