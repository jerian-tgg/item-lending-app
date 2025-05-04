<?php
session_start();
require_once __DIR__ . '/../classes/Auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Lending App</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Community Lending App</h1>
            <nav>
                <?php if (Auth::isLoggedIn()): ?>
                    <a href="index.php">Home</a> |
                    <a href="items.php">Browse Items</a> |
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a> |
                    <a href="register.php">Register</a>
                <?php endif; ?>
            </nav>
        </header>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>