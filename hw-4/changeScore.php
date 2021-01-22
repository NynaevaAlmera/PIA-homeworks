<?php
try {
    $conn = new SQLITE3('databases/film.db');
    $fetch_string = "SELECT * FROM ocene where film_id = " . $_GET["filmid"] . " AND user_email = '" . $_GET['email'] . "'";
    $fetch_query = $conn->query($fetch_string);

    var_dump($fetch_string);

    $ratings_array = $fetch_query->fetchArray(SQLITE3_ASSOC);
    $rating = null;
    if(!$ratings_array) {
        $update_string = "INSERT INTO ocene(film_id, user_email, rating) VALUES
        (" . $_GET["filmid"] . ",'" . $_GET['email'] . "'," . intval($_GET["rating"]) . ")";
        
    var_dump($update_string);
    echo("INSERT INTO ocene(film_id, user_email, rating) VALUES
    (" . $_GET["filmid"] . ",'" . $_GET['email'] . "'," . intval($_GET["rating"]) . ")");
        $fetch_query = $conn->exec($update_string);
    }
    else {
        $update_string = "UPDATE ocene 
        SET 
            rating = " . $_GET['rating'] . "
        WHERE
            film_id = " . $_GET['filmid'] . " AND user_email = '" . $_GET["email"] . "'";
            var_dump($update_string);
        
        $fetch_query = $conn->exec($update_string);
    }


    $conn->close();
}
catch(PDOException $e) {
    $update_error = "Error updating film";
    echo $e->getMessage();
    $conn->close();
}
?>