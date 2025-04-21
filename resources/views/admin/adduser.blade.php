<x-layout>
    <div class="container mt-5 p-4 bg-white shadow-lg rounded">
        <h1 class="text-center fw-bold mb-4">Add New User</h1>
        <p class="text-muted text-center">Fill in the details to create a new user account.</p>

        <!-- User Form -->
        <div class="border p-4 bg-light rounded">
            <h3 class="fw-bold">User Information</h3>
            <form method="POST" action="{{ route('admin.adduser') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Full Name</label>
                    <input value="{{old('name')}}" type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email Address</label>
                    <input value="{{old('email')}}" type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Phone Number</label>
                    <input value="{{old('phone')}}" type="number" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password_confirmation" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label fw-bold">User Role</label>
                    <select class="form-select" id="role" name="is_admin" required>
                        <option value="">--select--</option>
                        <option value="Admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4 py-2">Create User</button>
                    <a href="{{route('admin.users')}}" class="btn btn-secondary px-4 py-2">Cancel</a>
                </div>
            </form>
        </div>
        @if(session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif  
        @if($errors->any())
            <div class="alert alert-danger mt-3" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-layout>
