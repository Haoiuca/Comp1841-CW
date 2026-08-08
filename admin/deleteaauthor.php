<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    // Call the delete function
    deleteAuthor($pdo, $_POST['id']);

    // Redirect back to the authors list
    header('location: authors.php');
    exit();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    ob_start();
    echo 'Database error: ' . $e->getMessage();
    $output = ob_get_clean();
    include '../templates/admin_layout.html.php';
}