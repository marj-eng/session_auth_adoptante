
<?php
include 'db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (fullname, username, email, password_hash)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssss",
            $fullname,
            $username,
            $email,
            $password_hash
        );

        try {
            $stmt->execute();

            header("Location: index.php");
            exit();

        } catch (mysqli_sql_exception $e) {

            if ($e->getCode() == 1062) {
                $error = "Username or email already exists. Please use another one.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Account</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-container {
            background: white;
            width: 400px;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #333;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #764ba2;
        }

        .error {
            background: #ffe0e0;
            color: #cc0000;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="register-container">

    <h2>Create Account</h2>

    <?php if (!empty($error)): ?>
        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">

        <label>Full Name</label>
        <input type="text" name="fullname"
               placeholder="Enter your full name" required>

        <label>Username</label>
        <input type="text" name="username"
               placeholder="Enter username" required>

        <label>Email</label>
        <input type="email" name="email"
               placeholder="Enter email address" required>

        <label>Password</label>
        <input type="password" name="password"
               placeholder="Enter password" required>

        <button type="submit">Register</button>

    </form>

    <div class="login-link">
        Already have an account?
        <a href="index.php">Login here</a>
    </div>

</div>

</body>
</html>
