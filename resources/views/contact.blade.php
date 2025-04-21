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
    <div class="container mt-5 p-4 bg-white shadow-lg rounded">
        <h1 class="text-center fw-bold mb-4">Contact Us</h1>
        <p class="text-muted text-center">We’d love to hear from you! Get in touch with us.</p>

        <div class="border p-4 bg-light rounded">
            <h3 class="fw-bold">Our Contact Information</h3>
            <p><strong>Email:</strong> support@ririscollection.com</p>
            <p><strong>Phone:</strong> {{env('ADMIN_PHONE_NUMBER')}}</p>
            <p><strong>Address:</strong> Nairobi, Kenya</p>
            <p><strong>Working Hours:</strong> Mon - Fri | 9 AM - 5 PM</p>
        </div>

        <!-- Contact Form -->
        <div class="border p-4 bg-light rounded mt-4">
            <h3 class="fw-bold">Send Us a Message</h3>
            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold" value="{{old('name')}}">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold" value="{{old('email')}}">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold"value="{{old('phone_number')}}">Your Phone Number</label>
                    <input type="number" class="form-control" id="email" name="phone_number" >
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label fw-bold">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2">Send Message</button>
                </div>
            </form>
        </div>

        <div class="text-center mt-5">
            <p class="fw-bold">Need Immediate Assistance?</p>
            <a href="https://wa.me/{{env('ADMIN_PHONE_NUMBER')}}" class="btn btn-success px-4 py-2">Chat on WhatsApp</a>
        </div>
    </div>
</x-layout>
