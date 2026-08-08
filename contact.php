<?php
// 1. Check if the form was submitted
if (isset($_POST['message'])) {
    
    // Set up the email variables
    $to = 'qh2292r@gre.ac.uk'; 
    $subject = 'New Message from Student Stack Overflow';
    $message = $_POST['message'];
    $headers = 'From: ' . $_POST['email'];

    // 2. University Server Requirements (Crucial for the I-Drive!)
    ini_set("SMTP", "smtp.gre.ac.uk");
    ini_set("sendmail_from", "qh2292r@gre.ac.uk"); 

    // 3. Send the Email
    mail($to, $subject, $message, $headers);
    
    // 4. Show a success message
    $title = 'Message Sent';
    ob_start();
    echo '<h2>Thank You!</h2><p>Your message has been sent successfully. We will get back to you soon.</p>';
    $output = ob_get_clean();
    
} else {
    // 5. If the form hasn't been submitted yet, just display it
    $title = 'Contact Us';
    ob_start();
    include 'templates/mailform.html.php';
    $output = ob_get_clean();
}

// Output via the public layout
include 'templates/layout.html.php';