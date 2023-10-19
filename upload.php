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

// Start a PHP session to retrieve the user's ID
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("User ID not found. Please log in.");
}

// Define variables for the uploaded image and description
$image_description = $image_name = $image_tmp_name = $image_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image_name = $_FILES["image"]["name"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_type = $_FILES["image"]["type"];
    }

    $image_description = $_POST["description"];

    // Ensure that the description is not empty
    if (empty($image_description)) {
        echo "Image description is required.";
    } else {
        // Perform the insertion into the tbl_images table
        $insert_query = "INSERT INTO tbl_images (user_id, image_description, image_data) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);

        if ($stmt) {
            $stmt->bind_param("iss", $user_id, $image_description, $image_data);
            $image_data = file_get_contents($image_tmp_name);

            if ($stmt->execute()) {
                echo "Image uploaded successfully!";
            } else {
                echo "Error uploading the image: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload with Description</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            width: 400px;
        }

        h2 {
            margin: 0 0 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="file"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            resize: none;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload an Image with Description</h2>
        <form id="upload-form" enctype="multipart/form-data">
            <input type="file" id="image" name="image" accept="image/*" required>
            <textarea id="description" name="description" placeholder="Image Description" required></textarea>
            <button type="button" id="upload-button">Upload</button>
        </form>
        <div id="image-preview">
            <img id="image-display" src="" alt="Uploaded Image">
        </div>
    </div>
    <script>
        const imageInput = document.getElementById('image');
        const imageDisplay = document.getElementById('image-display');

        imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imageDisplay.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                imageDisplay.src = '';
            }
        });

        document.getElementById('upload-button').addEventListener('click', () => {
            const imageFile = imageInput.files[0];
            const description = document.getElementById('description').value;

            if (imageFile) {
                if (description.trim() === '') {
                    alert('Please add an image description.');
                } else {
                    const formData = new FormData();
                    formData.append('image', imageFile);
                    formData.append('description', description);

                    // Simulate the image upload process
                    setTimeout(() => {
                        // Redirect to the result page for image processing
                        window.location.href = 'result.html';
                    }, 2000);
                }
            } else {
                alert('Please select an image to upload.');
            }
        });
    </script>
</body>
</html>

