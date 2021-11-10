<?php

namespace App\Http\Controllers;


use App\Http\Traits\FrontEndTrait;
use App\Http\Traits\ShopifyTrait;
use App\Http\Traits\UpsellTrait;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
     use UpsellTrait,ShopifyTrait,FrontEndTrait;

    public function getData(){
        return $this->alphaFilterUpsells();
    }


    public function getPostPurchaseData(){
        return $this->alphaPostPurchaseUpsell();
    }

    public function getIncartData(){
        return $this->alphaIncartUpsell();
    }
}
