<?php
session_start();

// If the user does not have an active session, kick them out to the login page!
if (!isset($_SESSION['loggedin'])) {
    header('location: ../login.php'); 
    exit(); 
}
// If they are logged in, the script just finishes and lets the admin page load normally.
?>