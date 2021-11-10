<?php

namespace App\Jobs;

use App\Models\Upsell;
use App\Models\Setting;
use App\Models\UpsellType;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\ShopifyTrait;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AfterAuthenticateJob implements ShouldQueue
{
    use Dispatchable, SerializesModels,ShopifyTrait,CommonTrait;

    public function handle()
    {
        $shop = auth()->user();
        $setting=$shop->settings;
        $themeId = "{$this->getMainThemeId()}";
        if($setting == null):
            $shopApi = $this->shopApi(['body','shop']);
            $data = [
                'user_id'       => $shop->id,
                'themeId'       => $themeId,
                'domain'        => $shopApi['domain'],
                'currency'      => $shopApi['currency'],
                'language'      => $shopApi['primary_locale'],
                'store_name'    => $shopApi['name'],
                'store_email'   => $shopApi['email'],
                'store_phone'   => $shopApi['phone'],
                'country_name'  => $shopApi['country_name'],
                'plan_display_name' => $shopApi['plan_display_name'],
                'trial_ends' => today()->addDays(30)
            ];
            $setting = Setting::create($data);
            $shop->load('settings');
            // $this->welcomeEmail([ 
            //     'name'=> $setting->store_name,
            //     'email'=> $setting->store_email
            // ]);            
        endif;
        if($shop->settings->trial_ends == null):
            $setting->update([
                'trial_ends' => today()
            ]);
        endif;
        if(!$shop->settings->setup):
            if(Upsell::where('upsell_type_id',4)->first()):
                $scriptTag = $shop->settings->scripttag;
                if(!$scriptTag):
                    $response  = $this->createScriptTag();
                    if($response['status'] == 201):
                        $shop->settings->update(['scripttag'=> 1]);
                        $shop->settings->update(['script_tag_id'=> $response['body']['script_tag']['id']]);
                    endif;
                endif;
            endif;
            $this->createSnippetFile($themeId);
            $this->includeSnippet($themeId);
            $shop->settings->update([
                'setup' => true
            ]);
            $shop->load('settings');
        endif;
    }
}
