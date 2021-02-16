<?php
/**
 * 
 * deletepost.php
 * Jordan Webber
 * 000803303
 * December 10, 2020
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This file handles the AJAX request for the user wanting to delete their post.
 * A list of all remaining posts are returned.
 */
session_start();
include "connect.php";

$postID = filter_input(INPUT_GET, "postid", FILTER_VALIDATE_INT);

if ($postID === null or $postID === false) {
    echo "Could not delete post. Issue with post ID";
} else {
    $command = "DELETE FROM usersposts WHERE post_id = ?";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute([$postID]);

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
                    "date_time" => $row["date_time"],
                    "like_count" => $row["like_count"]
                ];
                array_push($posts, $newPost);
            }

            echo json_encode($posts);
        } else {
            echo -1;
        }
    }
}
