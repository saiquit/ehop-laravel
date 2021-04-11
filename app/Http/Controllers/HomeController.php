<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $featured = Product::latest()->take(8)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(4)->with(['products' => function ($query) {
            $query->inRandomOrder()->take(12);
        }])->get();
        return view('welcome', compact('categories', 'featured'));
    }
    public function checkout()
    {
        return view('checkout');
    }
    public function cart()
    {
        return view('cart');
    }
    public function thankYou()
    {
        return view('thankyou');
    }
}
