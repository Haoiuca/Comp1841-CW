<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('location: login.php'); 
    exit(); 
}

try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    if (isset($_POST['questionText'])) {
        
        $questionDate = date('Y-m-d');
        
        // --- IMAGE UPLOAD LOGIC ---
        $imageName = null; // Default to null if no image is uploaded
        
        // Check if an image was uploaded without errors
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            
            $imageName = basename($_FILES['image']['name']);
            
            // Define where the file should be saved on the server
            // (Assuming this public controller is in the root folder)
            $targetPath = 'uploads/' . $imageName; 
            
            // Move the file from the temporary folder to the uploads folder
            move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
        }
        // --------------------------

        // Call the database function, passing the $imageName string
        insertQuestion(
            $pdo, 
            $_POST['questionText'], 
            $questionDate, 
            $imageName,  // The file name (or null)
            $_SESSION['authorId'], 
            $_POST['moduleId']
        );
        
        header('location: index.php');
        exit();
        
    } else {
        $modules = allModules($pdo);
        $title = 'Ask a Question';
        
        ob_start();
        include 'templates/addquestion.html.php';
        $output = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';