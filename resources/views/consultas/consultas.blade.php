@extends('menu.index')
@section('content')
<div class="container col-md-12" style="background-color: white;">
	<div id="divTabla" class="divForm" style="display:none;">
		<div class="row">
			<div class="col-md-12">
				<br>
				<center><h5>Resultados de la busqueda</h5></center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10"></div>
			<div class="col-md-2">
					{{ Form::button(' Volver',
					[ 'id'=> 'volver', 'type' => 'button',
					'class' => 'btn btn-primary fa fa-share-square'])}}
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10 table-responsive">
				<table id="tablaReportes" class="display" cellspacing="0" width="100%"></table>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<div id="divForm" class="col-md-12 divForm">
		<br>
		<center><h3>Consultas</h3></center>
		<hr>
		{!! Form::open(['id'=>'FormConsultas',
		'autocomplete' => 'off']) !!}
		<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="form-group col-md-4">
				{{ Form::label('null', 'Fecha:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}
				<div class="input-group col-md-12">
					<span class="fecharango366 form-control date spanFecha" id="fecha" style="z-index:0;height:35px;color:#808080;">&nbsp;Seleccione rango de fecha...</span>
					<span class="input-group-addon btn btn-primary fa fa-calendar fecharango366" id="btnCal" type="button"></span>
					<input type="hidden" name="f_desde" id="f_desde" class="form-control">
					<input type="hidden" name="f_hasta" id="f_hasta" class="form-control">
				</div>
			</div>

			<div class="col-md-2">
				{{ Form::label('null', 'Tipo de busqueda:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}
				<select class="comboclear" name="Selectcampo" id="Selectcampo" style='width:100%;height:35px;'>
					<option value="">Seleccione...</option>
					<option value="usrNombreFull">Nombres</option>
					<option value="usrUserName">Login</option>
					<option value="des_perfil">Perfíl</option>
					<option value="creador">Creador</option>
				</select>
			</div>

			<div class="col-md-2">
				{{ Form::label('null', 'Descripción:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}

				    {!! Form::text('descripcion', '', [
                    'id'            => 'descripcion',
                    'class'         => 'form-control input',
                    'placeholder'   => '',
                    'style'         => 'width:100%;height:35px',
                    'maxlength'     => '50'])!!}
			</div>

			<div class="col-md-1">
				{{ Form::label('null', '&nbsp;',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}

				{{ Form::button(' consultar',
				[ 'id'=> 'consultar', 'type' => 'button',
				'class' => 'btn btn-primary fa fa-table'])}}
			</div>
			<div class="col-md-1"></div>

		</div>
		{!! Form::close() !!}
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('consultas') }}"
</script>
<script src="{{ asset('js/consultas/consultas.js') }}"></script>
@endsection