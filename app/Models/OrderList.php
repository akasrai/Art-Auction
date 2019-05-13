<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\ProductOrder');
    }

    protected $fillable = ['product_id', 'order_id', 'quantity','price', 'status'];
}
