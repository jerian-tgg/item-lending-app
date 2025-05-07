<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../classes/Auth.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (Auth::login($_POST['username'], $_POST['password'])) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/item-lending-app/public/css/styles.css">
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    <?php if ($error): ?>
        <div class="alert error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="btn">Login</button>
    </form>

    <p class="switch-link">Don't have an account? <a href="register.php">Register here</a></p>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
