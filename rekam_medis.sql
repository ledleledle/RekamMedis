-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Apr 2020 pada 16.52
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `stok`, `harga`) VALUES
(1, 'parashitamol', 1000, 500),
(2, 'antibilotil', 10, 5000);

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
(2, 'ledle', 'admin', 'patrick star', 'dibawah batu no.3. bikini bottom', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_obat`
--

CREATE TABLE `riwayat_obat` (
  `id` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_obat` int(11) NOT NULL,
  `biaya_pengobatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat_penyakit`
--

INSERT INTO `riwayat_penyakit` (`id`, `id_pasien`, `penyakit`, `tgl`, `id_rawatinap`, `id_obat`, `biaya_pengobatan`) VALUES
(1, 1, 'Skizofrenia', '2020-03-01', 0, 0, 15000);

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
(4, 'Copere', NULL, NULL, '', 0, 666);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `foto_rotgen`
--
ALTER TABLE `foto_rotgen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pasien_2` (`id_pasien`);

--
-- Indeks untuk tabel `riwayat_rawatinap`
--
ALTER TABLE `riwayat_rawatinap`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruang_inap`
--
ALTER TABLE `ruang_inap`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pasien` (`id_pasien`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `foto_rotgen`
--
ALTER TABLE `foto_rotgen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `riwayat_rawatinap`
--
ALTER TABLE `riwayat_rawatinap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ruang_inap`
--
ALTER TABLE `ruang_inap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
