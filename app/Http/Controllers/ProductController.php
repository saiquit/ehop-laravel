<?php

namespace App\Http\Controllers;

use App\Models\Attribute as ModelsAttribute;
use App\Models\Category;
use App\Models\Product;
use Attribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::query();
        $categories = Category::all();
        $sizes = ModelsAttribute::whereCode('size')->get();
        $colors = ModelsAttribute::whereCode('color')->get();

        if ($request->category) {
            foreach ($request['category'] as $category) {
                $categoryId = $category;
                $productsQuery->whereHas('category', function ($query) use ($categoryId) {
                    $query->where('category_id', $categoryId);
                });
            }
        }
        if ($request['search']) {
            $productsQuery->where('title', 'LIKE', '%' . $request['search'] . '%');
        }

        $products = $productsQuery->orderBy('created_at', 'desc')->paginate(15);
        return view('products.index', compact('products', 'categories', 'colors', 'sizes'));
    }
    public function productDetails($slug)
    {
        $featured = Product::latest()->take(8)->get();
        $product = Product::whereSlug($slug)->first();
        return view('products.product-details', compact('product', 'featured'));
    }
}
