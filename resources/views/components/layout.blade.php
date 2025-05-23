
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riri's Collection - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        a{
            text-decoration: none;
            color: inherit;
        }
        .fixed-dimension {
            width: 100%;
            height: 200px; /* Adjust as needed */
            object-fit: cover; /* Maintain aspect ratio */
        }
        .fixed-dimension-bigg {
            width: 100%;
            height: 400px; /* Adjust as needed */
            object-fit: cover; /* Maintain aspect ratio */
        }
        .pagination-sm .page-link {
        font-size: 12px; /* Adjust font size */
        padding: 3px 6px; /* Reduce padding */
    }
        .pagination-sm .page-item.active .page-link {
            background-color: #007bff; /* Active page color */
            border-color: #007bff; /* Active page border color */
        }
        .pagination-sm .page-link {
            color: #007bff; /* Link color */
        }
          .pagination .page-item:first-child .page-link, 
         .pagination .page-item:last-child .page-link {
              font-size: 12px; /* Smaller arrow buttons */
          }
          .product-img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
        }
        .thumbnail-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            cursor: pointer;
            border: 1px solid #ddd;
            margin: 5px;
        }
        .product-card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            background: #ffffff;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            color: #ff6600;
        }
        .discount {
            font-size: 18px;
            color: #28a745;
        }
        .btn-custom {
            padding: 10px 20px;
            font-size: 16px;
        }.whatsapp-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    background-color: #25D366;
    border-radius: 50%;
    padding: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}
.whatsapp-btn img {
    width: 50px;
    height: auto;
}
.whatsapp-btn:hover {
    background-color: #1DA85F;
}
.offer-ribbon {
        position: absolute;
        top: 10px;
        left: 10px;
        font-weight: bold;
        transform: rotate(-20deg);
    }
.sale-ribbon {
        position: absolute;
        top: 20px;
        right: 10px;
        background: red;
        color: white;
        padding: 8px 20px;
        font-size: 16px;
        font-weight: bold;
        transform: rotate(45deg);
        box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
    }
</style>
</head>
<body class="bg-light">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <img src="{{asset('images/logo/main_logo.jpeg')}}" alt="Rirs Collection Logo" width="40" height="40" class="me-2">
            <a class="navbar-brand" href="#">Riri's Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                @guest
                    
                
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('shop')}}">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('cart')}}"><i class="fa-solid fa-cart-plus"></i>Cart 
                     @if(session('cart') )
                                @if(count(session('cart')) > 0)
                                <span class="badge bg-danger">{{count(session('cart'))}}</span>
                                @endif
                            @endif
                            </a></li>
                           </span>
                            
                    @endguest
                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item"><a class="nav-link" href="{{route('admin.dashboard')}}">Admin Dashboard</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('shop')}}">Shop</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('about')}}">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('cart')}}"><i class="fa-solid fa-cart-plus"></i>Cart 
                            
                            @if(session('cart') )
                                @if(count(session('cart')) > 0)
                                <span class="badge bg-danger">{{count(session('cart'))}}</span>
                                @endif
                            @endif
                            </a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('profile')}}">{{auth()->user()->name}}<i class="fa-solid fa-user"></i></a></li>
                            
                            
                        <form method='POST' action="{{route('logout')}}">
                            @csrf
                            <button type='submit' class='btn btn-danger'>Logout</button>
                            
                        </form>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

        @if(Auth::check() && Auth::user()->is_admin == true)
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold">Admin Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard |</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Users |</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.adduser') }}">Add User |</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders') }}">Orders |</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pending Orders |</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.products') }}">Products |</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories') }}">Categories |</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.contact') }}">Contact |</a></li>
                
                    <li class="nav-item"><a class="nav-link" href="#">Reports |</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </div>
    
@endif

    </nav>
   <a href="https://wa.me/{{env('ADMIN_PHONE_NUMBER')}}" target="_blank" class="whatsapp-btn">
        <i class="fab fa-whatsapp fa-2x text-white"></i>
    </a>
    {{$slot}}

    <footer class="bg-dark text-light py-4 mt-5">
    <div class="container">
        <div class="row">
            <!-- Column 1: About & Contact -->
            <div class="col-md-4">
                <h5>About Us</h5>
                <p>Learn more about {{ env('COMPANY_NAME') }} and our mission.</p>
                <a href="{{ route('about') }}" class="text-light">About Us</a><br>
                <a href="{{ route('contact') }}" class="text-light">Contact Us</a><br>
                <a href="https://wa.me/{{env('ADMIN_PHONE_NUMBER')}}" class="text-light">Chat on WhatsApp</a>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <a href="{{ route('home') }}" class="text-light">Home</a><br>
                <a href="{{ route('shop') }}" class="text-light">Shop</a><br>
                <a href="{{ route('cart') }}" class="text-light">View Cart</a><br>
                <a href="{{ route('orders.store') }}" class="text-light">Checkout</a>
            </div>

            <!-- Column 3: Legal & Social -->
            <div class="col-md-4">
                <h5>Legal & Social</h5>
                <a href="{{route('terms')}}" class="text-light">Terms & Conditions</a><br>
                <a href="{{route('faqs')}}" class="text-light">FAQS</a><br>
                <a href="https://facebook.com/yourcompany" class="text-light">Facebook</a><br>
                <a href="https://twitter.com/yourcompany" class="text-light">Twitter</a>
            </div>
        </div>

        <div class="text-center mt-3">
            <p>&copy; {{ date('Y') }} {{ env('COMPANY_NAME') }}. All rights reserved.</p>
             <p>Web Development by Joseph Thangu +254 758954791 
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
</body>
</html>