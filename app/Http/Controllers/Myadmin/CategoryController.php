<?php

namespace App\Http\Controllers\Myadmin;

use Session;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth:admin');
        $this->middleware('superadmins' || 'editor' || 'admins' || 'moderator');

        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = Category::all();
        return view('myadmin/category/create')->with('categories', $categories);
    }

    public function create(Request $request)
    {
        $category = $this->categoryService->save($request->all());
        $categories = Category::all();
        if ($category) {
            Session::flash('success', 'Category added successfully.');
            return view('myadmin/category/create')->with('categories', $categories);
        } else {
            Session::flash('error', 'Some error occured while adding category.');
            return view('myadmin/category/create')->with('categories', $categories);
        }
    }
}
