<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../database/dbconn.php';

// Menangani Aksi POST: Edit dan Hapus Publikasi
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $redirect_url = function_exists('base_url') ? base_url('daftar-publikasi') : 'index.php?page=daftar_publikasi';

    // 1. Fungsi Hapus Publikasi
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $stmt = $pdo->prepare("DELETE FROM publikasi WHERE no_urut_publikasi = ?");
            $stmt->execute([$id]);
            $_SESSION['flash_success'] = "Publikasi berhasil dihapus dari database.";
        } else {
            $_SESSION['flash_error'] = "ID publikasi tidak valid.";
        }
        header("Location: " . $redirect_url);
        exit;
    }

    // 2. Fungsi Edit Publikasi
    if ($action === 'edit') {
        $id = (int)($_POST['id'] ?? 0);
        $judul = trim($_POST['judul_publikasi'] ?? '');
        $tanggal = trim($_POST['tanggal_rilis_publikasi'] ?? '');
        $kata_kunci = trim($_POST['kata_kunci_publikasi'] ?? '');
        $abstraksi = trim($_POST['abstraksi_publikasi'] ?? '');
        $sampul = trim($_POST['sampul_publikasi'] ?? '');

        // Cek jika ada file sampul baru yang diunggah
        if (isset($_FILES['file_sampul']) && $_FILES['file_sampul']['error'] === UPLOAD_ERR_OK) {
            $filename = basename($_FILES['file_sampul']['name']);
            $target_dir = __DIR__ . '/../src/assets/images/Publikasi/';
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            if (move_uploaded_file($_FILES['file_sampul']['tmp_name'], $target_dir . $filename)) {
                $sampul = $filename;
            }
        }

        if ($id > 0 && $judul !== '' && $tanggal !== '') {
            $stmt = $pdo->prepare("UPDATE publikasi SET judul_publikasi = ?, tanggal_rilis_publikasi = ?, kata_kunci_publikasi = ?, abstraksi_publikasi = ?, sampul_publikasi = ? WHERE no_urut_publikasi = ?");
            $stmt->execute([$judul, $tanggal, $kata_kunci, $abstraksi, $sampul, $id]);
            $_SESSION['flash_success'] = "Data publikasi berhasil diperbarui di database.";
        } else {
            $_SESSION['flash_error'] = "Gagal memperbarui: Judul dan Tanggal Rilis wajib diisi.";
        }
        header("Location: " . $redirect_url);
        exit;
    }
}

// Ambil semua data publikasi dari database
$stmt = $pdo->query("SELECT * FROM publikasi ORDER BY no_urut_publikasi ASC");
$publikasi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil daftar file sampul yang tersedia di folder src/assets/images/Publikasi
$cover_dir = __DIR__ . '/../src/assets/images/Publikasi';
$available_covers = [];
if (is_dir($cover_dir)) {
    foreach (scandir($cover_dir) as $f) {
        if (preg_match('/\.(webp|jpg|jpeg|png)$/i', $f)) {
            $available_covers[] = $f;
        }
    }
}

// Format Tanggal Indonesia
function format_tanggal_indonesia($date_str) {
    if (!$date_str || $date_str === '0000-00-00') return '-';
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $timestamp = strtotime($date_str);
    if (!$timestamp) return $date_str;
    $d = date('j', $timestamp);
    $m = (int)date('n', $timestamp);
    $y = date('Y', $timestamp);
    return $d . ' ' . ($bulan[$m] ?? '') . ' ' . $y;
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
    <title>Daftar Publikasi BPS Provinsi Papua</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between bg-[#f8fafc] text-gray-800">
<?php require_once __DIR__ . '/components/navbar.php'; ?>

<main class="flex-1 py-10 px-4 sm:px-6 lg:px-8 max-w-[1440px] w-full mx-auto">
    <!-- Judul Halaman Sesuai image.png -->
    <h1 class="text-xl sm:text-2xl font-bold text-[#002b6a] text-center mb-6">
        Daftar Publikasi BPS Provinsi Papua
    </h1>

    <!-- Notifikasi Flash Message -->
    <?php if ($flash_success): ?>
        <div class="mb-4 p-4 rounded-lg bg-emerald-50 border border-emerald-300 text-emerald-800 text-sm flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                <span><?= htmlspecialchars($flash_success) ?></span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 font-bold">&times;</button>
        </div>
    <?php endif; ?>

    <?php if ($flash_error): ?>
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-300 text-red-800 text-sm flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation text-red-600"></i>
                <span><?= htmlspecialchars($flash_error) ?></span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 font-bold">&times;</button>
        </div>
    <?php endif; ?>

    <!-- Tabel Layout Persis image.png -->
    <div class="overflow-x-auto shadow-sm border border-gray-200 rounded bg-white">
        <table class="w-full border-collapse text-left text-sm">
            <!-- Header Tabel -->
            <thead>
                <tr class="bg-[#002b6a] text-white">
                    <th scope="col" class="py-3 px-3 text-center font-bold border border-[#002b6a] w-12">No</th>
                    <th scope="col" class="py-3 px-4 text-center md:text-left font-bold border border-[#002b6a] w-52">Judul Publikasi</th>
                    <th scope="col" class="py-3 px-4 text-center md:text-left font-bold border border-[#002b6a] w-36 whitespace-nowrap">Tanggal Rilis</th>
                    <th scope="col" class="py-3 px-4 text-center md:text-left font-bold border border-[#002b6a] w-48">Kata Kunci</th>
                    <th scope="col" class="py-3 px-4 text-center font-bold border border-[#002b6a]">Abstraksi</th>
                    <th scope="col" class="py-3 px-3 text-center font-bold border border-[#002b6a] w-28">Sampul</th>
                    <th scope="col" class="py-3 px-3 text-center font-bold border border-[#002b6a] w-36">Edit</th>
                </tr>
            </thead>
            <!-- Isi Baris Tabel dari Database -->
            <tbody class="divide-y divide-gray-200">
                <?php if (empty($publikasi_list)): ?>
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-500 font-medium">
                            Belum ada data publikasi di database.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($publikasi_list as $index => $row): ?>
                        <tr class="<?= ($index % 2 === 1) ? 'bg-[#f4f7fb]' : 'bg-white' ?> hover:bg-blue-50/60 transition-colors">
                            <!-- Kolom 1: No -->
                            <td class="py-4 px-3 text-center align-top border border-gray-200 font-medium text-gray-800">
                                <?= $index + 1 ?>
                            </td>

                            <!-- Kolom 2: Judul Publikasi -->
                            <td class="py-4 px-4 align-top border border-gray-200 font-bold text-gray-900 leading-snug">
                                <?= htmlspecialchars($row['judul_publikasi']) ?>
                            </td>

                            <!-- Kolom 3: Tanggal Rilis -->
                            <td class="py-4 px-4 align-top border border-gray-200 text-gray-800 whitespace-nowrap font-normal">
                                <?= format_tanggal_indonesia($row['tanggal_rilis_publikasi']) ?>
                            </td>

                            <!-- Kolom 4: Kata Kunci -->
                            <td class="py-4 px-4 align-top border border-gray-200 text-gray-800 font-medium leading-relaxed">
                                <?= htmlspecialchars($row['kata_kunci_publikasi']) ?>
                            </td>

                            <!-- Kolom 5: Abstraksi -->
                            <td class="py-4 px-4 align-top border border-gray-200 text-gray-700 text-justify text-xs sm:text-sm leading-relaxed">
                                <?= nl2br(htmlspecialchars($row['abstraksi_publikasi'])) ?>
                            </td>

                            <!-- Kolom 6: Sampul -->
                            <td class="py-4 px-3 align-middle text-center border border-gray-200">
                                <div class="flex justify-center items-center">
                                    <?php 
                                    $cover_file = $row['sampul_publikasi'];
                                    $cover_path = function_exists('base_url') ? base_url('src/assets/images/Publikasi/' . $cover_file) : '/src/assets/images/Publikasi/' . $cover_file;
                                    ?>
                                    <img src="<?= $cover_path ?>" 
                                        alt="<?= htmlspecialchars($row['judul_publikasi']) ?>" 
                                        class="w-16 sm:w-20 h-auto max-h-28 object-contain rounded shadow-sm border border-gray-200 bg-white"
                                        onerror="this.onerror=null; this.src='<?= function_exists('base_url') ? base_url('src/assets/images/logo/logo.png') : '/src/assets/images/logo/logo.png' ?>';">
                                </div>
                            </td>

                            <!-- Kolom 7: Edit & Hapus (Sebelah Kolom Sampul) -->
                            <td class="py-4 px-3 align-middle text-center border border-gray-200">
                                <div class="flex flex-col gap-2 items-center justify-center">
                                    <!-- Tombol Edit -->
                                    <button type="button" 
                                            onclick='openEditModal(<?= json_encode($row, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)' 
                                            class="w-full max-w-[90px] inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded text-xs font-semibold shadow-sm transition-colors cursor-pointer">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus publikasi \'<?= htmlspecialchars(addslashes($row['judul_publikasi'])) ?>\' secara permanen dari database?');" class="w-full max-w-[90px]">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $row['no_urut_publikasi'] ?>">
                                        <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-semibold shadow-sm transition-colors cursor-pointer">
                                            <i class="fa-solid fa-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<!-- Modal Edit Publikasi -->
<div id="editModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full p-6 sm:p-8 overflow-hidden max-h-[90vh] flex flex-col">
        <!-- Header Modal -->
        <div class="flex items-center justify-between border-b pb-4 mb-4">
            <h3 class="text-xl font-bold text-[#002b6a] flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-amber-500"></i>
                <span>Edit Atribut Publikasi</span>
            </h3>
            <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-700 text-2xl font-bold leading-none cursor-pointer">&times;</button>
        </div>

        <!-- Form Edit Publikasi -->
        <form method="POST" enctype="multipart/form-data" class="space-y-4 overflow-y-auto pr-1 flex-1">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" id="edit_id">

            <!-- Judul Publikasi -->
            <div>
                <label for="edit_judul" class="block text-sm font-semibold text-gray-700 mb-1">Judul Publikasi *</label>
                <input type="text" name="judul_publikasi" id="edit_judul" required
                       class="w-full px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Tanggal Rilis & Kata Kunci -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="edit_tanggal" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Rilis *</label>
                    <input type="date" name="tanggal_rilis_publikasi" id="edit_tanggal" required
                           class="w-full px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="edit_kata_kunci" class="block text-sm font-semibold text-gray-700 mb-1">Kata Kunci</label>
                    <input type="text" name="kata_kunci_publikasi" id="edit_kata_kunci"
                           class="w-full px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Abstraksi -->
            <div>
                <label for="edit_abstraksi" class="block text-sm font-semibold text-gray-700 mb-1">Abstraksi Publikasi</label>
                <textarea name="abstraksi_publikasi" id="edit_abstraksi" rows="4"
                          class="w-full px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Pilihan Sampul dari folder src/assets/images/Publikasi -->
            <div>
                <label for="edit_sampul" class="block text-sm font-semibold text-gray-700 mb-1">File Gambar Sampul</label>
                <div class="flex items-center gap-4">
                    <select name="sampul_publikasi" id="edit_sampul" onchange="updateCoverPreview(this.value)"
                            class="flex-1 px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php foreach ($available_covers as $cover): ?>
                            <option value="<?= htmlspecialchars($cover) ?>"><?= htmlspecialchars($cover) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img id="cover_preview" src="" alt="Preview Sampul" class="w-12 h-16 object-contain rounded border border-gray-300 shadow-sm bg-gray-50">
                </div>
                <p class="text-xs text-gray-500 mt-1">Atau unggah file gambar sampul baru di bawah ini:</p>
                <input type="file" name="file_sampul" accept="image/*" class="mt-1 text-xs text-gray-600">
            </div>

            <!-- Tombol Aksi Modal -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t mt-4">
                <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" 
                        class="px-5 py-2 bg-[#002b6a] hover:bg-blue-900 text-white rounded-lg text-sm font-semibold shadow-md transition-colors cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(data) {
    document.getElementById('edit_id').value = data.no_urut_publikasi || '';
    document.getElementById('edit_judul').value = data.judul_publikasi || '';
    document.getElementById('edit_tanggal').value = data.tanggal_rilis_publikasi || '';
    document.getElementById('edit_kata_kunci').value = data.kata_kunci_publikasi || '';
    document.getElementById('edit_abstraksi').value = data.abstraksi_publikasi || '';
    
    const sampulSelect = document.getElementById('edit_sampul');
    if (sampulSelect) {
        sampulSelect.value = data.sampul_publikasi || '';
        updateCoverPreview(data.sampul_publikasi || '');
    }
    
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function updateCoverPreview(filename) {
    const preview = document.getElementById('cover_preview');
    if (filename) {
        const basePath = '<?= function_exists('base_url') ? base_url('src/assets/images/Publikasi/') : '/src/assets/images/Publikasi/' ?>';
        preview.src = basePath + filename;
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
}

// Tutup modal jika user klik di luar kotak modal
window.addEventListener('click', function(e) {
    const modal = document.getElementById('editModal');
    if (e.target === modal) {
        closeEditModal();
    }
});
</script>

<?php require_once __DIR__ . '/components/footer.php'; ?>
</body>
</html>