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
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM tbl_users";
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
}


//$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Analysis</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="allusers.php">
					<i class='bx bxs-user' ></i>
					<span class="text">All users</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Analytics</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
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
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="cv.png">
			</a>
		</nav>
		<!-- NAVBAR -->

        <div class="content">
                <div class="analysis-section">
                    <h1>User Analysis</h1>
                    <p>Total Users: <?php echo $totalUsers; ?></p>
                </div>

                <div class="analysis-section">
                    <h2>Age Summary</h2>
                    <p>Total Users: <?php echo $userCount; ?></p>
                    <p>Minimum Age: <?php echo calculateAge($minAge); ?> years</p>
                    <p>Maximum Age: <?php echo calculateAge($maxAge); ?> years</p>
                    <p>Average Age: <?php echo round($averageAge, 2); ?> years</p>
                </div>

                <div class="analysis-section">
                    <h2>Gender Distribution</h2>
                    <ul>
                        <?php
                        foreach ($genderSummary as $gender => $count) {
                            echo "<li>$gender: $count</li>";
                        }
                        ?>
                    </ul>
                </div>
        </div>

        <div class = "mngt">
                <?php
                    // Connect to your database here

                    // Retrieve all users from the tbl_users table
                    $query = "SELECT * FROM tbl_users";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<table>';
                        echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Actions</th></tr>';
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td style="padding:2px;>' . $row['user_id'] . '</td>';
                            echo '<td style="padding:2px;>' . $row['username'] . '</td>';
                            echo '<td style="padding:2px;>' . $row['email'] . '</td>';
                            echo '<td style="padding:2px;>';
                            echo '<a href="update.php?id=' . $row['user_id'] . '">Update</a>';
                            echo ' | ';
                            echo '<a href="delete.php?id=' . $row['user_id'] . '">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        
                        echo '</table>';
                    } else {
                        echo 'No users found.';
                    }

                    // Close the database connection
                    mysqli_close($conn);
                ?>
        </div>

	</section>
    
</body>
</html>
