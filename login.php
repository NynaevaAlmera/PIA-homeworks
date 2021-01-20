<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    </style>
</head>
<body>
    <div style="margin:0 auto; width:100%; height:100vh; display:inline-block; background-color: lightgray;">
        <form action="login.php" method="post" style="min-width:250px; width:30%; margin:10vh auto; background-color: white;">
            <div style="margin:0 auto; display:inline-block; width:100%; padding:20px;">
                <img src="pics/imdblogo.png" style="width: 50%; margin:0 auto; display:block;">
                <br>
                <label for="usernameOrEmail"><b>Username or Email</b></label>
                <input style="display: block;" name="usernameOrEmail" placeholder="Name or Email Address" type="text" required><br>
                <label for="pass"><b>Password</b></label>
                <input style="display: block;" name="pass" placeholder="Password" type="password" required><br>
                <button type="submit">Login</button>
                
                <hr>
                Don't have an account? Register <a href="register.php">here</a>
            </div>
        </form>
    </div>




</body>