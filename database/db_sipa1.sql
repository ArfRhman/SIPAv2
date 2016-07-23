-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 23. Juli 2016 jam 06:43
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_sipa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE IF NOT EXISTS `alat` (
  `ID_ALAT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_JURUSAN` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_LOKASI` int(11) DEFAULT NULL,
  `ID_KATEGORI` int(11) DEFAULT NULL,
  `ID_PAKET` int(11) DEFAULT NULL,
  `ID_FASE` int(11) DEFAULT NULL,
  `ID_USULAN` int(11) DEFAULT NULL,
  `NAMA_ALAT` varchar(50) DEFAULT NULL,
  `SPESIFIKASI` text,
  `SETARA` text,
  `SATUAN` varchar(20) DEFAULT NULL,
  `JUMLAH_ALAT` decimal(8,0) DEFAULT NULL,
  `HARGA_SATUAN` decimal(8,0) DEFAULT NULL,
  `JUMLAH_DISTRIBUSI` decimal(8,0) DEFAULT NULL,
  `KONFIRMASI` text,
  `REFERENSI_TERKAIT` text,
  `DATA_AHLI` tinyint(1) DEFAULT NULL,
  `REVISI` decimal(8,0) DEFAULT NULL,
  `TANGGAL_UPDATE` datetime DEFAULT NULL,
  `NO_INVENTARIS` decimal(8,0) DEFAULT NULL,
  `IS_FINAL` tinyint(1) DEFAULT NULL,
  `REVISI_PAKET` decimal(8,0) DEFAULT NULL,
  PRIMARY KEY (`ID_ALAT`),
  KEY `FK_RELATIONSHIP_10` (`ID_LOKASI`),
  KEY `FK_RELATIONSHIP_16` (`ID_FASE`),
  KEY `FK_RELATIONSHIP_18` (`ID_JURUSAN`),
  KEY `FK_RELATIONSHIP_26` (`ID_PAKET`),
  KEY `FK_RELATIONSHIP_29` (`ID_USULAN`),
  KEY `FK_RELATIONSHIP_36` (`ID_KATEGORI`),
  KEY `FK_RELATIONSHIP_6` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_tim_hps`
--

CREATE TABLE IF NOT EXISTS `anggota_tim_hps` (
  `ID_TIM_HPS` int(11) NOT NULL,
  `NIP` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_TIM_HPS`,`NIP`),
  KEY `FK_RELATIONSHIP_42` (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_tim_penerima`
--

CREATE TABLE IF NOT EXISTS `anggota_tim_penerima` (
  `ID_TIM_PENERIMA` int(11) NOT NULL,
  `NIP` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_TIM_PENERIMA`,`NIP`),
  KEY `FK_RELATIONSHIP_40` (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_pengadaan`
--

CREATE TABLE IF NOT EXISTS `bukti_pengadaan` (
  `ID_BUKTI` int(11) NOT NULL,
  `ID_PAKET` int(11) DEFAULT NULL,
  `TANGGAL` datetime DEFAULT NULL,
  `FILE` text,
  `KETERANGAN` text,
  PRIMARY KEY (`ID_BUKTI`),
  KEY `FK_RELATIONSHIP_35` (`ID_PAKET`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fase`
--

CREATE TABLE IF NOT EXISTS `fase` (
  `ID_FASE` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_FASE` varchar(50) DEFAULT NULL,
  `WAKTU_PELAKSANAAN` int(3) NOT NULL,
  `WAKTU_TAMBAHAN` int(3) NOT NULL,
  PRIMARY KEY (`ID_FASE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `fase`
--

INSERT INTO `fase` (`ID_FASE`, `NAMA_FASE`, `WAKTU_PELAKSANAAN`, `WAKTU_TAMBAHAN`) VALUES
(1, 'Pengajuan', 30, 16),
(2, 'VerifikasiHPS', 10, 4),
(3, 'Pengadaan', 30, 15),
(4, 'PenetapanKontrak', 7, 3),
(5, 'Penerimaan', 9, 9),
(6, 'Pencatatan', 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_user`
--

CREATE TABLE IF NOT EXISTS `jenis_user` (
  `ID_JENIS_USER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_JENIS_USER` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_JENIS_USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data untuk tabel `jenis_user`
--

INSERT INTO `jenis_user` (`ID_JENIS_USER`, `NAMA_JENIS_USER`) VALUES
(1, 'Teknisi'),
(2, 'Kepala Lab'),
(3, 'Manajemen'),
(4, 'Pembantu Direktur 2'),
(5, 'PPK'),
(6, 'Tim HPS'),
(7, 'ULP'),
(8, 'Tim Penerima'),
(9, 'PPSPM'),
(10, 'Direktur'),
(11, 'Administrasi Umum'),
(99, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `ID_JURUSAN` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_JURUSAN` varchar(50) DEFAULT NULL,
  `INISIAL` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_JURUSAN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`ID_JURUSAN`, `NAMA_JURUSAN`, `INISIAL`) VALUES
(0, NULL, NULL),
(1, 'Teknik Komputer dan Informatika', 'JTK'),
(2, 'Administrasi Niaga', 'AN'),
(3, 'Teknik Sipil', 'Sipil'),
(4, 'Teknik Mesin', 'Mesin'),
(5, 'Teknik Refrigerasi dan Tata Udara', 'Refri'),
(6, 'Teknik Konversi Energi', 'Energi'),
(7, 'Teknik Elektro', 'JTE'),
(8, 'Teknik Kimia', 'KI'),
(9, 'Akuntansi', 'Akun'),
(10, 'Bahasa Inggris', 'BI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `ID_KATEGORI` int(11) NOT NULL AUTO_INCREMENT,
  `KATEGORI` varchar(50) DEFAULT NULL,
  `KETERANGAN` text,
  PRIMARY KEY (`ID_KATEGORI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `KATEGORI`, `KETERANGAN`) VALUES
(1, 'Bahan Kimia', ''),
(2, 'Alat Berat', ''),
(3, 'Kendaraan Bermotor', ''),
(4, 'Alat Kebersihan', ''),
(5, 'Material Konstruksi', ''),
(6, 'Tata Lingkungan', ''),
(7, 'Internet Service Provider', ''),
(8, 'Komunikasi & Informatika', ''),
(9, 'Peralatan Kantor', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontrak`
--

CREATE TABLE IF NOT EXISTS `kontrak` (
  `ID_KONTRAK` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PAKET` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `KETERANGAN` text,
  `FILE` text,
  PRIMARY KEY (`ID_KONTRAK`),
  KEY `FK_RELATIONSHIP_24` (`ID_USER`),
  KEY `FK_RELATIONSHIP_25` (`ID_PAKET`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE IF NOT EXISTS `lokasi` (
  `ID_LOKASI` int(11) NOT NULL AUTO_INCREMENT,
  `ID_JURUSAN` int(11) DEFAULT NULL,
  `NAMA_LOKASI` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_LOKASI`),
  KEY `FK_RELATIONSHIP_15` (`ID_JURUSAN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`ID_LOKASI`, `ID_JURUSAN`, `NAMA_LOKASI`) VALUES
(1, 1, 'RSG'),
(2, 1, 'Lab. RPL'),
(3, 2, 'Lab Bisnis'),
(4, 2, 'Ruang Rapat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pagu`
--

CREATE TABLE IF NOT EXISTS `pagu` (
  `ID_PAGU` int(11) NOT NULL AUTO_INCREMENT,
  `ID_JURUSAN` int(11) DEFAULT NULL,
  `TAHUN_ANGGARAN` int(11) DEFAULT NULL,
  `PAGU_ALAT` bigint(20) DEFAULT NULL,
  `TANGGAL` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PAGU`),
  KEY `FK_RELATIONSHIP_17` (`ID_JURUSAN`),
  KEY `FK_RELATIONSHIP_46` (`TAHUN_ANGGARAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
  `ID_PAKET` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_TIM_HPS` int(11) DEFAULT NULL,
  `TAHUN_ANGGARAN` int(11) DEFAULT NULL,
  `NAMA_PAKET` text,
  `STATUS` decimal(8,0) DEFAULT NULL,
  `TANGGAL_DIBUAT` datetime DEFAULT NULL,
  `TOTAL_ANGGARAN` bigint(20) DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  `KETERANGAN_GAGAL_LELANG` text,
  `PENYEDIA` varchar(50) DEFAULT NULL,
  `WAKTU_PENGADAAN` int(11) DEFAULT NULL,
  `TYPE_WAKTU` varchar(20) DEFAULT NULL,
  `STATUS_BAYAR` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_PAKET`),
  KEY `FK_REFERENCE_40` (`TAHUN_ANGGARAN`),
  KEY `FK_RELATIONSHIP_2` (`ID_TIM_HPS`),
  KEY `FK_RELATIONSHIP_4` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `NIP` varchar(20) NOT NULL,
  `NAMA_PEGAWAI` varchar(50) DEFAULT NULL,
  `NO_HP` decimal(13,0) DEFAULT NULL,
  `EMAIL` char(50) DEFAULT NULL,
  `IS_TEKNISI` tinyint(1) DEFAULT NULL,
  `HPS_CERTIFIED` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`NIP`, `NAMA_PEGAWAI`, `NO_HP`, `EMAIL`, `IS_TEKNISI`, `HPS_CERTIFIED`) VALUES
('10', 'Cindy', 80, 'c@gmail.com', 0, 0),
('101010101010', 'Luthpi', 810101010, 'j@gmail.com', 0, 0),
('11', 'Tiara', 80, 't@gmail.com', 0, 0),
('11111111', 'Adit', 8111111, 'a@gmail.com', 1, 0),
('12', 'BobiT', 80, 'b@gmcil.com', 0, 0),
('13', 'Amos', 80, 'am@gmail.com', 0, 0),
('14', 'Amara', 2080, 'asd@asd', 0, 0),
('15', 'Amru', 1238, 'a@amc.', 0, 0),
('16', 'Amri', 12389, 'a@asma', 0, 0),
('17', 'Asma', 23123, 'as@ma', 0, 0),
('18', 'Amsah', 2912, 'a2S@asm', 0, 0),
('19', 'Amy', 2892839, 'asdm@ma', 0, 0),
('20', 'Darwin', 2938192, 'dar@gmail.com', 0, 0),
('2222222', 'Andi', 8222222, 'b@gmail.com', 0, 0),
('3333333', 'Andika', 83333333, 'c@gmail.com', 0, 0),
('4444444', 'Annisa', 84444444, 'd@gmail.com', 0, 0),
('555555', 'Arif', 8555555, 'e@gmail.com', 0, 0),
('6', 'Didi', 6345345, 'didi@gmail.com', 0, 1),
('66666', 'Budi', 8666666, 'f@gmail.com', 0, 0),
('7', 'Charlie', 239124, 'ch@gmail.com', 1, 0),
('7777777', 'Chandri', 87777777, 'g@gmail.com', 0, 0),
('8', 'Bima', 29312831, 'bim@gmail.com', 0, 1),
('8888888', 'Erwin', 8888888, 'h@gmail.com', 0, 0),
('9', 'Arjuna', 92315123, 'arj@gmail.com', 1, 0),
('99999999', 'Julid', 89999999, 'i@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemenang`
--

CREATE TABLE IF NOT EXISTS `pemenang` (
  `ID_PEMENANG` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PAKET` int(11) DEFAULT NULL,
  `NAMA_PERUSAHAAN` varchar(100) DEFAULT NULL,
  `NPWP` varchar(25) DEFAULT NULL,
  `ALAMAT` text,
  `PIC_PERUSAHAAN` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_PEMENANG`),
  KEY `FK_RELATIONSHIP_47` (`ID_PAKET`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan`
--

CREATE TABLE IF NOT EXISTS `penerimaan` (
  `ID_PENERIMAAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PAKET` int(11) DEFAULT NULL,
  `ID_ALAT` int(11) DEFAULT NULL,
  `ID_TIM_PENERIMA` int(11) DEFAULT NULL,
  `TANGGAL_PENERIMAAN` datetime DEFAULT NULL,
  `JUMLAH` decimal(8,0) DEFAULT NULL,
  `KETERANGAN` text,
  `STATUS_KONFIRMASI` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_PENERIMAAN`),
  KEY `FK_RELATIONSHIP_37` (`ID_PAKET`),
  KEY `FK_RELATIONSHIP_8` (`ID_TIM_PENERIMA`),
  KEY `FK_RELATIONSHIP_9` (`ID_ALAT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `progress_paket`
--

CREATE TABLE IF NOT EXISTS `progress_paket` (
  `ID_PROGRESS_PAKET` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PAKET` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_JENIS_USER` int(11) DEFAULT NULL,
  `ID_FASE` int(11) DEFAULT NULL,
  `ID_USULAN` int(11) DEFAULT NULL,
  `STATUS` decimal(8,0) DEFAULT NULL,
  `TANGGAL` datetime DEFAULT NULL,
  `REVISI_KE` decimal(8,0) DEFAULT NULL,
  PRIMARY KEY (`ID_PROGRESS_PAKET`),
  KEY `FK_RELATIONSHIP_12` (`ID_FASE`),
  KEY `FK_RELATIONSHIP_13` (`ID_USER`),
  KEY `FK_RELATIONSHIP_14` (`ID_PAKET`),
  KEY `FK_RELATIONSHIP_28` (`ID_USULAN`),
  KEY `FK_RELATIONSHIP_38` (`ID_JENIS_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `ID_REMINDER` int(11) NOT NULL,
  `ID_FASE` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `STATUS` decimal(8,0) DEFAULT NULL,
  PRIMARY KEY (`ID_REMINDER`),
  KEY `FK_RELATIONSHIP_43` (`ID_FASE`),
  KEY `FK_RELATIONSHIP_44` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_anggaran`
--

CREATE TABLE IF NOT EXISTS `tahun_anggaran` (
  `TAHUN_ANGGARAN` int(11) NOT NULL,
  `TANGGAL_MULAI` date DEFAULT NULL,
  PRIMARY KEY (`TAHUN_ANGGARAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim_hps`
--

CREATE TABLE IF NOT EXISTS `tim_hps` (
  `ID_TIM_HPS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) DEFAULT NULL,
  `NAMA_TIM` char(50) DEFAULT NULL,
  PRIMARY KEY (`ID_TIM_HPS`),
  KEY `FK_RELATIONSHIP_32` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim_penerima`
--

CREATE TABLE IF NOT EXISTS `tim_penerima` (
  `ID_TIM_PENERIMA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) DEFAULT NULL,
  `NAMA_TIM` char(50) DEFAULT NULL,
  PRIMARY KEY (`ID_TIM_PENERIMA`),
  KEY `FK_RELATIONSHIP_33` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_JENIS_USER` int(11) DEFAULT NULL,
  `ID_JURUSAN` int(11) DEFAULT NULL,
  `NIP` varchar(20) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`),
  KEY `FK_RELATIONSHIP_1` (`ID_JENIS_USER`),
  KEY `FK_RELATIONSHIP_23` (`ID_JURUSAN`),
  KEY `FK_RELATIONSHIP_31` (`NIP`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID_USER`, `ID_JENIS_USER`, `ID_JURUSAN`, `NIP`, `USERNAME`, `PASSWORD`) VALUES
(11, 1, 1, '11111111', 'TeknisiJTK', '5f4dcc3b5aa765d61d8327deb882cf99'),
(12, 2, 1, '2222222', 'KalabJTK', '5f4dcc3b5aa765d61d8327deb882cf99'),
(13, 3, 1, '3333333', 'KajurJTK', '5f4dcc3b5aa765d61d8327deb882cf99'),
(14, 3, 1, '10', 'Sekjur1JTK', '5f4dcc3b5aa765d61d8327deb882cf99'),
(15, 3, 1, '11', 'Sekjur2JTK', '5f4dcc3b5aa765d61d8327deb882cf99'),
(16, 1, 2, '7', 'TeknisiAN', '5f4dcc3b5aa765d61d8327deb882cf99'),
(17, 2, 2, '6', 'KalabAN', '5f4dcc3b5aa765d61d8327deb882cf99'),
(18, 3, 2, '8', 'KajurAN', '5f4dcc3b5aa765d61d8327deb882cf99'),
(19, 3, 2, '12', 'Sekjur1AN', '5f4dcc3b5aa765d61d8327deb882cf99'),
(20, 3, 2, '13', 'Sekjur2AN', '5f4dcc3b5aa765d61d8327deb882cf99'),
(21, 4, 0, '4444444', 'PD2', '5f4dcc3b5aa765d61d8327deb882cf99'),
(22, 5, 0, '555555', 'PPK', '5f4dcc3b5aa765d61d8327deb882cf99'),
(23, 6, 0, '66666', 'TimHPS', '5f4dcc3b5aa765d61d8327deb882cf99'),
(24, 7, 0, '7777777', 'ULP', '5f4dcc3b5aa765d61d8327deb882cf99'),
(25, 8, 0, '8888888', 'TimPenerima', '5f4dcc3b5aa765d61d8327deb882cf99'),
(26, 9, 0, '99999999', 'PPSPM', '5f4dcc3b5aa765d61d8327deb882cf99'),
(27, 10, 0, '101010101010', 'Direktur', '5f4dcc3b5aa765d61d8327deb882cf99'),
(28, 11, 0, '20', 'Adum', '5f4dcc3b5aa765d61d8327deb882cf99'),
(29, 99, 0, NULL, 'Admin', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usulan`
--

CREATE TABLE IF NOT EXISTS `usulan` (
  `ID_USULAN` int(11) NOT NULL AUTO_INCREMENT,
  `TAHUN_ANGGARAN` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_JURUSAN` int(11) DEFAULT NULL,
  `NAMA_PAKET` text,
  `STATUS` decimal(8,0) DEFAULT NULL,
  `TANGGAL_DIBUAT` datetime DEFAULT NULL,
  `TOTAL_ANGGARAN` bigint(20) DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_USULAN`),
  KEY `FK_RELATIONSHIP_27` (`ID_USER`),
  KEY `FK_RELATIONSHIP_30` (`ID_JURUSAN`),
  KEY `FK_RELATIONSHIP_45` (`TAHUN_ANGGARAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `FK_RELATIONSHIP_6` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_RELATIONSHIP_10` FOREIGN KEY (`ID_LOKASI`) REFERENCES `lokasi` (`ID_LOKASI`),
  ADD CONSTRAINT `FK_RELATIONSHIP_16` FOREIGN KEY (`ID_FASE`) REFERENCES `fase` (`ID_FASE`),
  ADD CONSTRAINT `FK_RELATIONSHIP_18` FOREIGN KEY (`ID_JURUSAN`) REFERENCES `jurusan` (`ID_JURUSAN`),
  ADD CONSTRAINT `FK_RELATIONSHIP_26` FOREIGN KEY (`ID_PAKET`) REFERENCES `paket` (`ID_PAKET`),
  ADD CONSTRAINT `FK_RELATIONSHIP_29` FOREIGN KEY (`ID_USULAN`) REFERENCES `usulan` (`ID_USULAN`),
  ADD CONSTRAINT `FK_RELATIONSHIP_36` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`);

--
-- Ketidakleluasaan untuk tabel `anggota_tim_hps`
--
ALTER TABLE `anggota_tim_hps`
  ADD CONSTRAINT `FK_RELATIONSHIP_42` FOREIGN KEY (`NIP`) REFERENCES `pegawai` (`NIP`),
  ADD CONSTRAINT `FK_RELATIONSHIP_41` FOREIGN KEY (`ID_TIM_HPS`) REFERENCES `tim_hps` (`ID_TIM_HPS`);

--
-- Ketidakleluasaan untuk tabel `anggota_tim_penerima`
--
ALTER TABLE `anggota_tim_penerima`
  ADD CONSTRAINT `FK_RELATIONSHIP_40` FOREIGN KEY (`NIP`) REFERENCES `pegawai` (`NIP`),
  ADD CONSTRAINT `FK_RELATIONSHIP_39` FOREIGN KEY (`ID_TIM_PENERIMA`) REFERENCES `tim_penerima` (`ID_TIM_PENERIMA`);

--
-- Ketidakleluasaan untuk tabel `bukti_pengadaan`
--
ALTER TABLE `bukti_pengadaan`
  ADD CONSTRAINT `FK_RELATIONSHIP_35` FOREIGN KEY (`ID_PAKET`) REFERENCES `paket` (`ID_PAKET`);

--
-- Ketidakleluasaan untuk tabel `kontrak`
--
ALTER TABLE `kontrak`
  ADD CONSTRAINT `FK_RELATIONSHIP_25` FOREIGN KEY (`ID_PAKET`) REFERENCES `paket` (`ID_PAKET`),
  ADD CONSTRAINT `FK_RELATIONSHIP_24` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Ketidakleluasaan untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD CONSTRAINT `FK_RELATIONSHIP_15` FOREIGN KEY (`ID_JURUSAN`) REFERENCES `jurusan` (`ID_JURUSAN`);

--
-- Ketidakleluasaan untuk tabel `pagu`
--
ALTER TABLE `pagu`
  ADD CONSTRAINT `FK_RELATIONSHIP_46` FOREIGN KEY (`TAHUN_ANGGARAN`) REFERENCES `tahun_anggaran` (`TAHUN_ANGGARAN`),
  ADD CONSTRAINT `FK_RELATIONSHIP_17` FOREIGN KEY (`ID_JURUSAN`) REFERENCES `jurusan` (`ID_JURUSAN`);

--
-- Ketidakleluasaan untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_REFERENCE_40` FOREIGN KEY (`TAHUN_ANGGARAN`) REFERENCES `tahun_anggaran` (`TAHUN_ANGGARAN`),
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ID_TIM_HPS`) REFERENCES `tim_hps` (`ID_TIM_HPS`);

--
-- Ketidakleluasaan untuk tabel `pemenang`
--
ALTER TABLE `pemenang`
  ADD CONSTRAINT `FK_RELATIONSHIP_47` FOREIGN KEY (`ID_PAKET`) REFERENCES `paket` (`ID_PAKET`);

--
-- Ketidakleluasaan untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `FK_RELATIONSHIP_9` FOREIGN KEY (`ID_ALAT`) REFERENCES `alat` (`ID_ALAT`),
  ADD CONSTRAINT `FK_RELATIONSHIP_37` FOREIGN KEY (`ID_PAKET`) REFERENCES `paket` (`ID_PAKET`),
  ADD CONSTRAINT `FK_RELATIONSHIP_8` FOREIGN KEY (`ID_TIM_PENERIMA`) REFERENCES `tim_penerima` (`ID_TIM_PENERIMA`);

--
-- Ketidakleluasaan untuk tabel `progress_paket`
--
ALTER TABLE `progress_paket`
  ADD CONSTRAINT `FK_RELATIONSHIP_38` FOREIGN KEY (`ID_JENIS_USER`) REFERENCES `jenis_user` (`ID_JENIS_USER`),
  ADD CONSTRAINT `FK_RELATIONSHIP_12` FOREIGN KEY (`ID_FASE`) REFERENCES `fase` (`ID_FASE`),
  ADD CONSTRAINT `FK_RELATIONSHIP_13` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_RELATIONSHIP_14` FOREIGN KEY (`ID_PAKET`) REFERENCES `paket` (`ID_PAKET`),
  ADD CONSTRAINT `FK_RELATIONSHIP_28` FOREIGN KEY (`ID_USULAN`) REFERENCES `usulan` (`ID_USULAN`);

--
-- Ketidakleluasaan untuk tabel `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `FK_RELATIONSHIP_44` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_RELATIONSHIP_43` FOREIGN KEY (`ID_FASE`) REFERENCES `fase` (`ID_FASE`);

--
-- Ketidakleluasaan untuk tabel `tim_hps`
--
ALTER TABLE `tim_hps`
  ADD CONSTRAINT `FK_RELATIONSHIP_32` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Ketidakleluasaan untuk tabel `tim_penerima`
--
ALTER TABLE `tim_penerima`
  ADD CONSTRAINT `FK_RELATIONSHIP_33` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_JENIS_USER`) REFERENCES `jenis_user` (`ID_JENIS_USER`),
  ADD CONSTRAINT `FK_RELATIONSHIP_23` FOREIGN KEY (`ID_JURUSAN`) REFERENCES `jurusan` (`ID_JURUSAN`),
  ADD CONSTRAINT `FK_RELATIONSHIP_31` FOREIGN KEY (`NIP`) REFERENCES `pegawai` (`NIP`);

--
-- Ketidakleluasaan untuk tabel `usulan`
--
ALTER TABLE `usulan`
  ADD CONSTRAINT `FK_RELATIONSHIP_45` FOREIGN KEY (`TAHUN_ANGGARAN`) REFERENCES `tahun_anggaran` (`TAHUN_ANGGARAN`),
  ADD CONSTRAINT `FK_RELATIONSHIP_27` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_RELATIONSHIP_30` FOREIGN KEY (`ID_JURUSAN`) REFERENCES `jurusan` (`ID_JURUSAN`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
