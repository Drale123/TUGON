<?php
// Initialize message variables
$message = '';
$messageType = '';

// Ensure a session exists
session_start();

// Include the database connection
require_once 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch the new password from user input
    $newPassword = trim($_POST['password']);
    
    // Get the username from the session
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

    if ($username) {
        // Fetch the old hashed password for the user
        $query = "SELECT password FROM user_list WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $oldPassword = $stmt->fetchColumn();

        if ($oldPassword) {
            if (password_verify($newPassword, $oldPassword)) {
                // New password matches the old password
                $message = 'New password cannot be the same as the old password.';
                $messageType = 'danger';
            } else {
                // Hash the new password and update it in the database
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $updateQuery = "UPDATE user_list SET password = :newPassword WHERE username = :username";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->bindParam(':newPassword', $hashedPassword, PDO::PARAM_STR);
                $updateStmt->bindParam(':username', $username, PDO::PARAM_STR);

                if ($updateStmt->execute()) {
                    $message = 'Change password successful. Redirecting to login...';
                    $messageType = 'success';

                    // Clear the session to prevent reuse
                    session_destroy();

                    // Redirect to the login page after 2 seconds
                    header("Refresh: 2; URL=login.php");
                } else {
                    $message = 'Failed to update the password. Please try again.';
                    $messageType = 'danger';
                }
            }
        } else {
            // User not found (shouldn't happen if the flow is correct)
            $message = 'User does not exist. Please try again.';
            $messageType = 'danger';
        }
    } else {
        // Handle missing username (shouldn't happen if session is correctly managed)
        $message = 'Invalid request. Please start from the forgot password page.';
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
    <title>Forgot Password || Change Password</title>
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
        <h2 class="forgot-password-title">Change Your Password</h2>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?> text-center">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="#" method="post">
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-reset">Change Password</button>
            <a href="login.php" class="back-to-login">Remember your password? Back to Login</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
