<?php
/**
 * 
 * addlike.php
 * Jordan Webber
 * 000803303
 * December 10, 2020
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This file increases the like of the post that the user liked and then returns
 * the list of posts with the updated like count.
 */
session_start();
include "connect.php";

if(!isset($_SESSION["username"])){
    echo -1;
} else {

    $postId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    if($postId === null || $postId === false) {
        echo -1;
    }

    $command = "UPDATE usersposts SET like_count = like_count + 1 WHERE post_id = ?";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute([$postId]);

    if($success){
        $command = "SELECT * FROM usersposts ORDER BY date_time DESC";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute();

        if($success) {
            $posts = [];
            while(($row = $stmt->fetch()) != null) {
                $newPost = [
                    "username" => $row["username"],
                    "id" => $row["post_id"],
                    "post" => $row["post"],
                    "date_time" => $row["date_time"],
                    "like_count" => $row["like_count"]
                ];
                array_push($posts, $newPost);
            }
            echo json_encode($posts);
        }
    } else {
        echo -1;
    }
}