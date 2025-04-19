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
        <h2 class="text-center mb-4">Manage Categories</h2>
        <form id="addCategoryForm" action="{{ route('admin.addcategory') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Category</button>
        </form>
        
        <!-- Add Category Button -->
        <button class="btn btn-warning mb-3" id="addProductBtn"><a class="text-white" href="{{route('admin.products')}}">Products</a></button>
        <!-- Category Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="categoryTable">
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editCategory" ><a href="{{route('admin.editcategory',$category->id)}}">Edit</a></button>
                        <form class="d-inline-block" action="{{route('admin.deletecategory',$category->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm deleteCategory" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</x-layout>