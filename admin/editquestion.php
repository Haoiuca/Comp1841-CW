<?php
include '../login/Check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

try {
    // 1. Check if the form was submitted
    if (isset($_POST['questionText'])) {
        
        // 2. Call master update function (Fixing the questionId -> id bug)
        updateQuestion(
            $pdo,
            $_POST['id'], 
            $_POST['questionText'],
            $_POST['authorId'],
            $_POST['moduleId']
        );
        
        // 3. Redirect back to the questions list upon success
        header('Location: question.php'); 
        exit();
        
    } 
    else {
        // 4. Fetch the existing question data to populate the form
        $question = findQuestionById($pdo, $_GET['id']);
        
        if (!$question) {
            throw new Exception('Question not found.');
        }

        // 5. Cleanly fetch dropdown data in two lines
        $authors = allAuthors($pdo);
        $modules = allModules($pdo);
        
        $title = 'Edit Question';

        // 6. Start Output Buffering
        ob_start();
        include '../templates/editquestion.html.php';
        $output = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = $e->getMessage();
}

// 7. Inject into the layout
include '../templates/admin_layout.html.php';