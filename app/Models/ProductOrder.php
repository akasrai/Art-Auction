<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    protected $fillable = ['order_reference', 'user_id', 'status', 'payment_method'];
}
