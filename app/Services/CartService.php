<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    public function addToCart($slug)
    {
        $product = Product::whereSlug($slug)->first();

        if (!$product) {
            abort(404);
        }
        
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
               $product->id => [
                  "name" => $product->name,
                  "slug" => $product->slug,
                  "quantity" => 1,
                  "price" => $product->options->price,
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
            "name" => $product->name,
            "slug" => $product->slug,
            "quantity" => 1,
            "price" => $product->options->price,
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
}
