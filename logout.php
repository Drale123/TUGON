<?php
    // Start or resume the session
    session_start();

    // Destroy the session to log out the user
    session_unset();
    session_destroy();

    // Redirect to the home page
    header("Location: index.php?page=home");
    exit();
?>
