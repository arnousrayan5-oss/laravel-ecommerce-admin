<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function order(){
        $cart = session()->get('cart', []);
        $productsIds = array_keys($cart);
        $products = Product::whereIn('id', $productsIds)->get();
        foreach($products as $product){
            $cart[$product->id]['price'] = $product->price;
        }

        Order::create(['user_id' => Auth::id(), 'order_items' => json_encode($cart)]);
        session()->forget('cart');
        return redirect()->back()->with('success', "Order submitted");
    }

    function addToCart(Product $product, Request $request){
        $fields = $request->validate([
            'quantity' => 'required|min:1|max:100|integer'
        ]);
        
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])){
            return redirect()->back()->with('error', "Item already in cart");
        }

        $cart[$product->id] = [
            'id' => $product->id,
            'quantity' => $fields['quantity'],
        ];

        session()->put('cart', $cart);
        $response = ['status' => 'success', 'message' => 'Added to Cart'];
        return response()->json($response);
    }

    function cartPage(){
        $cart = session()->get('cart', []);
        $productsIds = array_keys($cart); // [4,12,2]
        $products = Product::whereIn('id', $productsIds)->get();
        foreach($products as $product){
            $cart[$product->id]['name'] = $product->name;
            $cart[$product->id]['price'] = $product->price;
        }
        
        return view('cart', compact('cart'));
    }

    function incrementCart(Product $product){
        $cart = session()->get('cart', []);
        if(!isset($cart[$product->id])){
            return response()->json(['status' => 'error', 'message' => 'Item not in Cart']);
        }

        $cart[$product->id]['quantity'] += 1;
        if($cart[$product->id]['quantity'] > $product->quantity){
            $cart[$product->id]['quantity'] = $product->quantity;
            session()->put('cart', $cart);
            return response()->json(['status' => 'error', 'message' => 'Item out of Stock']);
        }

        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'message' => 'Quantity Added', 'action' => 'increment']);
    }

    function decrementCart(Product $product){
        $cart = session()->get('cart', []);
        if(!isset($cart[$product->id])){
            return response()->json(['status' => 'error', 'message' => 'Item not in cart']);
        }

        $cart[$product->id]['quantity'] -= 1;

        if($cart[$product->id]['quantity'] <= 0){
            $cart[$product->id]['quantity'] = 1;
            return response()->json(['status' => 'success', 'message' => 'Quantity did not change', 'action' => 'nothing']);
        }

        if($product->quantity <= 0){
            //remove from cart
            return response()->json(['status' => 'error', 'message' => 'Item out of Stock']);
        }

        if($cart[$product->id]['quantity'] > $product->quantity){
            $cart[$product->id]['quantity'] = $product->quantity;
        }
        
        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'message' => 'Quantity Deducted', 'action' => 'decrement']);
    }

    function removeCart(Product $product){
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'message' => 'Item Removed', 'action' => 'remove']);
    }
}
