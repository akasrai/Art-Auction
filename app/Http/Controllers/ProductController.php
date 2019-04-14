<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ProductOptionService;

class ProductController extends Controller
{
    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        ProductOptionService $productOptionService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->productOptionService = $productOptionService;
    }

    public function index()
    {
    }

    public function getBySlug($productSlug)
    {
        $user = Auth::user();
        $categories = $this->categoryService->getAllCategories();
        $productDetails = $this->productService->getBySlug($productSlug);

        return view('product.singleProduct')
                ->with('user', $user)
                ->with('categories', $categories)
                ->with('productDetails', $productDetails);
    }

    public function getByCategory($category)
    {
        $categories = $this->categoryService->getAllCategories();
        $categoryName = $this->categoryService->getNameBySlug($category);
        $products = $this->productService->getAllByCategoryName($category, 30);

        return view('product.categoryPage')
                ->with('category', $categoryName)
                ->with('products', $products)
                ->with('categories', $categories);
    }
}
