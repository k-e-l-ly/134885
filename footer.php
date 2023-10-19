<!DOCTYPE html>
<html>
<head>
    <style>
        @keyframes colorChange {
            0% {
                background: linear-gradient(45deg, black, grey);
            }
            50% {
                background: linear-gradient(45deg, grey, black);
            }
            100% {
                background: linear-gradient(45deg, black, grey);
            }
        }

        footer {
            animation: colorChange 5s linear infinite;
            background-size: 100% 100%;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .footer-nav {
            list-style: none;
            padding: 0;
        }

        .footer-nav li {
            display: inline;
            margin-right: 15px;
        }

        .footer-nav a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Your page content here -->

    <footer>
        <ul class="footer-nav">
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="upload.html">Upload Image</a></li>
            <li><a href="login.html">Login/Register</a></li>
        </ul>
        <p>&copy; 2023 Eye Test</p>
    </footer>
</body>
</html>
