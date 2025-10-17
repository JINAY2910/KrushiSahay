<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $dataDir = __DIR__ . "/data";
    $usersFile = $dataDir . "/users.txt";

    if (!file_exists($usersFile)) {
        showError("No registered users found. Please register first.");
        exit();
    }

    $users = file($usersFile, FILE_IGNORE_NEW_LINES);
    $validUser = false;
    $username = "";

    foreach ($users as $user) {
        $userData = explode(",", $user); // [name, email, password, date]
        if (count($userData) >= 3 && $userData[1] === $email && $userData[2] === $password) {
            $validUser = true;
            $username = $userData[0];
            break;
        }
    }

    if ($validUser) {
        // ✅ Session handling
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        // ✅ Cookie handling for Remember Me
        if (!empty($_POST['remember'])) {
            setcookie("username", $email, time() + (86400 * 30), "/"); // 30 days
        } else {
            setcookie("username", "", time() - 3600, "/"); // delete cookie if unchecked
        }

        header("Location: ../html/index.html"); // redirect to homepage/dashboard
        exit();
    } else {
        showError("Invalid email or password. Please try again.");
    }
} else {
    header("Location: ../html/login.html");
    exit();
}
function showError($message) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login Failed - Krushi Sahay</title>
        <link rel="stylesheet" href="../css/style.css">
        <style>
            .error {
                background: #f8d7da;
                color: #721c24;
                padding: 20px;
                border-radius: 8px;
                margin: 20px 0;
                border: 1px solid #f5c6cb;
            }
            .btn {
                background: #dc3545;
                color: #ffffff !important;
                padding: 12px 24px;
                text-decoration: none;
                border-radius: 5px;
                display: inline-block;
                margin-top: 15px;
            }
            .btn:hover { background: #c82333; }
        </style>
    </head>
    <body class="login-page">
        <div class="login-wrapper">
            <div class="login-container">
                <h1>🌾 Krushi Sahay</h1>
                <div class="error">
                    <h2>❌ Login Failed</h2>
                    <p><?php echo $message; ?></p>
                </div>
                <a href="../html/login.html" class="btn">Try Again</a>
                <p><a href="../html/register.html">Don't have an account? Register</a></p>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>
