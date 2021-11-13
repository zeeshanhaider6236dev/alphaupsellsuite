(function () {
    var app_URL = "{{ env('APP_URL') }}"
    var shop_currency = "{{ $currency }}";
    var proxy_url = "{{ env('PROXY_URL')}}";

    /**
     * ============================================
     * Selectors for pick Quantity when target
     * product is adding to cart
     * ============================================
     */

     var pickQuantity = ['select[name="quantity"]','#quantity'];



    /*
     *
     * ============================================
     * Theme Checkout button selectors
     * ============================================
     *
     */
    const themeCheckoutBtn = ['#checkout','input[name="checkout"]','button[name="checkout"]','input[class="action_button right"]','button[class~="btn-checkout"]','div[class~="actions"] button[class~="btn"]','div[class~="cart-checkout-btn"] .no-mrg','a[class~=btn-checkout]'];
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
    /*
     *
     * ============================================
     * Replace custom Checkout button with cart
     * checkout button
     * ============================================
     *
     */
    for(checkoutBtn of themeCheckoutBtn)
    {
        const themeCheckOutBtn = document.querySelectorAll(checkoutBtn)
        for(eachChekout of themeCheckOutBtn)
        {
            if(eachChekout != undefined)
            {
                // console.log(eachChekout)
                replaceElement(eachChekout,'alpha_checkoutBtn');
            }
        }
    }
    /**
     *
     * ---------------------------------------------------
     * Get Upsell in Upsell variable as an object also
     * declare other required variables
     * ---------------------------------------------------
     *
     */
    var upsell = {!! $upsell !!};
    var add_to_cart_upsell_HTML = '';
    console.log(upsell.setting);
    /**
     *
     * ---------------------------------------------------
     * create URL for Targeted product to get from store
     * ---------------------------------------------------
     *
     */
    var tProductUrl = location.origin + "/products/" + alpha_upsell_producthandle + ".json";
    /**
     *
     * ---------------------------------------------------
     * create array type variable named with
     * addToCartProducts
     * ---------------------------------------------------
     *
     */
    var addToCartProducts = [];
    /**
     *
     * ---------------------------------------------------
     * store all handles in addToCartHandles varibale
     * sent in response
     * ---------------------------------------------------
     *
     */
    var addToCartHandles = [
        @foreach($aProductHandle as $addToCartHandles)
        "{{ $addToCartHandles}}",
        @endforeach
    ];
    for (const key in addToCartHandles) {
        addToCartProducts.push(products[addToCartHandles[key]]);
    }
    /**
     *
     * ---------------------------------------------------
     * call api to get Targeted products with URL
     * ---------------------------------------------------
     *
     */
    alpha_upsell_ajax(tProductUrl, function (res) {
        if (res.hasOwnProperty('product')) {
            addToCartProducts.unshift(res.product);
            createHtmlForAddToCart(addToCartProducts);
        }
    });
    /**
     *
     * ---------------------------------------------------
     * create HTML For Add to Cart Upsell
     * ---------------------------------------------------
     *
     */
    function createHtmlForAddToCart(addToCartProducts) {
        /* ------Delare or define all variables */
        // console.log(addToCartProducts);
        var target_product_img     = addToCartProducts[0].image.src
        var target_product_title   = addToCartProducts[0].title
        var target_product_id      = addToCartProducts[0].id
        /*
         *
         * ============================================
         * Theme Checkout button selectors
         * ============================================
         *
         */
        // const themeCheckoutBtn = ['input[name="checkout"]','button[class~="btn"]'];
        /**
         *
         * ========================================
         * Add To Cart button selctors
         * ========================================
         *
         */
        var skip_first_itration = 0;
        var alpha_upsell_add_to_cart_selectors = ['button.product__add-to-cart-button','button.product-submit','button.single_add_to_cart_button','button.gt_button.gt_button--large','button.single_add_to_cart_button.single-product-add','div.mini-btn span.icon-shoppingcart','input.btn.add-to-cart-btn','button.btn--submit.js-add-to-card','a[class~=add-cart-btn]','button[class~=enj-add-to-cart-btn]', 'button[name="add"]', 'input[name="add"]', 'button[class~=add-to-cart-btn]', 'button[class~=product-form__cart-submit--small]', '#button-cart', 'button[class~=btn-addtocart]', '#AddToCartText', '#AddToCartText6643010142366', 'input[class~=atc]', 'input[class~=add-to-cart-button]', '#shopify_add_to_cart', 'a[class~=addtocart]', '#AddToCart', '#AddToCart-product-template', 'button[class~="btn--add-to-cart"]', 'button[class~="product-form__add-button"]', 'button[class~="ProductForm__AddToCart"]', 'button[data-action~="add-to-cart"]', '#AddToCart'];
        /**
         *
         * ========================================
         * Upsell HTML
         * ========================================
         *
         */
        // add_to_cart_upsell_HTML = '<div id="alpha_upsell_m5_myModal5" class="alpha_upsell_m5_modal5"><div class="alpha_upsell_m5_modal-content alpha_upsell_m5_modal_5"><div class="alpha_upsell_m5_modal_5_head"><input type="hidden" class="alpha_item_qty alpha_target_product"><h2>'+upsell.setting.alpha_t6_top_heading+' <span class="alpha_upsell_m5_close" id="alpha_upsell_m5_myModal5">&times;</span></h2></div><div class="alpha_upsell_m5_modal_5_body"><div class="alpha_upsell_m5_products"><div class="alpha_upsell_m5_item"><h3>Your Item</h3><div class="alpha_upsell_m5_prodcut_item"><div class="alpha_upsell_m5_item_img"> <img src="'+target_product_img+'" alt="bag"></div><div class="alpha_upsell_m5_item_detail"><h4>'+target_product_title+'</h4><p class="alpha_upsell_m4_t3"></p> <button type="button" class="alpha_upsell_m6_m6_btn1">'+upsell.setting.alpha_t6_checkout_btn+'</button></div></div></div><div class="alpha_upsell_m5_p"><h3>'+upsell.setting.alpha_t6_product_heading+'</h3>'
        // for(product of addToCartProducts)
        // {
        //     if(skip_first_itration == 0)
        //     {
        //         skip_first_itration++
        //         continue;
        //     }
        //     else if(addToCartProducts.length > 3 && skip_first_itration == 3 )
        //     {
        //         break;
        //     }
        //     else
        //     {
        //         skip_first_itration++
        //         add_to_cart_upsell_HTML += '<div class="alpha_upsell_m5_sale_item"><div class="alpha_upsell_m5_sale_img"> <img src="'+product.image.src+'" product-id="'+product.id+'"></div><div class="alpha_upsell_m5_sale_detail"><h4>'+product.title+'</h4><p><span class="alpha_t6_p_price">$'+product.variants[0].price+' </span> <span>'
        //         if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
        //         {
        //             add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
        //         }
        //         else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
        //         {
        //             add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
        //         }
        //         add_to_cart_upsell_HTML +='</span></p> '
        //         for(option of product.options)
        //         {
        //             if(option.values[0] != "Default Title")
        //             {
        //                 add_to_cart_upsell_HTML +='<select>'
        //                 for(value of option.values)
        //                 {
        //                     add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
        //                 }
        //                 add_to_cart_upsell_HTML +='</select> '
        //             }
        //         }
        //         add_to_cart_upsell_HTML +=' <input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /><button type="button" class="alpha_t6_atc_btn">'+upsell.setting.alpha_t6_cart_btn+'</div></div>'
        //     }
        // }
        // add_to_cart_upsell_HTML += '</div></div></div><div class="alpha_upsell_m5_footer"> <input type="button" value="'+upsell.setting.alpha_no_thanks_btn+'" class="alpha_upsell_m5_thanks"></div></div></div>';
        console.log(upsell.setting);
        add_to_cart_upsell_HTML = '<div class="reset-t6 aus-t6-main-wrapper"> <div class="reset-t6 aus-t6-main-container aus-t6-main-container-2"> <div class="reset-t6 aus-t6-top-part aus-t6-top-part-resp"> <div class="reset-t6 aus-t6-tp-text aus-t6-tp-text-resp"><input type="hidden" class="alpha_item_qty alpha_target_product">'+upsell.setting.alpha_t6_top_heading+'</div><div class="reset-t6 aus-t6-tp-cross-btn aus-t6-tp-cross-btn-resp">&times;</div></div><div class="reset-t6 aus-t6-mid-part aus-t6-mid-part-resp"> <div class="reset-t6 aus-t6-mp-text aus-t6-mp-text-resp">Your Item</div><div class="reset-t6 aus-t6-mp-box aus-t6-mp-box-resp"> <div class="reset-t6 aus-t6-mp-box-img-div aus-t6-mp-box-img-div-resp"> <img class="reset-t6 aus-t6-mp-box-img aus-t6-mp-box-img-resp" src="'+target_product_img+'" alt="error loading image"> </div><div class="reset-t6 aus-t6-mp-content-div aus-t6-mp-content-div-resp"> <div class="reset-t6 aus-t6-mp-box-title aus-t6-mp-box-title-resp">'+target_product_title+'</div><div class="reset-t6 aus-t6-mp-box-price alpha_upsell_m4_t3 aus-t6-mp-box-price-resp"></div><div class="reset-t6 aus-t6-mp-box-btn aus-t6-mp-box-btn-resp">'+upsell.setting.alpha_t6_checkout_btn+'</div></div></div></div><div class="reset-t6 aus-t6-last-portion aus-t6-last-portion-resp"> <div class="reset-t6 aus-t6-lp-text aus-t6-lp-text-resp">'+upsell.setting.alpha_t6_product_heading+'</div><div class="reset-t6 aus-t6-lp-box-div aus-t6-lp-box-div-resp">'
            for(product of addToCartProducts){
                if(skip_first_itration == 0)
                    {
                        skip_first_itration++
                        continue;
                    }
                    else if(addToCartProducts.length > 3 && skip_first_itration == 3 )
                    {
                        break;
                    }
                    else
                    {
                        skip_first_itration++
                        add_to_cart_upsell_HTML +='<div class="reset-t6 aus-t6-lp-box aus-t6-lp-box-resp"> <div class="reset-t6 aus-t6-lp-img-div aus-t6-lp-img-div-resp"> <img class="reset-t6 aus-t6-lp-img aus-t6-lp-img-resp" src="'+product.image.src+'" product-id="'+product.id+'" alt="error loading image"> </div><div class="reset-t6 aus-t6-ib-lp-content-div"> <div class="reset-t6 aus-t6-lp-ib-title aus-t6-lp-ib-title-resp">'+product.title+'</div><div class="reset-t6 aus-t6-lp-ib-price-div aus-t6-lp-ib-price-div-resp"> <div class="reset-t6 aus-t6-lp-ib-price aus-t6-lp-ib-price-resp">'+shop_currency+product.variants[0].price+'</div><div class="reset-t6 aus-t6-lp-ib-offer-badge aus-t6-lp-ib-offer-badge-resp">'
                        if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
                        {
                            add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
                        }
                        else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
                        {
                            add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
                        }
                        add_to_cart_upsell_HTML +='</div></div><div class="reset-t6 aus-t6-drop-down-div aus-t6-drop-down-div-resp">'
                        for(option of product.options)
                        {
                            if(option.values[0] != "Default Title")
                            {
                                add_to_cart_upsell_HTML +='<select class="reset-t6 aus-t6-drop-down aus-t6-drop-down-resp" name="size" id="size">'
                                for(value of option.values)
                                {
                                    add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
                                }
                                add_to_cart_upsell_HTML +='</select> '
                            }
                        }
                        add_to_cart_upsell_HTML += '</div><input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /><div class="reset-t6 aus-t6-atc-btn aus-t6-atc-btn-resp">'+upsell.setting.alpha_t6_cart_btn+'</div></div></div>'
                    }
            }
            add_to_cart_upsell_HTML +='</div></div><div class="reset-t6 aus-t6-footer aus-t6-footer-resp"> <div class="reset-t6 aus-t6-nts-btn aus-t6-nts-btn-resp">'+upsell.setting.alpha_no_thanks_btn+'</div></div></div></div>'




        /**
         *
         * --------------------------------------------------------------------
         * Add HTML before Body End
         * --------------------------------------------------------------------
         *
         */
        document.body.insertAdjacentHTML('beforeend',add_to_cart_upsell_HTML)
        /**
         *
         * --------------------------------------------------------------------
         * Itrate Loop on Add to cart Button Selector. Remove all default
         * events from add to cart button and add cutom events.
         * --------------------------------------------------------------------
         *
         */
        for(const btnSelector of alpha_upsell_add_to_cart_selectors)
        {
            replaceElement(document.querySelector(btnSelector),'upsellBtn')
        }

    /**
     *
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     * change image and price by changing the
     * variant.
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     *
     */
        document.addEventListener('change',function(e){
            var target_images        = e.target.closest('div[class~=aus-t6-last-portion]').querySelectorAll('img');
            var target_image_id      = e.target.closest('div[class~=aus-t6-lp-box]').querySelector('img').attributes["product-id"].value;
            var price_update_element = e.target.closest('div[class~=aus-t6-lp-box').querySelector('.aus-t6-lp-ib-price');
            var variantID_update_element = e.target.closest('div[class~=aus-t6-lp-box').querySelector('.alpha_target_product')
            // console.log(variantID_update_element);
            /* <-------Call function---------> */
            dynamicVariant(e.target, target_images, target_image_id, price_update_element, variantID_update_element,shop_currency)
        });
    /**
     *
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     * Add To Cart Product create discounts and
     * redirect to checkout page by clicking the
     * upsell checkout button.
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     *
     */
        document.addEventListener('click', function(e){
            if(e.target && e.target.classList.contains('aus-t6-atc-btn')) //Add to Cart Button Working
            {
                if(sale_notification_object != null)
                {
                    sessionStorage.removeItem('sale_notification_object');
                }
                sessionStorage.setItem("discountRequestFlag", true);
                addSpinner(e.target)
                e.target.previousElementSibling.setAttribute('alpha_product_quantity',1)
                var alpha_atc_object = [{
                    "id":e.target.previousElementSibling.value,
                    "quantity":1,
                    properties: {
                        '_alpha_atc_upsell_id':upsell.id,
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
                    alpha_upsell_ajax(proxy_url+"/trackUpsell?id="+upsell.id+"",function(res){
                        if(res.status == true)
                        {
                            // location.href = location.origin+"/cart";
                            // location.origin+'/cart/'+e.target.previousElementSibling.value+':'+1+'?'+'discount'+'='+upsell.upsell_discounts[0].discount_code
                            removeSpinner(e.target, '<span class="aus-t5-ib-atc-btn"> <span>✓</span> <span style="margin-left: -9px;">✓</span></span>') //Remove Spinner
                        }
                    });
                    // location.href = location.origin+"/cart";
                },'POST',alpha_fbt_upsell_cart_data,alpha_header);
            }
            else if(e.target && e.target.classList.contains('alpha_upsell_m1_m_1_top_btn'))
            {
                if(sale_notification_object != null)
                {
                    sessionStorage.removeItem('sale_notification_object');
                }
                window.location.href = window.location.origin
            }
            else if(e.target && e.target.classList.contains('aus-t6-mp-box-btn')) /*checkout button*/
            {
                if(sale_notification_object != null)
                {
                    sessionStorage.removeItem('sale_notification_object');
                }
                CheckoutWithDicounts(e.target);
            }
            else if(e.target && e.target.classList.contains('aus-t6-nts-btn')) //No Thanks Button working
            {
                if(sale_notification_object != null)
                {
                    sessionStorage.removeItem('sale_notification_object');
                }
                window.location.href = window.location.origin+'/cart'
            }
            else if(e.target && e.target.classList.contains('aus-t6-tp-cross-btn')) //Cross Button
            {
                if(sale_notification_object != null)
                {
                    sessionStorage.removeItem('sale_notification_object');
                }
                document.querySelector('.aus-t6-main-wrapper').style.display = "none";
                window.location.href = window.location.origin+'/cart'
            }
        });

    }
    /**  >------End function--------<  */



    /**
     *
     * ========================================
     * Defination of All functions
     * ========================================
     *
     */

    /* Create Form Data function */
    function createFormData(data)
    {
        var formData = new FormData();
        for ( var key in data ) {
            if(typeof data[key] == 'object'){
                if(data[key].length == 0)
                {
                    formData.append(key+'[]','');
                }
                else{
                    for (var i = 0; i < data[key].length; i++) {
                        formData.append(key+'[]', data[key][i]);
                    }
                }
            }
            else{
                formData.append(key, data[key]);
            }
        }
        return formData;
    }

    /* <------------Redirect to Checkout by creating Discounts-----------> */
    function CheckoutWithDicounts(target = null)
    {
        if (target != null) {
            addSpinner(target)
        }
        var alpha_cart_items_url = window.location.origin+'/cart.json';
        alpha_upsell_ajax(alpha_cart_items_url,function(response){
            var filter_items = []
            for(key in response.items )
            {
                var filter_item_obj = {
                    'upsell_id':response.items[key].properties,
                    'variant_id': response.items[key].variant_id,
                    'quantity': response.items[key].quantity,
                    'price': (response.items[key].price)/100,
                    'line_price': (response.items[key].line_price)/100,
                    'product_id': response.items[key].product_id,
                    'title': response.items[key].title,
                    'variant_title': response.items[key].variant_title,
                    'vendor': response.items[key].vendor,
                    'shop':window.location.host
                }
                filter_items.push(filter_item_obj)
            }
            var alpha_data_for_discount = createFormData({'discounts':JSON.stringify(filter_items)});

            alpha_upsell_ajax(proxy_url+"/create/discounts",function(res){
                if(res.status == true)
                {
                    target != null ? removeSpinner(target,'Checkout') :'';
                    window.location.href = res.checkout_url
                }
            },'POST',alpha_data_for_discount);

        },'POST');
    }

    /* <------------Add Spinner in Target Element -----------> */
    function addSpinner(element)
    {
        element.disabled = true;
        element.innerHTML += '<span class="alpha-upsell-loader"></span>' ;
    }
    /* <------------Remove Spinner From Target Element -----------> */
    function removeSpinner(element,text = '')
    {
        element.innerHTML = ''
        element.innerHTML = text
        // element.disabled = true;
        element.style.cursor="not-allowed"
    }

    function replaceElement(target_element,classToAdd)
    {
        // const targetElement = document.querySelector(target_element)
        // console.log(target_element)
        if(target_element != null)
        {
            var targetClone   = target_element.cloneNode(true)
            if (!target_element.classList.contains(classToAdd)) {
                targetClone.classList.add(classToAdd);
                target_element.insertAdjacentElement('afterend', targetClone);
                target_element.remove();
            }
            targetClone.addEventListener('click',function(e){
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

                urlParams.variant != undefined ? variant_id = urlParams.variant :  variant_id = addToCartProducts[0].variants[0].id;
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

                // document.querySelector('.alpha_target_product').value = variant_id
                document.querySelector('.alpha_target_product').setAttribute('alpha_product_quantity',targetProductQuantity)
                // var alpha_atc_object = [{
                //     "id":variant_id,
                //     "quantity":targetProductQuantity,
                // }]
                if(sale_notification_object != null)
                {
                    var alpha_atc_object = [{
                        "id":variant_id,
                        "quantity":targetProductQuantity,
                        "properties":{
                            '_Sale_notification':JSON.parse(sale_notification_object).upsellId
                        }
                    }]
                }
                else
                {
                    var alpha_atc_object = [{
                        "id":variant_id,
                        "quantity":targetProductQuantity,
                    }]
                }
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
                    if(sale_notification_object != null)
                    {
                        alpha_upsell_ajax(proxy_url+"/trackUpsell?id="+JSON.parse(sale_notification_object).upsellId+"",function(res){ });
                    }
                    var target_product_quantity    = response.items[0].quantity;
                    var target_product_varriant_id = response.items[0].variant_id;
                    for(variant of addToCartProducts[0].variants )
                    {
                        if (variant.id ==target_product_varriant_id ) {
                            var target_product_varriant_price = target_product_quantity*variant.price;
                            break;
                        }
                    }
                    document.querySelector('.alpha_upsell_m4_t3').innerText = shop_currency+target_product_varriant_price.toFixed(2);
                    if(response){
                        document.body.style.overflow = "hidden"
                        setProperty('.aus-t6-main-wrapper','display','block')
                    }
                    //update View
                    var formData = new FormData();
                        formData.append('id'+[],upsell.id);
                    alpha_upsell_ajax(proxy_url+"/count/view",function(res){
                        if(res.status == true){
                            console.log('increased');
                        }
                    },"POST",formData)
                    //update view code end
                },'POST',alpha_fbt_upsell_cart_data,alpha_header);
            });
        }
    }
    function setProperty(element,property,value)
    {
        let elements = document.querySelectorAll(element);
        for(let i=0;i<elements.length;i++)
        {
            elements[i].style.setProperty(property,value,'important');
        }
    }

    /* include common JS */

    @include('upsell_designs.includes.js.pre_purchase.global_js.commonJS')

})();
