<!-----------Modal-1---------->
<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <!-- Change class .modal-sm to change the size of the modal -->
   <form class="template-{{ $upsellTemplateId }}">
      <div class="modal-dialog modal-sm m_1_w" role="document" style="height: 100vh !important;">
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
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          "{{ $upsell->setting['add_to_cart_heading'] }}"
                                       @else
                                          "{{ $setting['add_to_cart_heading'] }}"
                                       @endif
                                    @else
                                    "{{ $setting['add_to_cart_heading'] }}"
                                    @endisset
                                    name="add_to_cart_heading"
                                 />
                              </p>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Font Family</label><br>
                                       <select name="heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}"
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['heading_font_family']  == $family ? "selected":"" }}
                                                   @else
                                                      {{ $setting['heading_font_family'] == $family ? "selected":"" }}
                                                   @endif
                                                @else
                                                   {{ $setting['heading_font_family'] == $family ? "selected":"" }}
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
                                                "{{ $upsell->setting['heading_font_size'] }}"
                                             @else
                                                "{{ $setting['heading_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['heading_font_size'] }}"
                                          @endisset
                                        name="heading_font_size">
                                    </p>
                                    <p class="f_input">
                                       <label>Total Price</label><br>
                                       <input type="text" name="total_price_text" value="Total:" />
                                    </p>

                                    <p class="f_input">
                                       <label>Text Align</label><br>
                                       <select name="heading_align">
                                          <option value="Left"
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['heading_align'] == 'Left'? 'selected':'' }}
                                                @else
                                                   {{ $setting['heading_align'] == 'Left'? 'selected':'' }}
                                                @endif
                                             @else
                                                {{ $setting['heading_align'] == 'Left'? 'selected':'' }}
                                             @endisset
                                          >Left</option>
                                          <option value="Center"
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['heading_align'] == 'Center'? 'selected':'' }}
                                                @else
                                                   {{ $setting['heading_align'] == 'Center'? 'selected':'' }}
                                                @endif
                                             @else
                                                {{ $setting['heading_align'] == 'Center'? 'selected':'' }}
                                             @endisset
                                          >Center</option>
                                          <option value="Right"
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['heading_align'] == 'Right'? 'selected':'' }}
                                                @else
                                                   {{ $setting['heading_align'] == 'Right'? 'selected':'' }}
                                                @endif
                                             @else
                                                {{ $setting['heading_align'] == 'Right'? 'selected':'' }}
                                             @endisset
                                          >Right</option>
                                       </select>
                                    </p>
                                 </div>
                              </div>
                              <h3>Color</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha-m-1-heading-color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha-m-1-heading-color'] }};"
                                             @else
                                                "background-color: {{ $setting['heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color: {{ $setting['heading_color'] }};"
                                          @endisset
                                       name="alpha-m-1-heading-color">
                                       </a>
                                       <input type="hidden" name="alpha-m-1-heading-color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha-m-1-heading-color'] }}"
                                             @else
                                                "{{ $setting['heading_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['heading_color'] }}"
                                          @endisset
                                       />

                                       <p>Heading Color </p>
                                    </div>

                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_heading_bg_color_m1" class="buttoncolor colorpicker" name="back_ground_color" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color: {{ $upsell->setting['alpha_heading_bg_color_m1'] }};"
                                             @else
                                               "background-color:{{ $setting['heading_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['heading_background_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_heading_bg_color_m1" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_heading_bg_color_m1'] }}"
                                             @else
                                               "{{ $setting['heading_background_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['heading_background_color'] }}"
                                          @endisset
                                       />
                                       <p>Background Color </p>
                                    </div>

                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">

                                    <div class="f_input_color">
                                       <a href="#" data-id="alpha_cross_icom_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_cross_icom_color'] }};"
                                             @else
                                               "background-color:{{ $setting['cross_icon_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_color'] }};"
                                          @endisset
                                        name="cross_icon_color">
                                       </a>
                                       <input type="hidden" name="alpha_cross_icom_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_cross_icom_color'] }}"
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
                                       <a href="#" data-id="text-color-price-total" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_cross_icom_color'] }};"
                                             @else
                                               "background-color:{{ $setting['cross_icon_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['cross_icon_color'] }};"
                                          @endisset
                                        name="cross_icon_color">
                                       </a>
                                       <input type="hidden" name="text-color-price-total" value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['alpha_cross_icom_color'] }}"
                                          @else
                                            "{{ $setting['cross_icon_color'] }}"
                                          @endif
                                       @else
                                          "{{ $setting['cross_icon_color'] }}"
                                       @endisset
                                       />
                                       <p> Total Color </p>
                                    </div>

                                 </div>


                              </div>

                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="price-color-figure" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['price-color-figure'] }};"
                                             @else
                                               "background-color:{{ $setting['price-color-figure'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['price-color-figure'] }};"
                                          @endisset
                                        name="cross_icon_color">
                                       </a>
                                       <input type="hidden" name="price-color-figure" value=
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             "{{ $upsell->setting['price-color-figure'] }}"
                                          @else
                                            "{{ $setting['price-color-figure'] }}"
                                          @endif
                                       @else
                                          "{{ $setting['price-color-figure'] }}"
                                       @endisset
                                       />
                                       <p> Price Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Countdown for Sales Timer</h3>
                              <div class="custom-control custom-checkbox">
                                 <input type="checkbox" value="1" class="custom-control-input" id="defaultCheckedDisabled2" name="offer_time_limit"
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          {{ $upsell->setting['offer_time_limit'] ? "checked" : ""}}
                                       @else
                                          {{ $setting['offer_time_limit'] ? "checked" : ""}}
                                       @endif
                                    @else
                                       {{ $setting['offer_time_limit'] ? "checked" : ""}}
                                    @endisset
                                 />
                                 <label class="custom-control-label" for="defaultCheckedDisabled2">
                                    Add a Time Limit To The Offer
                                 </label>
                              </div>
                              <p class="h_input">
                                 <label>Heading</label><br>
                                 <input type="text" value=
                                    @isset($upsell)
                                       @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                          "{{ $upsell->setting['time_offer_heading'] }}"
                                       @else
                                          "{{ $setting['time_offer_heading'] }}"
                                       @endif
                                    @else
                                    "{{ $setting['time_offer_heading'] }}"
                                    @endisset
                                 name="time_offer_heading" />
                              </p>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Heading Font Family</label><br>
                                       <select name="offer_heading_font_family">
                                          @foreach (config('upsell.strings.fontFamily') as $family)
                                             <option value="{{ $family }}"
                                                @isset($upsell)
                                                   @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                      {{ $upsell->setting['offer_heading_font_family']  == $family ? "selected":"" }}
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
                                                "{{ $upsell->setting['offer_heading_font_size'] }}"
                                             @else
                                                "{{ $setting['offer_heading_font_size'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['offer_heading_font_size'] }}"
                                          @endisset
                                          name="offer_heading_font_size">
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
                                                "{{ $upsell->setting['time_duration_minutes'] }}"
                                             @else
                                               "{{ $setting['time_duration_minutes'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['time_duration_minutes'] }}"
                                          @endisset
                                         name="time_duration_minutes">
                                    </p>
                                    <p class="f_input">
                                       <label>Timer Text</label><br>
                                       <input type="text" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['timer_text'] }}"
                                             @else
                                               "{{ $setting['timer_text'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['timer_text'] }}"
                                          @endisset
                                         name="timer_text">
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="time_offer_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['time_offer_heading_color'] }};"
                                             @else
                                              "background-color:{{ $setting['time_offer_heading_color'] }};"
                                             @endif
                                          @else
                                            "background-color:{{ $setting['time_offer_heading_color'] }};"
                                          @endisset
                                        >
                                       </a>
                                       <input type="hidden" name="time_offer_heading_color" value =
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['time_offer_heading_color'] }}"
                                             @else
                                                "{{ $setting['time_offer_heading_color'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['time_offer_heading_color'] }}"
                                          @endisset
                                       />
                                       <p>Heading Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="timer_heading_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['timer_heading_color'] }};"
                                             @else
                                               "background-color:{{ $setting['timer_heading_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_heading_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden"  name="timer_heading_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['timer_heading_color'] }} "
                                             @else
                                                "{{ $setting['timer_heading_color'] }} "
                                             @endif
                                          @else
                                             "{{ $setting['timer_heading_color'] }} "
                                          @endisset
                                       />
                                       <p>Timer Heading Color </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="timer_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['timer_color'] }};"
                                             @else
                                               "background-color:{{ $setting['timer_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['timer_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden"  name="timer_color" value =
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['timer_color'] }} "
                                             @else
                                               "{{ $setting['timer_color'] }} "
                                             @endif
                                          @else
                                             "{{ $setting['timer_color'] }} "
                                          @endisset
                                       />
                                       <p>Timer Color </p>
                                    </div>
                                 </div>
                              </div>
                              <h3>Product</h3>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <p class="f_input">
                                       <label>Add To Cart Button</label><br>
                                       <input type="text" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['add_to_cart_text'] }}"
                                             @else
                                               "{{ $setting['add_to_cart_text'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['add_to_cart_text'] }}"
                                          @endisset
                                       name="add_to_cart_text">
                                    </p>
                                    <div class="f_input_color">
                                       <label></label><br>
                                       <a href="#" data-id="alpha_original_price_color_m1" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['alpha_original_price_color_m1'] }};"
                                             @else
                                               "background-color:{{ $setting['Original_price_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['Original_price_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="alpha_original_price_color_m1" value =
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['alpha_original_price_color_m1'] }}"
                                             @else
                                                "{{ $setting['Original_price_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['Original_price_color'] }}"
                                          @endisset
                                       />
                                       <p>Original Price Color </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="button_background_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['button_background_color'] }};"
                                             @else
                                               "background-color:{{ $setting['button_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['button_background_color'] }};"
                                          @endisset
                                        >
                                       </a>
                                       <input type="hidden" name="button_background_color" value =
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['button_background_color'] }}"
                                             @else
                                               "{{ $setting['button_background_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['button_background_color'] }}"
                                          @endisset
                                       />
                                       <p>Button Background Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="discount_background_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['discount_background_color'] }};"
                                             @else
                                               "background-color:{{ $setting['discount_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_background_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="discount_background_color" value =
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['discount_background_color'] }}"
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
                                       <a href="#" data-id="button_text_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['button_text_color'] }};"
                                             @else
                                               "background-color:{{ $setting['button_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['button_text_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="button_text_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['button_text_color'] }}"
                                             @else
                                                "{{ $setting['button_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['button_text_color'] }}"
                                          @endisset
                                          />
                                       <p>Button Text Color </p>
                                    </div>
                                    <div class="f_input_color">
                                       <a href="#" data-id="discount_text_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['discount_text_color'] }};"
                                             @else
                                                "background-color:{{ $setting['discount_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['discount_text_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="discount_text_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['discount_text_color'] }}"
                                             @else
                                                "{{ $setting['discount_text_color'] }}"
                                             @endif
                                          @else
                                             "{{ $setting['discount_text_color'] }}"
                                          @endisset
                                       />
                                       <p>Discount Text Color </p>
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
                                                "{{ $upsell->setting['checkout_button_text'] }}"
                                             @else
                                               "{{ $setting['checkout_button_text'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['checkout_button_text'] }}"
                                          @endisset
                                        name="checkout_button_text">
                                    </p>
                                    <p class="f_input">
                                       <label>No Thanks Button</label><br>
                                       <input type="text" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['no_thanks_button_text'] }}"
                                             @else
                                               "{{ $setting['no_thanks_button_text'] }}"
                                             @endif
                                          @else
                                            "{{ $setting['no_thanks_button_text'] }}"
                                          @endisset
                                        name="no_thanks_button_text">
                                    </p>
                                 </div>
                              </div>
                              <div class="col-md-12 font">
                                 <div class="row">
                                    <div class="f_input_color">
                                       <a href="#" data-id="checkout_background_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['checkout_background_color'] }};"
                                             @else
                                               "background-color:{{ $setting['checkout_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_background_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden"  name="checkout_background_color" value =
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['checkout_background_color'] }}"
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
                                       <a href="#" data-id="no_thanks_background_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['no_thanks_background_color'] }};"
                                             @else
                                               "background-color:{{ $setting['no_thanks_background_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_background_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="no_thanks_background_color" value =
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['no_thanks_background_color'] }}"
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
                                       <a href="#" data-id="checkout_text_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['checkout_text_color'] }};"
                                             @else
                                               "background-color:{{ $setting['checkout_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_text_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="checkout_text_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['checkout_text_color'] }}"
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
                                       <a href="#" data-id="no_thanks_text_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['no_thanks_text_color'] }};"
                                             @else
                                               "background-color:{{ $setting['no_thanks_text_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_text_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="no_thanks_text_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['no_thanks_text_color'] }}"
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
                                       <a href="#" data-id="checkout_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['checkout_border_color'] }};"
                                             @else
                                               "background-color:{{ $setting['checkout_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['checkout_border_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="checkout_border_color" value =
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['checkout_border_color'] }}"
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
                                       <a href="#" data-id="no_thanks_border_color" class="buttoncolor colorpicker" id="basic" style=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "background-color:{{ $upsell->setting['no_thanks_border_color'] }};"
                                             @else
                                               "background-color:{{ $setting['no_thanks_border_color'] }};"
                                             @endif
                                          @else
                                             "background-color:{{ $setting['no_thanks_border_color'] }};"
                                          @endisset
                                       >
                                       </a>
                                       <input type="hidden" name="no_thanks_border_color" value=
                                          @isset($upsell)
                                             @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                "{{ $upsell->setting['no_thanks_border_color'] }}"
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
                              <div class="modal-2 alpha_atc_m_2">
                                 <div class="modal_2_head">
                                    <i class="fa fa-check alpha_atc_heading_m1_check aus-tick-emoji" style="color: #f34d00 !important; background: none !important;"></i>
                                    <h2 class="add_to_cart_heading_m_1">
                                       @isset($upsell)
                                          @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                             {{ $upsell->setting['add_to_cart_heading'] }}
                                          @else
                                             {{ $setting['add_to_cart_heading'] }}
                                          @endif
                                       @else
                                       {{ $setting['add_to_cart_heading'] }}
                                       @endisset
                                    </h2>
                                    <span class="close alpha_close_model" id="myModal2">×</span>
                                 </div>
                                 <div class="modal_2_body">
                                    <div class="top_product">
                                       <div class="top_p_img">
                                          <img src="{{ asset('assets')}}/img/m-2-1.jpg" alt="dress">
                                       </div>
                                       <div class="top_p_detail">
                                          <h3>Shop Ethnic Outfits Online - Affordable <br> Women's Clothes..!!  </h3>
                                          <div class="total-price-container">
                                             <p class="total-price-text">Total:<p>
                                             <span class="aus-total-price-fig" style="font-size: 13px; font-weight: bold;">{{ $currency }}39.95</span>
                                          </div>

                                          <!-- <table width="30%">
                                             <tbody>
                                                <tr>
                                                   <td>
                                                      <p>Color:</p>
                                                   </td>
                                                   <td>
                                                      <select>
                                                         <option>Blue</option>
                                                         <option>Black</option>
                                                         <option>Pink</option>
                                                      </select>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <p>Size:</p>
                                                   </td>
                                                   <td>
                                                      <select>
                                                         <option>24</option>
                                                         <option>26</option>
                                                         <option>28</option>
                                                      </select>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <p>Qty:</p>
                                                   </td>
                                                   <td>
                                                      <input type="number" min="1" value="1">
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table> -->
                                       </div>
                                    </div>
                                    <div class="b_timer">
                                       <div class="b_timer_head">
                                          <h2 class="b_timer_head_text">
                                             @isset($upsell)
                                                @if ($upsell->setting['upsell_template_type'] == $upsellTemplateId)
                                                   {{ $upsell->setting['time_offer_heading'] }}
                                                @else
                                                   {{ $setting['time_offer_heading'] }}
                                                @endif
                                             @else
                                                {{ $setting['time_offer_heading'] }}
                                             @endisset
                                          </h2>
                                       </div>
                                          <div class="m_2_time">
                                             <label class="alpha_m1_timer_label">
                                                @isset($upsell)
                                                   {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['timer_text'] : $setting['timer_text'] }}
                                                @else
                                                   {{ $setting['timer_text'] }}
                                                @endisset
                                             </label>
                                             <input type="text" class="offer_timer_m1_minutes" value=
                                                @isset($upsell)
                                                   {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ? $upsell->setting['time_duration_minutes'] : $setting['time_duration_minutes'] }}
                                                @else
                                                   {{ $setting['time_duration_minutes'] }}
                                                @endisset
                                              readonly>:<input type="text" class="offer_timer_m1_seconds" value="00" readonly>
                                          </div>
                                    </div>
                                    <div class="m_2_products">
                                       <div class="m2_p_main">
                                          <div class="m2_p_box">
                                             <div class="m2_img">
                                                <img src="{{ asset('assets')}}/img/m-2-2.jpg" alt="dress">
                                             </div>
                                             <div class="m2_detail">
                                                <h4>Shop Ethnic Outfits Online Women's Clothes</h4>
                                                <p>{{ $currency }}49.99 <span>20%Off</span></p>
                                                <span>
                                                   <select>
                                                      <option>Blue</option>
                                                      <option>Black</option>
                                                      <option>Yellow</option>
                                                   </select>
                                                   <select>
                                                      <option>S</option>
                                                      <option>M</option>
                                                      <option>L</option>
                                                   </select>
                                                </span>
                                                <button type="button" class="alpha_m1_add_to_cart_btn">
                                                   @isset($upsell)
                                                      {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ?  $upsell->setting['add_to_cart_text']  :  $setting['add_to_cart_text']  }}
                                                   @else
                                                   {{ $setting['add_to_cart_text'] }}
                                                   @endisset
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="m2_p_main">
                                          <div class="m2_p_box">
                                             <div class="m2_img">
                                                <img src="{{ asset('assets')}}/img/m-2-3.jpg" alt="dress">
                                             </div>
                                             <div class="m2_detail">
                                                <h4>Shop Ethnic Outfits Online Women's Clothes</h4>
                                                <p>{{ $currency }}49.99 <span>20%Off</span></p>
                                                <span>
                                                   <select>
                                                      <option>White</option>
                                                      <option>Black</option>
                                                      <option>Yellow</option>
                                                   </select>
                                                   <select>
                                                      <option>S</option>
                                                      <option>M</option>
                                                      <option>L</option>
                                                   </select>
                                                </span>
                                                <button type="button" class="alpha_m1_add_to_cart_btn">
                                                   @isset($upsell)
                                                      {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ?  $upsell->setting['add_to_cart_text']  :  $setting['add_to_cart_text']  }}
                                                   @else
                                                   {{ $setting['add_to_cart_text'] }}
                                                   @endisset
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="m2_p_main">
                                          <div class="m2_p_box">
                                             <div class="m2_img">
                                                <img src="{{ asset('assets')}}/img/m-2-4.jpg" alt="dress">
                                             </div>
                                             <div class="m2_detail">
                                                <h4>Shop Ethnic Outfits Online Women's Clothes</h4>
                                                <p>{{ $currency }}49.99 <span>20%Off</span></p>
                                                <span>
                                                   <select>
                                                      <option>Blue</option>
                                                      <option>Black</option>
                                                      <option>Yellow</option>
                                                   </select>
                                                   <select>
                                                      <option>S</option>
                                                      <option>M</option>
                                                      <option>L</option>
                                                   </select>
                                                </span>
                                                <button type="button" class="alpha_m1_add_to_cart_btn">
                                                   @isset($upsell)
                                                      {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ?  $upsell->setting['add_to_cart_text']  :  $setting['add_to_cart_text']  }}
                                                   @else
                                                      {{ $setting['add_to_cart_text'] }}
                                                   @endisset
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal_2_footer">
                                    <button type="button" class="m_2_btn_2">
                                       @isset($upsell)
                                          {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ?  $upsell->setting['checkout_button_text']  :  $setting['checkout_button_text']  }}
                                       @else
                                          {{ $setting['checkout_button_text'] }}
                                       @endisset
                                    </button>
                                    <button type="button" class="m_2_btn">
                                       @isset($upsell)
                                          {{ $upsell->setting['upsell_template_type'] == $upsellTemplateId ?  $upsell->setting['no_thanks_button_text']  :  $setting['no_thanks_button_text']  }}
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
<!-----------End Modal-1---------->
