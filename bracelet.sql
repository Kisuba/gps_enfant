-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 26 oct. 2023 à 13:30
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gpsenfant`
--

-- --------------------------------------------------------

--
-- Structure de la table `bracelet`
--

CREATE TABLE `bracelet` (
  `id` int(11) NOT NULL,
  `id_bracelet` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bracelet`
--

INSERT INTO `bracelet` (`id`, `id_bracelet`) VALUES
(11, 'BR230010'),
(7, 'br45656');

--
-- Déclencheurs `bracelet`
--
DELIMITER $$
CREATE TRIGGER `delete_bracelet` AFTER DELETE ON `bracelet` FOR EACH ROW BEGIN
   DELETE FROM gps_eleves where id_bracelet = old.id;
END
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bracelet`
--
ALTER TABLE `bracelet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_bracelet` (`id_bracelet`),
  ADD UNIQUE KEY `id_bracelet_2` (`id_bracelet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bracelet`
--
ALTER TABLE `bracelet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
