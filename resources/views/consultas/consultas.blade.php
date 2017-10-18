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
			<br />
			{!! Form::open(['id'=>'FormConsultas',
			'autocomplete' => 'off']) !!}
			<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
			<div class="row">
				<div class="form-group col-md-6">
					{{ Form::label('null', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Emisión:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}
					<div class="input-group col-md-12">
						<span class="fecharango366 form-control date spanFecha" id="fecha" style="z-index:0;height:35px;color:#808080;">&nbsp;Seleccione rango de fecha...</span>
						<span class="input-group-addon btn btn-primary flaticon-event-calendar-symbol fecharango366" id="btnCal" type="button"></span>
						<input type="hidden" name="f_desde" id="f_desde" class="form-control">
						<input type="hidden" name="f_hasta" id="f_hasta" class="form-control">
					</div>
				</div>

				<div class="col-md-6">
					{{ Form::label('null', 'Tipo DTE:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}
					<select class="comboclear form-control m-select2" name="SelectDTE" id="SelectDTE" style='width:100%;height:35px;'>
						<option value="">Seleccione...</option>
						<option value="34">34</option>
					</select>						
				</div>
			</div>

			<div class="row">
				<div class="col-md-5">
					{{ Form::label('null', 'Tipo de busqueda:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}
					<select class="comboclear form-control m-select2" name="Selectcampo" id="Selectcampo" style='width:100%;height:35px;'>
						<option value="">Seleccione...</option>
						<option value="NombreCliente">Nombre de cliente</option>
						<option value="NombreProveedor">Nombre de proveedor</option>
						<option value="FolioReferencia">Folio de referencia</option>
						<option value="NombreProducto">Nombre de producto</option>
						<option value="CodigoProducto">Código de producto</option>
					</select>						
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
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table id="tablaReportes" class="display" cellspacing="0" width="100%"></table>
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
								Cabecera
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link " data-toggle="tab" href="#m_builder_header" role="tab" aria-expanded="false">
								Detalle DTE
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_builder_left_aside" role="tab" aria-expanded="false">
								Referencias DTE
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_builder_right_aside" role="tab" aria-expanded="false">
								Estados de pago
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--begin::Form-->

			<form class="m-form m-form--label-align-right m-form--fit">
				<div class="m-portlet__body">
					<div class="tab-content">
						
						<!-- tab de cabecera -->
						<div class="tab-pane active" id="m_builder_page" aria-expanded="true">
							<div class="form-group m-form__group row">
								<label class="col-lg-4 col-form-label">Layout Type:</label>
								<div class="col-lg-8 col-xl-4">
									<select class="form-control" name="builder[layout][self][layout]">
										<option value="fluid" selected="">Fluid</option>
										<option value="boxed">Boxed</option>
									</select>
									<span class="m-form__help">Select page layout type</span>
								</div>
							</div>
						</div>

						<!-- tab de detalle DTE -->
						<div class="tab-pane" id="m_builder_header" aria-expanded="false">
							<div class="form-group m-form__group row">
								<label class="col-lg-4 col-form-label">Display Header Menu:</label>
								<div class="col-lg-8 col-xl-4">
									<input type="hidden" name="builder[layout][menu][header_desktop][display]" value="false">
									<span class="m-switch m-switch--icon-check">
										<label>
											<input type="checkbox" name="builder[layout][menu][header_desktop][display]" value="true" checked="">
									        <span></span>
									    </label>
									</span>
									<div class="m-form__help">Display header menu</div>
								</div>
							</div>
						</div>

						<!-- tab de REferneciaas -->
						<div class="tab-pane" id="m_builder_left_aside" aria-expanded="false">
							<div class="form-group m-form__group row">
								<label class="col-lg-4 col-form-label">Dropdown Submenu Arrow:</label>
								<div class="col-lg-8 col-xl-4">
									<span class="m-switch m-switch--icon-check">
										<input type="hidden" name="builder[layout][menu][aside][submenu][dropdown][arrow]" value="false">
									    <label>	
											<input type="checkbox" name="builder[layout][menu][aside][submenu][dropdown][arrow]" value="true" checked="">
									        <span></span>
									    </label>
									</span>
									<div class="m-form__help">Enable dropdown submenu arrow</div>
								</div>
							</div>
						</div>

						<!-- tab de Estados -->
						<div class="tab-pane" id="m_builder_right_aside" aria-expanded="false">
							<div class="form-group m-form__group row">
								<label class="col-lg-4 col-form-label">Display Right Aside:</label>
								<div class="col-lg-8 col-xl-4">
									<span class="m-switch m-switch--icon-check">
										<input type="hidden" name="builder[layout][aside][right][display]" value="false">
									    <label>
											<input type="checkbox" name="builder[layout][aside][right][display]" value="true">
									        <span></span>
									    </label>
									</span>
									<div class="m-form__help">Display right aside</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions">
						<div class="row">
							<div class="col-lg-12">
						        <center>
							        <button name="volver" id="volver" class="btn m-btn--pill btn-outline-primary" type="button">
										<span>
											<i class="la la-arrow-circle-left"></i>
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
	var ruta = "{{ URL::route('consultas') }}" 
	var d = [];
	d['v_dtes'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_dtes) }}'));
</script>
<script src="{{ asset('js/consultas/consultas.js') }}"></script>
@endsection