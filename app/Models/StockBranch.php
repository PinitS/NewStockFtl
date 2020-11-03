<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBranch extends Model
{
    use HasFactory;
    protected $appends = ['delete_active'];

    public function parts()
    {
        return $this->hasMany('App\Models\StockPart');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\StockCategory');
    }

    public function getDeleteActiveAttribute()
    {
        if (count($this->parts) > 0 || count($this->categories) > 0) {
            return false;
        } else {
            return true;
        }
    }
}
