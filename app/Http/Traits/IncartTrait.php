<?php
namespace App\Http\Traits;

use App\Models\Upsell;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\CommonValidationTrait;
use Illuminate\Support\Str;

trait IncartTrait {

    use CommonValidationTrait,CommonTrait;

    public function add_in_cart_upsell($upsellType)
    {
       
        $extra = array_merge($this->productRules(), $this->whichDeviceRules(), $this->scheduleRules(), $this->preivewHeadingRules("incart_heading"), $this->addIncartUpsellRules());
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
        endif;
        unset($validated['name']);
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        if(!isset($validated['count_down_timer'])):
            $validated['count_down_timer'] = 0;
            $validated['time_duration_minutes'] = 0;
        endif;
        if(!isset($validated['show_product_title'])):
            $validated['show_product_title'] = 0;
        endif;
        if(!isset($validated['show_variant_selection'])):
            $validated['show_variant_selection'] = 0;
        endif;
        if(!isset($validated['show_compare_price'])):
            $validated['show_compare_price'] = 0;
        endif;
        $targetkey = $targetted['key'];
        $targetedData = [];
        foreach($targetted ['values'] as $key => $value):
            $targetedData[] = [
                'shopify_'.Str::singular(substr($targetkey, 1))."_id" => $value,
                'shopify_'.Str::singular(substr($targetkey, 1))."_image" => $validated[$targetted['key'].'images'][$key],
                'shopify_'.Str::singular(substr($targetkey, 1))."_title" => $validated[$targetted['key'].'titles'][$key]
            ];
        endforeach;
        $data[ $targetted['key'] ] =  $targetedData;

        if(isset($appearon)):
            $appearonkey = $appearon['key'];
            $appearonData = [];

            foreach($appearon ['values'] as $key => $value):
                $appearonData[] = [
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_id"    => $value,
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_image" => $validated[$appearon['key'].'images'][$key],
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_title" => $validated[$appearon['key'].'titles'][$key],
                    'type'                                                     => "appearOn"
                ];
            endforeach;
            $data[ $appearon['key'] ] = $appearonData;
        endif;
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

    public function update_in_cart_upsell($upsell)
    {
       
        $extra = array_merge($this->productRules(), $this->whichDeviceRules(), $this->scheduleRules(), $this->preivewHeadingRules("incart_heading"), $this->addIncartUpsellRules());
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
        endif;
        unset($validated['name']);
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        if(!isset($validated['count_down_timer'])):
            $validated['count_down_timer'] = 0;
            $validated['time_duration_minutes'] = 0;
        endif;
        if(!isset($validated['show_product_title'])):
            $validated['show_product_title'] = 0;
        endif;
        if(!isset($validated['show_variant_selection'])):
            $validated['show_variant_selection'] = 0;
        endif;
        if(!isset($validated['show_compare_price'])):
            $validated['show_compare_price'] = 0;
        endif;
        $targetkey = $targetted['key'];
        $targetedData = [];
        foreach($targetted ['values'] as $key => $value):
            $targetedData[] = [
                'shopify_'.Str::singular(substr($targetkey, 1))."_id" => $value,
                'shopify_'.Str::singular(substr($targetkey, 1))."_image" => $validated[$targetted['key'].'images'][$key],
                'shopify_'.Str::singular(substr($targetkey, 1))."_title" => $validated[$targetted['key'].'titles'][$key]
            ];
        endforeach;
        $data[ $targetted['key'] ] =  $targetedData;
        if(isset($appearon)):
            $appearonkey = $appearon['key'];
            $appearonData = [];

            foreach($appearon ['values'] as $key => $value):
                $appearonData[] = [
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_id"    => $value,
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_image" => $validated[$appearon['key'].'images'][$key],
                    'shopify_'.Str::singular(substr($appearonkey, 1))."_title" => $validated[$appearon['key'].'titles'][$key],
                    'type'                                                     => "appearOn"
                ];
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
        if($upsell->fill($data)->save()):
            return response()->json(['success' => 'Upsell Updated Successfully.', 'status' => true, 'upsell_id' => $upsell->id]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }

    public function addIncartUpsellRules()
    {
        $extra = [];
       
        $extra [] = [ 'key' => 'discount_type', 'value' => [ "required","string" ] ];
        $extra [] = [ 'key' => 'discount_value', 'value' => [ "required","numeric" ] ];
        $extra [] = [ 'key' => 'count_down_timer', 'value' => [ "nullable","in:1,0" ] ];
        $extra [] = [ 'key' => 'time_duration_minutes', 'value' => [ "required_if:count_down_timer,1","min:0","numeric"]];
        $extra [] = [ 'key' => 'timer_font_family', 'value' => [ "required", 'string', 'in:'.implode(',',config('upsell.strings.fontFamily')) ] ];
        $extra [] = [ 'key' => 'button_text', 'value' => [ "required", 'string']];
        $extra [] = [ 'key' => 'timer_font_size', 'value' => [ "required", 'numeric', 'min:12', 'max:50' ] ];
        $extra [] = [ 'key' => 'show_product_title', 'value' => [ "nullable", "in:1,0"] ];
        $extra [] = [ 'key' => 'show_variant_selection', 'value' => [ "nullable", "in:1,0"] ];

        $extra [] = [ 'key' => 'timer_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'timer_text_bg_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        
        $extra [] = [ 'key' => 'show_compare_price', 'value' => [ "nullable", "in:1,0"] ];
        $extra [] = [ 'key' => 'product_title_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'upsell_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'sale_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'compare_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_hover_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_hover_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        return $extra;
    }
}