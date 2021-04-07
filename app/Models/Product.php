<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
