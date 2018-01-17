@extends('menu.index')
@section('content')
<div class="col-md-12">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <center>
                    <span id="spanTitulo">
                        Actualización de datos
                    </span>
                </center>
            </div>
        </div>
        <div class="m-portlet__body">
            {!! Form::open(['id'=>'FormDatos','autocomplete' => 'off']) !!}
            {!! Form::hidden('idUser', '', [
            'id'            => 'idUser',
            'class'         => 'form-control'])!!}
            <input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <div class="row form-group">
                        <label class="label" for="usrUserName"><b>Login:</b></label>
                        <span id="usrUserName" class="form-control input">Desconocido</span>
                    </div>
                    <br>
                    <div class="row form-group">
                        <label class="label" for="usrNombreFull"><b>Nombres:</b></label>
                        {!! Form::text('usrNombreFull', '', [
                        'id'            => 'usrNombreFull',
                        'class'         => 'form-control input',
                        'placeholder'   => 'Nombres',
                        'style'         => 'width:100%;height:35px',
                        'maxlength'     => '50'])!!}
                    </div>
                    <br>
                    <div class="row form-group">
                        <label class="label" for="usrEmail"><b>Email:</b></label>
                        {!! Form::text('usrEmail', '', [
                        'id'            => 'usrEmail',
                        'class'         => 'form-control input',
                        'placeholder'   => 'Email',
                        'style'         => 'width:100%;height:35px',
                        'maxlength'     => '50'])!!}
                    </div>
                    <br>
                    <div class="row form-group">
                        <label class="label" for="usrUltimaVisita"><b>Última visita:</b></label>
                        <span id="usrUltimaVisita" class="form-control input">Desconocido</span>
                    </div>
                    <br>
                    <div class="row">
                        <label class="label" for="auCreadoEl"><b>Fecha de creación:</b></label>
                        <span id="auCreadoEl" class="form-control input">Desconocido</span>
                    </div>
                    <br>
                    <div align="center">
                        <div class="pull-rigth">
                            <div class="divBotonera">
                                <button name="modificar" id="modificar" class="btn m-btn--pill btn-outline-primary" type="button">
                                    <span>
                                        <i class="la la-pencil"></i>
                                        <span>Modificar</span>
                                    </span>
                                </button>
                            </div>

                            <div class="divBotonera" style="display:none;">
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
                <div class="col-md-5">
                    <div>
                        <center>
                            <a href="#">
                                @if ($avatar = 'default.png') @endif
                                <input type="hidden" id="usrUrlimage" name="usrUrlimage">
                                <div>
                                    <img name="foto-perfil" id="foto-perfil" class="gavatar" alt="avatar" src='{!! asset("img/$avatar") !!}'>
                                </div>
                            </a>
                            <br>
                            <label>Cargar o cambiar foto de perfil</label>
                            <br>
                            <div>
                                <input type="file" name="foto" id="foto">
                            </div>
                            <br>
                             <label class="help-block">Archivo png o jpg no mayor a 2  megabytes (MB)</label>
                            <br>
                            <div>
                                <button name="eliminar" id="eliminar" class="btn btn-sm m-btn--pill btn-outline-primary" type="button">
                                    <span>
                                        <i class="la la-times"></i>
                                        <span>Elimar</span>
                                    </span>
                                </button>
                                <button name="cargar" id="cargar" class="btn btn-sm m-btn--pill btn-primary" type="button">
                                    <span>
                                        <i class="la la-check"></i>
                                        <span>Cargar</span>
                                    </span>
                                </button>
                            </div>
                        </center>
                    </div>
                </div>
            </div> 
            {!! Form::close() !!} 
        </div>
    </div>
</div>
<script type="text/javascript">
    var ruta = "{{ URL::route('perfil') }}"
    var rutaE = "{{ URL::route('fotoe') }}"
    var rutaC = "{{ URL::route('fotoc') }}"
    var d = [];
    d['v_datos'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_datos) }}'));
</script>
<script src="/js/perfiles/perfiles.js"></script>
@endsection
