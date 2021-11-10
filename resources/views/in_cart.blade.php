@extends('vendor.shopify-app.layouts.default')
@section('content')
@include('includes.upsell_header')
<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 tabs">
            <div class="tabs">
                <div class="tab_bg">
                    <form class="upsellForm">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">
                                    <i class="fas fa-cogs"></i>Configuration
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu1">
                                    <i class="fa fa-image"></i>Preview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu-fbt-video">
                                <i class="fas fa-video"></i>Video Guide
                                </a>
                             </li>
                        </ul>
                        <!----------------Tab-panes----------------->
                        <div class="tab-content mt-3">
                            <div id="home" class="tab-pane active">
                                <div class="container offer">
                                    <div class="row">
                                        <div class="col-md-5 offer_left">
                                            <h4>Offer Name</h4>
                                            <p>This is an internal name and won't appear on the frontend.</p>
                                        </div>
                                        <div class="col-md-7 offer_right">
                                            <label for="offer_name">Name : </label><br>
                                            @php
                                                if(isset($upsell)):
                                                    $name = $upsell['name'];
                                                else:
                                                    $name = '';
                                                endif;
                                            @endphp
                                            <input type="text" placeholder="Enter Offer Name...!!" id="offer_name" name="name" value="{{ $name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-5 offer_left">
                                            <h4>Select Target Products</h4>
                                            <p>
                                            Target products are those products, on which you want to show an offer. When customer will add these products to cart, then offer will be shown on those products.
                                            </p>
                                        </div>
                                        <div class="col-md-7 offer_right select_bg">
                                            <div class="row mt-2">
                                                <div class="col-md-4 select_left">
                                                    <h3>Upsell will Trigger on...</h3>
                                                </div>
                                                <div class="col-md-8 select_right">
                                                    <button type="button" class="save pickTProduct" data-toggle="modal"
                                                    data-target="#product_modal">Pick a Product</button>
                                                    <button type="button" class="cancel removeAll">Remove All</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="pickedTriggerOn itemContainer">
                                            @isset($upsell)
                                            @if($upsell->Tproducts->count())
                                                @foreach ($upsell->Tproducts as $tProduct)
                                                    <div class="box_shado mt">
                                                        <input class="tabValues" type="hidden" name="Tproducts[]" value="{{ $tProduct->shopify_product_id }}">
                                                        <input class="tabValues" type="hidden" name="Tproductsimages[]" value="{{ $tProduct->shopify_product_image }}">
                                                        <input class="tabValues" type="hidden" name="Tproductstitles[]" value="{{ $tProduct->shopify_product_title }}">
                                                        <div class="row">
                                                            <div class="img_box col-md-2">
                                                                <img src="{{  $tProduct->shopify_product_image }}">
                                                            </div>
                                                            <div class="img_name col-md-8">
                                                                <p>{{  $tProduct->shopify_product_title }}
                                                                </p>
                                                            </div>
                                                            <div class="img_btn col-md-2">
                                                                <button type="button" class="delete float-right deleteItem">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @elseif($upsell->Tcollections->count())
                                                @foreach ($upsell->Tcollections as $tCollection)
                                                    <input class="tabValues" type="hidden" name="Tcollections[]" value="{{ $tCollection->shopify_collection_id }}">
                                                    <input class="tabValues" type="hidden" name="Tcollectionsimages[]" value="{{ $tCollection->shopify_collection_image }}">
                                                    <input class="tabValues" type="hidden" name="Tcollectionstitles[]" value="{{ $tCollection->shopify_collection_title }}">
                                                    <div class="box_shado mt">
                                                        <div class="row">
                                                            <div class="img_box col-md-2">
                                                                <img src="{{  $tCollection->shopify_collection_image }}">
                                                            </div>
                                                            <div class="img_name col-md-8">
                                                                <p>{{  $tCollection->shopify_collection_title }}
                                                                </p>
                                                            </div>
                                                            <div class="img_btn col-md-2">
                                                                <button type="button" class="delete float-right deleteItem">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @elseif($upsell->Ttags->count())
                                                @foreach ($upsell->Ttags as $tTags)
                                                    <div class="box_shado mt">
                                                        <input class="tabValues" type="hidden" name="Ttags[]" value="{{ $tTags->shopify_tag_id }}">
                                                        <input class="tabValues" type="hidden" name="Ttagsimages[]" value="{{ $tTags->shopify_tag_image }}">
                                                        <input class="tabValues" type="hidden" name="Ttagstitles[]" value="{{ $tTags->shopify_tag_title }}">
                                                        <div class="row">
                                                            <div class="img_box col-md-2">
                                                                <img src="{{  $tTags->shopify_tag_image }}">
                                                            </div>
                                                            <div class="img_name col-md-8">
                                                                <p>{{  $tTags->shopify_tag_title }}
                                                                </p>
                                                            </div>
                                                            <div class="img_btn col-md-2">
                                                                <button type="button" class="delete float-right deleteItem">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container upsel_p">
                                    <div class="row">
                                        <div class="col-md-5 offer_left">
                                            <h4>Select Upsell Products</h4>
                                            <p>
                                            Upsell products are those products, which you want to show in the offer. When customers will add targeted products to cart, then upsell products will be shown in the offer.
                                            </p>
                                        </div>
                                        <div class="col-md-7 offer_right select_bg">
                                            <div class="row mt-2">
                                                <div class="col-md-4 select_left">
                                                    <h3>Upsell will Appear on...</h3>
                                                </div>
                                                <div class="col-md-8 select_right">
                                                    <button type="button" class="save pickAProduct" data-toggle="modal"
                                                    data-target="#product_modal">Pick a Product</button>
                                                    <button type="button" class="cancel removeAll">Remove All</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="pickedAppearOn itemContainer">
                                                @isset($upsell)
                                                    @if($upsell->Aproducts->count())
                                                        @foreach ($upsell->Aproducts as $aProduct)
                                                            <div class="box_shado mt">
                                                                <input class="tabValues" type="hidden" name="Aproducts[]" value="{{ $aProduct->shopify_product_id }}">
                                                                <input class="tabValues" type="hidden" name="Aproductsimages[]" value="{{ $aProduct->shopify_product_image }}">
                                                                <input class="tabValues" type="hidden" name="Aproductstitles[]" value="{{ $aProduct->shopify_product_title }}">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{ $aProduct->shopify_product_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{ $aProduct->shopify_product_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @elseif($upsell->Acollections->count())
                                                        @foreach ($upsell->Acollections as $aCollection)
                                                            <div class="box_shado mt">
                                                                <input class="tabValues" type="hidden" name="Acollections[]" value="{{ $aCollection->shopify_collection_id }}">
                                                                <input class="tabValues" type="hidden" name="Acollectionsimages[]" value="{{ $aCollection->shopify_collection_image }}">
                                                                <input class="tabValues" type="hidden" name="Acollectionstitles[]" value="{{ $aCollection->shopify_collection_title }}">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{ $aCollection->shopify_collection_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{ $aCollection->shopify_collection_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @elseif($upsell->Atags->count())
                                                        @foreach ($upsell->Atags as $aTags)
                                                            <div class="box_shado mt">
                                                                <input class="tabValues" type="hidden" name="Atags[]" value="{{ $aTags->shopify_tag_id }}">
                                                                <input class="tabValues" type="hidden" name="Atagsimages[]" value="{{ $aTags->shopify_tag_image }}">
                                                                <input class="tabValues" type="hidden" name="Atagstitles[]" value="{{ $aTags->shopify_tag_title }}">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{ $aTags->shopify_tag_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{ $aTags->shopify_tag_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container offer">
                                    <div class="row">
                                        <div class="col-md-5 offer_left">
                                            <h4>Optional Settings</h4>
                                            <p></p>
                                        </div>
                                        <div class="col-md-7 select_bg display">
                                            <h4>Work on device:</h4>
                                            <p>
                                                <div class="row">
                                                    <div class="form-check form_float ml-3">
                                                        @php
                                                            if(isset($upsell)):
                                                                $work_on_desktop = $upsell['setting']['work_on_desktop'];
                                                            else:
                                                                $work_on_desktop = $upsellType->setting['work_on_desktop'];
                                                            endif;
                                                        @endphp
                                                        <input {{ $work_on_desktop == 1 ? "checked" : '' }} name="work_on_desktop" type="checkbox" class="form-check-input" id="formCheck-1"
                                                        style="height: 20px;" value="1" checked>
                                                        <label class="form-check-label" for="formCheck-1">Desktop</label>
                                                    </div>
                                                    <div class="form-check form_float">
                                                        @php
                                                            if(isset($upsell)):
                                                                $work_on_mobile = $upsell['setting']['work_on_mobile'];
                                                            else:
                                                                $work_on_mobile = $upsellType->setting['work_on_mobile'];
                                                            endif;
                                                        @endphp
                                                        <input {{ $work_on_mobile == 1  ? "checked" : '' }} name="work_on_mobile" type="checkbox" class="form-check-input" id="formCheck-3"
                                                        style="height: 20px;" value="1" checked>
                                                        <label class="form-check-label" for="formCheck-3">Mobile</label>
                                                    </div>
                                                </div>
                                            </p>
                                            <hr>
                                            <h4>Schedule:</h4>
                                            <div class="row">
                                                <div class="col-md-6 discount_left">
                                                    <label>Start Date:</label><br>
                                                    @php
                                                    if(isset($upsell)):
                                                        $start_date = $upsell['setting']['start_date'];
                                                    else:
                                                        $start_date = \Carbon\Carbon::now()->format('Y-m-d');
                                                    endif;
                                                    @endphp
                                                    <input value="{{ $start_date }}" name="start_date" type="date">
                                                </div>
                                                <div class="col-md-6 discount_left">
                                                    <label>End Date:</label><br>
                                                    <input class="end_date" name="end_date" type="date" style="background-color: #dadada;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-------------------tab-1-close--------------------->
                            <div id="menu1" class="tab-pane fade p-0"><br>
                                <div class="container-fluid">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="design_input">
                                                    <h3>Title</h3>
                                                    <p class="h_input">
                                                        <label>Heading</label><br>
                                                        @php
                                                            if(isset($upsell)):
                                                                $incart_heading = $upsell['setting']['incart_heading'];
                                                            else:
                                                                $incart_heading = $upsellType->setting['incart_heading'];
                                                            endif;
                                                        @endphp
                                                        <input type="text" value="{{ $incart_heading }}" name="incart_heading">
                                                    </p>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <p class="f_input">
                                                                <label>Font family</label><br>
                                                                <select name="heading_font_family">
                                                                    @foreach (config('upsell.strings.fontFamily') as $family)
                                                                    <option
                                                                        @if(isset($upsell))
                                                                            @if($upsell['setting']['heading_font_family'] == $family)
                                                                                {{"selected"}}
                                                                            @endif
                                                                        @elseif($upsellType->setting['heading_font_family'] == $family)
                                                                            {{"selected"}}
                                                                        @endif
                                                                    value="{{ $family }}">
                                                                        {{ $family  }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </p>
                                                            <p class="f_input">
                                                                <label>Font Size</label><br>
                                                                @php
                                                                    if(isset($upsell)):
                                                                        $heading_font_size = $upsell['setting']['heading_font_size'];
                                                                    else:
                                                                        $heading_font_size = $upsellType->setting['heading_font_size'];
                                                                    endif;
                                                                @endphp
                                                                <input type="number" value="{{ $heading_font_size }}" min="12" name="heading_font_size">
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <div class="f_input_color">
                                                                <label>Color</label><br>
                                                                @php
                                                                    if(isset($upsell)):
                                                                        $heading_color = $upsell['setting']['heading_color'];
                                                                    else:
                                                                        $heading_color = $upsellType->setting['heading_color'];
                                                                    endif;
                                                                @endphp
                                                                <a href="#" class="buttoncolor colorpicker"   data-id="heading_color" style="background-color:{{ $heading_color}} ">
                                                                </a>
                                                                <input value="{{ $heading_color }}" type="hidden" name="heading_color">
                                                                <p>Text Color </p>
                                                            </div>
                                                            <div class="f_input">
                                                                <label>Text Align</label><br>
                                                                @php
                                                                    if(isset($upsell)):
                                                                        $heading_align = $upsell['setting']['heading_align'];
                                                                    else:
                                                                        $heading_align = $upsellType->setting['heading_align'];
                                                                    endif;
                                                                @endphp
                                                                <select name="heading_align">
                                                                    <option {{ $heading_align == "left" ? "selected" : '' }}       value="left">Left</option>
                                                                    <option {{ $heading_align == "center" ? "selected" : '' }}     value="center">Center</option>
                                                                    <option {{ $heading_align == "right" ? "selected" : '' }} value="right">Right</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3>Countdown Sales Timer</h3>
                                                    <div class="custom-control custom-checkbox">
                                                        @php
                                                            if(isset($upsell)):
                                                                $count_down_timer = $upsell['setting']['count_down_timer'];
                                                            else:
                                                                $count_down_timer = $upsellType->setting['count_down_timer'];
                                                            endif;
                                                        @endphp
                                                        <input type="checkbox" class="custom-control-input" id="defaultCheckedDisabled2" name="count_down_timer" {{ $count_down_timer== 1 ? "checked" : ''}} value="{{$count_down_timer}}">
                                                        <label class="custom-control-label" for="defaultCheckedDisabled2">
                                                            Add a Time Limit To The Offer
                                                        </label>
                                                    </div>
                                                    <p class="h_input">
                                                        <label>Timer Duration In Minutes</label><br>
                                                        @php
                                                            if(isset($upsell)):
                                                                $time_duration_minutes = $upsell['setting']['time_duration_minutes'];
                                                            else:
                                                                $time_duration_minutes = $upsellType->setting['time_duration_minutes'];
                                                            endif;
                                                        @endphp
                                                        <input type="text" value="{{ $time_duration_minutes }}" name="time_duration_minutes">
                                                    </p>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <p class="f_input">
                                                                <label>Font family</label><br>
                                                                <select name="timer_font_family">
                                                                    @foreach (config('upsell.strings.fontFamily') as $family)
                                                                    <option
                                                                    @if(isset($upsell))
                                                                        @if($upsell['setting']['timer_font_family'] == $family)
                                                                            {{"selected"}}
                                                                        @endif
                                                                    @elseif($upsellType->setting['timer_font_family'] == $family)
                                                                        {{"selected"}}
                                                                    @endif
                                                                    value="{{ $family }}">
                                                                        {{ $family }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </p>
                                                            <p class="f_input">
                                                                <label>Font Size</label><br>
                                                                @php
                                                                    if(isset($upsell)):
                                                                        $timer_font_size = $upsell['setting']['timer_font_size'];
                                                                    else:
                                                                          $timer_font_size = $upsellType->setting['timer_font_size'];
                                                                    endif;
                                                                @endphp
                                                                <input type="number" value="{{ $timer_font_size }}" min="12" name="timer_font_size">
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h3 class="mt-4">Translation</h3>
                                                    <p class="h_input">
                                                        <label>Button Text</label><br>
                                                        @php
                                                            if(isset($upsell)):
                                                                $button_text = $upsell['setting']['button_text'];
                                                            else:
                                                                $button_text = $upsellType->setting['button_text'];
                                                            endif;
                                                        @endphp
                                                        <input type="text" value="{{ $button_text }}" name="button_text">
                                                    </p>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="custom-control custom-checkbox">
                                                                @php
                                                                    if(isset($upsell)):
                                                                        $show_product_title = $upsell['setting']['show_product_title'];
                                                                    else:
                                                                        $show_product_title = $upsellType->setting['show_product_title'];
                                                                    endif;
                                                                @endphp
                                                                <input type="checkbox" class="custom-control-input" id="defaultCheckedDisabled5" name="show_product_title" {{$show_product_title == 1 ? "checked" : ''}} value="{{$show_product_title}}">
                                                                <label class="custom-control-label" for="defaultCheckedDisabled5">Show Product Title</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                @php
                                                                    if(isset($upsell)):
                                                                        $show_variant_selection = $upsell['setting']['show_variant_selection'];
                                                                    else:
                                                                        $show_variant_selection = $upsellType->setting['show_variant_selection'];
                                                                    endif;
                                                                @endphp
                                                                <input type="checkbox" class="custom-control-input" id="defaultCheckedDisabled3" name="show_variant_selection" {{$show_variant_selection == 1 ? "checked" : ''}} value="{{$show_variant_selection}}">
                                                                <label class="custom-control-label" for="defaultCheckedDisabled3">
                                                                    Show Variant Selection
                                                                </label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                @php
                                                                    if(isset($upsell)):
                                                                        $show_compare_price = $upsell['setting']['show_compare_price'];
                                                                    else:
                                                                        $show_compare_price = $upsellType->setting['show_compare_price'];
                                                                    endif;
                                                                @endphp
                                                                <input type="checkbox" class="custom-control-input" id="defaultCheckedDisabled4" name="show_compare_price" {{$show_compare_price == 1 ? "checked" : ''}} value="{{$show_compare_price}}">
                                                                <label class="custom-control-label" for="defaultCheckedDisabled4">
                                                                    Show Compare Price
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3 class="mt-4">Color Settings</h3>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $product_title_color = $upsell['setting']['product_title_color'];
                                                                else:
                                                                    $product_title_color = $upsellType->setting['product_title_color'];
                                                                endif;
                                                            @endphp
                                                                <a href="#" class="buttoncolor colorpicker" data-id="product_title_color"
                                                                style="background-color:{{ $product_title_color }}">
                                                            </a>
                                                            <input value="{{ $product_title_color }}" type="hidden" name="product_title_color">
                                                            <p>Product Title</p>
                                                        </div>
                                                        <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $upsell_background_color = $upsell['setting']['upsell_background_color'];
                                                                else:
                                                                    $upsell_background_color = $upsellType->setting['upsell_background_color'];
                                                                endif;
                                                            @endphp
                                                            <a href="#" class="buttoncolor colorpicker" data-id="upsell_background_color" style="background-color:{{ $upsell_background_color }}">
                                                            </a>
                                                            <input value="{{ $upsell_background_color }}" type="hidden" name="upsell_background_color">
                                                            <p>Upsell Background </p>
                                                        </div>

                                                        <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $sale_price_color = $upsell['setting']['sale_price_color'];
                                                                else:
                                                                    $sale_price_color = $upsellType->setting['sale_price_color'];
                                                                endif;
                                                            @endphp
                                                            <a href="#" class="buttoncolor colorpicker" data-id="sale_price_color" style="background-color:{{ $sale_price_color }};">
                                                            </a>
                                                            <input value="{{ $sale_price_color }}" type="hidden" name="sale_price_color">
                                                            <p>Sale Price </p>
                                                        </div>
                                                        @php
                                                            if(isset($upsell)):
                                                                $timer_text_color = $upsell['setting']['timer_text_color'];
                                                            else:
                                                                $timer_text_color = $upsellType->setting['timer_text_color'];
                                                            endif;
                                                        @endphp
                                                        <div class="f_input_color mt-3">
                                                            <a href="#" class="buttoncolor colorpicker" data-id="timer_text_color" style="background-color:{{ $timer_text_color }};">
                                                            </a>
                                                            <input value="{{ $timer_text_color }}" type="hidden" name="timer_text_color">
                                                            <p>Timer Text Color </p>
                                                        </div>

                                                        @php
                                                            if(isset($upsell)):
                                                                $timer_text_bg_color = $upsell['setting']['timer_text_bg_color'];
                                                            else:
                                                                $timer_text_bg_color = $upsellType->setting['timer_text_bg_color'];
                                                            endif;
                                                        @endphp
                                                        <div class="f_input_color mt-3">
                                                            <a href="#" class="buttoncolor colorpicker" data-id="timer_text_bg_color" style="background-color:{{ $timer_text_bg_color }};">
                                                            </a>
                                                            <input value="{{ $timer_text_bg_color }}" type="hidden" name="timer_text_bg_color">
                                                            <p>Timer Background Color </p>
                                                        </div>




                                                        <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $compare_price_color = $upsell['setting']['compare_price_color'];
                                                                else:
                                                                    $compare_price_color = $upsellType->setting['compare_price_color'];
                                                                endif;
                                                            @endphp
                                                            <a href="#" class="buttoncolor colorpicker" data-id="compare_price_color" style="background-color:{{ $compare_price_color }}">
                                                            </a>
                                                            <input value="{{ $compare_price_color }}" type="hidden" name="compare_price_color">
                                                            <p>Compare Price</p>
                                                        </div>

                                                        <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $button_border_color = $upsell['setting']['button_border_color'];
                                                                else:
                                                                    $button_border_color = $upsellType->setting['button_border_color'];
                                                                endif;
                                                            @endphp
                                                            <a href="#" class="buttoncolor colorpicker" data-id="button_border_color" style="background-color:{{ $button_border_color }}">
                                                            </a>
                                                            <input value="{{ $button_border_color }}" type="hidden" name="button_border_color">
                                                            <p>Button Border Color</p>
                                                        </div>

                                                        <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $button_text_color = $upsell['setting']['button_text_color'];
                                                                else:
                                                                    $button_text_color = $upsellType->setting['button_text_color'];
                                                                endif;
                                                            @endphp
                                                            <a href="#" class="buttoncolor colorpicker" data-id="button_text_color" style="background-color:{{ $button_text_color }}">
                                                            </a>
                                                            <input value="{{ $button_text_color }}" type="hidden" name="button_text_color">
                                                            <p>Button Text</p>
                                                        </div>

                                                        <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $button_hover_text_color = $upsell['setting']['button_hover_text_color'];
                                                                else:
                                                                    $button_hover_text_color = $upsellType->setting['button_hover_text_color'];
                                                                endif;
                                                            @endphp
                                                            <a href="#" class="buttoncolor colorpicker" data-id="button_hover_text_color" style="background-color:{{ $button_hover_text_color }}">
                                                            </a>
                                                            <input value="{{ $button_hover_text_color }}" type="hidden" name="button_hover_text_color">
                                                            <p>Button Hover Text </p>
                                                        </div>

                                                        <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $button_background_color = $upsell['setting']['button_background_color'];
                                                                else:
                                                                    $button_background_color = $upsellType->setting['button_background_color'];
                                                                endif;
                                                            @endphp
                                                            <a href="#" class="buttoncolor colorpicker" data-id="button_background_color" style="background-color:{{ $button_background_color }};">
                                                            </a>
                                                            <input value="{{ $button_background_color }}" type="hidden" name="button_background_color">
                                                            <p>Button background</p>
                                                        </div>

                                                        <div class="f_input_color mt-3">
                                                            @php
                                                                if(isset($upsell)):
                                                                    $button_hover_background_color = $upsell['setting']['button_hover_background_color'];
                                                                else:
                                                                    $button_hover_background_color = $upsellType->setting['button_hover_background_color'];
                                                                endif;
                                                            @endphp
                                                            <a href="#" class="buttoncolor colorpicker" data-id="button_hover_background_color" style="background-color:{{ $button_hover_background_color }}">
                                                            </a>
                                                            <input value="{{ $button_hover_background_color }}" type="hidden" name="button_hover_background_color">
                                                            <p>Button Hover background</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="design_p_inpage">
                                                <div class="design_inpage upsell_background_color">
                                                    <h2>Shopping Cart<span><i class="fa fa-close"></i></span></h2>
                                                    <div class="p_upsell upsell_background_color">
                                                        @php
                                                            if(isset($upsell)):
                                                                $incart_heading = $upsell['setting']['incart_heading'];
                                                            else:
                                                                $incart_heading = $upsellType->setting['incart_heading'];
                                                            endif;
                                                        @endphp
                                                        @php
                                                            if(isset($upsell)):
                                                                $time_duration_minute = $upsell['setting']['time_duration_minutes'];
                                                            else:
                                                                $time_duration_minute = $upsellType->setting['time_duration_minutes'];
                                                            endif;
                                                        @endphp
                                                        <div class="incart_heading_style">
                                                            <p>
                                                                {{ $incart_heading }}

                                                            </p>

                                                        </div>
                                                        <div class="incart_timer-aus" style="display : flex; justify-content: center;">
                                                        <span class="timer-bg-color-aus aus_timer_duration" id="time_duration">{{ $time_duration_minute }}</span>
                                                        <span class="timer-colon-aus "style="color: #ff3f3fff;  text-align: center; margin: 5px; paddin: 2px 6px; ">:</span>
                                                         <span class="timer-bg-color-aus aus_timer_duration" >00</span>

                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="upsell_img">
                                                                <img src="{{ asset('assets') }}/img/cream.png" alt="cream">
                                                            </div>
                                                            <div class="upsell_title">
                                                                @if($show_product_title == 1)
                                                                    <h4 class="incart_timer product_title_color_style product_title">Olivia Professional Herbal Cream</h4>
                                                                @endif
                                                                @if($show_variant_selection == 1)
                                                                    <select class="variant_option">
                                                                        <option>Select Variant</option>
                                                                        <option>Select Variant</option>
                                                                        <option>Select Variant</option>
                                                                    </select>
                                                                @endif
                                                                <p class="sale_price_color_style">{{ $currency }}25.00
                                                                @if($show_compare_price == 1)
                                                                  <span class="compare_price_color_style compare_price">{{ $currency }}35.00</span>
                                                                @endif
                                                                </p>
                                                            </div>
                                                            <div class="upsell_btn">
                                                                @php
                                                                    if(isset($upsell)):
                                                                        $button_text = $upsell['setting']['button_text'];
                                                                    else:
                                                                        $button_text = $upsellType->setting['button_text'];
                                                                    endif;
                                                                @endphp
                                                                <input type="button" class="incart_button button_border_color button_text_color button_background_color" value="{{ $button_text }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart_upsell">
                                                        <h3>Cart Items</h3>
                                                        <div class="row mt-4">
                                                            <div class="cart_img">
                                                                <img src="{{ asset('assets') }}/img/shampo.png" alt="cream">
                                                            </div>
                                                            <div class="cart_title">
                                                                <h4>Hand Wash</h4>
                                                                <p class="sale_price_color_style">{{ $currency }}25.00 <span class="compare_price_color_style compare_price">{{ $currency }}35.00</span></p>
                                                            </div>
                                                            <div class="cart_btn">
                                                                <h5>Remove</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="cart_img">
                                                                <img src="{{ asset('assets') }}/img/lipstick.png" alt="cream">
                                                            </div>
                                                            <div class="cart_title">
                                                                <h4>Lipstick</h4>
                                                                <p class="sale_price_color_style">{{ $currency }}25.00 <span class="compare_price_color_style compare_price">{{ $currency }}35.00</span></p>
                                                            </div>
                                                            <div class="cart_btn">
                                                                <h5>Remove</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="cart_img">
                                                                <img src="{{ asset('assets') }}/img/nail-polish.png" alt="cream">
                                                            </div>
                                                            <div class="cart_title">
                                                                <h4>Nail Paint</h4>
                                                                <p class="sale_price_color_style">{{ $currency }}25.00 <span class="compare_price_color_style compare_price">{{ $currency }}35.00</span></p>
                                                            </div>
                                                            <div class="cart_btn">
                                                                <h5>Remove</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="cart_img">
                                                                <img src="{{ asset('assets') }}/img/lotion.png" alt="cream">
                                                            </div>
                                                            <div class="cart_title">
                                                                <h4>Face Wash</h4>
                                                                <p class="sale_price_color_style">{{ $currency }}25.00 <span class="compare_price_color_style compare_price">{{ $currency }}35.00</span></p>
                                                            </div>
                                                            <div class="cart_btn">
                                                                <h5>Remove</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="preview_checkout incart_button button_border_color button_text_color button_background_color">Checkout</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-----------------Tab-2-Close----------------->
                        <div id="menu-fbt-video" class="tab-pane fade p-0"><br><div class="container-fluid">
                        <div class="container">
                           <div class="row">
                              <div class="col-md-12">
                                 <iframe width="100%" height="515" src="https://www.youtube.com/embed/MOZFC5vKTpI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                           </div>
                        </div>
                        </div>
                     </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------modal--------------->
@include('includes.components.pickProductModal')
@include('includes.pages.incart',[ "setting" => $upsellType->setting ])
@endsection

