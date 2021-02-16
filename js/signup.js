/**
 * signup.js
 * Jordan Webber
 * 000803303
 * December 07, 2020
 * 
 * This is the JavaScript file that handles the event for signing up a new 
 * user and anything before the user signs in
 */
window.addEventListener("load", function () {

    let signUpButton = document.getElementById("signup");

    /**
     * Dispalays the message that is returned from the AJAX request for
     * signing up a new user
     * 
     * @param {String} msg The message string returned from the AJAX request.
     */
    function newUser(msg) {
        $("#newUser").html(msg);
    }

    /**
     * Creates the sign up buttons event listener that gets the user information that the 
     * user inputted into the text boxes and sends the information to createuser.php via an
     * AJAX request.
     */
    signUpButton.addEventListener("click", function (event) {
        event.preventDefault();
        let username = document.forms[0].username.value;
        let password = document.forms[0].password.value;
        let email = document.forms[0].email.value;
        let age = document.forms[0].age.value;

        url = "server/createuser.php?username=" + username + "&password=" + password +
            "&email=" + email + "&age=" + age;
        fetch(url, { credentials: "include" })
            .then(response => response.text())
            .then(newUser);
    });
});