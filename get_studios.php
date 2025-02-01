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

$serviceType = $_GET['service_type'];

$sql = "SELECT name FROM studios WHERE service_type = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $serviceType);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$studios = [];
while ($row = mysqli_fetch_assoc($result)) {
    $studios[] = $row;
}

echo json_encode($studios);
?>