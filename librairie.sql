-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2023 at 04:01 PM
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
-- Database: `librairie`
--

-- --------------------------------------------------------

--
-- Table structure for table `auteurs`
--

CREATE TABLE `auteurs` (
  `id` int NOT NULL,
  `nom` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pays` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'vivant' COMMENT 'vivant ou mort',
  `dateDeces` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auteurs`
--

INSERT INTO `auteurs` (`id`, `nom`, `prenom`, `pays`, `status`, `dateDeces`) VALUES
(1, 'Non', 'Existant', 'aucun', 'vivant', '2023-03-01'),
(9, 'Rowling', 'J.K', 'Angleterre', 'vivant', '2023-03-03'),
(10, 'King', 'Stephen', 'U.S.A', 'vivant', '2023-03-01'),
(11, 'Proust', 'Marcel', 'France', 'mort', '1922-11-18'),
(12, 'Christie', 'Agatha', 'Angleterre', 'mort', '1976-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `genre` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre`, `description`) VALUES
(1, 'Non existant', 'Un genre default.'),
(2, 'Aventure', 'Un genre qui amene a decouvrir des chose inconnue'),
(7, 'Horreur', 'Un genre qui se base sur la peur du lecteur.'),
(8, 'Fantastique', 'Un genre qui se base sur des chose irréel');

-- --------------------------------------------------------

--
-- Table structure for table `livres`
--

CREATE TABLE `livres` (
  `id` int NOT NULL,
  `titre` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `idAuteur` int NOT NULL,
  `resume` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `prix` float NOT NULL,
  `dateParution` date NOT NULL,
  `idGenre` int NOT NULL,
  `edition` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `langue` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` bigint NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `idAuteur`, `resume`, `prix`, `dateParution`, `idGenre`, `edition`, `langue`, `image`, `isbn`, `stock`) VALUES
(10, 'Harry Potter', 9, '\"Tu est un sorcier Harry\" dit Hagrid', 8.9, '2015-12-08', 8, 'Pottermore', 'Français', 'index.jpg', 9781781101032, 10),
(11, 'Le crime de l\'orient express', 12, 'Une des aventure d\'hercule Poirot.', 8, '1934-01-01', 1, 'Test', 'Anglais', 'index.jpg', 2010009274, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
