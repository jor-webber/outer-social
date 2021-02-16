<?php
/**
 * Author: Jordan Webber, 000803303
 * Date: December 7, 2020
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * Purpose: The connection file used to connect to the database.
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=000803303",
        "000803303",
        "19940306"
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
?>