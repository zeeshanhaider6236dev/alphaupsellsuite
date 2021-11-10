<?php
namespace App\Http\Traits;

use App\Models\Upsell;
use App\Http\Traits\FbtTrait;
use App\Http\Traits\PpuTrait;
use App\Http\Traits\IncartTrait;

trait UpsellTrait {
  
    use FbtTrait,VolumeDiscountTrait,PpuTrait,SaleNotificaionTrait,IncartTrait,AddtocartTrait,NativePostPurchaseTrait;
  
    public function makeViewUrl($name){
        return $this->commonString($name);
    }

    public function addUpsellFunctionName($name){
        return 'add_'.$this->commonString($name).'_upsell';
    }

    
    public function updateUpsellFunctionName($name){
        return 'update_'.$this->commonString($name).'_upsell';
    }

    public function commonString($name)
    {
        return str_replace(' ','_',strtolower($name));
    }

    public function Upsellstore($upsellType)
    {
        $addUpsellFunctionName = $this->addUpsellFunctionName($upsellType->name);
        return $this->$addUpsellFunctionName($upsellType);
    }

    public function Upsellupdate($upsell)
    {
        $upsellType = $upsell->upsellType;
        $updateUpsellFunctionName = $this->updateUpsellFunctionName($upsellType->name);
        return $this->$updateUpsellFunctionName($upsell);
    }

    public function saleNotificationQuery()
    {
        $saleNotificationUpsellCount  = Upsell::selectRaw('count(*) as count')->where(['user_id'=>auth()->user()->id,'name'=>'Sale Notification Upsell'])->first()->count;
        return  $saleNotificationUpsellCount;
    }


    /**
     * 
     * this function is deleting the current upsell previous data (e.g Target Products,
     * Target Collections, Target Tags, AppearOn Products,collection,tags etc) 
     * when updating the upsell
     * 
     */

    public function delPrevUpsellRecord($data)
    {
        $data['Tproducts'] = $data['Tcollections'] = $data['Ttags'] = [];
        $data['Aproducts'] = $data['Acollections'] = $data['Atags'] = [];
        return $data;
    }

}