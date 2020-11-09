<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProductDetail extends Model
{
    use HasFactory;

    public function locationProductList()
    {
        return $this->belongsTo('App\Models\LocationProductList');
    }

    public function dealer()
    {
        return $this->belongsTo('App\Models\Dealer');
    }
}
