<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #7f2549, #f0c7d3);
            color: #fff;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .dashboard-header {
            background: #7f2549;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-header h1 {
            font-size: 24px;
            margin: 0;
        }

        .dashboard-header a {
            color: #fff;
            background: #f0c7d3;
            padding: 5px 45px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .dashboard-header a:hover {
            background: #c98aa3;
        }

        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
        }

        .sidebar {
            background: #7f2549;
            width: 250px;
            padding: 20px;
            border-radius: 10px 0 0 10px;
            min-height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #f0c7d3;
            font-weight: bold;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background: #f0c7d3;
            color: #fff;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background: #f0c7d3;
            color: #000;
            border-radius: 0 10px 10px 0;
            text-align: center;
        }

        .stats {
            margin-bottom: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            justify-items: center; 
            background: #7f2549;
        }

        .stats p {
            background: #f9f9f9;
            color: #7f2549;
            padding: 15px;
            border-radius: 10px;
            width: 100%;
            max-width: 200px;
            text-align: center;
            font-size: 16px;
            
        }

        .recent-activity {
            margin-top: 20px;
        }

        .recent-activity ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            
        }

        .recent-activity li {
            background: #f9f9f9;
            margin: 10px auto;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s ease;
            max-width: 500px;
        }

        .recent-activity li:hover {
            background: #7f2549;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <header class="dashboard-header">
            <h1><a href="index.html">Bliss</a></h1>
            <span>Admin Dashboard <a href="logout.php">Logout</a></span>
        </header>

        <div class="dashboard-container">
            <aside class="sidebar">
                <ul>
                    <li><a href="view_users.php">View Users</a></li>
                    <li><a href="add_product.php">Add Product</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="purchases.php">Purchases</a></li>
                    <li><a href="contact_us.php">View Contact Us</a></li>
                </ul>
            </aside>

            <main class="main-content">
                <h2>Dashboard</h2>
                <div class="stats"> <p><a href="view_users.php" style=>Total Users</a></p>
                    <p>Total Products</p>
                 
                </div>

                <div class="recent-activity">
                    <h3>Recent Comments</h3>
                    <ul>
                        <li>No comments yet.</li>
                    </ul>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
