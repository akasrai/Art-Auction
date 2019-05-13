<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    protected $fillable = ['name', 'slug', 'description','parent_id'];
}
