<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpsellTemplate extends Model
{
    protected $fillable = [
        'upsell_type_id', 'name', 'template_path', 'setting'
    ];

    protected $casts = [
        'setting' => 'json'
    ];
}
