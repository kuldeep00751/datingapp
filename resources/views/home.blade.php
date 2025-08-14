<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        @font-face {
            font-family: 'AvenirNext';
            src: url('/fonts/avenir-next-ultra-light.ttf') format('truetype');
            font-style: normal;
            color:#000;
        }
        @font-face {
            font-family: 'CambriaItalic';
            src: url('/fonts/Cambria Italic.ttf') format('truetype');
            font-style: italic;
        }
        @font-face {
            font-family: 'FutureBTBook';
            src: url('/fonts/futura-bk-bt-book.woff2') format('woff2'),
            url('/fonts/futura-bk-bt-book.woff') format('woff'),
            url('/fonts/futura-bk-bt-book.ttf') format('truetype');
            font-style: normal;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: 'AvenirNext', sans-serif;;
        }

        .welcome-screen {
            position: fixed;
            width: 100%;
            height: 100%;
            background: url('{{ asset("pictures/welcome_background.png") }}') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .welcome-screen::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            z-index: 0;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            color: #fff;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        .welcome-content h2 {
            font-size: 2.0rem;
            margin: 0;
            font-family: "AvenirNext", sans-serif;
            font-weight: 100;
        }

        .welcome-content h1 {
            font-size: 6rem;
            margin: 0px 0px;
            font-family: "AvenirNext", sans-serif;
            margin-bottom: 5rem;
            line-height: 0.9;
            font-weight: 100;
        }

        .welcome-content .brand {
            margin-top: 30px;
            font-size: 2rem;
        }

        .brand .logo-text {
            font-size: 1.4rem;
            font-weight: bold;
            display: inline-block;
            margin-left: 5px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
    </style>
</head>
<body>
    <div class="welcome-screen" id="welcomeScreen">
        <div class="welcome-content">
            <h2>Welcome</h2>
            <h1>{{ Auth::user()->like_to_be_called ?? 'Guest' }}</h1>
            <div class="brand">
                This is
            </div>
            <img src='{{ asset("pictures/LOGO H W.png") }}' width="300">
        </div>
    </div>

    <script>
        //Hide after 1.5 seconds
        setTimeout(() => {
            //document.getElementById('welcomeScreen').style.display = 'none';
            window.location.href = "{{ url('/menu') }}";
        }, 3000);
    </script>
</body>
</html>
