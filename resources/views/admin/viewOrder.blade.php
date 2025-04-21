<x-layout>
@if(session('success')) 
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="container mt-5 p-4 bg-white shadow-lg rounded">
        <h1 class="text-center fw-bold mb-4">Order Details</h1>
        <p class="text-muted text-center">View the complete order summary.</p>

        <!-- Order Information -->
        <div class="border p-4 bg-light rounded">
            <h3 class="fw-bold">Order Summary</h3>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                    <p><strong>Customer Name:</strong> {{ $user->name ?? 'Guest' }}</p>
                    <p><strong>Email:</strong> {{ $order->email ?? 'No Email' }}</p>
                    <p><strong>Address:</strong> {{ $order->address ?? 'No Address' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phone:</strong> {{ $order->phone_number ?? 'No Phone' }}</p>
                    <p><strong>Total Price:</strong> KSH {{ number_format($order->total_price, 2) }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Ordered On:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>

        <!-- Ordered Items -->
        <div class="border p-4 bg-light rounded mt-4">
            <h3 class="fw-bold">Ordered Items</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Product Id</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item=>$product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>KSH {{ number_format($product->price, 2) }}</td>
                                <td>KSH {{ number_format($product->quantity * $product->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('admin.orders') }}" class="btn btn-secondary px-4 py-2">Back to Orders</a>
            <form action="{{route('admin.orders.updateStatus.return',$order->id)}}" method="POST" class="d-inline">
                @csrf
                <select name="status" class="form-select w-50 d-inline-block" required>
                    <option value="" disabled selected>Select Order Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="delivered">Delivered</option>
                </select>
                <input type="hidden" name="id" value="{{ $order->id }}">
                <button type="submit" class="btn btn-primary px-4 py-2">Change Order Status</button>
            </form>
        </div>
    </div>
</x-layout>
