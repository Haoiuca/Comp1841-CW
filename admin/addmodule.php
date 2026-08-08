<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    // 1. Check if the form was submitted
    if (isset($_POST['moduleCode'])) {
        
        // 2. Pass the POST data directly to your new library function
        insertModule($pdo, $_POST['moduleName'], $_POST['moduleCode']);
        
        // 3. Redirect back to the module list
        header('location: modules.php');
        exit();
        
    } else {
        // 4. If form wasn't submitted, just display the page
        $title = 'Add a New Module';
        
        ob_start();
        include '../templates/addmodule.html.php';
        $output = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

// 5. Output the admin layout wrapper
include '../templates/admin_layout.html.php';