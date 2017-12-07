@extends('menu.index')
@section('content')
@php $nombres = array(); @endphp
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
	<div class="m-content">
	    @php
		$data = Session::get('perfiles');
		$widget = Session::get('widget');
	    @endphp
	    @switch($data['idPerfil'])
	    @case(1)
	        <!-- caso administrador -->
	    @break
	    @case(2)
	        <!-- caso cliente -->
	    @break
	    @case(3)
	    	@php 
	    		$dato=0;
	    	@endphp
    		@foreach ($v_publicaciones as $key => $value)
			    @if($key==0 && $dato < 1)
			    	<div class="row">
			    	@php array_push($nombres, $value->idNoticia); @endphp	
				    	<div class="col-xl-12">
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
								<div class="col-xl-12">
									<div class="col-xl-12">
										<br>
										<h6 class="m-portlet__head-text">
											{{$value->descripcion}}
										</h6>
									</div>
								</div>
								<br><br><br>
								<div class="m-widget19">
									<div class="m-widget19__content" style="text-align:justify">	
										<br><br>
										<div class="row">
											<div class="col-xl-6">
												<br>
												<div class="m-widget19__pic m-portlet-fit--top" style="min-height-: 286px">
													@php  
														$avatarUser = $value->urlImage;
														(strlen($avatarUser) > 10) ? $avatar=$avatarUser : $avatar="img/default-img.png";
													@endphp
													<img src="{{ asset($avatar) }}" alt="" width="300px" height="300px">
													<div class="m-widget19__shadow"></div>
												</div>
											</div>
											<div id="<?php echo $value->idNoticia;?>" class="col-xl-6">
												<div class="col-xl-12">
													<?php echo $value->detalle;?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
	    			@php $dato=1; @endphp
			    @else
						<div class="col-xl-4">
			    		@php array_push($nombres, $value->idNoticia); @endphp	
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
										</div>
									</div>
								</div>
							</div>
						</div>
			    @endif
			@endforeach
					</div>
	    @break
	    @default
	        {{"Perfíl no encontrado"}}
	        <script Language="Javascript">
	            Salir();
	        </script>
	    @endswitch
	</div>
</div>
<script Language="Javascript">
	var d = [];
	d['v_nombres'] = rhtmlspecialchars('{{ json_encode($nombres) }}');
	d['v_perfil'] = rhtmlspecialchars('{{ $data['idPerfil'] }}');
</script>
<script src="{{ asset('js/menu/home.js') }}"></script>
@endsection
