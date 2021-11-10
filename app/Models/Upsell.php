<?php

namespace App\Models;

use App\Models\UpsellType;
use App\Models\UpsellStats;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;

class Upsell extends Model
{
    use HasFillableRelations;

    protected $fillable = [
        'name','upsell_type_id','user_id','status','auto','setting','views','add_to_cart'
    ];
    protected $casts = [
        'setting' => 'json'
    ];
    protected $fillable_relations = ['Tproducts','Tcollections','Ttags','Aproducts','Acollections','Atags','Dproducts','volumeDiscounts','upsellDiscounts'];

    public function Tproducts()
    {
        return $this->hasMany(UpsellProduct::class)->where('type','targeted');
    }

    public function Tcollections()
    {
        return $this->hasMany(UpsellCollection::class)->where('type','targeted');
    }

    public function Ttags()
    {
        return $this->hasMany(UpsellTag::class)->where('type','targeted');
    }

    public function volumeDiscounts()
    {
        return $this->hasMany(UpsellVolumeDiscount::class);
    }

    public function Aproducts()
    {
        return $this->hasMany(UpsellProduct::class)->where('type','appearOn');
    }

    public function Acollections()
    {
        return $this->hasMany(UpsellCollection::class)->where('type','appearOn');
    }

    public function Atags()
    {
        return $this->hasMany(UpsellTag::class)->where('type','appearOn');
    }
    public function Dproducts()
    {
        return $this->hasMany(UpsellProduct::class)->where('type','downsell');
    }
    public function upsellType()
    {
        return $this->belongsTo(UpsellType::class);
    }

    public function upsellDiscounts()
    {
        return $this->hasMany(UpsellDiscount::class);
    }

    public function upsellStats()
    {
        return $this->hasMany(UpsellStats::class);
    }
    public function upsellTotalViews()
    {
        return $this->hasMany(UpsellStats::class)->where('type','views');
    }
    public function upsellTotalAddToCart()
    {
        return $this->hasMany(UpsellStats::class)->where('type','add_to_cart');
    }
    public function upsellTotalRevenue()
    {
        return $this->hasMany(UpsellStats::class)->where('type','transactions');
    }
    public function upsellTotalOrders()
    {
        return $this->hasMany(UpsellStats::class)->where('type','sells');
    }
}
