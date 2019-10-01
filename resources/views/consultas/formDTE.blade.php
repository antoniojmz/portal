	<div class="divForm" style="display:none;">
		<div class="m-portlet--tabs">
			<div class="m-portlet__head"  style="border-bottom:none;">
				<div class="m-portlet__head-tools">
					<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">

						<li class="nav-item">
							<a id="ahref1" class="nav-link active" data-toggle="tab" href="#m_builder_page" role="tab" aria-expanded="true">
								Cabecera
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " data-toggle="tab" href="#m_builder_header" role="tab" aria-expanded="false">
								Detalle DTE
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#m_builder_left_aside" role="tab" aria-expanded="false">
								Referencias DTE
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#m_builder_right_aside" role="tab" aria-expanded="false">
								Traza DTE
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#pronto_pago" role="tab" aria-expanded="false">
								Pronto Pago
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#!" id="volver" role="tab" aria-expanded="false">
								<i class="la la-arrow-left"></i>
								Volver al listado
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--begin::Form-->

			<form class="m-form m-form--label-align-right m-form--fit" id="formViewDTE">
				<div class="m-portlet__body" style="padding-top: 10px;">
					<div class="tab-content">
						<!-- tab de cabecera -->
						<div class="tab-pane active" id="m_builder_page" aria-expanded="true">
							<div class="form-group row">
								<!-- <label class="col-lg-2 col-form-label">Tipo DTE:</label> -->
								<div class="col-lg-2 col-xl-2">
									<label for="TipoDTE">Tipo DTE:</label>
									<span id="TipoDTE" class="form-control span text-center"></span>
								</div>

								<!-- <label class="col-lg-2 col-form-label">Folio DTE:</label> -->
								<div class="col-lg-2 col-xl-2">
									<label for="FolioDTE">Folio DTE:</label>
									<span id="FolioDTE" class="form-control span text-center"></span>
								</div>
							
								<!-- <label class="col-lg-2 col-form-label">Fecha Emisión:</label> -->
								<div class="col-lg-2 col-xl-2">
									<label for="FechaEmision">Fecha Emisión:</label>
									<span id="FechaEmision" class="form-control span text-center"></span>
								</div>

								<!-- <label class="col-lg-2 col-form-label">Fecha Recepción Cliente:</label> -->
								<div class="col-lg-2 col-xl-2">
									<label for="FechaRecepcion">Fecha Recepción Cliente:</label>
									<span id="FechaRecepcion" class="form-control span text-center"></span>
								</div>

								<div class="col-lg-2 col-xl-2">
									<label for="EstadoActualDTE">Estado Actual DTE:</label>
									<span id="EstadoActualDTE" class="form-control span text-center"></span>
								</div>

								<div class="col-lg-2 col-xl-2">
									<label for="FechaEstadoActualDTE">Fecha Estado DTE:</label>
									<span id="FechaEstadoActualDTE" class="form-control span text-center"></span>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-lg-2 col-xl-2">
									<label for="RutProveedor">RUT Proveedor:</label>
									<span id="RutProveedor" class="form-control span text-center"></span>
								</div>

								<div class="col-lg-3 col-xl-3">
									<label for="NombreProveedor">Nombre Proveedor:</label>
									<span id="NombreProveedor" class="form-control span"></span>
								</div>

								<div class="col-lg-2 col-xl-2">
									<label for="RutCliente">RUT Cliente:</label>
									<span id="RutCliente" class="form-control span text-center"></span>
								</div>

								<div class="col-lg-3 col-xl-3">
									<label for="NombreCliente">Nombre Cliente:</label>
									<span id="NombreCliente" class="form-control span"></span>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-lg-2 col-xl-2">
									<label for="MontoNetoCLP">Monto Neto:</label>
									<span id="MontoNetoCLP" class="form-control span text-right"></span>
								</div>
								
								<div class="col-lg-2 col-xl-2">
									<label for="MontoExentoCLP">Monto Exento:</label>
									<span id="MontoExentoCLP" class="form-control span text-right"></span>
								</div>
							
								<div class="col-lg-2 col-xl-2">
									<label for="MontoIVACLP">Monto IVA:</label>
									<span id="MontoIVACLP" class="form-control span text-right"></span>
								</div>

								<div class="col-lg-2 col-xl-2">
									<label for="MontoTotalCLP">Monto Total:</label>
									<span id="MontoTotalCLP" class="form-control span text-right"></span>
								</div>
							</div>
						</div>
						<!-- fin tab de cabecera -->

						<!-- tab de detalle DTE -->
						<div class="tab-pane" id="m_builder_header" aria-expanded="false">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<div class="table-responsive">
										<table id="tablaDetalles" class="display table" cellspacing="0" width="100%"></table>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>

						<!-- tab de Referencias -->
						<div class="tab-pane" id="m_builder_left_aside" aria-expanded="false">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<div class="table-responsive">
										<table id="tablaReferencias" class="display table" cellspacing="0" width="100%"></table>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>

						<!-- tab de Estados -->
						<div class="tab-pane" id="m_builder_right_aside" aria-expanded="false">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<div class="table-responsive">
										<table id="tablaEstados" class="display table" cellspacing="0" width="100%"></table>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>

						<!-- tab de Pronto Pago -->
						<div class="tab-pane active" id="pronto_pago" aria-expanded="true">
							<div class="row">
								<div class="col-lg-1"></div>
								<div class="col-lg-10">
									<label for="TipoDTE">Información de Pronto Pago</label>
									
								</div>
								<div class="col-lg-1"></div>
							</div>
						</div>
						<!-- fin tab Pronto Pago -->
					</div>
				</div>
				
			</form>
			<!--end::Form-->
		</div>
	</div>