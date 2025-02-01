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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studioName = $_POST['studio_name'];
    $serviceType = $_POST['service_type'];

 
    $sql = "INSERT INTO studios (name, service_type) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $studioName, $serviceType);

    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='alert alert-success'>Studio added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding studio: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Studio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poiret One';
            background-color: #e5e1dab7;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }
        h2 {
            font-family: 'Tangerine', serif;
            font-size: 40px;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .submit-btn {
            background-color: rgb(202, 135, 135);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #A87676;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add a Studio/Clinic/Salon</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="studio_name">Studio/Clinic/Salon Name:</label>
                <input type="text" id="studio_name" name="studio_name" required>
            </div>
            <div class="form-group">
                <label for="service_type">Service Type:</label>
                <select id="service_type" name="service_type" required>
                    <option value="nails">Nails</option>
                    <option value="facial">Facial Treatment</option>
                    <option value="hair">Hair Salon</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">Add Studio</button>
        </form>
    </div>
</body>
</html>