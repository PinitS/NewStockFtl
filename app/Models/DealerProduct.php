<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerProduct extends Model
{
    use HasFactory;

    protected $appends = ['delete_active'];

    public function dealerProductHistory()
    {
        return $this->hasMany('App\Models\DealerProductHistory');
    }

    public function dealer()
    {
        return $this->belongsTo('App\Models\Dealer');
    }

    public function locationProduct()
    {
        return $this->belongsTo('App\Models\LocationProduct');
    }

    public function getDeleteActiveAttribute()
    {
        foreach ($this->dealerProductHistory as $history) {

            if ($history->type == 1) {
                return false;
            }
        }
        return true;
    }
}
