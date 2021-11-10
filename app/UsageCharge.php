<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsageCharge extends Model
{
    protected $fillable = [
        'user_id', 'charge_id', 'status','usage_charge_id','description','price','billing_on','balance_used','balance_remaining'
    ];
}
