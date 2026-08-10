<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
try {
    $questions = getQuestionsWithDetails($pdo);

    $title = 'Student Forum - Questions';
    $basePath = '';

    ob_start();
    
    include 'templates/question.html.php';
    
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
include 'templates/layout.html.php';