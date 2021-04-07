<?php

namespace App\Http\Controllers;

use App\Models\Attribute as ModelsAttribute;
use App\Models\Category;
use App\Models\Product;
use Attribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $sizes = ModelsAttribute::whereCode('size')->get();
        $colors = ModelsAttribute::whereCode('color')->get();
        $products = Product::paginate(20);
        return view('products.index', compact('products', 'categories', 'colors', 'sizes'));
    }
    public function productDetails($slug)
    {
        $product = Product::whereSlug($slug)->first();
        return view('products.product-details', compact('product'));
    }
}
