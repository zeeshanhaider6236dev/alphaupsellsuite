
(function (){
    var app_URL    = "{{ env('APP_URL') }}"
    var flag       = "{{ $addToCartFlag }}"

    console.log(flag,'flag value')

	new MutationObserver(function (mutationsList, observer) {
	    for (var mutation of mutationsList ) {
	        // console.log(mutation);  
	        if (mutation.type === 'childList') {
	            for (var node of mutation.addedNodes) {
	                if(node.nodeType == 1)
	                {
	                	// console.log(node)
		                elementArray = ['#checkout','input[name="checkout"]','button[name="checkout"]','input[class="action_button right"]','button[class~="btn-checkout"]','div[class~="actions"] button[class~="btn"]','div[class~="cart-checkout-btn"] .no-mrg','a[class~=btn-checkout]'];
	                	if(node != null)
	                	{
		                	for (var i = 0; i < elementArray.length; i++) {
	                			// node = node.querySelector(elementArray[i]);
	                			if(node != null && node.querySelector(elementArray[i]))
	                			{
	                			// console.log(node.querySelector(elementArray[i]))
			                        if (!node.classList.contains('upsellBtn')) {
			                        	var btnCopy = node.querySelector(elementArray[i]).cloneNode(true);
			                            btnCopy.classList.add('upsellBtn');
			                        	// console.log(btnCopy)
			                            node.querySelector(elementArray[i]).insertAdjacentElement('afterend', btnCopy);
			                            // btnCopy.addEventListener('click', InitiateCheckout, true);
			                            node.querySelector(elementArray[i]).remove();
			                            btnCopy.addEventListener('click',function(e){
			                            	CheckoutWithDicounts(e.target)
			                            });
			                        }
	                			}
		                	}
		                }
	                }
	            }
	        }
	    }
	}).observe(document, {
	    attributes: false,
	    childList: true,
	    subtree: true
	});
	
	
    const themeCheckoutBtn = ['#checkout','input[name="checkout"]','button[name="checkout"]','input[class="action_button right"]','button[class~="btn-checkout"]','div[class~="actions"] button[class~="btn"]','div[class~="cart-checkout-btn"] .no-mrg','a[class~=btn-checkout]','div[class~="cart-popup-action"] .btn-danger'];
    /*
     *
     * ============================================
     * Replace custom Checkout button with cart
     * checkout button
     * ============================================
     *
     */
     console.log(typeof(sessionStorage.getItem("discountRequestFlag")))
     // sessionStorage.getItem("discountRequestFlag");
    if(flag || sessionStorage.getItem("discountRequestFlag")!=undefined && sessionStorage.getItem("discountRequestFlag") != "false")
    {
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
    }
	/*
     *
     * ===========================================================
     * By Clicking Checkout button create discount
     * and redirect to checkout... (For Cart page checkout btn)
     * ===========================================================
     *
     */
     if(flag || sessionStorage.getItem("discountRequestFlag")!=undefined && sessionStorage.getItem("discountRequestFlag") != "false" )
     {
         document.addEventListener('click',function(e){
         	if(e.target && e.target.classList.contains('alpha_checkoutBtn'))
         	{
                 sessionStorage.setItem("discountRequestFlag", false);
         		 CheckoutWithDicounts(e.target);
         	}
         });
     }
    /*
     *
     * ============================================
     * CheckoutWithDicounts Definations
     * ============================================
     *
     */
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
                    'shop':window.location.host,
                }
                filter_items.push(filter_item_obj)
            }
            var alpha_data_for_discount = createFormData({'discounts':JSON.stringify(filter_items)})
            alpha_upsell_ajax(""+app_URL+"/create/discounts",function(res){
                if(res.status == true)
                {
                    target != null ? removeSpinner(target,'Checkout') :'';
                    window.location.href = res.checkout_url
                }
            },'POST',alpha_data_for_discount);
        },'POST');
    }
    /*
     *
     * ============================================
     * Replace checkout btn with custom checkout 
     * ============================================
     *
     */
    function replaceElement(target_element,classToAdd)
    {
        // const targetElement = document.querySelector(target_element)
        if(target_element != null)
        {
        	// console.log(target_element);
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

             //    urlParams.variant != undefined ? variant_id = urlParams.variant :  variant_id = addToCartProducts[0].variants[0].id; 
             //    //------------------------------------------------------------------------------
             //    if(document.querySelector('#quantity') != undefined)
             //    {
             //    	var targetProductQuantity = document.querySelector('#quantity').value;
             //    }
            	// else
            	// {
            	// 	targetProductQuantity = 1;
            	// }
                
             //    document.querySelector('.alpha_target_product').value = variant_id
             //    document.querySelector('.alpha_target_product').setAttribute('alpha_product_quantity',targetProductQuantity)
             //    var alpha_atc_object = [{
             //        "id":variant_id,
             //        "quantity":targetProductQuantity,
             //    }]
             //    var data = {
             //        items:alpha_atc_object
             //    };  
             //    var alpha_fbt_upsell_cart_data = JSON.stringify(data);
             //    var alpha_header = [
             //        {
             //            "Content-Type": "application/json"
             //        }
             //    ]
             //    alpha_upsell_ajax("/cart/add.js",function(response){
             //        var target_product_quantity    = response.items[0].quantity;
             //        var target_product_varriant_id = response.items[0].variant_id;
             //        for(variant of addToCartProducts[0].variants )
             //        {
             //            if (variant.id ==target_product_varriant_id ) {
             //                var target_product_varriant_price = target_product_quantity*variant.price;
             //                break;
             //            }
             //        }
             //        document.querySelector('.alpha_t_product_price').innerText = '$'+target_product_varriant_price;
             //        response ? document.querySelector('.alpha_upsell_m1_modal1').style.display = "block" : '';
             //    },'POST',alpha_fbt_upsell_cart_data,alpha_header);
            });
        }  
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
})();


