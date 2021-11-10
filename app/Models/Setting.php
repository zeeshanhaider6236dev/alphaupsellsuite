<?php

namespace App\Models;

use App\User;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'user_id','setup','googleRefreshToken','googleAccessToken','googleAccountId','googleAccountEmail','domain','themeId','merchantAccountId','merchantAccountName','country','language','currency','productIdFormat','whichProducts','productIdFormat','shipping','collectionsId','productTitle','productdescription','variantSubmission','salePrice','secondImage','additionalImages','product_category_id','ageGroup','gender','productCondition','collectionType','enable','last_updated','store_name','store_email','store_phone','country_name','plan_display_name','trial_ends','scripttag','script_tag_id'
    ];

    protected $dates = [
        'last_updated'
    ];

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }
    public function authUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
