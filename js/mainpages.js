$(document).ready(function () {

    addDeleteButtonEvent();     // Add the delete button events when the page loads
    addLikeEventListener();     // add the like button events when the page loads

    /**
     * This is the keydown event handler for the textbox for the new posts
     * It keeps track of how many characters the user has left and displays it
     * below the textbox
     */
    $("#newPostText").keydown(function () {
        let length = this.value.length;

        $("#characterCount").html(250 - length + " characters remaining");
    });

    /**
     * This creates teh HTML formate for the users information for the post
     * which makes it in the correct order with all the appropriate classes for
     * the information.
     * 
     * @param {String} username the current user in the sesson
     * @param {User} newPost the post passed to the function
     */
    function postToHtml(username, newPost) {

        let html = "<div class='post'>";
        html += "<div class='username'>" + newPost.username + "</div>";
        html += "<div class='date'>" + newPost.date_time + "</div>";
        html += "<div class='postContent'>" + newPost.post + "</div>";
        if (Number(newPost.like_count) >= 1) {
            html += "<div class='likeCount'>" + newPost.like_count + " likes</div>";
        }

        if (username === newPost.username) {
            html += "<p class='links'><a class='button likeButton' value='" + newPost.id + "'>like </a><a class='button editButton' href='update.php?id=" + newPost.id + "' value='" + newPost.id + "'>edit</a><a class='button deleteButton' value='" + newPost.id + "' href='#'>delete</a></p>";
        } else {
            html += "<p class='links'><a class='button likeButton' value='" + newPost.id + "'>like</a></p>";
        }
        html += "</div>"

        return html;
    }

    /**
     * This gets an array of posts that then goes through the array and makes
     * each of the posts into their HTML formate for the posts to be displays and adds them
     * to a allposts string which is then displayed on the page for the user
     * 
     * @param {Post} posts the array of posts from the database.
     */
    function showAllPosts(posts) {
        let allPosts = "";
        let username = $("#usernameField").val();

        for (let i = 0; i < posts.length; i++) {
            allPosts += postToHtml(username, posts[i]);
        }

        $("#postContainer").html(allPosts);
        addDeleteButtonEvent();
        addLikeEventListener();
    }

    /**
     * The event handler for the submit button for adding a new post that sends an
     * AJAX request to add that post to the database table.
     */
    $("#addPostForm").submit(function (event) {
        event.preventDefault();
        let post = $("#newPostText").val();
        if (post === "") {
            return;
        }

        $("#newPostText").val("")
        $("#characterCount").html("250 characters remaining")
        let url = "server/addpost.php?posttext=" + post;

        fetch(url, { credentials: "include" })
            .then(response => response.json())
            .then(showAllPosts);
    });

    /**
     * This handles the submit for the account form that updates the account information of the user.
     */
    $("#accountForm").submit(function (event) {
        event.preventDefault();
        let email = $("#email").val();
        let age = $("#age").val();
        let oldPassword = $("#oldPassword").val();
        let newPassword = $("#newPassword").val();


        let url = "server/updateuser.php?email=" + email + "&age=" + age +
            "&oldpassword=" + oldPassword + "&newpassword=" + newPassword;

        fetch(url, { credentials: "include" })
            .then(response => response.json())
            .then(updatedUser);
    });

    /**
     * This function checked the returned value of the AJAX request and informs the user
     * if the information was able to be updated or if there was an error updating their
     * information in the table
     * 
     * @param {User} user The user information returned from the AJAX request 
     */
    function updatedUser(user) {
        if (user === -1) {
            $(".formTitle").html("ERROR! information could not be updated");
        } else if (user === -2) {
            $(".formTitle").html("ERROR! incorrect password");
        } else {
            $(".formTitle").html(user.username + " has been updated!");
        }

        $("#oldPassword").val("");
        $("#newPassword").val("");
    }

    /**
     * This adds the delete button event handler to all the delete buttons for
     * posts on the page.
     */
    function addDeleteButtonEvent() {

        $(".deleteButton").click(function () {
            let postId = $(this).attr("value");

            let url = "server/deletepost.php?postid=" + postId;

            fetch(url, { credentials: "include" })
                .then(response => response.json())
                .then(showAllPosts);
        });
    }

    // Getting the search bar into a variable
    let searchBar = document.getElementById("searchBar");

    /**
     * The event listener for the search bar so that when there is any
     * input it will send an AJAX request to query the database table 
     * to find any posts with the search value
     */
    searchBar.addEventListener("input", function () {
        let search = searchBar.value;

        let url = "server/searchposts.php?search=" + search;

        fetch(url, { credentials: "include" })
            .then(response => response.json())
            .then(showAllPosts);
    });

    /**
     * The update post submit event that will update the post owned by the user
     * and display a message if there is an error while updating. If there is no
     * error it will return to the home page
     */
    $("#updatePostForm").submit(function (event) {
        event.preventDefault();

        let id = $("#idField").attr("value");
        let updatedPost = $("#updatedPost").val();

        let url = "server/updateuserpost.php?id=" + id + "&post=" + updatedPost;

        fetch(url, { credentials: "include" })
            .then(response => response.text())
            .then(function (text) {
                if (text === -1) {
                    $(".formTitle").html("ERROR! Post could not be updated")
                } else {
                    location.href = "homepage.php";
                }
            });
    });

    /**
     * Adds teh event handlers for the like buttons on the page
     */
    function addLikeEventListener() {

        $(".likeButton").click(function () {
            let postId = $(this).attr("value");

            let url = "server/addlike.php?id=" + postId;

            fetch(url, { credentials: "include" })
                .then(response => response.json())
                .then(showAllPosts);
        });
    }

});
