<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAuction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    protected $fillable = [
        'product_id', 'user_id','bid_price'
    ];
}
