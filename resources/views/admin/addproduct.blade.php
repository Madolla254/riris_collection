<x-layout>
<form action="{{ route('admin.addproduct') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container mt-4">
        <h2 class="text-center mb-4">Add New Product</h2>
        
        <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text"value="{{old('name')}}" class="form-control" id="productName" name="name" required>
        </div>
        
        <div class="mb-3">
            <label for="productPrice" class="form-label">Product Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        
        <div class="mb-3">
            <label for="productImage" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="productImage" name="image_url" accept=".jpg, .jpeg, .png, .gif" required>
        </div>
        
    
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter product description" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category" required>
                <option value="" disabled selected>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" id="stock" placeholder="Enter stock quantity" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox"name="is_featured" class="form-check-input" id="isFeatured">
            <label class="form-check-label" for="isFeatured">Featured Product</label>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_new" class="form-check-input" id="isNew">
            <label class="form-check-label" for="isNew">New Arrival</label>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_on_sale" class="form-check-input" id="isOnSale">
            <label class="form-check-label" for="isOnSale">On Sale</label>
        </div>

        <div class="mb-3">
            <label for="salePrice" class="form-label">Sale Price</label>
            <input type="number" name="sale_price" class="form-control" id="salePrice" placeholder="Enter sale price">
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" name="brand" id="brand" placeholder="Enter brand name">
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" name="color" class="form-control" id="color" placeholder="Enter color">
        </div>

        <div class="mb-3">
            <label for="size" class="form-label">Size</label>
            <input type="text" class="form-control" name="size" placeholder="Enter size">
        </div>

        <div class="mb-3">
            <label for="material" class="form-label">Material</label>
            <input type="text" class="form-control" name="material" placeholder="Enter material">
        </div>

        <div class="mb-3">
            <label for="warranty" class="form-label">Warranty</label>
            <input type="text" class="form-control" name="warranty" placeholder="Enter warranty details">
        </div>

        <div class="mb-3">
            <label for="returnPolicy" class="form-label">Return Policy</label>
            <textarea class="form-control" name="returnPolicy" rows="2" placeholder="Enter return policy"></textarea>
        </div>

        <div class="mb-3">
            <label for="shippingInfo" class="form-label">Shipping Info</label>
            <textarea class="form-control" name="shippingInfo" rows="2" placeholder="Enter shipping details"></textarea>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" name="tags" placeholder="Enter relevant tags (comma-separated)">
        </div>

        <button type="submit" class="btn btn-primary">Save Product</button>
    </form>
</div>
        
    </div>
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif  
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layout>