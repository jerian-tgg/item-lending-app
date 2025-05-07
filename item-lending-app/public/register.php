<?php
require_once __DIR__ . '/../autoload.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = [
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'fullName' => trim($_POST['fullName']),
        'email' => trim($_POST['email'])
    ];

    if (Auth::register($userData)) {
        $_SESSION['message'] = 'Registration successful! Please login.';
        redirect('login.php');
    } else {
        $error = 'Username already exists!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="/item-lending-app/public/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if ($error): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Full Name:</label>
            <input type="text" name="fullName" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <button type="submit">Register</button>
        </form>
        <p style="text-align:center; margin-top:1rem;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
