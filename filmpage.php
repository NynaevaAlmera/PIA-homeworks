<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb sajt</title>
    <link rel="stylesheet" type="text/css" href="filmlist.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'topbar.php';?>
<div class="container-fluid" style="position:absolute; margin-top:0; padding:0;">  
    <div class="row content" style="width:100vw;">
        <div class="col-sm-3"></div>
        <div class="col-sm-6" style="background-color:rgb(255, 255, 255);margin-top:0;">
            <h3 style="display: inline-block;"><?php 
            
            try {
                $conn = new SQLITE3('databases/film.db');
                $fetch_string = "SELECT * FROM film where rowid = " . $_GET["filmid"];
                $fetch_query = $conn->query($fetch_string);

                $titles_array = $fetch_query->fetchArray(SQLITE3_ASSOC);
                echo($titles_array["naslov"]);
                
            }
            catch(PDOException $e) {
                echo "GRESKA: ";
                echo $e->getMessage();
            }

            ?></h3>
            <h4 style="display: inline-block;"><?php echo("&nbsp(" . $titles_array["godina_izdanja"] . ")");?></h4>
            <h5><?php echo($titles_array["trajanje"] . " | " . $titles_array["zanr"] . " | rated such and such by this many users");?></h5>
            
            <hr>
            <div class="row content">
                <div class="col-sm-4"><?php echo("<img style='width:100%;overflow:hidden;' src='" . $titles_array["thumbnail"] . "'>");?></div>
                <div class="col-sm-8"><?php echo("<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $titles_array["opis"] . "</p>");?></div>
            </div>
            <hr>
            <p><b>Director: </b><?php echo("<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $titles_array["reziser"] . "</p>");?></p>
            <p><b>Screenwriter: </b><?php echo("<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $titles_array["scenarista"] . "</p>");?></p>
            <p><b>Producent: </b><?php echo("<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $titles_array["producentska_kuca"] . "</p>");?></p>

        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
</body>
</html>