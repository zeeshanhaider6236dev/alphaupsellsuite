
if(Shopify.checkout != undefined)
{
    var lineItems = Shopify.checkout.line_items
    var alpha_upsell_products_ids = []
    for(ids of lineItems)
    {
        alpha_upsell_products_ids.push(ids.product_id)
    }

    var alpha_upsell_data  = {
        'shop' : Shopify.shop,
        'products_ids' : alpha_upsell_products_ids
    }

    var upsells =  {};
    var products = {};
    alpha_upsell_ajax("https://"+Shopify.shop+"/a/alphaUpsell/getPostPurchaseData",function(response){
        if (response.status == true) {
            upsells = response.upsells
            upsell_handle_urls = response.upsell_handles.map(function(handle){
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
}





function alphaUpsellData(upsells)
{    
    for(upsell in upsells){
        var append_css = document.createElement('style');
        append_css.textContent = upsells[upsell]['css'];
        document.head.appendChild(append_css);
        var append_script = document.createElement('script');
        append_script.innerHTML = upsells[upsell]['js'];
        document.body.appendChild(append_script);
    }
}

/**
 * 
 * ----------------------------------
 * This fuction will give substring 
 * ----------------------------------
 */

// function alphaProductShortName(alpha_string, end_index) {
//     var str = alpha_string;
//     var alpha_res = str.substring(0, end_index);
//     return alpha_res+'....';
//   }

// var alpha_upsell_xhr = new XMLHttpRequest();
// var alpha_upsell_url = "https://mytestapp.cf/adnan/public/getData";
// var upsellHtmls =  {};
// alpha_upsell_xhr.open("POST", alpha_upsell_url, true);
// alpha_upsell_xhr.onreadystatechange = function() {
//     if (alpha_upsell_xhr.readyState === 4 && alpha_upsell_xhr.status === 200) {
//         var response = JSON.parse(this.responseText);
//         if (response.status == true) {
//             var upsells = response.upsells;
//             for(upsell in upsells){
//                 upsellHtmls[Object.values(upsell).join('')] = upsells[upsell]['html'];
//                 var append_css = document.createElement('style');
//                 append_css.textContent = upsells[upsell]['css'];
//                 document.head.appendChild(append_css);
//                 var append_script = document.createElement('script');
//                 append_script.innerHTML = upsells[upsell]['js'];
//                 document.body.appendChild(append_script);
//             }
//         }
//     }
// }
// alpha_upsell_xhr.send(createFormData(alpha_upsell_data));


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
    // console.log(data);
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
