<?php
namespace App\Http\Traits;

use App\Models\Upsell;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\CommonValidationTrait;
use Illuminate\Support\Str;

trait SaleNotificaionTrait {

    use CommonValidationTrait,CommonTrait;

    public function add_sale_notification_upsell($upsellType)
    {
    
        $upsellCount  = Upsell::selectRaw('count(*) as count')->where(['user_id'=>auth()->user()->id,'upsell_type_id'=>'5'])->first()->count;
        if($upsellCount>=1)
        {
            return response()->json(['error' => 'You can not create more than one sale notificaion upsell']); 
        }
        $extra = array_merge($this->saleNotificaitonRules()); 
        $validated = $this->validation(['saleNotification'],$extra);
        if(!isset($validated['repeat_cycle'])):
            $validated['repeat_cycle'] = "0";
        endif;
        if(!isset($validated['hide_on_mobile'])):
            $validated['hide_on_mobile'] = "0";
        endif;
        if(!is_array($validated)):
            return $validated;
        endif;
        $data = [
            'name'              => 'Sale Notification',
            'upsell_type_id'    => $upsellType->id,
            'user_id'           => auth()->user()->id,
        ];
        
        $data['setting']['start_date'] = date("Y-m-d");
        $data['setting']['end_date']   = ""; 
        $data['setting'] = $validated;
        $upsell =  new Upsell($data);
        if( $upsell->save()):
            return response()->json(['success' => 'Upsell Added Successfully.','url' =>route('home')]);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }

    public function update_sale_notification_upsell($upsell)
    {
    
        
        $extra = array_merge($this->saleNotificaitonRules()); 
        $validated = $this->validation(['saleNotification'],$extra);
        if(!isset($validated['repeat_cycle'])):
            $validated['repeat_cycle'] = "0";
        endif;
        if(!isset($validated['hide_on_mobile'])):
            $validated['hide_on_mobile'] = "0";
        endif;
        if(!is_array($validated)):
            return $validated;
        endif;
        $data = [
            'name'              => 'Sale Notification',
            'id'                => $upsell->id,
            'user_id'           => auth()->user()->id,
        ];
        $data['setting']['start_date'] = date("Y-m-d");
        $data['setting']['end_date']   = "";
        $data['setting'] = $validated;
        // dd($data);
        if($upsell->update($data)):
            return response()->json(['success' => 'Upsell updated Successfully.']);
        else:
            return response()->json(['error' => 'Something Went Wrong.']);
        endif;
    }


    public function saleNotificaitonRules()
        {
            $extra = [];
            $extra [] = [
                'key'=>'notificationLayout',
                'value' => [ "required","string","in:".implode(',',config('upsell.strings.layout_options')) ],
            ];
            $extra [] = [
                'key'=>'initial_notification_display_time',
                'value' => [ "required","numeric","min:0" ],
            ];
            $extra [] = [
                'key'=>'delay_time_between_notification',
                'value' => [ "required","numeric","min:0" ],
            ];
            $extra [] = [ 
                'key' => 'repeat_cycle', 
                'value' => [ "nullable","in:1" ] 
            ];
            $extra [] = [ 
                'key' => 'hide_on_mobile', 
                'value' => [ "nullable","in:1" ] 
            ];
            $extra [] = [ 
                'key' => 'popup_position', 
                'value' => ["required","string","in:".implode(',',config('upsell.strings.pop_up_position')) ] 
            ];
            $extra [] = [ 
                'key' => 'product_title_font_size', 
                'value' => ["required","min:1" ] 
            ];
            $extra [] = [ 
                'key' => 'text_font_size', 
                'value' => ["required","min:1" ] 
            ];
            $extra [] = [ 
                'key' => 'product_title_weight', 
                'value' => ["required","in:".implode(',',config('upsell.strings.font_weight')) ] 
            ];
            $extra [] = [ 
                'key' => 'text_weight', 
                'value' => ["required","in:".implode(',',config('upsell.strings.font_weight')) ] 
            ];
            $extra [] = [ 
                'key' => 'product_title_color', 
                'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] 
            ];
            $extra [] = [ 
                'key' => 'background_color', 
                'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] 
            ];
            $extra [] = [ 
                'key' => 'timer_color', 
                'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] 
            ];
            $extra [] = [ 
                'key' => 'text_color', 
                'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] 
            ];
            $extra [] = [ 
                'key' => 'cross_icon_color', 
                'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] 
            ];
            $extra [] = [ 
                'key' => 'cross_icon_background_color', 
                'value' => [ "required", 'string', 'regex:'.config('upsell.strings.colorRegex') ] 
            ];
            $extra [] = [ 
                'key' => 'animation_type', 
                'value' => [ "required","in:".implode(',',config('upsell.strings.animation')) ] ,
            ];

            return $extra;

        }
     
}