<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
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
}
