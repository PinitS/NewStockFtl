<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationModel extends Model
{
    use HasFactory;
    protected $appends = ['delete_active'];

    public function product()
    {
        return $this->hasMany('App\Models\LocationProduct');
    }
    public function getDeleteActiveAttribute()
    {
        if (count($this->product) > 0) {
            return false;
        } else {
            return true;
        }
    }
}
