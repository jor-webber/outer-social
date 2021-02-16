<?php
/**
 * account.php
 * Jordan Webber
 * 000803303
 * December 10, 2020
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This page displays the account information of the user and allows them to edit
 * their password, email, or age and their user account will be updated.
 */
session_start();
include "server/connect.php";

if(isset($_SESSION["username"])){
    $command = "SELECT * FROM users WHERE username = ?";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute([$_SESSION["username"]]);

    if($success and ($row = $stmt->fetch()) != null){
        $username = $row["username"];
        $email = $row["email"];
        if($row["age"] !== null){
            $age = $row["age"];
        } else {
            $age = 0;
        }
        
    }
}
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
                <li><a id="logout" href="index.php">Log out</a></li>
                <input type="text" name="searchBar" id="searchBar" placeholder="Search">
            </ul>
        </nav>
    </header>
    <main>
        <form id="accountForm">
            <fieldset>
                <lable class="formTitle">Hello, <?= $username ?>! You can update your information here:</lable>
            </fieldset>
            <fieldset>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?= $email ?>">
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" value="<?= $age ?>" min="0" max="100">
                <label>Password:</label>
                <input type="password" name="oldPassword" id="oldPassword" placeholder="Current Password">
                <input type="password" name="newPassword" id="newPassword" placeholder="New Password">
            </fieldset>
            <fieldset>
                <input type="submit" class="button" value="Update Account">
            </fieldset>
        </form>
    </main>
    <footer>
        <p>&#169 Jordan Webber 2020</p>
    </footer>
</body>
</html>