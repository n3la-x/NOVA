<?php
require_once 'N/database.php';
session_start();

// Check if user ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("User ID is missing.");
}

$id = $_GET['id'];

// Fetch user data
$sql = "SELECT full_name, email, role FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Input validation (simple example, can be extended)
    if (empty($full_name) || empty($email) || !in_array($role, ['user', 'admin'])) {
        echo "Please fill out all fields correctly.";
    } else {
        // Update SQL query
        $update_sql = "UPDATE users SET full_name = ?, email = ?, role = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "sssi", $full_name, $email, $role, $id);

        if (mysqli_stmt_execute($update_stmt)) {
            header("Location: dashboard.php?message=User updated successfully");
            exit();
        } else {
            echo "Error updating user: An unexpected error occurred. Please try again.";
        }

        mysqli_stmt_close($update_stmt);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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

        button:hover {
            background: #5e1c38;
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
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="" method="POST">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>

            <button type="submit">Update User</button>
        </form>
        <a href="dashboard.php">Back to Users</a>
    </div>
</body>
</html>