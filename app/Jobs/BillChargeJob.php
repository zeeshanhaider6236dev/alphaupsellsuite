<?php

namespace App\Jobs;

use App\User;
use App\UsageCharge;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BillChargeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // info('Billing Job Time '.now()->format('d-m-Y'));

        // $users  = User::with(['settings','recurringCharge'])
        //     ->withCount('billingOrder')
        //     ->whereNotNull('password')
        //     ->whereHas('settings',function($query){
        //         $query->whereDate('trial_ends','<',today());
        //     })        
        //     ->whereDoesntHave('currentUsageCharge')->orWhereHas('currentUsageCharge',function($query){
        //         $query->whereDate('billing_on','<',today()->subDays(30));
        //     })->get();
        // foreach($users as $user):
        //     $shop               = $user;
        //     $charge_id          = $user->recurringCharge->charge_id;
        //     $total_month_order  = $user->billing_order_count;
        //     $total_bill_charge  = "";
        //     switch ($total_month_order) {
        //         case $total_month_order > 50 && $total_month_order <= 100 :
        //             $total_bill_charge  = 7.99;
        //             break;
        //         case $total_month_order > 100 && $total_month_order <= 200 :
        //             $total_bill_charge  = 14.99;
        //             break;
        //         case $total_month_order > 200 && $total_month_order <= 500 :
        //             $total_bill_charge  = 29.99;
        //             break;
        //         case $total_month_order > 500 && $total_month_order <= 1000 :
        //             $total_bill_charge  = 49.99;
        //             break;
        //         case $total_month_order > 1000 && $total_month_order <= 2000 :
        //             $total_bill_charge  = 89.99;
        //             break;
        //         case $total_month_order > 2000 && $total_month_order <= 5000 :
        //             $total_bill_charge  = 139.99;
        //             break;
        //         case $total_month_order > 5000 && $total_month_order <= 10000 :
        //             $total_bill_charge  = 169.99;
        //             break;
        //         case $total_month_order > 10000 && $total_month_order <= 20000 :
        //             $total_bill_charge  = 199.99;
        //             break;
        //         case $total_month_order > 20000 && $total_month_order <= 50000 :
        //             $total_bill_charge  = 249.99;
        //             break;
        //         case $total_month_order > 50000 && $total_month_order <= 100000 :
        //             $total_bill_charge  = 349.99;
        //             break;
        //         default:
        //             # code... will discuss next
        //             break;
        //     }
        //     // $tCharges = $shop->api()->rest('GET','/admin/api/2021-04/recurring_application_charges.json')['body'];
        //     if($total_bill_charge != ""):
        //         $charge = [
        //                     "usage_charge" => [
        //                         "description" => "Upsell Charge on ".$total_month_order.' orders',
        //                         "price" => $total_bill_charge
        //                     ]
        //                 ];
        //         $chargeResponse = $shop->api()->rest('POST','/admin/api/2021-04/recurring_application_charges/'.$charge_id.'/usage_charges.json',$charge)['body']['usage_charge'];  
        //         $shop->currentUsageCharge()->update(['status' => 'DEACTIVE']);
        //         UsageCharge::create([
        //             'user_id'                 => $shop->id,
        //             'charge_id'               => $user->recurringCharge->id,
        //             'status'                  => 'ACTIVE',
        //             'usage_charge_id'         => $chargeResponse->id,
        //             'description'             => $chargeResponse->description,
        //             'price'                   => $chargeResponse->price,
        //             'usage_charge_created_at' => $chargeResponse->created_at,
        //             'billing_on'              => $chargeResponse->billing_on,
        //             'balance_used'            => $chargeResponse->balance_used,
        //             'balance_remaining'       => $chargeResponse->balance_remaining,
        //         ]); 
        //     endif;
        // endforeach;


        $users  = User::with(['settings','recurringCharge'])
            ->withCount('billingOrder')
            ->whereNotNull('password')
            ->whereHas('settings',function($query){
                $query->whereDate('trial_ends','<',today());
            })        
            ->whereDoesntHave('currentUsageCharge')->orWhereHas('currentUsageCharge',function($query){
                $query->whereDate('billing_on','<',today()->subDays(30));
            })->get();
        
        info($users);
        foreach($users as $user):
            $shop               = $user;
            $charge_id          = $user->recurringCharge->charge_id;
            $total_month_order  = $user->billing_order_count;
            $total_bill_charge  = "";
            switch ($total_month_order) {
                case $total_month_order > 50 && $total_month_order <= 100 :
                    $total_bill_charge  = 7.99;
                    break;
                case $total_month_order > 100 && $total_month_order <= 200 :
                    $total_bill_charge  = 14.99;
                    break;
                case $total_month_order > 200 && $total_month_order <= 500 :
                    $total_bill_charge  = 29.99;
                    break;
                case $total_month_order > 500 && $total_month_order <= 1000 :
                    $total_bill_charge  = 49.99;
                    break;
                case $total_month_order > 1000 && $total_month_order <= 2000 :
                    $total_bill_charge  = 89.99;
                    break;
                case $total_month_order > 2000 && $total_month_order <= 5000 :
                    $total_bill_charge  = 139.99;
                    break;
                case $total_month_order > 5000 && $total_month_order <= 10000 :
                    $total_bill_charge  = 169.99;
                    break;
                case $total_month_order > 10000 && $total_month_order <= 20000 :
                    $total_bill_charge  = 199.99;
                    break;
                case $total_month_order > 20000 && $total_month_order <= 50000 :
                    $total_bill_charge  = 249.99;
                    break;
                case $total_month_order > 50000 && $total_month_order <= 100000 :
                    $total_bill_charge  = 349.99;
                    break;
                default:
                    # code... will discuss next
                    break;
            }
            // $tCharges = $shop->api()->rest('GET','/admin/api/2021-04/recurring_application_charges.json')['body'];
            if($total_bill_charge != ""):
                $charge = [
                            "usage_charge" => [
                                "description" => "Upsell Charge on ".$total_month_order.' orders',
                                "price" => $total_bill_charge
                            ]
                        ];
                $chargeResponse = $shop->api()->rest('POST','/admin/api/2021-04/recurring_application_charges/'.$charge_id.'/usage_charges.json',$charge)['body']['usage_charge'];  
                $shop->currentUsageCharge()->update(['status' => 'DEACTIVE']);
                UsageCharge::create([
                    'user_id'                 => $shop->id,
                    'charge_id'               => $user->recurringCharge->id,
                    'status'                  => 'ACTIVE',
                    'usage_charge_id'         => $chargeResponse->id,
                    'description'             => $chargeResponse->description,
                    'price'                   => $chargeResponse->price,
                    'usage_charge_created_at' => $chargeResponse->created_at,
                    'billing_on'              => $chargeResponse->billing_on,
                    'balance_used'            => $chargeResponse->balance_used,
                    'balance_remaining'       => $chargeResponse->balance_remaining,
                ]); 
            endif;
        endforeach;

    }
}
