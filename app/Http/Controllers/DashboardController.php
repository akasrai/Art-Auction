<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ProductOptionService;
use App\Services\ProductAuctionService;

class DashboardController extends Controller
{
    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        ProductOptionService $productOptionService,
        ProductAuctionService $productAuctionService
    ) {
        $this->middleware('auth');
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->productOptionService = $productOptionService;
        $this->productAuctionService = $productAuctionService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('dashboard.dashboard')
                ->with('categories', $categories);
    }

    public function getMyBiddings()
    {
        $userId = Auth::user()->id;
        $categories = $this->categoryService->getAllCategories();
        $myBiddingProducts = $this->productAuctionService->getAllByUserId($userId);
        foreach ($myBiddingProducts as $myBiddingProduct) {
            $myBiddingProduct->biddings = $this->productAuctionService->getAllByUserIdAndProductId($userId, $myBiddingProduct->product_id);
            $myBiddingProduct->highestBid = $this->productAuctionService->getCurrentHighestBidByProductId($myBiddingProduct->product_id);
        }

        return view('dashboard.myBiddings')
                ->with('myBiddingProducts', $myBiddingProducts)
                ->with('categories', $categories);
    }
}
