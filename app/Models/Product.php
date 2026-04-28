<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'brand',
        'ram',
        'storage',
        'operating_system',
        'image',
        'category_id'
    ];
}
