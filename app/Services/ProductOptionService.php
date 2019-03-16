<?php

namespace App\Services;

use App\Models\ProductOption;
use Illuminate\Support\Facades\Validator;

class ProductOptionService
{
    public function save(array $productData, $productId)
    {
        if ((int)$productData['product-option'] == 0) {
            $this->saveProductOptionAsSell($productData, $productId);
        } elseif ((int)$productData['product-option'] == 1) {
            $this->saveProductOptionAsAuction($productData, $productId);
        }
    }
     
    private function saveProductOptionAsAuction($productData, $productId)
    {
        ProductOption::create([
            'product_id' => $productId,
            'is_on_auction' => $productData['product-option'],
            'estimated_price' => $productData['estimated-price'],
            'auction_final_date' => $productData['auction-final-date']
         ]);
    }

    private function saveProductOptionAsSell($productData, $productId)
    {
        ProductOption::create([
            'product_id' => $productId,
            'is_on_auction' => $productData['product-option'],
            'price' => $productData['price'],
            'discount' => $productData['discount']
         ]);
    }
}
