<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    // Call delete function, passing the ID sent from the hidden form button
    deleteModule($pdo, $_POST['id']);

    // Redirect back to the list
    header('location: modules.php');
    exit();

} catch (PDOException $e) {
    // If there is an error (like a Foreign Key constraint violation), show it
    $title = 'An error has occurred';
    ob_start();
    echo 'Database error: ' . $e->getMessage();
    $output = ob_get_clean();
    include '../templates/admin_layout.html.php';
}