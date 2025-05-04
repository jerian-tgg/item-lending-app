<?php
class Auth {
    private static $usersFile = __DIR__ . '/../data/users.json';
    
    public static function register($userData) {
        $users = self::getAllUsers();
        
        foreach ($users as $user) {
            if ($user['username'] === $userData['username']) {
                return false;
            }
        }
        
        $users[] = [
            'username' => $userData['username'],
            'password' => $userData['password'], // Storing plaintext
            'fullName' => $userData['fullName'],
            'email' => $userData['email']
        ];
        
        file_put_contents(self::$usersFile, json_encode($users, JSON_PRETTY_PRINT));
        return true;
    }
    
    public static function login($username, $password) {
        $users = self::getAllUsers();
        
        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }
    
    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }
    
    public static function getUser() {
        return $_SESSION['user'] ?? null;
    }
    
    public static function logout() {
        unset($_SESSION['user']);
    }
    
    private static function getAllUsers() {
        if (!file_exists(self::$usersFile)) {
            return [];
        }
        
        $data = file_get_contents(self::$usersFile);
        return json_decode($data, true) ?: [];
    }
}