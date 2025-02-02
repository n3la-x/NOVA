<?php
require_once 'N/database.php'; // Assuming your database connection is in this file

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $emailOrUsername = $_POST["email_or_username"];
    $password = $_POST["password"];

    $errors = array();

    // Check if fields are empty
    if (empty($emailOrUsername) || empty($password)) {
        array_push($errors, "Both fields are required");
    }

    // Check if the email or username exists
    $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $emailOrUsername, $emailOrUsername);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount == 0) {
        array_push($errors, "No user found with that email or username");
    } else {
        // Fetch user data
        $users = mysqli_fetch_assoc($result);
        
        // Verify password
        if (!password_verify($password, $users["password"])) {
            array_push($errors, "Incorrect password");
        } else {
            // Successful login, start session and redirect
            session_start();
            session_regenerate_id(true);  // Regenerate session ID to prevent session fixation
            $_SESSION['id'] = $users['id'];
            $_SESSION['username'] = $users['username'];
            $_SESSION['role'] = $users['role']; // Ensure 'role' is set correctly

            // Check role and redirect accordingly
            if (trim($users['role']) === "admin") {
                header("Location: dashboard.php"); // Redirect to dashboard if admin
                exit(); // Stop further execution
            } elseif (trim($users['role']) === "user") {
                header("Location: Nova.html");
                exit(); // Stop further execution
            }
        }
    }

    // Display errors if any
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family:'Poiret One';
            background-color: #e5e1dab7;
        }

        .loginPart {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 500px;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }

        .loginPart h1 {
            color: rgb(168, 124, 124);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            width: 250px;
            height: 50px;
            font-size: 14px;
            border: 2.5px solid rgb(168, 124, 124);
            border-radius: 5px;
            margin: 10px;
            padding: 0 10px;
        }

        #loginBtn {
            width: 120px;
            height: 40px;
            font-size: 14px;
            background-color: rgb(168, 124, 124);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #loginBtn:hover {
            background-color: rgb(202, 135, 135);
        }

        .alert {
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="loginPart">
        <h1>Login</h1>
        <form action="" method="POST">
            <input type="text" placeholder="Enter email or username" id="email_or_username" name="email_or_username" required>
            <input type="password" placeholder="Enter password" id="password" name="password" minlength="8" required>
            <input type="submit" value="Login" id="loginBtn" name="submit">
        </form>
    </div>
</body>
</html>
