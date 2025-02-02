<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nova";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// i merr prej formes te tabla ne sql
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $rating = (int) $_POST['rating'];
    $review = $conn->real_escape_string($_POST['review']);

    $sql = "INSERT INTO reviews (name, rating, review) VALUES ('$name', $rating, '$review')";
    if (!$conn->query($sql)) {
        echo "Error: " . $conn->error;
    }
}

// i merr prej qitu te dhanta
$sql = "SELECT * FROM reviews ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
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
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
<!--font link-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Pangolin&family=Parkinsans:wght@300..800&family=Poiret+One&family=Roboto+Flex:opsz,wght@8..144,100..1000&family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
<!--font link end-->
    <title> Nova view Review</title>
    <style>
        body {
  font-family:'Poiret One';
  margin: 0;
  background-color: #e5e1dab7;

}

     .btn-primary{
        background-color:rgb(241, 240, 232);
        color: rgb(168, 124, 124);
        border-color:rgb(168, 124, 124);
     }
     .btn-primary:hover{
        background-color:rgb(168, 124, 124);
        color:rgb(241, 240, 232) ;
        border-color:rgb(168, 124, 124)
     }

    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Customer Reviews</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Name: <?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="card-text">Rating: <?php echo str_repeat('⭐', $row['rating']); ?></p>
                        <p class="card-text">"<?php echo htmlspecialchars($row['review']); ?>"</p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No reviews yet. Be the first to leave a review!</p>
        <?php endif; ?>
        <a href="Nova.html" class=" btn btn-primary">Back to Nova</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
