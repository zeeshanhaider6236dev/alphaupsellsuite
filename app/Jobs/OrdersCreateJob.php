<?php namespace App\Jobs;

use App\Models\Order;
use App\Models\Upsell;
use App\Models\UpsellDiscount;
use App\Models\UpsellStats;
use App\Models\UpsellVolumeDiscount;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;

class OrdersCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;
    public $upsellData;
    public $orders;
    public $revenue = 0;
    public $upsellId;
    public $flag = false;
    public $order;
    public $index; //Get index of discount applocation in order
    public $atc_upsell_id;


    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain
     * @param stdClass $data    The webhook data (JSON decoded)
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
        $this->order = Order::where('shopify_order_id',$this->data->id)->first();
        if(!$this->order):
            $this->user = User::where('name', $this->shopDomain)->whereNotNull('password')->first();
            $this->user->orders()->create([
                'shopify_order_id' => $this->data->id,
                'order'  => $this->data,
                'shopify_created_at' => Carbon::parse($this->data->created_at),
                'shopify_updated_at' => Carbon::parse($this->data->updated_at),
            ]);
        endif;

        /**
         *
         * =============================================================
         * Upsell Tracking For Post Purchase Upsell and Volume Discount
         * =============================================================
         *
         */

        if(!$this->order):
            if(count($this->data->discount_codes)):
                // info($this->data->line_items[0]->quantity);
                $this->revenue  += ($this->data->line_items[0]->price * $this->data->line_items[0]->quantity) - $this->data->line_items[0]->discount_allocations[0]->amount;
                $alpha_upsell_discount_code = $this->data->discount_codes[0]->code;
                $upsell_idTrack = UpsellDiscount::where('discount_code',$alpha_upsell_discount_code)->first();
                if($upsell_idTrack == null):
                    $upsell_idTrack = UpsellVolumeDiscount::where('discount_code',$alpha_upsell_discount_code)->first();
                endif;
                $upsell_data  = Upsell::where('id',$upsell_idTrack->upsell_id)->first();
                $upsell_stats = UpsellStats::where('upsell_id',$upsell_idTrack->upsell_id)
                    ->where('type','transactions')
                    ->where('upsell_created_at',today()->format('Y-m-d'))
                    ->first();
                if($upsell_stats != null):
                    $updated_value = $upsell_stats->value;
                    $updated_value += $this->revenue;
                    UpsellStats::where('id',$upsell_stats->id)
                    ->update([
                        'value' => $updated_value,
                        'upsell_created_at' => today()->format('Y-m-d'),
                    ]);
                else:
                    $upsell_data->upsellStats()->create([
                        'type'  => 'transactions',
                        'value' => $this->revenue,
                        'upsell_created_at' => today()->format('Y-m-d'),
                    ]);
                endif;
                $upsell_stats = UpsellStats::where('upsell_id',$upsell_idTrack->upsell_id)
                    ->where('type','sells')
                    ->where('upsell_created_at',today()->format('Y-m-d'))
                    ->first();
                if($upsell_stats != null):
                    $updated_value = $upsell_stats->value;
                    $updated_value += 1;
                    UpsellStats::where('id',$upsell_stats->id)
                    ->update([
                        'value' => $updated_value,
                        'upsell_created_at' => today()->format('Y-m-d'),
                    ]);
                else:
                    $upsell_data->upsellStats()->create([
                        'type'  => 'sells',
                        'value' => 1,
                        'upsell_created_at' => today()->format('Y-m-d'),
                    ]);
                endif;
            endif;
            /**
             *
             * ===============================================
             * upsell Tracking For FBT, InCart etc
             * ===============================================
             *
             */
            $upsells_data1 = [];
            foreach($this->data->line_items as $lineItem):
                if(count($lineItem->properties)):
                    if(isset($lineItem->properties[0]->name)):
                        foreach($lineItem->properties as $key => $value):
                            if($lineItem->properties[$key]->name == "_Sale_notification" || $lineItem->properties[$key]->name == "_alpha_upsell_id" || $lineItem->properties[$key]->name == "_alpha_atc_upsell_id"):
                                $this->upsellId = $lineItem->properties[$key]->value;
                                // info($this->upsellId);
                            endif;
                        endforeach;
                    else:
                        if(isset($lineItem->properties['_Sale_notification'])):
                            $this->upsellId = $lineItem->properties['_Sale_notification'];
                        elseif(isset($lineItem->properties['_alpha_upsell_id']) || $lineItem->properties[$key]->name == "_alpha_atc_upsell_id"):
                            $this->upsellId = $lineItem->properties['_alpha_upsell_id'];
                        endif;
                    endif;
                    // $this->upsellId  = $lineItem->properties[0]->value;
                    $this->revenue   = $lineItem->price * $lineItem->quantity;
                    // info($this->revenue);
                    if(!isset($upsell_data[$this->upsellId])):
                        // info($upsell_data);
                        $upsell_data[$this->upsellId] = ['upsell_id' => $this->upsellId, 'orders' => 1, 'revenue' => $this->revenue];
                    else:
                        $this->revenue += $upsell_data[$this->upsellId]['revenue'];
                        $upsell_data[$this->upsellId]['revenue'] =$this->revenue;
                    endif;
                elseif(count($lineItem->discount_allocations)):
                    $this->revenue   = ($lineItem->price - $lineItem->total_discount) ;
                    $this->index     = $lineItem->discount_allocations[0]->discount_application_index;
                    $this->atc_upsell_id = explode('_',$this->data->discount_applications[$this->index]->title);
                    $this->upsellId = $this->atc_upsell_id[count($this->atc_upsell_id)-1];
                    if(!isset($upsell_data[$this->upsellId])):
                        $upsell_data[$this->upsellId] = ['upsell_id' => $this->upsellId, 'orders' => 1, 'revenue' => $this->revenue];
                    else:
                        $this->revenue += $upsell_data[$this->upsellId]['revenue'];
                        $upsell_data[$this->upsellId]['revenue'] = $this->revenue;
                    endif;
                endif;
                // info($upsell_data)
                if(isset($upsell_data) && count($upsell_data))
                {
                    $upsells_data1[0]  = $upsell_data;
                    // info($upsells_data1);
                }
            endforeach;
            foreach($upsells_data1[0] as $upsell):
                $this->upsellId  = $upsell['upsell_id'];
                $this->revenue   = $upsell['revenue'];
                $this->alphaUpsellSells($this->upsellId);
                $this->alphaUpsellTransections($this->upsellId ,$this->revenue);
            endforeach;
        endif;
    }

    /*
     * =============================================================
     *  This function (alphaUsellSells) is updating
     *  orders count in database
     * =============================================================
     *
    */

    public function alphaUpsellSells($upsell_id)
    {
        $upsell_data  = Upsell::where('id',$upsell_id)->first();
        $upsell_stats = UpsellStats::where('upsell_id',$upsell_id)
            ->where('type','sells')
            ->where('upsell_created_at',today()->format('Y-m-d'))
            ->first();
        if($upsell_stats != null):
            $updated_value = $upsell_stats->value;
            $updated_value += 1;
            UpsellStats::where('id',$upsell_stats->id)
            ->update([
                'value' => $updated_value,
                'upsell_created_at' => today()->format('Y-m-d'),
            ]);
        else:
            $upsell_data->upsellStats()->create([
                'type'  => 'sells',
                'value' => 1,
                'upsell_created_at' => today()->format('Y-m-d'),
            ]);
        endif;
    }

    /*
     * =============================================================
     *  This function (alphaUpsellTransections) is updating
     *  revenue count in database foreach upsell
     * =============================================================
     *
    */

    public function alphaUpsellTransections($upsell_id,$revenue)
    {
        $upsell_data  = Upsell::where('id',$upsell_id)->first();
        $upsell_stats = UpsellStats::where('upsell_id',$upsell_id)
            ->where('type','transactions')
            ->where('upsell_created_at',today()->format('Y-m-d'))
            ->first();
        if($upsell_stats != null):
            $updated_value = $upsell_stats->value;
            $updated_value += $revenue;
            UpsellStats::where('id',$upsell_stats->id)
            ->update([
                'value' => $updated_value,
                'upsell_created_at' => today()->format('Y-m-d'),
            ]);
        else:
            $upsell_data->upsellStats()->create([
                'type'  => 'transactions',
                'value' => $revenue,
                'upsell_created_at' => today()->format('Y-m-d'),
            ]);
        endif;
    }
}
