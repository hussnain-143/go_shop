<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    protected $guarded = [];
    
    public function category()
    {
        return $this->hasOne(Category::class ,  'id','category_id',);
    }
    public function attribute()
    {
        return $this->hasOne(Attribute::class,  'id','attribute_id',);
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'attribute_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-M-Y'); 
    }
    
        public function getUpdatedAtAttribute($value)
        {
            return \Carbon\Carbon::parse($value)->format('d-M-Y');
        }
    
}
