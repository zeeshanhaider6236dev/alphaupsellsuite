(function () {
        console.log('template_5')


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
            // add_to_cart_upsell_HTML = '<div id="alpha_upsell_m3_myModal3" class="alpha_upsell_m3_modal3"><div class="alpha_upsell_m3_modal-content alpha_upsell_m3_modal-3"><div class="alpha_upsell_m3_modal_3_head"><input type="hidden" class="alpha_item_qty alpha_target_product"><h2>'+upsell.setting.alpha_t5_timer_heading+'</h2> <span class="alpha_upsell_m3_close" id="alpha_upsell_m3_myModal3">&times;</span><div class="alpha_upsell_m3_timer"><span>Ends Soon:</span></span><div> <span class="alpha_upsell_m3_minutes" id="alpha_upsell_m3_minute"></span></div><div> <span class="alpha_upsell_m3_seconds" id="alpha_upsell_m3_second"></span></div><p id="alpha_upsell_m3_time-up"></p></div></div><div class="alpha_upsell_m3_m_3_top"><div class="alpha_upsell_m3_m_3_top_img"> <img src=proxy_url+"/assets/images/modal-3/m-3-cart.png" alt="cart"></div><div class="alpha_upsell_m3_m_3_top_price"><h4>Your Cart <span class="alpha_upsell_m5_t5"></span></h4></div></div><div class="alpha_upsell_m3_modal_3_body">'
            //  for(product of addToCartProducts)
            //  {
            //     if(skip_first_itration == 0)
            //     {
            //         skip_first_itration++
            //         continue;
            //     }
            //     else if(addToCartProducts.length > 4 && skip_first_itration == 4 )
            //     {
            //         break;
            //     }
            //     else
            //     {
            //         skip_first_itration++;
            //         add_to_cart_upsell_HTML += '<div class="alpha_upsell_m3_m_3_p"><div class="alpha_upsell_m3_m_3_p_img"> <img src="'+product.image.src+'" product-id="'+product.id+'"></div><div class="alpha_upsell_m3_m_3_p_detail"><div class="alpha_upsell_m3_m_3_name"><h3>'+product.title+' <span> '
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
            //         add_to_cart_upsell_HTML +=' <input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /><button type="button" class="alpha_t5_atc_btn">'+upsell.setting.alpha_t5_atc_btn+'</button> </span></h3><p><span class="alpha_m5_product_t_price">$'+product.variants[0].price+' </span><span>'
            //         if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
            //         {
            //             add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
            //         }
            //         else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
            //         {
            //             add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
            //         }

            //         add_to_cart_upsell_HTML +='</span></p></div></div></div>'
            //     }
            //  }
            // add_to_cart_upsell_HTML +='</div><div class="alpha_upsell_m3_modal_3_footer"> <button type="button" class="alpha_upsell_m3_m3_btn1">'+upsell.setting.alpha_t5_checkout_btn+'</button> <button type="button" class="alpha_upsell_m3_m3_btn2">'+upsell.setting.alpha_t5_no_thanks_btn+'</button></div></div></div>';



            // add_to_cart_upsell_HTML = '<div class="aus-main-container aus-all-reset"> <br/> <div class="aus-min-container aus-all-reset"> <div class="aus-main-head-time-icon aus-all-reset"> <div class="aus-min-head aus-all-reset"><h2 class="aus-my-h2 aus-all-reset">'+upsell.setting.alpha_t5_timer_heading+'</h2></div><div class="aus-min-time aus-all-reset"> <span class="aus-soon-min aus-all-reset">Ends Soon: </span><span class="aus-time-min aus-all-reset"> 05 </span><span class="aus-colun-min aus-all-reset"> : </span><span class="aus-time-min aus-all-reset"> 28 </span> </div><div class="aus-min-icon aus-all-reset"><i class="fa fa-times aus-all-reset aus-cross-icon"></i></div></div><div class="aus-min-cart aus-all-reset"> <i class="fa fa-cart-plus aus-all-reset"></i><span class="aus-your-cart aus-all-reset">Your&nbsp;Cart</span> <div class="aus-dollor-cart aus-all-reset"><span class="aus-dollor-cart-min aus-all-reset"></span></div></div>'
            //     for(product of addToCartProducts)
            //     {
            //         if(skip_first_itration == 0)
            //         {
            //             skip_first_itration++
            //             continue;
            //         }
            //         else if(addToCartProducts.length > 4 && skip_first_itration == 4 )
            //         {
            //             break;
            //         }
            //         else
            //         {
            //             skip_first_itration++;
            //             add_to_cart_upsell_HTML += '<div class="aus-item-main aus-all-reset"> <div class="aus-image-text-main aus-all-reset"> <div class="aus-min-img aus-all-reset"><img src="'+product.image.src+'" height="100%" width="100%" product-id="'+product.id+'"/></div><div class="aus-min-text aus-all-reset"> <p class="aus-min-para aus-all-reset">'+product.title+'</p><span class="aus-lower-dollor aus-all-reset">'+product.variants[0].price+' </span><small class="aus-off-btn-txt aus-all-reset">'
            //             if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
            //             {
            //                 add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
            //             }
            //             else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
            //             {
            //                 add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
            //             }
            //             add_to_cart_upsell_HTML +='</small> </div></div><div class="aus-select-main aus-all-reset">'
            //             for(option of product.options)
            //             {
            //                 if(option.values[0] != "Default Title")
            //                 {
            //                     add_to_cart_upsell_HTML +='<select class="aus-select-org aus-all-reset">'
            //                     for(value of option.values)
            //                     {
            //                         add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
            //                     }
            //                     add_to_cart_upsell_HTML +='</select> '
            //                 }
            //             }

            //             add_to_cart_upsell_HTML +='<input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /><button class="aus-addtocart-btn aus-all-reset">Add</button></div></div>'
            //         }
            //     }
            // add_to_cart_upsell_HTML +='<br/> <hr/><div class="aus-main-btns aus-all-reset"><button class="aus-checkout-btn-low aus-all-reset">Continue To Checkout</button><button class="aus-nothanks-btn-low aus-all-reset">No Thanks</button></div></div><br/></div>'
// =============================================================================================
            add_to_cart_upsell_HTML = '<div class="reset-t5 aus-t5-main-wrapper"> <div class="reset-t5 aus-t5-main-container aus-t5-main-container-2"> <div class="reset-t5 aus-t5-top-container aus-t5-top-container-resp"> <div class="reset-t5 aus-t5-tc-text aus-t5-tc-text-resp"><input type="hidden" class="alpha_item_qty alpha_target_product">'+upsell.setting.alpha_t5_timer_heading+' </div><div class="reset-t5 aus-t5-tc-countdown aus-t5-tc-countdown-resp"> <div class="reset-t5 aus-t5-timer-text aus-t5-timer-text-resp">Ends Soon:</div><div class="reset-t5 aus-t5-timer-fig aus-t5-timer-fig-resp" id="alpha_upsell_m1_minute">09</div><div class="reset-t5 aus-t5-timer-colon aus-t5-timer-colon-resp">:</div><div class="reset-t5 aus-t5-timer-fig aus-t5-timer-fig-resp" id="alpha_upsell_m1_second">00</div></div><div class="reset-t5 aus-t5-tc-cross-btn aus-t5-tc-cross-btn-resp">&times;</div></div><div class="reset-t5 aus-t5-mid-part"> <div class="reset-t5 aus-t5-mp-icon aus-t5-mp-icon-resp"> <div class="reset-t5 aus-t5-mp-tick-emoji aus-t5-mp-tick-emoji-resp">&#10004;</div> </div><div class="reset-t5 aus-t5-mp-cart-text aus-t5-mp-cart-text-resp">'+target_product_title+'</div><div class="reset-t5 aus-t5-mp-price aus-t5-mp-price-resp">$29.99</div></div><div class="reset-t5 aus-t5-last-portion">'
            for(product of addToCartProducts){
                if(skip_first_itration == 0)
                {
                    skip_first_itration++
                    continue;
                }
                else if(addToCartProducts.length > 4 && skip_first_itration == 4 )
                {
                    break;
                }
                else
                {
                    skip_first_itration++;
                    add_to_cart_upsell_HTML += '<div class="reset-t5 aus-t5-item-box aus-t5-item-box-resp"> <div class="reset-t5 aus-item-box-left-div"> <div class="reset-t5 aus-ib-img-div aus-ib-img-div-resp"> <img class="reset-t5 aus-ib-img" src="'+product.image.src+'" alt="error loadin image" product-id="'+product.id+'"> </div><div class="reset-t5 aus-t5-ib-content-div"> <div class="reset-t5 aus-t5-item-title aus-t5-item-title-resp">'+product.title+'</div><div class="reset-t5 aus-t5-ib-price-div"> <div class="reset-t5 aus-t5-ib-price-text aus-t5-ib-price-text-resp">'+shop_currency+product.variants[0].price+'</div><div class="reset-t5 aus-t5-ib-offer-badge aus-t5-ib-offer-badge-resp">'
                    if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
                    {
                        add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
                    }
                    else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
                    {
                        add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
                    }
                    add_to_cart_upsell_HTML+='</div></div></div></div><div class="reset-t5 aus-item-box-right-div aus-item-box-right-div-resp"> <div class="reset-t5 aus-t5-ib-drop-down-div">'
                    for(option of product.options)
                        {
                            if(option.values[0] != "Default Title")
                            {
                                add_to_cart_upsell_HTML +='<select class="reset-t5 aus-t5-ib-drop-down aus-t5-ib-drop-down-resp" name="color" id="color">'
                                for(value of option.values)
                                {
                                    add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
                                }
                                add_to_cart_upsell_HTML +='</select> '
                            }
                        }
                        add_to_cart_upsell_HTML +='</div><input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /><div class="reset-t5 aus-t5-ib-atc-btn aus-t5-ib-atc-btn-resp"> Add</div></div></div>'
                }
            }
            add_to_cart_upsell_HTML +='</div><div class="reset-t5 aus-t5-footer"> <div class="reset-t5 aus-t5-footer-checkout-btn aus-t5-footer-checkout-btn-resp"> Continue To Checkout </div><div class="reset-t5 aus-t5-footer-nts-btn aus-t5-footer-nts-btn-resp">No,Thanks</div></div></div></div>'

            /**
             *
             * --------------------------------------------------------------------
             * Add HTML before Body End
             * --------------------------------------------------------------------
             *
             */
             // console.log('code working')
            // document.body.style.overflow = "hidden"
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
            // document.addEventListener('change',function(e){
            //     var target_images        = e.target.closest('div[class~=alpha_upsell_m3_modal_3_body]').querySelectorAll('img');
            //     var target_image_id      = e.target.closest('div[class~=alpha_upsell_m3_m_3_p]').querySelector('img').attributes["product-id"].value;
            //     var price_update_element = e.target.closest('div[class~=alpha_upsell_m3_m_3_p').querySelector('.alpha_m5_product_t_price');
            //     var variantID_update_element = e.target.closest('div[class~=alpha_upsell_m3_m_3_p').querySelector('.alpha_target_product')
            //     // console.log(price_update_element);
            //     /* <-------Call function---------> */
            //     dynamicVariant(e.target, target_images, target_image_id, price_update_element, variantID_update_element)

            // });

            document.addEventListener('change',function(e){
                var target_images        = e.target.closest('div[class~=aus-t5-last-portion]').querySelectorAll('img');
                var target_image_id      = e.target.closest('div[class~=aus-t5-item-box]').querySelector('img').attributes["product-id"].value;
                var price_update_element = e.target.closest('div[class~=aus-t5-item-box').querySelector('.aus-t5-ib-price-text');
                var variantID_update_element = e.target.closest('div[class~=aus-t5-item-box').querySelector('.alpha_target_product')
                // console.log(price_update_element);
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
                if(e.target && e.target.classList.contains('aus-t5-ib-atc-btn')) //Add to Cart Button Working
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    sessionStorage.setItem("discountRequestFlag", true);
                    console.log(e.target)
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
                                removeSpinner(e.target, '<span class="aus-t5-ib-atc-btn"> <span>✓</span> <span style="margin-left: -9px;">✓</span></span>')
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
                else if(e.target && e.target.classList.contains('aus-t5-footer-checkout-btn')) /*checkout button*/
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    CheckoutWithDicounts(e.target);
                }
                else if(e.target && e.target.classList.contains('aus-t5-footer-nts-btn')) //No Thanks Button working
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    window.location.href = window.location.origin+'/cart'
                }
                else if(e.target && e.target.classList.contains('aus-t5-tc-cross-btn')) //Cross Button
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    // document.querySelector('.aus-main-container.aus-main-container').style.display = "none";
                    setProperty('aus-t5-main-wrapper', 'display','none' )
                    window.location.href = window.location.origin+'/cart'
                }
            });

        }
        /**  >------End function--------<  */

        /** -------------Timer---------------------- */
        // var deadline = new Date("july 30, 2021 15:37:25").getTime();
        //     var x = setInterval(function() {
        //         var currentTime = new Date().getTime();
        //         var t = deadline - currentTime;
        //         var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        //         var seconds = Math.floor((t % (1000 * 60)) / 1000);
        //         document.getElementById("alpha_upsell_m3_minute").innerHTML = minutes;
        //         document.getElementById("alpha_upsell_m3_second").innerHTML = seconds;
        //         if (t < 0) {
        //             clearInterval(x);
        //             document.getElementById("alpha_upsell_m3_time-up").innerHTML = "TIME UP";
        //             document.getElementById("alpha_upsell_m3_minute").innerHTML = '0';
        //             document.getElementById("alpha_upsell_m3_second").innerHTML = '0';
        //         }
        //     }, 1000);
        var time = upsell.setting.alpha_t5_time_duration*60;
        var tmp  = time;
        var total_time = setInterval(function(){
            var minutes = document.getElementById("alpha_upsell_m1_minute");
            var seconds = document.getElementById("alpha_upsell_m1_second");

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
                        document.querySelector('.aus-t5-mp-price').innerText = shop_currency+target_product_varriant_price.toFixed(2);
                        // response ? document.querySelector('.alpha_upsell_m3_modal3').style.display = "block" : '';

                        if(response)
                        {
                            document.body.style.overflow = "hidden"
                            // document.querySelector('.aus-main-container').style.display = "block"

                            setProperty('.aus-t5-main-wrapper','display','block')
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
