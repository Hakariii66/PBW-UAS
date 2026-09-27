<?php
require_once __DIR__ . '/../database/dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?= function_exists('base_url') ? base_url('src/assets/images/logo/logo.png') : '/src/assets/images/logo/logo.png' ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= function_exists('base_url') ? base_url('src/css/output.css') : '/src/css/output.css' ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Galeri Publikasi</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between">
    <?php require_once __DIR__ . '/components/navbar.php'; ?>
    <main class="flex-1 flex flex-col justify-center items-center px-6 py-24 text-center">
        <div class="grid-wrapper grid grid-cols-3 gap-2 place-items-center">
            <div class="card w-[60%] border-8 rounded-xl"><img src="<?= function_exists('base_url') ? base_url('src/assets/images/Galeri/img1.jpg') : '/src/assets/images/Galeri/img1.jpg' ?>" alt="Galeri 1"></div>
            <div class="card w-[60%] border-8 rounded-xl"><img src="<?= function_exists('base_url') ? base_url('src/assets/images/Galeri/img2.jpg') : '/src/assets/images/Galeri/img2.jpg' ?>" alt="Galeri 2"></div>
            <div class="card w-[60%] border-8 rounded-xl"><img src="<?= function_exists('base_url') ? base_url('src/assets/images/Galeri/img3.jpg') : '/src/assets/images/Galeri/img3.jpg' ?>" alt="Galeri 3"></div>
            <div class="card w-[60%] border-8 rounded-xl"><img src="<?= function_exists('base_url') ? base_url('src/assets/images/Galeri/img4.jpg') : '/src/assets/images/Galeri/img4.jpg' ?>" alt="Galeri 4"></div>
            <div class="card w-[60%] border-8 rounded-xl"><img src="<?= function_exists('base_url') ? base_url('src/assets/images/Galeri/img5.jpg') : '/src/assets/images/Galeri/img5.jpg' ?>" alt="Galeri 5"></div>
            <div class="card w-[60%] border-8 rounded-xl"><img src="<?= function_exists('base_url') ? base_url('src/assets/images/Galeri/img6.jpg') : '/src/assets/images/Galeri/img6.jpg' ?>" alt="Galeri 6"></div>
            
        </div>
    </main>
    <?php require_once __DIR__ . '/components/footer.php'; ?>
</body>
</html>