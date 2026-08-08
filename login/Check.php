<?php
session_start();

// If the user does not have an active session, kick them out to the login page!
if (!isset($_SESSION['loggedin'])) {
    // Because Check.php is in the login/ folder, we use ../ to go back to the root
    header('location: ../login.php'); 
    exit(); 
}
// If they are logged in, the script just finishes and lets the admin page load normally.
?>