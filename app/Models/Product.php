<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
     
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function options()
    {
        return $this->hasOne('App\Models\ProductOption');
    }

    public function auctions()
    {
        return $this->hasMany('App\Models\ProductAuction');
    }

    protected $fillable = [
        'name', 'slug','size','description', 'quality', 'materials_used', 'artist','painted_date','style','status','created_at','updated_at'
    ];
}
