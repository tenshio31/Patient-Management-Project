-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 23 oct. 2023 à 13:21
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_patient`
--

-- --------------------------------------------------------

--
-- Structure de la table `his_admin`
--

DROP TABLE IF EXISTS `his_admin`;
CREATE TABLE IF NOT EXISTS `his_admin` (
  `ad_id` int(20) NOT NULL AUTO_INCREMENT,
  `ad_fname` varchar(200) DEFAULT NULL,
  `ad_lname` varchar(200) DEFAULT NULL,
  `ad_email` varchar(200) DEFAULT NULL,
  `ad_pwd` varchar(200) DEFAULT NULL,
  `ad_dpic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `his_admin`
--

INSERT INTO `his_admin` (`ad_id`, `ad_fname`, `ad_lname`, `ad_email`, `ad_pwd`, `ad_dpic`) VALUES
(1, 'Administrateur', '1', 'admin@mail.com', '4c7f5919e957f354d57243d37f223cf31e9e7181', 'doc-icon.png');

-- --------------------------------------------------------

--
-- Structure de la table `his_medical_records`
--

DROP TABLE IF EXISTS `his_medical_records`;
CREATE TABLE IF NOT EXISTS `his_medical_records` (
  `mdr_id` int(20) NOT NULL AUTO_INCREMENT,
  `mdr_number` varchar(200) DEFAULT NULL,
  `mdr_pat_name` varchar(200) DEFAULT NULL,
  `mdr_pat_adr` varchar(200) DEFAULT NULL,
  `mdr_pat_age` varchar(200) DEFAULT NULL,
  `mdr_pat_ailment` varchar(200) DEFAULT NULL,
  `mdr_pat_number` varchar(200) DEFAULT NULL,
  `mdr_pat_prescr` longtext DEFAULT NULL,
  `mdr_date_rec` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4),
  PRIMARY KEY (`mdr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `his_patients`
--

DROP TABLE IF EXISTS `his_patients`;
CREATE TABLE IF NOT EXISTS `his_patients` (
  `pat_id` int(20) NOT NULL AUTO_INCREMENT,
  `pat_fname` varchar(200) DEFAULT NULL,
  `pat_lname` varchar(200) DEFAULT NULL,
  `pat_dob` varchar(200) DEFAULT NULL,
  `pat_age` varchar(200) DEFAULT NULL,
  `pat_number` varchar(200) DEFAULT NULL,
  `pat_addr` varchar(200) DEFAULT NULL,
  `pat_phone` varchar(200) DEFAULT NULL,
  `pat_type` varchar(200) DEFAULT NULL,
  `pat_date_joined` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `pat_ailment` varchar(200) DEFAULT NULL,
  `pat_discharge_status` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`pat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `his_patients`
--

INSERT INTO `his_patients` (`pat_id`, `pat_fname`, `pat_lname`, `pat_dob`, `pat_age`, `pat_number`, `pat_addr`, `pat_phone`, `pat_type`, `pat_date_joined`, `pat_ailment`, `pat_discharge_status`) VALUES
(14, 'ANDRIATAHINA ', 'Michel Angelo', '31/03/2002', '21', '31U0Q', 'Lot 680 TER Loharanombato/Ampitatafika', '0348740828', 'HospitalisÃ©', '2023-09-25 10:44:57.339300', 'FiÃ¨vre', NULL),
(15, 'ANDRIAMIFIDY', 'Zanamaniraka Samuel', '08/04/1998', '25', '2RDLJ', 'Alasora', '0344483574', 'HospitalisÃ©', '2023-10-23 12:43:08.113037', 'FiÃ¨vre', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `his_pharmaceuticals`
--

DROP TABLE IF EXISTS `his_pharmaceuticals`;
CREATE TABLE IF NOT EXISTS `his_pharmaceuticals` (
  `phar_id` int(20) NOT NULL AUTO_INCREMENT,
  `phar_name` varchar(200) DEFAULT NULL,
  `phar_bcode` varchar(200) DEFAULT NULL,
  `phar_desc` longtext DEFAULT NULL,
  `phar_qty` varchar(200) DEFAULT NULL,
  `phar_cat` varchar(200) DEFAULT NULL,
  `phar_vendor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`phar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `his_pharmaceuticals`
--

INSERT INTO `his_pharmaceuticals` (`phar_id`, `phar_name`, `phar_bcode`, `phar_desc`, `phar_qty`, `phar_cat`, `phar_vendor`) VALUES
(4, 'ParacÃ©tamol', '520193846', '<p>Le parac&eacute;tamol, &eacute;galement connu sous le nom d&#39;ac&eacute;taminoph&egrave;ne dans certains pays, est un analg&eacute;sique non opio&iuml;de largement utilis&eacute; pour soulager la douleur et r&eacute;duire la fi&egrave;vre. Il agit en r&eacute;duisant la perception de la douleur et en diminuant la fi&egrave;vre, bien que son m&eacute;canisme d&#39;action pr&eacute;cis ne soit pas compl&egrave;tement compris. Il est couramment utilis&eacute; pour traiter des affections telles que les maux de t&ecirc;te, les douleurs musculaires, les douleurs articulaires et les fi&egrave;vres l&eacute;g&egrave;res &agrave; mod&eacute;r&eacute;es. Cependant, il est essentiel de respecter la posologie recommand&eacute;e, car une utilisation excessive de parac&eacute;tamol peut entra&icirc;ner des effets secondaires graves, notamment des l&eacute;sions h&eacute;patiques potentiellement mortelles. Le parac&eacute;tamol est g&eacute;n&eacute;ralement consid&eacute;r&eacute; comme un m&eacute;dicament s&ucirc;r lorsque pris conform&eacute;ment aux instructions, mais il doit &ecirc;tre utilis&eacute; avec pr&eacute;caution, en particulier chez les personnes ayant des probl&egrave;mes h&eacute;patiques ou qui consomment de l&#39;alcool r&eacute;guli&egrave;rement.</p>', '200', 'AnalgÃ©sique', 'Frakidex'),
(5, 'Amoxicilline', '761293048', '<p>L&#39;amoxicilline est un antibiotique de la classe des p&eacute;nicillines, utilis&eacute; pour traiter diverses infections bact&eacute;riennes, telles que les infections respiratoires, urinaires, de la peau et des tissus mous. Il agit en perturbant la paroi cellulaire des bact&eacute;ries, ce qui les tue ou les emp&ecirc;che de se multiplier. Des effets secondaires potentiels de l&#39;amoxicilline incluent des r&eacute;actions allergiques, des troubles gastro-intestinaux (naus&eacute;es, vomissements, diarrh&eacute;e) et des &eacute;ruptions cutan&eacute;es. Il est essentiel de suivre le traitement complet prescrit par un professionnel de la sant&eacute; et de ne pas utiliser l&#39;amoxicilline sans ordonnance m&eacute;dicale pour &eacute;viter la r&eacute;sistance aux antibiotiques.</p>', '300', 'Antibiotique', 'Frakidex');

-- --------------------------------------------------------

--
-- Structure de la table `his_prescriptions`
--

DROP TABLE IF EXISTS `his_prescriptions`;
CREATE TABLE IF NOT EXISTS `his_prescriptions` (
  `pres_id` int(200) NOT NULL AUTO_INCREMENT,
  `pres_pat_name` varchar(200) DEFAULT NULL,
  `pres_pat_age` varchar(200) DEFAULT NULL,
  `pres_pat_number` varchar(200) DEFAULT NULL,
  `pres_number` varchar(200) DEFAULT NULL,
  `pres_pat_addr` varchar(200) DEFAULT NULL,
  `pres_pat_type` varchar(200) DEFAULT NULL,
  `pres_date` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4),
  `pres_pat_ailment` varchar(200) DEFAULT NULL,
  `pres_ins` longtext DEFAULT NULL,
  PRIMARY KEY (`pres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `his_prescriptions`
--

INSERT INTO `his_prescriptions` (`pres_id`, `pres_pat_name`, `pres_pat_age`, `pres_pat_number`, `pres_number`, `pres_pat_addr`, `pres_pat_type`, `pres_date`, `pres_pat_ailment`, `pres_ins`) VALUES
(7, 'ANDRIATAHINA  Michel Angelo', '21', '31U0Q', '8XU9F', 'Lot 680 TER Loharanombato/Ampitatafika', 'HospitalisÃ©', '2023-09-25 11:05:47.2032', 'FiÃ¨vre', '<p>&nbsp;</p><ol><li><p><strong>M&eacute;dicament :</strong> Ac&eacute;taminoph&egrave;ne (parac&eacute;tamol)</p><ul><li><strong>Posologie :</strong> Prendre 500 mg toutes les 4 &agrave; 6 heures au besoin pour la fi&egrave;vre. Ne pas d&eacute;passer 3000 mg par jour.</li><li><strong>Instructions :</strong> Prendre avec de la nourriture pour &eacute;viter les maux d&#39;estomac. Ne pas prendre en combinaison avec d&#39;autres m&eacute;dicaments contenant de l&#39;ac&eacute;taminoph&egrave;ne.</li></ul></li><li><p><strong>Hydratation :</strong> Boire beaucoup de liquides, comme de l&#39;eau, des tisanes ou des jus de fruits, pour rester bien hydrat&eacute;.</p></li><li><p><strong>Repos :</strong> Se reposer suffisamment pour aider le corps &agrave; combattre l&#39;infection.</p></li><li><p><strong>Suivi m&eacute;dical :</strong> Si la fi&egrave;vre persiste au-del&agrave; de [nombre de jours], si de nouveaux sympt&ocirc;mes apparaissent ou si l&#39;&eacute;tat du patient s&#39;aggrave, prendre rendez-vous pour un suivi m&eacute;dical.</p></li><li><p><strong>Conseils :</strong> &Eacute;viter les activit&eacute;s ext&eacute;nuantes, maintenir une alimentation &eacute;quilibr&eacute;e et &eacute;viter l&#39;alcool pendant la prise de m&eacute;dicaments.</p></li></ol>');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
