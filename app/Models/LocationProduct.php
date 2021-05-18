<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProduct extends Model
{
    use HasFactory;

    protected $appends = ['delete_active' , 'sum_cost'];

    public function dealerProduct()
    {
        return $this->hasMany('App\Models\DealerProduct');
    }

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
        if (count($this->locationProductLists) > 0 || count($this->dealerProduct)) {
            return false;
        } else {
            return true;
        }
    }
    public function getSumCostAttribute()
    {
        $sum = 0;
        foreach ($this->productParts as $item){
            $sum += $item->groupPart->cost * $item->quantity;
        }
        return number_format($sum,2);
    }
}
