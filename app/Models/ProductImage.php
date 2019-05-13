<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    protected $fillable = [
        'product_id', 'image_url',
    ];
}
