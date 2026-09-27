-- phpMyAdmin SQL Dump
-- Database: `phpuas`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Table structure for table `publikasi`
--

CREATE TABLE IF NOT EXISTS `publikasi` (
  `no_urut_publikasi` int NOT NULL AUTO_INCREMENT,
  `judul_publikasi` varchar(100) NOT NULL,
  `tanggal_rilis_publikasi` date NOT NULL,
  `kata_kunci_publikasi` varchar(100) NOT NULL,
  `abstraksi_publikasi` text NOT NULL,
  `sampul_publikasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`no_urut_publikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publikasi`
--

INSERT INTO `publikasi` (`no_urut_publikasi`, `judul_publikasi`, `tanggal_rilis_publikasi`, `kata_kunci_publikasi`, `abstraksi_publikasi`, `sampul_publikasi`) VALUES
(1, 'Pengeluaran untuk Konsumsi Penduduk Papua Tahun 2025', '2026-02-27', 'Pengeluaran, Konsumsi, Penduduk', 'Buku ini memuat data keadaan ekonomi penduduk dari hasil Susenas Tahun 2025. Publikasi ini dimaksudkan untuk memberikan gambaran mengenai tingkat konsumsi dari berbagai lapisan masyarakat di Provinsi Papua, termasuk sajian data dalam satuan kalori dan protein. Data distribusi dan ketimpangan pendapatan juga melengkapi publikasi ini.', 'cover1.webp'),
(2, 'Luas Panen dan Produksi Padi di Provinsi Papua 2025', '2026-03-05', 'Pertanian, Luas Lahan, Petani', 'endataan Statistik Pertanian Tanaman Pangan Terintegrasi dengan Metode Kerangka Sampel Area (KSA) merupakan kegiatan yang dilaksanakan melalui kolaborasi antara Badan Pusat Statistik (BPS) dengan Badan Pengkajian dan Penerapan Teknologi (BPPT) dan Lembaga Penerbangan dan Antariksa Nasional (LAPAN) yang sekarang bergabung menjadi Badan Riset dan Inovasi Nasional (BRIN), Kementerian Agraria dan Tata Ruang/Badan Pertanahan Nasional (Kementerian ATR/BPN), serta Badan Informasi Geospasial (BIG). Kegiatan ini mulai diimplementasikan secara nasional pada tahun 2018 sebagai upaya untuk meningkatkan kualitas statistik pertanian tanaman pangan melalui pemanfaatan teknologi penginderaan jauh, sistem informasi geospasial, dan pengamatan lapangan.', 'cover2.webp'),
(3, 'Pengeluaran untuk Konsumsi Penduduk Papua Tengah Tahun 2025', '2026-03-02', 'Pengeluaran, Konsumsi, Rumah Tangga', 'Buku ini memuat data keadaan ekonomi penduduk dari hasil Susenas Tahun 2025. Publikasi ini dimaksudkan untuk memberikan gambaran mengenai tingkat konsumsi dari berbagai lapisan masyarakat di Provinsi Papua Tengah, termasuk sajian data dalam satuan kalori dan protein. Data distribusi dan ketimpangan pendapatan juga melengkapi publikasi ini.', 'cover3.webp'),
(4, 'Indikator Penting Provinsi Papua Selatan, Edisi Agustus 2026', '2026-01-30', 'SDM, IPM, Pertumbuhan Ekonomi', 'Indikator Penting Provinsi Papua Selatan merupakan publikasi yang diterbitkan secara berkala setiap bulannya. Publikasi ini merangkum berbagai data terbaru, baik ekonomi maupun sosial, yang dirilis oleh Badan Pusat Statistik Provinsi Papua. Rangkuman data ini ditujukan sebagai salah satu bahan bagi penyusunan kebijakan dan evaluasi pembangunan di Provinsi Papua Selatan. Beberapa indikator yang tercakup dalam publikasi ini di antaranya Inflasi, Nilai Tukar Petani (NTP), Transportasi, Pariwisata, Pertumbuhan Ekonomi, Indeks Pembangunan Manusia (IPM), Kemiskinan, Ketimpangan Pendapatan, Ketenagakerjaan, Penduduk, Pertanian, dan sebagainya.', 'cover4.webp'),
(5, 'Pengeluaran untuk Konsumsi Penduduk Papua Pegunungan Tahun 2025', '2023-12-30', 'Perkotaan, Perdesaan', 'Buku ini memuat data keadaan ekonomi penduduk dari hasil Susenas Tahun 2025. Publikasi ini dimaksudkan untuk memberikan gambaran mengenai tingkat konsumsi dari berbagai lapisan masyarakat di Provinsi Papua Pegunungan, termasuk sajian data dalam satuan kalori dan protein. Data distribusi dan ketimpangan pendapatan juga melengkapi publikasi ini.', 'cover5.webp'),
(6, 'Indikator Pendidikan Provinsi Papua Pegunungan Tahun 2025', '2026-09-27', 'Pendidikan, SDM', 'Pendidikan menjadi salah satu kunci dari arah pembangunan Sumber Daya Manusia (SDM) yaitu membangun SDM tangguh yang dinamis, produktif, terampil, menguasai ilmu pengetahuan dan teknologi didukung dengan kerja sama industri dan talenta global. Peningkatan kualitas dan daya saing SDM diharapkan dapat mencetak generasi penerus bangsa yang sehat, cerdas, adaptif, inovatif, terampil, serta berkarakter. Indikator Pendidikan Provinsi Papua Pegunungan Tahun 2025 sebagai salah satu potret pendidikan yang menggambarkan kondisi Pendidikan Papua Pegunungan berdasarkan hasil Susenas Maret 2025. Data yang disajikan mencakup beberapa indikator utama proses dan output pendidikan. Selain itu juga disajikan data hasil registrasi sekolah yang dikumpulkan oleh Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi untuk Tahun Ajaran 2024/2025. Data ini memuat informasi mengenai input pendidikan yang mencakup data jumlah sekolah, peserta didik, pendidik, sarana prasarana pendidikan, dan sanitasi sekolah. Semoga publikasi ini bermanfaat bagi semua pihak, terutama yang berkepentingan dalam pengembangan dan pembangunan di bidang pendidikan.', 'cover6.webp');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', '$2y$12$4.LGroHEG3SOB8VzWf3kCuzT0mwDnEiqjn4qHcAQx6JTjhbtKzUVm')
ON DUPLICATE KEY UPDATE `password` = VALUES(`password`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
