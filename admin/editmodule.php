<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    // 1. Has the user submitted the form to save changes?
    if (isset($_POST['moduleCode'])) {
        
        // Pass the new data from the form to your new update function
        updateModule($pdo, $_POST['id'], $_POST['moduleName'], $_POST['moduleCode']);
        
        // Send them back to the module list
        header('location: modules.php');
        exit();
        
    } else {
        // 2. The user just clicked 'Edit', so fetch the current module data
        $module = getModule($pdo, $_GET['id']);
        
        $title = 'Edit Module';
        
        // Start buffering and load the form template
        ob_start();
        include '../templates/editmodule.html.php';
        $output = ob_get_clean();
    }

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/admin_layout.html.php';