<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');

    .top_head_post {
        height: auto;
        border-bottom: 1px solid #dadada;
    }

    .post_timer {
        display: flex;
        background: {{ $upsell->setting['thank_you_timer_text_bg_color'] }} !important;
        width: 40%;
        padding: 5px 5px;
    }
    .timer_titles{
        color: {{ $upsell->setting['thank_you_timer_color'] }} !important;
    }
    .post_timer p {
        color: {{ $upsell->setting['thank_you_timer_text_color'] }};
        margin: 0px !important;
        font-family: {{ $upsell->setting['timer_font_family'] }} !important;
        font-size: {{ $upsell->setting['timer_font_size'] }}px !important;
        font-weight: 700;
    }

    .post_timer input {
        width: 30%;
        background: none;
        border: none;
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        margin-left: 5px;
    }

    .post_timer input:focus {
        outline: none;
    }

    .top_head_post h3 {
        text-align: {{ $upsell->setting['heading_align'] }}!important;
        font-family: {{ $upsell->setting['heading_font_family'] }}!important;
        margin: 10px 0px 0px;
        font-size: {{ $upsell->setting['heading_font_size'] }}px!important;
        color: {{ $upsell->setting['heading_color'] }}!important;
        font-weight: 700;
    }

    .top_head_post p {
        margin: 2px 0px 15px;
        text-align: center;
        font-size: 14px;
    }

    /*******Product-slider*******/

    .slideshow-container {
        position: relative;
        display: block;
    }

    .mySlides {
        height: 380px;
        padding: 20px 30px;
        text-align: center;
    }

    .prev,
    .next {
        display:none;
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -30px;
        padding: 10px;
        color: {{ $upsell->setting['arrow_icon_color'] }}!important;
        background:{{ $upsell->setting['arrow_icon_background_color'] }};
        font-weight: bold;
        font-size: 10px;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    .next {
        position: absolute;
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /*.prev:hover,
    .next:hover {
        background-color: rgb(3 0 74);
        color: white !important;
    }*/

    .dot-container {
        text-align: center;
        padding: 20px;
        display: block;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    /* Add an italic font style to all quotes */
    q {
        font-style: italic;
    }

    /* Add a blue color to the author */
    .author {
        color: cornflowerblue;
    }

    .post {
        width: 100%;
    }

    .post_p {
        width: 50%;
        float: left;
        margin: auto;
        height: auto;
        text-align: center;
        margin-bottom: 15px;
    }

    .post_img img {
        width: 90%;
    }

    .post_detail h4 {
        color: {{ $upsell->setting['product_title_color'] }}!important;
        font-size: 13px;
        margin: 8px 0px;
        padding: 0px 5px;
    }

    .post_detail p {
        font-family: poppins;
        margin: 5px 0px;
        font-size: 12px;
        font-weight: 600;
        color: #1f1f1f;
    }

    .post_detail p span {
        background: {{ $upsell->setting['discount_background_color'] }}!important;
        color: {{ $upsell->setting['discount_text_color'] }}!important;
        font-size: 10px;
        padding: 2px;
    }

    .post_detail select {
        border: 1px solid #818584;
        padding: 5px;
        font-size: 11px;
        width: 80%;
        border-radius: 50px;
        margin: 5px 0px;
    }

    .post_detail select:focus {
        outline: none;
    }

    .post_detail input {
        border: 1px solid #03004a;
        padding: 7px;
        background: {{ $upsell->setting['button_background_color'] }}!important;
        width: 80%;
        border-radius: 50px;
        margin-top: 5px;
        color: {{ $upsell->setting['button_text_color'] }}!important;
        font-size: 13px;
    }
    

    {{-- custom CSC --}}
    .post_detail input:hover
    {
        color: {{ $upsell->setting['button_hover_text_color'] }}!important;
        background: {{ $upsell->setting['button_hover_background_color'] }}!important;
    }
    .alpha_ppu_display
    {
        display:none;
    }
    .alpha_ppu_active
    {
        display:block!important;
    }
    .alpha_ppu_container
    {
        padding-top:10px!important;
    }
    .post_timer span {
        margin-top:2px;
        width: 30%;
        background: none;
        border: none;
        color: #fff;
        font-family: {{ $upsell->setting['timer_font_family'] }} !important;
        font-size: {{ $upsell->setting['timer_font_size'] }}px !important;
        font-weight: 700;
        margin-left: 5px;
    }
    .post_img img {
        height:200px!important;
    }
    .design_inpage_post
    {
        @php
            if($upsell->setting['work_on_desktop'] == 1):
                $display = 'block';
            else:
                $display = 'none';
            endif;
        @endphp
        display: {{$display}};
        background:{{ $upsell->setting['my_upsell_background_color'] }} !important;
        padding: 0px;
        box-shadow: 0 0 0 1px rgba(63, 63, 68, .05), 0 1px 5px 0 rgb(183 183 183);
        font-family: 'Roboto', sans-serif;
    }
    #product-sale-price
    {
        background:none!important;
        color:{{ $upsell->setting['sale_price_color'] }} !important;
        font-size:12px;
    }
    @media only screen and (max-width: 768px){
        .alpha_ppu_container{
            @php
                if($upsell->setting['work_on_mobile'] == 1):
                    $display = 'block';
                else:
                    $display = 'none';
                endif;
            @endphp
            display: {{$display}};
        }
        .post_timer
        {
            display: flex;
            background: #ab0000;
            width: 50%;
            padding: 5px 5px;
        }
    }

    
</style>