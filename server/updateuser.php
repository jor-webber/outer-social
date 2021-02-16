<?php

/**
 * updateuser.php
 * Jordan Webber
 * 000803303
 * December 12, 2020
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This program will handle the AJAX request to update the users information.
 */
session_start();
include "connect.php";

// Checking to make sure the session is still on
if (!isset($_SESSION["username"])) {
    echo -1;
} else {
    $username = $_SESSION["username"];
    $email = filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL);
    $age = filter_input(INPUT_GET, "age", FILTER_VALIDATE_INT);
    $oldPassword = filter_input(INPUT_GET, "oldpassword", FILTER_SANITIZE_STRING);
    $newPassword = filter_input(INPUT_GET, "newpassword", FILTER_SANITIZE_STRING);

    // if email is not filled in then it will not work
    if ($email === false || $email === null) {
        echo -1;
    } else if ($oldPassword === "" || $newPassword === "") {

        $command = "UPDATE users SET email = ?, age = ? WHERE username = ?";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute([$email, $age, $username]);

        if ($success) {
            $user = [
                "username" => $username,
                "email" => $email,
                "age" => $age
            ];

            echo json_encode($user);
        } else {
            echo -1;
        }
    } else {

        $command = "SELECT * FROM users WHERE username = ?";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute([$username]);

        if ($success) {
            $row = $stmt->fetch();
            $hashPassword = $row["password"];
        } 

        if (password_verify($oldPassword, $hashPassword)) {
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $command = "UPDATE users SET email = ?, age = ?, password = ? WHERE username = ?";
            $stmt = $dbh->prepare($command);
            $success = $stmt->execute([$email, $age, $newHash, $username]);

            if ($success) {
                $user = [
                    "username" => $username,
                    "email" => $email,
                    "age" => $age
                ];

                echo json_encode($user);
            } else {
                echo -1;
            }
        } else {
            echo -2;
        }
    }
}
