<!-----------Modal-5---------->
<div class="modal fade" id="centralModalSm5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                 <input type="checkbox" value="1" class="custom-control-input" name="alpha_t5_time_limit_toggler" id="alpha_t5_time_limit_toggler" 
                                     @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          {{ $upsell->setting['alpha_t5_time_limit_toggler'] ? "checked" : ""}}
                                       @else    
                                          {{ $setting['offer_time_limit'] ? "checked":"" }}
                                       @endif
                                    @else
                                       {{ $setting['offer_time_limit'] ? "checked":"" }}
                                    @endisset                                 
                                 />
                                 <label class="custom-control-label" for="alpha_t5_time_limit_toggler">Add a Time Limit To The Offer</label>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Timer Duration In Minutes</label><br>
                                       <input type="number" name="alpha_t5_time_duration" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_time_duration'] }}"   
                                             @else    
                                               "{{ $setting['time_duration_minutes'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['time_duration_minutes'] }}"
                                          @endisset
                                       >
                                    </p>
                                    <p class="f_input">
                                       <label>Timer Text</label><br>
                                       <input type="text" placeholder="Don't miss our special deals:" name="alpha_t5_timer_heading" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_timer_heading'] }}"   
                                             @else    
                                               "{{ $setting['time_offer_heading'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['time_offer_heading'] }}"
                                          @endisset
                                       >
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Font Family</label><br>
                                       <select name="alpha_t5_timer_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}" 
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['alpha_t5_timer_heading_font_family']  == $family ? "selected":"" }}   
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
                                       <input type="number" max="18" name="alpha_t5_timer_heading_font_size" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_timer_heading_font_size'] }}"   
                                             @else    
                                                "{{ $setting['time_offer_font_size'] }}" 
                                             @endif
                                          @else
                                             "{{ $setting['time_offer_font_size'] }}" 
                                          @endisset
                                       >
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_time_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_time_heading_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_heading_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_time_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_time_heading_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_timer_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_timer_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_timer_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_timer_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_timer_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_timer_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_timer_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_timer_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_cross_icon_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_cross_icon_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_cross_icon_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_cross_icon_color'] }}"    
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
                              <h3>Cart Product</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_cart_product_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_cart_product_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_bg_color'] }};" 
                                          @endisset
                                       > 
                                       </a>
                                       <input type="hidden" name="alpha_t5_cart_product_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_cart_product_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_cart_produt_price_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_cart_produt_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_price_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_price_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_cart_produt_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_cart_produt_price_color'] }}"    
                                             @else    
                                                "{{ $setting['cart_product_price_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cart_product_price_color'] }}" 
                                          @endisset
                                       />
                                       <p>Price Color</p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Product</h3>
                              <p class="h_input">
                                 <label>Button Text</label><br>
                                 <input type="text" placeholder="Add" name="alpha_t5_atc_btn" value=
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          "{{ $upsell->setting['alpha_t5_atc_btn'] }}"    
                                       @else    
                                          "{{ $setting['add_to_cart_text'] }}"
                                       @endif
                                    @else
                                       "{{ $setting['add_to_cart_text'] }}" 
                                    @endisset
                                 >    
                              </p>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_atc_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_atc_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_atc_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_atc_btn_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['atc_background_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['atc_background_color'] }}" 
                                          @endisset
                                       />
                                       <p>Button Background Color</p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_atc_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_atc_btn_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_atc_btn_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_atc_btn_border_color'] }}"    
                                             @else    
                                                "{{ $setting['atc_border_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['atc_border_color'] }}" 
                                          @endisset
                                       />
                                       <p>Button Border Color</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_atc_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_atc_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_atc_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_atc_btn_color'] }}"    
                                             @else    
                                                "{{ $setting['atc_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['atc_text_color'] }}" 
                                          @endisset
                                       />
                                       <p>Button Text Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_price_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_heading_color'] }};" 
                                          @endisset
                                       "background-color:{{ $setting['original_price_color'] }};">
                                       </a>
                                       <input type="hidden" name="alpha_t5_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_price_color'] }}"    
                                             @else    
                                                "{{ $setting['original_price_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['original_price_color'] }}" 
                                          @endisset
                                       />
                                       <p>Original Price Color</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_discount_price_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_discount_price_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['discount_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_discount_price_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_discount_price_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['discount_background_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['discount_background_color'] }}" 
                                          @endisset
                                       />
                                       <p>Discount Background Color</p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_discount_price_color" class="buttoncolor  colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_discount_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['discount_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_discount_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_discount_price_color'] }}"    
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
                                       <input type="text" placeholder="Continue To Checkout" name="alpha_t5_checkout_btn" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_checkout_btn'] }}"    
                                             @else    
                                                "{{ $setting['checkout_button_text'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['checkout_button_text'] }}" 
                                          @endisset
                                       >    
                                    </p>
                                    <p class="f_input">
                                       <label>No Thanks Button</label><br>
                                       <input type="text" placeholder="No Thanks" name="alpha_t5_no_thanks_btn" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_no_thanks_btn'] }}"    
                                             @else    
                                                "{{ $setting['no_thanks_button_text'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['no_thanks_button_text'] }}" 
                                          @endisset
                                       >    	  
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t5_checkout_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_checkout_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_checkout_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_checkout_btn_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_no_thanks_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_no_thanks_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_no_thanks_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_no_thanks_btn_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_checkout_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_checkout_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_checkout_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_checkout_btn_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_no_thanks_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_no_thanks_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_no_thanks_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_no_thanks_btn_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_checkout_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_checkout_btn_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_checkout_btn_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_checkout_btn_border_color'] }}"    
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
                                       <a href="#" data-id="alpha_t5_no_thanks_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t5_no_thanks_btn_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t5_no_thanks_btn_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t5_no_thanks_btn_border_color'] }}"    
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
                        <div class="col-md-6">
                           <div class="design_p_inpage pt-2">
                              <!-------Modal content------->
                              <div class="modal-content modal-3 alpha_atc_t_5">
                                 <div class="modal_3_head">
                                    <div>
                                       <span class="close t5_cross_icon" id="myModal4">×</span>
                                       <div class="b_timer3">
                                          <h4 class="alpha_t5_timer_heading">
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['alpha_t5_timer_heading'] }}   
                                                @else    
                                                {{ $setting['time_offer_heading'] }}
                                                @endif
                                             @else
                                             {{ $setting['time_offer_heading'] }}
                                             @endisset
                                          </h4>
                                          <div class="timer3 t5_timer_d">
                                             <input type="text" class="t5_timer alpha_t5_timer" value=
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      "{{ $upsell->setting['alpha_t5_time_duration'] }}"   
                                                   @else    
                                                   "{{ $setting['time_duration_minutes'] }}"
                                                   @endif
                                                @else
                                                "{{ $setting['time_duration_minutes'] }}"
                                                @endisset
                                             ><input type="text" value="00" class="alpha_t5_timer">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="m_3_top">
                                    <div class="m_3_top_img" style="width: 6% !important">
                                    <i class="fas fa-check"></i>
                                       <!-- <img src="{{ asset('assets')}}/img/m-3-cart.png" alt="cart"> -->
                                    </div>
                                    <div class="m_3_top_price">
                                       <h4 style="font-weight: bold !important;"> Diagonal Stripe Card Wallet <span>{{ $currency }}99.95</span></h4>
                                    </div>
                                 </div>
                                 <div class="modal_3_body">
                                    <div class="m_3_p">
                                       <div class="m_3_p_img">
                                          <img src="{{ asset('assets')}}/img/m-3-1.png" alt="watch">
                                       </div>
                                       <div class="m_3_p_detail">
                                          <div class="m_3_name">
                                             <h3>
                                                CURREN MEN'S TOP QUALITY WATCH <br>(DIAL 4.6CM) - CUR 148
                                                <span>
                                                   <select>
                                                      <option>Brown</option>
                                                      <option>Black</option>
                                                   </select>
                                                   <input type="button" class="alpha_t5_atc_btn alpha_t5_atc_btn-or" value=
                                                      @isset($upsell)
                                                         @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                            "{{ $upsell->setting['alpha_t5_atc_btn'] }}"    
                                                         @else    
                                                            "{{ $setting['add_to_cart_text'] }}"
                                                         @endif
                                                      @else
                                                         "{{ $setting['add_to_cart_text'] }}" 
                                                      @endisset
                                                   >
                                                </span>
                                             </h3>
                                             <p>{{ $currency }}99.95 <span>30%Off</span></p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="m_3_p">
                                       <div class="m_3_p_img">
                                          <img src="{{ asset('assets')}}/img/m-3-2.jpg" alt="belt">
                                       </div>
                                       <div class="m_3_p_detail">
                                          <div class="m_3_name">
                                             <h3>
                                                CURREN MEN'S TOP QUALITY WATCH <br>(DIAL 4.6CM) - CUR 148
                                                <span>
                                                   <select>
                                                      <option>Brown</option>
                                                      <option>Black</option>
                                                   </select>
                                                   <input type="button" class="alpha_t5_atc_btn alpha_t5_atc_btn-or" value=
                                                      @isset($upsell)
                                                         @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                            "{{ $upsell->setting['alpha_t5_atc_btn'] }}"    
                                                         @else    
                                                            "{{ $setting['add_to_cart_text'] }}"
                                                         @endif
                                                      @else
                                                         "{{ $setting['add_to_cart_text'] }}" 
                                                      @endisset
                                                   >
                                                </span>
                                             </h3>
                                             <p>{{ $currency }}99.95 <span>30%Off</span></p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="m_3_p">
                                       <div class="m_3_p_img">
                                          <img src="{{ asset('assets')}}/img/m-3-3.jpg" alt="wallet">
                                       </div>
                                       <div class="m_3_p_detail">
                                          <div class="m_3_name">
                                             <h3>
                                                CURREN MEN'S TOP QUALITY WATCH <br>(DIAL 4.6CM) - CUR 148
                                                <span>
                                                   <select>
                                                      <option>Brown</option>
                                                      <option>Black</option>
                                                   </select>
                                                   <input type="button" class="alpha_t5_atc_btn alpha_t5_atc_btn-or " value=
                                                      @isset($upsell)
                                                         @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                            "{{ $upsell->setting['alpha_t5_atc_btn'] }}"    
                                                         @else    
                                                            "{{ $setting['add_to_cart_text'] }}"
                                                         @endif
                                                      @else
                                                         "{{ $setting['add_to_cart_text'] }}" 
                                                      @endisset
                                                   >
                                                </span>
                                             </h3>
                                             <p>{{ $currency }}99.95 <span>30%Off</span></p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal_3_footer">
                                    <button type="button" class="m3_btn1 t5_checkout_btn">
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             {{ $upsell->setting['alpha_t5_checkout_btn'] }}    
                                          @else    
                                             {{ $setting['checkout_button_text'] }}
                                          @endif
                                       @else
                                          {{ $setting['checkout_button_text'] }} 
                                       @endisset
                                    </button> 
                                    <button type="button" class="m3_btn2 t5_no_thanks_btn">
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             {{ $upsell->setting['alpha_t5_no_thanks_btn'] }}    
                                          @else    
                                             {{ $setting['no_thanks_button_text'] }}
                                          @endif
                                       @else
                                          {{ $setting['no_thanks_button_text'] }} 
                                       @endisset
                                    </button> 
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