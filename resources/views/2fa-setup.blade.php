<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup 2FA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth/2fa-setup.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('YOKAMOS.png') }}">
</head>
<body>
    <div class="loginPage">
        <div class="ContentForm">
            <form method="POST" action="{{ route('2fa.enable') }}" class="formLogin">
                @csrf
                <h1>Setup 2FA</h1>

                @if($errors->any())
                    <div class="error-message">
                        {{ $errors->first() }}
                    </div>
                @endif

                <p>Scan this QR code with your authentication app:</p>

                <div class="qr-container">
                    <img src="{{ $qrCodeUrl }}" alt="QR Code">
                </div>

                <p>Or use this secret key: <br>
                    <strong class="secret-key">{{ $secret }}</strong>
                </p>

                <div class="inputbox">
                    <input type="text" name="code" placeholder="000000" required autofocus maxlength="6">
                    <ion-icon name="key-outline"></ion-icon>
                </div>

                <button type="submit" class="btn-Login">
                    <i class="fas fa-shield-alt"></i> Enable 2FA
                </button>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>