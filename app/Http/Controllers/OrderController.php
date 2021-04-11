<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                    'title' => $product->title,
                    'quantity' => $request['quantity'],
                    'image' => $product->image,
                    'price' => $product->price,
                    'slug' => $product->slug
                ]
            ];
            $this->addTotalToSession($cart);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $cart[$product->id]['quantity'] + $request['quantity'];
            $this->addTotalToSession($cart);

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        } else {
            // if item not exist in cart then add to cart with quantity = 1
            $cart[$product->id] = [
                "title" => $product->title,
                "quantity" => $request['quantity'],
                "price" => $product->price,
                "image" => $product->image,
                'slug' => $product->slug
            ];

            $this->addTotalToSession($cart);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    function removeItemFromCart($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        $this->addTotalToSession($cart);
        return back()->with('success', 'Product in cart successfully Deleted!');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session('cart');
        if (isset($cart[$id])) {
            if (intval($request['quantity']) <= 0) {
                return $this->removeItemFromCart($id);
            }
            $cart[$id]['quantity'] = $request['quantity'];
            session()->put('cart', $cart);
            $this->addTotalToSession($cart);
            return back()->with('success', 'Cart successfully updated');
        } else {
            return back()->with('error', 'Not Updated');
        }
    }

    public function addTotalToSession($cart)
    {
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach ($cart as $id => $cartItem) {
            $totalPrice += $cartItem['quantity'] * $cartItem['price'];
            $totalQuantity += $cartItem['quantity'];
        }
        session()->put('total', [
            'price' => $totalPrice,
            'quantity' => $totalQuantity,
        ]);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'company_name' => 'string|required',
            'phone_number' => 'numeric|required',
            'email' => 'email|string|required',
            'address' => 'string|required',
            'order_note' => 'string',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $order = auth()->user()->orders()->create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'company_name' => $request['company_name'],
            'phone_number' => $request['phone_number'],
            'address' => $request['address'],
            'order_note' => $request['order_note'],
            'email' => $request['email'],
        ]);
        if (session('cart')) {
            foreach (session('cart') as $key => $item) {
                $order->products()->attach($key, [
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
            session()->forget('cart');
            session()->forget('total');
        } else {
            return redirect()->back()->with('error', 'Noting in Cart');
        }
        return redirect()->route('thankYou')->with('success', 'Successfully Created');
    }
}
