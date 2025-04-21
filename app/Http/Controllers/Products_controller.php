<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $user=Auth::user();
        
        if (!$cart) {
            return view('cart',['cart'=>null]);
        }
    
        return view('cart',['cart'=>$cart,'user'=>$user]);
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

    //remove item from cart
    public function removeFromCart($id){
        $product = Products::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    //clear cart
    public function clearCart(){
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::all();
        $products = Products::where('name', 'LIKE', "%{$search}%")->orderBy('id','desc')->simplePaginate(10);
        return view('shop',['categories'=>$categories,'products'=>$products,'categoryname'=>"Search Results for: ".$search]);
    }

    public function storeOrder(Request $request){
        
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }
        $user = Auth::user();
        $order = new \App\Models\Orders();
        if (!$user) {
            $order->user_id = env('GUEST_USER_ID');
           }else{
            $order->user_id = $user->id;
           }
        //$order->user_id = $user->id;
        $order->total_price = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
        $order->status = 'pending';
        //fetch user phone number from form
        
        $validated=$request->validate([
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        $order->phone_number = $validated['phone'];
        $order->address = $validated['address'];
        $order->email = $validated['email'];
        //$order->phone_number = $user->phone;
        $order->save();

        $orderItems = [];
        foreach ($cart as $id => $item) {
            $orderItems[] = [
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'product_name' => $item['name'],
                
            ];
        }
        //store order items
        foreach ($cart as $id => $item) {
            \App\Models\OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'product_name' => $item['name'],
            ]);
        }

        session()->forget('cart');
        //send email to user
        if (!$user) {
            
            $user_email=$validated['email'];
        }else{
            $user_email=$user->email;
        }
        Mail::to($user_email)->send(new \App\Mail\OrderPlaced($order,$orderItems));
        //send email to admin
        Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\OrderPlaced($order,$orderItems));
        //send email to guest user
        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }

    //view order with id
    public function viewOrder($id){
        $order = \App\Models\Orders::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }
        $orderItems = \App\Models\OrderItems::where('order_id', $id)->get();
        if($order->status=='pending'){
            $tracking_percentage=25;
        }elseif($order->status=='processing'){
            $tracking_percentage=50;
        }elseif($order->status=='shipped'){
            $tracking_percentage=75;
        }elseif($order->status=='delivered'||$order->status=='completed'){
            $tracking_percentage=100;
        }else{
            $tracking_percentage=0;
        }
        
        return view('view_order',compact('order','orderItems','tracking_percentage'));
    }
 
}
