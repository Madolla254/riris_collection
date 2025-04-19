<x-layout>


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
            @foreach($cart as $id => $product)
                <tr>
                    <td><img src="{{asset($product['image_url'])}}" class="img-fluid" style="width: 60px; height:60px;"></td>
                    <td>{{$product['name']}}</td>
                    <td>{{$product['price']}}</td>
                    <td><input type="number" class="form-control w-50 text-center quantity" value="{{$product['quantity']}}"></td>
                    <td class="item-total">KSH</td>
                    <td><button class="btn btn-danger btn-sm remove-item">Remove</button></td>
                </tr>
            @endforeach
               
            </tbody>
        </table>

        <!-- Cart Summary -->
        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: <span id="cartTotal">KSH0</span></h4>
            <div>
                <button class="btn btn-secondary">Continue Shopping</button>
                <button class="btn btn-success">Checkout</button>
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