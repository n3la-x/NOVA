<?php
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: Signin.php");
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nova";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>