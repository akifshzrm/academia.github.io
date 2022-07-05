-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2022 at 10:34 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academia`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quote` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_content` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `title`, `quote`, `content`, `date_content`) VALUES
(1, 'Contact', '', 'Academia, Sukapura, Dayeuhkolot, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40257, Indonesia<br>', '2022-07-04 20:22:36'),
(2, 'Academia', '', '“Learning is not attained by chance, it must be sought for with ardour and attended to with diligence.”<br>', '2022-07-04 20:20:58'),
(3, 'About', '', '<p>Academia is an online course platform.</p>', '2022-07-04 20:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `status` text NOT NULL,
  `token_change_password` text DEFAULT NULL,
  `date_reg` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `full_name`, `password`, `status`, `token_change_password`, `date_reg`) VALUES
(1, 'nikakifdanis@gmail.com', 'Akif', 'e10adc3949ba59abbe56e057f20f883e', '1', '', '2022-07-04 13:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quote` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_content` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `quote`, `content`, `date_content`) VALUES
(8, 'Learning Never Exhausts The Mind', '#learnwithoutlimits', '<p><img src=\"../images/1385974ed5904a438616ff7bdb3f7439.png\" style=\"width: 554px;\"><b><i>Advance your learning strategies without worries with Academia. Academia is an online learning platform that offers various courses that teach by expert tutors.</i></b><br></p>', '2022-07-04 20:10:05'),
(9, 'Online Courses Now', 'Pick your own', '<p><i style=\"color: rgb(28, 29, 31); font-family: var(--bs-font-sans-serif); font-size: 1rem;\"><b>Choose from 100 online video courses with new additions published every month.</b></i></p><p><img src=\"../images/7ef605fc8dba5425d6965fbd4c8fbe1f.png\" style=\"width: 554px; float: right;\" class=\"note-float-right\"><i style=\"color: rgb(28, 29, 31); font-family: var(--bs-font-sans-serif); font-size: 1rem;\"><b><br></b></i><br></p>', '2022-07-04 20:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photos` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_content` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `photos`, `content`, `date_content`) VALUES
(1, 'TELKOM', 'partners_1655840646_MC06j95i_400x400.png', '<p>TELKOM</p>', '2022-06-21 19:44:06'),
(2, 'MANCHESTER', 'partners_1655840763_University_logo_centered_justified_300x300.png', '<p>MANCHESTER</p>', '2022-06-21 19:46:03'),
(3, 'UMP', 'partners_1655840777_universiti_malaysia_pahang_badge.png', '<p>UMP</p>', '2022-06-21 19:46:17'),
(5, 'TORONTO', 'partners_1655840821_Utoronto_coa.svg.png', '<p>TORONTO</p>', '2022-06-21 19:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photos` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_content` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `name`, `photos`, `content`, `date_content`) VALUES
(2, 'Akif', 'tutors_1656963753_akif.jpg', '<p><b><i>Nik Akif Danis bin Sahazerim</i></b></p>', '2022-07-04 19:42:33'),
(4, 'Syaza', 'tutors_1656963676_syaza.jpg', '<p><b><i>Nur Sabrina Syaza binti Zahar Hisham</i></b></p>', '2022-07-04 19:41:16'),
(5, 'Fasihah', 'tutors_1656963638_fasihah.jpg', '<p><b><i>Nur Fasihah Ayuni binti Mohd Yahya</i></b></p>', '2022-07-04 19:40:38'),
(6, 'Fahmi', 'tutors_1656963612_fahmi.jpg', '<p><b><i>Muhammad Zulfahmi bin Mohd Yunos</i></b></p>', '2022-07-04 19:40:12'),
(7, 'Nadia', 'tutors_1656963577_nadia.jpg', '<p><i><b>Nur Nadia Syakirah binti Mohd Sauki</b></i></p>', '2022-07-04 19:39:37'),
(8, 'Iman', 'tutors_1656963731_iman.jpg', '<p><b><i>Nurul Iman binti Nordin</i></b></p>', '2022-07-04 19:42:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
