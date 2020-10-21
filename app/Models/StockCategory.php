<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
    use HasFactory;

    public function parts()
    {
        return $this->hasMany('App\Models\StockPart');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\StockBranch');
    }
}
