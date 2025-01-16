-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 12:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gpsenfant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `mot_de_passe` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `mot_de_passe`) VALUES
(1, 'admin1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

-- --------------------------------------------------------

--
-- Table structure for table `bracelet`
--

CREATE TABLE `bracelet` (
  `id` int(11) NOT NULL,
  `id_bracelet` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bracelet`
--

INSERT INTO `bracelet` (`id`, `id_bracelet`) VALUES
(11, 'BR230010'),
(7, 'br45656');

--
-- Triggers `bracelet`
--
DELIMITER $$
CREATE TRIGGER `delete_bracelet` AFTER DELETE ON `bracelet` FOR EACH ROW BEGIN
   DELETE FROM gps_eleves where id_bracelet = old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `datagps`
--

CREATE TABLE `datagps` (
  `id` int(10) UNSIGNED NOT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `reading_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `identBrac` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datagps`
--

INSERT INTO `datagps` (`id`, `longitude`, `latitude`, `reading_time`, `identBrac`) VALUES
(297, -1.67683, 29.2298, '2023-10-20 14:34:30', 'BR230010'),
(298, -1.67688, 29.2298, '2023-10-20 14:34:41', 'BR230010'),
(299, -1.67696, 29.2299, '2023-10-20 14:34:51', 'BR230010'),
(300, -1.67695, 29.2299, '2023-10-20 14:35:03', 'BR230010'),
(301, -1.67695, 29.2299, '2023-10-20 14:35:12', 'BR230010'),
(302, -1.67695, 29.2299, '2023-10-20 14:35:22', 'BR230010'),
(303, -1.67695, 29.2299, '2023-10-20 14:35:32', 'BR230010'),
(304, -1.67695, 29.2299, '2023-10-20 14:35:42', 'BR230010'),
(305, -1.67695, 29.2299, '2023-10-20 14:35:53', 'BR230010'),
(306, -1.67695, 29.2299, '2023-10-20 14:36:03', 'BR230010'),
(307, -1.67695, 29.2299, '2023-10-20 14:36:13', 'BR230010'),
(308, -1.67695, 29.2299, '2023-10-20 14:36:23', 'BR230010'),
(309, -1.67695, 29.2299, '2023-10-22 05:56:28', 'BR230010'),
(310, -1.67611, 29.2271, '2024-07-11 14:35:27', 'br45656'),
(311, -1.67619, 29.2274, '2024-07-11 14:34:06', 'br45656');

-- --------------------------------------------------------

--
-- Table structure for table `eleves`
--

CREATE TABLE `eleves` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `postnom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `adresse` varchar(30) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eleves`
--

INSERT INTO `eleves` (`id`, `nom`, `postnom`, `prenom`, `adresse`, `photo`) VALUES
(1, 'Marceline1', 'Kisuba1', 'Alice1', 'Q Mabanga N41', 'eleve.jpg'),
(10, 'Obed', 'Kalulumya', 'Obed', 'Tmk 43', 'photo_2024-08-14_10-48-57.jpg'),
(13, 'Aurel', 'Kisuba', 'Charles', 'Katoyi 41', 'exemple.jpg.jpg');

--
-- Triggers `eleves`
--
DELIMITER $$
CREATE TRIGGER `delete_eleve` AFTER DELETE ON `eleves` FOR EACH ROW BEGIN
   DELETE FROM gps_eleves where id_eleve = old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gps_eleves`
--

CREATE TABLE `gps_eleves` (
  `id` int(11) NOT NULL,
  `id_bracelet` int(11) DEFAULT NULL,
  `id_eleve` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gps_eleves`
--

INSERT INTO `gps_eleves` (`id`, `id_bracelet`, `id_eleve`) VALUES
(20, 11, 1),
(21, 7, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bracelet`
--
ALTER TABLE `bracelet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_bracelet` (`id_bracelet`),
  ADD UNIQUE KEY `id_bracelet_2` (`id_bracelet`);

--
-- Indexes for table `datagps`
--
ALTER TABLE `datagps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gps_eleves`
--
ALTER TABLE `gps_eleves`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bracelet`
--
ALTER TABLE `bracelet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `datagps`
--
ALTER TABLE `datagps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT for table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gps_eleves`
--
ALTER TABLE `gps_eleves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
