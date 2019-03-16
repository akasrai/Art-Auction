<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $fillable = ['product_id', 'price', 'estimated_price','discount', 'is_on_auction','auction_final_date'];
}
