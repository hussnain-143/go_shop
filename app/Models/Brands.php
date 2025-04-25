<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $guarded = [];
    

    public function getImageAttribute($value)
    {
        
        if (empty($value)) {
            return null;
        }
        return asset($value);
        
    }
}
