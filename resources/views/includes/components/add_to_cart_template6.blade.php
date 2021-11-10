<div class="modal fade" id="centralModalSm6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                              <h3>Title</h3>
                              <p class="h_input">
                                 <label>Heading</label><br>
                                 <input type="text" name="alpha_t6_top_heading" value=
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          "{{ $upsell->setting['alpha_t6_top_heading'] }}"   
                                       @else    
                                          "{{ $setting['top_heading'] }}"
                                       @endif
                                    @else
                                       "{{ $setting['top_heading'] }}"
                                    @endisset 
                                 >
                              </p>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Font Family</label><br>
                                       <select name="alpha_t6_top_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}" 
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['alpha_t6_top_heading_font_family']  == $family ? "selected":"" }}   
                                                   @else    
                                                       {{ $setting['top_heading_font_family'] == $family ? "selected":"" }}
                                                   @endif
                                                @else
                                                    {{ $setting['top_heading_font_family'] == $family ? "selected":"" }}
                                                @endisset 
                                             >
                                                {{ $family }}
                                             </option>
                                          @endforeach
                                       </select>
                                    </p>
                                    <p class="f_input">
                                       <label>Font Size</label><br>
                                       <input type="number" name="alpha_t6_top_heading_font_size" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_top_heading_font_size'] }}"   
                                             @else    
                                                "{{ $setting['top_heading_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['top_heading_font_size'] }}"
                                          @endisset 
                                       >
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_top_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_top_heading_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_heading_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_top_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_top_heading_color'] }}"    
                                             @else    
                                                "{{ $setting['timer_heading_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_heading_color'] }}" 
                                          @endisset
                                       />
                                       <p>Heading Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_cross_icon_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_cross_icon_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_cross_icon_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_cross_icon_color'] }}"    
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
                                       <a href="#" data-id="alpha_t6_cross_icon_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_cross_icon_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_cross_icon_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_cross_icon_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['cross_icon_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cross_icon_bg_color'] }}" 
                                          @endisset
                                       />
                                       <p>Icon Background Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Cart Product</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_cart_product_title_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_cart_product_title_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_title_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_title_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_cart_product_title_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_cart_product_title_color'] }}"    
                                             @else    
                                                "{{ $setting['cart_product_title_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cart_product_title_color'] }}" 
                                          @endisset
                                       />
                                       <p>Title Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_cart_product_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_cart_product_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_cart_product_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_cart_product_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['cart_product_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cart_product_bg_color'] }}" 
                                          @endisset
                                       />
                                       <p>Background Color</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_cart_product_price_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_cart_product_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_price_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_price_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_cart_product_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_cart_product_price_color'] }}"    
                                             @else    
                                                "{{ $setting['cart_product_price_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cart_product_price_color'] }}" 
                                          @endisset
                                       />
                                       <p>Price Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Product</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Title</label><br>
                                       <input type="text" placeholder="You May Be Interested In..." name="alpha_t6_product_heading" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_product_heading'] }}"   
                                             @else    
                                                "{{ $setting['offer_heading'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['offer_heading'] }}"
                                          @endisset 
                                       >
                                    </p>
                                    <p class="f_input">
                                       <label>Button Text</label><br>
                                       <input type="text" placeholder="Add To Cart" name="alpha_t6_cart_btn" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_cart_btn'] }}"   
                                             @else    
                                                "{{ $setting['add_to_cart_text'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['add_to_cart_text'] }}"
                                          @endisset 
                                       >
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_product_title_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_product_title_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['offer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['offer_heading_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_product_title_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_product_title_color'] }}"    
                                             @else    
                                                "{{ $setting['offer_heading_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['offer_heading_color'] }}" 
                                          @endisset
                                       />
                                       <p>Title Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_price_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['orignal_price_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['orignal_price_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_price_color'] }}"    
                                             @else    
                                                "{{ $setting['orignal_price_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['orignal_price_color'] }}" 
                                          @endisset
                                       />
                                       <p>Original Price Color</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_dicount_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_dicount_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['discount_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_dicount_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_dicount_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t6_discount_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_discount_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['discount_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_discount_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_discount_color'] }}"    
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
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t6_atc_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_atc_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_atc_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_atc_btn_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t6_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_btn_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_btn_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_btn_border_color'] }}"    
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
                                       <a href="#" data-id="alpha_t6_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_btn_color'] }}"    
                                             @else    
                                                "{{ $setting['atc_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['atc_text_color'] }}" 
                                          @endisset
                                       />
                                       <p>Button Text Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3 class="mt-4">Translation</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Checkout Button</label><br>
                                       <input type="text" name="alpha_t6_checkout_btn" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_checkout_btn'] }}"   
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
                                       <input type="text" name="alpha_no_thanks_btn" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_no_thanks_btn'] }}"   
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
                                       <a href="#" data-id="alpha_t6_checkout_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_checkout_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_checkout_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_checkout_btn_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_no_thanks_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_no_thanks_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_no_thanks_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_no_thanks_btn_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t6_checkout_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_checkout_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_checkout_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_checkout_btn_color'] }}"    
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
                                       <a href="#" data-id="alpha_no_thanks_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_no_thanks_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_no_thanks_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_no_thanks_btn_color'] }}"    
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
                                       <a href="#" data-id="alpha_t6_checkout_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t6_checkout_btn_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t6_checkout_btn_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t6_checkout_btn_border_color'] }}"    
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
                                       <a href="#" data-id="alpha_no_thanks_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_no_thanks_btn_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_no_thanks_btn_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_no_thanks_btn_border_color'] }}"    
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
                              <div class="modal-content modal_5 alpha_atc_t_6">
                                 <div class="modal_5_head">
                                    <h2 class="alpha_t6_top_heading">
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             {{ $upsell->setting['alpha_t6_top_heading'] }}   
                                          @else    
                                             {{ $setting['top_heading'] }}
                                          @endif
                                       @else
                                          {{ $setting['top_heading'] }}
                                       @endisset 
                                    </h2>
                                    <span class="close t6_cross_icon" id="myModal5">×</span>
                                 </div>
                                 <div class="modal_5_body">
                                    <div class="m5_products">
                                       <div class="m5_item">
                                          <h3 class="alpha_t6_cart_product_heading" style="margin: 15px !important;"></h3>
                                          <div class="prodcut_item">
                                             <div class="item_img">
                                                <img src="{{ asset('assets')}}/img/m-10-1.png" alt="bag">
                                             </div>
                                             <div class="item_detail">
                                                <h4>Ladies Trending Leather Hand Bag</h4>
                                                <p class="t6_cart_product_price">{{ $currency }}24.95</p>
                                                <input type="button" class="alpha_t6_checkout_btn" value=
                                                   @isset($upsell)
                                                      @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                         "{{ $upsell->setting['alpha_t6_checkout_btn'] }}"   
                                                      @else    
                                                         "{{ $setting['checkout_button_text'] }}"
                                                      @endif
                                                   @else
                                                      "{{ $setting['checkout_button_text'] }}"
                                                   @endisset 
                                                >
                                             </div>
                                          </div>
                                       </div>
                                       <div class="m5_p">
                                          <h3 class="alpha_t6_product_heading">
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['alpha_t6_product_heading'] }}   
                                                @else    
                                                   {{ $setting['offer_heading'] }}
                                                @endif
                                             @else
                                                {{ $setting['offer_heading'] }}
                                             @endisset
                                          </h3>
                                          <div class="sale_item">
                                             <div class="sale_img">
                                                <img src="{{ asset('assets')}}/img/m-10-2.webp" alt="bag">
                                             </div>
                                             <div class="sale_detail">
                                                <h4>Ladies Trending Leather Hand Bag</h4>
                                                <p>{{ $currency }}34.95 <span>10%Off</span></p>
                                                <select>
                                                   <option>Sky Blue</option>
                                                   <option>Red</option>
                                                   <option>Green</option>
                                                </select>
                                                <select>
                                                   <option>M</option>
                                                   <option>S</option>
                                                   <option>L</option>
                                                </select>
                                                <input type="button" class="alpha_t6_atc_btn" value=
                                                   @isset($upsell)
                                                      @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                         "{{ $upsell->setting['alpha_t6_cart_btn'] }}"   
                                                      @else    
                                                         "{{ $setting['add_to_cart_text'] }}"
                                                      @endif
                                                   @else
                                                      "{{ $setting['add_to_cart_text'] }}"
                                                   @endisset
                                                >
                                             </div>
                                          </div>
                                          <div class="sale_item">
                                             <div class="sale_img">
                                                <img src="{{ asset('assets')}}/img/m-10-3.jpg" alt="bag">
                                             </div>
                                             <div class="sale_detail">
                                                <h4>Ladies Trending Leather Hand Bag</h4>
                                                <p>{{ $currency }}24.95 <span>10%Off</span></p>
                                                <select>
                                                   <option>Blue</option>
                                                   <option>Red</option>
                                                   <option>Green</option>
                                                </select>
                                                <select>
                                                   <option>M</option>
                                                   <option>S</option>
                                                   <option>L</option>
                                                </select>
                                                <input type="button" class="alpha_t6_atc_btn" value=
                                                   @isset($upsell)
                                                      @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                         "{{ $upsell->setting['alpha_t6_cart_btn'] }}"   
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
                                 <div class="m5_footer">
                                    <input type="button" class="m5_thanks" value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['alpha_no_thanks_btn'] }}"   
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