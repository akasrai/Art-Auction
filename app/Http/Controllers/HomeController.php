<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ProductOptionService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService, ProductOptionService $productOptionService, ProductService $productService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->productOptionService = $productOptionService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        $productsOnSell = $this->productService->getAllByProductOption(0, 12);
        $productsOnAuction = $this->productService->getAllByProductOption(1, 12);
        $featuredProducts = $this->productService->getAllByCategoryName('featured', 10);
        return view('welcome')
                ->with('categories', $categories)
                ->with('productsOnSell', $productsOnSell)
                ->with('featuredProducts', $featuredProducts)
                ->with('productsOnAuction', $productsOnAuction);
    }

    public function singleArticle($productSlug)
    {
        $categories = $this->categoryService->getAllCategories();
        $productDetails = $this->productService->getBySlug($productSlug);

        // dump(sizeof($productDetails->auctions));
        return view('product.singleProduct')
                ->with('categories', $categories)
                ->with('productDetails', $productDetails);
    }
}
