<?php

namespace App\Jobs;

use App\User;
use App\Models\Setting;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\ShopifyTrait;
use Osiset\ShopifyApp\Actions\CancelCurrentPlan;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use Osiset\ShopifyApp\Contracts\Queries\Shop as IShopQuery;
use Osiset\ShopifyApp\Contracts\Commands\Shop as IShopCommand;
use stdClass;

class AppUninstalledJob extends \Osiset\ShopifyApp\Messaging\Jobs\AppUninstalledJob
{
    // use ShopifyTrait,CommonTrait;
    // protected $domain;
    // protected $data;

    // public function __construct(domain $domain)
    // {
    //     $this->domain = $domain;
    // }
    
    // public function __construct(string $domain, stdClass $data)
    // {
    //     $this->domain = $domain;
    //     $this->data = $data;
    //     info($this->domain);
    // }


    // public function handle(
    //     IShopCommand $shopCommand,
    //     IShopQuery $shopQuery,
    //     CancelCurrentPlan $cancelCurrentPlanAction
    // ): bool {
    //     // Convert the domain
    //     $this->domain = ShopDomain::fromNative($this->domain);

    //     // Get the shop
    //     $shop = $shopQuery->getByDomain($this->domain);
    //     info($shop);
    //     $shopId = $shop->getId();
    //     info($shopId);
    //     // Cancel the current plan
    //     $cancelCurrentPlanAction($shopId);

    //     // Purge shop of token, plan, etc.
    //     $shopCommand->clean($shopId);

    //     // Soft delete the shop.
    //     $shopCommand->softDelete($shopId);

    //     return true;
    // }
    
    // public function handle(IShopCommand $shopCommand,IShopQuery $shopQuery,CancelCurrentPlan $cancelCurrentPlanAction)
    // : bool{

    //     $shop = User::where('name' , $this->domain)->first();
    //     info($shop);
    //     info('shop accessible');
    //     if($shop):
            // $shop->status = false;
            // $shop->settings->update([
            //     'setup' => false,
            //     'scripttag' => false,
            //     'script_tag_id' => null,
            //     'trial_ends' => null,
            // ]);
            // $shop->shopify_freemium = false;
            // $shop->save();
    //         // $shop->products()->delete();
    //         // if($shop->settings->store_email !=null){
    //         //     $this->UninstallEmail(['name'=>$shop->settings->store_name,'email'=>$shop->settings->store_email]);
    //         // }
    //         // package logic to uninstall app
    //         $shop = $shopQuery->getByDomain($this->domain);
    //         $shopId = $shop->getId();
    //         $cancelCurrentPlanAction($shopId);
    //         $shopCommand->clean($shopId);
    //         $shopCommand->softDelete($shopId);
    //     endif;
    //     return true;
    // }
}