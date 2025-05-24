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

<h2>Login</h2>
<?php if ($error): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label>Username:</label>
        <input type="text" name="username" required>
    </div>
    
    <div class="form-group">
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>
    
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>