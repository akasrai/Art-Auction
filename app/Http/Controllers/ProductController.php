<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ProductOptionService;

class ProductController extends Controller
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
    }

    public function getAuctionBySlug($productSlug)
    {
        $user = Auth::user();
        $categories = $this->categoryService->getAllCategories();
        $productDetails = $this->productService->getBySlug($productSlug);

        return view('product.singleAuction')
            ->with('user', $user)
            ->with('categories', $categories)
            ->with('productDetails', $productDetails);
    }

    public function getProductBySlug($productSlug)
    {
        $categories = $this->categoryService->getAllCategories();
        $productDetails = $this->productService->getBySlug($productSlug);

        return view('product.singleProduct')
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

    public function addToCart($slug)
    {
        $cart = $this->cartService->addToCart($slug);
        if ($cart) {
            Session::flash('success', 'Product added to cart successfully!');
            return redirect()->back();
        }
    }

    public function removeFromCart($id)
    {
        $cart = $this->cartService->removeFromCart($id);
        Session::flash('success', 'Item removed!');

        return redirect()->back();
    }

    public function getCartItems()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('product.cart')->with('categories', $categories);
    }

    public function getAuction()
    {
        $categories = $this->categoryService->getAllCategories();
        $productsOnAuction = $this->productService->getAvailableProductsByProductOption(1, 30);

        return view('product.auctionPage')
            ->with('categories', $categories)
            ->with('products', $productsOnAuction);
    }

    public function getShop()
    {
        $categories = $this->categoryService->getAllCategories();
        $productsOnSell = $this->productService->getAllByProductOption(0, 12);

        return view('product.shoppingPage')
            ->with('categories', $categories)
            ->with('products', $productsOnSell);
    }
}
