<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProduct extends Model
{
    use HasFactory;

    public function productDetail()
    {
        return $this->hasMany('App\Models\LocationProductDetail');
    }

    public function productPath()
    {
        return $this->hasMany('App\Models\ProductPath');
    }

    public function locationModel()
    {
        return $this->belongsTo('App\Models\LocationModel', 'model_id');
    }
}
