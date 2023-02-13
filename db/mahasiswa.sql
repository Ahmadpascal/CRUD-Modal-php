-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Feb 2023 pada 03.53
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `Id` int(11) NOT NULL,
  `nrp` char(9) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `jurusan` varchar(250) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`Id`, `nrp`, `nama`, `email`, `jurusan`, `gambar`) VALUES
(1, '220103082', 'ahmad anjari', 'anjariah76252@gmail.com', 'Teknik Informatika', 'ahmad.jpg'),
(2, '220103083', 'sidiq dwi p', 'sidiq@gmail.com', 'teknik mesin', 'sidiq.jpg'),
(3, '220103086', 'kevin rafael', 'kevinrafel53@gmail.com', 'teknik informatika', 'kevin.jpg'),
(4, '220103087', 'farhan rasyad', 'farhan@gmail.com', 'pendidikan otomotif', 'farhan.jpg'),
(5, '220103089', 'iskandar muda', 'iskandar@gmail.com', 'teknik pertambangan', 'iskandar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
