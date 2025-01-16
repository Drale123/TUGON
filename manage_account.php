<?php
// Include the database connection file
include_once 'dbconnect.php';

// Initialize variables
$message = '';
$messageType = '';

// Check if there is an active session
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if no session
    exit();
}

// Fetch the user's current username
$user_id = $_SESSION['user_id'];
$query = $pdo->prepare("SELECT username FROM user_list WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$user = $query->fetch(PDO::FETCH_ASSOC);
$currentUsername = $user['username'] ?? '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'] ?? '';
    $oldPassword = $_POST['oldPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';

    // Validate username change
    if (!empty($newUsername) && $newUsername !== $currentUsername) {
        $updateUsernameQuery = $pdo->prepare("UPDATE user_list SET username = :username WHERE user_id = :user_id");
        $updateUsernameQuery->execute(['username' => $newUsername, 'user_id' => $user_id]);
        $message = "Username updated successfully!";
        $messageType = 'success';
        $currentUsername = $newUsername; // Update local variable for display
    }

    // Validate password change
    if (!empty($newPassword)) {
        $checkPasswordQuery = $pdo->prepare("SELECT password FROM user_list WHERE user_id = :user_id");
        $checkPasswordQuery->execute(['user_id' => $user_id]);
        $storedPassword = $checkPasswordQuery->fetchColumn();

        if (!password_verify($oldPassword, $storedPassword)) {
            $message = "Incorrect current password.";
            $messageType = 'danger';
        } elseif (password_verify($newPassword, $storedPassword)) {
            $message = "The new password must not be the same as the old password.";
            $messageType = 'danger';
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updatePasswordQuery = $pdo->prepare("UPDATE user_list SET password = :newPassword WHERE user_id = :user_id");
            $updatePasswordQuery->execute([
                'newPassword' => $hashedPassword,
                'user_id' => $user_id,
            ]);
            $message = "Password updated successfully!";
            $messageType = 'success';
        }
    }

    if (empty($newPassword) && empty($newUsername)) {
        $message = "No changes were made.";
        $messageType = 'muted';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .adjusted-container {
      margin-top: -60px; /* Pushes the container down */
    }
  </style>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center vh-100 adjusted-container">
    <div class="card shadow-sm p-4" style="width: 400px; position: relative;">
      <h2 class="text-center mb-4">Manage Account</h2>
      <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?> text-center">
          <?php echo htmlspecialchars($message); ?>
        </div>
      <?php endif; ?>
      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($currentUsername); ?>" required>
        </div>
        <div class="mb-3">
          <label for="oldPassword" class="form-label">Old Password</label>
          <input type="password" class="form-control" id="oldPassword" name="oldPassword">
        </div>
        <div class="mb-3">
          <label for="newPassword" class="form-label">New Password</label>
          <input type="password" class="form-control" id="newPassword" name="newPassword">
        </div>
        <p class="text-muted small">Leave the password field blank if you don't want to update your password.</p>
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
