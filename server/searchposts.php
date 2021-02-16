<?php

/**
 * searchposts.php
 * Jordan Webber
 * 000803303
 * 
 * Statement of Authorship: I, Jordan Webber, 000803303 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement.
 * 
 * This file is used to get the search criteria from the search bar and find
 * all posts containing the search criteria
 */
session_start();
include "connect.php";

$searchCriteria = filter_input(INPUT_GET, "search", FILTER_SANITIZE_STRING);

if ($searchCriteria === null || $searchCriteria === "") {
    $command = "SELECT * FROM usersposts ORDER BY date_time DESC";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute();

    if($success) {
        $posts = [];
        while (($row = $stmt->fetch()) != null) {
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
    } else {
        echo -1;
    }

} else {
    $command = "SELECT * FROM usersposts WHERE post LIKE ? ORDER BY date_time DESC";
    $stmt = $dbh->prepare($command);
    $param = "%" . $searchCriteria . "%";
    $success = $stmt->execute([$param]);

    if($success) {
        $posts = [];
        while (($row = $stmt->fetch()) != null) {
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
    } else {
        echo -1;
    }
}
