<x-layout>
    <div class="container mt-5 p-4 bg-white shadow-lg rounded">
        <h1 class="text-center fw-bold mb-4">About {{ env('COMPANY_NAME') }}</h1>
        <p class="text-muted text-center">Discover who we are and what we stand for.</p>

        <div class="mb-4">
            <p>Welcome to <strong>{{ env('COMPANY_NAME') }}</strong>, where innovation meets excellence. We are dedicated to providing high-quality products and services that cater to the diverse needs of our customers.</p>
        </div>

        <div class="border p-4 mb-4 bg-light rounded">
            <h3 class="fw-bold">Our Mission</h3>
            <p>At <strong>{{ env('COMPANY_NAME') }}</strong>, our mission is to revolutionize the way people experience fashion. We strive to deliver <span class="text-primary fw-bold">exceptional quality</span>, <span class="text-success fw-bold">unparalleled customer service</span>, and <span class="text-warning fw-bold">cutting-edge solutions</span> to enhance your everyday life.</p>
        </div>

        <div class="border p-4 mb-4 bg-light rounded">
            <h3 class="fw-bold">Who We Are</h3>
            <p>Founded in <strong>2025</strong>, we have grown from a small startup to a trusted name in the industry. Our team consists of passionate professionals committed to delivering the best experience for our clients.</p>
        </div>

        <div class="border p-4 bg-light rounded">
            <h3 class="fw-bold">Why Choose Us?</h3>
            <ul class="list-unstyled">
                <li>✅ <strong>Quality Assurance</strong> – Every product/service undergoes thorough quality checks.</li>
                <li>✅ <strong>Customer-Centric Approach</strong> – Your satisfaction is our priority.</li>
                <li>✅ <strong>Innovation & Growth</strong> – We embrace new technologies and improvements.</li>
            </ul>
        </div>

        <div class="text-center mt-5">
            <p class="fw-bold">Join Our Journey</p>
            <p>Whether you're a new visitor or a longtime customer, we welcome you to explore our offerings and be part of our story. Stay connected with us for updates, offers, and exciting innovations!</p>
            <a href="{{ route('contact') }}" class="btn btn-primary px-4 py-2">Contact Us</a>
        </div>
    </div>
</x-layout>
