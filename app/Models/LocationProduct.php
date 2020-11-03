<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProduct extends Model
{
    use HasFactory;

    protected $appends = ['delete_active'];


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

    public function getDeleteActiveAttribute()
    {
        if (count($this->locationProductLists) > 0) {
            return false;
        } else {
            return true;
        }
    }
}
