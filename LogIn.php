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
<div class="top-container">
  <div class="navbar">
    <div class="navbar-left">
      <h2 style="  font-family: 'Tangerine', serif; font-size: 40px;">Book wellnes services !</h2>
    </div>
    <div class="navbar-right">
      <a href="login.html"><i class="bi bi-box-arrow-in-right"></i> Log in</a>
      <a href="#"><i class="bi bi-cloud-arrow-down-fill"></i> Download the app</a>
      <a href="#" onclick="openPopup()"><i class="bi bi-globe" ></i> Select Language</a>
    </div>
  </div>
</div>
<!-----------navbar sidebar------------>
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="bi bi-x-circle"></i></a>
  <a href="aboutus.html"><i class="bi bi-person-lines-fill"></i>About us</a>
  <a href="login.html"><i class="bi bi-box-arrow-in-right"></i> Log in</a>
  <a href="ContactUs.html"><i class="bi bi-telephone"></i>Contact us</a>
  <a href="SpeacialOffers.html"><i class="bi bi-stars"></i>Special offers</a>
  <div class="spacer"></div>
  <a class="logout-btn" href="logout.php"><i class="bi bi-box-arrow-in-left"></i>Logout</a>
  

</div>


<!-- -------------------------Pop-up form--------------- -->
<div id="popup" class="popup-overlay">
  <div class="popup-content">
    <h3 style="color:#503C3C;">Select Your Language</h3>
    <form>
      <label for="language" style="color: #493628;">Choose a language:</label>
      <select id="language" name="language">
        <option value="english">English</option>
        <option value="spanish">Spanish</option>
        <option value="french">French</option>
        <option value="german">German</option>
        <option value="chinese">Chinese</option>
      </select>
      <br><br>
      <input type="submit" class="submit-btn" value="Submit">
    </form>
   
  </div>
</div>
<div class="header" id="myHeader">
    <h2 style="margin-left: 20px;">Nova</h2>
    <button class="openbtn" onclick="openNav()"><i class="bi bi-list"></i></button>
</div>
<!---------------------------------CONTENT------------------------------------------->
<div class="section">
        <div class="mainBox">
            <?php
            require_once "N/database.php";

            if (isset($_POST["logIn"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                $sql = "SELECT * FROM users WHERE email ='$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        if($user['role'] == 'admin'){
                            header("Location:  dashboard.php");
                        }else{
                            header("Location:  Nova.html");
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                }
            }
            ?>
            <h1>Nova</h1>
            <div class="logInPart">
                <p>Log in to your account:</p>
                <form class="logInForm" action="LogIn.php" method="post">
                    <input placeholder="Enter Email" type="email" id="email" name="email" required minlength="8">
                    <input placeholder="Enter Password" type="password" id="password" name="password" required minlength="8">
                    <input type="submit" value="Log In" id="logIn" name="logIn">
                </form>
                <p>Don't have an account? <a href="Signin.php">Register</a></p>
            </div>
        </div>
    </div>
    <script src="Validation.js"></script>
<!---------------------------------KRYHET content---------------------------------------->

  <!----------------------------------------F O O T E R------------------------------------------>
<div class="footer-container">
  <footer>
    <a href="aboutus.html" class="footer-section-link">
      <h2>About Us</h2>
      <p>We connect you to the best local services, making booking easy and hassle-free.</p>
    </a>
    <div class="footer-section-link" style="color: white;" >
    <a href="ContactUs.html" style="color: white;" >
      <h2 style="color: white;">Contact Us</h2>
      <p style="color: white;">Email: support@nova.com</p>
      <p style="color: white;">Phone: +1 234 567 890</p>
    </a>
    </div>
    <div class="footer-section">
      <h2>Download the App</h2>
      <div class="app-links">
        <a href="#" class="app-store">App Store</a>
        <a href="#" class="play-store">Google Play</a>
      </div>
    </div>
    <div class="footer-section">
      <h2>Follow Us</h2>
      <div class="social-icons">
        <a href="#" class="social-icon"><i class="bi bi-facebook"></i>Facebook</a>
        <a href="#" class="social-icon"><i class="bi bi-instagram"></i>Instagram</a>
        <a href="#" class="social-icon"><i class="bi bi-twitter"></i>Twitter</a>
      </div>
    </div>
    <div class="footer-section">
      <button id="leave-review-btn">Leave a Review</button>
    </div>
</body>
</html>