-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2020 pada 15.36
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mpnj`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$Gy/Rbe4SUqjX8Vx/gZpXIemMxBxGBT7XIpU/5cKP8f3e8pK8mIsqe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `nama_provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `nama_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `nama_kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `santri` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `wilayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kamar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_santri` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `nama`, `nomor_telepon`, `provinsi_id`, `nama_provinsi`, `city_id`, `nama_kota`, `kecamatan_id`, `nama_kecamatan`, `kode_pos`, `alamat_lengkap`, `santri`, `wilayah`, `kamar`, `alamat_santri`, `user_id`) VALUES
(1, 'M. Ilham Surya Pratama', '085330150827', 9, 'Jawa Barat', 79, 'Kota Bogor', 1065, 'Bogor Timur - Kota', '67267', 'Dusun Paleran RT 011 RW 003 Desa Maron Wetan', 'N', NULL, NULL, NULL, 3),
(2, 'Indra Irawanto', '085330150827', 9, 'Jawa Barat', 55, 'Kota Bekasi', 752, 'Bekasi Timur', '67276', 'Dusun Paleran RT 011 RW 003 Desa Maron Wetan', 'N', NULL, NULL, NULL, 2),
(3, 'Yolo', '085330150822', 11, 'Jawa Timur', 369, 'Kabupaten Probolinggo', 5154, 'Maron', '67276', 'Dusun Krajan II RT 03 RW 001 Desan Maron Wetan', 'N', NULL, NULL, NULL, 5),
(10, 'M. Ilham Surya Pratama', '085330150827', 11, 'Jawa Timur', 369, 'Kabupaten Probolinggo', 5154, 'Maron', '67276', 'Dusun Paleran RT 011 RW 003', 'N', NULL, NULL, NULL, 1),
(11, 'Yolo', '085330150882', 5, 'DI Yogyakarta', 210, 'Kabupaten Kulon Progo', 2933, 'Kokap', '67276', 'Indramayu Pasar Minggu', 'N', NULL, NULL, NULL, 1),
(13, 'Yayos', '085333444555', 11, 'Jawa Timur', 160, 'Kabupaten Jember', 2208, 'Jenggawah', '67665', 'RT 09 RW 001 Dusun Makmur', 'N', NULL, NULL, NULL, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `id_bank` int(10) UNSIGNED NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`id_bank`, `nama_bank`) VALUES
(1, 'BNI'),
(2, 'Mandiri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banners`
--

CREATE TABLE `banners` (
  `id_banner` int(10) UNSIGNED NOT NULL,
  `nama_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banners`
--

INSERT INTO `banners` (`id_banner`, `nama_banner`, `foto_banner`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Yolo', '_home_petualangansuper_public_html_cache_news_2017_04_12_4866352265a4_resize_750_500_rel_left_top.jpg', 'Y', '2020-06-09 10:53:37', '2020-06-09 10:55:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id_foto_produk` int(10) UNSIGNED NOT NULL,
  `foto_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `foto_produk`
--

INSERT INTO `foto_produk` (`id_foto_produk`, `foto_produk`, `produk_id`) VALUES
(1, 'd92a18ebec15130e9bddb19dc23c3330.jpg', 1),
(2, '57c9268cb4ee97cba3c65e1279c06e2c.jpg', 1),
(3, '8993900a34bd873c57c157a0d2551830.jpg', 1),
(4, '51348e7dbbb7ed49d1e160e704ba62b3.jpg', 2),
(5, '6a8b437185a4cf2a519438b2221ce0a4.jpg', 2),
(6, '86549e142f0b82768523cbb6157072f5.jpg', 3),
(7, 'e15464836535e9243b174b26ab3c7202.jpg', 3),
(8, '3e3e363049f246a529f1c1f45aae8b72.jpg', 4),
(9, 'ca08e46dc2d1ead4cca43f960f5d85a7.jpg', 4),
(10, '5e646d74d5f25a6082b3b77d08b9a37b.jpg', 5),
(11, 'e86b74ae607043b7c937534c17d83b66.jpg', 5),
(12, '0a3c83bab3957c9086e5304cc191191c.jpg', 6),
(13, 'fd48a8bb5b7c9e4a6694f73ea3d7cfb1.jpg', 7),
(14, 'cb6910633f62f1cd0df4c909c62fb03d.jpg', 8),
(15, '59dad3e3e13a3f7ff40a2e4b1b0b4999.jpg', 8),
(16, '00e4182993f042abb23354f8548ea57e.jpg', 8),
(17, 'af49afeabef7e12c47f575c145575e6d.jpg', 9),
(18, '9899066ef565a37be3ab10f170425d49.jpg', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori_produk` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori_produk`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Elektronik'),
(4, 'Smartphone'),
(5, 'Laptop'),
(6, 'Sepatu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `kurir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ongkir` int(11) NOT NULL DEFAULT 0,
  `etd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `produk_id`, `user_id`, `status`, `jumlah`, `harga_jual`, `kurir`, `service`, `ongkir`, `etd`, `created_at`, `updated_at`) VALUES
(17, 6, 2, 'N', 1, 150000, 'jne', 'YES', 40000, '1-1', '2020-06-23 22:47:39', '2020-06-24 02:08:40'),
(18, 7, 2, 'N', 1, 150000, 'jne', 'YES', 40000, '1-1', '2020-06-23 22:47:59', '2020-06-24 02:08:40'),
(19, 8, 2, 'N', 1, 2000000, NULL, NULL, 0, NULL, '2020-06-23 22:48:03', '2020-06-23 23:37:43'),
(20, 5, 2, 'N', 1, 3500000, NULL, NULL, 0, NULL, '2020-06-23 22:48:43', '2020-06-24 02:07:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_konfirmasi` int(10) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_transfer` int(11) NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transfer` datetime NOT NULL DEFAULT current_timestamp(),
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_konfirmasi` datetime DEFAULT NULL,
  `rekening_admin_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `kode_transaksi`, `total_transfer`, `nama_pengirim`, `tanggal_transfer`, `bukti_transfer`, `waktu_konfirmasi`, `rekening_admin_id`) VALUES
(1, '1591368261', 88000, 'M. Ilham Surya Pratama', '2020-06-11 00:00:00', '_home_petualangansuper_public_html_cache_news_2017_04_12_4866352265a4_resize_750_500_rel_left_top.jpg', NULL, 1),
(2, '1591887362', 165000, 'M. Ilham Surya Pratama', '2020-06-11 00:00:00', '5d3028a42c37f.jpeg', NULL, 1),
(3, '1591887513', 254000, 'M. Ilham Surya Pratama', '2020-06-11 00:00:00', '3fe9cfd9-c323-4b91-b530-81268de86b24.jpg', NULL, 1),
(4, '1592718403', 164000, 'Indra Irawanto', '2020-06-21 00:00:00', '5d3028a42c37f.jpeg', NULL, 1),
(5, '1592925246', 2540000, 'Indra Irawanto', '2020-06-23 00:00:00', '5db7fa09ab4cf.png', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_30_151524_create_produk_table', 1),
(5, '2019_12_30_163537_create_kategori_produk_table', 1),
(6, '2019_12_30_163700_add_kategori_produk_id_on_produk', 1),
(7, '2019_12_31_035113_create_rekening_pelapak_table', 1),
(8, '2019_12_31_113317_create_foto_produk_table', 1),
(9, '2020_01_08_185357_create_keranjang_table', 1),
(10, '2020_01_13_085806_create_transaksi_table', 1),
(11, '2020_01_13_091643_create_transaksi_detail_table', 1),
(12, '2020_01_17_201414_create_konfirmasi_table', 1),
(13, '2020_02_03_162608_create_alamat_table', 1),
(14, '2020_02_06_070157_add_alamat_utama_to_konsumen', 1),
(15, '2020_02_25_162319_create_reviews_table', 1),
(16, '2020_03_18_170427_create_withdraw_table', 1),
(17, '2020_03_18_170708_create_bank_table', 1),
(18, '2020_03_18_170845_create_rekening_admin_table', 1),
(19, '2020_03_18_172048_add_rekening_admin_to_konfirmasi', 1),
(20, '2020_05_03_000835_create_jobs_table', 1),
(21, '2020_05_17_135033_add_alamat_order_filed_to_transaksi', 1),
(22, '2020_05_17_142529_add_from_field_to_transaksi_detail', 1),
(23, '2020_05_23_135750_create_admin_table', 1),
(24, '2020_05_25_194109_add_bank_id_to_rekening_pelapak', 1),
(25, '2020_05_31_085131_create_banners_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat` int(11) NOT NULL DEFAULT 0,
  `harga_modal` int(11) NOT NULL DEFAULT 0,
  `harga_jual` int(11) NOT NULL DEFAULT 0,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_produk` enum('single','varian') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single',
  `user_id` int(10) UNSIGNED NOT NULL,
  `wishlist` int(11) NOT NULL DEFAULT 0,
  `terjual` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori_produk_id` int(10) UNSIGNED NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `slug`, `satuan`, `berat`, `harga_modal`, `harga_jual`, `diskon`, `stok`, `keterangan`, `foto`, `tipe_produk`, `user_id`, `wishlist`, `terjual`, `created_at`, `updated_at`, `kategori_produk_id`, `status`) VALUES
(1, 'Adidas TeamVision Black List White', 'adidas-teamvision-black-list-white', 'pcs', 5, 70000, 80000, 0, 100, '<p>Kami menjual sepatu olahraga running, lari, futsal, badminton. 100% ORIGINAL</p>\r\n\r\n<p>Sepatu PRO ATT adalah sepatu yang diproduksi oleh PT. INTIDRAGON SURYATAMA (ISO 90001) di Mojokerto Indonesia yang terkenal dengan kekuatannya dari jaman dahulu, Sol yang dipress oleh pabrik sehingga tidak mudah jebol dan rusak, Nyaman dipakai, Design stylish dan attractive</p>\r\n\r\n<p>Keunggulan produk ini: - Original 100% PRO ATT - Kualitas istimewa standar pabrik - Bahan PVC, Tekstil, EVA yang terjamin - Sol karet Injection Kuat khas pabrik anti licin - Nyaman digunakan ~ Design keren ~ Bonus gantungan kunci</p>\r\n', NULL, 'single', 2, 0, 3, '2020-04-09 17:00:00', '2020-06-20 00:32:14', 6, 'aktif'),
(2, 'Converse Allstar CT Mono Full White Putih Low Pria Wanita Couple', 'converse-allstar-ct-mono-full-white-putih-low-pria-wanita-couple', 'pcs', 150, 90000, 950000, 10, 100, '<p>barang yang kami jual adalah sesuai dengan gambar kami menjual produk lokal dengan kualitas terbaik karna kami suplayer tangan pertama Stock kami selau tersedia dan siap di kirim ke alamat anda Kualitas Terjamin 100% terbaik Siap menerima Partai besar/Grosir dengan harga yang jauh dari harga satuan menerima juga Reseller dan Dropshipper Silahkan Bandingkan Kualitas dan Harga kami Dengan Toko sebelah Untung sedikit yg penting berkah amanah dan lancar Sepatu bisa di tukar bila kebesaran ataupun kekecilan yg penting kondisi sepatu masih seperti pertama di terima..</p>\r\n\r\n<p>Sambil kakak santai silahkan mainkan jari kakak untuk Berinteraksi Bersama kami dan dapatkan harga termurah darI GREENLAKESTORE</p>\r\n', NULL, 'single', 2, 0, 4, '2020-04-09 17:00:00', '2020-06-20 00:32:14', 6, 'aktif'),
(3, 'Allstar CT Mono Full White Putih Low Pria Wanita Couple', 'allstar-ct-mono-full-white-putih-low-pria-wanita-couple', 'pcs', 12, 70000, 85000, 10, 100, '<p>*Nama produk, photo dan deskripsi dari toko kami yang di pakai toko lain dengan harga murah, kakak harus lebih smart, teliti dan berhati hati.</p>\r\n\r\n<p>*Queen_wedges309 mengutamakan kepuasan customer ( silahkan kakak cek di ulasan kami ya kak) *harga menjamin kualitas barang.</p>\r\n\r\n<p>*pengemasan dijamin rapih.</p>\r\n\r\n<p>*100% barang baru melalui kualitas kontrol yang baik. Kami jual produk lokal dengan harga kompetitif dan kualitas terbaik ya kak, dan bisa di bandingkan dengan sebelah.</p>\r\n\r\n<p>*di toko kami juga menerima orderan dengan jumlah besar, baik itu partaian, atau untuk dijual kembali.</p>\r\n\r\n<p>*barang boleh sama, tapi kualitas barang bisa kami jamin berbeda. Karena tujuan kami memberikan kepuasan dan kenyamanan kepada costumer.</p>\r\n\r\n<p>*melayani 24 jam, dengan fast respon dan ramah.</p>\r\n\r\n<p>*utamakan tanyakan dulu barang yang mau dipesan, karena barang tidak selalu ready. Barang yang dikirim sesuai dengan pesanan dan gambar.</p>\r\n\r\n<p>*orderan langsung dikirim di hari pemesanan setelah melakukan transaksi atau transfer.</p>\r\n\r\n<p>*ingattt !!! Cantumkan size dan warna sepatu yang anda pesan dan selalu pantau juga toko kami di shopee . karena selalu ada produk baru di setiap harinya SELAMAT BERBELANJA Salam manis dari kami Queen_wedges309</p>\r\n', NULL, 'single', 2, 0, 7, '2020-04-09 17:00:00', '2020-06-20 00:32:14', 6, 'aktif'),
(4, 'DELL Latitude E-Series Core I5-M2520', 'dell-latitude-e-series-core-i5-m2520', 'pcs', 150, 3000000, 4500000, 0, 100, 'Dell Latitude E-Series \r\n\r\nBONUS(Free)\r\n- FREE  INTALASI PROGRAM  ( LAPTOP SIAP PAKAI )\r\n- FREE BUBLE + ASURANSI \r\nRECOMDED JNE\r\n(dijamin 100% Aman untk Pengiriman Luar kota/luar pulau)\r\n\r\nSPESIFIKASI :\r\nProcessor : Intel Core i5-M520 / i5-M2520 CPU 2.40GHz \r\nRAM : 2X2048 MB DDR3 (4 GB Pc3 10600 ) \r\nHarddisk : 250 GB \r\nVGA : Intel HD Graphics, Dedicated 64 MB, Shared 1632 MB, Up to 1696 MB \r\nBaterai : 6 / 9 Cell \r\nFitur : WiFi, DVD, Cardreader, 4 port USB 2.0, VGAa out, IEEE 1394a connector, Express Card Slot, Broadcom NetXtreme Gigabit Ethernet \r\nLayar : 13\",14\",15\" LED (WXGA 1280X800) (kirim random)\r\nBerat Barang : 2.5 Kg \r\nBerat Kemasan : 3.4 Kg \r\nUkuran Barang : 33.8 x 24.5 x 3.5 cm \r\nUkuran Kemasan : 47.5 x 26 x 6 cm \r\nWarna : Grey \r\nOperation System (OS) : Windows 7 \r\nGaransi : 1 Bulan \r\n\r\n* Barang Bekas Display mesin 100% OK, casing 85% ada gores dikit(stok terbatas )', NULL, 'single', 3, 0, 1, '2020-04-09 17:00:00', '2020-06-20 00:13:12', 5, 'aktif'),
(5, 'HP 14s DK0073AU Amd 7th A4 9125 ', 'hp-14s-dk0073au-amd-7th-a4-9125', 'pcs', 20, 3000000, 3500000, 0, 100, 'Keuntungan Beli Disini:\r\n- Bonus Tas Original\r\n- Jaminan 100% Produk Baru & Garansi Resmi(Sparepart & Service)\r\n- Free Request Aplikasi(Yang Tersedia)Jadi Terima Laptop Siap Pakai\r\n- Untuk Pengiriman Luar Kota Dipacking se-aman mungkin( Bubble berlapis Dan Asuransi 100% AMAN)\r\n- Garansi Resmi HP INDONESIA 1TAHUN\r\n\r\nSpesifikasi:\r\n- AMD A4-9125 Dual-Core Processor (2.3 GHz base frequency, up to 2.6 GHz burst frequency, 1 MB cache)\r\n- 4 GB DDR4-2133 SDRAM (1 x 4 GB)\r\n- 1TB 5400 rpm SATA\r\n- Amd Radeon R3 Graphic\r\n- Wifi,Bluetooth,Camera\r\n- 14\" diagonal HD SVA BrightView WLED-backlit (1366 x 768)\r\n- No Dvd\r\n- Windows 10 Original 64bit', NULL, 'single', 3, 0, 1, '2020-04-09 17:00:00', '2020-06-20 00:13:12', 5, 'aktif'),
(6, 'Miyako PSG-607', 'miyako-psg-607', 'pcs', 10, 120000, 150000, 0, 100, 'Jual Megic com Miyako PSG-607, Kapasitas 0.63 L Berkualitas\r\n\r\nKami menjual Megic com Miyako PSG-607, Kapasitas 0.63 L serta aneka Peralatan Dapur, Peralatan Memasak & Ruang Makan lainnya dengan kualitas baik dan harga terjangkau.\r\n\r\nDapatkan segera aneka Peralatan Dapur dan Memasak di toko kami seperti Penyimpanan Makanan, Peralatan Makan & Minum, Bekal, Peralatan Masak, Alat Masak Khusus, Peralatan Dapur, Dapur Lainnya, Aksesoris Dapur, Peralatan Baking, Food & Drink Maker dan Elektronik Rumah Tangga.\r\n\r\nMegic com Miyako PSG-607, Kapasitas 0.63 L\r\nPemasak Serbaguna (multi cooker)\r\n- Memasak Nasi\r\n- Memasak Mie\r\nMegic com Miyako PSG-607 merupakan rice cooker yang berfungsi untuk menanak nasi (cook), dan untuk mengkukus (steam).\r\nSpesifikasi :\r\n- Penanak Nasi 0.63 L\r\n- Daya Listrik 300 W\r\n- Voltase 220 Vac - 50 Hz\r\n\r\n\r\nSegera order Megic com Miyako PSG-607, Kapasitas 0.63 L (TOPSH-DPK-Pd Selamat-Rice Cooker-113515) sebelum stock habis. Silahkan Chat Untuk Ketersediaan Barang - FAST RESPONS!', NULL, 'single', 5, 0, 1, '2020-04-09 17:00:00', '2020-06-20 00:13:08', 2, 'aktif'),
(7, 'Cosmos 16-XDC Kipas Angin / Stand Fan', 'cosmos-16-xdc-kipas-angin-stand-fan', 'pcs', 20, 12000, 150000, 0, 100, 'Detail produk dari Cosmos 16-XDC - Kipas Angin / Stand Fan 16 inch Black/Green (Random Color)\r\nKipas Angin 16 Inch\r\nBaling-Baling Super Spread\r\nGaransi Motor 5 Tahun\r\n46W / 220V\r\nWarna Random : Black/Green (Tergantung persediaan stock)\r\nCosmos Stand Fan 16 inch – 16XDC Dilengkapi thermofuse yang berfungsi untuk mencegah terbakarnya motor kipas. Terdapat 3 level kekuatan angin. Motor halus dan tidak berisik dan Mudah Dibersihkan.\r\n\r\nKeunggulan:\r\n\r\nHembusan angin kencang\r\nAwet dan tahan lama digunakan\r\nKaki penyangga kipas yang kuat dan kokoh\r\nPenggunaan daya listrik rendah\r\nDilengkapi dengan 3 pilihan kecepatan sesuai dengan kebutuhan\r\nBaling-baling berukuran besar\r\nKetinggian kipas yang bisa diatur', NULL, 'single', 5, 0, 4, '2020-04-09 17:00:00', '2020-06-21 05:46:43', 2, 'aktif'),
(8, 'Sony Cyber-shot DSC-H300 Digital ', 'sony-cyber-shot-dsc-h300-digital', 'pcs', 20, 1500000, 2000000, 0, 100, 'Garansi Resmi 1 Tahun Sony Indonesia\r\n\r\n20.1 MP 1/2.3\" Super HAD CCD Sensor\r\n35x Optical Zoom 4.5-157.5mm Lens\r\n25-875mm (35mm Equivalent)\r\n3.0\" 461k-Dot Clear Photo LCD Screen\r\n1280 x 720 HD Video Recording at 30 fps\r\nOptical SteadyShot Image Stabilization\r\nISO Range of 80-3200\r\nBuilt-In Flash\r\nFace Detection, Panorama, & Other Modes\r\nRuns on 4 AA Batteries\r\n\r\nThe black Sony Cyber-shot DSC-H300 Digital Camera is a point-and-shoot camera featuring a 20.1 MP 1/2.3\" Super HAD CCD image sensor for producing high resolution still imagery and HD 720p video. This sensor is benefited by the inclusion of a long-reaching 35x optical zoom lens, giving a 35mm-equivalent focal length range of 25-875mm. For shooting in low-light conditions and when working at greater zoom magnifications, Optical SteadyShot image stabilization is available to counter the effects of camera shake.', NULL, 'single', 5, 0, 1, '2020-04-09 17:00:00', '2020-06-20 00:13:08', 2, 'aktif'),
(9, 'Panasonic Lumix DMC-G7 Kit 14-42mm', 'panasonic-lumix-dmc-g7-kit-14-42mm', 'pcs', 10, 2000000, 2500000, 0, 100, 'Offering true recording versatility, the silver Panasonic Lumix DMC-G7 is a true hybrid mirrorless camera that blends 4K UHD video with advanced still capture and burst shooting capabilities. Revolving around a 16 MP Live MOS Micro Four Thirds sensor and Venus Engine 9 image processor, the G7 features notable low-light sensitivity to ISO 25600, continuous shooting to 8 fps with single-shot AF, as well as a trio of 30 fps shooting rates based on the 4K UHD video recording. Complementing the fast burst shooting modes is an equally adept DFD autofocus system, which works to quicken focusing speeds and emphasize accurate subject tracking for consistently sharp imagery in fast-paced and trying working conditions. Rounding out the feature-set of the G7 is a contemporary body design accentuated by physical exposure control dials, six customizable function buttons, both a high-resolution EVF and 3.0\" tilting touchscreen LCD, and built-in Wi-Fi for wireless sharing and remote camera control. Bridging the gap between stills and video, the Lumix DMC-G7 pairs these two high-resolution mediums with refined focusing and shooting controls for the utmost in shooting versatility.\r\n\r\nCatatan PENGIRIMAN:\r\n1. Pengiriman Gosend Same Day/Grab Same Day akan dikirim di hari yg sama jika order masuk sebelum 14.00\r\n2. Pengiriman Gosend Instant/Grab Instant akan dikirim di hari yg sama jika order masuk sebelum 16.00\r\n3. Pengiriman JNE/J&T/SiCepat akan dikirim di hari yg sama jika order masuk sebelum 17.00\r\n4. Pengiriman luar kota jika ingin cepat harap menggunakan JNE YES.\r\n5. Double packing rapi dan aman menggunakan Bubble Wrap untuk Kamera, Lensa dan aksesoris lainnya yang membutuhkan packing extra.\r\n6. Jika barang diterima tidak sesuai atau dalam keadaan tidak baik, mohon langsung segera hubungi kami.\r\n7. Follow toko JPC KEMANG untuk mendapatkan update promo dan barang terbaru.', NULL, 'single', 5, 0, 2, '2020-04-09 17:00:00', '2020-06-20 00:13:08', 2, 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_admin`
--

CREATE TABLE `rekening_admin` (
  `id_rekening_admin` int(10) UNSIGNED NOT NULL,
  `nomor_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL,
  `atas_nama_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekening_admin`
--

INSERT INTO `rekening_admin` (`id_rekening_admin`, `nomor_rekening`, `bank_id`, `atas_nama_rekening`) VALUES
(1, '123567890', 2, 'Nurul Jadid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_pelapak`
--

CREATE TABLE `rekening_pelapak` (
  `id_rekening` int(10) UNSIGNED NOT NULL,
  `nomor_rekening` char(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekening_pelapak`
--

INSERT INTO `rekening_pelapak` (`id_rekening`, `nomor_rekening`, `atas_nama`, `user_id`, `bank_id`) VALUES
(1, '1234567890', 'Indra Irawan', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bintang` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `foto_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`id_review`, `produk_id`, `user_id`, `review`, `bintang`, `foto_review`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Oke Mantap', '5', NULL, '2020-06-07 17:00:00', '2020-06-07 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `waktu_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `total_bayar` int(11) NOT NULL,
  `status_transaksi` enum('proses','sukses','batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `batas_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `proses_pembayaran` enum('belum','sudah','terima','tolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `to` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `user_id`, `waktu_transaksi`, `total_bayar`, `status_transaksi`, `batas_transaksi`, `proses_pembayaran`, `created_at`, `updated_at`, `to`) VALUES
(1, '1591368261', 1, '2020-06-05 21:44:21', 88000, 'proses', '2020-06-06 21:44:21', 'terima', '2020-06-04 17:00:00', '2020-06-11 11:38:01', 'M. Ilham Surya Pratama <br> Dusun Paleran RT 011 RW 003 Desa Maron Wetan <br> Bogor Timur - Kota, Kota Bogor, Jawa Barat, 67267 <br> 085330150827'),
(2, '1591877291', 1, '2020-06-11 19:08:11', 85500, 'batal', '2020-06-12 19:08:11', 'tolak', '2020-06-11 12:08:11', '2020-06-13 18:07:20', 'M. Ilham Surya Pratama <br> Dusun Paleran RT 011 RW 003 Desa Maron Wetan <br> Bogor Timur - Kota, Kota Bogor, Jawa Barat, 67267 <br> 085330150827'),
(3, '1591887362', 1, '2020-06-11 21:56:02', 165000, 'proses', '2020-06-12 21:56:02', 'terima', '2020-06-11 14:56:02', '2020-06-19 14:30:48', 'M. Ilham Surya Pratama <br> Dusun Paleran RT 011 RW 003 Desa Maron Wetan <br> Bogor Timur - Kota, Kota Bogor, Jawa Barat, 67267 <br> 085330150827'),
(4, '1591887513', 1, '2020-06-11 21:58:33', 254000, 'proses', '2020-06-12 21:58:33', 'terima', '2020-06-11 14:58:33', '2020-06-11 16:14:13', 'M. Ilham Surya Pratama <br> Dusun Paleran RT 011 RW 003 Desa Maron Wetan <br> Bogor Timur - Kota, Kota Bogor, Jawa Barat, 67267 <br> 085330150827'),
(5, '1592718403', 2, '2020-06-21 12:46:43', 164000, 'proses', '2020-06-22 12:46:43', 'terima', '2020-06-21 05:46:43', '2020-06-21 05:49:14', 'Indra Irawanto, Dusun Paleran RT 011 RW 003 Desa Maron Wetan, Bekasi Timur, Kota Bekasi, Jawa Barat, 67276, 085330150827 <br> Bekasi Timur, Kota Bekasi, Jawa Barat, 67276 <br> 085330150827'),
(7, '1592922293', 2, '2020-06-23 21:24:53', 89000, 'proses', '2020-06-24 21:24:53', 'belum', '2020-06-23 14:24:53', '2020-06-23 14:24:53', 'Indra Irawanto, Dusun Paleran RT 011 RW 003 Desa Maron Wetan, Bekasi Timur, Kota Bekasi, Jawa Barat, 67276, 085330150827'),
(8, '1592924882', 2, '2020-06-23 22:08:02', 4679000, 'proses', '2020-06-24 22:08:02', 'belum', '2020-06-23 15:08:02', '2020-06-23 15:08:02', 'Indra Irawanto, Dusun Paleran RT 011 RW 003 Desa Maron Wetan, Bekasi Timur, Kota Bekasi, Jawa Barat, 67276, 085330150827'),
(9, '1592925246', 2, '2020-06-23 22:14:06', 2540000, 'proses', '2020-06-24 22:14:06', 'sudah', '2020-06-23 15:14:06', '2020-06-23 15:14:29', 'Indra Irawanto, Dusun Paleran RT 011 RW 003 Desa Maron Wetan, Bekasi Timur, Kota Bekasi, Jawa Barat, 67276, 085330150827');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(10) UNSIGNED NOT NULL,
  `transaksi_id` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `harga_jual` int(11) NOT NULL DEFAULT 0,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `kurir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `etd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` int(11) NOT NULL DEFAULT 0,
  `status_order` enum('Menunggu Konfirmasi','Telah Dikonfirmasi','Dikemas','Dikirim','Telah Sampai','Dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `transaksi_id`, `produk_id`, `jumlah`, `harga_jual`, `diskon`, `kurir`, `service`, `ongkir`, `etd`, `resi`, `sub_total`, `status_order`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 80000, 0, 'jne', 'OKE', 8000, '2-3', '020810015419720', 88000, 'Telah Sampai', 2, '2020-06-04 17:00:00', '2020-06-11 14:30:18'),
(2, 2, 3, 1, 85000, 10, 'jne', 'REG', 9000, '1-2', NULL, 76500, 'Dibatalkan', 2, '2020-06-11 12:08:11', '2020-06-13 06:51:23'),
(3, 3, 7, 1, 150000, 0, 'jne', 'OKE', 15000, '2-3', NULL, 165000, 'Telah Dikonfirmasi', 5, '2020-06-11 14:56:02', '2020-06-19 14:30:48'),
(4, 4, 1, 1, 80000, 0, 'jne', 'REG', 9000, '1-2', NULL, 89000, 'Dikemas', 2, '2020-06-11 14:58:33', '2020-06-20 23:23:41'),
(5, 4, 7, 1, 150000, 0, 'jne', 'OKE', 15000, '2-3', NULL, 165000, 'Telah Dikonfirmasi', 5, '2020-06-11 14:58:33', '2020-06-11 16:14:13'),
(6, 5, 7, 1, 150000, 0, 'jne', 'OKE', 14000, '4-5', 'qwerty', 164000, 'Dikirim', 5, '2020-06-21 05:46:43', '2020-06-20 22:58:29'),
(8, 7, 1, 1, 80000, 0, 'jne', 'CTC', 9000, '1-2', NULL, 89000, 'Menunggu Konfirmasi', 2, '2020-06-23 14:24:53', '2020-06-23 14:24:53'),
(9, 8, 4, 1, 4500000, 0, 'tiki', 'ECO', 15000, '4', NULL, 4515000, 'Dibatalkan', 3, '2020-06-23 15:08:02', '2020-06-23 15:12:57'),
(10, 8, 7, 1, 150000, 0, 'jne', 'OKE', 14000, '4-5', NULL, 164000, 'Menunggu Konfirmasi', 5, '2020-06-23 15:08:02', '2020-06-23 15:08:02'),
(11, 9, 9, 1, 2500000, 0, 'jne', 'YES', 40000, '1-1', NULL, 2540000, 'Menunggu Konfirmasi', 5, '2020-06-23 15:14:06', '2020-06-23 15:14:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` char(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `status_official` enum('santri','official') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'santri',
  `role` enum('konsumen','pelapak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'konsumen',
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_toko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `alamat_utama` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alamat_toko` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `nomor_hp`, `foto_profil`, `email`, `email_verified_at`, `status_official`, `role`, `nama_toko`, `foto_toko`, `rating`, `saldo`, `status`, `alamat_utama`, `remember_token`, `created_at`, `updated_at`, `alamat_toko`) VALUES
(1, 'M. Ilham Surya Pratama', 'ilham', '$2y$10$cS8pFG7KAYRRHS2Uban0VeggvF/DFgIuO5ZhDuRCORS1d3Mkdik1u', '085330150827', '4FpMtymKe98Bwd9.jpg', 'ilhamsurya26@gmail.com', '0000-00-00 00:00:00', 'santri', 'konsumen', NULL, NULL, '0', 0, 'aktif', 11, NULL, '2020-05-17 08:56:06', '2020-06-15 07:11:34', 3),
(2, 'Indra Irawanto', 'indra', '$2y$10$62v96w1jIhxOlm8YCMdNweOBl46uuudBP3O6MhYcIjHqBbs1/gJzy', '085330150820', 'DRoqSUBVRK1Yhap.png', 'indra@gmail.com', '0000-00-00 00:00:00', 'santri', 'pelapak', 'Dunia Sepatu', NULL, '0', 88000, 'aktif', 2, NULL, '2020-05-26 07:07:05', '2020-06-21 05:45:09', 2),
(3, 'Hafid Masruri', 'yolo', '4fded1464736e77865df232cbcb4cd19', '085330150826', NULL, 'hafid@gmail.com', '0000-00-00 00:00:00', 'santri', 'pelapak', 'Dunia Laptop', NULL, '0', 0, 'aktif', NULL, NULL, NULL, '2020-06-20 00:13:12', 3),
(5, 'Luthfi N', 'luthfi', '$2y$10$62v96w1jIhxOlm8YCMdNweOBl46uuudBP3O6MhYcIjHqBbs1/gJzy', '085330150824', NULL, 'luthfi@gmail.com', '0000-00-00 00:00:00', 'santri', 'pelapak', 'Elektronik World', NULL, '0', 0, 'aktif', NULL, NULL, NULL, '2020-06-20 00:13:08', 11),
(8, 'Badrut Tamam', 'badrut', '$2y$10$zwwseOL/fNMCIN8V8rO85ee..pKdaz3uuI59ot9RxkohS.Ve2MgsC', '085330150887', NULL, 'pilhamsurya1@gmail.com', '0000-00-00 00:00:00', 'santri', 'konsumen', NULL, NULL, '0', 0, 'aktif', NULL, NULL, '2020-04-11 17:11:49', NULL, 0),
(21, 'Yayos', 'yayos', '$2y$10$eAfLYKo8omzILWF7fG2MMO2ptIX5pSBXiV.nsAZeno44mOdFfpg.W', '085330150801', NULL, 'blogsayailham@gmail.com', '2020-06-14 00:10:05', 'santri', 'konsumen', NULL, NULL, NULL, 0, 'aktif', 13, NULL, '2020-06-13 17:00:25', '2020-06-21 09:03:30', NULL),
(23, 'Yolo Jojo', 'yolojojo', '$2y$10$TaVjOOnfHJNqoOiJzbg3PuGQhwsMpcQfjaqwl09VCZ8kl6FMz7i76', '085330150829', NULL, 'yolojojo@gmail.com', NULL, 'santri', 'pelapak', NULL, NULL, NULL, 0, 'aktif', NULL, NULL, '2020-06-20 00:18:03', '2020-06-20 00:23:37', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdraw`
--

CREATE TABLE `withdraw` (
  `id_withdraw` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nominal` int(11) NOT NULL,
  `rekening_pelapak_id` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','diterima','sukses') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `alamat_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`),
  ADD UNIQUE KEY `bank_nama_bank_unique` (`nama_bank`);

--
-- Indeks untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id_banner`),
  ADD UNIQUE KEY `banners_nama_banner_unique` (`nama_banner`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id_foto_produk`),
  ADD KEY `foto_produk_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori_produk`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `keranjang_produk_id_foreign` (`produk_id`),
  ADD KEY `keranjang_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`),
  ADD UNIQUE KEY `konfirmasi_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `konfirmasi_rekening_admin_id_foreign` (`rekening_admin_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_user_id_foreign` (`user_id`),
  ADD KEY `produk_kategori_produk_id_foreign` (`kategori_produk_id`);

--
-- Indeks untuk tabel `rekening_admin`
--
ALTER TABLE `rekening_admin`
  ADD PRIMARY KEY (`id_rekening_admin`),
  ADD KEY `rekening_admin_bank_id_foreign` (`bank_id`);

--
-- Indeks untuk tabel `rekening_pelapak`
--
ALTER TABLE `rekening_pelapak`
  ADD PRIMARY KEY (`id_rekening`),
  ADD KEY `rekening_pelapak_user_id_foreign` (`user_id`),
  ADD KEY `rekening_pelapak_bank_id_foreign` (`bank_id`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `reviews_produk_id_foreign` (`produk_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `transaksi_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transaksi_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `transaksi_detail_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `transaksi_detail_produk_id_foreign` (`produk_id`),
  ADD KEY `transaksi_detail_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nama_toko_unique` (`nama_toko`),
  ADD KEY `users_alamat_utama_foreign` (`alamat_utama`),
  ADD KEY `users_alamat_toko_foreign` (`alamat_toko`);

--
-- Indeks untuk tabel `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id_withdraw`),
  ADD KEY `withdraw_user_id_foreign` (`user_id`),
  ADD KEY `withdraw_rekening_pelapak_id_foreign` (`rekening_pelapak_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `banners`
--
ALTER TABLE `banners`
  MODIFY `id_banner` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `rekening_admin`
--
ALTER TABLE `rekening_admin`
  MODIFY `id_rekening_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rekening_pelapak`
--
ALTER TABLE `rekening_pelapak`
  MODIFY `id_rekening` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id_withdraw` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD CONSTRAINT `foto_produk_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `keranjang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `konfirmasi_rekening_admin_id_foreign` FOREIGN KEY (`rekening_admin_id`) REFERENCES `rekening_admin` (`id_rekening_admin`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_kategori_produk_id_foreign` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id_kategori_produk`),
  ADD CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `rekening_admin`
--
ALTER TABLE `rekening_admin`
  ADD CONSTRAINT `rekening_admin_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id_bank`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekening_pelapak`
--
ALTER TABLE `rekening_pelapak`
  ADD CONSTRAINT `rekening_pelapak_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id_bank`),
  ADD CONSTRAINT `rekening_pelapak_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `transaksi_detail_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `transaksi_detail_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_alamat_toko_foreign` FOREIGN KEY (`alamat_toko`) REFERENCES `alamat` (`id_alamat`),
  ADD CONSTRAINT `users_alamat_utama_foreign` FOREIGN KEY (`alamat_utama`) REFERENCES `alamat` (`id_alamat`);

--
-- Ketidakleluasaan untuk tabel `withdraw`
--
ALTER TABLE `withdraw`
  ADD CONSTRAINT `withdraw_rekening_pelapak_id_foreign` FOREIGN KEY (`rekening_pelapak_id`) REFERENCES `rekening_pelapak` (`id_rekening`),
  ADD CONSTRAINT `withdraw_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
