<?php
try {
    $conn = new SQLITE3('databases/film.db');
    $select_string = "SELECT * FROM film";
    $fetch_query = $conn->query($select_string);

    while($res = $fetch_query->fetchArray(SQLITE3_ASSOC)){
        var_dump($res);
    }

    echo("\nGlumci:\n");

    $select_string = "SELECT * FROM glumci";
    $fetch_query = $conn->query($select_string);

    while($res = $fetch_query->fetchArray(SQLITE3_ASSOC)){
        var_dump($res);
    }

    echo("\nOcene:\n");

    $select_string = "SELECT * FROM ocene";
    $fetch_query = $conn->query($select_string);

    while($res = $fetch_query->fetchArray(SQLITE3_ASSOC)){
        var_dump($res);
    }

    echo("changeScore.php?filmid=1&email=thetwilightenvoy@gmail.com&rating=6");
    
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>