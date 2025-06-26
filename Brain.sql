-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 05:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-
-- Database: `patient`
--
CREATE DATABASE IF NOT EXISTS `patient` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `patient`;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `PATIENT_ID` int(11) NOT NULL,
  `FULL_NAME` varchar(20) NOT NULL,
  `DATE_OF_BIRTH` date NOT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `PASS_WORD` varchar(255) NOT NULL,
  `MOBILE_NUMBER` varchar(10) NOT NULL,
  `Gender` enum('Male','Female','Others') NOT NULL,
  `BLOOD_GROUP` enum('A+ve','B+ve','O+ve','A-ve','B-ve','O-ve','AB+ve','AB-ve') NOT NULL,
  `OCCUPATION` varchar(10) NOT NULL,
  `REGISTERED_TIME` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`PATIENT_ID`, `FULL_NAME`, `DATE_OF_BIRTH`, `EMAIL`, `PASS_WORD`, `MOBILE_NUMBER`, `Gender`, `BLOOD_GROUP`, `OCCUPATION`, `REGISTERED_TIME`) VALUES
(1, 'ABC', '1989-11-05', 'vk@gmail.com', '1234', '0911121416', 'Male', 'A+ve', 'Proffesion', '2024-07-09 06:54:23'),
(3, 'DEF', '2024-07-09', 'abc@gmail.com', '1234', '9090989897', 'Male', 'O+ve', 'Proffesion', '2024-07-09 07:30:32'),
(4, 'XYZ', '2024-07-11', 'xyz@gmail.com', '$2y$10$vPESx68mhZPakO6A9uWaveLEx9KgR242aT5YIxsVuZ.Bc2rRYiHFK', '9090707060', 'Male', 'A+ve', 'Proffesion', '2024-07-09 09:06:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`PATIENT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `PATIENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
