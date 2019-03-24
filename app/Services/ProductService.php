<?php

namespace App\Services;

use App\Models\Product;
use App\Models\CategoryProduct;
use App\Services\ProductImageService;
use App\Services\ProductOptionService;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    public function __construct(ProductImageService $productImageService, ProductOptionService $productOptionService)
    {
        $this->productImageService = $productImageService;
        $this->productOptionService = $productOptionService;
    }

    
    public function isSlugUnique(String $slug)
    {
        return json_encode(!Product::where('slug', '=', $slug)->exists());
    }

    protected function productValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'images.*.image' => 'image|mimes:jpeg,bmp,png|max:2000'
        ]);
    }

    protected function auctionOptionValidator(array $data)
    {
        return Validator::make($data, [
            'product-option' => 'required',
            'estimated-price' => 'required',
            'auction-final-date' => 'required'
        ]);
    }
     
    protected function sellOptionValidator(array $data)
    {
        return Validator::make($data, [
            'product-option' => 'required',
            'price' => 'required'
        ]);
    }

    public function save(array $formData)
    {
        $this->productValidator($formData)->validate();
        if ((int)$formData['product-option'] == 0) {
            $this->sellOptionValidator($formData)->validate();
        } elseif ((int)$formData['product-option'] == 1) {
            $this->auctionOptionValidator($formData)->validate();
        }

        try {
            $product = $this->saveProduct($formData);
            if ($product->id) {
                $this->productImageService->save($formData['images'], $product->id);
                $this->saveProductCategory($formData['category'], $product->id);
                $this->productOptionService->save($formData, $product->id);
            }
        } catch (Exception $e) {
            dump($e);
        }
        return $product;
    }

    private function saveProductCategory(array $categories, $productId)
    {
        foreach ($categories as $category) {
            CategoryProduct::create([
                'product_id' => $productId,
                'category_id' => $category
            ]);
        }
    }

    private function saveProduct($productData)
    {
        $product = Product::create([
            'name' => $productData['name'],
            'slug' => $productData['slug'],
            // 'size' => $productData['size'],
            'description' => $productData['description'],
            'quality' => $productData['quality'],
            'materials_used' => $productData['materials-used'],
            'artist' => $productData['artist'],
            'painted_date' => $productData['painted-date'],
            'style'=> $productData['style'],
            'created_at' => $productData['publish-date']? $productData['publish-date'] : date("Y-m-d H:i:s"),
            'updated_at' => $productData['publish-date']? $productData['publish-date'] : date("Y-m-d H:i:s"),
        ]);
        return $product;
    }

    public function getAllByCategoryName($category, $limit)
    {
        $products = Product::with('categories', 'images', 'options')->whereHas('categories', function ($q) use ($category) {
            $q->where('slug', $category);
        })->orderBy('created_at', 'desc')->take($limit)->get();

        return $products;
    }

    public function getAllByProductOption($productOption, $limit)
    {
        $products = Product::with('categories', 'images', 'options')->whereHas('options', function ($q) use ($productOption) {
            $q->where('is_on_auction', $productOption);
        })->orderBy('created_at', 'desc')->take($limit)->get();

        return $products;
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function getBySlug($productSlug)
    {
        return Product::with(array('auctions' => function ($query) {
            $query->orderBy('created_at', 'DESC')->take(10);
        }))->where('slug', '=', $productSlug)->firstOrFail();
    }

    public function filterByParams(array $params)
    {
        $categoryId = $params['category'];
        $productName = $params['product-name'];

        if ($categoryId) {
            return Product::with('categories')->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            })->where('name', 'LIKE', '%'.$productName.'%')->orderBy('created_at', 'desc')->take(20)->get();
        } else {
            return Product::where('name', 'LIKE', '%'.$productName.'%')->orderBy('created_at', 'desc')->take(20)->get();
        }
    }
}
