<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $colors = explode(',', $request['colors']);
        $sizes = explode(',', $request['sizes']);


        $validate = Validator::make($request->all(), [
            'title' => 'string|required',
            'price' => 'required|string',
            'description' => 'string',
            'stock' => 'required',
            'image' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $image = $request->file('image');
        $slug = Str::slug($request['title']);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/products')) {
                Storage::disk('public')->makeDirectory('images/products');
            }
            $postImage = Image::make($image)->resize(800, 800)->stream();
            Storage::disk('public')->put('images/products/' . $imageName, $postImage);
        } else {
            $imageName = 'default.jpg';
        }

        $product = Product::create([
            'title' => $request['title'],
            'slug' => $slug,
            'price' => floatval($request['price']),
            'stock' => $request['stock'],
            'description' => $request['description'],
            'image' => $imageName,
            'rating' => '2.0'
        ]);

        foreach ($request->images as $gImage) {
            $currentDate = Carbon::now()->toDateString();
            $gImageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $galleryImage = Image::make($gImage)->resize(800, 800)->stream();
            Storage::disk('public')->put('images/products/' . $gImageName, $galleryImage);
            $product->images()->create([
                'product_image' => $gImageName
            ]);
        }

        $product->category()->attach($request->categories);
        foreach ($colors as  $color) {
            $product->attributes()->create([
                'code' => 'color',
                'value' => strtolower($color),
            ]);
        }
        foreach ($sizes as  $size) {
            $product->attributes()->create([
                'code' => 'size',
                'value' => strtolower($size),
            ]);
        }
        return view('admin.products.show', compact('product'))->with('success', 'Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $validate = Validator::make($request->all(), [
            'title' => 'string',
            'price' => 'string',
            'description' => 'string',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $image = $request->file('image');
        $slug = Str::slug($request['title']);
        $colors = explode(',', $request['colors']);
        $sizes = explode(',', $request['sizes']);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/products')) {
                Storage::disk('public')->makeDirectory('images/products');
            }
            if (Storage::disk('public')->exists('images/products/' . $product['image'])) {
                Storage::disk('public')->delete('images/products/' . $product['image']);
            }
            $postImage = Image::make($image)->resize(800, 800)->stream();
            Storage::disk('public')->put('images/products/' . $imageName, $postImage);
        } else {
            $imageName = $product['image'];
        }

        $product->update([
            'title' => $request['title'],
            'slug' => $slug,
            'price' => floatval($request['price']),
            'stock' => $request['stock'],
            'description' => $request['description'],
            'image' => $imageName,
        ]);
        $product->category()->sync($request->categories);
        $product->attributes()->delete();
        foreach ($colors as  $color) {
            $product->attributes()->create([
                'code' => 'color',
                'value' => strtolower($color),
            ]);
        }
        foreach ($sizes as  $size) {
            $product->attributes()->create([
                'code' => 'size',
                'value' => strtolower($size),
            ]);
        }
        return back()->with('success', 'Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Storage::disk('public')->exists('images/products/' . $product['image'])) {
            Storage::disk('public')->delete('images/products/' . $product['image']);
        }
        $product->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
