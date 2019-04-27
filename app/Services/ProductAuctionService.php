<?php

namespace App\Services;

use Mail;
use App\Mail\auctionWinner;
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
            'comment' => $biddingData['comment']
         ]);

        return $productAuction;
    }


    public function countBidsByProductId($productId)
    {
        return ProductAuction::where('product_id', $productId)->count();
    }

    public function emailWinner($productId)
    {
        $winner = ProductAuction::where('product_id', $productId)->orderBy('bid_price', 'desc')->first();
        Mail::to($winner->user['email'])->send(new auctionWinner($winner));
        return $winner->product->slug;
    }

    public function getAllByUserId($userId)
    {
        $status = 1;
        return ProductAuction::with('product')->whereHas('product', function ($q) use ($status) {
            $q->where('status', $status);
        })->where('user_id', $userId)->distinct()->get(['product_id']);
    }

    public function getAllByUserIdAndProductId($userId, $productId)
    {
        return ProductAuction::where('user_id', $userId)->where('product_id', $productId)->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function getCurrentHighestBidByProductId($productId)
    {
        return ProductAuction::where('product_id', $productId)->max('bid_price');
    }
}
