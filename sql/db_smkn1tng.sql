-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2016 at 11:41 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smkn1tng`
--
CREATE DATABASE IF NOT EXISTS `db_smkn1tng` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_smkn1tng`;

-- --------------------------------------------------------

--
-- Table structure for table `data_absensi`
--

DROP TABLE IF EXISTS `data_absensi`;
CREATE TABLE `data_absensi` (
  `dataabsensi_id` int(11) NOT NULL,
  `datasiswa_id` int(11) NOT NULL,
  `dataguru_id` int(11) NOT NULL,
  `tanggalabsen` date NOT NULL,
  `statusabsen` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_guru`
--

DROP TABLE IF EXISTS `data_guru`;
CREATE TABLE `data_guru` (
  `dataguru_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `matapelajaran_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_guru`
--

INSERT INTO `data_guru` (`dataguru_id`, `guru_id`, `kelas_id`, `matapelajaran_id`) VALUES
(2, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

DROP TABLE IF EXISTS `data_siswa`;
CREATE TABLE `data_siswa` (
  `datasiswa_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `dataguru_id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_guru`
--

DROP TABLE IF EXISTS `m_guru`;
CREATE TABLE `m_guru` (
  `guru_id` int(11) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jk` char(1) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_guru`
--

INSERT INTO `m_guru` (`guru_id`, `nip`, `nama`, `jk`, `alamat`, `nohp`, `email`) VALUES
(1, '6786', 'hiohi', 'l', 'jbvuibvu', 'vuv', 'bub');

-- --------------------------------------------------------

--
-- Table structure for table `m_jurusan`
--

DROP TABLE IF EXISTS `m_jurusan`;
CREATE TABLE `m_jurusan` (
  `jurusan_id` int(11) NOT NULL,
  `nama` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_kelas`
--

DROP TABLE IF EXISTS `m_kelas`;
CREATE TABLE `m_kelas` (
  `kelas_id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kelas`
--

INSERT INTO `m_kelas` (`kelas_id`, `nama`) VALUES
(3, 'ffff'),
(8, 'fghj'),
(13, 'kjk'),
(5, 'bjbuh'),
(16, 'ffggg'),
(9, 'bnnm'),
(12, 'kkll'),
(14, 'jk'),
(15, 'hvyhvyiguhonl');

-- --------------------------------------------------------

--
-- Table structure for table `m_matapelajaran`
--

DROP TABLE IF EXISTS `m_matapelajaran`;
CREATE TABLE `m_matapelajaran` (
  `matapelajaran_id` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_matapelajaran`
--

INSERT INTO `m_matapelajaran` (`matapelajaran_id`, `nama`) VALUES
(1, 'dfffff');

-- --------------------------------------------------------

--
-- Table structure for table `m_siswa`
--

DROP TABLE IF EXISTS `m_siswa`;
CREATE TABLE `m_siswa` (
  `siswa_id` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` char(1) NOT NULL,
  `tempatlahir` varchar(25) DEFAULT NULL,
  `tanggallahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hobi` varchar(25) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `pekerjaan_ayah` varchar(35) NOT NULL,
  `pekerjaan_ibu` varchar(35) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_siswa`
--

INSERT INTO `m_siswa` (`siswa_id`, `nis`, `nama`, `jk`, `tempatlahir`, `tanggallahir`, `alamat`, `hobi`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nohp`, `email`) VALUES
(1, '011111', 'test aja', 'L', 'test', '2016-10-24', 'cikupa', 'main komputer', 'said', 'maryam', 'security', 'prt', '021', 'ffff');

-- --------------------------------------------------------

--
-- Table structure for table `m_tahunajaran`
--

DROP TABLE IF EXISTS `m_tahunajaran`;
CREATE TABLE `m_tahunajaran` (
  `tahunajaran_id` int(11) NOT NULL,
  `tahunajaran` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_absensi`
--
ALTER TABLE `data_absensi`
  ADD PRIMARY KEY (`dataabsensi_id`);

--
-- Indexes for table `data_guru`
--
ALTER TABLE `data_guru`
  ADD PRIMARY KEY (`dataguru_id`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`datasiswa_id`);

--
-- Indexes for table `m_guru`
--
ALTER TABLE `m_guru`
  ADD PRIMARY KEY (`guru_id`);

--
-- Indexes for table `m_jurusan`
--
ALTER TABLE `m_jurusan`
  ADD PRIMARY KEY (`jurusan_id`);

--
-- Indexes for table `m_kelas`
--
ALTER TABLE `m_kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `m_matapelajaran`
--
ALTER TABLE `m_matapelajaran`
  ADD PRIMARY KEY (`matapelajaran_id`);

--
-- Indexes for table `m_siswa`
--
ALTER TABLE `m_siswa`
  ADD PRIMARY KEY (`siswa_id`);

--
-- Indexes for table `m_tahunajaran`
--
ALTER TABLE `m_tahunajaran`
  ADD PRIMARY KEY (`tahunajaran_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_absensi`
--
ALTER TABLE `data_absensi`
  MODIFY `dataabsensi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_guru`
--
ALTER TABLE `data_guru`
  MODIFY `dataguru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `datasiswa_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_guru`
--
ALTER TABLE `m_guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_jurusan`
--
ALTER TABLE `m_jurusan`
  MODIFY `jurusan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_kelas`
--
ALTER TABLE `m_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `m_matapelajaran`
--
ALTER TABLE `m_matapelajaran`
  MODIFY `matapelajaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_siswa`
--
ALTER TABLE `m_siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_tahunajaran`
--
ALTER TABLE `m_tahunajaran`
  MODIFY `tahunajaran_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
