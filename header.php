<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: 'Courier New', Courier, monospace;
            box-sizing: border-box;
        }
        .navbar {
            display: flex;
            justify-content: space-between; /* Logo to the right, buttons to the left */
            align-items: center;
            background-color: transparent; /* Background color */
            color: #fff; /* Text color */
            padding-top:0;
            padding: 10px 20px; /* Add padding to the top and bottom of the navigation bar */
        }

        .navbar .logo {
            color: black; /* Text color for the logo */
            font-weight: bold;
            text-decoration: none;
            font-size: 28px; /* Adjust the font size */
        }

        .navbar a {
            color: black;
            font-weight: 500;
            text-decoration: none;
            margin: 0 20px; /* Add margin to space out the buttons */
        }

        .navbar a:hover {
            text-decoration: underline;
        }
        .buttons{
            font-weight: 500;
        }
        
    </style>
</head>
<body>
    <div class="navbar">
        <a class="logo" href="#section-home">Eye Test</a>
        <div class="buttons">
            <a href="land.php">Home</a>
            <a href="about.php">About</a>
            <a href="upload.php">Upload Image</a>
            <a href="log.php">Login/Register</a>
        </div>
    </div>
</body>
</html>
