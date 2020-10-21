<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProduct extends Model
{
    use HasFactory;

    public function locationProductLists()
    {
        return $this->hasMany('App\Models\LocationProductList');
    }

    public function productParts()
    {
        return $this->hasMany('App\Models\ProductPart');
    }

    public function locationModel()
    {
        return $this->belongsTo('App\Models\LocationModel');
    }
}
