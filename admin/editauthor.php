<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    // 1. If form is submitted, update the author
    if (isset($_POST['name'])) {
        updateAuthor($pdo, $_POST['id'], $_POST['name'], $_POST['email']);
        header('location: authors.php');
        exit();
        
    } else {
        // 2. Otherwise, fetch the author to edit
        $author = getAuthor($pdo, $_GET['id']);
        $title = 'Edit Author';
        
        ob_start();
        include '../templates/editauthor.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/admin_layout.html.php';