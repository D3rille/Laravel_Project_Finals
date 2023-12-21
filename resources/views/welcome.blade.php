<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CropWatch</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
        }
        .splash-screen {
            text-align: center;
            opacity: 1;
            animation: fadeIn 2s ease-in-out forwards;
        }
        .splash-logo {
            width: 70%;
            max-width: 300px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="splash-screen">
        <img src="{{ asset('img/logo-withtext.png') }}" alt="Logo" class="splash-logo">
    </div>
    <script>
        setTimeout(function () {
            const splashScreen = document.querySelector(".splash-screen");
            splashScreen.style.animation = "fadeOut 2s ease-in-out forwards"; 
            setTimeout(function () {
                window.location.href = "{{ route('login') }}"; 
            }, 1000); 
        }, 3000);
    </script>
</body>
</html>
