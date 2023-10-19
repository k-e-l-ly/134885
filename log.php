<?php
include('connect.php');


?>

<!DOCTYPE html>
<html>
    <head>
        <title>The Login Page</title>
    </head>

    <body>

    <centre>

        <p>Login</p>
        
        <form>
            <input type = "text" id = "user" name = "username" placeholder = "Username"/><br><br>
            <input type = "text" id = "password" name = "password" placeholder = "password"/><br><br>
            <button type = "submit" id = "btn" name = "login" default>Login</button><br><br>
        </form>

    </centre>

    </body>
</html>