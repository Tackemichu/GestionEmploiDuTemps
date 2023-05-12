-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 mai 2023 à 14:24
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `database`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `idclasse` int(11) NOT NULL AUTO_INCREMENT,
  `niveau` varchar(5) NOT NULL,
  PRIMARY KEY (`idclasse`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`idclasse`, `niveau`) VALUES
(2, 'L2 GB'),
(3, 'M2'),
(6, 'L1 GB'),
(5, 'L2 IG'),
(7, 'L3 IG'),
(8, 'L3 GB'),
(14, 'L1 IG'),
(17, 'M3');

-- --------------------------------------------------------

--
-- Structure de la table `emploi_du_temps`
--

DROP TABLE IF EXISTS `emploi_du_temps`;
CREATE TABLE IF NOT EXISTS `emploi_du_temps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsalle` int(11) NOT NULL,
  `idprof` varchar(50) NOT NULL,
  `idclasse` varchar(50) NOT NULL,
  `cours` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idsalle` (`idsalle`),
  KEY `idprof` (`idprof`),
  KEY `idclasse` (`idclasse`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `emploi_du_temps`
--

INSERT INTO `emploi_du_temps` (`id`, `idsalle`, `idprof`, `idclasse`, `cours`, `date`) VALUES
(18, 10, '98', '3', 'Laravel', '2023-04-28 20:57:00'),
(19, 25, '91', '7', 'Laravel', '2023-04-28 07:59:00'),
(20, 22, '94', '3', 'Archi', '2023-04-26 02:00:00'),
(21, 26, '91', '6', 'Java', '2023-05-05 01:20:00'),
(22, 27, '99', '17', 'Anglais', '2023-04-27 08:00:00'),
(26, 18, '91', '8', 'Merise', '2023-04-29 01:33:00');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `idprof` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `grade` varchar(80) NOT NULL,
  PRIMARY KEY (`idprof`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`idprof`, `nom`, `prenom`, `grade`) VALUES
(91, 'RAMANDIMBY', 'robert', 'Docteur en Informatique'),
(99, 'RAKOTO', 'Mathieus', 'Assistant dâ€™Enseignement SupÃ©rieur et de Recherche'),
(98, 'LOVASOA', 'Lidia', 'Professeur titulaire');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `idsalle` int(11) NOT NULL AUTO_INCREMENT,
  `design` varchar(255) CHARACTER SET utf8 NOT NULL,
  `occupation` varchar(100) NOT NULL,
  PRIMARY KEY (`idsalle`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`idsalle`, `design`, `occupation`) VALUES
(26, 'salle blanche', 'Non'),
(24, 'salle D4', 'Oui'),
(22, 'salle maninday', 'Oui'),
(18, 'salle C001', 'Oui'),
(27, 'Salle G', 'Oui');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idu` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`idu`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idu`, `nom`, `prenom`, `email`, `mdp`) VALUES
(1, 'RAMANDIMBY', 'lova', 'andrianomeko@gmail.com', 'aona');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
