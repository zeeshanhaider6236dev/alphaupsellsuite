<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpsellProduct extends Model
{
    protected $fillable = [
        'upsell_id','type','shopify_product_id','shopify_product_title','shopify_product_image','price_rule_id','discount_code'
    ];
}
