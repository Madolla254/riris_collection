<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You for Your Feedback - {{env('COMPANY_NAME')}}</title>
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
            background-color: #007bff;
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
        <div class="header">Thank You for Your Feedback!</div>

        <!-- Message -->
        <div class="message">
            Hello <strong> {{ $data['name'] }}</strong>, <br>
            We truly appreciate your feedback and the time you took to share your thoughts. Your insights help us improve and enhance our services.
        </div>

        <!-- CTA Button -->
        <a href="{{ route('home')}}" class="button">See What's New</a>

        <!-- Footer -->
        <div class="footer">
            If you have additional suggestions or need assistance, feel free to <a href="mailto:{{env('ADMIN_EMAIL')}}">contact us</a>.<br>
            Follow us on <a href="{{env('FACEBOOK_LINK')}}">Facebook</a> | <a href="{{env('TWITTER_LINK')}}">Twitter</a>
            Or chat with us on <a href="{{env('WHATSAPP_LINK')}}">WhatsApp</a>.
            <br><br>
        </div>
    </div>

</body>
</html>
