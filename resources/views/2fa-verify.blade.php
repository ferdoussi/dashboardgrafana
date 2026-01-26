<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/auth/2fa-verify.css') }}">
</head>
<body>
    
<div class="loginPage">
    <div class="ContentForm">
    <form method="POST" action="{{ route('2fa.check') }}" class="formLogin">
    @csrf
    <h1>Vérification 2FA</h1>
    <p>Entrez le code de votre application</p>
    <div class="inputbox">
        <input type="text" name="code" placeholder="Enter 6-digit code" required>
    </div>
    <button type="submit" class="btn-Login">Vérifier</button>
</form>

        <div class="imgForm">
            <div class="welcome-section">
                <div class="welcome-subtitle">Authentification sécurisée</div>
                <p class="welcome-description">
                    Veuillez entrer le code à 6 chiffres généré par votre application d'authentification.
                </p>
            </div>
        </div>
    </div>
</div>


</body>
</html>