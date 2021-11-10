<?php namespace App\Jobs;

use App\Models\Order;
use App\Models\Upsell;
use App\Models\UpsellStats;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use stdClass;

class OrdersUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain|string
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain.
     * @param stdClass $data       The webhook data (JSON decoded).
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // info(json_encode($this->data));
        $last_customer_order = Order::where('checkout_token',$this->data->checkout_token)->first();
        // info($last_customer_order->variant_id);
        foreach($this->data->line_items as $line_item):
            if(isset($last_customer_order->variant_id)):
                if($line_item->variant_id == $last_customer_order->variant_id):
                    $item_purchased_by_alphaUpsell = $line_item;
                endif;
            endif;
        endforeach;
        if($item_purchased_by_alphaUpsell):
            $item_purchased_by_upsell_price = ($item_purchased_by_alphaUpsell->price * $item_purchased_by_alphaUpsell->quantity) - $item_purchased_by_alphaUpsell->total_discount;
        endif;
        $upsell = Upsell::where('id',$last_customer_order->upsell_id)->first();

        $this->UpsellTracker('add_to_cart', 1, $last_customer_order->upsell_id);
        $this->UpsellTracker('transactions', $item_purchased_by_upsell_price, $last_customer_order->upsell_id);
        $this->UpsellTracker('sells', 1, $last_customer_order->upsell_id);

        Order::where('checkout_token',$this->data->checkout_token)
        ->update([
            'checkout_token' => NULL,
            'upsell_id'      => NULL,
            'variant_id'     => NULL
        ]);
        // info($updated_data);
        // Convert domain
        // $this->shopDomain = ShopDomain::fromNative($this->shopDomain);

        // Do what you wish with the data
        // Access domain name as $this->shopDomain->toNative()
    }

    public function UpsellTracker($stats_type, $value, $upsell_id){
        $upsell_data =  $upsell_data  = Upsell::where('id',$upsell_id)->first();
        $upsell_stats = UpsellStats::where('upsell_id',$upsell_id)
            ->where('type',$stats_type)
            ->where('upsell_created_at',today()->format('Y-m-d'))
            ->first();
        if($upsell_stats != null):
            $updated_value = $upsell_stats->value;
            $updated_value += $value;
            UpsellStats::where('id',$upsell_stats->id)
            ->update([
                'value' => $updated_value,
                'upsell_created_at' => today()->format('Y-m-d'),
            ]);
            return response()->json(['status' =>true ]);
        else:
            // dd($upsell_stats);
            $upsell_data->upsellStats()->create([
                'type'  => $stats_type,
                'value' => $value,
                'upsell_created_at' => today()->format('Y-m-d'),
            ]);
            return response()->json(['status' =>true ]);  
        endif;
    }
}
