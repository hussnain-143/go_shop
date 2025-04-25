<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    public $timestamps = false;

    protected $guarded = [];


    public function getImageAttribute($value)
    {
        
        if (empty($value)) {
            return null;
        }
        return asset($value);
        
    }

}
