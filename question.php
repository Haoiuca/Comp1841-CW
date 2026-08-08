<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
try {
    // 1. Call the function from DatabaseFunctions.php instead of writing raw SQL here.
    // This function safely prepares, executes, and fetches the joined data.
    $questions = getQuestionsWithDetails($pdo);

    // 2. Set the title for the browser tab
    $title = 'Student Stack Overflow - Questions';
    $basePath = '';

    // 3. Start Output Buffering
    ob_start();
    
    // 4. Load the template (which will loop through the $questions array)
    include 'templates/question.html.php';
    
    // 5. Clean the buffer and store the HTML into the $output variable
    $output = ob_get_clean();

} catch (PDOException $e) {
    // 6. Secure Error Handling
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

// 7. Inject the $output and $title into the master layout
include 'templates/layout.html.php';