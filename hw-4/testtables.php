<?php
try {
    $conn = new SQLITE3('databases/film.db');
    $select_string = "SELECT *, rowid FROM film";
    $fetch_query = $conn->query($select_string);

    while($res = $fetch_query->fetchArray(SQLITE3_ASSOC)){
        var_dump($res);
    }
    
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>