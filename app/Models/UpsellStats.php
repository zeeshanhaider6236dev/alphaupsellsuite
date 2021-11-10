<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpsellStats extends Model
{
    //

    protected $fillable = ['upsell_id','type','value','upsell_created_at'];
    protected $dates = [
        'upsell_created_at'
    ];
}
