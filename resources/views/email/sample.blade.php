<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>
<body>
    <p>Hello {{ $input['name'] }},</p>
    <p>Thank you for registering with us! Please click the following link to verify your email address:</p>
    <p><a href="{{ route('verify', ['token' => $verification_token]) }}">Verify Email</a></p>
    <p>If you didn't create an account, you can safely ignore this email.</p>
</body>
</html>
