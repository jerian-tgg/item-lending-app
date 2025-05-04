<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../classes/Auth.php';

Auth::logout();
$_SESSION['message'] = 'You have been logged out.';
header('Location: login.php');
exit;
?>