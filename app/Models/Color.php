<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = [];

    public function getTextAttribute($value){

        return ucwords($value);

    }
}


