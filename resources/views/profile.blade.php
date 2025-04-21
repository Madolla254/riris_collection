<x-layout>


    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-light text-center">
                <h2>Your Profile</h2>
                <p class="text-muted">Manage your account and orders.</p>
            </div>
            <div class="card-body">
                
                <!-- User Details -->
                <div class="mb-4">
                    <h4 class="text-primary">👤 Personal Details</h4>
                    <p><strong>Name:</strong> {{$user->name}}</p>
                    <p><strong>Email:</strong> {{$user->email}}</p>
                    <p><strong>Phone Number:</strong> {{$user->phone}}</p>
                    <a href="{{route('password.request')}}"><button class="btn btn-warning">Change Password</button></a>
                </div>

               

                <!-- Pending Orders -->
                <div class="mb-4 table-responsive">
                    <h4 class="text-danger">⏳ Pending Orders</h4>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Total (KSH)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($incomplete_orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>KSH {{ number_format($order->total_price, 2) }}</td>
                                <td class="text-warning">{{ ucfirst($order->status) }}</td> 
                                <td><button class="btn btn-danger">Cancel Order</button><a href="{{route('user.view_order',$order->id)}}"> <button class="btn btn-primary">View order</button></a></td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                    </table>
                </div>
                

                 <!-- Previous Orders -->
                <div class="mb-4">
                    <h4 class="text-success">📦 All Orders</h4>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Total (KSH)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                             <a href="{{route('user.view_order',$order->id)}}"><tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>KSH {{ number_format($order->total_price, 2) }}</td>
                                <td class="text-success">{{ ucfirst($order->status) }}</td> 
                                <td><a href="{{route('user.view_order',$order->id)}}"> <button class="btn btn-primary">View order</button></a></td>
                            </tr></a>
                        @endforeach
                           
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

  

</x-layout>