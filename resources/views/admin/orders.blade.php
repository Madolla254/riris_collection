<x-layout>
    <div class="container mt-5 p-4 bg-white shadow-lg rounded">
        <h1 class="text-center fw-bold mb-4">Order Management</h1>
        <p class="text-muted text-center">Review and manage customer orders.</p>
        <a href="{{route('admin.pendingorders')}}" class="btn btn-success px-4 py-2">Pending Orders</a>
        <a href="{{route('admin.completedorders')}}" class="btn btn-primary px-4 py-2">Completed Orders</a>
        <a href="{{route('admin.cancelledorders')}}" class="btn btn-danger px-4 py-2">Cancelled Orders</a>
        <a href="{{route('admin.shippedorders')}}" class="btn btn-secondary px-4 py-2">Shipped Orders</a>
        <a href="{{route('admin.orders')}}" class="btn btn-warning px-4 py-2">All Orders</a>

        <!-- Orders Table -->
        <div class="border p-4 bg-light rounded">
            <h3 class="fw-bold">{{$title}}</h3>
            <p class="text-muted">Total Orders: {{ $orders->count() }}</p>
           
        </div>

        <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Ordered On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    @if($order->user)
                        <td>{{ $order->user->name ? $order->user->name:"No name selected" }}</td>
                    @else
                        <td>No user selected</td>
                    @endif
                    <td>KSH {{ number_format($order->total_price, 2) }}</td>
                    
                    <td>
                        <select class="form-select status-dropdown" data-id="{{ $order->id }}">
                            <option value="pending" class="text-warning" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                             <option value="processing" class="text-primary" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" class="text-info" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" class="text-success" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                        <option value="completed" class="text-success" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="returned" class="text-danger" {{ $order->status == 'returned' ? 'selected' : '' }}>Returned</option>

                            <option value="canceled" class="text-danger" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            


                        </select>
                    </td>

                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{route('admin.viewOrder',$order->id)}}" class="btn btn-primary btn-sm">View</a>
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>

        <div class="text-center mt-5">
            <p class="fw-bold">Looking for pending orders?</p>
            <a href="{{route('admin.pendingorders')}}" class="btn btn-success px-4 py-2">View Pending Orders</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".status-dropdown").change(function () {
            let orderId = $(this).data("id"); 
            let newStatus = $(this).val();

            $.ajax({
                url: "{{ route('admin.orders.updateStatus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: orderId,
                    status: newStatus
                },
                success: function (response) {
                    alert("Order status updated successfully!");
                },
                error: function () {
                    alert("Error updating order status. Try again!");
                }
            });
        });
    });
</script>

</x-layout>
