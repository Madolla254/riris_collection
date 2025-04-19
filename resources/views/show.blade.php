<x-layout>
   <div class="container mt-5">
        <div class="row">
            <!-- Product Image & Thumbnails -->
            <div class="col-md-6 text-center">
                <img src="{{asset($product->image_url)}}" class="img-fluid rounded mb-3" id="mainImage" alt="{{$product->name}}">
               
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="fw-bold">{{$product->name}}</h2>
                    <p class="text-muted">{{$product->category}}</p>
                    <h4 class="text-danger">KSH @if($product->sale_price) {{$product->sale_price}}<span class="text-success">(20% Off)</span> @else {{$product->price}}@endif</h4>
                    <p><strong>Stock:</strong> {{$product->stock}}</p>
                    <p><strong>Brand:</strong> {{$product->brand}}</p>
                    @if($product->color)
                    <p><strong>Color:</strong> {{$product->color}}</p>
                    @endif
                    @if($product->size)
                    <p><strong>Color:</strong> {{$product->size}}</p>
                    @endif
                    @if($product->material)
                    <p><strong>Color:</strong> {{$product->material}}</p>
                    @endif
                    @if($product->waranty)
                    <p><strong>Color:</strong> {{$product->waranty}}</p>
                    @endif
                    @if($product->return_policy)
                    <p><strong>Color:</strong> {{$product->return_policy}}</p>
                    @endif
                    @if($product->shipping_info)
                    <p><strong>Color:</strong> {{$product->shipping_info}}</p>
                    @endif
                    <p class="mt-3"><strong>Description:</strong></p>
                    <p>{{$product->description}}</p>
                    
                    <div class="mt-3">

                        <a href="{{route('add_to_cart',$product->id)}}"> <button class="btn btn-primary">Add to Cart</button></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Reviews -->
        
    </div>
</x-layout>