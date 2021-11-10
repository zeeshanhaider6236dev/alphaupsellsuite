(function () {
        console.log('template_2')

        var shop_currency = "{{ $currency }}";
        /**
         * ============================================
         * Selectors for pick Quantity when target
         * product is adding to cart
         * ============================================
         */

         var pickQuantity = ['select[name="quantity"]','#quantity'];
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
         * Theme Checkout button selectors
         * ============================================
         *
         */

        const themeCheckoutBtn = ['#checkout','input[name="checkout"]','button[name="checkout"]','input[class="action_button right"]','button[class~="btn-checkout"]','div[class~="actions"] button[class~="btn"]','div[class~="cart-checkout-btn"] .no-mrg','a[class~=btn-checkout]'];
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
            console.log(addToCartProducts[0]);
            var target_product_img     = addToCartProducts[0].image.src
            var target_product_title   = addToCartProducts[0].title
            var target_product_id      = addToCartProducts[0].id
            // console.log(addToCartProducts);

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
            // add_to_cart_upsell_HTML = '<div id="alpha_upsell_m6_myModal6" class="alpha_upsell_m6_modal6"><div class="topalpha_popup"><div class="alpha_upsell_m6_modal-content alpha_upsell_m6_modal_6"><div class="alpha_upsell_m6_modal_6_head"><input type="hidden" class="alpha_item_qty alpha_target_product" ><h2><i class="material-icons">check</i> '+upsell.setting.alpha_atc_t1_heading+'  <span class="alpha_upsell_m6_close alpha_upsell_m6_c6" id="alpha_upsell_m6_myModal6"><i class="material-icons">clear</i></span></h2><div class="alpha_upsell_m6_head_item"><div class="alpha_upsell_m6_h_item_img"> <img src="'+target_product_img+'" product-id="'+target_product_id+'"></div><div class="alpha_upsell_m6_h_item_heading"><h3>'+target_product_title+'</h3></div><div class="alpha_upsell_m6_h_item_btn"><p>Total: <span class="alpha_t_product_price"></span></p> <button type="button" class="alpha_upsell_m6_h_item_btnstyle alpha_m6_checkout">'+upsell.setting.alpha_t2_checkout_btn+'</button></div></div></div><div class="alpha_upsell_m6_b_timer"><div class="alpha_upsell_m6_b_timer_head"><h2><p class="t2_deal_heading temp_2_deal_heading">'+upsell.setting.alpha_t2_deal_heading+'</p> <span class="t2_deal_discount temp_2_deal_heading">'+upsell.setting.alpha_t2_deal_span+'</span></h2></div><div class="alpha_upsell_m6_b_timer_time"><div class="alpha_upsell_m6_timer"><h4>'+upsell.setting.t2_timer_text+'</h4><div> <span class="alpha_upsell_m6_minutes" id="alpha_upsell_m6_minute"></span></div> <span class="mid_coln">: </span><div> <span class="alpha_upsell_m6_seconds" id="alpha_upsell_m6_second"></span></div><p id="alpha_upsell_m6_time-up"></p></div></div></div><div class="alpha_upsell_m6_modal_6_body">'
            // for(product of addToCartProducts)
            //     {
            //         if(skip_first_itration == 0)
            //         {
            //             skip_first_itration++
            //             continue;
            //         }
            //         else if(addToCartProducts.length>4 && skip_first_itration == 4 )
            //         {
            //             break
            //         }
            //         else
            //         {
            //             skip_first_itration++;
            //         add_to_cart_upsell_HTML +='<div class="alpha_upsell_m6_products"><div class="alpha_upsell_m6_p_img"> <img src="'+product.image.src+'" product-id="'+product.id+'"></div><div class="alpha_upsell_m6_p_heading"><h2>'+product.title+' <span><input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'"> <button type="button" class="alpha_upsell_m6_h_item_btnstyle alpha_upsell_m6_atc_btn">'+upsell.setting.alpha_t2_atc_btn_text+'</button></span></h2><p><span class="alpha_m6_product_t_price">$'+product.variants[0].price+' </span><span>'
            //         if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
            //         {
            //             add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
            //         }
            //         else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
            //         {
            //             add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
            //         }

            //         add_to_cart_upsell_HTML +='</span></p>'
            //         for(option of product.options)
            //         {
            //             if(option.values[0] != "Default Title")
            //             {
            //                 add_to_cart_upsell_HTML +='<select>'
            //                 for(value of option.values)
            //                 {
            //                     add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
            //                 }
            //                 add_to_cart_upsell_HTML +='</select>'
            //             }
            //         }
            //         add_to_cart_upsell_HTML +='</div></div>'
            //         }
            //     }

            // add_to_cart_upsell_HTML +='</div><div class="alpha_upsell_modal_6_footer"> <button type="button" class="alpha_m6_no_thnx_btn">'+upsell.setting.alpha_t2_no_thanks_btn+'</button></div></div></div></div>';

            // ---------------------------------------------New is below-------------------------------------------------

            add_to_cart_upsell_HTML = '<div class="reset-t2 aus-t2-main-container-wrapper"> <div class="reset-t2 aus-t2-main-container aus-t2-main-container-2"> <div class="reset-t2 aus-t2-top-part"> <div class="reset-t2 aus-t2-tp-1 aus-t2-tp-1-resp"> <div class="reset-t2 aus-t2-tick-emoji aus-t2-tick-emoji-resp"> &#10004; </div><div class="reset-t2 aus-t2-heading aus-t2-heading-resp"> '+upsell.setting.alpha_atc_t1_heading+'</div><div class="reset-t2 aus-t2-cross-btn aus-t2-cross-btn">&times;</div></div><div class="reset-t2 aus-t2-tp-2 aus-t2-tp-2-resp"> <div class="reset-t2 aus-tp-2-img-div aus-tp-2-img-div-resp "> <img class="reset-t2 aus-tp-2-img aus-tp-2-img-resp"src="'+target_product_img+'" alt="error loading image" product-id="'+target_product_id+'"> </div><div class="reset-t2 aus-tp-2-text-div aus-tp-2-text-div-resp"> <div class="reset-t2 aus-tp-2-title aus-tp-2-title-resp"> '+target_product_title+' </div></div><div class="reset-t2 aus-tp-2-right-div aus-tp-2-right-div-resp"> <div class="reset-t2 aus-tp-2-price-div aus-tp-2-price-div"> <div class="reset-t2 aus-total-tp-2 aus-total-tp-2-resp">Total: </div><div class="reset-t2 aus-tp-2-price-fig aus-tp-2-price-fig-resp"> $29 </div></div><div class="reset-t2 aus-tp-2-checkout-btn aus-tp-2-checkout-btn-resp "> '+upsell.setting.alpha_t2_checkout_btn+' </div></div></div></div><div class="reset-t2 aus-t2-mid-part aus-t2-mid-part-resp"> <div class="reset-t2 aus-t2-mp-1"> <div class="reset-t2 aus-t2-mp-text aus-t2-mp-text-resp"><div class="reset-t2 aus-mp-offer-percentage aus-mp-offer-percentage-resp"> '+upsell.setting.alpha_t2_deal_heading+'</div><br><div class="reset-t2 aus-t2-mp-text aus-t2-mp-text-resp"> '+upsell.setting.alpha_t2_deal_span+'</div></div></div><div class="reset-t2 aus-t2-mp-2"> <div class="reset-t2 aus-t2-timer"> <div class="reset-t2 aus-t2-timer-text aus-t2-timer-text-resp">Time Left</div><div class="reset-t2 aus-t2-timer-fig aus-t2-timer-fig-resp" id="alpha_upsell_m6_minute"> 09</div><div class="reset-t2 aus-t2-timer-colon  aus-t2-timer-colon-resp">:</div><div class="reset-t2 aus-t2-timer-fig aus-t2-timer-fig-resp" id="alpha_upsell_m6_second"> 12</div></div></div></div><div class="reset-t2 aus-t2-last-portion">'
            for(product of addToCartProducts){
                if(skip_first_itration == 0){
                    skip_first_itration++
                    continue;
                }
                else if(addToCartProducts.length>4 && skip_first_itration == 4 ){
                        break
                }
                else{
                    skip_first_itration++;
                    add_to_cart_upsell_HTML += '<div class="reset-t2 aus-t2-item-box aus-t2-item-box-resp"> <div class="reset-t2 aus-t2-last-portion-img-div aus-t2-last-portion-img-div-resp"> <img class="reset-t2 aus-t2-last-portion-img aus-t2-last-portion-img-resp" src="'+product.image.src+'" product-id="'+product.id+'" alt="error loading image"> </div><div class="reset-t2 aus-t2-lp-text-div aus-t2-lp-text-div-resp"> <div class="reset-t2 aus-t2-ib-title aus-t2-ib-title-resp">'+product.title+'</div><div class="reset-t2 aus-t2-lp-price-div"> <div class="reset-t2 aus-t2-lp-price-fig aus-t2-lp-price-fig-resp">'+shop_currency+product.variants[0].price+'</div><div class="reset-t2 aus-t2-lp-offer-badge aus-t2-lp-offer-badge-resp">'
                    if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
                    {
                        add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
                    }
                    else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
                    {
                        add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
                    }
                    add_to_cart_upsell_HTML += '</div></div><div class="reset-t2 aus-t2-lp-variant">'
                    for(option of product.options)
                    {
                        if(option.values[0] != "Default Title")
                        {
                            add_to_cart_upsell_HTML +='<select class="reset-t2 aus-t2-variant-selector aus-t2-variant-selector-resp " name="color" id="color">'
                            for(value of option.values)
                            {
                                add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
                            }
                            add_to_cart_upsell_HTML +='</select>'
                        }
                    }
                    add_to_cart_upsell_HTML +='</div></div><input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'"><div class="reset-t2 aus-t2-lp-atc-btn aus-t2-lp-atc-btn-resp">'+upsell.setting.alpha_t2_atc_btn_text+'</div></div>'

                }
            }
            add_to_cart_upsell_HTML += '</div><div class="reset-t2 aus-t2-footer"> <div class="reset-t2 aus-t2-footer-btn aus-t2-footer-btn-resp"> No, Thanks</div></div></div></div>'
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
                var target_images        = e.target.closest('div[class~=aus-t2-last-portion]').querySelectorAll('img');
                var target_image_id      = e.target.closest('div[class~=aus-t2-item-box]').querySelector('img').attributes["product-id"].value;
                var price_update_element = e.target.closest('div[class~=aus-t2-item-box').querySelector('.aus-t2-lp-price-fig');
                var variantID_update_element = e.target.closest('div[class~=aus-t2-item-box').querySelector('.alpha_target_product')
                console.log(variantID_update_element);
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
                if(e.target && e.target.classList.contains('aus-t2-lp-atc-btn')) //Add to Cart Button Working
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
                        alpha_upsell_ajax("/a/alphaUpsell/trackUpsell?id="+upsell.id+"",function(res){
                            if(res.status == true)
                            {
                                // location.href = location.origin+"/cart";
                                // location.origin+'/cart/'+e.target.previousElementSibling.value+':'+1+'?'+'discount'+'='+upsell.upsell_discounts[0].discount_code
                                removeSpinner(e.target, '<span class="aus-t2-lp-atc-btn"> <span>✓</span> <span style="margin-left: -9px;">✓</span></span>')
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
                else if(e.target && e.target.classList.contains('aus-tp-2-checkout-btn')) /*checkout button*/
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    CheckoutWithDicounts(e.target);
                }
                else if(e.target && e.target.classList.contains('aus-t2-footer-btn')) //No Thanks Button working
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    window.location.href = window.location.origin+'/cart'
                }
                else if(e.target && e.target.classList.contains('aus-t2-cross-btn'))
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    document.querySelector('.aus-t2-main-container-wrapper').style.display = "none";
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

                alpha_upsell_ajax("/a/alphaUpsell/create/discounts",function(res){
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
            element.innerHTML += '<div class="alpha-upsell-loader"></div>' ;
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

                    document.querySelector('.alpha_target_product').value = variant_id
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
                            alpha_upsell_ajax("/a/alphaUpsell/trackUpsell?id="+JSON.parse(sale_notification_object).upsellId+"",function(res){ });
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
                        document.querySelector('.aus-tp-2-price-fig-resp').innerText = shop_currency+target_product_varriant_price.toFixed(2);
                        //response ? document.querySelector('.alpha_upsell_m6_modal6').style.display = "block" : '';
                        if (response){
                        document.querySelector('.aus-t2-main-container-wrapper').style.display = "block"
                        document.body.style.overflow = "hidden"
                        }
                        //update View
                        var formData = new FormData();
                            formData.append('id'+[],upsell.id);
                        alpha_upsell_ajax("/a/alphaUpsell/count/view",function(res){
                            if(res.status == true){
                                console.log('increased');
                            }
                        },"POST",formData)
                        //update view code end
                    },'POST',alpha_fbt_upsell_cart_data,alpha_header);
                });
            }
        }

        /* include common JS */

        @include('upsell_designs.includes.js.pre_purchase.global_js.commonJS')

        // var deadline = new Date("july 30, 2021 15:37:25").getTime();
        // var x = setInterval(function() {
        //    var currentTime = new Date().getTime();
        //    var t = deadline - currentTime;
        //    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        //    var seconds = Math.floor((t % (1000 * 60)) / 1000);
        //    document.getElementById("alpha_upsell_m6_minute").innerHTML = minutes;
        //    document.getElementById("alpha_upsell_m6_second").innerHTML =seconds;
        //    if (t < 0) {
        //       clearInterval(x);
        //       // document.getElementById("alpha_upsell_m6_time-up").innerHTML = "TIME UP";
        //       document.getElementById("alpha_upsell_m6_minute").innerHTML ='00' ;
        //       document.getElementById("alpha_upsell_m6_second").innerHTML = '00';
        //    }
        // }, 1000);

        // console.log(upsell.setting)
        var time = upsell.setting.t2_time_duration*60;
        var tmp  = time;
        var total_time = setInterval(function(){
            var minutes = document.getElementById("alpha_upsell_m6_minute");
            var seconds = document.getElementById("alpha_upsell_m6_second");

            // console.log(minutes, seconds)

            var c = tmp--;
            var m = (c/60) >> 0;
            var s = (c-m*60)+'';

            minutes.innerHTML = (m.length > 1 ? '' : '0')+m;
            seconds.innerHTML = (s.length > 1 ? '' : '0')+s;
            tmp!=0||(tmp=time);
            if( m == 0 && s == 1){
                seconds.innerHTML = '00'
                clearInterval(total_time);
            }
        },1000);

    })();


    /*
     *
     * ============================================
     * append material design icon CDN
     * ============================================
     *
     */
     var materialIconLink = document.createElement('link');
     materialIconLink.setAttribute('rel','stylesheet')
     materialIconLink.setAttribute('href','https://fonts.googleapis.com/icon?family=Material+Icons')
     document.querySelector('head').appendChild(materialIconLink)
