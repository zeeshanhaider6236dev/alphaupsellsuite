<?php

namespace App\Http\Traits;

use App\Models\Upsell;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\UpsellDiscount;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\CommonValidationTrait;


trait NativePostPurchaseTrait {

    use CommonValidationTrait,CommonTrait,ShopifyTrait;

    /**
     * 
     * ###########################################################
     * This Function will add the new Post Purchase upsell
     * ###########################################################
     * 
     */
    
    public function add_native_post_purchase_upsell($upsellType)
    {
        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Apply all extra rules to form data
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $extra = array_merge($this->nativePostPurchaseUpsellRules() ,$this->whichDeviceRules(), $this->scheduleRules(), $this->nativePreviewHeadingRules());
        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Called Validation funtion to validate the data
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $validated = $this->validation(['createUpsellForm'],$extra);


        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Return all errors if any occured 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        if(!is_array($validated)):
            return $validated;
        endif;


        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Createing data for database if validated
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $data = [
            'name'              => $validated['name'],
            'upsell_type_id'    => $upsellType->id,
            'user_id'           => auth()->user()->id,
        ];

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Grab data and filter the Target,AppearOn and
         * downsell produts data returned by the validation
         * function.
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $array = ['products'];
        foreach (["T","A","D"] as $value) :
            foreach ($array as $value2) :
                if(isset($validated[$value.$value2])):
                    if($value == "T"):
                        $targetted = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                    elseif($value == 'A'):
                        $appearon = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                    elseif($value == 'D'):
                        $downsell = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                    endif;
                    unset($validated[$value.$value2]);
                endif;
            endforeach;
        endforeach;


        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Set all checkboxes vlues to zero if not set
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */

        if(!isset($validated['desktop_view'])):
            $validated['desktop_view'] = 0;
        endif;
        if(!isset($validated['mobile_view'])):
            $validated['mobile_view'] = 0;
        endif;
        if(!isset($validated['time_limit_toggler'])):
            $validated['time_limit_toggler'] = 0;
        endif;
        if(!isset($validated['bg_color_toggler'])):
            $validated['bg_color_toggler'] = 0;
        endif;
        if(!isset($validated['border_color_toggler'])):
            $validated['border_color_toggler'] = 0;
        endif;
        if(!isset($validated['quantity_toggler'])):
            $validated['quantity_toggler'] = 0;
        endif;
        if(!isset($validated['variant_toggler'])):
            $validated['variant_toggler'] = 0;
        endif;

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Get Target Products Name From targeted variable 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $targetkey = $targetted['key'];
        $targetedData = [];
        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * create data for target products
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        foreach($targetted ['values'] as $key => $value):
            $targetedData[] = [
                'shopify_'.Str::singular(substr($targetkey, 1))."_id"    => $value,
                'shopify_'.Str::singular(substr($targetkey, 1))."_image" => $validated[$targetted['key'].'images'][$key],
                'shopify_'.Str::singular(substr($targetkey, 1))."_title" => $validated[$targetted['key'].'titles'][$key]
            ];
        endforeach;
        $data[ $targetted['key'] ] =  $targetedData;

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Get Appear On Products Data
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
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

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Get Down Sell Products Data 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        if(isset($downsell)):
            $downSellKey = $downsell['key'];
                $downSellData = [];
                $downSellIds  = [];
                foreach($downsell ['values'] as $key => $value):
                    $downSellData[] = [
                        'shopify_'.Str::singular(substr($downSellKey, 1))."_id"    => $value,
                        'shopify_'.Str::singular(substr($downSellKey, 1))."_image" => $validated[$downsell['key'].'images'][$key],
                        'shopify_'.Str::singular(substr($downSellKey, 1))."_title" => $validated[$downsell['key'].'titles'][$key],
                        'type'                                                     => "downsell"
                    ];
                    $downSellIds[] = $value;
                endforeach;
            $data[ $downsell['key'] ] = $downSellData;
        endif;

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Unset all target,appearon and downsell Produts
         * keys from validated variable
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */

        $array = ['products'];
        foreach (["T","A","D"] as $value) :
            foreach ($array as $value2) :
                if(isset($validated[$value.$value2.'images'])):
                    unset($validated[$value.$value2.'images'],$validated[$value.$value2.'titles']);
                endif;
            endforeach;
        endforeach;
        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Store data on data variable with setting key
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $data['setting'] = $validated;


        /**
         * 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Create Parameters and call Discount function
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * 
         */

        // if(isset($data['Atags'])):
        //     $tags_products_ids  = [];
        //     $tag                = [];
        //     foreach($data['Atags'] as $tag):
        //         $tag[] = $tag['shopify_tag_id'];
        //         $products_for_discount =  $this->getTagProductIdsGraphql($tag);
        //         foreach($products_for_discount['products']['edges'] as $product_id):
        //             $tags_products_ids[] = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$product_id['node']['id']);
        //         endforeach;
        //     endforeach;
        //     $tags_products_ids = collect($tags_products_ids);
        //     $product_ids_for_discount = $tags_products_ids->unique();
        //     $product_ids_for_discount = $product_ids_for_discount->values()->all();

        //     if($data['setting']['discount_price_option'] != config("upsell.strings.ppuDiscountType")[2]):
        //         $upsell_discount = [];
        //         $target_key  = $appearon['key'];
        //         $upsell_discount_title      = $data['name'];
        //         $dicount_value              = $data['setting']['upsell_discount'] ;
        //         $discount_product_quantity  = 1;
        //         $start_date                 = $data['setting']['start_date'];
        //         if($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[0]):
        //             $dicount_value_type = "percentage";
        //         elseif($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[1]):
        //             $dicount_value_type = "fixed_amount";
        //         endif;
        //         $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $product_ids_for_discount, $start_date,$dicount_value_type,$target_key );
        //         $upsell_discount[0]['price_rule_id'] = $res_result[0];
        //         $upsell_discount[0]['discount_code'] = $res_result[1];
        //         $data['upsellDiscounts'] = $upsell_discount;
        //     endif;
        // else:
        //     if($data['setting']['discount_price_option'] != config("upsell.strings.ppuDiscountType")[2]):
        //         $target_key  = $appearon['key'];
        //         $upsell_discount = [];
        //         $upsell_discount_title      = $data['name'];
        //         $dicount_value              = $data['setting']['upsell_discount'] ;
        //         $discount_product_quantity  = 1;
        //         $start_date                 = $data['setting']['start_date'];
        //         if($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[0]):
        //             $dicount_value_type = "percentage";
        //         elseif($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[1]):
        //             $dicount_value_type = "fixed_amount";
        //         endif;
        //         $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $appearOnIds, $start_date,$dicount_value_type,$target_key );
        //         $upsell_discount[0]['price_rule_id'] = $res_result[0];
        //         $upsell_discount[0]['discount_code'] = $res_result[1];
        //         $data['upsellDiscounts'] = $upsell_discount;
        //     endif;
        // endif;

        
       
        
        /**
         * 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Save upsell 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * 
         */
        $upsell = new Upsell($data);
        $upsell_id = $upsell['id'];
        if($upsell_id):
            return response()->json(['success' => 'Upsell Added Successfully.', 'status' => true, 'upsell_id' => $upsell_id]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }

    /**
     * 
     * ###########################################################
     * This Function will update the existing Post Purchase upsell
     * ###########################################################
     * 
     */

    public function update_native_post_purchase_upsell($upsell)
    {
       /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Apply all extra rules to form data
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $extra = array_merge($this->nativePostPurchaseUpsellRules() ,$this->whichDeviceRules(), $this->scheduleRules(), $this->nativePreviewHeadingRules());
        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Called Validation funtion to validate the data
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $validated = $this->validation(['createUpsellForm'],$extra);


        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Return all errors if any occured 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        if(!is_array($validated)):
            return $validated;
        endif;


        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Createing data for database if validated
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $data = [
            'name'              => $validated['name'],
            'id'                => $upsell->id,
            'user_id'           => auth()->user()->id,
        ];

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Grab data and filter the Target,AppearOn and
         * downsell produts data returned by the validation
         * function.
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $array = ['products'];
        foreach (["T","A","D"] as $value) :
            foreach ($array as $value2) :
                if(isset($validated[$value.$value2])):
                    if($value == "T"):
                        $targetted = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                    elseif($value == 'A'):
                        $appearon = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                    elseif($value == 'D'):
                        $downsell = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                    endif;
                    unset($validated[$value.$value2]);
                endif;
            endforeach;
        endforeach;


        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Set all checkboxes vlues to zero if not set
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */

        if(!isset($validated['desktop_view'])):
            $validated['desktop_view'] = 0;
        endif;
        if(!isset($validated['mobile_view'])):
            $validated['mobile_view'] = 0;
        endif;
        if(!isset($validated['time_limit_toggler'])):
            $validated['time_limit_toggler'] = 0;
        endif;
        if(!isset($validated['bg_color_toggler'])):
            $validated['bg_color_toggler'] = 0;
        endif;
        if(!isset($validated['border_color_toggler'])):
            $validated['border_color_toggler'] = 0;
        endif;
        if(!isset($validated['quantity_toggler'])):
            $validated['quantity_toggler'] = 0;
        endif;
        if(!isset($validated['variant_toggler'])):
            $validated['variant_toggler'] = 0;
        endif;

        // dd($validated);
        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Get Target Products Name From targeted variable 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $targetkey = $targetted['key'];
        $targetedData = [];
        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * create data for target products
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        foreach($targetted ['values'] as $key => $value):
            $targetedData[] = [
                'shopify_'.Str::singular(substr($targetkey, 1))."_id"    => $value,
                'shopify_'.Str::singular(substr($targetkey, 1))."_image" => $validated[$targetted['key'].'images'][$key],
                'shopify_'.Str::singular(substr($targetkey, 1))."_title" => $validated[$targetted['key'].'titles'][$key]
            ];
        endforeach;
        $data[ $targetted['key'] ] =  $targetedData;

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Get Appear On Products Data
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
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

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Get Down Sell Products Data 
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        if(isset($downsell)):
            $downSellKey = $downsell['key'];
                $downSellData = [];
                $downSellIds  = [];
                foreach($downsell ['values'] as $key => $value):
                    $downSellData[] = [
                        'shopify_'.Str::singular(substr($downSellKey, 1))."_id"    => $value,
                        'shopify_'.Str::singular(substr($downSellKey, 1))."_image" => $validated[$downsell['key'].'images'][$key],
                        'shopify_'.Str::singular(substr($downSellKey, 1))."_title" => $validated[$downsell['key'].'titles'][$key],
                        'type'                                                     => "downsell"
                    ];
                    $downSellIds[] = $value;
                endforeach;
            $data[ $downsell['key'] ] = $downSellData;
        else:
            $data["Dproducts"] = [];

        endif;

        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Unset all target,appearon and downsell Produts
         * keys from validated variable
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */

        $array = ['products'];
        foreach (["T","A","D"] as $value) :
            foreach ($array as $value2) :
                if(isset($validated[$value.$value2.'images'])):
                    unset($validated[$value.$value2.'images'],$validated[$value.$value2.'titles']);
                endif;
            endforeach;
        endforeach;
        /*
         *
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * Store data on data variable with setting key
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         *
        */
        $data['setting'] = $validated;
        // return $data;
        if($upsell->fill($data)->save()):
            return response()->json(['success' => 'Upsell Updated Successfully.', 'status' => true, 'upsell_id' => $upsell->id]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }

    
     
}