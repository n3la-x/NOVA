<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$username = "root";
$password = "";
$database = "nova";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {

        if (password_verify($password, $user["password"])) {
            if ($user["role"] === "admin") {
                header("Location: dashboard.php"); 
                exit();
            } elseif ($user["role"] === "user") {
                header("Location: Nova.html"); 
                exit();
            }
        } else {
            echo "<div class='alert alert-danger'>Incorrect password!</div>";
        }
    } else {
        header("Location: Signin.php"); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
<!--font link-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Pangolin&family=Parkinsans:wght@300..800&family=Poiret+One&family=Roboto+Flex:opsz,wght@8..144,100..1000&family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
<!--font link end-->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poiret One';
            background-color: #e5e1dab7;
        }

        .loginPart {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
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
            font-size: 16px;
            border: 2.5px solid rgb(168, 124, 124);
            border-radius: 5px;
            margin: 10px;
            padding: 0 10px;
        }

        #login {
            width: 120px;
            height: 40px;
            font-size: 16px;
            background-color: rgb(168, 124, 124);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #login:hover {
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
    </style>
</head>
<body>
    <div class="loginPart">
        <h1>Login</h1>
        <form action="" method="post">
            <input type="email" placeholder="Enter email" id="email" name="email" required>
            <input type="password" placeholder="Enter password" id="password" name="password" required>
            <input type="submit" value="Login" id="login" name="login">
        </form>
        <p>Don't have an account? <a href="Signin.php">Sign up</a></p>
    </div>
</body>
</html>