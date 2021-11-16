<?php

namespace App\Http\Controllers;

use App\User;

class DiscountController extends Controller
{
	/**
     *
     * ---------------------------------------------
     * Discount Create for add to cart upsell
     * ---------------------------------------------
     *
     */
    public function createDiscounts(){
        $products = json_decode(request('discounts'));
        // dd(json_encode($products));
        $line_items = [];
        foreach ($products as $key => $value):
            $variant_id = $value->variant_id;
            if(isset($value->upsell_id->_alpha_atc_upsell_id)):
                $upsell_id  = $value->upsell_id->_alpha_atc_upsell_id;
                $shop       = $value->shop;
                $user 	    = User::where('name',$shop)->with(['upsells'=>function($u) use($upsell_id){
                	$u->where('id',$upsell_id);
                }])->first();
                if($user && count($user->upsells)):
                	$discount_type  = $user->upsells[0]->setting['discount_type'];
                	$discount_value = $user->upsells[0]->setting['discount_value'];
                	if($discount_type == config('upsell.strings.ppuDiscountType')[0]):
                		$lineItem = [
					      	"variant_id"=> $variant_id,
					        "quantity"=> 1,
					        "applied_discount"=> [
						        "description" => "T_Discount_".$value->upsell_id->_alpha_atc_upsell_id,
						        "value_type"  => "percentage",
						        "value"		  => $discount_value,
						        "amount"	  => $value->price,
					        ],
					    ];
					else:
						$lineItem = [
					      	"variant_id"=> $variant_id,
					        "quantity"=> 1,
					        "applied_discount"=> [
						        "description" => "T. Discount",
						        "value_type"  => "fixed_amount",
						        "value"		  => $discount_value,
						        "amount"	  => $value->price,
					        ]
					    ];
                	endif;
                	$line_items[] = $lineItem;
                else:
                	$shop       = $value->shop;
	                $user 	    = User::where('name',$shop)->first();
		        	$lineItem = [
				      	"variant_id"=> $variant_id,
				        "quantity"=> $value->quantity,
				    ];
				    $line_items[] = $lineItem;
                endif;
            else:
            	if(isset($value->upsell_id->_Sale_notification)):
	        		$alphaKeyName  = "_Sale_notification";
	        		$alphaKeyValue = $value->upsell_id->_Sale_notification;
	        	elseif(isset($value->upsell_id->_alpha_upsell_id)):
	        		$alphaKeyName  = "_alpha_upsell_id";
	        		$alphaKeyValue = $value->upsell_id->_alpha_upsell_id;
	        	endif;
            	$shop       = $value->shop;
                $user 	    = User::where('name',$shop)->first();
                if(isset($alphaKeyName) && isset($value->upsell_id->_alpha_upsell_id)):
                	$lineItem = [
			      	"variant_id"=> $variant_id,
			        "quantity"=> $value->quantity,
			        "properties" => [
			        	[
			        		"name"  => $alphaKeyName,
					        "value" => $alphaKeyValue
				        ]
		        	]
			    ];
                else:
		        	$lineItem = [
				      	"variant_id"=> $variant_id,
				        "quantity"=> $value->quantity,
				    ];
                endif;
			    $line_items[] = $lineItem;
            endif;
        endforeach;
        $data = [
        	"draft_order" => [
        		"line_items" => $line_items
        	]
        ];
        // dd($data);
        $get_product = $user->api()->rest('POST','/admin/api/2021-04/draft_orders.json',$data);
        // info(json_encode($get_product['body']));
        if($get_product['status'] == 201):
        	return response()->json(['status' =>true , "checkout_url" => $get_product['body']['draft_order']['invoice_url'] ]);
        endif;
    }
}
