<x-layout>
        <form action="{{route('register')}}" method="POST" class="container p-4 col-md-6 col-sm-12">
        @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input value="{{old('name')}}" type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input value="{{old('email')}}"type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
    </div>
    
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel"value="{{old('phone')}}" id="phone" name="phone" class="form-control" placeholder="+254712345678" required />
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
    </div>
    
    <div class="mb-3">
        <label for="confirm_password" class="form-label">Repeat Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repeat your password" required>
    </div>
    
    <button type="submit" class="btn btn-success w-40">Register</button>
</form>
            @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
            </ul>
                @endforeach
            @endif


</x-layout>