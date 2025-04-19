<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $guarded =[];

    public function attr_value()  {

        return $this->hasOne(AttributeValue::class,'id', 'attribute_value_id' );
        
    }
}
