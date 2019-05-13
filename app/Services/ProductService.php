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

    public function update($request)
    {
        $formData = $request->all();
        $this->productValidator($formData)->validate();
        if ((int)$formData['product-option'] == 0) {
            $this->sellOptionValidator($formData)->validate();
        } elseif ((int)$formData['product-option'] == 1) {
            $this->auctionOptionValidator($formData)->validate();
        }

        try {
            $product = $this->updateProduct($formData);
            if ($product) {
                if ($request->has('images')) {
                    $this->productImageService->save($formData['images'], $formData["product-id"]);
                }
                $this->updateProductCategory($formData['category'], $formData['product-id']);
                $this->productOptionService->update($formData);
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

    private function updateProductCategory(array $categories, $productId)
    {
        CategoryProduct::where('product_id', $productId)->forceDelete();
        $this->saveProductCategory($categories, $productId);
    }

    private function saveProduct($productData)
    {
        return Product::create([
            'name' => $productData['name'],
            'slug' => $productData['slug'],
            'size' => $productData['size'],
            'description' => $productData['description'],
            'quality' => $productData['quality'],
            'artist' => $productData['artist'],
            'painted_date' => $productData['painted-date'],
            'style'=> $productData['style'],
            'created_at' => $productData['publish-date']? $productData['publish-date'] : date("Y-m-d H:i:s"),
            'updated_at' => $productData['publish-date']? $productData['publish-date'] : date("Y-m-d H:i:s"),
        ]);
    }

    private function updateProduct($productData)
    {
        return Product::where('id', $productData['product-id'])
                ->update([
                    'name' => $productData['name'],
                    'slug' => $productData['slug'],
                    'size' => $productData['size'],
                    'description' => $productData['description'],
                    'quality' => $productData['quality'],
                    'artist' => $productData['artist'],
                    'painted_date' => $productData['painted-date'],
                    'style'=> $productData['style'],
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
    }

    public function getAllByCategoryName($category, $limit)
    {
        return Product::with('categories', 'images', 'options')->whereHas('categories', function ($q) use ($category) {
            $q->where('slug', $category);
        })->where('status', 1)->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function getAllByCategoryNameAndOption($category, $option, $limit)
    {
        return Product::with('categories', 'images', 'options')->whereHas('categories', function ($q) use ($category) {
            $q->where('slug', $category);
        })->whereHas('options', function ($q) use ($option) {
            $q->where('is_on_auction', $option)->where('auction_final_date', '>=', date("Y-m-d H:i:s"));
        })->where('status', 1)->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function getAllByProductOption($productOption, $limit)
    {
        return Product::with('categories', 'images', 'options')->whereHas('options', function ($q) use ($productOption) {
            $q->where('is_on_auction', $productOption);
        })->where('status', '!=', 0)->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function getAvailableProductsByProductOption($productOption, $limit)
    {
        return Product::with('categories', 'images', 'options')->whereHas('options', function ($q) use ($productOption) {
            $q->where('is_on_auction', $productOption)->where('auction_final_date', '>=', date("Y-m-d H:i:s"));
        })->where('status', 1)->where('created_at', '<=', date("Y-m-d H:i:s"))->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function getBySlug($productSlug)
    {
        $product = Product::where('slug', '=', $productSlug)->firstOrFail();
        return $product->setRelation('auctions', $product->auctions()->orderBy('created_at', 'DESC')->paginate(10));
    }

    public function filterByParams(array $params, $limit)
    {
        $categoryId = $params['category'];
        $productName = $params['product-name'];

        if ($categoryId) {
            return Product::with('categories', 'options')
                ->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                })
                // ->whereHas('options', function ($q) {
                //     $q->where('auction_final_date', '>=', date("Y-m-d H:i:s"));
                // })
                ->where('name', 'LIKE', '%'.$productName.'%')
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate($limit);
        } else {
            return Product::with('categories', 'options')
            // ->whereHas('options', function ($q) {
            //     $q->where('auction_final_date', '>=', date("Y-m-d H:i:s"));
            // })
            ->where('name', 'LIKE', '%'.$productName.'%')
            ->where("status", 1)->orderBy('created_at', 'desc')
            ->paginate($limit);
        }
    }

    public function endAuction($productSlug)
    {
        return Product::where('slug', $productSlug)
            ->update(['status' => 2, 'updated_at'=> date("Y-m-d H:i:s")]);
    }

    public function delete($productSlug)
    {
        return Product::where('slug', $productSlug)
            ->update(['status' => 0, 'updated_at'=> date("Y-m-d H:i:s")]);
    }

    public function getNameById($id)
    {
        return Product::find($id)->name;
    }
}
