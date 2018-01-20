@extends('accesos.index')
@section('content')
<div class="row"> 
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
		<div class="m-portlet">
	        <div class="m-portlet__head">
	            <div class="m-portlet__head-caption">
	                <center>
	                    <span id="spanTitulo"></span>
	                </center>
	            </div>
	        </div>
	        <div class="m-portlet__body">
				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						<div class="table-responsive">
							<table id="tablaAccesos" class="display table" cellspacing="0" width="100%"></table>
						</div>
					</div>
				</div>
	        </div>
	    </div>
	</div>
	<div class="col-lg-3"></div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('accesos') }}"
	var RutaSalir = "{{ URL::route('logout') }}";
	var d = [];
	d['v_accesos'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_accesos) }}'));
</script>
<script src="{{ asset('js/accesos/accesos.js') }}"></script>
@endsection