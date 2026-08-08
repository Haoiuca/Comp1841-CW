<?php
// 1. Find the current session
session_start();

// 2. Destroy all session variables securely
$_SESSION = [];
session_destroy();

// 3. Redirect back to the public home page
header('location: index.php');
exit();