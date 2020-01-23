-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2020 pada 19.51
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
(1, '5e161826ef5d0_keripik bayam 3.jpg', 1),
(2, '5e1618278e926_keripik bayam.png', 1),
(3, '5e1618280bf50_keripik bayam 2.jpg', 1),
(4, '5e1618d1d90ce_tahu bulat 2.jpg', 2),
(5, '5e1618d27fd84_tahu bulat.jpg', 2),
(6, '5e18b25e0172c_seblak.png', 3),
(7, '5e1af8b52f5f1_keripik bayam.png', 4);

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
(2, 'Elektronik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `pembeli_id` int(11) DEFAULT NULL,
  `pembeli_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `harga_jual` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirasi_pembayaran`
--

CREATE TABLE `konfirasi_pembayaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_transfer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `nama_pengirim` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_konfirmasi` datetime NOT NULL,
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
  `rekening_admin_id` int(11) NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transfer` datetime NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_konfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_lengkap`, `username`, `password`, `provinsi_id`, `city_id`, `alamat`, `kode_pos`, `nomor_hp`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'M. Ilham Surya Pratama', 'ilham', '$2y$10$YkfummEoFgo5DVE1WqQ/nODBlYmeqHcuvEGGwhfAdJhfXklkXj6Yi', 11, 369, 'Maron Wetan RT 11 RW 003', '67276', '085330150827', 'ilham@gmail.com', 'aktif', '2020-01-04 20:33:34', '2020-01-04 20:33:34'),
(2, 'Luthfi Nurul Huda', 'luthfi', 'luthfi', 11, 369, 'Bucor', '67276', '085330150827', 'luthfi@gmail.com', 'aktif', '2020-01-05 14:03:40', '2020-01-05 14:03:40');

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
(4, '2019_12_28_073709_konfirmasi_pembayaran', 1),
(5, '2019_12_29_144016_create_pelapak_table', 1),
(6, '2019_12_30_151524_create_produk_table', 1),
(7, '2019_12_30_163537_create_kategori_produk_table', 1),
(8, '2019_12_30_163700_add_kategori_produk_id_on_produk', 1),
(9, '2019_12_31_035113_create_rekening_pelapak_table', 1),
(10, '2019_12_31_113317_create_foto_produk_table', 1),
(11, '2020_01_04_072034_create_konsumen_table', 1),
(13, '2020_01_11_183431_add_jumlah_harga_to_keranjang', 1),
(14, '2020_01_12_075634_add_status_to_keranjang', 1),
(15, '2020_01_13_085806_create_transaksi_table', 1),
(16, '2020_01_13_091643_create_transaksi_detail_table', 1),
(17, '2020_01_17_201414_create_konfirmasi_table', 1),
(18, '2020_01_08_185357_create_keranjang_table', 2);

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
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_official` enum('santri','official') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_toko` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` int(11) NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelapak`
--

INSERT INTO `pelapak` (`id_pelapak`, `username`, `password`, `status_official`, `nama_toko`, `alamat_toko`, `provinsi_id`, `city_id`, `alamat`, `kode_pos`, `nomor_hp`, `email`, `rating`, `saldo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'indra', '$2y$10$s5PfsWTO/htr7B8FHy4FuewimegZpaH2Q4IYrCK/ziJdT.414nPbW', 'santri', 'Toko Indra', 'Brabe', 11, 369, 'Brabe', '67276', '085330150827', '', '', 0, 'aktif', '2020-01-01 14:53:00', '2020-01-01 14:53:00'),
(2, 'yolo', 'yolo', 'santri', 'Toko Yolo', 'Maron', 11, 369, 'RT 11 RW 003 Maron Wetan', '67276', '085330150827', '', '', 0, 'aktif', '2020-01-10 17:18:00', '2020-01-10 17:18:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `produk` (`id_produk`, `nama_produk`, `satuan`, `berat`, `harga_modal`, `harga_jual`, `diskon`, `stok`, `keterangan`, `foto`, `tipe_produk`, `pelapak_id`, `wishlist`, `terjual`, `created_at`, `updated_at`, `kategori_produk_id`) VALUES
(1, 'Keripik Bayam', 'pcs', 2, 4000, 5000, 0, 20, 'Keripik bayam adalah keripik yang terbuat dari daun bayam dan digoreng dengan menggunakan tepung yang telah dibumbui. Biasanya rasanya adalah asin dengan aroma bawang yang gurih.', NULL, 'single', 1, 0, 0, '2020-01-08 10:58:49', '2020-01-08 10:58:49', 1),
(2, 'Keripi Tahun Bulat', 'pcs', 5, 2000, 4000, 0, 10, 'Tahu bulat adalah sebuah jajanan kaki lima berupa olahan kacang kedelai yang dibuat menjadi sebuah tahu berbentuk bulat dengan isi kopong. Biasanya, tahu bulat dijual di sebuah mobil bak terbuka dan kebanyakan dihargai Rp500 per buah. Jajanan tersebut menjadi semakin terkenal semenjak adanya permainan video Tahu Bulat yang diluncurkan pada tahun 2016,Namun Begitu Kepopuleran Permainan Tersebut tak berlangsung lama. Saat ini, bisnis tahu bulat menyebar di Bogor, Sentul, Jonggol, Cileungsi, Sukabumi, Sumedang, Bandung, Semarang, Solo, Yogyakarta, hingga Wonosobo.', NULL, 'single', 1, 0, 0, '2020-01-08 11:01:39', '2020-01-08 11:01:39', 1),
(3, 'Kripik Seblak', 'pcs', 4, 4000, 6000, 0, 10, 'Bandung merupakan salah satu kota yang memiliki beragam makanan khas. Makanan khas Bandung terdiri dari banyak sekali ragam dan salah satunya ada yang dinamakan seblak. Terbuat dari kerupuk basah yang dimasak dengan sayuran dan sumber protein seperti telur, ayam, atau olahan daging sapi, dan dimasak dengan bumbu tertentu. Seblak kini menjadi jalanan yang digemari berbagai kalangan masyarakat.\r\n\r\nSIMAK PULA\r\n4 Cara Membuat Seblak Sederhana, Jajanan Khas Bandung yang Populer\r\nSeblak disajikan di rumah makan dan warung, serta dijajakan di gerobak pedagang keliling. Makanan yang bertekstur kenyal ini memiliki rasa yang pedas dan menyegarkan, serta memiliki beberapa variasi, baik rasa maupun bahan tambahan juga kemasan.\r\n\r\nSaat ini cara membuat seblak memiliki dua jenis yaitu seblak kering dan seblak basah. Cara membuat seblak kering sebenarnya mirip dengan kerupuk pedas pada umumnya. Seperti basreng (bakso goreng), ceker goreng, makaroni, kerupuk pedas, kerupuk mi pedas dan lain sebagainya.\r\n\r\nSedangkan cara membuat seblak basah, dibuat dengan kuah pedas gurih dengan aroma kencur yang khas. Varian seblak pun kini sudah bermacam-macam, tak hanya mi dan kerupuk basah saja, namun bisa ditambah sayap ayam, sosis, bakso, makaroni, tulang ayam, dan ceker.\r\n\r\nSeblak kering adalah satu dari beberapa varian jajanan seblak yang dapat kamu nikmati sebagai cemilan pedas renyah. Bumbu berasa pedas adalah perpaduan yang tak bisa dipisahkan dari seblak baik itu seblak kering ataupun seblak basah. Rasa pedas ini justru yang menjadikan sensasi tersendiri dalam menikmati seblak sehingga jika dibuat tanpa campuran bumbu pedasnya akan berasa ada yang kurang. Baik seblak basah maupun seblak kering, keduanya sama-sama menggunakan bahan dasar kerupuk. Kerupuk yang dipilih bisa berupa kerupuk udang atau juga kerupuk bawang.\r\n\r\nPerbedaan dari keduanya hanyalah dari langkah penyajiannya saja. Jika pada seblak basah kerupuk yang akan dimasak direndam dan direbus terlebih dahulu sampai lembek, maka untuk seblak kering kerupuk yang akan dimasak langsung digoreng bersama dengan bumbu halus hingga merekah. Kehati-hatian tentunya diperlukan sekali pada saat menggoreng seblak kering ini agar tidak gosong yang justru akan menjadikan seblak ini terasa pahit.\r\n\r\nPerbedaan lainnya antara seblak kering dengan seblak basah adalah ketahanannya. Seblak basah hanya dapat bertahan selama beberapa jam saja atau tidak lebih dari satu hari. Sedangkan seblak kering asalkan disimpan dalam wadah kedap udara akan bertahan cukup lama dan kerenyahannya pun akan bertahan cukup lama. Penasaran dengan cara membuat seblak kering? Berikut resepnya yang telah dirangkum liputan6.com, Sabtu (20/10/2018)', NULL, 'single', 2, 0, 0, '2020-01-10 10:21:46', '2020-01-10 10:21:46', 1),
(4, 'Kricik Bayem 3', 'pcs', 3, 5000, 6000, 0, 20, 'Kricik Bayem 3 enak', NULL, 'single', 1, 0, 0, '2020-01-12 03:45:25', '2020-01-12 03:45:25', 1);

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
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembeli_id` int(10) NOT NULL,
  `pembeli_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `pembeli_id`, `pembeli_type`, `waktu_transaksi`, `total_bayar`) VALUES
(1, '1579803742', 1, 'App\\Models\\Konsumen', '2020-01-23 18:22:22', 22000);

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
  `status_order` enum('pending','verifikasi','packing','dikirim','sukses') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `transaksi_id`, `produk_id`, `jumlah`, `harga_jual`, `diskon`, `kurir`, `service`, `ongkir`, `etd`, `sub_total`, `status_order`) VALUES
(1, 1, 1, 1, 5000, 0, 'jne', 'CTCYES', 12000, '1-1', 17000, 'pending'),
(2, 1, 1, 1, 5000, 0, 'jne', 'CTCYES', 12000, '1-1', 17000, 'pending');

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

--
-- Indexes for dumped tables
--

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
-- Indeks untuk tabel `konfirasi_pembayaran`
--
ALTER TABLE `konfirasi_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indeks untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

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
  ADD PRIMARY KEY (`id_pelapak`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_pelapak_id_foreign` (`pelapak_id`),
  ADD KEY `produk_kategori_produk_id_foreign` (`kategori_produk_id`);

--
-- Indeks untuk tabel `rekening_pelapak`
--
ALTER TABLE `rekening_pelapak`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `transaksi_detail_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `transaksi_detail_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `konfirasi_pembayaran`
--
ALTER TABLE `konfirasi_pembayaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pelapak`
--
ALTER TABLE `pelapak`
  MODIFY `id_pelapak` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rekening_pelapak`
--
ALTER TABLE `rekening_pelapak`
  MODIFY `id_rekening` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_kategori_produk_id_foreign` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id_kategori_produk`),
  ADD CONSTRAINT `produk_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `transaksi_detail_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;