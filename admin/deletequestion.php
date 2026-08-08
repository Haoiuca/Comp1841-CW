<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['id'])) {
        
        $question = getQuestionsWithDetails($pdo);
        if (!empty($question['image']) && file_exists('../uploads/' . $question['image'])) {
            unlink('../uploads/' . $question['image']);
        }
        deleteQuestion($pdo, $_POST['id']);

        header('location: question.php');
        exit();
    } else {
        header('location: question.php');
        exit();
    }

} catch (PDOException $e) {
    // 5. Secure Error Handling (Uses the admin layout)
    $title = 'An error has occurred';
    $output = 'Unable to delete question: ' . $e->getMessage();
    include '../templates/admin_layout.html.php';
}