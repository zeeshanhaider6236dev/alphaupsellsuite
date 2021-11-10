(function(){
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


    var upsell = {!! $upsell !!}
    var app_URL = "{{ env('APP_URL') }}"
    /**
     * 
     * ========================================
     * Below the add to cart button selctors
     * ========================================
     * 
     */
    var alpha_upsell_SN_add_to_cart_selectors    = ['button[class~=enj-add-to-cart-btn]','button[name="add"]','input[name="add"]','button[class~=add-to-cart-btn]','button[class~=product-form__cart-submit--small]','#button-cart','button[class~=btn-addtocart]','#AddToCartText','#AddToCartText6643010142366','input[class~=atc]','input[class~=add-to-cart-button]','#shopify_add_to_cart','a[class~=addtocart]','#AddToCart','#AddToCart-product-template','button[class~="btn--add-to-cart"]','button[class~="product-form__add-button"]','button[class~="ProductForm__AddToCart "]','button[data-action~="add-to-cart"]','#AddToCart'];


    var sale_notification_HTML = '@foreach ($orderProducts as $product)@php $customer_name = explode(' ', $product['customer_name']);
    $size = sizeof($customer_name)-1;$last_name = $customer_name[$size];@endphp<div class="alpha_upsell_sale_popup_n_1 alpha_upsell_sale_popup_bg {{ $alignmentClass }} {{ $upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[1] ?  'alpha_upsell_sale_popup_n_2' : '' }} {{ $animation_class }}"><a href="{{ 'https://'.$shopName.'/products/'.$product['handle'] }}" style="display:inline-flex" class="alpha_anchor_tag" data-id="{{ $product['product_id'].','.$product['handle'] }}"><div class="{{ $upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[0] ?  'alpha_upsell_sale_popup_n1_img' : 'alpha_upsell_sale_popup_n2_img' }}"><img src="{{ $product['image'] }}" alt=""></div><div class="alpha_upsell_sale_popup_n1_heading"><input type="hidden" class="alpha_item_qty alpha_target_product" ><input type="hidden" value="{{ $product['handle'] }}"><h5 class="alpha_user_info">{{  $last_name }} From {{ $product['country_name'] }}, purchased</h5><h3 class="alpha_product_title">{{  Illuminate\Support\Str::limit($product['title'],20) }}</h3><p class="alpha_SN_timer">{{ $product['created_ago'] }}</p></div></a><div class="{{ $upsell->setting['notificationLayout'] == config('upsell.strings.layout_options')[1] ?  'alpha_upsell_sale_popup_n2_close' : 'alpha_upsell_sale_popup_n1_close' }}"><button class="alpha_upsell_sale_popup_n1_btn remove_sale_notification_button">&times;</button></div></div>@endforeach'

    document.body.insertAdjacentHTML('beforeend',sale_notification_HTML);
    var current_class;
    var prevId;
    var total_length;
    sessionStorage.getItem('class_activator')==null ? sessionStorage.setItem('class_activator',0):'';
    var class_activator = Number(sessionStorage.getItem('class_activator'))
    function  __controller(currentDivId)
    {
        current_class = document.querySelectorAll('.alpha_upsell_sale_popup_n_1');
        prevId = ((currentDivId + current_class.length)-1) % current_class.length;
        current_class[prevId].classList.contains('alpha_upsell_sale_notification_active')? current_class[prevId].classList.remove('alpha_upsell_sale_notification_active'):'';
            current_class[currentDivId].classList.add('alpha_upsell_sale_notification_active');
        // current_class[currentDivId].classList.add('alpha_upsell_sale_notification_active');				
    }
    setTimeout(() => {
        __controller(class_activator);
        var upsell_notification_loop = setInterval(() => {
            class_activator = Number(sessionStorage.getItem('class_activator'))
            total_length = document.querySelectorAll('.alpha_upsell_sale_popup_n_1').length;
            __controller((class_activator+1)%total_length);
            @if($upsell->setting['repeat_cycle'])
                    class_activator<total_length-1 ? class_activator++:class_activator=0;
                    sessionStorage.setItem('class_activator',class_activator);
            @else
                if(class_activator<total_length-1)
                    {
                        class_activator++;

                    }
                else
                    {
                        current_class[0].classList.remove('alpha_upsell_sale_notification_active');
                        clearInterval(upsell_notification_loop)
                    }
                
                sessionStorage.setItem('class_activator',class_activator);
            @endif
        }, {{ $upsell->setting['delay_time_between_notification']*1000 }});
    }, {{ $upsell->setting['initial_notification_display_time']*1000 }});

    document.body.addEventListener('click', function ( event ) {
        var target_sale_notification = event.target.classList.contains('remove_sale_notification_button');
        if( target_sale_notification ) {
            document.querySelector('.alpha_upsell_sale_notification_active').classList.remove('alpha_upsell_sale_notification_active');               
        };
    });

    // calling t0 Each Notification function which will trigered when someone click the alpha upsell notification

    eachNotification(document.querySelectorAll('.alpha_anchor_tag'),function(e){
        e.preventDefault();
        notificationClickedFlag = true;
        var sale_notification_data   = e.target.closest('a').getAttribute('data-id');
            sale_notification_data   = sale_notification_data.split(',');
        var sale_notification_object = {
            'id':sale_notification_data[0],
            'handle':sale_notification_data[1],
            'upsellId':upsell.id
        };
        // console.log(sale_notification_object)
        sessionStorage.setItem("sale_notification_object", JSON.stringify(sale_notification_object));
        sessionStorage.setItem('notificationClickedFlag',true);
        window.location.href     = window.location.origin+'/products/'+sale_notification_data[1];
    });

    // Define Each Notification function which will trigered when someone click the alpha upsell notification
    function eachNotification(selector_parm,callback)
    {
        for(val of selector_parm)
        {
            val.addEventListener('click',callback)
        }
    }
    // console.log(sessionStorage.getItem('notificationClickedFlag'))
    if(sessionStorage.getItem('notificationClickedFlag')!=null && sessionStorage.getItem('notificationClickedFlag'))
    {
        var notificationClickedFlag = sessionStorage.getItem('notificationClickedFlag')
        sessionStorage.setItem('notificationClickedFlag',false);
    }

    //Replace Button
    function replaceElement(target_element,classToAdd)
    {
        
        /**
         * ============================================
         * Selectors for pick Quantity when target 
         * product is adding to cart
         * ============================================
         */
        // notificationClickedFlag = false;
        var pickQuantity = ['select[name="quantity"]','#quantity'];
        if(target_element != null)
        {
            var targetClone   = target_element.cloneNode(true)
            if (!target_element.classList.contains(classToAdd)) {
                targetClone.classList.add(classToAdd);
                target_element.insertAdjacentElement('afterend', targetClone);
                target_element.remove();
            }
            targetClone.addEventListener('click',function(e){
                if(notificationClickedFlag)
                {
                    e.preventDefault();
                    var variant_id = '';                        
                    var urlParams;
                    (window.onpopstate = function () {
                        var match,
                            pl     = /\+/g,  // Regex for replacing addition symbol with a space
                            search = /([^&=]+)=?([^&]*)/g,
                            decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
                            query  = window.location.search.substring(1);

                        urlParams = {};
                        while (match = search.exec(query))
                        urlParams[decode(match[1])] = decode(match[2]);
                    })();
                    //------------------------------------------------------------------------------

                    urlParams.variant != undefined ? variant_id = urlParams.variant :  variant_id = alpha_variant_id; 
                    //------------------------------------------------------------------------------
                    for(qty of pickQuantity)
                    {
                        if(document.querySelector(qty) != undefined)
                        {
                            var targetProductQuantity = document.querySelector(qty).value;
                        }
                        else
                        {
                            targetProductQuantity = 1;
                        }
                    }
                    
                    document.querySelector('.alpha_target_product').value = variant_id
                    document.querySelector('.alpha_target_product').setAttribute('alpha_product_quantity',targetProductQuantity)
                    var alpha_atc_object = [{
                        "id":variant_id,
                        "quantity":targetProductQuantity,
                        "properties":{
                            '_Sale_notification':upsell.id
                        }
                    }]
                    var data = {
                        items:alpha_atc_object
                    };  
                    var alpha_fbt_upsell_cart_data = JSON.stringify(data);
                    var alpha_header = [
                        {
                            "Content-Type": "application/json"
                        }
                    ]
                    alpha_upsell_ajax("/cart/add.js",function(response){
                        alpha_upsell_ajax(""+app_URL+"/trackUpsell?id="+upsell.id+"",function(res){
                            if(res.status == true)
                            {
                                // console.log('sale notification add to cart increased')
                                window.location.href = window.location.origin+'/cart';
                            }
                        });

                        //update view code end
                    },'POST',alpha_fbt_upsell_cart_data,alpha_header);
                }
            });
        } 
    }
    //End Replace Button Code

    /**
     * 
     * --------------------------------------------------------------------
     * Itrate Loop on Add to cart Button Selector. Remove all default
     * events from add to cart button and add cutom events.
     * --------------------------------------------------------------------
     * 
     */
    for(const btnSelector of alpha_upsell_SN_add_to_cart_selectors)
    {
        // console.log(document.querySelector(btnSelector))
        if(document.querySelector(btnSelector) != null && performance.navigation.type != performance.navigation.TYPE_RELOAD  && upsells.add_to_cart==undefined)
        {
            // console.log(sessionStorage.getItem('notificationClickedFlag'))
            replaceElement(document.querySelector(btnSelector),'upsellBtn')
            break;
        }
    }
    // console.info(performance.navigation.type,'test',performance.navigation.TYPE_RELOAD);

    // console.log(upsells.add_to_cart);

})();