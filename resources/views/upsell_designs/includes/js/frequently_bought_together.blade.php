(function(){

    console.log('working')
     /*
     *
     * ================================================================================
     * Get Sale Notification Object From Session Storage.
     * The sessoion is creting when a user will  click the sale notification and
     * then click on add to cart button
     * ================================================================================
     *
     */


    var sale_notification_object = sessionStorage.getItem('sale_notification_object')


    var app_URL = "{{ env('APP_URL') }}"
    var currentShowingUpsellId = "{{ $upsellId }}";
    var trackingUpsellid = JSON.stringify({id:currentShowingUpsellId })

    var tProductUrl = location.origin+"/products/"+alpha_upsell_producthandle+".json";
    var fbtProducts = [];
    var fbtHandles = [
        @foreach($aProductHandle as $fbtHandles)
            "{{ $fbtHandles}}",
        @endforeach
    ];
    for(const key in fbtHandles)
    {
        fbtProducts.push(products[fbtHandles[key]]);
    }
    alpha_upsell_ajax(tProductUrl,function(res){
        if(res.hasOwnProperty('product')){
            fbtProducts.unshift(res.product);
            createHtmlForFbt(fbtProducts);
        }
    });
    function createHtmlForFbt(fbtProducts){
        /**
         *
         * ========================================
         * Below the add to cart button selctors
         * ========================================
         *
         */
        var alpha_upsell_fbt_add_to_cart_selectors    = ['div.product-submit.action-button.submit','button[class~=enj-add-to-cart-btn]','button[name="add"]','input[name="add"]','button[class~=add-to-cart-btn]','button[class~=product-form__cart-submit--small]','#button-cart','button[class~=btn-addtocart]','#AddToCartText','#AddToCartText6643010142366','input[class~=atc]','input[class~=add-to-cart-button]','#shopify_add_to_cart','a[class~=addtocart]','#AddToCart','#AddToCart-product-template','button[class~="btn--add-to-cart"]','button[class~="product-form__add-button"]','button[class~="ProductForm__AddToCart "]','button[data-action~="add-to-cart"]','#AddToCart'];
        /**
         *
         * ========================================
         * Below the description selctors
         * ========================================
         *
         */
        var alpha_upsell_fbt_descrption_selectors     = ['div[class~=contact_product_09].contact_product_detail_11','div[class~=product-name]','div[class~=short-description-detail]','div[class~=product--description]','p[class~=note_pro]','div[class~=prt-rate-btn]+p','div[class~=rte]','div[class~=short-desc]','div[class~=product-short-desc]','div[class~=product-single-prices]+div[class~=description]','div[class~=product-description]','div[class~=product-des]','p[class~=short-des]','div[class~=product-single__description]','div[class~=description] p','div[class~=pd_summary]','p[class~=description]','div[class~=pro__details]','div[class~=product__short-description]','div[class~=Shopify-product-details__short-description]','div[class~=short-description]','div[class~=product-description-right]','div[class~="amount"]+span','p[class~=abs]','[class~=thumnail-desc]','p[class~=short-description]'];
        /**
         *
         * ========================================
         * Below products selctors
         * ========================================
         *
         */

        var alpha_upsell_fbt_below_product_selectors = ['div[class~=breadcrumbs].breadcrumb_2blog.breadcrumb_04.breadcrumbs-center+div[id~=main]+div[class~=tabs_container]','div[class~=text-center].breadcrumb-size+div[class~=container].container-full.product-detail+div[class~=container].container-full','#more_info_block','div[class~=product_description]','div[class~=woocommerce-tabs].row.js__tab_plugin.js__tab_plugin_2','div[class~=engoc-product-detail-tab]','#shopify-section-single-product-tab','div[class~=collateral]','div[class~=detail-tabs]','div[class~=product-details-left] div[class~=product-details]','#ProductTabs','div[class~=commerce-tabs]','div[class~= lookbook]','#shopify-section-gp-product-template-2-columns-right','div[class~=dt-sc-tabs-container]+style+script+script+div','div[class~=hoz-tab-container]','div[class~=tab-pd-details]','#shopify-section-product-tab','#content','div[class~=k2t-product-bottom ]','div[class~=dt-sc-tabs-container]','div[class~=tab-pd-details]','#myTabContent','div[class~=theme-ask]','div[class~=product-tabs]','div[class~=product_section]','#shopify-section-product-template','#shopify-section-product-add-more','#shopify-section-product-page-description','#quickview_product','div[class~=product__description]','#shopify-section-product-template-default']

        /**
         *
         * ========================================
         * Bottom of the page selctors
         * ========================================
         *
         */
        var alpha_upsell_fbt_above_footer_selectors   = ['#shopify-section-footer-model-24','#shopify-section-footer-model-7','div[class~=breadcrumbs-section]+div+footer','footer[class~=ossvn--footer]','div[class~=button-accrion]+footer[class~=footer-container]','#shopify-section-footer-model-12','#shopify-section-newsletter-block-type-3','#shopify-section-footer-logo','#shopify-section-footer-model-1','div[class~=is-sticky]+div+footer','footer[class~=footer-v2]','#shopify-section-footer-model-6','#shopify-section-footer-model-22','#shopify-section-footer-model-4','#shopify-section-footer','div[class~=newsletter]','#shopify-section-footer-model-9','#shopify-section-footer-model-10','div[class~=footer-teamplate]','footer[class~=footer_v1]','footer[class~=footer_v4 ]','footer[class~=k2t-footer]','#shopify-section-footer-model-3','div[class~=site-footer__middle]','div[class~=footer]','#shopify-section-static-footer','#jas-footer','#footer','#shopify-section-footer-bottom','#shopify-section-footer-model-18','footer div[class~=container]','div[class~=footer-top]','footer[class~=footer-container]','footer[class~=site-footer]','div[class~=site-footer]','#shopify-section-footer','#shopify-section-footer-model-2'];

        var alphaUpsellTotalPrice = 0;
        var alphaUpsellTotalCompareAtPrice = 0;
        var alpha_upsell_id = "{{ $upsell->id }}";
        var alpha_upsell_title = "{{ $upsell->setting['fbt_heading'] }}"
        var alpha_upsell_button_text = "{{ $upsell->setting['button_text'] }}"
        var alpha_upsell_sale_badge_text = "{{ $upsell->setting['sale_badge_text'] }}"
        var show_sale_badge_on_image = "{{ $upsell->setting['show_sale_badge_on_image'] }}"
        var show_compare_price = "{{ $upsell->setting['show_compare_price_available'] }}"
        var show_total_price = "{{ $upsell->setting['show_original_total_price'] }}"
        var total_price_text = "{{ $upsell->setting['total_price_text'] }}"
        var this_item = "{{ $upsell->setting['this_item'] }}"

        var alphaFbtHtml =  '<div class="alpha_upsell_freq_live_p alpha_upsell_freq_freq_pre"><h2>'+alpha_upsell_title+'</h2>'
        for(const alphaProductKey in fbtProducts)
        {
            if(fbtProducts[alphaProductKey]['variants'][0]['price'])
            {
                alphaUpsellTotalPrice += parseFloat(fbtProducts[alphaProductKey]['variants'][0]['price'])
            }
            if(fbtProducts[alphaProductKey]['variants'][0]['compare_at_price'])
            {
                alphaUpsellTotalCompareAtPrice += parseFloat(fbtProducts[alphaProductKey]['variants'][0]['compare_at_price'])
            }
            var alphaProduct     = fbtProducts[alphaProductKey];
            alphaFbtHtml+='<div class="alpha_upsell_freq_item"><img src="'+alphaProduct['image']['src']+'" alt="cream">'
            if(alphaProductKey > 0)
            {
               if(show_sale_badge_on_image == 1)
               {
                    alphaFbtHtml += '<span class="alpha_upsell_freq_notify-badge">'+alpha_upsell_sale_badge_text+'</span>'
               }
            }
            if(alphaProductKey < fbtProducts.length-1)
            {
                alphaFbtHtml+= '<span class="alpha_upsell_freq_img_plus">+</span>'
            }
            alphaFbtHtml+= '</div>'
        }
        if(show_total_price == 1)
        {
            alphaFbtHtml+= '<p class="alpha_upsell_freq_live_total">'+total_price_text+' <span class="alpha_upsell_freq_l_t_s aus_fbt_total_price">'+alpha_upsell_currency_symbol+alphaUpsellTotalPrice.toFixed(2)+'</span><span class="alpha_upsell_freq_l_t_p aus_fbt_total_compare_price">'
        }
        if(alphaUpsellTotalCompareAtPrice!=0 && alphaUpsellTotalCompareAtPrice >alphaUpsellTotalPrice)
        {
            if(show_compare_price == 1)
            {
                alphaFbtHtml += alpha_upsell_currency_symbol+alphaUpsellTotalCompareAtPrice
            }
        }
        alphaFbtHtml+='</span></p><input type="button" class="alpha_upsell_freq_live_btn" id="alpha_upsell_add_to_cart_fbt" value="'+alpha_upsell_button_text+'"><ul class="alpha_upsell_freq_live_ul">'
        for(const alphaProductKey2 in fbtProducts)
        {
            var alphaFbtProductPrice  = fbtProducts[alphaProductKey2]['variants'][0]['price']
            if(fbtProducts[alphaProductKey2]['variants'][0]['price'])
            {
                var alphaFbtProductPrice  = alpha_upsell_currency_symbol+fbtProducts[alphaProductKey2]['variants'][0]['price']
            }
            else
            {
                var alphaFbtProductPrice  = fbtProducts[alphaProductKey2]['variants'][0]['price']
            }
            if(fbtProducts[alphaProductKey2]['variants'][0]['compare_at_price'])
            {
                var alphaFbtProductCompareAtPrice = alpha_upsell_currency_symbol+fbtProducts[alphaProductKey2]['variants'][0]['compare_at_price']
            }
            else
            {
                var alphaFbtProductCompareAtPrice = fbtProducts[alphaProductKey2]['variants'][0]['compare_at_price']
            }
            alphaFbtHtml += '<li class="alpha_upsell_freq_live_total">'
            if(alphaProductKey2 == 0)
            {
                alphaFbtHtml += '<b>'+this_item+':</b>'
            }
            alphaFbtHtml +='<a style="display: inline;"><h3 class="alpha_upsell_freq_p_title">'+fbtProducts[alphaProductKey2]['title']+'</h3></a>'
            if(fbtProducts[alphaProductKey2]['variants'].length == 1)
            {
                alphaFbtHtml +='<select class="alpha_upsell_freq_input alpha_upsell_freq_variants" style="display:none;">'
            }
            else
            {
                alphaFbtHtml +='<select class="alpha_upsell_freq_input alpha_upsell_freq_variants">'
            }
            for(const alphaFbtVariant in fbtProducts[alphaProductKey2]['variants'])
            {
                // console.log(fbtProducts[alphaProductKey2]['variants'][alphaFbtVariant]);
                alphaFbtHtml+= '<option value ='+fbtProducts[alphaProductKey2]['variants'][alphaFbtVariant]['id']+'>'+fbtProducts[alphaProductKey2]['variants'][alphaFbtVariant]['title']+'</option>'
            }
            alphaFbtHtml +='</select><span style="margin-left: 0.5em; white-space: nowrap; display: inline;">'
            if(show_total_price == 1)
            {
                alphaFbtHtml += '<span class="alpha_upsell_freq_l_t_s aus_fbt_price_2">'+alphaFbtProductPrice+'</span>'
            }
            if(show_compare_price == 1 && alphaFbtProductPrice < alphaFbtProductCompareAtPrice)
            {
                alphaFbtHtml += '<span class="alpha_upsell_freq_l_t_p aus_fbt_compare_price"><span style="white-space:nowrap;">'+alphaFbtProductCompareAtPrice+'</span></span></span></li>'
            }
        }
        alphaFbtHtml += '</ul></div>'
        @if($upsell->setting['location_of_fbt'] == 'below_add_to_cart')
            for(value of alpha_upsell_fbt_add_to_cart_selectors)
            {
                if(document.querySelector(value)!= null )
                {
                    if(value == 'button[class~=product-form__cart-submit--small]')
                    {
                        console.log(1,value)
                        document.querySelector(value).closest('form').closest('div').insertAdjacentHTML('afterend',alphaFbtHtml);
                        break;
                    }
                    else
                    {
                        if(document.querySelector(value).closest('form') != null)
                        {
                            console.log(1,value)
                            document.querySelector(value).closest('form').insertAdjacentHTML('afterend',alphaFbtHtml);
                            break;
                        }
                    }

                }
            }
        @elseif($upsell->setting['location_of_fbt'] == 'below_the_description')
            for(value of alpha_upsell_fbt_descrption_selectors)
            {
                if(document.querySelector(value)!= null)
                {
                    console.log(value);
                    document.querySelector(value).insertAdjacentHTML('afterend',alphaFbtHtml);
                    break;
                }
            }
        @elseif($upsell->setting['location_of_fbt'] == 'below_the_product')
            for(value of alpha_upsell_fbt_below_product_selectors)
            {
                // if(document.querySelector(value)!= null)
                // {
                //     if(value == "div[class~=section-header--small]" || value=="section[class~=new-products]")
                //     {
                //         document.querySelector(value).insertAdjacentHTML('afterbegin',alphaFbtHtml);
                //     }
                //     else if(value == '#quickview_product' || value=='#shopify-section-related-products'||value=='div[class~=shopify-section--bordered]')
                //     {
                //         document.querySelector(value).insertAdjacentHTML('afterend',alphaFbtHtml);
                //     }
                //     else
                //     {
                //         document.querySelector(value).insertAdjacentHTML('beforebegin',alphaFbtHtml);
                //     }
                //     break;
                // }

                if(document.querySelector(value)!= null)
                {
                    console.log(value)
                    document.querySelector(value).insertAdjacentHTML('afterend',alphaFbtHtml);
                    break;
                }
            }
        @elseif($upsell->setting['location_of_fbt'] == 'bottom_of_page')
            for(value of alpha_upsell_fbt_above_footer_selectors)
            {
                if(document.querySelector(value)!= null)
                {
                    if(value == "#shopify-section-newsletter-block-type-3" )
                    {
                        console.log(value);
                        document.querySelector(value).insertAdjacentHTML('afterbegin',alphaFbtHtml);
                        break;
                    }
                    else{
                        console.log(value)
                        document.querySelector(value).insertAdjacentHTML('beforebegin',alphaFbtHtml);
                        break;
                    }

                }
            }
        @endif
        /**
         *
         *  Products Variant Ids for Add to Cart
         *
         */
        var alpha_freq_add_to_cart_items_id = document.querySelectorAll('.alpha_upsell_freq_variants');
        var alpha_fbt_array = [];
        document.addEventListener('click',function(e){
            if(e.target && e.target.id== 'alpha_upsell_add_to_cart_fbt'){
                for(const key of alpha_freq_add_to_cart_items_id)
                {
                    var alpha_fbt_object = {
                        "id":key.value,
                        "quantity":1,
                        properties: {
                            '_alpha_upsell_id':alpha_upsell_id,
                        }
                    }
                    alpha_fbt_array.push(alpha_fbt_object)
                }
                var data = {
                    items:alpha_fbt_array
                };
                var alpha_fbt_upsell_cart_data = JSON.stringify(data);
                var alpha_header = [
                    {
                        "Content-Type": "application/json"
                    }
                ]
                alpha_upsell_ajax("/cart/add.js",function(response){
                    alpha_upsell_ajax("/a/alphaUpsell/trackUpsell?id="+currentShowingUpsellId+"",function(res){
                        if(res.status == true)
                        {
                            location.href = location.origin+"/cart";
                        }
                    });
                    // location.href = location.origin+"/cart";
                },'POST',alpha_fbt_upsell_cart_data,alpha_header);
             }
         });


        /**
         *
         * Changing Variants Prices by changging the Variant
         *
         */
        // console.log(fbtProducts);
        document.addEventListener('change',function(e){
            if(e.target && e.target.classList.contains('alpha_upsell_freq_variants')){
                for(const alphaFreqProduct in fbtProducts)
                {
                    for(alphaFreqVariant in fbtProducts[alphaFreqProduct]['variants'])
                    {
                        if(e.target.value == fbtProducts[alphaFreqProduct]['variants'][alphaFreqVariant]['id'])
                        {
                            var alpha_freq_price = fbtProducts[alphaFreqProduct]['variants'][alphaFreqVariant]['price'];
                            var alpha_freq_compare_at_price = fbtProducts[alphaFreqProduct]['variants'][alphaFreqVariant]['compare_at_price'];
                            e.target.parentNode.querySelector('.alpha_upsell_freq_l_t_s').innerHTML =   alpha_upsell_currency_symbol+alpha_freq_price
                            var alpha_upsell_freq_1_t_p = e.target.parentNode.querySelector('.alpha_upsell_freq_l_t_p').children[0];
                            console.log(alpha_freq_compare_at_price);
                            if(alpha_freq_compare_at_price != '' && alpha_freq_compare_at_price > alpha_freq_price){
                                alpha_upsell_freq_1_t_p.innerHTML =   alpha_upsell_currency_symbol+alpha_freq_compare_at_price
                            }else{
                                alpha_upsell_freq_1_t_p.innerHTML = ''
                            }

                            // var this_item_price = document.querySelectorAll('.alpha_upsell_freq_l_t_s')[1].innerText
                            // var this_item_price = this_item_price.replace( /^\D+/g, '');
                            var aus_total_sum = 0;
                            var aus_total_compare_sum = 0;
                            var all_product_price = document.querySelectorAll('.aus_fbt_price_2');
                            var all_product_compare_price = document.querySelectorAll('.aus_fbt_compare_price');
                            for(var aus_fbt_price of all_product_price){
                                var aus_fbt_total_price = Number(aus_fbt_price.innerText.replace( /^\D+/g, ''))
                                aus_total_sum = aus_total_sum + parseFloat(aus_fbt_total_price);
                            }
                            for(var aus_fbt_compare_price of all_product_compare_price){
                                var aus_fbt_compare_price = Number(aus_fbt_compare_price.innerText.replace( /^\D+/g, ''));
                                aus_total_compare_sum = aus_total_compare_sum + parseFloat(aus_fbt_compare_price);
                            }
                            document.querySelector('.aus_fbt_total_price').innerText = alpha_upsell_currency_symbol +aus_total_sum.toFixed(2);
                            if(aus_total_compare_sum!='' && aus_total_compare_sum > aus_total_sum){
                                document.querySelector('.aus_fbt_total_compare_price').innerText = alpha_upsell_currency_symbol + aus_total_compare_sum.toFixed(2);
                            }else{
                                document.querySelector('.aus_fbt_total_compare_price').innerText = '';
                            }
                        }
                    }
                }
            }
        });
    }
})();
