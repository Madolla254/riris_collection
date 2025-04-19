<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use Illuminate\Http\Request;

class Products_controller extends Controller
{
    public function shop()

    {
        //show categories
        $categories = Category::all();
        $products=Products::orderBy('id','desc')->simplePaginate(10);
        return view('shop',['categories'=>$categories,'products'=>$products,'categoryname'=>"Featured Products"]);
    }
    public function home()
    {
        $products=Products::orderBy('id','desc')->simplePaginate(6);
        //return view('home',compact('products'));
        return view('welcome',compact('products'));
    }
    public function cart()
    {
        $cart = session()->get('cart');
    
        return view('cart',['cart'=>$cart]);
    }
    public function show($id)
    {
        $product=Products::find($id);
        return view('show',compact('product'));
    }
    public function addToCart(Request $request, $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image_url" => $product->image_url,
                
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function category($id,Request $request)
    {
        //show products with category id
        $categories = Category::all();
        $products = Products::where('category_id', $id)->orderBy('id','desc')->simplePaginate(10);
        return view('shop',['categories'=>$categories,'products'=>$products,'categoryname'=>Category::find($id)->name]);
    }
 
}
