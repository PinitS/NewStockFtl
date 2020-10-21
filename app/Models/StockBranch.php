<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBranch extends Model
{
    use HasFactory;

    public function parts()
    {
        return $this->hasMany('App\Models\StockPart');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\StockCategory');
    }
}
