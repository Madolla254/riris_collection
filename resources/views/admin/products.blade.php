<x-layout>
@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
    <div class="container mt-4">
        <h2 class="text-center mb-4">Manage Products</h2>
        
        <!-- Add Product Button -->
        <button class="btn btn-success mb-3" id="addProductBtn"><a class="text-white" href="{{route('admin.addproduct')}}">Add New Product</a></button>
        <button class="btn btn-warning mb-3" id="addProductBtn"><a class="text-white" href="{{route('admin.categories')}}">Categories</a></button>
        <!-- Product Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productTable">
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editProduct" data-id="{{ $product->id }}"><a href="{{route('admin.editproduct',['id'=>$product->id])}}">Edit</button>
                        
                        
                        <form class="d-inline-block" action="{{route('admin.deleteproduct',$product->id)}}" method="POST">
                            @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm deleteProduct" type="submit">Delete</button>
                            </form>
                        
                    </td>
                </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</x-layout>