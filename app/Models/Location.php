<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $appends = ['delete_active'];

    public function productLists()
    {
        return $this->hasMany('App\Models\LocationProductList');
    }

    public function getDeleteActiveAttribute()
    {
        if (count($this->productLists) > 0) {
            return false;
        } else {
            return true;
        }
    }
}
