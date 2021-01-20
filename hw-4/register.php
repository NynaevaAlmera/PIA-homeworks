<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    </style>
</head>
<body>
    <?php 
    $usernameError = $passError = $firstNameError = $lastNameError = $emailError = $totalError = "";
    $username = $pass = $firstName = $lastName = $email = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameError = "Input username";
            $totalError = 'error';
        } 
        else {
            $username = trim($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
              $usernameError = "Alphanumeric characters only";
              $totalError = 'error';
            }
        }

        if (empty($_POST["pass"])) {
            $passError = "Input username";
            $totalError = 'error';
        } 
        else {
            $pass = trim($_POST["pass"]);
            if (!preg_match("/^[a-zA-Z0-9]*$/",$pass)) {
              $passError = "Alphanumeric characters only";
              $totalError = 'error';
            }
            else{
                if(strlen($pass)<8){
                    $passError = "Password min. 8 characters";
                    $totalError = 'error';
                }
            }
        }

        if (empty($_POST["firstName"])) {
          $firstNameError = "Input first name";
          $totalError = 'error';
        } 
        else {
          $firstName = trim($_POST["firstName"]);
          if (!preg_match("/^[a-zA-Z-']*$/",$firstName)) {
            $firstNameError = "Invalid characters in first name";
            $totalError = 'error';
          }
        }

        if (empty($_POST["lastName"])) {
            $lastNameError = "Input last name";
            $totalError = 'error';
        } 
        else {
            $lastName = trim($_POST["lastName"]);
            if (!preg_match("/^[a-zA-Z-']*$/",$lastName)) {
              $lastNameError = "Invalid characters in last name";
              $totalError = 'error';
            }
        }
        
        if (empty($_POST["email"])) {
          $emailError = "Input email";
          $totalError = 'error';
        } 
        else {
          $email = trim($_POST["email"]);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Input valid email address";
            $totalError = 'error';
          }
        }

        if($totalError == ""){
            try {
                $conn = new SQLITE3('databases/film.db');
                $fetch_string = "SELECT * FROM korisnici where email = '" . $email . "'";
                $fetch_query = $conn->query($fetch_string);

                

                if($result_array = $fetch_query->fetchArray()){
                    $emailError = "Email taken";
                }
                else{
                    $fetch_string = "SELECT * FROM korisnici where username = '" . $username . "'";
                    $fetch_query = $conn->query($fetch_string);
                    if($result_array = $fetch_query->fetchArray()){
                        $usernameError = "Username taken";
                    }
                    else{
                        $insert_string = "INSERT INTO korisnici VALUES('"
                        . $firstName . "','" .  $lastName . "','" .  $email . "','" .  hash('sha256', $pass) . "','" .  $username . "'," .  '0)';
                        $fetch_query = $conn->exec($insert_string);

                        unset($_POST["firstname"]);
                        unset($_POST["lastname"]);
                        unset($_POST["username"]);
                        unset($_POST["pass"]);
                        unset($_POST["email"]);

                        $POST["userdict"] = array(
                            "firstname" => $firstName,
                            "lastname" => $lastName,
                            "username" => $username,
                            "email" => $email,
                            "admin" => 0
                        );

                        header("Location: filmlist.php");
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
        <form action="register.php" method="post" style="min-width:250px; width:60%; margin:10vh auto; background-color: white;">
            <div class="container-fluid" style="margin:0 auto; display:inline-block; width:100%; padding:20px;">
                <div class="row content">
                    <img src="pics/imdblogo.png" style="width: 50%; margin:0 auto; display:block;">
                    <br>
                </div>
                <div class="row content">
                    <div class="col-sm-6">
                        <label for="username"><b>Username</b></label>
                        <input style="display: block;" name="username" placeholder="Username" type="text" required>
                        <span style="color:red"><?php echo $usernameError;?></span><br>
                        <label for="email"><b>Email address</b></label>
                        <input style="display: block;" name="email" placeholder="Email" type="text" required>
                        <span style="color:red"><?php echo $emailError;?></span><br>
                        <label for="pass"><b>Password</b></label>
                        <input style="display: block;" name="pass" placeholder="Password" type="password" required>
                        <span style="color:red"><?php echo $passError;?></span><br>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName"><b>First Name</b></label>
                        <input style="display: block;" name="firstName" placeholder="First Name" type="text" required>
                        <span style="color:red"><?php echo $firstNameError;?></span><br>
                        <label for="lastName"><b>Last Name</b></label>
                        <input style="display: block;" name="lastName" placeholder="Last Name" type="text" required>
                        <span style="color:red"><?php echo $lastNameError;?></span><br>
                    </div>
                </div>
                <div class="row content text-center">
                    <br>
                    <button type="submit">Register</button>
                </div>
                <hr>
                Already have an account? Login <a href="login.php">here</a>
            </div>
        </form>
    </div>




</body>
</html>