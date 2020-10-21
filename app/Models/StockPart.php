<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPart extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\StockCategory', 'stock_category_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\StockBranch', 'stock_branch_id');
    }

    public function histories()
    {
        return $this->hasMany('App\Models\StockPartHistory');
    }

    public function productPart()
    {
        return $this->hasOne('App\Models\ProductPart');
    }

    public function groupPart()
    {
        return $this->belongsTo('App\Models\GroupParts' );
    }

}
