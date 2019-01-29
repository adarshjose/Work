-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 07:16 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adarsh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie_cat_rel`
--

CREATE TABLE `movie_cat_rel` (
  `movie_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_cat_rel`
--

INSERT INTO `movie_cat_rel` (`movie_id`, `cat_id`) VALUES
(8, 1),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pn_admin`
--

CREATE TABLE `pn_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) DEFAULT NULL,
  `admin_pass` varchar(50) DEFAULT NULL,
  `admin_email` varchar(60) DEFAULT NULL,
  `admin_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pn_admin`
--

INSERT INTO `pn_admin` (`admin_id`, `admin_name`, `admin_pass`, `admin_email`, `admin_status`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'active'),
(2, 'Adarsh', 'adarsh', 'adarsh@gmail.com', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `pn_category`
--

CREATE TABLE `pn_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) DEFAULT NULL,
  `cat_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pn_category`
--

INSERT INTO `pn_category` (`cat_id`, `cat_name`, `cat_status`) VALUES
(1, 'Adventure', 'active'),
(2, 'Horror', 'active'),
(3, 'Action', 'active'),
(4, 'Family', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `pn_movie`
--

CREATE TABLE `pn_movie` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(60) DEFAULT NULL,
  `movie_desc` text,
  `movie_url` varchar(100) DEFAULT NULL,
  `movie_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pn_movie`
--

INSERT INTO `pn_movie` (`movie_id`, `movie_name`, `movie_desc`, `movie_url`, `movie_status`) VALUES
(1, '2.O', '2.0 is a 2018 Indian Tamil-language science fiction action film[3][7] written and directed by S. Shankar.', 'https://www.youtube.com/embed/_qOl_7qfPOM', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `pn_movie_crew`
--

CREATE TABLE `pn_movie_crew` (
  `crew_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL DEFAULT '0',
  `crew_name` varchar(50) DEFAULT NULL,
  `crew_type` int(11) NOT NULL DEFAULT '0',
  `crew_image` varchar(60) DEFAULT NULL,
  `crew_img_data` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pn_movie_crew`
--

INSERT INTO `pn_movie_crew` (`crew_id`, `movie_id`, `crew_name`, `crew_type`, `crew_image`, `crew_img_data`) VALUES
(3, 8, 'Rajinikanth', 1, '‰PNG\n\Z\n\0\0\0\nIHDR\0\0\0å\0\0\0\0\0‡kb6\0\0\0	pHYs\0\0\0\0\0šœ\0\0\nOiC', NULL),
(4, 8, '	Shankar', 2, '‰PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0\0\0\0\0\0\0ôxÔú\0\0YPIDATxÚíÝ	|\\e½ÿñ´™4Ó4¦:', NULL),
(5, 8, 'ryrt', 0, '‰PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0á\0\0\0á\0\0\0	m"H\0\0\0	pHYs\0\0\0\0\0šœ\0\0\nOiC', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pn_admin`
--
ALTER TABLE `pn_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `pn_category`
--
ALTER TABLE `pn_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `pn_movie`
--
ALTER TABLE `pn_movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `pn_movie_crew`
--
ALTER TABLE `pn_movie_crew`
  ADD PRIMARY KEY (`crew_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pn_admin`
--
ALTER TABLE `pn_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pn_category`
--
ALTER TABLE `pn_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pn_movie`
--
ALTER TABLE `pn_movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pn_movie_crew`
--
ALTER TABLE `pn_movie_crew`
  MODIFY `crew_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
