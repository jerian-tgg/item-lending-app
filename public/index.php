<?php
require_once __DIR__ . '/../autoload.php';

$user = Auth::getUser();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <?php if (Auth::isLoggedIn()): ?>
            <h2>Welcome, <?= htmlspecialchars($user['fullName']) ?>!</h2>
            <ul>
                <li>Username: <?= htmlspecialchars($user['username']) ?></li>
                <li>Email: <?= htmlspecialchars($user['email']) ?></li>
            </ul>
            <p><a href="items.php">Browse Items</a> | <a href="logout.php">Logout</a></p>
        <?php else: ?>
            <p><a href="login.php">Login</a> or <a href="register.php">Register</a></p>
        <?php endif; ?>
    </div>
</body>
</html>