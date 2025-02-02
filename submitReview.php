<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "nova";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['name'], $_POST['rating'], $_POST['review'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $rating = (int) $_POST['rating'];
    $review = $conn->real_escape_string($_POST['review']);

    $sql = "INSERT INTO reviews (name, rating, review) VALUES ('$name', $rating, '$review')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Success"; 
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Missing fields!";
}

$conn->close();
?>
