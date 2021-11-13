(function () {
        console.log('template_4')

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
        // console.log(upsell.setting);
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
            var skip_first_itration  = 0;
            var alpha_active_product = true;
            var alpha_upsell_add_to_cart_selectors = ['button.product__add-to-cart-button','button.product-submit','button.single_add_to_cart_button','button.gt_button.gt_button--large','button.single_add_to_cart_button.single-product-add','div.mini-btn span.icon-shoppingcart','input.btn.add-to-cart-btn','button.btn--submit.js-add-to-card','a[class~=add-cart-btn]','button[class~=enj-add-to-cart-btn]', 'button[name="add"]', 'input[name="add"]', 'button[class~=add-to-cart-btn]', 'button[class~=product-form__cart-submit--small]', '#button-cart', 'button[class~=btn-addtocart]', '#AddToCartText', '#AddToCartText6643010142366', 'input[class~=atc]', 'input[class~=add-to-cart-button]', '#shopify_add_to_cart', 'a[class~=addtocart]', '#AddToCart', '#AddToCart-product-template', 'button[class~="btn--add-to-cart"]', 'button[class~="product-form__add-button"]', 'button[class~="ProductForm__AddToCart"]', 'button[data-action~="add-to-cart"]', '#AddToCart'];
            /**
             *
             * ========================================
             * Upsell HTML
             * ========================================
             *
             */
             // alpha_t4_targetProductTitle = alphaProductShortName(addToCartProducts[0].title,28)
             alpha_t4_targetProductTitle = addToCartProducts[0].title
            // add_to_cart_upsell_HTML = '<div id="alpha_upsell_m4_myModal4" class="alpha_upsell_m4_modal4"><div class="alpha_upsell_m4_modal-content alpha_upsell_m4_modal_4"><div class="alpha_upsell_m4_modal_4_head"><div> <span class="alpha_upsell_m4_close" id="alpha_upsell_m4_myModal4">&times;</span><div class="alpha-t4-timer-content"><div class="alpha_upsell_m4_b_timer4"><input type="hidden" class="alpha_item_qty alpha_target_product"><h4>'+upsell.setting.alpha_t4_timer_heading+'</h4></div><div class="alpha_upsell_m4_timer4"><div> <span class="alpha_upsell_m4_minutes4" id="alpha_upsell_m4_minute4"></span></div> <span class="alpha_time_seprator">:</span> <div> <span class="alpha_upsell_m4_seconds4" id="alpha_upsell_m4_second4"></span></div><p id="alpha_upsell_m4_time-up4"></p></div></div></div></div><div class="alpha_upsell_m4_top"><div class="alpha_upsell_m4_top_cart"><div class="alpha_upsell_m4_t1"> <i class="material-icons">done</i>'+alpha_t4_targetProductTitle+'</div><div class="alpha_upsell_m4_cart_p">  <span class="alpha_upsell_m4_t3"></span> </div></div></div><div class="alpha_upsell_m4_body"><h2>'+upsell.setting.alpha_t4_title_heading+'</h2><div class="alpha_upsell_m4_product_main">'
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
            //             if(alpha_active_product)
            //             {
            //                 skip_first_itration++
            //                 var product_title = alphaProductShortName(product.title,30);
            //                 add_to_cart_upsell_HTML +='<div class="alpha_upsell_m4_detail alpha_active_product"><div class="alpha_upsell_m4_p"><div class="alpha_upsell_m_4_img d-flex"> <img src="'+product.image.src+'" product-id="'+product.id+'"> </div><div class="alpha_upsell_m_4_img_detail"><h4>'+product_title+'</h4><p><span class="alpha_m4_product_t_price">$'+product.variants[0].price+' </span><span>'
            //                 if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
            //                 {
            //                     add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
            //                 }
            //                 else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
            //                 {
            //                     add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
            //                 }
            //                 add_to_cart_upsell_HTML +='</span></p>'

            //                 for(option of product.options)
            //                 {
            //                     if(option.values[0] != "Default Title")
            //                     {
            //                         add_to_cart_upsell_HTML +='<select>'
            //                         for(value of option.values)
            //                         {
            //                             add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
            //                         }
            //                         add_to_cart_upsell_HTML +='</select>'
            //                     }
            //                 }
            //                  add_to_cart_upsell_HTML +='<input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /> <button type="button" class="alpha_t4_atc_btn">'+upsell.setting.alpha_t4_atc_btn+'</button></div></div></div>'
            //                 alpha_active_product = false;
            //             }
            //             else
            //             {
            //                 skip_first_itration++
            //                 var product_title = alphaProductShortName(product.title,30);
            //                 add_to_cart_upsell_HTML +='<div class="alpha_upsell_m4_detail"><div class="alpha_upsell_m4_p"><div class="alpha_upsell_m_4_img d-flex"> <img src="'+product.image.src+'" product-id="'+product.id+'"> </div><div class="alpha_upsell_m_4_img_detail"><h4>'+product_title+'</h4><p><span class="alpha_m4_product_t_price">$'+product.variants[0].price+' </span><span>'
            //                 if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
            //                 {
            //                     add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
            //                 }
            //                 else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
            //                 {
            //                     add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
            //                 }
            //                 add_to_cart_upsell_HTML +='</span></p>'

            //                 for(option of product.options)
            //                 {
            //                     if(option.values[0] != "Default Title")
            //                     {
            //                         add_to_cart_upsell_HTML +='<select>'
            //                         for(value of option.values)
            //                         {
            //                             add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
            //                         }
            //                         add_to_cart_upsell_HTML +='</select>'
            //                     }
            //                 }
            //                  add_to_cart_upsell_HTML +='<input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /> <button type="button" class="alpha_t4_atc_btn">'+upsell.setting.alpha_t4_atc_btn+'</button></div></div></div>'
            //             }
            //             skip_first_itration++
            //             add_to_cart_upsell_HTML +='<div class="alpha_upsell_m4_detail"><div class="alpha_upsell_m4_p"><div class="alpha_upsell_m_4_img d-flex"> <img src="'+product.image.src+'" product-id="'+product.id+'"> </div><div class="alpha_upsell_m_4_img_detail"><h4>'+product.title+'</h4><p><span class="alpha_m4_product_t_price">$'+product.variants[0].price+' </span><span>'
            //             if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
            //             {
            //                 add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
            //             }
            //             else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
            //             {
            //                 add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
            //             }
            //             add_to_cart_upsell_HTML +='</span></p>'

            //             for(option of product.options)
            //             {
            //                 if(option.values[0] != "Default Title")
            //                 {
            //                     add_to_cart_upsell_HTML +='<select>'
            //                     for(value of option.values)
            //                     {
            //                         add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
            //                     }
            //                     add_to_cart_upsell_HTML +='</select>'
            //                 }
            //             }
            //              add_to_cart_upsell_HTML +='<input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /> <button type="button" class="alpha_t4_atc_btn">Get It Now</button></div></div></div>'
            //         }
            //     }
            //     add_to_cart_upsell_HTML +='</div><div class="alpha-slider-icon-container"><a class="alpha-slider-left  alpha-slider-icon" >❮</a><a class="alpha-slider-right alpha-slider-icon" >❯</a></div></div><div class="alpha_upsell_m4_footer"> <button type="button" class="alpha_upsell_m4_check">'+upsell.setting.alpha_t4_checkout_btn+'</button> <input type="button" value="'+upsell.setting.alpha_t4_no_thanks_btn+'" class="alpha_upsell_m4_thanks"></div></div></div>';

// ------------------------------------------------------------------------------------------------------------
            add_to_cart_upsell_HTML = '<div class="reset-t4 aus-t4-main-container-wrapper"><div class="reset-t4 aus-t4-main-container aus-t4-main-container-2"><div class="reset-t4 aus-t4-top-part"><div class="reset-t4 aus-t4-tp-timer"><div class="reset-t4 aus-t4-timer-text aus-t4-timer-text-resp">'+upsell.setting.alpha_t4_timer_heading+'</div><div class="reset-t4 aus-t4-timer-fig aus-t4-timer-fig-resp" id="alpha_upsell_m1_minute">09</div><div class="reset-t4 aus-t4-timer-colon aus-t4-timer-colon-resp">:</div><div class="reset-t4 aus-t4-timer-fig aus-t4-timer-fig-resp" id="alpha_upsell_m1_second">09</div></div><div class="reset-t4 aus-t4-cross-btn aus-t4-cross-btn-resp">&times;</div></div><div class="reset-t4 aus-t4-below-top aus-t4-below-top-resp"><div class="reset-t4 aus-t4-bt-tick-emoji aus-t4-bt-tick-emoji-resp">&#10004;</div><div class="reset-t4 aus-t4-bt-title aus-t4-bt-title-resp">'+alpha_t4_targetProductTitle+'</div><div class="reset-t4 aus-t4-bt-price aus-t4-bt-price-resp">$29.99</div></div><div class="reset-t4 aus-t4-last-portion aus-t4-last-portion-resp"><div class="reset-t4 aus-lp-heading aus-lp-heading-resp">Checkout These Items We Think You Would Love</div><div class="reset-t4 aus-lp-item-box-div aus-lp-item-box-div-resp">'
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
                skip_first_itration++
                add_to_cart_upsell_HTML +='<div class="aus-t4-item-box-wrapper"><div class="reset-t4 aus-lp-item-box aus-lp-item-box-resp aus-item-box-1"><div class="reset-t4 aus-lp-ib-img-div aus-lp-ib-img-div-resp"><img class="reset-t4 aus-lp-ib-img aus-lp-ib-img-resp" src="'+product.image.src+'" product-id="'+product.id+'" alt="Oops! error loading image"></div><div class="reset-t4 aus-t4-lp-ib-content-div aus-t4-lp-ib-content-div-resp"><div class="reset-t4 aus-t4-ib-title aus-t4-ib-title-resp">'+product.title+'</div><div class="reset-t4 aus-t4-ib-price-div aus-t4-ib-price-div-resp"><div class="reset-t4 aus-t4-price-fig aus-t4-price-fig-resp">'+shop_currency+product.variants[0].price+'</div><div class="reset-t4 aus-t4-price-offer-badge aus-t4-price-offer-badge-resp">'
                if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
                {
                    add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
                }
                else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
                {
                    add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
                }
                add_to_cart_upsell_HTML +='</div></div><div class="reset-t4 aus-t4-drop-down-div aus-t4-drop-down-div-resp">'
                for(option of product.options)
                {
                    if(option.values[0] != "Default Title")
                    {
                        add_to_cart_upsell_HTML +='<select class="reset-t4 aus-t4-drop-down aus-t4-drop-down-resp" name="color" id="color">'
                        for(value of option.values)
                        {
                            add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
                        }
                        add_to_cart_upsell_HTML +='</select>'
                    }
                }
                add_to_cart_upsell_HTML +='</div><input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'" /><div class="reset-t4 aus-t4-atc-btn aus-t4-atc-btn-resp">Get It Now</div></div></div></div>'
            }
        }
            add_to_cart_upsell_HTML +='<div class="aus-t4-arrow aus-t4-arrow-next aus-t4-arrow-resp">&#10095;</div><div class="aus-t4-arrow aus-t4-arrow-prev aus-t4-arrow-resp">&#10094;</div></div></div><div class="reset-t4 aus-t4-footer aus-t4-footer-resp"><div class="reset-t4 aus-t4-checkout-btn aus-t4-checkout-btn-resp">Checkout</div><div class="reset-t4 aus-t4-nts-btn aus-t4-nts-btn-resp">No,Thanks</div></div></div></div>'
            /**
             *
             * --------------------------------------------------------------------
             * Append active class to first element
             * --------------------------------------------------------------------
             *
             */
            setTimeout(()=>{
                document.querySelector('.aus-t4-item-box-wrapper').classList.add('aus-t4-active')
            },200);

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
                var target_images        = e.target.closest('div[class~=aus-t4-last-portion]').querySelectorAll('img');
                var target_image_id      = e.target.closest('div[class~=aus-lp-item-box]').querySelector('img').attributes["product-id"].value;
                var price_update_element = e.target.closest('div[class~=aus-lp-item-box').querySelector('.aus-t4-price-fig');
                var variantID_update_element = e.target.closest('div[class~=aus-lp-item-box').querySelector('.alpha_target_product')

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
                if(e.target && e.target.classList.contains('aus-t4-atc-btn')) //Add to Cart Button Working
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
                                removeSpinner(e.target,'<span class="aus-t4-atc-btn"> <span>✓</span> <span style="margin-left: -9px;">✓</span></span>')
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
                else if(e.target && e.target.classList.contains('aus-t4-checkout-btn')) /*checkout button*/
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    CheckoutWithDicounts(e.target);
                }
                else if(e.target && e.target.classList.contains('aus-t4-nts-btn')) //No Thanks Button working
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    window.location.href = window.location.origin+'/cart'
                }
                else if(e.target && e.target.classList.contains('aus-t4-cross-btn')) //Cross Button
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    document.querySelector('.aus-t4-main-container-wrapper').style.display = "none";
                    window.location.href = window.location.origin+'/cart'
                }
            });

        }
        /**  >------End function--------<  */

        /** -------------Timer---------------------- */
            // var deadline = new Date("july 31, 2022 15:37:25").getTime();
            // var x = setInterval(function() {
            //     var currentTime = new Date().getTime();
            //     var t = deadline - currentTime;
            //     var minutes4 = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            //     var seconds4 = Math.floor((t % (1000 * 60)) / 1000);
            //     document.getElementById("alpha_upsell_m4_minute4").innerHTML = minutes4;
            //     document.getElementById("alpha_upsell_m4_second4").innerHTML = seconds4;
            //     if (t < 0) {
            //         clearInterval(x);
            //         // document.getElementById("alpha_upsell_m4_time-up4").innerHTML = "TIME UP";
            //         document.getElementById("alpha_upsell_m4_minute4").innerHTML = '0';
            //         document.getElementById("alpha_upsell_m4_second4").innerHTML = '0';
            //     }
            // }, 1000);
            // var deadline = new Date("july 31, 2022 15:37:25").getTime();
            // var x = setInterval(function() {
            //     var currentTime = new Date().getTime();
            //     var t = deadline - currentTime;
            //     var minutes4 = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            //     var seconds4 = Math.floor((t % (1000 * 60)) / 1000);
            //     document.getElementById("alpha_upsell_m4_minute4").innerHTML = minutes4;
            //     document.getElementById("alpha_upsell_m4_second4").innerHTML = seconds4;
            //     if (t < 0) {
            //         clearInterval(x);
            //         // document.getElementById("alpha_upsell_m4_time-up4").innerHTML = "TIME UP";
            //         document.getElementById("alpha_upsell_m4_minute4").innerHTML = '0';
            //         document.getElementById("alpha_upsell_m4_second4").innerHTML = '0';
            //     }
            // }, 1000);

            var time = upsell.setting.alpha_t4_time_duration*60;
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
                console.log('tester is here')
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
                        document.querySelector('.aus-t4-bt-price').innerText = shop_currency +target_product_varriant_price.toFixed(2);
                        // response ? document.querySelector('.alpha_upsell_m4_modal4').style.display = "block" : '';
                        if(response)
                        {

                            // document.querySelector('.aus-t4-main-container-wrapper').style.display = "block"
                            document.querySelector('.aus-t4-main-container-wrapper').style.setProperty('display', 'block', 'important');

                            document.body.style.overflow = "hidden"
                        }
                        //update View
                        var formData = new FormData();
                            formData.append('id'+[],upsell.id);
                        alpha_upsell_ajax(proxy_url+"/count/view",function(res){
                            if(res.status == true){
                                // console.log('increased');
                            }
                        },"POST",formData)
                        //update view code end
                    },'POST',alpha_fbt_upsell_cart_data,alpha_header);
                });
            }
        }

        var var1=0;
        /* <------------Function for Next Products -----------> */
        function plusClick(){
           var targeted_products= document.getElementsByClassName('aus-t4-item-box-wrapper');
           for(var prodcut of targeted_products){
               if(prodcut.classList.contains('aus-t4-active')){
                   prodcut.classList.remove('aus-t4-active');
               }
           }
           var1 = (var1 +1)  %3
           targeted_products[var1].classList.add('aus-t4-active')
        }
        /* <------------Function For previous products -----------> */
        function minusClick(){
            var targeted_products= document.getElementsByClassName('aus-t4-item-box-wrapper');
            for(var prodcut of targeted_products){
                if(prodcut.classList.contains('aus-t4-active')){
                    prodcut.classList.remove('aus-t4-active');
                 //     var1 = (var1 + 1)%targeted_products.length
                 //    targeted_products[var1].classList.add('aus-t4-active')
                }
            }
            var mClick= targeted_products.length - 1;
            var1 = (var1 + mClick)  % 3
            targeted_products[var1].classList.add('aus-t4-active')
        }

        /*
         *
         * ============================================
         * Slide Images
         * ============================================
         *
         */
        setTimeout(()=>{
            document.querySelector('.aus-t4-arrow-next').addEventListener('click', function(){
                plusClick();
            });
            document.querySelector('.aus-t4-arrow-prev').addEventListener('click' , function(){
                minusClick();
            });
        },1000)


        /* include common JS */

        @include('upsell_designs.includes.js.pre_purchase.global_js.commonJS')

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

