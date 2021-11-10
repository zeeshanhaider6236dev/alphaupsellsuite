<div class="alpha_upsell_volume_live_p alpha_upsell_volume_pre_w">
    <h2>Bulk Buy Offers Unlocked!!</h2>   
    @foreach ($volume_discounts as $key => $vol)
        
        <div class="alpha_upsell_volume_volum_bg alpha_upsell_volume_volume_best" data-quantity="{{$vol['quantity'] }}" data-variant-id="{{$product_variant_id}}">
            <div class="alpha_upsell_volume_volume_img">
                <img src="{{$product_img}}" alt="bag">
            </div>
            <div class="alpha_upsell_volume_volume_head">
                <h3>{{ $vol['quantity'] }} Quantities</h3>
            </div>
            @if($vol['discount_type'] == 'USD Off')
                <div class="alpha_upsell_volume_volume_dis">
                    <h5>$ {{ $vol['discount'] }} Off</h5>
                </div>
            @else
                <div class="alpha_upsell_volume_volume_dis">
                    <h5>{{ $vol['discount'] . $vol['discount_type'] }}</h5>
                </div>
            @endif
            <div class="alpha_upsell_volume_disc_price">
                @if($vol['discount_type'] == 'USD Off')
                    @php    
                        $discount_prices = $product_price * $vol['quantity']-$vol['discount'];
                    @endphp    
                    <h2>{{ $discount_prices }}$</h2>
                @elseif($vol['discount_type'] == '% Off')
                    @php
                        $discount_value = $vol['discount']/100*($product_price * $vol['quantity']);
                        $discount_prices = ($product_price * $vol['quantity']) - $discount_value;
                    @endphp
                    <h2>{{ $discount_prices }}$</h2>
                @else
                    @php
                        $discount_prices = $product_price * $vol['quantity'];
                    @endphp
                    <h2>{{ $discount_prices }}$</h2>
                @endif
                <p>{{ $product_price * $vol['quantity'] }}$</p>
            
            </div>
        </div>
    @endforeach 
   
</div>

