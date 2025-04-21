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
@if($errors->any()) 
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="container mt-5 p-4 bg-white shadow-lg rounded">
        <h1 class="text-center fw-bold mb-4">User Management</h1>
        <p class="text-muted text-center">Manage all registered users in the system.</p>
        <a href="{{route('admin.contact')}}" class="btn btn-secondary px-4 py-2">Users Feedback</a>
        <a href="{{route('admin.adduser.show')}}" class="btn btn-success px-4 py-2">Add User</a>

        <!-- User Table -->
        <div class="border p-4 bg-light rounded">
            <h3 class="fw-bold">All Users</h3>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Registered On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <form action="{{ route('admin.deleteuser', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="text-center mt-5">
            <p class="fw-bold">Need to add new users?</p>
            <a href="{{route('admin.adduser.show')}}" class="btn btn-success px-4 py-2">Add User</a>
        </div>
    </div>
    {{$users->links()}}
</x-layout>
