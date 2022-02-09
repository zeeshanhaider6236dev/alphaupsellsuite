@extends('vendor.shopify-app.layouts.default')
@section('content')
@include('includes.upsell_header')
<!-- ======== This code is for alpha upsell suite 2.0========= -->
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
                                            <input type="text" placeholder="Enter Offer Name...!!" id="offer_name" name="name" @isset($upsell) value = "{{ $upsell->name }}"@endisset>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-5 offer_left">
                                            <h4>Select Target Products</h4>
                                            <p>
                                            Target products are those products, on which you want to show an offer. When a customer visits those product pages, then an offer will be shown on those products.
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
                                                            <input class="tabValues" type="hidden" name="Tcollectionstitles[][]" value="{{ $tCollection->shopify_collection_title }}">

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
                                            Upsell products are those products, which you want to show on offer. When customers visit targeted product pages, then upsell products will be shown on offer.
                                            </p>
                                        </div>
                                        <div class="col-md-7 offer_right select_bg">
                                            <div class="row mt-2">
                                                <div class="col-md-4 select_left">
                                                    <h3>Upsell will Appear on...</h3>
                                                </div>
                                                <div class="col-md-8 select_right">
                                                    <input class="autoHidden" type="hidden" name="auto" value="{{ isset($upsell) && $upsell->auto ? '1' : '0'}}">
                                                     <button id="ppu_button" type="button" class="autoButton ppu-auto-button {{ isset($upsell) && $upsell->auto ? 'autoTrue save' : 'delete'}}" >Auto</button>
                                                    <button type="button" class="save pickAProduct" data-toggle="modal"
                                                        data-target="#product_modal" {{ isset($upsell) && $upsell->auto ? 'disabled' : '' }}>Pick a Product</button>
                                                    <button type="button" id="#remove_button_auto" class="cancel removeAll" {{ isset($upsell) && $upsell->auto ? 'disabled' : '' }}>Remove All</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="auto-collapse-box" class="collapse itemContainer item-container-auto-module {{ isset($upsell) && $upsell->auto ? 'show' : '' }}">
                                              @isset($upsell)
                                                @if($upsell->auto)
                                                    <div class="box_shado mt" style="display: flex; align-items: center;">
                                                        <div class="img_box col-md-2" style="width: 100%;"> <img src="https://i.ibb.co/zP4drmC/Pngtree-artificial-intelligence-chip-icon-for-4864546.png" alt="error loading image "></div>
                                                        <div>
                                                            <span>Our AI analysis the previous purchases in your store through data mining algorithm & produce memory graph with recommended products that are usually added.</span>
                                                        </div>
                                                        <div class="img_btn col-md-2">
                                                            <button id="delete_button_auto" type="button" class="delete float-right">Delete</button>
                                                        </div>
                                                    </div>
                                                @endif
                                              @endisset
                                            </div>
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
                                            <h4>Widget Location</h4>
                                            <p>Choose the position of your Frequently Bought Together widget</p>
                                        </div>
                                        <div class="col-md-7 offer_right">
                                            <div class="row">
                                                <div class="col-md-12 discount_left">
                                                    <label>Location of the Frequently Bought Together widget:</label><br>
                                                    <select name="location_of_fbt">
                                                        <option
                                                            @if(isset($upsell))
                                                                {{
                                                                    $upsell->setting['location_of_fbt'] == config("upsell.strings.fbtLocation")[0] ? "selected" : ''
                                                                }}
                                                            @else
                                                                {{
                                                                    $upsellType->setting['location_of_fbt'] == config("upsell.strings.fbtLocation")[0] ? "selected" : ''
                                                                }}
                                                            @endif
                                                            value="{{ config("upsell.strings.fbtLocation")[0] }}" > Below the 'Add to cart' button
                                                        </option>
                                                        <option
                                                            @if(isset($upsell))
                                                                {{
                                                                     $upsell->setting['location_of_fbt'] == config("upsell.strings.fbtLocation")[1] ? "selected" : ''
                                                                }}
                                                            @else
                                                                {{
                                                                    $upsellType->setting['location_of_fbt'] == config("upsell.strings.fbtLocation")[1] ? "selected" : ''
                                                                }}
                                                            @endif
                                                            value="{{ config("upsell.strings.fbtLocation")[1] }}">Below the short description, in the right column
                                                        </option>
                                                        <option
                                                            @if(isset($upsell))
                                                                {{
                                                                     $upsell->setting['location_of_fbt'] == config("upsell.strings.fbtLocation")[2] ? "selected" : ''
                                                                }}
                                                            @else
                                                                {{
                                                                    $upsellType->setting['location_of_fbt'] == config("upsell.strings.fbtLocation")[2] ? "selected" : ''
                                                                }}
                                                            @endif
                                                            value="{{ config("upsell.strings.fbtLocation")[2] }}">Below the long description, taking full width
                                                        </option>
                                                        <option
                                                            @if(isset($upsell))
                                                                {{
                                                                    $upsell->setting['location_of_fbt'] == config("upsell.strings.fbtLocation")[3] ? "selected" : ''
                                                                }}
                                                            @else
                                                                {{
                                                                    $upsellType->setting['location_of_fbt'] == config("upsell.strings.fbtLocation")[3] ? "selected" : ''
                                                                }}
                                                            @endif
                                                            value="{{ config("upsell.strings.fbtLocation")[3] }}">Above the footer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
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
                                                        <input name="work_on_desktop" type="checkbox" class="form-check-input" id="formCheck-1" style="height: 20px;"  @if (isset($upsell))
                                                            {{ $upsell->setting['work_on_desktop']  ? "checked" : '' }}
                                                        @else
                                                            {{ $upsellType->setting['work_on_desktop']  ? "checked" : '' }}
                                                        @endif  value = "1" checked>
                                                        <label class="form-check-label" for="formCheck-1">Desktop</label>
                                                    </div>
                                                    <div class="form-check form_float">
                                                        <input
                                                        @if (isset($upsell))
                                                            {{ $upsell->setting['work_on_mobile']  ? "checked" : '' }}
                                                        @else
                                                            {{ $upsellType->setting['work_on_mobile']  ? "checked" : '' }}
                                                        @endif
                                                        name="work_on_mobile" type="checkbox" class="form-check-input" id="formCheck-3" style="height: 20px;" value="1" checked>
                                                        <label class="form-check-label" for="formCheck-3">Mobile</label>
                                                    </div>
                                                </div>
                                            </p>
                                            <hr>
                                            <h4>Schedule:</h4>
                                            <div class="row">
                                                <div class="col-md-6 discount_left">
                                                    <label>Start Date:</label><br>
                                                    <input value=
                                                        @if(isset($upsell))
                                                            "{{ $upsell->setting['start_date'] }}"
                                                        @else
                                                            "{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        @endif
                                                        name="start_date" type="date" />
                                                </div>
                                                <div class="col-md-6 discount_left">
                                                    <label>End Date:</label><br>
                                                    <input class="fbt_end_date" name="end_date" type="date" style="background-color: #dadada;" value="{{ isset($upsell['setting']['end_date']) ? $upsell['setting']['end_date'] : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-------------------tab-1-close--------------------->
                            <div id="menu1" class="tab-pane fade p-0"><br><div class="container-fluid">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="design_input">
                                                    <h3>Title</h3>
                                                    <p class="h_input">
                                                        <label>Heading</label><br>
                                                        <input value=
                                                            @if(isset($upsell))
                                                                "{{ $upsell->setting['fbt_heading'] }}"
                                                            @else
                                                                "{{ $upsellType->setting['fbt_heading'] }}"
                                                            @endif
                                                            name="fbt_heading" type="text" placeholder="Frequently Bought Together" />
                                                    </p>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <p class="f_input">
                                                                <label>Font family</label><br>
                                                                <select name="heading_font_family">
                                                                    @foreach (config('upsell.strings.fontFamily') as $family)
                                                                        <option
                                                                        @if(isset($upsell))
                                                                            {{ $upsell->setting['heading_font_family'] == $family ? "selected" : '' }}
                                                                        @else
                                                                            {{ $upsellType->setting['heading_font_family'] == $family ? "selected" : '' }}
                                                                        @endif
                                                                        value="{{ $family }}">
                                                                            {{ $family }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </p>
                                                            <p class="f_input">
                                                                <label>Font Size</label><br>
                                                                <input value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['heading_font_size'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['heading_font_size'] }}"
                                                                    @endif
                                                                name="heading_font_size" type="number" value="22" min="12">
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <div class="f_input_color">
                                                                <label>Color</label><br>
                                                                <a href="#" data-id="heading_color" class="buttoncolor colorpicker" style=
                                                                    @if (isset($upsell))
                                                                        "background-color:{{ $upsell->setting['heading_color'] }};"
                                                                    @else
                                                                        "background-color:{{ $upsellType->setting['heading_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                 @if (isset($upsell))
                                                                    "{{ $upsell->setting['heading_color'] }}"
                                                                 @else
                                                                    "{{ $upsellType->setting['heading_color'] }}"
                                                                 @endif
                                                                 type="hidden" name="heading_color">
                                                                <p>Text Color </p>
                                                            </div>
                                                            <p class="f_input">
                                                                <label>Text Align</label><br>
                                                                <select name="heading_align">
                                                                    <option
                                                                        @if(isset($upsell))
                                                                            {{ $upsell->setting['heading_align'] == "left" ? "selected" : '' }}
                                                                        @else
                                                                            {{ $upsellType->setting['heading_align'] == "left" ? "selected" : '' }}
                                                                        @endif
                                                                        value="left">Left
                                                                    </option>
                                                                    <option
                                                                        @if (isset($upsell))
                                                                            {{ $upsell->setting['heading_align'] == "center" ? "selected" : '' }}
                                                                        @else
                                                                            {{ $upsellType->setting['heading_align'] == "center" ? "selected" : '' }}
                                                                        @endif
                                                                        value="center">Center
                                                                    </option>
                                                                    <option
                                                                        @if(isset($upsell))
                                                                            {{ $upsell->setting['heading_align'] == "right" ? "selected" : '' }}
                                                                        @else
                                                                            {{ $upsellType->setting['heading_align'] == "right" ? "selected" : '' }}
                                                                        @endif
                                                                        value="right">Right
                                                                    </option>
                                                                </select>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h3 class="mt-4">Translation</h3>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <p class="f_input">
                                                                <label>Add Selected To Cart</label><br>
                                                                <input value=
                                                                 @if (isset($upsell))
                                                                    "{{ $upsell->setting['button_text'] }}"
                                                                 @else
                                                                    "{{ $upsellType->setting['button_text'] }}"
                                                                 @endif
                                                                 name="button_text" type="text" placeholder="Add Selected To Cart">
                                                            </p>
                                                            <p class="f_input">
                                                                <label>This Item</label><br>
                                                                <input name="this_item" type="text" value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['this_item'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['this_item'] }}"
                                                                    @endif
                                                                >
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <p class="f_input">
                                                                <label>Sale Badge</label><br>
                                                                <input  name="sale_badge_text" type="text" value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['sale_badge_text'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['sale_badge_text'] }}"
                                                                    @endif
                                                                >
                                                            </p>
                                                            <p class="f_input">
                                                                <label>Total Price</label><br>
                                                                <input  name="total_price_text" type="text" value=
                                                                @if (isset($upsell))
                                                                    "{{ $upsell->setting['total_price_text'] }}"
                                                                @else
                                                                    "{{ $upsellType->setting['total_price_text'] }}"
                                                                @endif
                                                                >
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h3 class="mt-4">Color Settings</h3>
                                                    <div class="col-md-12 font">
                                                        <div class="row">
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="product_title_color" class="buttoncolor colorpicker" style=
                                                                    @if (isset($upsell))
                                                                        "background-color:{{ $upsell->setting['product_title_color'] }};"
                                                                    @else
                                                                        "background-color:{{ $upsellType->setting['product_title_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                 @if (isset($upsell))
                                                                    "{{ $upsell->setting['product_title_color'] }}"
                                                                 @else
                                                                    "{{ $upsellType->setting['product_title_color'] }}"
                                                                 @endif
                                                                 type="hidden" name="product_title_color">
                                                                <p>Product Title </p>
                                                            </div>
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="sale_price_color" class="buttoncolor colorpicker"  style=
                                                                    @if (isset($upsell))
                                                                        "background-color: {{ $upsell->setting['sale_price_color'] }};"
                                                                    @else
                                                                        "background-color: {{ $upsellType->setting['sale_price_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                @if (isset($upsell))
                                                                     "{{ $upsell->setting['sale_price_color'] }}"
                                                                @else
                                                                     "{{ $upsellType->setting['sale_price_color'] }}"
                                                                @endif
                                                                type="hidden" name="sale_price_color">
                                                                <p>Sale Price </p>
                                                            </div>
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="compare_price_color" class="buttoncolor colorpicker" style=
                                                                @if (isset($upsell))
                                                                    "background-color: {{ $upsell->setting['compare_price_color'] }};"
                                                                @else
                                                                    "background-color: {{ $upsellType->setting['compare_price_color'] }};"
                                                                @endif

                                                                >
                                                                </a>
                                                                <input value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['compare_price_color'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['compare_price_color'] }}"
                                                                    @endif
                                                                    type="hidden" name="compare_price_color">
                                                                <p>Compare Price</p>
                                                            </div>
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="button_border_color" class="buttoncolor colorpicker" style=
                                                                    @if (isset($upsell))
                                                                        "background-color:{{ $upsellType->setting['button_border_color'] }};"
                                                                    @else
                                                                        "background-color:{{ $upsellType->setting['button_border_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['button_border_color'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['button_border_color'] }}"
                                                                    @endif
                                                                    type="hidden" name="button_border_color">
                                                                <p>Button Border Color</p>
                                                            </div>
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="button_text_color" class="buttoncolor colorpicker" style=
                                                                    @if (isset($upsell))
                                                                        "background-color: {{ $upsell->setting['button_text_color'] }};"
                                                                    @else
                                                                        "background-color: {{ $upsellType->setting['button_text_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['button_text_color'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['button_text_color'] }}"
                                                                    @endif
                                                                    type="hidden" name="button_text_color">
                                                                <p>Button Text</p>
                                                            </div>
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="button_hover_text_color" class="buttoncolor colorpicker"  style=
                                                                    @if (isset($upsell))
                                                                        "background-color: {{ $upsell->setting['button_hover_text_color'] }};"
                                                                    @else
                                                                        "background-color: {{ $upsellType->setting['button_hover_text_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['button_hover_text_color'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['button_hover_text_color'] }}"
                                                                    @endif
                                                                    type="hidden" name="button_hover_text_color">
                                                                <p>Button Hover Text </p>
                                                            </div>
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="button_background_color" class="buttoncolor colorpicker"  style=
                                                                    @if (isset($upsell))
                                                                        "background-color: {{ $upsell->setting['button_background_color'] }};"
                                                                    @else
                                                                        "background-color: {{ $upsellType->setting['button_background_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['button_background_color'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['button_background_color'] }}"
                                                                    @endif
                                                                    type="hidden" name="button_background_color">
                                                                <p>Button background</p>
                                                            </div>
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="button_hover_background_color" class="buttoncolor colorpicker" style=
                                                                    @if (isset($upsell))
                                                                        "background-color:{{ $upsell->setting['button_hover_background_color'] }};"
                                                                    @else
                                                                       "background-color:{{ $upsellType->setting['button_hover_background_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                    @if (isset($upsell))
                                                                        "{{ $upsell->setting['button_hover_background_color'] }}" type="hidden"
                                                                    @else
                                                                        "{{ $upsellType->setting['button_hover_background_color'] }}" type="hidden"
                                                                    @endif
                                                                 name="button_hover_background_color">
                                                                <p>Button Hover background</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h2 class="mt-4">Price Options</h2>
                                                    <h5>Optional preferences for the product price and total amount.</h5>
                                                    <h4>Show the original product prices and total price</h4>
                                                    <label class="switch">
                                                        <input
                                                            @if (isset($upsell))
                                                                {{ $upsell->setting['show_original_total_price']  ? "checked" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['show_original_total_price']  ? "checked" : '' }}
                                                            @endif
                                                         name="show_original_total_price" type="checkbox" value="1">
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <h4>Show the 'Compare at price' when available</h4>
                                                    <label class="switch">
                                                        <input name="show_compare_price_available" type="checkbox"
                                                            @if (isset($upsell))
                                                                {{ $upsell->setting['show_compare_price_available']  ? "checked" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['show_compare_price_available']  ? "checked" : '' }}
                                                            @endif
                                                         value="1" />
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <h4>Show the 'Sale' badge on images(if applicable)</h4>
                                                    <label class="switch">
                                                        <input name="show_sale_badge_on_image" type="checkbox"
                                                            @if (isset($upsell))
                                                                {{ $upsell->setting['show_sale_badge_on_image']  ? "checked" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['show_sale_badge_on_image']  ? "checked" : '' }}
                                                            @endif
                                                         value="1" />
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="design_preview">
                                                    <div class="live_p">
                                                        <h2 class="fbt_heading_style">
                                                            @if (isset($upsell))
                                                                {{ $upsell->setting['fbt_heading'] }}
                                                            @else
                                                                {{ $upsellType->setting['fbt_heading'] }}
                                                            @endif
                                                        </h2>
                                                        <div class="item">
                                                            <img src="{{ asset('assets') }}/img/shampo.png" alt="cream"/>
                                                            <span class="img_plus" style="margin-left:10px;">+</span>
                                                        </div>
                                                        <div class="item">
                                                            <span class="notify-badge sale_badge">
                                                                @if (isset($upsell))
                                                                    {{ $upsellType->setting['sale_badge_text'] }}
                                                                @else
                                                                    {{ $upsellType->setting['sale_badge_text'] }}
                                                                @endif
                                                            </span>
                                                            <img src="{{ asset('assets') }}/img/cream.png" alt="cream">
                                                            <span class="img_plus" style="margin-left:10px;">+</span>
                                                        </div>
                                                        <div class="item">
                                                            <span class="notify-badge sale_badge">{{ $upsellType->setting['sale_badge_text'] }}</span>
                                                            <img src="{{ asset('assets') }}/img/lotion.png" alt="cream" />
                                                        </div>
                                                        <p class="live_total">
                                                            <span class="total_price">
                                                                @if (isset($upsell))
                                                                    {{ $upsell->setting['total_price_text'] }} :
                                                                @else
                                                                    {{ $upsellType->setting['total_price_text'] }} :
                                                                @endif
                                                            </span>
                                                            <span class="l_t_s sale_price_color_style">{{ $currency }}55.00</span>
                                                            <span class="l_t_p compare_price_color_style">{{ $currency }}77.00</span>
                                                        </p>
                                                        <button type="button" class="live_btn fbt_button button_border_color_style button_text_color_style" >
                                                            @if (isset($upsell))
                                                                {{ $upsell->setting['button_text'] }}
                                                            @else
                                                                {{ $upsellType->setting['button_text'] }}
                                                            @endif
                                                        </button>
                                                        <ul class="live_ul">
                                                            <li class="live_total">
                                                                <span class="this_item">
                                                                    @if (isset($upsell))
                                                                        {{ $upsell->setting['this_item'] }} :
                                                                    @else
                                                                        {{ $upsellType->setting['this_item'] }} :
                                                                    @endif
                                                                </span>
                                                                <span class="p_title product_title_color_style">Shampoo</span>
                                                                <span class="l_t_s sale_price_color_style">{{ $currency }}27.00</span>
                                                                <span class="l_t_p compare_price_color_style">{{ $currency }}35.00</span>
                                                            </li>
                                                            <li class="live_total">
                                                                <span class="p_title product_title_color_style">Cream</span>
                                                                <span class="l_t_s sale_price_color_style">{{ $currency }}9.00</span>
                                                                <span class="l_t_p compare_price_color_style">{{ $currency }}17.00</span>
                                                            </li>
                                                            <li class="live_total">
                                                                <span class="p_title product_title_color_style">FaceWash</span>
                                                                <span class="l_t_s sale_price_color_style">{{ $currency }}19.00</span>
                                                                <span class="l_t_p compare_price_color_style">{{ $currency }}25.00</span>
                                                            </li>
                                                        </ul>
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
                                                <iframe width="100%" height="515" src="https://www.youtube.com/embed/CoXPGIaifwQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <!------------modal--------------->
@include('includes.components.pickProductModal')
@include('includes.pages.fbt',[ "setting" => $upsellType->setting ])
@endsection
