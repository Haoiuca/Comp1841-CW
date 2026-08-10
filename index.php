<?php
// 1. Include necessary utility files (Database connection and Shared functions)
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

try {
    // 2. Look at the incoming action query parameter (e.g., ?route=list)
    // If no route parameter is provided, default to the home page view.
    $route = $_GET['route'] ?? 'home';

    // 3. Process routing actions using a switch statement
    switch ($route) {
        case 'home':
            $title = 'Student Forum - Home';
            
            // Capture the home page contents into output buffering
            ob_start();
            include 'templates/home.html.php';
            $output = ob_get_clean();
            break;

        case 'list':
            $title = 'All Questions';
            
            // Query the database via your reusable custom function library
            // Typically calls an INNER JOIN to retrieve author names and module codes
            $questions = getQuestionsWithDetails($pdo); 
            
            ob_start();
            include 'templates/questions.html.php';
            $output = ob_get_clean();
            break;

        case 'add':
            $title = 'Ask a Question';
            
            // Fetch authors and modules to populate select dropdowns on the form
            $authors = allAuthors($pdo);
            $modules = allModules($pdo);

            // Handle the POST form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Read input fields safely
                $questionText = $_POST['questionText'];
                $authorId = $_POST['authorId'];
                $moduleId = $_POST['moduleId'];
                $questionDate = date('Y-m-d');
                
                // Handle screenshot image upload string path if required by coursework brief
                $imageFilename = null;
                if (!empty($_FILES['image']['name'])) {
                    $imageFilename = $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/uploads/' . $imageFilename);
                }

                // Insert into the database using a parameterized helper function
                saveQuestion($pdo, $questionText, $questionDate, $imageFilename, $authorId, $moduleId);
                
                // Redirect back to list view to fulfill the PRG (Post/Redirect/Get) design pattern
                header('Location: index.php?route=list');
                exit();
            }

            ob_start();
            include 'templates/addquestion.html.php';
            $output = ob_get_clean();
            break;

        case 'delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                deleteQuestion($pdo, $_POST['id']);
                header('Location: index.php?route=list');
                exit();
            }
            break;

        case 'edit':
            $title = 'Edit Question';
            $authors = allAuthors($pdo);
            $modules = allModules($pdo);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                updateQuestion($pdo, $_POST['id'], $_POST['questionText'], $_POST['authorId'], $_POST['moduleId']);
                header('Location: index.php?route=list');
                exit();
            } else {
                // GET request: Fetch the row data for this specific primary key to pre-populate the edit fields
                $question = findQuestionById($pdo, $_GET['id']);
            }

            ob_start();
            include 'templates/editquestion.html.php';
            $output = ob_get_clean();
            break;

        default:
            // Fallback for route inputs that aren't defined
            http_response_code(404);
            $title = 'Page Not Found';
            $output = '<h1>404 - The requested page does not exist.</h1>';
            break;
    }

} catch (PDOException $e) {
    // 4. Centralised Try-Catch safety layer
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

// 5. Final Assembly: Load the master site template frame
// This master template expects $title and $output to be populated.
include 'templates/layout.html.php';