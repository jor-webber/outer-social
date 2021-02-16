<?php
/**
 * updateuserpost.php
 * Jordan Webber
 * 000803303
 * December 12, 2020
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This file updates the post that the user wanted to edit that they own.
 * It changes the post to the new updated post then chose.
 */
session_start();
include "connect.php";

if (!isset($_SESSION["username"])) {
    die("ERROR! Session has ended");
} else {
    $postId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    $updatedPost = filter_input(INPUT_GET, "post", FILTER_SANITIZE_STRING);

    if ($postId === null || $postId === false || $updatedPost === "") {
        die("ERROR! Post id error with GET parameter");
    }

    $command = "UPDATE usersposts SET post = ? WHERE post_id = ?";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute([$updatedPost , $postId]);

    if($success) {
        echo "Post was updated!";
    } else {
        echo -1;
    }
}