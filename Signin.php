<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection (replace with your credentials)
$host = "localhost";
$username = "root";
$password = "";
$database = "nova";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST["submit"])) {
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    // Validation
    if (empty($fullName) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password !== $confirm_password) {
        array_push($errors, "Password does not match");
    }

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        array_push($errors, "Email already exists!");
    }

    // Insert data if no errors
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO users (full_name, email, username, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $fullName, $email, $username, $passwordHash, $role);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect based on role
            if ($role === "admin") {
                header("Location:   dashboard.php"); // Redirect to admin dashboard
                exit();
            } elseif ($role === "user") {
                header("Location: Nova.html"); // Redirect to user dashboard
                exit();
            }
        } else {
            die("Something went wrong: " . mysqli_error($conn));
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
    <title>Nova</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('images/intro.jpg'); /* Ensure the image path is correct */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            font-family: 'Ogg', sans-serif;
        }

        .signUpPart {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 500px;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }

        .signUpPart h1 {
            color: #7f2549;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input, select {
            width: 250px;
            height: 50px;
            font-size: 14px;
            border: 2.5px solid #7f2549;
            border-radius: 5px;
            margin: 10px;
            padding: 0 10px;
        }

        #signUp {
            width: 120px;
            height: 40px;
            font-size: 14px;
            background-color: #7f2549;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #signUp:hover {
            background-color: #6a1c36;
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
    <div class="signUpPart">
        <h1>Nova</h1>
        <form action="" method="post">
            <p>Sign Up:</p>

            <input type="text" placeholder="Enter fullname" id="fullname" name="fullname" maxlength="50" required>
            <input type="email" placeholder="Enter email" id="email" name="email" required>
            <input type="text" placeholder="Enter username" id="username" name="username" maxlength="30" required>
            <input type="password" placeholder="Enter password" id="password" name="password" minlength="8" required>
            <input type="password" placeholder="Confirm password" id="confirm_password" name="confirm_password" minlength="8" required>

            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <input type="submit" value="Sign Up" id="signUp" name="submit">
        </form>
    </div>

    <script>
        // Basic client-side validation (optional)
        document.querySelector("form").addEventListener("submit", function (event) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                event.preventDefault();
            }
        });
    </script>
</body>
</html>