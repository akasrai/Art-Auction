<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    protected $fillable = ['product_id', 'price', 'estimated_price','discount', 'is_on_auction','auction_final_date'];
}
