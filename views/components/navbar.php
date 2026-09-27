<header class="nav-container w-full bg-[#002b6a] shadow-2xl">
    <div class="wrapper py-6 px-10 flex flex-col lg:flex-row items-center justify-between gap-6">
        <div class="logo-wrap flex items-center gap-4">
            <img class="w-20" src="<?= function_exists('base_url') ? base_url('src/assets/images/logo/logo.png') : '/src/assets/images/logo/logo.png' ?>" alt="logo">
            <p class="italic text-2xl text-white leading-6 font-bold uppercase">Badan Pusat Statistik <br> Provinsi Papua</p>
        </div>
        <div class="nav-wrap">
            <nav>
                <ul class="flex flex-wrap items-center gap-6 text-white text-base">
                    <li><a href="<?= function_exists('base_url') ? base_url('beranda') : 'index.php?page=beranda' ?>" class="hover:text-gray-300">Beranda</a></li>
                    <li><a href="<?= function_exists('base_url') ? base_url('daftar-publikasi') : 'index.php?page=daftar_publikasi' ?>" class="hover:text-gray-300">Daftar Publikasi</a></li>
                    <li><a href="<?= function_exists('base_url') ? base_url('galeri-publikasi') : 'index.php?page=galeri_publikasi' ?>" class="hover:text-gray-300">Galeri Publikasi</a></li>
                    <li><a href="<?= function_exists('base_url') ? base_url('tambah-publikasi') : 'index.php?page=tambah-publikasi' ?>" class="hover:text-gray-300">Tambah Publikasi</a></li>
                    <li><a href="<?= function_exists('base_url') ? base_url('login') : 'index.php?page=login' ?>" class="bg-white text-[#002b6a] px-4 py-2 rounded-lg font-bold hover:bg-gray-100">Login</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>