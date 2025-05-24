<?php
require_once __DIR__ . '/../autoload.php';

if (!Auth::isLoggedIn()) {
    redirect('login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $itemId = (int)$_POST['item_id'];
    
    if (Item::returnItem($itemId)) {
        $_SESSION['message'] = 'Item returned successfully!';
    } else {
        $_SESSION['error'] = 'Could not return the item.';
    }
}

redirect('items.php');