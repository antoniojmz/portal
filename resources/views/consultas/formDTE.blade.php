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
							<a class="nav-link" data-toggle="tab" href="#m_builder_header" role="tab" aria-expanded="false">
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
							<a class="nav-link" data-toggle="tab" href="#pronto_pago" id="pronto_pago_"  role="tab" aria-expanded="false">
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
				<input type="hidden" name="KeyDTE" id="KeyDTE" />

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
						<div class="tab-pane" id="pronto_pago" aria-expanded="false">
							<div class="row">
								<div class="col-lg-1"></div>
								<div class="col-lg-10">
									<div class="m-portlet m-portlet--full-height m-portlet--fit">
										<div class="m-portlet__head" style="padding-top: 10px; padding-bottom: 0px;">   
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<h3 class="m-portlet__head-text m--font-info">
														Información de Pronto Pago
														<span class="m-portlet__head-desc">
															solicitud/simulación de Pronto Pago
														</span>
													</h3>
												</div>
											</div>
											<div class="m-portlet__head-toolbar" id="divIndicadorPP">
												<div class="m-portlet__head-actions">
													<button class="btn btn-danger btn-sm btn-bold">Solicitado</button>
												</div>
											</div>
										</div>
										<div class="m-portlet__body" style="padding-top: 0px;">
											<div class="row" style="padding-top: 10px;">
												<div class="col-lg-4">
													<label for="FolioDTEPP">Número Factura:</label>
													<span id="FolioDTEPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-4">
													<label for="NombreProveedorPP">Proveedor:</label>
													<span id="NombreProveedorPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-4">
													<label for="MontoTotalCLPPP">Monto Total Factura:</label>
													<span id="MontoTotalCLPPP" class="form-control span text-center"></span>
												</div>
											</div>
											<div class="row" style="padding-top: 10px;">
												<div class="col-lg-3">
													<label for="FechaEmisionPP">Fecha Emisón:</label>
													<span id="FechaEmisionPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-3">
													<label for="FechaVencimientoPP">Fecha Vencimiento:</label>
													<span id="FechaVencimientoPP" class="form-control span text-center">05-01-2020</span>
												</div>
												<div class="col-lg-3">
													<label for="FechaPagoSolicitadaPP">Fecha de Pago Solictada:</label>
													<input type="date"  class="form-control" name="FechaPagoSolicitadaPP" id="FechaPagoSolicitadaPP" value="">
												</div>
												<div class="col-lg-3" style="">
													<label for="DiasAnticipoSolicitadaPP">Días de Anticipo:</label>
													<span id="DiasAnticipoSolicitadaPP" class="form-control span text-center"></span>
												</div>
											</div>

											<div class="row" id="divBtnSimularPP" style="padding-top: 30px; display: block;">
												<button type="button" class="btn btn-danger" id="btnSimularPP">Simular Pronto pagoPago</button>
											</div>

											<div class="row divSimularPP" id="divTituloSimularPP" style="padding-top: 30px; display: none;">
												<h4 class="m--font-danger">Simulación Pronto Pago</h4>
											</div>

											<div class="row divSimularPP" id="divTituloSimularPP_2" style="padding-top: 30px; display: none;">
												<h4 class="m--font-danger">Pronto Pago Solicitado</h4>
											</div>

											<div class="row divSimularPP" id="divSimulacion1" style="padding-top: 10px; display: none;">
												<div class="col-lg-3">
													<label for="TipoCambioPP">Tipo Cambio:</label>
													<span id="TipoCambioPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-3">
													<label for="TasaDescuentoDiaMensualPP">Tasa de Descuento Mensual:</label>
													<span id="TasaDescuentoDiaMensualPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-3">
													<label for="TasaDescuentoDiaPP">Tasa Descuento Dia:</label>
													<span id="TasaDescuentoDiaPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-3">
													<label for="TasaDescuentoPP">Tasa Descuento Pronto Pago:</label>
													<span id="TasaDescuentoPP" class="form-control span text-center"></span>
												</div>
											</div>
											<div class="row divSimularPP" id="divSimulacion2" style="padding-top: 10px; display: none;">
												<div class="col-lg-3">
													<label for="DescuentoPP">Descuento Pronto Pago:</label>
													<span id="DescuentoPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-3">
													<label for="IVAPP">IVA Descontado:</label>
													<span id="IVAPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-3">
													<label for="NetoDescontadoPP">Neto Descontado:</label>
													<span id="NetoDescontadoPP" class="form-control span text-center"></span>
												</div>
												<div class="col-lg-3">
													<label for="DiferenciaPagoPP">Diferencia a Pagar:</label>
													<span id="DiferenciaPagoPP" class="form-control span text-center bg-warning"></span>
												</div>
											</div>
											<div class="col-lg-12 text-right" >
												<div class="row" id="divBtnSolicitarPP" style="padding-top: 10px; display: none;">
													<button type="button" id="btnSolicitarPP" class="btn btn-success btn-bold">Enviar Solicitud Pronto Pago</button>
												</div>
											</div>
										</div>
									</div>
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

	<!-- Modal -->
	<div id="ModalSolicitarPP" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	     	<div class="modal-header">
	        	<h4 class="modal-title">Solicitud de Pronto Pago</h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
	      	<div class="modal-body">
	      		<div class="col-md-12">
					La Solicitud de Pronto Pago será validada por el departamento de xxxxxxxx y alguno de los aspectos a revisar son:
						- Revisión 1 <br />
						- Revisión 1 <br />
						- Revisión 1 <br />
						- Revisión 1 <br />
				</div>
	      	</div>
	    	<div class="modal-footer">
	        	<button type="button" class="btn btn-success" id="btnConfirmarPP" >Confirmar Solicitud</button>
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	      	</div>
	    </div>
	    <!-- end: Modal content-->
	  </div>
	</div>
