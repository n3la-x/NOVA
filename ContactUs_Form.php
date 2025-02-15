<?php

$servername = "localhost"; 
$username = "root";         
$password = "";             
$dbname = "nova"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['emri']) && isset($_POST['email']) && isset($_POST['mesazhi'])) {
       
        $emri = mysqli_real_escape_string($conn, $_POST['emri']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $mesazhi = mysqli_real_escape_string($conn, $_POST['mesazhi']);

   
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        } elseif (empty($emri) || empty($email) || empty($mesazhi)) {
            echo "All fields are required.";
        } else {
           
         
            $stmt = $conn->prepare("INSERT INTO contactus (emri, email, mesazhi) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $emri, $email, $mesazhi);

            if ($stmt->execute()) {
              echo "Your message has been sent successfully!";
          } else {
              echo "Error: " . $stmt->error; 
          }
          $stmt = $conn->prepare("INSERT INTO contactus (emri, email, mesazhi) VALUES (?, ?, ?)");
               $stmt->bind_param("sss", $emri, $email, $mesazhi);

       
            $stmt->close();
        }
    }
}
$conn->close();
?>



 
<!DOCTYPE html>
<html>
<head>
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
             <!--font link-->
             <link rel="preconnect" href="https://fonts.googleapis.com">
             <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
             <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=DM+Serif+Text:ital@0;1&family=Pangolin&family=Parkinsans:wght@300..800&family=Poiret+One&family=Roboto+Flex:opsz,wght@8..144,100..1000&family=Tangerine:wght@400;700&display=swap" rel="stylesheet"><!--font link end-->
                <title>Contact Us</title>
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
                padding:  5px 5px;
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
                padding: 15px;
                color: rgb(168, 124, 124);
                font-size: 17px;
               
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
              
              /* Pop-up form content */
              .popup-content {
                background: white;
                padding: 20px;
                border-radius: 10px;
                width: 90%;
                max-width: 400px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
                text-align: center;
              }
              
              /* Close button */
              .close-btn {
                background-color:rgb(168, 124, 124);
                color: white;
                position: fixed;
                top: 39%;
                border: none;
                padding: 5px;
                right: 890px;
                font-size: 25px;
                border-radius: 5px;
                cursor: pointer;
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
                .close-btn:hover {
                background-color: rgb(225, 172, 172);
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
              }
              .submit-btn:hover{
                background-color: rgb(225, 172, 172);
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
              
              }
              
              /* Responsive layout */
              @media screen and (max-width: 500px) {
                .language-btn {
                  font-size: 14px;
                  padding: 10px 15px;
                }
              
                .popup-content {
                  padding: 15px;
                }
              
                .close-btn {
                background-color:#CA8787;
                color: white;
                position: fixed;
                top: 39%;
                border: none;
                padding: 5px ;
                right: 375px;
                font-size: 15px;
                border-radius: 5px;
                cursor: pointer;
                }
              }
              
              /*----------------------hr line----------------------------*/
                     h4 {
                          display: flex;
                          flex-direction: row;
                          color:#E1ACAC;
                          padding: 3px 5px 3px 5px;
                      }
                      
                      h4:before,
                      h4:after {
                          content: "";
                          flex: 1 1;
                          border-bottom: 1px solid #E1ACAC;
                          margin: auto;
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
                /*--------------BUTONAT TE KATEGORIT-----------------*/   
                .button-ctg {
                --c:   rgb(219, 181, 181); /* NGJYRA E BUTONIT*/
                
                box-shadow: 0 0 0 .1em inset var(--c); 
                --_g: linear-gradient(var(--c) 0 0) no-repeat;
                background: 
                  var(--_g) calc(var(--_p,0%) - 100%) 0%,
                  var(--_g) calc(200% - var(--_p,0%)) 0%,
                  var(--_g) calc(var(--_p,0%) - 100%) 100%,
                  var(--_g) calc(200% - var(--_p,0%)) 100%;
                background-size: 50.5% calc(var(--_p,0%)/2 + .5%);
                outline-offset: .1em;
                transition: background-size .4s, background-position 0s .4s;
                color: #818181 ;
              }
              .button-ctg:hover {
                --_p: 100%;
                transition: background-position .4s, background-size 0s;
                color:white ;
              }
              .button-ctg:active {
                box-shadow: 0 0 9e9q inset #0009; 
                background-color: var(--c);
                color: #818181;
              }
              
              .button-ctg {
                font-family: system-ui, sans-serif;
                font-size: 15px;
                cursor: pointer;
                padding: 10px 15px;
                margin: 20px 10px; 
                border: none;
              }   
              /*------------------BUTON SPECIAL OFFERS---------------*/
              @import url("https://fonts.googleapis.com/css?family=Raleway");
              
              :root {
                --glow-color: hsl(186 100% 69%);
              }
              
              .glowing-btn {
                position: relative;
                color: var(--glow-color);
                cursor: pointer;
                padding: 0.35em 1em;
                border: 0.15em solid var(--glow-color);
                border-radius: 0.45em;
                background: none;
                perspective: 2em;
                font-family: "Raleway", sans-serif;
                font-size: 2em;
                font-weight: 900;
                letter-spacing: 1em;
              
                -webkit-box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
                  0px 0px 0.5em 0px var(--glow-color);
                -moz-box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
                  0px 0px 0.5em 0px var(--glow-color);
                box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
                  0px 0px 0.5em 0px var(--glow-color);
                animation: border-flicker 2s linear infinite;
              }
              
              .glowing-txt {
                float: left;
                margin-right: -0.8em;
                -webkit-text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3),
                  0 0 0.45em var(--glow-color);
                -moz-text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3),
                  0 0 0.45em var(--glow-color);
                text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3), 0 0 0.45em var(--glow-color);
                animation: text-flicker 3s linear infinite;
              }
              
              .faulty-letter {
                opacity: 0.5;
                animation: faulty-flicker 2s linear infinite;
              }
              
              .glowing-btn::before {
                content: "";
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                opacity: 0.7;
                filter: blur(1em);
                transform: translateY(120%) rotateX(95deg) scale(1, 0.35);
                background: var(--glow-color);
                pointer-events: none;
              }
              
              .glowing-btn::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                opacity: 0;
                z-index: -1;
                background-color: var(--glow-color);
                box-shadow: 0 0 2em 0.2em var(--glow-color);
                transition: opacity 100ms linear;
              }
              
              .glowing-btn:hover {
                color: rgba(0, 0, 0, 0.8);
                text-shadow: none;
                animation: none;
              }
              
              .glowing-btn:hover .glowing-txt {
                animation: none;
              }
              
              .glowing-btn:hover .faulty-letter {
                animation: none;
                text-shadow: none;
                opacity: 1;
              }
              
              .glowing-btn:hover:before {
                filter: blur(1.5em);
                opacity: 1;
              }
              
              .glowing-btn:hover:after {
                opacity: 1;
              }
       
      
            /* Embedded CSS */
           
          
            .contact-us {
                max-width: 600px;
                margin: 2rem auto;
                background: white;
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
    
            .contact-us h2 {
                margin-top: 0;
                font-size: 1.8rem;
                color: #E1ACAC;
            }
    
            .contact-us p {
                margin-bottom: 1.5rem;
                line-height: 1.6;
            }
    
            form {
                display: flex;
                flex-direction: column;
            }
    
            form label {
                margin-bottom: 0.5rem;
                font-weight: bold;
            }
    
            form input, form textarea {
                margin-bottom: 1rem;
                padding: 0.8rem;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 1rem;
            }
    
            form button {
                background-color:rgb(219, 172, 172) ;
                color: white;
                padding: 0.8rem;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 1rem;
            }
    
            form button:hover {
                background-color:rgb(219, 181, 181) ;
            }
    
            #form-feedback {
                margin-top: 1rem;
                padding: 1rem;
                background-color: white;
                color: #E1ACAC;
                border: 1px solid rgb(219, 172, 172);
                border-radius: 4px;
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

        </style>
        

<body>
  <div class="top-container">
    <div class="navbar">
      <div class="navbar-left">
        <h2 style="  font-family: 'Tangerine', serif; font-size: 40px;">Book wellnes services !</h2>
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
        <a href="ContactUs_Form.php"><i class="bi bi-telephone"></i>Contact us</a>
        <a href="SpecialOffers.html"><i class="bi bi-stars"></i>Special offers</a>
        <div class="spacer"></div>
        <a class="logout-btn" href="logout.php"><i class="bi bi-box-arrow-in-left"></i>Logout</a>
       
        
      
      </div>
      
      <!-- Pop-up form -->
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
          <button class="close-btn" onclick="closePopup()"><i class="bi bi-x-square"></i></button>
        </div>
      </div>
      <div class="header" id="myHeader">
        <h2 ><a href="Nova.html">Nova</a></h2>
        <button class="openbtn" onclick="openNav()"><i class="bi bi-list"></i></button>
    </div>
    <br>
    <br>
    <br>
    <main>
        <section class="contact-us">
            <h2>Contact Us</h2>
            <p>If you have any questions or concerns, feel free to reach out to us using the form below.</p>

            <form method="POST" >
                <label for="emri">Name:</label>
                <input type="text" id="emri" name="emri" placeholder="Your Full Name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email Address" required>

                <label for="mesazhi">Message:</label>
                <textarea id="mesazhi" name="mesazhi" rows="5" placeholder="Your Message" required></textarea>

                <button type="submit">Send Message</button>
            </form>

            <div id="form-feedback" style="display: none;">Thank you for reaching out! We'll get back to you shortly.</div>
        </section>
    </main>
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
            const form = document.getElementById("contact-form");
            const feedback = document.getElementById("form-feedback");

            form.addEventListener("submit", (event) => {
                event.preventDefault(); 

                const name = form.name.value.trim();
                const email = form.email.value.trim();
                const message = form.message.value.trim();

          
                if (!name || !email || !message) {
                    alert("Please fill out all fields.");
                    return;
                }

               
                console.log("Form submitted:", { name, email, message });

            
                feedback.style.display = "block";

       
                form.reset();
            });
        });
    </script>

    
</body>
</html>

