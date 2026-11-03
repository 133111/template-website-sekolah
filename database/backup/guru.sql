CREATE TABLE IF NOT EXISTS `guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `usia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
