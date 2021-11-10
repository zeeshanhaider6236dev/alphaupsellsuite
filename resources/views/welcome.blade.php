@extends('vendor.shopify-app.layouts.default')
@section('styles')
{{-- <link rel="stylesheet" href="{{ asset('css/daterangepicker.min.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
--}}
<style>
    /*.pagination{
        text-align:center;
    }*/
    .month-wrapper{
        width: 430px !important;
    }
</style>
<!-- Date Range Picker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .talk_to_expert
    {

        display: flex;
        color: white;
        height: 40px;
        width: 150px;
        background-color: #007bff;
        justify-content: center;
        align-items: center;
    }
    .talk_to_expert a
    {
        font-family: revert !important;
        color: white !important;
        text-decoration: none !important;
        font-weight: bold !important;
    }
    .box
    {
        background-color: white;
        padding: 20px 0px;

    }
    .more_help
    {
        text-align: center;
    }
    .dash_top h3
    {
        font-size: 15px;
    }
    #reportrange,#reportrange1
    {
        background: #fff;
        cursor: pointer;
        padding: 5px 10px; border: 1px solid #ccc;
        display: inline-block;
        width: 20%;
        float: right;
    }
    .productsBox .card {
        margin: 10px 0px;
    }
    .productsBox .card .table-responsive {
        border: 1px solid #dadada;
    }
    .blue-bg {
        background-color: #007bff;
        color: white;
    }
    .tab_bg_2 {
        padding: 5px;
    }
    .nav-tabs .nav-link:hover {
        cursor: pointer;
    }
    form.btnform {
        margin-top: 0px;
    }
    .nav-tabs {
        border-bottom: none;
    }
    .btnform input {
        border: none;
        background-color: #8f8fa51f;
    }
    .select2-container {
        width: 100% !important;
    }
    .productOverlay,
    .variantOverlay {
        width: 100%;
        height: 300px;
        background-color: #8f8fa51f;
        position: relative;
    }
    .productOverlay .fa-spinner,
    .variantOverlay .fa-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 50px;
        color: #007bff;
    }
    .productSearchButton {
        max-height: 40px;
    }
    .bg-blue {
        background-color: #007bff;
    }
    .sticky {
        position: fixed;
        top: 0;
        width: 98%;
        background: white;
        z-index: +1;
        margin-left: -5px;
    }
    .alpha_dash_2
    {
        flex-direction: column;
    }
    .alpha_FAQs_link
    {
        color:black;
    }
    /*#D4D4D4*/
    .alpha_FAQs_header
    {
        background-color:#f4f6f8;
    }
    .alpha_FAQs_list
    {
        list-style-type: none;
    }
    .alpha_FAQs_heading
    {
        font-weight: 600;
        font-size: 18px;
    }
    .alpha_card_heading
    {
        border:none!important;
    }
    .help-support
    {
        background-color: #f4f6f8;
    }
    .panel_defalt{
            border: 1px solid #ddd !important;
            margin-top: 5px !important;
            background: white !important;
        }
        .panel_head {
            margin-top: 5px;
            padding: 5px 15px 10px !important;
        }
        .panel_head h4 a{
            color: #383838 !important;
           font-size: 16px !important;
        }

        .panel_body {
            border-top: 1px solid #e3e3e3;
            padding: 15px 15px !important;
            font-size: 15px !important;

        }
        .faq_list_1{
            list-style: none !important;
            padding: 0px !important;
        }


    /* .accordion .card-header:after {
        font-family: 'FontAwesome';
        content: "\f068";
        float: right;
    }
    .accordion .card-header.collapsed:after {

    } */

    .panel-body.panel_body{
        /* background-color: #f4f6f8 !important; */
    }

    .panel-heading [data-toggle="collapse"]:after {
        font-weight: bold !important;
        content: "\2212" ;
        float: right;
        font-size: 25px !important;
    }
    .panel-heading [data-toggle="collapse"].collapsed:after {
        font-weight: bold !important;
        font-size: 25px !important;
        content: "+" ;
        font-family: "FontAwesome" ;
        float: right;
    }
</style>
@endsection
@section('content')
<div class="tabs">
    <div class="container-fluid tab_bg">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ ( request('tab') == null || request('tab') == 'home') ? 'active' : '' }}" data-toggle="tab" href="#home">
                    <i class="fa fa-tachometer-alt"></i>Dashboard
                </a>
            </li>
            <li class="nav-item createUpsellTab">
                <a class="nav-link createUpsellTab {{ request('tab') == 'menu1' ? 'active' : '' }}" data-toggle="tab" href="#menu1">
                    <i class="fab fa-joomla createUpsellTab"></i>Create Upsell
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request('tab') == 'menu2' ? 'active' : '' }}" data-toggle="tab" href="#menu2">
                    <i class="fas fa-list-alt"></i>List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('tab') == 'menu3' ? 'active' : '' }}" data-toggle="tab" href="#menu3">
                    <i class="fa fa-book"></i>FAQ's
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('tab') == 'menu4' ? 'active' : '' }}" data-toggle="tab" href="#menu4">
                    <i class="fa fa-question-circle"></i>Help & Support
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('tab') == 'menu5' ? 'active' : '' }}" data-toggle="tab" href="#menu5">
                    <i class="fa fa-dollar-sign"></i>Billing
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('tab') == 'menu6' ? 'active' : '' }}" data-toggle="tab" href="#menu6">
                    <i class="fas fa-play"></i>Tutorials
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" target="_blank" href="https://apps.shopify.com/alpha-upsell#modal-show=ReviewListingModal&st_campaign=rate-app&st_source=admin&utm_campaign=installed&utm_content=contextual&utm_medium=shopify&utm_source=admin">
                <i class="fas fa-star"></i> Write a Review
                </a>
            </li>

            <li class="talk_to_expert">
                <a class="" href="https://calendly.com/meetingwithalphaexpert/30min" target="_blank">
                    {{-- <i class="fa fa-dollar-sign"></i> --}}Book A Call
                </a>
            </li>
        </ul>
        <!----------------Tab-panes----------------->
        <div class="tab-content mt-3">
            <div id="home" class="tab-pane {{ ( request('tab') == null || request('tab') == 'home') ? 'active show' : '' }}">
                @unless($upsellCount)
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 upsel_heading p-0">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-md-12 upsel p-0">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="upsel_txt">
                                        <h2>Join 1,000+ merchants that sell more with ALPHA Upsell Suite..!</h2>
                                        <p>Create an Upsell/Cross-sell and boost sales in your store today. It only takes a minute.This
                                            is a great way to increase your average order value without leaving the page...!
                                        </p>
                                        <button class="glow createUpsellBtn">
                                            <i class="fa fa-plus"></i>Create Upsell
                                        </button>
                                        {{-- <a class="glow createUpsellBtn alpha_h_p_create {{ request('tab') == 'menu2' ? 'active' : '' }}" data-toggle="tab" href="#menu1">
                                            <i class="fa fa-plus"></i> Create Upsell
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="upsel_img">
                                        <img src="assets/img/bg.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="dash_top">
                        <h3>Performance Overview
                            <div id="reportrange">
                                <i class="fa fa-calendar"></i>&nbsp;
                                    <span>{{ \Carbon\Carbon::parse(request('from'))->format('d-m-Y') }} to {{ \Carbon\Carbon::parse(request('to'))->format('d-m-Y') }}</span>
                                <i class="fa fa-caret-down"></i>
                            </div>
                        </h3>
                    </div>
                    <div class="dash_2">
                        <div class="dashbox_1">
                            <p>Views <i class="fa fa-eye"></i></p>
                            <h3>
                                {{ $totalStats->totalViews ? $totalStats->totalViews : '0' }}
                            </h3>
                        </div>
                        <div class="dashbox_1">
                            <p>Add To Cart <i class="fas fa-luggage-cart"></i></p>
                            <h3>
                                {{ $totalStats->totalAddToCart ? $totalStats->totalAddToCart : '0' }}
                            </h3>
                        </div>
                        <div class="dashbox_1">
                            <p>Order <i class="far fa-credit-card"></i></p>
                            <h3>{{ $totalStats->totalOrders ? $totalStats->totalOrders : '0' }}</h3>
                        </div>
                        <div class="dashbox_1">
                            <p>Revenue <i class="fas fa-sack-dollar"></i></p>
                            <h3>
                                {{ $totalStats->totalRevenue ? $currency.' '.$totalStats->totalRevenue : $currency.'0' }}
                            </h3>
                        </div>
                        <div class="dashbox_1">
                            <p>Conversion Rate <i class="fas fa-chart-bar"></i></p>
                            <h3>
                                {{ $totalStats->totalViews ? number_format(($totalStats->totalOrders/$totalStats->totalViews)*100,2)."%" : '0 %' }}
                            </h3>
                        </div>
                    </div>
                    <div class="dash_2_chart container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div id="chartContainer" style="height: 400px; width:100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="dash_top">
                        <h3>Upsells Overview</h3>
                    </div>
                    <div class="dash_2">
                        <table width="100%" border="0" class="table table-striped table-bordered table_dash table-responsive">
							<tbody>
								<tr class="table_head">
									<th>Offer Name</th>
									<th>Upsell Type</th>
									<th>View</th>
									<th>Add To Cart</th>
									<th>Revenue</th>
									<th>Order</th>
									<th>Conversion Rate</th>
									<th>Priority</th>
									<th>Action</th>
									<th>Status</th>
								</tr>
                                @if($userUpsells->count() && !isset($dateWiseStats))
                                    @foreach ($userUpsells->take(5) as $key => $upsell)
                                        @php
                                            $totalViews   =  $upsell->upsellTotalViews->pluck('value')->sum();
                                            $totalATC     =  $upsell->upsellTotalAddToCart->pluck('value')->sum();
                                            $totalRevenue =  $upsell->upsellTotalRevenue->pluck('value')->sum();
                                            $totalOrders  =  $upsell->upsellTotalOrders->pluck('value')->sum();
                                        @endphp
                                        <tr id="{{ $upsell->id }}">
                                            <td>{{ $upsell->name }}</td>
                                            <td>{{ $upsell->upsellType->name }}</td>
                                            <td>{{ $totalViews }}</td>
                                            <td>{{ $totalATC }}</td>
                                            <td>{{ $currency.$totalRevenue }}</td>
                                            <td>{{ $totalOrders }}</td>
                                            <td>
                                            @if($totalATC && $totalViews > 0)
                                                {{ number_format(($totalOrders/$totalViews)*100,2)."%" }}
                                            @else
                                                {{ 0 }}
                                            @endif
                                            </td>
                                            <td>
                                                <select name="alphaUpsellPriority" id="alphaUpsellPriority" class="form-control">
                                                    <option value="1" {{ $upsell->priority == 1 ? "selected":'' }}>1     </option>
                                                    <option value="2" {{ $upsell->priority == 2 ? "selected":'' }}>2     </option>
                                                    <option value="3" {{ $upsell->priority == 3 ? "selected":'' }}>3     </option>
                                                    <option value="4" {{ $upsell->priority == 4 ? "selected":'' }}>4     </option>
                                                    <option value="5" {{ $upsell->priority == 5 ? "selected":'' }}>5     </option>
                                                    <option value="6" {{ $upsell->priority == 6 ? "selected":'' }}>6     </option>
                                                    <option value="7" {{ $upsell->priority == 7 ? "selected":'' }}>7     </option>
                                                    <option value="8" {{ $upsell->priority == 8 ? "selected":'' }}>8     </option>
                                                    <option value="9" {{ $upsell->priority == 9 ? "selected":'' }}>9     </option>
                                                    <option value="10" {{ $upsell->priority == 10 ? "selected":'' }}>10  </option>
                                                </select>
                                            </td>
                                            <td class="action_icon">
                                                <a href="{{ route('upsell.storefrontview', $upsell) }}" target="_blank">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="{{ route('upsell.edit',$upsell) }}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <i class="far fa-trash-alt alpha-upsell-delete" title="click to delete upsell"></i>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input alpha-upsell-request" data-id="{{ $upsell->id }}" id="fcustomSwitches{{ $key }}" {{ $upsell->status == 1 ? "checked":'' }}>
                                                    <label class="custom-control-label"  for="fcustomSwitches{{ $key }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @elseif(count($userUpsellsStats))
                                    @foreach ($userUpsellsStats->chunk(2) as $key => $upsellvalue)
                                        @foreach($upsellvalue as $upsell )
                                            <tr id="{{ $upsell->id }}">
                                                <td>{{ $upsell->name }}</td>
                                                <td>{{ $upsell->upsell_type_name }}</td>
                                                <td>{{ $upsell->totalViews }}</td>
                                                <td>{{ $upsell->totalAddToCart }}</td>
                                                <td>{{ $upsell->totalRevenue ? '$ '.$upsell->totalRevenue : '$ 0' }}</td>
                                                <td>{{ $upsell->totalOrders }}</td>
                                                <td>
                                                    @if($upsell->totalAddToCart && $upsell->totalViews > 0)
                                                        {{ number_format(($upsell->totalOrders/$upsell->totalViews)*100,2)."%" }}
                                                    @else
                                                        {{ 0 }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <select name="alphaUpsellPriority" id="alphaUpsellPriority" class="form-control">
                                                        <option value="1" {{ $upsell->priority == 1 ? "selected":'' }}>1     </option>
                                                        <option value="2" {{ $upsell->priority == 2 ? "selected":'' }}>2     </option>
                                                        <option value="3" {{ $upsell->priority == 3 ? "selected":'' }}>3     </option>
                                                        <option value="4" {{ $upsell->priority == 4 ? "selected":'' }}>4     </option>
                                                        <option value="5" {{ $upsell->priority == 5 ? "selected":'' }}>5     </option>
                                                        <option value="6" {{ $upsell->priority == 6 ? "selected":'' }}>6     </option>
                                                        <option value="7" {{ $upsell->priority == 7 ? "selected":'' }}>7     </option>
                                                        <option value="8" {{ $upsell->priority == 8 ? "selected":'' }}>8     </option>
                                                        <option value="9" {{ $upsell->priority == 9 ? "selected":'' }}>9     </option>
                                                        <option value="10" {{ $upsell->priority == 10 ? "selected":'' }}>10  </option>
                                                    </select>
                                                </td>
                                                <td class="action_icon">
                                                    <a href="{{ route('upsell.edit',$upsell->id) }}">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <i class="far fa-trash-alt alpha-upsell-delete" title="click to delete upsell"></i>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input alpha-upsell-request" data-id="{{ $upsell->id }}" id="customSwitches{{ $key }}" {{ $upsell->status == 1 ? "checked":'' }}>
                                                        <label class="custom-control-label"  for="customSwitches{{ $key }}"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @break
                                        @endforeach
                                    @endforeach
                                    {{-- @foreach ($userUpsellsStats->chunk(2) as $key => $upsell)
                                        <tr id="{{ $upsell->id }}">
                                            <td>{{ $upsell->name }}</td>
                                            <td>{{ $upsell->upsell_type_name }}</td>
                                            <td>{{ $upsell->totalViews }}</td>
                                            <td>{{ $upsell->totalAddToCart }}</td>
                                            <td>{{ $upsell->totalRevenue ? '$ '.$upsell->totalRevenue : '$ 0' }}</td>
                                            <td>{{ $upsell->totalOrders }}</td>
                                            <td>
                                                @if($upsell->totalAddToCart && $upsell->totalViews > 0)
                                                    {{ number_format(($upsell->totalOrders/$upsell->totalViews)*100,2)."%" }}
                                                @else
                                                    {{ 0 }}
                                                @endif
                                            </td>
                                            <td>
                                                <select name="alphaUpsellPriority" id="alphaUpsellPriority" class="form-control">
                                                    <option value="1" {{ $upsell->priority == 1 ? "selected":'' }}>1     </option>
                                                    <option value="2" {{ $upsell->priority == 2 ? "selected":'' }}>2     </option>
                                                    <option value="3" {{ $upsell->priority == 3 ? "selected":'' }}>3     </option>
                                                    <option value="4" {{ $upsell->priority == 4 ? "selected":'' }}>4     </option>
                                                    <option value="5" {{ $upsell->priority == 5 ? "selected":'' }}>5     </option>
                                                    <option value="6" {{ $upsell->priority == 6 ? "selected":'' }}>6     </option>
                                                    <option value="7" {{ $upsell->priority == 7 ? "selected":'' }}>7     </option>
                                                    <option value="8" {{ $upsell->priority == 8 ? "selected":'' }}>8     </option>
                                                    <option value="9" {{ $upsell->priority == 9 ? "selected":'' }}>9     </option>
                                                    <option value="10" {{ $upsell->priority == 10 ? "selected":'' }}>10  </option>
                                                </select>
                                            </td>
                                            <td class="action_icon">
                                                <a href="{{ route('upsell.edit',$upsell->id) }}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <i class="far fa-trash-alt alpha-upsell-delete" title="click to delete upsell"></i>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input alpha-upsell-request" data-id="{{ $upsell->id }}" id="customSwitches{{ $key }}" {{ $upsell->status == 1 ? "checked":'' }}>
                                                    <label class="custom-control-label"  for="customSwitches{{ $key }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                @else
                                    <tr>
                                        <td colspan="10" style="text-align:center">Upsells Not Created Yet...</td>
                                    </tr>
                                @endif
							</tbody>
					    </table>
                    </div>
                @endunless
            </div>
            <!-------------------tab-1-close, Menu1 start--------------------->
            <div id="menu1" class="tab-pane fade p-0 {{ request('tab') == 'menu1' ? 'active show' : '' }}"><br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 c_page">
                            <h2>Welcome to the ALPHA Upsell Suite..!!</h2>
                            <p>Use the app to create different Upsell/Cross-sell offers. Nudge shoppers to buy more and increase your sales.</p>
                        </div>
                    </div>
                </div>
              @php
                $upsellTypes->splice(4,1);
              @endphp
                @foreach ($upsellTypes->chunk(3) as $chunk)
                    <div class="container p-0">
                        <div class="col-md-12 c_page_box">
                            <div class="row">
                                @foreach ($chunk as $type)
                                    @if($type->name != config('upsell.strings.sale_notification_identifier'))
                                        <div class="col-md-4">
                                            <div class="box_1">
                                                <img src="{{ asset('assets'.$type->image) }}">
                                                <h3>{{ $type->name }}</h3>
                                                @if($saleNotificationUpsell && $type->name == config('upsell.strings.sale_notification_identifier'))
                                                    <a href="{{ route('upsell.edit',$saleNotificationUpsell) }}" class="c_page_btn_1">
                                                        <i class="fa fa-plus"></i>Edit
                                                    </a>
                                                @else
                                                    <a href="{{ route('create.upsell',$type) }}" class="c_page_btn_1">
                                                        <i class="fa fa-plus"></i>Create
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-------------------Tab-2-Close, Menu2 start--------------------->
        	<div id="menu2" class="container tab-pane fade p-0 {{ request('tab') == 'menu2' ? 'active show' : '' }}">
				<div class="dash_top">
					<h3>Upsells Overview
                        <div id="reportrange1">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span>{{ \Carbon\Carbon::parse(request('from'))->format('d-m-Y') }} to {{ \Carbon\Carbon::parse(request('to'))->format('d-m-Y') }}</span> <i class="fa fa-caret-down"></i>
                        </div>
                    </h3>
				</div>
				<div class="dash_2 alpha_dash_2" >
					<table width="100%" border="0" class="table table-striped table-bordered table_dash table-responsive">
						<tbody>
							<tr class="table_head">
								<th>Offer Name</th>
								<th>Upsell Type</th>
								<th>View</th>
								<th>Add To Cart</th>
								<th>Revenue</th>
								<th>Order</th>
								<th>Conversion Rate</th>
								<th>Priority</th>
								<th>Action</th>
								<th>Status</th>
							</tr>
                            @if($userUpsells->count() && !isset($dateWiseStats))
                                @foreach ($userUpsells as $key => $upsell)
                                    @php
                                        $totalViews   =  $upsell->upsellTotalViews->pluck('value')->sum();
                                        $totalATC     =  $upsell->upsellTotalAddToCart->pluck('value')->sum();
                                        $totalRevenue =  $upsell->upsellTotalRevenue->pluck('value')->sum();
                                        $totalOrders  =  $upsell->upsellTotalOrders->pluck('value')->sum();
                                    @endphp
                                    <tr id="{{ $upsell->id }}">
                                        <td>{{ $upsell->name }}</td>
                                        <td>{{ $upsell->upsellType->name }}</td>
                                        <td>{{ $totalViews }}</td>
                                        <td>{{ $totalATC }}</td>
                                        <td>{{ $currency.$totalRevenue }}</td>
                                        <td>{{ $totalOrders }}</td>
                                        <td>
                                            @if($totalATC && $totalViews > 0)
                                                {{ number_format(($totalOrders/$totalViews)*100,2)."%" }}
                                            @else
                                                {{ 0 }}
                                            @endif
                                        </td>
                                        <td>
                                            <select name="alphaUpsellPriority" id="alphaUpsellPriority" class="form-control">
                                                <option value="1" {{ $upsell->priority == 1 ? "selected":'' }}>1     </option>
                                                <option value="2" {{ $upsell->priority == 2 ? "selected":'' }}>2     </option>
                                                <option value="3" {{ $upsell->priority == 3 ? "selected":'' }}>3     </option>
                                                <option value="4" {{ $upsell->priority == 4 ? "selected":'' }}>4     </option>
                                                <option value="5" {{ $upsell->priority == 5 ? "selected":'' }}>5     </option>
                                                <option value="6" {{ $upsell->priority == 6 ? "selected":'' }}>6     </option>
                                                <option value="7" {{ $upsell->priority == 7 ? "selected":'' }}>7     </option>
                                                <option value="8" {{ $upsell->priority == 8 ? "selected":'' }}>8     </option>
                                                <option value="9" {{ $upsell->priority == 9 ? "selected":'' }}>9     </option>
                                                <option value="10" {{ $upsell->priority == 10 ? "selected":'' }}>10  </option>
                                            </select>
                                        </td>
                                        <td class="action_icon">
                                            <a href="{{ route('upsell.storefrontview', $upsell) }}" target="_blank">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a href="{{ route('upsell.edit',$upsell) }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <i class="far fa-trash-alt alpha-upsell-delete" title="click to delete upsell"></i>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input alpha-upsell-request" data-id="{{ $upsell->id }}" id="customSwitches{{ $key }}" {{ $upsell->status == 1 ? "checked":'' }}>
                                                <label class="custom-control-label"  for="customSwitches{{ $key }}"></label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif(isset($userUpsellsStats) && count($userUpsellsStats))
                                @foreach ($userUpsellsStats as $key => $upsell)
                                    <tr id="{{ $upsell->id }}">
                                        <td>{{ $upsell->name }}</td>
                                        <td>{{ $upsell->upsell_type_name }}</td>
                                        <td>{{ $upsell->totalViews }}</td>
                                        <td>{{ $upsell->totalAddToCart }}</td>
                                        <td>{{ $upsell->totalRevenue ? '$ '.$upsell->totalRevenue : '$ 0' }}</td>
                                        <td>{{ $upsell->totalOrders }}</td>
                                        <td>
                                            @if($upsell->totalAddToCart && $upsell->totalViews > 0)
                                                {{ number_format(($upsell->totalOrders/$upsell->totalViews)*100,2)."%" }}
                                            @else
                                                {{ 0 }}
                                            @endif
                                        </td>
                                        <td>
                                            <select name="alphaUpsellPriority" id="alphaUpsellPriority" class="form-control">
                                                <option value="1" {{ $upsell->priority == 1 ? "selected":'' }}>1     </option>
                                                <option value="2" {{ $upsell->priority == 2 ? "selected":'' }}>2     </option>
                                                <option value="3" {{ $upsell->priority == 3 ? "selected":'' }}>3     </option>
                                                <option value="4" {{ $upsell->priority == 4 ? "selected":'' }}>4     </option>
                                                <option value="5" {{ $upsell->priority == 5 ? "selected":'' }}>5     </option>
                                                <option value="6" {{ $upsell->priority == 6 ? "selected":'' }}>6     </option>
                                                <option value="7" {{ $upsell->priority == 7 ? "selected":'' }}>7     </option>
                                                <option value="8" {{ $upsell->priority == 8 ? "selected":'' }}>8     </option>
                                                <option value="9" {{ $upsell->priority == 9 ? "selected":'' }}>9     </option>
                                                <option value="10" {{ $upsell->priority == 10 ? "selected":'' }}>10  </option>
                                            </select>
                                        </td>
                                        <td class="action_icon">
                                            <a href="{{ route('upsell.edit',$upsell->id) }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <i class="far fa-trash-alt alpha-upsell-delete" title="click to delete upsell"></i>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input alpha-upsell-request" data-id="{{ $upsell->id }}" id="customSwitches{{ $key }}" {{ $upsell->status == 1 ? "checked":'' }}>
                                                <label class="custom-control-label"  for="customSwitches{{ $key }}"></label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" style="text-align:center">Upsells Not Created Yet...</td>
                                </tr>
                            @endif
						</tbody>
					</table>
                    @if($userUpsells->count() && !isset($dateWiseStats))
                        {{ $userUpsells->links() }}
                    @elseif(isset($userUpsellsStats) && count($userUpsellsStats))
                        {{ $userUpsellsStats->links() }}
                    @endif
				</div>
			</div>
            <!-------------------Tab-3-Clsoe, Menu3 Start--------------------->
            <div id="menu3" class="tab-pane fade {{ request('tab') == 'menu3' ? 'active show' : '' }}"><br>
                <div class="container faq p-0">
                    <div class="panel-group" id="accordion">
                        <!----------------1---------------------------->
                        <div class="panel panel-default panel_defalt" >
                            <div class="panel-heading panel_head" data-toggle="collapse"
                            data-target="#collapseOne" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> When does the app show?</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body panel_body">
                                    <p class="alpha_FAQs_heading">Depends on your selection.</p>
                                    <ul class="faq_list_1">
                                    <li>
                                        <p>If you selected Product page:</p>
                                        <ul class="faq_list_1">
                                        <li>It shows after customers click ADD TO CART  in your cart page or cart drawer.</li>
                                        </ul>
                                    </li>
                                    <li>
                                    <p>If you selected thank you page:</p>
                                        <ul class="faq_list_1">
                                            <li> It shows after customers COMPLETE A PURCHASE in your store on top of your thank you page.</li>
                                        </ul>
                                    </li>
                                    </ul>
                                    <p>Have more questions? send us a message through the chat. Cheers for more sales!</p>
                                </div>
                            </div>
                        </div>
                        <!----------------2---------------------------->
                        <div class="panel panel-default panel_defalt" data-toggle="#collapsetwo">
                            <div class="panel-heading panel_head" data-toggle="collapse"
                            data-target="#collapsetwo" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsetwo"> Product page funnel does not show?</a>
                                </h4>
                            </div>
                            <div id="collapsetwo" class="panel-collapse collapse in">
                                <div class="panel-body panel_body">
                                     <p class="alpha_FAQs_heading">Follow these steps to troubleshoot your Product page upsell:</p class="alpha_FAQs_heading">
                                                <ul class="faq_list_1">
                                                    <li>
                                                        <p>Click on "preview" in your funnels list</p>
                                                        <ul class="faq_list_1">
                                                            <li>Does the funnel show?</li>
                                                            <li>If not - <a href="#">here's how to fix it.</a></li>
                                                            <li>If you see the funnel, move on to the next step.</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <p>Head over to your store, and click on "Add to cart"</p>
                                                        <ul class="faq_list_1">
                                                            <li>Does your page redirect?</li>
                                                            <li>Is your customer immediately redirected to checkout or your cart page?</li>
                                                            <li>If so - we will not interfere with your store navigation, so you might see the funnel for a split second or not at all.</li>
                                                            <li>It's too risky to hold that navigation as some information might get lost in the process.</li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <p>2 options here</p>
                                                        <ul class="faq_list_1">
                                                            <li>Open a drawer cart / drawer modal instead of redirecting customers out of the product page</li>
                                                            <li>Change your funnels to be cart page funnels instead.</li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <p>Do customers stay on your product page after clicking "add to cart"?</p>
                                                    </li>
                                                </ul>
                                </div>
                            </div>
                        </div>
                        <!----------------3---------------------------->
                        <div class="panel panel-default panel_defalt">
                            <div class="panel-heading panel_head" data-toggle="collapse"
                            data-target="#collapsethree" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsethree"> What counts as a view?</a>
                                </h4>
                            </div>
                            <div id="collapsethree" class="panel-collapse collapse in">
                            <div class="panel-body panel_body">
                                <ul class="faq_list_1">
                                    <li>Each plan provides a certain number of views. One view is a single display of the offer to a customer.  For instance, when a customer clicks 'Checkout' and an upsell offer is triggered and displayed to the customer, that is counted as a view.</li>
                                    <li>Each Upsell funnel still counts as one view regardless of how many offers your customer sees.</li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <!----------------4---------------------------->
                        <div class="panel panel-default panel_defalt">
                            <div class="panel-heading panel_head" data-toggle="collapse"
                            data-target="#collapsefour" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsefour">Can I have an offer shown on mobile?</a>
                                </h4>
                            </div>
                            <div id="collapsefour" class="panel-collapse collapse in">
                                <div class="panel-body panel_body">
                                   <ul class="alpha_FAQs_list">
                                        <li>Yes, all offers are displayed on all types of screens. You can even create offers solely for mobile and/or desktop view. This option is available during the Funnel creation in "Advanced settings"</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!----------------53---------------------------->
                        <div class="panel panel-default panel_defalt">
                            <div class="panel-heading panel_head" data-toggle="collapse"
                            data-target="#collapsefive" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsefive"> How will the orders be processed?</a>
                                </h4>
                            </div>
                            <div id="collapsefive" class="panel-collapse collapse in">
                                <div class="panel-body panel_body">
                                     <ul class="alpha_FAQs_list">
                                        <li>There is no built-in checkout processor so customers who add/replace products via Offers will be redirected to the payment gateway set up in your Shopify store.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- ------------------------6------------------- -->
                        <div class="panel panel-default panel_defalt">
                            <div class="panel-heading panel_head" data-toggle="collapse"
                            data-target="#collapsesix" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsesix">What is a Draft order?</a>
                                </h4>
                            </div>
                            <div id="collapsesix" class="panel-collapse collapse in">
                                <div class="panel-body panel_body">
                                    <ul class="alpha_FAQs_list">
                                        <li>Draft orders can be created in Shopify to manually configure an order and send that order to a customer to allow them to check out</li>
                                        <li>They are listed in Orders > Drafts</li>
                                        <li>Draft Orders allow for more flexible applications of discounts to products. They can also be programmatically created. This is why the ALPHA app (as well as many other discount apps on Shopify) leverage Draft Orders.</li>
                                        <li>The app does not prepare a Draft order when the user clicks the checkout button and No discount applied!  When no Discount promotions have been applied, the app will leverage the "standard" checkout!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- ------------------------7------------------------- -->
                        <div class="panel panel-default panel_defalt">
                            <div class="panel-heading panel_head" data-toggle="collapse"
                            data-target="#collapseseven" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseseven"> What is different about a checkout that is created based on a Draft Order?</a>
                                </h4>
                            </div>
                            <div id="collapseseven" class="panel-collapse collapse in">
                                <div class="panel-body panel_body">
                                    <p class="alpha_FAQs_heading">The key differences between a "standard" checkout and checkout that is prepared by Shopify based on a Draft Order are</p>
                                    <ul class="alpha_FAQs_list">
                                        <li><b>No discount code field is available at checkout.</b> ALPHA provides a solution if you need a discount code field. You can add a custom promotion code field to the cart page</li>
                                        <li><b>No "back to cart" link or "home page link" is available.</b> Unfortunately, these links are not available due to the limitations of the Shopify APIs.</li>
                                        <li><b>Shopify Plus scripts are not executed</b> on draft order checkouts. Use our free Sales Channel companion app to work around this.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- ---------------8-------------------- -->
                        <div class="panel panel-default panel_defalt">
                            <div class="panel-heading panel_head"data-toggle="collapse"
                            data-target="#collapseeight" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseeight">  Can I remove the Draft orders?</a>
                                </h4>
                            </div>
                            <div id="collapseeight" class="panel-collapse collapse in">
                                <div class="panel-body panel_body">
                                    <ul class="alpha_FAQs_list">
                                        <li>Yes, all Draft orders created by the app can be safely removed.</li>
                                        <li>You can also configure the app to automatically remove the Draft orders (with a small delay) from the Settings > General > Advanced menu</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- --------------9------------------->
                        <div class="panel panel-default panel_defalt">
                            <div class="panel-heading panel_head" data-toggle="collapse"
                            data-target="#collapsenine" style="cursor:pointer;">
                                <h4 class="panel-title">
                                   <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsenine">Checkout page missing a discount box?</a>
                                </h4>
                            </div>
                            <div id="collapsenine" class="panel-collapse collapse in">
                                <div class="panel-body panel_body">
                                    <ul class="alpha_FAQs_list">
                                        <li>You're right - when the checkout is opened from the upsell app, customers can not add additional discount codes.</li>
                                        <li>It's similar to trying to use 2 coupon codes in the checkout.</li>
                                        <li>Shopify would not accept multiple discounts codes on a single order.</li>
                                        <li>It works this way because of the way we use discounts.</li>
                                    </ul>
                                    <p>With ALPHA, you do not need to manage discount codes for your upsell discounts, they are applied on the fly</p>
                                </div>
                            </div>
                        </div>
                        <!-- -------------- -->
                    </div>
                </div>
            </div>
            <!------------------Tab-4-Clsoe, Menu4 Start---------------------->
            <div id="menu4" class="container tab-pane fade p-0 {{ request('tab') == 'menu4' ? 'active show' : '' }}">
                <div class="card">
                    <div class="card-body help-support">
                        <form>
                          <div class="form-group">
                            <label for="alpha-upsell-contact-email">Email address</label>
                            <input type="email" class="form-control" id="alpha-upsell-contact-email" placeholder="name@example.com">
                          </div>
                          <div class="form-group">
                            <label for="alpha-upsell-contact-us-subject">Subject</label>
                            <input type="text" class="form-control" id="alpha-upsell-contact-us-subject" placeholder="example...">
                          </div>
                          <div class="form-group">
                            <label for="alpha-upsell-contact-us-message">Message</label>
                            <textarea class="form-control" id="alpha-upsell-contact-us-message" rows="3"></textarea>
                          </div>
                          <div class="form-group">
                            <a href="#" class="btn glow text-light">Send</a>
                          </div>
                        </form>
                        <div class="container more_help">
                            <h4>Need More Help..?</h4>
                            <p>Get in Touch:</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box">
                                        <a href="https://www.facebook.com/ALPHA-upsell-Suite-100646532312483" class="contact-us-btn" target="_blank" style="COLOR: black; text-decoration:none">
                                        <img src="{{asset('assets/img//fb.png')}}">
                                        <h4>FaceBook</h4>
                                        <p>Send us a message and we'll help you out.</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box">
                                        <a href="https:////web.whatsapp.com/send?phone=923143216236&amp;text={{auth()->user()->name}}%20Needs%20Help%20in%20Facebook%20Pixel%20?%20" class="contact-us-btn" target="_blank" style="COLOR: black; text-decoration:none">
                                        <img src="{{asset('assets/img//WhatsApp-icon.png')}}">
                                        <h4>Whatsapp</h4>
                                        <p>Tell us more and we'll help you get there.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!------------------Tab-5-Clsoe, Menu5 Start --------------------->
            <div id="menu5" class="container tab-pane fade p-0 {{ request('tab') == 'menu5' ? 'active show' : '' }}">
                <div class="container">
                    <div class="col-md-12 upsel_price">
                        {{-- <h2>Welcome to Alpha Upsell Suite-Important Message
                            <span>
                                <a href="#" class="float-right">
                                    <button type="button" class="save mb-3 butn_p">Let's Go!</button>
                                </a>
                            </span>
                        </h2> --}}
                        <div class="price_p">
                            <p>The app is completely free if you have less than 50 orders per month
                                <span>
                                    Pricing is based on the total orders in the store, not generated by the app.
                                </span>
                            </p>
                            {{-- <p>In the next page, you will approve changes for the highest possibble plan (up to $1,999.99/monthly).</p> --}}
                            {{-- <p>
                                <span>Pricing is based on the total orders in the store, not generated by the app.</span>
                            </p> --}}
                            <div class="alert alert-warning" role="alert">
                              <h4 style="color: black;">Example</h4>
                              <p>You had 470 orders in the last 30 days and 50 of then were generated from Alpha Upsell Suite, you will be charged according to the 470 orders - $ 29.99</p>
                            </div>
                            <div class="alert alert-danger" role="alert">
                              <h4 style="color: black;">Warning</h4>
                              <p>
                                  Our pricing is according to the number of total orders in your store, not only the orders that were generated by the Alpha Upsell Suite. <a href="{{ asset('assets/img/billing.png') }}" target="_blank">https://prnt.sc/1c68kum</a>
                              </p>
                            </div>
                        </div>
                        <div class="price_table">
                            <table width="100%" border="0" class="table table-striped table-bordered table_dash table-responsive">
                                <tbody>

                                    <tr class="table_head_price">
                                        <th>Orders Per Month</th>
                                        <th>Features</th>
                                        <th>Price</th>
                                    </tr>

                                    <tr>
                                        <td>0 - 50</td>
                                        <td>Full Features</td>
                                        <td>Free</td>
                                    </tr>

                                    <tr>
                                        <td>51 - 100</td>
                                        <td>Full Features</td>
                                        <td>$7.99</td>
                                    </tr>

                                    <tr>
                                        <td>101 - 200</td>
                                        <td>Full Features</td>
                                        <td>$14.99</td>
                                    </tr>

                                    <tr>
                                        <td>201 - 500</td>
                                        <td>Full Features</td>
                                        <td>$29.99</td>
                                    </tr>

                                    <tr>
                                        <td>501 - 1,000</td>
                                        <td>Full Features</td>
                                        <td>$49.99</td>
                                    </tr>

                                    <tr>
                                        <td>1,001 - 2,000</td>
                                        <td>Full Features</td>
                                        <td>$89.99</td>
                                    </tr>

                                    <tr>
                                        <td>2.001 - 5,000</td>
                                        <td>Full Features</td>
                                        <td>$139.99</td>
                                    </tr>

                                    <tr>
                                        <td>5,001 - 10,000</td>
                                        <td>Full Features</td>
                                        <td>$169.99</td>
                                    </tr>

                                    <tr>
                                        <td>10,001 - 20,000</td>
                                        <td>Full Features</td>
                                        <td>$199.99</td>
                                    </tr>

                                    <tr>
                                        <td>20,001 - 50,000</td>
                                        <td>Full Features</td>
                                        <td>$249.99</td>
                                    </tr>

                                    <tr>
                                        <td>50,001 - 100,000</td>
                                        <td>Full Features</td>
                                        <td>$349.99</td>
                                    </tr>

                                    <tr>
                                        <td>100,000 +</td>
                                        <td>Full Features</td>
                                        <td>Contact us</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="price_btn">
                            <a href="#"><button type="button" class="save mb-3 butn_p">Let's Go!</button></a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!------------------Tab-5-Clsoe, Menu۶ Start --------------------->
            <div id="menu6" class="container-fluid tab-pane fade p-0 {{ request('tab') == 'menu6' ? 'active show' : '' }}">
                <div class="row">
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/LUFDRB9flRo" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/1.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/CoXPGIaifwQ" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/2.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/aU7EStux9aY" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/3.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/_nBZNMLEPuY" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/4.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/RTT0t7WM22g" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/5.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/U_MkoqnmBWM" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/6.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/bVlhMewt8pg" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/7.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/_nBZNMLEPuY" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/8.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/o4NBS3WuBEk" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/9.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/XiztGbS1dGE" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/10.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 upsel_price">
                        <a href="https://youtu.be/GDt1vCJDtu0" target="_blank">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="{{asset('assets/images/11.jpg')}}" alt="Card image cap">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Messenger Chat Plugin Code -->
        <div id="fb-root"></div>

        <!-- Your Chat Plugin code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>
    </div>
@endsection
@section('scripts')
@parent
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

{{-- <script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/jquery.daterangepicker.min.js') }}"></script>
 --}}

{{-- Date Picker JS CDN --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>


    // $('.dateInputFrom').dateRangePicker({
    //     format:'DD-MM-YYYY'
    // }).on('datepicker-apply',function(event,obj){
    //     let dates = obj.value.split(" to ");
    //     location.href = `${location.origin}${location.pathname}?from=${moment(dates[0],'DD-MM-YYYY').format('YYYY/MM/DD')}&to=${moment(dates[1],'DD-MM-YYYY').format('YYYY/MM/DD')}`
    // });



    $(function() {

        const urlParams = new URLSearchParams(window.location.search)

        if(urlParams.get('from'))
        {
           var start = moment(urlParams.get('from'))
           var end   = moment(urlParams.get('to'));
        }
        else
        {
            var start = moment().subtract(29, 'days');
            var end   = moment();
        }
        function cb(start, end) {
            // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            const params = new URLSearchParams(window.location.search)
            if(params.get('tab'))
            {
                var newparams = '&tab='+params.get('tab')
                params.delete('tab')
                location.href = `${location.origin}${location.pathname}?from=${start.format('YYYY/MM/DD')}&to=${end.format('YYYY/MM/DD')}`+newparams
            }
            else
            {
               location.href = `${location.origin}${location.pathname}?from=${start.format('YYYY/MM/DD')}&to=${end.format('YYYY/MM/DD')}`
            }
        }
        $('#reportrange').daterangepicker({

            startDate :start,
            endDate:end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        $('#reportrange1').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
    });

    var graphData = [
            @foreach ($graphData as $single)
                {!! '["'.$single->upsell_created_at.'",'. $single->totalViews.','. $single->totalAddToCart.','. $single->totalRevenue.','. $single->totalOrders.'],' !!}
            @endforeach
          ]
    var chart;
    var data;
    var options;
    let chart_flag = false;
    let clickCount = 0;
    @if($upsellCount && count($graphData))
        let params = new URLSearchParams(document.location.search.substring(1));
        let tab   = params.get("tab"); // is the string "Jonathan"

        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          data = new google.visualization.DataTable();
          data.addColumn('string', 'Date');
          data.addColumn('number', 'Views');
          data.addColumn('number', 'Add To Cart');
          data.addColumn('number', 'Revenue');
          data.addColumn('number', 'Orders');
          data.addRows(graphData);
          options = {
            chart: {
              title: 'Statistics',
              subtitle: ''
            },
          };
          chart = new google.charts.Line(document.getElementById('chartContainer'));
          if(tab == null || tab == "home")
          {
            chart.draw(data, google.charts.Line.convertOptions(options));
            chart_flag = true
          }
        }
        $('.nav-link').on('click', function(event){
            if(!chart_flag && clickCount == 0)
            {
                console.log('if part is executed')

                let navLink = $(this).attr('href')
                if(navLink.split('#')[1] == 'home')
                {
                    setTimeout(()=>{
                        chart.draw(data, google.charts.Line.convertOptions(options));
                    },200)
                    clickCount += 1;

                }

            }
            else
            {
                console.log('else part is executed')
            }
            // setTimeout(()=>{
            //     chart.draw(data, google.charts.Line.convertOptions(options));
            // },200)
        });

    @else
        $(document).on('click','.createUpsellBtn',function(){
            $('.createUpsellTab').trigger('click');
        });
    @endif


    $(function(){
        $('[name=alphaUpsellPriority]').on('change',function(e){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'info',
                title: 'Being Updated...'
            })
            var alphaUpsellId = e.target.closest('tr').id;
            var alphaUpsellPriority = $(this).val();
            var data = {
                'upsellId': alphaUpsellId,
                'priority': alphaUpsellPriority

            }
            $.ajax({
                    url: "{{ route('upsell.setPriority') }}",
                    data: data,
                    method: "post",
                    success: function(response){
                        console.log(response.status);
                        if(response.status == true)
                        {
                            messages(response)
                        }
                    }
                });
        });
    });
    $(function(){
        $('.alpha-upsell-request').on('change',function(e){
            if($(e.target).data('id') != 'undefined')
            {
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                Toast.fire({
                    icon: 'info',
                    title: 'Being Updated...'
                })
                var upsellId = $(e.target).data('id');
                var data = {
                    'upsellId': upsellId
                }
                $.ajax({
                    url: "{{ route('upsell.updateStatus') }}",
                    data: data,
                    method: "post",
                    success: function(response){
                        if(response.status == true)
                        {
                            messages(response)
                        }
                    }
                });
            }
        });
        $('.alpha-upsell-delete').on('click',function(e){
            alphaUpsellId = e.target.closest('tr').id;
            var data = {
                    'upsellId': alphaUpsellId
                }
            $.ajax({
                url: "{{ route('upsell.delete') }}",
                data: data,
                method: "post",
                success: function(response){
                    if(response.status == true)
                    {
                        e.target.closest('tr').remove();
                        messages(response);
                    }
                }
            });
        });
        $('.nav-link').click(function(){
            let navLink = $(this).attr('href')
            navLink.split('#')
            insertUrlParam('tab',navLink.split('#')[1])
        })
    });

    function insertUrlParam(key, value) {
        if (history.pushState) {
            let searchParams = new URLSearchParams(window.location.search);
            searchParams.set(key, value);
            let newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + searchParams.toString();
            window.history.pushState({path: newurl}, '', newurl);
        }
    }

</script>



    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100646532312483");
      chatbox.setAttribute("attribution", "setup_tool");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>



@endsection
