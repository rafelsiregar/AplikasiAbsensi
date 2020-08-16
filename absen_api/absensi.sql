-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 02:31 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `id_user` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `keterangan` enum('Masuk','Pulang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `id_user`, `tanggal`, `jam`, `keterangan`) VALUES
(5, 10, '2020-08-05', '06:30:00', 'Masuk'),
(6, 10, '2020-08-05', '14:01:00', 'Pulang'),
(7, 12, '2020-08-03', '07:00:01', 'Masuk'),
(8, 12, '2020-08-03', '14:00:05', 'Pulang'),
(9, 12, '2020-05-06', '06:16:44', 'Masuk'),
(10, 12, '2020-05-06', '14:16:44', 'Pulang');

-- --------------------------------------------------------

--
-- Table structure for table `jam`
--

CREATE TABLE `jam` (
  `id_jam` int(2) NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `keterangan` enum('Masuk','Pulang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jam`
--

INSERT INTO `jam` (`id_jam`, `mulai`, `selesai`, `keterangan`) VALUES
(1, '06:15:00', '06:59:59', 'Masuk'),
(2, '14:00:00', '16:00:00', 'Pulang');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `tingkat` varchar(3) NOT NULL,
  `jurusan` varchar(10) DEFAULT NULL,
  `nama_kelas` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `tingkat`, `jurusan`, `nama_kelas`) VALUES
(30, 'XII', 'IPS', 'XII IPS 3'),
(31, 'X', 'IPA', 'X IPA 1'),
(32, 'X', 'IPS', 'X IPS 4'),
(33, 'X', 'IPA', 'X IPA 2');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(2) NOT NULL,
  `nis` int(4) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(150) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`) VALUES
(1, 5000, 'RENDY AHMAD GUNARDI', 'Laki-laki', 'Bandung', '2000-11-21'),
(2, 5551, 'AHMAD YURIANTO', 'Laki-laki', 'Jakarta', '2000-02-21'),
(3, 5560, 'ARIQ MUSTAFA', 'Laki-laki', 'Kendal', '2010-09-10'),
(4, 5592, 'AHMAD WAHYU BAIHAQI', 'Laki-laki', 'Kendal', '2001-12-30'),
(5, 5150, 'WENDI CAGUR', 'Laki-laki', 'Semarang', '2002-02-21'),
(8, 1912, 'DIAN PRAMANA PUTERA', 'Laki-laki', 'Jakarta', '1991-02-12'),
(9, 5511, 'Evita', 'Perempuan', 'Pekanbaru', '2001-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_user`
--

CREATE TABLE `siswa_user` (
  `id_siswa` int(2) NOT NULL,
  `id_user` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa_user`
--

INSERT INTO `siswa_user` (`id_siswa`, `id_user`) VALUES
(4, 2),
(3, 3),
(5, 5),
(9, 10),
(8, 11),
(2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas_siswa`
--

CREATE TABLE `tb_kelas_siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kelas_siswa`
--

INSERT INTO `tb_kelas_siswa` (`id_siswa`, `id_kelas`) VALUES
(4, 32),
(2, 32),
(8, 31),
(9, 31);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', '38ca89564b2259401518960f7a06f94b', 'admin'),
(2, 'wahyu', '0e8982822c9f3035d7c34f50978481a6', 'siswa'),
(3, 'ariq', 'cb3ac37cfa0f0588cefaad2de296377f', 'siswa'),
(5, 'wendi', '2e4bfd5d14e62b57e9d5824643c75f93', 'siswa'),
(10, 'evita', '6a59c47d77e763e2a443e5e331f18b0a', 'siswa'),
(11, 'dian', 'f97de4a9986d216a6e0fea62b0450da9', 'siswa'),
(12, 'yuri', '17809f92c7cb171a572869c18a873e07', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `waktu`
--

CREATE TABLE `waktu` (
  `id_waktu` int(11) NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `keterangan` enum('masuk','pulang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `fk_id_siswa_user` (`id_user`);

--
-- Indexes for table `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD UNIQUE KEY `nis_2` (`nis`);

--
-- Indexes for table `siswa_user`
--
ALTER TABLE `siswa_user`
  ADD UNIQUE KEY `id_siswa` (`id_siswa`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_kelas_siswa`
--
ALTER TABLE `tb_kelas_siswa`
  ADD KEY `id_kelas_siswa` (`id_kelas`),
  ADD KEY `key_id_siswa` (`id_siswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id_waktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jam`
--
ALTER TABLE `jam`
  MODIFY `id_jam` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id_waktu` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `fk_id_siswa_user` FOREIGN KEY (`id_user`) REFERENCES `siswa_user` (`id_user`);

--
-- Constraints for table `siswa_user`
--
ALTER TABLE `siswa_user`
  ADD CONSTRAINT `fk_id_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_siswa_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tb_kelas_siswa`
--
ALTER TABLE `tb_kelas_siswa`
  ADD CONSTRAINT `id_kelas_siswa` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `key_id_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
