<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        if (!$product) {
            abort(404);
        }
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $product->id => [
                    'name' => $product->title,
                    'quantity' => $request['quantity'],
                    'image' => $product->image,
                    'price' => $product->price,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request['quantity'];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => $request['quantity'],
            "price" => $product->price,
            "image" => $product->image
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}
