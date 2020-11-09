<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    protected $appends = ['delete_active'];


    public function locationProductDetail()
    {
        return $this->hasMany('App\Models\LocationProductDetail');
    }

    public function getDeleteActiveAttribute()
    {
        if (count($this->locationProductDetail) > 0) {
            return false;
        } else {
            return true;
        }
    }
}
