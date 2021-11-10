<?php

namespace App\Http\Traits;


trait ShopifyTrait
{

    use ShopifyApiTrait;

    public function cancelCharge($shop = null)
    {
        $this->shop($shop);
        $this->shopifyApiRequest("cancelCharge", $this->shop->currentCharge->charge_id, null, null, null, 'DELETE');
    }

    public function premiumChecks($shop = null)
    {
        $this->shop($shop);
        if ($this->shop->plan_id == null) :
            return false;
        endif;
        if ($this->shop->isFreemium()) :
            return false;
        endif;
        return true;
    }

    public function getProductsByIds($productIds, $shop = null)
    {
        $this->shop($shop);
        $products = [];
        $requests =  $this->shopifyApiRequest("getProducts", null, ['limit' => 250, 'ids' => $productIds, 'fields' => 'id,variants']);
        // info(json_encode($requests['body']['products']));
        $products = array_merge($products, json_decode(json_encode($requests['body']['products'])));
        while (isset($requests['link']['next'])) {
            $requests =  $this->shopifyApiRequest("getProducts", null, ['limit' => 250, 'ids' => $productIds, 'fields' => 'id,variants', 'page_info' => $requests['link']['next']]);
            if (isset($requests['body']['products'])) :
                $products = array_merge($products, json_decode(json_encode($requests['body']['products'])));
            else :
                return [];
            endif;
        }
        dd($products);
        return $products;
    }
    public function getProductForUpsell($productIds,$shop = null)
    {
        $this->shop($shop);
        return  $this->shopifyApiRequest("getProducts", null , ['ids' => $productIds,'fields' => 'id,variants,title,images,options,image'],['body','products']);
    }
    // public function getCollectionProductsForUpsell($collectionId,$shop = null)
    // {
    //     // return $collectionId;
    //     $this->shop($shop);
    //     return  $this->shopifyApiRequest("getCollectionProducts", $collectionId,null,['body']);
    // }
    public function getCollectionProductsGraphql($collectionId,$shop = null)
    {
        $queryURL = "gid://shopify/Collection/";
        foreach($collectionId as $value):
            $_collectionIds[] = '"'.$queryURL.$value.'"';
        endforeach;
        $collectionId =  implode(',',$_collectionIds);
        // return $collectionId;
        $this->shop($shop);
        $requests =  $this->shopifyApiGraphQuery("getCollectionProducts", [$collectionId] , null ,['body','data','nodes']);
        return $requests;
    }

    public function getCollectionProductsGraphqlIds($collectionId,$shop = null)
    {
        $queryURL = "gid://shopify/Collection/";
        foreach($collectionId as $value):
            $_collectionIds[] = '"'.$queryURL.$value.'"';
        endforeach;
        $collectionId =  implode(',',$_collectionIds);
        // return $collectionId;
        $this->shop($shop);
        $requests =  $this->shopifyApiGraphQuery("getCollectionProductsIds", [$collectionId] , null ,['body','data','nodes']);
        return $requests;
    }

    public function getTagProductsGraphql($Tag,$shop = null)
    {
        $this->shop($shop);
        $requests =  $this->shopifyApiGraphQuery("getProductsByTag", $Tag , null ,['body','data','nodes']);
        return $requests;
    }
    public function getTagProductIdsGraphql($Tag,$shop = null)
    {
        $this->shop($shop);
        $requests =  $this->shopifyApiGraphQuery("getProductIdsByTag", $Tag , null ,['body','data','nodes']);
        return $requests;
    }
    public function getProductsForUpsellGraphql($productIds,$shop = null)
    {
        $queryURL = "gid://shopify/Product/";
        foreach($productIds as $value):
            $_productIds[] = '"'.$queryURL.$value.'"';
        endforeach;
        $productIds =  implode(',',$_productIds);
        $this->shop($shop);
        $requests =  $this->shopifyApiGraphQuery("getProductsByIds", [$productIds] , null ,['body','data','product']);
        return $requests;
    }
    public function getOrderProductsDetails($productIds, $shop = null)
    {
        $this->shop($shop);
        return $this->shopifyApiRequest("getProducts", null, ['ids' => $productIds, 'fields' => 'id,image,handle'], ['body', 'products']);
    }

    public function shopApi($required_fields = null)
    {
        $this->shop();
        return $this->shopifyApiRequest("shop", null, null, $required_fields);
    }

    public function getMainThemeId()
    {
        $this->shop();
        $requests =  $this->shopifyApiRequest("getAllThemes", null, null, ['body', 'themes']);
        $themeid = null;
        foreach ($requests as $theme) {
            if ($theme['role'] == "main") {
                $themeid = $theme['id'];
                break;
            }
        }
        return $themeid;
    }

    public function getVariantsByProductId($id)
    {
        $this->shop();
        $requests =  $this->shopifyApiGraphQuery("getVarientByProductId", [$id], null, ['body', 'data', 'product', 'variants', 'edges']);
        return $requests;
    }

    public function getProductById($id)
    {
        $this->shop();
        $requests =  $this->shopifyApiRequest("getProductById", $id, null, ['body', 'product']);
        return $requests;
    }

    public function getProductCollectionIds($productId, $shop)
    {
        $this->shop($shop);
        $requests =  $this->shopifyApiRequest("getProductCollectionIds", null, ['product_id' => $productId], ['body', 'collects']);
        return $requests;
    }

    public function includeSnippet($themeid, $shop = null)
    {
        $this->shop($shop);
        $requests =  $this->shopifyApiRequest("getSingleAsset", $themeid, ["asset[key]" => config('shopifyApi.strings.theme_liquid_file')], ['body', 'asset', 'value']);
        if ($requests) :
            $html = $requests;
            if (strpos($html, config('shopifyApi.strings.app_start_identifier')) === false) :
                $pos = strpos($html, config('shopifyApi.strings.app_include_before_tag'));
                $newhtml = substr($html, 0, $pos) . config('shopifyApi.strings.app_include') . substr($html, $pos);
                $toupdate = [
                    "asset" => [
                        "key" => config('shopifyApi.strings.theme_liquid_file'),
                        "value" => $newhtml
                    ]
                ];
                $this->shopifyApiRequest("saveSingleAsset", $themeid, $toupdate, ['status'], null, 'PUT');
            endif;
        endif;
    }

    public function deleteIncludeSnippet($themeid, $shop = null)
    {
        $this->shop($shop);
        $requests =  $this->shopifyApiRequest("getSingleAsset", $themeid, ["asset[key]" => config('shopifyApi.strings.theme_liquid_file')], ['body', 'asset', 'value']);
        $pos = strpos($requests, config('shopifyApi.strings.app_start_identifier'));
        if ($pos !== false) :
            $pos2 = strpos($requests, config('shopifyApi.strings.app_end_identifier'));
            $newhtml = substr($requests, 0, $pos) . substr($requests, $pos2 + strlen(config('shopifyApi.strings.app_end_identifier')));
            $toupdate = [
                "asset" => [
                    "key" => config('shopifyApi.strings.theme_liquid_file'),
                    "value" => $newhtml
                ]
            ];
            $requests =  $this->shopifyApiRequest("saveSingleAsset", $themeid, $toupdate, ['status'], null, 'PUT');
        endif;
    }

    public function createSnippetFile($themeid, $shop = null)
    {
        $this->shop($shop);
        $lfile = view('snippets.index')->render();
        $add = [
            "asset" => [
                "key" => config('shopifyApi.strings.app_snippet_key'),
                "value" => "{$lfile}"
            ]
        ];
        $this->shopifyApiRequest("saveSingleAsset", $themeid, $add, null, null, 'PUT');
    }

    /**
     * 
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This function is Creating the Script Tag
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     * 
     */

    public function createScriptTag($shop = null)
    {
        $this->shop($shop);
        $reqFields = [
            "script_tag" => [
                'event' => config('shopifyApi.scriptTag.event'),
                'src'   => config('shopifyApi.scriptTag.src')
            ]
        ];
        return $this->shopifyApiRequest('createScriptTag',null,$reqFields,null,null,'POST');
    }

    /**
     * 
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This function is Deleting the Script Tag
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     * 
     */

    public function deleteScriptTag($script_tag_id, $shop = null)
    {
        $this->shop($shop);
        return $this->shopifyApiRequest('deleteScriptTag',$script_tag_id,null,null,null,"DELETE");
    }
    
    public function createPriceRule($price_rule, $shop = null)
    {
        $this->shop();
        $res_price = $this->shopifyApiRequest("createPriceRule", null, $price_rule, ['body'], null, "POST");
        return $res_price;
    }

    public function createDiscountCode($price_rule_id, $discount_code, $shop = null)
    {
        $this->shop();
        return $this->shopifyApiRequest("createDiscountCode", $price_rule_id, $discount_code, ['body'], null, "POST");
    }


    public function deletePriceRule($price_rule_id, $shop = null)
    {
        $this->shop();
        return $this->shopifyApiRequest("deletePriceRule", $price_rule_id, null, null, null, "DELETE");
    }
    
    /**
     * 
     * ================================================================================
     * This function is generating dicounts rules for Upsells
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * $title : it is the tile of Upsell. e.g. Volume Discount, Post Purchase etc
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * $discunt_value : how much cost of discount e.g ($10, $20,  20% etc)
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * $quantity : total quantity of the product where dicount will apply
     * e.g. on single quantity of the product discount will apply.
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * $entitled_ids : Total products or collection ids where discount will apply
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * $start_date : The data when discount will start
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     *  $value_type :  Discount type can be ($age off ) or (fixed amount)
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * $targetkey: it can be TargetProduct, TargetCollection, TargetTags
     * ================================================================================
     * 
     */
    
    public function discountPriceRule($title,  $discount_value, $quantity, $entitled_ids, $start_date, $value_type="percentage", $targetkey){
        // $shop = $this->shop($shop);
        $price_rule['price_rule'] = [
            "target_type" => "line_item",
            "target_selection" => "entitled",
            "allocation_method" => "across",
            "customer_selection" => "all",
        ];
        $price_rule['price_rule']["title"] = $title;
        $price_rule['price_rule']["value_type"] = $value_type;
        $price_rule['price_rule']["value"] = '-'.$discount_value;
        $price_rule['price_rule']["prerequisite_quantity_range"]["greater_than_or_equal_to"] = $quantity;
        if($targetkey == "Tproducts" || $targetkey == "Aproducts" || $targetkey == "Atags"):
            $price_rule['price_rule']["entitled_product_ids"] = $entitled_ids;
        elseif($targetkey == "Tcollections" || $targetkey == "Acollections"):
            $price_rule['price_rule']["entitled_collection_ids"] = $entitled_ids;
        endif;    
        $price_rule['price_rule']["starts_at"] = $start_date;
        $create_price_rule = $this->createPriceRule($price_rule);
        $price_rule_id = $create_price_rule['price_rule']['id'];
        $discount_code['discount_code'] = [
            "code" => 'VD_'.$price_rule_id
          ];
        $create_discount_code = $this->createDiscountCode($price_rule_id, $discount_code);
        $coupon_code = $create_discount_code['discount_code']['code'];
        return [$price_rule_id, $coupon_code];
    }

    // public function deleteSnippetFile($themeid,$shop = null){
    // 	$this->shop($shop);
        // $requests = $this->api_request("DELETE","deleteAsset",$themeid,["asset[key]" => config('constants.strings.app_snippet')],['status']);
    // }
}
