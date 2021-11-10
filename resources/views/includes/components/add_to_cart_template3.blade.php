<div class="modal fade" id="centralModalSm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                 <input type="text" placeholder="Thank You For Placing Order With Us" name="alpha_t3_heading" value= 
                                    @isset($upsell)
                                       "{{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_heading'] : $setting['top_heading'] }}"
                                    @else
                                       "{{ $setting['top_heading'] }}"
                                    @endisset
                                 />    
                              </p>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Font Family</label><br>
                                       <select name="alpha_t3_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}" 
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['alpha_t3_heading_font_family']  == $family ? "selected":"" }}   
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
                                       <input type="number" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_heading_font_size'] }}"   
                                             @else    
                                                "{{ $setting['top_heading_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['top_heading_font_size'] }}"
                                          @endisset 
                                       name="alpha_t3_heading_font_size">    
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t3_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_heading_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['top_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['top_heading_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_heading_color" value=
                                           @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_heading_color'] }}"    
                                             @else    
                                                "{{ $setting['top_heading_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['top_heading_color'] }}" 
                                          @endisset
                                       />
                                       <p>Heading Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t3_cross_icon_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_cross_icon_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_cross_icon_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_cross_icon_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_cross_icon_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_cross_icon_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden"  name="alpha_t3_cross_icon_bg_color"  value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_cross_icon_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_cart_item_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_cart_item_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_cart_item_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_cart_item_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_cart_item_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_cart_item_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_cart_item_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_cart_item_border_color'] }}"    
                                             @else    
                                                "{{ $setting['cart_product_border_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cart_product_border_color'] }}" 
                                          @endisset
                                       />
                                       <p>Border Color</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t3_cart_item_price_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_cart_item_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cart_product_price_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cart_product_price_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_cart_item_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_cart_item_price_color'] }}"    
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
                              <h3>Countdown For Sales Timer</h3>
                              <div class="custom-control custom-checkbox">
                                 <input type="checkbox" value="1" class="custom-control-input" name="alpha_t3_timer" id="alpha_t3_timer" 
                                     @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          {{ $upsell->setting['alpha_t3_timer'] ? "checked" : ""}}
                                       @else    
                                          {{ $setting['offer_time_limit'] ? "checked":"" }}
                                       @endif
                                    @else
                                       {{ $setting['offer_time_limit'] ? "checked":"" }}
                                    @endisset
                                 >
                                 <label class="custom-control-label" for="alpha_t3_timer">Add a Time Limit To The Offer</label>
                              </div>
                              <p class="h_input">
                                 <label>Heading</label><br>
                                 <input type="text" placeholder="You May Be Interested In..." name="alpha_t3_r_product_heading" value=
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          "{{ $upsell->setting['alpha_t3_r_product_heading'] }}"    
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
                                       <label>Heading Font Family</label><br>
                                       <select name="alpha_t3_r_product_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}" 
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['alpha_t3_r_product_heading_font_family']  == $family ? "selected":"" }}   
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
                                       <label>Heading Font Size</label><br>
                                       <input type="number" min="1" name="alpha_t3_r_product_heading_font_size" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_r_product_heading_font_size'] }}"   
                                             @else    
                                                "{{ $setting['offer_heading_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['offer_heading_font_size'] }}"
                                          @endisset 
                                       />    
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Timer Duration In Minutes</label><br>
                                       <input type="number" name="alpha_t3_timer_duration" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_timer_duration'] }}"   
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
                                       <input type="text" placeholder="Ends Soon:" name="alpha_t3_timer_heaading" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_timer_heaading'] }}"   
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
                                       <select name="alpha_t3_timer_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}" 
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['alpha_t3_timer_heading_font_family']  == $family ? "selected":"" }}   
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
                                       <input type="number" name="alpha_t3_timer_heading_font_size" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_timer_heading_font_size'] }}"   
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
                                       <a href="#" data-id="alpha_t3_r_product_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_r_product_heading_color'] }};"    
                                             @else    
                                                 "background-color:{{ $setting['offer_heading_color'] }};"
                                             @endif
                                          @else
                                              "background-color:{{ $setting['offer_heading_color'] }};" 
                                          @endisset
                                      >
                                       </a>
                                       <input type="hidden" name="alpha_t3_r_product_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_r_product_heading_color'] }}"    
                                             @else    
                                                 "{{ $setting['offer_heading_color'] }}"
                                             @endif
                                          @else
                                              "{{ $setting['offer_heading_color'] }}" 
                                          @endisset
                                       />
                                       <p>Heading Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t3_timer_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_timer_heading_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_heading_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_timer_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_timer_heading_color'] }}"    
                                             @else    
                                                "{{ $setting['timer_heading_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_heading_color'] }}" 
                                          @endisset
                                       />
                                       <p>Timer Heading Color</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t3_timer_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_timer_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_timer_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_timer_color'] }}"    
                                             @else    
                                                "{{ $setting['timer_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_color'] }}" 
                                          @endisset
                                       />
                                       <p>Timer Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t3_timer_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_timer_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_timer_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_timer_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['timer_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_bg_color'] }}" 
                                          @endisset
                                       />
                                       <p>Timer Background Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Product</h3>
                              <p class="h_input">
                                 <label>Button Text</label><br>
                                 <input type="text" placeholder="
                                     @isset($upsell)
                                                      {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_atc_btn'] : $setting['add_to_cart_text'] }}
                                                   @else
                                                      {{ $setting['add_to_cart_text'] }}
                                                   @endisset
                                 " name="alpha_t3_atc_btn" value=
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          "{{ $upsell->setting['alpha_t3_atc_btn'] }};"    
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
                                       <a href="#" data-id="alpha_t3_atc_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_atc_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_atc_btn_bg_color" value=
                                           @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_atc_btn_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_atc_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_atc_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_atc_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_atc_btn_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_price_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['Original_price_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['Original_price_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_price_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_dicount_price_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_dicount_price_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['discount_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_dicount_price_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_dicount_price_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_dicount_price_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_dicount_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['discount_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_dicount_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_dicount_price_color'] }}"    
                                             @else    
                                                "{{ $setting['discount_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['discount_text_color'] }}" 
                                          @endisset
                                       />
                                       <p>Discount Text Color</p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t3_upsell_product_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_upsell_product_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['product_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['product_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_upsell_product_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_upsell_product_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['product_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['product_bg_color'] }}" 
                                          @endisset
                                       />
                                       <p>Full Background Color</p>
                                    </div>
                                 </div>
                              </div>
                              <h3 class="mt-4">Translation</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Checkout Button</label><br>
                                       <input type="text" placeholder="Checkout" name="alpha_t3_checkout_btn" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_checkout_btn'] }}"   
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
                                       <input type="text" placeholder="No Thanks" name="alpha_t3_no_thanks_btn" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_no_thanks_btn'] }}"   
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
                                       <a href="#" data-id="alpha_t3_checkout_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_checkout_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_checkout_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_checkout_btn_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_no_thanks_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_no_thanks_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_no_thanks_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_no_thanks_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_checkout_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_checkout_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_checkout_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_checkout_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_no_thanks_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_no_thanks_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_no_thanks_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_no_thanks_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_checkout_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_checkout_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_checkout_border_color" value=
                                           @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_checkout_border_color'] }}"    
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
                                       <a href="#" data-id="alpha_t3_no_thanks_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t3_no_thanks_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t3_no_thanks_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t3_no_thanks_border_color'] }}"    
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
                              <div class="modal-content modal_1 alpha_atc_t_3">
                                 <div class="modal_1_head">
                                    <h2>
                                    
                                       <p class="alpha_t3_heading" style="font-weight: bold !important;">
                                       <p class="t3-icon-template-3">&#10003;</p>

                                       
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                {{ $upsell->setting['alpha_t3_heading'] }}    
                                             @else   
                                                {{ $setting['top_heading'] }}
                                             @endif
                                          @else
                                             {{ $setting['top_heading'] }}
                                          @endisset
                                       </p> 
                                     
                                       <span class="close alpha_close_model_t3" id="myModal">×</span>
                                    </h2>
                                 </div>
                                 <div class="modal_1_body">
                                    <div class="m_1_bg alpha_t3_cart_item">
                                       <div class="m_1_img">
                                          <img src="{{ asset('assets')}}/img/m-1-1.jpg" alt="shoes">
                                       </div>
                                       <div class="m_1_head">
                                          <h3>Elegant High Heels</h3>
                                          <p>(<span class="alpha_t3_cart_item_price">{{ $currency }}34.99</span>)</p>
                                       </div>
                                       <div class="m_1_head_btn">
                                          <button type="button" class="m_1_top_btn_2 alpha_t3_checkout_btn">
                                             @isset($upsell)
                                                {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_checkout_btn'] : $setting['checkout_button_text'] }}
                                             @else
                                                {{ $setting['checkout_button_text'] }}
                                             @endisset
                                          </button>
                                       </div>
                                    </div>
                                    <div class="b_timer_shoe">
                                       <div class="b_timer_head_shoe">
                                          <h2 class="alpha_t3_r_product_heading">
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['alpha_t3_r_product_heading'] }}    
                                                @else   
                                                   {{ $setting['offer_heading'] }}
                                                @endif
                                             @else
                                                {{ $setting['offer_heading'] }}
                                             @endisset
                                          </h2>
                                       </div>
                                       <div class="m_2_time_shoe">
                                          <label class="alpha_t3_timer_heaading">
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['alpha_t3_timer_heaading'] }}    
                                                @else   
                                                   {{ $setting['time_offer_heading'] }}
                                                @endif
                                             @else
                                                {{ $setting['time_offer_heading'] }}
                                             @endisset
                                          </label>
                                          <input type="text" value=
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   "{{ $upsell->setting['alpha_t3_timer_duration'] }}"    
                                                @else   
                                                   "{{ $setting['time_duration_minutes'] }}"
                                                @endif
                                             @else
                                                "{{ $setting['time_duration_minutes'] }}"
                                             @endisset
                                          class="alpha_t3_timer_duration alpha_t3_timer" readonly>:<input type="text" class="alpha_t3_timer" value="00" readonly>
                                       </div>
                                    </div>
                                    <div class="product_imgs">
                                       <div class="m_b_img_main">
                                          <div class="m_b_img">
                                             <div class="m_b_img_l">
                                                <img src="{{ asset('assets')}}/img/m-1-2.webp" alt="shoes">
                                             </div>
                                             <div class="m_b_img_r">
                                                <h3>Women Pumps Comfort High Heels</h3>
                                                <p>{{ $currency }}24.95 <span>20%Off</span></p>
                                                <form>
                                                   <select>
                                                      <option>Yellow</option>
                                                      <option>Black</option>
                                                   </select>
                                                   <select>
                                                      <option>24</option>
                                                      <option>32</option>
                                                   </select>
                                                </form>
                                                <button type="button" class="m_b_btn alpha_t3_atc_btn">
                                                    @isset($upsell)
                                                      {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_atc_btn'] : $setting['add_to_cart_text'] }}
                                                   @else
                                                      {{ $setting['add_to_cart_text'] }}
                                                   @endisset
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="m_b_img_main">
                                          <div class="m_b_img">
                                             <div class="m_b_img_l">
                                                <img src="{{ asset('assets')}}/img/m-1-3.webp" alt="shoes">
                                             </div>
                                             <div class="m_b_img_r">
                                                <h3>Women Pumps Comfort High Heels</h3>
                                                <p>{{ $currency }}24.95 <span>20%Off</span></p>
                                                <form>
                                                   <select>
                                                      <option>Black</option>
                                                      <option>Yellow</option>
                                                   </select>
                                                   <select>
                                                      <option>24</option>
                                                      <option>32</option>
                                                   </select>
                                                </form>
                                                <button type="button" class="m_b_btn alpha_t3_atc_btn">
                                                   @isset($upsell)
                                                      {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_atc_btn'] : $setting['add_to_cart_text'] }}
                                                   @else
                                                      {{ $setting['add_to_cart_text'] }}
                                                   @endisset
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="product_imgs">
                                       <div class="m_b_img_main">
                                          <div class="m_b_img">
                                             <div class="m_b_img_l">
                                                <img src="{{ asset('assets')}}/img/m-1-4.jpg" alt="shoes">
                                             </div>
                                             <div class="m_b_img_r">
                                                <h3>Women Pumps Comfort High Heels</h3>
                                                <p>{{ $currency }}24.95 <span>20%Off</span></p>
                                                <form>
                                                   <select>
                                                      <option>Red</option>
                                                      <option>Black</option>
                                                   </select>
                                                   <select>
                                                      <option>24</option>
                                                      <option>32</option>
                                                   </select>
                                                </form>
                                                <button type="button" class="m_b_btn alpha_t3_atc_btn">
                                                    @isset($upsell)
                                                      {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_atc_btn'] : $setting['add_to_cart_text'] }}
                                                   @else
                                                      {{ $setting['add_to_cart_text'] }}
                                                   @endisset
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="m_b_img_main">
                                          <div class="m_b_img">
                                             <div class="m_b_img_l">
                                                <img src="{{ asset('assets')}}/img/m-1-5.jpg" alt="shoes">
                                             </div>
                                             <div class="m_b_img_r">
                                                <h3>Women Pumps Comfort High Heels</h3>
                                                <p>{{ $currency }}24.95 <span>20%Off</span></p>
                                                <form>
                                                <select>
                                                   <option>White</option>
                                                   <option>Yellow</option>
                                                </select>
                                                <select>
                                                   <option>24</option>
                                                   <option>32</option>
                                                </select>
                                                <button type="button" class="m_b_btn alpha_t3_atc_btn">
                                                    @isset($upsell)
                                                      {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_atc_btn'] : $setting['add_to_cart_text'] }}
                                                   @else
                                                      {{ $setting['add_to_cart_text'] }}
                                                   @endisset
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal_1_footer">
                                    <button type="button" class="thnx_btn">
                                       @isset($upsell)
                                          {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_no_thanks_btn'] : $setting['no_thanks_button_text'] }}
                                       @else
                                          {{ $setting['no_thanks_button_text'] }}
                                       @endisset
                                    </button>
                                    <button type="button" class="m_1_top_btn_2 alpha_t3_checkout_btn">
                                       @isset($upsell)
                                          {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t3_checkout_btn'] : $setting['checkout_button_text'] }}
                                       @else
                                          {{ $setting['checkout_button_text'] }}
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