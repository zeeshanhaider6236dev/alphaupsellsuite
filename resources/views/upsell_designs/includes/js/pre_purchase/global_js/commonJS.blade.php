/*
 *===========================================================
 * targetElement = targetElement is element which is used 
 * to change the variant detail in popup box
 * 
 * targetImages : all images which are used in the upsell box
 *
 * targetImage  : it is image which is containing the ID of
 * current slected product variant
 *
 * priceUpdateSelector : where to update the the current 
 * variant price
 *
 * variantIdUpdateSelector : updated variant id in hidden field
 *===========================================================
 *
*/

function dynamicVariant(targetElement, targetImages, targetImageProductId, priceUpdateSelector, variantIdUpdateSelector, currency )
{
	var options           = targetElement.parentElement.querySelectorAll('select')
    var images            = targetImages;
    var query             = '';
    var product_id        = '';
    var variant_id        = ''; 
    var variant_price     = '';
    var variant_image_id  = '';
    var variant_image_src = '';
    var flag              = false;
    var flag1             = false;

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

    for(product of addToCartProducts)
    {
        if(product.id == targetImageProductId)
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
                    console.log('productID=',product_id,'variant_id=',variant_id,'variant_price=',variant_price,'variant_image_id',variant_image_id)
               }
           }
           if(flag)
           {
               break;
           }
        }
    }
    for(product of addToCartProducts)
    {
        if(product.id == targetImageProductId)
        {
            for(image of product.images)
            {
                if(image.variant_ids.length)
                {
                    for(variantID of image.variant_ids)
                    {
                      if(variantID == variant_id)
                        {
                          variant_image_src = image.src
                          flag1 = true;
                          break;   
                        }  
                    }
                }
            }
        }
        if (flag1) {
            break;
        }
    }
    for(image of images)
    {
        if (product_id == image.attributes["product-id"].value) {
            if(variant_image_src != '')
            {
                image.attributes['src'].value = variant_image_src;
            }
            priceUpdateSelector.innerText 	    = currency+variant_price+' '
            variantIdUpdateSelector.value 		= variant_id
            break;
        }
    }
}