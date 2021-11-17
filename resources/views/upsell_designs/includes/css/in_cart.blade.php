 @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');
.alpha_upsell_in_page_custom {
    @php
        if($upsell->setting['work_on_desktop'] == 1):
            $display = 'block';
        else:
            $display = 'none';
        endif;
    @endphp
    display: {{$display}};
}


.alpha_upsell_in_page_design_inpage {
    width: 100%;
    font-family: 'Roboto', sans-serif;
}
.alpha_upsell_in_page_p_upsell {
    height: auto;
    padding: 15px 30px 15px 9px;
    width: fit-content;
    background: {{$upsell->setting['upsell_background_color']}} !important;
    margin: 10px auto;
    box-shadow: none;
    position: relative;
    z-index: 9;
    line-height: normal !important;
}
.alpha_upsell_in_page_timer_title p {

    font-weight: 500;
    line-height: normal;
    margin: 0px !important;
    letter-spacing: normal;
    text-transform: none;
    padding: 0px;
    border: 0px;
    color: {{$upsell->setting['heading_color']}} !important;
    font-size: {{$upsell->setting['heading_font_size']}}px !important;
    font-family: {{$upsell->setting['heading_font_family']}} !important;
    text-align:{{$upsell->setting['heading_align']}} !important;
}
.alpha_upsell_in_page_timer {
    width: fit-content;
    padding: 10px;
    margin: auto;
}
.alpha_upsell_in_page_timer input {
    border: none !important;
    background: {{ $upsell->setting['timer_text_bg_color'] }} !important;
    width: auto;
    max-width: 35px !important;
    text-align: center;
    font-weight: 700 !important;
    font-style: normal !important;
    margin: 0px 2px !important;
    display: inline !important;
    padding: 5px !important;
    border-radius: 3px !important;
    line-height: normal !important;
    letter-spacing: normal !important;
    text-indent: 0px !important;
    height: auto !important;
    color: {{$upsell->setting['timer_text_color']}} !important;
    font-size: {{$upsell->setting['timer_font_size']}}px !important;
    font-family: {{$upsell->setting['timer_font_family']}} !important;
}
.alpha_upsell_in_page_timer input:focus {
    outline: none;
}
.alpha_upsell_in_page_in_page_product{
    width: 100%;
    display: flex;
    height: auto;
}
.alpha_upsell_in_page_upsell_img {
    width: 80px;
    height:80px;
    padding: 0px 10px 0px 0px;
}
.alpha_upsell_in_page_upsell_img img {
    width: 100% !important;
    height: auto !important;
}
.alpha_upsell_in_page_upsell_title {
    width: fit-content;
    text-align: left !important;
}
.alpha_upsell_in_page_upsell_title h4 {
    font-size: 14px;
    color: {{$upsell->setting['product_title_color']}} !important;
    margin-bottom: 5px;
    margin-top: 0px;
    font-weight: 400;
    letter-spacing: 0;
    font-family: 'Roboto', sans-serif !important;
    text-transform: capitalize;
    line-height: normal;
    padding: 0px !important;
    border: 0px !important;
}

.alpha_upsell_in_page_upsell_title p span[id=price] {
    color: {{$upsell->setting['sale_price_color']}} !important;
}

.alpha_upsell_in_page_upsell_title p span[id=product_compare_price] {
    text-decoration: line-through;
    color: {{$upsell->setting['compare_price_color']}} !important;
}
.alpha_upsell_in_page_upsell_title select {
    appearance: none !important;
    width: 100% !important;
    max-width: 220px !important;
    font-size: 14px !important;
    font-weight: normal !important;
    border: 1px solid #dadada !important;
    color: #555555 !important;
    background-color: rgb(255, 255, 255) !important;
    text-align: left !important;
    vertical-align: baseline !important;
    margin: 0px !important;
    padding: 0px 25px 0px 5px !important;
    height: auto !important;
    min-height: 25px !important;
    max-height: 25px !important;
    line-height: 1.1em !important;
    background-image: url(//cdn.shopify.com/s/files/1/1307/1841/t/5/assets/ico-select.svg?v=2900367270910467858);
    background-repeat: no-repeat !important;
    background-position: right 5px center !important;
    font-family: 'Roboto', sans-serif !important;
    opacity: 1 !important;
    position: unset !important;
    letter-spacing: normal !important;
    border-radius: 0px !important;
}
.alpha_upsell_in_page_upsell_title select:focus{
    outline: none;
}
.alpha_upsell_in_page_upsell_title p {
    margin: 5px 0px 0px !important;
    font-size: 14px;
    font-weight: 500;
    color: #e21414 !important;
    font-family: 'Roboto', sans-serif !important;
    letter-spacing: normal;
    display: inline-block;
    line-height: normal;
    padding: 0px;
}
.alpha_upsell_in_page_upsell_title p span {
    text-decoration: line-through !important;
    color: #251c6b !important;
    margin-right: 10px !important;
}
.alpha_upsell_in_page_upsell_btn {
    background: {{$upsell->setting['button_background_color'] }} !important;
    border: 1px solid {{$upsell->setting['button_border_color'] }} !important;
    color: {{$upsell->setting['button_text_color']}} !important;
    font-size: 14px !important;
    padding: 5px 10px !important;
    cursor: pointer;
    font-family: 'Roboto', sans-serif !important;
    font-style: normal !important;
    font-weight: 500 !important;
    width: fit-content !important;
    border-radius: 0px !important;
    box-shadow: none !important;
    line-height: normal !important;
    letter-spacing: normal !important;
    text-transform: capitalize !important;
    min-width: fit-content !important;
    margin: 5px 0px 0px !important;
    height: auto !important;
    float: none !important;
}

.alpha_upsell_in_page_upsell_btn:hover{
    background: {{$upsell->setting['button_hover_background_color']}} !important;
    color: {{$upsell->setting['button_hover_text_color']}} !important;

}
.alpha_upsell_in_page_upsell_btn:focus {
    outline: none;
}
.alpha_upsell_in_page_upsell_title .jumpstart-selector .arrow {
    display: none !important;
}
.alpha_upsell_in_page_upsell_title .select-wrapper {
    position: relative;
    height: auto;
    line-height: normal;
    border: 0px;
    color: transparent;
    background-color: transparent;
    padding: 0px;
    margin: 0;
    font-size: 0px;
    text-align: inherit;
    cursor: pointer;
    z-index: 0;
}
.alpha_upsell_in_page_upsell_title .select-wrapper .selected-text {
    white-space: unset;
    overflow: hidden;
    text-overflow: unset;
    padding: 0px;
    height: auto;
    line-height: unset;
    width: unset;
    z-index: 0;
}
.alpha_upsell_in_page_upsell_title .select-wrapper:after {
    display: none;
}
.alpha_upsell_in_page_upsell_title .select-hidden {
    display: inline !important;
    visibility: visible !important;
}
.alpha_upsell_in_page_upsell_title .select-styled {
    display: none;
}

@media only screen and (max-width: 768px){
    .alpha_upsell_in_page_custom {
        @php
            if($upsell->setting['work_on_mobile'] == 1):
                $display = 'block';
            else:
                $display = 'none';
            endif;
        @endphp
        display: {{$display}};
    }

}
