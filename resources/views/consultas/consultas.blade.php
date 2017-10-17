@extends('menu.index')
@section('content')
<div class="container col-md-10" style="background-color: white;">
	<div class="row">
		<div class="col-md-12">
			<br>
			<center><span id="spanTitulo"></span></center>
			<hr>
		</div>
	</div>
	<div id="divTabla" class="divForm" style="display:none;">
		<div class="row">
			<div class="col-md-12">
				{{ Form::button(' Volver',
				[ 'id'=> 'volver', 'type' => 'button',
				'style' => 'float:right;',
				'class' => 'btn m-btn--pill btn-outline-primary flaticon-cancel'])}}


			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-md-12 table-responsive">
				<table id="tablaReportes" class="display" cellspacing="0" width="100%"></table>
			</div>
		</div>
	</div>
	<div id="divForm" class="col-md-12 divForm">
		<br />
		{!! Form::open(['id'=>'FormConsultas',
		'autocomplete' => 'off']) !!}
		<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
		<div class="row">
			<div class="form-group col-md-4">
				{{ Form::label('null', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Estado:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}
				<div class="input-group col-md-12">
					<span class="fecharango366 form-control date spanFecha" id="fecha" style="z-index:0;height:35px;color:#808080;">&nbsp;Seleccione rango de fecha...</span>
					<span class="input-group-addon btn btn-primary flaticon-event-calendar-symbol fecharango366" id="btnCal" type="button"></span>
					<input type="hidden" name="f_desde" id="f_desde" class="form-control">
					<input type="hidden" name="f_hasta" id="f_hasta" class="form-control">
				</div>
			</div>

			<div class="col-md-3">
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

			<div class="col-md-3">
				{{ Form::label('null', 'Descripción:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}

				    {!! Form::text('descripcion', '', [
                    'id'            => 'descripcion',
                    'class'         => 'form-control input',
                    'placeholder'   => '',
                    'style'         => 'width:100%;height:35px',
                    'maxlength'     => '50'])!!}
			</div>

			<div class="col-md-2">
				{{ Form::label('null', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}

				{{ Form::button(' consultar',
				[ 'id'=> 'consultar', 'type' => 'button',
				'class' => 'btn m-btn--pill btn-primary flaticon-interface flaticon-search'])}}
			</div>

		</div>
		{!! Form::close() !!}
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('consultas') }}"
</script>
<script src="{{ asset('js/consultas/consultas.js') }}"></script>
@endsection