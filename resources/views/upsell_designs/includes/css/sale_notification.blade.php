    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');

    .alpha_upsell_sale_popup_bg{
	 background: {{ $upsell->setting['background_color'] }};
    }
.alpha_upsell_sale_popup_n_1 {
    z-index:+999999 !important;
    height: auto;
    box-shadow: 0 0 0 1px rgb(63 63 68 / 5%), 0 1px 5px 0 rgb(183 183 183);
    padding: 10px;
    margin: 15px 10px;
    width: 360px;
    display: flex;
    font-family: 'Roboto', sans-serif;
	position: relative; 
    display:none;
}
.alpha_upsell_sale_popup_n1_img{
	width: 20%;
	margin-right: 10px;
}
.alpha_upsell_sale_popup_n1_img img{
	width: 100%;
}
.alpha_upsell_sale_popup_n1_heading h5 {
    font-size: {{ $upsell->setting['text_font_size']."px" }} !important;
    font-weight: {{ $upsell->setting['text_weight'] }} !important;
    color: {{ $upsell->setting['text_color'] }}!important;
    margin: 5px 0px;
    line-height: 1.4;
    font-family: 'Roboto', sans-serif !important;
    letter-spacing: 0px !important;
    text-transform: capitalize !important;
}
.alpha_upsell_sale_popup_n1_heading h3 {
    font-size: {{ $upsell->setting['product_title_font_size']."px" }} !important;
    font-weight: {{ $upsell->setting['product_title_weight'] }} !important;
    margin: 0;
    color:{{ $upsell->setting['product_title_color'] }};
    margin-bottom: 5px;
    line-height: 1.4;
    font-family: 'Roboto', sans-serif !important;
    letter-spacing: 0px !important;
    text-transform: capitalize !important;
}
.alpha_upsell_sale_popup_n1_heading p{
	color: {{ $upsell->setting['timer_color'] }};
    font-size: 13px;
    line-height: 1.4;
    margin: 0px;
	font-weight: 300;
}
/*.alpha_upsell_sale_popup_n1_close{
    position: absolute;
    top: 5px;
    right: 5px;
}*/
.alpha_upsell_sale_popup_n1_btn {
    border-radius: 50px !important;
    background-color: {{ $upsell->setting['cross_icon_background_color'] }} !important;
    width: 18px !important;
    height: 18px !important;
    min-width:18px !important;
    min-height:18px !important;
    border: none !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0px !important;
    color: {{ $upsell->setting['cross_icon_color'] }} !important;
    font-size: 16px !important;
    cursor: pointer !important;
    font-family: 'Roboto', sans-serif !important;
}
.alpha_upsell_sale_popup_n1_btn:focus{
	outline: none;
}

.alpha_upsell_sale_popup_n_2 {
    border-radius: 50px;
}
.alpha_upsell_sale_popup_n2_img {
    width: 20%;
    margin-right: 10px;
}
.alpha_upsell_sale_popup_n2_img img {
    width: 100%;
    border-radius: 50%;
    min-height: 100%!important;
    height: 76px !important;
}
.alpha_upsell_sale_popup_n2_close {
    position: relative;
    top: 40px;
    right: 10px;
}
.alpha_upsell_sale_top_left{
	position: fixed;
    top: 0;
    z-index: 9;
}
.alpha_upsell_sale_top_right {
    position: fixed;
    top: 0;
    right: 0;
    z-index: 9;
}
.alpha_upsell_sale_bottom_left {
    position: fixed;
    bottom: 0;
}
.alpha_upsell_sale_bottom_right{
	position: fixed;
	right: 0;
	bottom: 0;
}
.alpha_upsell_sale_notification_active{
    display:flex;
}
.alpha_anchor_tag
{
    text-decoration: none !important;
}

{{-- Custom CSS  --}}

@if(($upsell->setting['popup_position']) == config('upsell.strings.pop_up_position')[0] && $upsell->setting['animation_type'] == config('upsell.strings.animation')[1])
    
    .bounce-left{-webkit-animation:bounce-left .8s both;animation:bounce-left .8s both}
    @-webkit-keyframes bounce-left{0%{-webkit-transform:translateX(-48px);transform:translateX(-48px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:1}24%{opacity:1}40%{-webkit-transform:translateX(-26px);transform:translateX(-26px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}65%{-webkit-transform:translateX(-13px);transform:translateX(-13px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}82%{-webkit-transform:translateX(-6.5px);transform:translateX(-6.5px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}93%{-webkit-transform:translateX(-4px);transform:translateX(-4px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}25%,55%,75%,87%,98%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}100%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;opacity:1}}@keyframes bounce-left{0%{-webkit-transform:translateX(-48px);transform:translateX(-48px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:1}24%{opacity:1}40%{-webkit-transform:translateX(-26px);transform:translateX(-26px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}65%{-webkit-transform:translateX(-13px);transform:translateX(-13px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}82%{-webkit-transform:translateX(-6.5px);transform:translateX(-6.5px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}93%{-webkit-transform:translateX(-4px);transform:translateX(-4px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}25%,55%,75%,87%,98%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}100%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;opacity:1}}

@elseif(($upsell->setting['popup_position']) == config('upsell.strings.pop_up_position')[1] && $upsell->setting['animation_type'] == config('upsell.strings.animation')[1])

    .bounce-right{-webkit-animation:bounce-right .8s both;animation:bounce-right .8s both}
    @-webkit-keyframes bounce-right{0%{-webkit-transform:translateX(48px);transform:translateX(48px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:1}24%{opacity:1}40%{-webkit-transform:translateX(26px);transform:translateX(26px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}65%{-webkit-transform:translateX(13px);transform:translateX(13px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}82%{-webkit-transform:translateX(6.5px);transform:translateX(6.5px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}93%{-webkit-transform:translateX(4px);transform:translateX(4px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}25%,55%,75%,87%,98%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}100%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;opacity:1}}@keyframes bounce-right{0%{-webkit-transform:translateX(48px);transform:translateX(48px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:1}24%{opacity:1}40%{-webkit-transform:translateX(26px);transform:translateX(26px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}65%{-webkit-transform:translateX(13px);transform:translateX(13px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}82%{-webkit-transform:translateX(6.5px);transform:translateX(6.5px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}93%{-webkit-transform:translateX(4px);transform:translateX(4px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}25%,55%,75%,87%,98%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}100%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;opacity:1}}

@elseif(($upsell->setting['popup_position']) == config('upsell.strings.pop_up_position')[2] && $upsell->setting['animation_type'] == config('upsell.strings.animation')[1] )

    .bounce-left{-webkit-animation:bounce-left .8s both;animation:bounce-left .8s both}
    @-webkit-keyframes bounce-left{0%{-webkit-transform:translateX(-48px);transform:translateX(-48px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:1}24%{opacity:1}40%{-webkit-transform:translateX(-26px);transform:translateX(-26px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}65%{-webkit-transform:translateX(-13px);transform:translateX(-13px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}82%{-webkit-transform:translateX(-6.5px);transform:translateX(-6.5px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}93%{-webkit-transform:translateX(-4px);transform:translateX(-4px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}25%,55%,75%,87%,98%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}100%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;opacity:1}}@keyframes bounce-left{0%{-webkit-transform:translateX(-48px);transform:translateX(-48px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:1}24%{opacity:1}40%{-webkit-transform:translateX(-26px);transform:translateX(-26px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}65%{-webkit-transform:translateX(-13px);transform:translateX(-13px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}82%{-webkit-transform:translateX(-6.5px);transform:translateX(-6.5px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}93%{-webkit-transform:translateX(-4px);transform:translateX(-4px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}25%,55%,75%,87%,98%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}100%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;opacity:1}}

@elseif(($upsell->setting['popup_position']) == config('upsell.strings.pop_up_position')[3] && $upsell->setting['animation_type'] == config('upsell.strings.animation')[1])

    .bounce-right{-webkit-animation:bounce-right .8s both;animation:bounce-right .8s both}
    @-webkit-keyframes bounce-right{0%{-webkit-transform:translateX(48px);transform:translateX(48px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:1}24%{opacity:1}40%{-webkit-transform:translateX(26px);transform:translateX(26px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}65%{-webkit-transform:translateX(13px);transform:translateX(13px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}82%{-webkit-transform:translateX(6.5px);transform:translateX(6.5px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}93%{-webkit-transform:translateX(4px);transform:translateX(4px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}25%,55%,75%,87%,98%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}100%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;opacity:1}}@keyframes bounce-right{0%{-webkit-transform:translateX(48px);transform:translateX(48px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in;opacity:1}24%{opacity:1}40%{-webkit-transform:translateX(26px);transform:translateX(26px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}65%{-webkit-transform:translateX(13px);transform:translateX(13px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}82%{-webkit-transform:translateX(6.5px);transform:translateX(6.5px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}93%{-webkit-transform:translateX(4px);transform:translateX(4px);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}25%,55%,75%,87%,98%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}100%{-webkit-transform:translateX(0);transform:translateX(0);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;opacity:1}}

@elseif( $upsell->setting['animation_type'] ==  config('upsell.strings.animation')[0])

    .fade-in{-webkit-animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both;animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both}
    @-webkit-keyframes fade-in{0%{opacity:0}100%{opacity:1}}@keyframes fade-in{0%{opacity:0}100%{opacity:1}}

@elseif( $upsell->setting['animation_type'] ==  config('upsell.strings.animation')[2])

    
    .kenburns-top{-webkit-animation:kenburns-top 5s ease-out both;animation:kenburns-top 5s ease-out both}
    @-webkit-keyframes kenburns-top{0%{-webkit-transform:scale(1) translateY(0);transform:scale(1) translateY(0);-webkit-transform-origin:50% 16%;transform-origin:50% 16%}100%{-webkit-transform:scale(1.25) translateY(-15px);transform:scale(1.25) translateY(-15px);-webkit-transform-origin:top;transform-origin:top}}@keyframes kenburns-top{0%{-webkit-transform:scale(1) translateY(0);transform:scale(1) translateY(0);-webkit-transform-origin:50% 16%;transform-origin:50% 16%}100%{-webkit-transform:scale(1.25) translateY(-15px);transform:scale(1.25) translateY(-15px);-webkit-transform-origin:top;transform-origin:top}}

@else

    
    .shake-bottom{-webkit-animation:shake-bottom .8s cubic-bezier(.455,.03,.515,.955) both;animation:shake-bottom .8s cubic-bezier(.455,.03,.515,.955) both}
    @-webkit-keyframes shake-bottom{0%,100%{-webkit-transform:rotate(0deg);transform:rotate(0deg);-webkit-transform-origin:50% 100%;transform-origin:50% 100%}10%{-webkit-transform:rotate(2deg);transform:rotate(2deg)}20%,40%,60%{-webkit-transform:rotate(-4deg);transform:rotate(-4deg)}30%,50%,70%{-webkit-transform:rotate(4deg);transform:rotate(4deg)}80%{-webkit-transform:rotate(-2deg);transform:rotate(-2deg)}90%{-webkit-transform:rotate(2deg);transform:rotate(2deg)}}@keyframes shake-bottom{0%,100%{-webkit-transform:rotate(0deg);transform:rotate(0deg);-webkit-transform-origin:50% 100%;transform-origin:50% 100%}10%{-webkit-transform:rotate(2deg);transform:rotate(2deg)}20%,40%,60%{-webkit-transform:rotate(-4deg);transform:rotate(-4deg)}30%,50%,70%{-webkit-transform:rotate(4deg);transform:rotate(4deg)}80%{-webkit-transform:rotate(-2deg);transform:rotate(-2deg)}90%{-webkit-transform:rotate(2deg);transform:rotate(2deg)}}

@endif

.alpha_SN_timer
{
    padding: 0px !important;
}
.alpha_user_info
{
    padding: 0px !important;
}
.alpha_product_title
{
    padding: 0px !important;
    line-height: 22px !important;
}
@if($upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[0])
    .alpha_upsell_sale_popup_n1_btn
    {
        position: absolute;
        top: -12px;
        right: 0px;
        margin-top: 15px;
        margin-right: 4px;
    }
@elseif($upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[1])
    /*.alpha_upsell_sale_popup_n1_btn
    {
        position: absolute;
        top: -16px;
        right: -16px;
        margin-top: 15px;
        margin-right: 4px;
    }*/
    .alpha_upsell_sale_popup_n2_close 
    {
        position: relative;
        top: 30px;
        right: 0px;
    }
@elseif($upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[2])
    .alpha_upsell_sale_popup_n1_btn
    {
        position: absolute;
        top: -12px;
        right: -2px;
        margin-top: 15px;
        margin-right: 4px;
    }
@endif

@media only screen and (max-width: 668px){
    .alpha_upsell_sale_popup_n_1{
        @php
            if($upsell->setting['hide_on_mobile'] == 0):
                $display = 'block';
            else:
                $display = 'none';
            endif;
        @endphp
        display: {{$display}};
    }

}




