<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2>New Contact Message</h2>
    <p><strong>Name:</strong> {{ $contact->name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    @if($contact->phone)
        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
    @endif
    @if($contact->tour_type)
        <p><strong>Tour Type:</strong> {{ $contact->tour_type }}</p>
    @endif
    <p><strong>Message:</strong></p>
    <p>{{ $contact->message }}</p>
    <hr>
    <p style="color:#888;">Received at: {{ $contact->created_at }}</p>
</body>
</html>
