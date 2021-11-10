<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'order' => 'json'
    ];
    protected $fillable = [
        'shopify_order_id','user_id','order','shopify_created_at','shopify_updated_at'
    ];
}
