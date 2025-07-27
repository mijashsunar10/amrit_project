<!DOCTYPE html>
<html>
<head>
    <title>Contact Us Message</title>
</head>
<body>
    <h2>Book Cycle Contact Us:</h2>
    <p class="text-lg"><strong>Name:</strong> {{ $data['name'] }}</p>
    <p class="text-lg"><strong>Email:</strong> {{ $data['email'] }}</p>
    @if (!empty($data['whatsapp']))
        <p class="text-lg"><strong>WhatsApp:</strong> {{ $data['whatsapp'] }}</p>
    @endif
    <p class="text-lg"><strong>Message:</strong> {{ $data['message'] }}</p>
</body>
</html>