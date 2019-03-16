<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
     
    public function productImage()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    protected $fillable = [
        'name', 'slug','size','description', 'quality', 'materials_used', 'artist','painted_date','style','status','created_at','updated_at'
    ];
}
