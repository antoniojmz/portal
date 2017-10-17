@extends('menu.index')
@section('content')
<div class="container col-md-10" style="background-color: white;">
	<div id="divTabla" class="divForm">
		<div class="row">
			<div class="col-md-12">
				<br>
				<center><span id="spanTitulo"></span></center>
				<hr>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-md-12 table-responsive">
				<table id="tablaClientes" class="display" cellspacing="0" width="100%"></table>
			</div>
		</div>
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('clientes') }}"
	var d = [];
	d['v_clientes'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_clientes) }}'));
</script>
<script src="{{ asset('js/clientes/clientes.js') }}"></script>
@endsection