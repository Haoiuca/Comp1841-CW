<?php
$title = 'Contact Us';
$basePath = '';

// Track the status of the form submission
$messageStatus = null; 

if (isset($_POST['submit'])) {
    
    // Basic sanitization
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Check if the email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Tell the template to show the success popup
        $messageStatus = 'success';
    } else {
        // Tell the template to show an error popup
        $messageStatus = 'error';
    }
}

ob_start();

include 'templates/mailform.html.php';

$output = ob_get_clean();
include 'templates/layout.html.php';
?>