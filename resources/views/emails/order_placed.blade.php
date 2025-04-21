<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmation - {{env('COMPANY_NAME')}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .logo img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .message {
            font-size: 16px;
            color: #555;
            margin: 20px 0;
        }
        .table-container {
            width: 100%;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #ffffff;
        }
        .footer {
            font-size: 14px;
            color: #888;
            margin-top: 30px;
        }
        .button {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
       

        <!-- Header -->
        <div class="header">Your Order Has Been Received!</div>

        <!-- Message -->
        <div class="message">
            Hello {{ $order->user->name }}, <br>
            Thank you for shopping with {{env('COMPANY_NAME')}}. Your order has been successfully placed.
        </div>

        <!-- Order Summary Table -->
        <div class="table-container">
            <table>
                <tr>
                    <th>Order ID</th>
                    <td>{{ $order->id}}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ $order->created_at }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $order->address }}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{ $order->phone_number }}</td>
                </tr>

                <tr>
                    <th>Total Amount</th>
                    <td>KSH {{ $order->total_price }}</td>
                </tr>
                
            </table>
        </div>

        <!-- Order Items Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_items as $key => $value)
                         <tr>
                            <td>{{ $value['product_id']}}</td>
                            <td>{{ $value['product_name'] }}</td>
                            <td>KSH {{ $value['quantity'] }}</td>
                            <td>KSH {{ number_format($value['price'],2) }}</td>
                            <td>KSH {{ number_format($value['quantity'] * $value['price'],2) }}</td>
                        </tr>
                    @endforeach
                       
                    
                </tbody>
            </table>
        </div>

        <!-- CTA Button -->
        <a href="#" class="button">View Order Details</a>

        <!-- Footer -->
        <div class="footer">
            Need assistance? <a href="mailto:{{env('ADMIN_EMAIL')}}">Contact Support</a>.<br>
            Follow us on <a href="{{env('FACEBOOK_LINK')}}">Facebook</a> | <a href="{{env('TWITTER_LINK')}}">Twitter</a>
            Or chat with us on <a href="{{env('WHATSAPP_LINK')}}">WhatsApp</a>.
        </div>
    </div>

</body>
</html>
