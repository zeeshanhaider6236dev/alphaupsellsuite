<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpsellTag extends Model
{
    protected $fillable = [
        'upsell_id','shopify_tag_id','shopify_tag_title','shopify_tag_image','type'
    ];
}
