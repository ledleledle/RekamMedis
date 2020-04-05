-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 05 Apr 2020 pada 19.07
-- Versi Server: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekam_medis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_rotgen`
--

CREATE TABLE `foto_rotgen` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `directory` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(300) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `tgl_lahir` varchar(200) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `berat_badan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `nama_pasien`, `tgl_lahir`, `tinggi_badan`, `berat_badan`) VALUES
(1, 'Joker India', '1998-03-04', 120, 30),
(3, 'leon prasetya mulya', '1998-08-04', 168, 46),
(4, 'Selly Shelly', '2019-11-26', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `alamat` varchar(360) NOT NULL,
  `pekerjaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `username`, `password`, `nama_pegawai`, `alamat`, `pekerjaan`) VALUES
(1, 'leon', 'admin', 'leon prasetya mulya', 'No.19 sumbergedong, trenggalek', 2),
(2, 'ledle', 'admin', 'patrick star', 'dibawah batu no.3. bikini bottom', 1),
(3, 'ananan', 'anjing', 'tolol', 'lo semua ngentod', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_penyakit`
--

CREATE TABLE `riwayat_penyakit` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `penyakit` varchar(300) NOT NULL,
  `tgl` varchar(200) NOT NULL,
  `id_rawatinap` int(11) NOT NULL,
  `biaya_pengobatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat_penyakit`
--

INSERT INTO `riwayat_penyakit` (`id`, `id_pasien`, `penyakit`, `tgl`, `id_rawatinap`, `biaya_pengobatan`) VALUES
(1, 1, 'Skizofrenia', '2020-03-01', 0, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_rawatinap`
--

CREATE TABLE `riwayat_rawatinap` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `tgl_masuk` varchar(200) NOT NULL,
  `tgl_keluar` varchar(200) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang_inap`
--

CREATE TABLE `ruang_inap` (
  `id` int(11) NOT NULL,
  `nama_ruang` varchar(200) NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `tgl_masuk` varchar(200) DEFAULT NULL,
  `jam_masuk` varchar(100) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruang_inap`
--

INSERT INTO `ruang_inap` (`id`, `nama_ruang`, `id_pasien`, `tgl_masuk`, `jam_masuk`, `status`, `biaya`) VALUES
(1, 'Melati', NULL, NULL, '', 0, 900000),
(2, 'Mawar', 1, '2020-03-20', '03:21:00', 1, 600000),
(3, 'Coper', NULL, NULL, '', 2, 400000),
(4, 'Copere', NULL, NULL, '', 0, 666),
(5, 'aiiih', NULL, NULL, '', 0, 40000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto_rotgen`
--
ALTER TABLE `foto_rotgen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pasien_2` (`id_pasien`);

--
-- Indexes for table `riwayat_rawatinap`
--
ALTER TABLE `riwayat_rawatinap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruang_inap`
--
ALTER TABLE `ruang_inap`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pasien` (`id_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto_rotgen`
--
ALTER TABLE `foto_rotgen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `riwayat_rawatinap`
--
ALTER TABLE `riwayat_rawatinap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ruang_inap`
--
ALTER TABLE `ruang_inap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
