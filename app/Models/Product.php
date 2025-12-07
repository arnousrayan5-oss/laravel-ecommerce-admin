<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'info',
        'main_image',
        'price',
        'quantity'
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
