<?php

namespace App\Http\Controllers;

use App\Http\Traits\ShopifyTrait;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Upsell;
use App\Models\UpsellStats;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    use ShopifyTrait;
    /*
     *
     * this function is accepting the ids of checkout products and return the post purchase
     * upsell products
     *
     */
    public function alpha_post_purchase()
    {
        $currency = Setting::select('currency')->whereHas('authUser',function($q){
            $q->where('name',request('shop'));
        })->first();
        $currency = config("currency.".$currency->currency.".currency_symbol");
        /*
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *   Get Customer Data
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
        */
        $shop = User::where('name',request()->shop)->first();
        $customer = $shop->api()->rest('GET','/admin/api/2021-07/customers/'.request('customer').'.json')['body'];
        // info(json_encode($customer));
        /*
         *
         * checkout products ids from request
         *
         *
        */
         $checkout_products_ids = explode(",",request('name'));


        /**
         *
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * Query to get post purchase upsells from database
         * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *
         */
        if(request()->has('shop')):
            $shop = User::where('name',request()->shop)->whereNotNull('password')
            ->whereHas('upsells',function($q){
                $q->where('status',true);
            })
            ->with(['upsells' => function($q){
                $q->where('upsells.status',true);
                $q->where(function($q2){
                    $q2->where('setting->end_date' , null)->orWhere('setting->end_date', '>=' ,today());
                });
                $q->whereHas('upsellType',function($q2){
                    $q2->where('name',config('upsell.strings.NativePostPurchaseUpsellName'));
                });
                $q->with(['upsellType' => function($q2){
                    $q2->where('name',config('upsell.strings.NativePostPurchaseUpsellName'));
                }]);
                $q->with([
                    'Tproducts',
                    'Aproducts',
                    'Dproducts']);
            }])->first();

            /**
             *
             * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
             * Filter Post Purchase Upsell from shop
             * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
             *
             */
            if($shop->upsells->count()):
                $native_post_purchase_upsell = [];
                foreach($checkout_products_ids as $native_post_purchase_upsell_Id):
                    foreach($shop->upsells as $native_post_purchase):
                        // info($native_post_purchase);
                        // dd($native_post_purchase->Tproducts);
                        if($native_post_purchase->Tproducts->where('shopify_product_id',$native_post_purchase_upsell_Id)->count()):
                            $native_post_purchase_upsell[] = $native_post_purchase;
                        endif;
                    endforeach;
                    // break;
                endforeach;
            endif;
            // dd($native_post_purchase_upsell);
            if(isset($native_post_purchase_upsell) && count($native_post_purchase_upsell)):
                $upsell = collect($native_post_purchase_upsell)->where('priority',collect($native_post_purchase_upsell)->max('priority'))->random(1)[0];
                /**
                 *
                 * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                 * Generate Data for fronend of Post Purchase upsell
                 * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                 *
                 */
                if(isset($upsell)):
                    $data = [];
                    if($upsell->Tproducts->count()):
                        $products   = [];
                        $productsWithCount = [];
                        if($upsell->Aproducts->count()):
                            $lineitems = $shop->userOrders->pluck('order.line_items');
                            $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                            $appearOnproducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                            foreach($appearOnproducts['nodes'] as $aproducts):
                                $aproducts['count']=0;
                                $productsWithCount[] = $aproducts;
                            endforeach;
                            foreach($productsWithCount as $key => $value):
                                $aproductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$value['id']);
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($aproductId == $product['product_id']):
                                            $value['count'] = $value['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            $price = array_column($productsWithCount, 'count');
                            array_multisort($price, SORT_DESC, $productsWithCount);
                            $products = array_merge($products,collect($productsWithCount)->take(1)->toArray());
                        endif;
                    endif;
                    if($upsell->Dproducts->count()):
                        $productsWithCount = [];
                        if($upsell->Dproducts->count()):
                            $lineitems = $shop->userOrders->pluck('order.line_items');
                            $product_ids_to_get = $upsell->Dproducts->pluck('shopify_product_id');
                            $downSellProducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                            foreach($downSellProducts['nodes'] as $dproducts):
                                $dproducts['count']=0;
                                $productsWithCount[] = $dproducts;
                            endforeach;
                            foreach($productsWithCount as $key => $value):
                                $dproductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$value['id']);
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($dproductId == $product['product_id']):
                                            $value['count'] = $value['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            $price = array_column($productsWithCount, 'count');
                            array_multisort($price, SORT_DESC, $productsWithCount);
                            $d_product = collect($productsWithCount)->take(1)->toArray();
                            $products = array_merge($products,$d_product);
                            info($products);
                        endif;
                    endif;
                    if(count($products)):
                        $native_post_purchase_data = [
                            'setting'  => $upsell->setting,
                            'products' => $products,
                            'customer' => $customer,
                            'upsell_id'=> $upsell->id,
                            'currency' => $currency,
                        ];
                        $this->updateUpsellViews($upsell->id);
                        // info(json_encode($native_post_purchase_data));
                        return json_encode($native_post_purchase_data);
                    else:
                        return 0;
                    endif;
                endif;
            endif;
        endif;
        return 1;
    }

    /*
     *
     * Verify Add to order token
     *
     */
    public function jwt_token_varify()
    {
        $data  = json_decode(request('data'));
        // dd($data->changes[0]);
        if(request('trackUpsell')):
            if(isset($data->changes[0]->variantId)):
                $variant_id = $data->changes[0]->variantId;
            else:
                $variant_id = $data->changes[0]->variant_id;
            endif;
            $checkoutData = json_decode(request('trackUpsell'));
            $orderDetail = Order::where('order->checkout_token', $checkoutData->checkout_token)
            ->update([
                'checkout_token' => $checkoutData->checkout_token ,
                'upsell_id'      => $checkoutData->upsell_id,
                'variant_id'     => $variant_id,
            ]);
        endif;
        $token = $data->token;

        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        // info(json_encode($jwtHeader));
        // info($jwtPayload->input_data->initialPurchase->referenceId);

        if(json_decode(request('data'))->referenceId == $jwtPayload->input_data->initialPurchase->referenceId):

            $alpha_header   = ["alg" => "HS256", "typ" => "JWT"];
            $API_KEY        = config("shopify-app.api_key");
            $alpha_uuid     = Str::uuid();
            // $data_now       = time();
            $referenceId    = json_decode(request('data'))->referenceId;
            $changes        = json_decode(request('data'))->changes;

            $API_secret     = config("shopify-app.api_secret");

            // info($alpha_uuid);

            $payload = [
                    "iss"     => $API_KEY,
                    "jti"     => $alpha_uuid,
                    "iat"     => strtotime("now"),
                    "sub"     => $referenceId,
                    "changes" => $changes,
                ];

            // Create token header as a JSON string
            $header = json_encode($alpha_header);

            // Create token payload as a JSON string
            $payload = json_encode($payload);

            // Encode Header to Base64Url String
            $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

            // Encode Payload to Base64Url String
            $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

            // Create Signature Hash
            $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload,$API_secret , true);

            // Encode Signature to Base64Url String
            $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

            // Create JWT
            $token = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

            // info(json_encode($payload));
            // $encoded_header  = base64_encode(json_encode($alpha_header));
            // $encoded_payload = base64_encode(json_encode($payload));
            // // $encoded_key = base64_encode(json_encode($API_secret));
            // $encodedContent = $encoded_header.".".$encoded_payload;
            // info($encodedContent.'   '.$API_secret);
            // // $signature = hashHmacSHA256($encodedContent);
            // $signature = hash_hmac('sha256', json_encode($encodedContent), $API_secret);
            $token = ["token"=>$token];
            info($token);
            return json_encode($token);

        endif;
    }


    /**
     * Encode data to Base64URL
     * @param string $data
     * @return boolean|string
     */
    function base64url_encode($data)
    {
      // First of all you should encode $data to Base64 string
      $b64 = base64_encode($data);

      // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
      if ($b64 === false) {
        return false;
      }

      // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
      $url = strtr($b64, '+/', '-_');

      // Remove padding character from the end of line and return the Base64URL result
      return rtrim($url, '=');
    }

    /**
     *
     * update Upsells Statistics
     * -------------------------------------------------
     * This function will increment the view of
     * upsells by getting the upsell
     * and update views column of upsell.
     * -------------------------------------------------
     *
     */

    public function updateUpsellViews($upsell_id)
    {
        $upsell_data  = Upsell::where('id',$upsell_id)->first();
        $upsell_stats = UpsellStats::where('upsell_id',$upsell_id)
            ->where('type','views')
            ->whereDate('upsell_created_at',today()->format('Y-m-d'))
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
            $upsell_data->upsellStats()->createMany([[
                'type'  => 'views',
                'value' => 1,
                'upsell_created_at' => today()->format('Y-m-d'),
            ]]);
        endif;
        return response()->json(['status'=>'true']);
    }

}
