<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        
        .container {
            max-width: 600px;
            height: 600px;
            margin: 0 auto;
            margin-top: 100px;
            margin-bottom: 350px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        #upload-form {
            margin: 20px 0;
        }

        #file-input {
            display: none;
        }

        label[for="file-input"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #selected-file {
            margin-top: 10px;
        }

        #preview {
            max-width: 100%;
            margin-top: 20px;
        }

        #description {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container">
        <h1>Image Upload Page</h1>
        <form id="upload-form" enctype="multipart/form-data" action="upload.php" method="post">
            <input type="file" id="file-input" name="image" accept="image/*" />
            <label for="file-input">Select Image</label>
            <p id="selected-file">No file selected</p>
            <textarea id="description" name="description" placeholder="Enter a description for the image"></textarea>
            <img id="preview" src="#" alt="Preview" style="display: none;">
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('file-input');
        const selectedFile = document.getElementById('selected-file');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function () {
            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                selectedFile.textContent = `Selected file: ${fileName}`;

                // Display a preview of the selected image
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                selectedFile.textContent = 'No file selected';
                preview.style.display = 'none';
            }
        });
    </script>

<?php include 'footer.php'; ?>
</body>
</html>
