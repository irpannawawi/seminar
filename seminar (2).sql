-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2023 at 11:15 AM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.25

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
(2, 'Umum', 'umum', 1700022267),
(3, 'Hari Kemerdekaan', 'hari-kemerdekaan', 1700022275);

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
  `date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_start` time DEFAULT NULL,
  `date_finish` time DEFAULT NULL,
  `price` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kuota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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

INSERT INTO `events` (`id_events`, `title`, `slug`, `description`, `status`, `snk`, `date`, `date_start`, `date_finish`, `price`, `kuota`, `location`, `url_location`, `label`, `id_category`, `type_event`, `image`, `date_created`) VALUES
(32, 'Functional Medicine-Antiaging MasterCourse on Weight Loss and Body Countouring', 'functional-medicine-antiaging-mastercourse-on-weight-loss-and-body-countouring', '<p>Functional Medicine-Antiaging MasterCourse on Weight Loss and Body&nbsp;Countouring<br><br>???? Jum\'at - Minggu, 15-16-17 Desember 2023<br>???? Espro Aesthetic Institute Jakarta Barat<br><br>LUCK = Preparation Meet Opportunity<br><br>Taukah anda bahwa 50% dari Penduduk Indonesia mengalami insuline resistance, diabetes, overweigth dan obesitas.<br>Melakukan terapi RF, cavitation, injeksi meso, bahkan liposuction pada pasien overweight dan obesitas adalah suatu kesalahan dan hanya mencari omset.<br><br>Mampukah para dokter mengatasi pasien:<br>* Diet Yoyo<br>* Wanita menopause<br>* Penghoby kulineran<br>* Banyak Undangan Makan<br>* Emotional Eater<br>* Mudah lapar<br>* Belum kenyang tanpa makan nasi<br>* Punya Gen Gemuk<br>* Malas Olahraga?<br>* Nite Craving?<br><br>Sudah coba banyak cara, namun ga efektif :<br>* Sudah coba obat injeksi yang paling baru dan mahal<br>* Sudah coba resep obat minum dengan dosis yang paling tinggi<br><br>▶️ Workshop Section:<br>1. Basic Science of Anti-Aging Medicine<br>2. Sports Medicine Approach<br>3. Nutritional Approach<br>4. Hormonal Approach<br>5. Pharmacotherapy Approach<br>6. Body Contouring<br>7. Case Studies on Obesity Management<br><br>Managing Body Shaping:<br>- Best Method for Cellulites, Stretchmarks and Waist Reduction: Shockwave, 4th Generation of Tecar Therapy, Less pain HIFU, Newest Technology Cryo and Heat Shock.<br>- How to reduce waist line 2-10cm in one treatment<br>- Ozone Therapy for Holistic Metabolic Syndrome and Body Shaping and Weight Loss<br><br>Bonus tambahan: Ilmu Ozone Therapy untuk membuka bright aura dan kharisma (1x terapi hasil langsung nampak dan bertahan 7 hari)<br><br>▶️ Speaker:<br>1. DR. Dr. S. Kristianto Witono, FAAFRM, FIAS, M.Sc, MBA, M.Kes(Gizi), ABAARM<br>2. Dr. Riani Lorreta<br>3. Ir. Samuel Lazarus<br><br>Day 1: Ozone therapy and Effective Body Shaping<br>Day 2: 4 Sections<br>Day 3: 4 Sections and case studies (participants are welcome to bring their own cases)<br><br>???? Registration:<br>Normal Price: Rp 8.500.000,- per peserta<br>Early Bird: Rp 6.500.000,- (s/d 31 Nov 2023)<br><br>Tiap peserta akan menerima:<br>* Terapi Ozone atau Body Shaping<br>* Sertifikat SKP IDI<br>* Buffet Lunch + snack coffee<br>* Gratis produk senilai 500rb</p>', 'published', '<p>khusus dokter / owner klinik</p>', '11/16/2023', '10:00:00', '12:00:00', '500000', '50', 'Cafe Kincana', 'https://maps.app.goo.gl/SeLjPqUjPqvMFFCn8', '', '2, 3', 'offline', NULL, 1700031633),
(37, 'Pediatrics and Neonatology Updates For Daily Practice (PNEUMO)', 'pediatrics-and-neonatology-updates-for-daily-practice-(pneumo)', '', 'draft', '', '', '00:00:00', '00:00:00', '', '', '', '', '', '', NULL, NULL, 1700031822);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `password`, `no_hp`, `email`, `date_created`, `role_id`) VALUES
(1, 'Sandi Maulidika', '$2y$10$cnzOdfEdSGWUEONqTCMkSetNEbu5lr/npJXRXEmuxoGxGS44MX4wW', '087801751657', 'admin@gmail.com', '2023-11-07 12:11:24', 1),
(2, 'Voni Puspita Sari', '$2y$10$.LtIJtIjVD85tKx8/YokWea.FV1BU.LpaU4a7zgmcQ6TPTOfI49u6', '087801751656', 'vonisnd@gmail.com', '0000-00-00 00:00:00', 2);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_events` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
