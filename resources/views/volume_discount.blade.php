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
                          <i class="fas fa-cogs"></i>
                          Configuration
                       </a>
                    </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#menu1">
                          <i class="fa fa-image"></i>
                          Preview
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
                              <label for="offer_name">Name:</label><br>
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
                              Target products are those products, on which you want to show an offer. Display your volume and quantity base discount on your product pages.
                              </p>
                           </div>
                           <div class="col-md-7 offer_right select_bg">
                              <div class="row mt-2">
                                 <div class="col-md-4 select_left">
                                    <h3>Upsell will Trigger on...</h3>
                                 </div>
                                 <div class="col-md-8 select_right">
                                    <button type="button" class="save pickTProduct" data-toggle="modal"
                                    data-target="#product_modal">
                                        Pick a Product
                                    </button>
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
                              <h4>Volume Discount Offer</h4>
                              <p>
                              Encourage customers to add more products to carts with offers like : 20% off or Save $10.
                              </p>
                           </div>
                           <div class="col-md-7 offer_right select_bg">
                           <div class="pickVolume itemContainer">
                              @isset($upsell)
                                @if($upsell->volumeDiscounts->count())
                                  @foreach ($upsell->volumeDiscounts as $volumeDiscount)
                                  <div class="row bg_hover volumeDiv">
                                    <div class="offer_qty col-md-2">
                                        <label>Quantity</label><br>
                                        <input type="number" value="{{ $volumeDiscount->quantity }}" min="1" name="quantity[]">
                                    </div>
                                    <div class="offer_disc col-md-3">
                                        <label>Discount:</label><br>
                                        <input type="number" value="{{ $volumeDiscount->discount }}" name="discount[]">
                                        <select name="offer[]">
                                            @if($volumeDiscount->discount_type == "% Off")
                                               <option value="{{ $volumeDiscount->discount_type }}"selected>{{ $volumeDiscount->discount_type }}</option>
                                               <option value="Fixed Amount">Fixed Amount</option>
                                               {{-- <option value="No Discount"> No Discount</option> --}}
                                            @elseif($volumeDiscount->discount_type == "Fixed Amount")
                                              <option value="{{ $volumeDiscount->discount_type }}" selected>{{ $volumeDiscount->discount_type }}</option>
                                              <option value="% Off">% Off</option>
                                              {{-- <option value="No Discount"> No Discount</option>  --}}
                                            {{-- @else
                                              <option value="{{ $volumeDiscount->discount_type }}" selected> {{ $volumeDiscount->discount_type }}</option>
                                              <option value="% Off">% Off</option>
                                              <option value="USD Off">USD Off</option> --}}
                                            @endif
                                        </select>
                                    </div>
                                    <div class="offer_most col-md-7">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <label>Best Deal</label><br>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                @php
                                                    if($volumeDiscount->best_deal == 1):
                                                        $best_deal = 1;
                                                    else:
                                                        $best_deal = 0;
                                                    endif;
                                                    $index = $loop->index;
                                                @endphp

                                                <input type="hidden" name="bestdeal[]" value="{{$best_deal}}" class="class_one">
                                                <input type="checkbox" class="custom-control-input" id="defaultInline{{$index}}" {{ $best_deal == 1 ? "checked" : ''}}>
                                                <label class="custom-control-label" for="defaultInline{{$index}}"></label>
                                            </div>
                                          </div>
                                          <div class="col-md-6 text-right">
                                            <i class="far fa-trash-alt alpha-upsell-deal-delete" title="click to delete deal"></i>
                                          </div>
                                        </div>
                                        <!-- <i class="fa fa-trash-o"></i> -->
                                    </div>
                                  </div>
                                  @endforeach
                                @endif
                             @else
                            <!---- First Deal--->
                           <div class="row bg_hover volumeDiv">
                            <div class="offer_qty col-md-2">
                                <label>Quantity</label><br>
                                <input type="number" value="{{ $upsellType->setting['quantity'] }}" min="1" name="quantity[]">
                            </div>
                            <div class="offer_disc col-md-3">
                                <label>Discount:</label><br>
                                <input type="number" value="{{ $upsellType->setting['discount'] }}" name="discount[]">
                                <select name="offer[]">
                                    <option value="{{ $upsellType->setting['offer'] }}"selected>% Off</option>
                                    <option value="Fixed Amount">Fixed Amount</option>
                                    {{-- <option value="No Discount"> No Discount</option> --}}
                                </select>
                            </div>
                            <div class="offer_most col-md-7">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label>Best Deal</label><br>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="hidden" name="bestdeal[]" value="0" class="class_one">
                                        <input type="checkbox" class="custom-control-input deal1" id="defaultInline1">
                                        <label class="custom-control-label" for="defaultInline1"></label>
                                    </div>
                                  </div>
                                  <div class="col-md-6 text-right">
                                    <i class="far fa-trash-alt alpha-upsell-deal-delete" title="click to delete deal"></i>
                                  </div>
                                </div>
                                <!-- <i class="fa fa-trash-o"></i> -->
                            </div>
                          </div>
                          <!---- End Of First Deal--->
                          <!---- Second Deal--->
                          <div class="row bg_hover volumeDiv">
                            <div class="offer_qty col-md-2">
                                <label>Quantity</label><br>
                                <input type="number" value="{{ $upsellType->setting['quantity'] }}" min="1" name="quantity[]">
                            </div>
                            <div class="offer_disc col-md-3">
                                <label>Discount:</label><br>
                                <input type="number" value="{{ $upsellType->setting['discount'] }}" name="discount[]">
                                <select name="offer[]">
                                    <option value="{{ $upsellType->setting['offer'] }}"selected>% Off</option>
                                    <option value="Fixed Amount">Fixed Amount</option>
                                    {{-- <option value="No Discount"> No Discount</option> --}}
                                </select>
                            </div>
                            <div class="offer_most col-md-7">
                               <div class="row">
                                  <div class="col-md-6">
                                    <label>Best Deal</label><br>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="hidden" name="bestdeal[]" value="1" class="class_one">
                                        <input type="checkbox" class="custom-control-input deal2" id="defaultInline2" value="1" checked>
                                        <label class="custom-control-label" for="defaultInline2"></label>
                                    </div>
                                  </div>
                                  <div class="col-md-6 text-right">
                                    <i class="far fa-trash-alt alpha-upsell-deal-delete" title="click to delete deal"></i>
                                  </div>
                                </div>
                                {{-- <i class="fa fa-trash-o"></i> --}}
                            </div>
                          </div>
                          <!---- End Of Second Deal--->
                          <!---- Third Deal--->
                          <div class="row bg_hover volumeDiv">
                            <div class="offer_qty col-md-2">
                                <label>Quantity</label><br>
                                <input type="number" value="{{ $upsellType->setting['quantity'] }}" min="1" name="quantity[]">
                            </div>
                            <div class="offer_disc col-md-3">
                                <label>Discount:</label><br>
                                <input type="number" value="{{ $upsellType->setting['discount'] }}" name="discount[]">
                                <select name="offer[]">
                                    <option value="{{ $upsellType->setting['offer'] }}"selected>% Off</option>
                                    <option value="Fixed Amount">Fixed Amount</option>
                                    {{-- <option value="No Discount"> No Discount</option> --}}
                                </select>
                            </div>
                            <div class="offer_most col-md-7">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label>Best Deal</label><br>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="hidden" name="bestdeal[]" value="0" class="class_one">
                                        <input type="checkbox" class="custom-control-input deal3" id="defaultInline3">
                                        <label class="custom-control-label" for="defaultInline3"></label>
                                    </div>
                                  </div>
                                  <div class="col-md-6 text-right">
                                    <i class="far fa-trash-alt alpha-upsell-deal-delete" title="click to delete deal"></i>
                                  </div>
                                </div>
                                <!-- <i class="fa fa-trash-o"></i> -->
                            </div>
                          </div>
                          @endisset
                          <!---- End Of Third Deal--->
                            </div>
                              <button type="button" class="save btn_f addNewVolume">
                                  Add Volume Row
                              </button>
                           </div>
                        </div>
                     </div>
                     <div class="container mt-4">
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
                                        style="height: 20px;" value="1"  checked>
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
                                  @php
                                    if(isset($upsell)):
                                        $end_date = $upsell['setting']['end_date'];
                                        $style = "background-color: #fffdfd;";
                                    else:
                                        $end_date = '';
                                        $style = "background-color: #dadada;";
                                    endif;
                                  @endphp
                                  <input value="{{ $end_date }}" name="end_date" type="date" id="end_date" style="{{$style}}">
                              </div>
                            </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-------------------tab-1-close--------------------->
                  <div id="menu1" class="tab-pane fade p-0">
                     <br>
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
                                                $volume_discount_heading = $upsell['setting']['volume_discount_heading'];
                                            else:
                                                $volume_discount_heading = $upsellType->setting['volume_discount_heading'];
                                            endif;
                                        @endphp
                                        <input type="text" value="{{ $volume_discount_heading }}" name="volume_discount_heading">
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
                                    <h3 class="mt-4">Color Settings</h3>
                                    <div class="col-md-12 font">
                                       <div class="row">
                                          <div class="f_input_color mt-3">
                                            @php
                                                if(isset($upsell)):
                                                    $quantity_color = $upsell['setting']['quantity_color'];
                                                else:
                                                    $quantity_color = $upsellType->setting['quantity_color'];
                                                endif;
                                            @endphp
                                             <a href="#" class="buttoncolor colorpicker" data-id="quantity_color" style="background-color:{{ $quantity_color }};">
                                             </a>
                                             <input value="{{ $quantity_color }}" type="hidden" name="quantity_color">
                                             <p>Quanity </p>
                                          </div>
                                          <div class="f_input_color mt-3">
                                            @php
                                                if(isset($upsell)):
                                                    $best_deal_color = $upsell['setting']['best_deal_color'];
                                                else:
                                                    $best_deal_color = $upsellType->setting['best_deal_color'];
                                                endif;
                                            @endphp
                                             <a href="#" class="buttoncolor colorpicker" data-id="best_deal_color" style="background-color:{{ $best_deal_color }};">
                                             </a>
                                             <input value="{{ $best_deal_color }}" type="hidden" name="best_deal_color">
                                             <p>Best Deal Background</p>
                                          </div>
                                          <div class="f_input_color mt-3">
                                            @php
                                                if(isset($upsell)):
                                                    $original_total_price_color = $upsell['setting']['original_total_price_color'];
                                                else:
                                                    $original_total_price_color = $upsellType->setting['original_total_price_color'];
                                                endif;
                                            @endphp
                                             <a href="#" class="buttoncolor colorpicker" data-id="original_total_price_color" style="background-color: {{ $original_total_price_color }};">
                                             </a>
                                             <input value="{{ $original_total_price_color }}" type="hidden" name="original_total_price_color">
                                             <p>Original Total Price</p>
                                          </div>
                                          <div class="f_input_color mt-3">
                                             <a href="#" class="buttoncolor colorpicker" data-id="discount_total_price_color" style="background-color: {{ $upsellType->setting['discount_total_price_color'] }};">
                                             </a>
                                             <input value="{{ $upsellType->setting['discount_total_price_color'] }}" type="hidden" name="discount_total_price_color">
                                             <p>Discount Total Price</p>
                                          </div>
                                          <div class="f_input_color mt-3">
                                            @php
                                                if(isset($upsell)):
                                                    $discount_badge_text_color = $upsell['setting']['discount_badge_text_color'];
                                                else:
                                                    $discount_badge_text_color = $upsellType->setting['discount_badge_text_color'];
                                                endif;
                                            @endphp
                                             <a href="#" class="buttoncolor colorpicker" data-id="discount_badge_text_color" style="background-color:{{ $discount_badge_text_color }};">
                                             </a>
                                             <input value="{{ $discount_badge_text_color }}" type="hidden" name="discount_badge_text_color">
                                             <p>Discount Badge Text Color</p>
                                          </div>
                                          <div class="f_input_color mt-3">
                                            @php
                                                if(isset($upsell)):
                                                    $discount_badge_background = $upsell['setting']['discount_badge_background'];
                                                else:
                                                    $discount_badge_background = $upsellType->setting['discount_badge_background'];
                                                endif;
                                            @endphp
                                             <a href="#" class="buttoncolor colorpicker" data-id="discount_badge_background" style="background-color: {{ $discount_badge_background }};">
                                             </a>
                                             <input value="{{ $discount_badge_background }}" type="hidden" name="discount_badge_background">
                                             <p>Discount Badge Background</p>
                                          </div>
                                          <div class="f_input_color mt-3">
                                            @php
                                                if(isset($upsell)):
                                                    $background_color = $upsell['setting']['background_color'];
                                                else:
                                                    $background_color = $upsellType->setting['background_color'];
                                                endif;
                                            @endphp
                                             <a href="#" class="buttoncolor colorpicker" data-id="background_color" style="background-color: {{ $background_color }};">
                                             </a>
                                             <input value="{{ $background_color }}" type="hidden" name="background_color">
                                             <p>Background Color</p>
                                          </div>
                                          <div class="f_input_color mt-3">
                                            @php
                                                if(isset($upsell)):
                                                    $hover_background_color = $upsell['setting']['hover_background_color'];
                                                else:
                                                    $hover_background_color = $upsellType->setting['hover_background_color'];
                                                endif;
                                            @endphp
                                             <a href="#" class="buttoncolor colorpicker" data-id="hover_background_color" style="background-color:{{ $hover_background_color }};">
                                             </a>
                                             <input value="{{ $hover_background_color }}" type="hidden" name="hover_background_color">
                                             <p>Background Hover Color</p>
                                          </div>
                                          <div class="f_input_color mt-3">
                                            @php
                                                if(isset($upsell)):
                                                    $container_background_color = $upsell['setting']['container_background_color'];
                                                else:
                                                    $container_background_color = $upsellType->setting['container_background_color'];
                                                endif;
                                            @endphp
                                             <a href="#" class="buttoncolor colorpicker" data-id="container_background_color" style="background-color:{{ $container_background_color }};">
                                             </a>
                                             <input value="{{ $container_background_color }}" type="hidden" name="container_background_color">
                                             <p>Container Background</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="design_preview">
                                    <div class="live_p">
                                       <h2 class="volume_discount_heading_style">{{ $upsellType->setting['volume_discount_heading'] }}</h2>
                                       <div class="volum_bg volum_bg1">
                                          <div class="volume_img">
                                             <img src="{{asset('assets')}}/img/bag.png" alt="bag">
                                          </div>
                                          <div class="volume_head">
                                             <h3 class="quantity_color_style">2 Quantities</h3>
                                             <h4 class="best_deal_color_style">Best Deal</h4>
                                          </div>
                                          <div class="volume_dis">
                                             <h5 class="discount_badge_text_style discount_badge_background_style">10% Off</h5>
                                          </div>
                                          <div class="disc_price">
                                             <h2 class="discount_total_price_style">{{ $currency }}19.99</h2>
                                             <p class="original_total_price_style">{{ $currency }}29.99</p>
                                          </div>
                                       </div>
                                       <div class="volum_bg volume_best volum_bg2">
                                          <div class="volume_img">
                                             <img src="{{asset('assets')}}/img/bag.png" alt="bag">
                                          </div>
                                          <div class="volume_head">
                                             <h3 class="quantity_color_style">3 Quantities</h3>
                                             <h4 class="best_deal_color_style">Best Deal</h4>
                                          </div>
                                          <div class="volume_dis">
                                             <h5 class="discount_badge_text_style discount_badge_background_style">20% Off</h5>
                                          </div>
                                          <div class="disc_price">
                                             <h2 class="discount_total_price_style">{{ $currency }}19.99</h2>
                                             <p class="original_total_price_style">{{ $currency }}39.99</p>
                                          </div>
                                       </div>
                                       <div class="volum_bg volum_bg3">
                                          <div class="volume_img">
                                             <img src="{{asset('assets')}}/img/bag.png" alt="bag">
                                          </div>
                                          <div class="volume_head">
                                             <h3 class="quantity_color_style">5 Quantities</h3>
                                             <h4 class="best_deal_color_style">Best Deal</h4>
                                          </div>
                                          <div class="volume_dis">
                                             <h5 class="discount_badge_text_style discount_badge_background_style">30% Off</h5>
                                          </div>
                                          <div class="disc_price">
                                             <h2 class="discount_total_price_style">{{ $currency }}19.99</h2>
                                             <p class="original_total_price_style">{{ $currency }}49.99</p>
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
                                 <iframe width="100%" height="515" src="https://www.youtube.com/embed/U_MkoqnmBWM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
@include('includes.pages.volume_discount',[ "setting" => $upsellType->setting ])
@endsection
