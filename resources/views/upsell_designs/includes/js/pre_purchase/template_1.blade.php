(function () {

    var shop_currency = "{{ $currency }}";
    var proxy_url = "{{ env('PROXY_URL')}}";
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
console.log(addToCartHandles)
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

/* Timer */

// var deadline = new Date("july 30, 2021 15:37:25").getTime();
// var x = setInterval(function () {
//     var currentTime = new Date().getTime();
//     var t = deadline - currentTime;
//     var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((t % (1000 * 60)) / 1000);
//     document.getElementById("alpha_upsell_m2_minute").innerHTML = minutes;
//     document.getElementById("alpha_upsell_m2_second").innerHTML = seconds;
//     if (t < 0) {
//         clearInterval(x);
//         // document.getElementById("alpha_upsell_m2_time-up").innerHTML = "TIME UP";
//         document.getElementById("alpha_upsell_m2_minute").innerHTML = '0';
//         document.getElementById("alpha_upsell_m2_second").innerHTML = '0';
//     }
// }, 1000);

var time = upsell.setting.time_duration_minutes*60;
var tmp  = time;
var total_time = setInterval(function(){
    var minutes = document.getElementById("aus-t1-timer-fig-minutes");
    var seconds = document.getElementById("aus-t1-timer-fig-seconds");

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
    // target_product_title = alphaProductShortName(target_product_title,28k)
    // add_to_cart_upsell_HTML = '<div id="alpha_upsell_m2_myModal2" class="alpha_upsell_m2_modal2"><div class="alpha_upsell_m2_modal-content alpha_upsell_m2_modal-2"><div class="alpha_upsell_m2_modal_2_head"><input type="hidden" class="alpha_item_qty alpha_target_product" ><h2 class="top-heading_title"><i class="material-icons">check</i><span class="top_heading_text"> '+upsell.setting.add_to_cart_heading+'</span> <span class="alpha_upsell_m2_close" id="alpha_upsell_m2_myModal2">&times;</span></h2></div><div class="alpha_upsell_m2_modal_2_body"><div class="alpha_upsell_m2_top_product"><div class="alpha_upsell_m2_top_p_img"> <img src="'+target_product_img+'" product-id="'+target_product_id+'"></div><div class="alpha_upsell_m2_top_p_detail"><h3>'+target_product_title+' <span>Total: <span class="alpha_t_product_price"></span></span></h3></table></div></div><div class="alpha_upsell_m2_b_timer"><div class="alpha_upsell_m2_b_timer_head"><h2>'+upsell.setting.time_offer_heading+'</h2><p></p></div><div class="alpha_upsell_m2_b_timer_time"><div class="alpha_upsell_m2_timer"><h4>'+upsell.setting.timer_text+'</h4><div class="alpha_m2_timer_content"> <span class="alpha_upsell_m2_minutes" id="alpha_upsell_m2_minute"></span></div> <span class="alpha_t2_timer_separator">:</span><div class="alpha_m2_timer_content"> <span class="alpha_upsell_m2_seconds" id="alpha_upsell_m2_second"></span></div><p id="alpha_upsell_m2_time-up"></p></div></div></div><div class="alpha_upsell_m2_m_2_products">'
    //         for(product of addToCartProducts)
    //         {
    //             // break;
    //             if(skip_first_itration == 0)
    //             {
    //                 skip_first_itration++
    //                 continue;
    //             }
    //             else if(addToCartProducts.length>4 && skip_first_itration == (addToCartProducts.length)-1 )
    //             {
    //                 break
    //             }
    //             else
    //             {
    //                 skip_first_itration++
    //                 var _product_title = alphaProductShortName(product.title,28)
    //                 add_to_cart_upsell_HTML +='<div class="alpha_upsell_m2_m2_p_main"><div class="alpha_upsell_m2_m2_p_box"><div class="alpha_upsell_m2_m2_img"> <img src="'+product.image.src+'" alt="dress" product-id="'+product.id+'"></div><div class="alpha_t1_content"><div class="alpha_upsell_m2_m2_detail"><h4>'+_product_title+'</h4><p><span class="alpha_upsell_m2_product_price">$'+product.variants[0].price+'</span> <span>'
    //                 if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
    //                 {
    //                     add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
    //                 }
    //                 else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
    //                 {
    //                     add_to_cart_upsell_HTML += '$'+upsell.setting.discount_value+' Off'
    //                 }
    //                 add_to_cart_upsell_HTML +='</span></p><form>'
    //                 for(option of product.options)
    //                 {
    //                     if(option.values[0] != "Default Title")
    //                     {
    //                         add_to_cart_upsell_HTML +='<select>'
    //                         for(value of option.values)
    //                         {
    //                             add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
    //                         }
    //                         add_to_cart_upsell_HTML +='</select> '
    //                     }
    //                 }

    //                 add_to_cart_upsell_HTML +='</form></div><input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'"><button type="button" class="alpha_upsell_m2_m_b_btn">'+upsell.setting.add_to_cart_text+'</button></div></div></div>'
    //             }
    //         }
    //         add_to_cart_upsell_HTML +='</div></div><div class="alpha_upsell_m2_modal_2_footer"> <button type="button" class="alpha_upsell_m2_m_2_btn_2">'+upsell.setting.checkout_button_text+'</button> <button type="button" class="alpha_upsell_m2_m_2_btn">'+upsell.setting.no_thanks_button_text+'</button></div></div></div>';

// ------------------------------------------------------------------------------------------------------------------------

    console.log(addToCartProducts.length)

    add_to_cart_upsell_HTML = '<div class="aus-t1-main-container-wrapper"> <div class="reset-t1 aus-t1-main-container aus-t1-main-container-2"> <div class="reset-t1 aus-t1-top-container"> <div class="reset-t1 aus-t1-top-container-content"> <div class="reset-t1 aus-t1-tick-emoji aus-t1-tick-emoji-resp"> &#10004;</div><div class="reset-t1 aus-t1-top-container-text aus-t1-top-container-text-resp"><input type="hidden" class="alpha_item_qty alpha_target_product" > '+upsell.setting.add_to_cart_heading+' </div><div class="reset-t1 aus-t1-cross-btn aus-t1-cross-btn-resp"> &times;</div></div></div><div class="reset-t1 aus-t1-below-top-container"> <div class="reset-t1 aus-t1-bt-img-div aus-t1-bt-img-div-resp"> <img class="reset-t1 aus-t1-bt-img aus-t1-bt-img-resp" src="'+target_product_img+'" alt="error loading image" product-id="'+target_product_id+'"> </div><div class="reset-t1 aus-t1-below-top-2"> <div class="reset-t1 aus-t1-below-top-2-content"> <div class="reset-t1 aus-t1-bt-2-title aus-t1-bt-2-title-resp"> '+target_product_title+' </div></div><div class="reset-t1 aus-bt-2-price-div"> <div class="reset-t1 aus-bt-2-total aus-bt-2-total-resp">Total:</div><div class="reset-t1 aus-bt-2-price-fig aus-bt-2-price-fig-resp"> $39.95</div></div></div></div><div class="reset-t1 aus-t1-below-top-line"></div><div class="reset-t1 aus-t1-mid-container"> <div class="reset-t1 aus-t1-mid-container-1"> <div class="reset-t2 aus-mid-container-text aus-mid-container-text-resp">Limited Time Offer</div></div><div class="rest-t1 aus-mid-container-2"> <div class="reset-t1 aus-t1-timer"> <div class="reset-t1 aus-t1-timer-text aus-t1-timer-text-resp">Time Left :</div><div class="reset-t1 aus-t1-timer-fig aus-t1-timer-fig-resp" id="aus-t1-timer-fig-minutes"> 09</div><div class="reset-t1 aus-t1-timer-colon aus-t1-timer-colon-resp">:</div><div class="reset-t1 aus-t1-timer-fig aus-t1-timer-fig-resp" id="aus-t1-timer-fig-seconds"> 00</div></div></div></div><div class="reset-t1 aus-t1-last-portion">'
    for(product of addToCartProducts){
        if(skip_first_itration == 0)
        {
            skip_first_itration++
            continue;
        }
        else if(addToCartProducts.length>4 && skip_first_itration == (addToCartProducts.length)-1 )
        {
            break
        }
        else{
            skip_first_itration++
            var _product_title = alphaProductShortName(product.title,28)
            add_to_cart_upsell_HTML += '<div class="reset-t1 aus-t1-item-box aus-t1-item-box-resp"> <div class="reset-t1 aus-t1-lp-img-div aus-t1-lp-img-div-resp"> <img class="reset-t1 aus-t1-lp-img aus-t1-lp-img-resp" src="'+product.image.src+'" alt="error loading image " product-id="'+product.id+'"> </div><div class="reset-t1 aus-t1-content-div aus-t1-content-div-resp"> <div class="reset-t1 aus-item-title aus-item-title-resp">'+product.title+'</div><div class="reset-t1 aus-ib-price-div"> <div class="reset-t1 aus-t1-ib-price aus-t1-ib-price-resp"> '+shop_currency+product.variants[0].price+'</div><div class="reset-t1 aus-t1-offer-badge aus-t1-offer-badge-resp">'
            if(upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[0] }}")
            {
                add_to_cart_upsell_HTML += upsell.setting.discount_value+upsell.setting.discount_type
            }
            else if (upsell.setting.discount_type == "{{ config('upsell.strings.ppuDiscountType')[1] }}")
            {
                add_to_cart_upsell_HTML += shop_currency+upsell.setting.discount_value+' Off'
            }
            add_to_cart_upsell_HTML += '</div></div><div class="reset-t1 aus-t1-drop-down-div">'
            for(option of product.options)
            {
                if(option.values[0] != "Default Title")
                {
                    add_to_cart_upsell_HTML +='<select class="reset-t1 aus-drop-down-t1 aus-drop-down-t1-resp" name="color" id="aus-color">'
                    for(value of option.values)
                    {
                        add_to_cart_upsell_HTML +='<option value="'+value+'">'+value+'</option>'
                    }
                    add_to_cart_upsell_HTML +='</select> '
                }
            }

            add_to_cart_upsell_HTML +='</div><input type="hidden" class="alpha_target_product" value="'+product.variants[0].id+'"><div class="reset-t1 aus-t1-atc-btn aus-t1-atc-btn-resp"> Add To Cart</div></div></div>'
        }

    }
    add_to_cart_upsell_HTML += '</div><div class="reset-t1 aus-t1-footer"> <div class="reset-t1 aus-t1-checkout-btn aus-t1-checkout-btn-resp">'+upsell.setting.checkout_button_text+'</div><div class="reset-t1 aus-t1-nts-btn aus-t1-nts-btn-resp">'+upsell.setting.no_thanks_button_text+'</div></div></div></div>'

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
        var target_images        = e.target.closest('div[class~=aus-t1-last-portion]').querySelectorAll('img');
        var target_image_id      = e.target.closest('div[class~=aus-t1-item-box]').querySelector('img').attributes["product-id"].value;
        var price_update_element = e.target.closest('div[class~=aus-t1-item-box').querySelector('.aus-t1-ib-price');
        var variantID_update_element = e.target.closest('div[class~=aus-t1-item-box').querySelector('.alpha_target_product')
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
        if(e.target && e.target.classList.contains('aus-t1-atc-btn')) //add to cart button
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
                        removeSpinner(e.target,'<span class="aus-t1-atc-btn"> <span>✓</span> <span style="margin-left: -9px;">✓</span></span>')
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
        else if(e.target && e.target.classList.contains('aus-t1-checkout-btn')) //chekcout btn
        {
            if(sale_notification_object != null)
            {
                sessionStorage.removeItem('sale_notification_object');
            }
            CheckoutWithDicounts(e.target);
        }
        else if(e.target && e.target.classList.contains('aus-t1-nts-btn'))
        {
            if(sale_notification_object != null)
            {
                sessionStorage.removeItem('sale_notification_object');
            }
            window.location.href = window.location.origin+'/cart'
        }
        else if(e.target && e.target.classList.contains('aus-t1-cross-btn')) //close upsell btn
        {
            if(sale_notification_object != null)
            {
                sessionStorage.removeItem('sale_notification_object');
            }
            document.querySelector('.aus-t1-main-container-wrapper').style.display = "none";
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
    console.log(element);
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
                document.querySelector('.aus-bt-2-price-fig-resp').innerText = shop_currency+target_product_varriant_price.toFixed(2);
                // response ? document.querySelector('.alpha_upsell_m2_modal2').style.display = "block" : '';
                if(response)
                {
                    document.querySelector('.aus-t1-main-container-wrapper').style.display = "block"
                    document.body.style.overflow = "hidden"
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





/* include common JS */
@include('upsell_designs.includes.js.pre_purchase.global_js.commonJS')
})();

