-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 06:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_film`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_nama`) VALUES
(3, 'Persahabatan'),
(4, 'Misteri'),
(5, 'Komedi'),
(6, 'Petualangan');

-- --------------------------------------------------------

--
-- Table structure for table `kartun`
--

CREATE TABLE `kartun` (
  `kartun_id` int(11) NOT NULL,
  `kartun_foto` varchar(255) DEFAULT NULL,
  `kartun_nama` varchar(255) DEFAULT NULL,
  `kartun_tahunRilis` int(5) DEFAULT NULL,
  `produksi_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kartun`
--

INSERT INTO `kartun` (`kartun_id`, `kartun_foto`, `kartun_nama`, `kartun_tahunRilis`, `produksi_id`, `genre_id`) VALUES
(1, 'bighero6.jpg', 'Big Hero 6', 2014, 2, 6),
(2, 'insideout.jpg', 'Inside Out', 2015, 1, 5),
(3, 'moana.jpeg', 'Moana', 2016, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `produksi_id` int(11) NOT NULL,
  `produksi_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`produksi_id`, `produksi_nama`) VALUES
(1, 'Pixar'),
(2, 'Disney');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `kartun`
--
ALTER TABLE `kartun`
  ADD PRIMARY KEY (`kartun_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `produksi_id` (`produksi_id`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`produksi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kartun`
--
ALTER TABLE `kartun`
  MODIFY `kartun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kartun`
--
ALTER TABLE `kartun`
  ADD CONSTRAINT `genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`),
  ADD CONSTRAINT `produksi_id` FOREIGN KEY (`produksi_id`) REFERENCES `produksi` (`produksi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
