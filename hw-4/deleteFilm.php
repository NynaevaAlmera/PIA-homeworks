<?php
session_start();
if($_SESSION["userdict"]["admin"]){
    try {
        $conn = new SQLITE3('databases/film.db');
        $foreign_string = "PRAGMA foreign_keys = ON;";
        $conn->exec($foreign_string);
        
        $delete_string = "DELETE FROM film WHERE filmid = " . $_GET["filmid"];
        $conn->exec($delete_string);
        $conn->close();
    }
    catch(PDOException $e) {
        $insert_error = "Error inserting film";
        $_SESSION['error'] = $e->getMessage();
        $conn->close();
    }
    
}


?>