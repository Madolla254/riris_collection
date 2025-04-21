<x-layout>
     <!-- Navigation Bar with Search -->
    <nav class="navbar navbar-light bg-white p-3 shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{route('shop')}}">Shop</a>
            <form class="d-flex" method="POST" action="{{ route('search') }}">
            @csrf

                <input name="search" class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" >
                <button class="btn btn-outline-success" type="submit"><i class="fa fa-search"></i>Search</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar - Categories -->
            <aside class="col-md-3">
                <div class="list-group shadow">
                    <h5 class="list-group-item fw-bold">Categories</h5>
                    @foreach($categories as $category)
                        <a href="{{route('shop.category',$category->id)}}" class="list-group-item list-group-item-action">{{ $category->name }}</a>
                        
                    @endforeach
                </div>
            </aside>

            <!-- Main Content - Products -->
            <main class="col-md-9">
                <h2 class="fw-bold">{{ $categoryname}}</h2>
               <section class="container my-5">
        <div class="row mb-3">
        @foreach($products as $product)
            
            <div class="col-md-4">
                <a href="{{ route('product.show', $product->id) }}">
                <div>
                    <div class="card hover-zoom hover-shadow mb-4">
                        @if($product->is_new)
                            <span class="badge bg-warning position-absolute top-0 start-0">New Arrival!</span>
                        @endif
                        @if($product->is_on_sale)
                           <span class="sale-ribbon bg-danger badge">Sale!</span>
                        @endif
                        <img src="{{ asset($product->image_url) }}" class="card-img-top fixed-dimension " alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title text-dark">{{ $product->name }}</h5>
                            <p class="card-text text-dark">@if($product->sale_price) <small class="text-decoration-line-through text-muted fst-italic">KSH {{ number_format($product->price) }}</small><br/>KSH {{$product->sale_price}}<span class="text-success badge">({{round($product->price/$product->sale_price,2)}}% Off)</span> @else KSH {{$product->price}}@endif</p>
                            <a href="{{route('add_to_cart',$product->id)}}"> <button class="btn btn-primary">Add to Cart</button></a>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            
            
                
        @endforeach
        </div>
        
    </section>
            </main>
        </div>
    </div>
    {{$products->links()}}
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>