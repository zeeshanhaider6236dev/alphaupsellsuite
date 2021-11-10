<?php
namespace App\Http\Traits;


trait AddtocartRulesTrait {

    

    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * Define Rules for Template 1
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function template_1()
    {
         
        $extra    = [];
        $extra [] = ['key'  => 'upsell_template_type', 'value' => ['required',"numeric"] ];
        $extra [] = [ 'key' => 'add_to_cart_heading', 'value' => [ "required", "string", 'max:191' ] ];
        // Total Price Text Rules
        $extra [] = [ 'key' => 'total_price_text', 'value' => [ "required", "string", 'max:191' ] ];
        // Total Price Text Color Rules
        $extra [] = [ 'key' => 'text-color-price-total', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        // Total Price Color Rules
        $extra [] = [ 'key' => 'price-color-figure', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        

        $extra [] = [ 'key' => 'heading_font_family', 'value' => [ "required", "string" ] ];
        $extra [] = [ 'key' => 'heading_font_size', 'value'   => [ "required", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha-m-1-heading-color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'heading_align', 'value' => [ "required", 'string', 'in:Left,Center,Right' ] ];
        $extra [] = [ 'key' => 'alpha_heading_bg_color_m1', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_cross_icom_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];

        $extra [] = [ 'key' => 'offer_time_limit', 'value' => [ "nullable","in:1" ] ];
        $extra [] = [ 'key' => 'time_offer_heading', 'value' => [ "required_if:offer_time_limit,1","string","max:191"]];
        $extra [] = [ 'key' => 'offer_heading_font_family', 'value' => [ "required_if:offer_time_limit,1","string"]];
        $extra [] = [ 'key' => 'offer_heading_font_size', 'value'   => [ "required_if:offer_time_limit,1", "numeric" ] ];
        $extra [] = [ 'key' => 'time_duration_minutes', 'value'   => [ "required_if:offer_time_limit,1", "numeric" ] ];
        $extra [] = [ 'key' => 'timer_text', 'value'   => [ "required_if:offer_time_limit,1", "string" ] ];
        $extra [] = [ 'key' => 'time_offer_heading_color', 'value' => [ "required_if:offer_time_limit,1", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'timer_heading_color', 'value' => [ "required_if:offer_time_limit,1", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'timer_color', 'value' => [ "required_if:offer_time_limit,1", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        
        $extra [] = [ 'key' => 'add_to_cart_text', 'value' => [ "required", "string", 'max:191'  ] ];
        $extra [] = [ 'key' => 'alpha_original_price_color_m1', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'discount_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'discount_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        
        $extra [] = [ 'key' => 'checkout_button_text', 'value' => [ "required", "string", 'max:191'  ] ];
        $extra [] = [ 'key' => 'no_thanks_button_text', 'value' => [ "required", "string", 'max:191'  ] ];
        $extra [] = [ 'key' => 'checkout_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'no_thanks_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'checkout_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'no_thanks_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'checkout_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'no_thanks_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];


        return $extra; 
    }
    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * Define Rules for Template 2
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function template_2()
    {
        $extra    = [];
        $extra [] = [ 'key' => 'alpha_atc_t1_heading', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t2_heading_font_family', 'value' => [ "required", "string" ] ];
        $extra [] = [ 'key' => 'alpha_t2_heading_font_size', 'value'   => [ "required", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t2_heading_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_heading_background', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_icon_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_icon_background', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 't2-total-price-text', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 't2-total-price-color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 't2-price-color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        
        $extra [] = [ 'key' => 'alpha_t2_timer_limit', 'value' => [ "nullable","in:1" ] ];
        $extra [] = [ 'key' => 'alpha_t2_deal_heading', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t2_deal_span', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 't2_heading_font_family', 'value' => [ "required", "string" ] ];
        $extra [] = [ 'key' => 't2_heading_font_size', 'value'   => [ "required", "numeric" ] ];
        $extra [] = [ 'key' => 't2_time_duration', 'value'   => [ "required_if:alpha_t2_timer_limit,1", "numeric" ] ];
        $extra [] = [ 'key' => 't2_timer_text', 'value'   => [ "required_if:alpha_t2_timer_limit,1", "string" ] ];
        $extra [] = [ 'key' => 't2_timer_text_font_family', 'value'   => [ "required_if:alpha_t2_timer_limit,1", "string" ] ];
        $extra [] = [ 'key' => 't2_timer_text_font_size', 'value'   => [ "required_if:alpha_t2_timer_limit,1", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t2_deal_heading_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_deal_span_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 't2_timer_heading_color', 'value'   => [ "required_if:alpha_t2_timer_limit,1", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 't2_timer_color', 'value'   => [ "required_if:alpha_t2_timer_limit,1", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_atc_btn_text', 'value'   => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t2_atc_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_atc_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_price_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_discount_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_discount_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_checkout_btn', 'value'   => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t2_no_thanks_btn', 'value'   => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t2_checkout_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_no_thanks_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_checkout_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_no_thanks_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_checkout_btn_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t2_no_thanks_btn_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        

        return $extra;
    }
    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * Define Rules for Template 3
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function template_3()
    {
        $extra [] = [ 'key' => 'alpha_t3_heading', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t3_heading_font_family', 'value' => [ "required", "string" ] ];
        $extra [] = [ 'key' => 'alpha_t3_heading_font_size', 'value'   => [ "required", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t3_heading_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_cross_icon_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_cross_icon_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_cart_item_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_cart_item_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_cart_item_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        
        
        $extra [] = [ 'key' => 'alpha_t3_timer', 'value' => [ "nullable","in:1" ] ];
        $extra [] = [ 'key' => 'alpha_t3_r_product_heading', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t3_r_product_heading_font_family', 'value' => [ "required", "string" ] ];
        $extra [] = [ 'key' => 'alpha_t3_r_product_heading_font_size', 'value'   => [ "required", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t3_timer_duration', 'value'   => [ "required_if:alpha_t3_timer,1", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t3_timer_heaading', 'value'   => [ "required_if:alpha_t3_timer,1", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t3_timer_heading_font_family', 'value' => [ "required", "string" ] ];
        $extra [] = [ 'key' => 'alpha_t3_timer_heading_font_size', 'value'   => [ "required", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t3_r_product_heading_color', 'value' => [ "required_if:alpha_t3_timer,1", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_timer_heading_color', 'value' => [ "required_if:alpha_t3_timer,1", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_timer_color', 'value' => [ "required_if:alpha_t3_timer,1", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_timer_bg_color', 'value' => [ "required_if:alpha_t3_timer,1", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        
        $extra [] = [ 'key' => 'alpha_t3_atc_btn', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t3_atc_btn_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_atc_btn_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_dicount_price_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_dicount_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_upsell_product_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];

        
        $extra [] = [ 'key' => 'alpha_t3_checkout_btn', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t3_no_thanks_btn', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t3_checkout_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_no_thanks_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_checkout_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_no_thanks_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_checkout_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t3_no_thanks_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];

        return $extra;
    }

    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * Define Rules for Template 4
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function template_4()
    {
        $extra [] = [ 'key' => 'alpha_t4_time_limit_toggler', 'value' => [ "nullable","in:1" ] ];
        $extra [] = [ 'key' => 'alpha_t4_time_duration', 'value'   => [ "required_if:alpha_t4_time_limit_toggler,1", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t4_timer_heading', 'value'   => [ "required_if:alpha_t4_time_limit_toggler,1", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t4_timer_heading_font_family', 'value'   => [ "required_if:alpha_t4_time_limit_toggler,1", "string" ] ];
        $extra [] = [ 'key' => 'alpha_t4_timer_heading_font_size', 'value'   => [ "required_if:alpha_t4_time_limit_toggler,1", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t4_timer_heading_color', 'value'   => [ "required_if:alpha_t4_time_limit_toggler,1", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_timer_color', 'value'   => [ "required_if:alpha_t4_time_limit_toggler,1", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_timer_bg_color', 'value'   => [ "required_if:alpha_t4_time_limit_toggler,1", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_cross_icon_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_cross_icon_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_cart_product_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_cart_product_icon_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_cart_product_price_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_cart_product_checkout_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_title_heading', 'value'   => [ "required", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t4_title_heading_font_family', 'value'   => [ "required", "string" ] ];
        $extra [] = [ 'key' => 'alpha_t4_title_heading_font_size', 'value'   => [ "required", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t4_title_heading_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_atc_btn', 'value'   => [ "required", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t4_atc_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_atc_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_price_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_discount_price_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_discount_price_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_checkout_btn', 'value'   => [ "required", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t4_no_thanks_btn', 'value'   => [ "required", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t4_checkout_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_no_thanks_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_checkout_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_no_thanks_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_checkout_btn_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t4_no_thanks_btn_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];

        return $extra;
    }
    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * Define Rules for Template 5-
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function template_5()
    {
        $extra [] = [ 'key' => 'alpha_t5_time_limit_toggler', 'value' => [ "nullable","in:1" ] ];
        $extra [] = [ 'key' => 'alpha_t5_time_duration', 'value'   => [ "required_if:alpha_t5_time_limit_toggler,1", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t5_timer_heading', 'value'   => [ "required_if:alpha_t5_time_limit_toggler,1", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t5_timer_heading_font_family', 'value'   => [ "required_if:alpha_t5_time_limit_toggler,1", "string" ] ];
        $extra [] = [ 'key' => 'alpha_t5_timer_heading_font_size', 'value'   => [ "required_if:alpha_t5_time_limit_toggler,1", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t5_time_heading_color', 'value'   => [ "required_if:alpha_t5_time_limit_toggler,1", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_timer_color', 'value'   => [ "required_if:alpha_t5_time_limit_toggler,1", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_timer_bg_color', 'value'   => [ "required_if:alpha_t5_time_limit_toggler,1", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_cross_icon_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_cart_product_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_cart_produt_price_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_atc_btn', 'value'   => [ "required", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t5_atc_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_atc_btn_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_atc_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_price_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_discount_price_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_discount_price_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_checkout_btn', 'value'   => [ "required", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t5_no_thanks_btn', 'value'   => [ "required", "string", "max:191" ] ];
        $extra [] = [ 'key' => 'alpha_t5_checkout_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_no_thanks_btn_bg_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_checkout_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_no_thanks_btn_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_checkout_btn_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t5_no_thanks_btn_border_color', 'value'   => [ "required", "string", 'regex:'.config('upsell.strings.colorRegex') ] ];

        return $extra;
    }
    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * Define Rules for Template 6
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function template_6()
    {
        $extra [] = [ 'key' => 'alpha_t6_top_heading', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t6_top_heading_font_family', 'value' => [ "required", "string" ] ];
        $extra [] = [ 'key' => 'alpha_t6_top_heading_font_size', 'value'   => [ "required", "numeric" ] ];
        $extra [] = [ 'key' => 'alpha_t6_top_heading_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_cross_icon_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];

        $extra [] = [ 'key' => 'alpha_t6_cross_icon_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_cart_product_title_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_cart_product_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_cart_product_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        
        $extra [] = [ 'key' => 'alpha_t6_product_heading', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t6_cart_btn', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t6_product_title_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_dicount_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_discount_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_atc_btn_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_btn_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_btn_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_checkout_btn', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_no_thanks_btn', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'alpha_t6_checkout_btn_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_no_thanks_btn_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_checkout_btn_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_no_thanks_btn_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_t6_checkout_btn_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'alpha_no_thanks_btn_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];

        return $extra;
    }
     
}