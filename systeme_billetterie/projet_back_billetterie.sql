-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 30 avr. 2023 à 04:18
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_back_billetterie`
--

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE `billets` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `public_code` varchar(255) NOT NULL,
  `private_id` varchar(255) NOT NULL,
  `date_generation` datetime NOT NULL DEFAULT current_timestamp(),
  `consume_code` varchar(255) NOT NULL,
  `consume` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `billets`
--

INSERT INTO `billets` (`id`, `event_id`, `visitor_id`, `public_code`, `private_id`, `date_generation`, `consume_code`, `consume`) VALUES
(1, 1, 1, '5104C7C933049685BE6020EECAD3C0', 'FAITHG77F4', '2023-04-30 03:58:41', 'DEFC225FF9D99126F057650D075F6F9A', 0),
(2, 1, 2, '2C6E49BC5A26042A5DA50658F4F602', 'HANANE744D', '2023-04-30 03:58:59', '7B9E233970F3D86118BE0F2AD9FA8D74', 0),
(4, 1, 4, '57D929A19A3EFED4A034A1EC0CAC6B', 'FOUADE832', '2023-04-30 03:59:25', '87006943C3874402B71611B0B1B9286D', 0),
(5, 1, 5, '8C0213718976ECBE549A95FD27B595', 'ADAMF3E6', '2023-04-30 03:59:33', 'AF7A50024909F676F32CB5F45AC9ECD6', 1),
(6, 1, 6, 'A4936C116FE993CB7FF65D9F832D34', 'BLESSI1912', '2023-04-30 04:07:16', 'B5BF1878D96FDD97FF3DB0E0709B7FF2', 0),
(7, 1, 7, 'DB837C63E25FBB36A2841FE2DE1B0F', 'CHARLE3983', '2023-04-30 04:07:23', '7D2C275189B23A3F0CB47F9E46B521E9', 0);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `Place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `nom`, `date`, `Place`) VALUES
(1, 'Rendu Projet back', '2023-04-30 23:59:00', 'Amphithéâtre Hetic');

-- --------------------------------------------------------

--
-- Structure de la table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `visitors`
--

INSERT INTO `visitors` (`id`, `nom_prenom`, `event_id`) VALUES
(1, 'Faithgot', 1),
(2, 'Hanane', 1),
(4, 'Fouad', 1),
(5, 'Adam', 1),
(6, 'BLESSING-GRACE', 1),
(7, 'Charles', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billets`
--
ALTER TABLE `billets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billet_visitor` (`visitor_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_event` (`event_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billets`
--
ALTER TABLE `billets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billets`
--
ALTER TABLE `billets`
  ADD CONSTRAINT `billet_visitor` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`),
  ADD CONSTRAINT `billets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Contraintes pour la table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitor_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
