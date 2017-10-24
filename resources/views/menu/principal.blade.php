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
<!-- END: Subheader -->
<div class="m-content">
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
    <!--End::Main Portlet-->
</div>
@endsection