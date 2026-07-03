<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

try {
    $sql = 'SELECT questions.id, questionText, questionDate, image, 
                   author.name AS authorName, author.email AS authorEmail,
                   module.moduleName, module.moduleCode
            FROM questions
            INNER JOIN author ON questions.id = author.id
            INNER JOIN module ON questions.moduleId = module.moduleId
            ORDER BY questionDate DESC';

    $questions = $pdo->query($sql);

    $title = 'Student Stack Overflow - Questions';

    ob_start();

    include 'templates/question.html.php';

    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include 'templates/layout.html.php';