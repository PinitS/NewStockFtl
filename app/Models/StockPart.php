<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPart extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\StockCategory');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\StockBranch');
    }

    public function histories()
    {
        return $this->hasMany('App\Models\StockHistory');
    }

}
