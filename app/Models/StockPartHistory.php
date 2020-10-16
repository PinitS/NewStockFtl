<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPartHistory extends Model
{
    use HasFactory;

    public function part()
    {
        return $this->belongsTo('App\Models\StockPart' , 'stock_part_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
