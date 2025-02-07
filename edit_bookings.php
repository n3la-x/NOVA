<?php
include 'N/database.php'; 

if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Booking ID.");
}

$id = $_GET['id'];


$query = "SELECT * FROM bookingform WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("SQL Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query execution failed: " . $conn->error);
}

$booking = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $_POST['service'];
    $specificService = $_POST['specificService'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $updateQuery = "UPDATE bookingform SET service=?, specificService=?, name=?, email=?, phone=?, date=?, time=? WHERE id=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssi", $service, $specificService, $name, $email, $phone, $date, $time, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Booking updated successfully!'); window.location.href='bookings.php';</script>";
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e5e1dab7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color:rgb(219, 181, 181);
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            color:rgb(219, 181, 181);
        }

        input, select, button {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background:rgb(219, 181, 181);
            color: #fff;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

      

        a {
            display: block;
            text-align: center;
            color:rgb(219, 181, 181);
            text-decoration: none;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
        </style>
<body>
    <div class="container">
        <h1>Edit Booking</h1>
        <form method="POST">
            <label>Service:</label>
            <input type="text" name="service" value="<?= htmlspecialchars($booking['service']) ?>" required>
            
            <label>Specific Service:</label>
            <input type="text" name="specificService" value="<?= htmlspecialchars($booking['specificService']) ?>" required>
            
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($booking['name']) ?>" required>
            
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($booking['email']) ?>" required>
            
            <label>Phone:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($booking['phone']) ?>" required>
            
            <label>Date:</label>
            <input type="date" name="date" value="<?= htmlspecialchars($booking['date']) ?>" required>
            
            <label>Time:</label>
            <input type="time" name="time" value="<?= htmlspecialchars($booking['time']) ?>" required>
            
            <button type="submit">Update Booking</button>
        </form>
    </div>
</body>
</html>