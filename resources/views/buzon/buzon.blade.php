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
			</div>
			<div class="m-portlet__body">
				<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
					<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
						<div id="ChatBodyC" class="m-messenger__messages"></div>
					</div>
				</div>
			</div>
			<div id="my-portlet__footer" class="m-portlet__foot">
				<form id="FormChatC">
					<input type="hidden" name="caso" id="caso" value="2">
					<input type="hidden" name="idChat" id="idChat" value="0">
					<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
					<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
						<div class="m-messenger__form">
							<div class="m-messenger__form-controls">
								<textarea name="message" id="message" placeholder="Ingrese su mennsaje..." class="m-messenger__form-input" maxlength="990"></textarea>
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




		<button type="button" id="volverChat"> volver</button>
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('buzon') }}"
	var rutaC = "{{ URL::route('conversacion') }}"
	var rutaS = "{{ URL::route('chat') }}"
	var RutabR = "{{ URL::route('buzonR') }}"
	var d = [];
	d['v_chat'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_chat) }}'));
	d['idUser'] = JSON.parse(rhtmlspecialchars('{{ json_encode($idUser) }}'));
	console.log(d);
</script>
<script src="{{ asset('js/buzon/buzon.js') }}"></script>
@endsection








