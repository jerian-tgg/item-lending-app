<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    require __DIR__ . '/classes/' . $class . '.php';
});

function redirect($path) {
    header("Location: $path");
    exit;
}