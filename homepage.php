<?php

/**
 * homepage.php
 * Jordan Webber
 * 000803303
 * December 7, 2020
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This is the home page for the user when the log in. It checks their credentials when they
 * log in and make sure the user name and password is correct. It then displays all the 
 * posts in the database table and gives the user the ability to edit or delete posts that
 * belong to them.
 */
session_start();
include "server/connect.php";

if (!isset($_SESSION["username"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

    if ($username === null || $password === null || $username === "" || $password === null) {
        die("Oops, error with login information <a href='index.php'>Click here</a> to try again!'");
    } else {
        $command = "SELECT username, password FROM users WHERE username = ?";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute([$username]);

        if ($success && ($row = $stmt->fetch()) != null) {
            $hash = $row["password"];
            if (password_verify($password, $hash)) {
                $_SESSION["username"] = $username;
            } else {
                die("Oops, sorry there was an error with the credentials given\n" .
                    "Please <a href='index.php'>Click here</a> to try again!");
            }
        } else {
            die("Oops, sorry there was an error with the credentials given\n" .
                "Please <a href='index.php'>Click here</a> to try again!");
        }
    }
}

$command = "SELECT * FROM usersposts ORDER BY date_time DESC";
$stmt = $dbh->prepare($command);
$success = $stmt->execute();

?>
<!DOCTYPE html>
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
                <li><a if="logout" href="index.php">Log out</a></li>
                <input type="text" name="searchBar" id="searchBar" placeholder="Search">
            </ul>
        </nav>
    </header>
    <main>
        <form id="addPostForm">
            <fieldset>
                <label class="formTitle">Welcome, <?= $_SESSION["username"] ?>! Add a new post:</label>
            </fieldset>
            <fieldset>
                <textarea placeholder="Enter post here..." maxLength="250" id="newPostText"></textarea>
                <br>
                <label id="characterCount">250 characters remaining</label>
                <input type="hidden" id="usernameField" value="<?= $_SESSION["username"] ?>">
            </fieldset>
            <fieldset>
                <div>
                    <input class='button' type="submit" value="Add post">
                </div>
            </fieldset>
        </form>
        <div id="postContainer">
            <?php
            while (($row = $stmt->fetch()) != null) {
                echo "<div class='post'>";
                echo "<div class='username'>$row[username]</div>";
                echo "<div class='date'>$row[date_time]</div>";
                echo "<div class='postContent'>$row[post]</div>";
                if (intval($row["like_count"]) >= 1) {
                    echo "<div class='likeCount'>$row[like_count] likes</div>";
                }

                if ($row["username"] === $_SESSION["username"]) {
                    echo "<p class='links'><a class='button likeButton' value='$row[post_id]'>like </a><a class='button editButton' href='update.php?id=$row[post_id]' value='$row[post_id]'>edit</a><a class='button deleteButton' href='#' value='$row[post_id]'>delete</a></p>";
                } else {
                    echo "<p class='links'><a class='button likeButton' value='$row[post_id]'>like</a></p>";
                }
                echo "</div>";
            }

            ?>
        </div>
    </main>
    <footer>
        <p>&#169 Jordan Webber 2020</p>
    </footer>
</body>

</html>