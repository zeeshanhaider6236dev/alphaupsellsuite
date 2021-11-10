<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpsellCollection extends Model
{
    protected $fillable = [
        'upsell_id','shopify_collection_id','shopify_collection_title','shopify_collection_image','type','price_rule_id','discount_code'
    ];
}
