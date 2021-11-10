<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;


class UpsellType extends Model
{
    use HasFillableRelations;
  
    protected $fillable = [
        'name','image','setting'
    ];

    protected $fillable_relations = ['templates'];

    protected $casts = [
        'setting' => 'json'
    ];

    public function templates(){
        return $this->hasMany(UpsellTemplate::class,'upsell_type_id','id');
    }
    
}
