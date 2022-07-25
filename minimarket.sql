-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2022 pada 10.36
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minimarket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `masterbarang`
--

CREATE TABLE `masterbarang` (
  `barang_id` int(11) NOT NULL,
  `barang_nama` varchar(255) NOT NULL,
  `barang_harga_beli` int(11) NOT NULL,
  `barang_harga_jual` int(11) NOT NULL,
  `barang_jumlah` int(11) NOT NULL,
  `suplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masterbarang`
--

INSERT INTO `masterbarang` (`barang_id`, `barang_nama`, `barang_harga_beli`, `barang_harga_jual`, `barang_jumlah`, `suplier_id`) VALUES
(4, 'Pepsodent 350 gr', 9000, 10000, 50, 1),
(5, 'Bimoli 2L', 25000, 28000, 50, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mastersuplier`
--

CREATE TABLE `mastersuplier` (
  `suplier_id` int(11) NOT NULL,
  `suplier_nama` varchar(255) NOT NULL,
  `suplier_alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mastersuplier`
--

INSERT INTO `mastersuplier` (`suplier_id`, `suplier_nama`, `suplier_alamat`) VALUES
(1, 'sembako barokah', 'Jln.Abdul Karim No.15, Pepe, Sedati, Sidoarjo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_transaksi`
--

CREATE TABLE `tmp_transaksi` (
  `tmp_transaksi_id` int(11) NOT NULL,
  `tmp_transaksi_tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_transaksi_detail`
--

CREATE TABLE `tmp_transaksi_detail` (
  `tmp_transaksi_detail_id` int(11) NOT NULL,
  `tmp_transaksi_detail_barang` varchar(255) NOT NULL,
  `tmp_transaksi_detail_jumlah` int(11) NOT NULL,
  `tmp_transaksi_detail_harga` int(11) NOT NULL,
  `tmp_transaksi_detail_subtotal` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_detail_id` int(11) NOT NULL,
  `transaksi_detail_barang` varchar(255) NOT NULL,
  `transaksi_detail_jumlah` int(11) NOT NULL,
  `transaksi_detail_harga` int(11) NOT NULL,
  `transaksi_detail_subtotal` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `masterbarang`
--
ALTER TABLE `masterbarang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indeks untuk tabel `mastersuplier`
--
ALTER TABLE `mastersuplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indeks untuk tabel `tmp_transaksi`
--
ALTER TABLE `tmp_transaksi`
  ADD PRIMARY KEY (`tmp_transaksi_id`);

--
-- Indeks untuk tabel `tmp_transaksi_detail`
--
ALTER TABLE `tmp_transaksi_detail`
  ADD PRIMARY KEY (`tmp_transaksi_detail_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_detail_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `masterbarang`
--
ALTER TABLE `masterbarang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `mastersuplier`
--
ALTER TABLE `mastersuplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tmp_transaksi`
--
ALTER TABLE `tmp_transaksi`
  MODIFY `tmp_transaksi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tmp_transaksi_detail`
--
ALTER TABLE `tmp_transaksi_detail`
  MODIFY `tmp_transaksi_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `transaksi_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
