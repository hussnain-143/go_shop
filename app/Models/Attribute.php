<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = [];

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }

}

