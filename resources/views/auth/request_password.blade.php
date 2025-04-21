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
    <h3>Request Password Reset</h3>
        <form id="requestPasswordForm" method="POST" action="{{ route('password.sendResetLink') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label bold">Email</label>
                <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email" required>
            </div>
            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
            <p class="mt-3">Remembered your password? <a href="{{ route('login') }}" class="btn btn-link">Login</a></p>
        </form>
    </div>
</div>
</x-layout>