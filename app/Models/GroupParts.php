<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupParts extends Model
{
    use HasFactory;
    protected $appends = ['delete_active'];

    public function productParts()
    {
        return $this->hasMany('App\Models\ProductPart' ,'group_part_id');
    }

    public function stockParts()
    {
        return $this->hasMany('App\Models\StockPart' , 'group_part_id');
    }

    public function getDeleteActiveAttribute()
    {
        if (count($this->productParts) > 0 || count($this->stockParts) > 0) {
            return false;
        } else {
            return true;
        }
    }

}
