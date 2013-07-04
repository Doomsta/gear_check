DROP TABLE IF EXISTS `class_attribute_effects`;
CREATE TABLE IF NOT EXISTS `class_attribute_effects` (
  `class` int(2) NOT NULL,
  `stat_type` int(1) NOT NULL,
  `stat_value` int(1) NOT NULL,
  PRIMARY KEY (`class`,`stat_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `class_attribute_effects` (`class`, `stat_type`, `stat_value`) VALUES
(1, 4, 3),
(1, 7, 2),
(2, 4, 2),
(2, 6, 1),
(2, 7, 2),
(3, 3, 3),
(3, 6, 1),
(3, 7, 1),
(4, 3, 3),
(4, 4, 1),
(4, 7, 1),
(5, 5, 2),
(5, 6, 3),
(7, 4, 1),
(7, 5, 4),
(7, 6, 2),
(7, 7, 1),
(8, 5, 3),
(8, 6, 2),
(9, 5, 2),
(9, 6, 2),
(9, 7, 1),
(11, 4, 1),
(11, 5, 2),
(11, 6, 2);