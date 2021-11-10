<?php
namespace App\Http\Traits;

use App\Models\Upsell;
use App\Models\Setting;
use Illuminate\Support\Str;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\CommonValidationTrait;

trait AddtocartTrait {

    use CommonValidationTrait,CommonTrait,ShopifyTrait,AddtocartRulesTrait;

    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This Function will add the new Add To Cart upsell
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    
    public function add_pre_purchase_upsell($upsellType)
    {
        // return "Add";
        $extra = array_merge($this->productRules(), $this->whichDeviceRules(), $this->scheduleRules(),$this->discountRules(), $this->addToCartUpsellRules());
        $validated = $this->validation(['createUpsellForm'],$extra);
        if(!is_array($validated)):
            return $validated;
        endif;
        $data = [
            'name'                  => $validated['name'],
            'upsell_type_id'        => $upsellType->id,
            'user_id'               => auth()->user()->id,
            'auto'                  => $validated['auto'],
        ];
        $array = ['Tproducts','Tcollections','Ttags'];
        foreach($array as $value):
            if(isset($validated[$value])):
                $targetted = ['key' => $value, 'values' => $validated[$value]];
                unset($validated[$value]);
            endif;
        endforeach;
        if(!$validated['auto']):
            $array = ['Aproducts','Acollections','Atags'];
            foreach ($array as $value2) :
                if(isset($validated[$value2])):
                    $appearon = ['key' => $value2, 'values' => $validated[$value2]];
                    unset($validated[$value2]);
                endif;
            endforeach;
        else:
            unset($validated['auto']);
        endif;
        unset($validated['name']);
        if(!isset($validated['upsell_template_type'])):
            $validated['upsell_template_type'] =  request('upsell_template_type');
        endif;
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        if(request('upsell_template_type') == 1):
            !isset($validated['offer_time_limit']) ? $validated['offer_time_limit'] = 0 : '';
        elseif(request('upsell_template_type') == 2): 
            !isset($validated['alpha_t2_timer_limit']) ? $validated['alpha_t2_timer_limit'] = 0 : '';
        elseif(request('upsell_template_type') == 3):
            !isset($validated['alpha_t3_timer']) ? $validated['alpha_t3_timer'] = 0 : '';
        elseif(request('upsell_template_type') == 4):
            !isset($validated['alpha_t4_time_limit_toggler']) ? $validated['alpha_t4_time_limit_toggler'] = 0 : '';
        elseif(request('upsell_template_type') == 5):
            !isset($validated['alpha_t5_time_limit_toggler']) ? $validated['alpha_t5_time_limit_toggler'] = 0 : '';
        endif;
        $targetkey = $targetted['key'];
        $targetedData = [];
        foreach($targetted ['values'] as $key => $value):
            $targetedData[] = [
                'shopify_'.Str::singular(substr($targetkey, 1))."_id"    => $value,
                'shopify_'.Str::singular(substr($targetkey, 1))."_image" => $validated[$targetted['key'].'images'][$key],
                'shopify_'.Str::singular(substr($targetkey, 1))."_title" => $validated[$targetted['key'].'titles'][$key]
            ];
        endforeach;
        $data[ $targetted['key'] ] =  $targetedData;
        if(isset($appearon)):
            $appearonkey = $appearon['key'];
            $appearonData = [];
            $appearOnIds  = [];
            foreach($appearon ['values'] as $key => $value):
                $appearonData[] = [
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_id"    => $value,
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_image" => $validated[$appearon['key'].'images'][$key],
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_title" => $validated[$appearon['key'].'titles'][$key],
                    'type'                                                     => "appearOn"
                ];
                $appearOnIds[] = $value;
            endforeach;
            $data[ $appearon['key'] ] = $appearonData;
        endif;
        $array = ['products','collections','tags'];
        foreach (["T","A"] as $value) :
            foreach ($array as $value2) :
                if(isset($validated[$value.$value2.'images'])):
                    unset($validated[$value.$value2.'images'],$validated[$value.$value2.'titles']);
                endif;
            endforeach;
        endforeach;
        $data['setting'] = $validated;

        /**
         * 
         * ----------------------------------------------------
         * Create Parameters and call Discount function
         * ----------------------------------------------------
         * 
         */
        /* if(isset($data['Atags'])):
            $tags_products_ids  = [];
            $tag                = [];
            foreach($data['Atags'] as $tag):
                $tag[] = $tag['shopify_tag_id'];
                $products_for_discount =  $this->getTagProductIdsGraphql($tag);
                foreach($products_for_discount['products']['edges'] as $product_id):
                    $tags_products_ids[] = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$product_id['node']['id']);
                endforeach;
            endforeach;
            $tags_products_ids = collect($tags_products_ids);
            $product_ids_for_discount = $tags_products_ids->unique();
            $product_ids_for_discount = $product_ids_for_discount->values()->all();

            if($data['setting']['discount_type'] != config("upsell.strings.ppuDiscountType")[2]):
                $upsell_discount = [];
                $target_key  = $appearon['key'];
                $upsell_discount_title      = $data['name'];
                $dicount_value              = $data['setting']['discount_value'] ;
                $discount_product_quantity  = 1;
                $start_date                 = $data['setting']['start_date'];
                if($data['setting']['discount_type'] == config("upsell.strings.ppuDiscountType")[0]):
                    $dicount_value_type = "percentage";
                elseif($data['setting']['discount_type'] == config("upsell.strings.ppuDiscountType")[1]):
                    $dicount_value_type = "fixed_amount";
                endif;
                $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $product_ids_for_discount, $start_date,$dicount_value_type,$target_key );
                $upsell_discount[0]['price_rule_id'] = $res_result[0];
                $upsell_discount[0]['discount_code'] = $res_result[1];
                $data['upsellDiscounts'] = $upsell_discount;
            endif;
        else:
            if($data['setting']['discount_type'] != config("upsell.strings.ppuDiscountType")[2]):
                $target_key  = $appearon['key'];
                $upsell_discount = [];
                $upsell_discount_title      = $data['name'];
                $dicount_value              = $data['setting']['discount_value'] ;
                $discount_product_quantity  = 1;
                $start_date                 = $data['setting']['start_date'];
                if($data['setting']['discount_type'] == config("upsell.strings.ppuDiscountType")[0]):
                    $dicount_value_type = "percentage";
                elseif($data['setting']['discount_type'] == config("upsell.strings.ppuDiscountType")[1]):
                    $dicount_value_type = "fixed_amount";
                endif;
                $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $appearOnIds, $start_date,$dicount_value_type,$target_key );
                $upsell_discount[0]['price_rule_id'] = $res_result[0];
                $upsell_discount[0]['discount_code'] = $res_result[1];
                $data['upsellDiscounts'] = $upsell_discount;
            endif;
        endif; */


        $upsell = new Upsell($data);
        $upsell_id = $upsell['id'];
        if($upsell_id):
            return response()->json(['success' => 'Upsell Added Successfully.', 'status' => true, 'upsell_id' => $upsell_id, 'template' => $data['setting']['upsell_template_type']]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }

    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This Function will update the existing Add To Cart upsell
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */

    public function update_pre_purchase_upsell($upsell)
    {
        /**
         * 
         * --------------------------------------------------------
         * Create rules for upsell to validate upsell data
         * --------------------------------------------------------
         * 
         */
       $extra = array_merge($this->productRules(), $this->whichDeviceRules(), $this->scheduleRules(),$this->discountRules(), $this->addToCartUpsellRules());
       /**
         * 
         * --------------------------------------------------------
         * call to validation method to validate the data
         * --------------------------------------------------------
         * 
         */
        $validated = $this->validation(['createUpsellForm'],$extra);
        /**
         * 
         * --------------------------------------------------------
         * return errors if not validated data
         * --------------------------------------------------------
         * 
         */
        if(!is_array($validated)):
            return $validated;
        endif;
        /**
         * 
         * --------------------------------------------------------
         * create data for if validation successfully completed
         * --------------------------------------------------------
         * 
         */
        $data = [
            'name'                  => $validated['name'],
            'id'                    => $upsell->id,
            'user_id'               => auth()->user()->id,
            'auto'                  => $validated['auto'],
            'Tproducts'             => [],
            'Tcollections'          => [],
            'Ttags'                 => [],
            'Aproducts'             => [],
            'Acollections'          => [],
            'Atags'                 => [],
        ];
        $array = ['Tproducts','Tcollections','Ttags'];
        foreach($array as $value):
            if(isset($validated[$value])):
                $targetted = ['key' => $value, 'values' => $validated[$value]];
                unset($validated[$value]);
            endif;
        endforeach;
        if(!$validated['auto']):
            $array = ['Aproducts','Acollections','Atags'];
            foreach ($array as $value2) :
                if(isset($validated[$value2])):
                    $appearon = ['key' => $value2, 'values' => $validated[$value2]];
                    unset($validated[$value2]);
                endif;
            endforeach;
        else:
            unset($validated['auto']);
        endif;
        unset($validated['name']);
        if(!isset($validated['upsell_template_type'])):
            $validated['upsell_template_type'] =  request('upsell_template_type');
        endif;
        /**
         * 
         * --------------------------------------------------------
         * setting key value for Work on desktop and work on mobile
         * for all templates,if unchecked. 
         * --------------------------------------------------------
         * 
         */
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;

        /**
         * 
         * -----------------------------------------------------
         * setting key value for Time toggler for all templates
         * if time toggler is unchecked. 
         * -----------------------------------------------------
         * 
         */

        if(request('upsell_template_type') == 1):
            !isset($validated['offer_time_limit']) ? $validated['offer_time_limit'] = 0 : '';
        elseif(request('upsell_template_type') == 2): 
            !isset($validated['alpha_t2_timer_limit']) ? $validated['alpha_t2_timer_limit'] = 0 : '';
        elseif(request('upsell_template_type') == 3):
            !isset($validated['alpha_t3_timer']) ? $validated['alpha_t3_timer'] = 0 : '';
        elseif(request('upsell_template_type') == 4):
            !isset($validated['alpha_t4_time_limit_toggler']) ? $validated['alpha_t4_time_limit_toggler'] = 0 : '';
        elseif(request('upsell_template_type') == 5):
            !isset($validated['alpha_t5_time_limit_toggler']) ? $validated['alpha_t5_time_limit_toggler'] = 0 : '';
        endif;

         /**
         * 
         * -----------------------------------------------------
         * create data for shopify product id, image, title to
         * save in database.
         * -----------------------------------------------------
         * 
         */
        $targetkey = $targetted['key'];
        $targetedData = [];
        foreach($targetted ['values'] as $key => $value):
            $targetedData[] = [
                'shopify_'.Str::singular(substr($targetkey, 1))."_id"    => $value,
                'shopify_'.Str::singular(substr($targetkey, 1))."_image" => $validated[$targetted['key'].'images'][$key],
                'shopify_'.Str::singular(substr($targetkey, 1))."_title" => $validated[$targetted['key'].'titles'][$key]
            ];
        endforeach;
        /**
         * 
         * --------------------------------------------
         * store targed data in data variable with 
         * target key.
         * --------------------------------------------
         * 
         */
        $data[ $targetted['key'] ] =  $targetedData;
        /**
         * 
         * --------------------------------------------
         * store appear on data in data variable with 
         * target key.
         * --------------------------------------------
         * 
         */
        if(isset($appearon)):
            $appearonkey = $appearon['key'];
            $appearonData = [];
            $appearOnIds  = [];
            foreach($appearon ['values'] as $key => $value):
                $appearonData[] = [
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_id"    => $value,
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_image" => $validated[$appearon['key'].'images'][$key],
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_title" => $validated[$appearon['key'].'titles'][$key],
                    'type'                                                     => "appearOn"
                ];
                $appearOnIds[] = $value;
            endforeach;
            $data[ $appearon['key'] ] = $appearonData;
        endif;

        /**
         * 
         * --------------------------------------------
         * unset target and appear on data keys from
         * $validated variable.
         * --------------------------------------------
         * 
         */
        $array = ['products','collections','tags'];
        foreach (["T","A"] as $value) :
            foreach ($array as $value2) :
                if(isset($validated[$value.$value2.'images'])):
                    unset($validated[$value.$value2.'images'],$validated[$value.$value2.'titles']);
                endif;
            endforeach;
        endforeach;

        /**
         * 
         * --------------------------------------------
         * store validated data in setting key in data
         * variable
         * --------------------------------------------
         * 
         */
        $data['setting'] = $validated;

        /**
         * 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Delete Previous Discount Rules from shopify also
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * 
         */
        if($upsell['upsellDiscounts']->count()):
            $upsell_discount_id = $upsell['upsellDiscounts'][0]['price_rule_id'];
            $this->deletePriceRule($upsell_discount_id);
        endif;
        /**
         * 
         * ----------------------------------------------------
         * Create Parameters and call Discount function
         * ----------------------------------------------------
         * 
         */
        // return $data;
        /* if(isset($data['Atags']) && count($data['Atags'])):
            $tags_products_ids  = [];
            $tag                = [];
            foreach($data['Atags'] as $tag):
                $tag[] = $tag['shopify_tag_id'];
                $products_for_discount =  $this->getTagProductIdsGraphql($tag);
                foreach($products_for_discount['products']['edges'] as $product_id):
                    $tags_products_ids[] = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$product_id['node']['id']);
                endforeach;
            endforeach;
            $tags_products_ids = collect($tags_products_ids);
            $product_ids_for_discount = $tags_products_ids->unique();
            $product_ids_for_discount = $product_ids_for_discount->values()->all();

            if($data['setting']['discount_type'] != config("upsell.strings.ppuDiscountType")[2]):
                $upsell_discount = [];
                $target_key  = $appearon['key'];
                $upsell_discount_title      = $data['name'];
                $dicount_value              = $data['setting']['discount_value'] ;
                $discount_product_quantity  = 1;
                $start_date                 = $data['setting']['start_date'];
                if($data['setting']['discount_type'] == config("upsell.strings.ppuDiscountType")[0]):
                    $dicount_value_type = "percentage";
                elseif($data['setting']['discount_type'] == config("upsell.strings.ppuDiscountType")[1]):
                    $dicount_value_type = "fixed_amount";
                endif;
                $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $product_ids_for_discount, $start_date,$dicount_value_type,$target_key );
                $upsell_discount[0]['price_rule_id'] = $res_result[0];
                $upsell_discount[0]['discount_code'] = $res_result[1];
                $data['upsellDiscounts'] = $upsell_discount;
            endif;
        else:
            if($data['setting']['discount_type'] != config("upsell.strings.ppuDiscountType")[2]):
                $target_key  = $appearon['key'];
                $upsell_discount = [];
                $upsell_discount_title      = $data['name'];
                $dicount_value              = $data['setting']['discount_value'] ;
                $discount_product_quantity  = 1;
                $start_date                 = $data['setting']['start_date'];
                if($data['setting']['discount_type'] == config("upsell.strings.ppuDiscountType")[0]):
                    $dicount_value_type = "percentage";
                elseif($data['setting']['discount_type'] == config("upsell.strings.ppuDiscountType")[1]):
                    $dicount_value_type = "fixed_amount";
                endif;
                $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $appearOnIds, $start_date,$dicount_value_type,$target_key );
                $upsell_discount[0]['price_rule_id'] = $res_result[0];
                $upsell_discount[0]['discount_code'] = $res_result[1];
                $data['upsellDiscounts'] = $upsell_discount;
            endif;
        endif; */

        /**
         * 
         * --------------------------------------------
         * update upsell with updated data
         * --------------------------------------------
         * 
         */
        
        if($upsell->fill($data)->save()):
            return response()->json(['success' => 'Upsell Updated Successfully.', 'status' => true, 'upsell_id' => $upsell->id,'template' => $data['setting']['upsell_template_type']]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;        
    }

    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This Function is defining rules for Post Purchase upsell
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function addToCartUpsellRules()
    {
        /**
         * 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * create function name to call the function from AddtocartRule Trait
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * 
         */

        $atcTemplateRules = "template_".request('upsell_template_type');
        
        /**
         * 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * call to function for tamplate rules
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * 
         */
        return $this->$atcTemplateRules();
    }

    /**
     * 
     * =============================================================
     * This Function is defining rules for discount
     * =============================================================
     * 
     * 
     */

    public function discountRules()
    {
        $extra   = [];
        $extra [] = [ 'key' => 'discount_type', 'value' => [ "required", 'string', 'in:'.implode(',',config('upsell.strings.ppuDiscountType')) ] ];
        $extra [] = [ 'key' => 'discount_value', 'value' => [ "required", 'numeric'  ] ];

        return $extra;
    }
     
}