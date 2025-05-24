<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $image = $_FILES['image'];

    if ($name && $description && $image) {
        if ($image['error'] === UPLOAD_ERR_OK) {
            $targetDir = __DIR__ . '/item-lending-app/public/images/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);  // Create if it doesn't exist
            }
            
            // Generate a unique name to avoid overwriting
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('item_', true) . '.' . $ext;
            $targetFile = $targetDir . $newFileName;

            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                // ✅ Save to items.json
                $items = Item::getAllItems();
                $items[] = [
                    'id' => uniqid(),
                    'name' => $name,
                    'description' => $description,
                    'image' => $newFileName,
                    'available' => true,
                ];
                file_put_contents(__DIR__ . '/../data/items.json', json_encode($items, JSON_PRETTY_PRINT));

                $success = "Item added successfully!";
            } else {
                $error = "Failed to upload image. Check folder permissions.";
            }
        } else {
            $error = "Error with image upload: " . $image['error'];
        }
    } else {
        $error = "Please fill in all fields and upload an image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Item</title>
    <link rel="stylesheet" href="/item-lending-app/public/css/styles.css">
</head>

<div class="form-container">
    <h2>Add Item</h2>
    <?php if ($error): ?>
        <div class="alert error"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="alert success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Item Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn">Add Item</button>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
