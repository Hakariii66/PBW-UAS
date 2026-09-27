<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../database/dbconn.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor = trim($_POST['nomor'] ?? '');
    $judul = trim($_POST['judul'] ?? '');
    $tanggal_rilis = trim($_POST['tanggal_rilis'] ?? '');
    $kata_kunci = trim($_POST['kata_kunci'] ?? '');
    $abstraksi = trim($_POST['abstraksi'] ?? '');
    $sampul_name = 'cover1.webp'; // Default cover jika tidak ada upload

    // Cek upload file sampul
    if (isset($_FILES['sampul']) && $_FILES['sampul']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['sampul']['name']);
        $target_dir = __DIR__ . '/../src/assets/images/Publikasi/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES['sampul']['tmp_name'], $target_file)) {
            $sampul_name = $filename;
        }
    }

    if ($judul !== '' && $tanggal_rilis !== '') {
        try {
            if ($nomor !== '' && is_numeric($nomor)) {
                $stmt = $pdo->prepare("INSERT INTO publikasi (no_urut_publikasi, judul_publikasi, tanggal_rilis_publikasi, kata_kunci_publikasi, abstraksi_publikasi, sampul_publikasi) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([(int)$nomor, $judul, $tanggal_rilis, $kata_kunci, $abstraksi, $sampul_name]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO publikasi (judul_publikasi, tanggal_rilis_publikasi, kata_kunci_publikasi, abstraksi_publikasi, sampul_publikasi) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$judul, $tanggal_rilis, $kata_kunci, $abstraksi, $sampul_name]);
            }

            $_SESSION['flash_success'] = "Publikasi baru berhasil ditambahkan!";
            header("Location: " . (function_exists('base_url') ? base_url('daftar-publikasi') : 'index.php?page=daftar_publikasi'));
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error_message = "Nomor urut publikasi tersebut sudah digunakan. Silakan gunakan nomor lain.";
            } else {
                $error_message = "Terjadi kesalahan saat menyimpan data: " . $e->getMessage();
            }
        }
    } else {
        $error_message = "Judul dan Tanggal Rilis wajib diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?= function_exists('base_url') ? base_url('src/assets/images/logo/logo.png') : '/src/assets/images/logo/logo.png' ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= function_exists('base_url') ? base_url('src/css/output.css') : '/src/css/output.css' ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Form Menambahkan Publikasi Baru</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between bg-[#f0f4f8]">
    <?php require_once __DIR__ . '/components/navbar.php'; ?>

    <main class="flex-1 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Judul Form Sesuai image2.png -->
        <h1 class="text-xl sm:text-2xl font-bold text-[#002b6a] text-center mb-8">
            Form Menambahkan Publikasi Baru
        </h1>

        <!-- Notifikasi Error jika ada -->
        <?php if (!empty($error_message)): ?>
            <div class="max-w-3xl mx-auto mb-6 p-4 rounded-lg bg-red-50 border border-red-300 text-red-800 text-sm flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation text-red-600"></i>
                    <span><?= htmlspecialchars($error_message) ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 font-bold">&times;</button>
            </div>
        <?php endif; ?>

        <!-- Container Card Form -->
        <div class="max-w-3xl mx-auto bg-[#f8f9fa] p-8 sm:p-10 rounded-lg shadow-sm border border-gray-200/60">
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                <!-- Field 1: Nomor -->
                <div>
                    <label for="nomor" class="block font-bold text-gray-900 text-sm mb-1.5">Nomor:</label>
                    <input type="number" id="nomor" name="nomor" placeholder="Masukkan nomor..."
                           class="w-full bg-white border border-gray-300 rounded px-3.5 py-2 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <!-- Field 2: Judul -->
                <div>
                    <label for="judul" class="block font-bold text-gray-900 text-sm mb-1.5">Judul:</label>
                    <input type="text" id="judul" name="judul" required placeholder="Masukkan judul..."
                           class="w-full bg-white border border-gray-300 rounded px-3.5 py-2 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <!-- Field 3: Tanggal Rilis -->
                <div>
                    <label for="tanggal_rilis" class="block font-bold text-gray-900 text-sm mb-1.5">Tanggal Rilis:</label>
                    <input type="date" id="tanggal_rilis" name="tanggal_rilis" required
                           class="w-full bg-white border border-gray-300 rounded px-3.5 py-2 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <!-- Field 4: Kata Kunci (Di bawah Tanggal Rilis) -->
                <div>
                    <label for="kata_kunci" class="block font-bold text-gray-900 text-sm mb-1.5">Kata Kunci:</label>
                    <input type="text" id="kata_kunci" name="kata_kunci" placeholder="Masukkan kata kunci..."
                           class="w-full bg-white border border-gray-300 rounded px-3.5 py-2 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>

                <!-- Field 5: Abstraksi (Di bawah Kata Kunci) -->
                <div>
                    <label for="abstraksi" class="block font-bold text-gray-900 text-sm mb-1.5">Abstraksi:</label>
                    <textarea id="abstraksi" name="abstraksi" rows="4" placeholder="Masukkan abstraksi..."
                              class="w-full bg-white border border-gray-300 rounded px-3.5 py-2 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-600"></textarea>
                </div>

                <!-- Field 6: Sampul -->
                <div>
                    <label for="sampul" class="block font-bold text-gray-900 text-sm mb-1.5">Sampul:</label>
                    <input type="file" id="sampul" name="sampul" accept="image/*"
                           class="w-full bg-white border border-gray-300 rounded px-3 py-1.5 text-sm text-gray-700 cursor-pointer">
                </div>

                <!-- Tombol Tambah -->
                <div class="pt-2">
                    <button type="submit" 
                            class="bg-[#002b6a] hover:bg-[#001e4a] text-white font-bold px-7 py-2.5 rounded shadow text-sm transition-colors cursor-pointer">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </main>

    <?php require_once __DIR__ . '/components/footer.php'; ?>
</body>
</html>