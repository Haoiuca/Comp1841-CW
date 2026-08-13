<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="forum.css">
</head>
<body>
    <header>
        <h1>Student Stack Overflow</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="question.php">Questions List</a></li>
            <li><a href="addquestion.php">Ask a Question</a></li>
            <li><a href="admin/question.php">Admin</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
    
    <main>
        <?=$output?>
    </main>
    
    <footer>
        <p>&copy; <?=date('Y')?> Student Forum. All Rights Reserved.</p>
    </footer>
</body>
</html>