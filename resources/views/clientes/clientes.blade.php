@extends('menu.index')
@section('content')
<div class="container col-md-10" style="background-color: white;">
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
						<table id="tablaClientes" class="display" cellspacing="0" width="100%"></table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="divForm" style="display:none;">
		<div class="m-portlet m-portlet--tabs">
			<div class="m-portlet__head">
				<div class="m-portlet__head-tools">
					<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_builder_page" role="tab" aria-expanded="true">
								Información Clientes
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link " data-toggle="tab" href="#m_builder_header" role="tab" aria-expanded="false">
								Listado DTE
							</a>
						</li>
						@if ($idPerfil!=3)
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_builder_left_aside" role="tab" aria-expanded="false">
									Listado Proveedores
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
				<div class="m-portlet__body">
					<div class="tab-content">
						<!-- tab de cabecera -->
						<div class="tab-pane active" id="m_builder_page" aria-expanded="true">

							<div class="col-md-12">
								<center>
									<span class="spanSubTitulo">Datos Cliente</span>
								</center>
								<hr>
							</div>

							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">Codigo Sociedad SAP:</label>
								<div class="col-lg-10 col-xl-10">
									<span id="CodigoSociedadSAP" class="form-control span"></span>
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">Nombre Cliente:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="NombreCliente" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">RUT Cliente:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="RutCliente" class="form-control span"></span>
								</div>
							</div>
    
							<div class="form-group m-form__group row">
								<label class="col-lg-2 col-form-label">Razon Social:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="RazonSocial" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">Nombre Fantasia:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="NombreFantasiaCliente" class="form-control span"></span>
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
									<span id="PersonaContactoCliente" class="form-control span"></span>
								</div>
								<label class="col-lg-2 col-form-label">Teléfono Contacto:</label>
								<div class="col-lg-4 col-xl-4">
									<span id="TelefonoContactoCliente" class="form-control span"></span>
								</div>
							</div>
										
						</div>

						<!-- tab de detalle DTE -->
						<div class="tab-pane" id="m_builder_header" aria-expanded="false">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<div class="table-responsive">
										<table id="tablaDTE" class="display" cellspacing="0" width="100%"></table>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>
						@if ($idPerfil!=3)
							<!-- tab de Referencias -->
							<div class="tab-pane" id="m_builder_left_aside" aria-expanded="false">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<div class="table-responsive">
											<table id="tablaProveedores" class="display" cellspacing="0" width="100%"></table>
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
											<table id="tablaUsuarios" class="display" cellspacing="0" width="100%"></table>
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
	var ruta = "{{ URL::route('clientes') }}"
	var rutaD = "{{ URL::route('detallesCliente') }}" 
	var d = [];
	d['v_clientes'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_clientes) }}'));
	d['v_busq_cliente'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_busq_cliente) }}'));
</script>
<script src="{{ asset('js/clientes/clientes.js') }}"></script>
@endsection



