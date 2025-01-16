<?php
// Initialize message variables
$message = '';
$messageType = '';

// Start session to store the username
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include the database connection
    require_once 'dbconnect.php';

    // Sanitize and fetch the submitted username
    $username = trim($_POST['username']);

    // Check if the username exists in the database
    $query = "SELECT COUNT(*) FROM user_list WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        // Store the username in the session
        $_SESSION['username'] = $username;

        // Redirect to change_password.php if the username exists
        header("Location: change_password.php");
        exit;
    } else {
        // Set error message if the username does not exist
        $message = 'Username does not exist';
        $messageType = 'danger';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.ico">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Forgot Password</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .forgot-password-container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .forgot-password-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .forgot-password-container a {
            text-decoration: none;
        }

        .back-to-login {
            display: block;
            margin-top: 1rem;
            text-align: center;
            color: #007bff;
        }

        .back-to-login:hover {
            text-decoration: underline;
        }

        .btn-reset {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2 class="forgot-password-title">Forgot Your Password?</h2>
        
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?> text-center">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="#" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <button type="submit" class="btn btn-primary btn-reset">Change Password</button>
            <a href="login.php" class="back-to-login">Remember your password? Back to Login</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
