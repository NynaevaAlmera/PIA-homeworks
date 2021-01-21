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
<?php 
    session_start();
    $userMailError = $passError = $totalError = "";
    $username = $pass = $firstName = $lastName = $email = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["usernameOrEmail"])) {
            $userMailError = "Input username or email";
            $totalError = 'error';
        } 
        else {
            $usernameOrEmail = trim($_POST["usernameOrEmail"]);
        }
        if (empty($_POST["pass"])) {
            $passError = "Input username or email";
            $totalError = 'error';
        } 
        else {
            $pass = trim($_POST["pass"]);
        }

        if($totalError == ""){
            try {
                $conn = new SQLITE3('databases/film.db');
                $fetch_string = "SELECT * FROM korisnici where username = '" . $usernameOrEmail . "'";
                $fetch_query = $conn->query($fetch_string);
    
                if(!($result_array = $fetch_query->fetchArray())){
                    $fetch_string = "SELECT * FROM korisnici where email = '" . $usernameOrEmail . "'";
                    $fetch_query = $conn->query($fetch_string);
                    if(!($result_array = $fetch_query->fetchArray())){
                        $userMailError = "Incorrect username or email";
                    }
                }
                if($userMailError == ""){
                    $hashed_pass = $result_array["password"];
                    if($hashed_pass == hash("sha256", $pass)){
                        $_SESSION["userdict"] = array(
                            "firstname" => $result_array["first_name"],
                            "lastname" => $result_array["last_name"],
                            "username" => $result_array["username"],
                            "email" => $result_array["email"],
                            "admin" => $result_array["admin_status"]
                        );

                        unset($_POST["usernameOrEmail"]);
                        unset($_POST["pass"]);

                        //var_dump($_SESSION["userdict"]);

                        header("Location: filmlist.php");
                    }
                    else{
                        $passError = "Incorrect password";
                    }
                }
                
            }
            catch(PDOException $e) {
                echo "GRESKA: ";
                echo $e->getMessage();
            }
        }

      }
    ?>
    <div style="margin:0 auto; width:100%; height:100vh; display:inline-block; background-color: lightgray;">
        <form action="login.php" method="post" style="min-width:250px; width:30%; margin:10vh auto; background-color: white;">
            <div style="margin:0 auto; display:inline-block; width:100%; padding:20px;">
                <img src="pics/imdblogo.png" style="width: 50%; margin:0 auto; display:block;">
                <br>
                <label for="usernameOrEmail"><b>Username or Email</b></label>
                <input style="display: block;" name="usernameOrEmail" placeholder="Name or Email Address" type="text" required>
                <span style="color:red"><?php echo $userMailError;?></span><br>
                <label for="pass"><b>Password</b></label>
                <input style="display: block;" name="pass" placeholder="Password" type="password" required>
                <span style="color:red"><?php echo $passError;?></span><br>
                <button type="submit">Login</button>
                
                <hr>
                Don't have an account? Register <a href="register.php">here</a>
            </div>
        </form>
    </div>




</body>
</html>