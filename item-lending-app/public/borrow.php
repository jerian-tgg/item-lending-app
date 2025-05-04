<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../classes/Item.php';
require_once __DIR__ . '/../classes/Auth.php';

if (!Auth::isLoggedIn()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $itemId = (int)$_POST['item_id'];
    
    if (Item::borrowItem($itemId)) {
        $_SESSION['message'] = 'Item borrowed successfully!';
    } else {
        $_SESSION['error'] = 'Item could not be borrowed. It may no longer be available.';
    }
}

header('Location: items.php');
exit;
?>