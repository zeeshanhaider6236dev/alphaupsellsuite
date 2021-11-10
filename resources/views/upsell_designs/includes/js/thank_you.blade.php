(function(){

    var app_URL = "{{ env('APP_URL') }}"
    var shop_currency = "{{ $currency }}";
    /**
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     * blade response data, upsell return with view
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     */

    var upsell = {!! $upsell !!}
    var timer_duration = upsell.setting.timer_duration


    /**
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     * current post purchase upsell id
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     */
    var currentShowingUpsellId = "{{ $upsellId }}";
    var trackingUpsellid = JSON.stringify({id:currentShowingUpsellId })

    /**
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     * This variable storing all products of Post Purchase
     * Upsell
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     */

    var postPurchaseProducts = [];

    /**
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     * This variable storing all appear on products
     * of Post Purchase Upsell handles
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     */

    var fbtHandles = [
        @foreach($aProductHandle as $ppuHandles)
            "{{ $ppuHandles}}",
        @endforeach
    ];

    /**
     *
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     * Search all products by handle in products variable
     * for post purchase upsell.
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     *
     */

    for(const key in fbtHandles)
    {
        postPurchaseProducts.push(products[fbtHandles[key]]);
    }

    /**
     *
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     * Call to a createHtmlForPostPurchase function.
     * This function will create the HTML for Post
     * Purchase Upsell.
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     *
     */
    createHtmlForPostPurchase(postPurchaseProducts);

    /**
     *
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     *
     * createHtmlForPostPurchase function defination.
     *
     * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     *
     */

    function createHtmlForPostPurchase(postPurchaseProducts)
    {
        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * Define all selectors to show the upsell
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
        var post_purchase_location = ['div[class~="section"]'];

        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * Create HTML for Post Purchase Upsell
         * define variable post_purchase_HTML
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         */
         console.log(upsell.setting)
        var post_purchase_HTML = '<div class="alpha_ppu_container" id="alpha_ppu_container"><div class="design_inpage_post"><div class="top_head_post">'
        if (upsell.setting.time_limit_toggler) {
            post_purchase_HTML += '<div class="post_timer"><p>'+upsell.setting.thank_you_timer_text+'</p><span class="timer_titles">'+timer_duration+':00</span></div>'
        }
        post_purchase_HTML += '<h3>'+upsell.setting.ppu_heading+'</h3></div><div class="body_post"><div class="slideshow-container"><div class="mySlides"> '
        for(value of postPurchaseProducts)
        {
            post_purchase_HTML += '<div class="post alpha_ppu_display"> <div class="post_p"> <div class="post_img"> <img src="'+value.image.src+'" alt="image" product-id="'+value.id+'"> </div><div class="post_detail">'
            if(upsell.setting.show_ppu_product_title)
            {
                post_purchase_HTML += ' <h4>'+value.title+'</h4>'
            }
            post_purchase_HTML +='<p><span id="product-sale-price">'+shop_currency+value.variants[0].price+' </span>'
            if(upsell.setting.discount_price_option != "{{ config('upsell.strings.ppuDiscountType')[2] }}")
            {
                post_purchase_HTML +='<span>'
                if(upsell.setting.discount_price_option == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
                    {
                        post_purchase_HTML += upsell.setting.upsell_discount+upsell.setting.discount_price_option
                    }
                else if (upsell.setting.discount_price_option == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
                    {
                        post_purchase_HTML += '$'+upsell.setting.upsell_discount+' Off'
                    }
                post_purchase_HTML +='</span>'
            }

            post_purchase_HTML +='</p>'
            if(upsell.setting["show_ppu_varient_selection"])
            {
                for(option of value.options)
                {
                    if(option.values[0] != "Default Title")
                    {
                        post_purchase_HTML += '<select class="alpha_variant_options">'
                        for(val of option.values)
                        {
                            post_purchase_HTML +='<option value="'+val+'">'+val+'</option>'
                        }
                        post_purchase_HTML += '</select>'
                    }
                }
            }
            post_purchase_HTML += '<input type="hidden" value="'+value.variants[0].id+'" id="variant_id"><input type="button" class="alpha-reorder" value="'+upsell.setting.ppu_button_text+'"> </div></div></div>'
        }
            post_purchase_HTML += '</div><a class="prev">❮</a> <a class="next">❯</a> </div></div></div></div>'
        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * change image and price by changing the
         * variant.
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
            document.addEventListener('change',function(e){
                var options = e.target.parentElement.querySelectorAll('select')
                var query               = '';
                var product_id          = '';
                var variant_id          = '';
                var variant_price       = '';
                var variant_image_id    = '';
                var variant_image_src   = '';
                var images              = '';
                var flag    = false;
                var flag1   = false;

                for(var key = 0 ; key<options.length ; key++)
                {
                    if(key > 0)
                    {
                        query += ' / '+options[key].value
                    }
                    else
                    {
                        query += options[key].value
                    }
                }

                for(product of postPurchaseProducts)
                {
                   for(variant of product.variants)
                   {
                       if(query == variant.title)
                       {
                            product_id        = variant.product_id;
                            variant_id        = variant.id;
                            variant_price     = variant.price;
                            variant_image_id  = variant.image_id
                            flag = true;
                       }
                   }
                   if(flag)
                   {
                       break;
                   }
                }
                for(product of postPurchaseProducts)
                {
                    for(image of product.images)
                    {
                        if(variant_image_id == image.id)
                        {
                            variant_image_src = image.src
                            flag1 = true;
                        }
                    }
                    if (flag1) {
                        break;
                    }
                }

                images = document.querySelector('.mySlides').getElementsByTagName('img');
                for(image of images)
                {
                    if (product_id == image.attributes["product-id"].value) {
                        image.attributes['src'].value = variant_image_src;
                        image.parentElement.parentElement.querySelectorAll('span')[0].innerText = '$'+variant_price+' '
                        image.parentElement.parentElement.querySelectorAll('input')[0].value = variant_id
                        break;
                    }
                }
            });
        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * >------------Add to Cart Items--------------<
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
            document.addEventListener('click',function(e) {
                if(e.target && e.target.classList.contains('alpha-reorder'))
                {
                    alpha_upsell_ajax("/a/alphaUpsell/trackUpsell?id="+currentShowingUpsellId+"",function(res){
                        if(res.status == true)
                        {
                            var alpha_variant_id    = e.target.previousElementSibling.value;
                            var variant_quantity    = 1;
                            var alpha_discount_code = upsell.upsell_discounts[0].discount_code;
                            location.href = location.origin+'/'+'cart'+'/'+alpha_variant_id+':'+variant_quantity+'?'+'discount'+'='+alpha_discount_code;
                        }
                    });
                    // var alpha_variant_id    = e.target.previousElementSibling.value;
                    // var variant_quantity    = 1;
                    // var alpha_discount_code = upsell.upsell_discounts[0].discount_code;
                    // location.href = location.origin+'/'+'cart'+'/'+alpha_variant_id+':'+variant_quantity+'?'+'discount'+'='+alpha_discount_code;
                }
            });
        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * Append HTML to shopify store with selector
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
        document.querySelector('div[class~="section"]').insertAdjacentHTML('afterend',post_purchase_HTML);


        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * >--------Start Product slider code----------<
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */

        var alpha_upsell_length =postPurchaseProducts.length;
        var index  = 0;

        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * Called to showSlidePlus function to show
         * first 2 products.
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
        showSlidePlus();

        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * added event to slide between products by
         * clicking the left and right arrows.
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
        document.querySelector('.next').addEventListener('click',function(){
            showSlidePlus()
        });
        document.querySelector('.prev').addEventListener('click',function(){
            showSlidePrev()
        });


        // ----------------------------
        (function() {
            var min_horizontal_move = 30;
            var max_vertical_move = 30;
            var within_ms = 1000;

            var start_xPos;
            var start_yPos;
            var start_time;

            function touch_start(event) {
                start_xPos = event.touches[0].pageX;
                start_yPos = event.touches[0].pageY;
                start_time = new Date();
            }


            function touch_end(event) {
                var end_xPos = event.changedTouches[0].pageX;
                var end_yPos = event.changedTouches[0].pageY;
                var end_time = new Date();
                let move_x = end_xPos - start_xPos;
                let move_y = end_yPos - start_yPos;
                let elapsed_time = end_time - start_time;
                if (Math.abs(move_x) > min_horizontal_move && Math.abs(move_y) < max_vertical_move && elapsed_time < within_ms) {
                    if (move_x < 0) {
                        // alert("left");
                        showSlidePlus()
                    } else {
                        // alert("right");
                        showSlidePrev()
                    }
                }
            }

            var content = document.getElementById("alpha_ppu_container");
            content.addEventListener('touchstart', touch_start);
            content.addEventListener('touchend', touch_end);

        })();
        // ----------------------------






        if(alpha_upsell_length>2)
        {
            document.querySelector('.next').classList.add('alpha_ppu_active')

        }
		/**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * showSlidePlus function defination
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
        function showSlidePlus(start = null)
        {
            if(index>0)
                {
                    document.querySelector('.prev').classList.add('alpha_ppu_active')
                }
            if((index+1)%alpha_upsell_length)
                {
                    if(index+1 == alpha_upsell_length-1)
                        {
                            document.querySelector('.next').classList.remove('alpha_ppu_active')
                        }
                    var alpha_ppu_product = document.getElementsByClassName('alpha_ppu_display');
                    for(value of alpha_ppu_product)
                        {
                            if(value.classList.contains('alpha_ppu_active'));
                                {
                                    value.classList.remove('alpha_ppu_active');
                                }
                        }
                    alpha_ppu_product[index].classList.add("alpha_ppu_active");
                    alpha_ppu_product[(index+1)%alpha_upsell_length].classList.add("alpha_ppu_active");
                    index = (index+1)%alpha_upsell_length
                    // console.log('next index = '+(index-1)+','+index)
                }
            else
                {
                    var alpha_ppu_product = document.getElementsByClassName('alpha_ppu_display');
                    if(alpha_ppu_product[index].classList.contains("alpha_ppu_active"))
                        {
                            alpha_ppu_product[index].classList.remove("alpha_ppu_active");
                        }
                    alpha_ppu_product[index].classList.add("alpha_ppu_active");
                }
        }

        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * showSlidePrev function defination
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */

        function showSlidePrev()
        {
            if(index > 1)
            {
                var alpha_ppu_product = document.getElementsByClassName('alpha_ppu_display');
                for(value of alpha_ppu_product)
                    {
                        if(value.classList.contains('alpha_ppu_active'));
                        {
                            value.classList.remove('alpha_ppu_active');
                        }
                    }
                index = ((index+alpha_upsell_length) % alpha_upsell_length)-1;
                alpha_ppu_product[index].classList.add("alpha_ppu_active");
                alpha_ppu_product[index-1].classList.add("alpha_ppu_active");

                // console.log('prev index = '+(index-1)+','+(index))
                if(index == 1)
                {
                    document.querySelector('.next').classList.add('alpha_ppu_active')
                    document.querySelector('.prev').classList.remove('alpha_ppu_active')
                }
                else
                {
                    document.querySelector('.next').classList.add('alpha_ppu_active')
                }
            }
        }
        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * >-------------End Slider Code --------------<
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */

        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * >------------Start Count down --------------<
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
        if (upsell.setting.time_limit_toggler) {
            var time = timer_duration*60;
            var tmp  = time;
            var total_time = setInterval(function(){
                var r = document.querySelectorAll('.timer_titles');
                var c = tmp--;
                var m = (c/60)>>0;
                var s = (c-m*60)+'';
                for(var i=0; i<r.length; i++){
                    if(m<10)
                    {
                        r[i].innerHTML = '0'+m+':'+(s.length>1?'':'0')+s
                    }
                    else
                    {
                        r[i].innerHTML = m+':'+(s.length>1?'':'0')+s
                    }
                    tmp!=0||(tmp=time);
                    if( m == 0 && s == 1){
                        sessionStorage.setItem("alpha_upsell_ppu_timer", "offer_expire");
                        var alpha_upsell_incart_offer = sessionStorage.getItem("alpha_upsell_incart_timer");
                        if(alpha_upsell_incart_offer){
                            var all_design_inpage = document.querySelectorAll('.design_inpage');
                            for(var j=0; j<all_design_inpage.length; j++){
                                all_design_inpage[j].remove();
                            }
                        }
                        clearInterval(total_time);
                    }

                }
            },1000);
        }
    }




}())
