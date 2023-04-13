-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 03:15 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidsgamesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authenticator`
--

CREATE TABLE `authenticator` (
  `passCode` varchar(255) NOT NULL,
  `registrationOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authenticator`
--

INSERT INTO `authenticator` (`passCode`, `registrationOrder`) VALUES
('$2y$10$fxMTc4KD4mZlj03wc4grTuVLssP0ZKxeqfcfvxVx2xnrrKF.CKsk.', 1),
('$2y$10$AH/612QosAUyKIy5s4lEBuGdNAhnw.PbHYfIuLNK2aHQXWRMIF6fi', 2),
('$2y$10$rSNEZ5wd8YyRRlNCmwfb2uUvkffrAMdmLkcm5s.b7WAgiGy8UoA1i', 3),
('JDJ5JDEyJGJFbXZOSWIwS1FPSTVVNzM4RjJ2b3VITVBRMTRob3Q5Wnk0endoRi5PSlBjV2kwSGVZWWJT', 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `history`
-- (See below for the actual view)
--
CREATE TABLE `history` (
`scoreTime` datetime
,`id` varchar(200)
,`fName` varchar(50)
,`lName` varchar(50)
,`result` enum('success','failure','incomplete')
,`livesUsed` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `registrationTime` datetime NOT NULL,
  `id` varchar(200) GENERATED ALWAYS AS (concat(ucase(left(`fName`,2)),ucase(left(`lName`,2)),ucase(left(`userName`,3)),cast(`registrationTime` as signed))) VIRTUAL,
  `registrationOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`fName`, `lName`, `userName`, `registrationTime`, `registrationOrder`) VALUES
('Patrick', 'Saint-Louis', 'sonic12345', '2023-04-13 09:10:22', 1),
('Marie', 'Jourdain', 'asterix2023', '2023-04-13 09:10:22', 2),
('Jonathan', 'David', 'pokemon527', '2023-04-13 09:10:22', 3),
('Eraste', 'Boko', 'Rastecov', '2023-04-13 15:12:28', 4);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `scoreTime` datetime NOT NULL,
  `result` enum('success','failure','incomplete') DEFAULT NULL,
  `livesUsed` int(11) NOT NULL,
  `registrationOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`scoreTime`, `result`, `livesUsed`, `registrationOrder`) VALUES
('2023-04-13 09:11:13', 'success', 4, 1),
('2023-04-13 09:11:13', 'failure', 6, 2),
('2023-04-13 09:11:13', 'incomplete', 5, 3);

-- --------------------------------------------------------

--
-- Structure for view `history`
--
DROP TABLE IF EXISTS `history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `history`  AS SELECT `s`.`scoreTime` AS `scoreTime`, `p`.`id` AS `id`, `p`.`fName` AS `fName`, `p`.`lName` AS `lName`, `s`.`result` AS `result`, `s`.`livesUsed` AS `livesUsed` FROM (`player` `p` join `score` `s`) WHERE `p`.`registrationOrder` = `s`.`registrationOrder``registrationOrder`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authenticator`
--
ALTER TABLE `authenticator`
  ADD KEY `registrationOrder` (`registrationOrder`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`registrationOrder`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD KEY `registrationOrder` (`registrationOrder`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `registrationOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authenticator`
--
ALTER TABLE `authenticator`
  ADD CONSTRAINT `authenticator_ibfk_1` FOREIGN KEY (`registrationOrder`) REFERENCES `player` (`registrationOrder`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`registrationOrder`) REFERENCES `player` (`registrationOrder`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
