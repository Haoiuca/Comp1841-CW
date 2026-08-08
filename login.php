<?php
session_start();

// 1. Check if the login form was submitted
if (isset($_POST['login'])) {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    // 2. Try to find the user by the email they typed in
    $author = getAuthorByEmail($pdo, $_POST['email']);

    // 3. If the user exists AND the password matches the hashed password in the DB
    if ($author && password_verify($_POST['password'], $author['password'])) {
        
        // 4. Success! Set the session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['authorId'] = $author['id'];
        $_SESSION['name'] = $author['name'];
        
        // 5. Redirect them into the secure Admin Panel
        header('location: admin/question.php'); 
        exit();
        
    } else {
        // 6. Fail! Send an error message to the template
        $error = 'Invalid email or password.';
    }
}

// Display the login page
$title = 'Log In';
ob_start();

include 'templates/login.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';

