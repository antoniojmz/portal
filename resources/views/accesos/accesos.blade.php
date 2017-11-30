@extends('accesos.index')
@section('content')
<div class="container col-md-10" style="background-color: white;">
	<div class="row">
		<div class="col-md-12">
			<br>
			<center><span id="spanTitulo"></span></center>
			<hr>
		</div>
	</div>
	<div id="divTabla" class="col-md-12 divForm">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 table-responsive">
				<table id="tablaAccesos" class="display m-portlet__body" cellspacing="0" width="100%"></table>
				<br>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('accesos') }}"
	var d = [];
	d['v_accesos'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_accesos) }}'));
</script>
<script src="{{ asset('js/accesos/accesos.js') }}"></script>
@endsection