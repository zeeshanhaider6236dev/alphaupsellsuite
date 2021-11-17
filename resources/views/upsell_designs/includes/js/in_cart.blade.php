

var app_URL = "{{ env('APP_URL') }}"

var getUpsell = {!! $upsell !!}
console.log(getUpsell.setting);

var currentShowingUpsellId  = "{{ $upsell_id }}";
var appear_on_handle        = "{{ $aProductHandle[0] }}";
var timer_duration          = "{{ $upsell->setting['time_duration_minutes'] }}";
var cart_button_text        = "{{ $upsell->setting['button_text'] }}";
var incart_title            = "{{ $upsell->setting['incart_heading'] }}";
var show_product_title      = "{{ $upsell->setting['show_product_title'] }}";
var show_variant_selection  = "{{ $upsell->setting['show_variant_selection'] }}";
var show_compare_price      = "{{ $upsell->setting['show_compare_price'] }}";
var appear_on_product       = products[appear_on_handle];
var product_image           = appear_on_product.image.src;
var title                   = (appear_on_product.title).toString();
var product_title           = alphaProductShortName(title,30);
var product_variants        = appear_on_product.variants;
        var in_cart_Html = '<div class="alpha_upsell_in_page_custom"><div class="alpha_upsell_in_page_design_inpage"><div class="alpha_upsell_in_page_p_upsell"><div class="alpha_upsell_in_page_timer_title"><p>'+incart_title+'</p></div>'
        if(getUpsell.setting.count_down_timer != 0){
            in_cart_Html += '<div class="alpha_upsell_in_page_timer"><input type="text" readonly class="minutes"><input type="text"  readonly class="seconds"></div>'
        }
        in_cart_Html += '<div class="alpha_upsell_in_page_in_page_product"><div class="alpha_upsell_in_page_upsell_img"><img src="'+product_image+'" alt="cream"></div>'
        if(show_product_title != 0){
            in_cart_Html+='<div class="alpha_upsell_in_page_upsell_title"><h4>'+product_title+'</h4>'
        }
        // console.log(product_variants[0].title)
        if(product_variants[0].title != "Default Title")
        {
            if(show_variant_selection != 0){
                in_cart_Html+='<select name="product_variants" class="product_variants">'
                 for(product_variant of product_variants){
                     var variant_id            = product_variant.id;
                     var variant_title         = product_variant.title;
                     var variant_price         = product_variant.price;
                     var variant_compare_price = product_variant.compare_at_price;
                     in_cart_Html+='<option value="'+variant_id+'">'+variant_title+'</option>'
                 }
            }
        }
        else
        {
            var variant_id         = product_variants[0].id;
            var variant_title         = product_variants[0].title;
            var variant_price         = product_variants[0].price;
            var variant_compare_price = product_variants[0].compare_at_price;
        }

        in_cart_Html+='<input type="hidden" id="alphaInCart_variant_id" value="'+product_variants[0].id+'"></select><p><span id="price" style="text-decoration:none!important;">'+alpha_upsell_currency_symbol+''+''+product_variants[0].price+'</span><span id="product_compare_price">'
        if(show_compare_price != 0 && product_variants[0].compare_at_price != 0){
            in_cart_Html+=alpha_upsell_currency_symbol+''+''+product_variants[0].compare_at_price
         }
        in_cart_Html+='</span></p><input type="button" value="'+cart_button_text+'" class="alpha_upsell_in_page_upsell_btn"></div></div></div></div>'

    //ajax cart selectors
    var ajax_cart_selectors = [
    // 'div[class="ajaxcart__row"]',
    'form[action="/cart"].ajaxcart .drawer__inner .ajaxcart__product .ajaxcart__row',
    'form[action="/cart"].ajaxcart .ajaxcart__product .ajaxcart__row',
    'div[id="ajaxifyCart"] form[action="/cart"].cart-form',
    'form[action="/cart"] .ajaxcart__row',
    // 'div[class="sp-modal-messages"]',
    'div[class~="sp-cart-list"]',
    'form[action="/checkout"]',
    'form[action="/cart"].cart',
    'form[action="/cart"]',
    'div[class~="cart__popup-item"]',
    ];

    //Incart upsell design added in ajax cart
    document.addEventListener("DOMNodeInserted",function (e) {
        for(var i=0; i<ajax_cart_selectors.length; i++){
            var cart_selector = document.querySelector(ajax_cart_selectors[i]);
            // console.log('DOMNodeInserted' ,',',cart_selector,',',e.target )
            if(cart_selector == e.target){
                addIncart()
                break;
            }
        }
    });


    function addIncart(){
        for(var i=0; i<ajax_cart_selectors.length; i++){
            var cart_selector = document.querySelectorAll(ajax_cart_selectors[i]);
            var count = 0;
            if(count == 1){
                break;
            }
            for(var i=0; i<cart_selector.length; i++){
                if(cart_selector[i].querySelector('.alpha_upsell_in_page_design_inpage') == null){
                     var alpha_upsell_incart = sessionStorage.getItem("alpha_upsell_incart");
                    if(!alpha_upsell_incart){
                            cart_selector[i].insertAdjacentHTML('afterbegin',in_cart_Html);
                    }
                }
                var alpha_upsell_incart_offer = sessionStorage.getItem("alpha_upsell_incart_timer");
                if(alpha_upsell_incart_offer){
                var all_design_inpage = document.querySelectorAll('.alpha_upsell_in_page_custom');
                    for(var j=0; j<all_design_inpage.length; j++){
                        all_design_inpage[j].remove();
                    }
                }
                count++;
                break;
            }

        }
    }

    var cart_page_selectors = [
        'div#slidedown-cart div.has-items ul.mini-products-list',
        'div.form-cart div.enj-minicart-ajax',
        'div#CartDrawer.drawer div#CartContainer',
        'div.cart-group-1 ul.drop-cart li.no-way',
        'div#CartContainer.list-product-mini ul.engoc_max_height',
        'div#cart form#cart-form',
        'div#cart div.cart',
        'div.same-style.cart-wrap div.shopping-cart-content ul.single-cart-item-loop',
        'div.js-minicart div.mini-cart-bottom.enj-minicart-ajax',
        'div.model-popup div.popup_cart.pu-cart div.popup_inner',
        'div#shopping-cart div.cont',
        'div.header-minicart div.minicart-wrap',
        'div.mcart div.mcart_panel',
        'div.dropdown-menu.shoppingcart-box',
        'div.pull-right.header-meta #CartContainer.noo-minicart',
        'div#modalAddToCart div.modal-content',
        'div.mega_drop_menu.mega_dropdown_nav_cart_v1',
        'div.header_account_area .header_account-list ul.ht-dropdown',
        'div#modalAddToCart div.modal-content',
        'div.header_account-list.mini_cart_wrapper ul.ht-dropdown.cart-box-width',
        'div.widget_shopping_cart_content ul.engo-w-products-list',
        'div.shopping-cart-wrap div.mini-cart ul.cart-item-loop',
        'div.pushmenu div.cart-list',
        'div.shopping-cart-wrap .mini-cart',
        'div.enj-minicart-ajax div.prod',
        'div.mini_cart_inner .inner-single-block',
        'div.mini-cart-wrap div.mini-cart-content',
        'div#nr-cart-header.nr-cart-header',
        'div.content_minicart div.bottom11.enj-minicart-ajax',
        'button.sp-dropdown-toggle+div.sp-dropdown-menu div.sp-cart-layout',
        'div.cart-empty-title+div.cart-content',
        'div.cart #CartContainer ul.list',
        'div.small-cart div.small-cart-item-wrapper.single-product-cart',
        'div.cart-inner div.engo-popup div.mini-product-item.clearfix',
        'div.cart-empty+div.mini_cart_header',
        'aside.aside-shop div.aside-shop-main.clearfix',
        'div.shp__cart__wrap div.single-product-cart',
        'h3.minicart-title+div.minicart-items-wrapper',
        'div.cartloading+div.cart-inner-content div.cart-content',
        'a.mini-cart-link+div#CartContainer',
        'div.sp-dropdown-menu div.sp-mobile-add+div.sp-dropdown-inner div.sp-cart-layout',
        'div#mini-cart div.mini-cartContent',
        'div#CartContainer ul.cart_list',
        'div.product-popup.engo-popup.cart-popup div.content',
        'div.child-content a.action-cart+div.minicart-content',
        'div.mfp-content div.gp-popup-addtocart#gp-popup-addtocart div.ajax_cart-popup',
        '.widget_shopping_cart.pr .widget_shopping_cart_content',
        '.header-r-cart li .mini-cart-content',
        'ul.mini-products-list li.whishlist-item',
        'div.header-cart-wrap .header-mini-cart .mini-cart-body.item-style',
        'div#modalAddToCart div.modal-dialog.white-modal .modal-body',
        'div.header-cart-content.js-minicart-content div.minicart-scroll.enj-minicart-ajax',
        'form[action="/cart"].ajaxcart .drawer__inner .ajaxcart__product .ajaxcart__row',
        'form[action="/cart"] div[class~="sp-shopcart-table-02"]',
        'div[class="cart_content_ajax"]',
        'form[id="cartform"]',
        'form[action="/cart"].cart-form .cart__table',
        'form[action="/cart"].cart-drawer .cart-drawer__header .cart-drawer__header-container .cart-drawer__content-container',
        'div[class="single-product-cart"]',
        'div[class="shopping-cart-content"]',
        '.relative .mini-content div.mini-cart-head+.enj-minicart-ajax',
        'ul[class="dropdown cart-box-width"]',
        'ol[class="mini-products-list"]',
        'div[class="shop-item"]',
        'div[id="slidedown-cart"]',
        'div[class="wrapper-top-cart"] .dropdown-cart .has-items .mini-products-list',
        'form[action="/cart"].Cart',
        'form[action="/cart"]#cart_form .section .cart_items',
        'form[action="/checkout"]#cart ul[id=mm-1]',
        'form[action="/cart"].cart',
        'form[action="/cart"].cart .cart__row',
        'div[class="cart-form"]',
        'form[action="/cart"] .table-responsive',
        'form[action="/cart"] div[class~="table-content"]',
        'div[class="table-responsive"]',
        'div[class="shopping__cart__inner"]',
        'div[class~="cart-popup-left"]',
        'div[class~="sp-cart-list"]',
        'div[class~="ajax-cart-desc"]',
        'div[class~="list-mini-cart-item"]',
        '#modalAddToCartProduct.modal div.modal-body',
        'div.mini-product-item.row',
        'div .enj-cartcost+div.cart-tab .mini-cart-product.enj-minicart-ajax',
        'div[class~=mini-product-item]',
        '.child-content .minicart-content.cart-slideout .minicart-dropdown-wrapper',
        '.cartloading+.cart-inner-content .cart-content',
        'li[class="cart_item"]',
        'div[class~="cart__popup-item"]',
        'ul[class~="dropdown-menu"] li table[class="table"]',
        'form[action="/cart"]',
        ];

        //Incart upsell design added in cart page
        for(var i=0; i<cart_page_selectors.length; i++){

            var  form_elements = document.querySelectorAll(cart_page_selectors[i]);
            for(var j=0; j<form_elements.length; j++){
                    var flag = true;
                    for(var k=0; k < cart_page_selectors.length; k++){
                        var parents = getParents(form_elements[j],cart_page_selectors[k]);
                        if(parents){
                            for(var l=0; l<parents.length; l++){
                               if(parents[l].querySelector('.alpha_upsell_in_page_design_inpage')){
                                    flag = false;
                                }
                            }
                        }

                    }
                    if(flag){
                        var alpha_upsell_incart = sessionStorage.getItem("alpha_upsell_incart");
                        if(!alpha_upsell_incart){
                                // console.log(form_elements[j], j)
                                form_elements[j].insertAdjacentHTML('afterbegin',in_cart_Html);
                                break;

                        }
                        var alpha_upsell_incart_offer = sessionStorage.getItem("alpha_upsell_incart_timer");
                        if(alpha_upsell_incart_offer){
                            var all_design_inpage = document.querySelectorAll('.alpha_upsell_in_page_custom');
                            for(var j=0; j<all_design_inpage.length; j++){
                                all_design_inpage[j].remove();
                            }
                        }
                    }
            }
        }
         function getParents(elem, selector) {
            if (!Element.prototype.matches) {
                Element.prototype.matches =
                    Element.prototype.matchesSelector ||
                    Element.prototype.mozMatchesSelector ||
                    Element.prototype.msMatchesSelector ||
                    Element.prototype.oMatchesSelector ||
                    Element.prototype.webkitMatchesSelector ||
                    function(s) {
                        var matches = (this.document || this.ownerDocument).querySelectorAll(s),i = matches.length;
                        while (--i >= 0 && matches.item(i) !== this) {}
                        return i > -1;
                    };
            }
            var parents = [];
            for ( ; elem && elem !== document; elem = elem.parentNode ) {
                if (selector) {
                    if (elem.matches(selector)) {
                        parents.push(elem);
                    }
                    continue;
                }
                parents.push(elem);
            }
            return parents;
        };
    //Incart upsell countdown timer
        var time = timer_duration*60;
        var tmp=time;
        var total_time = setInterval(function(){
            var minutes = document.querySelectorAll('.alpha_upsell_in_page_timer input[class="minutes"]');
            var seconds = document.querySelectorAll('.alpha_upsell_in_page_timer input[class="seconds"]');

            var c = tmp--;
            var m = (c/60)>>0;
            var s = (c-m*60)+'';
            for(var i=0; i<minutes.length; i++){
                for(var j=0; j<seconds.length; j++){
                   var test_min = minutes[i].setAttribute('value', m);
                   var test_sec = seconds[j].setAttribute('value', (s.length>1?'':'0')+s);
                    tmp!=0||(tmp=time);
                    if( m == 0 && s == 1){
                        sessionStorage.setItem("alpha_upsell_incart_timer", "offer_expire");
                        var alpha_upsell_incart_offer = sessionStorage.getItem("alpha_upsell_incart_timer");
                        if(alpha_upsell_incart_offer){
                            var all_design_inpage = document.querySelectorAll('.alpha_upsell_in_page_custom');
                            for(var k=0; k<all_design_inpage.length; k++){
                                all_design_inpage[k].remove();
                            }
                        }
                        clearInterval(total_time);
                    }
                }

            }
        },1000);

    var alpha_Incart_ATC = document.querySelector('.alpha_upsell_in_page_upsell_btn')


    document.addEventListener('click',function(e){
        if(e.target && e.target.classList.contains('alpha_upsell_in_page_upsell_btn'))
        {
            var add_to_cart_variantid = document.querySelector('#alphaInCart_variant_id').value;
            console.log(add_to_cart_variantid)
            if(e.target && e.target.classList.contains('alpha_upsell_in_page_upsell_btn')){
                var obj = {"id":add_to_cart_variantid, "quantity": 1, properties: {
                            '_alpha_upsell_id':currentShowingUpsellId,
                            }};
                var data = JSON.stringify(obj);
                var alpha_header = [
                    {
                        "Content-Type": "application/json"
                    }
                ];

            alpha_upsell_ajax("/cart/add.js",function(response){
                alpha_upsell_ajax("/a/alphaUpsell/trackUpsell?id="+currentShowingUpsellId+"",function(res){
                    if(res.status == true){
                        sessionStorage.setItem("alpha_upsell_incart", "alpha_upsell_in_page_design_inpage");
                        location.href = location.origin+"/cart";
                    }
                });
                // location.href = location.origin+"/cart";
            },'POST',data,alpha_header);

        }

        }
    });




    //add dropdown item in cart
    document.addEventListener('change', function(e){
        if(e.target && e.target.classList.contains('product_variants')){
            document.querySelector('#alphaInCart_variant_id').value =  e.target.value;

            var variants_id = e.target.value;
            var _variants = product_variants;
            for(appear_on_products in _variants)
            {
                var _variant_id = _variants[appear_on_products].id;
                if(variants_id == _variant_id)
                {
                    // document.querySelector('#alpha_variant_id').value =  _variant_id;
                    var add_to_cart_variant = _variant_id;
                    document.querySelector("#product_compare_price").innerText = ' ';
                    if(show_compare_price!=0 && _variants[appear_on_products].compare_at_price > _variants[appear_on_products].price){
                        document.querySelector("#product_compare_price").innerText = alpha_upsell_currency_symbol+_variants[appear_on_products].compare_at_price;

                    }
                    document.querySelector("#price").innerText = ' ';
                    document.querySelector("#price").innerText = alpha_upsell_currency_symbol+_variants[appear_on_products].price;

                    // var add_to_cart = document.querySelector('.alpha_upsell_in_page_upsell_btn');

                    // add_to_cart.addEventListener('click',function(e){
                    //     var obj = {"id":add_to_cart_variant, "quantity": 1, properties: {
                    //         '_alpha_upsell_id':currentShowingUpsellId
                    //         }};
                    //     var data = JSON.stringify(obj);
                    //     var alpha_header = [
                    //         {
                    //             "Content-Type": "application/json"
                    //         }
                    //     ]
                    //     alpha_upsell_ajax("/cart/add.js",function(response){
                    //         alpha_upsell_ajax(""+app_URL+"/trackUpsell?id="+currentShowingUpsellId+"",function(res){
                    //             if(res.status == true){
                    //                 sessionStorage.setItem("alpha_upsell_incart", "alpha_upsell_in_page_custom");
                    //                 location.href = location.origin+"/cart";
                    //             }
                    //         });
                    //     },'POST',data,alpha_header);
                    // });
                }
            }
        }
    });




