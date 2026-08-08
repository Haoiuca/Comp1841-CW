<?php
include '../login/Check.php';
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    // 1. Fetch all modules using your library function
    $modules = allModules($pdo);

    $title = 'Manage Modules';

    // 2. Start output buffering
    ob_start();

    // 3. Include the template to display the list
    include '../templates/modules.html.php';

    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

// 4. Output everything using the admin layout
include '../templates/admin_layout.html.php';