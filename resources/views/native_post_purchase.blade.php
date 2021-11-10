@extends('vendor.shopify-app.layouts.default')
@section('content')
@include('includes.upsell_header')
<!-- This code is for alpha upsell 2.0 -->
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
              <!----------------Info --- Action Reqired------------------>
               {{-- <div class="tab-content">
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                    </svg>
                    <div class="alert alert-primary mt-3 d-flex align-items-center flex-row" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        <h4 style="color: black;">Action Required</h4>
                    </div>
                    <div>
                        <p style="color:black;">Please go to <b>Checkout settings -> Post-purchase</b> page section. Choose the <b>Alpha Upsell Suite</b> as the app for handling post purchase upsells.</p>
                        <button class="btn btn-primary native-setting-btn">Open Checkout Setting</button>
                    </div>
                    </div>
                </div> --}}
               <div class="tab-content">
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                    </svg>
                    <div class="alert alert-primary mt-3 d-flex justify-content-center flex-column alert-dismissible fade show position-relative" role="alert">
                        <div class="aus_cross_icon position-absolute" style="top:0;right:10px;cursor:pointer;">&#10060;</div>
                        <div class="d-flex align-items-center ">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                            <h4 style="font-family: sans-serif;color: black;" class="ml-1 mt-1">Action Required</h4>
                        </div>
                        <div>
                            <p style="color:black;">Please go to <strong>Checkout settings &#8594; Post-purchase</strong> page section. Choose the <strong>Alpha Upsell Suite</strong> as the app for handling post purchase upsells.</p>
                            <a class="btn btn-primary native-setting-btn" href="https://{{ auth()->user()->name}}/admin/settings/checkout" target="_blank">Open Checkout Settings</a>
                        </div>
                    </div>
                </div>



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
                              <label>Name:</label><br>
                              <input type="text" placeholder="Enter Offer Name...!!" name="name" @isset($upsell) value = "{{ $upsell->name }}"@endisset>
                          </div>
                      </div>
                  </div>
                  <div class="container">
                      <div class="row">
                          <div class="col-md-5 offer_left">
                              <h4>Select Target Products</h4>
                              <p>Target products are those products, on which you want to show offer. When customer will add these products to order, then offer will be shown on those products.</p>
                          </div>
                          <div class="col-md-7 offer_right select_bg">
                              <div class="row mt-2">
                                  <div class="col-md-4 select_left">
                                      <h3>Upsell will Trigger on...</h3>
                                  </div>
                                  <div class="col-md-8 select_right">
                                      <button type="button" class="save pickTProduct" data-toggle="modal" data-target="#product_modal">Pick a Product</button>
                                      <button type="button" class="cancel">Remove All</button>
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
                              <p>Upsell products are those products, which you want to show in offer. When customer will add targeted products to order, then upsell products will be shown in offer.</p>
                          </div>
                          <div class="col-md-7 offer_right select_bg">
                              <div class="row mt-2">
                                  <div class="col-md-4 select_left">
                                      <h3>Upsell will Appear on...</h3>
                                  </div>
                                  <div class="col-md-8 select_right">
                                      <button type="button" class="save pickAProduct" data-toggle="modal" data-target="#product_modal">Pick a Product</button>
                                      <button type="button" class="cancel">Remove All</button>
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
                                      @endif
                                  @endisset
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="container upsel_p">
                      <div class="row">
                          <div class="col-md-5 offer_left">
                              <h4>Select Downsell Products</h4>
                              <p>Downsell products are those products, which you want to show in offer. When customer will decline upsell products to order, then Downsell products will be shown in offer.</p>
                          </div>
                          <div class="col-md-7 offer_right select_bg">
                              <div class="row mt-2">
                                  <div class="col-md-4 select_left">
                                      <h3>Upsell will Appear on...</h3>
                                  </div>
                                  <div class="col-md-8 select_right">
                                      <button type="button" class="save pickDProduct" data-toggle="modal" data-target="#product_modal">Pick a Product</button>
                                      <button type="button" class="cancel">Remove All</button>
                                  </div>
                              </div>
                              <hr>
                              <div class="pickedDownSell itemContainer">
                                  @isset($upsell)
                                      @if($upsell->Dproducts->count())
                                          @foreach ($upsell->Dproducts as $dProduct)
                                              <div class="box_shado mt">
                                                  <input class="tabValues" type="hidden" name="Dproducts[]" value="{{ $dProduct->shopify_product_id }}">
                                                  <input class="tabValues" type="hidden" name="Dproductsimages[]" value="{{ $dProduct->shopify_product_image }}">
                                                  <input class="tabValues" type="hidden" name="Dproductstitles[]" value="{{ $dProduct->shopify_product_title }}">
                                                  <div class="row">
                                                      <div class="img_box col-md-2">
                                                          <img src="{{ $dProduct->shopify_product_image }}">
                                                      </div>
                                                      <div class="img_name col-md-8">
                                                          <p>{{ $dProduct->shopify_product_title }}
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
                              <h4>Discount Details</h4>
                              <p>Choose the discount type here whether you want to apply discount in percentage, a fix price or no discount.</p>
                          </div>
                          <div class="col-md-7 offer_right">
                              <div class="row">
                                  <div class="col-md-6 discount_left">
                                      <label>Discount Type:</label><br>
                                      <select name="native_ppu_dicount_type">
                                        <option
                                          @if(isset($upsell))
                                              {{ $upsell->setting['native_ppu_dicount_type'] == "No Discount" ? "selected" : '' }}
                                          @else
                                              {{ $upsellType->setting['native_ppu_dicount_type'] == "No Discount" ? "selected" : '' }}
                                          @endif
                                          values="No Discount">No Discount
                                        </option>
                                          <option
                                          @if(isset($upsell))
                                              {{ $upsell->setting['native_ppu_dicount_type'] == "% Off" ? "selected" : '' }}
                                          @else
                                              {{ $upsellType->setting['native_ppu_dicount_type'] == "% Off" ? "selected" : '' }}
                                          @endif
                                          value="% Off">% Off
                                      </option>
                                      <option
                                          @if(isset($upsell))
                                              {{ $upsell->setting['native_ppu_dicount_type'] == "Fixed Price Off" ? "selected" : '' }}
                                          @else
                                              {{ $upsellType->setting['native_ppu_dicount_type'] == "Fixed Price Off" ? "selected" : '' }}
                                          @endif
                                          value="Fixed Price Off">Fixed Price Off
                                      </option>

                                      </select>
                                  </div>
                                  <div class="col-md-6 discount_left">
                                      <label>Discount Value:</label><br>
                                      <input type="number" value="10" name="native_ppu_dicount_value">
                                  </div>
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
                      <!-- <h4>Work on device:</h4>
                        <div class="row">
                          <div class="form-check form_float ml-3">
                            <input type="checkbox" class="form-check-input desktop_view" id="formCheck-1" style="height: 20px;" name="desktop_view" value="1"
                                @if(isset($upsell))
                                    {{ $upsell->setting['desktop_view']  ? "checked" : '' }}
                                @else
                                    {{ $upsellType->setting['desktop_view']  ? "checked" : '' }}
                                @endif
                                >
                            <label class="form-check-label" for="formCheck-1">Desktop</label>
                          </div>
                          <div class="form-check form_float">
                              <input type="checkbox" class="form-check-input mobile_view" id="formCheck-3" style="height: 20px;" name="mobile_view"  value="1"
                              @if(isset($upsell))
                                  {{ $upsell->setting['mobile_view']  ? "checked" : '' }}
                              @else
                                  {{ $upsellType->setting['mobile_view']  ? "checked" : '' }}
                              @endif
                               >
                              <label class="form-check-label" for="formCheck-3" >Mobile</label>
                          </div>
                        </div>
                        <hr> -->
                        <h4>Schedule:</h4>
                        <div class="row">
                            <div class="col-md-6 discount_left">
                                <label>Start Date:</label><br>
                                <input type="date" name="start_date"
                                value=
                                @if(isset($upsell))
                                    "{{ $upsell->setting['start_date']}}"
                                @else
                                    "{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                @endif
                                name="start_date" type="date"
                                >
                            </div>
                            <div class="col-md-6 discount_left">
                                <label>End Date:</label><br>
                                <input tclass="end_date"    name="end_date" type="date" style="background-color: #dadada;">
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
                                            <!-- <input type="hidden" name="native_post_purchase_heading" value="This Exclusive offer Expire in:"> -->
                                            <input type="text" id="testInput"  name="native_post_purchase_heading" value=
                                            @if(isset($upsell))
                                                "{{ $upsell->setting['native_post_purchase_heading'] }}"
                                            @else
                                                "{{ $upsellType->setting['native_post_purchase_heading'] }}"
                                            @endif
                                            >
                                        </p>
                                        <div class="custom-control custom-checkbox">
                                            <!-- input type="hidden" name="time_limit_toggler" value="1"> -->
                                            <input type="checkbox"  class="custom-control-input" id="defaultCheckedDisabled2" name="time_limit_toggler" value="1"
                                            @if(isset($upsell))
                                                {{ $upsell->setting['time_limit_toggler']  ? "checked" : '' }}
                                            @else
                                                {{ $upsellType->setting['time_limit_toggler']  ? "checked" : '' }}
                                            @endif
                                             >
                                            <label class="custom-control-label" for="defaultCheckedDisabled2">Add a Time Limit To The Offer</label>
                                        </div>
                                        <p class="h_input">
                                            <label>Timer Duration In Minutes</label><br>
                                            <!-- <input type="hidden" name="time_limit_duration" value="10"> -->
                                            <input type="text"  name="time_limit_duration" value=
                                            @if(isset($upsell))
                                                {{ $upsell->setting['time_limit_duration']  }}
                                            @else
                                                {{ $upsellType->setting['time_limit_duration'] }}
                                            @endif>
                                        </p>
                                        <div class="col-md-12 font">
                                            <div class="row">
                                                <div class="col-md-12 font">
                                                    <div class="row">
                                                        <p class="f1_input">
                                                            <label>Font Size</label><br>
                                                            <!-- <input type="hidden" name="font_size" value="Auto"> -->
                                                            <select name="font_size" >
                                                                @foreach (config('upsell.strings.fontsize') as $size)
                                                                    <option
                                                                    @if(isset($upsell))
                                                                        {{ $upsell->setting['font_size'] == $size ? "selected" : '' }}
                                                                    @else
                                                                        {{ $upsellType->setting['font_size'] == $size ? "selected" : '' }}
                                                                    @endif
                                                                     value="{{ $size }}">
                                                                        {{ $size }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </p>
                                                        <p class="f1_input">
                                                            <label>Text alignment</label><br>
                                                            <select name="text_align" >
                                                                @foreach (config('upsell.strings.text_align') as $alignment)
                                                                    <option
                                                                    @if(isset($upsell))
                                                                        {{ $upsell->setting['text_align'] == $alignment ? "selected" : '' }}
                                                                    @else
                                                                        {{ $upsellType->setting['text_align'] == $alignment ? "selected" : '' }}
                                                                    @endif
                                                                     value="{{ $alignment }}">
                                                                        {{ $alignment }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </p>
                                                        <p class="f1_input">
                                                            <label>Text color</label><br>
                                                            <select name="text_color" >
                                                                @foreach (config('upsell.strings.text_color') as $color)
                                                                    <option
                                                                    @if(isset($upsell))
                                                                        {{ $upsell->setting['text_color'] == $color ? "selected" : '' }}
                                                                    @else
                                                                        {{ $upsellType->setting['text_color'] == $color ? "selected" : '' }}
                                                                    @endif
                                                                     value="{{ $color }}">
                                                                        {{ $color }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-0">
                                                <div class="row">
                                                    <div class="custom-control custom-checkbox">
                                                        <!-- <input type="hidden" name="bg_color_toggler" value="1"> -->
                                                        <input type="checkbox"  class="custom-control-input" id="defaultCheckedDisabled1" name="bg_color_toggler" value="1"
                                                        @if(isset($upsell))
                                                            {{ $upsell->setting['bg_color_toggler']  ? "checked" : '' }}
                                                        @else
                                                            {{ $upsellType->setting['bg_color_toggler']  ? "checked" : '' }}
                                                        @endif
                                                        >
                                                        <label class="custom-control-label" for="defaultCheckedDisabled1">Show Background</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <!-- <input type="hidden" name="border_color_toggler" value="1"> -->
                                                        <input type="checkbox"  class="custom-control-input" id="defaultCheckedDisabled4" name="border_color_toggler" value="1"
                                                        @if(isset($upsell))
                                                            {{ $upsell->setting['border_color_toggler']  ? "checked" : '' }}
                                                        @else
                                                            {{ $upsellType->setting['border_color_toggler']  ? "checked" : '' }}
                                                        @endif
                                                        >
                                                        <label class="custom-control-label" for="defaultCheckedDisabled4">Show Border</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <!-- <input type="hidden" name="quantity_toggler" value="1"> -->
                                                        <input type="checkbox"  class="custom-control-input" id="defaultCheckedDisabled6" name="quantity_toggler" value="1"
                                                        @if(isset($upsell))
                                                            {{ $upsell->setting['quantity_toggler']  ? "checked" : '' }}
                                                        @else
                                                            {{ $upsellType->setting['quantity_toggler']  ? "checked" : '' }}
                                                        @endif
                                                        >
                                                        <label class="custom-control-label" for="defaultCheckedDisabled6">Quantity</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <!-- <input type="hidden" name="variant_toggler" value="1"> -->
                                                        <input type="checkbox"  class="custom-control-input" id="defaultCheckedDisabled5" name="variant_toggler" value="1"
                                                        @if(isset($upsell))
                                                            {{ $upsell->setting['variant_toggler']  ? "checked" : '' }}
                                                        @else
                                                            {{ $upsellType->setting['variant_toggler']  ? "checked" : '' }}
                                                        @endif
                                                        >
                                                        <label class="custom-control-label" for="defaultCheckedDisabled5">Varient</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="c_black">Sub Heading</h3>
                                        <div class="col-md-12 font">
                                            <div class="row">
                                                <div class="col-md-12 p-0">
                                                    <p class="h_input">
                                                        <label>Text</label><br>
                                                        <!-- <input type="hidden" name="user_welcome_msg" value="Hey {customer.Name}"> -->
                                                        <textarea class="textarea_field"  name="user_welcome_msg">@if(isset($upsell)) {{ $upsell->setting['user_welcome_msg'] }}@else {{ $upsellType->setting['user_welcome_msg'] }}@endif</textarea>
                                                        <p class="field-text"><span class="text_fonts"> Optional Tags</span>{customer.Name}</p>
                                                    </p>
                                                </div>
                                                <div class="col-md-12 font">
                                                    <div class="row">
                                                        <p class="f1_input">
                                                            <label>Font Size</label><br>
                                                            <!-- <input type="hidden" name="user_heading_font_size" value="Auto"> -->
                                                            <select name="user_heading_font_size" >
                                                                @foreach (config('upsell.strings.fontsize') as $size)
                                                                    <option
                                                                    @if(isset($upsell))
                                                                        {{ $upsell->setting['user_heading_font_size'] == $size ? "selected" : '' }}
                                                                    @else
                                                                        {{ $upsellType->setting['user_heading_font_size'] == $size ? "selected" : '' }}
                                                                    @endif
                                                                     value="{{ $size }}">
                                                                        {{ $size }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </p>
                                                        <p class="f1_input">
                                                            <label>Text alignment</label><br>
                                                            <!-- <input type="hidden" name="user_heading_text_align" value="Center"> -->
                                                            <select name="user_heading_text_align" >
                                                                @foreach (config('upsell.strings.text_align') as $alignment)
                                                                    <option
                                                                    @if(isset($upsell))
                                                                        {{ $upsell->setting['user_heading_text_align'] == $alignment ? "selected" : '' }}
                                                                    @else
                                                                        {{ $upsellType->setting['user_heading_text_align'] == $alignment ? "selected" : '' }}
                                                                    @endif
                                                                     value="{{ $alignment }}">
                                                                        {{ $alignment }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </p>
                                                        <p class="f1_input">
                                                            <label>Text color</label><br>
                                                            <!-- <input type="hidden" name="user_heading_text_color" value="Red"> -->
                                                            <select name="user_heading_text_color" >
                                                              @foreach (config('upsell.strings.text_color') as $color)
                                                                  <option
                                                                  @if(isset($upsell))
                                                                      {{ $upsell->setting['user_heading_text_color'] == $color ? "selected" : '' }}
                                                                  @else
                                                                      {{ $upsellType->setting['user_heading_text_color'] == $color ? "selected" : '' }}
                                                                  @endif
                                                                   value="{{ $color }}">
                                                                      {{ $color }}
                                                                  </option>
                                                              @endforeach
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3>Text</h3>
                                        <div class="col-md-12 font">
                                            <div class="row">
                                                <div class="col-md-12 p-0">
                                                    <p class="h_input">
                                                        <label>Text</label><br>
                                                        <!-- <input type="hidden" name="text_tagline_message" value="Hurry up before it solid out."> -->
                                                        <textarea class="textarea_field"  name="text_tagline_message">@if(isset($upsell)){{ $upsell->setting['text_tagline_message'] }} @else {{ $upsellType->setting['text_tagline_message'] }}@endif</textarea>
                                                        <p class="field-text">
                                                            <span class="text_fonts"> Optional Tags</span>{customer.Name}
                                                        </p>
                                                    </p>
                                                </div>
                                                <div class="col-md-12 font">
                                                    <div class="row">
                                                        <p class="f1_input">
                                                            <label>Font Size</label><br>
                                                            <!-- <input type="hidden" name="text_font_size" value="Auto"> -->
                                                            <select name="text_font_size" >
                                                                @foreach (config('upsell.strings.fontsize') as $size)
                                                                    <option
                                                                    @if(isset($upsell))
                                                                        {{ $upsell->setting['text_font_size'] == $size ? "selected" : '' }}
                                                                    @else
                                                                        {{ $upsellType->setting['text_font_size'] == $size ? "selected" : '' }}
                                                                    @endif
                                                                     value="{{ $size }}">
                                                                        {{ $size }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </p>
                                                        <p class="f1_input">
                                                            <label>Text alignment</label><br>
                                                            <!-- <input type="hidden" name="text_heading_align" value="Center"> -->
                                                            <select name="text_heading_align" >
                                                                @foreach (config('upsell.strings.text_align') as $alignment)
                                                                    <option
                                                                    @if(isset($upsell))
                                                                        {{ $upsell->setting['text_heading_align'] == $alignment ? "selected" : '' }}
                                                                    @else
                                                                        {{ $upsellType->setting['text_heading_align'] == $alignment ? "selected" : '' }}
                                                                    @endif
                                                                     value="{{ $alignment }}">
                                                                        {{ $alignment }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </p>
                                                        <p class="f1_input">
                                                            <label>Text color</label><br>
                                                            <!-- <input type="hidden" name="text_heading_color" value="Default"> -->
                                                            <select name="text_heading_color" >
                                                               @foreach (config('upsell.strings.text_color') as $color)
                                                                <option
                                                                @if(isset($upsell))
                                                                    {{ $upsell->setting['text_heading_color'] == $color ? "selected" : '' }}
                                                                @else
                                                                    {{ $upsellType->setting['text_heading_color'] == $color ? "selected" : '' }}
                                                                @endif
                                                                 value="{{ $color }}">
                                                                    {{ $color }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3>Prices</h3>
                                        <div class="col-md-12 font">
                                            <div class="row">
                                                <p class="f1_input">
                                                    <label>Sale price</label><br>
                                                    <!-- <input type="hidden" name="price_color" value="Default"> -->
                                                    <select name="price_color" >
                                                        @foreach (config('upsell.strings.text_color') as $color)
                                                            <option
                                                            @if(isset($upsell))
                                                                {{ $upsell->setting['price_color'] == $color ? "selected" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['price_color'] == $color ? "selected" : '' }}
                                                            @endif
                                                             value="{{ $color }}">
                                                                {{ $color }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </p>

                                                <p class="f1_input">
                                                    <label>Compare price</label><br>
                                                     <!-- <input type="hidden" name="compare_at_price_color" value="Red"> -->
                                                    <select name="compare_at_price_color" >
                                                        @foreach (config('upsell.strings.text_color') as $color)
                                                            <option
                                                            @if(isset($upsell))
                                                                {{ $upsell->setting['compare_at_price_color'] == $color ? "selected" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['compare_at_price_color'] == $color ? "selected" : '' }}
                                                            @endif
                                                             value="{{ $color }}">
                                                                {{ $color }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                                <p class="f1_input">
                                                    <label>Bagde Color</label><br>
                                                    <!-- <input type="hidden" name="badge_color" value="Yellow"> -->
                                                    <select name="badge_color" >
                                                        @foreach (config('upsell.strings.text_color') as $color)
                                                            <option
                                                            @if(isset($upsell))
                                                                {{ $upsell->setting['badge_color'] == $color ? "selected" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['badge_color'] == $color ? "selected" : '' }}
                                                            @endif
                                                             value="{{ $color }}">
                                                                {{ $color }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                        <h3>Buttons</h3>
                                        <div class="col-md-12 font">
                                            <div class="row">
                                                <div class="col-md-6 p-0">
                                                    <p class="btn_input">
                                                        <label>Purchase Button</label><br>
                                                        <input type="text" name="accept_offer_text"  value=
                                                        @if(isset($upsell))
                                                            "{{ $upsell->setting['accept_offer_text'] }}"
                                                        @else
                                                            "{{ $upsellType->setting['accept_offer_text'] }}"
                                                        @endif
                                                        >
                                                    </p>
                                                </div>
                                                <div class="col-md-6 p-0">
                                                    <p class="btn_input">
                                                        <label>Decline Button</label><br>
                                                        <input type="text" class="mr-1"  name="decline_offer_text" value=
                                                        @if(isset($upsell))
                                                            "{{ $upsell->setting['decline_offer_text'] }}"
                                                        @else
                                                            "{{ $upsellType->setting['decline_offer_text'] }}"
                                                        @endif
                                                        />
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="design_p_inpage">
                                        <div class="design_inpage_post">
                                            <div class="paid_info">
                                                <p><span class="check_icon"><i class="fa fa-check"></i></span>You have Paid for your order.</p>
                                                <a href=""><p>View order confirmation<i class="arrow-left"></i></p></a>
                                            </div>
                                            <div class="top_head_post">
                                                <div class="post_timer">
                                                    <div class="alignment">
                                                        <!-- <p class="message1">This Exclusive offer Expire in:</p>
                                                        <input type="text" id="timer-hide-show" value="10:00"> -->
                                                        <p>
                                                            <span class="message1">This Exclusive offer Expire in:</span>
                                                            <span id="timer-hide-show">10:00</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <h3 class="native_user_msg">Hey David!!</h3>
                                                <p class="native_user_tag_line">Hurry up before it sold out.</p>
                                            </div>
                                            <div class="body_post">
                                                <div class="post_content">
                                                    <div class="post_image">
                                                        <img src="{{asset('assets/img/shirt.png')}}" class="image-responsive" width="100%">
                                                    </div>
                                                    <div class="post_info post_detail">
                                                        <h4>The Yasmit shirts</h4>
                                                        <p><span class="price_1"><del>{{ $currency }}149.95 </del> </span > <span class="price_2">{{ $currency }}89.99</span></span ><span class="price_3"> Save 20%</span></p>
                                                        <div class="line_break"><hr></div>
                                                        <div class="p_price">
                                                            <div class="p_price_left">
                                                                <h5>Subtotal</5>
                                                                <h5>Shipping</5>
                                                                <h5>Taxes</5>
                                                            </div>
                                                            <div class="p_price_right">
                                                                <h5>{{ $currency }}89.99</5>
                                                                <h5>Free</5>
                                                                <h5>Free</5>
                                                            </div>
                                                        </div>
                                                        <div class="line_break"><hr></div>
                                                        <div class="p_price">
                                                            <div class="p_price_left">
                                                                <h5>Totall</5>
                                                            </div>
                                                            <div class="p_price_right">
                                                                <h5>{{ $currency }}89.99</5>
                                                            </div>
                                                        </div>
                                                        <div class="p_size native_variants">
                                                            <p>size</p>
                                                            <select class="size_select">
                                                                <option>Medium</option>
                                                                <option>Size</option>
                                                                <option>Extra Large</option>
                                                                <option>Large</option>
                                                            </select>
                                                        </div>
                                                        <div class="p_size native_variants">
                                                            <p>Color</p>
                                                            <select class="size_select">
                                                                <option>Red</option>
                                                                <option>Yellow</option>
                                                                <option>Green</option>
                                                            </select>
                                                        </div>
                                                        <div class="p_size native_quantity">
                                                            <p>Quantity</p>
                                                            <input type="number" name="native_quantity" min="1" id="native_quantity" value="1">
                                                        </div>
                                                        <input type="button" value="Pay Now . {{ $currency }}89.99" class="pay_btn">
                                                        <input type="button" value="Decline this offer" class="decline">
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
                  <!-----------------Tab-2-Close----------------->
                <div id="menu-fbt-video" class="tab-pane fade p-0"><br><div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <iframe width="100%" height="515" src="https://www.youtube.com/embed/bVlhMewt8pg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
@include('includes.components.pickProductModal')
@include('includes.pages.native_ppu',[ "setting" => $upsellType->setting ])
@endsection
