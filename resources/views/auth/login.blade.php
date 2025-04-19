<x-layout>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-warning">
        {{ session('error') }}
    </div>
@endif
<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="w-100 w-lg-50">
    <h3>Login</h3>
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label bold">Email</label>
                <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p>Dont have an account? <a href="{{ route('register') }}">Register</a></p>
        </form>
    </div>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</x-layout>