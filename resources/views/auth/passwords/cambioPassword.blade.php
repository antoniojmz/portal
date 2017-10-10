@extends('menu.index')
@section('content')
<div class="container col-md-10" style="background-color: white;">
    <br>
    <div id="divForm" class="col-md-12 form-control divForm">
        <center><h3>Cambio de contraseña</h3></center>
        <hr>
        {!! Form::open(['id'=>'Formclave','autocomplete' => 'off']) !!}
            <input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label class="control-label">Contraseña actual:</label>
                    <input type="password" class="form-control" id="password_old" name="password_old"/>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label class="control-label">Contraseña nueva:</label>
                    <input type="password" class="form-control" id="password" name="password" data-fv-different="true" data-fv-different-field="password_old" data-fv-different-message="Las contraseñas no pueden ser iguales" />
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label class="control-label">Confirme nueva contraseña:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-fv-identical="true" data-fv-identical-field="password" data-fv-identical-message="Las contraseñas no coinciden" />
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button id="cancelar" type="reset" class="btn btn-primary fa fa-times-circle"> Cancelar</button>
                    <button id="aceptar" type="button" class="btn btn-primary fa fa-check-circle"> Aceptar</button>
                </div>
            </div>
            <br>
        {!! Form::close() !!}
    </div>
</div>
<script type="text/javascript">
    var ruta = "{{ URL::route('password') }}"
</script>
<script src="/js/cambioPassword/cambioPassword.js"></script>
@endsection
