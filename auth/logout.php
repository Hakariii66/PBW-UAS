<?php
// auth/logout.php - Proses Keluar Sistem

require_once __DIR__ . '/session.php';

// Hapus Sesi
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Hapus Cookies Remember Me
setcookie('remember_user', '', time() - 3600, '/');
setcookie('remember_token', '', time() - 3600, '/');

// Mulai sesi baru untuk menampilkan pesan feedback
session_start();
$_SESSION['login_success'] = "Anda telah berhasil logout.";

$login_url = function_exists('base_url') ? base_url('login') : '../index.php?page=login';
header("Location: " . $login_url);
exit;
