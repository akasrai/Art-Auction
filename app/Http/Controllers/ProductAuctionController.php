<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductAuctionService;

class ProductAuctionController extends Controller
{
    public function __construct(ProductAuctionService $productAuctionService)
    {
        $this->middleware('auth');
        $this->productAuctionService = $productAuctionService;
    }
    
    public function bidProduct(Request $request)
    {
        $productAuction = $this->productAuctionService->save($request->all());
        if ($productAuction) {
            return response()->json([
                'id' => $productAuction->id,
                'status' => 200,
                'biddingAmount'=> $productAuction->bid_price,
                'createdAt' =>$productAuction->created_at,
                'comment' => $productAuction->comment
                ]);
        } else {
            return response()->json(['status' => 500, 'message' => 'Something went wrong.']);
        }
    }
}
