@extends('menu.index')
@section('content')
<div class="col-md-12">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <center>
                    <span id="spanTitulo">
                        Cambio de contraseña
                    </span>
                </center>
            </div>
        </div>
        <div class="m-portlet__body">
            {!! Form::open(['id'=>'Formclave','autocomplete' => 'off']) !!}
                <input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label class="control-label">Contraseña actual:</label>
                        <input type="password" class="form-control inputClear" id="password_old" name="password_old" required/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label class="control-label">Contraseña nueva:</label>
                        <input type="password" class="form-control inputClear" id="password" name="password" data-fv-different="true" data-fv-different-field="password_old" data-fv-different-message="Las contraseñas no pueden ser iguales" required/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label class="control-label">Confirme nueva contraseña:</label>
                        <input type="password" class="form-control inputClear" id="password_confirmation" name="password_confirmation" data-fv-identical="true" data-fv-identical-field="password" data-fv-identical-message="Las contraseñas no coinciden" required/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button name="cancelar" id="cancelar" class="btn m-btn--pill btn-outline-primary" type="button">
                            <span>
                                <i class="la la-times"></i>
                                <span>Cancelar</span>
                            </span>
                        </button>
                        <button name="aceptar" id="aceptar" class="btn m-btn--pill btn-primary" type="button">
                            <span>
                                <i class="la la-check"></i>
                                <span>Guardar</span>
                            </span>
                        </button>
                    </div>
                </div>
                <br>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script type="text/javascript">
    var ruta = "{{ URL::route('password') }}"
</script>
<script src="/js/cambioPassword/cambioPassword.js"></script>
@endsection
