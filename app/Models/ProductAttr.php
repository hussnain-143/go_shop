<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    protected $guarded =[];

    public function images(){
        return $this->hasMany(ProductAttrImage::class, 'product_attr_id', 'id');
    }
}
