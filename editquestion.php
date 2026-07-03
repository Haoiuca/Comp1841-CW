<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

try {
    if (isset($_POST['questionText'])) {
        $sql = 'UPDATE questions 
                SET questionText = :questionText, 
                    authorId = :authorId, 
                    moduleId = :moduleId 
                WHERE id = :id';
                
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':questionText', $_POST['questionText']);
        $stmt->bindValue(':authorId', $_POST['authorId']);
        $stmt->bindValue(':moduleId', $_POST['moduleId']);
        $stmt->bindValue(':id', $_POST['questionId']); // Khóa chính từ trường hidden trong form
        
     
        $stmt->execute();
        
        header('Location: questions.php');
        exit();
        
    } 
    else {
        
        $sql = 'SELECT * FROM questions WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        
        
        $question = $stmt->fetch();
        
        if (!$question) {
            throw new Exception('Question not found.');
        }

      
        $sqlAuthors = 'SELECT id, name FROM authors';
        $authorsStmt = $pdo->query($sqlAuthors);
        $authors = $authorsStmt->fetchAll();

        
        $sqlModules = 'SELECT id, moduleName FROM modules';
        $modulesStmt = $pdo->query($sqlModules);
        $modules = $modulesStmt->fetchAll();

        
        $title = 'Edit Question';

       
        ob_start();
        include 'templates/editquestion.html.php';
        $output = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = $e->getMessage();
}

include 'templates/layout.html.php';