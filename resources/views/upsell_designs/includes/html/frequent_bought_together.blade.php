<div class="alpha_upsell_freq_live_p alpha_upsell_freq_freq_pre">
    <h2>Frequently Bought Together</h2>
    @foreach ($products as $product)
    <div class="alpha_upsell_freq_item">
        @if(!$loop->first)
            <span class="alpha_upsell_freq_notify-badge">Sale</span>
        @endif
        <img src="{{ $product['featuredImage']['src'] }}" alt="cream">
        @if(!$loop->last)
            <span class="alpha_upsell_freq_img_plus">+</span>
        @endif
    </div>
    @endforeach
    <p class="alpha_upsell_freq_live_total">Total Price: 
        <span class="alpha_upsell_freq_l_t_s">$55.00</span> 
        <span class="alpha_upsell_freq_l_t_p">$77.00</span>
    </p> 
	<input type="button" class="alpha_upsell_freq_live_btn" value="Add Selected To Cart"> 
    <ul class="alpha_upsell_freq_live_ul">
        <li class="alpha_upsell_freq_live_total">This item:
            <span class="alpha_upsell_freq_p_title"> Sed ut perspiciatis unde omnis iste natus error sit 
                <select class="alpha_upsell_freq_input">
                    <option>700ml</option>
                    <option>500ml</option>
                </select>
            </span> 
            <span class="alpha_upsell_freq_l_t_s">$27.00</span>
            <span class="alpha_upsell_freq_l_t_p">$35.00</span>
        </li>
        <li class="alpha_upsell_freq_live_total">
            <span class="alpha_upsell_freq_p_title">Sed ut perspiciatis unde omnis iste natus error sit  
                <select class="alpha_upsell_freq_input">
                    <option>300ml</option>
                    <option>500ml</option>
                </select>	
            </span> 
            <span class="alpha_upsell_freq_l_t_s">$9.00</span> 
            <span class="alpha_upsell_freq_l_t_p">$17.00</span>
        </li>
        <li class="alpha_upsell_freq_live_total">
            <span class="alpha_upsell_freq_p_title">Sed ut perspiciatis unde omnis iste natus error sit 
                <select class="alpha_upsell_freq_input">
                    <option>250ml</option>
                    <option>500ml</option>
                </select>
            </span>
            <span class="alpha_upsell_freq_l_t_s">$19.00</span> 
            <span class="alpha_upsell_freq_l_t_p">$25.00</span>
        </li>
    </ul> 
</div>
