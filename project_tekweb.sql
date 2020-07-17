-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2020 at 01:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_tekweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `email`, `no_telp`, `status`) VALUES
(1, 'admin', 'admin', '$2y$10$6PDnriz0qIKkqWFOtsMjg.KtF.h8fv6qK11JaeM6vp7sEdr6CnenC', 'admin@admin.com', '081234567890', 0),
(3, 'jor', 'cyn', '$2y$10$RuC0peB1nWvARdZ27.qzweFPoLJ.3fYCt6Q/kcGxyJ7HXVmlrJG8S', 'aaa@gmail.com', '03114180135', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `cart_harga` int(11) DEFAULT NULL,
  `status_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `cart_harga`, `status_cart`, `id_user`, `id_produk`, `jumlah`) VALUES
(45, 36000000, 1, 1, 26, 2),
(46, 36000000, 1, 1, 26, 2),
(47, 18000000, 1, 1, 26, 1),
(48, 15000000, 1, 1, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Motherboard'),
(2, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `harga` int(30) NOT NULL,
  `stock` int(10) NOT NULL,
  `gambar0` varchar(255) NOT NULL,
  `gambar1` varchar(255) NOT NULL,
  `gambar2` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `id_kategori` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `merek`, `harga`, `stock`, `gambar0`, `gambar1`, `gambar2`, `deskripsi`, `id_kategori`) VALUES
(25, 'Laptop', 'ROG', 15000000, 19, 'Hydrangeas.jpg', 'Penguins.jpg', 'Jellyfish.jpg', 'murah', 1),
(26, 'Asus GL503', 'Asus', 18000000, 18, 'G14_wallpaper_1920x1080.jpg', 'GX_wallpaper_1920x1080.jpg', 'beiheng-guo-IAVVv6z3D6g-unsplash.jpg', 'Laptop orang sultan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` varchar(255) NOT NULL,
  `total_harga` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `total_harga`, `id_user`, `id_cart`) VALUES
(14, 'Fri, 26 Jun 2020 01:04:04 PM', '36000000', 1, 46),
(15, 'Fri, 26 Jun 2020 01:04:42 PM', '18000000', 1, 47),
(16, 'Fri, 26 Jun 2020 01:06:17 PM', '15000000', 1, 48);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `email`, `no_telp`) VALUES
(1, 'Kevin Jonathan', 'kevinjo', '$2y$10$5BXA3hjctCZy1UKpRd.x0eADJyZk8MO937qz9Ew/Dav4c8RlVqPKu', 'kevinjonathan@gmail.com', '081234567890'),
(2, 'jor', 'cyn', '$2y$10$QSo7YHnt1FqQVmd2O3Rnfe23LYmg0FnWoKhJDKRhHP734PPD7mnSO', 'aaa@gmail.com', '03114180135'),
(3, 'jordan', 'jordan', '$2y$10$sirQ4w0hxOnyKW4o4cbbc.cmBfb55hZqProDFEgDVG6X0wC0D6vpO', 'jordan@gmail.com', '081234567890'),
(4, 'Wong ganteng', 'ganteng', '$2y$10$Er7fE.KfUS48yd.y9Vrt4e2tpjaOFjnEZqNFCqdkg1hm7vLWHTWWi', 'wongganteng123@gmail.com', '081234567890'),
(5, 'Kevin R', 'kevinreynaldi28', '$2y$10$xnBC9QTls.vd/rmO9I2SO.lQWyLDIuLZS0eu.55Wc1R7zw4U8ZHy.', 'kevinreynaldi28@gmail.com', '081234567890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
