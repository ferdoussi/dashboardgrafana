<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        /* ===== Page Background ===== */
        .loginPage {
            /* Replace with your actual asset path */
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('wee.jpg') }}') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ===== Content Form Container ===== */
        .ContentForm {
            width: 100%;
            max-width: 410px;
            min-height: 550px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            overflow: hidden;
            display: flex;
        }

        /* ===== Login Form ===== */
        .formLogin {
            backdrop-filter: blur(10px) brightness(100%);
            background: rgba(255, 255, 255, 0.85);
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 40px 30px;
            align-items: center; /* Centers all children horizontally */
            justify-content: center;
        }

        .form-logo {
            max-width: 180px;
            
            margin-bottom: 40px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .formLogin h1 {
            text-align: center;
            color: #0D3457;
            background: linear-gradient(45deg, #0D3457, #1D81B2);
            -webkit-background-clip: text;
            background-clip: text;
            
            margin-bottom: 30px;
            font-size: 2.4rem;
            position: relative;
            display: inline-block;
        }

        .formLogin h1::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: 3px;
            background: #1970A1;
            border-radius: 2px;
        }

        /* ===== Input Boxes ===== */
        .inputbox {
            position: relative;
            width: 100%; /* Full width of container padding */
            margin-bottom: 25px;
        }

        .inputbox input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1rem;
            padding: 0 35px 0 10px;
            color: #03193c;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            transition: border-color 0.3s;
        }

        .inputbox input:focus {
            border-bottom: 2px solid #1970A1;
        }

        .inputbox ion-icon {
            position: absolute;
            right: 10px;
            color: #555;
            cursor: pointer;
            font-size: 1.3em;
            top: 50%;
            transform: translateY(-50%);
        }

        /* ===== Login Button ===== */
        .btn-Login {
            width: 100%;
            background: #0D3457;
            font-size: 18px;
            font-weight: 500;
            margin-top: 10px;
            border-radius: 8px;
            padding: 12px;
            border: none;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-Login:hover {
            background: #1D81B2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(29, 129, 178, 0.4);
        }

        /* ===== Error Message ===== */
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%;
            font-size: 0.9rem;
            text-align: center;
            border-left: 5px solid #dc3545;
        }

        /* ===== Responsive ===== */
        @media (max-width: 480px) {
            .ContentForm {
                width: 100%;
                box-shadow: none;
            }
            .formLogin {
                padding: 30px 20px;
                background: rgba(255, 255, 255, 0.95);
            }
        }
    </style>
   
</head>

<body>
    <div class="loginPage">
        <div class="ContentForm">
            <form action="{{ route('login') }}" method="POST" class="formLogin">
                @csrf
                <img class="logoForm form-logo" src="{{ asset('logo.png') }}" alt="Logo">
                <h1>Se Connecter</h1>

                @if($errors->any())
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                    </div>
                @endif

                <div class="inputbox">
                    <input type="email" name="email" placeholder="Adresse email" value="{{ old('email') }}" required>
                    <ion-icon name="mail-outline"></ion-icon>
                </div>

                <div class="inputbox">
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                    <ion-icon name="lock-closed-outline"></ion-icon>

                </div>

                <button type="submit" class="btn-Login"> 
                     Se Connecter
                </button>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.setAttribute('name', 'eye-off-outline');
            } else {
                passwordInput.type = 'password';
                toggleIcon.setAttribute('name', 'eye-outline');
            }
        }
    </script>
</body>
</html>