<?php

namespace App\Http\Controllers\Myadmin;

use Session;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->middleware('auth:admin', ['except' => ['checkUniqueSlug']]);
        $this->middleware('superadmins' || 'editor' || 'admins' || 'moderator');
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }


    public function index()
    {
        $product = new Product;
        $categories = $this->categoryService->getAllCategories();
        return view('myadmin/product/create')
                ->with('categories', $categories)
                ->with('product', $product);
    }

    public function create(Request $request)
    {
        $product = $this->productService->save($request->all());
        $categories =$this->categoryService->getAllCategories();
        if ($product) {
            Session::flash('success', 'New product added successfully.');
            return view('myadmin/product/create')
                ->with('product', $product)
                ->with('categories', $categories);
        } else {
            Session::flash('error', 'Some error occured while adding new product.');
            return view('myadmin/product/create')->with('categories', $categories);
        }
    }


    public function edit($productSlug)
    {
        $categories = $this->categoryService->getAllCategories();
        $product = $this->productService->getBySlug($productSlug);
       
        return view('myadmin/product/create')
                ->with('product', $product)
                ->with('categories', $categories);
    }

    public function update(Request $request)
    {
        $product = $this->productService->update($request);

        if ($request->all()['product-option']==1) {
            return redirect('/admin/auctions/'.$request->all()['slug']);
        } else {
            return redirect('/admin/auctions');
        }
    }

    public function delete($productSlug)
    {
        $deleteProduct = $this->productService->delete($productSlug);
        if ($deleteProduct) {
            return redirect("/admin/auctions");
        }
    }

    public function checkUniqueSlug(Request $request)
    {
        return $this->productService->isSlugUnique($request->slug);
    }
}
