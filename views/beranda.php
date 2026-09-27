<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?= function_exists('base_url') ? base_url('src/assets/images/logo/logo.png') : '/src/assets/images/logo/logo.png' ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= function_exists('base_url') ? base_url('src/css/output.css') : '/src/css/output.css' ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Beranda</title>
    <style>
        body {
            background-image: url('<?= function_exists('base_url') ? base_url('src/assets/images/background/bg.png') : '/src/assets/images/background/bg.png' ?>');
            background-position: center; 
            background-repeat: no-repeat; 
            background-size: cover;
            font-family: Arial, Helvetica, sans-serif;
            color: white;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between">
<?php require_once __DIR__ . '/components/navbar.php'; ?>
<main class="flex-1 flex flex-col justify-center items-center px-6 py-24 text-center">
    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight drop-shadow-[0_4px_16px_rgba(0,0,0,0.95)] max-w-5xl">
        Lembaga yang Independen, Tepercaya, dan Berperan Aktif <br> 
        dalam Mendukung Perumusan Kebijakan Berbasis Data <br>
        Bersama Indonesia Maju Menuju Indonesia Emas 2045
    </h1>
</main>
<?php require_once __DIR__ . '/components/footer.php'; ?>
</body>
</html>