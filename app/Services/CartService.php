<?php

namespace App\Services;

use App\Models\Product;
use App\Services\ProductAuctionService;

class CartService
{
    public function __construct(ProductAuctionService $productAuctionService)
    {
        $this->productAuctionService = $productAuctionService;
    }

    public function addToCart($slug)
    {
        $product = Product::whereSlug($slug)->first();

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');
        $price = 0;

        if ($product->options->is_on_auction == 1) {
            $price = $this->productAuctionService->getCurrentHighestBidByProductId($product->id);
        } else {
            $price = $product->options->price;
        }

        if (!$cart) {
            $cart = [
                $product->id => [
                    "quantity" => 1,
                    "price" => $price,
                    "name" => $product->name,
                    "slug" => $product->slug,
                    "image" => $product->images[0]->image_url,
                    "discount" => $product->options->discount,
                ]
            ];
            session()->put('cart', $cart);

            return $cart;
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
            session()->put('cart', $cart);

            return $cart;
        }

        $cart[$product->id] = [
            "quantity" => 1,
            "price" => $price,
            "name" => $product->name,
            "slug" => $product->slug,
            "image" => $product->images[0]->image_url,
            "discount" => $product->options->discount,
        ];

        session()->put('cart', $cart);

        return $cart;
    }

    public function getCartProduct()
    {
        $cart = session()->get('cart');
        if ($cart) {
            // unset($cart[7]);
            // session()->put('cart', $cart);
            // dump($cart);
        }
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if ($cart) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return $cart;
    }

    public function emptyCart()
    {
        $cart = session()->get('cart');
        if ($cart) {
            session()->forget('cart');
        }

        return $cart;
    }
}