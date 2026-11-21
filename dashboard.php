
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "N/A";
$session_id = session_id();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f5f9;
        }

        .navbar {
            background: #333;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            font-size: 22px;
        }

        .logout {
            background: #667eea;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }

        .welcome {
            background: white;
            padding: 35px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .welcome h1 {
            color: #667eea;
            margin-top: 0;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .card h3 {
            color: #333;
            margin-top: 0;
        }

        .card p {
            color: #666;
            overflow-wrap: anywhere;
        }

        .status {
            color: green;
            font-weight: bold;
        }

        @media (max-width: 750px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .container {
                margin: 15px auto;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Session Auth System</h2>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="container">

        <div class="welcome">
            <h1>Welcome, <?php echo $username; ?>!</h1>
            <p>This page is protected and only visible to logged-in users.</p>
            <h3>Explore Dashboard</h3>
        </div>

        <div class="cards">

            <div class="card">
                <h3>Account Status</h3>
                <p class="status">Active</p>
                <p>Your session is active.</p>
                <p>Session protection enabled.</p>
            </div>

            <div class="card">
                <h3>User Details</h3>
                <p>User ID: <?php echo htmlspecialchars((string)$user_id); ?></p>
                <p>Username: <?php echo $username; ?></p>
            </div>

            <div class="card">
                <h3>Active Session ID</h3>
                <p><?php($session_id); ?></p>
                <p></p>
            </div>

        </div>

    </div>

</body>
</html>
