@extends('vendor.shopify-app.layouts.default')
@section('content')
@include('includes.upsell_header')
<div class="container-fluid">
   <div class="container">
      <div class="col-md-12 tabs">
         <div class="tabs">
            <div class="tab_bg">
               <form class="upsellForm">
                  <input type="hidden" name="upsell_template_type" class="template-to-select" @isset($upsell) value = "{{ $upsell->setting['upsell_template_type'] }}" @else value= "1" @endisset>
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
                                 <label>Name:</label><br>
                                 <input type="text" name="name" placeholder="Enter Offer Name...!!" @isset($upsell) value = "{{ $upsell->name }}"@endisset>
                              </div>
                           </div>
                        </div>
                        <div class="container">
                           <div class="row">
                              <div class="col-md-5 offer_left">
                                 <h4>Select Target Products</h4>
                                 <p>
                                 Target products are those products, on which you want to show an offer. When a customer will click on Add to Cart Button, then an offer will pop up on those products.
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
                                 Upsell products are those products, which you want to show in the offer. When customers click targeted products Add to Cart Button, then upsell products will be shown on offer.
                                 </p>
                              </div>
                              <div class="col-md-7 offer_right select_bg">
                                 <div class="row mt-2">
                                    <div class="col-md-4 select_left">
                                       <h3>Upsell will Appear on...</h3>
                                    </div>
                                    <div class="col-md-8 select_right">
                                       <input class="autoHidden" type="hidden" name="auto" value="{{ isset($upsell) && $upsell->auto ? '1' : '0'}}">
                                        <button id="ppu_button"type="button" class="autoButton ppu-auto-button {{ isset($upsell) && $upsell->auto ? 'autoTrue save' : 'delete'}}">Auto</button>
                                       <button type="button" class="save pickAProduct" data-toggle="modal"
                                          data-target="#product_modal">Pick a Product</button>
                                       <button type="button" class="cancel removeAll">Remove All</button>
                                 </div>
                                 </div>
                                 <hr>
                                 <div>
                                    <div id="auto-collapse-box" class="collapse itemContainer item-container-auto-module" style="display:block;">
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
                                 <h4>Discount Details</h4>
                                 <p>
                                    Choose the discount type here whether you want to apply discount in percentage, a fix price or no discount.
                                 </p>
                              </div>
                              <div class="col-md-7 offer_right">
                                 <div class="row">
                                    <div class="col-md-6 discount_left">
                                       <label>Discount Type:</label><br>
                                       <select name="discount_type">
                                          <option @if(isset($upsell))
                                                   {{ $upsell->setting['discount_type'] == "% Off" ? "selected" : '' }}
                                             @else
                                                   {{ $upsellType->setting['discount_type'] == "% Off" ? "selected" : '' }}
                                             @endif
															value="% Off">% Off
                                          </option>
                                          <option @if(isset($upsell))
                                                      {{ $upsell->setting['discount_type'] == "Fixed Price Off" ? "selected" : '' }}
                                                @else
                                                      {{ $upsellType->setting['discount_type'] == "Fixed Price Off" ? "selected" : '' }}
                                                @endif
															value="Fixed Price Off">Fixed Price Off
                                          </option>
                                          {{-- <option @if(isset($upsell))
                                                      {{ $upsell->setting['discount_type'] == "No Discount" ? "selected" : '' }}
                                                @else
                                                      {{ $upsellType->setting['discount_type'] == "No Discount" ? "selected" : '' }}
                                                @endif
															values="No Discount">No Discount
                                          </option> --}}
                                       </select>
                                    </div>
                                    <div class="col-md-6 discount_left">
                                       <label>Discount Value:</label><br>
                                       <input type="number" name="discount_value" value=
                                          @if(isset($upsell))
															"{{$upsell->setting['discount_value']}}"
														@else
															"{{$upsellType->setting['discount_value']}}"
														@endif
														min="0"
                                       />
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
                                    <div class="row">
                                       <div class="form-check form_float ml-3">
                                          <input type="checkbox" value="1" class="form-check-input" id="formCheck-1" style="height: 20px;" name="work_on_desktop"
                                          @if(isset($upsell))
                                             {{ $upsell->setting['work_on_desktop']  ? "checked" : '' }}
                                          @else
                                             {{ $upsellType->setting['work_on_desktop']  ? "checked" : '' }}
                                          @endif
                                          />
                                          <label class="form-check-label" for="formCheck-1">
                                             Desktop
                                          </label>
                                       </div>
                                       <div class="form-check form_float">
                                          <input type="checkbox" value="1" class="form-check-input" id="formCheck-3" style="height: 20px;" name="work_on_mobile"
                                          @if(isset($upsell))
                                             {{ $upsell->setting['work_on_mobile']  ? "checked" : '' }}
                                          @else
                                             {{ $upsellType->setting['work_on_mobile']  ? "checked" : '' }}
                                          @endif
                                          />
                                          <label class="form-check-label" for="formCheck-3">
                                             Mobile
                                          </label>
                                       </div>
                                    </div>
                                 <hr>
                                 <h4>Schedule:</h4>
                                 <div class="row">
                                 <div class="col-md-6 discount_left">
                                       <label>Start Date:</label><br>
                                       <input value=
														@if(isset($upsell))
															"{{ $upsell->setting['start_date']}}"
														@else
															"{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
														@endif
                                          name="start_date" type="date"
                                       />
                                 </div>
                                 <div class="col-md-6 discount_left">
                                       <label>End Date:</label><br>
                                       <input value="{{ isset($upsell['setting']['end_date']) ? $upsell['setting']['end_date'] : '' }}" class="end_date" name="end_date" type="date" style="background-color: #dadada;" />
                                 </div>
                              </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!----------tab-1-close----------->
                     <div id="menu1" class="tab-pane fade p-0">
                        <h2 class="choose_h">Choose A Funnel Template</h2>
                        <div class="row">
                           <div class="col-md-4 template_1 popup-box-color" ">
                              @isset($upsell)
                                 @if ( $upsell->setting['upsell_template_type'] == 1)
                                    <div class="alpha_t_u_choosen">
                                       <span>&#10003;</span>
                                    </div>
                                 @endif
                              @else
                                 <div class="alpha_t_u_choosen">
                                    <span>&#10003;</span>
                                 </div>
                              @endisset
                              <div class="popup_1 @isset($upsell) {{ $upsell->setting['upsell_template_type'] == 1 ? "select_popup":'' }} @else {{ "select_popup" }} @endisset" style="background-color: white !important;">
                                 <div data-toggle="modal" data-target="#centralModalSm">
                                    <a href="#lightbox" data-slide-to="0">
                                       <img src="{{ asset('assets')}}/img/template-1.jpg" alt=""></a>
                                 </div>
                                 <button type="button" class="save select-template" data-toggle="modal" data-target="#centralModalSm">Select Template</button>
                              </div>
                           </div>
                           <div class="col-md-4 template_2 popup-box-color">
                              @isset($upsell)
                                 @if ( $upsell->setting['upsell_template_type'] == 2)
                                    <div class="alpha_t_u_choosen">
                                       <span>&#10003;</span>
                                    </div>
                                 @endif
                              @endisset
                              <div class="popup_1 @isset($upsell) {{ $upsell->setting['upsell_template_type'] == 2 ? "select_popup":'' }} @endisset" style="background-color: white !important;">
                                 <div data-toggle="modal" data-target="#centralModalSm2">
                                    <a href="#lightbox" data-slide-to="1">
                                       <img src="{{ asset('assets')}}/img/template-2.jpg" alt="">
                                    </a>
                                 </div>
                                 <button type="button" class="save select-template" data-toggle="modal" data-target="#centralModalSm2">
                                    Select Template
                                 </button>
                              </div>
                           </div>
                           <div class="col-md-4 template_3 popup-box-color" >
                              @isset($upsell)
                                 @if ( $upsell->setting['upsell_template_type'] == 3)
                                    <div class="alpha_t_u_choosen">
                                       <span>&#10003;</span>
                                    </div>
                                 @endif
                              @endisset
                              <div class="popup_1 @isset($upsell) {{ $upsell->setting['upsell_template_type'] == 3 ? "select_popup":'' }} @endisset" style="background-color: white !important;">
                                 <div data-toggle="modal" data-target="#centralModalSm3">
                                    <a href="#lightbox" data-slide-to="2">
                                       <img src="{{ asset('assets')}}/img/template-3.jpg" alt="">
                                    </a>
                                 </div>
                                 <button type="button" class="save select-template" data-toggle="modal" data-target="#centralModalSm3">
                                    Select Template
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="row mt-4 ">
                           <div class="col-md-4 template_4 popup-box-color" >
                              @isset($upsell)
                                 @if ( $upsell->setting['upsell_template_type'] == 4)
                                    <div class="alpha_t_u_choosen">
                                       <span>&#10003;</span>
                                    </div>
                                 @endif
                              @endisset
                              <div class="popup_1 @isset($upsell) {{ $upsell->setting['upsell_template_type'] == 4 ?"select_popup":'' }} @endisset" style="background-color: white !important;">
                                 <div data-toggle="modal" data-target="#centralModalSm4">
                                    <a href="#lightbox" data-slide-to="3">
                                       <img src="{{ asset('assets')}}/img/template-4.jpg" alt="">
                                    </a>
                                 </div>
                                 <button type="button" class="save select-template" data-toggle="modal" data-target="#centralModalSm4">
                                    Select Template
                                 </button>
                              </div>
                           </div>
                           <div class="col-md-4 template_5 popup-box-color" >
                              @isset($upsell)
                                 @if ( $upsell->setting['upsell_template_type'] == 5)
                                    <div class="alpha_t_u_choosen">
                                       <span>&#10003;</span>
                                    </div>
                                 @endif
                              @endisset
                              <div class="popup_1 @isset($upsell) {{ $upsell->setting['upsell_template_type'] == 5 ?"select_popup":'' }} @endisset" style="background-color: white !important;">
                                 <div data-toggle="modal" data-target="#centralModalSm5">
                                    <a href="#lightbox" data-slide-to="4">
                                       <img src="{{ asset('assets')}}/img/template-5.jpg" alt="">
                                    </a>
                                 </div>
                                 <button type="button" class="save select-template" data-toggle="modal" data-target="#centralModalSm5">
                                    Select Template
                                 </button>
                              </div>
                           </div>
                           <div class="col-md-4 template_6 popup-box-color">
                              @isset($upsell)
                                 @if ( $upsell->setting['upsell_template_type'] == 6)
                                    <div class="alpha_t_u_choosen">
                                       <span>&#10003;</span>
                                    </div>
                                 @endif
                              @endisset
                              <div class="popup_1 @isset($upsell) {{ $upsell->setting['upsell_template_type'] == 6 ?"select_popup":'' }} @endisset"  style="background-color: white !important;">
                                 <div data-toggle="modal" data-target="#centralModalSm6">
                                    <a href="#lightbox" data-slide-to="5">
                                       <img src="{{ asset('assets')}}/img/template-6-fix.jpg" alt="">
                                    </a>
                                 </div>
                                 <button type="button" class="save select-template" data-toggle="modal" data-target="#centralModalSm6">
                                    Select Template
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Lightbox Gallery by Bootstrap 4" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal_w" role="document">
                              <div class="modal-content">
                                 <div class="modal-body">
                                    <div id="lightbox" class="carousel slide" data-ride="carousel" data-interval="8000" data-keyboard="true">
                                       <ol class="carousel-indicators">
                                          <li data-target="#lightbox" data-slide-to="0"></li>
                                          <li data-target="#lightbox" data-slide-to="1"></li>
                                          <li data-target="#lightbox" data-slide-to="2"></li>
                                          <li data-target="#lightbox" data-slide-to="3"></li>
                                          <li data-target="#lightbox" data-slide-to="4"></li>
                                          <li data-target="#lightbox" data-slide-to="5"></li>
                                       </ol>
                                       <div class="carousel-inner">
                                          <div class="carousel-item active">
                                             <img src="{{ asset('assets')}}/img/template-1.jpg" class="w-100" alt="">
                                          </div>
                                          <div class="carousel-item">
                                             <img src="{{ asset('assets')}}/img/template-2.jpg" class="w-100" alt="">
                                          </div>
                                          <div class="carousel-item">
                                             <img src="{{ asset('assets')}}/img/template-3.jpg" class="w-100" alt="">
                                          </div>
                                          <div class="carousel-item">
                                             <img src="{{ asset('assets')}}/img/template-4.jpg" class="w-100" alt="">
                                          </div>
                                          <div class="carousel-item">
                                             <img src="{{ asset('assets')}}/img/template-5.jpg" class="w-100" alt="">
                                          </div>
                                          <div class="carousel-item">
                                             <img src="{{ asset('assets')}}/img/template-6-fix.jpg" class="w-100" alt="">
                                          </div>
                                       </div>
                                       <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="sr-only">Previous</span>
                                       </a>
                                       <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="sr-only">Next</span>
                                       </a>
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
                                 <iframe width="100%" height="515" src="https://www.youtube.com/embed/aU7EStux9aY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
<!-----------All Templates---------->
@foreach ($upsellTemplates as $key => $template)
   @include('includes.components.add_to_cart_template'.($key+1),['setting' => $upsellTemplates[$key]->setting,'upsellTemplateId' => $upsellTemplates[$key]->id])
@endforeach

@include('includes.components.pickProductModal')

@include('includes.pages.add_to_cart')
@endsection
