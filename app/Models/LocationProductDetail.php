<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProductDetail extends Model
{
    use HasFactory;

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function locationProduct()
    {
        return $this->belongsTo('App\Models\LocationProduct');
    }
}
