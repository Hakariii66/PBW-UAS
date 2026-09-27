<?php
require_once __DIR__ . '/../../auth/session.php';

$login_error = $_SESSION['login_error'] ?? null;
$login_success = $_SESSION['login_success'] ?? null;
unset($_SESSION['login_error'], $_SESSION['login_success']);

$is_logged = is_logged_in();
$current_user = get_logged_user();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?= function_exists('base_url') ? base_url('src/assets/images/logo/logo.png') : '/src/assets/images/logo/logo.png' ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= function_exists('base_url') ? base_url('src/css/output.css') : '/src/css/output.css' ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Login - BPS Provinsi Papua</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between bg-[#f0f4f8] text-gray-800">
    <?php require_once __DIR__ . '/../components/navbar.php'; ?>

    <main class="flex-1 flex items-center justify-center py-12 px-4 sm:px-6">
        <div class="max-w-md w-full bg-white rounded-xl shadow-md border border-gray-200 p-8 sm:p-10">
            <!-- Header Card Login -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-[#002b6a] mb-4">
                    <i class="fa-solid fa-user-shield text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-[#002b6a]">Login Admin</h1>
                <p class="text-sm text-gray-500 mt-1">Silakan masukkan username dan password Anda</p>
            </div>

            <!-- Pesan Error / Sukses -->
            <?php if ($login_error): ?>
                <div class="mb-5 p-3.5 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                    <span><?= htmlspecialchars($login_error) ?></span>
                </div>
            <?php endif; ?>

            <?php if ($login_success): ?>
                <div class="mb-5 p-3.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-emerald-500"></i>
                    <span><?= htmlspecialchars($login_success) ?></span>
                </div>
            <?php endif; ?>

            <?php if ($is_logged): ?>
                <!-- Tampilan jika sudah login -->
                <div class="text-center py-4">
                    <p class="text-sm text-gray-600 mb-2">Saat ini Anda telah login sebagai:</p>
                    <p class="text-lg font-bold text-[#002b6a] mb-6"><?= htmlspecialchars($current_user) ?></p>
                    
                    <div class="flex flex-col gap-3">
                        <a href="<?= function_exists('base_url') ? base_url('beranda') : 'index.php?page=beranda' ?>" 
                           class="w-full py-2.5 px-4 bg-[#002b6a] hover:bg-[#001e4a] text-white font-semibold rounded-lg text-sm transition-colors text-center">
                            Ke Beranda
                        </a>
                        <a href="<?= function_exists('base_url') ? base_url('logout') : 'auth/logout.php' ?>" 
                           class="w-full py-2.5 px-4 border border-red-300 text-red-600 hover:bg-red-50 font-semibold rounded-lg text-sm transition-colors text-center">
                            Keluar (Logout)
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Formulir Login -->
                <form action="<?= function_exists('base_url') ? base_url('login-process') : 'auth/login-process.php' ?>" method="POST" class="space-y-5">
                    <!-- Input Username -->
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </span>
                            <input type="text" id="username" name="username" required placeholder="Masukkan username..."
                                   class="w-full pl-10 pr-3.5 py-2.5 bg-white border border-gray-300 rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </span>
                            <input type="password" id="password" name="password" required placeholder="Masukkan password..."
                                   class="w-full pl-10 pr-3.5 py-2.5 bg-white border border-gray-300 rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Checkbox Ingat Saya (Cookies) -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-600">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                            <span>Ingat saya</span>
                        </label>
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit" 
                            class="w-full py-2.5 px-4 bg-[#002b6a] hover:bg-[#001e4a] text-white font-bold rounded-lg text-sm shadow transition-colors cursor-pointer">
                        Login
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </main>

    <?php require_once __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
