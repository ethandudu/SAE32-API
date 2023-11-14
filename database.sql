-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 14 nov. 2023 à 20:33
-- Version du serveur : 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae32`
--

-- --------------------------------------------------------

--
-- Structure de la table `index`
--

CREATE TABLE `index` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) DEFAULT 'Sans titre',
  `numberframe` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `packets`
--

CREATE TABLE `packets` (
  `ID` int(11) NOT NULL,
  `fileid` int(11) NOT NULL,
  `packetid` int(11) NOT NULL,
  `protocols` varchar(80) NOT NULL,
  `macsrc` varchar(17) NOT NULL,
  `macdst` varchar(17) NOT NULL,
  `ipsrc` varchar(17) DEFAULT NULL,
  `ipdst` varchar(17) DEFAULT NULL,
  `data` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `index`
--
ALTER TABLE `index`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `packets`
--
ALTER TABLE `packets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fileid` (`fileid`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `index`
--
ALTER TABLE `index`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `packets`
--
ALTER TABLE `packets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `packets`
--
ALTER TABLE `packets`
  ADD CONSTRAINT `updateid-fileid` FOREIGN KEY (`fileid`) REFERENCES `index` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
