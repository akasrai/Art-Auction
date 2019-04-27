<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CategoryProduct;
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
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'slug' => 'required|regex:/^[a-zA-Z-\s]+$/|max:255'
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

    public function delete($id)
    {
        $products = CategoryProduct::where("category_id", $id);
        if ($products) {
            CategoryProduct::where("category_id", $id)->update(['category_id'=>1]);
        }

        return Category::where('id', $id)->delete();
    }
}
