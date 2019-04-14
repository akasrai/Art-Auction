<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);
    }

    public function save(array $data)
    {
        $this->validator($data)->validate();
        $category = Category::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'parent_id' => $data['parent'],
            'description' => $data['description']
        ]);

        return $category;
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getNameBySlug($slug)
    {
        return Category::where('slug', $slug)->get(['name']);
    }
}
