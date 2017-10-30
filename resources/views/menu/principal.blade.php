@extends('menu.index')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <div class="m-subheader__title ">
                Bienvenido a tu Portal de Proveedores
            </div>
        </div>
        <div>
            <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                <span class="m-subheader__daterange-label">
                    <span class="m-subheader__daterange-title"></span>
                    <span class="m-subheader__daterange-date m--font-brand"></span>
                </span>
                <a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                    <i class="la la-angle-down"></i>
                </a>
            </span>
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
        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Finance Summary-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Finance Summary
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-danger">
                                        Today
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 34.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">
                                                                Quick Actions
                                                            </span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                    Activity
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                    Messages
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                    FAQ
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                    Support
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                                Cancel
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
                    <div class="m-portlet__body">
                        <div class="m-widget12">
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    Annual Companies Taxes EMS
                                    <br>
                                    <span>
                                        $500,000
                                    </span>
                                </span>
                                <span class="m-widget12__text2">
                                    Next Tax Review Date
                                    <br>
                                    <span>
                                        July 24,2017
                                    </span>
                                </span>
                            </div>
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    Total Annual Profit Before Tax
                                    <br>
                                    <span>
                                        $3,800,000
                                    </span>
                                </span>
                                <span class="m-widget12__text2">
                                    Type Of Market Share
                                    <br>
                                    <span>
                                        Grossery
                                    </span>
                                </span>
                            </div>
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    Avarage Product Price
                                    <br>
                                    <span>
                                        $60,70
                                    </span>
                                </span>
                                <div class="m-widget12__text2">
                                    <div class="m-widget12__desc">
                                        Satisfication Rate
                                    </div>
                                    <br>
                                    <div class="m-widget12__progress">
                                        <div class="m-widget12__progress-sm progress m-progress--sm">
                                            <div class="m-widget12__progress-bar progress-bar bg-brand" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="m-widget12__stats">
                                            63%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Finance Summary-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Sale Reports-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Sales Reports
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab1_content" role="tab">
                                        Last Month
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget11_tab2_content" role="tab">
                                        All Time
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--Begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::tab 1 content-->
                            <div class="tab-pane active" id="m_widget11_tab1_content">
                                <!--begin::Widget 11-->
                                <div class="m-widget11">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table">
                                            <!--begin::Thead-->
                                            <thead>
                                                <tr>
                                                    <td class="m-widget11__label">
                                                        #
                                                    </td>
                                                    <td class="m-widget11__app">
                                                        Application
                                                    </td>
                                                    <td class="m-widget11__sales">
                                                        Sales
                                                    </td>
                                                    <td class="m-widget11__price">
                                                        Avg Price
                                                    </td>
                                                    <td class="m-widget11__total m--align-right">
                                                        Total
                                                    </td>
                                                </tr>
                                            </thead>
                                            <!--end::Thead-->
                                            <!--begin::Tbody-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Vertex 2.0
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Vertex To By Again
                                                        </span>
                                                    </td>
                                                    <td>
                                                        19,200
                                                    </td>
                                                    <td>
                                                        $63
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $14,740
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Metronic
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Powerful Admin Theme
                                                        </span>
                                                    </td>
                                                    <td>
                                                        24,310
                                                    </td>
                                                    <td>
                                                        $39
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $16,010
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Apex
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            The Best Selling App
                                                        </span>
                                                    </td>
                                                    <td>
                                                        9,076
                                                    </td>
                                                    <td>
                                                        $105
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $37,200
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Cascades
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Design Tool
                                                        </span>
                                                    </td>
                                                    <td>
                                                        11,094
                                                    </td>
                                                    <td>
                                                        $16
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $8,520
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Tbody-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <div class="m-widget11__action m--align-right">
                                        <button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">
                                            Import Report
                                        </button>
                                    </div>
                                </div>
                                <!--end::Widget 11-->
                            </div>
                            <!--end::tab 1 content-->
                            <!--begin::tab 2 content-->
                            <div class="tab-pane" id="m_widget11_tab2_content">
                                <!--begin::Widget 11-->
                                <div class="m-widget11">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table">
                                            <!--begin::Thead-->
                                            <thead>
                                                <tr>
                                                    <td class="m-widget11__label">
                                                        #
                                                    </td>
                                                    <td class="m-widget11__app">
                                                        Application
                                                    </td>
                                                    <td class="m-widget11__sales">
                                                        Sales
                                                    </td>
                                                    <td class="m-widget11__change">
                                                        Change
                                                    </td>
                                                    <td class="m-widget11__price">
                                                        Avg Price
                                                    </td>
                                                    <td class="m-widget11__total m--align-right">
                                                        Total
                                                    </td>
                                                </tr>
                                            </thead>
                                            <!--end::Thead-->
                                            <!--begin::Tbody-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Loop
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            CRM System
                                                        </span>
                                                    </td>
                                                    <td>
                                                        19,200
                                                    </td>
                                                    <td>
                                                        $63
                                                    </td>
                                                    <td>
                                                        $11,300
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $34,740
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Selto
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Powerful Website Builder
                                                        </span>
                                                    </td>
                                                    <td>
                                                        24,310
                                                    </td>
                                                    <td>
                                                        $39
                                                    </td>
                                                    <td>
                                                        $14,700
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $46,010
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Jippo
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            The Best Selling App
                                                        </span>
                                                    </td>
                                                    <td>
                                                        9,076
                                                    </td>
                                                    <td>
                                                        $105
                                                    </td>
                                                    <td>
                                                        $8,400
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $67,800
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Verto
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Web Development Tool
                                                        </span>
                                                    </td>
                                                    <td>
                                                        11,094
                                                    </td>
                                                    <td>
                                                        $16
                                                    </td>
                                                    <td>
                                                        $12,500
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $18,520
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Tbody-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <div class="m-widget11__action m--align-right">
                                        <button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">
                                            Generate Report
                                        </button>
                                    </div>
                                </div>
                                <!--end::Widget 11-->
                            </div>
                            <!--end::tab 2 content-->
                            <!--begin::tab 3 content-->
                            <div class="tab-pane" id="m_widget11_tab3_content"></div>
                            <!--end::tab 3 content-->
                        </div>
                        <!--End::Tab Content-->
                    </div>
                </div>
                <!--end:: Widgets/Sale Reports-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Product Sales-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Product Sales
                                    <span class="m-portlet__head-desc">
                                        Total Sales By Products
                                    </span>
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                        Filter
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                    Activity
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                    Messages
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                    FAQ
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                    Support
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
                    <div class="m-portlet__body">
                        <div class="m-widget25">
                            <span class="m-widget25__price m--font-brand">
                                $237,650
                            </span>
                            <span class="m-widget25__desc">
                                Total Revenue This Month
                            </span>
                            <div class="m-widget25--progress">
                                <div class="m-widget25__progress">
                                    <span class="m-widget25__progress-number">
                                        63%
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        Sales Growth
                                    </span>
                                </div>
                                <div class="m-widget25__progress">
                                    <span class="m-widget25__progress-number">
                                        39%
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-accent" role="progressbar" style="width: 39%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        Product Growth
                                    </span>
                                </div>
                                <div class="m-widget25__progress" >
                                    <span class="m-widget25__progress-number">
                                        54%
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-warning" role="progressbar" style="width: 54%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        Community Growth
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Product Sales-->
            </div>
        </div>        
    @break
    @case(2)
        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Finance Summary-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Finance Summary
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-danger">
                                        Today
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 34.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">
                                                                Quick Actions
                                                            </span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                    Activity
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                    Messages
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                    FAQ
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                    Support
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                                Cancel
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
                    <div class="m-portlet__body">
                        <div class="m-widget12">
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    Annual Companies Taxes EMS
                                    <br>
                                    <span>
                                        $500,000
                                    </span>
                                </span>
                                <span class="m-widget12__text2">
                                    Next Tax Review Date
                                    <br>
                                    <span>
                                        July 24,2017
                                    </span>
                                </span>
                            </div>
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    Total Annual Profit Before Tax
                                    <br>
                                    <span>
                                        $3,800,000
                                    </span>
                                </span>
                                <span class="m-widget12__text2">
                                    Type Of Market Share
                                    <br>
                                    <span>
                                        Grossery
                                    </span>
                                </span>
                            </div>
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    Avarage Product Price
                                    <br>
                                    <span>
                                        $60,70
                                    </span>
                                </span>
                                <div class="m-widget12__text2">
                                    <div class="m-widget12__desc">
                                        Satisfication Rate
                                    </div>
                                    <br>
                                    <div class="m-widget12__progress">
                                        <div class="m-widget12__progress-sm progress m-progress--sm">
                                            <div class="m-widget12__progress-bar progress-bar bg-brand" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="m-widget12__stats">
                                            63%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Finance Summary-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Sale Reports-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Sales Reports
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab1_content" role="tab">
                                        Last Month
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget11_tab2_content" role="tab">
                                        All Time
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--Begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::tab 1 content-->
                            <div class="tab-pane active" id="m_widget11_tab1_content">
                                <!--begin::Widget 11-->
                                <div class="m-widget11">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table">
                                            <!--begin::Thead-->
                                            <thead>
                                                <tr>
                                                    <td class="m-widget11__label">
                                                        #
                                                    </td>
                                                    <td class="m-widget11__app">
                                                        Application
                                                    </td>
                                                    <td class="m-widget11__sales">
                                                        Sales
                                                    </td>
                                                    <td class="m-widget11__price">
                                                        Avg Price
                                                    </td>
                                                    <td class="m-widget11__total m--align-right">
                                                        Total
                                                    </td>
                                                </tr>
                                            </thead>
                                            <!--end::Thead-->
                                            <!--begin::Tbody-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Vertex 2.0
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Vertex To By Again
                                                        </span>
                                                    </td>
                                                    <td>
                                                        19,200
                                                    </td>
                                                    <td>
                                                        $63
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $14,740
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Metronic
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Powerful Admin Theme
                                                        </span>
                                                    </td>
                                                    <td>
                                                        24,310
                                                    </td>
                                                    <td>
                                                        $39
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $16,010
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Apex
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            The Best Selling App
                                                        </span>
                                                    </td>
                                                    <td>
                                                        9,076
                                                    </td>
                                                    <td>
                                                        $105
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $37,200
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Cascades
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Design Tool
                                                        </span>
                                                    </td>
                                                    <td>
                                                        11,094
                                                    </td>
                                                    <td>
                                                        $16
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $8,520
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Tbody-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <div class="m-widget11__action m--align-right">
                                        <button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">
                                            Import Report
                                        </button>
                                    </div>
                                </div>
                                <!--end::Widget 11-->
                            </div>
                            <!--end::tab 1 content-->
                            <!--begin::tab 2 content-->
                            <div class="tab-pane" id="m_widget11_tab2_content">
                                <!--begin::Widget 11-->
                                <div class="m-widget11">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table">
                                            <!--begin::Thead-->
                                            <thead>
                                                <tr>
                                                    <td class="m-widget11__label">
                                                        #
                                                    </td>
                                                    <td class="m-widget11__app">
                                                        Application
                                                    </td>
                                                    <td class="m-widget11__sales">
                                                        Sales
                                                    </td>
                                                    <td class="m-widget11__change">
                                                        Change
                                                    </td>
                                                    <td class="m-widget11__price">
                                                        Avg Price
                                                    </td>
                                                    <td class="m-widget11__total m--align-right">
                                                        Total
                                                    </td>
                                                </tr>
                                            </thead>
                                            <!--end::Thead-->
                                            <!--begin::Tbody-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Loop
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            CRM System
                                                        </span>
                                                    </td>
                                                    <td>
                                                        19,200
                                                    </td>
                                                    <td>
                                                        $63
                                                    </td>
                                                    <td>
                                                        $11,300
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $34,740
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Selto
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Powerful Website Builder
                                                        </span>
                                                    </td>
                                                    <td>
                                                        24,310
                                                    </td>
                                                    <td>
                                                        $39
                                                    </td>
                                                    <td>
                                                        $14,700
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $46,010
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Jippo
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            The Best Selling App
                                                        </span>
                                                    </td>
                                                    <td>
                                                        9,076
                                                    </td>
                                                    <td>
                                                        $105
                                                    </td>
                                                    <td>
                                                        $8,400
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $67,800
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            <input type="checkbox">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">
                                                            Verto
                                                        </span>
                                                        <span class="m-widget11__sub">
                                                            Web Development Tool
                                                        </span>
                                                    </td>
                                                    <td>
                                                        11,094
                                                    </td>
                                                    <td>
                                                        $16
                                                    </td>
                                                    <td>
                                                        $12,500
                                                    </td>
                                                    <td class="m--align-right m--font-brand">
                                                        $18,520
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Tbody-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <div class="m-widget11__action m--align-right">
                                        <button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">
                                            Generate Report
                                        </button>
                                    </div>
                                </div>
                                <!--end::Widget 11-->
                            </div>
                            <!--end::tab 2 content-->
                            <!--begin::tab 3 content-->
                            <div class="tab-pane" id="m_widget11_tab3_content"></div>
                            <!--end::tab 3 content-->
                        </div>
                        <!--End::Tab Content-->
                    </div>
                </div>
                <!--end:: Widgets/Sale Reports-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Product Sales-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Product Sales
                                    <span class="m-portlet__head-desc">
                                        Total Sales By Products
                                    </span>
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                        Filter
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                    Activity
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                    Messages
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                    FAQ
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                    Support
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
                    <div class="m-portlet__body">
                        <div class="m-widget25">
                            <span class="m-widget25__price m--font-brand">
                                $237,650
                            </span>
                            <span class="m-widget25__desc">
                                Total Revenue This Month
                            </span>
                            <div class="m-widget25--progress">
                                <div class="m-widget25__progress">
                                    <span class="m-widget25__progress-number">
                                        63%
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        Sales Growth
                                    </span>
                                </div>
                                <div class="m-widget25__progress">
                                    <span class="m-widget25__progress-number">
                                        39%
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-accent" role="progressbar" style="width: 39%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        Product Growth
                                    </span>
                                </div>
                                <div class="m-widget25__progress" >
                                    <span class="m-widget25__progress-number">
                                        54%
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-warning" role="progressbar" style="width: 54%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget25__progress-sub">
                                        Community Growth
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Product Sales-->
            </div>
        </div>
    @break
    @case(3)
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
                        <div class="m-widget14__chart" style="height:120px;">
                            <canvas  id="facturacion_por_mes"></canvas>
                        </div>
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
                                <div id="facturacion_por_estado" class="m-widget14__chart" style="height: 160px">
                                    <div class="m-widget14__stat">
                                        %
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
                                        <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                        <span id="span3" class="m-widget14__legend-text"></span>
                                    </div>
                                    <div id="div4" style="display:none;" class="m-widget14__legend">
                                        <span class="m-widget14__legend-bullet m--bg-info"></span>
                                        <span id="span4" class="m-widget14__legend-text"></span>
                                    </div>
                                    <div id="div5" style="display:none;" class="m-widget14__legend">
                                        <span class="m-widget14__legend-bullet m--bg-danger"></span>
                                        <span id="span5" class="m-widget14__legend-text"></span>
                                    </div>
                                    <div id="div6" style="display:none;" class="m-widget14__legend">
                                        <span style="background-color:#FA58F4;" class="m-widget14__legend-bullet"></span>
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
                                Product Sales
                                <span class="m-portlet__head-desc">
                                    Total Sales By Products
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                    Filter
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">
                                                                Activity
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">
                                                                Messages
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">
                                                                FAQ
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                            <span class="m-nav__link-text">
                                                                Support
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
                <div class="m-portlet__body">
                    <div class="m-widget25">
                        <span class="m-widget25__price m--font-brand">
                            $237,650
                        </span>
                        <span class="m-widget25__desc">
                            Total Revenue This Month
                        </span>
                        <div class="m-widget25--progress">
                            <div class="m-widget25__progress">
                                <span class="m-widget25__progress-number">
                                    63%
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget25__progress-sub">
                                    Sales Growth
                                </span>
                            </div>
                            <div class="m-widget25__progress">
                                <span class="m-widget25__progress-number">
                                    39%
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-accent" role="progressbar" style="width: 39%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget25__progress-sub">
                                    Product Growth
                                </span>
                            </div>
                        </div>
                        <div class="m-widget25--progress">
                            <div class="m-widget25__progress" >
                                <span class="m-widget25__progress-number">
                                    54%
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-danger" role="progressbar" style="width: 54%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget25__progress-sub">
                                    Community Growth
                                </span>
                            </div>
                            <div class="m-widget25__progress" >
                                <span class="m-widget25__progress-number">
                                    54%
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-warning" role="progressbar" style="width: 54%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget25__progress-sub">
                                    Community Growth
                                </span>
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
                                Latest Updates
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
                                <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                    Today
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">
                                                                Activity
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">
                                                                Messages
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">
                                                                FAQ
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                            <span class="m-nav__link-text">
                                                                Support
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
                <div class="m-portlet__body">
                    <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
                        <div class="m-widget4__item">
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-interface-3"></i>
                                </a>
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Make Metronic Great Again
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <span class="m-widget4__number m--font-accent">
                                    +500
                                </span>
                            </div>
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-folder-4"></i>
                                </a>
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Green Maker Team
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <span class="m-widget4__stats m--font-info">
                                    <span class="m-widget4__number m--font-accent">
                                        -64
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="m-widget4__item">
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-line-graph"></i>
                                </a>
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Make Apex Great Again
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <span class="m-widget4__stats m--font-info">
                                    <span class="m-widget4__number m--font-accent">
                                        +1080
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="m-widget4__item m-widget4__item--last">
                            <div class="m-widget4__ext">
                                <a href="#" class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-diagram"></i>
                                </a>
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    A Programming Language
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <span class="m-widget4__stats m--font-info">
                                    <span class="m-widget4__number m--font-accent">
                                        +19
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @break
    @default
    {{"Perfíl no encontrado"}}
    @endswitch
</div>
<script Language="Javascript">
    var d = [];
    d['v_widget1'] = JSON.parse(rhtmlspecialchars('{{ json_encode($widget["v_widget1"]) }}'));
    d['v_widget2'] = JSON.parse(rhtmlspecialchars('{{ json_encode($widget["v_widget2"]) }}'));
    d['v_widget3'] = JSON.parse(rhtmlspecialchars('{{ json_encode($widget["v_widget3"]) }}'));
</script>
<script src="{{ asset('js/menu/principal.js') }}"></script>

@endsection