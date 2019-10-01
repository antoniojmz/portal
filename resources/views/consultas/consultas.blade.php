@extends('menu.index')
@section('content')
<div class="col-md-12 m-portlet">
	<div class="divForm">
		<br>
		<div class="row">
			<div class="col-md-12">
				<center><span id="spanTitulo"></span></center>
			</div>
		</div>
		<hr>
		<div id="divTabla">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table id="tablaReportes" class="table dt-responsive nowrap table-hover" style="font-size: 12px;" cellspacing="0" width="100%"></table>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('consultas.formDTE')
</div>

<!-- Modal -->
<div id="ModalTrazas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Traza DTE</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="col-md-12">
			<div class="table-responsive">
				<table id="tablaTrazas" class="display table" cellspacing="0" width="100%"></table>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('consultaDTE') }}";
	
	var rutaD = "{{ URL::route('detallesDTE') }}";
	var rutaT = "{{ URL::route('trazaDTE') }}";
	
	var d = [];
	d['v_dtes'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_dtes) }}'));
	d['v_busq_consulta'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_busq_consulta) }}'));
	d['v_tipo_dte'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_tipo_dte) }}'));
</script>
<script src="{{ asset('js/consultas/consultas.js') }}"></script>
@endsection