<?php
// contact.php (Public Router)
if (isset($_POST['message'])) {
    // 1. Setup variables
    $to = 'your_university_email@gre.ac.uk'; 
    $subject = 'New Message from Stack Overflow';
    $message = $_POST['message'];
    $headers = 'From: ' . $_POST['email'];

    // 2. University Server Requirement (If testing on I-Drive)
    ini_set("SMTP", "smtp.gre.ac.uk");
    ini_set("sendmail_from", "your_university_email@gre.ac.uk");

    // 3. Send Email
    mail($to, $subject, $message, $headers);
    
    // Redirect to a thank you page
    header('Location: index.php?status=emailsent');
} else {
    // Load the contact form template
    $title = 'Contact Us';
    ob_start();
    include 'templates/mailform.html.php';
    $output = ob_get_clean();
    include 'templates/layout.html.php';
}