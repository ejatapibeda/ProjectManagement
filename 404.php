<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 150px;
            margin: 0;
            font-weight: 900;
            letter-spacing: 20px;
            background: url('https://cdn.pixabay.com/photo/2018/05/30/15/39/thunderstorm-3441687_1280.jpg') center;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: cover;
            background-position: center;
            animation: shrink 5s infinite alternate;
        }

        @keyframes shrink {
            0% {
                background-size: 120% 120%;
            }

            100% {
                background-size: 100% 100%;
            }
        }

        h2 {
            font-size: 30px;
            margin-top: 0;
            color: #333;
            animation: fadeInUp 1s ease-out;
        }

        p {
            font-size: 18px;
            color: #666;
            max-width: 600px;
            margin: 20px auto;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4a90e2;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out 1s both;
        }

        .btn:hover {
            background-color: #3570b4;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .astronaut {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: auto;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(-50%, -50%) translateY(0);
            }

            50% {
                transform: translate(-50%, -50%) translateY(-20px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 100px;
                letter-spacing: 10px;
            }

            h2 {
                font-size: 24px;
            }

            p {
                font-size: 16px;
                padding: 0 20px;
            }

            .astronaut {
                width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>404</h1>
        <div class="dalem">
            <h2>Oops! Page Not Found</h2>
            <p>The page you are looking for might have been removed, had its name changed, or is temporarily
                unavailable.
            </p>
            <a href="index.php" class="btn">Go to Homepage</a>
        </div>
    </div>
    <img id="astronaut" src="" alt="Floating Astronaut" class="astronaut">

    <?php
    include_once __DIR__ . '/config/config.php';
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const img = document.getElementById('astronaut');
            const baseURL = '<?php echo $base_url; ?>';
            img.src = `${baseURL}assets/images/404.png`;
        });

        document.addEventListener('mousemove', (e) => {
            const astronaut = document.querySelector('.astronaut');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            astronaut.style.transform = `translate(calc(-50% + ${x * 20}px), calc(-50% + ${y * 20}px))`;
        });
    </script>
</body>

</html>
