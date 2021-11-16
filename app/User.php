<?php

namespace App;

use App\Models\ContactUs;
use App\Models\Order;
use App\Models\Setting;
use App\Models\ShopProduct;
use App\Models\Upsell;
use App\UsageCharge;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;
use Osiset\ShopifyApp\Contracts\ShopModel as IShopModel;
use Osiset\ShopifyApp\Storage\Models\Charge;
use Osiset\ShopifyApp\Traits\ShopModel;
use Log;

class User extends Authenticatable implements IShopModel
{
    use HasFillableRelations;
    use Notifiable;
    use ShopModel;
    protected $fillable_relations = ['products'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','shopify_freemium','plan_id','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['settings'];


    public static function boot()
    {
       parent::boot();

       static::deleted(function($user){
            $shop = User::withTrashed()->find($user->id);
            $shop->status = false;
            $shop->settings->update([
                'setup' => false,
                'scripttag' => false,
                'script_tag_id' => null,
                'trial_ends' => null,
            ]);
            $shop->shopify_freemium = false;
            $shop->save();
            // info('success');
       });
    }


    public function settings()
    {
        return $this->hasOne(Setting::class);
    }

    public function shop_contacts()
    {
        return $this->hasMany(ContactUs::class);
    }

    public function currentCharge()
    {
        return $this->hasOne(Charge::class)->where('status','ACTIVE');
    }

    public function products()
    {
        return $this->hasMany(ShopProduct::class);
    }

    public function upsells()
    {
        return $this->hasMany(Upsell::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function billingOrder()
    {
        return $this->hasMany(Order::class,'user_id','id')->whereBetween('shopify_created_at',[
            today()->subDays(30),today()
        ]);
    }

    public function recurringCharge()
    {
        return $this->hasOne(Charge::class)->where('status','ACTIVE');
    }
    public function currentUsageCharge()
    {
        return $this->hasMany(UsageCharge::class)->where('status','ACTIVE');
    }

    public function userOrders()
    {
        return $this->hasMany(Order::class)->limit(50)->latest();
    }


}
