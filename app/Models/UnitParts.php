<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitParts extends Model
{
    use HasFactory;

    protected $appends = ['delete_active'];


    public function groupParts()
    {
        return $this->hasMany('App\Models\GroupParts');
    }

    public function getDeleteActiveAttribute()
    {
        if (count($this->groupParts) > 0 ) {
            return false;
        } else {
            return true;
        }
    }
}
