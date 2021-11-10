<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpsellDiscount extends Model
{
    protected $fillable = [
        'upsell_id','price_rule_id','discount_code'
    ];
}
