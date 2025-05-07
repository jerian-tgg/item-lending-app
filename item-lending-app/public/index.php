<?php 
require_once __DIR__ . '/../autoload.php';

$user = Auth::getUser();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="/item-lending-app/public/css/styles.css">
</head>
<body>
    <div class="container">
        <?php if (Auth::isLoggedIn()): ?>
            <h2>Welcome, <?= htmlspecialchars($user['fullName']) ?>!</h2>
            <div class="info-box">
                <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            </div>
            <div class="actions">
                <a href="items.php" class="button-link">Browse Items</a>
                <a href="logout.php" class="button-link">Logout</a>
            </div>
        <?php else: ?>
            <div class="alert error">You are not logged in.</div>
            <p class="text-center"><a href="login.php">Login</a> or <a href="register.php">Register</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
