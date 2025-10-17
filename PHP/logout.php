<!-- <?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Clear session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Clear "Remember Me" cookie
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/');
}

// Redirect back to login page
header("Location: ../html/login.html");
exit();
?> -->
