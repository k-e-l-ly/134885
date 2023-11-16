<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Page Title</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0; /* Remove default margin */
        }

        /* Header styling */
        header {
            background-color: #333;
            padding: 10px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        header a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid white;
            border-radius: 5px;
        }

        /* Float four columns side by side */
        .column {
            float: left;
            width: 25%;
            padding: 0 10px;
            padding-top: 30px; /* Adjusted top padding */
        }

        /* Remove extra left and right margins, due to padding in columns */
        .row {
            margin: 0 -5px;
            align-items: center;
            justify-content: center;
            display: flex;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 16px;
            text-align: center;
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Responsive columns - one column layout (vertical) on small screens */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                height: 180px;
                display: block;
                margin-bottom: 20px;
            }
        }

        /* Style for the text area */
        .text-display {
            text-align: center;
            padding: 20px;
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <h1>Eye Test</h1>
    <div>
        <a href="#">Login</a>
        <a href="#">Register</a>
    </div>
</header>

<!-- Text area for display -->
<div class="text-display">
    <p>Who will you be joining us as?</p>
</div>

<!-- Cards with clickable text -->
<div class="row">
    <div class="column">
        <a href="admin_page.html">
            <div class="card">Admin</div>
        </a>
    </div>
    <div class="column">
        <a href="user_page.html">
            <div class="card">User</div>
        </a>
    </div>
</div>

</body>
</html>
