<?php

namespace App\Services;

use App\Models\ProductAuction;
use Illuminate\Support\Facades\Validator;

class ProductAuctionService
{
    protected function productAuctionValidator(array $data)
    {
        return Validator::make($data, [
            'userId' => 'required',
            'productId' => 'required',
            'biddingAmount' => 'required'
        ]);
    }

    public function save(array $biddingData)
    {
        $this->productAuctionValidator($biddingData)->validate();
        $productAuction = ProductAuction::create([
            'product_id' => $biddingData['productId'],
            'user_id' => $biddingData['userId'],
            'bid_price' => $biddingData['biddingAmount'],
         ]);

        return $productAuction;
    }
}
