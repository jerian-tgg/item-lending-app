<?php
class User {
    public $username;
    public $fullName;
    public $email;
    private $password;  // Keep this private for security

    public function __construct($username, $password, $fullName = null, $email = null, $isHashed = false) {
        $this->username = $username;
        $this->password = $isHashed ? $password : password_hash($password, PASSWORD_DEFAULT);
        $this->fullName = $fullName;
        $this->email = $email;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    // Add this method to safely expose the password for JSON encoding
    public function getPasswordForStorage() {
        return $this->password;
    }
}