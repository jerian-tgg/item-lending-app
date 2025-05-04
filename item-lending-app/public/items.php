<?php
require_once __DIR__ . '/../autoload.php';

if (!Auth::isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$items = Item::getAllItems();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Browse Items</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <!-- Home Button -->
        <p><a href="index.php" class="home-button">← Return to Home</a></p>

        <h2>Available Items</h2>
        <div class="item-grid">
            <?php foreach ($items as $item): ?>
                <div class="item-card <?= $item['available'] ? '' : 'unavailable' ?>">
                    <!-- Image Fix -->
                    <img src="images/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                    
                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                    <p><?= htmlspecialchars($item['description']) ?></p>
                    
                    <?php if ($item['available']): ?>
                        <form action="borrow.php" method="post">
                            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                            <button type="submit">Borrow</button>
                        </form>
                    <?php else: ?>
                        <?php if ($item['borrowed_by'] === $_SESSION['user']['username']): ?>
                            <!-- Return Button -->
                            <form action="return.php" method="post">
                                <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="return-button">Return Item</button>
                            </form>
                        <?php else: ?>
                            <p class="status">Borrowed by <?= htmlspecialchars($item['borrowed_by']) ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>