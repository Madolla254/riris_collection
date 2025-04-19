<x-layout>
<!--create category form-->
<div class="container mt-5">
    <h2 class="text-center">Edit Category</h2>
    <form action="{{ route('admin.updatecategory', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" value="{{$category->name}}" class="form-control" id="name" placeholder="Enter category name">
        </div>

    

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</x-layout>