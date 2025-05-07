<?php
class Item {
    private static $itemsFile = __DIR__ . '/../data/items.json';

    public static function getAllItems() {
        if (!file_exists(self::$itemsFile)) {
            return [];
        }
        
        $data = file_get_contents(self::$itemsFile);
        return json_decode($data, true) ?: [];
    }

    public static function borrowItem($itemId) {
        $items = self::getAllItems();
        
        foreach ($items as &$item) {
            if ($item['id'] == $itemId && $item['available']) {
                $item['available'] = false;
                $item['borrowed_by'] = $_SESSION['user']['username'];
                file_put_contents(self::$itemsFile, json_encode($items, JSON_PRETTY_PRINT));
                return true;
            }
        }
        return false;
    }

    public static function returnItem($itemId) {
        $items = self::getAllItems();
        
        foreach ($items as &$item) {
            if ($item['id'] == $itemId && !$item['available'] && $item['borrowed_by'] === $_SESSION['user']['username']) {
                $item['available'] = true;
                unset($item['borrowed_by']);
                file_put_contents(self::$itemsFile, json_encode($items, JSON_PRETTY_PRINT));
                return true;
            }
        }
        return false;
    }

    // NEW: Add item
    public static function addItem($newItem) {
        $items = self::getAllItems();
        $items[] = $newItem;
        file_put_contents(self::$itemsFile, json_encode($items, JSON_PRETTY_PRINT));
    }
}
