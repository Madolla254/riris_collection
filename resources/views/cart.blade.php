<x-layout>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>  
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="text-center mb-4">Shopping Cart</h2>

        <!-- Shopping Cart Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody id="cartItems">
            @if(empty($cart) || count($cart) == 0)
                <tr>
                    <td colspan="6" class="text-center">Your cart is empty.</td>
                    <td><a href="{{route('shop')}}"><button class="btn btn-success">Continue Shopping</button></a></td>
                </tr>
            @else
            @foreach($cart as $id => $product)
                <tr>
                    <td><img src="{{asset($product['image_url'])}}" class="img-fluid" style="width: 60px; height:60px;"></td>
                    <td>{{$product['name']}}</td>
                    <td>{{$product['price']}}</td>
                    <td><input type="number" class="form-control w-50 text-center quantity" value="{{$product['quantity']}}"></td>
                    <td class="item-total">KSH</td>
                    <td><a href="{{route('remove_from_cart',$id)}}"><button class="btn btn-danger btn-sm remove-item">Remove</button></a></td>
                </tr>
            @endforeach
            @endif
            
               
            
            </tbody>
        </table>
        @if(!empty($cart))

        <!-- Cart Summary -->
        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: <span id="cartTotal">KSH0</span></h4>
            <hr />
            <div>
                
                <a href="{{route('shop')}}"><button class="btn btn-success">Continue Shopping</button></a>
                <a href="{{route('clear_cart')}}"><button class="btn btn-danger">Clear Cart</button></a>


            </div>
        </div>
        <div class="container mt-5 p-4 bg-white shadow-lg rounded">
        <h1 class="text-center fw-bold mb-4">Checkout</h1>
        <p class="text-muted text-center">Complete your purchase by providing your details.</p>

        <!-- Checkout Form -->
        <div class="border p-4 bg-light rounded">
            <h3 class="fw-bold">Billing Details</h3>
            <form method="POST" action="{{route('orders.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" @if(auth()->check()) value={{auth()->user()->phone}} @endif name="phone" required placeholder="+254 712 345 678">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" id="email" @if(auth()->check()) value={{auth()->user()->email}} @endif name="email" required placeholder="Enter your email address">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Address</label>
                    <input type="text" class="form-control" id="addres"   name="address" required placeholder="Where should we deliver? e.g limuru town, near the church">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4 py-2">Proceed to Checkout</button>
                </div>
            </form>
        </div>
        @endif
        <div class="text-center mt-5">
            <p class="fw-bold">Need assistance?</p>
            <a href="https://wa.me/{{env('ADMIN_PHONE_NUMBER')}}" class="btn btn-secondary px-4 py-2">Chat on WhatsApp</a>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Cart Script -->
    <script>
        $(document).ready(function(){
            //create a function to calculate the total price of the cart
            function calculateTotal() {
                let total = 0;
                $('#cartItems tr').each(function() {
                    var price = parseFloat($(this).find('td:nth-child(3)').text().replace('KSH', '').trim());
                    var quantity = parseInt($(this).find('.quantity').val());
                    var itemTotal = price * quantity;

                    $(this).find('.item-total').text('KSH' + itemTotal.toFixed(2));
                    total += itemTotal;
                });
                $('#cartTotal').text('KSH' + total.toFixed(2));

            }
            calculateTotal(); // Initial calculation
            //create a function to update the quantity of the item in the cart
            $('.quantity').on('change', function() {
                var quantity = $(this).val();
                var price = parseFloat($(this).closest('tr').find('td:nth-child(3)').text().replace('KSH', '').trim());
                var itemTotal = price * quantity;
                $(this).closest('tr').find('.item-total').text('KSH' + itemTotal.toFixed(2));
                calculateTotal(); // Recalculate total after changing quantity
            });
            
        });
    </script>
</x-layout>