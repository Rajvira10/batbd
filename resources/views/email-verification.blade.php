<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .email-body {
            font-size: 16px;
            line-height: 1.5;
        }

        .email-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Email Verification</h1>
        </div>
        <div class="email-body">
            <p>Dear {{ $user->name }},</p>
            <p>Thank you for registering. Please click the button below to verify your email address:</p>
            <div class="text-center">
                <a href="{{ $verificationUrl }}" class="btn btn-primary">Verify Email</a>
            </div>
            <p>If you did not register, please ignore this email.</p>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
