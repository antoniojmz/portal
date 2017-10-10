@extends('menu.index')
@section('content')
<div class="container col-md-12">
	<div id="divTabla" style="display:none;">
		<div class="row">
			<div class="col-md-12">
				<center><span id="titulo" class="spanTitulo"></span></center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12 col-md-offset-11">
					{{ Form::button(' Volver',
					[ 'id'=> 'volver', 'type' => 'button',
					'class' => 'btn btn-primary fa fa-share-square'])}}
				</div>
				<br />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table id="tablaReportes" class="display" cellspacing="0" width="100%"></table>
			</div>
		</div>
	</div>
	<div id="divForm" class="col-md-12">
		<br>
		<center><h3>Consultas</h3></center>
		<hr>
		{!! Form::open(['id'=>'FormConsultas',
		'autocomplete' => 'off']) !!}
		<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
		<div class="row">
			<div class="col-md-1">
				{{ Form::label('null', 'Fecha:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}
			</div>
			<div class="form-group col-md-4">
				<div class="input-group col-md-12">
					<span class="fecharango366 form-control date spanFecha" id="fecha" style="z-index:0;height:35px;color:#808080;">&nbsp;Seleccione rango de fecha...</span>
					<span class="input-group-addon btn btn-primary fa fa-calendar fecharango366" id="btnCal" type="button"></span>
					<input type="hidden" name="f_desde" id="f_desde" class="form-control">
					<input type="hidden" name="f_hasta" id="f_hasta" class="form-control">
				</div>
			</div>
			<div class="col-md-1">
				{{ Form::label('null', 'Consulta:',array('style' => 'text-align:center;line-height:300%','class' => 'label-input','id' => '','align' => 'center'))}}
			</div>
			<div class="col-md-4">
				<select class="comboclear" name="Selectconsulta2" id="Selectconsulta2" style='width:100%;height:35px;'>
					<option value=""></option>
				</select>
			</div>
			<div class="col-md-2">
				{{ Form::button(' consultar',
				[ 'id'=> 'consultar', 'type' => 'button',
				'class' => 'btn btn-primary fa fa-table'])}}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
<script src="{{ asset('js/consultas/consultas.js') }}"></script>
@endsection