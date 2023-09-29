-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 29 sep. 2023 à 12:44
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `super_reminder`
--

-- --------------------------------------------------------

--
-- Structure de la table `Lists`
--

CREATE TABLE `Lists` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Lists`
--

INSERT INTO `Lists` (`id`, `id_user`, `title`, `date`) VALUES
(6, 7, 'Bonjour', '2023-09-27'),
(16, 8, 'LIste anniversaire magalie', '2023-09-28'),
(17, 8, 'Prout', '2023-09-28'),
(18, 8, 'Liste test 1', '2023-09-28'),
(19, 8, 'Liste test 2', '2023-09-28'),
(20, 8, 'Liste test 3', '2023-09-28'),
(21, 8, 'Liste test 4', '2023-09-28'),
(22, 8, 'prout', '2023-09-29'),
(23, 8, 'Blout', '2023-09-29'),
(24, 8, 'Brout', '2023-09-29'),
(26, 2, 'Bonjour', '2023-09-29'),
(27, 2, 'HELLO', '2023-09-29'),
(31, 2, 'Bonjour', '2023-09-29');

-- --------------------------------------------------------

--
-- Structure de la table `Tasks`
--

CREATE TABLE `Tasks` (
  `id` int(11) NOT NULL,
  `id_list` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `finish` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(11) DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Tasks`
--

INSERT INTO `Tasks` (`id`, `id_list`, `title`, `date`, `finish`, `priority`) VALUES
(2, 9, 'lait', '2023-09-27', 0, 3),
(5, 12, 'Poubelle', '2023-09-27', 0, 3),
(6, 12, 'Eau', '2023-09-27', 0, 3),
(7, 12, 'Lait', '2023-09-27', 0, 2),
(8, 12, 'Fromage', '2023-09-27', 0, 2),
(14, 12, 'julie', '2023-09-28', 0, 2),
(17, 13, 'Lait', '2023-09-28', 0, 3),
(21, 13, 'Boulangerie', '2023-09-28', 0, 3),
(32, 17, 'Box', '2023-09-29', 0, 3),
(33, 18, 'box', '2023-09-29', 0, 3),
(34, 17, 'Hot', '2023-09-29', 0, 3),
(35, 17, 'Bloc', '2023-09-29', 0, 3),
(36, 13, 'bonjour', '2023-09-29', 0, 3),
(37, 13, 'Acheter de l&#039;huile', '2023-09-29', 0, 1),
(38, 31, 'Bonjour', '2023-09-29', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `login`, `firstname`, `lastname`, `password`) VALUES
(1, 'Toto', 'Thomas', 'Spinec', '$2y$10$1qRtYRbnGSqS/2mVj5gqX.7uYZ2sUJkm2MC3hmNyjHsPq6gTUFOGO'),
(2, 'Juju', 'Julie', 'Lambert', '$2y$10$HLGmdJAO8L32dma2vutNFethBuITuHG0QqsY4jo8tFgpZSs/XyE3i'),
(3, 'Mehdo', 'mehdi', 'romdhani', '$2y$10$WOllTShiugGM.9B.tTB..OwMFtFZU6.necFW6dS5twvF/HIKbm3du'),
(4, 'Jerem', 'Jeremy', 'Nowak', '$2y$10$la2vwTmXxEjnwx11.NXCqOB.9S/XUoV8BtCr7XpIMmIu/GkRgGq8K'),
(5, 'Amine', 'Amine', 'Necib', '$2y$10$0E5pr0GlYjf2kDzNv986yuDNJcCYJzRBveWDMqFhrFzBcvmO4NHMO'),
(6, 'Axel', 'Axel', 'Vair', '$2y$10$EtJeckNfDN2sf.S5r/j08.kXVVCeavzA51MqN1AJjzw0K8J8v9vC2'),
(7, 'Vince', 'Vincent', 'Ye', '$2y$10$QpQWpE9xlWsRKUjqnfGb2O3bFc8M/wuZqMRILc0u3SKHZtjJKf8ya'),
(8, 'Titi', 'Laetitia', 'Parente-Necib', '$2y$10$qkrsAOq8TluO7SU0jnjZ6OMI8PSMRXxDd0RBPEe3BBRK51SsgfX8W');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Lists`
--
ALTER TABLE `Lists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Tasks`
--
ALTER TABLE `Tasks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Lists`
--
ALTER TABLE `Lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `Tasks`
--
ALTER TABLE `Tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
