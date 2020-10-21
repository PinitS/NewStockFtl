<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPart extends Model
{
    use HasFactory;

    public function locationProduct()
    {
        return $this->belongsTo('App\Models\LocationProduct' , 'product_id');
    }

    public function groupParts()
    {
        return $this->belongsTo('App\Models\GroupParts' , 'group_part_id');
    }
}
