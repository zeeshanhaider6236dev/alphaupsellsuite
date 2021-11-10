<!-----------Modal-4---------->
<div class="modal fade" id="centralModalSm4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <!-- Change class .modal-sm to change the size of the modal -->
   <form class="template-{{ $upsellTemplateId }}">
      <div class="modal-dialog modal-sm m_1_w" role="document">
         <div class="modal-content modal_1_show" style="height: 100vh;">
            <div class="modal-header">
               <h4 class="modal-title w-100 m_head_h">Customize Your Template</h4>
               <button type="button" class="close m1_close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body m_1_body">
               <div class="container">
                  <div class="col-md-12 popup_page">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="design_input">
                              <h3>Countdown For Sales Timer</h3>
                              <div class="custom-control custom-checkbox">
                                 <input type="checkbox" value="1" class="custom-control-input" id="alpha_t4_time_limit_toggler" name="alpha_t4_time_limit_toggler" 
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          {{ $upsell->setting['alpha_t4_time_limit_toggler'] ? "checked" : ""}}
                                       @else    
                                          {{ $setting['offer_time_limit'] ? "checked":"" }}
                                       @endif
                                    @else
                                       {{ $setting['offer_time_limit'] ? "checked":"" }}
                                    @endisset
                                 />
                                 <label class="custom-control-label" for="alpha_t4_time_limit_toggler">Add a Time Limit To The Offer</label>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Timer Duration In Minutes</label><br>
                                       <input type="number" name="alpha_t4_time_duration" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_time_duration'] }}"   
                                             @else    
                                               "{{ $setting['time_duration_minutes'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['time_duration_minutes'] }}"
                                          @endisset
                                       />    
                                    </p>
                                    <p class="f_input">
                                       <label>Timer Text</label><br>
                                       <input type="text"  placeholder="Deal Ends Soon:" name="alpha_t4_timer_heading" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_timer_heading'] }}"   
                                             @else    
                                               "{{ $setting['time_offer_heading'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['time_offer_heading'] }}"
                                          @endisset
                                       />    	  
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Font Family</label><br>
                                       <select name="alpha_t4_timer_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}" 
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['alpha_t4_timer_heading_font_family']  == $family ? "selected":"" }}   
                                                   @else    
                                                      {{ $setting['time_offer_font_family'] == $family ? "selected":"" }}
                                                   @endif
                                                @else
                                                    {{ $setting['time_offer_font_family'] == $family ? "selected":"" }}
                                                @endisset
                                             >
                                                {{ $family }}
                                             </option>
                                          @endforeach
                                       </select>
                                    </p>
                                    <p class="f_input">
                                       <label>Font Size</label><br>
                                       <input type="number" name="alpha_t4_timer_heading_font_size" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_timer_heading_font_size'] }}"   
                                             @else    
                                                "{{ $setting['time_offer_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['time_offer_font_size'] }}"
                                          @endisset
                                       />
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t4_timer_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t4_timer_heading_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_heading_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t4_timer_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{  $upsell->setting['alpha_t4_timer_heading_color']  }}"    
                                             @else    
                                                "{{ $setting['timer_heading_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_heading_color'] }}" 
                                          @endisset
                                       />
                                       <p>Timer Heading Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t4_timer_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t4_timer_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t4_timer_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_timer_color'] }}"    
                                             @else    
                                                "{{ $setting['timer_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_color'] }}" 
                                          @endisset
                                       />
                                       <p>Timer Color</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t4_timer_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t4_timer_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t4_timer_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_timer_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['timer_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_bg_color'] }}" 
                                          @endisset
                                       />
                                       <p>Timer Background Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t4_cross_icon_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t4_cross_icon_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t4_cross_icon_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_cross_icon_color'] }}"    
                                             @else    
                                                "{{ $setting['cross_icon_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cross_icon_color'] }}" 
                                          @endisset
                                       />
                                       <p>Icon Color </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t4_cross_icon_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t4_cross_icon_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t4_cross_icon_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_cross_icon_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['cross_icon_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cross_icon_bg_color'] }}" 
                                          @endisset
                                       "{{ $setting['cross_icon_bg_color'] }}" />
                                       <p>Icon Background Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Cart Product</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t4_cart_product_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t4_cart_product_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t4_cart_product_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_cart_product_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['cart_product_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cart_product_bg_color'] }}" 
                                          @endisset
                                       />
                                       <p>Background Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t4_cart_product_icon_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t4_cart_product_icon_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_cross_icon_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_cross_icon_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t4_cart_product_icon_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t4_cart_product_icon_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['cart_cross_icon_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cart_cross_icon_bg_color'] }}" 
                                          @endisset
                                       />
                                       <p>Icon Background Color</p>
                                       </form>
                                    </div>
                                 </div>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_cart_product_price_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_cart_product_price_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['cart_product_price_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['cart_product_price_color'] }};" 
                                             @endisset
                                          ></a>
                                          <input type="hidden" name="alpha_t4_cart_product_price_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_cart_product_price_color'] }}"    
                                                @else    
                                                   "{{ $setting['cart_product_price_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['cart_product_price_color'] }}" 
                                             @endisset
                                          />
                                          <p>Price Color </p>
                                       </div>
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_cart_product_checkout_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_cart_product_checkout_btn_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['cart_product_checkout_text_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['cart_product_checkout_text_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_cart_product_checkout_btn_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_cart_product_checkout_btn_color'] }}"    
                                                @else    
                                                   "{{ $setting['cart_product_checkout_text_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['cart_product_checkout_text_color'] }}" 
                                             @endisset
                                          />
                                          <p>Checkout Button Color </p>
                                       </div>
                                    </div>
                                 </div>
                                 <h3>Title</h3>
                                 <p class="h_input">
                                    <label>Heading</label><br>
                                    <input type="text" placeholder="Check out these items we think you would love!" name="alpha_t4_title_heading" value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['alpha_t4_title_heading'] }}"    
                                          @else    
                                             "{{ $setting['offer_heading'] }}"
                                          @endif
                                       @else
                                          "{{ $setting['offer_heading'] }}" 
                                       @endisset
                                    />    
                                 </p>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <p class="f_input">
                                          <label>Font Family</label><br>
                                          <select name="alpha_t4_title_heading_font_family">
                                             @foreach (config('upsell.strings.fontFamily') as $family)
                                                <option value="{{ $family }}" 
                                                   @isset($upsell)
                                                      @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                         {{ $upsell->setting['alpha_t4_title_heading_font_family']  == $family ? "selected":"" }}   
                                                      @else    
                                                         {{ $setting['offer_heading_font_family'] == $family ? "selected":"" }}
                                                      @endif
                                                   @else
                                                      {{ $setting['offer_heading_font_family'] == $family ? "selected":"" }}
                                                   @endisset
                                                >
                                                   {{ $family }}
                                                </option>
                                             @endforeach
                                          </select>
                                       </p>
                                       <p class="f_input">
                                          <label>Font Size</label><br>
                                          <input type="number" name="alpha_t4_title_heading_font_size" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_title_heading_font_size'] }}"   
                                                @else    
                                                   "{{ $setting['offer_heading_font_size'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['offer_heading_font_size'] }}"
                                             @endisset
                                          >    
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_title_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_title_heading_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['offer_heading_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['offer_heading_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_title_heading_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_title_heading_color'] }}"    
                                                @else    
                                                   "{{ $setting['offer_heading_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['offer_heading_color'] }}" 
                                             @endisset
                                          />
                                          <p>Heading Color </p>
                                       </div>
                                    </div>
                                 </div>
                                 <h3>Product</h3>
                                 <p class="h_input">
                                    <label>Button Text</label><br>
                                    <input type="text" name="alpha_t4_atc_btn"  value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['alpha_t4_atc_btn'] }}"    
                                          @else    
                                             "{{ $setting['add_to_cart_text'] }}"
                                          @endif
                                       @else
                                          "{{ $setting['add_to_cart_text'] }}" 
                                       @endisset
                                    />    
                                 </p>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_atc_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_atc_btn_bg_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['atc_background_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['atc_background_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_atc_btn_bg_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_atc_btn_bg_color'] }}"    
                                                @else    
                                                   "{{ $setting['atc_background_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['atc_background_color'] }}" 
                                             @endisset
                                          "{{ $setting['atc_background_color'] }}" />
                                          <p>Button Background Color</p>
                                       </div>
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_atc_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_atc_btn_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['atc_text_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['atc_text_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_atc_btn_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_atc_btn_color'] }}"    
                                                @else    
                                                   "{{ $setting['atc_text_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['atc_text_color'] }}" 
                                             @endisset
                                          />
                                          <p>Button Text Color</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_price_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_price_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['Original_price_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['Original_price_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_price_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_price_color'] }}"    
                                                @else    
                                                   "{{ $setting['Original_price_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['Original_price_color'] }}" 
                                             @endisset
                                          />
                                          <p>Original Price Color </p>
                                       </div>
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_discount_price_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_discount_price_bg_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['discount_background_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['discount_background_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_discount_price_bg_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_discount_price_bg_color'] }}"    
                                                @else    
                                                   "{{ $setting['discount_background_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['discount_background_color'] }}" 
                                             @endisset
                                          />
                                          <p>Discount Background Color </p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_discount_price_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_discount_price_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['discount_text_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['discount_text_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_discount_price_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_discount_price_color'] }}"    
                                                @else    
                                                   "{{ $setting['discount_text_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['discount_text_color'] }}" 
                                             @endisset
                                          />
                                          <p>Discount Text Color</p>
                                       </div>
                                    </div>
                                 </div>
                                 <h3 class="mt-4">Translation</h3>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <p class="f_input">
                                          <label>Checkout Button</label><br>
                                          <input type="text" placeholder="Checkout" name="alpha_t4_checkout_btn" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_checkout_btn'] }}"    
                                                @else    
                                                   "{{ $setting['checkout_button_text'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['checkout_button_text'] }}" 
                                             @endisset
                                          />    
                                       </p>
                                       <p class="f_input">
                                          <label>No Thanks Button</label><br>
                                          <input type="text" placeholder="No Thanks" name="alpha_t4_no_thanks_btn" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_no_thanks_btn'] }}"    
                                                @else    
                                                   "{{ $setting['no_thanks_button_text'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['no_thanks_button_text'] }}" 
                                             @endisset
                                          />    	  
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_checkout_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_checkout_btn_bg_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['checkout_background_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['checkout_background_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_checkout_btn_bg_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_checkout_btn_bg_color'] }}"    
                                                @else    
                                                   "{{ $setting['checkout_background_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['checkout_background_color'] }}" 
                                             @endisset
                                          />
                                          <p>Checkout Background Color </p>
                                       </div>
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_no_thanks_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_no_thanks_btn_bg_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['no_thanks_background_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['no_thanks_background_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_no_thanks_btn_bg_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_no_thanks_btn_bg_color'] }}"    
                                                @else    
                                                   "{{ $setting['no_thanks_background_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['no_thanks_background_color'] }}" 
                                             @endisset
                                          />
                                          <p>No,Thanks Background Color </p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_checkout_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_checkout_btn_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['checkout_text_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['checkout_text_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_checkout_btn_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_checkout_btn_color'] }}"    
                                                @else    
                                                   "{{ $setting['checkout_text_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['checkout_text_color'] }}" 
                                             @endisset
                                          />
                                          <p>Checkout Text Color </p>
                                       </div>
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_no_thanks_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_no_thanks_btn_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['no_thanks_text_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['no_thanks_text_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_no_thanks_btn_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_no_thanks_btn_color'] }}"    
                                                @else    
                                                   "{{ $setting['no_thanks_text_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['no_thanks_text_color'] }}" 
                                             @endisset
                                          />
                                          <p>No,Thanks Text Color </p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 font">
                                    <div class="row">
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_checkout_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_checkout_btn_border_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['checkout_border_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['checkout_border_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_checkout_btn_border_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_checkout_btn_border_color'] }}"    
                                                @else    
                                                   "{{ $setting['checkout_border_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['checkout_border_color'] }}" 
                                             @endisset
                                          />
                                          <p>Checkout Border Color </p>
                                       </div>
                                       <div class="f_input_color">
                                          <a href="#" data-id="alpha_t4_no_thanks_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "background-color:{{ $upsell->setting['alpha_t4_no_thanks_btn_border_color'] }};"    
                                                @else    
                                                   "background-color:{{ $setting['no_thanks_border_color'] }};"
                                                @endif
                                             @else
                                                "background-color:{{ $setting['no_thanks_border_color'] }};" 
                                             @endisset
                                          >
                                          </a>
                                          <input type="hidden" name="alpha_t4_no_thanks_btn_border_color" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t4_no_thanks_btn_border_color'] }}"    
                                                @else    
                                                   "{{ $setting['no_thanks_border_color'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['no_thanks_border_color'] }}" 
                                             @endisset
                                          />
                                          <p>No,Thanks Border Color </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="design_p_inpage pt-2">
                              <!-------Modal content------->
                              <div class="modal-content modal_4 alpha_atc_t_4">
                                 <div class="modal_4_head">
                                    <div>
                                       <span class="close alpha_t4_cross_icon" id="myModal4">×</span>
                                       <div class="b_timer4">
                                          <h4 class="b_timer4_heading">
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['alpha_t4_timer_heading'] }}   
                                                @else    
                                                {{ $setting['time_offer_heading'] }}
                                                @endif
                                             @else
                                             {{ $setting['time_offer_heading'] }}
                                             @endisset
                                          </h4>
                                          <div class="timer4">
                                             <input type="text" class="alpha_t4_timer t4_timer" readonly value=
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      "{{ $upsell->setting['alpha_t4_time_duration'] }}"   
                                                   @else    
                                                   "{{ $setting['time_duration_minutes'] }}"
                                                   @endif
                                                @else
                                                "{{ $setting['time_duration_minutes'] }}"
                                                @endisset
                                              ><input type="text" class="t4_timer" value="00" readonly>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="m4_top alpha_t4_cart_product" >
                                    <div style="display: flex; justify-content: space-between;">
                                       <span class="m4_t1"><i class="alpha_t4_p_t4_cross" style="background: #4A4A4A;"> &#10004;</i> Nivea Skin Firming And Toning Gel Cream...</span>
                                       <!-- <span class="m4_t2"><input type="number" min="1" value="2"></span> -->
                                       <span class="m4_t3 t4_Cart_product_price" style="font-weight: bold !important;">{{ $currency }}19.99</span>
                                       <!-- <span class="m4_t4 t4_checkout">Checkout</span> -->
                                    </div>
                                 </div>
                                 <div class="m4_body">
                                    <h2 class="t4_heading">
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             {{ $upsell->setting['alpha_t4_title_heading'] }}    
                                          @else    
                                             {{ $setting['offer_heading'] }}
                                          @endif
                                       @else
                                          {{ $setting['offer_heading'] }} 
                                       @endisset                                       
                                    </h2>
                                    <div class="m4_product_main">
                                       <div class="m4_detail">
                                          <div class="m4_p">
                                             <div class="m_4_img">
                                                <img src="{{ asset('assets') }}/img/m-5-1.jpg" alt="shoes">
                                             </div>
                                             <div class="m_4_img_detail">
                                                <h4>Discord Sunglasses</h4>
                                                <p>{{ $currency }}39.95 <span>30%Off</span></p>
                                                <select>
                                                   <option>Black</option>
                                                   <option>Blue</option>
                                                   <option>Red</option>
                                                </select>
                                                <input type="button" class="t4_atc_btn" value=
                                                   @isset($upsell)
                                                      @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                         "{{ $upsell->setting['alpha_t4_atc_btn'] }}"    
                                                      @else    
                                                         "{{ $setting['add_to_cart_text'] }}"
                                                      @endif
                                                   @else
                                                      "{{ $setting['add_to_cart_text'] }}" 
                                                   @endisset
                                                >
                                             </div>
                                          </div>
                                       </div>
                                       <div class="m4_detail">
                                          <div class="m4_p">
                                             <div class="m_4_img">
                                                <img src="{{ asset('assets') }}/img/m-5-2.jpg" alt="shoes">
                                             </div>
                                             <div class="m_4_img_detail">
                                                <h4>High Heels Shoes</h4>
                                                <p>{{ $currency }}79.95 <span>30%Off</span></p>
                                                <select class="img_select">
                                                   <option>Black</option>
                                                   <option>Blue</option>
                                                   <option>Red</option>
                                                </select>
                                                <select class="img_select">
                                                   <option>22</option>
                                                   <option>24</option>
                                                   <option>26</option>
                                                </select>
                                                <input type="button" class="t4_atc_btn" value=
                                                   @isset($upsell)
                                                      @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                         "{{ $upsell->setting['alpha_t4_atc_btn'] }}"    
                                                      @else    
                                                         "{{ $setting['add_to_cart_text'] }}"
                                                      @endif
                                                   @else
                                                      "{{ $setting['add_to_cart_text'] }}" 
                                                   @endisset
                                                >
                                             </div>
                                          </div>
                                       </div>
                                       <div class="m4_detail">
                                          <div class="m4_p">
                                             <div class="m_4_img">
                                                <img src="{{ asset('assets') }}/img/m-5-3.jpg" alt="shoes">
                                             </div>
                                             <div class="m_4_img_detail">
                                                <h4>Leather Shoulder Bag</h4>
                                                <p>{{ $currency }}54.95 <span>30%Off</span></p>
                                                <select>
                                                   <option>Black</option>
                                                   <option>Blue</option>
                                                   <option>Red</option>
                                                </select>
                                                <input type="button" class="t4_atc_btn" value=
                                                   @isset($upsell)
                                                      @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                         "{{ $upsell->setting['alpha_t4_atc_btn'] }}"    
                                                      @else    
                                                         "{{ $setting['add_to_cart_text'] }}"
                                                      @endif
                                                   @else
                                                      "{{ $setting['add_to_cart_text'] }}" 
                                                   @endisset
                                                >
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="m4_footer">
                                    <input type="button" class="m4_check t4_checkout" value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['alpha_t4_checkout_btn'] }}"    
                                          @else    
                                             "{{ $setting['checkout_button_text'] }}"
                                          @endif
                                       @else
                                          "{{ $setting['checkout_button_text'] }}" 
                                       @endisset
                                     >
                                    <input type="button" class="m4_thanks t4_thanks" value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['alpha_t4_no_thanks_btn'] }}"    
                                          @else    
                                             "{{ $setting['no_thanks_button_text'] }}"
                                          @endif
                                       @else
                                          "{{ $setting['no_thanks_button_text'] }}" 
                                       @endisset
                                     >
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
               @isset($upsell)
                  <button type="button" data-id="{{ $upsellTemplateId }}" class="save update_setting">Save Changes</button>
               @else
                  <button type="button" data-id="{{ $upsellTemplateId }}" class="save save_setting">Save Changes</button>
               @endisset
            </div>
         </div>
      </div>
   </form>
</div>
<!--------Modal-4-close------->