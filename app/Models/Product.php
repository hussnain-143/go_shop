<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded =[];


    public function attribute(){
        return $this->hasMany(ProductAttribute::class,'product_id','id')->with('attr_value');
    }

    public function productAttribute()  {
        return $this->hasMany(ProductAttr::class,'product_id','id')->with('images'); 
    }


}

