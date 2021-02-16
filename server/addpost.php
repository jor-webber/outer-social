<?php
/**
 * addpost.php
 * Jordan Webber
 * 000803303
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This file is used to handle the AJAX request to add a new post to the
 * outsocial main page.
 */
session_start();
include "connect.php";

$username = $_SESSION["username"];
$post = filter_input(INPUT_GET, "posttext", FILTER_SANITIZE_STRING);

if ($username === null or $post === null) {
    echo -1;
} else {
    $command = "INSERT INTO usersposts(username, post) VALUES(?,?)";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute([$username, $post]);

    if ($success) {
        $command = "SELECT * FROM usersposts ORDER BY date_time DESC";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute();

        if ($success) {

            $posts = [];
            while (($row = $stmt->fetch()) != null) {
                
                $newPost = [
                    "id" => $row["post_id"],
                    "username" => $row["username"],
                    "post" => $row["post"],
                    "date_time" => $row["date_time"]
                ];
                array_push($posts, $newPost);
            }

            echo json_encode($posts);
        } else {
            echo -1;
        }
    }
}
