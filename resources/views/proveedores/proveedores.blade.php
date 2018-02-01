@extends('menu.index')
@section('content')
<div class="col-md-12 m-portlet">
	<div class="divForm">
		<div class="row">
			<div class="col-md-12">
				<br>
				<center><span id="spanTitulo"></span></center>
				<hr>
			</div>
		</div>
		<div id="divForm" class="col-md-12 divForm">
			{!! Form::open(['id'=>'FormProveedores',
			'autocomplete' => 'off']) !!}
			<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
			<div class="row">
				<div class="col-md-5">
					<br>
					{!! Field::select('Selectcampo', null, null,
					[ 'label' => 'Tipo de busqueda:', 
					'style' => 'width:100%;height:35px;',
					'placeholder' => 'Seleccione...',
					'class' => 'comboclear form-control m-select2']) !!}						
				</div>

				<div class="col-md-5">
					{{ Form::label('null', 'Descripción:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}

					    {!! Form::text('descripcion', '', [
	                    'id'            => 'descripcion',
	                    'class'         => 'form-control input',
	                    'placeholder'   => '',
	                    'style'         => 'width:100%;height:35px',
	                    'maxlength'     => '50'])!!}
				</div>
				 
				
				<div class="col-md-2">
					<button style="float:right;margin: 45px 0px 0px 0px;" name="consultar" id="consultar" class="btn m-btn--pill btn-primary" type="button">
						<span>
							<i class="la la-search"></i>
							<span>Consultar</span>
						</span>
			        </button>
				</div>

			</div>
			{!! Form::close() !!}
		</div>
		<div id="divTabla">
			<br /><br />
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table id="tablaProveedores" class="display table" cellspacing="0" width="100%"></table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="divForm" style="display:none;">
		<div class="m-portlet--tabs">
			<div class="m-portlet__head" style="border-bottom:none;">
				<div class="m-portlet__head-tools">
					<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
						<li class="nav-item m-tabs__item">
							<a id="ahref1" class="nav-link m-tabs__link active" data-toggle="tab" href="#m_builder_page" role="tab" aria-expanded="true">
								Información Proveedor
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link " data-toggle="tab" href="#m_builder_header" role="tab" aria-expanded="false">
								Listado DTE
							</a>
						</li>						
						@if ($idPerfil!=2)
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_builder_left_aside" role="tab" aria-expanded="false">
									Listado Clientes
								</a>
							</li>
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_builder_right_aside" role="tab" aria-expanded="false">
									Listado Usuarios
								</a>
							</li>
						@endif
					</ul>
				</div>
			</div>
			<!--begin::Form-->

			<form class="m-form m-form--label-align-right m-form--fit">
				<div class="m-portlet__body" style="padding-top: 10px;">
					<div class="tab-content">
						<!-- tab de cabecera -->
						<div class="tab-pane active" id="m_builder_page" aria-expanded="true">
							<div class="col-md-12">
								<center>
									<span class="spanSubTitulo">Datos Proveedor</span>
								</center>
								<hr>
							</div>
							
							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">ID Proveedor SAP:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="IdProveedorSAP" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">RUT Proveedor:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="RutProveedor" class="form-control span"></span>
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">Nombre Proveedor:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="NombreProveedor" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">Razon Social:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="RazonSocialProveedor" class="form-control span"></span>
								</div>
							</div>
    
							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">Nombre Fantasia:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="NombreFantasia" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">Giro:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="Giro" class="form-control span"></span>
								</div>
							</div>

							<div class="col-md-12">
								<br>
								<center>
									<span class="spanSubTitulo">Datos de Contacto</span>
								</center>
								<hr>
							</div>

							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">Persona Contacto:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="PersonaContacto" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">Teléfono Contacto:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="TelefonoContacto" class="form-control span"></span>
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">Teléfono Proveedor:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="TelefonoProveedor" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">Correo Electrónico:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="CorreoElectronico" class="form-control span"></span>
								</div>
							</div>

							<div class="col-md-12">
								<br>
								<center>
									<span class="spanSubTitulo">Datos Bancarios</span>
								</center>
								<hr>
							</div>

							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">Entidad Bancaria:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="banco" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">Cuenta Bancaría:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="cuenta" class="form-control span"></span>
								</div>
							</div>							
    
							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">RUT Titular:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="RutTitular" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">Sucursal:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="sucursal" class="form-control span"></span>
								</div>
							</div>
										
						</div>

						<!-- tab de detalle DTE -->
						<div class="tab-pane" id="m_builder_header" aria-expanded="false">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table id="tablaDTE" class="display table compact" cellspacing="0" width="100%"></table>
									</div>
								</div>
							</div>
						</div>
						@if ($idPerfil!=2)
							<!-- tab de Referencias -->
							<div class="tab-pane" id="m_builder_left_aside" aria-expanded="false">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<div class="table-responsive">
											<table id="tablaClientes" class="display table" cellspacing="0" width="100%"></table>
										</div>
									</div>
									<div class="col-md-1"></div>
								</div>
							</div>

							<!-- tab de Estados -->
							<div class="tab-pane" id="m_builder_right_aside" aria-expanded="false">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<div class="table-responsive">
											<table id="tablaUsuarios" class="display table compact" cellspacing="0" width="100%"></table>
										</div>
									</div>
									<div class="col-md-1"></div>
								</div>
							</div>
						@endif
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions">
						<div class="row">
							<div class="col-lg-12">
						        <center>
							        <button name="volver" id="volver" class="btn m-btn--pill btn-outline-primary" type="button">
										<span>
											<i class="la la-arrow-left"></i>
											<span>Volver</span>
										</span>
							        </button>
						        </center>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('proveedores') }}"
	var rutaD = "{{ URL::route('detallesProveedor') }}" 
	var d = [];
	d['v_proveedores'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_proveedores) }}'));
	d['v_busq_proveedor'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_busq_proveedor) }}'));
</script>
<script src="{{ asset('js/proveedores/proveedores.js') }}"></script>
@endsection



