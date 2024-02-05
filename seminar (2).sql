-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 05, 2024 at 03:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminar`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int NOT NULL,
  `peserta_id` int NOT NULL,
  `events_id` int NOT NULL,
  `order_id` varchar(128) NOT NULL,
  `date_absensi` datetime DEFAULT NULL,
  `status_kehadiran` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int NOT NULL,
  `name_category` varchar(128) NOT NULL,
  `slug_category` varchar(128) NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`, `slug_category`, `date_created`) VALUES
(3, 'Hari Kemerdekaan', 'hari-kemerdekaan', 1700022275),
(5, 'Umum', 'umum', 1700672467),
(6, 'Privasi', 'privasi', 1704864877);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_events` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` enum('published','draft') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `snk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `date_start` date DEFAULT NULL,
  `date_finish` date DEFAULT NULL,
  `time_start` varchar(128) DEFAULT NULL,
  `time_finish` varchar(128) DEFAULT NULL,
  `price` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kuota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sisa_kuota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `region` varchar(128) NOT NULL,
  `location` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `url_location` varchar(128) DEFAULT NULL,
  `label` varchar(50) DEFAULT NULL,
  `id_category` varchar(128) DEFAULT NULL,
  `type_event` enum('online','offline') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_events`, `title`, `slug`, `description`, `status`, `snk`, `date_start`, `date_finish`, `time_start`, `time_finish`, `price`, `kuota`, `sisa_kuota`, `region`, `location`, `url_location`, `label`, `id_category`, `type_event`, `image`, `date_created`) VALUES
(60, 'Functional Medicine-Antiaging MasterCourse on Weight Loss and Body Countouring', 'functional-medicine-antiaging-mastercourse-on-weight-loss-and-body-countouring', '<p>Functional Medicine-Antiaging MasterCourse on Weight Loss and Body&nbsp;Countouring<br><br>???? Jum\'at - Minggu, 15-16-17 Desember 2023<br>???? Espro Aesthetic Institute Jakarta Barat<br><br>LUCK = Preparation Meet Opportunity<br><br>Taukah anda bahwa 50% dari Penduduk Indonesia mengalami insuline resistance, diabetes, overweigth dan obesitas.<br>Melakukan terapi RF, cavitation, injeksi meso, bahkan liposuction pada pasien overweight dan obesitas adalah suatu kesalahan dan hanya mencari omset.<br><br>Mampukah para dokter mengatasi pasien:<br>* Diet Yoyo<br>* Wanita menopause<br>* Penghoby kulineran<br>* Banyak Undangan Makan<br>* Emotional Eater<br>* Mudah lapar<br>* Belum kenyang tanpa makan nasi<br>* Punya Gen Gemuk<br>* Malas Olahraga?<br>* Nite Craving?<br><br>Sudah coba banyak cara, namun ga efektif :<br>* Sudah coba obat injeksi yang paling baru dan mahal<br>* Sudah coba resep obat minum dengan dosis yang paling tinggi<br><br>▶️ Workshop Section:<br>1. Basic Science of Anti-Aging Medicine<br>2. Sports Medicine Approach<br>3. Nutritional Approach<br>4. Hormonal Approach<br>5. Pharmacotherapy Approach<br>6. Body Contouring<br>7. Case Studies on Obesity Management<br><br>Managing Body Shaping:<br>- Best Method for Cellulites, Stretchmarks and Waist Reduction: Shockwave, 4th Generation of Tecar Therapy, Less pain HIFU, Newest Technology Cryo and Heat Shock.<br>- How to reduce waist line 2-10cm in one treatment<br>- Ozone Therapy for Holistic Metabolic Syndrome and Body Shaping and Weight Loss<br><br>Bonus tambahan: Ilmu Ozone Therapy untuk membuka bright aura dan kharisma (1x terapi hasil langsung nampak dan bertahan 7 hari)<br><br>▶️ Speaker:<br>1. DR. Dr. S. Kristianto Witono, FAAFRM, FIAS, M.Sc, MBA, M.Kes(Gizi), ABAARM<br>2. Dr. Riani Lorreta<br>3. Ir. Samuel Lazarus<br><br>Day 1: Ozone therapy and Effective Body Shaping<br>Day 2: 4 Sections<br>Day 3: 4 Sections and case studies (participants are welcome to bring their own cases)<br><br>???? Registration:<br>Normal Price: Rp 8.500.000,- per peserta<br>Early Bird: Rp 6.500.000,- (s/d 31 Nov 2023)<br><br>Tiap peserta akan menerima:<br>* Terapi Ozone atau Body Shaping<br>* Sertifikat SKP IDI<br>* Buffet Lunch + snack coffee<br>* Gratis produk senilai 500rb</p>', 'published', '<p>khusus dokter / owner klinik</p>', '2024-01-20', '2024-02-20', '8:00 PM', '12:00 PM', '500000', '1000', '849', 'Jakarta', 'Grand Zuri Ketapang', 'https://www.google.com/maps/search/?api=1&amp;amp;query=-1.83064,109.971', '', '[\"3\"]', 'offline', 'AcarAku.com659ec2dba657c', 1705726327),
(61, 'Master Course on Fundamental Laser-Light Science + Endolift', 'master-course-on-fundamental-laser-light-science-+-endolift', '<p>Master Course on Fundamental Laser-Light Science + Endolift in Jakarta<br><br>Disertai demo newest laser diode 940nm for vascular dan laser endolift<br><br>Anda sudah pernah belajar laser &amp; IPL bahkan mengantongi sertifikat pelatihan laser, namun masih bingung?<br><br>New trend Laser for Endolift, minimally invasive laser for face &amp; Body Shaping.<br>meniruskan wajah, mengencangkan garis dagu, menghilangkan double chin, mengencangkan lengan, membentuk sixpack, mengencangkan kulit leher, Lipolisys pada area body tertentu.<br><br>Topik-topik menarik yang akan anda pelajari:<br>1. Memahami Working Mechanism &amp; Phylosophy of Laser. Pemahaman mengapa terjadi kesalahan apabila timbul efek samping yang tidak dikehendaki.<br>2. Perbedaan Q-Switch NdYAG Nano &amp; Pico.<br>3. Apa beda laser Continuous, Long Pulsed, Micro-Pulsed, Quasy Long Pulsed &amp; Q Switched Laser?<br>4. Mengapa Alexandrite laser menjadi laser terbaik untuk whitening? Dan Nd:YAG hanya untuk brightening?<br>5. Laser Pico hanya sekadar trend, dokter di Korea, Singapore sudah paham bahwa laser pico hanya untuk tattoo removal bukan melasma.<br>6. Cara membedakan laser pico asli dan palsu.<br>7. Yellow Laser dengan panjang gelombang: 532nm, 577nm, 585nm, 595nm. Bagaimana menentukan mana yang lebih bagus secara science?<br>8. Perbandingan Long Pulsed Yellow Laser dengan Long Pulsed 940nm, 980nm dan 1064nm untuk kasus vascular.<br>9. Aplikasi Diode 1450nm/1470nm untuk acne vulgaris, perbedaan memakai spot size besar atau kecil.<br>10. Bagaimana mengkombinasikan berbagai macam laser dengan Chemical Peeling?<br>11. bagaimana aplikasi CO2 laser untuk Surgery Without Anestesia?<br>12. Perbedaan Laser Active and Passive pada Q Switched Ndyag dan pengaruh pada efficacy perawatan kulit.<br>13. Apa bedanya IPL &amp; I2PL? Bagaimana membuat IPL menjadi less pain, permanent hair removal? IPL dengan gel itu kuno, sakit, penetrasinya dangkal dan banyak parameternya salah sehingga 12x terapi bulu masih tumbuh.<br><br>Senin 4 Desember 2023: The phylosophy and Fundamental of Laser-Light Science disertai demo dan limited hands on (hands on co2 fractional or diode 1450nm or qswitched ndyag or i2pl, 8 orang).<br>Selasa 5 Desember 2023: seminar + demo Endolift Laser atau hands on (Endolift maks 8 orang)</p>', 'published', '<p>Khusus Untuk Dokter &amp; Owner klinik</p>', '2024-01-26', '2024-02-29', '2:43 PM', '4:43 PM', '500000', '100', '97', 'sumatera selatan', '', '', 'Zoom', '[\"5\",\"6\"]', 'online', '65b3629e4bb06.jpeg', 1706255006);

-- --------------------------------------------------------

--
-- Table structure for table `mailer`
--

CREATE TABLE `mailer` (
  `id_mailer` int NOT NULL,
  `mail_host` varchar(128) NOT NULL,
  `mail_address` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mail_password` varchar(128) NOT NULL,
  `mail_name` varchar(128) NOT NULL,
  `mail_reply` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mail_port` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mailer`
--

INSERT INTO `mailer` (`id_mailer`, `mail_host`, `mail_address`, `mail_password`, `mail_name`, `mail_reply`, `mail_port`) VALUES
(1, 'mail.sandemoindoteknologi.co.id', 'seminar@sandemoindoteknologi.co.id', 'seminar@sandemoindoteknologi.co.id', 'Sandemo Indo Teknologi', 'seminar@sandemoindoteknologi.co.id', '465');

-- --------------------------------------------------------

--
-- Table structure for table `partnership`
--

CREATE TABLE `partnership` (
  `id_leader` int NOT NULL,
  `role_id` int NOT NULL,
  `events_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `kuota_tiket` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tiket_terjual` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `partnership`
--

INSERT INTO `partnership` (`id_leader`, `role_id`, `events_id`, `user_id`, `kuota_tiket`, `tiket_terjual`) VALUES
(48, 2, 60, 7, '122', '28'),
(50, 2, 61, 7, '3', '0');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int NOT NULL,
  `events_id` int NOT NULL,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nowa` varchar(50) NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `domisili` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_participate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `events_id`, `name`, `nowa`, `email`, `domisili`, `date_participate`) VALUES
(274, 61, 'Sandi Maulidika', '085380948596', 'infosandemo@gmail.com', 'Jakarta', '2024-02-02'),
(275, 60, 'Sandi Maulidika', '085380948596', 'infosandemo@gmail.com', 'Jakarta', '2024-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int NOT NULL,
  `name_rekening` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nomor_rekening` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name_bank` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `events_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `name_rekening`, `nomor_rekening`, `name_bank`, `code`, `image`, `events_id`) VALUES
(11, 'Sandi Maulidika', '1931239592', 'BANK BNI', NULL, 'mastercard.png', NULL),
(12, 'Voni Puspita Sari', '08234234923', 'BANK BRI', NULL, 'mastercard.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int NOT NULL,
  `title_web` varchar(128) NOT NULL,
  `sub_title` varchar(128) NOT NULL,
  `meta_google` text NOT NULL,
  `description_web` text NOT NULL,
  `logo_web` varchar(128) NOT NULL,
  `whatsapp` varchar(128) NOT NULL,
  `facebook` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `instagram` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sukses_bayar` text NOT NULL,
  `tagihan_bayar` text NOT NULL,
  `sukses_bayar_email` text NOT NULL,
  `tagihan_bayar_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `title_web`, `sub_title`, `meta_google`, `description_web`, `logo_web`, `whatsapp`, `facebook`, `instagram`, `sukses_bayar`, `tagihan_bayar`, `sukses_bayar_email`, `tagihan_bayar_email`) VALUES
(1, 'AcarAku.com', 'Pembelian Tiket Event', '<p>Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak</p>', '<p>Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak</p>', 'AcarAku6566f8d4df607.png', '6287801751656', 'https://facebook.com/sandemo', 'https://instagram.com/sandemo', '*Halo {name}*\nTerima kasih telah melakukan pembelian tiket \"{var1}\", Berikut detail pesanan Anda:\n\nInvoice: {var2}\nNama Event: {var1}\nWaktu Pelaksanaan: {var3}\nJumlah Tiket: {var4}\nStatus: LUNAS\n\nTerimas Kasih,', '*Halo {name}*\nTerima kasih telah melakukan pemesanan tiket \"{var1}\", Berikut detail pemesanan Anda:\n\nInvoice: {var2}\nNama Event: {var1}\nWaktu Pelaksanaan: {var3}\nJumlah Tiket: {var4}\nStatus: BELUM LUNAS\n\nTerimas Kasih,', '<p><strong>Halo {name}</strong><br>Terima kasih telah melakukan pembayaran tiket <strong>\"{var1}\"</strong>, Berikut detail pesanan Anda:</p>\n<p>Invoice: <strong>{var2}</strong><br>Nama Event: <strong>{var1}</strong><br>Waktu Pelaksanaan: <strong>{var3}</strong><br>Jumlah Tiket: <strong>{var4}</strong><br>Status: <strong>LUNAS</strong></p>\n<p>Terimas Kasih,</p>', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_order` char(128) NOT NULL,
  `leader_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `peserta_id` int DEFAULT NULL,
  `events_id` int NOT NULL,
  `bank_transfer` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bukti_tf` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `code_promo` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tiket` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nominal` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status_transaksi` enum('Tertunda','Refund','Lunas','Dibatalkan','Prosses') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `by_order` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_order`, `leader_id`, `user_id`, `peserta_id`, `events_id`, `bank_transfer`, `bukti_tf`, `code_promo`, `tiket`, `nominal`, `status_transaksi`, `by_order`, `date_transaksi`) VALUES
(178, 'TS592376693334', 48, 7, NULL, 60, 'BANK BNI', '65aa5b255dace2024-01-19.png', NULL, '100', '50000000', 'Lunas', '1', '2024-01-19'),
(197, 'TS428753231409', 50, 7, NULL, 61, 'BANK BNI', NULL, NULL, '3', '1500000', 'Lunas', '1', '2024-01-26'),
(208, 'TS651167753851', 48, 7, NULL, 60, 'BANK BRI', '65b75342c47ed2024-01-29.png', NULL, '50', '50000000', 'Lunas', '1', '2024-01-29'),
(217, 'TS594954430343', NULL, NULL, 274, 61, NULL, NULL, NULL, '1', NULL, 'Lunas', 'Bejok', '2024-02-02'),
(218, 'TS371376625473', NULL, NULL, 275, 60, NULL, NULL, NULL, '1', NULL, 'Lunas', 'Bejok', '2024-02-02');

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `update_sisa_kuota` AFTER UPDATE ON `transaksi` FOR EACH ROW BEGIN
    IF NEW.status_transaksi = 'Lunas' AND NEW.tiket IS NOT NULL AND NEW.peserta_id IS NULL THEN
        UPDATE events
        SET sisa_kuota = sisa_kuota - NEW.tiket
        WHERE id_events = NEW.events_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `no_hp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_id` int NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `password`, `no_hp`, `email`, `role_id`, `date_created`) VALUES
(1, 'Sandi Maulidika', '$2y$10$0z4o4Ky//pZDC1oBAkGPFO0uh069t0MK/1q35FpfHWp2Qsf6qOeTa', '087801751656', 'admin@gmail.com', 1, 1700235369),
(7, 'Bejok', '$2y$10$.OD23eSqGVgfrBzPRVDbQuprywwFj/FVFZL.fb9035.fNbhVIcd8G', '087801751656', 'leader@gmail.com', 2, 1704106320),
(10, 'Fahri', '$2y$10$I/raR/p22ktZ5dGDdVZ8IO5cj2AaQ6vm0TNNWG.98/f89OPi9TEVm', '087801751656', 'leader2@gmail.com', 2, 1705469730);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int NOT NULL,
  `name_role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id_role`, `name_role`) VALUES
(1, 'Admin'),
(2, 'Leader');

-- --------------------------------------------------------

--
-- Table structure for table `wagw`
--

CREATE TABLE `wagw` (
  `id_wagw` int NOT NULL,
  `token` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `link_send` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `link_qr` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `link_device` varchar(128) DEFAULT NULL,
  `date_created` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wagw`
--

INSERT INTO `wagw` (`id_wagw`, `token`, `link_send`, `link_qr`, `link_device`, `date_created`) VALUES
(2, '2UCzcg8AJsQCafVmcR5V', 'https://api.fonnte.com/send', 'https://api.fonnte.com/qr', 'https://api.fonnte.com/device', 1700463683);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_events`);

--
-- Indexes for table `mailer`
--
ALTER TABLE `mailer`
  ADD PRIMARY KEY (`id_mailer`);

--
-- Indexes for table `partnership`
--
ALTER TABLE `partnership`
  ADD PRIMARY KEY (`id_leader`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `wagw`
--
ALTER TABLE `wagw`
  ADD PRIMARY KEY (`id_wagw`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_events` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `mailer`
--
ALTER TABLE `mailer`
  MODIFY `id_mailer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partnership`
--
ALTER TABLE `partnership`
  MODIFY `id_leader` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wagw`
--
ALTER TABLE `wagw`
  MODIFY `id_wagw` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
