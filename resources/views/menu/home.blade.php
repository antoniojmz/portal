@extends('menu.index')
@section('content')
@php $nombres = array() @endphp
<div class="container col-md-12">
	<!-- <div class="m-subheader">
	    <div class="d-flex align-items-center">
	        <div class="mr-auto">
	            <div class="m-subheader__title ">
	                Bienvenido a tu Portal de Proveedores
	            </div>
	        </div>
	    </div>
	</div> -->
	    @php
		$data = Session::get('perfiles');
		$widget = Session::get('widget');
	    @endphp
	    @switch($data['idPerfil'])
	    @case(1)
	        <!-- caso administrador -->
			<div class="m-content m-portlet">
				<h3>Bienvenido al perfil de Administrador</h3>	
			</div>
	    @break
	    @case(2)
	        <!-- caso cliente -->
			<div class="m-content m-portlet">
				<h3>Bienvenido al perfil de Cliente</h3>	
			</div>
	    @break
	    @case(3)
	    	@php 
	    		$dato=0;
	    	@endphp
			<div class="m-content FormNoticias" style="display:none;">
                <div class="row">
                	<div class="col-xl-2"></div>
                	<div class="col-xl-8">
						<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
							<div class="m-portlet__head m-portlet__head--fit"></div>
							<div class="m-portlet__body">
								<div class="m-widget19">
									<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides">
										<img id="imageNoticia" src="img/default-img.png" alt="">
										<h3 id="tituloNoticia" class="m-widget19__title m--font-light"></h3>
									</div>
									<div class="m-widget19__content">
										<div class="m-widget19__header">
											<div class="m-widget19__info">
												<h6 class="m-portlet__head-text">
													<span id="descripcionNoticia"></span>
												</h6>	
											</div>
										</div>
										<div id="detalleNoticia" class="m-widget19__body"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
                	<div class="col-xl-2"></div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <center>
									<br>
                                    <button id="volverHome" class="btn m-btn--pill btn-outline-primary" type="button">
                                        <span>
                                            <i class="la la-arrow-left"></i>
                                            <span>Volver</span>
                                        </span>
                                    </button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="m-content FormNoticias">
	    		@foreach ($v_publicaciones as $key => $value)
				    @if($key==0 && $dato < 1)
				    	@php array_push($nombres, $value->idNoticia); @endphp
						    <form id="Form<?php echo $value->idNoticia;?>">
						    	<div style="display:none;">
							    	<input type="hidden" id="idNoticiaForm<?php echo $value->idNoticia;?>" value="<?php echo $value->idNoticia;?>">
							    	<input type="hidden" id="tituloForm<?php echo $value->idNoticia;?>" value="<?php echo $value->titulo;?>">
							    	<input type="hidden" id="descripcionForm<?php echo $value->idNoticia;?>" value="<?php echo $value->descripcion;?>">
							    	<input type="hidden" id="urlImageForm<?php echo $value->idNoticia;?>" value="<?php echo $value->urlImage;?>">

							    	<input type="hidden" id="DetalleForm<?php echo $value->idNoticia;?>" value='<?php echo $value->detalle;?>'>

							    	<span id="spanDetalleForm<?php echo $value->idNoticia;?>" style="display:none;"> 
							    		<?php echo $value->detalle;?>
							    	</span>
						    	</div>
			    				<div class="m-portlet m-portlet--mobile">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													{{$value->titulo}}
												</h3>
											</div>
										</div>
									</div>
									<div class="tab-content">
										<div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
											<div class="m-widget5">
												<div class="row">
													<div class="col-md-6">
														<div class="m-widget5__content">
															@php  
																$avatarUser = $value->urlImage;
																(strlen($avatarUser) > 10) ? $avatar=$avatarUser : $avatar="img/default-img.png";
															@endphp
															<img src="{{ asset($avatar) }}" alt="">
														</div>
													</div>
													<div class="col-md-6">
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																{{$value->descripcion}}
															</h4>
														</div>
														<div id="<?php echo $value->idNoticia;?>" class="m-widget5__stats1">
																<?php echo $value->detalle;?>
															<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom idForm" value="<?php echo $value->idNoticia;?>">Leer mas</button>
														</div>
													</div>		
												</div>		
											</div>
										</div>
									</div>
								</div>
						    </form>	
						<div class="row">
		    			@php $dato=1; @endphp
				    @else
							<div class="col-xl-4">
				    		@php array_push($nombres, $value->idNoticia); @endphp	
						    <form id="Form<?php echo $value->idNoticia;?>">
								<div style="display:none;">
							    	<input type="hidden" id="idNoticiaForm<?php echo $value->idNoticia;?>" value="<?php echo $value->idNoticia;?>">
							    	<input type="hidden" id="tituloForm<?php echo $value->idNoticia;?>" value="<?php echo $value->titulo;?>">
							    	<input type="hidden" id="descripcionForm<?php echo $value->idNoticia;?>" value="<?php echo $value->descripcion;?>">
							    	<input type="hidden" id="urlImageForm<?php echo $value->idNoticia;?>" value="<?php echo $value->urlImage;?>">
							    	<input type="hidden" id="DetalleForm<?php echo $value->idNoticia;?>" value='<?php echo $value->detalle;?>'>
							    	<span id="spanDetalleForm<?php echo $value->idNoticia;?>" style="display:none;"> 
							    		<?php echo $value->detalle;?>
							    	</span>
						    	</div>
								<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
									<div class="m-portlet__head m-portlet__head--fit"></div>
									<div class="m-portlet__body">
										<div class="m-widget19">
											<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides">
												@php  
													$avatarUser = $value->urlImage;
													(strlen($avatarUser) > 10) ? $avatar=$avatarUser : $avatar="img/default-img.png";
												@endphp
												<img src="{{ asset($avatar) }}" alt="">
												<h3 class="m-widget19__title m--font-light">
													{{$value->titulo}}
												</h3>
												<div class="m-widget19__shadow"></div>
											</div>
											<div class="m-widget19__content">
												<div class="m-widget19__header">
													<div class="m-widget19__info">
														<h6 class="m-portlet__head-text">
															{{$value->descripcion}}
														</h6>	
													</div>
												</div>
												<div id="<?php echo $value->idNoticia;?>" class="m-widget19__body">
													<?php echo $value->detalle;?>
												</div>
												<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom idForm" value="<?php echo $value->idNoticia;?>">Leer mas</button>
											</div>
										</div>
									</div>
								</div>
						    </form>	
							</div>
				    @endif
				@endforeach
						</div>
			</div>
	    @break
	    @default
	        {{"Perfíl no encontrado"}}
	        <script Language="Javascript">
	            Salir();
	        </script>
	    @endswitch
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('ver_noticia') }}"
	var d = [];
	d['v_nombres'] = rhtmlspecialchars('{{ json_encode($nombres) }}');
	d['v_perfil'] = rhtmlspecialchars('{{ $data['idPerfil'] }}');
	console.log(d);
</script>
<script src="{{ asset('js/menu/home.js') }}"></script>
@endsection
