-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2014 at 10:42 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistem_informasi_administrasi_siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum_kd`
--

CREATE TABLE IF NOT EXISTS `kurikulum_kd` (
  `id_kd` int(10) NOT NULL AUTO_INCREMENT,
  `id_sk` int(10) NOT NULL,
  `jenis_kd` varchar(10) NOT NULL,
  PRIMARY KEY (`id_kd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `kurikulum_kd`
--

INSERT INTO `kurikulum_kd` (`id_kd`, `id_sk`, `jenis_kd`) VALUES
(15, 61, 'a_kd1'),
(16, 61, 'b_kd2'),
(59, 87, 'a_kd1'),
(60, 87, 'b_kd2'),
(61, 88, 'a_kd1'),
(62, 89, 'a_kd1'),
(63, 90, 'a_kd1');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum_sk`
--

CREATE TABLE IF NOT EXISTS `kurikulum_sk` (
  `id_sk` int(10) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(10) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `id_tahun_ajaran` int(10) NOT NULL,
  `semester` int(10) NOT NULL,
  `jenis_sk` varchar(10) NOT NULL,
  PRIMARY KEY (`id_sk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `kurikulum_sk`
--

INSERT INTO `kurikulum_sk` (`id_sk`, `id_mapel`, `id_kelas`, `id_tahun_ajaran`, `semester`, `jenis_sk`) VALUES
(61, 14, 22, 29, 1, 'a_sk1'),
(62, 14, 22, 29, 1, 'k_uts'),
(63, 14, 22, 29, 1, 'l_uas'),
(87, 10, 22, 29, 1, 'a_sk1'),
(88, 10, 22, 29, 1, 'b_sk2'),
(89, 10, 22, 29, 1, 'k_uts'),
(90, 10, 22, 29, 1, 'l_uas');

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE IF NOT EXISTS `login_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `login_admin`
--

INSERT INTO `login_admin` (`id_admin`, `nama`, `username`, `password`, `tipe`) VALUES
(17, 'Yazid Alfalisyada', 'yazid', 'a61f35c6f017d3ab1f5cf1cb3b0d8f3e', 'admin'),
(19, 'wali', 'wali', 'bf8cd26e6c6732b8df17a31b54800ed8', 'wali'),
(20, 'bhoting', 'bhoting', '968470b30cf3e2d04899a0ab00d5ddf5', 'guru'),
(21, 'wali1', 'wali1', '4fbe85981811e7caac556cb0016e36b6', 'wali'),
(25, 'guru2', 'guru2', '440a21bd2b3a7c686cf3238883dd34e9', 'guru'),
(29, 'ccc', 'ccc', '9df62e693988eb4e1e1444ece0578579', 'guru'),
(32, 'a', 'a', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `login_siswa`
--

CREATE TABLE IF NOT EXISTS `login_siswa` (
  `id_login_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id_login_siswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `login_siswa`
--

INSERT INTO `login_siswa` (`id_login_siswa`, `id_siswa`, `username`, `password`, `created`) VALUES
(7, 33, 'abdul', '589d3335df3a6d43aeb0b11fc09673bd', '2014-02-18 15:02:17'),
(8, 35, 'abitri', '8c3f048701cbab868d5e0c312635e69e', '2014-04-04 15:04:14'),
(9, 34, 'abi', '4ffbe35a28505921bd64d4d21a944861', '2014-04-22 16:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `m_kelas`
--

CREATE TABLE IF NOT EXISTS `m_kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `m_kelas`
--

INSERT INTO `m_kelas` (`id_kelas`, `nama_kelas`, `status`) VALUES
(22, '7 - A', 1),
(23, '7 - B', 1),
(24, '7 - C', 1),
(25, '7 - D', 1),
(26, '7 - E', 1),
(27, '7 - F', 1),
(28, '7 - G', 1),
(29, '8 - A', 2),
(30, '8 - B', 2),
(31, '8 - C', 2),
(32, '8 - D', 2),
(33, '8 - E', 2),
(34, '8 - F', 2),
(35, '8 - G', 2),
(36, '9 - A', 3),
(37, '9 - B', 3),
(38, '9 - C', 3),
(39, '9 - D', 3),
(40, '9 - E', 3),
(41, '9 - F', 3),
(42, '9 - G', 3);

-- --------------------------------------------------------

--
-- Table structure for table `m_mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `m_mata_pelajaran` (
  `id_mata_pelajaran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mata_pelajaran` varchar(45) NOT NULL,
  PRIMARY KEY (`id_mata_pelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `m_mata_pelajaran`
--

INSERT INTO `m_mata_pelajaran` (`id_mata_pelajaran`, `nama_mata_pelajaran`) VALUES
(10, 'Pendidikan Agama Islam'),
(11, 'Pendidikan Kewarganegaraan'),
(12, 'Bahasa Indonesia'),
(13, 'Bahasa Inggris'),
(14, 'Matematika'),
(15, 'Ilmu Pengetahuan Alam'),
(16, 'Ilmu Pengetahuan Sosial'),
(17, 'Seni Budaya'),
(18, 'Pendidikan Jasmani, Olah Raga dan Kesehatan'),
(19, 'Teknologi Informasi dan Komunikasi'),
(20, 'Seni Rupa'),
(21, 'Seni Musik');

-- --------------------------------------------------------

--
-- Table structure for table `m_orang_tua`
--

CREATE TABLE IF NOT EXISTS `m_orang_tua` (
  `id_ortu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ayah` varchar(45) NOT NULL,
  `nama_ibu` varchar(45) NOT NULL,
  `alamat_ayah` varchar(45) NOT NULL,
  `alamat_ibu` varchar(45) NOT NULL,
  `no_tlp_ayah` varchar(20) NOT NULL,
  `no_tlp_ibu` varchar(20) NOT NULL,
  `status_perwalian` varchar(10) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  PRIMARY KEY (`id_ortu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `m_orang_tua`
--

INSERT INTO `m_orang_tua` (`id_ortu`, `nama_ayah`, `nama_ibu`, `alamat_ayah`, `alamat_ibu`, `no_tlp_ayah`, `no_tlp_ibu`, `status_perwalian`, `id_siswa`) VALUES
(32, 'Joko', 'Rosida', 'Jl. Reporter Blok C-44 Komp.PWI', 'Jl. Reporter Blok C-44 Komp.PWI', '08126747466', '08126747466', 'Wali', 33),
(33, 'Adi', 'Siti', 'Jl. Pantai Tiram Blok 0 No. 12 JTW Asri II', 'Jl. Pantai Tiram Blok 0 No. 12 JTW Asri II', '08137285291', '085613123122', 'Kandung', 34),
(34, 'Bambang', 'Siti', 'Jl. Sanggata I 2/4 JTW Asri Pd. Gede', 'Jl. Sanggata I 2/4 JTW Asri Pd. Gede', '08137285291', '085613131232', 'Kandung', 35),
(35, 'Adi', 'Ida', 'KPAD Jl. Perhubungan Blok D.G2', 'KPAD Jl. Perhubungan Blok D.G2', '08137285291', '085613131232', 'Wali', 36),
(36, 'a', 'a', 'a', 'a', 'a', 'a', 'Kandung', 37);

-- --------------------------------------------------------

--
-- Table structure for table `m_paket`
--

CREATE TABLE IF NOT EXISTS `m_paket` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(10) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `m_paket`
--

INSERT INTO `m_paket` (`id_paket`, `nama_paket`) VALUES
(1, 'Kelas 7'),
(2, 'Kelas 8'),
(3, 'Kelas 9');

-- --------------------------------------------------------

--
-- Table structure for table `m_siswa`
--

CREATE TABLE IF NOT EXISTS `m_siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(10) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `photo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `m_siswa`
--

INSERT INTO `m_siswa` (`id_siswa`, `nis`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `photo`) VALUES
(33, '9961065088', 'ABDULLAH RIZKY AKBAR', 'Jakarta', '1996-05-01', 'Laki-laki', 'Islam', 'Jl. Reporter Blok C-44 Komp.PWI', 'Chrysanthemum.jpg'),
(34, '9940083415', 'ABI KARAMI MUHAMAD', 'Jakarta', '1995-10-26', 'Laki-laki', 'Islam', 'Jl. Pantai Tiram Blok 0 No. 12 JTW Asri II', 'Chrysanthemum1.jpg'),
(35, '9951104138', 'ABITRI MAHADILA PUTRI', 'Bekasi', '1995-11-09', 'Perempuan', 'Islam', 'Jl. Sanggata I 2/4 JTW Asri Pd. Gede', 'Penguins.jpg'),
(36, '9940083425', 'ADAM RAHMAT', 'Jakarta', '1995-06-15', 'Laki-laki', 'Islam', 'KPAD Jl. Perhubungan Blok D.G2', ''),
(37, 'a', 'a', 'a', '2014-03-19', 'Laki-laki', 'Islam', 'a', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_status_absen`
--

CREATE TABLE IF NOT EXISTS `m_status_absen` (
  `id_status_absen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(30) NOT NULL,
  PRIMARY KEY (`id_status_absen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `m_status_absen`
--

INSERT INTO `m_status_absen` (`id_status_absen`, `nama_status`) VALUES
(1, 'Masuk'),
(2, 'Izin'),
(3, 'Sakit'),
(4, 'Tanpa Keterangan');

-- --------------------------------------------------------

--
-- Table structure for table `m_tahun_ajaran`
--

CREATE TABLE IF NOT EXISTS `m_tahun_ajaran` (
  `id_tahun_ajaran` int(10) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tahun` int(11) NOT NULL,
  PRIMARY KEY (`id_tahun_ajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `m_tahun_ajaran`
--

INSERT INTO `m_tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`, `status`, `tahun`) VALUES
(29, '2013 / 2014', 1, 2013),
(31, '2014 / 2015', 0, 2014),
(32, '2015 / 2016', 0, 2015);

-- --------------------------------------------------------

--
-- Table structure for table `r_absen`
--

CREATE TABLE IF NOT EXISTS `r_absen` (
  `id_absen` int(100) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tahun_ajaran` int(10) NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `tgl` date NOT NULL,
  `id_status_absen` int(11) NOT NULL,
  PRIMARY KEY (`id_absen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `r_absen`
--

INSERT INTO `r_absen` (`id_absen`, `id_siswa`, `id_kelas`, `id_tahun_ajaran`, `semester`, `tgl`, `id_status_absen`) VALUES
(1, 33, 22, 29, 1, '2014-04-20', 1),
(2, 34, 22, 29, 1, '2014-04-20', 1),
(3, 36, 22, 29, 1, '2014-04-20', 1),
(13, 33, 22, 29, 1, '2014-04-21', 2),
(14, 34, 22, 29, 1, '2014-04-21', 1),
(15, 36, 22, 29, 1, '2014-04-21', 4),
(16, 33, 22, 29, 1, '2014-04-22', 2),
(17, 34, 22, 29, 1, '2014-04-22', 3),
(18, 36, 22, 29, 1, '2014-04-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_guru`
--

CREATE TABLE IF NOT EXISTS `r_guru` (
  `id_admin` int(10) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `id_mata_pelajaran` int(10) NOT NULL,
  `id_tahun_ajaran` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_guru`
--

INSERT INTO `r_guru` (`id_admin`, `id_kelas`, `id_mata_pelajaran`, `id_tahun_ajaran`) VALUES
(25, 23, 11, 29),
(29, 23, 12, 29),
(25, 24, 11, 29),
(32, 26, 10, 29),
(25, 22, 11, 29),
(32, 25, 10, 29),
(25, 25, 11, 29),
(29, 25, 12, 29),
(20, 22, 10, 29),
(20, 23, 10, 29),
(20, 24, 10, 29),
(20, 29, 10, 29),
(20, 30, 10, 29),
(20, 31, 10, 29);

-- --------------------------------------------------------

--
-- Table structure for table `r_kelas_siswa`
--

CREATE TABLE IF NOT EXISTS `r_kelas_siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_kelas_siswa`
--

INSERT INTO `r_kelas_siswa` (`id_siswa`, `id_kelas`, `id_tahun_ajaran`, `status`) VALUES
(33, 22, 29, 1),
(34, 22, 29, 1),
(34, 33, 31, 2),
(35, 23, 29, 1),
(36, 22, 29, 1),
(36, 29, 31, 2),
(35, 29, 31, 2);

-- --------------------------------------------------------

--
-- Table structure for table `r_nilai_siswa`
--

CREATE TABLE IF NOT EXISTS `r_nilai_siswa` (
  `id_nilai` int(10) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(10) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `id_mapel` tinyint(4) NOT NULL,
  `id_tahun_ajaran` tinyint(4) NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `id_sk` int(10) NOT NULL,
  `id_kd` int(10) NOT NULL,
  `nilai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `r_nilai_siswa`
--

INSERT INTO `r_nilai_siswa` (`id_nilai`, `id_siswa`, `id_kelas`, `id_mapel`, `id_tahun_ajaran`, `semester`, `id_sk`, `id_kd`, `nilai`) VALUES
(27, 33, 22, 10, 29, 1, 87, 59, 90),
(28, 33, 22, 10, 29, 1, 87, 60, 80),
(29, 33, 22, 10, 29, 1, 88, 61, 70),
(30, 33, 22, 10, 29, 1, 89, 62, 70),
(31, 33, 22, 10, 29, 1, 90, 63, 80),
(32, 34, 22, 10, 29, 1, 87, 59, 89),
(33, 34, 22, 10, 29, 1, 87, 60, 80);

-- --------------------------------------------------------

--
-- Table structure for table `r_paket_pelajaran`
--

CREATE TABLE IF NOT EXISTS `r_paket_pelajaran` (
  `id_mata_pelajaran` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `kkm` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_paket_pelajaran`
--

INSERT INTO `r_paket_pelajaran` (`id_mata_pelajaran`, `id_paket`, `kkm`) VALUES
(10, 1, 70),
(10, 2, 75),
(10, 3, 80),
(11, 1, 70),
(11, 2, 75),
(11, 3, 80),
(12, 1, 70),
(12, 2, 75),
(12, 3, 80),
(13, 1, 70),
(13, 2, 75),
(13, 3, 80),
(14, 1, 70),
(14, 2, 75),
(14, 3, 80),
(15, 1, 70),
(15, 2, 75),
(15, 3, 80),
(16, 1, 70),
(16, 2, 75),
(16, 3, 80),
(17, 1, 70),
(17, 2, 75),
(17, 3, 80),
(18, 1, 70),
(18, 2, 75),
(18, 3, 80),
(19, 1, 70),
(19, 2, 75),
(19, 3, 80);

-- --------------------------------------------------------

--
-- Table structure for table `r_siswa_kelas_paket`
--

CREATE TABLE IF NOT EXISTS `r_siswa_kelas_paket` (
  `id_kelas` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_siswa_kelas_paket`
--

INSERT INTO `r_siswa_kelas_paket` (`id_kelas`, `id_paket`) VALUES
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3);

-- --------------------------------------------------------

--
-- Table structure for table `r_wali_kelas`
--

CREATE TABLE IF NOT EXISTS `r_wali_kelas` (
  `id_admin` int(10) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `id_tahun_ajaran` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_wali_kelas`
--

INSERT INTO `r_wali_kelas` (`id_admin`, `id_kelas`, `id_tahun_ajaran`) VALUES
(19, 22, 29);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_semester` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `nama_semester`, `status`) VALUES
(1, 'Semester 1', 1),
(2, 'Semester 2', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
