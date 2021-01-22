<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create film</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    </style>
</head>
<body>
<?php 
    session_start();
    /*include 'loggedincheck.php';
    
    if($_POST["userdict"]["admin"] == 0){
        header("Location: login.php");
    }*/
    
    $titleError = $descError = $genreError = $writerError = $dirError = $prodError = $yearError = $lenError = $thumbError = $totalError = $insert_error = "";
    $title = $desc = $genre = $writer = $dir = $prod = $year = $len = $thumb = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["title"])) {
            $titleError = "Input title";
            $totalError = 'error';
        } 
        else {
            $title = trim($_POST["title"]);
        }

        if (empty($_POST["desc"])) {
            $descError = "Input description";
            $totalError = 'error';
        } 
        else {
            $desc = trim($_POST["desc"]);
        }

        if (empty($_POST["genre"])) {
            $genreError = "Input genre";
            $totalError = 'error';
        } 
        else {
            $genre = trim($_POST["genre"]);
        }

        if (empty($_POST["writer"])) {
            $writerError = "Input writer";
            $totalError = 'error';
        } 
        else {
            $writer = trim($_POST["writer"]);
        }

        if (empty($_POST["dir"])) {
            $dirError = "Input director";
            $totalError = 'error';
        } 
        else {
            $dir = trim($_POST["dir"]);
        }

        if (empty($_POST["prod"])) {
            $prodError = "Input production house";
            $totalError = 'error';
        } 
        else {
            $prod = trim($_POST["prod"]);
        }

        if (empty($_POST["year"])) {
            $yearError = "Input year";
            $totalError = 'error';
        } 
        else {
            $year = trim($_POST["year"]);
        }

        if (empty($_POST["len"])) {
            $lenError = "Input length";
            $totalError = 'error';
        } 
        else {
            $len = trim($_POST["len"]);
        }

        if (empty($_POST["thumb"])) {
            $thumbError = "Input thumbnail";
            $totalError = 'error';
        } 
        else {
            $thumb = trim($_POST["thumb"]);
        }

        if($totalError == ""){
            try {
                $conn = new SQLITE3('databases/film.db');
                $insert_string = "INSERT INTO film(naslov,opis,zanr,scenarista,reziser,producentska_kuca,godina_izdanja,trajanje,thumbnail) VALUES('"
                        . $title . "','" .  $desc . "','" .  $genre . "','" .  $writer . "','" . $dir . "','" . $prod . "'," . $year . ",'" . $len . "','" . $thumb . "')";
                $fetch_query = $conn->exec($insert_string);

                if($fetch_query){
                    unset($_POST["title"]);
                    unset($_POST["desc"]);
                    unset($_POST["genre"]);
                    unset($_POST["writer"]);
                    unset($_POST["dir"]);
                    unset($_POST["prod"]);
                    unset($_POST["year"]);
                    unset($_POST["len"]);
                    unset($_POST["thumb"]);

                    header("Location: filmlist.php");
                }
                else{
                    $insert_error = "Error inserting film";
                }
                
            }
            catch(PDOException $e) {
                $insert_error = "Error inserting film";
                echo $e->getMessage();
            }
        }

      }
    ?>
<div style="margin:0 auto; width:100%; height:100vh; display:inline-block; background-color: lightgray;">
        <form action="adminCreate.php" method="post" style="min-width:250px; width:60%; margin:0 auto; background-color: white;">
            <div class="container-fluid" style="margin:0 auto; display:inline-block; width:100%; padding:20px;">
                <div class="row content">
                    <div class="col-sm-6">
                        <label for="title"><b>Title</b></label>
                        <input style="display: block;" name="title" placeholder="Title" type="text" required>
                        <span style="color:red"><?php echo $titleError;?></span><br>
                        <label for="genre"><b>Genre</b></label>
                        <input style="display: block;" name="genre" placeholder="Genre" type="text" required>
                        <span style="color:red"><?php echo $genreError;?></span><br>
                    </div>
                    <div class="col-sm-6">
                        <label for="writer"><b>Writer</b></label>
                        <input style="display: block;" name="writer" placeholder="Writer" type="text" required>
                        <span style="color:red"><?php echo $writerError;?></span><br>
                        <label for="dir"><b>Director</b></label>
                        <input style="display: block;" name="dir" placeholder="Director" type="text" required>
                        <span style="color:red"><?php echo $dirError;?></span><br>
                    </div>
                </div>
                <div class="row content">
                    <div class="col-sm-6">
                        <label for="prod"><b>Production house</b></label>
                        <input style="display: block;" name="prod" placeholder="Production house" type="text" required>
                        <span style="color:red"><?php echo $prodError;?></span><br>
                        <label for="year"><b>Year</b></label>
                        <input style="display: block;" name="year" placeholder="Year" type="number" required>
                        <span style="color:red"><?php echo $yearError;?></span><br>
                        
                    </div>
                    <div class="col-sm-6">
                        <label for="len"><b>Length</b></label>
                        <input style="display: block;" name="len" placeholder="Length" type="text" required>
                        <span style="color:red"><?php echo $lenError;?></span><br>
                        <label for="thumb"><b>Thumbnail</b></label>
                        <input style="display: block;" name="thumb" placeholder="Thumbnail" type="text" required>
                        <span style="color:red"><?php echo $thumbError;?></span><br>
                    </div>
                    <div class="row content">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 content-center ">
                            <label for="desc"><b>Description</b></label>
                            <textarea rows="10" cols="40" style="display: block;" name="desc">Description</textarea>
                            <span style="color:red"><?php echo $descError;?></span><br>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
                <div class="row content text-center">
                    <br>
                    <button type="submit">Create</button>
                </div>
                <hr>
                <p class="text-center"><a href="filmlist.php">Films list</a></p>
            </div>
        </form>
    </div>
</body>
</html>