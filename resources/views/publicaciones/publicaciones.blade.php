@extends('menu.index')
@section('content')
<div class="container col-md-10">
	<div class="divForm m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<center><span id="spanTitulo">Listado de publicaciones </span></center>
			</div>
		</div>	
		<br>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<center><span id="spanNoReg" class="spanSubTitulo"></span></center>
			</div>
			<div class="col-md-2">
				<button style="float:right;" name="agregar" id="agregar" class="btn m-btn--pill btn-primary" type="button">
					<span>
						<i class="la la-plus"></i>
						<span>Agregar</span>
					</span>
				</button>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10 table-responsive">
				<table id="tablaPublicaciones" class="display m-portlet__body" cellspacing="0" width="100%"></table>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<div class="divForm" style="display:none;">
        {!! Form::open(['id'=>'Formpublicaciones','autocomplete' => 'off', 'class' => 'm-form m-form--fit']) !!}
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<center><span id="spanTitulo">Registro de publicaciones</span></center>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-11"></div>
					<div class="col-md-1">
			 			<a id="volverT" href="#">Volver</a>
					</div>
				</div>
				<center>
					<h6>
						<span>
							<a id="ahrefDetalle" href="#">
								Detalles de la publicación
							</a>
						</span>
					</h6>
				</center>
				<br>
				<div id="divDetalles">
					<input type="hidden" name="idNoticia" id="idNoticia">
					<input type="hidden" name="urlImage" id="urlImage">
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-4">
								<label >Fecha inicio:</label>
	                            <div class='input-group date' id='datetimepicker2'>
	                            	<input type='text' id ="fechaInicio" name ="fechaInicio" class="form-control" data-date-format="DD-MM-YYYY" readonly placeholder="Fecha inicio de la publicación" />
									<span class="input-group-addon" id='btn-fechaInicio' name='btn-fechaInicio'>
										<i class="la la-calendar-check-o"></i>
									</span>
	                            </div>
	                            <span id="spanFechaI" style="display:none;color:#FF0000;font-size:9px;"><b>El campo es requerido.</b></span>
							</div>
							<div class="col-lg-4">
								<label class="">Fecha Fin:</label>
								<div class='input-group date' id='datetimepicker2'>
	                            	<input type='text' id ="fechaFin" name ="fechaFin" class="form-control" data-date-format="DD-MM-YYYY" readonly placeholder="Fecha fin de la publicación" />
									<span class="input-group-addon" id='btn-fechaFin' name='btn-fechaFin'>
										<i class="la la-calendar-check-o"></i>
									</span>
	                            </div>
							</div>
							<div class="col-lg-4">
								<label class="">
									Orden:
								</label>
								<div class="m-input-icon m-input-icon--right">
									<select class="comboclear" id="idOrden" name="idOrden" style="width:100%;">
										<option value="">Seleccione...</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-4">
								<label>Proveedores:</label>
								<div class="m-input-icon m-input-icon--right">
									<select class="comboclear" id="idProveedor" name="idProveedor[]" multiple="true" style="width:100%;"></select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="m-checkbox-list">
									<br><br>
									<label class="m-checkbox m-checkbox--primary">
										<input type="checkbox" id="checkProveedor" name="checkProveedor">
										Seleccionar todos los proveedores
										<span></span>
									</label>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="m-checkbox-list">
									<br><br>
									<label class="m-checkbox m-checkbox--primary">
										<input type="checkbox" id="idPrincipal" name="idPrincipal">
										Noticia Princial
										<span></span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="form-group m-form__group row">
					<label class="col-form-label col-lg-3 col-sm-12">
						Title:
					</label>
					<div class="col-lg-7 col-md-7 col-sm-12">
						<input type="text" class="form-control m-input" name="titulo" id="titulo" placeholder="Título de publicación">
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-form-label col-lg-3 col-sm-12">
						Descripción:
					</label>
					<div class="col-lg-7 col-md-7 col-sm-12">
						<input type="text" class="form-control m-input" name="descripcion" id="descripcion" placeholder="Descripción de la publicación">
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-form-label col-lg-3 col-sm-12">
						Detalle:
					</label>
					<div class="col-lg-7 col-md-7 col-sm-12">
						<div id="divDetalle"></div>
                        <span id="spanDetalleE" style="display:none;color:#FF0000;font-size:9px;"><b>El campo es requerido.</b></span>
					</div>
				</div>
				<div id="divImagen" class="form-group m-form__group row" style="display:none;">
					@php  
						$avatarImg = 'asd';
						(strlen($avatarImg) > 10) ? $avatar=$avatarImg : $avatar="img/default-img.png";
					@endphp
					<label class="col-form-label col-lg-3 col-sm-12">
						Miniatura:
					</label>
					<div class="form-group m-form__group row col-lg-7 col-md-7 col-sm-12">
						<div class="m-widget19__user-img">
							<img id="imgPublicacion" class="m-widget19__img" src="{{ asset($avatar) }}" alt="Img notificación" width="100%">
						</div>
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-form-label col-lg-3 col-sm-12">
						Imagen:
					</label>
					<div class="col-lg-7 col-md-7 col-sm-12">
						<div></div>
						<label class="custom-file">
							<input type="file" id="img" name="img" class="custom-file-input" accept="image/jpg">
							<span class="custom-file-control">Examinar...</span>
						</label>
						<br>
                         <label class="help-block">Archivo png o jpg no mayor a 10 megabytes (MB)</label>
                        <br>
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<div class="row">
							<div class="col-lg-4"></div>
							<div class="col-lg-8">
								<button name="cancelar" id="cancelar" class="btn m-btn--pill btn-outline-primary" type="button">
									<span>
										<i class="la la-times"></i>
										<span>Cancelar</span>
									</span>
								</button>
								<button name="guardar" id="guardar" class="btn m-btn--pill btn-primary" type="button">
									<span>
										<i class="la la-check"></i>
										<span>Guardar</span>
									</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
        {!! Form::close() !!}
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('publicaciones') }}"
	var rutaA = "{{ URL::route('activarPu') }}"
	var d = [];
	d['v_proveedores'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_proveedores) }}'));
	d['v_publicaciones'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_publicaciones) }}'));
</script>
<script src="{{ asset('js/publicaciones/publicaciones.js') }}"></script>
@endsection