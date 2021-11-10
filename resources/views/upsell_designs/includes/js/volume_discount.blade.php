var app_URL = "{{ env('APP_URL') }}"

var currentShowingUpsellId = "{{ $upsell_id }}";
var targetted_handle       = "{{ $tProductHandle[0] }}";
var volume_discount_title  = "{{ $upsell->setting['volume_discount_heading'] }}";
var targetted_product      = products[targetted_handle];
var product_variants       = targetted_product.variants;
var product_image          = targetted_product.image.src;

var volume_discount_deals  = {!! $volume_discount_deals !!};

    var first_variant_id = '';
    var volume_discount_Html = '<div class="alpha_upsell_volume_custom"><div class="alpha_upsell_volume_live_p alpha_upsell_volume_pre_w">'+
    '<h2>'+volume_discount_title+'</h2>';
    for(discount_deals in volume_discount_deals){
    var quantity = volume_discount_deals[discount_deals].quantity;
    var discount = volume_discount_deals[discount_deals].discount;
    var discount_code = volume_discount_deals[discount_deals].discount_code;
    var discount_type = volume_discount_deals[discount_deals].discount_type;
    var best_deal = volume_discount_deals[discount_deals].best_deal;
    volume_discount_Html +='<div class="alpha_upsell_volume_volum_bg alpha_upsell_volume_volume_best" data-quantity="'+quantity+'" data-discount="'+discount_code+'">'+
      '<div class="alpha_upsell_volume_volume_img">'+
         '<img src="'+product_image+'" alt="bag">'+
      '</div>'+
      '<div class="alpha_upsell_volume_volume_head">'+
         '<h3>'+quantity+''+'   Quantities</h3>';
         if(best_deal == 1){
            volume_discount_Html +='<h4>Best Deal</h4>';
         }
      volume_discount_Html +='</div>';
      var count = 0;
      for(product_variant of product_variants){
            if(count == 0){
                 first_variant_id = product_variant.id;
                 var variant_price = product_variant.price;
            }
            if(discount_type == 'Fixed Amount'){
                var total_price = totalPrice(variant_price,quantity);
                var after_discount_price = usdDiscountPrice(variant_price, quantity, discount);
                if(count == 0){
                volume_discount_Html += '<div class="alpha_upsell_volume_volume_dis">'+
                 '<h5>'+alpha_upsell_currency_symbol+''+''+discount+'</h5>'+
                 '</div>';
                }
                 count++;
            }
            else if(discount_type == '% Off'){
                var total_price = totalPrice(variant_price,quantity)
                var after_discount_price = percentDiscountPrice(variant_price, quantity, discount);
                if(count == 0){
                volume_discount_Html += '<div class="alpha_upsell_volume_volume_dis">'+
                 '<h5>'+discount+' '+' '+discount_type+'</h5>'+
                '</div>';
                }
                count++;
            }
            else{
              var total_price = variant_price * quantity;
              volume_discount_Html += '<div class="alpha_upsell_volume_volume_dis">'+
                '<h5>'+discount+' '+' '+discount_type+'</h5>'+
                '</div>';
            }
        }

      volume_discount_Html +='<div class="alpha_upsell_volume_disc_price">'+
         '<h2 class="after_discount_price">'+alpha_upsell_currency_symbol+''+''+after_discount_price.toFixed(2)+'</h2>'+
         '<p class="total_price">'+alpha_upsell_currency_symbol+''+''+total_price.toFixed(2)+'</p>'+
      '</div>'+
   '</div>';

}
volume_discount_Html +='</div></div>';

cart_selectors  = ['div[class~="clearfix"].error-message','ul[class~="product-meta-info"]',
'form[id~="form_buy"]','div[class~="pro-details-action"]','div[class~="single-product-button-group"]','form[id~="AddToCartForm"]',
,'#addToCart-product-template', 'button[id~="AddToCart"]','form[action="/cart/add"]','div[class~="product-detail"]','#AddToCart-product-template','#AddToCart--product-template','button[name="add"]','button[class~="btn--add-to-cart"]'
];

for(value of cart_selectors) {
    if(document.querySelector(value) !=null ){
        console.log(value)
        document.querySelector(value).insertAdjacentHTML('afterend',volume_discount_Html);
        break;
    }
}


var add_to_cart_variant = '';
document.addEventListener('change', function() {
    var total_prices = new Array();
    var variant_discount_prices = new Array();
    var current_variant        = window.location.href;
    var url = new URL(current_variant);
    var current_variant_id     = url.searchParams.get("variant");
    for(discount_deals in volume_discount_deals){
        var quantity = volume_discount_deals[discount_deals].quantity;
        var discount = volume_discount_deals[discount_deals].discount;
        discount_code = volume_discount_deals[discount_deals].discount_code;
        var discount_type = volume_discount_deals[discount_deals].discount_type;
            for(product_variant of product_variants){
            var variant_id = product_variant.id;
                if(variant_id == current_variant_id){
                    add_to_cart_variant = variant_id;
                    var variant_price = product_variant.price;
                    var all_total_prices = document.querySelectorAll(".total_price");
                    if(discount_type == 'Fixed Amount'){
                        var tPrice = totalPrice(variant_price,quantity);
                        total_prices.push(tPrice);
                        for(const [i, variant_total_price] of all_total_prices.entries()){
                            for(const [j, current_variant_price] of total_prices.entries()){
                                if(i == j){
                                    variant_total_price.innerText = ' ';
                                    variant_total_price.innerText = alpha_upsell_currency_symbol+current_variant_price.toFixed(2);
                                }
                            }

                        }
                        var all_discount_prices = document.querySelectorAll(".after_discount_price");
                        var after_discount_price = usdDiscountPrice(variant_price, quantity, discount);
                        variant_discount_prices.push(after_discount_price);
                        for(const [k, variant_discount_price] of all_discount_prices.entries()){
                            for(const [l, current_variant_discount] of variant_discount_prices.entries()){
                                if(k == l){
                                    variant_discount_price.innerText = ' ';
                                    variant_discount_price.innerText = alpha_upsell_currency_symbol+current_variant_discount.toFixed(2);
                                    console.log('fixed')
                                }
                            }

                        }
                    }
                    if(discount_type == '% Off'){
                        var tPrice = totalPrice(variant_price,quantity);
                        total_prices.push(tPrice);
                        for(const [i, variant_total_price] of all_total_prices.entries()){
                            for(const [j, current_variant_price] of total_prices.entries()){
                                if(i == j){
                                    variant_total_price.innerText = ' ';
                                    variant_total_price.innerText = alpha_upsell_currency_symbol+current_variant_price.toFixed(2);
                                }
                            }

                        }
                        var all_discount_prices = document.querySelectorAll(".after_discount_price");
                        var after_discount_price = percentDiscountPrice(variant_price, quantity, discount);
                        variant_discount_prices.push(after_discount_price);
                        for(const [k, variant_discount_price] of all_discount_prices.entries()){
                            for(const [l, current_variant_discount] of variant_discount_prices.entries()){
                                if(k == l){
                                    console.log('% off')
                                    variant_discount_price.innerText = ' ';
                                    variant_discount_price.innerText = alpha_upsell_currency_symbol+current_variant_discount.toFixed(2);
                                }
                            }

                        }
                    }

                }
            }
    }

});

var add_to_cart = document.querySelectorAll('.alpha_upsell_volume_volum_bg');
var i;
for (i = 0; i < add_to_cart.length; i++) {
    add_to_cart[i].addEventListener('click',function(e){
        alpha_upsell_ajax("/a/alphaUpsell/trackUpsell?id="+currentShowingUpsellId+"",function(res){
            if(res.status == true){
            }
        });

        var variant_quantity  = e.target.closest('.alpha_upsell_volume_volum_bg').getAttribute("data-quantity");
        var discount_coupon    = e.target.closest('.alpha_upsell_volume_volum_bg').getAttribute("data-discount");
        if(add_to_cart_variant){
            var obj = {"id":add_to_cart_variant, "quantity": variant_quantity, properties: {
                '_alpha_upsell_id':currentShowingUpsellId }};
        }
        else{
            var obj = {"id":first_variant_id, "quantity": variant_quantity, properties: {
                                '_alpha_upsell_id':currentShowingUpsellId }};    }
        var cart_object = JSON.stringify(obj);
        var alpha_header = [
                        {
                            "Content-Type": "application/json"
                        }
                    ];
        if(add_to_cart_variant && cart_object)
        {
            if(cart_object)
            {
                location.href = location.origin+'/'+'cart'+'/'+add_to_cart_variant+':'+variant_quantity+'?'+'discount'+'='+discount_coupon;
            }
        }
        else
        {
            if(cart_object){
                location.href = location.origin+'/'+'cart'+'/'+first_variant_id+':'+variant_quantity+'?'+'discount'+'='+discount_coupon;
            }
        }

    });
}


function totalPrice(variant_price, quantity){
    total_price = variant_price * quantity;
    return total_price;
}

function usdDiscountPrice(variant_price, quantity, discount){
    var after_discount_price = (variant_price * quantity) - discount;
    return after_discount_price;
}

function percentDiscountPrice(variant_price, quantity, discount){
    var after_discount_price = (discount/100) * (variant_price * quantity);
    var final_price = (variant_price * quantity) - after_discount_price;
    return final_price;
}









