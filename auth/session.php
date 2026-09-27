<?php
// auth/session.php - Manajemen Sesi & Cookies

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek auto-login via Cookie jika sesi belum ada
if (!isset($_SESSION['user']) && isset($_COOKIE['remember_user']) && isset($_COOKIE['remember_token'])) {
    require_once __DIR__ . '/../database/dbconn.php';
    
    $cookie_user = $_COOKIE['remember_user'];
    $cookie_token = $_COOKIE['remember_token'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->execute([$cookie_user]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $expected_token = hash('sha256', $user['username'] . $user['password']);
        if (hash_equals($expected_token, $cookie_token)) {
            $_SESSION['user'] = $user['username'];
        }
    }
}

// Helper functions
if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        return isset($_SESSION['user']) && !empty($_SESSION['user']);
    }
}

if (!function_exists('get_logged_user')) {
    function get_logged_user() {
        return $_SESSION['user'] ?? null;
    }
}
