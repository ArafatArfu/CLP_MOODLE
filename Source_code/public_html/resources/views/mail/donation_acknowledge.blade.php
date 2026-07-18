<!DOCTYPE html>
<html>
<head>
    <title>New Donation Completion</title>
</head>
<body>
    <h1>New Donation Completion</h1>
    <p><strong>Name:</strong> {{ $donation->name }}</p>
    <p><strong>Email Address:</strong> {{ $donation->email }}</p>
    <p><strong>Payment Method:</strong> {{ $donation->payment_method }}</p>
</body>
</html>
