@php
    $positions = ['alpha_upsell_sale_bottom_left','alpha_upsell_sale_bottom_right','alpha_upsell_sale_top_left','alpha_upsell_sale_top_right'];
    foreach (config('upsell.strings.pop_up_position') as $key =>  $position):
        if($position == $upsell->setting['popup_position']):
            $alignmentClass = $positions[$key];
            break;
        endif;
    endforeach;

    $animations = ['bounce-left','bounce-right','kenburns-top','shake-bottom','fade-in'];

    if(($upsell->setting['popup_position']) == 'Bottom Left' && $upsell->setting['animation_type'] == 'Bounce'):
        $animation_class = $animations[0];
    elseif(($upsell->setting['popup_position']) == 'Bottom Right' && $upsell->setting['animation_type'] == 'Bounce'):
        $animation_class = $animations[1];
    elseif(($upsell->setting['popup_position']) == 'Top Left' && $upsell->setting['animation_type'] == 'Bounce'):
        $animation_class = $animations[0];
    elseif(($upsell->setting['popup_position']) == 'Top Right' && $upsell->setting['animation_type'] == 'Bounce'):
        $animation_class = $animations[1];
    elseif(($upsell->setting['animation_type']) ==  'Fade In'):
        $animation_class = $animations[4];
    elseif(($upsell->setting['animation_type']) ==  'Zoom'):
        $animation_class = $animations[2];
    elseif(($upsell->setting['animation_type']) ==  'Shake'):
        $animation_class = $animations[3];
    endif;

@endphp
@foreach ($orderProducts as $product)
        @php
            $customer_name = explode(' ', $product['customer_name']);
            $size = sizeof($customer_name)-1;
            $last_name = $customer_name[$size];
        @endphp
        <div class="alpha_upsell_sale_popup_n_1 alpha_upsell_sale_popup_bg {{ $alignmentClass }} {{ $upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[1] ?  'alpha_upsell_sale_popup_n_2' : '' }} {{ $animation_class }}">
            <a href="{{ 'https://'.$shopName.'/products/'.$product['handle'] }}" style="display:inline-flex">
                <div class="{{ $upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[0] ?  'alpha_upsell_sale_popup_n1_img' : 'alpha_upsell_sale_popup_n2_img' }}">
                    <img src="{{ $product['image'] }}" alt="">
                </div>
                <div class="alpha_upsell_sale_popup_n1_heading">
                    <h5>{{  $last_name }} From {{ $product['country_name'] }}, purchased</h5>
                    <h3>{{  Illuminate\Support\Str::limit($product['title'],20) }}</h3>
                    <p>{{ $product['created_ago'] }}</p>
                </div>
            </a>
            <div class="{{ $upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[1] ?  'alpha_upsell_sale_popup_n2_close' : 'alpha_upsell_sale_popup_n1_close' }}">
                <button class="alpha_upsell_sale_popup_n1_btn remove_sale_notification_button">&times;</button>
            </div>
        </div>
@endforeach