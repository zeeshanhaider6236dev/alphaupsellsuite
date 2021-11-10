<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpsellVolumeDiscount extends Model
{
    protected $fillable = [
        'upsell_id','quantity','discount','discount_type', 'price_rule_id','discount_code', 'best_deal'
    ];
}
