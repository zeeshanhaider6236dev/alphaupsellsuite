<!-----------Modal-2---------->
<div class="modal fade" id="centralModalSm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <!-- Change class .modal-sm to change the size of the modal -->
   <form class="template-{{ $upsellTemplateId }}">
      <div class="modal-dialog modal-sm m_1_w" role="document">
         <div class="modal-content modal_1_show" style="height: 100vh !important;">
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
                                 <input type="text" value=
                                    @isset($upsell)
                                       "{{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_atc_t1_heading'] : $setting['top_heading'] }}"
                                    @else
                                       "{{ $setting['top_heading'] }}"
                                    @endisset
                                  placeholder="You Just Added" name="alpha_atc_t1_heading">    
                              </p>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Font family</label><br>
                                       <select name="alpha_t2_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}" 
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['alpha_t2_heading_font_family']  == $family ? "selected":"" }}   
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
                                                "{{ $upsell->setting['alpha_t2_heading_font_size'] }}"   
                                             @else    
                                                "{{ $setting['top_heading_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['top_heading_font_size'] }}"
                                          @endisset 
                                       name="alpha_t2_heading_font_size" >    
                                    </p>
                                    <p class="f_input">
                                 <label>Total Price </label><br>
                                 <input type="text" name="t2-total-price-text" value=
                                 @isset($upsell)
                                    @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                       "{{ $upsell->setting['t2-total-price-text'] }}"   
                                    @else    
                                       "{{ $setting['t2-total-price-text'] }}"
                                    @endif
                                 @else
                                    "{{ $setting['t2-total-price-text'] }}"
                                 @endisset
                                 />    
                                 </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_heading_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['top_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['top_heading_color'] }};" 
                                          @endisset
                                       ></a>
                                       <input type="hidden" name="alpha_t2_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_heading_color'] }}"    
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
                                       <a href="#" data-id="alpha_t2_heading_background" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_heading_background'] }};"    
                                             @else    
                                                "background-color:{{ $setting['top_heading_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['top_heading_bg_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_heading_background" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_heading_background'] }}"    
                                             @else    
                                                "{{ $setting['top_heading_bg_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['top_heading_bg_color'] }}" 
                                          @endisset
                                       />
                                       <p>Background Color </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_icon_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_icon_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_color'] }};" 
                                          @endisset
                                       >    
                                       </a>
                                       <input type="hidden" name="alpha_t2_icon_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_icon_color'] }}"    
                                             @else    
                                                "{{ $setting['cross_icon_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['cross_icon_color'] }}" 
                                          @endisset
                                       />
                                       <p>Icon Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_icon_background" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_icon_background'] }};"    
                                             @else    
                                                "background-color:{{ $setting['cross_icon_bg_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_bg_color'] }};" 
                                          @endisset
                                       > 
                                       </a>
                                       <input type="hidden" name="alpha_t2_icon_background" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_icon_background'] }}"    
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
                              <div class="col-md-12 font">
                                 <div class="row">
                                 
                                    <div class="f_input_color">
                                       <a href="#" data-id="t2-total-price-color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['t2-total-price-color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['t2-total-price-color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['t2-total-price-color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="t2-total-price-color" value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['t2-total-price-color'] }}"    
                                          @else    
                                             "{{ $setting['t2-total-price-color'] }}"
                                          @endif
                                       @else
                                          "{{ $setting['t2-total-price-color'] }}" 
                                       @endisset
                                       />
                                       <p> Total Price Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="t2-price-color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['t2-price-color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['t2-price-color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['t2-price-color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="t2-price-color" value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['t2-price-color'] }}"    
                                          @else    
                                             "{{ $setting['t2-price-color'] }}"
                                          @endif
                                       @else
                                          "{{ $setting['t2-price-color'] }}" 
                                       @endisset
                                       />
                                       <p> Price Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Countdown Sales Timer</h3>
                              <div class="custom-control custom-checkbox">
                                 <input type="checkbox" value="1" class="custom-control-input" name="alpha_t2_timer_limit" id="alpha_t2_timer_limit" 
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          {{ $upsell->setting['alpha_t2_timer_limit'] ? "checked" : ""}}
                                       @else    
                                          {{ $setting['offer_time_limit'] ? "checked":"" }}
                                       @endif
                                    @else
                                       {{ $setting['offer_time_limit'] ? "checked":"" }}
                                    @endisset
                                 >
                                 <label class="custom-control-label" for="alpha_t2_timer_limit">Add a Time Limit To The Offer</label>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Heading</label><br>
                                       <input type="text" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_deal_heading'] }}"    
                                             @else    
                                               "{{ $setting['offer_heading'] }}" 
                                             @endif
                                          @else
                                         "{{ $setting['offer_heading'] }}" 
                                          @endisset
                                       name="alpha_t2_deal_heading">    
                                    </p>
                                    <p class="f_input">
                                       <label>Span</label><br>
                                       <input type="text" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_deal_span'] }}"    
                                             @else    
                                              "{{ $setting['offer_span'] }}" 
                                             @endif
                                          @else
                                            "{{ $setting['offer_span'] }}" 
                                          @endisset
                                       name="alpha_t2_deal_span">    	  
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Heading Font family</label><br>
                                       <select name="t2_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}"
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['t2_heading_font_family']  == $family ? "selected":"" }}   
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
                                       <input type="number" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['t2_heading_font_size'] }}"   
                                             @else    
                                                "{{ $setting['offer_heading_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['offer_heading_font_size'] }}"
                                          @endisset 
                                       name="t2_heading_font_size">    
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Timer Duration In Minutes</label><br>
                                       <input type="number" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['t2_time_duration'] }}"   
                                             @else    
                                               "{{ $setting['time_duration_minutes'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['time_duration_minutes'] }}"
                                          @endisset
                                       name="t2_time_duration">    
                                    </p>
                                    <p class="f_input">
                                       <label>Timer Text</label><br>
                                       <input type="text" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['t2_timer_text'] }}"   
                                             @else    
                                               "{{ $setting['time_offer_heading'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['time_offer_heading'] }}"
                                          @endisset 
                                       name="t2_timer_text">    	  
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Font family</label><br>
                                       <select name="t2_timer_text_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}" 
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['t2_timer_text_font_family']  == $family ? "selected":"" }}   
                                                   @else    
                                                      {{ $setting['timer_heading_font_family'] == $family ? "selected":"" }}
                                                   @endif
                                                @else
                                                    {{ $setting['timer_heading_font_family'] == $family ? "selected":"" }}
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
                                                "{{ $upsell->setting['t2_timer_text_font_size'] }}"   
                                             @else    
                                                "{{ $setting['timer_heading_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_heading_font_size'] }}"
                                          @endisset
                                       name="t2_timer_text_font_size">    
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_deal_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_deal_heading_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['offer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['offer_heading_color'] }};" 
                                          @endisset
                                       > 
                                       </a>
                                       <input type="hidden" name="alpha_t2_deal_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_deal_heading_color'] }}"    
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
                                       <a href="#" data-id="alpha_t2_deal_span_color"  class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_deal_span_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['offer_span_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['offer_span_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_deal_span_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_deal_span_color'] }}"    
                                             @else    
                                                "{{ $setting['offer_span_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['offer_span_color'] }}" 
                                          @endisset
                                       />
                                       <p>Span Color </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="t2_timer_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['t2_timer_heading_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_heading_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="t2_timer_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['t2_timer_heading_color'] }}"    
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
                                       <a href="#" data-id="t2_timer_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['t2_timer_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['timer_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="t2_timer_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['t2_timer_color'] }}"    
                                             @else    
                                                "{{ $setting['timer_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['timer_color'] }}" 
                                          @endisset
                                       "{{ $setting['timer_color'] }}" />
                                       <p>Timer Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Product</h3>
                              <p class="h_input">
                                 <label>Button Text</label><br>
                                 <input type="text" value=
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          "{{ $upsell->setting['alpha_t2_atc_btn_text'] }};"    
                                       @else    
                                          "{{ $setting['add_to_cart_text'] }}"
                                       @endif
                                    @else
                                       "{{ $setting['add_to_cart_text'] }}" 
                                    @endisset
                                 placeholder="Add To Cart" name="alpha_t2_atc_btn_text">    
                              </p>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_atc_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_atc_btn_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_atc_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_atc_btn_bg_color'] }}"    
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
                                       <a href="#" data-id="alpha_t2_atc_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_atc_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['atc_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['atc_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_atc_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_atc_btn_color'] }}"    
                                             @else    
                                                "{{ $setting['atc_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['atc_text_color'] }}" 
                                          @endisset
                                       "{{ $setting['atc_text_color'] }}" />
                                       <p>Button Text Color</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_price_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_price_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['Original_price_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['Original_price_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_price_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_price_color'] }}"    
                                             @else    
                                                "{{ $setting['Original_price_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['Original_price_color'] }}" 
                                          @endisset
                                       "{{ $setting['Original_price_color'] }}" />
                                       <p>Original Price Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_discount_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_discount_bg_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['discount_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_discount_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_discount_bg_color'] }}"    
                                             @else    
                                                "{{ $setting['discount_background_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['discount_background_color'] }}" 
                                          @endisset
                                       "{{ $setting['discount_background_color'] }}" />
                                       <p>Discount Background Color </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_discount_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_discount_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['discount_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_discount_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_discount_color'] }}"    
                                             @else    
                                                "{{ $setting['discount_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['discount_text_color'] }}" 
                                          @endisset
                                       "{{ $setting['discount_text_color'] }}" />
                                       <p>Discount Text Color</p>
                                    </div>
                                 </div>
                              </div>
                              <h3 class="mt-4">Translation</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Checkout Button</label><br>
                                       <input type="text" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_checkout_btn'] }}"   
                                             @else    
                                               "{{ $setting['checkout_button_text'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['checkout_button_text'] }}"
                                          @endisset 
                                       placeholder="Checkout" name="alpha_t2_checkout_btn">    
                                    </p>
                                    <p class="f_input">
                                       <label>No Thanks Button</label><br>
                                       <input type="text" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_no_thanks_btn'] }}"   
                                             @else    
                                               "{{ $setting['no_thanks_button_text'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['no_thanks_button_text'] }}"
                                          @endisset
                                       placeholder="No Thanks" name="alpha_t2_no_thanks_btn">    	  
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_checkout_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_checkout_btn_bg_color'] }};"    
                                             @else    
                                                 "background-color:{{ $setting['checkout_background_color'] }};"
                                             @endif
                                          @else
                                              "background-color:{{ $setting['checkout_background_color'] }};" 
                                          @endisset
                                      >
                                       </a>
                                       <input type="hidden" name="alpha_t2_checkout_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_checkout_btn_bg_color'] }}"    
                                             @else    
                                                 "{{ $setting['checkout_background_color'] }}"
                                             @endif
                                          @else
                                              "{{ $setting['checkout_background_color'] }}" 
                                          @endisset
                                       "{{ $setting['checkout_background_color'] }}" />
                                       <p>Checkout Background Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_no_thanks_btn_bg_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_no_thanks_btn_bg_color'] }};"    
                                             @else    
                                               "background-color:{{ $setting['no_thanks_background_color'] }};"
                                             @endif
                                          @else
                                            "background-color:{{ $setting['no_thanks_background_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_no_thanks_btn_bg_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_no_thanks_btn_bg_color'] }}"    
                                             @else    
                                               "{{ $setting['no_thanks_background_color'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['no_thanks_background_color'] }}" 
                                          @endisset
                                       "{{ $setting['no_thanks_background_color'] }}" />
                                       <p>No,Thanks Background Color </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_checkout_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_checkout_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_checkout_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_checkout_btn_color'] }}"    
                                             @else    
                                                "{{ $setting['checkout_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['checkout_text_color'] }}" 
                                          @endisset
                                       "{{ $setting['checkout_text_color'] }}" />
                                       <p>Checkout Text Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_no_thanks_btn_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_no_thanks_btn_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_text_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_no_thanks_btn_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_no_thanks_btn_color'] }}"    
                                             @else    
                                                "{{ $setting['no_thanks_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['no_thanks_text_color'] }}" 
                                          @endisset
                                       "{{ $setting['no_thanks_text_color'] }}" />
                                       <p>No,Thanks Text Color </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_checkout_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_checkout_btn_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['checkout_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_t2_checkout_btn_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_checkout_btn_border_color'] }}"    
                                             @else    
                                                "{{ $setting['checkout_border_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['checkout_border_color'] }}" 
                                          @endisset
                                       "{{ $setting['checkout_border_color'] }}" />
                                       <p>Checkout Border Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_t2_no_thanks_btn_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_t2_no_thanks_btn_border_color'] }};"    
                                             @else    
                                                "background-color:{{ $setting['no_thanks_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_border_color'] }};" 
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden"  name="alpha_t2_no_thanks_btn_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_t2_no_thanks_btn_border_color'] }}"    
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
                              <div class="modal_6 alpha_atc_t_2">
                                 <div class="modal_6_head">
                                    <h2>
                                       <i class="fa fa-check t1_icon"></i>
                                       <span class="alpha_t2_heading">
                                          @isset($upsell)
                                             {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_atc_t1_heading'] : $setting['top_heading'] }}
                                          @else
                                             {{ $setting['top_heading'] }}
                                          @endisset
                                       </span> 
                                       <span class="close c6" id="myModal6">
                                       <i class="fa fa-times t1_icon"></i>
                                       </span>
                                    </h2>
                                    <div class="head_item">
                                       <div class="h_item_img">
                                          <img src="{{ asset('assets')}}/img/m-6-1.jpg" alt="dress">
                                       </div>
                                       <div class="h_item_heading">
                                          <h3>Shop Ethnic Outfits Online - Affordable<br> Women's Clothes..!!</h3>
                                       </div>
                                       <div class="h_item_btn" style="text-align: center !important;">
                                          <div class="price-div" style="display: flex; justify-content: center;">
                                          <p class="total-price-t2">Total:</p>
                                          <p><span class="price-fig-t2">{{ $currency }}29.95</span></p>
                                          </div>
                                          <button type="button" class="h_item_btnstyle alpha_t2_checkout_button">
                                             @isset($upsell)
                                                {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t2_checkout_btn'] : $setting['checkout_button_text'] }}
                                             @else
                                                {{ $setting['checkout_button_text'] }}
                                             @endisset
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="m6_timer">
                                    <h2> 
                                       <p class="t2_deal_heading temp_2_deal_heading">                                    
                                          @isset($upsell)
                                             {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t2_deal_heading'] : $setting['offer_heading'] }}
                                          @else
                                             {{ $setting['offer_heading'] }}
                                          @endisset
                                       </p> 
                                       <span class="t2_deal_discount temp_2_deal_heading">
                                          @isset($upsell)
                                             {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t2_deal_span'] : $setting['offer_span'] }}
                                          @else
                                             {{ $setting['offer_span'] }}
                                          @endisset
                                       </span>
                                    </h2>
                                    <div class="m_3_time">
                                       <label class="t2_timer_text">
                                          @isset($upsell)
                                             {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['t2_timer_text'] : $setting['time_offer_heading'] }}
                                          @else
                                             {{ $setting['time_offer_heading'] }}
                                          @endisset
                                       </label>
                                       <input type="text" value=
                                          @isset($upsell)
                                             {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['t2_time_duration'] : $setting['time_duration_minutes'] }}
                                          @else
                                             {{ $setting['time_duration_minutes'] }}
                                          @endisset
                                       class="t2_time_duration t2_timer" readonly>:<input class="t2_timer" type="text" value="00" readonly>
                                    </div>
                                 </div>
                                 <div class="modal_6_body">
                                    <div class="m6_products">
                                       <div class="m6_p_img">
                                          <img src="{{ asset('assets')}}/img/m-6-2.jpg" alt="bag"> 
                                       </div>
                                       <div class="m6_p_heading">
                                          <h2>Women's handbag Female leather shoulder bag..!! <span>
                                             <button type="button" class="h_item_btnstyle alpha_t2_atc_btn">
                                                @isset($upsell)
                                                   {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t2_atc_btn_text'] : $setting['add_to_cart_text'] }}
                                                @else
                                                   {{ $setting['add_to_cart_text'] }}
                                                @endisset
                                             </button></span>
                                          </h2>
                                          <p>{{ $currency }}29.99 <span>10%Off</span></p>
                                          <select>
                                             <option>Black</option>
                                             <option>Blue</option>
                                             <option>Red</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="m6_products">
                                       <div class="m6_p_img">
                                          <img src="{{ asset('assets')}}/img/m-6-4.jpg" alt="bag"> 
                                       </div>
                                       <div class="m6_p_heading">
                                          <h2>Women's Shoes Female Heels Yellow Shoes.!! <span>
                                             <button type="button" class="h_item_btnstyle alpha_t2_atc_btn">
                                                @isset($upsell)
                                                   {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t2_atc_btn_text'] : $setting['add_to_cart_text'] }}
                                                @else
                                                   {{ $setting['add_to_cart_text'] }}
                                                @endisset
                                             </button></span>
                                          </h2>
                                          <p>{{ $currency }}29.99 <span>10%Off</span></p>
                                          <select>
                                             <option>Yellow</option>
                                             <option>Blue</option>
                                             <option>Red</option>
                                          </select>
                                          <select>
                                             <option>24</option>
                                             <option>26</option>
                                             <option>28</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="m6_products">
                                       <div class="m6_p_img">
                                          <img src="{{ asset('assets')}}/img/m-6-3.jpg" alt="bag"> 
                                       </div>
                                       <div class="m6_p_heading">
                                          <h2>Women's handbag Female leather shoulder bag..!! <span>
                                             <button type="button" class="h_item_btnstyle alpha_t2_atc_btn">
                                                @isset($upsell)
                                                   {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t2_atc_btn_text'] : $setting['add_to_cart_text'] }}
                                                @else
                                                   {{ $setting['add_to_cart_text'] }}
                                                @endisset
                                             </button></span>
                                          </h2>
                                          <p>{{ $currency }}29.99 <span>10%Off</span></p>
                                          <select>
                                             <option>Gray</option>
                                             <option>Blue</option>
                                             <option>Red</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal_6_footer">
                                    <button type="button" class="no_thanks_btn">
                                       @isset($upsell)
                                          {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['alpha_t2_no_thanks_btn'] : $setting['no_thanks_button_text'] }}
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
                  <button type="button" data-id="{{ $upsellTemplateId }}" class="save update_setting">Save changes</button>
               @else
                  <button type="button" data-id="{{ $upsellTemplateId }}" class="save save_setting">Save changes</button>
               @endisset
            </div>
         </div>
      </div>
   </form>
</div>
<!--------Modal-2-close------->