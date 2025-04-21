<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to [Your Website Name]!</title>
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
        .footer {
            font-size: 14px;
            color: #888;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <div class="container">
      
        <!-- Header -->
        <div class="header">Welcome to {{env('COMPANY_NAME')}}!</div>

        <!-- Message -->
        <div class="message">
            Hello {{ $name }}, <br>
            We’re excited to have you on board! Explore amazing products, deals, and exclusive offers tailored just for you.
        </div>

        <!-- CTA Button -->
        <a href="{{ route('shop') }}" class="button">Start Shopping</a>

        <!-- Footer -->
        <div class="footer">
            Need assistance? <a href="mailto:{{env('ADMIN_EMAIL')}}">Contact Support</a>.<br>
            Follow us on <a href="{{env('FACEBOOK_LINK')}}">Facebook</a> | <a href="{{env('TWITTER_LINK')}}">Twitter</a>
            Or chat with us on <a href="{{env('WHATSAPP_LINK')}}">WhatsApp</a>.
        </div>
    </div>

</body>
</html>
