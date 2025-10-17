<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data (match HTML names from complaint form)
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $scheme = trim($_POST['scheme']);
    $complaint = trim($_POST['complaint']);

    // Validation
    $errors = [];

    if (empty($name)) $errors[] = "Full name is required";
    if (empty($phone)) $errors[] = "Mobile number is required";
    if (empty($location)) $errors[] = "Location is required";
    if (empty($scheme)) $errors[] = "Please select a scheme";
    if (empty($complaint)) $errors[] = "Complaint description is required";

    // If validation passes
    if (empty($errors)) {

        // Create data directory
        $dataDir = 'data';
        if (!file_exists($dataDir)) {
            mkdir($dataDir, 0777, true);
        }

        // Save complaint data
        $complaintsFile = $dataDir . '/complaints.txt';
        $complaintData = $name . ',' . $phone . ',' . $location . ',' . $scheme . ',' . $complaint . ',' . date('Y-m-d H:i:s') . "\n";
        $result = file_put_contents($complaintsFile, $complaintData, FILE_APPEND | LOCK_EX);

        if ($result) {
            showSuccess($name, $scheme, $complaint);
        } else {
            showError("Failed to save complaint! Please try again.");
        }

    } else {
        showError(implode("<br>", $errors));
    }

} else {
    header("Location: ../html/complaint.html"); // redirect if accessed directly
    exit();
}

function showSuccess($name, $scheme, $complaint) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Complaint Submitted - Krushi Sahay</title>
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
                color: #fff !important; 
                padding: 12px 24px; 
                text-decoration: none; 
                border-radius: 5px; 
                display: inline-block;
                margin-top: 15px;
            }
            .btn:hover { background: #218838; }
            .complaint-details {
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
                    <h2>✅ Complaint Submitted Successfully!</h2>
                    
                    <div class="complaint-details">
                        <h3>Your Complaint Details:</h3>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
                        <p><strong>Scheme:</strong> <?php echo htmlspecialchars($scheme); ?></p>
                        <p><strong>Complaint:</strong> <?php echo htmlspecialchars($complaint); ?></p>
                        <p><strong>Date:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                    </div>
                    
                    <p>Thank you for raising your issue. Our NGO partners will escalate it to the authorities.</p>
                </div>
                
                <a href="../html/complaint.html" class="btn">Submit Another Complaint</a>
                <p><a href="../html/dashboard.html">← Back to Dashboard</a></p>
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
        <title>Complaint Error - Krushi Sahay</title>
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
                color: #fff !important; 
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
                    <h2>❌ Complaint Submission Failed</h2>
                    <p><?php echo $message; ?></p>
                </div>
                
                <a href="../html/complaint.html" class="btn">Try Again</a>
                <p><a href="../html/dashboard.html">← Back to Dashboard</a></p>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>
