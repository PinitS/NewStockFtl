<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
    use HasFactory;

    protected $appends = ['delete_active'];

    public function parts()
    {
        return $this->hasMany('App\Models\StockPart');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\StockBranch');
    }

    public function getDeleteActiveAttribute()
    {
        if (count($this->parts) > 0) {
            return false;
        } else {
            return true;
        }
    }
}
