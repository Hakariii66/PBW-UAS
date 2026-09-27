<?php
// auth/login-process.php - Proses Autentikasi Pengguna

require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../database/dbconn.php';

// Tentukan URL tujuan redirect yang aman
$login_url = function_exists('base_url') ? base_url('login') : '../index.php?page=login';
$beranda_url = function_exists('base_url') ? base_url('beranda') : '../index.php?page=beranda';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $remember = isset($_POST['remember']);

    if ($username === '' || $password === '') {
        $_SESSION['login_error'] = "Username dan password wajib diisi!";
        header("Location: " . $login_url);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login Berhasil - Simpan ke Sesi
            $_SESSION['user'] = $user['username'];
            $_SESSION['login_success'] = "Selamat datang, " . htmlspecialchars($user['username']) . "! Anda berhasil login.";

            // Simpan Cookies jika opsi "Ingat saya" dicentang
            if ($remember) {
                $expiry = time() + (86400 * 30); // 30 hari
                $token = hash('sha256', $user['username'] . $user['password']);
                setcookie('remember_user', $user['username'], $expiry, '/');
                setcookie('remember_token', $token, $expiry, '/');
            } else {
                // Hapus cookie lama jika tidak dicentang
                setcookie('remember_user', '', time() - 3600, '/');
                setcookie('remember_token', '', time() - 3600, '/');
            }

            header("Location: " . $beranda_url);
            exit;
        } else {
            $_SESSION['login_error'] = "Username atau password salah!";
            header("Location: " . $login_url);
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['login_error'] = "Terjadi kesalahan sistem: " . $e->getMessage();
        header("Location: " . $login_url);
        exit;
    }
} else {
    header("Location: " . $login_url);
    exit;
}
