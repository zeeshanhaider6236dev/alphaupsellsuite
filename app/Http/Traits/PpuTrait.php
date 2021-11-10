<?php
namespace App\Http\Traits;

use App\Models\Upsell;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\UpsellDiscount;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\CommonValidationTrait;

trait PpuTrait {

    use CommonValidationTrait,CommonTrait,ShopifyTrait;

    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This Function will add the new Post Purchase upsell
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    
    public function add_thank_you_upsell($upsellType)
    {
        $extra = array_merge($this->productRules(), $this->whichDeviceRules(), $this->scheduleRules(), $this->preivewHeadingRules('ppu_heading'),$this->postPurchaseUpsellRules());
        $validated = $this->validation(['createUpsellForm'],$extra);
        if(!is_array($validated)):
            return $validated;
        endif;
        $data = [
            'name'              => $validated['name'],
            'upsell_type_id'    => $upsellType->id,
            'user_id'           => auth()->user()->id,
            'auto'              => $validated['auto'],
        ];
        if(!$validated['auto']):
            $array = ['products','collections','tags'];
            foreach (["T","A"] as $value) :
                foreach ($array as $value2) :
                    if(isset($validated[$value.$value2])):
                        if($value == "T"):
                            $targetted = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                        elseif($value == 'A'):
                            $appearon = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                        endif;
                        unset($validated[$value.$value2]);
                    endif;
                endforeach;
            endforeach;
        else:
            unset($validated['auto']);
        endif;
        unset($validated['name']);
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        if(!isset($validated['show_ppu_product_title'])):
            $validated['show_ppu_product_title'] = 0;
        endif;
        if(!isset($validated['show_ppu_varient_selection'])):
            $validated['show_ppu_varient_selection'] = 0;
        endif;
        if(!isset($validated['time_limit_toggler'])):
            $validated['time_limit_toggler'] = 0;
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

        if(isset($data['Atags'])):
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

            if($data['setting']['discount_price_option'] != config("upsell.strings.ppuDiscountType")[2]):
                $upsell_discount = [];
                $target_key  = $appearon['key'];
                $upsell_discount_title      = $data['name'];
                $dicount_value              = $data['setting']['upsell_discount'] ;
                $discount_product_quantity  = 1;
                $start_date                 = $data['setting']['start_date'];
                if($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[0]):
                    $dicount_value_type = "percentage";
                elseif($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[1]):
                    $dicount_value_type = "fixed_amount";
                endif;
                $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $product_ids_for_discount, $start_date,$dicount_value_type,$target_key );
                $upsell_discount[0]['price_rule_id'] = $res_result[0];
                $upsell_discount[0]['discount_code'] = $res_result[1];
                $data['upsellDiscounts'] = $upsell_discount;
            endif;

        else:
            if($data['setting']['discount_price_option'] != config("upsell.strings.ppuDiscountType")[2]):
                $target_key  = $appearon['key'];
                $upsell_discount = [];
                $upsell_discount_title      = $data['name'];
                $dicount_value              = $data['setting']['upsell_discount'] ;
                $discount_product_quantity  = 1;
                $start_date                 = $data['setting']['start_date'];
                if($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[0]):
                    $dicount_value_type = "percentage";
                elseif($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[1]):
                    $dicount_value_type = "fixed_amount";
                endif;
                $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $appearOnIds, $start_date,$dicount_value_type,$target_key );
                $upsell_discount[0]['price_rule_id'] = $res_result[0];
                $upsell_discount[0]['discount_code'] = $res_result[1];
                $data['upsellDiscounts'] = $upsell_discount;
            endif;
        endif;

        
       
        
        /**
         * 
         * ==============================================
         * Save upsell with relations
         * ==============================================
         * 
         */
        $upsell = new Upsell($data);
        $upsell_id = $upsell['id'];
        if($upsell_id):
            $scriptTag = Setting::select('scripttag')->where('domain',auth()->user()->name)->first();
            // dd($scriptTag->scripttag);
            if(!$scriptTag->scripttag):
                $response  = $this->createScriptTag();
                if($response['status'] == 201):
                    Setting::where('domain',auth()->user()->name)->update(['scripttag'=> 1,'script_tag_id'=> $response['body']['script_tag']['id']]);
                else:
                    return response()->json(['error' => 'Something Went Wrong.']);
                endif;
            endif;
            return response()->json(['success' => 'Upsell Added Successfully.', 'status' => true, 'upsell_id' => $upsell_id]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }

    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This Function will update the existing Post Purchase upsell
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */

    public function update_thank_you_upsell($upsell)
    {
       
        $extra = array_merge($this->productRules(), $this->whichDeviceRules(), $this->scheduleRules(), $this->preivewHeadingRules('ppu_heading'),$this->postPurchaseUpsellRules());
        $validated = $this->validation(['createUpsellForm'],$extra);
        if(!is_array($validated)):
            return $validated;
        endif;
        $data = [
            'name'              => $validated['name'],
            'id'                => $upsell->id,
            'user_id'           => auth()->user()->id,
            'auto'              => $validated['auto'],
        ];
        // $data['Tproducts'] = $data['Tcollections'] = $data['Ttags'] = [];
        // $data['Aproducts'] = $data['Acollections'] = $data['Atags'] = [];
        $data = $this->delPrevUpsellRecord($data);
        if(!$validated['auto']):
            $array = ['products','collections','tags'];
            foreach (["T","A"] as $value) :
                foreach ($array as $value2) :
                    if(isset($validated[$value.$value2])):
                        if($value == "T"):
                            $targetted = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                        elseif($value == 'A'):
                            $appearon = ['key' => $value.$value2, 'values' => $validated[$value.$value2]];
                        endif;
                        unset($validated[$value.$value2]);
                    endif;
                endforeach;
            endforeach;
        else:
            unset($validated['auto']);
        endif;
        unset($validated['name']);
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        if(!isset($validated['show_ppu_product_title'])):
            $validated['show_ppu_product_title'] = 0;
        endif;
        if(!isset($validated['show_ppu_varient_selection'])):
            $validated['show_ppu_varient_selection'] = 0;
        endif;
        if(!isset($validated['time_limit_toggler'])):
            $validated['time_limit_toggler'] = 0;
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
        if(count($data['Atags'])):
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

            if($data['setting']['discount_price_option'] != config("upsell.strings.ppuDiscountType")[2]):
                $upsell_discount = [];
                $target_key  = $appearon['key'];
                $upsell_discount_title      = $data['name'];
                $dicount_value              = $data['setting']['upsell_discount'] ;
                $discount_product_quantity  = 1;
                $start_date                 = $data['setting']['start_date'];
                if($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[0]):
                    $dicount_value_type = "percentage";
                elseif($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[1]):
                    $dicount_value_type = "fixed_amount";
                endif;
                $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $product_ids_for_discount, $start_date,$dicount_value_type,$target_key );
                $upsell_discount[0]['price_rule_id'] = $res_result[0];
                $upsell_discount[0]['discount_code'] = $res_result[1];
                $data['upsellDiscounts'] = $upsell_discount;
            endif;

        else:
            if($data['setting']['discount_price_option'] != config("upsell.strings.ppuDiscountType")[2]):
                $target_key  = $appearon['key'];
                $upsell_discount = [];
                $upsell_discount_title      = $data['name'];
                $dicount_value              = $data['setting']['upsell_discount'] ;
                $discount_product_quantity  = 1;
                $start_date                 = $data['setting']['start_date'];
                if($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[0]):
                    $dicount_value_type = "percentage";
                elseif($data['setting']['discount_price_option'] == config("upsell.strings.ppuDiscountType")[1]):
                    $dicount_value_type = "fixed_amount";
                endif;
                $res_result = $this->discountPriceRule($upsell_discount_title, $dicount_value, $discount_product_quantity, $appearOnIds, $start_date,$dicount_value_type,$target_key );
                $upsell_discount[0]['price_rule_id'] = $res_result[0];
                $upsell_discount[0]['discount_code'] = $res_result[1];
                $data['upsellDiscounts'] = $upsell_discount;
            endif;
        endif;

        // return $data;
        if($upsell->fill($data)->save()):
            return response()->json(['success' => 'Upsell Updated Successfully.', 'status' => true, 'upsell_id' => $upsell->id]);
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
    public function postPurchaseUpsellRules()
    {
        $extra = [];

        $extra [] = [ 
            'key' => 'discount_price_option', 
            'value' => [ "required", "in:".implode(',',config('upsell.strings.ppuDiscountType')) ],
        ];
        // Timer Text --- Input Field
        $extra [] = [ 'key' => 'thank_you_timer_text', 'value' => [ "required","string"]];
        // Timer Text Color rules ---- color
        $extra [] = [ 'key' => 'thank_you_timer_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        // Timer BG Color rules ---- color
        $extra [] = [ 'key' => 'thank_you_timer_text_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        // Timer Color rules ---- color
        $extra [] = [ 'key' => 'thank_you_timer_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];

        // slider arrow icon rules ---- color
        $extra [] = [ 'key' => 'arrow_icon_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        // slider arrow icon rules ---- background color
        $extra [] = [ 'key' => 'arrow_icon_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];

        //  time toggler rules ----
        $extra [] = [ 'key' => 'time_limit_toggler', 'value' => [ "nullable","in:1" ] ];
        $extra [] = [ 'key' => 'timer_duration', 'value' => [ "required_if:time_limit_toggler,1","min:0","numeric"]];
        $extra [] = [ 'key' => 'timer_font_family', 'value' => [ "required_if:time_limit_toggler,1","string","in:".implode(',',config('upsell.strings.fontFamily')) ] ];
        $extra [] = [ 'key' => 'timer_font_size', 'value' => [ "required_if:time_limit_toggler,1","min:12","numeric"]];
        $extra [] = [ 'key' => 'ppu_button_text', 'value' => [ "required","string"]];
        $extra [] = [ 'key' => 'upsell_discount', 'value' => [ "required","min:0","numeric"]];
        $extra [] = [ 'key' => 'product_title_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'my_upsell_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'sale_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'discount_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'discount_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_hover_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_hover_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'show_ppu_product_title', 'value' => [ "nullable","in:1" ] ];
        $extra [] = [ 'key' => 'show_ppu_varient_selection', 'value' => [ "nullable","in:1" ] ];
        return $extra;
    }
     
}