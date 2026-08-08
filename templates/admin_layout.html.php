<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="../forum.css">
</head>
<body>
    <header>
        <h1>Student Stack Overflow - Admin Panel</h1>
    </header>
    
    <nav>
        <ul>
            <!-- <li><a href="index.php">Home</a></li> -->
            <li><a href="question.php">Questions List</a></li>
            <!--<li><a href="admin/addquestion.php">Ask a Question</a></li>-->
            <li><a href="../index.php">Public Site</a></li>
            <li><a href="modules.php">Manage Modules</a></li>
            <li><a href="authors.php">Manage Authors</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
    </nav>
    
    <main>
        <?=$output?>
    </main>
    
    <footer>
        <p>&copy; <?=date('Y')?> Student Stack Overflow. All Rights Reserved.</p>
    </footer>
</body>
</html>