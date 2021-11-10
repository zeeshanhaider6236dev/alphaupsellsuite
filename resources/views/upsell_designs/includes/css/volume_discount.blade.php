@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');

.alpha_upsell_volume_pre_w {
    width: 470px;
    box-shadow: 0 0 0 1px rgb(63 63 68 / 5%), 0 1px 5px 0 rgb(183 183 183);
    margin-top: 20px;
}
.alpha_upsell_volume_custom {
    @php
        if($upsell->setting['work_on_desktop'] == 1):
            $display = 'block';
        else:
            $display = 'none';
        endif;
    @endphp
    display: {{$display}};

}
.alpha_upsell_volume_live_p {
    background: {{ $upsell->setting['container_background_color'] }};
    box-shadow:none !important;
    padding: 0px 15px;
    display: inline-block;
	font-family: 'Roboto', sans-serif;

}
.alpha_upsell_volume_live_p h2 {
    text-align: {{ $upsell->setting['heading_align'] }};
    font-size: {{ $upsell->setting['heading_font_size'] }}px;
    color: {{ $upsell->setting['heading_color'] }};
    margin: 10px 0px;
    font-weight: 400;
    font-family: {{ $upsell->setting['heading_font_family'] }};
    text-transform: capitalize;
    letter-spacing: normal;
}
.alpha_upsell_volume_volum_bg {
    height: auto;
    width: fit-content !important;
    box-shadow: 0 0 0 1px rgb(63 63 68 / 5%), 0 1px 5px 0 rgb(183 183 183);
    padding: 10px;
    border-radius: 5px;
    margin: 15px 0px;
    display: flex;
    font-family: 'Roboto', sans-serif;
}
.alpha_upsell_volume_volume_img {
    width: 15%;
}
.alpha_upsell_volume_volume_img img {
    width: 100%;
    border-radius: 5px;
    margin: 0px;
}
.alpha_upsell_volume_volume_head {
    width: 40%;
    padding: 15px 10px;
}
.alpha_upsell_volume_volume_head h3 {
    font-size: 12px;
    margin: 0px;
    font-family: 'Roboto', sans-serif;
    letter-spacing: normal;
    text-transform: capitalize;
    color: {{ $upsell->setting['quantity_color'] }};
}
.alpha_upsell_volume_volume_head h4 {
    font-size: 14px;
    margin: 3px 0px 0px;
    font-weight: 700;
    color: {{ $upsell->setting['best_deal_color'] }};
    font-family: 'Roboto', sans-serif;
    letter-spacing: normal;
    text-transform: capitalize;
}
.alpha_upsell_volume_volume_dis {
    padding: 15px 0px;
    width: 20%;
}
.alpha_upsell_volume_volume_dis h5 {
    background: {{ $upsell->setting['discount_badge_background'] }};
    color: {{ $upsell->setting['discount_badge_text_color'] }};
    font-size: 14px;
    width: 80%;
    padding: 2px;
    border-radius: 3px;
    text-align: center;
    margin: 0px;
    letter-spacing: normal;
    font-family: 'Roboto', sans-serif !important;
    text-transform: capitalize;
}
.alpha_upsell_volume_disc_price {
    padding: 15px 10px;
    width: 25%;
    text-align: right;
}
.alpha_upsell_volume_disc_price h2 {
    text-align: right;
    margin: 0px;
    font-size: 12px;
    color: {{ $upsell->setting['discount_total_price_color'] }};
    font-weight: 700;
}
.alpha_upsell_volume_disc_price p {
    color: {{ $upsell->setting['original_total_price_color'] }};
    margin: 0px;
    font-size: 14px;
    text-decoration: line-through;
    font-family: 'Roboto', sans-serif;
    letter-spacing: normal;
}
.alpha_upsell_volume_volume_best {
    background: {{ $upsell->setting['background_color'] }};
}
.alpha_upsell_volume_volum_bg:hover {
    background: {{ $upsell->setting['hover_background_color'] }};
    cursor: pointer;
}


@media only screen and (max-width: 768px){
.alpha_upsell_volume_custom {
    @php
        if($upsell->setting['work_on_mobile'] == 1):
            $display = 'block';
        else:
            $display = 'none';
        endif;
    @endphp
    display: {{$display}};

}
.alpha_upsell_volume_pre_w {
    width: 95%;
    padding: 20px 5px;
}
.alpha_upsell_volume_volum_bg {
    padding: 10px 5px;
}
.alpha_upsell_volume_volume_head h3 {
    text-transform: capitalize;
    letter-spacing: normal;
}
.alpha_upsell_volume_volume_img {
    width: 20%;
}
.alpha_upsell_volume_volume_head {
    width: 35%;
    padding: 5px;
}
.alpha_upsell_volume_volume_dis {
    padding: 5px;
    width: 30%;
}
.alpha_upsell_volume_disc_price {
    padding: 5px 10px;
    width: 25%;
    text-align: right;
}
.alpha_upsell_volume_volume_dis h5 {
    letter-spacing: normal;
}

}

