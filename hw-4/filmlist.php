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
<?php //include 'loggedincheck.php';?>
<?php include 'topbar.php';?>
<div class="container-fluid" style="position:absolute; margin-top:0; padding:0;">  
    <div class="row content" style="width:100vw;">
        <div class="col-sm-3"></div>
        <div class="col-sm-6" style="background-color:rgb(255, 255, 255);margin-top:0;">
        <h3>Films:</h3>
        <hr>
        <?php
        try {
            $conn = new SQLITE3('databases/film.db');
            $select_string = "SELECT *, rowid FROM film";
            $fetch_query = $conn->query($select_string);

            while($res = $fetch_query->fetchArray(SQLITE3_ASSOC)){
                echo("<div class='row content' style='height=50px;'>");
            }
            
        }
        catch(PDOException $e) {
            $insert_error = "Error inserting film";
            echo $e->getMessage();
        }
        ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
</body>
</html>