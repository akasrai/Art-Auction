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
        if ($request->input('category')=='') {
            $request->merge(['category'=>'']);
        }
        if ($request->input('product-name')=='') {
            $request->merge(['product-name'=>'']);
        }
        
        $categories = $this->categoryService->getAllCategories();
        $searchResults = $this->productService->filterByParams($request->all(), 30);

        return view('product.searchResult')
                ->with('categories', $categories)
                ->with('searchKeyWord', $request->input('product-name'))
                ->with('searchResults', $searchResults->appends(request()->query()));
    }
}
