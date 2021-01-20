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
    /*include 'loggedincheck.php';
    if($_POST["userdict"]["admin"] == 0){
        header("Location: login.php");
    }*/

    try {
        $conn = new SQLITE3('databases/film.db');
        $fetch_string = "SELECT * FROM film where rowid = " . $_GET["filmid"];
        $fetch_query = $conn->query($fetch_string);

        $film = $fetch_query->fetchArray(SQLITE3_ASSOC);

    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }

    $titleError = $descError = $genreError = $writerError = $dirError = $prodError = $yearError = $lenError = $thumbError = $totalError = $update_error = "";
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
                $update_string = "UPDATE film 
                SET 
                    naslov = '$title',
                    opis = '$desc',
                    zanr = '$genre',
                    scenarista = '$writer',
                    reziser = '$dir',
                    producentska_kuca = '$prod',
                    godina_izdanja = $year,
                    trajanje = '$len',
                    thumbnail = '$thumb'
                WHERE
                    rowid = " . $_GET['filmid'];
                
                $fetch_query = $conn->exec($update_string);

                if($fetch_query){

                    $conn->close();

                    header("Location: filmlist.php");
                }
                else{
                    $update_error = "Error updating film";
                }
                
            }
            catch(PDOException $e) {
                $update_error = "Error updating film";
                echo $e->getMessage();
            }
        }

      }
    ?>
<div style="margin:0 auto; width:100%; height:100vh; display:inline-block; background-color: lightgray;">
        <form action="adminAlter.php?filmid=<?php echo($_GET["filmid"]);?>" method="post" style="min-width:250px; width:60%; margin:0 auto; background-color: white;">
            <div class="container-fluid" style="margin:0 auto; display:inline-block; width:100%; padding:20px;">
                <div class="row content">
                    <div class="col-sm-6">
                        <label for="title"><b>Title</b></label>
                        <input style="display: block;" name="title" value="<?php echo($film["naslov"]);?>" type="text" required>
                        <span style="color:red"><?php echo $titleError;?></span><br>
                        <label for="genre"><b>Genre</b></label>
                        <input style="display: block;" name="genre" value="<?php echo($film["zanr"]);?>" type="text" required>
                        <span style="color:red"><?php echo $genreError;?></span><br>
                    </div>
                    <div class="col-sm-6">
                        <label for="writer"><b>Writer</b></label>
                        <input style="display: block;" name="writer" value="<?php echo($film["scenarista"]);?>" type="text" required>
                        <span style="color:red"><?php echo $writerError;?></span><br>
                        <label for="dir"><b>Director</b></label>
                        <input style="display: block;" name="dir" value="<?php echo($film["reziser"]);?>" type="text" required>
                        <span style="color:red"><?php echo $dirError;?></span><br>
                    </div>
                </div>
                <div class="row content">
                    <div class="col-sm-6">
                        <label for="prod"><b>Production house</b></label>
                        <input style="display: block;" name="prod" value="<?php echo($film["producentska_kuca"]);?>" type="text" required>
                        <span style="color:red"><?php echo $prodError;?></span><br>
                        <label for="year"><b>Year</b></label>
                        <input style="display: block;" name="year" value="<?php echo($film["godina_izdanja"]);?>" type="number" required>
                        <span style="color:red"><?php echo $yearError;?></span><br>
                        
                    </div>
                    <div class="col-sm-6">
                        <label for="len"><b>Length</b></label>
                        <input style="display: block;" name="len" value="<?php echo($film["trajanje"]);?>" type="text" required>
                        <span style="color:red"><?php echo $lenError;?></span><br>
                        <label for="thumb"><b>Thumbnail</b></label>
                        <input style="display: block;" name="thumb" value="<?php echo($film["thumbnail"]);?>" type="text" required>
                        <span style="color:red"><?php echo $thumbError;?></span><br>
                    </div>
                    <div class="row content">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 content-center ">
                            <label for="desc"><b>Description</b></label>
                            <textarea rows="10" cols="40" style="display: block;" name="desc"><?php echo($film["opis"]);?></textarea>
                            <span style="color:red"><?php echo $descError;?></span><br>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
                <div class="row content text-center">
                    <br>
                    <button type="submit">Update</button>
                </div>
                <hr>
                <p class="text-center"><a href="filmlist.php">Films list</a></p>
            </div>
        </form>
    </div>
</body>
</html>