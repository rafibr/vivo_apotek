-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 12:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek2`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(100) NOT NULL,
  `nama_operator` varchar(100) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `jumlah_sisa` int(11) NOT NULL DEFAULT 0,
  `kode_pelanggan` varchar(255) DEFAULT NULL,
  `tujuan` varchar(100) NOT NULL,
  `harga_barang` int(11) NOT NULL DEFAULT 0,
  `sub_total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `kode_transaksi`, `nama_operator`, `tanggal`, `kode_barang`, `nama_barang`, `jumlah`, `jumlah_sisa`, `kode_pelanggan`, `tujuan`, `harga_barang`, `sub_total`) VALUES
(1, 'TRK-0822001', 'Anti Roviana Dewi', '2022-08-10', 'BAR-0822001', 'Bisolvoncair', '2', 2, 'PEL-0822001', 'Anton', 10000, 20000),
(2, 'TRK-0822002', 'Anti Roviana Dewi', '2022-08-10', 'BAR-0822001', 'Bisolvoncair', '4', 4, 'PEL-0822001', 'Anton', 10000, 40000),
(3, 'TRK-0822003', 'Anti Roviana Dewi', '2022-08-10', 'BAR-0822001', 'Bisolvoncair', '4', 4, 'PEL-0822001', 'Anton', 10000, 40000),
(6, 'TRK-0822004', 'Anti Roviana Dewi', '2022-08-10', 'BAR-0822001', 'Bisolvoncair', '31', 31, 'PEL-0822001', 'Anton', 10000, 310000);

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `barang_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
	UPDATE gudang SET jumlah = jumlah-new.jumlah
    WHERE kode_barang=new.kode_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(100) NOT NULL,
  `nama_operator` varchar(100) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kode_supplier` varchar(100) DEFAULT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `jumlah_sisa` int(11) NOT NULL DEFAULT 0,
  `harga_barang` int(11) NOT NULL DEFAULT 0,
  `sub_total` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `kode_transaksi`, `nama_operator`, `tanggal`, `kode_barang`, `nama_barang`, `kode_supplier`, `nama_supplier`, `jumlah`, `jumlah_sisa`, `harga_barang`, `sub_total`) VALUES
(2, 'TRM-0822001', 'Anti Roviana Dewi', '2022-08-10', 'BAR-0822001', 'Bisolvoncair', 'SUP-0822001', 'Kimia Farma', '20', -35, 10000, 200000),
(6, 'TRM-0822003', 'Anti Roviana Dewi', '2022-08-10', 'BAR-0822001', 'Bisolvoncair', 'SUP-0822001', 'Kimia Farma', '2', 0, 10000, 20000),
(7, 'TRM-0822007', 'Anti Roviana Dewi', '2022-08-10', 'BAR-0822001', 'Bisolvoncair', 'SUP-0822001', 'Kimia Farma', '5', -26, 10000, 50000);

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE gudang SET jumlah = jumlah+new.jumlah
    WHERE kode_barang=new.kode_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_jenis` varchar(100) NOT NULL,
  `jumlah` varchar(250) NOT NULL DEFAULT '0',
  `stok_awal` int(11) NOT NULL DEFAULT 0,
  `exp_date` date DEFAULT NULL,
  `harga_beli` int(11) DEFAULT 0,
  `harga_jual` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `kode_barang`, `nama_barang`, `id_jenis`, `jumlah`, `stok_awal`, `exp_date`, `harga_beli`, `harga_jual`) VALUES
(1, 'BAR-0822001', 'Bisolvon cair', '1', '21', 20, '2022-08-10', 10000, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `jenis_barang`) VALUES
(1, 'Obat cair'),
(2, 'Obat tablet');

-- --------------------------------------------------------

--
-- Table structure for table `log_transaksi`
--

CREATE TABLE `log_transaksi` (
  `id` int(11) NOT NULL,
  `kode_log` varchar(255) NOT NULL,
  `kode_transaksi` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `keterangan` enum('keluar','masuk') NOT NULL DEFAULT 'keluar',
  `barang_diproses` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL DEFAULT 0,
  `harga_total` int(11) NOT NULL DEFAULT 0,
  `barang_sekarang` int(11) NOT NULL DEFAULT 0,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_transaksi`
--

INSERT INTO `log_transaksi` (`id`, `kode_log`, `kode_transaksi`, `kode_barang`, `keterangan`, `barang_diproses`, `harga_satuan`, `harga_total`, `barang_sekarang`, `tanggal`) VALUES
(1, 'LOG-0822001', 'TRM-0822001', 'BAR-0822001', 'masuk', 10, 10000, 100000, 10, '2022-08-10 06:18:44'),
(2, 'LOG-0822002', 'TRM-0822001', 'BAR-0822001', 'masuk', 20, 10000, 200000, 20, '2022-08-10 06:19:46'),
(3, 'LOG-0822003', 'TRM-0822001', 'BAR-0822001', 'masuk', 2, 10000, 20000, 2, '2022-08-10 06:22:40'),
(4, 'LOG-0822004', 'TRM-0822001', 'BAR-0822001', 'masuk', 2, 10000, 20000, 2, '2022-08-10 06:23:02'),
(5, 'LOG-0822005', 'TRM-0822001', 'BAR-0822001', 'masuk', 3, 10000, 30000, 3, '2022-08-10 06:24:23'),
(6, 'LOG-0822002', 'TRK-0822001', 'BAR-0822001', 'keluar', 2, 10000, 20000, 20, '2022-08-10 06:26:36'),
(7, 'LOG-0822002', 'TRK-0822002', 'BAR-0822001', 'keluar', 4, 10000, 40000, 18, '2022-08-10 06:26:59'),
(8, 'LOG-0822002', 'TRK-0822003', 'BAR-0822001', 'keluar', 4, 10000, 40000, 14, '2022-08-10 06:27:58'),
(9, 'LOG-0822002', 'TRK-0822004', 'BAR-0822001', 'keluar', 45, 10000, 450000, 10, '2022-08-10 06:29:34'),
(10, 'LOG-08220010', 'TRM-0822003', 'BAR-0822001', 'masuk', 2, 10000, 20000, 2, '2022-08-10 06:30:00'),
(11, 'LOG-08220011', 'TRM-0822007', 'BAR-0822001', 'masuk', 5, 10000, 50000, 5, '2022-08-10 06:33:40'),
(12, 'LOG-0822006', 'TRK-0822004', 'BAR-0822001', 'keluar', 2, 10000, 20000, 2, '2022-08-10 06:35:34'),
(13, 'LOG-0822007', 'TRK-0822004', 'BAR-0822001', 'keluar', 31, 10000, 310000, 5, '2022-08-10 06:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) NOT NULL,
  `kode_pelanggan` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telpon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id`, `kode_pelanggan`, `nama_pelanggan`, `alamat`, `telpon`) VALUES
(1, 'PEL-0822001', 'Anton', 'Banjarmasin', '120139');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` int(11) NOT NULL,
  `kode_supplier` varchar(100) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id`, `kode_supplier`, `nama_supplier`, `alamat`, `telepon`) VALUES
(1, 'SUP-0822001', 'Kimia Farma', 'jakarta', '10202020');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(25) NOT NULL DEFAULT 'member',
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `nama`, `alamat`, `telepon`, `username`, `password`, `level`, `foto`) VALUES
(26, '1000100000', 'Anti Roviana Dewi', '', '08999444000', 'superadmin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 'ard.jpg'),
(27, '1000200000', 'Penjualan', '', '0986660000', 'penjualan', '21232f297a57a5a743894a0e4a801fc3', 'penjualan', 'IMG-20220717-WA0043.jpg'),
(34, '1000200000', 'Persediaan', '', '0986660000', 'persediaan', '21232f297a57a5a743894a0e4a801fc3', 'persediaan', 'IMG-20220717-WA0043.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
