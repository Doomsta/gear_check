-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Jun 2013 um 01:31
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
(40156, 'Wicked Ametrine', 3, 38, 20, 32, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
