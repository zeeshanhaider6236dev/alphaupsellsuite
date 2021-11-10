@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');

.alpha_upsell_freq_freq_pre {
    @php
        if($upsell->setting['work_on_desktop'] == 1):
            $display = 'block';
        else:
            $display = 'none';
        endif;
    @endphp
    display: {{$display}};
    font-family: 'Roboto', sans-serif;
    padding:0px 0px 0px 10px;
    width: 100%;
	text-align: left;
	clear: both;
}
.alpha_upsell_freq_freq_pre h2 {
    text-align: {{ $upsell->setting['heading_align'] }}!important;
    font-size: {{ $upsell->setting['heading_font_size'] }}px!important;
    color: {{ $upsell->setting['heading_color'] }}!important;
	margin: 10px 0px 15px;
	font-weight: 400;
	font-family: {{ $upsell->setting['heading_font_family'] }}!important;
}
.alpha_upsell_freq_item {
	width: 95px;
    position:relative;
    display:inline-block;
	margin-right: 10px;
}
.alpha_upsell_freq_notify-badge {
    position: absolute;
    top: 10px;
    left: 26px;
    background: #f10000;
    text-align: center;
    color: white;
    padding: 1px 7px 3px;
    font-size: 14px;
    font-weight: 700;
	font-family: 'Roboto', sans-serif;
}
.alpha_upsell_freq_live_p img {
    width: 70%;
    margin: 10px 0px;
}
.alpha_upsell_freq_img_plus {
    font-size: 16px;
    font-weight: 700;
    margin-left: 15px;
	position: absolute;
    top: 35%;
}
.alpha_upsell_freq_live_total {
    margin-bottom: 10px !important;
    font-size: 14px;
    font-weight: 400;
    margin-top: 0px;
    font-family: 'Roboto', sans-serif;
    list-style: disc !important;
    padding: 0px !important;
    border: 0px !important;
	color: #000 !important;
}
.alpha_upsell_freq_l_t_s {
    color: {{ $upsell->setting['sale_price_color'] }};
    font-weight: 700;
    font-size: 14px;
    white-space: nowrap;
}
.alpha_upsell_freq_live_btn {
    background: {{ $upsell->setting['button_background_color'] }};
    border: 1px solid {{ $upsell->setting['button_border_color'] }};
    color: {{ $upsell->setting['button_text_color'] }};
    padding: 10px 20px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Roboto', sans-serif !important;
    font-style: normal;
	width: fit-content;
}
.alpha_upsell_freq_live_btn:focus {
    outline: none;
	background: #546ea9;
    border: 1px solid #546ea9;
}
.alpha_upsell_freq_live_btn:hover {
    background: #546ea9;
	color:white;
}
.alpha_upsell_freq_p_title {
    display: inline;
    margin-left: 5px;
    line-height: 2em;
    font-weight: 400;
    font-size: 14px;
    color: {{ $upsell->setting['product_title_color'] }}!important;
    font-family: 'Roboto', sans-serif;
}
ul.alpha_upsell_freq_live_ul {
    margin: 10px 0px 0px;
    padding: 0px 0px 0px 15px;
	display: block;
	clear: left;
	font-family: 'Roboto', sans-serif;
}
ul.alpha_upsell_freq_live_ul:first-child{
    font-weight:bold !important;
}
.alpha_upsell_freq_l_t_p {
    margin-left: 5px;
    white-space: nowrap;
    display: inline;
    color: {{ $upsell->setting['compare_price_color'] }};
    text-decoration: line-through;
    font-weight: 700;
    font-size: 14px;
}
.alpha_upsell_freq_input {
    display: inline-block;
    background:none !important;
    appearance: auto !important;
    width: auto;
    max-width: 220px;
    font-size: 14px;
    font-weight: normal;
    border: 1px solid #dadada;
    color: rgb(0, 0, 0);
    background-color: rgb(255, 255, 255);
    text-align: left;
    vertical-align: baseline;
    margin: 2px 2px 2px 5px;
    padding: 0px 25px 0px 5px;
    height: auto;
    min-height: 25px;
    max-height: 25px;
    line-height: 1.1em;
    background-image: url(//cdn.shopify.com/s/files/1/1307/1841/t/5/assets/ico-select.svg?v=2900367270910467858);
    background-repeat: no-repeat;
    background-position: right 5px center;
	font-family: 'Roboto', sans-serif;
}
.alpha_upsell_freq_input:focus{
	outline: none;
	border: 1px solid #dadada;
}
.alpha_upsell_freq_live_total a:hover{
	text-decoration: none;
}


{{-- Custom CSS --}}


.alpha_upsell_freq_live_btn:hover
{
    color:{{ $upsell->setting['button_hover_text_color'] }}!important;
    background:{{ $upsell->setting['button_hover_background_color'] }};
}

@media only screen and (max-width: 768px){
    .alpha_upsell_freq_freq_pre{
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
