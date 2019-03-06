<?php

namespace App\Http\Controllers\Myadmin;

use Session;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:admin', ['except' => ['checkUniqueSlug']]);
        $this->middleware('superadmins' || 'editor' || 'admins' || 'moderator');
        $this->productService = $productService;
    }


    public function index()
    {
        $categories = Category::all();
        return view('myadmin/product/create')->with('categories', $categories);
    }

    public function checkUniqueSlug(Request $request)
    {
        return $this->productService->isSlugUnique($request->slug);
    }
}
