

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset Request</title>
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
        <div class="header">Password Reset Request</div>

        <!-- Message -->
        <div class="message">
            Hello, <br>
            You requested to reset your password. Click the button below to set a new password:
        </div>

        <!-- Reset Button -->
        <a href="{{ $resetLink }}" class="button">Reset Password</a>

        <!-- Footer -->
        <div class="footer">
            If you didn’t request this, please ignore this email. <br>
            Need help? <a href="mailto:{{env('ADMIN_EMAIL')}}">Contact Support</a>.
        </div>
    </div>

</body>
</html>
