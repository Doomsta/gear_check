DROP TABLE IF EXISTS `socket_bonus`;
CREATE TABLE IF NOT EXISTS `socket_bonus` (
  `id` int(5) NOT NULL,
  `stat_type1` int(2) NOT NULL,
  `stat_value1` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `socket_bonus` (`id`, `stat_type1`, `stat_value1`) VALUES
(3312, 4, 8),
(2892, 4, 4),
(3357, 4, 6),
(2927, 4, 4),
(3354, 7, 12),
(3766, 7, 12),
(2868, 7, 6),
(3766, 7, 12),
(3307, 7, 9),
(3753, 45, 9),
(3752, 45, 5),
(3596, 45, 5),
(3602, 45, 7);
