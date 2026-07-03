<?php
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['questionText'])) {
        
        
        $sql = 'INSERT INTO questions SET 
                questionText = :questionText,
                questionDate = :questionDate,
                image = :image,
                authorId = :id,
                moduleId = :moduleId';
        
        $stmt = $pdo->prepare($sql);
        
        
        $stmt->bindValue(':questionText', $_POST['questionText']);
        $stmt->bindValue(':questionDate', date('Y-m-d')); // Tự động lấy ngày hiện tại
        
        
        $imagePath = !empty($_POST['image']) ? $_POST['image'] : null;
        $stmt->bindValue(':image', $imagePath);
        
        $stmt->bindValue(':authorId', $_POST['authorId']);
        $stmt->bindValue(':moduleId', $_POST['moduleId']);
        
       
        $stmt->execute();
        
       
        header('location: index.php');
        exit();
        
    } else {
        include '../includes/DatabaseConnection.php';
        $authorSql = 'SELECT id, name FROM author';
        $author = $pdo->query($authorSql);
        
        $moduleSql = 'SELECT moduleId, moduleName FROM module';
        $module = $pdo->query($moduleSql);
        
        $title = 'Add a new question';
        
        ob_start();
        
        include '../templates/addquestion.html.php';
        
        $output = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include '../templates/layout.html.php';