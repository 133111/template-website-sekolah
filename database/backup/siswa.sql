CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `usia` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `nrp` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
