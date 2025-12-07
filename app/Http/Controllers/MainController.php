<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Carousel;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function home(){
        $carousel = Carousel::all();
        $products = Product::paginate(3);
        return view('home', compact('carousel', 'products'));
    }

    function showProduct(Product $product){
        $tagsIds = $product->tags()->pluck('tag_id');
        $similarProducts = Product::whereHas('tags', function($query) use($tagsIds){
            $query->whereIn('tag_id', $tagsIds);
        })->where('id', '!=', $product->id)->inRandomOrder()->limit(8)->get();
        return view('showProduct', compact('product', 'similarProducts'));
    }

    //SELECT * FROM products WHERE id IN (SELECT product_id FROM product_tag WHERE tag_id IN $tagsIds)

    function allProducts(){
        $products = Product::paginate(6);
        $tags = Tag::all();
        return view('productsAll', compact('products', 'tags'));
    }

    function filterByTag(Tag $tag){
        $tags = Tag::all();
        $products = $tag->products()->paginate(6);
        return view('productsAll', compact('products', 'tags'));
    }

    function searchProduct($keyword){
        $tags = Tag::all();
        $products = Product::where('name', 'LIKE', '%' .$keyword . '%')->paginate(6);
        return view('productsAll', compact('products', 'tags'));
    }
}
