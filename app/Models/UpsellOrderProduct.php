<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpsellOrderProduct extends Model
{
    protected $fillable = [
        'upsell_order_id','upsell_order_product'
    ];
}
