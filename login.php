<?php
// Include the database connection
require 'dbconnect.php';

$message = '';
$messageType = ''; // To store success or error type

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $userType = $_POST['user_type'];

    // Validate user type
    if ($userType === '') {
        $message = "Please select a valid user type.";
        $messageType = "danger"; // Red color for errors
    } else {
        // Check if the username exists with the correct user_type
        $query = "SELECT * FROM user_list WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists
        if (!$user) {
            $message = "Username not registered.";
            $messageType = "danger"; // Red color for errors
        } else {
            // Check if the user type matches
            if ($user['user_type'] !== $userType) {
                $message = "Incorrect user type.";
                $messageType = "danger"; // Red color for errors
            } else {
                // Verify the password
                if (!password_verify($password, $user['password'])) {
                    $message = "Wrong password.";
                    $messageType = "danger"; // Red color for errors
                } else {
                    // Successful login
                    $message = "Login successful! Redirecting...";
                    $messageType = "success"; // Green color for success

                    // Start session and save user data for further pages
                    session_start();
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_type'] = $user['user_type'];
                }
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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <style>
        .error {
            color: red;
            font-size: 0.875rem;
            height: 0.5px;
            line-height: 8px;
            margin-top: 5px;
            font-style: italic;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h3 class="text-center mb-4">Log In</h3>

                    <?php if ($message): ?>
                        <div class="alert alert-<?php echo $messageType; ?> text-center">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>

                    <form id="login-form" method="POST">
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

                        <button type="submit" class="btn btn-primary w-100">Log In</button>
                    </form>
                    <div class="mt-4 text-center">
                        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                        <p><a href="forgot_password.php">Forgot your password?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Delay redirection by 3 seconds after successful login
        <?php if ($messageType === "success"): ?>
            setTimeout(function() {
                window.location.href = 'index.php?page=home'; // Redirect to home.php after 3 seconds
            }, 3000);
        <?php endif; ?>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
