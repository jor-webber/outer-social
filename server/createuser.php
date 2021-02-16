<?php

/**
 * 
 * createuser.php
 * Jordan Webber
 * 000803303
 * December 7, 2020
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This is the file that handles the AJAX request to create a new user. It
 * makes sure that all the important information is there and that there is a minimum
 * password length is 6 characters. Otherwise an error is sent back to the user
 */
include "connect.php";

$username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL);
$age = filter_input(INPUT_GET, "age", FILTER_VALIDATE_INT);

if ($username === "" || $password === "" || $email === null || $email === false) {
    echo "Error inputting user. Information missing";
} else if (strlen($password) < 6) {
    echo "Sorry!! Password is too short";
} else {

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    if ($age === null || $age === false) {

        $command = "INSERT INTO users(username, password, email) VALUES(?,?,?)";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute([$username, $hashPassword, $email]);

    } else {

        $command = "INSERT INTO users VALUES(?,?,?,?)";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute([$username, $hashPassword, $email, $age]);
        
    }

    if ($success) {
        echo $username . " has been added!\n<a href='index.php'>Click Here</a>" .
            " to log in!";
    } else {
        echo "Error imputting user. Please try again!";
    }
}
