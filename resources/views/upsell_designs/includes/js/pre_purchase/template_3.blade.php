
    (function () {

        var shop_currency = "{{ $currency }}";

        console.log('template 3')
        /**
         * ============================================
         * Selectors for Quantity
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
        var upsell = {!! $upsell !!}
        var add_to_cart_upsell_HTML = ''

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
            var target_product_img     = addToCartProducts[0].image.src
            var target_product_title   = addToCartProducts[0].title
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
            var count = 0;

            add_to_cart_upsell_HTML = '<div class="reset-all aus-main-cont-wrapper"> <div class="aus-main-container"> <div class="reset-all aus-top-container top-container-resp">  <div class="reset-all aus-tick-emoji aus-tick-emoji-resp">&#10004;</div><div class="reset-all aus-thank-you-text thank-you-text-resp"><input type="hidden" class="alpha_item_qty alpha_target_product" >'+upsell.setting.alpha_t3_heading+'</div> <div class="reset-all aus-cross-btn aus-cross-btn-resp">&times;</div> </div><div class="reset-all aus-below-top below-top-resp"> <div class="reset-all aus-vertical-line"></div><div class="reset-all aus-bt-image-container aus-bt-image-container-resp"> <img class="reset-all aus-image-bt bt-image-resp" src="'+target_product_img+'" alt="error"> </div><div id="bt-2" class="reset-all aus-below-top-2 bt-2-resp"> <div class="reset-all bt-text-div text-div-resp"> <div class="aus-below-top-top-class"> <div class=" reset-all aus-item-added-text text-resp-item-added">'+target_product_title+' </div></div><div class="reset-all aus-price-cont aus-price-container-resp "> <div class="reset-all aus-price-text-bt price-cont-resp"></div><div class="reset-all aus-price-fig-bt price-cont-resp">()</div></div></div><div class="reset-all aus-btn-bt btn-div-resp"> <div class="reset-all aus-checkout-btn aus-checkout-btn-bt btn-resp">Checkout</div> </div></div></div><div class="reset-all aus-mid-portion mid-portion-resp"> <div class="reset-all aus-interested-text interested-text-resp">'+upsell.setting.alpha_t3_r_product_heading+'</div> <div class="reset-all aus-mid-portion-2 mid-portion-2-resp"> <div class="reset-all aus-endsoon-text"> '+upsell.setting.alpha_t3_timer_heaading+'</div><div class="reset-all aus-countdown aus-countdown-resp"> <div class="reset-all aus-timer-text" id="alpha_upsell_m1_minute">10</div><div class="reset-all aus-timer-colon">:</div><div class="reset-all aus-timer-text " id="alpha_upsell_m1_second">00</div></div></div></div><div class="reset-all aus-last-portion aus-lp-resp">'
            for(product of addToCartProducts){
                if(skip_first_itration == 0){
                    skip_first_itration++;
                    continue;
                }
                else{
                add_to_cart_upsell_HTML += '<div class="reset-all aus-item-box item-box-resp"> <div class="reset-all aus-item-box-1 aus-ib1-resp"> <img class="reset-all aus-item-image image-item-box" src="'+product.image.src+'" alt="error loading image" product-id="'+product.id+'"> </div><div class="reset-all aus-item-box-2 box-2-resp"> <div class="reset-all item-title box-2-resp"> '+product.title+'</div><div class="reset-all aus-price-offer box-2-resp"> <div class="reset-all"> <div class="reset-all aus-price-text box-2-resp">'+shop_currency+product.variants[0].price+'</div></div><div class="reset-all box-2-resp"> <div class="reset-all aus-offer-percentage box-2-resp">'
                if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}") {
                    add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
                }
                else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}"){
                    add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+'Off'
                }
                add_to_cart_upsell_HTML +='</div></div></div><div class="reset-all aus-drop-down drop-down-resp">'
                for(option of product.options)
                {
                    if(option.values[0] != "Default Title")
                    {
                        add_to_cart_upsell_HTML += '<select class="aus-drop-down-1 box-2-resp" name="aus-shoe-color" id="aus-shoe-color">'
                        for(val of option.values)
                        {
                            add_to_cart_upsell_HTML +='<option value="'+val+'">'+val+'</option>'
                        }
                        add_to_cart_upsell_HTML += '</select>'
                    }
                }
                add_to_cart_upsell_HTML +='</div><input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'"><button class="reset-all aus-atc-btn-ib btn-resp">'+upsell.setting.alpha_t3_atc_btn+'</button> </div></div>'
                }
            }
            add_to_cart_upsell_HTML +='</div><div class="reset-all aus-footer aus-footer-resp"> <button class="reset-all aus-nts-btn footer-btn-resp">'+upsell.setting.alpha_t3_no_thanks_btn+'</button> <button class="reset-all aus-checkout-btn-footer footer-btn-resp">'+upsell.setting.alpha_t3_checkout_btn+'</button> </div></div></div>'


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
                /* Creating Parameter for Function */

                var target_images        = e.target.closest('div[class~=aus-last-portion]').querySelectorAll('img');
                var target_image_id      = e.target.closest('div[class~=aus-item-box]').querySelector('img').attributes["product-id"].value;
                var price_update_element = e.target.closest('div[class~=aus-item-box').querySelector('.aus-price-text');
                var variantID_update_element = e.target.closest('div[class~=aus-item-box').querySelector('.alpha_target_product')
                console.log(variantID_update_element)

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
                if(e.target && e.target.classList.contains('aus-atc-btn-ib')) //Add to cart btn
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
                                removeSpinner(e.target, '<span class="aus-atc-btn-ib"> <span>✓</span> <span style="margin-left: -9px;">✓</span></span>')
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
                else if(e.target && e.target.classList.contains('aus-checkout-btn') || e.target.classList.contains('aus-checkout-btn-footer')) // checkout btn
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    CheckoutWithDicounts(e.target);
                }
                else if(e.target && e.target.classList.contains('aus-nts-btn')) //no thanks btn
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    window.location.href = window.location.origin+'/cart'
                }
                else if(e.target && e.target.classList.contains('aus-cross-btn')) // cross icon btn
                {
                    if(sale_notification_object != null)
                    {
                        sessionStorage.removeItem('sale_notification_object');
                    }
                    document.querySelector('.aus-main-cont-wrapper').style.display = "none";
                    window.location.href = window.location.origin+'/cart'
                }
            });

            /** aus-checkout-btn-footer
             *
             *================================
             * Timer
             *================================
             *
             */
            // var deadline = new Date("july 30, 2021 15:37:25").getTime();
            // var x = setInterval(function() {
            //     var currentTime = new Date().getTime();
            //     var t = deadline - currentTime;
            //     var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            //     var seconds = Math.floor((t % (1000 * 60)) / 1000);
            //     document.getElementById("alpha_upsell_m1_minute").innerHTML = minutes;
            //     document.getElementById("alpha_upsell_m1_second").innerHTML = seconds;
            //     if (t < 0) {
            //         clearInterval(x);
            //         document.getElementById("alpha_upsell_m1_time-up").innerHTML = "TIME UP";
            //         document.getElementById("alpha_upsell_m1_minute").innerHTML = '0';
            //         document.getElementById("alpha_upsell_m1_second").innerHTML = '0';
            //     }
            // }, 1000);

            var time = upsell.setting.alpha_t3_timer_duration*60;
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
            element.innerHTML += ' <div class="alpha-upsell-loader"></div>' ;
        }
        /* <------------Remove Spinner From Target Element -----------> */
        function removeSpinner(element,text = '')
        {
            element.innerHTML = ''
            element.innerHTML = text
            // element.disabled = true;
            element.style.cursor="not-allowed"
        }
        /* Genrate new copy of element with custom Class */
        function replaceElement(target_element,classToAdd)
        {
            // const targetElement = document.querySelector(target_element)
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
                        document.querySelector('.aus-price-fig-bt').innerText = shop_currency+target_product_varriant_price.toFixed(2);
                        // response ? document.querySelector('.aus-main-cont-wrapper').style.display = "block" : '';
                        if(response){
                            document.querySelector('.aus-main-cont-wrapper').style.display = "block"
                            document.body.style.overflow = "hidden"
                        }
                        //update View
                        var formData = new FormData();
                            formData.append('id'+[],upsell.id);
                        alpha_upsell_ajax("/a/alphaUpsell/count/view",function(res){
                            if(res.status == true){
                                // console.log('increased');
                            }
                        },"POST",formData)
                        //update view code end
                    },'POST',alpha_fbt_upsell_cart_data,alpha_header);
                });
            }
        }

        /* include common JS */

        @include('upsell_designs.includes.js.pre_purchase.global_js.commonJS')


    })();

