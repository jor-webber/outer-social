<?php

/**
 * 
 * update.php
 * Jordan Webber
 * 000803303
 * December 10, 2020
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This program displays the post that the user would like to edit with the
 * current post in the text box and allows them to edit it then submit it which
 * will update their post with the new post.
 */
session_start();
include "server/connect.php";

if (!isset($_SESSION["username"])) {
    die("ERROR! Session has ended");
} else {
    $postId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    if ($postId === null || $postId === false) {
        die("ERROR! Post id error with GET parameter");
    }

    $command = "SELECT * FROM usersposts WHERE post_id = ?";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute([$postId]);

    if ($success) {
        $row = $stmt->fetch();
        $username = $row["username"];
    }

    if ($_SESSION["username"] !== $username) {
        die("ERROR! You are not the owner of this post! unable to edit.");
    }
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainstyles.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/mainpages.js"></script>
    <title>Outer Social</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="title">Outer Social</li>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a id="logout" href="index.php">Log out</a></li>
                <input type="text" name="searchBar" id="searchBar" placeholder="Search">
            </ul>
        </nav>
    </header>
    <main>
        <form id="updatePostForm">
            <fieldset>
                <label class="formTitle">Update Post</label>
            </fieldset>
            <fieldset>
                <textarea placeholder="Enter post here..." maxLength="250" id="updatedPost"><?= $row["post"] ?></textarea>
                <br>
                <label id="characterCount">250 characters remaining</label>
                <input type="hidden" id="idField" value="<?= $postId ?>">
            </fieldset>
            <fieldset>
                <div>
                    <input class='button' type="submit" value="Update Post">
                </div>
            </fieldset>
        </form>
    </main>
    <footer>
        <p>&#169 Jordan Webber 2020</p>
    </footer>
</body>