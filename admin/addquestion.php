<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['questionText'])) {
        
        // 1. Prepare dynamic variables
        $questionDate = date('Y-m-d'); 
        $imagePath = !empty($_POST['image']) ? $_POST['image'] : null;
        
        // 2. Call your master function to handle the preparation, binding, and execution safely
        saveQuestion(
            $pdo, 
            $_POST['questionText'], 
            $questionDate, 
            $imagePath, 
            $_POST['authorId'], 
            $_POST['moduleId']
        );
        
        // 3. Redirect back to the question list
        header('location: index.php');
        exit();
        
    } else {
        
        // 4. Use your functions to cleanly fetch dropdown data
        $authors = allAuthors($pdo);
        $modules = allModules($pdo);
        
        $title = 'Add a new question';
        
        ob_start();
        
        include '../templates/addquestion.html.php';
        
        $output = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include '../templates/admin_layout.html.php';