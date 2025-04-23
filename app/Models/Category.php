<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function parentCategory()
{
    return $this->belongsTo(Category::class, 'parent_category_id');
}

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->with('productAttribute');
    }

    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }
    public function getImageAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return asset($value);
    }
    
}
