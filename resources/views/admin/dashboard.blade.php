<x-layout>
    <!-- Main Content -->
        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Admin Dashboard</h2>
                <button class="btn btn-primary d-lg-none" id="toggleSidebar">Menu</button>
            </div>
            
            <!-- Dashboard Cards -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Orders</h5>
                            <p class="card-text">You have 120 new orders.</p>
                            <a href="#" class="btn btn-primary">View Orders</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <p class="card-text">Total products: {{$productsCount}}.</p>
                            <a href="{{route('admin.products')}}" class="btn btn-success">Manage Products</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Customers</h5>
                            <p class="card-text">Active customers: 900.</p>
                            <a href="#" class="btn btn-info">View Customers</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout>