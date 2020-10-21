<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupParts extends Model
{
    use HasFactory;

    public function productParts()
    {
        return $this->hasMany('App\Models\ProductPart' );
    }

    public function stockParts()
    {
        return $this->hasMany('App\Models\StockPart' );
    }

}
