-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2026 at 10:57 AM
-- Server version: 9.6.0
-- PHP Version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_tugas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `deskripsi` text,
  `deadline` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `prioritas` enum('Tinggi','Sedang','Rendah') NOT NULL,
  `status` enum('Belum Selesai','Selesai') DEFAULT 'Belum Selesai',
  `selesai_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `poin_konsistensi` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `nama_tugas`, `deskripsi`, `deadline`, `waktu`, `prioritas`, `status`, `selesai_at`, `created_at`, `poin_konsistensi`) VALUES
(1, 1, 'Algoritma dan Pemrograman', 'Mata kuliah yang memfokuskan daya pikir logika yang tinggi dan bernalar tinggi', '2026-03-24', '21:55:00', 'Tinggi', 'Selesai', NULL, '2026-03-24 14:55:06', 0),
(2, 1, 'Struktur Data', 'Mata kuliah yang merupakan tingkat lanjut dari Algoritma dan Pemrograman', '2026-03-24', '22:02:00', 'Tinggi', 'Selesai', NULL, '2026-03-24 15:01:00', 0),
(3, 1, 'Basis Data', 'Mata Kuliah dengan membuat mahasiswa paham database', '2026-03-24', '22:13:00', 'Sedang', 'Selesai', NULL, '2026-03-24 15:11:40', 0),
(4, 1, 'Sistem Operasi', 'Mata kuliah yang menyenangkan karena mencoba berbagi linux distro', '2026-03-24', '22:28:00', 'Sedang', 'Selesai', '2026-03-24 15:27:11', '2026-03-24 15:27:10', 10),
(5, 1, 'Artificial Inteligent', 'AI adalah matakuliah paling susah nih tapi bisa diakses dengan mudah dan resources yang banyak.', '2026-03-27', '16:40:00', 'Tinggi', 'Selesai', '2026-03-27 16:39:45', '2026-03-27 09:39:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `panggilan` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `panggilan`, `created_at`) VALUES
(1, 'Rossi Ramadhan', '$2y$12$JnaIi.ZT8w0.gwdKqwR.cu/in1tn64N5ohFBtYaiCcNnlBoL7kPnG', 'Rossi', '2026-03-24 14:28:08'),
(2, 'rossi', '$2y$12$i9dkZj58rkYpAPlahtD47.Xtf7ILtg8BxIOw9EGIk6RfYVXjeUjki', 'Rossi', '2026-04-21 12:03:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
