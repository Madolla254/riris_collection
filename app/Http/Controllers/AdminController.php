<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        //count products
        $productsCount = Products::count();
        //count users
        $totalCustomers=User::count();
        //count orders with status pending
        $pendingOrders=Orders::where('status','pending')->count();
        //$pendingOrders=Orders::count();
        return view('admin.dashboard',['productsCount'=>$productsCount,'totalCustomers'=>$totalCustomers,'pendingOrders'=>$pendingOrders]);
    }
    public function products()
    {
        $products=Products::orderBy('created_at','desc')->paginate(10);
        
        return view('admin.products',['products'=>$products]);
    }
    public function orders()
    {
        $orders = Orders::with('User')->orderBy('created_at', 'desc')->simplePaginate();

        // Return view with orders data
        return view('admin.orders', ['orders' => $orders,'title'=>'All Orders']);
        
    }
    //pending orders
    public function pendingOrders()
    {
        $orders = Orders::where('status', 'pending')->with('User')->orderBy('created_at', 'desc')->simplePaginate();
        // Return view with orders data
        return view('admin.orders', ['orders'=>$orders,'title'=>'Pending Orders']);
        
    }
    //completed orders
    public function completedOrders()
    {
        $orders = Orders::where('status', 'completed')->with('User')->orderBy('created_at', 'desc')->simplePaginate();
        // Return view with orders data
        return view('admin.orders', ['orders'=>$orders,'title'=>'Completed Orders']);
        
    }
    //cancelled orders
    public function cancelledOrders()
    {
        $orders = Orders::where('status', 'cancelled')->with('User')->orderBy('created_at', 'desc')->simplePaginate();
        // Return view with orders data
        return view('admin.orders', ['orders'=>$orders,'title'=>'Cancelled Orders']);
        
    }
    //shipped orders
    public function shippedOrders()
    {
        $orders = Orders::where('status', 'shipped')->with('User')->orderBy('created_at', 'desc')->simplePaginate();
        // Return view with orders data
        return view('admin.orders', ['orders'=>$orders,'title'=>'Shipped Orders']);
        
    }
    
    //view order
    public function viewOrder($id)
    {
        $order = Orders::find($id);
        
        if($order->user_id){
            $user = User::find($order->user_id);
        }else{
            $user = null;
        }

        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Order not found');
        }
        $orderItems = OrderItems::where('order_id', $id)->get();
        //$productItem=Products::find($orderItems->product_id);
        return view('admin.vieworder', ['order' => $order, 'orderItems' => $orderItems, 'user' => $user]);
    }

    public function deleteOrder($id)
    {
        $order = Orders::findOrFail($id);
        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Order not found');
        }
        $order->delete();
        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully');
    }
    public function updateOrderStatus(Request $request)
{
    $order = Orders::find($request->id);
    if ($order) {
        $order->status = $request->status;
        $order->save();
        return response()->json(['success' => true, 'message' => 'Order status updated!']);
    }
    return response()->json(['success' => false, 'message' => 'Order not found!'], 404);
}
public function updateOrderStatus_return(Request $request){
    $order = Orders::find($request->id);
    if ($order) {
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Order status updated!');
    }
    return redirect()->back()->with('error', 'Could not update status !');
}
    public function addProduct(Request $request)
    {
        //validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'warranty' => 'nullable|string|max:255',
            'return_policy' => 'nullable|string|max:255',
            'shipping_info' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'is_featured' => 'nullable|string|max:255',
            'is_new' => 'nullable|string|max:255',
            'is_on_sale' => 'nullable|string|max:255',
            'sale_price' => 'nullable|numeric'
            
            // Add other fields as necessary
        ]);

        //create a new product
        $product = new Products();
        $product->name = ucwords($request->input('name'));
        $product->description = ucfirst($request->input('description'));
        $product->price = $request->input('price');
        // handle image upload
        // $product->image_url = $request->input('image_url');
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image_url = 'images/' . $imageName;
        } else {
            $product->image_url = null; // or set a default image
        }
        //$product->image_url = $request->input('image_url');
        $product->category_id = $request->input('category_id');
        $product->stock = $request->input('stock');
        $product->brand = $request->input('brand');
        $product->color = $request->input('color');
        $product->size = $request->input('size');
        $product->description= $request->input('description');
        $product->material = $request->input('material');
        $product->warranty = $request->input('warranty');
        $product->return_policy = $request->input('return_policy');
        $product->shipping_info = $request->input('shipping_info');
        $product->tags = $request->input('tags');

        $product->is_featured = $request->input('is_featured', false);
        $product->is_new = $request->input('is_new', false);
        $product->is_on_sale = $request->input('is_on_sale', false);
        $product->sale_price = $request->input('sale_price');
        $product->sku = Products::generateSKU($request->input('name'), $request->input('category'));
        $product->barcode= Products::generateBarcode();

        $product->save();

        //handle form  submission
        //redirect
        $allproducts=Products::orderBy('created_at','desc')->paginate(10);
        return view('admin.products',['products'=>$allproducts])->with('success', 'Product added successfully');
    }
    public function addProductshow()
    {
        $categories=Category::all();
        if (!$categories) {
            return redirect()->route('admin.products')->with('error', 'Categories not found');
        }
        return view('admin.addproduct', ['categories' => $categories]);
        //return view('admin.addproduct');
    }

    public function editProduct($id)
    {
        $product = Products::find($id);
        $categories=Category::all();
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Product not found');
        }
        return view('admin.editproduct', ['product' => $product,'categories' => $categories]);
    }
    public function updateProduct(Request $request, $id){
        //validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'warranty' => 'nullable|string|max:255',
            'return_policy' => 'nullable|string|max:255',
            'shipping_info' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'is_featured' => 'nullable|string|max:255',
            'is_new' => 'nullable|string|max:255',
            'is_on_sale' => 'nullable|string|max:255',
            'sale_price' => 'nullable|numeric'
            
            // Add other fields as necessary
        ]);

        //create a new product
        $product = Products::find($id);
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Product not found');
        }
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        // handle image upload
        // $product->image_url = $request->input('image_url');
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image_url = 'images/' . $imageName;
        } else {
            $product->image_url = null; // or set a default image
        }
        //$product->image_url = $request->input('image_url');
        $product->category_id = $request->input('category_id');
        $product->stock = $request->input('stock');
        $product->brand = $request->input('brand');
        $product->color = $request->input('color');
        $product->size = $request->input('size');
        $product->description= $request->input('description');
        $product->material = $request->input('material');
        $product->warranty = $request->input('warranty');
        $product->return_policy = $request->input('return_policy');
        $product->shipping_info = $request->input('shipping_info');
        $product->tags = $request->input('tags');
        
        $product->is_featured = $request->input('is_featured',false);

        $product->is_new = $request->input('is_new', false);
        $product->is_on_sale = $request->input('is_on_sale', false);
        $product->sale_price = $request->input('sale_price');
        $product->sku = Products::generateSKU($request->input('name'), $request->input('category'));
        $product->barcode= Products::generateBarcode();
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }
    public function deleteProduct($id)
    {
        $product = Products::findOrFail($id);
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Product not found');
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }
    public function showCategories()
    {
        $categories = Category::all();
        if (!$categories) {
            return redirect()->route('admin.products')->with('error', 'Categories not found');
        }
        return view('admin.categories', ['categories' => $categories]);
    }
    public function addCategory(Request $request)
    {
        //validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            
        ]);

        //create a new category
        $category = new Category();
        $category->name = ucfirst($request->input('name'));
        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category added successfully');
    }
    public function editCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Category not found');
        }
    
        return view('admin.editcategory', ['category' => $category]);
    }

    
    public function updateCategory($id, Request $request)
    {
        //validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            
        ]);

        //update the category
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Category not found');
        }
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }
    //delete category
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Category not found');
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }

    public function users()
    {
        $users = User::orderBy('is_admin','desc')->orderBy('created_at','desc')->paginate(100);
        if (!$users) {
            return redirect()->route('admin.products')->with('error', 'Users not found');
        }
        return view('admin.users', ['users' => $users]);
    }
    public function show_adduser()
    {
        return view('admin.adduser');
    }
    public function addUser(Request $request)
    {
        //validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            
        ]);

        //create a new user
        $user = new User();
        $user->name = ucwords($request->input('name'));
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
         if($request->input('is_admin') == 'Admin') {
            $user->is_admin=1;
        } else {
            false;
        }
        Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));
        $user->save();
        

        return redirect()->route('admin.users')->with('success', 'User added successfully');
    }
    //delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'User not found');
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
    //view contact messages
    public function contact()
    {
        $contacts = Contact::orderBy('created_at','desc')->paginate(50);
        if (!$contacts) {
            return redirect()->route('admin.products')->with('error', 'Contacts not found');
        }
        return view('admin.contact', ['contacts' => $contacts]);
    }
}
