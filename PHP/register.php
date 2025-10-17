<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data (matching your HTML field names)
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);
    
    // Validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Full name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email or mobile is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    if (empty($confirm)) {
        $errors[] = "Please confirm your password";
    }
    
    if ($password !== $confirm) {
        $errors[] = "Passwords do not match";
    }
    
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    
    // If validation passes
    if (empty($errors)) {
        
        // Create data directory
        $dataDir = 'data';
        if (!file_exists($dataDir)) {
            mkdir($dataDir, 0777, true);
        }
        
        // Check if user already exists (by email/mobile)
        $usersFile = $dataDir . '/users.txt';
        if (file_exists($usersFile)) {
            $users = file($usersFile, FILE_IGNORE_NEW_LINES);
            foreach ($users as $user) {
                $userData = explode(',', $user);
                if (isset($userData[1]) && $userData[1] === $email) {
                    showError("This email/mobile is already registered!");
                    exit();
                }
            }
        }
        
        // Save user data (format: name,email,password,registration_date)
        $userData = $name . ',' . $email . ',' . $password . ',' . date('Y-m-d H:i:s') . "\n";
        $result = file_put_contents($usersFile, $userData, FILE_APPEND | LOCK_EX);
        
        if ($result) {
            showSuccess($name, $email);
        } else {
            showError("Registration failed! Please try again.");
        }
        
    } else {
        showError(implode("<br>", $errors));
    }
    
} else {
    header("Location: ../html/register.html");
    exit();
}

function showSuccess($name, $email) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registration Successful - Krushi Sahay</title>
        <link rel="stylesheet" href="../css/style.css">
        <style>
            .success { 
                background: #d4edda; 
                color: #155724; 
                padding: 20px; 
                border-radius: 8px; 
                margin: 20px 0; 
                border: 1px solid #c3e6cb;
            }
            .btn { 
                background: #28a745;
                color: #ffffff !important; 
                padding: 12px 24px; 
                text-decoration: none; 
                border-radius: 5px; 
                display: inline-block;
                margin-top: 15px;
            }
            .btn:hover { background: #218838; }
            .user-details {
                background: #f8f9fa;
                padding: 15px;
                margin: 15px 0;
                border-radius: 5px;
                border-left: 4px solid #28a745;
            }
        </style>
    </head>
    <body class="login-page">
        <div class="login-wrapper">
            <div class="login-container">
                <h1>🌾 Krushi Sahay</h1>
                
                <div class="success">
                    <h2>✅ Registration Successful!</h2>
                    
                    <div class="user-details">
                        <h3>Your Registration Details:</h3>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
                        <p><strong>Email/Mobile:</strong> <?php echo htmlspecialchars($email); ?></p>
                        <p><strong>Registration Date:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                    </div>
                    
                    <p>Welcome to Krushi Sahay! Your account has been created successfully.</p>
                    <p>You can now login with your credentials.</p>
                </div>
                
                <a href="../html/login.html" class="btn">Login Now</a>
                <p><a href="../html/register.html">← Register Another Account</a></p>
            </div>
        </div>
    </body>
    </html>
    <?php
}

function showError($message) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registration Error - Krushi Sahay</title>
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
                    <h2>❌ Registration Failed</h2>
                    <p><?php echo $message; ?></p>
                </div>
                
                <a href="../html/register.html" class="btn">Try Again</a>
                <p><a href="../html/login.html">Already have an account? Login here</a></p>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>
