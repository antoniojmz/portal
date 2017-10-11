@extends('menu.index')
@section('content')
<div class="container col-md-10" style="background-color: white;">
	<br>
	<div id="divTabla" class="col-md-12 divForm">
		<div class="table-responsive">
			<table id="tablaUsuarios" class="display" cellspacing="0" width="100%"></table>
		</div>
		<br />
		<div class="col-md-12">
			<div style="float:right;">
				{{ Form::button(' Agregar',
				[ 'id'=> 'agregar', 'type' => 'button',
				'class' => 'btn btn-primary fa fa-plus-circle'])}}
			</div>
		</div>
		<br>
	</div>
	<div id="divForm" style="display:none;" class="col-md-12 divForm">
		<center><h3>Registro de usuario</h3></center>
		<hr>
		{!! Form::open(['id'=>'FormUsuario','autocomplete' => 'off']) !!}
			{!! Form::hidden('idUser', '', [
			'id'            => 'idUser',
			'class'         => 'form-control'])!!}
			<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<label class="label" for="usrUserName"><b>Login:</b></label>
					{!! Form::text('usrUserName', '', [
					'id'            => 'usrUserName',
					'class'         => 'form-control',
					'placeholder'   => 'Login',
					'style'         => 'width:100%;height:35px',
					'maxlength'     => '10'])!!}
				</div>
				<div class="col-md-4"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<label class="label" for="usrNombreFull"><b>Nombres:</b></label>
					{!! Form::text('usrNombreFull', '', [
					'id'            => 'usrNombreFull',
					'class'         => 'form-control',
					'placeholder'   => 'Nombres',
					'style'         => 'width:100%;height:35px',
					'maxlength'     => '50'])!!}
				</div>
				<div class="col-md-4"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 form-group">
					<label class="label" for="usrEmail"><b>Email:</b></label>
					{!! Form::text('usrEmail', '', [
					'id'            => 'usrEmail',
					'class'         => 'form-control',
					'placeholder'   => 'Email',
					'style'         => 'width:100%;height:35px',
					'maxlength'     => '50'])!!}
				</div>
				<div class="col-md-4"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					{!! Field::select('idPerfil', null, null,
					[ 'label' => 'Perfíl', 
					'placeholder' => 'Seleccione...',
					'style' => 'width:100%;height:35px;',
					'class' => 'form-control comboclear']) !!}
				</div>
				<div class="col-md-4"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					{!! Field::select('usrEstado', null, null,
					[ 'label' => 'Estado', 
					'style' => 'width:100%;height:35px;',
					'placeholder' => 'Seleccione...',
					'class' => 'form-control comboclear']) !!}
				</div>
				<div class="col-md-4"></div>
			</div>
			<div id="divConsulta" style="display:none;">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<label class="label" for="usrUltimaVisita"><b>Última visita:</b></label>
						<span id="usrUltimaVisita" class="form-control">Desconocido</span>
					</div>
					<div class="col-md-4"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<label class="label" for="auCreadoEl"><b>Creado el:</b></label>
						<span id="auCreadoEl" class="form-control">Desconocido</span>
					</div>
					<div class="col-md-4"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<label class="label" for="creador"><b>Creado por:</b></label>
						<span id="creador" class="form-control">Desconocido</span>
					</div>
					<div class="col-md-4"></div>
				</div>
				<br>			
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<label class="label" for="auModificadoEl"><b>modificado el:</b></label>
						<span id="auModificadoEl" class="form-control">Desconocido</span>
					</div>
					<div class="col-md-4"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<label class="label" for="modificador"><b>Modificado por:</b></label>
						<span id="modificador" class="form-control">Desconocido</span>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>
			<br>
			<div align="center">
				<div class="pull-rigth">
					{{ Form::button(' Cancelar',
					[ 'id'=> 'cancelar', 'type' => 'button',
					'class' => 'btn btn-primary fa fa-times-circle'])}}
					{{ Form::button(' Guardar',
					[ 'id'=> 'guardar', 'type' => 'button',
					'class' => 'btn btn-primary fa fa-check-circle'])}}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	<br>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('usuarios') }}"
	var rutaR = "{{ URL::route('reiniciar') }}"
	var d = [];
	d['v_usuarios'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_usuarios) }}'));
	d['v_perfiles'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_perfiles) }}'));
	d['v_estados'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_estados) }}'));
</script>
<script src="{{ asset('js/usuarios/usuarios.js') }}"></script>
@endsection