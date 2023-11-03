<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "eyecancer";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the total number of users
/*$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM tbl_users";
$result = $conn->query($totalUsersQuery);
$row = $result->fetch_assoc();
$totalUsers = $row['total_users'];

// Get the summary of users' ages
$ageSummaryQuery = "SELECT 
    COUNT(*) AS user_count, 
    MIN(dateofbirth) AS min_age, 
    MAX(dateofbirth) AS max_age, 
    AVG(YEAR(NOW()) - YEAR(dateofbirth)) AS average_age 
    FROM tbl_users";
$result = $conn->query($ageSummaryQuery);
$row = $result->fetch_assoc();

$userCount = $row['user_count'];
$minAge = $row['min_age'];
$maxAge = $row['max_age'];
$averageAge = round($row['average_age'], 2);

function calculateAge($dateOfBirth) {
    $birthDate = new DateTime($dateOfBirth);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate);
    return $age->y;
}

// Get the summary of users' gender distribution
$genderSummaryQuery = "SELECT gender, COUNT(*) AS gender_count FROM tbl_users GROUP BY gender";
$result = $conn->query($genderSummaryQuery);

$genderSummary = array();
while ($row = $result->fetch_assoc()) {
    $genderSummary[$row['gender']] = $row['gender_count'];
}*/


//$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Analysis</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Center the table */
        .user-table {
            text-align: center;
            margin-right: 0px;
            margin-right: 200px;
            width: 80%; /* Adjust the width as needed */
        }

        /* Style the table */
        .user-table table {
            width: 100%;
            border-collapse: collapse;
            margin-right: 90px;
        }

        .user-table table th, .user-table table td {
            border: 1px solid #ccc;
            padding: 20px;
        }

        .user-table table th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Admin Dashboard</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="basics.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="allusers.php">
                    <i class='bx bxs-user' ></i>
                    <span class="text">All Users</span>
                </a>
            </li>
            <li>
                <a href="predictions.php">
                    <i class='bx bxs-predict' ></i>
                    <span class="text">Predictions</span>
                </a>
            </li>
            <li>
                <a href="reports.php">
                    <i class='bx bxs-report' ></i>
                    <span class="text">Reports</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog' ></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
	
	<section id="content">
        <div class="content">
            <!--<div class="analysis-section">
                <h1>All Users</h1>
            </div>-->

            <div class="user-table">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "eyecancer";

                // Create a connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve user statistics
                /*$statisticsQuery = "SELECT COUNT(*) AS total_users, MIN(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dateofbirth, '%Y')) AS min_age, MAX(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dateofbirth, '%Y')) AS max_age, AVG(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dateofbirth, '%Y')) AS average_age, gender, COUNT(*) AS gender_count FROM tbl_users GROUP BY gender";
                $result = $conn->query($statisticsQuery);

                while ($row = $result->fetch_assoc()) {
                    echo "<p>Total Users: " . $row['total_users'] . "</p>";
                    echo "<p>Minimum Age: " . $row['min_age'] . " years</p>";
                    echo "<p>Maximum Age: " . $row['max_age'] . " years</p>";
                    echo "<p>Average Age: " . round($row['average_age'], 2) . " years</p>";
                    echo "<h2>Gender Distribution</h2>";
                    echo "<ul>";
                    echo "<li>" . $row['gender'] . ": " . $row['gender_count'] . "</li>";
                    echo "</ul>";
                }

                // Close the database connection*/
                $conn->close();
                ?>
            </div>

            <div class="user-table">
                <h2>All Users List</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    // Retrieve all users from the database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "eyecancer";

                    // Create a connection
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $usersQuery = "SELECT user_id, username, email, dateofbirth, gender FROM tbl_users";
                    $result = $conn->query($usersQuery);

                    while ($row = $result->fetch_assoc()) {
                        // Calculate the age from the date of birth
                        $dateOfBirth = $row['dateofbirth'];
                        $dateOfBirth = new DateTime($dateOfBirth);
                        $currentDate = new DateTime();
                        $age = $currentDate->diff($dateOfBirth)->y;

                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $age . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>";
                        echo "<a href='update.php?user_id=" . $row['user_id'] . "'>Update</a>";
                        echo " | ";
                        echo "<a href='delete.php?user_id=" . $row['user_id'] . "'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
