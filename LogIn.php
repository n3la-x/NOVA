<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Step 1: Database connection
$servername = "localhost";  // Change this if needed
$username = "root";         // Change this if needed
$password = "";             // Change this if needed
$dbname = "nova";  // Replace with your actual database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form data is set
    if (isset($_POST['emri']) && isset($_POST['email']) && isset($_POST['mesazhi'])) {
        // Sanitize and validate form inputs
        $emri = mysqli_real_escape_string($conn, $_POST['emri']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $mesazhi = mysqli_real_escape_string($conn, $_POST['mesazhi']);

        // Validate the email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        } elseif (empty($emri) || empty($email) || empty($mesazhi)) {
            echo "All fields are required.";
        } else {
            // Step 3: Use prepared statement to insert form data into the database
            $stmt = $conn->prepare("INSERT INTO contactus (emri, email, mesazhi) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $emri, $email, $mesazhi);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Your message has been sent successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    }
}

// Step 4: Close the database connection
$conn->close();
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
