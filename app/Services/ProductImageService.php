<?php

namespace App\Services;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;

class ProductImageService
{
    public function save(array $images, $productId)
    {
        foreach ($images as $image) {
            $filename = $image->store('images/products');
            ProductImage::create([
                'product_id' => $productId,
                'image_url' => $filename
            ]);
        }
    }
}
