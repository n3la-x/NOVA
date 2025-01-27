<?php
session_start();
include_once 'Database.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    $email = $_POST['email'];
    $password = $_POST['password'];


    if ($user->login($email, $password)) {
        header("Location: Nova.php");
        exit;
    } else {
        echo "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!--font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=DM+Serif+Text:ital@0;1&family=Pangolin&family=Parkinsans:wght@300..800&family=Poiret+One&family=Roboto+Flex:opsz,wght@8..144,100..1000&family=Tangerine:wght@400;700&display=swap" rel="stylesheet"><!--font link end-->
    <title>Log in</title>
    <style>
body {
  font-family:'Poiret One';
  margin: 0;
  background-color: #e5e1dab7;

}
      .container{
        align-items: center;
      max-width: 400px;
      margin: auto;
      padding: 100px;
      }
     
      .top-container {
  background-color:rgb(229, 225, 218);
  padding: 30px;
  text-align: center;
}

.header {
  padding: 10px 10px;
  background:rgb(202, 135, 135);
  color: #f1f1f1;
  align-items: center;
  justify-content: space-between;
  display: flex;
}
.header h2 a{
  margin-left: 20px;
  color: #f1f1f1!important;
}

.header h2 a:hover{
  color: rgb(80, 60, 60)#818181;
}
@media (max-width: 768px) {

  .content {
    padding-top: 80px; /* Match the new header height */
  }
}

.content {
  padding-top: 60px;
  display: flex;
  justify-content: center;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 102px;
}

/*---------------------navbar-----------------------*/
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color:rgb(241, 240, 232);
  color: rgb(168, 124, 124);
  padding:  0px 10px;
  border-radius: 20px;
  box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.5);
}
.navbar-right  {
  display: flex;
}
.navbar-left{
  display: flex;
}
.navbar  a{
  padding: 10px;
  margin: 0px 5px;
  color: rgb(168, 124, 124);
  font-size: 20px;
  text-decoration: none;
}

.navbar a:hover {
  background-color: rgb(202, 135, 135);
  color: white;
  box-shadow: 0px 5px 10px 0px rgb(225, 172, 172);
  border-radius: 5px;
}

.active {
  width: 60px;
  border-radius: 20px;
}

@media screen and (max-width: 500px) {
  .navbar {
    flex-direction: column;
    align-items: center;
  }
  .navbar-left, .navbar-right {
    flex-direction: column;
    width: 100%;
  }
  .navbar-left .active {
    margin-left: 40%;
    text-align: center;
    align-items: center;
  }
  .navbar a {
    width: 100%;
    text-align: center;
  }

}
/* Pop-up form container */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background:#503c3c61;
  backdrop-filter: blur(30px);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}


.popup-content {
  background: white;
  padding: 20px;
  border-radius: 10px;
  width: 90%;
  max-width: 400px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
  text-align: center;
}

.submit-btn{
  background-color: rgb(168, 124, 124);
  color: white;
  border: none;
  margin-top: 7%;
  padding: 10px 55px;
  top: 0px;
  float: center;
  font-size: 15px;
  border-radius: 5px;
  cursor: pointer;
}

.submit-btn:hover{
  background-color: rgb(225, 172, 172);
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);

}

@media screen and (max-width: 500px) {
  .language-btn {
    font-size: 14px;
    padding: 10px 15px;
  }

  .popup-content {
    padding: 15px;
  }

}

/*----------------------hr line----------------------------*/
        h4{
          display: flex;
            flex-direction: row;
            color:#E1ACAC;
            margin: 100px 0 0px 0;
            font-family:'Charm';
        }
        
        h4:before,
        h4:after {
            content: "";
            flex: 1 1;
            border-bottom: 1px solid #E1ACAC;
            margin: 20px 5px;
        }
 /*-------------------side bar---------------*/
  .sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: rgb(219, 181, 181);
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: linear;
}

.sidebar a:hover {
  color: #f1f1f1;
  font-style: italic;
  text-decoration-line: underline;
  text-decoration-style: wavy;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 10px;
  font-size: 36px;
  margin-left: 30px;
}




@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
  
}
.openbtn {
      font-size: 20px;
      cursor: pointer;
      background-color: rgb(229, 225, 218);
      color: rgb(168, 124, 124);
      padding: 10px 15px;
      margin: 0 20px;
      border: none;
      border-radius: 3px;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .openbtn:hover {
      background-color: #82828220;
      color: rgb(229, 225, 218);
      box-shadow: 0px 4px 8px rgb(229, 225, 218);
    }

  /*---------------------------------------------------F O O T E R-------------------------------------*/
.footer-container {
  background-color: rgb(168, 124, 124);
  color: white;
  padding: 20px;
  margin-top: 70px;
}

footer {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.footer-section {
  margin: 20px;
  flex: 1;
  min-width: 200px;
}
.footer-section:hover{
  padding: 10px;
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;}

.footer-section h2 {
  border-bottom: 2px solid #ecf0f1;
  margin-bottom: 10px;
  padding-bottom: 5px;
  font-size: 20px;
}

.app-links a, .social-icons a {
  display: block;
  margin: 5px 0;
  color: white;
  text-decoration: none;
}

.app-links a:hover, .social-icons a:hover {
  color: rgb(243, 208, 215);
  font-style: italic;
}

#leave-review-btn {
  background-color: rgb(219, 181, 181);
  border-radius: 10px;
  color: white;
  border: none;
  padding: 10px 40px;
  margin:0px 0px 0px 25px;
  cursor: pointer;
  font-size: 16px;
}

#leave-review-btn:hover {
  background-color: rgb(243, 208, 215);
  color:rgb(126, 99, 99);
  font-style: italic;
}

/* FORMAAA PER REVIEW*/
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
  width: 90%;
  max-width: 400px;
  border-radius: 5px;
  text-align: center;
  position: relative;
}

.modal-content .close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 20px;
  cursor: pointer;
}

.modal-content form {
  display: flex;
  flex-direction: column;
}

.modal-content label {
  margin: 10px 0 5px;
}

.modal-content input, .modal-content select, .modal-content textarea, .modal-content button {
  padding: 10px;
  margin-bottom: 15px;
  font-size: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.modal-content button {
  background-color: rgb(168, 124, 124);
  color: white;
  cursor: pointer;
}

.modal-content button:hover {
  background-color: rgb(243, 208, 215);
  color:  rgb(168, 124, 124);
  font-style: italic;
}

        input[type=text], input[type=password], input[type=submit]{
        width: 50%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: flex;
        border: 1px groove rgb(164, 164, 164) ;
        background: #ffffff;
        border-radius: 8px;
    
      }
      input[type=text]:focus, input[type=password]:focus, input[type=submit]:focus{
        background-color: #ffffff;
        outline: none;
      }
     
      
      hr {
        border: 1px solid #ffffff;
        margin-bottom: 25px;
      }
      
    
      
      button:hover {
        opacity:1;
      }
      
    
     .loginbtn {
      background-color:#e5e1dab7;
        border-style: groove;
        border-color: #E1ACAC;
        color: rgb(168, 124, 124);
        padding: 14px 20px;
        margin: 5px 0 22px 0;
        cursor: pointer;
        display: center;
        width: 50%;
        opacity: 0.9;
        float: center;
        width: 55%;
        border-radius: 5%;
       
      }
      
      .container {
        padding: 16px;
        padding: 16px;
    justify-content: center;
    box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.5);
    border-radius: 5%;
    background-color: rgb(219, 181, 181);
      }
      
      .clearfix::after {
        content: "";
        clear: both;
        display: table;
      }

    
      @media screen and (max-width: 300px) {
       .loginbtn {
          width: 20%;
        }
      }
    </style>
</head>
<body>
  <div class="top-container">
    <div class="navbar">
      <div class="navbar-left">
        <h2 style=" font-family: 'Tangerine'; font-size: 40px;">Book wellnes services !</h2>
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
    <a href="#"><i class="bi bi-hourglass-split"></i>Last minute appoitment</a>
    <a href="Dashboard.html"><i class="bi bi-hourglass-split"></i>Dashboard</a>
    
  
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
      <h2><a href="Nova.html">Nova</a></h2>
      <button class="openbtn" onclick="openNav()"><i class="bi bi-list"></i></button>
  </div>
  <!--....................................Login FORMA................................-->
    <h2 style="color: rgb(168, 124, 124);margin: 5px 0 2px 655px;padding: 10px;" >Login Form</h2>

<form action="/action_page.php" method="post">

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="password" required>
      <input type="checkbox" onclick="myFunction()">Show Password 
      <br>
    <button type="submit" class="loginbtn">Login</button>
    <br>
    <label>
       <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    
           </label>
           <br>
  
  

    <span class="psw"><a href="#"> Forgot password?</a></span>
    <span class="haveacc"><a href="signup.html">Don't have an account?</a></span>
  </div>
</form>
<!--..................................F O O T E R............................-->
<div class="footer-container">
  <footer>
    <div class="footer-section">
      <h2>About Us</h2>
      <p>We connect you to the best local services, making booking easy and hassle-free.</p>
    </div>
    <div class="footer-section">
      <h2>Contact Us</h2>
      <p>Email: support@fresha.com</p>
      <p>Phone: +1 234 567 890</p>
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
  </footer>
</div>

<!-- Review Form Modal -->
<div id="review-modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Write a Review</h2>
    <form id="review-form">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="rating">Rating:</label>
      <select id="rating" name="rating" required>
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
      </select>

      <label for="review">Your Review:</label>
      <textarea id="review" name="review" rows="4" required></textarea>

      <button type="submit" style="font-size: 20px;">Submit</button>
    </form>
  </div>
</div>
<script>
    
  /*---------------------------------F O O T E R------------------------------------------------*/
  // Modal functionality
const leaveReviewBtn = document.getElementById('leave-review-btn');
const modal = document.getElementById('review-modal');
const closeModal = document.querySelector('.close');

leaveReviewBtn.addEventListener('click', () => {
  modal.style.display = 'flex';
});

closeModal.addEventListener('click', () => {
  modal.style.display = 'none';
});

window.addEventListener('click', (e) => {
  if (e.target === modal) {
    modal.style.display = 'none';
  }
});

// Handle review submission
const reviewForm = document.getElementById('review-form');
reviewForm.addEventListener('submit', (e) => {
  e.preventDefault();
  alert('Thank you for your review!');
  modal.style.display = 'none';
  reviewForm.reset();
});

  
/*---------sidebar---------------*/
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}

  /* ------- popup ---------------*/
function openPopup() {
  document.getElementById('popup').style.display = 'flex';
}

function closePopup() {
  document.getElementById('popup').style.display = 'none';
}
/*pop up end*/
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector('.sticky');
  const content = document.querySelector('.content');

  if (header && content) {
    const headerHeight = header.offsetHeight;
    content.style.paddingTop = `${headerHeight}px`;
  }
});
</script>
    
</body>
</html>