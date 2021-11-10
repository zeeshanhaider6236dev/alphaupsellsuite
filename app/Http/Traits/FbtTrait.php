<?php
namespace App\Http\Traits;

use App\Models\Upsell;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\CommonValidationTrait;
use Illuminate\Support\Str;

trait FbtTrait {

    use CommonValidationTrait,CommonTrait;

    /**
     * 
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This Function will add the new upsell
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function add_frequently_bought_together_upsell($upsellType)
    {
        // return request();
        $extra = array_merge($this->productRules(), $this->whichDeviceRules(), $this->scheduleRules(), $this->preivewHeadingRules(), $this->addSpecificRules());
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
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        if(!isset($validated['show_sale_badge_on_image'])):
            $validated['show_sale_badge_on_image'] = 0;
        endif;
        if(!isset($validated['show_compare_price_available'])):
            $validated['show_compare_price_available'] = 0;
        endif;
        if(!isset($validated['show_original_total_price'])):
            $validated['show_original_total_price'] = 0;
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
        // return $data;
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
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This Function will update the existing upsell
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * 
     */
    public function update_frequently_bought_together_upsell($upsell)
    {
        // return request();
        $extra = array_merge($this->productRules(), $this->whichDeviceRules(), $this->scheduleRules(), $this->preivewHeadingRules(), $this->addSpecificRules());
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
        $data['Tproducts'] = $data['Tcollections'] = $data['Ttags'] = [];
        $data['Aproducts'] = $data['Acollections'] = $data['Atags'] = [];
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
        if(!isset($validated['work_on_desktop'])):
            $validated['work_on_desktop'] = 0;
        endif;
        if(!isset($validated['work_on_mobile'])):
            $validated['work_on_mobile'] = 0;
        endif;
        if(!isset($validated['show_sale_badge_on_image'])):
            $validated['show_sale_badge_on_image'] = 0;
        endif;
        if(!isset($validated['show_compare_price_available'])):
            $validated['show_compare_price_available'] = 0;
        endif;
        if(!isset($validated['show_original_total_price'])):
            $validated['show_original_total_price'] = 0;
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
        
        // return $data;
        if($upsell->fill($data)->save()):
            return response()->json(['success' => 'Upsell Updated Successfully.', 'status' => true, 'upsell_id' => $upsell->id]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }

    public function addSpecificRules()
    {
        $extra = [];
        $extra [] = [ 'key' => 'location_of_fbt', 'value' => [ "required", "in:".implode(',',config('upsell.strings.fbtLocation')) ] ];
        $extra [] = [ 'key' => 'button_text', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'this_item', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'sale_badge_text', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'total_price_text', 'value' => [ "required", "string", 'max:191' ] ];
        $extra [] = [ 'key' => 'product_title_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'sale_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'compare_price_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_border_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_hover_text_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'button_hover_background_color', 'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] ];
        $extra [] = [ 'key' => 'show_original_total_price', 'value' => [ 'nullable', 'in:1' ] ];
        $extra [] = [ 'key' => 'show_compare_price_available', 'value' => [ 'nullable', 'in:1' ] ];
        $extra [] = [ 'key' => 'show_sale_badge_on_image', 'value' => [ 'nullable', 'in:1' ] ];
        return $extra;
    }
}