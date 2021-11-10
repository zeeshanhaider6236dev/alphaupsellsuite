<?php
namespace App\Http\Traits;

use App\Models\Upsell;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\CommonValidationTrait;
use Illuminate\Support\Str;

trait VolumeDiscountTrait {

    use CommonValidationTrait,CommonTrait;

    public function add_volume_discount_upsell($upsellType)
    {

       $extra = array_merge($this->targettedProductsRules(), $this->whichDeviceRules(), $this->scheduleRules(), $this->preivewHeadingRules("volume_discount_heading"), $this->addVolumeDiscountUpsellRules());
        $validated = $this->validation(['createUpsellForm'],$extra);
        if(!is_array($validated)):
            return $validated;
        endif;

        $data = [
            'name'              => $validated['name'],
            'upsell_type_id'    => $upsellType->id,
            'user_id'           => auth()->user()->id,

        ];


        if($validated):
            $array = ['products','collections','tags'];
            foreach ($array as $value2) :
                if(isset($validated['T'.$value2])):
                        $targetted = ['key' => 'T'.$value2, 'values' => $validated['T'.$value2]];
                    unset($validated['T'.$value2]);
                endif;
            endforeach;
       endif;
        unset($validated['name']);
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        $targetkey = $targetted['key'];
        $targetedData = [];
        $targeted_product_ids = [];
        $targeted_collection_ids = [];
        $collection_product_ids = [];
        $targeted_tag_ids = [];
        $shop = auth()->user();
        foreach($targetted ['values'] as $key => $value):
            $targeted_product_ids[] = $value;
            $targeted_collection_ids[] = $value;
            $targeted_tag_ids[] = $value;
            $targetedData[] = [
                'shopify_'.Str::singular(substr($targetkey, 1))."_id" => $value,
                'shopify_'.Str::singular(substr($targetkey, 1))."_image" => $validated[$targetted['key'].'images'][$key],
                'shopify_'.Str::singular(substr($targetkey, 1))."_title" => $validated[$targetted['key'].'titles'][$key]
            ];
        endforeach;
        $data[ $targetted['key'] ] =  $targetedData;
        $data['volumeDiscounts'] = array_map(function($elements1,$elements2,$elements3,$elements4){

                return ['quantity' => $elements1, 'discount' => $elements2, 'discount_type' => $elements3, 'best_deal' => $elements4];

            },$validated['quantity'],$validated['discount'],$validated['offer'],$validated['bestdeal']);

        unset($validated['quantity'], $validated['discount'], $validated['offer'], $validated['bestdeal']);
        // dd($data['volumeDiscounts']);
        foreach ($data['volumeDiscounts'] as $key => $deal):
            $deal_title = $data['name'];
            if($deal['discount_type'] == '% Off'):
                if($targetkey == "Tproducts"):

                    $discount_value = $deal['discount'];
                    $quantity = $deal['quantity'];
                    $start_date = $validated['start_date'];
                    $entitled_ids = $targeted_product_ids;
                    $value_type = "percentage";
                    $discounts_array = $this->discountPriceRule($deal_title, $discount_value, $quantity, $entitled_ids, $start_date, $value_type, $targetkey);
                    $deal['price_rule_id'] = $discounts_array[0];
                    $data['volumeDiscounts'][$key] = $deal;
                    $deal['discount_code'] = $discounts_array[1];
                    $data['volumeDiscounts'][$key] = $deal;
                elseif($targetkey == "Tcollections"):

                    $discount_value = $deal['discount'];
                    $quantity = $deal['quantity'];
                    $start_date = $validated['start_date'];
                    $entitled_ids = $targeted_collection_ids;
                    $value_type = "percentage";
                    $discounts_array = $this->discountPriceRule($deal_title, $discount_value, $quantity, $entitled_ids, $start_date, $value_type, $targetkey);
                    $deal['price_rule_id'] = $discounts_array[0];
                    $data['volumeDiscounts'][$key] = $deal;
                    $deal['discount_code'] = $discounts_array[1];
                    $data['volumeDiscounts'][$key] = $deal;

                else:
                    $targeted_tag_ids = [
                    'shopify_'.Str::singular(substr($targetkey, 1))."_id" => $value];

                endif;
            elseif($deal['discount_type'] == 'Fixed Amount'):
                if($targetkey == "Tproducts"):

                    $discount_value = $deal['discount'];
                    $quantity = $deal['quantity'];
                    $start_date = $validated['start_date'];
                    $entitled_ids = $targeted_product_ids;
                    $value_type = "fixed_amount";
                    $discounts_array = $this->discountPriceRule($deal_title, $discount_value, $quantity, $entitled_ids, $start_date, $value_type, $targetkey);
                    $deal['price_rule_id'] = $discounts_array[0];
                    $data['volumeDiscounts'][$key] = $deal;
                    $deal['discount_code'] = $discounts_array[1];
                    $data['volumeDiscounts'][$key] = $deal;

                elseif($targetkey == "Tcollections"):

                    $discount_value = $deal['discount'];
                    $quantity = $deal['quantity'];
                    $start_date = $validated['start_date'];
                    $entitled_ids = $targeted_collection_ids;
                    $value_type = "fixed_amount";
                    $discounts_array = $this->discountPriceRule($deal_title, $discount_value, $quantity, $entitled_ids, $start_date, $value_type, $targetkey);
                    $deal['price_rule_id'] = $discounts_array[0];
                    $data['volumeDiscounts'][$key] = $deal;
                    $deal['discount_code'] = $discounts_array[1];
                    $data['volumeDiscounts'][$key] = $deal;
                else:
                    $targeted_tag_ids = [
                    'shopify_'.Str::singular(substr($targetkey, 1))."_id" => $value];

                endif;
            endif;
        endforeach;
        foreach (["T","A"] as $value) :
            foreach ($array as $value2) :
                if(isset($validated[$value.$value2.'images'])):
                    unset($validated[$value.$value2.'images'],$validated[$value.$value2.'titles']);
                endif;
            endforeach;
        endforeach;
        $data['setting'] = $validated;
        $upsell = new Upsell($data);
        $upsell_id = $upsell['id'];
        if($upsell_id):

            return response()->json(['success' => 'Upsell Added Successfully.', 'status' => true, 'upsell_id' => $upsell_id]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }

    public function update_volume_discount_upsell($upsell)
    {
       // delete previous price rules in shopfiy for current upsell
       foreach ($upsell['volumeDiscounts'] as $volume_discount):
            $get_price_rule = $volume_discount['price_rule_id'];
            $del_price_rule = $this->deletePriceRule($get_price_rule);
       endforeach;
       $extra = array_merge($this->targettedProductsRules(), $this->whichDeviceRules(), $this->scheduleRules(), $this->preivewHeadingRules("volume_discount_heading"), $this->addVolumeDiscountUpsellRules());
        $validated = $this->validation(['createUpsellForm'],$extra);
        if(!is_array($validated)):
            return $validated;
        endif;

        $data = [
            'name'              => $validated['name'],
            'id'                => $upsell->id,
            'user_id'           => auth()->user()->id,

        ];

        $data['Tproducts'] = $data['Tcollections'] = $data['Ttags'] = [];
        $data['Aproducts'] = $data['Acollections'] = $data['Atags'] = [];
        if($validated):
            $array = ['products','collections','tags'];
            foreach ($array as $value2) :
                if(isset($validated['T'.$value2])):
                        $targetted = ['key' => 'T'.$value2, 'values' => $validated['T'.$value2]];
                    unset($validated['T'.$value2]);
                endif;
            endforeach;
       endif;
        unset($validated['name']);
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        $targetkey = $targetted['key'];
        $targetedData = [];
        $targeted_product_ids = [];
        $targeted_collection_ids = [];
        $collection_product_ids = [];
        $targeted_tag_ids = [];
        $shop = auth()->user();
        foreach($targetted ['values'] as $key => $value):
            $targeted_product_ids[] = $value;
            $targeted_collection_ids[] = $value;
            $targeted_tag_ids[] = $value;
            $targetedData[] = [
                'shopify_'.Str::singular(substr($targetkey, 1))."_id" => $value,
                'shopify_'.Str::singular(substr($targetkey, 1))."_image" => $validated[$targetted['key'].'images'][$key],
                'shopify_'.Str::singular(substr($targetkey, 1))."_title" => $validated[$targetted['key'].'titles'][$key]
            ];
        endforeach;
        $data[ $targetted['key'] ] =  $targetedData;
        $data['volumeDiscounts'] = array_map(function($elements1,$elements2,$elements3,$elements4){

                return ['quantity' => $elements1, 'discount' => $elements2, 'discount_type' => $elements3, 'best_deal' => $elements4];

            },$validated['quantity'],$validated['discount'],$validated['offer'],$validated['bestdeal']);

        unset($validated['quantity'], $validated['discount'], $validated['offer'], $validated['bestdeal']);
        foreach ($data['volumeDiscounts'] as $key => $deal):
            $deal_title = $data['name'];
            if($deal['discount_type'] == '% Off'):
                if($targetkey == "Tproducts"):

                    $discount_value = $deal['discount'];
                    $quantity = $deal['quantity'];
                    $start_date = $validated['start_date'];
                    $entitled_ids = $targeted_product_ids;
                    $value_type = "percentage";
                    $discounts_array = $this->discountPriceRule($deal_title, $discount_value, $quantity, $entitled_ids, $start_date, $value_type, $targetkey);
                    $deal['price_rule_id'] = $discounts_array[0];
                    $data['volumeDiscounts'][$key] = $deal;
                    $deal['discount_code'] = $discounts_array[1];
                    $data['volumeDiscounts'][$key] = $deal;
                elseif($targetkey == "Tcollections"):
                    $discount_value = $deal['discount'];
                    $quantity = $deal['quantity'];
                    $start_date = $validated['start_date'];
                    $entitled_ids = $targeted_collection_ids;
                    $value_type = "percentage";
                    $discounts_array = $this->discountPriceRule($deal_title, $discount_value, $quantity, $entitled_ids, $start_date, $value_type, $targetkey);
                    $deal['price_rule_id'] = $discounts_array[0];
                    $data['volumeDiscounts'][$key] = $deal;
                    $deal['discount_code'] = $discounts_array[1];
                    $data['volumeDiscounts'][$key] = $deal;
                else:
                    $targeted_tag_ids = [
                    'shopify_'.Str::singular(substr($targetkey, 1))."_id" => $value];

                endif;
            elseif($deal['discount_type'] == 'Fixed Amount'):
                if($targetkey == "Tproducts"):

                    $discount_value = $deal['discount'];
                    $quantity = $deal['quantity'];
                    $start_date = $validated['start_date'];
                    $entitled_ids = $targeted_product_ids;
                    $value_type = "fixed_amount";
                    $discounts_array = $this->discountPriceRule($deal_title, $discount_value, $quantity, $entitled_ids, $start_date, $value_type, $targetkey);
                    $deal['price_rule_id'] = $discounts_array[0];
                    $data['volumeDiscounts'][$key] = $deal;
                    $deal['discount_code'] = $discounts_array[1];
                    $data['volumeDiscounts'][$key] = $deal;

                elseif($targetkey == "Tcollections"):

                    $discount_value = $deal['discount'];
                    $quantity = $deal['quantity'];
                    $start_date = $validated['start_date'];
                    $entitled_ids = $targeted_collection_ids;
                    $value_type = "fixed_amount";
                    $discounts_array = $this->discountPriceRule($deal_title, $discount_value, $quantity, $entitled_ids, $start_date, $value_type, $targetkey);
                    $deal['price_rule_id'] = $discounts_array[0];
                    $data['volumeDiscounts'][$key] = $deal;
                    $deal['discount_code'] = $discounts_array[1];
                    $data['volumeDiscounts'][$key] = $deal;
                else:
                    $targeted_tag_ids = [
                    'shopify_'.Str::singular(substr($targetkey, 1))."_id" => $value];
                endif;
            endif;
        endforeach;
        $array = ['products','collections','tags'];
        foreach (["T"] as $value) :
            foreach ($array as $value2) :
                if(isset($validated[$value.$value2.'images'])):
                    unset($validated[$value.$value2.'images'],$validated[$value.$value2.'titles']);
                endif;
            endforeach;
        endforeach;
        $data['setting'] = $validated;
        if($upsell->fill($data)->save()):
            return response()->json(['success' => 'Upsell Updated Successfully.', 'status' => true, 'upsell_id' => $upsell->id]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }



    public function addVolumeDiscountUpsellRules()
    {
        $quantityCount  = count(request()->quantity);
        $extra = [];
        $extra [] = [ 'key' => 'quantity', 'value' => [ "required", 'array' ] ];
        $extra [] = [ 'key' => 'quantity.*', 'value' => [ "required", 'numeric', 'min:1' ] ];
        $extra [] = [ 'key' => 'discount', 'value' => [ "required", 'array', "size : $quantityCount" ] ];
        $extra [] = [ 'key' => 'discount.*', 'value' => [ "required", 'numeric' ] ];
        $extra [] = [ 'key' => 'offer', 'value' => [ "required", 'array', "size : $quantityCount" ] ];
        $extra [] = [ 'key' => 'offer.*', 'value' => [ "required", 'string' ] ];
        $extra [] = [ 'key' => 'bestdeal', 'value' => [ "required", 'array', "size : $quantityCount" ] ];
        $extra [] = [ 'key' => 'bestdeal.*', 'value' => [ "required", "in:1,0"] ];
        $extra [] = [ 'key' => 'quantity_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'best_deal_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'original_total_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'discount_total_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'discount_badge_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'discount_badge_background', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'hover_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'container_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        return $extra;

    }
}
