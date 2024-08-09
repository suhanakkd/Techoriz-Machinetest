<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Registering</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>Thank you for registering at {{ config('app.name') }}.</p>
    <p>We are glad to have you with us!</p>
</body>
</html>
