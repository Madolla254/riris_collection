<x-layout>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-light text-center">
                <h2>Order Details</h2>
                <p class="text-muted">Order ID: {{ $order->id }} | Placed on {{ $order->created_at->format('d M Y') }}</p>
            </div>

            <div class="card-body">
                
                <!-- Order Summary -->
                <div class="mb-4">
                    <h4 class="text-primary">📦 Order Summary</h4>
                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                    <p><strong>Total Amount:</strong> KSH {{ number_format($order->total_price, 2) }}</p>
                    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-warning">{{ $order->status }}</span></p>
                    <p><strong>Shipping Address:</strong><span>{{ $order->address }}</span></p>
                    
                    <!--cancel button-->
                    @if(($order->status === 'processing'|| $order->status === 'pending'&& $order->created_at->diffInMinutes() <= 30))
                        <p class="text-danger">You can cancel your order within 30 minutes of placing it.</p>
                        <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-50">Cancel Order</button>
                        </form>
                    @endif
                </div>

                <!-- Order Tracking -->
                @if($order->status !== 'Delivered')
                    <div class="mb-4">
                        <h4 class="text-info">🚚 Order Tracking</h4>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" 
                                style="width: {{ $tracking_percentage }}%;" 
                                aria-valuenow="{{ $tracking_percentage }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                {{ $order->tracking_stage }}
                            </div>
                        </div>
                        <p class="mt-2"><strong>Estimated Delivery:</strong> {{ $order->estimated_delivery }}</p>
                    </div>
                @endif

                <!-- Order Items Table -->
                <h4 class="text-success">🛒 Order Items</h4>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price (KSH)</th>
                            <th>Total (KSH)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Cancel Order Button -->
                @if($order->status === 'Processing')
                    <div class="text-center mt-4">
                        <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-50">Cancel Order</button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-layout>
