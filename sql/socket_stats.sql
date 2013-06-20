-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Jun 2013 um 03:54
-- Server Version: 5.5.27
-- PHP-Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `test`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `socket_stats`
--

DROP TABLE IF EXISTS `socket_stats`;
CREATE TABLE IF NOT EXISTS `socket_stats` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `color` int(1) NOT NULL,
  `stat_type1` int(2) NOT NULL,
  `stat_value1` int(2) NOT NULL,
  `stat_type2` int(2) NOT NULL,
  `stat_value2` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `socket_stats`
--

INSERT INTO `socket_stats` (`id`, `name`, `color`, `stat_type1`, `stat_value1`, `stat_type2`, `stat_value2`) VALUES
(40111, 'Bold Cardinal Ruby', 2, 4, 20, 0, 0),
(40114, 'Bright Cardinal Ruby', 2, 38, 20, 0, 0),
(40112, 'Delicate Cardinal Ruby', 2, 3, 20, 0, 0),
(40116, 'Flashing Cardinal Ruby', 2, 14, 20, 0, 0),
(40117, 'Fractured Cardinal Ruby', 2, 44, 20, 0, 0),
(40118, 'Precise Cardinal Ruby', 2, 37, 20, 0, 0),
(40113, 'Runed Cardinal Ruby', 2, 42, 23, 0, 0),
(40115, 'Subtle Cardinal Ruby', 2, 13, 20, 0, 0),
(40119, 'Solid Majestic Zircon', 8, 7, 30, 0, 0),
(40121, 'Lustrous Majestic Zircon', 8, 43, 10, 0, 0),
(40122, 'Stormy Majestic Zircon', 8, 47, 25, 0, 0),
(40120, 'Sparkling Majestic Zircon', 8, 6, 20, 0, 0),
(40123, 'Brilliant King''s Amber', 4, 5, 20, 0, 0),
(40127, 'Mystic King''s Amber', 4, 35, 20, 0, 0),
(40128, 'Quick King''s Amber', 4, 36, 20, 0, 0),
(40125, 'Rigid King''s Amber', 4, 31, 20, 0, 0),
(40124, 'Smooth King''s Amber', 4, 32, 20, 0, 0),
(40126, 'Thick King''s Amber', 4, 12, 20, 0, 0),
(40162, 'Accurate Ametrine', 3, 37, 10, 31, 10),
(40144, 'Champion''s Ametrine', 3, 4, 10, 12, 10),
(40147, 'Deadly Ametrine', 3, 3, 10, 32, 10),
(40150, 'Deft Ametrine', 3, 3, 10, 36, 10),
(40154, 'Durable Ametrine', 3, 45, 12, 35, 10),
(40158, 'Empowered Ametrine', 3, 38, 20, 35, 10),
(40143, 'Etched Ametrine', 3, 4, 10, 31, 10),
(40146, 'Fierce Ametrine', 3, 4, 10, 36, 10),
(40161, 'Glimmering Ametrine', 3, 14, 10, 12, 10),
(40148, 'Glinting Ametrine', 3, 3, 10, 31, 10),
(40142, 'Inscribed Ametrine', 3, 4, 10, 32, 10),
(40149, 'Lucent Ametrine', 3, 3, 10, 35, 10),
(40151, 'Luminous Ametrine', 3, 45, 12, 5, 10),
(40152, 'Potent Ametrine', 3, 45, 12, 32, 10),
(40157, 'Pristine Ametrine', 3, 38, 20, 31, 10),
(40155, 'Reckless Ametrine', 3, 45, 12, 36, 10),
(40163, 'Resolute Ametrine', 3, 37, 10, 12, 10),
(40145, 'Resplendent Ametrine', 3, 4, 10, 35, 10),
(40160, 'Stalwart Ametrine', 3, 13, 10, 12, 10),
(40159, 'Stark Ametrine', 3, 38, 20, 36, 10),
(40153, 'Veiled Ametrine', 3, 45, 12, 31, 10),
(40156, 'Wicked Ametrine', 3, 38, 20, 32, 10),
(42142, 'Bold Dragon''s Eye', 2, 4, 34, 0, 0),
(36766, 'Bright Dragon''s Eye', 4, 5, 34, 0, 0),
(42143, 'Delicate Dragon''s Eye', 2, 3, 34, 0, 0),
(42152, 'Flashing Dragon''s Eye', 2, 14, 34, 0, 0),
(42153, 'Fractured Dragon''s Eye', 2, 44, 34, 0, 0),
(42146, 'Lustrous Dragon''s Eye', 8, 43, 17, 0, 0),
(42158, 'Mystic Dragon''s Eye', 4, 35, 34, 0, 0),
(42154, 'Precise Dragon''s Eye', 2, 37, 34, 0, 0),
(42150, 'Quick Dragon''s Eye', 4, 36, 34, 0, 0),
(42156, 'Rigid Dragon''s Eye', 4, 31, 34, 0, 0),
(42144, 'Runed Dragon''s Eye', 2, 45, 39, 0, 0),
(42149, 'Smooth Dragon''s Eye', 4, 32, 34, 0, 0),
(36767, 'Solid Dragon''s Eye', 8, 7, 51, 0, 0),
(42145, 'Sparkling Dragon''s Eye', 8, 6, 34, 0, 0),
(42155, 'Stormy Dragon''s Eye', 8, 47, 43, 0, 0),
(42151, 'Subtle Dragon''s Eye', 2, 13, 34, 0, 0),
(42157, 'Thick Dragon''s Eye', 4, 12, 34, 0, 0),
(40175, 'Dazzling Eye of Zul', 6, 5, 10, 43, 5),
(40167, 'Enduring Eye of Zul', 6, 12, 10, 7, 15),
(40179, 'Energized Eye of Zul', 6, 36, 10, 43, 5),
(40169, 'Forceful Eye of Zul', 6, 36, 10, 7, 15),
(40174, 'Intricate Eye of Zul', 6, 36, 10, 6, 10),
(40165, 'Jagged Eye of Zul', 6, 32, 10, 7, 15),
(40177, 'Lambent Eye of Zul', 6, 31, 10, 43, 5),
(40171, 'Misty Eye of Zul', 6, 32, 10, 6, 10),
(40178, 'Opaque Eye of Zul', 6, 35, 10, 43, 5),
(40180, 'Radiant Eye of Zul', 6, 32, 10, 47, 13),
(40170, 'Seer''s Eye of Zul', 6, 5, 10, 6, 10),
(40183, 'Shattered Eye of Zul', 6, 36, 10, 47, 13),
(40172, 'Shining Eye of Zul', 6, 31, 10, 6, 10),
(40168, 'Steady Eye of Zul', 6, 35, 10, 7, 15),
(40176, 'Sundered Eye of Zul', 6, 32, 10, 43, 5),
(40181, 'Tense Eye of Zul', 6, 31, 10, 47, 13),
(40164, 'Timeless Eye of Zul', 6, 5, 10, 7, 15),
(40173, 'Turbid Eye of Zul', 6, 35, 10, 6, 10),
(40166, 'Vivid Eye of Zul', 6, 31, 10, 7, 15);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
