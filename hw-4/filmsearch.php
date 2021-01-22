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
<?php
        try {
            $search_term = isset($_GET["searchterm"])? $_GET["searchterm"]:"";
            $conn = new SQLITE3('databases/film.db');
            $pagesize = 10;
            $pagenum = isset($_GET["page"])? $_GET["page"]:1;
            $select_all_string = "SELECT COUNT(*) AS numrows FROM film WHERE naslov LIKE '%" . $search_term . "%'";
            $total_query = $conn->query($select_all_string);
            $total_rows = $total_query? $total_query->fetchArray(SQLITE3_ASSOC)['numrows']:0;

            $conn->close();
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            $conn->close();
        }
        ?>
<div class="container-fluid" style="position:absolute; margin-top:0; padding:0;">  
    <div class="row content" style="width:100vw;">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3"></div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6" style="background-color:rgb(255, 255, 255);margin-top:0;">
        <h3>Films:</h3>
        <?php 
        if($pagenum > 1) echo("<a href='filmsearch.php?searchterm=$search_term&page=" . ($pagenum-1) ."'><span class='glyphicon 
        glyphicon-arrow-left'></span> Previous</a>");
        if($total_rows > $pagenum * $pagesize) echo("<a style='position:absolute; right:10px;' href='filmsearch.php?searchterm=$search_term&page=" . ($pagenum+1) ."'>
        Next <span class='glyphicon glyphicon-arrow-right'></span></a>");
        ?>
        <br>
        <hr>
        <?php
        try{
            $conn = new SQLITE3('databases/film.db');
            $select_string = "SELECT * FROM film WHERE naslov LIKE '%" . $search_term . "%' LIMIT $pagesize OFFSET " . ($pagenum-1)*$pagesize;
            $fetch_query = $conn->query($select_string);
            while($film = $fetch_query->fetchArray(SQLITE3_ASSOC)){
                echo("<div class='row' style='height:90px; width:100%; display:inline-block; border-bottom:1px solid black;'>");
                echo("<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>");
                echo("<img class='img-responsive' style='height:80px;' src='" . $film["thumbnail"] . "'>");
                echo("</div>");
                echo("<div class='col-xs-8 col-sm-8 col-md-8 col-lg-8'>");
                echo("<a href='filmpage.php?filmid=" . $film['filmid'] . "'>" . $film["naslov"] . "</a>");
                echo("</div>");
                echo("<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>");
                echo("<b>" . "Ocena" . "</b>");
                echo("</div>");
                echo("</div>");
            }

            $conn->close();
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            $conn->close();
        }
        ?>
        </div>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3"></div>
    </div>
</div>
</body>
</html>