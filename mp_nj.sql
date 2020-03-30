-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Mar 2020 pada 20.25
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_mpnj`
--

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
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `nama`, `nomor_telepon`, `provinsi_id`, `nama_provinsi`, `city_id`, `nama_kota`, `kecamatan_id`, `nama_kecamatan`, `kode_pos`, `alamat_lengkap`, `santri`, `wilayah`, `kamar`, `alamat_santri`, `user_id`, `user_type`) VALUES
(1, 'M. Ilham Surya Pratama', '085330150827', 11, 'Jawa Timur', 369, 'Kabupaten Probolinggo', 5154, 'Maron', '67276', 'Dusun Paleran RT 011 RW 003 Desa Maron Wetan', 'N', NULL, NULL, NULL, 1, 'App\\Models\\Konsumen'),
(2, 'Indra Irawanto', '085330150827', 11, 'Jawa Timur', 369, 'Kabupaten Probolinggo', 5154, 'Maron', '67276', 'Dusun Paleran RT 011 RW 003 Desa Maron Wetan', 'N', NULL, NULL, NULL, 1, 'App\\Models\\Pelapak');

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
  `pembeli_id` int(11) NOT NULL,
  `pembeli_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '1584713319', 920500, 'M. Ilham Surya Pratama', '2020-03-20 00:00:00', 'bank bri syariah.png', NULL, 2),
(2, '1584902084', 942000, 'M. Ilham Surya Pratama', '2020-03-22 00:00:00', 'Screenshot (20).png', NULL, 1),
(3, '1584902455', 4514000, 'M. Ilham Surya Pratama', '2020-03-22 00:00:00', 'Screenshot (19).png', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_hp` char(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `alamat_utama` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_lengkap`, `username`, `password`, `remember_token`, `nomor_hp`, `foto_profil`, `email`, `status`, `alamat_utama`, `created_at`, `updated_at`) VALUES
(1, 'M. Ilham Surya Pratama', 'ilham', '$2y$10$mLRBFK6.Kz1RBs6.IFA/a.qLnIN8WCxtYtsIjfXo3amYdHSGVlQJu', 'chWVaovEbEAm2YjHdWX0Zn9dp9VJCMxywZHuJF3JRKYeJgotwas092QkfMPD', '085330150827', 'ZQ8ld7RowEZUgIV.jpg', 'ilhamsurya26@gmail.com', 'aktif', 1, '2020-01-04 20:33:34', '2020-03-18 19:17:14'),
(17, 'Soleh', 'soleh', '$2y$10$BiOcr6QxhdwPNDKGQn3FTePRizxKCzbGEOsi3HVslPqPpW4IRDA9.', NULL, '123456789123', '', 'blogsayailham@gmail.com', 'aktif', NULL, '2020-02-27 15:26:01', '2020-02-27 15:46:12'),
(18, 'Hais Batara', 'hais', '$2y$10$amWv34TK3df7n3RhHVXZI.C.pNnlfSegeGuf909q9PXFJspYhXFCu', NULL, '085330150827', '', 'ilhamdicoding@gmail.com', 'nonaktif', NULL, '2020-02-28 13:22:53', '2020-02-28 13:22:53'),
(20, 'Komando', 'komando', '$2y$10$11.O9SQdBOSgOIe3SiX.f.EnDipZGUdvwBsXAtuuaUUJm4GgsvVxy', NULL, '085330150822', NULL, 'komando@gmail.com', 'nonaktif', NULL, '2020-03-03 11:12:54', '2020-03-03 11:12:54'),
(21, 'Jojo Kuadrat', 'jojo', '$2y$10$CZ4dOx1UzfUANNzM8u77vOfZ3MyVVzt07XkiMDfXkrA5ztN6.q13C', NULL, '085330150825', NULL, 'jojo@gmail.com', 'nonaktif', NULL, '2020-03-06 06:11:15', '2020-03-06 06:11:15');

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
(4, '2019_12_29_144016_create_pelapak_table', 1),
(5, '2019_12_30_151524_create_produk_table', 1),
(6, '2019_12_30_163537_create_kategori_produk_table', 1),
(7, '2019_12_30_163700_add_kategori_produk_id_on_produk', 1),
(8, '2019_12_31_035113_create_rekening_pelapak_table', 1),
(9, '2019_12_31_113317_create_foto_produk_table', 1),
(10, '2020_01_04_072034_create_konsumen_table', 1),
(11, '2020_01_08_185357_create_keranjang_table', 1),
(12, '2020_01_13_085806_create_transaksi_table', 1),
(13, '2020_01_13_091643_create_transaksi_detail_table', 1),
(14, '2020_01_17_201414_create_konfirmasi_table', 1),
(15, '2020_01_26_161233_add_api_token_field_konsumen', 1),
(16, '2020_02_03_162608_create_alamat_table', 1),
(17, '2020_02_06_070157_add_alamat_utama_to_konsumen', 1),
(18, '2020_02_25_162319_create_reviews_table', 1),
(19, '2020_02_28_175019_add_alamat_utama_to_pelapak', 1),
(20, '2020_03_18_170427_create_withdraw_table', 1),
(21, '2020_03_18_170708_create_bank_table', 1),
(22, '2020_03_18_170845_create_rekening_admin_table', 1),
(23, '2020_03_18_172048_add_rekening_admin_to_konfirmasi', 1);

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
-- Struktur dari tabel `pelapak`
--

CREATE TABLE `pelapak` (
  `id_pelapak` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_official` enum('santri','official') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'santri',
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_toko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alamat_utama` int(10) UNSIGNED DEFAULT NULL,
  `alamat_toko` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelapak`
--

INSERT INTO `pelapak` (`id_pelapak`, `nama_lengkap`, `username`, `password`, `status_official`, `nama_toko`, `foto_profil`, `foto_toko`, `nomor_hp`, `email`, `rating`, `saldo`, `status`, `created_at`, `updated_at`, `alamat_utama`, `alamat_toko`) VALUES
(1, 'Indra Irawanto', 'indra', 'e24f6e3ce19ee0728ff1c443e4ff488d', 'santri', 'Dunia Sepatu', NULL, NULL, '085330150827', 'indra@gmail.com', NULL, 0, 'aktif', '2020-01-01 14:53:00', '2020-03-01 10:31:05', 2, NULL),
(2, 'Hafid Masruri', 'yolo', '4fded1464736e77865df232cbcb4cd19', 'santri', 'Dunia Laptop', NULL, NULL, '085330150826', 'hafid@gmail.com', NULL, 0, 'aktif', '2020-01-10 17:18:00', '2020-01-10 17:18:00', NULL, NULL),
(3, 'Luthfi N', 'luthfi', 'luthfi', 'santri', 'Elektronik World', NULL, NULL, '085330150825', 'luthfi@gmail.com', NULL, 0, 'aktif', '2020-01-01 14:53:00', '2020-01-01 14:53:00', 2, NULL);

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
  `pelapak_id` int(10) UNSIGNED NOT NULL,
  `wishlist` int(11) NOT NULL DEFAULT 0,
  `terjual` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori_produk_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `slug`, `satuan`, `berat`, `harga_modal`, `harga_jual`, `diskon`, `stok`, `keterangan`, `foto`, `tipe_produk`, `pelapak_id`, `wishlist`, `terjual`, `created_at`, `updated_at`, `kategori_produk_id`) VALUES
(1, 'Adidas TeamVision Black List White', 'adidas-teamvision-black-list-white', 'pcs', 5, 70000, 80000, 0, -1, '<p>Kami menjual sepatu olahraga running, lari, futsal, badminton. 100% ORIGINAL</p>\r\n\r\n<p>Sepatu PRO ATT adalah sepatu yang diproduksi oleh PT. INTIDRAGON SURYATAMA (ISO 90001) di Mojokerto Indonesia yang terkenal dengan kekuatannya dari jaman dahulu, Sol yang dipress oleh pabrik sehingga tidak mudah jebol dan rusak, Nyaman dipakai, Design stylish dan attractive</p>\r\n\r\n<p>Keunggulan produk ini: - Original 100% PRO ATT - Kualitas istimewa standar pabrik - Bahan PVC, Tekstil, EVA yang terjamin - Sol karet Injection Kuat khas pabrik anti licin - Nyaman digunakan ~ Design keren ~ Bonus gantungan kunci</p>\r\n', NULL, 'single', 1, 0, 2, NULL, '2020-03-22 11:34:44', 6),
(2, 'Converse Allstar CT Mono Full White Putih Low Pria Wanita Couple', 'converse-allstar-ct-mono-full-white-putih-low-pria-wanita-couple', 'pcs', 10, 90000, 950000, 10, -1, '<p>barang yang kami jual adalah sesuai dengan gambar kami menjual produk lokal dengan kualitas terbaik karna kami suplayer tangan pertama Stock kami selau tersedia dan siap di kirim ke alamat anda Kualitas Terjamin 100% terbaik Siap menerima Partai besar/Grosir dengan harga yang jauh dari harga satuan menerima juga Reseller dan Dropshipper Silahkan Bandingkan Kualitas dan Harga kami Dengan Toko sebelah Untung sedikit yg penting berkah amanah dan lancar Sepatu bisa di tukar bila kebesaran ataupun kekecilan yg penting kondisi sepatu masih seperti pertama di terima..</p>\r\n\r\n<p>Sambil kakak santai silahkan mainkan jari kakak untuk Berinteraksi Bersama kami dan dapatkan harga termurah darI GREENLAKESTORE</p>\r\n', NULL, 'single', 1, 0, 2, NULL, '2020-03-22 11:34:44', 6),
(3, 'Allstar CT Mono Full White Putih Low Pria Wanita Couple', 'allstar-ct-mono-full-white-putih-low-pria-wanita-couple', 'pcs', 12, 70000, 85000, 10, -1, '<p>*Nama produk, photo dan deskripsi dari toko kami yang di pakai toko lain dengan harga murah, kakak harus lebih smart, teliti dan berhati hati.</p>\r\n\r\n<p>*Queen_wedges309 mengutamakan kepuasan customer ( silahkan kakak cek di ulasan kami ya kak) *harga menjamin kualitas barang.</p>\r\n\r\n<p>*pengemasan dijamin rapih.</p>\r\n\r\n<p>*100% barang baru melalui kualitas kontrol yang baik. Kami jual produk lokal dengan harga kompetitif dan kualitas terbaik ya kak, dan bisa di bandingkan dengan sebelah.</p>\r\n\r\n<p>*di toko kami juga menerima orderan dengan jumlah besar, baik itu partaian, atau untuk dijual kembali.</p>\r\n\r\n<p>*barang boleh sama, tapi kualitas barang bisa kami jamin berbeda. Karena tujuan kami memberikan kepuasan dan kenyamanan kepada costumer.</p>\r\n\r\n<p>*melayani 24 jam, dengan fast respon dan ramah.</p>\r\n\r\n<p>*utamakan tanyakan dulu barang yang mau dipesan, karena barang tidak selalu ready. Barang yang dikirim sesuai dengan pesanan dan gambar.</p>\r\n\r\n<p>*orderan langsung dikirim di hari pemesanan setelah melakukan transaksi atau transfer.</p>\r\n\r\n<p>*ingattt !!! Cantumkan size dan warna sepatu yang anda pesan dan selalu pantau juga toko kami di shopee . karena selalu ada produk baru di setiap harinya SELAMAT BERBELANJA Salam manis dari kami Queen_wedges309</p>\r\n', NULL, 'single', 1, 0, 2, NULL, '2020-03-22 10:37:55', 6),
(4, 'DELL Latitude E-Series Core I5-M2520', 'dell-latitude-e-series-core-i5-m2520', 'pcs', 150, 3000000, 4500000, 0, 9, 'Dell Latitude E-Series \r\n\r\nBONUS(Free)\r\n- FREE  INTALASI PROGRAM  ( LAPTOP SIAP PAKAI )\r\n- FREE BUBLE + ASURANSI \r\nRECOMDED JNE\r\n(dijamin 100% Aman untk Pengiriman Luar kota/luar pulau)\r\n\r\nSPESIFIKASI :\r\nProcessor : Intel Core i5-M520 / i5-M2520 CPU 2.40GHz \r\nRAM : 2X2048 MB DDR3 (4 GB Pc3 10600 ) \r\nHarddisk : 250 GB \r\nVGA : Intel HD Graphics, Dedicated 64 MB, Shared 1632 MB, Up to 1696 MB \r\nBaterai : 6 / 9 Cell \r\nFitur : WiFi, DVD, Cardreader, 4 port USB 2.0, VGAa out, IEEE 1394a connector, Express Card Slot, Broadcom NetXtreme Gigabit Ethernet \r\nLayar : 13\",14\",15\" LED (WXGA 1280X800) (kirim random)\r\nBerat Barang : 2.5 Kg \r\nBerat Kemasan : 3.4 Kg \r\nUkuran Barang : 33.8 x 24.5 x 3.5 cm \r\nUkuran Kemasan : 47.5 x 26 x 6 cm \r\nWarna : Grey \r\nOperation System (OS) : Windows 7 \r\nGaransi : 1 Bulan \r\n\r\n* Barang Bekas Display mesin 100% OK, casing 85% ada gores dikit(stok terbatas )', NULL, 'single', 2, 0, 1, NULL, '2020-03-09 01:57:01', 5),
(5, 'HP 14s DK0073AU Amd 7th A4 9125 ', 'hp-14s-dk0073au-amd-7th-a4-9125', 'pcs', 20, 3000000, 3500000, 0, 10, 'Keuntungan Beli Disini:\r\n- Bonus Tas Original\r\n- Jaminan 100% Produk Baru & Garansi Resmi(Sparepart & Service)\r\n- Free Request Aplikasi(Yang Tersedia)Jadi Terima Laptop Siap Pakai\r\n- Untuk Pengiriman Luar Kota Dipacking se-aman mungkin( Bubble berlapis Dan Asuransi 100% AMAN)\r\n- Garansi Resmi HP INDONESIA 1TAHUN\r\n\r\nSpesifikasi:\r\n- AMD A4-9125 Dual-Core Processor (2.3 GHz base frequency, up to 2.6 GHz burst frequency, 1 MB cache)\r\n- 4 GB DDR4-2133 SDRAM (1 x 4 GB)\r\n- 1TB 5400 rpm SATA\r\n- Amd Radeon R3 Graphic\r\n- Wifi,Bluetooth,Camera\r\n- 14\" diagonal HD SVA BrightView WLED-backlit (1366 x 768)\r\n- No Dvd\r\n- Windows 10 Original 64bit', NULL, 'single', 2, 0, 0, NULL, NULL, 5),
(6, 'Miyako PSG-607', 'miyako-psg-607', 'pcs', 10, 120000, 150000, 0, 0, 'Jual Megic com Miyako PSG-607, Kapasitas 0.63 L Berkualitas\r\n\r\nKami menjual Megic com Miyako PSG-607, Kapasitas 0.63 L serta aneka Peralatan Dapur, Peralatan Memasak & Ruang Makan lainnya dengan kualitas baik dan harga terjangkau.\r\n\r\nDapatkan segera aneka Peralatan Dapur dan Memasak di toko kami seperti Penyimpanan Makanan, Peralatan Makan & Minum, Bekal, Peralatan Masak, Alat Masak Khusus, Peralatan Dapur, Dapur Lainnya, Aksesoris Dapur, Peralatan Baking, Food & Drink Maker dan Elektronik Rumah Tangga.\r\n\r\nMegic com Miyako PSG-607, Kapasitas 0.63 L\r\nPemasak Serbaguna (multi cooker)\r\n- Memasak Nasi\r\n- Memasak Mie\r\nMegic com Miyako PSG-607 merupakan rice cooker yang berfungsi untuk menanak nasi (cook), dan untuk mengkukus (steam).\r\nSpesifikasi :\r\n- Penanak Nasi 0.63 L\r\n- Daya Listrik 300 W\r\n- Voltase 220 Vac - 50 Hz\r\n\r\n\r\nSegera order Megic com Miyako PSG-607, Kapasitas 0.63 L (TOPSH-DPK-Pd Selamat-Rice Cooker-113515) sebelum stock habis. Silahkan Chat Untuk Ketersediaan Barang - FAST RESPONS!', NULL, 'single', 3, 0, 1, NULL, '2020-03-20 07:08:39', 2),
(7, 'Cosmos 16-XDC Kipas Angin / Stand Fan', 'cosmos-16-xdc-kipas-angin-stand-fan', 'pcs', 20, 12000, 150000, 0, 0, 'Detail produk dari Cosmos 16-XDC - Kipas Angin / Stand Fan 16 inch Black/Green (Random Color)\r\nKipas Angin 16 Inch\r\nBaling-Baling Super Spread\r\nGaransi Motor 5 Tahun\r\n46W / 220V\r\nWarna Random : Black/Green (Tergantung persediaan stock)\r\nCosmos Stand Fan 16 inch – 16XDC Dilengkapi thermofuse yang berfungsi untuk mencegah terbakarnya motor kipas. Terdapat 3 level kekuatan angin. Motor halus dan tidak berisik dan Mudah Dibersihkan.\r\n\r\nKeunggulan:\r\n\r\nHembusan angin kencang\r\nAwet dan tahan lama digunakan\r\nKaki penyangga kipas yang kuat dan kokoh\r\nPenggunaan daya listrik rendah\r\nDilengkapi dengan 3 pilihan kecepatan sesuai dengan kebutuhan\r\nBaling-baling berukuran besar\r\nKetinggian kipas yang bisa diatur', NULL, 'single', 3, 0, 1, NULL, '2020-03-20 07:08:39', 2),
(8, 'Sony Cyber-shot DSC-H300 Digital ', 'sony-cyber-shot-dsc-h300-digital', 'pcs', 20, 1500000, 2000000, 0, 9, 'Garansi Resmi 1 Tahun Sony Indonesia\r\n\r\n20.1 MP 1/2.3\" Super HAD CCD Sensor\r\n35x Optical Zoom 4.5-157.5mm Lens\r\n25-875mm (35mm Equivalent)\r\n3.0\" 461k-Dot Clear Photo LCD Screen\r\n1280 x 720 HD Video Recording at 30 fps\r\nOptical SteadyShot Image Stabilization\r\nISO Range of 80-3200\r\nBuilt-In Flash\r\nFace Detection, Panorama, & Other Modes\r\nRuns on 4 AA Batteries\r\n\r\nThe black Sony Cyber-shot DSC-H300 Digital Camera is a point-and-shoot camera featuring a 20.1 MP 1/2.3\" Super HAD CCD image sensor for producing high resolution still imagery and HD 720p video. This sensor is benefited by the inclusion of a long-reaching 35x optical zoom lens, giving a 35mm-equivalent focal length range of 25-875mm. For shooting in low-light conditions and when working at greater zoom magnifications, Optical SteadyShot image stabilization is available to counter the effects of camera shake.', NULL, 'single', 3, 0, 1, NULL, '2020-03-22 11:40:55', 2),
(9, 'Panasonic Lumix DMC-G7 Kit 14-42mm', 'panasonic-lumix-dmc-g7-kit-14-42mm', 'pcs', 10, 2000000, 2500000, 0, 9, 'Offering true recording versatility, the silver Panasonic Lumix DMC-G7 is a true hybrid mirrorless camera that blends 4K UHD video with advanced still capture and burst shooting capabilities. Revolving around a 16 MP Live MOS Micro Four Thirds sensor and Venus Engine 9 image processor, the G7 features notable low-light sensitivity to ISO 25600, continuous shooting to 8 fps with single-shot AF, as well as a trio of 30 fps shooting rates based on the 4K UHD video recording. Complementing the fast burst shooting modes is an equally adept DFD autofocus system, which works to quicken focusing speeds and emphasize accurate subject tracking for consistently sharp imagery in fast-paced and trying working conditions. Rounding out the feature-set of the G7 is a contemporary body design accentuated by physical exposure control dials, six customizable function buttons, both a high-resolution EVF and 3.0\" tilting touchscreen LCD, and built-in Wi-Fi for wireless sharing and remote camera control. Bridging the gap between stills and video, the Lumix DMC-G7 pairs these two high-resolution mediums with refined focusing and shooting controls for the utmost in shooting versatility.\r\n\r\nCatatan PENGIRIMAN:\r\n1. Pengiriman Gosend Same Day/Grab Same Day akan dikirim di hari yg sama jika order masuk sebelum 14.00\r\n2. Pengiriman Gosend Instant/Grab Instant akan dikirim di hari yg sama jika order masuk sebelum 16.00\r\n3. Pengiriman JNE/J&T/SiCepat akan dikirim di hari yg sama jika order masuk sebelum 17.00\r\n4. Pengiriman luar kota jika ingin cepat harap menggunakan JNE YES.\r\n5. Double packing rapi dan aman menggunakan Bubble Wrap untuk Kamera, Lensa dan aksesoris lainnya yang membutuhkan packing extra.\r\n6. Jika barang diterima tidak sesuai atau dalam keadaan tidak baik, mohon langsung segera hubungi kami.\r\n7. Follow toko JPC KEMANG untuk mendapatkan update promo dan barang terbaru.', NULL, 'single', 3, 0, 1, NULL, '2020-03-22 11:40:55', 2);

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
(1, '123456890', 1, 'Nurul Jadid'),
(2, '098654321', 2, 'Nurul Jadid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_pelapak`
--

CREATE TABLE `rekening_pelapak` (
  `id_rekening` int(10) UNSIGNED NOT NULL,
  `nama_bank` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_rekening` char(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pelapak_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `konsumen_id` int(10) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bintang` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `foto_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembeli_id` int(11) NOT NULL,
  `pembeli_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `total_bayar` int(11) NOT NULL,
  `proses_pembayaran` enum('belum','sudah','terima','tolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `pembeli_id`, `pembeli_type`, `waktu_transaksi`, `total_bayar`, `proses_pembayaran`, `created_at`, `updated_at`) VALUES
(2, '1584898675', 1, 'App\\Models\\Konsumen', '2020-03-22 17:37:55', 87500, 'belum', NULL, NULL),
(3, '1584902084', 1, 'App\\Models\\Konsumen', '2020-03-22 18:34:44', 942000, 'sudah', NULL, NULL),
(4, '1584902455', 1, 'App\\Models\\Konsumen', '2020-03-22 18:40:55', 4514000, 'sudah', NULL, NULL);

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
  `sub_total` int(11) NOT NULL DEFAULT 0,
  `status_order` enum('Menunggu Konfirmasi','Telah Dikonfirmasi','Dikemas','Dikirim','Telah Sampai','Dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `pelapak_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `transaksi_id`, `produk_id`, `jumlah`, `harga_jual`, `diskon`, `kurir`, `service`, `ongkir`, `etd`, `sub_total`, `status_order`, `pelapak_id`, `created_at`, `updated_at`) VALUES
(5, 2, 3, 1, 85000, 0, 'tiki', 'ECO', 11000, '6', 96000, 'Menunggu Konfirmasi', 1, NULL, NULL),
(6, 3, 2, 1, 950000, 0, 'jne', 'CTC', 7000, '3-6', 957000, 'Telah Dikonfirmasi', 1, NULL, NULL),
(7, 3, 1, 1, 80000, 0, 'jne', 'CTC', 7000, '3-6', 87000, 'Telah Dikonfirmasi', 1, NULL, NULL),
(8, 4, 9, 1, 2500000, 0, 'tiki', 'REG', 14000, '5', 2514000, 'Dikemas', 3, NULL, NULL),
(9, 4, 8, 1, 2000000, 0, 'tiki', 'REG', 14000, '5', 2014000, 'Dikemas', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdraw`
--

CREATE TABLE `withdraw` (
  `id_withdraw` int(10) UNSIGNED NOT NULL,
  `pelapak_id` int(10) UNSIGNED NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('pending','diterima','sukses') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`),
  ADD UNIQUE KEY `bank_nama_bank_unique` (`nama_bank`);

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
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori_produk`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `keranjang_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`),
  ADD UNIQUE KEY `konfirmasi_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `konfirmasi_rekening_admin_id_foreign` (`rekening_admin_id`);

--
-- Indeks untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`),
  ADD UNIQUE KEY `konsumen_username_unique` (`username`),
  ADD UNIQUE KEY `konsumen_email_unique` (`email`),
  ADD UNIQUE KEY `konsumen_remember_token_unique` (`remember_token`),
  ADD KEY `konsumen_alamat_utama_foreign` (`alamat_utama`);

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
-- Indeks untuk tabel `pelapak`
--
ALTER TABLE `pelapak`
  ADD PRIMARY KEY (`id_pelapak`),
  ADD UNIQUE KEY `pelapak_username_unique` (`username`),
  ADD UNIQUE KEY `pelapak_nama_toko_unique` (`nama_toko`),
  ADD UNIQUE KEY `pelapak_nomor_hp_unique` (`nomor_hp`),
  ADD UNIQUE KEY `pelapak_email_unique` (`email`),
  ADD KEY `pelapak_alamat_utama_foreign` (`alamat_utama`),
  ADD KEY `pelapak_alamat_toko_foreign` (`alamat_toko`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_pelapak_id_foreign` (`pelapak_id`),
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
  ADD KEY `rekening_pelapak_pelapak_id_foreign` (`pelapak_id`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `reviews_produk_id_foreign` (`produk_id`),
  ADD KEY `reviews_konsumen_id_foreign` (`konsumen_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `transaksi_kode_transaksi_unique` (`kode_transaksi`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `transaksi_detail_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `transaksi_detail_produk_id_foreign` (`produk_id`),
  ADD KEY `transaksi_detail_pelapak_id_foreign` (`pelapak_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id_withdraw`),
  ADD KEY `withdraw_pelapak_id_foreign` (`pelapak_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `pelapak`
--
ALTER TABLE `pelapak`
  MODIFY `id_pelapak` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rekening_admin`
--
ALTER TABLE `rekening_admin`
  MODIFY `id_rekening_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rekening_pelapak`
--
ALTER TABLE `rekening_pelapak`
  MODIFY `id_rekening` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id_withdraw` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD CONSTRAINT `foto_produk_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `konfirmasi_rekening_admin_id_foreign` FOREIGN KEY (`rekening_admin_id`) REFERENCES `rekening_admin` (`id_rekening_admin`);

--
-- Ketidakleluasaan untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD CONSTRAINT `konsumen_alamat_utama_foreign` FOREIGN KEY (`alamat_utama`) REFERENCES `alamat` (`id_alamat`);

--
-- Ketidakleluasaan untuk tabel `pelapak`
--
ALTER TABLE `pelapak`
  ADD CONSTRAINT `pelapak_alamat_toko_foreign` FOREIGN KEY (`alamat_toko`) REFERENCES `alamat` (`id_alamat`),
  ADD CONSTRAINT `pelapak_alamat_utama_foreign` FOREIGN KEY (`alamat_utama`) REFERENCES `alamat` (`id_alamat`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_kategori_produk_id_foreign` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id_kategori_produk`),
  ADD CONSTRAINT `produk_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`);

--
-- Ketidakleluasaan untuk tabel `rekening_admin`
--
ALTER TABLE `rekening_admin`
  ADD CONSTRAINT `rekening_admin_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id_bank`);

--
-- Ketidakleluasaan untuk tabel `rekening_pelapak`
--
ALTER TABLE `rekening_pelapak`
  ADD CONSTRAINT `rekening_pelapak_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`);

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_konsumen_id_foreign` FOREIGN KEY (`konsumen_id`) REFERENCES `konsumen` (`id_konsumen`),
  ADD CONSTRAINT `reviews_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`),
  ADD CONSTRAINT `transaksi_detail_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `transaksi_detail_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `withdraw`
--
ALTER TABLE `withdraw`
  ADD CONSTRAINT `withdraw_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
