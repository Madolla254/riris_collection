<x-layout>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="w-100 w-lg-50">
    <h3>admin login</h3>
        <form id="loginForm" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label bold">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
</x-layout>