<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function products(){
        $products = Product::all();
        return view('admin.products.all', compact('products'));
    }

    
    function editPage(Request $request, Product $product){
        if($request->user->can('update', $product)){
            
        }
        // $images = ProductImage::where('product_id', $product->id)->get();
        $tags = Tag::whereNotIn('id', $product->tags()->pluck('tag_id'))->get();
        return view('admin.products.edit', compact('product', 'tags'));
    }

    function edit(Request $request, Product $product){
        $fields = $request->validate([
            'name' => ['required', 'between:1,255'],
            'description' => ['required', 'between:3,255'],
            'price' => ['required', 'integer', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'main_image' => ['image', 'mimes:jpg,png,jpeg', 'max:1024'],
            'info' => ['max:1500']
        ]);

        if(isset($fields['main_image'])){
            $image_name = time() . "." . $fields['main_image']->extension();
            $fields['main_image']->move(public_path('/assets/uploads'),$image_name);
            $fields['main_image'] = $image_name;
        }
        $product->update($fields);
        return redirect()->back();
    }
    
    function create(Request $request){
        $fields = $request->validate([
            'name' => ['required', 'between:1,255'],
            'description' => ['required', 'between:3,255'],
            'price' => ['required', 'integer', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'main_image' => ['image', 'mimes:jpg,png,jpeg', 'max:1024'],
            'info' => ['max:1500']
        ]);

        if(isset($fields['main_image'])){
            $image_name = time() . "." . $fields['main_image']->extension();
            $fields['main_image']->move(public_path('/assets/uploads'),$image_name);
            $fields['main_image'] = $image_name;
        }

        Product::create($fields);
        return redirect()->back();
    }

    function addProductTag(Product $product, Request $request){
        $fields = $request->validate([
            'tag' => ['required', 'integer', 'exists:tags,id']
        ]);
        $product->tags()->attach([$fields['tag']]);
        return redirect()->back();
    }

    function removeProductTag(Product $product, Tag $tag){
        $product->tags()->detach([$tag->id]);
        return redirect()->back();
    }

    function uploadProductImage(Product $product, Request $request){
        $fields = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:1024']
        ]);

        $image_name = time() . "." . $fields['image']->extension();
        $fields['image']->move(public_path('/assets/uploads'),$image_name);
       
        ProductImage::create(['product_id' => $product->id, 'image' => $image_name]);
        return redirect()->back();
    }
}
