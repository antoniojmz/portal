@extends('menu.index')
@section('content')
@php $nombres = array();$nombresDiv = array();$nombresHref = array(); $nombresLiNav= array(); $total =1; @endphp
<div class="col-md-12">
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
	    		$count=0; $paginas=[]; $cActiva=0;
				array_push($nombresDiv,"divNoticias1");
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
										<h3 style="color: white; text-shadow: black 0.1em 0.1em 0.2em" id="tituloNoticia" class="m-widget19__title m--font-light"></h3>
									</div>
									<div class="m-widget19__content">
										<div class="m-widget19__header">
											<div class="m-widget19__info">
												<h6 class="m-portlet__head-text">
													<span id="descripcionNoticia"></span>
												</h6>	
											</div>
										</div>
										<div class="m-widget19__body">
											<div class="row">
												<div class="col-md-12">
													<div id="detalleNoticia"></div>
												</div>
											</div>
										</div>
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
			@if (isset($v_publicaciones))
        		@if (count($v_publicaciones['principal']) > 0)
        			@foreach ($v_publicaciones['principal'] as $key => $value)
						@php array_push($nombres, $value->idNoticia); @endphp
	        			<div class="row" id="divPrincipal">
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
						    </form>
						    <div class="col-xl-12">
							    <div class="m-portlet">
									<div class="m-portlet__body  m-portlet__body--no-padding">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<h3 class="m-portlet__head-text">
														{{$value->titulo}}
													</h3>
												</div>
											</div>
										</div>
										<div class="row m-row--no-padding m-row--col-separator-xl">
											<div class="col-xl-6">
												@php  
													$avatarUser = $value->urlImage;
													(strlen($avatarUser) > 10) ? $avatar=$avatarUser : $avatar="img/default-img.png";
												@endphp
												<img src="{{ asset($avatar) }}"  width="100%" height="100%" alt="">
											</div>
											<div class="col-xl-6">
												<!--begin:: Widgets/Profit Share-->
												<div class="m-widget1">
													<div class="m-widget1__item">
														<div class="m-widget5__content">
															<h4 class="m-widget5__title">
																{{$value->descripcion}}
															</h4>
														</div>
														<div id="<?php echo $value->idNoticia;?>" class="m-widget5__stats1">
																<?php echo $value->detalle;?>
														</div>
														<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom idForm" value="<?php echo $value->idNoticia;?>">Leer mas</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
						    </div>

						</div>
					@endforeach	
					<p></p>					
	        		<div id="divNoticias<?php echo $total; ?>" class="row divNoticias">
				@endif
        		@if (count($v_publicaciones['noticias']) > 0)
					@foreach ($v_publicaciones['noticias'] as $key => $value)
						@php array_push($nombres, $value->idNoticia); @endphp
						<div class="col-xl-4">
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
						@php $count+=1; @endphp	
						@if(fmod($count,3) == 0)
							@php $total+=1;	
							array_push($nombresDiv,"divNoticias".$total); @endphp
							</div>
							<p></p>
							<div id="divNoticias<?php echo $total; ?>" class="row divNoticias" style="display:none;">
						@endif
					@endforeach	
					</div>
				@endif
			@endif
			<?php 
			for ($i=1; $i <= $total; $i++) {
				$paginas[$i-1] = $i; 
			} ?>
			<div class="row" style="display:flex;justify-content:center;">
		    	<div class="pagination-sm">
				    <ul class="pagination nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary">
						<li id="liNavPrincipio" class="livPag nav-item m-tabs__item">
							<a class="nav-link m-tabs__link" id="hrefPrincipio">
								<i class='la la-angle-double-left'></i>
							</a>
						</li>
						@if(fmod(count($v_publicaciones['noticias']),3) == 0)
							@php 
								array_pop($paginas); 
								array_pop($nombresDiv); 
								$total = $total -1;
							@endphp
						@endif
					  	@foreach ($paginas as $key => $value)
						    @if ($cActiva==0)
								@php array_push($nombresHref,$value); @endphp
						    	<li id="liNav{{$value}}" class="active livPag nav-item m-tabs__item">
						    		<a class="nav-link m-tabs__link hrefactive active" id="href{{$value}}" href="#">
						    			&nbsp;&nbsp;&nbsp;{{$value}}&nbsp;&nbsp;&nbsp;
						    		</a>
						    	</li>
						    @else
								@php array_push($nombresHref,$value); @endphp
						    	<li id="liNav{{$value}}" class="livPag nav-item m-tabs__item">
						    		<a class="nav-link m-tabs__link hrefactive" id="href{{$value}}" href="#">
						    			&nbsp;&nbsp;&nbsp;{{$value}}&nbsp;&nbsp;&nbsp;
						    		</a>
						    	</li>
						    @endif
							@php $cActiva=1; @endphp	
					  	@endforeach	
						<li id="liNavFinal nav-item m-tabs__item" class="livPag">
							<a class="nav-link m-tabs__link" id="hrefFinal" href="#">
								<i class='la la-angle-double-right'></i>
							</a>
						</li>
				  	</ul>
		    	</div>
			</div>
			</div>
	    @break
	    @default
	        {{"Perfíl no encontrado"}}
	        <script>
	            Salir();
	        </script>
	    @endswitch
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('ver_noticia') }}"
	var d = [];
	d['v_nombres'] = rhtmlspecialchars('{{ json_encode($nombres) }}');
	d['v_nombresDiv'] = rhtmlspecialchars('{{ json_encode($nombresDiv) }}');
	d['v_nombresHref'] = rhtmlspecialchars('{{ json_encode($nombresHref) }}');
	d['v_nombresLiNav'] = rhtmlspecialchars('{{ json_encode($nombresLiNav) }}');
	d['v_total'] = rhtmlspecialchars('{{ json_encode($total) }}');
	d['v_perfil'] = rhtmlspecialchars('{{ $data['idPerfil'] }}');
</script>
<script src="{{ asset('js/menu/home.js') }}"></script>
@endsection
