<!-- resources/views/emails/participant_registered.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>New Participant Registration</title>
</head>
<body>
    <h1>New Participant Registration</h1>
    <p><strong>Last Name:</strong> {{ $participant->last_name }}</p>
    <p><strong>First Name:</strong> {{ $participant->first_name }}</p>
    <p><strong>Mailing Address:</strong> {{ $participant->mailing_address }}</p>
    <p><strong>Email Address:</strong> {{ $participant->email }}</p>
    <p><strong>Contact Phone:</strong> {{ $participant->contact_phone }}</p>
    <p><strong>Number of Guests:</strong> {{ $participant->guests }}</p>
    <p><strong>Payment Method:</strong> {{ $participant->payment_method }}</p>
    <p><strong>Amount:</strong> {{ $participant->amount }}</p>
</body>
</html>
