<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'string|required',
            'description' => 'string',
            'image' => 'required'
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $image = $request->file('image');
        $slug = Str::slug($request['title']);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/categories')) {
                Storage::disk('public')->makeDirectory('images/categories');
            }
            $categoryImage = Image::make($image)->resize(800, 800)->stream();
            Storage::disk('public')->put('images/categories/' . $imageName, $categoryImage);
        } else {
            $imageName = 'default.jpg';
        }

        $category = Category::create([
            'title' => $request['title'],
            'slug' => $slug,
            'description' => $request['description'],
            'image' => $imageName,
        ]);
        return view('admin.categories.show', compact('category'))->with('success', 'Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'string',
            'description' => 'string',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $image = $request->file('image');
        $slug = Str::slug($request['title']);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/categories')) {
                Storage::disk('public')->makeDirectory('images/categories');
            }
            if (Storage::disk('public')->exists('images/categories/' . $category['image'])) {
                Storage::disk('public')->delete('images/categories/' . $category['image']);
            }
            $categoryImage = Image::make($image)->resize(800, 800)->stream();
            Storage::disk('public')->put('images/categories/' . $imageName, $categoryImage);
        } else {
            $imageName = $category['image'];
        }

        $category->update([
            'title' => $request['title'],
            'slug' => $slug,
            'description' => $request['description'],
            'image' => $imageName,
        ]);
        return view('admin.categories.show', compact('category'))->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
