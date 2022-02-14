<?php
namespace App\Http\Traits;

use App\Models\Setting;
use App\Models\Upsell;
use App\Models\UpsellStats;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


trait FrontEndTrait {


    /**
     *
     * -----------------------------------------
     * This Function  will Filter upsells
     * -----------------------------------------
     *
     */
    public function alphaFilterUpsells()
    {
        $currency = Setting::select('currency')->whereHas('authUser',function($q){
            $q->where('name',request('shop'));
        })->first();
        $currency = config("currency.".$currency->currency.".currency_symbol");

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
                    $q2->where('name','!=',config('upsell.strings.postPurchaseUpsellName'));
                    $q2->when(!request()->has('product_id'),function($q3){
                        $q3->whereNotIn('name', config('upsell.strings.getPreUpsellIncart'));
                    });
                });
                $q->with(['upsellType' => function($q2){
                    $q2->where('name','!=',config('upsell.strings.postPurchaseUpsellName'));
                }]);
                $q->with([
                    'Tproducts',
                    'Tcollections',
                    'Ttags',
                    'Aproducts',
                    'Acollections',
                    'Atags',
                    'volumeDiscounts',
                    'upsellDiscounts']);
            }])->first();
            if($shop):
                $data = [];
                $in_cart_upsell = [];
                $shop->load(['orders' => function($q){
                    $q->orderBy('shopify_created_at','desc')->limit(10);
                }]);
                if(request()->has('product_id')):
                    $fbt_upsells = [];
                    $add_to_cart_upsell     = [];
                    $volume_discount_upsell = [];
                endif;
                foreach ($shop->upsells as $key => $upsell) :
                    if($upsell->upsellType->name == config('upsell.strings.sale_notification_identifier')):
                        $data = array_merge($data,$this->saleNotification($shop,$upsell));
                    endif;
                    if($upsell->upsellType->name == config('upsell.strings.inCartUpsellName')):
                        $in_cart_upsell[] = $upsell;
                    endif;
                    if(request()->has('product_id')):
                        if($upsell->Tproducts->where('shopify_product_id',request()->product_id)->count()):
                            if($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[0]):
                                $fbt_upsells[] = $upsell;
                            elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[1]):
                                $add_to_cart_upsell[] = $upsell;
                            elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[2]):
                                $volume_discount_upsell[] = $upsell;
                            endif;
                        elseif($upsell->Tcollections->count()):
                            $tCollectionIds = $upsell->Tcollections->pluck('shopify_collection_id');
                            foreach ($tCollectionIds as $value) :
                                if(in_array($value,request()->product_collection_ids)):
                                    if($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[0]):
                                        $fbt_upsells[] = $upsell;
                                    elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[1]):
                                        $add_to_cart_upsell[] = $upsell;
                                    elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[2]):
                                        $volume_discount_upsell[] = $upsell;
                                    endif;
                                endif;
                            endforeach;
                        elseif($upsell->Ttags->count()):
                            $tTagIds = $upsell->Ttags->pluck('shopify_tag_id');
                            foreach ($tTagIds as $value):
                                if(request()->product_tags):
                                    if(in_array($value,request()->product_tags)):
                                        if($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[0]):
                                            $fbt_upsells[] = $upsell;
                                        elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[1]):
                                            $add_to_cart_upsell[] = $upsell;
                                        elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[2]):
                                            $volume_discount_upsell[] = $upsell;
                                        endif;
                                    endif;
                                endif;
                            endforeach;
                        endif;
                    endif;
                endforeach;
                if(count($in_cart_upsell)):
                    $in_cart_upsell =  collect($in_cart_upsell)->where('priority',collect($in_cart_upsell)->max('priority'))->random(1)[0];
                    $data = array_merge($data,$this->inCart($shop,$in_cart_upsell));
                endif;
                if(request()->has('product_id')):
                    if(count($fbt_upsells)):
                        // return $fbt_upsells;
                        $fbt_upsells =  collect($fbt_upsells)->where('priority',collect($fbt_upsells)->max('priority'))->random(1)[0];
                        if(!is_array($fbt_upsells)):
                            $data = array_merge($data,$this->frequentBoughtTogather($fbt_upsells,$shop));
                            // dd($data);
                        endif;
                    endif;
                    if(count($add_to_cart_upsell)):
                        $add_to_cart_upsell =  collect($add_to_cart_upsell)->where('priority',collect($add_to_cart_upsell)->max('priority'))->random(1)[0];
                        if(!is_array($add_to_cart_upsell)):
                            $data = array_merge($data,$this->addToCart($add_to_cart_upsell,$shop));
                        endif;
                    endif;
                    if(count($volume_discount_upsell)):
                        $volume_discount_upsell =  collect($volume_discount_upsell)->where('priority',collect($volume_discount_upsell)->max('priority'))->random(1)[0];
                        if(!is_array($volume_discount_upsell)):
                            $data = array_merge($data,$this->volumeDiscount($volume_discount_upsell,$shop));
                        endif;
                    endif;
                endif;
                $upsells_handle = [];
                foreach($data as $key => $handle):
                    if(isset($handle['handle'])):
                        $upsells_handle = array_merge($upsells_handle,$handle['handle']);
                        unset($handle['handle']);
                        $data[$key] = $handle;
                    endif;
                endforeach;
                $upsells_handle  = array_unique($upsells_handle);
                // $checkout_script = view('upsell_designs.includes.js.pre_purchase.global_js.checkout_replace')->render();
                if(count($data) && isset($data['pre_purchase']) || isset($data['sale_notification'])):
                    if(isset($data['pre_purchase'])):
                        $addToCartFlag = true;
                    else:
                        $addToCartFlag = false;
                    endif;
                    $checkout_script = view('upsell_designs.includes.js.pre_purchase.global_js.checkout_replace', compact('addToCartFlag'))->render();
                else:
                    $add_to_cart_upsell =   [];
                    $loop_break_flag    = false;

                    foreach ($shop->upsells as $key => $upsell) :
                        if(request()->has('product_ids')):
                            foreach(request()->product_ids as $product_id):
                                if($upsell->Tproducts->where('shopify_product_id',$product_id)->count()):
                                    if($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[1]):
                                        $add_to_cart_upsell[] = $upsell;
                                    endif;
                                // elseif($upsell->Tcollections->count()):
                                //     $tCollectionIds = $upsell->Tcollections->pluck('shopify_collection_id');
                                //     foreach ($tCollectionIds as $value) :
                                //         if(in_array($value,request()->product_collection_ids)):
                                //             if($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[0]):
                                //                 $fbt_upsells[] = $upsell;
                                //             elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[1]):
                                //                 $add_to_cart_upsell[] = $upsell;
                                //             elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[2]):
                                //                 $volume_discount_upsell[] = $upsell;
                                //             endif;
                                //         endif;
                                //     endforeach;
                                // elseif($upsell->Ttags->count()):
                                //     $tTagIds = $upsell->Ttags->pluck('shopify_tag_id');
                                //     foreach ($tTagIds as $value):
                                //         if(request()->product_tags):
                                //             if(in_array($value,request()->product_tags)):
                                //                 if($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[0]):
                                //                     $fbt_upsells[] = $upsell;
                                //                 elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[1]):
                                //                     $add_to_cart_upsell[] = $upsell;
                                //                 elseif($upsell->upsellType->name == config('upsell.strings.upsellTypeNamesToMatch')[2]):
                                //                     $volume_discount_upsell[] = $upsell;
                                //                 endif;
                                //             endif;
                                //         endif;
                                //     endforeach;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                    if(count($add_to_cart_upsell)):
                        $addToCartFlag = true;
                        $checkout_script = view('upsell_designs.includes.js.pre_purchase.global_js.checkout_replace', compact('addToCartFlag'))->render();
                    else:
                        $checkout_script = false;
                    endif;
                endif;
                return response()->json(['currency' => $currency,'status' => true,'upsells' => $data,'upsell_handles'=> $upsells_handle,'checkOutJs' => $checkout_script]);
            endif;
        endif;
    }

    /**
     *
     * ------------------------------------------------------------------
     * this method is creating data for Frequently Bought Togather Upsell
     * ------------------------------------------------------------------
     *
     */

    public function frequentBoughtTogather($upsell,$shop)
    {
        $data = [];
        if($upsell->Tproducts->where('shopify_product_id',request()->product_id)->count()):
            $products   = [];
            $productsWithCount = [];
            if($upsell->auto):
                $appearOnproducts = $this->getOrdersProducts($upsell, $shop, request()->product_id);
                // dd(gettype($appearOnproducts));
                if(gettype($appearOnproducts) == "string"):
                    $data[$this->commonString($upsell->upsellType->name)]['error'] = "Data not generated";
                    return $data;
                    // $aProductHandle = [];
                else:
                    $products = array_merge($products,collect($appearOnproducts)->take(2)->toArray());
                    foreach($products as $productHandle):
                        $aProductHandle[] = $productHandle['handle'];
                    endforeach;
                endif;
            else:
                if($upsell->Aproducts->count()):
                    // $lineitems = $shop->orders->pluck('order.line_items');
                    $lineitems = $shop->userOrders->pluck('order.line_items');
                    $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                    $appearOnproducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                    if(count($appearOnproducts['nodes']) > 2):
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
                        $products = array_merge($products,collect($productsWithCount)->take(2)->toArray());
                        foreach($products as $productHandle):
                            $aProductHandle[] = $productHandle['handle'];
                        endforeach;
                    else:
                        $products = $appearOnproducts['nodes'];
                    foreach($products as $productHandle):
                        $aProductHandle[] = $productHandle['handle'];
                    endforeach;
                    endif;
                elseif($upsell->Acollections->count()):
                    $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                    // $lineitems = $shop->orders->pluck('order.line_items');
                    $lineitems = $shop->userOrders->pluck('order.line_items');
                    $checked_shopify_collection_ids = collect([]);
                    $flag  = true;
                    $limit = 0;
                    $collectionProducts = [];
                    while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                        $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                        $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                        $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                        if($collections[0]!=null):
                            if($limit <= 50):
                                foreach($collections[0]['products']['edges'] as $responseProduct):
                                    $flag2 = false;
                                    foreach($collectionProducts as $node):
                                        if($node['node']['id'] == $responseProduct['node']['id']):
                                            $flag2 = true;
                                            break;
                                        endif;
                                    endforeach;
                                    if(!$flag2):
                                        $responseProduct['count'] = 0;
                                        $collectionProducts[] = $responseProduct;
                                    endif;
                                    $limit++;
                                endforeach;
                            else:
                                $flag = false;
                            endif;
                        endif;
                    endwhile;
                    if($collectionProducts[0]!=null):
                        foreach($collectionProducts as $cProducts):
                            $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                            foreach($lineitems as $OrderItem ):
                                foreach($OrderItem as $product):
                                    if($cProductsId == $product['product_id']):
                                        $cProducts['count'] = $cProducts['count']+1;
                                    endif;
                                endforeach;
                            endforeach;
                        endforeach;
                        $price = array_column($collectionProducts, 'count');
                        array_multisort($price, SORT_DESC, $collectionProducts);
                        $products = array_merge($products,collect($collectionProducts)->take(2)->toArray());
                        foreach($products as $collectionProduct):
                            $aProductHandle[] = $collectionProduct['node']['handle'];
                        endforeach;
                    endif;
                elseif($upsell->Atags->count()):
                    $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                    // $lineitems             =  $shop->orders->pluck('order.line_items');
                    $lineitems             = $shop->userOrders->pluck('order.line_items');
                    $checked_Shopify_Tags  =  collect([]);
                    $flag  = true;
                    $limit = 0;
                    $TagsProducts = [];
                    while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                        $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                        $checked_Shopify_Tags[] =   $shopify_Tag[0];
                        $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                        // return $tagProducts['products']['edges'];
                        if(count($tagProducts['products']['edges'])):
                            if($limit <= 50):
                                foreach($tagProducts['products']['edges'] as $responseProduct):
                                    // return $responseProduct['node']['id'];
                                    $flag2 = false;
                                    foreach($TagsProducts as $node):
                                        if($node['node']['id'] == $responseProduct['node']['id']):
                                            $flag2 = true;
                                            break;
                                        endif;
                                    endforeach;
                                    if(!$flag2):
                                        $responseProduct['count'] = 0;
                                        $TagsProducts[] = $responseProduct;
                                    endif;
                                    $limit++;
                                endforeach;
                            else:
                                $flag = false;
                            endif;
                        endif;
                    endwhile;
                    // return $TagsProducts;
                    if(count($TagsProducts)):
                        foreach($TagsProducts as $tagProduct):
                            $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                            // return $tagProductId;
                            foreach($lineitems as $OrderItem ):
                                foreach($OrderItem as $product):
                                    if($tagProductId == $product['product_id']):
                                            $tagProduct['count'] = $tagProduct['count']+1;
                                    endif;
                                endforeach;
                            endforeach;
                        endforeach;
                        // return $TagsProducts;
                        $price = array_column($TagsProducts, 'count');
                        array_multisort($price, SORT_DESC, $TagsProducts);
                        $products = array_merge($products,collect($TagsProducts)->take(2)->toArray());
                        foreach($products as $TagsProducts):
                            $aProductHandle[] = $TagsProducts['node']['handle'];
                        endforeach;
                    endif;
                endif;
            endif;
            $upsellId = $upsell->id;
            $aProductHandle = array_unique($aProductHandle);
            $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
            $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
            $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','upsellId','aProductHandle'))->render();
        elseif($upsell->Tcollections->count()):
            $tCollectionIds = $upsell->Tcollections->pluck('shopify_collection_id');
            foreach ($tCollectionIds as $key1 => $value) :
                if(in_array($value,request()->product_collection_ids)):
                    $products  = [];
                    $productsWithCount = [];
                    $aProductHandle = [];
                    if($upsell->Aproducts->count()):
                        // $lineitems = $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                        $appearOnproducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                        foreach($appearOnproducts['nodes'] as $aproducts):
                            $aproducts['count']=0;
                            // $aProductHandle[] = $aproducts['handle'];
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
                        $products = array_merge($products,collect($productsWithCount)->take(2)->toArray());
                        foreach($products as $productHandle):
                            $aProductHandle[] = $productHandle['handle'];
                        endforeach;
                    elseif($upsell->Acollections->count()):
                        $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                        // $lineitems = $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $checked_shopify_collection_ids = collect([]);
                        $flag  = true;
                        $limit = 0;
                        $collectionProducts = [];
                        while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                            $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                            $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                            $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                            // return $collections;
                            // dd($collections);
                            if($collections[0]!=null):
                                if($limit <= 50):
                                    foreach($collections[0]['products']['edges'] as $responseProduct):
                                        $flag2 = false;
                                        foreach($collectionProducts as $node):
                                            if($node['node']['id'] == $responseProduct['node']['id']):
                                                $flag2 = true;
                                                break;
                                            endif;
                                        endforeach;
                                        if(!$flag2):
                                            $responseProduct['count'] = 0;
                                            $collectionProducts[] = $responseProduct;
                                        endif;
                                        $limit++;
                                    endforeach;
                                else:
                                    $flag = false;
                                endif;
                            endif;
                        endwhile;
                        // return  $collectionProducts;
                        if($collectionProducts[0]!=null):
                            foreach($collectionProducts as $cProducts):
                                $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($cProductsId == $product['product_id']):
                                            $cProducts['count'] = $cProducts['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            $price = array_column($collectionProducts, 'count');
                            array_multisort($price, SORT_DESC, $collectionProducts);
                            $products = array_merge($products,collect($collectionProducts)->take(2)->toArray());
                            // dd($products);
                            foreach($products as $collectionProduct):
                                $aProductHandle[] = $collectionProduct['node']['handle'];
                            endforeach;
                            // dd($aProductHandle);
                        endif;
                        // return $products;
                    elseif($upsell->Atags->count()):
                        $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                        // $lineitems             =  $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $checked_Shopify_Tags  =  collect([]);
                        $flag  = true;
                        $limit = 0;
                        $TagsProducts = [];
                        while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                            $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                            $checked_Shopify_Tags[] =   $shopify_Tag[0];
                            $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                            // return $tagProducts['products']['edges'];
                            if(count($tagProducts['products']['edges'])):
                                if($limit <= 50):
                                    foreach($tagProducts['products']['edges'] as $responseProduct):
                                        // return $responseProduct['node']['id'];
                                        $flag2 = false;
                                        foreach($TagsProducts as $node):
                                            if($node['node']['id'] == $responseProduct['node']['id']):
                                                $flag2 = true;
                                                break;
                                            endif;
                                        endforeach;
                                        if(!$flag2):
                                            $responseProduct['count'] = 0;
                                            $TagsProducts[] = $responseProduct;
                                        endif;
                                        $limit++;
                                    endforeach;
                                else:
                                    $flag = false;
                                endif;
                            endif;
                        endwhile;
                        // return $TagsProducts;
                        if(count($TagsProducts)):
                            foreach($TagsProducts as $tagProduct):
                                $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                                // return $tagProductId;
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($tagProductId == $product['product_id']):
                                                $tagProduct['count'] = $tagProduct['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            // return $TagsProducts;
                            $price = array_column($TagsProducts, 'count');
                            array_multisort($price, SORT_DESC, $TagsProducts);
                            $products = array_merge($products,collect($productsWithCount)->take(2)->toArray());
                            foreach($products as $collectionProduct):
                                $aProductHandle[] = $collectionProduct['handle'];
                            endforeach;
                        endif;
                    endif;
                endif;
            endforeach;
            // dd($aProductHandle);
            // dd($upsell->id);
            $upsellId = $upsell->id;
            $aProductHandle = array_unique($aProductHandle);
            $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
            $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
            $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','aProductHandle','upsellId'))->render();
        elseif($upsell->Ttags->count()):
            $tTagIds = $upsell->Ttags->pluck('shopify_tag_id');
            foreach ($tTagIds as $value) :
                if(in_array($value,request()->product_tags)):
                    $products  = [];
                    $productsWithCount = [];
                    if($upsell->Aproducts->count()):
                        // $lineitems = $shop->orders->pluck('order.line_items');
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
                        $products = array_merge($products,collect($productsWithCount)->take(2)->toArray());
                        foreach($products as $productHandle):
                            $aProductHandle[] = $productHandle['handle'];
                        endforeach;
                    elseif($upsell->Acollections->count()):
                        $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                        // $lineitems = $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $checked_shopify_collection_ids = collect([]);
                        $flag  = true;
                        $limit = 0;
                        $collectionProducts = [];
                        while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                            $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                            $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                            $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                            // return $collections;
                            if($collections[0]!=null):
                                if($limit <= 50):
                                    foreach($collections[0]['products']['edges'] as $responseProduct):
                                        $flag2 = false;
                                        foreach($collectionProducts as $node):
                                            if($node['node']['id'] == $responseProduct['node']['id']):
                                                $flag2 = true;
                                                break;
                                            endif;
                                        endforeach;
                                        if(!$flag2):
                                            $responseProduct['count'] = 0;
                                            $collectionProducts[] = $responseProduct;
                                        endif;
                                        $limit++;
                                    endforeach;
                                else:
                                    $flag = false;
                                endif;
                            endif;
                        endwhile;
                        // return  $collectionProducts;
                        if($collectionProducts[0]!=null):
                            foreach($collectionProducts as $cProducts):
                                $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($cProductsId == $product['product_id']):
                                            $cProducts['count'] = $cProducts['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            $price = array_column($collectionProducts, 'count');
                            array_multisort($price, SORT_DESC, $collectionProducts);
                            $products = array_merge($products,collect($collectionProducts)->take(2)->toArray());
                            foreach($products as $collectionProduct):
                                $aProductHandle[] = $collectionProduct['node']['handle'];
                            endforeach;
                        endif;
                        // return $products;
                    elseif($upsell->Atags->count()):
                        $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                        // $lineitems             =  $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $checked_Shopify_Tags  =  collect([]);
                        $flag  = true;
                        $limit = 0;
                        $TagsProducts = [];
                        while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                            $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                            $checked_Shopify_Tags[] =   $shopify_Tag[0];
                            $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                            // return $tagProducts['products']['edges'];
                            if(count($tagProducts['products']['edges'])):
                                if($limit <= 50):
                                    foreach($tagProducts['products']['edges'] as $responseProduct):
                                        // return $responseProduct['node']['id'];
                                        $flag2 = false;
                                        foreach($TagsProducts as $node):
                                            if($node['node']['id'] == $responseProduct['node']['id']):
                                                $flag2 = true;
                                                break;
                                            endif;
                                        endforeach;
                                        if(!$flag2):
                                            $responseProduct['count'] = 0;
                                            $TagsProducts[] = $responseProduct;
                                        endif;
                                        $limit++;
                                    endforeach;
                                else:
                                    $flag = false;
                                endif;
                            endif;
                        endwhile;
                        // return $TagsProducts;
                        if(count($TagsProducts)):
                            foreach($TagsProducts as $tagProduct):
                                $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                                // return $tagProductId;
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($tagProductId == $product['product_id']):
                                            $tagProduct['count'] = $tagProduct['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            // return $TagsProducts;
                            $price = array_column($TagsProducts, 'count');
                            array_multisort($price, SORT_DESC, $TagsProducts);
                            $products = array_merge($products,collect($TagsProducts)->take(2)->toArray());
                            foreach($products as $tagsProduct):
                                $aProductHandle[] = $tagsProduct['node']['handle'];
                            endforeach;
                        endif;
                    endif;
                endif;
            endforeach;
            $upsellId = $upsell->id;
            $aProductHandle = array_unique($aProductHandle);
            $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
            $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
            $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','upsellId','aProductHandle'))->render();
        endif;
        if(count($data)):
            // dd($data);
            $this->updateUpsellViews($upsell->id);
            return $data;
        else:
            return $data;
        endif;
    }

    /**
     *
     * ------------------------------------------------------------------
     * this method is creating data for Add To Cart
     * ------------------------------------------------------------------
     *
     */
    public function addToCart($upsell, $shop)
    {
        // Get store currency
        $currency = Setting::select('currency')->whereHas('authUser',function($q){
            $q->where('name',request('shop'));
        })->first();
        $currency = config("currency.".$currency->currency.".currency_symbol");
        $data = [];
        if($upsell->Tproducts->where('shopify_product_id',request()->product_id)->count()):
            $products   = [];
            $productsWithCount = [];
            if($upsell->auto):
                $appearOnproducts = $this->getOrdersProducts($upsell, $shop, request()->product_id);
                $products = array_merge($products,collect($appearOnproducts)->take(4)->toArray());
                foreach($products as $productHandle):
                    $aProductHandle[] = $productHandle['handle'];
                endforeach;
            else:
                if($upsell->Aproducts->count()):
                    // $lineitems = $shop->orders->pluck('order.line_items');
                    $lineitems = $shop->userOrders->pluck('order.line_items');
                    $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                    $appearOnproducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                    if(count($appearOnproducts['nodes']) > 2):
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
                        $products = array_merge($products,collect($productsWithCount)->take(4)->toArray());
                        foreach($products as $productHandle):
                            $aProductHandle[] = $productHandle['handle'];
                        endforeach;
                    else:
                        $products = $appearOnproducts['nodes'];
                    foreach($products as $productHandle):
                        $aProductHandle[] = $productHandle['handle'];
                    endforeach;
                    endif;
                elseif($upsell->Acollections->count()):
                    $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                    // $lineitems = $shop->orders->pluck('order.line_items');
                    $lineitems = $shop->userOrders->pluck('order.line_items');
                    $checked_shopify_collection_ids = collect([]);
                    $flag  = true;
                    $limit = 0;
                    $collectionProducts = [];
                    while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                        $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                        $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                        $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                        if($collections[0]!=null):
                            if($limit <= 50):
                                foreach($collections[0]['products']['edges'] as $responseProduct):
                                    $flag2 = false;
                                    foreach($collectionProducts as $node):
                                        if($node['node']['id'] == $responseProduct['node']['id']):
                                            $flag2 = true;
                                            break;
                                        endif;
                                    endforeach;
                                    if(!$flag2):
                                        $responseProduct['count'] = 0;
                                        $collectionProducts[] = $responseProduct;
                                    endif;
                                    $limit++;
                                endforeach;
                            else:
                                $flag = false;
                            endif;
                        endif;
                    endwhile;
                    if($collectionProducts[0]!=null):
                        foreach($collectionProducts as $cProducts):
                            $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                            foreach($lineitems as $OrderItem ):
                                foreach($OrderItem as $product):
                                    if($cProductsId == $product['product_id']):
                                        $cProducts['count'] = $cProducts['count']+1;
                                    endif;
                                endforeach;
                            endforeach;
                        endforeach;
                        $price = array_column($collectionProducts, 'count');
                        array_multisort($price, SORT_DESC, $collectionProducts);
                        $products = array_merge($products,collect($collectionProducts)->take(4)->toArray());
                        foreach($products as $collectionProduct):
                            $aProductHandle[] = $collectionProduct['node']['handle'];
                        endforeach;
                    endif;
                elseif($upsell->Atags->count()):
                    $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                    // $lineitems             =  $shop->orders->pluck('order.line_items');
                    $lineitems             =  $shop->userOrders->pluck('order.line_items');
                    $checked_Shopify_Tags  =  collect([]);
                    $flag  = true;
                    $limit = 0;
                    $TagsProducts = [];
                    while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                        $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                        $checked_Shopify_Tags[] =   $shopify_Tag[0];
                        $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                        // return $tagProducts['products']['edges'];
                        if(count($tagProducts['products']['edges'])):
                            if($limit <= 50):
                                foreach($tagProducts['products']['edges'] as $responseProduct):
                                    // return $responseProduct['node']['id'];
                                    $flag2 = false;
                                    foreach($TagsProducts as $node):
                                        if($node['node']['id'] == $responseProduct['node']['id']):
                                            $flag2 = true;
                                            break;
                                        endif;
                                    endforeach;
                                    if(!$flag2):
                                        $responseProduct['count'] = 0;
                                        $TagsProducts[] = $responseProduct;
                                    endif;
                                    $limit++;
                                endforeach;
                            else:
                                $flag = false;
                            endif;
                        endif;
                    endwhile;
                    // return $TagsProducts;
                    if(count($TagsProducts)):
                        foreach($TagsProducts as $tagProduct):
                            $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                            // return $tagProductId;
                            foreach($lineitems as $OrderItem ):
                                foreach($OrderItem as $product):
                                    if($tagProductId == $product['product_id']):
                                            $tagProduct['count'] = $tagProduct['count']+1;
                                    endif;
                                endforeach;
                            endforeach;
                        endforeach;
                        // return $TagsProducts;
                        $price = array_column($TagsProducts, 'count');
                        array_multisort($price, SORT_DESC, $TagsProducts);
                        $products = array_merge($products,collect($TagsProducts)->take(4)->toArray());
                        foreach($products as $TagsProducts):
                            $aProductHandle[] = $TagsProducts['node']['handle'];
                        endforeach;
                    endif;
                endif;
            endif;
            $upsellId = $upsell->id;
            // dd($upsell->upsellType->name);
            $aProductHandle = array_unique($aProductHandle);
            $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
            $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
            $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','upsellId','aProductHandle','currency'))->render();
        elseif($upsell->Tcollections->count()):
            $tCollectionIds = $upsell->Tcollections->pluck('shopify_collection_id');
            foreach ($tCollectionIds as $key1 => $value) :
                if(in_array($value,request()->product_collection_ids)):
                    $products  = [];
                    $productsWithCount = [];
                    $aProductHandle = [];
                    if($upsell->Aproducts->count()):
                        // $lineitems = $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                        $appearOnproducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                        foreach($appearOnproducts['nodes'] as $aproducts):
                            $aproducts['count']=0;
                            // $aProductHandle[] = $aproducts['handle'];
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
                        $products = array_merge($products,collect($productsWithCount)->take(4)->toArray());
                        foreach($products as $productHandle):
                            $aProductHandle[] = $productHandle['handle'];
                        endforeach;
                    elseif($upsell->Acollections->count()):
                        $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                        // $lineitems = $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $checked_shopify_collection_ids = collect([]);
                        $flag  = true;
                        $limit = 0;
                        $collectionProducts = [];
                        while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                            $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                            $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                            $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                            // return $collections;
                            // dd($collections);
                            if($collections[0]!=null):
                                if($limit <= 50):
                                    foreach($collections[0]['products']['edges'] as $responseProduct):
                                        $flag2 = false;
                                        foreach($collectionProducts as $node):
                                            if($node['node']['id'] == $responseProduct['node']['id']):
                                                $flag2 = true;
                                                break;
                                            endif;
                                        endforeach;
                                        if(!$flag2):
                                            $responseProduct['count'] = 0;
                                            $collectionProducts[] = $responseProduct;
                                        endif;
                                        $limit++;
                                    endforeach;
                                else:
                                    $flag = false;
                                endif;
                            endif;
                        endwhile;
                        // return  $collectionProducts;
                        if($collectionProducts[0]!=null):
                            foreach($collectionProducts as $cProducts):
                                $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($cProductsId == $product['product_id']):
                                            $cProducts['count'] = $cProducts['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            $price = array_column($collectionProducts, 'count');
                            array_multisort($price, SORT_DESC, $collectionProducts);
                            $products = array_merge($products,collect($collectionProducts)->take(4)->toArray());
                            // dd($products);
                            foreach($products as $collectionProduct):
                                $aProductHandle[] = $collectionProduct['node']['handle'];
                            endforeach;
                            // dd($aProductHandle);
                        endif;
                        // return $products;
                    elseif($upsell->Atags->count()):
                        $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                        // $lineitems             =  $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $checked_Shopify_Tags  =  collect([]);
                        $flag  = true;
                        $limit = 0;
                        $TagsProducts = [];
                        while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                            $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                            $checked_Shopify_Tags[] =   $shopify_Tag[0];
                            $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                            // return $tagProducts['products']['edges'];
                            if(count($tagProducts['products']['edges'])):
                                if($limit <= 50):
                                    foreach($tagProducts['products']['edges'] as $responseProduct):
                                        // return $responseProduct['node']['id'];
                                        $flag2 = false;
                                        foreach($TagsProducts as $node):
                                            if($node['node']['id'] == $responseProduct['node']['id']):
                                                $flag2 = true;
                                                break;
                                            endif;
                                        endforeach;
                                        if(!$flag2):
                                            $responseProduct['count'] = 0;
                                            $TagsProducts[] = $responseProduct;
                                        endif;
                                        $limit++;
                                    endforeach;
                                else:
                                    $flag = false;
                                endif;
                            endif;
                        endwhile;
                        // return $TagsProducts;
                        if(count($TagsProducts)):
                            foreach($TagsProducts as $tagProduct):
                                $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                                // return $tagProductId;
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($tagProductId == $product['product_id']):
                                                $tagProduct['count'] = $tagProduct['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            // return $TagsProducts;
                            $price = array_column($TagsProducts, 'count');
                            array_multisort($price, SORT_DESC, $TagsProducts);
                            $products = array_merge($products,collect($productsWithCount)->take(4)->toArray());
                            foreach($products as $collectionProduct):
                                $aProductHandle[] = $collectionProduct['handle'];
                            endforeach;
                        endif;
                    endif;
                endif;
            endforeach;
            // dd($aProductHandle);
            // dd($upsell->id);
            $upsellId = $upsell->id;
            $aProductHandle = array_unique($aProductHandle);
            $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
            $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
            $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','aProductHandle','upsellId','currency'))->render();
        elseif($upsell->Ttags->count()):
            $tTagIds = $upsell->Ttags->pluck('shopify_tag_id');
            foreach ($tTagIds as $value) :
                if(in_array($value,request()->product_tags)):
                    $products  = [];
                    $productsWithCount = [];
                    if($upsell->Aproducts->count()):
                        // $lineitems = $shop->orders->pluck('order.line_items');
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
                        $products = array_merge($products,collect($productsWithCount)->take(4)->toArray());
                        foreach($products as $productHandle):
                            $aProductHandle[] = $productHandle['handle'];
                        endforeach;
                    elseif($upsell->Acollections->count()):
                        $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                        // $lineitems = $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $checked_shopify_collection_ids = collect([]);
                        $flag  = true;
                        $limit = 0;
                        $collectionProducts = [];
                        while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                            $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                            $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                            $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                            // return $collections;
                            if($collections[0]!=null):
                                if($limit <= 50):
                                    foreach($collections[0]['products']['edges'] as $responseProduct):
                                        $flag2 = false;
                                        foreach($collectionProducts as $node):
                                            if($node['node']['id'] == $responseProduct['node']['id']):
                                                $flag2 = true;
                                                break;
                                            endif;
                                        endforeach;
                                        if(!$flag2):
                                            $responseProduct['count'] = 0;
                                            $collectionProducts[] = $responseProduct;
                                        endif;
                                        $limit++;
                                    endforeach;
                                else:
                                    $flag = false;
                                endif;
                            endif;
                        endwhile;
                        // return  $collectionProducts;
                        if($collectionProducts[0]!=null):
                            foreach($collectionProducts as $cProducts):
                                $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($cProductsId == $product['product_id']):
                                            $cProducts['count'] = $cProducts['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            $price = array_column($collectionProducts, 'count');
                            array_multisort($price, SORT_DESC, $collectionProducts);
                            $products = array_merge($products,collect($collectionProducts)->take(4)->toArray());
                            foreach($products as $collectionProduct):
                                $aProductHandle[] = $collectionProduct['node']['handle'];
                            endforeach;
                        endif;
                        // return $products;
                    elseif($upsell->Atags->count()):
                        $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                        // $lineitems             =  $shop->orders->pluck('order.line_items');
                        $lineitems = $shop->userOrders->pluck('order.line_items');
                        $checked_Shopify_Tags  =  collect([]);
                        $flag  = true;
                        $limit = 0;
                        $TagsProducts = [];
                        while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                            $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                            $checked_Shopify_Tags[] =   $shopify_Tag[0];
                            $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                            // return $tagProducts['products']['edges'];
                            if(count($tagProducts['products']['edges'])):
                                if($limit <= 50):
                                    foreach($tagProducts['products']['edges'] as $responseProduct):
                                        // return $responseProduct['node']['id'];
                                        $flag2 = false;
                                        foreach($TagsProducts as $node):
                                            if($node['node']['id'] == $responseProduct['node']['id']):
                                                $flag2 = true;
                                                break;
                                            endif;
                                        endforeach;
                                        if(!$flag2):
                                            $responseProduct['count'] = 0;
                                            $TagsProducts[] = $responseProduct;
                                        endif;
                                        $limit++;
                                    endforeach;
                                else:
                                    $flag = false;
                                endif;
                            endif;
                        endwhile;
                        // return $TagsProducts;
                        if(count($TagsProducts)):
                            foreach($TagsProducts as $tagProduct):
                                $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                                // return $tagProductId;
                                foreach($lineitems as $OrderItem ):
                                    foreach($OrderItem as $product):
                                        if($tagProductId == $product['product_id']):
                                            $tagProduct['count'] = $tagProduct['count']+1;
                                        endif;
                                    endforeach;
                                endforeach;
                            endforeach;
                            // return $TagsProducts;
                            $price = array_column($TagsProducts, 'count');
                            array_multisort($price, SORT_DESC, $TagsProducts);
                            $products = array_merge($products,collect($TagsProducts)->take(4)->toArray());
                            foreach($products as $tagsProduct):
                                $aProductHandle[] = $tagsProduct['node']['handle'];
                            endforeach;
                        endif;
                    endif;
                endif;
            endforeach;
            $upsellId = $upsell->id;
            $aProductHandle = array_unique($aProductHandle);
            $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
            $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
            $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','upsellId','aProductHandle','currency'))->render();
        endif;
        if(count($data)):
            // dd($data);
            return $data;
        else:
            return $data;
        endif;
    }

    /**
     *
     * ------------------------------------------------------------------
     * this method is creating data for Volume Discount Upsell
     * ------------------------------------------------------------------
     *
     */

    public function volumeDiscount($upsell,$shop)
    {
        $data = [];
        if(request()->product_id && $upsell->Tproducts->where('shopify_product_id',request()->product_id)->count()):
            $products = [];
            $tProductHandle = [];
            if($upsell->volumeDiscounts->count()):
                $product_ids = $upsell->Tproducts->pluck('shopify_product_id');
                $products = $this->getProductsForUpsellGraphql($product_ids,$shop);
                foreach ($products['nodes'] as $product):
                    $tProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$product['id']);
                    if($tProductId == request()->product_id):
                        $tProductHandle[] = $product['handle'];
                    endif;
                endforeach;
                $volume_discount_deals = $upsell->volumeDiscounts;
                $upsell_id = $upsell->id;
                $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $tProductHandle;
                $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','tProductHandle','volume_discount_deals','upsell_id'))->with('shopName',$shop->name)->render();
            endif;
        elseif(request()->product_collection_ids && $upsell->Tcollections->where('shopify_collection_id',request()->product_collection_ids[0])->count()):
            if($upsell->volumeDiscounts->count()):
                $shopify_collecton_id   =  $upsell->Tcollections->pluck('shopify_collection_id');
                $collections = $this->getCollectionProductsGraphql($shopify_collecton_id,$shop);
                foreach($collections as $collectionProducts):
                    $tProducts = $collectionProducts["products"]["edges"];
                    $tProductHandle = [];
                    foreach ($tProducts as $tProduct):
                        $TproductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tProduct['node']['id']);
                        if($TproductId == request()->product_id):
                            $tProductHandle[]  = $tProduct['node']['handle'];
                        endif;
                    endforeach;
                endforeach;
                $volume_discount_deals = $upsell->volumeDiscounts;
                $upsell_id = $upsell->id;
                $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $tProductHandle;
                $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','tProductHandle','volume_discount_deals','upsell_id'))->with('shopName',$shop->name)->render();
            endif;
        elseif(request()->product_tags && $upsell->Ttags->where('shopify_tag_id',request()->product_tags[0])->count()):
            if($upsell->volumeDiscounts->count()):
                $shopify_tag_id   =  $upsell->Ttags->pluck('shopify_tag_id');
                $tagsProducts = $this->getTagProductsGraphql($shopify_tag_id,$shop);
                $tProductHandle = [];
                foreach($tagsProducts["products"]["edges"] as $tagProduct):
                    $TproductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                        if($TproductId == request()->product_id):
                            $tProductHandle[]  = $tagProduct['node']['handle'];
                        endif;
                endforeach;
                $volume_discount_deals = $upsell->volumeDiscounts;
                $upsell_id = $upsell->id;
                $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $tProductHandle;
                $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','tProductHandle','volume_discount_deals','upsell_id'))->with('shopName',$shop->name)->render();
            endif;
        endif;
        if(count($data)):
            $this->updateUpsellViews($upsell->id);
            return $data;
        else:
            return $data;
        endif;
    }

    /**
     *
     * ------------------------------------------------------------------
     * this method is creating data for Sale Notification Upsell
     * ------------------------------------------------------------------
     *
     */

    public function saleNotification($shop,$sale_notification_upsell)
    {
        $orderProducts = $shop->orders->pluck('order')->transform(function($item){
            // $item = json_decode($item,true);
            $country_name = $item['customer']['default_address']['country_name'];
            $customer_name = $item['customer']['first_name'].' '.$item['customer']['last_name'];
            $created_ago = Carbon::parse($item['created_at'])->diffForHumans();
            return collect($item['line_items'])
                ->transform(function($item2) use ($country_name,$customer_name,$created_ago){
                    return [
                        'product_id' => $item2['product_id'],
                        'quantity' => $item2['quantity'],
                        'variant_id' => $item2['variant_id'],
                        'title'=> $item2['title'],
                        'variant_title' => $item2['variant_title'],
                        'name' => $item2['name'],
                        'price' => $item2['price'],
                        'country_name' => $country_name,
                        'customer_name' => $customer_name,
                        'created_ago' => $created_ago
                    ];
                });
        })->collapse();
        $orderProducts->transform(function($item) use ($orderProducts){
            $item['count'] = $orderProducts->where('product_id',$item['product_id'])->count();
            return $item;
        });
        $orderProductsImages = collect($this->getOrderProductsDetails($orderProducts->pluck('product_id')->unique()->implode(','),$shop));
        $orderProducts->transform(function($product) use ($orderProductsImages){
            $responseProduct = $orderProductsImages->where('id',$product['product_id'])->first();
            $product['image'] = $responseProduct['image']['src'];
            $product['handle'] = $responseProduct['handle'];
            return $product;
        });
        $orderProducts->unique('product_id')->values()->sortByDesc('count')->take(10);
        $data[ $this->commonString($sale_notification_upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('orderProducts'))->with(['shopName' => $shop->name,'upsell' => $sale_notification_upsell])->render();
        $data[ $this->commonString($sale_notification_upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('orderProducts'))->with(['shopName' => $shop->name,'upsell' => $sale_notification_upsell])->render();
        $this->updateUpsellViews($sale_notification_upsell->id);
        return $data;
    }

    /**
     *
     * ------------------------------------------------------------------
     * this method is creating data for InCart Upsell
     * ------------------------------------------------------------------
     *
     */

    public function inCart($shop,$upsell)
    {
        $data = [];
        if(count(request('product_ids'))):
            $cart_products = request()->product_ids;
            foreach($cart_products as $cart_product_id):
                if($upsell->Tproducts->where('shopify_product_id',$cart_product_id)->count()):
                    if($upsell->Aproducts->count()):
                        $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                        $product_ids_to_get=json_decode($product_ids_to_get);
                        $product_ids_to_target = $upsell->Tproducts->pluck('shopify_product_id');
                        $product_ids_to_target=json_decode($product_ids_to_target);
                        $appearing_products = array_diff($product_ids_to_get,$product_ids_to_target);
                        $appearOnproducts = $this->getProductsForUpsellGraphql($appearing_products,$shop);
                        $aProducts = [];
                        foreach($appearOnproducts['nodes'] as $aproducts):
                            $aProducts[] = collect($aproducts);
                        endforeach;
                        $incart_appear_on_product = Arr::random($aProducts);
                        $upsell_id = $upsell->id;
                        $aProductHandle[] = $incart_appear_on_product['handle'];
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                    elseif($upsell->Acollections->count()):
                        $shopify_collecton_id   =  $upsell->Acollections->pluck('shopify_collection_id');
                        $product_ids_to_target = $upsell->Tproducts->pluck('shopify_product_id');
                        $product_ids_to_target=json_decode($product_ids_to_target);
                        $collections = $this->getCollectionProductsGraphql($shopify_collecton_id,$shop);
                        foreach($collections as $collectionProducts):
                            $aProducts[] = collect($collectionProducts["products"]["edges"]);
                        endforeach;
                        $productToAppear = [];
                        foreach($aProducts[0] as $product1)
                        {
                            $pid=str_replace("gid://shopify/Product/","",$product1['node']['id']);
                            if (!in_array($pid,$product_ids_to_target))
                            {
                                array_push($productToAppear,$product1);
                            }
                        }
                        $aProductt = $productToAppear;
                        $aProduct = Arr::random($aProductt);
                        $upsell_id = $upsell->id;
                        $aProductHandle[]  = $aProduct['node']['handle'];
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                    elseif($upsell->Atags->count()):
                        $shopify_tag_id   =  $upsell->Atags->pluck('shopify_tag_id');
                        $tags   = $this->getTagProductsGraphql($shopify_tag_id,$shop);
                        $aProducts = [];
                        foreach($tags["products"]["edges"] as $tagsProducts):
                            $aProducts[] = $tagsProducts;
                        endforeach;
                        $aProduct = Arr::random($aProducts);
                        // dd($aProduct);
                        $upsell_id = $upsell->id;
                        $aProductHandle[]  = $aProduct["node"]["handle"];
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                    endif;
                elseif($upsell->Tcollections->count()):
                    $cart_collection = request()->collection_ids;
                    foreach($cart_collection as $cart_collections):
                        if($upsell->Tcollections->where('shopify_collection_id',$cart_collections)->count()):
                            if($upsell->Aproducts->count()):
                                $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                                $appearOnproducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                                $aProducts = [];
                                foreach($appearOnproducts['nodes'] as $aproducts):
                                    $aProducts[] = collect($aproducts);
                                endforeach;
                                $incart_appear_on_product = Arr::random($aProducts);
                                $upsell_id = $upsell->id;
                                $aProductHandle[] = $incart_appear_on_product['handle'];
                                $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                                $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                                $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                            elseif($upsell->Acollections->count()):
                                    $shopify_collecton_id   =  $upsell->Acollections->pluck('shopify_collection_id');
                                    $collections = $this->getCollectionProductsGraphql($shopify_collecton_id,$shop);
                                    foreach($collections as $collectionProducts):
                                        $aProducts[] = collect($collectionProducts["products"]["edges"]);
                                    endforeach;
                                    $aProductt = $aProducts[0]->toArray();
                                    $aProduct = Arr::random($aProductt);
                                    $upsell_id = $upsell->id;
                                    $aProductHandle[]  = $aProduct["node"]["handle"];
                                    $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                                    $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                                    $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                            elseif($upsell->Atags->count()):
                                $shopify_tag_id   =  $upsell->Atags->pluck('shopify_tag_id');
                                $tags   = $this->getTagProductsGraphql($shopify_tag_id,$shop);
                                $aProducts = [];
                                foreach($tags["products"]["edges"] as $tagsProducts):
                                    $aProducts[] = $tagsProducts;
                                endforeach;
                                $aProduct = Arr::random($aProducts);
                                $upsell_id = $upsell->id;
                                $aProductHandle[]  = $aProduct["node"]["handle"];
                                $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                                $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                                $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                            endif;
                        endif;
                    endforeach;
                    elseif(count(request('tags'))):
                        $cart_tags = request()->tags;
                        foreach($cart_tags as $cart_tag):
                            if($upsell->Ttags->where('shopify_tag_id',$cart_tag)->count()):
                                if($upsell->Aproducts->count()):
                                    $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                                    $appearOnproducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                                    $aProducts = [];
                                    foreach($appearOnproducts['nodes'] as $aproducts):
                                        $aProducts[] = collect($aproducts);
                                    endforeach;
                                    $incart_appear_on_product = Arr::random($aProducts);
                                    $upsell_id = $upsell->id;
                                    $aProductHandle[] = $incart_appear_on_product['handle'];
                                    $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                                    $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                                    $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                                elseif($upsell->Acollections->count()):
                                        $shopify_collecton_id   =  $upsell->Acollections->pluck('shopify_collection_id');
                                        $collections = $this->getCollectionProductsGraphql($shopify_collecton_id,$shop);
                                        foreach($collections as $collectionProducts):
                                            $aProducts[] = collect($collectionProducts["products"]["edges"]);
                                        endforeach;
                                        $aProductt = $aProducts[0]->toArray();
                                        $aProduct = Arr::random($aProductt);
                                        $upsell_id = $upsell->id;
                                        $aProductHandle[]  = $aProduct["node"]["handle"];
                                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                                        $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                                        $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();

                                elseif($upsell->Atags->count()):
                                    $shopify_tag_id   =  $upsell->Atags->pluck('shopify_tag_id');
                                    $tags   = $this->getTagProductsGraphql($shopify_tag_id,$shop);
                                    $aProducts = [];
                                    foreach($tags["products"]["edges"] as $tagsProducts):
                                        $aProducts[] = $tagsProducts;
                                    endforeach;
                                    $aProduct = Arr::random($aProducts);
                                    $upsell_id = $upsell->id;
                                    $aProductHandle[]  = $aProduct["node"]["handle"];
                                    $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                                    $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                                    $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                                endif;
                            endif;
                        endforeach;
                    endif;
            endforeach;
        endif;
        if(count($data)):
            $this->updateUpsellViews($upsell->id);
            return $data;
        else:
            return $data;
        endif;
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
        // $upsell_data->upsellStats()->createMany([[
        //     'type'  => 'views',
        //     'value' => 1,
        // ]]);
        // UpsellStats::create([
        //     'type' => 1,
        //     'value' => 0,
        // ]);


        // $views        = $upsell_data[0]->views;
        // $views       += 1;
        // upsell::where('id',$upsell_id)
        // ->update([
        //     'views'          => $views
        // ]);
    }


    /**
      *
      * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      * This function is returning data for post purchase upsell
      * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      *
      *
     */

    public function alphaPostPurchaseUpsell()
    {
        /*
         |
         | ============================================================
         |  Get Shop Currency and return with response
         | ============================================================
         |
         |
        */
        $currency = Setting::select('currency')->whereHas('authUser',function($q){
            $q->where('name',request('shop'));
        })->first();
        $currency = config("currency.".$currency->currency.".currency_symbol");

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
                    $q2->where('name',config('upsell.strings.postPurchaseUpsellName'));
                });
                $q->with(['upsellType' => function($q2){
                    $q2->where('name',config('upsell.strings.postPurchaseUpsellName'));
                }]);
                $q->with([
                    'Tproducts',
                    'Tcollections',
                    'Ttags',
                    'Aproducts',
                    'Acollections',
                    'Atags',
                    'volumeDiscounts',
                    'upsellDiscounts']);
            }])->first();
            /**
             *
             * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
             * Filter Post Purchase Upsell from shop
             * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
             *
             */
            //
            if($shop->upsells->count()):
                $post_purchase_upsell = [];
                foreach(request('products_ids') as $post_purchase_upsell_Id):
                    foreach($shop->upsells as $post_purchase):
                        if($post_purchase->Tproducts->where('shopify_product_id',$post_purchase_upsell_Id)->count()):
                            $post_purchase_upsell[] = $post_purchase;
                        endif;
                    endforeach;
                endforeach;
            endif;
            /**
             *
             * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
             * Generate Random Post Purchase Upsell on priority basis
             * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
             *
             */

            if(isset($post_purchase_upsell) && count($post_purchase_upsell)):
                $upsell = collect($post_purchase_upsell)->where('priority',collect($post_purchase_upsell)->max('priority'))->random(1)[0];

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
                            // $lineitems = $shop->orders->pluck('order.line_items');
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
                            $products = array_merge($products,collect($productsWithCount)->take(4)->toArray());
                            foreach($products as $productHandle):
                                $aProductHandle[] = $productHandle['handle'];
                            endforeach;
                        elseif($upsell->Acollections->count()):
                            $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                            // $lineitems = $shop->orders->pluck('order.line_items');
                            $lineitems = $shop->userOrders->pluck('order.line_items');
                            $checked_shopify_collection_ids = collect([]);
                            $flag  = true;
                            $limit = 0;
                            $collectionProducts = [];
                            while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                                $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                                $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                                $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                                if($collections[0]!=null):
                                    if($limit <= 50):
                                        foreach($collections[0]['products']['edges'] as $responseProduct):
                                            $flag2 = false;
                                            foreach($collectionProducts as $node):
                                                if($node['node']['id'] == $responseProduct['node']['id']):
                                                    $flag2 = true;
                                                    break;
                                                endif;
                                            endforeach;
                                            if(!$flag2):
                                                $responseProduct['count'] = 0;
                                                $collectionProducts[] = $responseProduct;
                                            endif;
                                            $limit++;
                                        endforeach;
                                    else:
                                        $flag = false;
                                    endif;
                                endif;
                            endwhile;
                            if($collectionProducts[0]!=null):
                                foreach($collectionProducts as $cProducts):
                                    $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                                    foreach($lineitems as $OrderItem ):
                                        foreach($OrderItem as $product):
                                            if($cProductsId == $product['product_id']):
                                                $cProducts['count'] = $cProducts['count']+1;
                                            endif;
                                        endforeach;
                                    endforeach;
                                endforeach;
                                $price = array_column($collectionProducts, 'count');
                                array_multisort($price, SORT_DESC, $collectionProducts);
                                $products = array_merge($products,collect($collectionProducts)->take(4)->toArray());
                                foreach($products as $collectionProduct):
                                    $aProductHandle[] = $collectionProduct['node']['handle'];
                                endforeach;
                            endif;
                        elseif($upsell->Atags->count()):
                            $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                            // $lineitems             =  $shop->orders->pluck('order.line_items');
                            $lineitems = $shop->userOrders->pluck('order.line_items');
                            $checked_Shopify_Tags  =  collect([]);
                            $flag  = true;
                            $limit = 0;
                            $TagsProducts = [];
                            while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                                $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                                $checked_Shopify_Tags[] =   $shopify_Tag[0];
                                $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                                // return $tagProducts['products']['edges'];
                                if(count($tagProducts['products']['edges'])):
                                    if($limit <= 50):
                                        foreach($tagProducts['products']['edges'] as $responseProduct):
                                            // return $responseProduct['node']['id'];
                                            $flag2 = false;
                                            foreach($TagsProducts as $node):
                                                if($node['node']['id'] == $responseProduct['node']['id']):
                                                    $flag2 = true;
                                                    break;
                                                endif;
                                            endforeach;
                                            if(!$flag2):
                                                $responseProduct['count'] = 0;
                                                $TagsProducts[] = $responseProduct;
                                            endif;
                                            $limit++;
                                        endforeach;
                                    else:
                                        $flag = false;
                                    endif;
                                endif;
                            endwhile;
                            // return $TagsProducts;
                            if(count($TagsProducts)):
                                foreach($TagsProducts as $tagProduct):
                                    $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                                    // return $tagProductId;
                                    foreach($lineitems as $OrderItem ):
                                        foreach($OrderItem as $product):
                                            if($tagProductId == $product['product_id']):
                                                $tagProduct['count'] = $tagProduct['count']+1;
                                            endif;
                                        endforeach;
                                    endforeach;
                                endforeach;
                                $price = array_column($TagsProducts, 'count');
                                array_multisort($price, SORT_DESC, $TagsProducts);
                                $products = array_merge($products,collect($TagsProducts)->take(4)->toArray());
                                foreach($products as $TagsProducts):
                                    $aProductHandle[] = $TagsProducts['node']['handle'];
                                endforeach;
                            endif;
                        endif;
                        $upsellId = $upsell->id;
                        $aProductHandle = array_unique($aProductHandle);
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','upsellId','aProductHandle','currency'))->render();
                    elseif($upsell->Tcollections->count()):
                        $tCollectionIds = $upsell->Tcollections->pluck('shopify_collection_id');
                        foreach ($tCollectionIds as $key1 => $value) :
                            if(in_array($value,request()->product_collection_ids)):
                                $products  = [];
                                $productsWithCount = [];
                                $aProductHandle = [];
                                if($upsell->Aproducts->count()):
                                    // $lineitems = $shop->orders->pluck('order.line_items');
                                    $lineitems = $shop->userOrders->pluck('order.line_items');
                                    $lineitems = $shop->userOrders->pluck('order.line_items');
                                    $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                                    $appearOnproducts = $this->getProductsForUpsellGraphql($product_ids_to_get,$shop);
                                    foreach($appearOnproducts['nodes'] as $aproducts):
                                        $aproducts['count']=0;
                                        // $aProductHandle[] = $aproducts['handle'];
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
                                    $products = array_merge($products,collect($productsWithCount)->take(4)->toArray());
                                    foreach($products as $productHandle):
                                        $aProductHandle[] = $productHandle['handle'];
                                    endforeach;
                                elseif($upsell->Acollections->count()):
                                    $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                                    // $lineitems = $shop->orders->pluck('order.line_items');
                                    $lineitems = $shop->userOrders->pluck('order.line_items');
                                    $checked_shopify_collection_ids = collect([]);
                                    $flag  = true;
                                    $limit = 0;
                                    $collectionProducts = [];
                                    while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                                        $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                                        $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                                        $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                                        // return $collections;
                                        // dd($collections);
                                        if($collections[0]!=null):
                                            if($limit <= 50):
                                                foreach($collections[0]['products']['edges'] as $responseProduct):
                                                    $flag2 = false;
                                                    foreach($collectionProducts as $node):
                                                        if($node['node']['id'] == $responseProduct['node']['id']):
                                                            $flag2 = true;
                                                            break;
                                                        endif;
                                                    endforeach;
                                                    if(!$flag2):
                                                        $responseProduct['count'] = 0;
                                                        $collectionProducts[] = $responseProduct;
                                                    endif;
                                                    $limit++;
                                                endforeach;
                                            else:
                                                $flag = false;
                                            endif;
                                        endif;
                                    endwhile;
                                    // return  $collectionProducts;
                                    if($collectionProducts[0]!=null):
                                        foreach($collectionProducts as $cProducts):
                                            $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                                            foreach($lineitems as $OrderItem ):
                                                foreach($OrderItem as $product):
                                                    if($cProductsId == $product['product_id']):
                                                        $cProducts['count'] = $cProducts['count']+1;
                                                    endif;
                                                endforeach;
                                            endforeach;
                                        endforeach;
                                        $price = array_column($collectionProducts, 'count');
                                        array_multisort($price, SORT_DESC, $collectionProducts);
                                        $products = array_merge($products,collect($collectionProducts)->take(2)->toArray());
                                        // dd($products);
                                        foreach($products as $collectionProduct):
                                            $aProductHandle[] = $collectionProduct['node']['handle'];
                                        endforeach;
                                        // dd($aProductHandle);
                                    endif;
                                    // return $products;
                                elseif($upsell->Atags->count()):
                                    $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                                    // $lineitems             =  $shop->orders->pluck('order.line_items');
                                    $lineitems = $shop->userOrders->pluck('order.line_items');
                                    $checked_Shopify_Tags  =  collect([]);
                                    $flag  = true;
                                    $limit = 0;
                                    $TagsProducts = [];
                                    while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                                        $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                                        $checked_Shopify_Tags[] =   $shopify_Tag[0];
                                        $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                                        // return $tagProducts['products']['edges'];
                                        if(count($tagProducts['products']['edges'])):
                                            if($limit <= 50):
                                                foreach($tagProducts['products']['edges'] as $responseProduct):
                                                    // return $responseProduct['node']['id'];
                                                    $flag2 = false;
                                                    foreach($TagsProducts as $node):
                                                        if($node['node']['id'] == $responseProduct['node']['id']):
                                                            $flag2 = true;
                                                            break;
                                                        endif;
                                                    endforeach;
                                                    if(!$flag2):
                                                        $responseProduct['count'] = 0;
                                                        $TagsProducts[] = $responseProduct;
                                                    endif;
                                                    $limit++;
                                                endforeach;
                                            else:
                                                $flag = false;
                                            endif;
                                        endif;
                                    endwhile;
                                    // return $TagsProducts;
                                    if(count($TagsProducts)):
                                        foreach($TagsProducts as $tagProduct):
                                            $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                                            // return $tagProductId;
                                            foreach($lineitems as $OrderItem ):
                                                foreach($OrderItem as $product):
                                                    if($tagProductId == $product['product_id']):
                                                            $tagProduct['count'] = $tagProduct['count']+1;
                                                    endif;
                                                endforeach;
                                            endforeach;
                                        endforeach;
                                        // return $TagsProducts;
                                        $price = array_column($TagsProducts, 'count');
                                        array_multisort($price, SORT_DESC, $TagsProducts);
                                        $products = array_merge($products,collect($productsWithCount)->take(4)->toArray());
                                        foreach($products as $collectionProduct):
                                            $aProductHandle[] = $collectionProduct['handle'];
                                        endforeach;
                                    endif;
                                endif;
                            endif;
                        endforeach;
                        // dd($aProductHandle);
                        // dd($upsell->id);
                        $upsellId = $upsell->id;
                        $aProductHandle = array_unique($aProductHandle);
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','aProductHandle','upsellId','currency'))->render();
                    elseif($upsell->Ttags->count()):
                        $tTagIds = $upsell->Ttags->pluck('shopify_tag_id');
                        foreach ($tTagIds as $value) :
                            if(in_array($value,request()->product_tags)):
                                $products  = [];
                                $productsWithCount = [];
                                if($upsell->Aproducts->count()):
                                    // $lineitems = $shop->orders->pluck('order.line_items');
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
                                    $products = array_merge($products,collect($productsWithCount)->take(4)->toArray());
                                    foreach($products as $productHandle):
                                        $aProductHandle[] = $productHandle['handle'];
                                    endforeach;
                                elseif($upsell->Acollections->count()):
                                    $shopify_collectonIds   =  $upsell->Acollections->pluck('shopify_collection_id');
                                    // $lineitems = $shop->orders->pluck('order.line_items');
                                    $lineitems = $shop->userOrders->pluck('order.line_items');
                                    $checked_shopify_collection_ids = collect([]);
                                    $flag  = true;
                                    $limit = 0;
                                    $collectionProducts = [];
                                    while($flag && $shopify_collectonIds->count() != $checked_shopify_collection_ids->count()):
                                        $collections_ids_to_get =  $shopify_collectonIds->diff($checked_shopify_collection_ids)->random(1);
                                        $checked_shopify_collection_ids[] = $collections_ids_to_get[0];
                                        $collections = $this->getCollectionProductsGraphql($collections_ids_to_get,$shop);
                                        // return $collections;
                                        if($collections[0]!=null):
                                            if($limit <= 50):
                                                foreach($collections[0]['products']['edges'] as $responseProduct):
                                                    $flag2 = false;
                                                    foreach($collectionProducts as $node):
                                                        if($node['node']['id'] == $responseProduct['node']['id']):
                                                            $flag2 = true;
                                                            break;
                                                        endif;
                                                    endforeach;
                                                    if(!$flag2):
                                                        $responseProduct['count'] = 0;
                                                        $collectionProducts[] = $responseProduct;
                                                    endif;
                                                    $limit++;
                                                endforeach;
                                            else:
                                                $flag = false;
                                            endif;
                                        endif;
                                    endwhile;
                                    // return  $collectionProducts;
                                    if($collectionProducts[0]!=null):
                                        foreach($collectionProducts as $cProducts):
                                            $cProductsId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$cProducts['node']['id']);
                                            foreach($lineitems as $OrderItem ):
                                                foreach($OrderItem as $product):
                                                    if($cProductsId == $product['product_id']):
                                                        $cProducts['count'] = $cProducts['count']+1;
                                                    endif;
                                                endforeach;
                                            endforeach;
                                        endforeach;
                                        $price = array_column($collectionProducts, 'count');
                                        array_multisort($price, SORT_DESC, $collectionProducts);
                                        $products = array_merge($products,collect($collectionProducts)->take(2)->toArray());
                                        foreach($products as $collectionProduct):
                                            $aProductHandle[] = $collectionProduct['node']['handle'];
                                        endforeach;
                                    endif;
                                    // return $products;
                                elseif($upsell->Atags->count()):
                                    $shopify_Tags          =  $upsell->Atags->pluck('shopify_tag_id');
                                    // $lineitems             =  $shop->orders->pluck('order.line_items');
                                    $lineitems = $shop->userOrders->pluck('order.line_items');
                                    $checked_Shopify_Tags  =  collect([]);
                                    $flag  = true;
                                    $limit = 0;
                                    $TagsProducts = [];
                                    while($flag &&  $shopify_Tags->count() != $checked_Shopify_Tags->count()):
                                        $shopify_Tag =   $shopify_Tags->diff($checked_Shopify_Tags)->random(1);
                                        $checked_Shopify_Tags[] =   $shopify_Tag[0];
                                        $tagProducts = $this->getTagProductsGraphql($shopify_Tag,$shop);
                                        // return $tagProducts['products']['edges'];
                                        if(count($tagProducts['products']['edges'])):
                                            if($limit <= 50):
                                                foreach($tagProducts['products']['edges'] as $responseProduct):
                                                    // return $responseProduct['node']['id'];
                                                    $flag2 = false;
                                                    foreach($TagsProducts as $node):
                                                        if($node['node']['id'] == $responseProduct['node']['id']):
                                                            $flag2 = true;
                                                            break;
                                                        endif;
                                                    endforeach;
                                                    if(!$flag2):
                                                        $responseProduct['count'] = 0;
                                                        $TagsProducts[] = $responseProduct;
                                                    endif;
                                                    $limit++;
                                                endforeach;
                                            else:
                                                $flag = false;
                                            endif;
                                        endif;
                                    endwhile;
                                    // return $TagsProducts;
                                    if(count($TagsProducts)):
                                        foreach($TagsProducts as $tagProduct):
                                            $tagProductId = str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$tagProduct['node']['id']);
                                            // return $tagProductId;
                                            foreach($lineitems as $OrderItem ):
                                                foreach($OrderItem as $product):
                                                    if($tagProductId == $product['product_id']):
                                                        $tagProduct['count'] = $tagProduct['count']+1;
                                                    endif;
                                                endforeach;
                                            endforeach;
                                        endforeach;
                                        // return $TagsProducts;
                                        $price = array_column($TagsProducts, 'count');
                                        array_multisort($price, SORT_DESC, $TagsProducts);
                                        $products = array_merge($products,collect($TagsProducts)->take(2)->toArray());
                                        foreach($products as $tagsProduct):
                                            $aProductHandle[] = $tagsProduct['node']['handle'];
                                        endforeach;
                                    endif;
                                endif;
                            endif;
                        endforeach;
                        $upsellId = $upsell->id;
                        $aProductHandle = array_unique($aProductHandle);
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] = $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css']  = view('upsell_designs.index_css',compact('upsell','products'))->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js']   = view('upsell_designs.index_js',compact('upsell','products','upsellId','aProductHandle','currency'))->render();
                    endif;
                    if(count($data)):
                        $upsells_handle = [];
                        foreach($data as $key => $handle):
                            if(isset($handle['handle'])):
                                $upsells_handle = array_merge($upsells_handle,$handle['handle']);
                                unset($handle['handle']);
                                $data[$key] = $handle;
                            endif;
                        endforeach;
                        $upsells_handle = array_unique($upsells_handle);
                        $this->updateUpsellViews($upsell->id);
                        return response()->json(['currency'=> $currency,'status' => true,'upsells' => $data,'upsell_handles'=> $upsells_handle]);
                    else:
                        return $data;
                    endif;
                endif;
            else:
                return response()->json(['status' => false]);
            endif;
        endif;
     }

     public function alphaIncartUpsell(){
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
                    $q2->where('name',config('upsell.strings.inCartUpsellName'));
                });
                $q->with(['upsellType' => function($q2){
                    $q2->where('name',config('upsell.strings.inCartUpsellName'));
                }]);
                $q->with([
                    'Tproducts',
                    'Tcollections',
                    'Ttags',
                    'Aproducts',
                    'Acollections',
                    'Atags'
                    ]);
            }])->first();
            if(count($shop->upsells)):
                $incart_upsell = [];
                foreach($shop->upsells as $incart):
                    if($incart->Tproducts->where('shopify_product_id',request()->product_id)->count()):
                        $incart_upsell[] = $incart;
                    endif;
                endforeach;
            endif;
            // dd($incart_upsell);
            if(isset($incart_upsell) && count($incart_upsell)):
                $upsell = collect($incart_upsell)->where('priority',collect($incart_upsell)->max('priority'))->random(1)[0];
                if($upsell):
                    if($upsell->Aproducts->count()):
                        $product_ids_to_get = $upsell->Aproducts->pluck('shopify_product_id');
                        $product_ids_to_get=json_decode($product_ids_to_get);
                        $product_ids_to_target = $upsell->Tproducts->pluck('shopify_product_id');
                        $product_ids_to_target=json_decode($product_ids_to_target);
                        $appearing_products = array_diff($product_ids_to_get,$product_ids_to_target);
                        $appearOnproducts = $this->getProductsForUpsellGraphql($appearing_products,$shop);
                        $aProducts = [];
                        foreach($appearOnproducts['nodes'] as $aproducts):
                            $aProducts[] = collect($aproducts);
                        endforeach;
                        $incart_appear_on_product = Arr::random($aProducts);
                        $upsell_id = $upsell->id;
                        $aProductHandle[] = $incart_appear_on_product['handle'];
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                        // dd($data);
                    elseif($upsell->Acollections->count()):
                        $shopify_collecton_id   =  $upsell->Acollections->pluck('shopify_collection_id');
                        $product_ids_to_target = $upsell->Tproducts->pluck('shopify_product_id');
                        $product_ids_to_target=json_decode($product_ids_to_target);
                        $collections = $this->getCollectionProductsGraphql($shopify_collecton_id,$shop);
                        foreach($collections as $collectionProducts):
                            $aProducts[] = collect($collectionProducts["products"]["edges"]);
                        endforeach;
                        $productToAppear = [];
                        foreach($aProducts[0] as $product1)
                        {
                            $pid=str_replace("gid://shopify/Product/","",$product1['node']['id']);
                            if (!in_array($pid,$product_ids_to_target))
                            {
                                array_push($productToAppear,$product1);
                            }
                        }
                        // info($productToAppear);
                        $aProductt = $productToAppear;
                        $aProduct = Arr::random($aProductt);
                        $upsell_id = $upsell->id;
                        $aProductHandle[]  = $aProduct['node']['handle'];
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                    elseif($upsell->Atags->count()):
                        $shopify_tag_id   =  $upsell->Atags->pluck('shopify_tag_id');
                        $tags   = $this->getTagProductsGraphql($shopify_tag_id,$shop);
                        $aProducts = [];
                        foreach($tags["products"]["edges"] as $tagsProducts):
                            $aProducts[] = $tagsProducts;
                        endforeach;
                        $aProduct = Arr::random($aProducts);
                        // dd($aProduct);
                        $upsell_id = $upsell->id;
                        $aProductHandle[]  = $aProduct["node"]["handle"];
                        $data[ $this->commonString($upsell->upsellType->name) ]['handle'] =  $aProductHandle;
                        $data[ $this->commonString($upsell->upsellType->name) ]['css'] = view('upsell_designs.index_css',compact('upsell'))->with('shopName',$shop->name)->render();
                        $data[ $this->commonString($upsell->upsellType->name) ]['js'] = view('upsell_designs.index_js',compact('upsell','aProductHandle','upsell_id'))->with('shopName',$shop->name)->render();
                    endif;
                    return response()->json(['status' => true,'upsells' => $data,'upsell_handles'=> $aProductHandle]);
                endif;
            else:
                 return response()->json(['status' => false]);
            endif;
        endif;
    }

    /**
      *
      * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      * Get Most Purchased Products to show on frontend
      * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      *
      *
     */

    public function getOrdersProducts($upsell, $shop, $skip_target_product)
    {
        $orders_product_ids = DB::table('orders')
                    ->select(DB::raw('JSON_EXTRACT(orders.order,"$.line_items[*].product_id") as lineitems'))
                    ->where('user_id',$shop->id)
                    ->orderBy('id','desc')
                    ->take(50)
                    ->get();
        if(isset($orders_product_ids) && count($orders_product_ids)):
            $orders_product_ids =   $orders_product_ids->transform(function($ele){
                return json_decode($ele->lineitems);
            })->collapse()->countBy()->sortDesc()->take(4)->except($skip_target_product)->keys();
        else:
            return "Not any order placed since the app installed";
        endif;
        $appearOnproducts = $this->getProductsForUpsellGraphql($orders_product_ids,$shop);
        return $appearOnproducts['nodes'];
    }

}
