<?php
// ==============================================================================
// SISTEM ROUTING DINAMIS - PHP_UAS
// ==============================================================================

// 1. Deteksi Base Path secara dinamis
// Mendukung instalasi di subfolder (misal: /PHP_UAS atau /projekAkhirPBW/PHP_UAS)
// maupun di root domain / Virtual Host Laragon (misal: http://php-uas.test/)
$script_name = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$base_path = ($script_name === '/' || $script_name === '.') ? '' : rtrim($script_name, '/');

// 2. Definisikan konstanta global dan fungsi pembantu (helper)
if (!defined('BASE_URL')) {
    define('BASE_URL', $base_path);
}
if (!defined('BASE_DIR')) {
    define('BASE_DIR', __DIR__);
}

if (!function_exists('base_url')) {
    function base_url($path = '') {
        $path = ltrim($path, '/');
        return BASE_URL . ($path !== '' ? '/' . $path : '');
    }
}

// 3. Resolusi Rute (Mendukung parameter query ?page=... maupun Clean URL path)
$route = '';

if (isset($_GET['page']) && trim($_GET['page']) !== '') {
    // Mode Query String: index.php?page=daftar_publikasi
    $route = trim($_GET['page'], '/');
} else {
    // Mode Clean URL: /beranda, /PHP_UAS/daftar-publikasi
    $request_uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

    // Hilangkan base_path jika ada di awal request_uri
    if ($base_path !== '' && strpos($request_uri, $base_path) === 0) {
        $request_uri = substr($request_uri, strlen($base_path));
    }

    // Hilangkan awalan /index.php jika user mengakses via index.php/...
    $request_uri = preg_replace('#^/index\.php#i', '', $request_uri);

    $route = trim($request_uri, '/');
}

// Simpan rute saat ini agar bisa diakses oleh navbar/views untuk active link styling
$current_route = $route;

// 4. Sistem Penjaluran / Dispatcher
switch ($route) {
    case '':
    case 'beranda':
    case 'home':
        require __DIR__ . '/views/beranda.php';
        break;

    case 'daftar-publikasi':
    case 'daftar_publikasi':
        require __DIR__ . '/views/daftar-publikasi.php';
        break;

    case 'galeri-publikasi':
    case 'galeri_publikasi':
        require __DIR__ . '/views/galeri-publikasi.php';
        break;

    case 'tambah-publikasi':
    case 'tambah_publikasi':
    case 'add_publication':
    case 'add-publication':
        require __DIR__ . '/views/tambah-publikasi.php';
        break;

    case 'edit-publikasi':
    case 'edit_publikasi':
    case 'edit_publication':
    case 'edit-publication':
        if (file_exists(__DIR__ . '/views/edit-publikasi.php')) {
            require __DIR__ . '/views/edit-publikasi.php';
        } elseif (file_exists(__DIR__ . '/views/edit-publication.php')) {
            require __DIR__ . '/views/edit-publication.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/views/error/404.php';
        }
        break;

    case 'hapus-publikasi':
    case 'hapus_publikasi':
    case 'remove_publication':
    case 'remove-publication':
    case 'delete-publication':
        if (file_exists(__DIR__ . '/views/hapus-publikasi.php')) {
            require __DIR__ . '/views/hapus-publikasi.php';
        } elseif (file_exists(__DIR__ . '/views/remove-publication.php')) {
            require __DIR__ . '/views/remove-publication.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/views/error/404.php';
        }
        break;

    case 'login':
        // Cek lokasi file login (views/auth/login.php atau views/login.php)
        if (file_exists(__DIR__ . '/views/auth/login.php')) {
            require __DIR__ . '/views/auth/login.php';
        } elseif (file_exists(__DIR__ . '/views/login.php')) {
            require __DIR__ . '/views/login.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/views/error/404.php';
        }
        break;

    case 'logout':
        if (file_exists(__DIR__ . '/auth/logout.php')) {
            require __DIR__ . '/auth/logout.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/views/error/404.php';
        }
        break;

    case 'login-process':
    case 'login_process':
        if (file_exists(__DIR__ . '/auth/login-process.php')) {
            require __DIR__ . '/auth/login-process.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/views/error/404.php';
        }
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/views/error/404.php';
        break;
}
