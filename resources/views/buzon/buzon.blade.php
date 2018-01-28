@extends('menu.index')
@section('content')
<style type="text/css" media="screen">
	.m-widget3 .m-widget3__item .m-widget3__header .m-widget3__user-img{
		margin:4px;
	}	
	.m-portlet{
		padding: 0px;
	}
</style>
<?php 
	$value=0;
	if(!empty($_POST['idSubmitchat'])){
		$value = $_POST['idSubmitchat'];
	} 
?>
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
		<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="450" data-scrollable="true" data-max-height="500" data-mobile-max-height="450">
			<div id="divBandejaMensaje" class="m-widget3" ></div>
		</div>
	</div>
	<div class="col-lg-12 divForm" style="display:none;">
		<div class="m-portlet">
			<div class="m-portlet__head">	
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<div class="m-card-user m-card-user--skin-dark">
							<div class="m-card-user__pic">
								<img id="imgUserChat" class="avatar" alt="avatar" src=""/>
							</div>
						</div>
						<h3 id="NombreUsuario" class="m-portlet__head-text"></h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<a id="volverChat" href="#" class="m-nav__link">
								volver
							</a>
						</li>								
					</ul>
				</div>
			</div>
			<div  id="styleScroll" class="m-portlet__body scrollBar" style="background-color:#FFF"> 	
				<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
					<div id="ChatBodyC" class="m-messenger__messages"></div>
				</div>
		      	<div class="forceOverflow"></div>
			</div>
			<div id="my-portlet__footer" class="m-portlet__foot">
				<form id="FormChatC">
					{{ csrf_field() }}
					<input type="hidden" name="caso" id="caso" value="2">
					<input type="hidden" name="idChat" id="idChat" value="0">
					<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
					<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
						<div class="m-messenger__form" style="padding-bottom: 2px;">
							<div class="m-messenger__form-controls">
								<textarea name="messageB" id="messageB" placeholder="Ingrese su mennsaje..." class="m-messenger__form-input" maxlength="990"></textarea>
							</div>
							<div class="m-messenger__form-tools">
								<a href="#" id="ChatSubmitC" class="m-nav__link m-portlet__nav-link btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--pill">
									<i class="flaticon-paper-plane"></i>
								</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script Language="Javascript">
	var rutaC = "{{ URL::route('conversacion') }}"
	var d = [];
	d['v_chat'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_chat) }}'));
	d['idUser'] = JSON.parse(rhtmlspecialchars('{{ json_encode($idUser) }}'));
	d['idChat'] = JSON.parse(rhtmlspecialchars('{{ json_encode($value) }}'));
</script>
<script src="{{ asset('js/buzon/buzon.js') }}"></script>
@endsection