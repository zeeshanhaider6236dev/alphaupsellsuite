@push('componentCss')
    <style>
        .alpha_model_dialog
        {
            margin: 0 !important;
        }
        .alpha_model_dialog,.alpha_model_content
        {
            height: 100vh;
        }
        .alpha_upsell_model_picker
        {
            overflow: hidden;
        }
        .modal_2_head
        {
            display: flex;
        }
        .modal_2_head h2
        {
            margin-left: 4px;
        }
        .alpha_atc_heading_m1_check
        {
            background: {{ isset($upsell) && $upsell->setting['upsell_template_type'] == 1 ? $upsell->setting['button_background_color'] : '#f34d00;'  }} !important;
            color: white;
            padding: 4px;
            border-radius: 50%;
            font-size: 14px;
        }
        .alpha_tab_content
        {
            max-height: 100%;
            overflow: scroll;
        }
        .alpha_t_u_choosen
        {
            position:absolute;
            top:-2px;
            right: -2px;
            background-color:#00a500;
            width:30px;
            height:30px;
            border-radius:50%;
            text-align:center;
            font-size:20px;
            line-height:29px;
        }
        .product_search
        {
            max-height: 100% !important;
        }
        .alpha_t_u_choosen span
        {
            color:white;
            border:none;
        }
        .alpha_atc_m_2, .alpha_atc_t_2, .alpha_atc_t_3, .alpha_atc_t_4, .alpha_atc_t_5, .alpha_atc_t_6
        {
            position:sticky!important;
            top:10px;
            margin-bottom:10px;
        }
        .alpha_atc_t_4
        {
            height: auto;
        }
        /* Template 1 Styling */
        .total-price-text{
            color: #f34d00;
            font-weight: bold;
        }
        .b_timer_head_text{
            font-weight: bold;
        }
        .total-price-container{
            display: flex ;
            position: absolute;
            bottom: 10px;
            right: 5px ;


        }
        .alpha_close_model
        {
            position:absolute;
            top:2px;
            right:6px;
        }
        .add_to_cart_heading_m_1
        {
            width:95%;
        }
        
        /* Template 2 styling */

        .t2_deal_heading
        {
            display: inline;
        }
        .alpha_t2_checkout_button
        {
            border:1px solid #3bbb92;
        }

        /* Template 3 Styling*/

        .t3-icon-template-3{
            display: inline;
            padding: 1px 3px;
            color: white ;
            background-color: #44a5ff;
            border-radius: 50%;
        }


        .alpha_close_model_t3
        {
            position:absolute;
            top:18px;
            right:9px;
        }


        /* Template 5 styling */

        .m_3_name h3 span select{
            color: black !important;
            border: 0.5px solid black !important;
            background: none !important;
        }
        .alpha_t5_atc_btn-or {
            color: white !important;
            background-color: #13a1cf !important;
        }



        /* Template 6 Styling */

        .t6_cross_icon
        {
            text-align: center;
            position: absolute;
            top: 17px;
            right: 10px;
            line-height: 18px;
        }
        .alpha_t6_atc_btn, .alpha_t6_checkout_btn
        {
            border:1px solid white !important;
        }

        /* upsell setting after created*/
        @isset($upsell)
            @if ($upsell->setting['upsell_template_type'] == 1)
                @if (!$upsell->setting['offer_time_limit'])
                    .m_2_time
                    {
                        display:none;
                    }
                @endif
                .modal_2_head
                {
                    background-color:   {{ $upsell->setting['alpha_heading_bg_color_m1']  }} !important;
                }
                .modal_2_head h2
                {
                    font-family: {{ $upsell->setting['heading_font_family']  }} !important;
                    font-size:   {{ $upsell->setting['heading_font_size']  }}px !important;
                    color:       {{ $upsell->setting['alpha-m-1-heading-color']  }} !important;
                    text-align:  {{ $upsell->setting['heading_align']  }} !important;
                }
                .modal_2_head span
                {
                    color: {{ $upsell->setting['alpha_cross_icom_color']  }} !important;
                }
                .b_timer_head h2
                {
                    color: {{ $upsell->setting['time_offer_heading_color']  }} !important;
                    font-family: {{ $upsell->setting['offer_heading_font_family']  }} !important;
                    font-size: {{ $upsell->setting['offer_heading_font_size']  }}px !important;
                }
                .m_2_time label
                {
                    color: {{ $upsell->setting['timer_heading_color']  }} !important;
                }
                .m_2_time input
                {
                    color: {{ $upsell->setting['timer_color']  }} !important;
                }
                .m2_detail button
                {
                    background: {{ $upsell->setting['button_background_color']  }} !important;
                    color: {{ $upsell->setting['button_text_color']  }} !important;
                }
                .m2_detail p
                {
                    color:{{ $upsell->setting['alpha_original_price_color_m1']  }} !important;
                }
                .m2_detail p span
                {
                    color:{{ $upsell->setting['discount_text_color']  }} !important;
                    background: {{ $upsell->setting['discount_background_color']  }} !important;
                }
                .m_2_btn
                {
                    background-color:{{ $upsell->setting['no_thanks_background_color']  }} !important;
                    color:{{ $upsell->setting['no_thanks_text_color']  }} !important;
                    border-color:{{ $upsell->setting['no_thanks_border_color']  }} !important;;
                }
                .m_2_btn_2
                {
                    background-color:{{ $upsell->setting['checkout_background_color']  }} !important;;
                    color:{{ $upsell->setting['checkout_text_color']  }} !important;;
                    border-color:{{ $upsell->setting['checkout_border_color']  }} !important;;
                }
            @endif
            @if ($upsell->setting['upsell_template_type'] == 2)
                @if (!$upsell->setting['alpha_t2_timer_limit'])
                    .m_3_time
                    {
                        display: none;   
                    }
                @endif
                .modal_6_head h2
                {
                   font-family:{{ $upsell->setting['alpha_t2_heading_font_family']  }} !important; 
                   font-size:{{ $upsell->setting['alpha_t2_heading_font_size']  }}px !important; 
                   color:{{ $upsell->setting['alpha_t2_heading_color']  }} !important; 
                }
                .modal_6_head
                {
                    background-color:{{ $upsell->setting['alpha_t2_heading_background']  }} !important;
                }
                .modal_6_head h2 i
                {
                    color:{{ $upsell->setting['alpha_t2_icon_color']  }} !important;
                    background-color:{{ $upsell->setting['alpha_t2_icon_background']  }} !important;
                }
                .h_item_heading p input
                {
                    border-color:red !important;
                }
                .m6_timer h2
                {
                    font-family:{{ $upsell->setting['t2_heading_font_family']  }} !important; 
                    font-size:{{ $upsell->setting['t2_heading_font_size']  }}px !important;
                    color:{{ $upsell->setting['alpha_t2_deal_heading_color']  }} !important;
                }
                .m6_timer h2 span
                {
                    color:{{ $upsell->setting['alpha_t2_deal_span_color']  }} !important;
                }
                .m_3_time label
                {
                    font-family:{{ $upsell->setting['t2_timer_text_font_family']  }} !important; 
                    font-size:{{ $upsell->setting['t2_timer_text_font_size']  }}px !important;
                    color:{{ $upsell->setting['t2_timer_heading_color']  }} !important;
                }
                .m_3_time input
                {
                    color:{{ $upsell->setting['t2_timer_color']  }} !important;
                }
                .alpha_t2_atc_btn
                {
                    background-color:{{ $upsell->setting['alpha_t2_atc_btn_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t2_atc_btn_color']  }} !important;
                }
                .m6_p_heading p
                {
                    color:{{ $upsell->setting['alpha_t2_price_color']  }} !important;
                }
                .m6_p_heading p span
                {
                    background-color:{{ $upsell->setting['alpha_t2_discount_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t2_discount_color']  }} !important;
                }
                .alpha_t2_checkout_button
                {
                    background-color:{{ $upsell->setting['alpha_t2_checkout_btn_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t2_checkout_btn_color']  }} !important;
                    border-color:{{ $upsell->setting['alpha_t2_checkout_btn_border_color']  }} !important;
                }
                .modal_6_footer button
                {
                    background-color:{{ $upsell->setting['alpha_t2_no_thanks_btn_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t2_no_thanks_btn_color']  }} !important;
                    border-color:{{ $upsell->setting['alpha_t2_no_thanks_btn_border_color']  }} !important;
                }
            @endif
            @if ($upsell->setting['upsell_template_type'] == 3)
                @if (!$upsell->setting['alpha_t3_timer'])
                    .m_2_time_shoe
                    {
                        display: none;   
                    }
                @endif
                .alpha_t3_heading
                {
                    font-family:{{ $upsell->setting['alpha_t3_heading_font_family']  }} !important; 
                    font-size:{{ $upsell->setting['alpha_t3_heading_font_size']  }}px !important;
                    color:{{ $upsell->setting['alpha_t3_heading_color']  }} !important;
                }
                .alpha_close_model_t3
                {
                    color:{{ $upsell->setting['alpha_t3_cross_icon_color']  }} !important;
                    background-color:{{ $upsell->setting['alpha_t3_cross_icon_bg_color']  }} !important;
                }
                .m_1_bg
                {
                    background-color:{{ $upsell->setting['alpha_t3_cart_item_bg_color']  }} !important;
                    border-left-color:{{ $upsell->setting['alpha_t3_cart_item_border_color']  }} !important;
                }
                .m_1_head p span
                {
                    color:{{ $upsell->setting['alpha_t3_cart_item_price_color']  }} !important;
                }
                .b_timer_head_shoe h2
                {
                    font-family:{{ $upsell->setting['alpha_t3_r_product_heading_font_family']  }} !important;
                    font-size:{{ $upsell->setting['alpha_t3_r_product_heading_font_size']  }}px !important;
                    color:{{ $upsell->setting['alpha_t3_r_product_heading_color']  }} !important;

                }
                .m_2_time_shoe label
                {
                    font-family:{{ $upsell->setting['alpha_t3_timer_heading_font_family']  }} !important;
                    font-size:{{ $upsell->setting['alpha_t3_timer_heading_font_size']  }}px !important;
                    color:{{ $upsell->setting['alpha_t3_timer_heading_color']  }} !important;
                }
                .m_2_time_shoe input
                {
                    color:{{ $upsell->setting['alpha_t3_timer_color']  }} !important;
                    background-color:{{ $upsell->setting['alpha_t3_timer_bg_color']  }} !important;
                }
                .m_b_btn
                {
                    background-color:{{ $upsell->setting['alpha_t3_atc_btn_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t3_atc_btn_color']  }} !important;
                }
                .m_b_img_r p
                {
                    color:{{ $upsell->setting['alpha_t3_price_color']  }} !important;
                }
                .m_b_img_r p span
                {
                    background-color:{{ $upsell->setting['alpha_t3_dicount_price_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t3_dicount_price_color']  }} !important;
                }
                .m_b_img
                {
                    background-color:{{ $upsell->setting['alpha_t3_upsell_product_bg_color']  }} !important;
                }
                .alpha_t3_checkout_btn
                {
                    background-color:{{ $upsell->setting['alpha_t3_checkout_btn_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t3_checkout_color']  }} !important;
                    border-color:{{ $upsell->setting['alpha_t3_checkout_border_color']  }} !important;
                }
                .thnx_btn
                {
                    background-color:{{ $upsell->setting['alpha_t3_no_thanks_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t3_no_thanks_color']  }} !important;
                    border-color:{{ $upsell->setting['alpha_t3_no_thanks_border_color']  }} !important;
                }
            @endif
            @if ($upsell->setting['upsell_template_type'] == 4)
                @if (!$upsell->setting['alpha_t4_time_limit_toggler'])
                .b_timer4
                {
                    display: none;   
                }
                @endif
                .b_timer4 h4
                {
                    font-family:{{ $upsell->setting['alpha_t4_timer_heading_font_family']  }} !important;
                    font-size:{{ $upsell->setting['alpha_t4_timer_heading_font_size']  }}px !important;
                    color:{{ $upsell->setting['alpha_t4_timer_heading_color']  }} !important;
                }
                .timer4 input
                {
                   color:{{ $upsell->setting['alpha_t4_timer_color']  }} !important;  
                   background-color:{{ $upsell->setting['alpha_t4_timer_bg_color']  }} !important;  
                }
                .alpha_t4_cross_icon
                {
                   color:{{ $upsell->setting['alpha_t4_cross_icon_color']  }} !important;  
                   background-color:{{ $upsell->setting['alpha_t4_cross_icon_bg_color']  }} !important;  
                }
                .m4_top
                {
                   background-color:{{ $upsell->setting['alpha_t4_cart_product_bg_color']  }} !important;  
                }
                .m4_t1 i
                {
                   background-color:{{ $upsell->setting['alpha_t4_cart_product_icon_bg_color']  }} !important;  
                }
                .m4_t3
                {
                   color:{{ $upsell->setting['alpha_t4_cart_product_price_color']  }} !important;  
                }
                .m4_t4
                {
                   color:{{ $upsell->setting['alpha_t4_checkout_btn_color']  }} !important;  
                   {{-- color:{{ $upsell->setting['alpha_t4_cart_product_checkout_btn_color']  }} !important;   --}}
                }
                .m4_body h2
                {
                   font-family:{{ $upsell->setting['alpha_t4_title_heading_font_family']  }} !important;  
                   font-size:{{ $upsell->setting['alpha_t4_title_heading_font_size']  }}px !important;  
                   color:{{ $upsell->setting['alpha_t4_title_heading_color']  }} !important;  
                }
                .m_4_img_detail input
                {
                   background-color:{{ $upsell->setting['alpha_t4_atc_btn_bg_color']  }} !important;  
                   color:{{ $upsell->setting['alpha_t4_atc_btn_color']  }} !important; 
                   border: none; 
                }
                .m_4_img_detail p
                {
                   color:{{ $upsell->setting['alpha_t4_price_color']  }} !important;  
                }
                .m_4_img_detail p span
                {
                   background-color:{{ $upsell->setting['alpha_t4_discount_price_bg_color']  }} !important;  
                   color:{{ $upsell->setting['alpha_t4_discount_price_color']  }} !important;  
                }
                .m4_check
                {
                   background-color:{{ $upsell->setting['alpha_t4_checkout_btn_bg_color']  }} !important;  
                   color:{{ $upsell->setting['alpha_t4_checkout_btn_color']  }} !important; 
                   border-color:{{ $upsell->setting['alpha_t4_checkout_btn_border_color']  }} !important;; 
                }
                .t4_thanks
                {
                   background-color:{{ $upsell->setting['alpha_t4_no_thanks_btn_bg_color']  }} !important;  
                   color:{{ $upsell->setting['alpha_t4_no_thanks_btn_color']  }} !important; 
                   border-color:{{ $upsell->setting['alpha_t4_no_thanks_btn_border_color']  }} !important;; 
                }
            @endif
            @if ($upsell->setting['upsell_template_type'] == 5)
                @if (!$upsell->setting['alpha_t5_time_limit_toggler'])
                    .timer3
                    {
                        display: none;   
                    }
                @endif
                .b_timer3 h4
                {
                    font-family:{{ $upsell->setting['alpha_t5_timer_heading_font_family']  }} !important;
                    font-size:{{ $upsell->setting['alpha_t5_timer_heading_font_size']  }}px !important;
                    color:{{ $upsell->setting['alpha_t5_time_heading_color']  }} !important;
                }
                .timer3 input
                {
                   color:{{ $upsell->setting['alpha_t5_timer_color']  }} !important;  
                   background-color:{{ $upsell->setting['alpha_t5_timer_bg_color']  }} !important;  
                }
                .t5_cross_icon
                {
                   color:{{ $upsell->setting['alpha_t5_cross_icon_color']  }} !important;  
                }
                .m_3_top
                {
                   background-color:{{ $upsell->setting['alpha_t5_cart_product_bg_color']  }} !important;  
                }
                .m_3_top_price h4 span
                {
                   color:{{ $upsell->setting['alpha_t5_cart_produt_price_color']  }} !important;  
                }
                .alpha_t5_atc_btn
                {
                   background-color:{{ $upsell->setting['alpha_t5_atc_btn_bg_color']  }} !important;  
                   border-color:{{ $upsell->setting['alpha_t5_atc_btn_border_color']  }} !important;  
                   color:{{ $upsell->setting['alpha_t5_atc_btn_color']  }} !important;  
                }
                .m_3_name p
                {
                    color:{{ $upsell->setting['alpha_t5_price_color']  }} !important;
                }
                .m_3_name p span
                {
                    background-color:{{ $upsell->setting['alpha_t5_discount_price_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t5_discount_price_color']  }} !important;
                }
                .t5_checkout_btn
                {
                   background-color:{{ $upsell->setting['alpha_t5_checkout_btn_bg_color']  }} !important;  
                   color:{{ $upsell->setting['alpha_t5_checkout_btn_color']  }} !important; 
                   border-color:{{ $upsell->setting['alpha_t5_checkout_btn_border_color']  }} !important;; 
                }
                .t5_no_thanks_btn
                {
                   background-color:{{ $upsell->setting['alpha_t5_no_thanks_btn_bg_color']  }} !important;  
                   color:{{ $upsell->setting['alpha_t5_no_thanks_btn_color']  }} !important; 
                   border-color:{{ $upsell->setting['alpha_t5_no_thanks_btn_border_color']  }} !important;; 
                }
            @endif
            @if ($upsell->setting['upsell_template_type'] == 6)
                .modal_5_head h2
                {
                   font-family:{{ $upsell->setting['alpha_t6_top_heading_font_family']  }} !important;
                   font-size:{{ $upsell->setting['alpha_t6_top_heading_font_size']  }}px !important;
                   color:{{ $upsell->setting['alpha_t6_top_heading_color']  }} !important;
                }
                .modal_5_head span
                {
                    color:{{ $upsell->setting['alpha_t6_cross_icon_color']  }} !important;
                    background-color:{{ $upsell->setting['alpha_t6_cross_icon_bg_color']  }} !important;
                }
                .m5_item h3
                {
                    color:{{ $upsell->setting['alpha_t6_cart_product_title_color']  }} !important;
                }
                .prodcut_item
                {
                    background-color:{{ $upsell->setting['alpha_t6_cart_product_bg_color']  }} !important;
                }
                .item_detail p
                {
                    color:{{ $upsell->setting['alpha_t6_cart_product_price_color']  }} !important;
                }
                .m5_p h3
                {
                    color:{{ $upsell->setting['alpha_t6_product_title_color']  }} !important;
                }
                .sale_detail p
                {
                    color:{{ $upsell->setting['alpha_t6_price_color']  }} !important;
                }
                .sale_detail p span
                {
                    background-color:{{ $upsell->setting['alpha_t6_dicount_bg_color']  }} !important;
                    color:{{ $upsell->setting['alpha_t6_discount_color']  }} !important;
                }
                .sale_detail input
                {
                   background-color:{{ $upsell->setting['alpha_t6_atc_btn_bg_color']  }} !important;
                   border-color:{{ $upsell->setting['alpha_t6_btn_border_color']  }} !important;
                   color:{{ $upsell->setting['alpha_t6_btn_color']  }} !important; 
                }
                .m5_thanks
                {
                   background-color:{{ $upsell->setting['alpha_no_thanks_btn_bg_color']  }} !important;
                   color:{{ $upsell->setting['alpha_no_thanks_btn_color']  }} !important; 
                   border-color:{{ $upsell->setting['alpha_no_thanks_btn_border_color']  }} !important;
                }
                .item_detail input
                {
                   background-color:{{ $upsell->setting['alpha_t6_checkout_btn_bg_color']  }} !important;
                   color:{{ $upsell->setting['alpha_t6_checkout_btn_color']  }} !important; 
                   border-color:{{ $upsell->setting['alpha_t6_checkout_btn_border_color']  }} !important;
                }

            @endif
        @endisset
    </style>
@endpush


@push('componentJs')
    <script src="https://unpkg.com/vanilla-picker@2"></script>
    <script>
        $("#delete_button_auto").on( "click", function() {
            $( "#ppu_button" ).trigger( "click" );
        });
        $(function(){
            $(".colorpicker").each(function(index,element){
                new Picker(element).onChange = function(color) {
                    $(element).css({background : color.hex});
                    $(`input[name=${$(element).data('id')}]`).val(color.hex).trigger('change');
                };
            });

            /** ----------Model 1 JavaScript Start---------- */
            
            $('input[name="add_to_cart_heading"]').keyup(function(e){
                $('.add_to_cart_heading_m_1').text($(this).val())
            });
            $('select[name="heading_font_family"]').change(function(){
                setProperty('.add_to_cart_heading_m_1',"font-family",`${$(this).val()}`);
            });
            $('input[name="heading_font_size"]').change(function(){
                setProperty('.add_to_cart_heading_m_1',"font-size",`${$(this).val()}px`);
            });
            $('input[name="heading_font_size"]').keyup(function(){
                setProperty('.add_to_cart_heading_m_1',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha-m-1-heading-color"]').change(function(){
                setProperty('.add_to_cart_heading_m_1',"color",`${$(this).val()}`);
            });
            $('select[name="heading_align"]').change(function(){
                setProperty('.add_to_cart_heading_m_1',"text-align",`${$(this).val()}`);
            });
            $('input[name="alpha_heading_bg_color_m1"]').change(function(){
                setProperty('.modal_2_head',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_cross_icom_color"]').change(function(){
                setProperty('.alpha_close_model',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_cross_icom_color"]').change(function(){
                setProperty('.alpha_atc_heading_m1_check',"color",`${$(this).val()}`);
            });
            $('input[name="offer_time_limit"]').change(function(e){
                if($(this).is(':checked')){
                    $(".m_2_time").show();
                }else{
                    $(".m_2_time").hide();
                }
            });
            $('input[name="time_offer_heading"]').keyup(function(){
                $('.b_timer_head_text').text($(this).val())
            });
            $('input[name="total_price_text"]').keyup(function(){
                $('.total-price-text').text($(this).val())
            });
            $('select[name="offer_heading_font_family"]').change(function(){
                setProperty('.b_timer_head_text',"font-family",`${$(this).val()}`);
            });
            $('input[name="offer_heading_font_size"]').change(function(){
                setProperty('.b_timer_head_text',"font-size",`${$(this).val()}px`);
            });
            $('input[name="offer_heading_font_size"]').keyup(function(){
                setProperty('.b_timer_head_text',"font-size",`${$(this).val()}px`);
            });
            $('input[name="time_duration_minutes"]').change(function(){
                $('.offer_timer_m1_minutes').val($(this).val());
            });
            $('input[name="time_duration_minutes"]').keyup(function(){
                $('.offer_timer_m1_minutes').val($(this).val());
            });
            $('input[name="timer_text"]').keyup(function(){
                $('.alpha_m1_timer_label').text($(this).val());
            });
            $('input[name="time_offer_heading_color"]').change(function(){
                setProperty('.b_timer_head_text',"color",`${$(this).val()}`);
            });
            $('input[name="text-color-price-total"]').change(function(){
                setProperty('.total-price-text',"color",`${$(this).val()}`);
            });
            $('input[name="price-color-figure"]').change(function(){
                setProperty('.aus-total-price-fig',"color",`${$(this).val()}`);
            });
            $('input[name="timer_heading_color"]').change(function(){
                setProperty('.m_2_time',"color",`${$(this).val()}`);
            });
            $('input[name="timer_color"]').change(function(){
                setProperty('.offer_timer_m1_minutes',"color",`${$(this).val()}`);
                setProperty('.offer_timer_m1_seconds',"color",`${$(this).val()}`);
            });
            $('input[name="add_to_cart_text"]').keyup(function(){
                $('.alpha_m1_add_to_cart_btn').text($(this).val());
            });
            $('input[name="alpha_original_price_color_m1"]').change(function(){
                setProperty('.m2_detail p',"color",`${$(this).val()}`);
            });
            $('input[name="button_background_color"]').change(function(){
                setProperty('.alpha_m1_add_to_cart_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="button_text_color"]').change(function(){
                setProperty('.alpha_m1_add_to_cart_btn',"color",`${$(this).val()}`);
            });
            $('input[name="discount_background_color"]').change(function(){
                setProperty('.m2_detail p span',"background-color",`${$(this).val()}`);
            });
            $('input[name="discount_text_color"]').change(function(){
                setProperty('.m2_detail p span',"color",`${$(this).val()}`);
            });
            $('input[name="checkout_button_text"]').keyup(function(){
                $('.m_2_btn_2').text(`${$(this).val()}`)
            });
            $('input[name="checkout_background_color"]').change(function(){
                setProperty('.m_2_btn_2',"background-color",`${$(this).val()}`);
            });
            $('input[name="checkout_text_color"]').change(function(){
                setProperty('.m_2_btn_2',"color",`${$(this).val()}`);
            });
            $('input[name="checkout_border_color"]').change(function(){
                setProperty('.m_2_btn_2',"border-color",`${$(this).val()}`);
            });
            $('input[name="no_thanks_button_text"]').keyup(function(){
                $('.m_2_btn').text(`${$(this).val()}`)
            });
            $('input[name="no_thanks_background_color"]').change(function(){
                setProperty('.m_2_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="no_thanks_text_color"]').change(function(){
                setProperty('.m_2_btn',"color",`${$(this).val()}`);
            });
            $('input[name="no_thanks_border_color"]').change(function(){
                setProperty('.m_2_btn',"border-color",`${$(this).val()}`);
            });

        
        /** ----------------Model 1 JavaScript End------------------------- */
        /** ----------------Model 2 JavaScript start------------------------  */

            $('input[name="alpha_atc_t1_heading"]').keyup(function(){
                $('.alpha_t2_heading').text(`${$(this).val()}`)
            });
            $('input[name="t2-total-price-text"]').keyup(function(){
                $('.total-price-t2').text(`${$(this).val()}`)
            });
            $('select[name="alpha_t2_heading_font_family"]').change(function(){
                setProperty('.alpha_t2_heading',"font-family",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_heading_font_size"]').change(function(){
                setProperty('.alpha_t2_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t2_heading_font_size"]').keyup(function(){
                setProperty('.alpha_t2_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t2_heading_color"]').change(function(){
                setProperty('.alpha_t2_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_heading_background"]').change(function(){
                setProperty('.modal_6_head',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_icon_color"]').change(function(){
                setProperty('.t1_icon',"color",`${$(this).val()}`);
            });
            $('input[name="t2-total-price-color"]').change(function(){
                setProperty('.total-price-t2',"color",`${$(this).val()}`);
            });
            $('input[name="t2-price-color"]').change(function(){
                setProperty('.price-fig-t2',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_icon_background"]').change(function(){
                setProperty('.t1_icon',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_qty"]').change(function(){
                setProperty('.alpha_t2_qty',"border-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_timer_limit"]').change(function(){
               if($(this).is(':checked')){
                    $(".m_3_time").show();
                }else{
                    $(".m_3_time").hide();
                }
            });
            $('input[name="alpha_t2_deal_heading"]').keyup(function(){
                $('.t2_deal_heading').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t2_deal_span"]').keyup(function(){
                $('.t2_deal_discount').text(`${$(this).val()}`)
            });
            $('select[name="t2_heading_font_family"]').change(function(){
                setProperty('.temp_2_deal_heading',"font-family",`${$(this).val()}`);
            });
            $('input[name="t2_heading_font_size"]').change(function(){
                setProperty('.temp_2_deal_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="t2_heading_font_size"]').keyup(function(){
                setProperty('.temp_2_deal_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="t2_time_duration"]').change(function(){
                 $('.t2_time_duration').val(`${$(this).val()}`);
            });
            $('input[name="t2_time_duration"]').keyup(function(){
                 $('.t2_time_duration').val(`${$(this).val()}`);
            });
            $('input[name="t2_timer_text"]').keyup(function(){
                 $('.t2_timer_text').text(`${$(this).val()}`);
            });
            $('select[name="t2_timer_text_font_family"]').change(function(){
                setProperty('.t2_timer_text',"font-family",`${$(this).val()}`);
            });
            $('input[name="t2_timer_text_font_size"]').change(function(){
                setProperty('.t2_timer_text',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t2_deal_heading_color"]').change(function(){
                setProperty('.t2_deal_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_deal_span_color"]').change(function(){
                setProperty('.t2_deal_discount',"color",`${$(this).val()}`);
            });
            $('input[name="t2_timer_heading_color"]').change(function(){
                setProperty('.t2_timer_text',"color",`${$(this).val()}`);
            });
            $('input[name="t2_timer_color"]').change(function(){
                setProperty('.t2_timer',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_atc_btn_text"]').keyup(function(){
                $('.alpha_t2_atc_btn').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t2_atc_btn_bg_color"]').change(function(){
                setProperty('.alpha_t2_atc_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_atc_btn_color"]').change(function(){
                setProperty('.alpha_t2_atc_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_price_color"]').change(function(){
                setProperty('.m6_p_heading p',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_discount_bg_color"]').change(function(){
                setProperty('.m6_p_heading p span',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_discount_color"]').change(function(){
                setProperty('.m6_p_heading p span',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_checkout_btn"]').keyup(function(){
                 $('.alpha_t2_checkout_button').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t2_checkout_btn_bg_color"]').change(function(){
                setProperty('.alpha_t2_checkout_button',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_checkout_btn_color"]').change(function(){
                setProperty('.alpha_t2_checkout_button',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_checkout_btn_border_color"]').change(function(){
                setProperty('.alpha_t2_checkout_button',"border-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_no_thanks_btn"]').keyup(function(){
                $('.no_thanks_btn').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t2_no_thanks_btn_bg_color"]').change(function(){
                setProperty('.no_thanks_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_no_thanks_btn_color"]').change(function(){
                setProperty('.no_thanks_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t2_no_thanks_btn_border_color"]').change(function(){
                setProperty('.no_thanks_btn',"border-color",`${$(this).val()}`);
            });
            
        /** ----------------Model 2 JavaScript End------------------------ */
        /** ----------------Model 3 JavaScript start------------------------ */
            $('input[name="alpha_t3_heading"]').keyup(function(){
                $('.alpha_t3_heading').text(`${$(this).val()}`)
            });
            $('select[name="alpha_t3_heading_font_family"]').change(function(){
               setProperty('.alpha_t3_heading',"font-family",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_heading_font_size"]').change(function(){
               setProperty('.alpha_t3_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t3_heading_font_size"]').keyup(function(){
               setProperty('.alpha_t3_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t3_heading_color"]').change(function(){
               setProperty('.alpha_t3_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_cross_icon_color"]').change(function(){
               setProperty('.alpha_close_model_t3',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_cross_icon_color"]').change(function(){
               setProperty('.t3-icon-template-3',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_cross_icon_bg_color"]').change(function(){
               setProperty('.alpha_close_model_t3',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_cross_icon_bg_color"]').change(function(){
               setProperty('.t3-icon-template-3',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_cart_item_bg_color"]').change(function(){
               setProperty('.alpha_t3_cart_item',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_cart_item_border_color"]').change(function(){
               setProperty('.alpha_t3_cart_item',"border-left-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_cart_item_price_color"]').change(function(){
               setProperty('.alpha_t3_cart_item_price',"color",`${$(this).val()}`);
            });
            // $('input[name="alpha_t3_cont_shop_btn_color"]').change(function(){
            //    setProperty('.m_1_top_btn',"color",`${$(this).val()}`);
            // });
            $('input[name="alpha_t3_timer"]').change(function(){
                if($(this).is(':checked')){
                    $(".m_2_time_shoe").show();
                }else{
                    $(".m_2_time_shoe").hide();
                }
            });
            $('input[name="alpha_t3_r_product_heading"]').keyup(function(){
               $('.alpha_t3_r_product_heading').text(`${$(this).val()}`)
            });
            $('select[name="alpha_t3_r_product_heading_font_family"]').change(function(){
                setProperty('.alpha_t3_r_product_heading',"font-family",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_r_product_heading_font_size"]').change(function(){
                setProperty('.alpha_t3_r_product_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t3_r_product_heading_font_size"]').keyup(function(){
                setProperty('.alpha_t3_r_product_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t3_timer_duration"]').keyup(function(){
                $('.alpha_t3_timer_duration').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t3_timer_duration"]').change(function(){
                $('.alpha_t3_timer_duration').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t3_timer_heaading"]').keyup(function(){
                $('.alpha_t3_timer_heaading').text(`${$(this).val()}`)
            });
            $('select[name="alpha_t3_timer_heading_font_family"]').change(function(){
                setProperty('.alpha_t3_timer_heaading',"font-family",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_timer_heading_font_size"]').keyup(function(){
                setProperty('.alpha_t3_timer_heaading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t3_timer_heading_font_size"]').change(function(){
                setProperty('.alpha_t3_timer_heaading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t3_r_product_heading_color"]').change(function(){
                setProperty('.alpha_t3_r_product_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_timer_heading_color"]').change(function(){
                setProperty('.alpha_t3_timer_heaading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_timer_color"]').change(function(){
                setProperty('.alpha_t3_timer',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_timer_bg_color"]').change(function(){
                setProperty('.alpha_t3_timer',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_atc_btn"]').keyup(function(){
                $('.alpha_t3_atc_btn').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t3_atc_btn_bg_color"]').change(function(){
                setProperty('.alpha_t3_atc_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_atc_btn_color"]').change(function(){
                setProperty('.alpha_t3_atc_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_price_color"]').change(function(){
                setProperty('.m_b_img_r p',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_dicount_price_bg_color"]').change(function(){
                setProperty('.m_b_img_r p span',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_dicount_price_color"]').change(function(){
                setProperty('.m_b_img_r p span',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_upsell_product_bg_color"]').change(function(){
                setProperty('.m_b_img',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_checkout_btn"]').keyup(function(){
                $('.alpha_t3_checkout_btn').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t3_checkout_btn_bg_color"]').change(function(){
                setProperty('.alpha_t3_checkout_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_checkout_color"]').change(function(){
                setProperty('.alpha_t3_checkout_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_checkout_border_color"]').change(function(){
                setProperty('.alpha_t3_checkout_btn',"border-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_no_thanks_btn"]').keyup(function(){
                $('.thnx_btn').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t3_no_thanks_bg_color"]').change(function(){
                setProperty('.thnx_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_no_thanks_bg_color"]').change(function(){
                setProperty('.thnx_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_no_thanks_color"]').change(function(){
                setProperty('.thnx_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t3_no_thanks_border_color"]').change(function(){
                setProperty('.thnx_btn',"border-color",`${$(this).val()}`);
            });
        /** ----------------Model 3 JavaScript End------------------------ */
        /** ----------------Model 4 JavaScript start------------------------ */
            $('input[name="alpha_t4_time_limit_toggler"]').change(function(){
                if($(this).is(':checked')){
                    $(".b_timer4").show();
                }else{
                    $(".b_timer4").hide();
                }
            });
            $('input[name="alpha_t4_time_duration"]').change(function(){
                $('.alpha_t4_timer').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t4_time_duration"]').keyup(function(){
                $('.alpha_t4_timer').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t4_timer_heading"]').keyup(function(){
                $('.b_timer4_heading').text(`${$(this).val()}`)
            });
            $('select[name="alpha_t4_timer_heading_font_family"]').change(function(){
                setProperty('.b_timer4_heading',"font-family",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_timer_heading_font_size"]').change(function(){
                setProperty('.b_timer4_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t4_timer_heading_font_size"]').keyup(function(){
                setProperty('.b_timer4_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t4_timer_heading_color"]').change(function(){
                setProperty('.b_timer4_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_timer_color"]').change(function(){
                setProperty('.t4_timer',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_timer_bg_color"]').change(function(){
                setProperty('.t4_timer',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_cross_icon_color"]').change(function(){
                setProperty('.alpha_t4_cross_icon',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_cross_icon_color"]').change(function(){
                setProperty('.alpha_t4_p_t4_cross',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_cross_icon_bg_color"]').change(function(){
                setProperty('.alpha_t4_cross_icon',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_cross_icon_bg_color"]').change(function(){
                setProperty('.alpha_t4_p_t4_cross',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_cart_product_bg_color"]').change(function(){
                setProperty('.alpha_t4_cart_product',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_cart_product_icon_bg_color"]').change(function(){
                setProperty('.alpha_t4_p_t4_cross',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_cart_product_price_color"]').change(function(){
                setProperty('.t4_Cart_product_price',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_cart_product_checkout_btn_color"]').change(function(){
                setProperty('.t4_checkout',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_title_heading"]').keyup(function(){
               $('.t4_heading').text(`${$(this).val()}`)
            });
            $('select[name="alpha_t4_title_heading_font_family"]').change(function(){
               setProperty('.t4_heading',"font-family",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_title_heading_font_size"]').change(function(){
               setProperty('.t4_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t4_title_heading_font_size"]').keyup(function(){
               setProperty('.t4_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t4_title_heading_color"]').change(function(){
               setProperty('.t4_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_atc_btn"]').keyup(function(){
                $('.t4_atc_btn').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t4_atc_btn_bg_color"]').change(function(){
                setProperty('.t4_atc_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_atc_btn_color"]').change(function(){
                setProperty('.t4_atc_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_price_color"]').change(function(){
                setProperty('.m_4_img_detail p',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_discount_price_bg_color"]').change(function(){
                setProperty('.m_4_img_detail p span',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_discount_price_color"]').change(function(){
                setProperty('.m_4_img_detail p span',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_checkout_btn"]').keyup(function(){
                $('.t4_checkout').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t4_checkout_btn_bg_color"]').change(function(){
                setProperty('.t4_checkout',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_checkout_btn_color"]').change(function(){
                setProperty('.t4_checkout',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_checkout_btn_border_color"]').change(function(){
                setProperty('.t4_checkout',"border-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_no_thanks_btn"]').keyup(function(){
                $('.t4_thanks').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t4_no_thanks_btn_bg_color"]').change(function(){
                setProperty('.t4_thanks',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t4_no_thanks_btn_color"]').change(function(){
                setProperty('.t4_thanks',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_no_thanks_btn_border_color"]').change(function(){
                setProperty('.t4_thanks',"border-color",`${$(this).val()}`);
            });
        /** ----------------Model 4 JavaScript End------------------------ */
        /** ----------------Model 5 JavaScript start------------------------ */

            $('input[name="alpha_t5_time_limit_toggler"]').change(function(){
                if($(this).is(':checked')){
                    $(".t5_timer_d").show();
                }else{
                    $(".t5_timer_d").hide();
                }
            });
            $('input[name="alpha_t5_time_duration"]').keyup(function(){
                $('.t5_timer').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t5_time_duration"]').change(function(){
                $('.t5_timer').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t5_timer_heading"]').keyup(function(){
                $('.alpha_t5_timer_heading').text(`${$(this).val()}`)
            });
            $('select[name="alpha_t5_timer_heading_font_family"]').change(function(){
                setProperty('.alpha_t5_timer_heading',"font-family",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_timer_heading_font_size"]').change(function(){
                setProperty('.alpha_t5_timer_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t5_timer_heading_font_size"]').keyup(function(){
                setProperty('.alpha_t5_timer_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t5_time_heading_color"]').change(function(){
                setProperty('.alpha_t5_timer_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_timer_color"]').change(function(){
                setProperty('.alpha_t5_timer',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_timer_bg_color"]').change(function(){
                setProperty('.alpha_t5_timer',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_cross_icon_color"]').change(function(){
                setProperty('.t5_cross_icon',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_cross_icon_color"]').change(function(){
                setProperty('.fas.fa-check',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_cart_product_bg_color"]').change(function(){
                setProperty('.m_3_top',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_cart_produt_price_color"]').change(function(){
                setProperty('.m_3_top_price h4 span',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_atc_btn"]').keyup(function(){
                $('.alpha_t5_atc_btn').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t5_atc_btn_bg_color"]').change(function(){
                setProperty('.alpha_t5_atc_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_atc_btn_border_color"]').change(function(){
                setProperty('.alpha_t5_atc_btn',"border-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_atc_btn_color"]').change(function(){
                setProperty('.alpha_t5_atc_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_price_color"]').change(function(){
                setProperty('.m_3_name p',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_discount_price_bg_color"]').change(function(){
                setProperty('.m_3_name p span',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_discount_price_color"]').change(function(){
                setProperty('.m_3_name p span',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_checkout_btn"]').keyup(function(){
                $('.t5_checkout_btn').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t5_checkout_btn_bg_color"]').change(function(){
                setProperty('.t5_checkout_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_checkout_btn_color"]').change(function(){
                setProperty('.t5_checkout_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_checkout_btn_border_color"]').change(function(){
                setProperty('.t5_checkout_btn',"border-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_no_thanks_btn"]').keyup(function(){
                $('.t5_no_thanks_btn').text(`${$(this).val()}`)
            });
            $('input[name="alpha_t5_no_thanks_btn_bg_color"]').change(function(){
                setProperty('.t5_no_thanks_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_no_thanks_btn_color"]').change(function(){
                setProperty('.t5_no_thanks_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t5_no_thanks_btn_border_color"]').change(function(){
                setProperty('.t5_no_thanks_btn',"border-color",`${$(this).val()}`);
            });
        /** ----------------Model 5 JavaScript end------------------------ */
        /** ----------------Model 6 JavaScript start------------------------ */
            $('input[name="alpha_t6_top_heading"]').keyup(function(){
                $('.alpha_t6_top_heading').text(`${$(this).val()}`)
            });
            $('select[name="alpha_t6_top_heading_font_family"]').change(function(){
               setProperty('.alpha_t6_top_heading',"font-family",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_top_heading_font_size"]').change(function(){
               setProperty('.alpha_t6_top_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t6_top_heading_font_size"]').keyup(function(){
               setProperty('.alpha_t6_top_heading',"font-size",`${$(this).val()}px`);
            });
            $('input[name="alpha_t6_top_heading_color"]').change(function(){
               setProperty('.alpha_t6_top_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_cross_icon_color"]').change(function(){
               setProperty('.t6_cross_icon',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_cross_icon_bg_color"]').change(function(){
               setProperty('.t6_cross_icon',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_cart_product_title_color"]').change(function(){
               setProperty('.alpha_t6_cart_product_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_cart_product_bg_color"]').change(function(){
               setProperty('.prodcut_item',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_cart_product_price_color"]').change(function(){
               setProperty('.t6_cart_product_price',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_product_heading"]').keyup(function(){
               $('.alpha_t6_product_heading').text(`${$(this).val()}`);
            });
            $('input[name="alpha_t6_cart_btn"]').keyup(function(){
               $('.alpha_t6_atc_btn').val(`${$(this).val()}`);
            });
            $('input[name="alpha_t6_product_title_color"]').change(function(){
               setProperty('.alpha_t6_product_heading',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_price_color"]').change(function(){
               setProperty('.sale_detail p',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_dicount_bg_color"]').change(function(){
               setProperty('.sale_detail p span',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_discount_color"]').change(function(){
               setProperty('.sale_detail p span',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_atc_btn_bg_color"]').change(function(){
               setProperty('.alpha_t6_atc_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_btn_border_color"]').change(function(){
               setProperty('.alpha_t6_atc_btn',"border-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_btn_color"]').change(function(){
               setProperty('.alpha_t6_atc_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_checkout_btn"]').keyup(function(){
               $('.alpha_t6_checkout_btn').val(`${$(this).val()}`)
            });
            $('input[name="alpha_t6_checkout_btn_bg_color"]').change(function(){
               setProperty('.alpha_t6_checkout_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_checkout_btn_color"]').change(function(){
               setProperty('.alpha_t6_checkout_btn',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_t6_checkout_btn_border_color"]').change(function(){
               setProperty('.alpha_t6_checkout_btn',"border-color",`${$(this).val()}`);
            });
            $('input[name="alpha_no_thanks_btn"]').keyup(function(){
               $('.m5_thanks').val(`${$(this).val()}`)
            });
            $('input[name="alpha_no_thanks_btn_bg_color"]').change(function(){
               setProperty('.m5_thanks',"background-color",`${$(this).val()}`);
            });
            $('input[name="alpha_no_thanks_btn_color"]').change(function(){
               setProperty('.m5_thanks',"color",`${$(this).val()}`);
            });
            $('input[name="alpha_no_thanks_btn_border_color"]').change(function(){
               setProperty('.m5_thanks',"border-color",`${$(this).val()}`);
            });
            $(document).on('click','.end_date', function() {
               $('.end_date').css({'background-color': '#fffdfd'});
            });

        /** ----------------Model 6 JavaScript end------------------------ */

        /** -----------------Save upsell with Template Setting ---------------------- */
            $('.select-template').click(function(){
                $('.popup_1').removeClass("select_popup");
                $(this).closest('.popup_1').addClass('select_popup')
            })
        /** ----------Decalre variable id and upsell_add_rule for updating the upsell after saving--------- */
            var id = '';
            var upsell_add_route = '';
        /** 
        *    ------After clicking the save_setting button save upsell if it is not created-------
        *    ------if upsell created change the route for update ------------------
        */


        @isset($upsell)
            $('.update_setting').click(function(){
                let element = $(this);
                addSpinner($(element));
                $('.template-to-select').val($(this).data('id'))
                let template_to_select = ".template-"+$('.template-to-select').val();
                ajaxRequest("{{ route('upsell.update',$upsell) }}",function(response){
                    if(response.status){
                        $(element).empty().html('Save changes').prop('disabled',false);
                        $(element).prev('.cancel').trigger('click')
                        $('.alpha_t_u_choosen').remove()
                        var chekedTemplateCode = '<div class="alpha_t_u_choosen"><span>&#10003;</span></div>'
                        $('.template_'+response.template).prepend(chekedTemplateCode)
                    }
                    else if(response.errors){
                        $(element).empty().html('Save changes').prop('disabled',false);
                    }
                },'POST',$(".upsellForm, "+template_to_select+"").serialize());
            });
        @else            
            $('.save_setting').click(function(){
                let element = $(this);
                addSpinner($(element));
                if(id == ''){
                    upsell_add_route = "{{ route('upsell.store',$upsellType) }}";
                }
                else{
                    var upsell_update_route = "{{ route('upsell.update','') }}";
                    upsell_add_route = upsell_update_route+'/'+id;
                }
                $('.template-to-select').val($(this).data('id'))
                let template_to_select = ".template-"+$('.template-to-select').val();
                ajaxRequest(upsell_add_route,function(response){
                    if(response.status){
                        $(element).empty().html('Save changes').prop('disabled',false);
                        $('.saveUpsell').empty().html('update');
                        id = response.upsell_id;
                        $(element).prev('.cancel').trigger('click')
                        $('.alpha_t_u_choosen').remove()
                        var chekedTemplateCode = '<div class="alpha_t_u_choosen"><span>&#10003;</span></div>'
                        $('.template_'+response.template).prepend(chekedTemplateCode)
                    }
                    else if(response.errors){
                        $(element).empty().html('Save changes').prop('disabled',false);
                    }
                },'POST',$(".upsellForm, "+template_to_select+"").serialize());
            });
        @endisset



        /** -------Save Upsell with Template Setting by clicking the button Save------------ */


        @isset($upsell)
            $('.updateUpsell').click(function(){
                let element = $(this);
                addSpinner($(element));
                let template_to_select = ".template-"+$('.template-to-select').val();
                ajaxRequest("{{ route('upsell.update',$upsell) }}",function(response){
                    if(response.status){
                        $(element).empty().html('update').prop('disabled',false);
                    }
                },'POST',$(".upsellForm, "+template_to_select+"").serialize());

            });
        @else
            $('.saveUpsell').click(function(){
                let element = $(this);
                addSpinner($(element));
                if(id == ''){
                    upsell_add_route = "{{ route('upsell.store',$upsellType) }}";
                }
                else{
                    var upsell_update_route = "{{ route('upsell.update','') }}";
                    upsell_add_route = upsell_update_route+'/'+id;
                }
                let template_to_select = ".template-"+$('.template-to-select').val();
                ajaxRequest(upsell_add_route,function(response){
                    if(response.status){
                        $(element).empty().html('update').prop('disabled',false);
                        id = response.upsell_id;
                        // var template_class       = "template_"+response.template;
                    }
                    else if(response.errors){
                        $(element).empty().html('Save').prop('disabled',false);
                    }
                },'POST',$(".upsellForm, "+template_to_select+"").serialize());
            });
        @endisset
        /** -----------------Save Upsell with Template Setting End------------------------ */
        });
        @isset($upsell)
            var upsell = {!! $upsell !!}
            if(upsell.auto){
                var flag = true;
            }
            else{
                var flag = false;
            }
        @else
            var flag = false;
        @endisset
        $('.ppu-auto-button').on('click',function(){
            console.log(flag)
            var html = `<div class="box_shado mt" style="display: flex; align-items: center;"><div class="img_box col-md-2" style="width: 100%;"> <img src="https://i.ibb.co/zP4drmC/Pngtree-artificial-intelligence-chip-icon-for-4864546.png" alt="error loading image "></div><div><span>Our AI analysis the previous purchases in your store through data mining algorithm & produce memory graph with recommended products that are usually added.</span></div><div class="img_btn col-md-2"><button id="delete_button_auto"type="button" class="delete float-right">Delete</button></div></div>`
            
            if(!flag){
                $("#auto-collapse-box").css('display','block')
                $("#auto-collapse-box").html(html);
                flag = true;
            }
            else{
                $("#auto-collapse-box").css('display','none')
                $("#auto-collapse-box").html('');
                flag = false;
            }
        });
        $(document).on('click','#delete_button_auto',function(){
            // console.log($(this).get())
            // console.log($('.autoButton'))
            $('.ppu-auto-button')[0].click()
        });
    </script>
@endpush