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
            justify-content: space-between;
            align-items: center;
            background-color: transparent;
            color: #fff;
            padding-top: 0;
            padding: 10px 20px;
        }

        .navbar .logo {
            color: rgb(158, 103, 226);
            font-weight: bold;
            text-decoration: none;
            font-size: 28px;
        }

        .navbar a {
            color: black;
            font-weight: 500;
            text-decoration: none;
            margin: 0 20px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .buttons {
            font-weight: 500;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
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
            <?php
            session_start();
            if (isset($_SESSION['user_id'])) {
                // User is logged in, display user profile
                $user_id = $_SESSION['user_id'];

                // Replace with your database connection code
                $servername = "localhost"; 
                $username = "root";
                $password = ""; 
                $database = "eyecancer"; 

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Database Connection failed: " . $conn->connect_error);
                }

                // Fetch user information from the database (adjust this code based on your database structure)
                $query = "SELECT * FROM tbl_users WHERE id = $user_id";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    echo '<div class="user-profile">';
                    echo '<img src="' . (!empty($user['photo']) ? 'images/' . $user['photo'] : '') . '" class="user-image" alt="User Image">';
                    echo '<span class="hidden-xs">' . $user['firstname'] . ' ' . $user['lastname'] . '</span>';
                    echo '</div>';
                    echo '<a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a>';
                }
                $conn->close();
            } else {
                echo '<a href="logout.php">Login/Register</a>';
            }
            ?>
        </div>
    </div>
</body>
</html>
