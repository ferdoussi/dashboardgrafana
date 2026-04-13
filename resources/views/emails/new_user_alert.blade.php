<!DOCTYPE html>
<html>
<head>
    <style>
        .btn { background: #5188f6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Hello Super Admin,</h2>
    <p>A new user has been added to the <strong>Yokamos</strong> platform and requires your validation.</p>

    <div style="background: #f4f4f4; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <p><strong>Name:</strong> {{ $newEmployee->name }}</p>
        <p><strong>Email:</strong> {{ $newEmployee->email }}</p>
        <p><strong>Role:</strong> {{ $newEmployee->role }}</p>
        <p><strong>Company:</strong> {{ $newEmployee->company }}</p>
    </div>

    <p>To validate this user, please log in to your dashboard:</p>
    <a href="{{ url('http://127.0.0.1:8000/') }}" class="btn">Access Dashboard</a>

    <p style="margin-top: 30px; font-size: 12px; color: #777;">This is an automated message from the Yokamos Security Platform.</p>
</body>
</html>