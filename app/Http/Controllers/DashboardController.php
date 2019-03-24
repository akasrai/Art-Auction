<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ProductOptionService;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService, ProductService $productService, ProductOptionService $productOptionService)
    {
        $this->middleware('auth');
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
        $productsOnAuction = $this->productService->getAllByProductOption(1, 6);
        $featuredProducts = $this->productService->getAllByCategoryName('featured');

        return view('welcome')
                ->with('categories', $categories)
                ->with('featuredProducts', $featuredProducts)
                ->with('productsOnAuction', $productsOnAuction);
    }
}
