-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 02 juin 2024 à 21:21
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pj_piscine`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `InsertRandomAvailabilities`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRandomAvailabilities` ()   BEGIN
    DECLARE i INT;
    DECLARE j INT;
    DECLARE h TIME;

    SET i = 1;
    
    WHILE i <= 20 DO
        SET j = 0;
        
        WHILE j < 7 DO
            SET h = '10:00:00';
            
            WHILE h <= '17:00:00' DO
                INSERT INTO dispo_agents_heure_par_heure (id_agent, jour, heure, dispo)
                VALUES (i, 
                        CASE j
                            WHEN 0 THEN 'Lundi'
                            WHEN 1 THEN 'Mardi'
                            WHEN 2 THEN 'Mercredi'
                            WHEN 3 THEN 'Jeudi'
                            WHEN 4 THEN 'Vendredi'
                            WHEN 5 THEN 'Samedi'
                            WHEN 6 THEN 'Dimanche'
                        END, 
                        h, 
                        FLOOR(RAND() * 2));
                        
                SET h = ADDTIME(h, '01:00:00');
            END WHILE;
            
            SET j = j + 1;
        END WHILE;
        
        SET i = i + 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `courriel` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courriel` (`courriel`),
  UNIQUE KEY `idx_courriel` (`courriel`(50))
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `courriel`, `mot_de_passe`) VALUES
(111, 'admin', 'administrateur', 'administrateur@omnesimmobilier.fr', 'admin78990');

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `id_agent` int NOT NULL AUTO_INCREMENT,
  `photo` text,
  `bureau` varchar(255) DEFAULT NULL,
  `numero_tel` varchar(20) DEFAULT NULL,
  `courriel` varchar(255) NOT NULL,
  `specialite` varchar(255) DEFAULT NULL,
  `video` text,
  `cv` text,
  `honoraire` decimal(10,2) DEFAULT NULL,
  `mot_de_passe` char(20) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_agent`),
  UNIQUE KEY `courriel` (`courriel`),
  UNIQUE KEY `idx_courriel` (`courriel`(191))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id_agent`, `photo`, `bureau`, `numero_tel`, `courriel`, `specialite`, `video`, `cv`, `honoraire`, `mot_de_passe`, `nom`, `prenom`) VALUES
(1, 'Edouard.jpg', '0130137520', '0622674528', 'Edouard.menut@omnesimmobilier.fr', 'residentiel', 'videoedouard.mp4', 'cvedouard.jpg', 26.80, 'Edoudou92', 'Menut', 'Edouard'),
(2, 'chloe.jpg', '0130137521', '0614677383', 'Chloe.lestic@omnesimmobilier.fr', 'commercial', 'videochloe.mp4', 'cvchloe.jpg', 26.80, 'Cloclo78', 'Lestic', 'Chloe'),
(3, 'alice.jpg', '0130137522', '0783456782', 'Alice.coudert@omnesimmobilier.fr', 'Location', 'videoalice.mp4', 'cvalice.jpg', 26.80, 'Alice13', 'Coudert', 'Alice'),
(4, 'victor.jpg', '0130137523', '0767548202', 'Victor.laine@omnesimmobilier.fr', 'Terrain', 'videovictor.mp4', 'cvvictor.jpg', 26.80, 'Victor16', 'Laine', 'Victor'),
(5, 'agent5.jpg', '0130137524', '0623456781', 'Agent5@omnesimmobilier.fr', 'residentiel', 'video5.mp4', 'cv5.jpg', 26.80, 'Password5', 'Garcia', 'Miguel'),
(6, 'agent6.jpg', '0130137525', '0623456782', 'Agent6@omnesimmobilier.fr', 'residentiel', 'video6.mp4', 'cv6.jpg', 26.80, 'Password6', 'Müller', 'Anna'),
(7, 'agent7.jpg', '0130137526', '0623456783', 'Agent7@omnesimmobilier.fr', 'residentiel', 'video7.mp4', 'cv7.jpg', 26.80, 'Password7', 'Kim', 'Ji-hoon'),
(8, 'agent8.jpg', '0130137527', '0623456784', 'Agent8@omnesimmobilier.fr', 'residentiel', 'video8.mp4', 'cv8.jpg', 26.80, 'Password8', 'Santos', 'Maria'),
(9, 'agent9.jpg', '0130137528', '0623456785', 'Agent9@omnesimmobilier.fr', 'commercial', 'video9.mp4', 'cv9.jpg', 26.80, 'Password9', 'Nguyen', 'Thi'),
(10, 'agent10.jpg', '0130137529', '0623456786', 'Agent10@omnesimmobilier.fr', 'commercial', 'video10.mp4', 'cv10.jpg', 26.80, 'Password10', 'Yamamoto', 'Takeshi'),
(11, 'agent11.jpg', '0130137530', '0623456787', 'Agent11@omnesimmobilier.fr', 'commercial', 'video11.mp4', 'cv11.jpg', 26.80, 'Password11', 'Dupont', 'Jean'),
(12, 'agent12.jpg', '0130137531', '0623456788', 'Agent12@omnesimmobilier.fr', 'commercial', 'video12.mp4', 'cv12.jpg', 26.80, 'Password12', 'Plaza', 'Marie'),
(13, 'agent13.jpg', '0130137532', '0623456789', 'Agent13@omnesimmobilier.fr', 'Location', 'video13.mp4', 'cv13.jpg', 26.80, 'Password13', 'Smith', 'Rahul'),
(14, 'agent14.jpg', '0130137533', '0623456790', 'Agent14@omnesimmobilier.fr', 'Location', 'video14.mp4', 'cv14.jpg', 26.80, 'Password14', 'Legal', 'Emily'),
(15, 'agent15.jpg', '0130137534', '0623456791', 'Agent15@omnesimmobilier.fr', 'Location', 'video15.mp4', 'cv15.jpg', 26.80, 'Password15', 'Sellitau', 'Emma'),
(16, 'agent16.jpg', '0130137535', '0623456792', 'Agent16@omnesimmobilier.fr', 'Location', 'video16.mp4', 'cv16.jpg', 26.80, 'Password16', 'Cisse', 'Zinedine'),
(17, 'agent17.jpg', '0130137536', '0623456793', 'Agent17@omnesimmobilier.fr', 'Terrain', 'video17.mp4', 'cv17.jpg', 26.80, 'Password17', 'Gado', 'Jerry'),
(18, 'agent18.jpg', '0130137537', '0623456794', 'Agent18@omnesimmobilier.fr', 'Terrain', 'video18.mp4', 'cv18.jpg', 26.80, 'Password18', 'Dos Santos', 'Victoria'),
(19, 'agent19.jpg', '0130137538', '0623456795', 'Agent19@omnesimmobilier.fr', 'Terrain', 'video19.mp4', 'cv19.jpg', 26.80, 'Password19', 'Da Silva', 'Rayan'),
(20, 'agent20.jpg', '0130137539', '0623456796', 'Agent20@omnesimmobilier.fr', 'Terrain', 'video20.mp4', 'cv20.jpg', 26.80, 'Password20', 'Larcanche', 'Fred');

-- --------------------------------------------------------

--
-- Structure de la table `biens`
--

DROP TABLE IF EXISTS `biens`;
CREATE TABLE IF NOT EXISTS `biens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `photos` text,
  `description` text,
  `adresse` text,
  `prix` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `biens`
--

INSERT INTO `biens` (`id`, `type`, `photos`, `description`, `adresse`, `prix`) VALUES
(49, 'residentiel', 'photos_biens/bien49.jpg', 'Villa spacieuse avec vue panoramique sur la ville, 4 chambres, 3 salles de bain, grande terrasse et jardin arboré.', '12 allée des Lilas, Paris', 750000.00),
(50, 'commercial', 'photos_biens/bien50.jpg', 'Local commercial récemment rénové, idéalement situé en plein centre-ville, comprenant 2 espaces de vente.', '15 rue de la Paix, Lyon', 200000.00),
(51, 'location', 'photos_biens/bien51.jpg', 'Appartement moderne en location, 2 chambres, lumineux avec balcon offrant une vue imprenable sur la mer.', '20 avenue des Champs, Marseille', 1800.00),
(52, 'terrain', 'photos_biens/bien52.jpg', 'Terrain plat constructible, bien exposé, situé dans un quartier calme, proche des commodités.', '10 boulevard de la République, Lille', 80000.00),
(53, 'residentiel', 'photos_biens/bien53.jpg', 'Maison de ville rénovée avec goût, 2 chambres, petit jardin intimiste, proche des transports en commun.', '8 impasse des Roses, Bordeaux', 550000.00),
(54, 'commercial', 'photos_biens/bien54.jpg', 'Local commercial lumineux, parfait pour une boutique de luxe, situé dans un quartier prisé de la ville.', '25 quai de la Seine, Paris', 180000.00),
(55, 'location', 'photos_biens/bien55.jpg', 'Appartement en location, entièrement meublé, 2 chambres, cuisine équipée, proche des commerces et transports.', '30 rue de Rivoli, Paris', 2200.00),
(56, 'terrain', 'photos_biens/bien56.jpg', 'Terrain à bâtir avec vue dégagée sur la campagne, idéal pour la construction d une maison individuelle.', '40 avenue des Fleurs, Nice', 95000.00),
(57, 'residentiel', 'photos_biens/bien57.jpg', 'Maison de ville avec jardin, 2 chambres, rénovée avec des matériaux de qualité, proche des écoles et des commerces.', '50 rue Victor Hugo, Lyon', 600000.00),
(58, 'commercial', 'photos_biens/bien58.jpg', 'Local commercial spacieux, offrant une belle visibilité, situé dans un quartier animé et touristique.', '60 boulevard Saint-Germain, Paris', 200000.00),
(59, 'location', 'photos_biens/bien59.jpg', 'Appartement en location, lumineux et calme, proche des transports en commun et des commerces.', '70 rue de la Gare, Lille', 2100.00),
(60, 'terrain', 'photos_biens/bien60.jpg', 'Grand terrain constructible, situé dans un quartier résidentiel, offrant de nombreuses possibilités.', '80 avenue de la Liberté, Marseille', 100000.00),
(61, 'residentiel', 'photos_biens/bien61.jpg', 'Charmante maison en pierre, entièrement rénovée, avec jardin paysager, à proximité des écoles et des commerces.', '90 rue de la Mer, Bordeaux', 580000.00),
(62, 'commercial', 'photos_biens/bien62.jpg', 'Local commercial en angle de rue, avec vitrine, idéal pour une enseigne de prestige.', '100 boulevard des Capucines, Paris', 190000.00),
(63, 'location', 'photos_biens/bien63.jpg', 'Appartement en location, spacieux et lumineux, offrant une vue dégagée sur la ville.', '110 rue de la Liberté, Lyon', 2400.00),
(64, 'terrain', 'photos_biens/bien64.jpg', 'Terrain plat et viabilisé, situé dans un lotissement calme, à proximité des services.', '120 avenue du Stade, Marseille', 105000.00),
(65, 'residentiel', 'photos_biens/bien65.jpg', 'Maison de ville avec terrasse, entièrement rénovée, proche du centre-ville et des transports.', '130 boulevard de la République, Lille', 620000.00),
(66, 'commercial', 'photos_biens/bien66.jpg', 'Local commercial avec belle hauteur sous plafond, situé dans un quartier dynamique.', '140 rue des Écoles, Bordeaux', 210000.00),
(67, 'location', 'photos_biens/bien67.jpg', 'Appartement en location, entièrement rénové, offrant de beaux volumes et des prestations de qualité.', '150 avenue de la Gare, Paris', 2300.00),
(68, 'terrain', 'photos_biens/bien68.jpg', 'Grand terrain avec vue panoramique sur la mer, idéal pour la construction dune villa contemporaine.', '160 boulevard du Montparnasse, Paris', 110000.00),
(69, 'residentiel', 'photos_biens/bien69.jpg', 'Maison de ville avec cour intérieure, entièrement rénovée, proche des commerces et des écoles.', '170 rue de la Paix, Lyon', 600000.00),
(70, 'commercial', 'photos_biens/bien70.jpg', 'Local commercial lumineux, situé en plein cœur de la ville, proche des grands axes.', '180 avenue des Champs, Marseille', 220000.00),
(71, 'location', 'photos_biens/bien71.jpg', 'Appartement en location, avec balcon et vue dégagée sur la ville, proche des commodités.', '190 boulevard de la Liberté, Lille', 2500.00),
(72, 'terrain', 'photos_biens/bien72.jpg', 'Terrain arboré, situé dans un quartier résidentiel, à quelques minutes des plages.', '200 rue de la Mer, Bordeaux', 120000.00),
(73, 'residentiel', 'photos_biens/bien73.jpg', 'Maison de ville avec jardin, entièrement rénovée, offrant des prestations haut de gamme.', '210 rue de la République, Lyon', 620000.00);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` text,
  `courriel` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `infos_financieres` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_courriel` (`courriel`(191))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `adresse`, `courriel`, `mot_de_passe`, `infos_financieres`) VALUES
(1, 'lola', 'legal', '6 Rue Brune\r\n', 'chloe.lestic@gmail.com', '$2y$10$xs7Hr.8Ar1cPEUOSuiJ8fOrIF76SJfXzmei5Alu0A3XQzvxugYJhm', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `communication`
--

DROP TABLE IF EXISTS `communication`;
CREATE TABLE IF NOT EXISTS `communication` (
  `ID_communication` int NOT NULL AUTO_INCREMENT,
  `ID_client` int DEFAULT NULL,
  `ID_agent` int DEFAULT NULL,
  `message` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `envoyeur` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_communication`),
  KEY `ID_client` (`ID_client`),
  KEY `ID_agent` (`ID_agent`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consultations`
--

DROP TABLE IF EXISTS `consultations`;
CREATE TABLE IF NOT EXISTS `consultations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `courriel_client` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `id_agent` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courriel_client` (`courriel_client`(250)),
  KEY `id_agent` (`id_agent`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `consultations`
--

INSERT INTO `consultations` (`id`, `courriel_client`, `date`, `heure`, `id_agent`) VALUES
(4, 'chloe.lestic@gmail.com', '2024-05-14', '10:00:00', 2),
(7, 'chloe.lestic@gmail.com', '0000-00-00', '10:00:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `dispo_agents`
--

DROP TABLE IF EXISTS `dispo_agents`;
CREATE TABLE IF NOT EXISTS `dispo_agents` (
  `id_dispo` int NOT NULL AUTO_INCREMENT,
  `id_agent` int NOT NULL,
  `jour` varchar(10) NOT NULL,
  `AM` tinyint(1) NOT NULL DEFAULT '1',
  `PM` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_dispo`),
  KEY `id_agent` (`id_agent`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `dispo_agents`
--

INSERT INTO `dispo_agents` (`id_dispo`, `id_agent`, `jour`, `AM`, `PM`) VALUES
(1, 1, 'Lundi', 0, 0),
(2, 1, 'Mardi', 0, 0),
(3, 1, 'Mercredi', 0, 0),
(4, 1, 'Jeudi', 1, 1),
(5, 1, 'Vendredi', 0, 1),
(6, 2, 'Lundi', 1, 1),
(7, 2, 'Mardi', 1, 0),
(8, 2, 'Mercredi', 1, 1),
(9, 2, 'Jeudi', 0, 1),
(10, 2, 'Vendredi', 1, 0),
(11, 3, 'Lundi', 0, 1),
(12, 3, 'Mardi', 0, 0),
(13, 3, 'Mercredi', 0, 1),
(14, 3, 'Jeudi', 1, 1),
(15, 3, 'Vendredi', 0, 1),
(16, 4, 'Lundi', 0, 0),
(17, 4, 'Mardi', 1, 1),
(18, 4, 'Mercredi', 0, 1),
(19, 4, 'Jeudi', 1, 1),
(20, 4, 'Vendredi', 0, 1),
(21, 5, 'Lundi', 0, 0),
(22, 5, 'Mardi', 1, 0),
(23, 5, 'Mercredi', 0, 1),
(24, 5, 'Jeudi', 1, 0),
(25, 5, 'Vendredi', 0, 0),
(26, 6, 'Lundi', 1, 0),
(27, 6, 'Mardi', 0, 1),
(28, 6, 'Mercredi', 0, 0),
(29, 6, 'Jeudi', 1, 0),
(30, 6, 'Vendredi', 0, 1),
(31, 7, 'Lundi', 0, 1),
(32, 7, 'Mardi', 0, 0),
(33, 7, 'Mercredi', 0, 0),
(34, 7, 'Jeudi', 1, 0),
(35, 7, 'Vendredi', 0, 1),
(36, 8, 'Lundi', 1, 0),
(37, 8, 'Mardi', 1, 1),
(38, 8, 'Mercredi', 0, 0),
(39, 8, 'Jeudi', 1, 0),
(40, 8, 'Vendredi', 0, 1),
(41, 9, 'Lundi', 0, 1),
(42, 9, 'Mardi', 1, 0),
(43, 9, 'Mercredi', 0, 1),
(44, 9, 'Jeudi', 0, 1),
(45, 9, 'Vendredi', 1, 0),
(46, 10, 'Lundi', 1, 1),
(47, 10, 'Mardi', 0, 0),
(48, 10, 'Mercredi', 0, 1),
(49, 10, 'Jeudi', 0, 0),
(50, 10, 'Vendredi', 1, 1),
(51, 11, 'Lundi', 1, 0),
(52, 11, 'Mardi', 1, 1),
(53, 11, 'Mercredi', 0, 0),
(54, 11, 'Jeudi', 1, 0),
(55, 11, 'Vendredi', 0, 1),
(56, 12, 'Lundi', 0, 1),
(57, 12, 'Mardi', 0, 0),
(58, 12, 'Mercredi', 1, 0),
(59, 12, 'Jeudi', 1, 0),
(60, 12, 'Vendredi', 0, 1),
(61, 13, 'Lundi', 1, 0),
(62, 13, 'Mardi', 0, 1),
(63, 13, 'Mercredi', 0, 0),
(64, 13, 'Jeudi', 1, 0),
(65, 13, 'Vendredi', 0, 1),
(66, 14, 'Lundi', 0, 1),
(67, 14, 'Mardi', 0, 0),
(68, 14, 'Mercredi', 1, 0),
(69, 14, 'Jeudi', 1, 0),
(70, 14, 'Vendredi', 0, 1),
(71, 15, 'Lundi', 1, 0),
(72, 15, 'Mardi', 1, 1),
(73, 15, 'Mercredi', 0, 0),
(74, 15, 'Jeudi', 1, 0),
(75, 15, 'Vendredi', 0, 1),
(76, 16, 'Lundi', 0, 1),
(77, 16, 'Mardi', 0, 0),
(78, 16, 'Mercredi', 1, 0),
(79, 16, 'Jeudi', 1, 0),
(80, 16, 'Vendredi', 0, 1),
(81, 17, 'Lundi', 1, 0),
(82, 17, 'Mardi', 1, 1),
(83, 17, 'Mercredi', 0, 0),
(84, 17, 'Jeudi', 1, 0),
(85, 17, 'Vendredi', 0, 1),
(86, 18, 'Lundi', 0, 1),
(87, 18, 'Mardi', 0, 0),
(88, 18, 'Mercredi', 1, 0),
(89, 18, 'Jeudi', 1, 0),
(90, 18, 'Vendredi', 0, 1),
(91, 19, 'Lundi', 1, 0),
(92, 19, 'Mardi', 0, 1),
(93, 19, 'Mercredi', 0, 0),
(94, 19, 'Jeudi', 1, 0),
(95, 19, 'Vendredi', 0, 1),
(96, 20, 'Lundi', 0, 1),
(97, 20, 'Mardi', 1, 0),
(98, 20, 'Mercredi', 0, 1),
(99, 20, 'Jeudi', 1, 1),
(100, 20, 'Vendredi', 0, 0);

--
-- Déclencheurs `dispo_agents`
--
DROP TRIGGER IF EXISTS `before_insert_dispo_agents`;
DELIMITER $$
CREATE TRIGGER `before_insert_dispo_agents` BEFORE INSERT ON `dispo_agents` FOR EACH ROW BEGIN
    IF NEW.AM = 0 THEN
        UPDATE dispo_agents_heure_par_heure
        SET dispo = 0
        WHERE id_agent = NEW.id_agent AND jour = NEW.jour AND HOUR(heure) < 12;
    END IF;

    IF NEW.PM = 0 THEN
        UPDATE dispo_agents_heure_par_heure
        SET dispo = 0
        WHERE id_agent = NEW.id_agent AND jour = NEW.jour AND HOUR(heure) >= 12;
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_dispo_agents`;
DELIMITER $$
CREATE TRIGGER `before_update_dispo_agents` BEFORE UPDATE ON `dispo_agents` FOR EACH ROW BEGIN
    IF NEW.AM = 0 THEN
        UPDATE dispo_agents_heure_par_heure
        SET dispo = 0
        WHERE id_agent = NEW.id_agent AND jour = NEW.jour AND HOUR(heure) < 12;
    ELSEIF OLD.AM = 0 AND NEW.AM = 1 THEN
        UPDATE dispo_agents_heure_par_heure
        SET dispo = 1
        WHERE id_agent = NEW.id_agent AND jour = NEW.jour AND HOUR(heure) < 12;
    END IF;

    IF NEW.PM = 0 THEN
        UPDATE dispo_agents_heure_par_heure
        SET dispo = 0
        WHERE id_agent = NEW.id_agent AND jour = NEW.jour AND HOUR(heure) >= 12;
    ELSEIF OLD.PM = 0 AND NEW.PM = 1 THEN
        UPDATE dispo_agents_heure_par_heure
        SET dispo = 1
        WHERE id_agent = NEW.id_agent AND jour = NEW.jour AND HOUR(heure) >= 12;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `dispo_agents_heure_par_heure`
--

DROP TABLE IF EXISTS `dispo_agents_heure_par_heure`;
CREATE TABLE IF NOT EXISTS `dispo_agents_heure_par_heure` (
  `id_agent` int NOT NULL,
  `jour` varchar(10) NOT NULL,
  `heure` time NOT NULL,
  `dispo` tinyint(1) NOT NULL DEFAULT '0',
  `id_rdv` int DEFAULT NULL,
  PRIMARY KEY (`id_agent`,`jour`,`heure`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `dispo_agents_heure_par_heure`
--

INSERT INTO `dispo_agents_heure_par_heure` (`id_agent`, `jour`, `heure`, `dispo`, `id_rdv`) VALUES
(1, 'Lundi', '10:00:00', 0, NULL),
(1, 'Lundi', '11:00:00', 0, NULL),
(1, 'Lundi', '12:00:00', 0, NULL),
(1, 'Lundi', '13:00:00', 0, NULL),
(1, 'Lundi', '14:00:00', 0, NULL),
(1, 'Lundi', '15:00:00', 0, NULL),
(1, 'Lundi', '16:00:00', 0, NULL),
(1, 'Lundi', '17:00:00', 0, NULL),
(1, 'Mardi', '10:00:00', 0, NULL),
(1, 'Mardi', '11:00:00', 0, NULL),
(1, 'Mardi', '12:00:00', 0, NULL),
(1, 'Mardi', '13:00:00', 0, NULL),
(1, 'Mardi', '14:00:00', 0, NULL),
(1, 'Mardi', '15:00:00', 0, NULL),
(1, 'Mardi', '16:00:00', 0, NULL),
(1, 'Mardi', '17:00:00', 0, NULL),
(1, 'Mercredi', '10:00:00', 0, NULL),
(1, 'Mercredi', '11:00:00', 0, NULL),
(1, 'Mercredi', '12:00:00', 0, NULL),
(1, 'Mercredi', '13:00:00', 0, NULL),
(1, 'Mercredi', '14:00:00', 0, NULL),
(1, 'Mercredi', '15:00:00', 0, NULL),
(1, 'Mercredi', '16:00:00', 0, NULL),
(1, 'Mercredi', '17:00:00', 0, NULL),
(1, 'Jeudi', '10:00:00', 0, NULL),
(1, 'Jeudi', '11:00:00', 0, NULL),
(1, 'Jeudi', '12:00:00', 0, NULL),
(1, 'Jeudi', '13:00:00', 0, NULL),
(1, 'Jeudi', '14:00:00', 0, NULL),
(1, 'Jeudi', '15:00:00', 0, NULL),
(1, 'Jeudi', '16:00:00', 0, NULL),
(1, 'Jeudi', '17:00:00', 0, NULL),
(1, 'Vendredi', '10:00:00', 0, NULL),
(1, 'Vendredi', '11:00:00', 0, NULL),
(1, 'Vendredi', '12:00:00', 0, NULL),
(1, 'Vendredi', '13:00:00', 0, NULL),
(1, 'Vendredi', '14:00:00', 0, NULL),
(1, 'Vendredi', '15:00:00', 0, NULL),
(1, 'Vendredi', '16:00:00', 0, NULL),
(1, 'Vendredi', '17:00:00', 0, NULL),
(2, 'Lundi', '10:00:00', 0, NULL),
(2, 'Lundi', '11:00:00', 0, NULL),
(2, 'Lundi', '12:00:00', 0, NULL),
(2, 'Lundi', '13:00:00', 0, NULL),
(2, 'Lundi', '14:00:00', 1, NULL),
(2, 'Lundi', '15:00:00', 0, NULL),
(2, 'Lundi', '16:00:00', 1, NULL),
(2, 'Lundi', '17:00:00', 1, NULL),
(2, 'Mardi', '10:00:00', 0, NULL),
(2, 'Mardi', '11:00:00', 0, NULL),
(2, 'Mardi', '12:00:00', 0, NULL),
(2, 'Mardi', '13:00:00', 0, NULL),
(2, 'Mardi', '14:00:00', 1, NULL),
(2, 'Mardi', '15:00:00', 0, NULL),
(2, 'Mardi', '16:00:00', 1, NULL),
(2, 'Mardi', '17:00:00', 1, NULL),
(2, 'Mercredi', '10:00:00', 0, NULL),
(2, 'Mercredi', '11:00:00', 1, NULL),
(2, 'Mercredi', '12:00:00', 0, NULL),
(2, 'Mercredi', '13:00:00', 1, NULL),
(2, 'Mercredi', '14:00:00', 0, NULL),
(2, 'Mercredi', '15:00:00', 1, NULL),
(2, 'Mercredi', '16:00:00', 1, NULL),
(2, 'Mercredi', '17:00:00', 0, NULL),
(2, 'Jeudi', '10:00:00', 1, NULL),
(2, 'Jeudi', '11:00:00', 1, NULL),
(2, 'Jeudi', '12:00:00', 1, NULL),
(2, 'Jeudi', '13:00:00', 1, NULL),
(2, 'Jeudi', '14:00:00', 1, NULL),
(2, 'Jeudi', '15:00:00', 0, NULL),
(2, 'Jeudi', '16:00:00', 1, NULL),
(2, 'Jeudi', '17:00:00', 1, NULL),
(2, 'Vendredi', '10:00:00', 0, NULL),
(2, 'Vendredi', '11:00:00', 1, NULL),
(2, 'Vendredi', '12:00:00', 1, NULL),
(2, 'Vendredi', '13:00:00', 1, NULL),
(2, 'Vendredi', '14:00:00', 1, NULL),
(2, 'Vendredi', '15:00:00', 1, NULL),
(2, 'Vendredi', '16:00:00', 1, NULL),
(2, 'Vendredi', '17:00:00', 1, NULL),
(3, 'Lundi', '10:00:00', 0, NULL),
(3, 'Lundi', '11:00:00', 0, NULL),
(3, 'Lundi', '12:00:00', 0, NULL),
(3, 'Lundi', '13:00:00', 0, NULL),
(3, 'Lundi', '14:00:00', 1, NULL),
(3, 'Lundi', '15:00:00', 1, NULL),
(3, 'Lundi', '16:00:00', 1, NULL),
(3, 'Lundi', '17:00:00', 1, NULL),
(3, 'Mardi', '10:00:00', 0, NULL),
(3, 'Mardi', '11:00:00', 0, NULL),
(3, 'Mardi', '12:00:00', 0, NULL),
(3, 'Mardi', '13:00:00', 0, NULL),
(3, 'Mardi', '14:00:00', 1, NULL),
(3, 'Mardi', '15:00:00', 1, NULL),
(3, 'Mardi', '16:00:00', 1, NULL),
(3, 'Mardi', '17:00:00', 1, NULL),
(3, 'Mercredi', '10:00:00', 0, NULL),
(3, 'Mercredi', '11:00:00', 0, NULL),
(3, 'Mercredi', '12:00:00', 0, NULL),
(3, 'Mercredi', '13:00:00', 0, NULL),
(3, 'Mercredi', '14:00:00', 1, NULL),
(3, 'Mercredi', '15:00:00', 1, NULL),
(3, 'Mercredi', '16:00:00', 1, NULL),
(3, 'Mercredi', '17:00:00', 1, NULL),
(3, 'Jeudi', '10:00:00', 0, NULL),
(3, 'Jeudi', '11:00:00', 0, NULL),
(3, 'Jeudi', '12:00:00', 0, NULL),
(3, 'Jeudi', '13:00:00', 0, NULL),
(3, 'Jeudi', '14:00:00', 1, NULL),
(3, 'Jeudi', '15:00:00', 1, NULL),
(3, 'Jeudi', '16:00:00', 1, NULL),
(3, 'Jeudi', '17:00:00', 1, NULL),
(3, 'Vendredi', '10:00:00', 0, NULL),
(3, 'Vendredi', '11:00:00', 0, NULL),
(3, 'Vendredi', '12:00:00', 0, NULL),
(3, 'Vendredi', '13:00:00', 0, NULL),
(3, 'Vendredi', '14:00:00', 1, NULL),
(3, 'Vendredi', '15:00:00', 1, NULL),
(3, 'Vendredi', '16:00:00', 1, NULL),
(3, 'Vendredi', '17:00:00', 1, NULL),
(4, 'Lundi', '10:00:00', 0, NULL),
(4, 'Lundi', '11:00:00', 0, NULL),
(4, 'Lundi', '12:00:00', 0, NULL),
(4, 'Lundi', '13:00:00', 0, NULL),
(4, 'Lundi', '14:00:00', 0, NULL),
(4, 'Lundi', '15:00:00', 0, NULL),
(4, 'Lundi', '16:00:00', 0, NULL),
(4, 'Lundi', '17:00:00', 0, NULL),
(4, 'Mardi', '10:00:00', 0, NULL),
(4, 'Mardi', '11:00:00', 0, NULL),
(4, 'Mardi', '12:00:00', 0, NULL),
(4, 'Mardi', '13:00:00', 0, NULL),
(4, 'Mardi', '14:00:00', 0, NULL),
(4, 'Mardi', '15:00:00', 0, NULL),
(4, 'Mardi', '16:00:00', 0, NULL),
(4, 'Mardi', '17:00:00', 0, NULL),
(4, 'Mercredi', '10:00:00', 0, NULL),
(4, 'Mercredi', '11:00:00', 0, NULL),
(4, 'Mercredi', '12:00:00', 0, NULL),
(4, 'Mercredi', '13:00:00', 0, NULL),
(4, 'Mercredi', '14:00:00', 0, NULL),
(4, 'Mercredi', '15:00:00', 0, NULL),
(4, 'Mercredi', '16:00:00', 0, NULL),
(4, 'Mercredi', '17:00:00', 0, NULL),
(4, 'Jeudi', '10:00:00', 0, NULL),
(4, 'Jeudi', '11:00:00', 0, NULL),
(4, 'Jeudi', '12:00:00', 0, NULL),
(4, 'Jeudi', '13:00:00', 0, NULL),
(4, 'Jeudi', '14:00:00', 0, NULL),
(4, 'Jeudi', '15:00:00', 0, NULL),
(4, 'Jeudi', '16:00:00', 0, NULL),
(4, 'Jeudi', '17:00:00', 0, NULL),
(4, 'Vendredi', '10:00:00', 0, NULL),
(4, 'Vendredi', '11:00:00', 0, NULL),
(4, 'Vendredi', '12:00:00', 0, NULL),
(4, 'Vendredi', '13:00:00', 0, NULL),
(4, 'Vendredi', '14:00:00', 0, NULL),
(4, 'Vendredi', '15:00:00', 0, NULL),
(4, 'Vendredi', '16:00:00', 0, NULL),
(4, 'Vendredi', '17:00:00', 0, NULL),
(5, 'Lundi', '10:00:00', 0, NULL),
(5, 'Lundi', '11:00:00', 0, NULL),
(5, 'Lundi', '12:00:00', 0, NULL),
(5, 'Lundi', '13:00:00', 0, NULL),
(5, 'Lundi', '14:00:00', 0, NULL),
(5, 'Lundi', '15:00:00', 0, NULL),
(5, 'Lundi', '16:00:00', 0, NULL),
(5, 'Lundi', '17:00:00', 0, NULL),
(5, 'Mardi', '10:00:00', 0, NULL),
(5, 'Mardi', '11:00:00', 0, NULL),
(5, 'Mardi', '12:00:00', 0, NULL),
(5, 'Mardi', '13:00:00', 0, NULL),
(5, 'Mardi', '14:00:00', 0, NULL),
(5, 'Mardi', '15:00:00', 0, NULL),
(5, 'Mardi', '16:00:00', 0, NULL),
(5, 'Mardi', '17:00:00', 0, NULL),
(5, 'Mercredi', '10:00:00', 0, NULL),
(5, 'Mercredi', '11:00:00', 0, NULL),
(5, 'Mercredi', '12:00:00', 0, NULL),
(5, 'Mercredi', '13:00:00', 0, NULL),
(5, 'Mercredi', '14:00:00', 0, NULL),
(5, 'Mercredi', '15:00:00', 0, NULL),
(5, 'Mercredi', '16:00:00', 0, NULL),
(5, 'Mercredi', '17:00:00', 0, NULL),
(5, 'Jeudi', '10:00:00', 0, NULL),
(5, 'Jeudi', '11:00:00', 0, NULL),
(5, 'Jeudi', '12:00:00', 0, NULL),
(5, 'Jeudi', '13:00:00', 0, NULL),
(5, 'Jeudi', '14:00:00', 0, NULL),
(5, 'Jeudi', '15:00:00', 0, NULL),
(5, 'Jeudi', '16:00:00', 0, NULL),
(5, 'Jeudi', '17:00:00', 0, NULL),
(5, 'Vendredi', '10:00:00', 0, NULL),
(5, 'Vendredi', '11:00:00', 0, NULL),
(5, 'Vendredi', '12:00:00', 0, NULL),
(5, 'Vendredi', '13:00:00', 0, NULL),
(5, 'Vendredi', '14:00:00', 0, NULL),
(5, 'Vendredi', '15:00:00', 0, NULL),
(5, 'Vendredi', '16:00:00', 0, NULL),
(5, 'Vendredi', '17:00:00', 0, NULL),
(6, 'Lundi', '10:00:00', 1, NULL),
(6, 'Lundi', '11:00:00', 1, NULL),
(6, 'Lundi', '12:00:00', 1, NULL),
(6, 'Lundi', '13:00:00', 1, NULL),
(6, 'Lundi', '14:00:00', 0, NULL),
(6, 'Lundi', '15:00:00', 0, NULL),
(6, 'Lundi', '16:00:00', 0, NULL),
(6, 'Lundi', '17:00:00', 0, NULL),
(6, 'Mardi', '10:00:00', 1, NULL),
(6, 'Mardi', '11:00:00', 1, NULL),
(6, 'Mardi', '12:00:00', 1, NULL),
(6, 'Mardi', '13:00:00', 1, NULL),
(6, 'Mardi', '14:00:00', 0, NULL),
(6, 'Mardi', '15:00:00', 0, NULL),
(6, 'Mardi', '16:00:00', 0, NULL),
(6, 'Mardi', '17:00:00', 0, NULL),
(6, 'Mercredi', '10:00:00', 1, NULL),
(6, 'Mercredi', '11:00:00', 1, NULL),
(6, 'Mercredi', '12:00:00', 0, NULL),
(6, 'Mercredi', '13:00:00', 1, NULL),
(6, 'Mercredi', '14:00:00', 0, NULL),
(6, 'Mercredi', '15:00:00', 0, NULL),
(6, 'Mercredi', '16:00:00', 0, NULL),
(6, 'Mercredi', '17:00:00', 0, NULL),
(6, 'Jeudi', '10:00:00', 1, NULL),
(6, 'Jeudi', '11:00:00', 1, NULL),
(6, 'Jeudi', '12:00:00', 1, NULL),
(6, 'Jeudi', '13:00:00', 1, NULL),
(6, 'Jeudi', '14:00:00', 0, NULL),
(6, 'Jeudi', '15:00:00', 0, NULL),
(6, 'Jeudi', '16:00:00', 0, NULL),
(6, 'Jeudi', '17:00:00', 0, NULL),
(6, 'Vendredi', '10:00:00', 1, NULL),
(6, 'Vendredi', '11:00:00', 1, NULL),
(6, 'Vendredi', '12:00:00', 1, NULL),
(6, 'Vendredi', '13:00:00', 1, NULL),
(6, 'Vendredi', '14:00:00', 0, NULL),
(6, 'Vendredi', '15:00:00', 0, NULL),
(6, 'Vendredi', '16:00:00', 0, NULL),
(6, 'Vendredi', '17:00:00', 0, NULL),
(7, 'Lundi', '10:00:00', 0, NULL),
(7, 'Lundi', '11:00:00', 0, NULL),
(7, 'Lundi', '12:00:00', 0, NULL),
(7, 'Lundi', '13:00:00', 0, NULL),
(7, 'Lundi', '14:00:00', 0, NULL),
(7, 'Lundi', '15:00:00', 0, NULL),
(7, 'Lundi', '16:00:00', 1, NULL),
(7, 'Lundi', '17:00:00', 1, NULL),
(7, 'Mardi', '10:00:00', 0, NULL),
(7, 'Mardi', '11:00:00', 0, NULL),
(7, 'Mardi', '12:00:00', 0, NULL),
(7, 'Mardi', '13:00:00', 0, NULL),
(7, 'Mardi', '14:00:00', 1, NULL),
(7, 'Mardi', '15:00:00', 1, NULL),
(7, 'Mardi', '16:00:00', 1, NULL),
(7, 'Mardi', '17:00:00', 1, NULL),
(7, 'Mercredi', '10:00:00', 0, NULL),
(7, 'Mercredi', '11:00:00', 0, NULL),
(7, 'Mercredi', '12:00:00', 0, NULL),
(7, 'Mercredi', '13:00:00', 0, NULL),
(7, 'Mercredi', '14:00:00', 1, NULL),
(7, 'Mercredi', '15:00:00', 1, NULL),
(7, 'Mercredi', '16:00:00', 1, NULL),
(7, 'Mercredi', '17:00:00', 1, NULL),
(7, 'Jeudi', '10:00:00', 0, NULL),
(7, 'Jeudi', '11:00:00', 0, NULL),
(7, 'Jeudi', '12:00:00', 0, NULL),
(7, 'Jeudi', '13:00:00', 0, NULL),
(7, 'Jeudi', '14:00:00', 1, NULL),
(7, 'Jeudi', '15:00:00', 1, NULL),
(7, 'Jeudi', '16:00:00', 1, NULL),
(7, 'Jeudi', '17:00:00', 1, NULL),
(7, 'Vendredi', '10:00:00', 0, NULL),
(7, 'Vendredi', '11:00:00', 0, NULL),
(7, 'Vendredi', '12:00:00', 0, NULL),
(7, 'Vendredi', '13:00:00', 0, NULL),
(7, 'Vendredi', '14:00:00', 1, NULL),
(7, 'Vendredi', '15:00:00', 0, NULL),
(7, 'Vendredi', '16:00:00', 1, NULL),
(7, 'Vendredi', '17:00:00', 1, NULL),
(8, 'Lundi', '10:00:00', 1, NULL),
(8, 'Lundi', '11:00:00', 0, NULL),
(8, 'Lundi', '12:00:00', 1, NULL),
(8, 'Lundi', '13:00:00', 1, NULL),
(8, 'Lundi', '14:00:00', 0, NULL),
(8, 'Lundi', '15:00:00', 0, NULL),
(8, 'Lundi', '16:00:00', 0, NULL),
(8, 'Lundi', '17:00:00', 0, NULL),
(8, 'Mardi', '10:00:00', 1, NULL),
(8, 'Mardi', '11:00:00', 1, NULL),
(8, 'Mardi', '12:00:00', 1, NULL),
(8, 'Mardi', '13:00:00', 1, NULL),
(8, 'Mardi', '14:00:00', 0, NULL),
(8, 'Mardi', '15:00:00', 0, NULL),
(8, 'Mardi', '16:00:00', 0, NULL),
(8, 'Mardi', '17:00:00', 0, NULL),
(8, 'Mercredi', '10:00:00', 1, NULL),
(8, 'Mercredi', '11:00:00', 1, NULL),
(8, 'Mercredi', '12:00:00', 1, NULL),
(8, 'Mercredi', '13:00:00', 1, NULL),
(8, 'Mercredi', '14:00:00', 0, NULL),
(8, 'Mercredi', '15:00:00', 0, NULL),
(8, 'Mercredi', '16:00:00', 0, NULL),
(8, 'Mercredi', '17:00:00', 0, NULL),
(8, 'Jeudi', '10:00:00', 1, NULL),
(8, 'Jeudi', '11:00:00', 1, NULL),
(8, 'Jeudi', '12:00:00', 1, NULL),
(8, 'Jeudi', '13:00:00', 1, NULL),
(8, 'Jeudi', '14:00:00', 0, NULL),
(8, 'Jeudi', '15:00:00', 0, NULL),
(8, 'Jeudi', '16:00:00', 0, NULL),
(8, 'Jeudi', '17:00:00', 0, NULL),
(8, 'Vendredi', '10:00:00', 1, NULL),
(8, 'Vendredi', '11:00:00', 1, NULL),
(8, 'Vendredi', '12:00:00', 1, NULL),
(8, 'Vendredi', '13:00:00', 1, NULL),
(8, 'Vendredi', '14:00:00', 0, NULL),
(8, 'Vendredi', '15:00:00', 0, NULL),
(8, 'Vendredi', '16:00:00', 0, NULL),
(8, 'Vendredi', '17:00:00', 0, NULL),
(9, 'Lundi', '10:00:00', 0, NULL),
(9, 'Lundi', '11:00:00', 0, NULL),
(9, 'Lundi', '12:00:00', 0, NULL),
(9, 'Lundi', '13:00:00', 0, NULL),
(9, 'Lundi', '14:00:00', 1, NULL),
(9, 'Lundi', '15:00:00', 0, NULL),
(9, 'Lundi', '16:00:00', 1, NULL),
(9, 'Lundi', '17:00:00', 1, NULL),
(9, 'Mardi', '10:00:00', 0, NULL),
(9, 'Mardi', '11:00:00', 0, NULL),
(9, 'Mardi', '12:00:00', 0, NULL),
(9, 'Mardi', '13:00:00', 0, NULL),
(9, 'Mardi', '14:00:00', 1, NULL),
(9, 'Mardi', '15:00:00', 1, NULL),
(9, 'Mardi', '16:00:00', 1, NULL),
(9, 'Mardi', '17:00:00', 1, NULL),
(9, 'Mercredi', '10:00:00', 0, NULL),
(9, 'Mercredi', '11:00:00', 0, NULL),
(9, 'Mercredi', '12:00:00', 0, NULL),
(9, 'Mercredi', '13:00:00', 0, NULL),
(9, 'Mercredi', '14:00:00', 1, NULL),
(9, 'Mercredi', '15:00:00', 0, NULL),
(9, 'Mercredi', '16:00:00', 1, NULL),
(9, 'Mercredi', '17:00:00', 1, NULL),
(9, 'Jeudi', '10:00:00', 0, NULL),
(9, 'Jeudi', '11:00:00', 0, NULL),
(9, 'Jeudi', '12:00:00', 0, NULL),
(9, 'Jeudi', '13:00:00', 0, NULL),
(9, 'Jeudi', '14:00:00', 1, NULL),
(9, 'Jeudi', '15:00:00', 1, NULL),
(9, 'Jeudi', '16:00:00', 1, NULL),
(9, 'Jeudi', '17:00:00', 1, NULL),
(9, 'Vendredi', '10:00:00', 0, NULL),
(9, 'Vendredi', '11:00:00', 0, NULL),
(9, 'Vendredi', '12:00:00', 0, NULL),
(9, 'Vendredi', '13:00:00', 0, NULL),
(9, 'Vendredi', '14:00:00', 1, NULL),
(9, 'Vendredi', '15:00:00', 1, NULL),
(9, 'Vendredi', '16:00:00', 1, NULL),
(9, 'Vendredi', '17:00:00', 1, NULL),
(10, 'Lundi', '10:00:00', 1, NULL),
(10, 'Lundi', '11:00:00', 1, NULL),
(10, 'Lundi', '12:00:00', 1, NULL),
(10, 'Lundi', '13:00:00', 1, NULL),
(10, 'Lundi', '14:00:00', 0, NULL),
(10, 'Lundi', '15:00:00', 0, NULL),
(10, 'Lundi', '16:00:00', 1, NULL),
(10, 'Lundi', '17:00:00', 1, NULL),
(10, 'Mardi', '10:00:00', 1, NULL),
(10, 'Mardi', '11:00:00', 1, NULL),
(10, 'Mardi', '12:00:00', 1, NULL),
(10, 'Mardi', '13:00:00', 1, NULL),
(10, 'Mardi', '14:00:00', 1, NULL),
(10, 'Mardi', '15:00:00', 1, NULL),
(10, 'Mardi', '16:00:00', 1, NULL),
(10, 'Mardi', '17:00:00', 1, NULL),
(10, 'Mercredi', '10:00:00', 1, NULL),
(10, 'Mercredi', '11:00:00', 1, NULL),
(10, 'Mercredi', '12:00:00', 1, NULL),
(10, 'Mercredi', '13:00:00', 1, NULL),
(10, 'Mercredi', '14:00:00', 1, NULL),
(10, 'Mercredi', '15:00:00', 1, NULL),
(10, 'Mercredi', '16:00:00', 1, NULL),
(10, 'Mercredi', '17:00:00', 1, NULL),
(10, 'Jeudi', '10:00:00', 1, NULL),
(10, 'Jeudi', '11:00:00', 1, NULL),
(10, 'Jeudi', '12:00:00', 1, NULL),
(10, 'Jeudi', '13:00:00', 1, NULL),
(10, 'Jeudi', '14:00:00', 1, NULL),
(10, 'Jeudi', '15:00:00', 1, NULL),
(10, 'Jeudi', '16:00:00', 1, NULL),
(10, 'Jeudi', '17:00:00', 1, NULL),
(10, 'Vendredi', '10:00:00', 1, NULL),
(10, 'Vendredi', '11:00:00', 1, NULL),
(10, 'Vendredi', '12:00:00', 0, NULL),
(10, 'Vendredi', '13:00:00', 1, NULL),
(10, 'Vendredi', '14:00:00', 1, NULL),
(10, 'Vendredi', '15:00:00', 1, NULL),
(10, 'Vendredi', '16:00:00', 1, NULL),
(10, 'Vendredi', '17:00:00', 1, NULL),
(11, 'Lundi', '10:00:00', 1, NULL),
(11, 'Lundi', '11:00:00', 1, NULL),
(11, 'Lundi', '12:00:00', 1, NULL),
(11, 'Lundi', '13:00:00', 1, NULL),
(11, 'Lundi', '14:00:00', 0, NULL),
(11, 'Lundi', '15:00:00', 0, NULL),
(11, 'Lundi', '16:00:00', 0, NULL),
(11, 'Lundi', '17:00:00', 0, NULL),
(11, 'Mardi', '10:00:00', 1, NULL),
(11, 'Mardi', '11:00:00', 0, NULL),
(11, 'Mardi', '12:00:00', 1, NULL),
(11, 'Mardi', '13:00:00', 0, NULL),
(11, 'Mardi', '14:00:00', 0, NULL),
(11, 'Mardi', '15:00:00', 0, NULL),
(11, 'Mardi', '16:00:00', 0, NULL),
(11, 'Mardi', '17:00:00', 0, NULL),
(11, 'Mercredi', '10:00:00', 1, NULL),
(11, 'Mercredi', '11:00:00', 1, NULL),
(11, 'Mercredi', '12:00:00', 1, NULL),
(11, 'Mercredi', '13:00:00', 1, NULL),
(11, 'Mercredi', '14:00:00', 0, NULL),
(11, 'Mercredi', '15:00:00', 0, NULL),
(11, 'Mercredi', '16:00:00', 0, NULL),
(11, 'Mercredi', '17:00:00', 0, NULL),
(11, 'Jeudi', '10:00:00', 1, NULL),
(11, 'Jeudi', '11:00:00', 1, NULL),
(11, 'Jeudi', '12:00:00', 1, NULL),
(11, 'Jeudi', '13:00:00', 1, NULL),
(11, 'Jeudi', '14:00:00', 0, NULL),
(11, 'Jeudi', '15:00:00', 0, NULL),
(11, 'Jeudi', '16:00:00', 0, NULL),
(11, 'Jeudi', '17:00:00', 0, NULL),
(11, 'Vendredi', '10:00:00', 1, NULL),
(11, 'Vendredi', '11:00:00', 1, NULL),
(11, 'Vendredi', '12:00:00', 1, NULL),
(11, 'Vendredi', '13:00:00', 1, NULL),
(11, 'Vendredi', '14:00:00', 0, NULL),
(11, 'Vendredi', '15:00:00', 0, NULL),
(11, 'Vendredi', '16:00:00', 0, NULL),
(11, 'Vendredi', '17:00:00', 0, NULL),
(12, 'Lundi', '10:00:00', 0, NULL),
(12, 'Lundi', '11:00:00', 0, NULL),
(12, 'Lundi', '12:00:00', 0, NULL),
(12, 'Lundi', '13:00:00', 0, NULL),
(12, 'Lundi', '14:00:00', 1, NULL),
(12, 'Lundi', '15:00:00', 1, NULL),
(12, 'Lundi', '16:00:00', 1, NULL),
(12, 'Lundi', '17:00:00', 1, NULL),
(12, 'Mardi', '10:00:00', 0, NULL),
(12, 'Mardi', '11:00:00', 0, NULL),
(12, 'Mardi', '12:00:00', 0, NULL),
(12, 'Mardi', '13:00:00', 0, NULL),
(12, 'Mardi', '14:00:00', 1, NULL),
(12, 'Mardi', '15:00:00', 1, NULL),
(12, 'Mardi', '16:00:00', 1, NULL),
(12, 'Mardi', '17:00:00', 1, NULL),
(12, 'Mercredi', '10:00:00', 0, NULL),
(12, 'Mercredi', '11:00:00', 0, NULL),
(12, 'Mercredi', '12:00:00', 0, NULL),
(12, 'Mercredi', '13:00:00', 0, NULL),
(12, 'Mercredi', '14:00:00', 1, NULL),
(12, 'Mercredi', '15:00:00', 1, NULL),
(12, 'Mercredi', '16:00:00', 1, NULL),
(12, 'Mercredi', '17:00:00', 1, NULL),
(12, 'Jeudi', '10:00:00', 0, NULL),
(12, 'Jeudi', '11:00:00', 0, NULL),
(12, 'Jeudi', '12:00:00', 0, NULL),
(12, 'Jeudi', '13:00:00', 0, NULL),
(12, 'Jeudi', '14:00:00', 1, NULL),
(12, 'Jeudi', '15:00:00', 1, NULL),
(12, 'Jeudi', '16:00:00', 1, NULL),
(12, 'Jeudi', '17:00:00', 1, NULL),
(12, 'Vendredi', '10:00:00', 0, NULL),
(12, 'Vendredi', '11:00:00', 0, NULL),
(12, 'Vendredi', '12:00:00', 0, NULL),
(12, 'Vendredi', '13:00:00', 0, NULL),
(12, 'Vendredi', '14:00:00', 1, NULL),
(12, 'Vendredi', '15:00:00', 1, NULL),
(12, 'Vendredi', '16:00:00', 1, NULL),
(12, 'Vendredi', '17:00:00', 1, NULL),
(13, 'Lundi', '10:00:00', 1, NULL),
(13, 'Lundi', '11:00:00', 1, NULL),
(13, 'Lundi', '12:00:00', 1, NULL),
(13, 'Lundi', '13:00:00', 1, NULL),
(13, 'Lundi', '14:00:00', 0, NULL),
(13, 'Lundi', '15:00:00', 0, NULL),
(13, 'Lundi', '16:00:00', 0, NULL),
(13, 'Lundi', '17:00:00', 0, NULL),
(13, 'Mardi', '10:00:00', 1, NULL),
(13, 'Mardi', '11:00:00', 1, NULL),
(13, 'Mardi', '12:00:00', 1, NULL),
(13, 'Mardi', '13:00:00', 1, NULL),
(13, 'Mardi', '14:00:00', 0, NULL),
(13, 'Mardi', '15:00:00', 0, NULL),
(13, 'Mardi', '16:00:00', 0, NULL),
(13, 'Mardi', '17:00:00', 0, NULL),
(13, 'Mercredi', '10:00:00', 1, NULL),
(13, 'Mercredi', '11:00:00', 1, NULL),
(13, 'Mercredi', '12:00:00', 1, NULL),
(13, 'Mercredi', '13:00:00', 1, NULL),
(13, 'Mercredi', '14:00:00', 0, NULL),
(13, 'Mercredi', '15:00:00', 0, NULL),
(13, 'Mercredi', '16:00:00', 0, NULL),
(13, 'Mercredi', '17:00:00', 0, NULL),
(13, 'Jeudi', '10:00:00', 1, NULL),
(13, 'Jeudi', '11:00:00', 0, NULL),
(13, 'Jeudi', '12:00:00', 1, NULL),
(13, 'Jeudi', '13:00:00', 1, NULL),
(13, 'Jeudi', '14:00:00', 0, NULL),
(13, 'Jeudi', '15:00:00', 0, NULL),
(13, 'Jeudi', '16:00:00', 0, NULL),
(13, 'Jeudi', '17:00:00', 0, NULL),
(13, 'Vendredi', '10:00:00', 1, NULL),
(13, 'Vendredi', '11:00:00', 1, NULL),
(13, 'Vendredi', '12:00:00', 1, NULL),
(13, 'Vendredi', '13:00:00', 1, NULL),
(13, 'Vendredi', '14:00:00', 0, NULL),
(13, 'Vendredi', '15:00:00', 0, NULL),
(13, 'Vendredi', '16:00:00', 0, NULL),
(13, 'Vendredi', '17:00:00', 0, NULL),
(14, 'Lundi', '10:00:00', 0, NULL),
(14, 'Lundi', '11:00:00', 0, NULL),
(14, 'Lundi', '12:00:00', 0, NULL),
(14, 'Lundi', '13:00:00', 0, NULL),
(14, 'Lundi', '14:00:00', 1, NULL),
(14, 'Lundi', '15:00:00', 1, NULL),
(14, 'Lundi', '16:00:00', 1, NULL),
(14, 'Lundi', '17:00:00', 1, NULL),
(14, 'Mardi', '10:00:00', 0, NULL),
(14, 'Mardi', '11:00:00', 0, NULL),
(14, 'Mardi', '12:00:00', 0, NULL),
(14, 'Mardi', '13:00:00', 0, NULL),
(14, 'Mardi', '14:00:00', 1, NULL),
(14, 'Mardi', '15:00:00', 1, NULL),
(14, 'Mardi', '16:00:00', 1, NULL),
(14, 'Mardi', '17:00:00', 1, NULL),
(14, 'Mercredi', '10:00:00', 0, NULL),
(14, 'Mercredi', '11:00:00', 0, NULL),
(14, 'Mercredi', '12:00:00', 0, NULL),
(14, 'Mercredi', '13:00:00', 0, NULL),
(14, 'Mercredi', '14:00:00', 0, NULL),
(14, 'Mercredi', '15:00:00', 0, NULL),
(14, 'Mercredi', '16:00:00', 0, NULL),
(14, 'Mercredi', '17:00:00', 0, NULL),
(14, 'Jeudi', '10:00:00', 0, NULL),
(14, 'Jeudi', '11:00:00', 0, NULL),
(14, 'Jeudi', '12:00:00', 0, NULL),
(14, 'Jeudi', '13:00:00', 0, NULL),
(14, 'Jeudi', '14:00:00', 1, NULL),
(14, 'Jeudi', '15:00:00', 1, NULL),
(14, 'Jeudi', '16:00:00', 1, NULL),
(14, 'Jeudi', '17:00:00', 1, NULL),
(14, 'Vendredi', '10:00:00', 0, NULL),
(14, 'Vendredi', '11:00:00', 0, NULL),
(14, 'Vendredi', '12:00:00', 0, NULL),
(14, 'Vendredi', '13:00:00', 0, NULL),
(14, 'Vendredi', '14:00:00', 1, NULL),
(14, 'Vendredi', '15:00:00', 1, NULL),
(14, 'Vendredi', '16:00:00', 1, NULL),
(14, 'Vendredi', '17:00:00', 1, NULL),
(15, 'Lundi', '10:00:00', 1, NULL),
(15, 'Lundi', '11:00:00', 1, NULL),
(15, 'Lundi', '12:00:00', 1, NULL),
(15, 'Lundi', '13:00:00', 1, NULL),
(15, 'Lundi', '14:00:00', 0, NULL),
(15, 'Lundi', '15:00:00', 0, NULL),
(15, 'Lundi', '16:00:00', 0, NULL),
(15, 'Lundi', '17:00:00', 0, NULL),
(15, 'Mardi', '10:00:00', 1, NULL),
(15, 'Mardi', '11:00:00', 1, NULL),
(15, 'Mardi', '12:00:00', 1, NULL),
(15, 'Mardi', '13:00:00', 1, NULL),
(15, 'Mardi', '14:00:00', 0, NULL),
(15, 'Mardi', '15:00:00', 0, NULL),
(15, 'Mardi', '16:00:00', 0, NULL),
(15, 'Mardi', '17:00:00', 0, NULL),
(15, 'Mercredi', '10:00:00', 1, NULL),
(15, 'Mercredi', '11:00:00', 1, NULL),
(15, 'Mercredi', '12:00:00', 1, NULL),
(15, 'Mercredi', '13:00:00', 1, NULL),
(15, 'Mercredi', '14:00:00', 0, NULL),
(15, 'Mercredi', '15:00:00', 0, NULL),
(15, 'Mercredi', '16:00:00', 0, NULL),
(15, 'Mercredi', '17:00:00', 0, NULL),
(15, 'Jeudi', '10:00:00', 1, NULL),
(15, 'Jeudi', '11:00:00', 1, NULL),
(15, 'Jeudi', '12:00:00', 1, NULL),
(15, 'Jeudi', '13:00:00', 1, NULL),
(15, 'Jeudi', '14:00:00', 0, NULL),
(15, 'Jeudi', '15:00:00', 0, NULL),
(15, 'Jeudi', '16:00:00', 0, NULL),
(15, 'Jeudi', '17:00:00', 0, NULL),
(15, 'Vendredi', '10:00:00', 1, NULL),
(15, 'Vendredi', '11:00:00', 1, NULL),
(15, 'Vendredi', '12:00:00', 1, NULL),
(15, 'Vendredi', '13:00:00', 1, NULL),
(15, 'Vendredi', '14:00:00', 0, NULL),
(15, 'Vendredi', '15:00:00', 0, NULL),
(15, 'Vendredi', '16:00:00', 0, NULL),
(15, 'Vendredi', '17:00:00', 0, NULL),
(16, 'Lundi', '10:00:00', 0, NULL),
(16, 'Lundi', '11:00:00', 0, NULL),
(16, 'Lundi', '12:00:00', 0, NULL),
(16, 'Lundi', '13:00:00', 0, NULL),
(16, 'Lundi', '14:00:00', 1, NULL),
(16, 'Lundi', '15:00:00', 1, NULL),
(16, 'Lundi', '16:00:00', 1, NULL),
(16, 'Lundi', '17:00:00', 1, NULL),
(16, 'Mardi', '10:00:00', 0, NULL),
(16, 'Mardi', '11:00:00', 0, NULL),
(16, 'Mardi', '12:00:00', 0, NULL),
(16, 'Mardi', '13:00:00', 0, NULL),
(16, 'Mardi', '14:00:00', 1, NULL),
(16, 'Mardi', '15:00:00', 1, NULL),
(16, 'Mardi', '16:00:00', 1, NULL),
(16, 'Mardi', '17:00:00', 1, NULL),
(16, 'Mercredi', '10:00:00', 0, NULL),
(16, 'Mercredi', '11:00:00', 0, NULL),
(16, 'Mercredi', '12:00:00', 0, NULL),
(16, 'Mercredi', '13:00:00', 0, NULL),
(16, 'Mercredi', '14:00:00', 1, NULL),
(16, 'Mercredi', '15:00:00', 1, NULL),
(16, 'Mercredi', '16:00:00', 1, NULL),
(16, 'Mercredi', '17:00:00', 1, NULL),
(16, 'Jeudi', '10:00:00', 0, NULL),
(16, 'Jeudi', '11:00:00', 0, NULL),
(16, 'Jeudi', '12:00:00', 0, NULL),
(16, 'Jeudi', '13:00:00', 0, NULL),
(16, 'Jeudi', '14:00:00', 1, NULL),
(16, 'Jeudi', '15:00:00', 1, NULL),
(16, 'Jeudi', '16:00:00', 1, NULL),
(16, 'Jeudi', '17:00:00', 1, NULL),
(16, 'Vendredi', '10:00:00', 0, NULL),
(16, 'Vendredi', '11:00:00', 0, NULL),
(16, 'Vendredi', '12:00:00', 0, NULL),
(16, 'Vendredi', '13:00:00', 0, NULL),
(16, 'Vendredi', '14:00:00', 1, NULL),
(16, 'Vendredi', '15:00:00', 1, NULL),
(16, 'Vendredi', '16:00:00', 1, NULL),
(16, 'Vendredi', '17:00:00', 1, NULL),
(17, 'Lundi', '10:00:00', 1, NULL),
(17, 'Lundi', '11:00:00', 1, NULL),
(17, 'Lundi', '12:00:00', 1, NULL),
(17, 'Lundi', '13:00:00', 1, NULL),
(17, 'Lundi', '14:00:00', 0, NULL),
(17, 'Lundi', '15:00:00', 0, NULL),
(17, 'Lundi', '16:00:00', 0, NULL),
(17, 'Lundi', '17:00:00', 0, NULL),
(17, 'Mardi', '10:00:00', 1, NULL),
(17, 'Mardi', '11:00:00', 1, NULL),
(17, 'Mardi', '12:00:00', 1, NULL),
(17, 'Mardi', '13:00:00', 1, NULL),
(17, 'Mardi', '14:00:00', 0, NULL),
(17, 'Mardi', '15:00:00', 0, NULL),
(17, 'Mardi', '16:00:00', 0, NULL),
(17, 'Mardi', '17:00:00', 0, NULL),
(17, 'Mercredi', '10:00:00', 1, NULL),
(17, 'Mercredi', '11:00:00', 1, NULL),
(17, 'Mercredi', '12:00:00', 1, NULL),
(17, 'Mercredi', '13:00:00', 1, NULL),
(17, 'Mercredi', '14:00:00', 0, NULL),
(17, 'Mercredi', '15:00:00', 0, NULL),
(17, 'Mercredi', '16:00:00', 0, NULL),
(17, 'Mercredi', '17:00:00', 0, NULL),
(17, 'Jeudi', '10:00:00', 1, NULL),
(17, 'Jeudi', '11:00:00', 1, NULL),
(17, 'Jeudi', '12:00:00', 1, NULL),
(17, 'Jeudi', '13:00:00', 1, NULL),
(17, 'Jeudi', '14:00:00', 0, NULL),
(17, 'Jeudi', '15:00:00', 0, NULL),
(17, 'Jeudi', '16:00:00', 0, NULL),
(17, 'Jeudi', '17:00:00', 0, NULL),
(17, 'Vendredi', '10:00:00', 1, NULL),
(17, 'Vendredi', '11:00:00', 1, NULL),
(17, 'Vendredi', '12:00:00', 1, NULL),
(17, 'Vendredi', '13:00:00', 1, NULL),
(17, 'Vendredi', '14:00:00', 0, NULL),
(17, 'Vendredi', '15:00:00', 0, NULL),
(17, 'Vendredi', '16:00:00', 0, NULL),
(17, 'Vendredi', '17:00:00', 0, NULL),
(18, 'Lundi', '10:00:00', 0, NULL),
(18, 'Lundi', '11:00:00', 0, NULL),
(18, 'Lundi', '12:00:00', 0, NULL),
(18, 'Lundi', '13:00:00', 0, NULL),
(18, 'Lundi', '14:00:00', 1, NULL),
(18, 'Lundi', '15:00:00', 1, NULL),
(18, 'Lundi', '16:00:00', 1, NULL),
(18, 'Lundi', '17:00:00', 1, NULL),
(18, 'Mardi', '10:00:00', 0, NULL),
(18, 'Mardi', '11:00:00', 0, NULL),
(18, 'Mardi', '12:00:00', 0, NULL),
(18, 'Mardi', '13:00:00', 0, NULL),
(18, 'Mardi', '14:00:00', 1, NULL),
(18, 'Mardi', '15:00:00', 1, NULL),
(18, 'Mardi', '16:00:00', 1, NULL),
(18, 'Mardi', '17:00:00', 1, NULL),
(18, 'Mercredi', '10:00:00', 0, NULL),
(18, 'Mercredi', '11:00:00', 0, NULL),
(18, 'Mercredi', '12:00:00', 0, NULL),
(18, 'Mercredi', '13:00:00', 0, NULL),
(18, 'Mercredi', '14:00:00', 1, NULL),
(18, 'Mercredi', '15:00:00', 1, NULL),
(18, 'Mercredi', '16:00:00', 1, NULL),
(18, 'Mercredi', '17:00:00', 1, NULL),
(18, 'Jeudi', '10:00:00', 0, NULL),
(18, 'Jeudi', '11:00:00', 0, NULL),
(18, 'Jeudi', '12:00:00', 0, NULL),
(18, 'Jeudi', '13:00:00', 0, NULL),
(18, 'Jeudi', '14:00:00', 1, NULL),
(18, 'Jeudi', '15:00:00', 1, NULL),
(18, 'Jeudi', '16:00:00', 1, NULL),
(18, 'Jeudi', '17:00:00', 1, NULL),
(18, 'Vendredi', '10:00:00', 0, NULL),
(18, 'Vendredi', '11:00:00', 0, NULL),
(18, 'Vendredi', '12:00:00', 0, NULL),
(18, 'Vendredi', '13:00:00', 0, NULL),
(18, 'Vendredi', '14:00:00', 1, NULL),
(18, 'Vendredi', '15:00:00', 1, NULL),
(18, 'Vendredi', '16:00:00', 1, NULL),
(18, 'Vendredi', '17:00:00', 1, NULL),
(19, 'Lundi', '10:00:00', 1, NULL),
(19, 'Lundi', '11:00:00', 0, NULL),
(19, 'Lundi', '12:00:00', 1, NULL),
(19, 'Lundi', '13:00:00', 1, NULL),
(19, 'Lundi', '14:00:00', 0, NULL),
(19, 'Lundi', '15:00:00', 0, NULL),
(19, 'Lundi', '16:00:00', 0, NULL),
(19, 'Lundi', '17:00:00', 0, NULL),
(19, 'Mardi', '10:00:00', 1, NULL),
(19, 'Mardi', '11:00:00', 1, NULL),
(19, 'Mardi', '12:00:00', 1, NULL),
(19, 'Mardi', '13:00:00', 1, NULL),
(19, 'Mardi', '14:00:00', 0, NULL),
(19, 'Mardi', '15:00:00', 0, NULL),
(19, 'Mardi', '16:00:00', 0, NULL),
(19, 'Mardi', '17:00:00', 0, NULL),
(19, 'Mercredi', '10:00:00', 1, NULL),
(19, 'Mercredi', '11:00:00', 1, NULL),
(19, 'Mercredi', '12:00:00', 1, NULL),
(19, 'Mercredi', '13:00:00', 1, NULL),
(19, 'Mercredi', '14:00:00', 0, NULL),
(19, 'Mercredi', '15:00:00', 0, NULL),
(19, 'Mercredi', '16:00:00', 0, NULL),
(19, 'Mercredi', '17:00:00', 0, NULL),
(19, 'Jeudi', '10:00:00', 1, NULL),
(19, 'Jeudi', '11:00:00', 1, NULL),
(19, 'Jeudi', '12:00:00', 1, NULL),
(19, 'Jeudi', '13:00:00', 1, NULL),
(19, 'Jeudi', '14:00:00', 0, NULL),
(19, 'Jeudi', '15:00:00', 0, NULL),
(19, 'Jeudi', '16:00:00', 0, NULL),
(19, 'Jeudi', '17:00:00', 0, NULL),
(19, 'Vendredi', '10:00:00', 1, NULL),
(19, 'Vendredi', '11:00:00', 1, NULL),
(19, 'Vendredi', '12:00:00', 1, NULL),
(19, 'Vendredi', '13:00:00', 1, NULL),
(19, 'Vendredi', '14:00:00', 0, NULL),
(19, 'Vendredi', '15:00:00', 0, NULL),
(19, 'Vendredi', '16:00:00', 0, NULL),
(19, 'Vendredi', '17:00:00', 0, NULL),
(20, 'Lundi', '10:00:00', 0, NULL),
(20, 'Lundi', '11:00:00', 0, NULL),
(20, 'Lundi', '12:00:00', 0, NULL),
(20, 'Lundi', '13:00:00', 0, NULL),
(20, 'Lundi', '14:00:00', 1, NULL),
(20, 'Lundi', '15:00:00', 1, NULL),
(20, 'Lundi', '16:00:00', 1, NULL),
(20, 'Lundi', '17:00:00', 1, NULL),
(20, 'Mardi', '10:00:00', 0, NULL),
(20, 'Mardi', '11:00:00', 0, NULL),
(20, 'Mardi', '12:00:00', 0, NULL),
(20, 'Mardi', '13:00:00', 0, NULL),
(20, 'Mardi', '14:00:00', 1, NULL),
(20, 'Mardi', '15:00:00', 1, NULL),
(20, 'Mardi', '16:00:00', 1, NULL),
(20, 'Mardi', '17:00:00', 1, NULL),
(20, 'Mercredi', '10:00:00', 0, NULL),
(20, 'Mercredi', '11:00:00', 0, NULL),
(20, 'Mercredi', '12:00:00', 0, NULL),
(20, 'Mercredi', '13:00:00', 0, NULL),
(20, 'Mercredi', '14:00:00', 1, NULL),
(20, 'Mercredi', '15:00:00', 1, NULL),
(20, 'Mercredi', '16:00:00', 1, NULL),
(20, 'Mercredi', '17:00:00', 1, NULL),
(20, 'Jeudi', '10:00:00', 0, NULL),
(20, 'Jeudi', '11:00:00', 0, NULL),
(20, 'Jeudi', '12:00:00', 0, NULL),
(20, 'Jeudi', '13:00:00', 0, NULL),
(20, 'Jeudi', '14:00:00', 1, NULL),
(20, 'Jeudi', '15:00:00', 1, NULL),
(20, 'Jeudi', '16:00:00', 1, NULL),
(20, 'Jeudi', '17:00:00', 1, NULL),
(20, 'Vendredi', '10:00:00', 0, NULL),
(20, 'Vendredi', '11:00:00', 0, NULL),
(20, 'Vendredi', '12:00:00', 0, NULL),
(20, 'Vendredi', '13:00:00', 0, NULL),
(20, 'Vendredi', '14:00:00', 1, NULL),
(20, 'Vendredi', '15:00:00', 1, NULL),
(20, 'Vendredi', '16:00:00', 1, NULL),
(20, 'Vendredi', '17:00:00', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `infos_financieres`
--

DROP TABLE IF EXISTS `infos_financieres`;
CREATE TABLE IF NOT EXISTS `infos_financieres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `courriel_client` varchar(255) NOT NULL,
  `nom_carte` varchar(255) DEFAULT NULL,
  `prenom_carte` varchar(255) DEFAULT NULL,
  `adresse_ligne_1` varchar(255) DEFAULT NULL,
  `adresse_ligne_2` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `code_postal` varchar(20) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `numero_tel` varchar(20) DEFAULT NULL,
  `code_cb` varchar(16) DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courriel_client` (`courriel_client`(250))
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `infos_financieres`
--

INSERT INTO `infos_financieres` (`id`, `courriel_client`, `nom_carte`, `prenom_carte`, `adresse_ligne_1`, `adresse_ligne_2`, `ville`, `code_postal`, `pays`, `numero_tel`, `code_cb`, `cvv`) VALUES
(55, 'chloe.lestic@gmail.com', 'legal ', 'lola', 'rdf', 'ez', 'paris', '78920', 'portugal', '0268758209', '1203', '122');

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_agent` int DEFAULT NULL,
  `courriel_client` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `adresse` text,
  `autres_infos` text,
  `duree` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_agent` (`id_agent`),
  KEY `courriel_client` (`courriel_client`(250))
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`id`, `id_agent`, `courriel_client`, `date`, `heure`, `adresse`, `autres_infos`, `duree`) VALUES
(14, 10, 'chloe.lestic@gmail.com', '0000-00-00', '14:00:00', NULL, NULL, '01:00:00'),
(10, 2, 'chloe.lestic@gmail.com', '0000-00-00', '12:00:00', NULL, NULL, '01:00:00'),
(11, 7, 'chloe.lestic@gmail.com', '0000-00-00', '15:00:00', NULL, NULL, '01:00:00'),
(12, 7, 'chloe.lestic@gmail.com', '0000-00-00', '15:00:00', NULL, NULL, '01:00:00'),
(13, 9, 'chloe.lestic@gmail.com', '0000-00-00', '15:00:00', NULL, NULL, '01:00:00'),
(15, 10, 'chloe.lestic@gmail.com', '0000-00-00', '15:00:00', NULL, NULL, '01:00:00'),
(16, 2, 'chloe.lestic@gmail.com', '0000-00-00', '17:00:00', NULL, NULL, '01:00:00'),
(17, 2, 'chloe.lestic@gmail.com', '0000-00-00', '10:00:00', NULL, NULL, '01:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `test_paiement`
--

DROP TABLE IF EXISTS `test_paiement`;
CREATE TABLE IF NOT EXISTS `test_paiement` (
  `numero_carte` varchar(16) NOT NULL,
  `date` date NOT NULL,
  `cvv_test` varchar(3) NOT NULL,
  PRIMARY KEY (`numero_carte`,`date`,`cvv_test`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `test_paiement`
--

INSERT INTO `test_paiement` (`numero_carte`, `date`, `cvv_test`) VALUES
('4345676798431203', '2024-05-01', '122');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dispo_agents`
--
ALTER TABLE `dispo_agents`
  ADD CONSTRAINT `dispo_agents_ibfk_1` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
