<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function isSlugUnique(String $slug)
    {
        return json_encode(!Product::where('slug', '=', $slug)->exists());
    }
}
