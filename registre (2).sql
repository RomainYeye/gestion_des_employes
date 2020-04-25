-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 25 avr. 2020 à 09:57
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `registre`
--

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE `employes` (
  `NOEMP` int(4) NOT NULL,
  `NOM` varchar(20) DEFAULT NULL,
  `PRENOM` varchar(20) DEFAULT NULL,
  `EMPLOI` varchar(20) DEFAULT NULL,
  `SUP` int(4) DEFAULT NULL,
  `EMBAUCHE` date DEFAULT NULL,
  `SAL` double(9,2) DEFAULT NULL,
  `COM` double(9,2) DEFAULT NULL,
  `NOSERV` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`NOEMP`, `NOM`, `PRENOM`, `EMPLOI`, `SUP`, `EMBAUCHE`, `SAL`, `COM`, `NOSERV`) VALUES
(1000, 'LEROY', 'PAULOO', 'PRESIDENT', NULL, '2012-12-14', 55007.00, 10000.00, 1),
(1200, 'LEMAIRE', 'GUY', 'DIRECTEUR', 1000, '1987-03-11', 36303.63, NULL, 2),
(1303, 'MASURE', 'EMILE', 'TECHNICIEN', 1500, '1988-06-17', 10451.05, NULL, 3),
(1500, 'DUPONT', 'JEAN', 'DIRECTEUR', 1000, '1987-10-23', 28434.84, NULL, 5),
(45769, 'LAVARE', 'KEVIN', 'MONTEUR', 1000, '2020-03-12', 52000.00, NULL, 5),
(142558, 'TEST', 'MICHEL', 'COMPTABLE', 1000, '2020-04-09', 100000.00, 1000.00, 3),
(1471141, 'ONE', 'JON', 'GRAFFEUR', NULL, '2020-03-12', 5555.00, NULL, 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `employes1`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `employes1` (
`noemp` int(4)
,`nom` varchar(20)
,`emploi` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure de la table `employes2`
--

CREATE TABLE `employes2` (
  `NOEMP` int(4) NOT NULL,
  `NOM` varchar(20) DEFAULT NULL,
  `PRENOM` varchar(20) DEFAULT NULL,
  `EMPLOI` varchar(20) DEFAULT NULL,
  `SUP` int(4) DEFAULT NULL,
  `EMBAUCHE` date DEFAULT NULL,
  `SAL` double(9,2) DEFAULT NULL,
  `COM` double(9,2) DEFAULT NULL,
  `NOSERV` int(2) NOT NULL,
  `NOPROJ` decimal(3,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employes2`
--

INSERT INTO `employes2` (`NOEMP`, `NOM`, `PRENOM`, `EMPLOI`, `SUP`, `EMBAUCHE`, `SAL`, `COM`, `NOSERV`, `NOPROJ`) VALUES
(1000, 'LEROY', 'PAUL', 'PRESIDENT', NULL, '1987-10-25', 55005.50, NULL, 1, '103'),
(1101, 'DUMONT', 'LOUIS', 'VENDEUR', 1300, '1987-10-25', 9952.69, 0.00, 1, '103'),
(1102, 'MINET', 'MARC', 'VENDEUR', 1300, '1987-10-25', 8894.39, 17230.00, 1, '103'),
(1104, 'NYS', 'ETIENNE', 'TECHNICIEN', 1200, '1987-10-25', 13576.45, NULL, 1, '103'),
(1105, 'DENIMAL', 'JEROME', 'COMPTABLE', 1600, '1987-10-25', 17321.23, NULL, 1, '103'),
(1200, 'LEMAIRE', 'GUY', 'DIRECTEUR', 1000, '1987-03-11', 36303.63, NULL, 2, '103'),
(1201, 'MARTIN', 'JEAN', 'TECHNICIEN', 1200, '1987-06-25', 12358.63, NULL, 2, '103'),
(1202, 'DUPONT', 'JACQUES', 'TECHNICIEN', 1200, '1988-10-30', 11344.33, NULL, 2, '103'),
(1300, 'LENOIR', 'GERARD', 'DIRECTEUR', 1000, '1987-04-02', 31353.14, 13071.00, 3, '103'),
(1301, 'GERARD', 'ROBERT', 'VENDEUR', 1300, '1999-04-16', 8464.25, 12430.00, 3, '103'),
(1303, 'MASURE', 'EMILE', 'TECHNICIEN', 1200, '1988-06-17', 11496.16, NULL, 3, '103'),
(1500, 'DUPONT', 'JEAN', 'DIRECTEUR', 1000, '1987-10-23', 28434.84, NULL, 5, '102'),
(1501, 'DUPIRE', 'PIERRE', 'ANALYSTE', 1500, '1984-10-24', 23102.31, NULL, 5, '102'),
(1502, 'DURAND', 'BERNARD', 'PROGRAMMEUR', 1500, '1987-07-30', 14521.45, NULL, 5, '102'),
(1503, 'DELNATTE', 'LUC', 'PUPITREUR', 1500, '1999-01-15', 9681.11, NULL, 5, '102'),
(1600, 'LAVARE', 'PAUL', 'DIRECTEUR', 1000, '1991-12-13', 31238.12, NULL, 6, '102'),
(1601, 'CARON', 'ALAIN', 'COMPTABLE', 1600, '1985-09-16', 33003.30, NULL, 6, '102'),
(1602, 'DUBOIS', 'JULES', 'VENDEUR', 1300, '1990-12-20', 10473.05, 35535.00, 6, '102'),
(1603, 'MOREL', 'ROBERT', 'COMPTABLE', 1600, '1985-07-18', 33003.30, NULL, 6, '102'),
(1604, 'HAVET', 'ALAIN', 'VENDEUR', 1300, '1991-01-01', 10327.83, 33415.00, 6, '102'),
(1605, 'RICHARD', 'JULES', 'COMPTABLE', 1600, '1985-10-22', 33503.35, NULL, 5, '102'),
(1615, 'DUPREZ', 'JEAN', 'BALAYEUR', 1000, '1998-10-22', 6600.66, NULL, 5, '102'),
(2000, 'H', 'Romain', NULL, NULL, '2020-02-25', 50000.00, NULL, 1, '102'),
(1010, 'MOYEN', 'Toto', NULL, 1000, '1999-12-12', 20832.07, NULL, 1, '103');

-- --------------------------------------------------------

--
-- Structure de la table `proj`
--

CREATE TABLE `proj` (
  `noproj` decimal(3,0) NOT NULL,
  `nomproj` varchar(10) DEFAULT NULL,
  `budget` decimal(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `proj`
--

INSERT INTO `proj` (`noproj`, `nomproj`, `budget`) VALUES
('101', 'alpha', '250000.00'),
('102', 'beta', '175000.00'),
('103', 'gamma', '1500000.00');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `NOSERV` int(2) NOT NULL,
  `SERVICE` varchar(20) DEFAULT NULL,
  `VILLE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`NOSERV`, `SERVICE`, `VILLE`) VALUES
(1, 'DIRECTION', 'PARIS'),
(2, 'LOGISTIQUE', 'SECLINE'),
(3, 'VENTES', 'ROUBAIX'),
(5, 'INFORMATIQUE', 'LILLE'),
(6, 'COMPTABILITE', 'LILLE'),
(10, 'TECHNIQUE', 'Lyon');

-- --------------------------------------------------------

--
-- Structure de la table `services2`
--

CREATE TABLE `services2` (
  `NOSERV` int(2) NOT NULL,
  `SERVICE` varchar(20) DEFAULT NULL,
  `VILLE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `services2`
--

INSERT INTO `services2` (`NOSERV`, `SERVICE`, `VILLE`) VALUES
(1, 'DIRECTION', 'PARIS'),
(2, 'LOGISTIQUE', 'SECLIN'),
(3, 'VENTES', 'ROUBAIX'),
(4, 'FORMATION', 'VILLENEUVE D\'ASCQ'),
(5, 'INFORMATIQUE', 'LILLE'),
(6, 'COMPTABILITE', 'LILLE'),
(7, 'TECHNIQUE', 'ROUBAIX');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'Romain', '$2y$10$tsnELYImscmesU7Z4xVexO3N5gB2psB4YNmcA3RmeY9H2usVsjBsm', 'admin'),
(25, 'Louane', '$2y$10$oQld4.rHAqTH3qki/4QRausiNUZ87689WDIpgVRRQv1C8OVrjmnTq', 'user');

-- --------------------------------------------------------

--
-- Structure de la vue `employes1`
--
DROP TABLE IF EXISTS `employes1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employes1`  AS  select `employes`.`NOEMP` AS `noemp`,`employes`.`NOM` AS `nom`,`employes`.`EMPLOI` AS `emploi` from `employes` where `employes`.`NOSERV` = 1 ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`NOEMP`),
  ADD KEY `NOSERV` (`NOSERV`),
  ADD KEY `SUP` (`SUP`);

--
-- Index pour la table `proj`
--
ALTER TABLE `proj`
  ADD PRIMARY KEY (`noproj`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`NOSERV`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `employes_ibfk_1` FOREIGN KEY (`NOSERV`) REFERENCES `services` (`NOSERV`),
  ADD CONSTRAINT `employes_ibfk_2` FOREIGN KEY (`SUP`) REFERENCES `employes` (`NOEMP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
