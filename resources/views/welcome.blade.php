<x-layout>
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Welcome to Riri's Collection</h1>
            <p class="lead">Discover the best products at unbeatable prices.</p>
            <a href="{{route('shop')}}" class="btn btn-light btn-lg">Shop Now</a>
        </div>
    </header>

    <!-- Featured Products -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row mb-4">
        @foreach($products as $product)
            
            <div class="col-md-4">
                <a href="{{ route('product.show', $product->id) }}">
                <div>
                    <div class="card hover-zoom hover-shadow mb-4">
                        <img src="{{ $product->image_url }}" class="card-img-top fixed-dimension " alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title text-dark">{{ $product->name }}</h5>
                            <p class="card-text text-dark">KSH {{ number_format($product->price, 2) }}</p>
                            <a href="{{route('add_to_cart',$product->id)}}"> <button class="btn btn-primary">Add to Cart</button></a>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            
            
                
        @endforeach
        </div>
        
    </section>
    <div class="d-flex justify-content-center">
    <ul class="pagination pagination-sm">
        {{ $products->links() }}
    </ul>
</div>
        


</x-layout>