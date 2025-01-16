<?php
// Include the database connection
require 'dbconnect.php';

$message = '';
$messageType = ''; // To store success or error type

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = trim($_POST['username']);
    $userType = $_POST['user_type'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate input and passwords
    if ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
        $messageType = "danger"; // Red color for errors
    } else {
        // Check if the username already exists
        $query = "SELECT COUNT(*) FROM user_list WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $usernameExists = $stmt->fetchColumn();

        if ($usernameExists) {
            $message = "Username already taken.";
            $messageType = "danger"; // Red color for errors
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            try {
                // Insert into database
                $query = "INSERT INTO user_list (username, password, user_type) VALUES (:username, :password, :user_type)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':user_type', $userType);
                $stmt->execute();

                // Successful registration message
                $message = "Registration successful! Redirecting...";
                $messageType = "success"; // Green color for success
            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
                $messageType = "danger"; // Red color for errors
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.ico">
    <title>Sign Up</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .signup-container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .signup-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .message-box {
            margin-bottom: 1rem;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
        .message-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2 class="signup-title">Sign Up</h2>

        <?php if ($message): ?>
            <div class="message-box message-<?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form id="signup-form" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
                <label for="user-type" class="form-label">User Type</label>
                <select id="user-type" class="form-select" name="user_type" required>
                    <option value="" disabled selected>Select user type</option>
                    <option value="resident">Resident</option>
                    <option value="official">Brgy. Official</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
    </div>
    <script>
        // Delay redirection by 3 seconds after successful registration
        <?php if ($messageType === "success"): ?>
            setTimeout(function() {
                window.location.href = 'index.php?page=home'; // Redirect to the home page after 3 seconds
            }, 3000);
        <?php endif; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
