-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2023 at 06:19 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `seminar`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int NOT NULL,
  `name_category` varchar(128) NOT NULL,
  `slug_category` varchar(128) NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`, `slug_category`, `date_created`) VALUES
(3, 'Hari Kemerdekaan', 'hari-kemerdekaan', 1700022275),
(5, 'Umum', 'umum', 1700672467);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_events` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` enum('published','draft') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `snk` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `date_start` date DEFAULT NULL,
  `date_finish` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_finish` time DEFAULT NULL,
  `price` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kuota` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `location` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `url_location` varchar(128) DEFAULT NULL,
  `label` varchar(50) DEFAULT NULL,
  `id_category` varchar(128) DEFAULT NULL,
  `type_event` enum('online','offline') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `image` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_events`, `title`, `slug`, `description`, `status`, `snk`, `date_start`, `date_finish`, `time_start`, `time_finish`, `price`, `kuota`, `location`, `url_location`, `label`, `id_category`, `type_event`, `image`, `date_created`) VALUES
(32, 'Functional Medicine-Antiaging MasterCourse on Weight Loss and Body Countouring', 'functional-medicine-antiaging-mastercourse-on-weight-loss-and-body-countouring', '<p>Functional Medicine-Antiaging MasterCourse on Weight Loss and Body&nbsp;Countouring<br><br>???? Jum\'at - Minggu, 15-16-17 Desember 2023<br>???? Espro Aesthetic Institute Jakarta Barat<br><br>LUCK = Preparation Meet Opportunity<br><br>Taukah anda bahwa 50% dari Penduduk Indonesia mengalami insuline resistance, diabetes, overweigth dan obesitas.<br>Melakukan terapi RF, cavitation, injeksi meso, bahkan liposuction pada pasien overweight dan obesitas adalah suatu kesalahan dan hanya mencari omset.<br><br>Mampukah para dokter mengatasi pasien:<br>* Diet Yoyo<br>* Wanita menopause<br>* Penghoby kulineran<br>* Banyak Undangan Makan<br>* Emotional Eater<br>* Mudah lapar<br>* Belum kenyang tanpa makan nasi<br>* Punya Gen Gemuk<br>* Malas Olahraga?<br>* Nite Craving?<br><br>Sudah coba banyak cara, namun ga efektif :<br>* Sudah coba obat injeksi yang paling baru dan mahal<br>* Sudah coba resep obat minum dengan dosis yang paling tinggi<br><br>▶️ Workshop Section:<br>1. Basic Science of Anti-Aging Medicine<br>2. Sports Medicine Approach<br>3. Nutritional Approach<br>4. Hormonal Approach<br>5. Pharmacotherapy Approach<br>6. Body Contouring<br>7. Case Studies on Obesity Management<br><br>Managing Body Shaping:<br>- Best Method for Cellulites, Stretchmarks and Waist Reduction: Shockwave, 4th Generation of Tecar Therapy, Less pain HIFU, Newest Technology Cryo and Heat Shock.<br>- How to reduce waist line 2-10cm in one treatment<br>- Ozone Therapy for Holistic Metabolic Syndrome and Body Shaping and Weight Loss<br><br>Bonus tambahan: Ilmu Ozone Therapy untuk membuka bright aura dan kharisma (1x terapi hasil langsung nampak dan bertahan 7 hari)<br><br>▶️ Speaker:<br>1. DR. Dr. S. Kristianto Witono, FAAFRM, FIAS, M.Sc, MBA, M.Kes(Gizi), ABAARM<br>2. Dr. Riani Lorreta<br>3. Ir. Samuel Lazarus<br><br>Day 1: Ozone therapy and Effective Body Shaping<br>Day 2: 4 Sections<br>Day 3: 4 Sections and case studies (participants are welcome to bring their own cases)<br><br>???? Registration:<br>Normal Price: Rp 8.500.000,- per peserta<br>Early Bird: Rp 6.500.000,- (s/d 31 Nov 2023)<br><br>Tiap peserta akan menerima:<br>* Terapi Ozone atau Body Shaping<br>* Sertifikat SKP IDI<br>* Buffet Lunch + snack coffee<br>* Gratis produk senilai 500rb</p>', 'published', '<p>khusus dokter / owner klinik</p>', '2023-05-26', '2023-05-26', '10:00:00', '12:00:00', '500000', '50', 'Cafe Kincana', 'https://maps.app.goo.gl/SeLjPqUjPqvMFFCn8', '', '', 'offline', NULL, 1701008608),
(40, 'Pediatrics and Neonatology Updates For Daily Practice (PNEUMO)', 'pediatrics-and-neonatology-updates-for-daily-practice-(pneumo)', '<p>Greetings to you! MER-C Cabang Jogja proudly present:</p>\r\n<p><strong>Pediatric and Neonatology Updates for Daily Practice (PNEUMO)</strong></p>\r\n<p>&nbsp;</p>\r\n<p>Anak-anak merupakan aset berharga masa depan bagi sebuah negara. Sebagai generasi penerus bangsa, kesejahteraan dan kesehatan anak-anak tentu menjadi prioritas dalam pembangunan calon sumber daya manusia yang berkualitas. Kesehatan sebagai salah satu kebutuhan anak masih menjadi masalah utama di Indonesia.</p>\r\n<p>Berdasarkan tujuan pembangunan berkelanjutan poin ketiga yang dicetuskan oleh&nbsp;<em>World Health Organization&nbsp;</em>(WHO), neonatus dan anak-anak merupakan bagian dari target utama untuk pemenuhan kesehatan dengan mencegah penderitaan dari penyakit yang dapat dicegah dan kematian dini. Selain itu, misi pemerintah melalui Kementerian Kesehatan Republik Indonesia tahun 2020-2024 diantaranya yaitu menurunkan angka kematian ibu dan bayi serta menurunkan angka stunting pada balita.</p>\r\n<p>Oleh karena itu, sebagai upaya meningkatkan kualitas pelayanan kesehatan, panitia seminar MERC menghadirkan&nbsp;<em>Pediatric &amp; Neonatology Update for&nbsp; Daily Practice</em>&nbsp;(PNEUMO) dengan tema&nbsp;<em>update&nbsp;</em>tatalaksana pada pasien anak dan neonatus dalam praktik klinis. Harapannya adalah untuk meningkatkan kualitas tenaga kesehatan dalam memberikan pelayanan kesehatan.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Symposium</strong></p>\r\n<p>1. Emergency Management in Pediatrics</p>\r\n<p>2. Pediatrics Urology 101: Common Cases in Emergency Setting</p>\r\n<p>3. Traumatology in Pediatrics</p>\r\n<p>4. Early Detection of Children Developmental Disorders: Easy Yet Challenging</p>\r\n<p>5. Childhood Diabetes : Diagnosis and Treatment</p>\r\n<p>6. Updates in Immunization (According to IDAI)</p>\r\n<p>7. How to Deal with Child Abuse for General Practitioner</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Workshop</strong></p>\r\n<p>1. Circumcision in Pediatric Emergency</p>\r\n<p>2. Pediatric Fluid Therapy</p>\r\n<p>3. Airway Management in Pediatric Emergency</p>\r\n<p>4. Case-based Simulation in Pediatric Emergency Diseases</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong>Early bird until 26th October 2023. Grab it fast!</strong></em></p>\r\n<p>&nbsp;</p>\r\n<p><strong>For more information:</strong></p>\r\n<p>IG : @MER-C Jogja</p>\r\n<p>Contact Person :</p>\r\n<p>1. 0821 3521 1889 (Amalia)</p>\r\n<p>2. 0812 8304 6319 (Rahma)</p>', 'published', '<p>Sasaran peserta dari kegiatan seminar dan workshop ini adalah dokter spesialis, dokter umum/residen, perawat, bidan, mahasiswa kesehatan dan seluruh tenaga kesehatan lain yang berminat untuk ikut serta.</p>', '2023-11-26', '2023-11-26', '08:11:00', '10:02:00', 'FREE', '100', 'Shope Coffee', 'http://seminar.test/', '', '', 'offline', NULL, 1701008623),
(41, 'Master Course on Fundamental Laser-Light Science + Endolift', 'master-course-on-fundamental-laser-light-science-+-endolift', '<p><strong>Master Course on Fundamental Laser-Light Science + Endolift in Jakarta</strong><br><br>Disertai demo newest laser diode 940nm for vascular dan laser endolift<br><br>Anda sudah pernah belajar laser &amp; IPL bahkan mengantongi sertifikat pelatihan laser, namun masih bingung?<br><br>New trend Laser for Endolift, minimally invasive laser for face &amp; Body Shaping.<br>meniruskan wajah, mengencangkan garis dagu, menghilangkan double chin, mengencangkan lengan, membentuk sixpack, mengencangkan kulit leher, Lipolisys pada area body tertentu.<br><br>Topik-topik menarik yang akan anda pelajari:<br>1. Memahami Working Mechanism &amp; Phylosophy of Laser. Pemahaman mengapa terjadi kesalahan apabila timbul efek samping yang tidak dikehendaki.<br>2. Perbedaan Q-Switch NdYAG Nano &amp; Pico.<br>3. Apa beda laser Continuous, Long Pulsed, Micro-Pulsed, Quasy Long Pulsed &amp; Q Switched Laser?<br>4. Mengapa Alexandrite laser menjadi laser terbaik untuk whitening? Dan Nd:YAG hanya untuk brightening?<br>5. Laser Pico hanya sekadar trend, dokter di Korea, Singapore sudah paham bahwa laser pico hanya untuk tattoo removal bukan melasma.<br>6. Cara membedakan laser pico asli dan palsu.<br>7. Yellow Laser dengan panjang gelombang: 532nm, 577nm, 585nm, 595nm. Bagaimana menentukan mana yang lebih bagus secara science?<br>8. Perbandingan Long Pulsed Yellow Laser dengan Long Pulsed 940nm, 980nm dan 1064nm untuk kasus vascular.<br>9. Aplikasi Diode 1450nm/1470nm untuk acne vulgaris, perbedaan memakai spot size besar atau kecil.<br>10. Bagaimana mengkombinasikan berbagai macam laser dengan Chemical Peeling?<br>11. bagaimana aplikasi CO2 laser untuk Surgery Without Anestesia?<br>12. Perbedaan Laser Active and Passive pada Q Switched Ndyag dan pengaruh pada efficacy perawatan kulit.<br>13. Apa bedanya IPL &amp; I2PL? Bagaimana membuat IPL menjadi less pain, permanent hair removal? IPL dengan gel itu kuno, sakit, penetrasinya dangkal dan banyak parameternya salah sehingga 12x terapi bulu masih tumbuh.<br><br>Senin 4 Desember 2023: The phylosophy and Fundamental of Laser-Light Science disertai demo dan limited hands on (hands on co2 fractional or diode 1450nm or qswitched ndyag or i2pl, 8 orang).<br>Selasa 5 Desember 2023: seminar + demo Endolift Laser atau hands on (Endolift maks 8 orang)</p>', 'published', '<p>Khusus Untuk Dokter &amp; Owner klinik</p>', '2023-11-26', '2023-11-26', '09:01:00', '11:01:00', '50000', '100', 'Shope Coffee', 'http://seminar.test/', '', '', 'offline', NULL, 1701008219);

-- --------------------------------------------------------

--
-- Table structure for table `partnership`
--

CREATE TABLE `partnership` (
  `id_leader` int NOT NULL,
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  `kuota_tiket` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tiket_terjual` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `partnership`
--

INSERT INTO `partnership` (`id_leader`, `role_id`, `user_id`, `kuota_tiket`, `total_terjual`) VALUES
(1, 2, 4, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int NOT NULL,
  `events_id` int NOT NULL,
  `order_id` int NOT NULL,
  `name_peserta` varchar(128) NOT NULL,
  `nowa` varchar(50) NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_participate` int NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `events_id`, `order_id`, `name_peserta`, `nowa`, `email`, `date_participate`, `status`) VALUES
(1, 32, 1, 'Sandi Maulidika', '085380945896', 'SMA Negeri', 1700031633, 'testing'),
(2, 32, 2, 'Voni Puspita Sari', '082182877737', 'SMA Negeri', 1700031633, 'testing'),
(3, 40, 3, 'Ajeng Anu', '085380945896', 'SMA Negeri', 1700031633, 'testing'),
(4, 41, 4, 'Robi anu', '081936219006', 'SMA Negeri', 1700031633, 'testing');

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
  `facebook` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `instagram` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sukses_bayar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `title_web`, `sub_title`, `meta_google`, `description_web`, `logo_web`, `facebook`, `instagram`, `sukses_bayar`) VALUES
(1, 'AcarAku', 'Pembelian Tiket Event', '<p>Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</p>', '<p>Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</p>', 'AcarAku655cd4fc3ab19.png', 'https://facebook.com/sandemo', 'https://instagram.com/sandemo', '*Halo {name}*\r\nTerima kasih telah melakukan pemesanan tiket *\"{var1}\"*, Berikut detail pemesanan Anda:\r\n\r\nInvoice: *{var2}*\r\nNama Event: *{var1}*\r\nWaktu Pelaksanaan: *{var3}*\r\nJumlah Tiket: *{var4}*\r\nStatus: *LUNAS*\r\n\r\nTerimas Kasih,');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `no_hp` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_id` int NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `password`, `no_hp`, `email`, `role_id`, `date_created`) VALUES
(1, 'Sandi Maulidika', '$2y$10$0z4o4Ky//pZDC1oBAkGPFO0uh069t0MK/1q35FpfHWp2Qsf6qOeTa', '087801751656', 'admin@gmail.com', 1, 1700235369),
(4, 'Voni Puspita Sari', '$2y$10$XlMS7k.xbhrNeynIFfH3uOQOCxBCq7N48GxKdj51CumDtxCITPOH6', '087801751656', 'voni@gmail.com', 2, 1701058216);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int NOT NULL,
  `name_role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `link_send` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `link_qr` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `link_device` varchar(128) DEFAULT NULL,
  `date_created` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wagw`
--

INSERT INTO `wagw` (`id_wagw`, `token`, `link_send`, `link_qr`, `link_device`, `date_created`) VALUES
(2, 'hfPduW__pEo8AgzoC5bD', 'https://api.fonnte.com/send', 'https://api.fonnte.com/qr', 'https://api.fonnte.com/device', 1700463683);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_events` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `partnership`
--
ALTER TABLE `partnership`
  MODIFY `id_leader` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wagw`
--
ALTER TABLE `wagw`
  MODIFY `id_wagw` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
