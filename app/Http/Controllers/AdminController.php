<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Users;

class AdminController extends Controller
{
    public function dashboard()
    {
        //count products
        $productsCount = Products::count();
        return view('admin.dashboard',['productsCount'=>$productsCount]);
    }
    public function products()
    {
        $products=Products::orderBy('created_at','desc')->paginate(10);
        
        return view('admin.products',['products'=>$products]);
    }
    public function orders()
    {
        return view('admin.orders');
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
        $category->name = $request->input('name');
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
}
