<?php

namespace App\Http\Controllers;

use App\Http\Traits\FrontEndTrait;
use App\Http\Traits\ShopifyTrait;
use App\Http\Traits\UpsellTrait;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Upsell;
use App\Models\UpsellDiscount;
use App\Models\UpsellStats;
use App\Models\UpsellTemplate;
use App\Models\UpsellType;
use App\UsageCharge;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Osiset\ShopifyApp\Storage\Models\Plan;

class WelcomeController extends Controller
{
    use UpsellTrait,ShopifyTrait,FrontEndTrait;

    public function index()
    {
        $currency = Setting::select('currency')->where('user_id',auth()->user()->id)->first();
        $currency = config("currency.".$currency->currency.".currency_symbol");
        // dd($currency);
        $upsellCount            = Upsell::selectRaw('count(*) as count')->where('user_id',auth()->user()->id)->first()->count;
        $upsellTypes            = UpsellType::all();
        $saleNotification       = $upsellTypes->where('name',config('upsell.strings.sale_notification_identifier'))->first();
        $saleNotificationUpsell = Upsell::where(['user_id'=>auth()->user()->id,'upsell_type_id'=> $saleNotification->id])->first();
        if(request('from') && request('to')):
            $userUpsellsStats = DB::table('upsells')
                ->where('user_id',auth()->user()->id)
                ->join('upsell_types','upsells.upsell_type_id','upsell_types.id')
                ->join('upsell_stats','upsell_stats.upsell_id','upsells.id')
                ->select(
                    'upsells.id','upsells.name', 'upsells.priority', 'upsells.status',
                    DB::raw('upsell_types.name as upsell_type_name'),
                    DB::raw('sum(IF(type="views" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalViews'),
                    DB::raw('sum(IF(type="add_to_cart" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalAddToCart'),
                    DB::raw('sum(IF(type="transactions" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalRevenue'),
                    DB::raw('sum(IF(type="sells" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalOrders')
                )
                ->orderBy('totalRevenue', 'DESC')
                ->groupBy('upsell_stats.upsell_id')
                ->paginate(10)
                ->withQueryString();
                // dd($userUpsellsStats);
            // $userUpsellsStats->appends()
            $userUpsells = Upsell::latest()
                ->where('user_id',auth()->user()->id)
                ->with('upsellType')
                ->whereDate('created_at','>=',request('from'))
                ->whereDate('created_at','<=',request('to'))
                ->paginate(10);
            // dd($userUpsells);

            $totalStats = DB::table('upsells')
                ->where('user_id',auth()->user()->id)
                ->join('upsell_stats','upsell_id','upsells.id')
                ->select(
                    DB::raw('sum(IF(type="views" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalViews'),
                    DB::raw('sum(IF(type="add_to_cart" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalAddToCart'),
                    DB::raw('sum(IF(type="transactions" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalRevenue'),
                    DB::raw('sum(IF(type="sells" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalOrders')
                )
                ->first();
                /*
                 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                 *         Query For Graph Data
                 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                */
            $graphData = DB::table('upsells')
                ->where('user_id',auth()->user()->id)
                ->where('upsell_created_at','>=',DATE(request('from')))
                ->where('upsell_created_at','<=',DATE(request('to')))
                ->join('upsell_stats','upsell_id','upsells.id')
                ->select(
                    DB::raw('upsell_created_at'),
                    DB::raw('sum(IF(type="views" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalViews'),
                    DB::raw('sum(IF(type="add_to_cart" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalAddToCart'),
                    DB::raw('sum(IF(type="transactions" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalRevenue'),
                    DB::raw('sum(IF(type="sells" AND upsell_created_at >= DATE("'.request('from').'") AND upsell_created_at <= DATE("'.request('to').'"), value, 0))  as totalOrders'),
                )
                ->groupBy('upsell_created_at')
                ->get();

                $dateWiseStats = true;
                return view("welcome",compact('upsellCount','upsellTypes','saleNotificationUpsell','userUpsells','userUpsellsStats','totalStats','graphData','dateWiseStats', 'currency'));
            // dd($graphData);
        else:
            $userUpsells  = Upsell::latest()
                ->where('user_id',auth()->user()->id)
                ->with('upsellType','upsellTotalViews','upsellTotalAddToCart','upsellTotalRevenue','upsellTotalOrders')
                ->paginate(10);
            $userUpsells->appends(['tab'=>'menu2']);
            $totalStats   = DB::table('upsells')
                ->join('upsell_stats','upsell_id','upsells.id')
                ->where('user_id',auth()->user()->id)
                ->select(
                    // DB::raw('sum(views) as totalViews'),
                    DB::raw('sum(if(type="views",value,0)) as totalViews'),
                    DB::raw('sum(if(type="add_to_cart",value,0)) as totalAddToCart'),
                    DB::raw('sum(if(type="transactions",value,0)) as totalRevenue'),
                    DB::raw('sum(if(type="sells",value,0)) as totalOrders'))
            ->first();
            /*
             * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
             *         Query For Graph Data
             * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            */
            $graphData = DB::table('upsells')
                ->where('user_id',auth()->user()->id)
                ->join('upsell_stats','upsell_id','upsells.id')
                ->select(
                    DB::raw('upsell_created_at'),
                    DB::raw('sum(if(type="views",value,0)) as totalViews'),
                    DB::raw('sum(if(type="add_to_cart",value,0)) as totalAddToCart'),
                    DB::raw('sum(if(type="transactions",value,0)) as totalRevenue'),
                    DB::raw('sum(if(type="sells",value,0)) as totalOrders'))
            ->groupBy('upsell_created_at')
            ->get();

    	    return view("welcome",compact('upsellCount','upsellTypes','saleNotificationUpsell','userUpsells','totalStats','graphData','currency'));
        endif;
    }

    public function createUpsell(UpsellType $upsellType)
    {
        $currency = Setting::select('currency')->where('user_id',auth()->user()->id)->first();
        $currency = config("currency.".$currency->currency.".currency_symbol");
        // dd($currency);

        $saleNotification       = $upsellType->where('name',config('upsell.strings.sale_notification_identifier'))->first();
        $saleNotificationUpsell = Upsell::where(['user_id'=>auth()->user()->id,'upsell_type_id'=> $saleNotification->id])->first();
        $upsellTemplates        = UpsellTemplate::all();
        return view($this->makeViewUrl($upsellType->name),compact('upsellType','saleNotificationUpsell','upsellTemplates','currency'));
    }

    public function storeUpsell(UpsellType $upsellType)
    {
        return $this->Upsellstore($upsellType);
    }


    public function editUpsell(Upsell $upsell)
    {
        $currency = Setting::select('currency')->where('user_id',auth()->user()->id)->first();
        $currency = config("currency.".$currency->currency.".currency_symbol");

        $saleNotificationUpsell = '';
        $upsellType = $upsell->upsellType;
        if($upsellType->name == config('upsell.strings.sale_notification_identifier')):
            $saleNotification = $upsellType->where('name',config('upsell.strings.sale_notification_identifier'))->first();
            $saleNotificationUpsell = Upsell::where(['user_id'=>auth()->user()->id,'upsell_type_id'=> $saleNotification->id])->first();
        elseif($upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[0]):
            $upsell =  $upsell->load(['Tproducts','Tcollections','Ttags','Aproducts','Acollections','Atags']);
        elseif($upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[2]):
            $upsell =  $upsell->load(['Tproducts','Tcollections','Ttags','Aproducts','Acollections','Atags']);
        elseif($upsellType->name == config('upsell.strings.inCartUpsellName')):
            $upsell =  $upsell->load(['Tproducts','Tcollections','Ttags','Aproducts','Acollections','Atags']);
        endif;
        $upsellTemplates        = UpsellTemplate::all();
        return view($this->makeViewUrl($upsellType->name),compact('upsellType','saleNotificationUpsell','upsell','upsellTemplates','currency'));
    }

    public function updateUpsell(Upsell $upsell)
    {
        return $this->Upsellupdate($upsell);
    }

    public function search($tabType,$cursor = '',$type = 'after',Request $request)
    {
        $tabValues = explode(',',$request->query('tabValues'));
        $query = trim($request->query('query'));
        $arr = [];
        $limit = 50;
        $arr[] = $query ? $query  : '';
        if($cursor):
            $arr [] = $type == "after" ? "first" : "last";
            $arr[] = $limit;
            $arr[] = ','.$type.':';
            $arr [] = '"'.$cursor.'"';
        else:
            $arr [] = "first";
            $arr[] = $limit;
        endif;
        $links = null;
        switch ($tabType) {
            case 'collections':
                $response = $this->shopifyApiGraphQuery('getCollectionsBySearch',$arr,null,['body','data','collections']);
                $collections = collect($response['edges']);
                if(isset($response['pageInfo'])):
                    $links = $response['pageInfo'];
                endif;
                return view('includes.modal_collections',compact('collections','links','query','tabType','tabValues'));
                break;
            case 'tags':
                $tags = collect($this->shopifyApiGraphQuery('getTagsBySearch',null,null,['body','data','shop','productTags','edges']));
                if($query):
                    $tags = $tags->filter(function ($item) use ($query) {
                        return (stripos($item['node'], $query) !== false);
                    });
                endif;
                $tags = $tags->simplePaginate($limit);
                return view('includes.modal_tags',compact('tags','tabType','query','tabValues'));
                break;
            default:
                $response = $this->shopifyApiGraphQuery('getProductsBySearch',$arr,null,['body','data','products']);
                $products = collect($response['edges']);
                if(isset($response['pageInfo'])):
                    $links = $response['pageInfo'];
                endif;
                return view('includes.modal_products',compact('products','links','query','tabType','tabValues'));
                break;
        }
    }

    /**
     *
     * ----------------------------------------------------
     * This function accepting request from shopify store
     * and send response back to request with upsells.
     * ----------------------------------------------------
     *
     */

    public function getData()
    {
        return $this->alphaFilterUpsells();
    }
    /**
     *
     * ----------------------------------------------------
     * This function accepting request from shopify store
     * and send response back to request with post purchase
     * upsell.
     * ----------------------------------------------------
     *
     */

    public function getPostPurchaseData()
    {
        return $this->alphaPostPurchaseUpsell();
    }

    public function getIncartData()
    {
        return $this->alphaIncartUpsell();
    }

    /**
     *
     * -------------------------------------------------------------
     * This function accepting request from shoify store
     * and update the database data (add_to_carts column)
     * of requested upsell.
     * -------------------------------------------------------------
     *
     */
    public function trackUpsell()
    {
        $upsell_data  = Upsell::where('id',request('id'))->first();
        $upsell_stats = UpsellStats::where('upsell_id',request('id'))
            ->where('type','add_to_cart')
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
            return response()->json(['status' =>true ]);
        else:
            // dd($upsell_stats);
            $upsell_data->upsellStats()->create([
                'type'  => 'add_to_cart',
                'value' => 1,
                'upsell_created_at' => today()->format('Y-m-d'),
            ]);
            return response()->json(['status' =>true ]);
        endif;


        // $upsellData = upsell::select('add_to_carts')->findOrFail(request('id'));
        // $addToCart =  $upsellData->add_to_carts+1;
        // upsell::where('id',request('id'))->update([
        //     'add_to_carts' => $addToCart
        // ]);
    }

    /**
     *
     * ---------------------------------------------
     * This Function is Setting Priority of Upsell
     * ---------------------------------------------
     *
     */
    public function setPriority()
    {
        // return request('priority');
        upsell::select('priority')->findOrFail(request('upsellId'));
        upsell::where('id',request('upsellId'))->update([
            'priority' => request('priority')
        ]);
        return response()->json(['status' =>true , "success" => "Priority updated successfully"]);
    }

    /**
     *
     * ---------------------------------------------
     * Update Upsell Status
     * ---------------------------------------------
     *
     */
    public function updateStatus()
    {
        // return request();
        $status = upsell::select('status')->findOrFail(request('upsellId'));
        if($status->status == 1):
            $status = 0;
        else:
            $status = 1;
        endif;
        // return $status;
        upsell::where('id',request('upsellId'))->update([
            'status' => $status
        ]);
        return response()->json(['status' =>true , "success" => "Upsell status updated successfully"]);
    }

    /**
     *
     * ---------------------------------------------
     *  Delete Upsell
     * ---------------------------------------------
     *
     */

    public function deleteUpsell()
    {
        $res = Upsell::where('id',request('upsellId'))->findOrFail(request('upsellId'));
        if($res['upsell_type_id'] == 4):
            if($res['upsellDiscounts']->count()):
                $upsell_discount_id = $res['upsellDiscounts'][0]['price_rule_id'];
                $this->deletePriceRule($upsell_discount_id);
            endif;
        endif;
        $result = $res->delete();
        // delete previous price rules in shopfiy for current upsell
       foreach ($res['volumeDiscounts'] as $volume_discount):
            $get_price_rule = $volume_discount['price_rule_id'];
            $del_price_rule = $this->deletePriceRule($get_price_rule);
       endforeach;
        if($result):
            if($res['upsell_type_id'] == 4):
                $post_purchase_count = Upsell::where('upsell_type_id',$res['upsell_type_id'])->count();
                if(!$post_purchase_count):
                    $scriptTagId = Setting::select('script_tag_id')->where('domain',auth()->user()->name)->first();
                    $response = $this->deleteScriptTag($scriptTagId->script_tag_id);
                    if($response['status'] == 200):
                        Setting::where('domain',auth()->user()->name)->update([
                            'scripttag'     => false,
                            'script_tag_id' => null,
                        ]);
                    endif;
                endif;
            endif;
            return response()->json(['status' =>true , "success" => "Upsell Deleted successfully"]);
        endif;
    }

    /*
     *========================================
     *   Update Upsell Views (add to Cart)
     *========================================
    */
    public function countView()
    {
        return $this->updateUpsellViews(request('id'));
    }

    public function plans()
    {
        $plan_id = Plan::first()->id;
        return view('plans',compact('plan_id'));
    }

    public function test(Request $request)
    {
        info("webhook working fine");
        // return abort('404');
        // 186169229474


        // $shop = auth()->user();
        // $script_tag = $shop->api()->rest('GET','/admin/api/2021-07/script_tags.json');
        // dd($script_tag);

        // $shop = auth()->user();
        // $webhook = $shop->api()->rest('GET','/admin/api/2021-07/webhooks.json');
        // dd($webhook);

        // $shop = auth()->user();
        // $customer = $shop->api()->rest('GET','/admin/api/2021-07/customers/5583335030946.json');
        // dd($customer);
        // $shop = auth()->user();
        // $shop = $shop->api()->rest('GET','/admin/api/2021-07/shop.json')['body']['shop'];
        // dd($shop);

        // $shop = auth()->user();
        // $script_tag = $shop->api()->rest('GET','/admin/api/2021-04/script_tags.json')['body'];
        // $script_tag = $shop->api()->rest('DELETE','/admin/api/2021-04/script_tags/178145984670.json');
        // 178145984670

        // dd($script_tag);


        /*
         *=========================================================
         * Billing Testing Code
         *=========================================================
         *
        */
        // $upsell_idTrack = UpsellDiscount::where('discount_code','VD_973017645253')->first();
        // if($upsell_idTrack!=null):
        //     dd(1);
        // endif;
        // dd($upsell_idTrack);
        // $shop = auth()->user();
        // $orders = $shop->api()->rest('GET','/admin/api/2021-04/orders.json',['status' => 'any'])['body']['orders'];

        // dd($shop);
        // foreach($orders as $order):
        //     Order::create([
        //         'user_id' => 1 ,
        //         'shopify_order_id' => $order->id ,
        //         'order' => $order ,
        //         'shopify_created_at' => today()->subDays(30),
        //         'shopify_updated_at' => today()->subDays(30),
        //     ]);
        //     break;
        // endforeach;
        // dd(1);
        // $orderCount = Order::whereBetween('shopify_created_at',[today()->subDays(30),today()])->get();
        // dd($orderCount);

        // $users = User::with(['settings','recurringCharge'])
        //     ->withCount('billingOrder')
        //     ->whereNotNull('password')
        //     ->whereHas('settings',function($query){
        //         $query->whereDate('trial_ends','<',today());
        //     })
        //     ->whereDoesntHave('currentUsageCharge')->orWhereHas('currentUsageCharge',function($query){
        //         $query->whereDate('billing_on','<',today()->subDays(30));
        //     })->get();
        // dd($users);
        // foreach($users as $user):
        //     $charge_id          = $user->recurringCharge->charge_id;
        //     $total_month_order  = $user->billing_order_count;
        //     $total_bill_charge;
        //     switch ($total_month_order) {
        //         case $total_month_order > 50 && $total_month_order <= 100 :
        //             $total_bill_charge = 7.99;
        //             break;
        //         case $total_month_order > 100 && $total_month_order <= 200 :
        //             $total_bill_charge = 14.99;
        //             break;
        //         case $total_month_order > 200 && $total_month_order <= 500 :
        //             $total_bill_charge = 29.99;
        //             break;
        //         case $total_month_order > 500 && $total_month_order <= 1000 :
        //             $total_bill_charge = 49.99;
        //             break;
        //         case $total_month_order > 1000 && $total_month_order <= 2000 :
        //             $total_bill_charge = 89.99;
        //             break;
        //         case $total_month_order > 2000 && $total_month_order <= 5000 :
        //             $total_bill_charge = 139.99;
        //             break;
        //         case $total_month_order > 5000 && $total_month_order <= 10000 :
        //             $total_bill_charge = 169.99;
        //             break;
        //         case $total_month_order > 10000 && $total_month_order <= 20000 :
        //             $total_bill_charge = 199.99;
        //             break;
        //         case $total_month_order > 20000 && $total_month_order <= 50000 :
        //             $total_bill_charge = 249.99;
        //             break;
        //         case $total_month_order > 50000 && $total_month_order <= 100000 :
        //             $total_bill_charge = 349.99;
        //             break;
        //         default:
        //             # code...
        //             break;
        //     }
        //     $tCharges = $shop->api()->rest('GET','/admin/api/2021-04/recurring_application_charges.json')['body'];
        //     $charge = [
        //                 "usage_charge" => [
        //                     "description" => "Upsell Charge on ".$total_month_order.' orders',
        //                     "price" => $total_bill_charge
        //                 ]
        //             ];
        //     $chargeResponse = $shop->api()->rest('POST','/admin/api/2021-04/recurring_application_charges/'.$charge_id.'/usage_charges.json',$charge)['body']['usage_charge'];
        //     $lastActiveUsageCharge = UsageCharge::where(['id' => $shop->id, 'status' => 'ACTIVE'])->first();
        //     if($lastActiveUsageCharge):
        //         UsageCharge::where('id', $shop->id)->update(['status' => 'DEACTIVE']);
        //     endif;
        //     UsageCharge::create([
        //         'user_id'                 => $shop->id,
        //         'charge_id'               => $user->recurringCharge->id,
        //         'status'                  => 'ACTIVE',
        //         'usage_charge_id'         => $chargeResponse->id,
        //         'description'             => $chargeResponse->description,
        //         'price'                   => $chargeResponse->price,
        //         'usage_charge_created_at' => $chargeResponse->created_at,
        //         'billing_on'              => $chargeResponse->billing_on,
        //         'balance_used'            => $chargeResponse->balance_used,
        //         'balance_remaining'       => $chargeResponse->balance_remaining,
        //     ]);
        // endforeach;

        /*
         *=========================================================
         * Billing Testing Code End
         *=========================================================
         *
        */


        // return auth()->user();
        // return dd(auth()->user()->api()->rest('GET','/admin/api/2021-01/webhooks.json')['body']);
        // $price_rule = auth()->user()->api()->rest('GET','/admin/api/2020-10/price_rules.json');
        // dd($price_rule);
        // foreach ($price_rule['body']['price_rules'] as $rules):
        //     $price_rule_id = $rules['id'];
        //     $price_rule_del = auth()->user()->api()->rest('DELETE','/admin/api/2021-01/price_rules/'.$price_rule_id.'.json');
        // endforeach;


        // $discount_code = auth()->user()->api()->rest('GET','/admin/api/2021-01/price_rules/'.$price_rule_id.'/discount_codes.json');
        // dd($discount_code);

        // return dd(auth()->user()->api()->graph('{
        //     shop {
        //       productTags(first: 250) {
        //         edges {
        //           node
        //         }
        //       }
        //     }
        //   }')['body']['data']);
        // return dd(auth()->user()->api()->graph("{
        //     shop {
        //       name
        //       productTags(first: 10) {
        //         edges {
        //           node
        //         }
        //       }
        //     }
        // }")['body']['data']);
        // return dd($this->shopifyApiGraphQuery('getAllProducts'))

        // return dd(auth()->user()->api()->graph('{
        //     nodes(ids: ["gid://shopify/Collection/235109187739"]) {
        //         ...on Collection {
        //             products(first: 50) {
        //                 edges {
        //                     node {
        //                         id
        //                         title
        //                         featuredImage {
        //                             src
        //                         }
        //                         variants(first: 1) {
        //                             edges{
        //                                 node {
        //                                     price
        //                                     compareAtPrice
        //                                 }
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }'));

        // return dd(auth()->user()->api()->graph('{
        //     products(first: 50, query: "tag:01-08") {
        //       pageInfo {
        //         hasNextPage
        //       }
        //       edges {
        //         cursor
        //         node {
        //           id
        //           title
        //           tags
        //           featuredImage {
        //             src
        //           }
        //           variants(first: 1) {
        //             edges {
        //               node {
        //                 compareAtPrice
        //                 price
        //               }
        //             }
        //           }
        //         }
        //       }
        //     }
        //   }
        //    '));
    }

    /*
     |
     | ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     |   Return Store Front View of Upsell
     | ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     |
    */
    public function storeFrontViewUpsell(Upsell $upsell){
        $shop = auth()->user();
        $target_data = Upsell::where('id', $upsell->id)
            ->with([
                'Tproducts' => function($q){
                    $q->limit(1);
                },
                'Tcollections' => function($q1){
                    $q1->limit(1);
                },
                'Ttags' => function($q2){
                    $q2->limit(1);
                }
            ])->first();
        if(count($target_data->Tproducts)):
            /*
             |
             | ====================================
             |  API CALL for single product
             | -----------------------------------
             |      Get Product Handle
             | -----------------------------------
             | ====================================
             |
            */
            $product_handle = $shop->api()->rest('GET','/admin/api/2021-10/products/'.$target_data->Tproducts[0]->shopify_product_id.'.json')['body']['product']['handle'];
            /*
             |
             |  ==================================
             |      Creating URL to Redirect
             |  ==================================
             |
            */
            $url = "https://".$shop->name."/products/".$product_handle;
            /*
             |
             | ================================
             |     redirect to url
             | ================================
            */
             return redirect($url);
        elseif(count($target_data->Tcollections)):
            /*
             |
             | ========================================
             |  API CALL for single collection
             | ---------------------------------------
             |  Get collection first product Handle
             | ---------------------------------------
             | ========================================
             |
            */

            $collection_product_handle = $shop->api()->rest('GET','admin/api/2021-10/collections/'.$target_data->Tcollections[0]->shopify_collection_id.'/products.json')['body']['products'][0]['handle'];
            /*
             |
             |  ==================================
             |      Creating URL to Redirect
             |  ==================================
             |
            */

            $url = "https://".$shop->name."/products/".$collection_product_handle;

             /*
              |
              | ================================
              |     redirect to url(collection)
              | ================================
             */
             return redirect($url);
        elseif(count($target_data->Ttags)):
            $tag_product_handle = $this->getTagProductsGraphql([$target_data->Ttags[0]->shopify_tag_id],$shop);
            /*
             |
             |  ==================================
             |      Creating URL to Redirect
             |  ==================================
             |
            */

            $url = "https://".$shop->name."/products/".$tag_product_handle->products->edges[0]->node->handle;

             /*
              |
              | ================================
              |     redirect to url(collection)
              | ================================
             */
            return redirect($url);
        else:
            abort('404');
        endif;
    }
}
