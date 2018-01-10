@extends('menu.index')
@section('content')
<div class="container col-md-10">
	<div class="col-lg-12 divForm m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<center>
					<h3 class="m-portlet__head-text">
						Buzon de mensajes
					</h3>
				</center>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="m-section">
				<div class="m-section__content">
					<table id="tablaBuzon" class="display" cellspacing="0" width="100%">
					 	<thead>
					    	<tr>
					      		<th>Usuario</th>
					      		<th>Operador</th>
					      		<th>Tiempo</th>
					    	</tr>
					  	</thead>
					  	<tbody>
					  	</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 divForm" style="display:none;">
		no me veo
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('buzon') }}"
	var d = [];
	d['v_chat'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_chat) }}'));
</script>
<script src="{{ asset('js/buzon/buzon.js') }}"></script>
@endsection



