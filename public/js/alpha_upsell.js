

// var app_URL = "https://alphaupsellsuite.com"

    var alpha_upsell_data = {
        'shop' : Shopify.shop,
        'product_ids' : alpha_upsell_product_ids,
        'collection_ids' : alpha_upsell_collectionsIds,
        'tags' : alpha_upsell_tags
    };
    if(typeof alpha_upsell_productId != "undefined"){
        alpha_upsell_data.product_id = alpha_upsell_productId;
        alpha_upsell_data.product_collection_ids = alpha_upsell_product_collection_ids;
        alpha_upsell_data.product_tags = alpha_upsell_product_tags;
    }


    var upsells         = {};
    var products        = {};
    var checkoutData    = {};
    var store_currency  = '';
    // console.log(Shopify.shop);
    alpha_upsell_ajax("/a/alphaUpsell",function(response){
        if (response.status == true) {
            store_currency = response.currency;
            // console.log(store_currency);
            upsells = response.upsells
            checkoutData = response.checkOutJs
            if(checkoutData != false)
            {
                checkoutScript(checkoutData)
            }
            // console.log(Object.values(response.upsell_handles))
            // console.log(Array.isArray(response.upsell_handles))
            if(Array.isArray(response.upsell_handles))
            {
                var upsell_handles = response.upsell_handles;
            }
            else
            {
                var upsell_handles = Object.values(response.upsell_handles);
            }

            upsell_handle_urls = upsell_handles.map(function(handle){
                return location.origin+"/products/"+handle+".json";
            })
            for(var i = 0; i<upsell_handle_urls.length; i++)
            {
                alpha_upsell_ajax(upsell_handle_urls[i],function(res){
                    if(res.hasOwnProperty('product')){
                        products[res.product.handle] = res.product
                    }
                });
            }
            var interval = setInterval(function()
            {
                if(upsell_handle_urls.length == Object.keys(products).length){
                    clearInterval(interval);
                    alphaUpsellData(upsells)
                }
            }, 100);
        }
    },'POST',createFormData(alpha_upsell_data));

    function checkoutScript(checkoutScript)
    {
        var append_script = document.createElement('script');
        append_script.type = "text/javascript";
        append_script.innerHTML = checkoutScript;

        document.body.appendChild(append_script);
    }
    function alphaUpsellData(upsells)
    {
        // console.log(upsells)
        for(upsell in upsells){
            var append_css          = document.createElement('style');
            append_css.textContent  = upsells[upsell]['css'];
            document.head.appendChild(append_css);
            var append_script       = document.createElement('script');
            append_script.innerHTML = upsells[upsell]['js'];
            document.head.appendChild(append_script);
        }
    }



/**
 *
 * ----------------------------------
 * This fuction will give substring
 * ----------------------------------
 */

    function alphaProductShortName(alpha_string, end_index) {
        var str = alpha_string;
        if(str.length > end_index)
        {
            var alpha_res = str.substring(0, end_index);
            return alpha_res+'..';
        }
        else
        {
            return str;

        }
    }


    var elementArray = [
        'span[class~=sprite-add-to-cart]',
        '.ajax-spin-cart',
        'button.shop-button.enj-add-to-cart-btn',
        'input[id="AddToCart-product-template"]',
        'button[class~="ProductForm__AddToCart"]',
        'button[class~="product__add-to-cart"]',
        'button[class~="shopify_add_to_cart"]',
        'button[class~="product-form__cart-submit"]',
        'input[class~="add-to-cart-button"]',
        'button[class~="btn-addtocart"]',
        'input[class="atc"]',
        'input[name="add"]',
        'button[name="add"]',
        'button span[class="text"]',
        'button span[class~="bt__text"]',
        'button[class~=enj-add-to-cart-btn]',
        'button[name="add"]',
        'input[name="add"]',
        'button[class~=add-to-cart-btn]',
        'button[class~=product-form__cart-submit--small]',
        '#button-cart',
        'button[class~=btn-addtocart]',
        '#AddToCartText',
        '#AddToCartText6643010142366',
        'input[class~=atc]',
        'input[class~=add-to-cart-button]',
        '#shopify_add_to_cart','a[class~=addtocart]',
        '#AddToCart',
        '#AddToCart-product-template',
        'button[class~="btn--add-to-cart"]',
        'button[class~="product-form__add-button"]',
        'button[class~="ProductForm__AddToCart "]',
        'button[data-action~="add-to-cart"]',
    ];

    // console.log(elementArray)

    // if(typeof alpha_upsell_productId != "undefined")
    // {
    //     var elementArray1 = ['span[id="AddToCartText-'+alpha_upsell_productId+'"]'];
    //     elementArray  = elementArray1.concat(elementArray)
    // }


    for(var i=0; i<elementArray.length; i++){
        // console.log(elementArray[i])
        var cart_button = document.querySelector(elementArray[i]);
        if(cart_button != null){
            document.querySelector(elementArray[i]).addEventListener('click',function(e){
                // console.log(e.target , cart_button)
                // if(e.target == cart_button){
                    // console.log(e.target)
                   // if(alpha_upsell_cart == 0){
                        alpha_upsell_ajax("/a/alphaUpsell/getIncartData",function(response){
                            if (response.status == true) {
                                upsell_handle_urls = response.upsell_handles;
                                var upsell_handle_json = location.origin+"/products/"+upsell_handle_urls+".json";
                                alpha_upsell_ajax(upsell_handle_json,function(res){
                                    if(res.hasOwnProperty('product')){
                                        products[res.product.handle] = res.product
                                        alphaUpsellData(response.upsells)
                                    }
                                });
                            }
                        },'POST',createFormData(alpha_upsell_data));
                    // }
                // }
            });
            break;
        }
    }

    function createFormData(data){
            var formData = new FormData();
            for ( var key in data ) {
                // console.log(data[key].length);
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
            // console.log(data);
            return formData;
    }

    function alpha_upsell_ajax(url,callback = null,method = 'GET',data = {}, headers = []){
        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        if(headers.length)
        {
            for(header of headers)
            {
                for(key in header)
                {
                    xhr.setRequestHeader(key, header[key]);
                }
            }
        }
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(this.responseText);
                if(callback){
                    callback(response);
                }
            }
        }
        xhr.send(data);
    }
