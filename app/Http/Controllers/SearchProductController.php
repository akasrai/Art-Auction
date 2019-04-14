<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;

class SearchProductController extends Controller
{
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function search(Request $request)
    {
        $categories = $this->categoryService->getAllCategories();
        $searchResults = $this->productService->filterByParams($request->all(), 30);
        
        if ($request->input('category')==null) {
            $request->merge(['category'=>'']);
        }

        if ($request->input('product-name')==null) {
            $request->merge(['product-name'=>'']);
        }

        return view('product.searchResult')
                ->with('categories', $categories)
                ->with('searchResults', $searchResults->appends(request()->query()));
    }
}
