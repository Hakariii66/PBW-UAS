<?php
// Mengirimkan status HTTP 404 Not Found
header("HTTP/1.0 404 Not Found");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - 404</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 80px;
            color: #ff6b6b;
            margin-bottom: 10px;
        }
        h2 {
            margin-bottom: 20px;
        }
        p {
            color: #666;
            margin-bottom: 30px;
        }
        a {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Oops! Halaman Tidak Ditemukan</h2>
        <p>Maaf, halaman yang Anda cari mungkin sudah dihapus, dipindahkan, atau alamat URL yang Anda masukkan salah.</p>
        <a href="<?= function_exists('base_url') ? base_url('beranda') : 'index.php?page=beranda' ?>">Kembali ke Beranda</a>
    </div>
</body>
</html>
