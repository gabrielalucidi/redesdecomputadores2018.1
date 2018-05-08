<?php

    // workaround to activate php error reporting
    error_reporting(E_ALL); ini_set('display_errors', '1');

    // open db connection
    require 'php/open_db_connection.php';

    // removes the current preferences of the user
    $sql = "DELETE FROM preference where user = 1;";
    if ($conn->query($sql) !== TRUE)
        echo "Error: " . $sql . "|" . $conn->error . "<br>";

    // inserts the new configurations
    $sql = "";
    foreach ($_POST as $key => $value) {
        $sql .= "INSERT INTO preference (user, setting, active) VALUES (1, '".$key."', '".$value."');"; // there's no need to use IGNORE on this insertion once there will be no preferences stored in the bd for this user
    }
    if ($sql != "" and $conn->multi_query($sql) !== TRUE)
        echo "Error: " . $sql . "<br>" . $conn->error;
    else
        header('Location: index.php');


    // close db connection
    require 'php/close_db_connection.php';
?>