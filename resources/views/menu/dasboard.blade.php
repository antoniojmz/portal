@extends('menu.index')
@section('content')
<!-- BEGIN: Subheader -->
<div id="divBienvenida" class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <div class="m-subheader__title ">
                Bienvenido a tu Portal de Proveedores
            </div>
        </div>
        <div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                        <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                            Filtrar por
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav">
                                            <li class="m-nav__item">
                                                <a href="javascript:void(0);" id="FiltroAnio" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-share"></i>
                                                    <span class="m-nav__link-text">
                                                        Este Año
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="javascript:void(0);" id="FiltroMes" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-share"></i>
                                                    <span class="m-nav__link-text">
                                                        Este Mes
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="javascript:void(0);" id="FiltroTryMes" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                    <span class="m-nav__link-text">
                                                        Últumos 3 meses
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="javascript:void(0);" id="FiltroSixMes" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                    <span class="m-nav__link-text">
                                                        Últumos 6 meses
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="javascript:void(0);" id="FiltrotweMes" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                    <span class="m-nav__link-text">
                                                        Últumos 12 meses
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

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
    <div class="divTablaFacP">
        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-xl-6">
                        <!--begin:: Widgets/Daily Sales-->
                        <div class="m-widget14">
                            <div class="m-widget14__header m--margin-bottom-30">
                                <h3 class="m-widget14__title">
                                    Facturación útimos 12 meses
                                </h3>
                                <span class="m-widget14__desc">
                                    Facturas emitidas al cliente los últimos 12 meses.
                                </span>
                            </div>
                            <div id="divFacturacion_por_mes" class="m-widget14__chart" style="height:120px;"></div>
                        </div>
                        <!--end:: Widgets/Daily Sales-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin:: Widgets/Profit Share-->
                        <div class="m-widget14">
                            <div class="m-widget14__header">
                                <h3 class="m-widget14__title">
                                    Facturación por estado
                                </h3>
                                <span class="m-widget14__desc">
                                    Resumen se Facturas por estado.
                                </span>
                            </div>
                            <div class="row  align-items-center">
                                <div class="col">
                                    <div id="facturacion_por_estado" class="m-widget14__chart" style="height: 160px;">
                                        <div class="m-widget14__stat">
                                            <span id="spanPorcentaje"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="m-widget14__legends">
                                        <div id="div1" style="display:none;" class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                            <span id="span1" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div2" style="display:none;" class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-success"></span>
                                            <span id="span2" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div3" style="display:none;" class="m-widget14__legend">
                                            <span style="background-color:#FA58F4;" class="m-widget14__legend-bullet"></span>
                                            <span id="span3" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div4" style="display:none;" class="m-widget14__legend">
                                            <span style="background-color:#F515C7;" class="m-widget14__legend-bullet"></span>
                                            <span id="span4" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div5" style="display:none;" class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-danger"></span>
                                            <span id="span5" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div6" style="display:none;" class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                            <span id="span6" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div7" style="display:none;" class="m-widget14__legend">
                                            <span style="background-color:#66FEF1;" class="m-widget14__legend-bullet"></span>
                                            <span id="span7" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div8" style="display:none;" class="m-widget14__legend">
                                            <span style="background-color:#2DF130;" class="m-widget14__legend-bullet"></span>
                                            <span id="span8" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div9" style="display:none;" class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-info"></span>
                                            <span id="span9" class="m-widget14__legend-text"></span>
                                        </div>
                                        <div id="div99" style="display:none;" class="m-widget14__legend">
                                            <span style="background-color:#F514C7;" class="m-widget14__legend-bullet"></span>
                                            <span id="span99" class="m-widget14__legend-text"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Profit Share-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <!--begin:: Widgets/Product Sales-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Facturación Total
                                    <span class="m-portlet__head-desc">
                                        Total de Facturas Recibidas
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget25">
                            <span id="spanMontoTotal" class="m-widget25__price m--font-brand"></span>
                            <br>
                            <span class="m-widget25__desc">
                                Total Facturado este año
                            </span>
                            <div class="m-widget25--progress">
                                <div class="m-widget25__progress">
                                    <span id="spanMonto1" class="m-widget25__progress-number"></span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div id="progress1" class="progress-bar m--bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span id="spanDes1" class="m-widget25__progress-sub"></span>
                                    <span><a id="href1" href="#" class="m-menu__link btn btn-link">Ver DTE´s </a></span>
                                </div>
                                <div class="m-widget25__progress">
                                    <span id="spanMonto2" class="m-widget25__progress-number"></span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div id="progress2" class="progress-bar m--bg-accent" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span id="spanDes2" class="m-widget25__progress-sub"></span>
                                    <span><a id="href2" href="#" class="m-menu__link btn btn-link">Ver DTE´s </a></span>
                                </div>
                            </div>
                            <div class="m-widget25--progress">
                                <div class="m-widget25__progress" >
                                    <span id="spanMonto3" class="m-widget25__progress-number"></span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div id="progress3" class="progress-bar m--bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span id="spanDes3" class="m-widget25__progress-sub"></span>
                                    <span><a id="href3" href="#" class="m-menu__link btn btn-link">Ver DTE´s </a></span>
                                </div>
                                <div class="m-widget25__progress" >
                                    <span id="spanMonto4" class="m-widget25__progress-number"></span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div id="progress4" class="progress-bar m--bg-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span id="spanDes4" class="m-widget25__progress-sub"></span>
                                    <span><a id="href4" href="#" class="m-menu__link btn btn-link">Ver DTE´s </a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Product Sales-->
            </div>
            <div class="col-xl-4">
                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Cambios de estados
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="DivCambioEstados" class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="divTablaFacP" style="background-color: white;display:none;">
        <br />
        <div id="divFormTabla">    
            <div class="row">
                <div class="col-md-11">
                    <button style="float:right;" class="btn m-btn--pill btn-outline-primary LinkFacP" type="button">
                        <span>
                            <i class="la la-arrow-left"></i>
                            <span>Volver</span>
                        </span>
                    </button>
                </div>
                <div class="col-md-1"></div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table id="tablaReportesEstadisticos" class="display" cellspacing="0" width="100%"></table>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <div id="divFormTab" style="display:none;">
            <div class="m-portlet m-portlet--tabs">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_builder_page" role="tab" aria-expanded="true">
                                    Cabecera
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link " data-toggle="tab" href="#m_builder_header" role="tab" aria-expanded="false">
                                    Detalle DTE
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_builder_left_aside" role="tab" aria-expanded="false">
                                    Referencias DTE
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_builder_right_aside" role="tab" aria-expanded="false">
                                    Estados de pago
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--begin::Form-->

                <form class="m-form m-form--label-align-right m-form--fit">
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            
                            <!-- tab de cabecera -->
                            <div class="tab-pane active" id="m_builder_page" aria-expanded="true">

                                <div class="col-md-12">
                                    <center>
                                        <span class="spanSubTitulo">Datos DTE</span>
                                    </center>
                                    <hr>
                                </div>
                                
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Tipo DTE:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="TipoDTE" class="form-control span"></span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Folio DTE:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="FolioDTE" class="form-control span"></span>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Fecha Emisión:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="FechaEmision" class="form-control span"></span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Fecha Recepción Cliente:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="FechaRecepcion" class="form-control span"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <center>
                                        <span class="spanSubTitulo">Datos Proveedor</span>
                                    </center>
                                    <hr>
                                </div>                      
                            
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">RUT Proveedor:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="RutProveedor" class="form-control span"></span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Nombre Proveedor:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="NombreProveedor" class="form-control span"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <center>
                                        <span class="spanSubTitulo">Datos Cliente</span>
                                    </center>
                                    <hr>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">RUT Cliente:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="RutCliente" class="form-control span"></span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Nombre Cliente:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="NombreCliente" class="form-control span"></span>
                                    </div>
                                </div>  


                                <div class="col-md-12">
                                    <br>
                                    <center>
                                        <span class="spanSubTitulo">Montos</span>
                                    </center>
                                    <hr>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Monto Neto:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="MontoNetoCLP" class="form-control span"></span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Monto Exento:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="MontoExentoCLP" class="form-control span"></span>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Monto IVA:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="MontoIVACLP" class="form-control span"></span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Monto Total:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="MontoTotalCLP" class="form-control span"></span>
                                    </div>
                                </div>  
                                
                                <div class="col-md-12">
                                    <br>
                                    <center>
                                        <span class="spanSubTitulo">Estado Actual DTE</span>
                                    </center>
                                    <hr>
                                </div>  

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Estado Actual DTE:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="EstadoActualDTE" class="form-control span"></span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Fecha Estado DTE:</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <span id="FechaEstadoActualDTE" class="form-control span"></span>
                                    </div>
                                </div>                                          
                            </div>

                            <!-- tab de detalle DTE -->
                            <div class="tab-pane" id="m_builder_header" aria-expanded="false">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="table-responsive">
                                            <table id="tablaDetalles" class="display" cellspacing="0" width="100%"></table>
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
                                            <table id="tablaReferencias" class="display" cellspacing="0" width="100%"></table>
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
                                            <table id="tablaEstados" class="display" cellspacing="0" width="100%"></table>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <center>
                                        <button name="volverTabProv" id="volverTabProv" class="btn m-btn--pill btn-outline-primary" type="button">
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
                </form>
                <!--end::Form-->
            </div>
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
    var ruta = "{{ URL::route('facturacion') }}"
    var rutaD = "{{ URL::route('detallesDTE') }}"
    var rutaF = "{{ URL::route('filtrarwidget') }}"
    var d = [];
    d['idPerfil'] = JSON.parse(rhtmlspecialchars('{{ json_encode($data["idPerfil"]) }}'));
    d['v_widget1'] = JSON.parse(rhtmlspecialchars('{{ json_encode($widget["v_widget1"]) }}'));
    d['v_widget2'] = JSON.parse(rhtmlspecialchars('{{ json_encode($widget["v_widget2"]) }}'));
    d['v_widget4'] = JSON.parse(rhtmlspecialchars('{{ json_encode($widget["v_widget4"]) }}'));
</script>
<script src="{{ asset('js/menu/dasboard.js') }}"></script>
@endsection