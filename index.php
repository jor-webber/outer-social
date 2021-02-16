<?php
/**
 * index.php
 * Jordan Webber
 * 000803303
 * 
 * This is the first page that is opened when the user goes to the site. It allows
 * them to sign in or sign up by clicking the link to the sign up page. Also, it starts by
 * destroying any sessions that are currently started.
 *
 */
session_start();
session_destroy();
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Outer Social</title>
</head>

<body>
    <header>
        <h1>OUTER SOCIAL</h1>
        <h2>Please Sign in to Your Account</h2>
    </header>
    <form action="homepage.php" method="POST">
        <input class="loginInfo" type="text" name="username" id="username" placeholder="Username">
        <input class="loginInfo"type="password" name="password" id="password" placeholder="Password">
        <input class="loginButton" type="submit" value="Log In">
        <p>Not signed up yet? <a href="signup.html">click here</a> to sign up</p>
    </form>
    
</body>

</html>