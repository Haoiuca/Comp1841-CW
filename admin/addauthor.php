<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['name'])) {
        insertAuthor($pdo, $_POST['name'], $_POST['email'], $_POST['password']);
        header('location: authors.php');
        exit();
    } else {
        $title = 'Add a New Author';
        ob_start();
        include '../templates/addauthor.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/admin_layout.html.php';