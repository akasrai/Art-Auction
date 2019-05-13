<?php

namespace App\Http\Controllers\Myadmin;

use Session;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Services\ProductAuctionService;

class ProductAuctionController extends Controller
{
    public function __construct(ProductAuctionService $productAuctionService, ProductService $productService)
    {
        $this->middleware('auth:admin', ['except' => ['checkUniqueSlug']]);
        $this->middleware('superadmins' || 'editor' || 'admins' || 'moderator');
        $this->productService = $productService;
        $this->productAuctionService = $productAuctionService;
    }

    public function auctionList()
    {
        $auctionProductList = $this->productService->getAllByProductOption(1, 10);
        return view('myadmin/auction/auctionList')
                ->with('auctionProductList', $auctionProductList);
    }

    public function getProductBySlug($productSlug)
    {
        $auctionDetails = $this->productService->getBySlug($productSlug);
        $totalAuctionBids = $this->productAuctionService->countBidsByProductId($auctionDetails->id);
        
        return view('myadmin/auction/singleAuction')
                ->with('auctionDetails', $auctionDetails)
                ->with('totalAuctionBids', $totalAuctionBids);
    }

    public function endAuction($productSlug)
    {
        $updateProduct = $this->productService->endAuction($productSlug);
        return redirect('/admin/auctions/'.$productSlug);
    }

    public function emailWinner($productId)
    {
        $productSlug = $this->productAuctionService->emailWinner($productId);
        Session::flash('success', 'Email sent to winner.');
        return redirect('/admin/auctions/'.$productSlug);
    }
}
