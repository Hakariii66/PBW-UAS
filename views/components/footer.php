<footer class="footer-container w-full min-h-[60%] bg-[#002a6b] text-white">
    <div class="wrapper py-8 px-10 md:px-14">
        <!-- Top Wrap: Berjejer Horizontal -->
        <div class="top-wrap flex flex-col md:flex-row justify-between gap-10 items-start pb-8">
            <div class="col1 flex flex-col gap-4 md:w-1/2">
                <div class="logo-wrap flex items-center gap-4">
                    <img class="w-20" src="<?= function_exists('base_url') ? base_url('src/assets/images/logo/logo.png') : '/src/assets/images/logo/logo.png' ?>" alt="logo">
                    <p class="italic text-2xl text-white leading-6 font-bold uppercase">Badan Pusat Statistik <br> Provinsi Papua</p>
                </div>
                <address class="not-italic text-sm text-gray-200 leading-relaxed">
                    Badan Pusat Statistik Provinsi Papua <a href="https://maps.app.goo.gl/CmyxjAHoG6BHy3Ak9"><i class="fa-solid fa-location-dot"></i></a> <br>
                    (BPS-Statistics of Papua Province) <br>
                    Jl. Dr. Sam Ratulangi Dok II Jayapura 99112 <br>
                    Telp. (0967) 5165 999; 5165 107 <br>
                    Hp : 0821 24 535 535 &nbsp; Email : pst9400@bps.go.id
                </address>
                <div class="banner bg-white rounded-2xl p-2 w-[70%] max-w-xs shadow">
                    <img class="w-full h-auto" src="<?= function_exists('base_url') ? base_url('src/assets/images/banner/banner_BerAhlak.png') : '/src/assets/images/banner/banner_BerAhlak.png' ?>" alt="banner">
                </div>
            </div>
            <div class="col2 flex flex-col gap-2">
                <h4 class="font-bold text-white text-lg">Tentang Kami</h4>
                <ul class="space-y-1 text-sm">
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">Profil BPS</a></li>
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">PPID</a></li>
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">Kebijakan Diseminasi</a></li>
                </ul>
            </div>
            <div class="col3 flex flex-col gap-2">
                <h4 class="font-bold text-white text-lg">Tautan Lainnya</h4>
                <ul class="space-y-1 text-sm">
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">ASEAN Stats</a></li>
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">Reformasi Birokrasi</a></li>
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">Layanan Pengadaan Secara Elektronik</a></li>
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">Politeknik Statistika STIS</a></li>
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">Pusdiklat BPS</a></li>
                    <li><a class="hover:text-blue-300 text-gray-300" href="#">JDIH BPS</a></li>
                </ul>
            </div>
        </div>
        <hr class="border-white/20 my-6">
        <!-- Bottom Wrap: Hak Cipta & Icon Sosmed -->
        <div class="bottom-wrap flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="copyright text-sm text-gray-200">
                <p>Created by Athaya Daffa Winata (222413514@stis.ac.id)</p>
            </div>
            <div class="social-media flex items-center gap-3">
                <div class="icon bg-[#0867fe] w-12 h-12 text-white rounded-full flex justify-center items-center hover:scale-110 transition-transform">
                    <a href="https://www.facebook.com/bpspapua94/" id="1">
                        <i class="fa-brands fa-facebook-f"></i>  
                    </a>
                </div>
                <div class="icon bg-[#ea32aa] w-12 h-12 text-white rounded-full flex justify-center items-center hover:scale-110 transition-transform">
                    <a href="https://www.instagram.com/bpspapua/" id="2">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
                <div class="icon bg-black w-12 h-12 text-white rounded-full flex justify-center items-center hover:scale-110 transition-transform">
                    <a href="https://x.com/bps_statistics" id="3">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </div>
                <div class="icon bg-red-600 w-12 h-12 text-white rounded-full flex justify-center items-center hover:scale-110 transition-transform">
                    <a href="https://www.youtube.com/channel/UCHt_0w9GM-y5sNzSWtjGtkA" id="4">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>