<?php
session_start(); 
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
  header("Location: LogIn.php"); // Redirect to login page if not logged in or not admin
  exit();
}
// Check if the user is logged in


$host = 'localhost'; // Change if you're using a different host
$username = 'root'; // Change to your DB username
$password = ''; // Change to your DB password
$database = 'nova'; // Change to your DB name

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle deletion of user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id = ?";
    
    // Prepare and bind
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='alert alert-success'>User deleted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting user: " . mysqli_error($conn) . "</div>";
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='alert alert-danger'>Error preparing statement: " . mysqli_error($conn) . "</div>";
    }
}

// Fetch all users with prepared statements
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <title>Dashboard</title>
    <style>
  
body {
  font-family:'Poiret One';
  margin: 0;
  background-color: #e5e1dab7;

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
@media (max-width: 768px) {

  .content {
    padding-top: 80px; 
  }
}

.content {
  padding-top: 60px;
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
.sidebar .logout-btn {
  margin-top: 200%; 
  background-color: rgb(168, 124, 124); 
  color: white; 
  border-radius: 5px; 
  transition: background-color 0.3s ease; 
}

.sidebar .logout-btn:hover {
  background-color: #82828220; 
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
    /*---------------------------------------Content------------------------- */
   

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .actions button {
            padding: 5px 10px;
            margin-right: 5px;
        }

        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
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
.footer-section-link {
  margin: 20px;
  flex: 1;
  min-width: 200px;
  color: white;
}
.footer-section-link:hover{
  padding: 10px;
  color: white;
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
.footer-section:hover{
  padding: 10px;
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
.footer-section-link h2 {
  border-bottom: 2px solid #ecf0f1;
  margin-bottom: 10px;
  padding-bottom: 5px;
  font-size: 20px;
}

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
.spacer {
}

    </style>
</head>
<body>
<div class="top-container">
  <div class="navbar">
    <div class="navbar-left">
      <h2 style="font-family: 'Tangerine', serif; font-size: 40px;">Book wellnes services !</h2>
    </div>
    <div class="navbar-right">
      <a href="LogIn.php"><i class="bi bi-box-arrow-in-right"></i> Log in</a>
      <a href="#"><i class="bi bi-cloud-arrow-down-fill"></i> Download the app</a>
      <a href="#" onclick="openPopup()"><i class="bi bi-globe" ></i> Select Language</a>
    </div>
  </div>
</div>
<!-----------navbar sidebar------------>
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="bi bi-x-circle"></i></a>
  <a href="aboutus.html"><i class="bi bi-person-lines-fill"></i>About us</a>
  <a href="Signup.php"><i class="bi bi-box-arrow-in-right"></i> Sign up</a>
  <a href="ContactUs_Form.php"><i class="bi bi-telephone"></i>Contact us </a>
  <a href="SpecialOffers.html"><i class="bi bi-stars"></i>Special offers</a>
  <a href="add_studio.php"><i class="bi bi-patch-plus-fill"></i>Add Studio</a>
  <a href="bookings.php"><i class="bi bi-patch-plus-fill"></i>Bookings</a>
  <a href="contactUs.php"><i class="bi bi-telephone"></i>Contact Us Messages</a>
  <a href="viewReview.php"><i class="bi bi-envelope-paper-heart"></i>View Reviews</a>
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
<h2 ><a href="Nova.html" style="color:white;">Nova</a></h2>
    <button class="openbtn" onclick="openNav()"><i class="bi bi-list"></i></button>
</div>
<!---------------------------------CONTENT------------------------------------------->
<div class="container">
        <h1>User Dashboard</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['role']) ?></td>
                    <td class="actions">
                        <a href="dashboard.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">
                            <button style="background-color: #e74c3c; color: white; border: none;">Delete</button>
                        </a>
                        <a href="edit_user.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

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

  /*--------------TESTEMONIALS CAROUSEL----------------------*/
  const carousel = document.querySelector('.carousel');
let isDragging = false;
let startX;
let scrollLeft;

carousel.addEventListener('mousedown', (e) => {
  isDragging = true;
  startX = e.pageX - carousel.offsetLeft;
  scrollLeft = carousel.scrollLeft;
  carousel.style.cursor = 'grabbing';
});

carousel.addEventListener('mouseleave', () => {
  isDragging = false;
  carousel.style.cursor = 'grab';
});

carousel.addEventListener('mouseup', () => {
  isDragging = false;
  carousel.style.cursor = 'grab';
});

carousel.addEventListener('mousemove', (e) => {
  if (!isDragging) return;
  e.preventDefault();
  const x = e.pageX - carousel.offsetLeft;
  const walk = (x - startX) * 2; 
  carousel.scrollLeft = scrollLeft - walk;
});

carousel.addEventListener('touchstart', (e) => {
  isDragging = true;
  startX = e.touches[0].pageX - carousel.offsetLeft;
  scrollLeft = carousel.scrollLeft;
});

carousel.addEventListener('touchend', () => {
  isDragging = false;
});

carousel.addEventListener('touchmove', (e) => {
  if (!isDragging) return;
  const x = e.touches[0].pageX - carousel.offsetLeft;
  const walk = (x - startX) * 2; // Adjust scroll speed
  carousel.scrollLeft = scrollLeft - walk;
});

  /*..............COUNTER...........................*/
  const counterElement = document.getElementById('counter');
let count = 0;
function incrementCounter() {
  counterElement.textContent = count;
  count = (count + 1) % 501; 
}
setInterval(incrementCounter, 500);
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
