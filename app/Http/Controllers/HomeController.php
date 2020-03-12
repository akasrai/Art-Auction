<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ProductOptionService;

class HomeController extends Controller
{
    public function __construct(
        CartService $cartService,
        ProductService $productService,
        CategoryService $categoryService,
        ProductOptionService $productOptionService
          ) {
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->productOptionService = $productOptionService;

    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        $productsOnSell = $this->productService->getAllByProductOption(0, 12);
        $productsOnAuction = $this->productService->getAvailableProductsByProductOption(1, 12);
        $featuredProducts = $this->productService->getAllByCategoryNameAndOption('featured', 1, 10);
        return view('welcome')
                ->with('categories', $categories)
                ->with('productsOnSell', $productsOnSell)
                ->with('featuredProducts', $featuredProducts)
                ->with('productsOnAuction', $productsOnAuction);
    }

    public function getFAQ()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('info-pages/faq')->with('categories', $categories);
    }

    public function getContactInfo()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('info-pages/contact')->with('categories', $categories);
    }
}
