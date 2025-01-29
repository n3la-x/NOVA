<?php
session_start();
// Check if the user is logged in and is a user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: Signin.php"); // Redirect to the signup page if not a user
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, User!</h1>
    <p>This is the user dashboard.</p>
</body>
</html>