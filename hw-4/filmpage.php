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

    <?php //include 'loggedincheck.php';?>

    <script>
    function deleteFilm(filmid) {
        var del = confirm("Delete this film?");
        if(del === true){
            var request = new XMLHttpRequest();
            request.open("GET", "deleteFilm.php?filmid="+filmid, true);
            request.send();   
            window.location.replace("filmlist.php");    
        }
    }
    function rated() {
        d = document.getElementById("rating").value;
        var request = new XMLHttpRequest();
        request.open("GET", "changeScore.php?filmid=<?php echo($_GET["filmid"]);?>&email=<?php 
        //echo($_SESSION["userdict"]["email"]);
        
        echo("thetwilightenvoy@gmail.com");
        
        ?>&rating="+d, true);
        request.send();  
    }
    </script>
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
                $fetch_string = "SELECT * FROM film where filmid = " . $_GET["filmid"];
                $fetch_query = $conn->query($fetch_string);

                $titles_array = $fetch_query->fetchArray(SQLITE3_ASSOC);
                $fetch_string = "SELECT * FROM ocene where film_id = " . $_GET["filmid"];
                $fetch_query = $conn->query($fetch_string);

                $numOfRatings = 0;
                $totalScore = 0;
                while($next_rating = $fetch_query->fetchArray(SQLITE3_ASSOC)){
                    $numOfRatings++;
                    $totalScore += $next_rating["rating"];
                }
                if($numOfRatings > 0){
                    $avgRating = $totalScore / $numOfRatings;
                }
                else{
                    $avgRating = 0;
                }
                echo($titles_array["naslov"]);
                $conn->close();
            }
            catch(PDOException $e) {
                echo "GRESKA: ";
                echo $e->getMessage();
                $conn->close();
            }

            ?></h3>
            <h4 style="display: inline-block;"><?php echo("&nbsp(" . $titles_array["godina_izdanja"] . ")");?></h4>
            <h5><?php echo($titles_array["trajanje"] . " | " . $titles_array["zanr"] . " | Rating <b>" . $avgRating . "/10</b>, from " . $numOfRatings . " users");?></h5>

            <?php 
            try {
                $conn = new SQLITE3('databases/film.db');
                $fetch_string = "SELECT * FROM ocene where film_id = " . $_GET["filmid"] . " AND user_email = '" . "thetwilightenvoy@gmail.com" . "'";
                $fetch_query = $conn->query($fetch_string);

                $ratings_array = $fetch_query->fetchArray(SQLITE3_ASSOC);

                $rating = null;
                if(!$ratings_array) $rating = null;
                else $rating = $ratings_array['rating'];
                $conn->close();
            }
            catch(PDOException $e) {
                echo "GRESKA: ";
                echo $e->getMessage();
                $conn->close();
            }
            ?>

            <b>Your score: </b><select onchange="rated()" id="rating" name="">
                <option <?php if($rating == 1) echo("selected");?> value="1">1</option>
                <option <?php if($rating == 2) echo("selected");?> value="2">2</option>
                <option <?php if($rating == 3) echo("selected");?> value="3">3</option>
                <option <?php if($rating == 4) echo("selected");?> value="4">4</option>
                <option <?php if($rating == 5) echo("selected");?> value="5">5</option>
                <option <?php if($rating == 6) echo("selected");?> value="6">6</option>
                <option <?php if($rating == 7) echo("selected");?> value="7">7</option>
                <option <?php if($rating == 8) echo("selected");?> value="8">8</option>
                <option <?php if($rating == 9) echo("selected");?> value="9">9</option>
                <option <?php if($rating == 10) echo("selected");?> value="10">10</option>
                <option <?php if(!$rating) echo("selected");?> value="Unrated">Unrated</option>
            </select>      

            <br><br>
            
            <a style="color: black;" href="<?php echo('adminAlter.php?filmid=' . $titles_array['filmid']);?>"><button type="button">Alter Film</button></a>
            <button type="button" onclick="deleteFilm(<?php echo($titles_array['filmid']);?>)">Delete Film</button>
            
            <hr>
            <div class="row content">
                <div class="col-sm-4"><?php echo("<img style='width:100%;overflow:hidden;' src='" . $titles_array["thumbnail"] . "'>");?></div>
                <div class="col-sm-8"><?php echo("<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $titles_array["opis"] . "</p>");?></div>
            </div>
            <hr>
            <p><b>Director: </b><?php echo("<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $titles_array["reziser"] . "</p>");?></p>
            <p><b>Screenwriter: </b><?php echo("<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $titles_array["scenarista"] . "</p>");?></p>
            <p><b>Producent: </b><?php echo("<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $titles_array["producentska_kuca"] . "</p>");?></p>
            <p><b>Actors: </b><p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php 
            try {
                $conn = new SQLITE3('databases/film.db');
                $select_string = "SELECT actor FROM glumci WHERE film_id = " . $titles_array['filmid'];
                $fetch_query = $conn->query($select_string);
            
                $res = $fetch_query->fetchArray(SQLITE3_ASSOC);
                while($res){
                    echo($res["actor"]);
                    $res = $fetch_query->fetchArray(SQLITE3_ASSOC);
                    echo($res? ', ':'');
                }
            
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            ?></p></p>

        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
</body>
</html>