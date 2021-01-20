<?php

try {
    $conn = new SQLITE3('databases/film.db');
    $delete_string = "DELETE FROM film WHERE rowid = " . $_GET["filmid"];
    $conn->exec($delete_string);
}
catch(PDOException $e) {
    $insert_error = "Error inserting film";
    echo $e->getMessage();
}


?>