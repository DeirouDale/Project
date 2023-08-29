-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 05:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `student_number` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `platform` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `profile`, `student_number`, `first_name`, `last_name`, `course`, `platform`) VALUES
(155, 32, '341254814_224937790222293_5652218934724462962_n.jpg', '20-12334', 'Selwyne', 'Ponce', 'BS in Computer Engineering', 'dsafdsaf'),
(156, 33, '149674405_1015820682243528_7983130344207149549_n.jpg', '20-12334', 'Joshua', 'Abellano', 'BS in Electrical Engineering', 'sadfsfda'),
(157, 34, '340290191_955203845632288_1873519190156857035_n.jpg', '20-234567', 'Kenric', 'Catiwa', 'BS in Civil Engineering', 'dsafdsaf');

-- --------------------------------------------------------

--
-- Table structure for table `election_state`
--

CREATE TABLE `election_state` (
  `id` int(11) NOT NULL,
  `state` varchar(11) NOT NULL,
  `btn_class` varchar(11) NOT NULL,
  `btn_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `election_state`
--

INSERT INTO `election_state` (`id`, `state`, `btn_class`, `btn_name`) VALUES
(1, 'open', 'closebtn', 'closebtn');

-- --------------------------------------------------------

--
-- Table structure for table `election_title`
--

CREATE TABLE `election_title` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `election_title`
--

INSERT INTO `election_title` (`id`, `title`) VALUES
(1, 'COE Student Council');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `position` varchar(150) NOT NULL,
  `columnName` varchar(50) NOT NULL,
  `label` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position`, `columnName`, `label`) VALUES
(32, 'President', 'President', 'General'),
(33, 'First Year Representative', 'FirstYearRepresentative', '1'),
(34, 'Third Year Representative', 'ThirdYearRepresentative', '3');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `t_votes` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `position`, `name`, `t_votes`) VALUES
(155, 'President', 'Selwyne Ponce', '1'),
(156, 'First Year Representative', 'Joshua Abellano', '0'),
(157, 'Third Year Representative', 'Kenric Catiwa', '0');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `student_number` varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `course` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  `password` varchar(15) NOT NULL,
  `voted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `first_name`, `last_name`, `student_number`, `course`, `year_level`, `password`, `voted`) VALUES
(1, 'CHYRA ', 'ACOSTA', '20-051113', 'BS in Computer Engineering', 3, 'lllljenDHp', 'Yes'),
(2, 'JUSTINE PSALM', 'ACOSTA', '20-051100', 'BS in Computer Engineering', 3, 'XFLHCWIIFO', 'No'),
(3, 'RYAN ANTHONY GABRIEL', 'ADAMANA', '20-051246', 'BS in Computer Engineering', 3, 'w30TZD5wXO', 'No'),
(4, 'ADRIAN ', 'ADAYA', '20-051119', 'BS in Computer Engineering', 3, 'F0x2kpnxWG', 'No'),
(5, ' RHYAN JHAMES', 'AGCAOILI', '20-051109', 'BS in Computer Engineering', 3, 'PtjjcjQndw', 'No'),
(6, 'ISMAEL ', 'AY-AY', '20-051127', 'BS in Computer Engineering', 3, '9PqAZzSvWS', 'No'),
(7, 'JOSEPH VICTOR', 'BARENG', '20-050029', 'BS in Computer Engineering', 3, 'mLcKhy1n4n', 'No'),
(8, 'LJAN ROSS', 'BUTIN', '20-050982', 'BS in Computer Engineering', 3, '0dZ2JFGTxN', 'No'),
(9, 'IAN ', 'CABALLERO', '20-050062', 'BS in Computer Engineering', 3, 'dber99eA81', 'No'),
(10, 'ROVEL HAROLD PAUL', 'CABATIC', '20-051094', 'BS in Computer Engineering', 3, 'gsJ44A2law', 'No'),
(11, 'ANDRA CAMILLE', 'CAGAT', '20-051117', 'BS in Computer Engineering', 3, '84irhdWCw7', 'No'),
(12, ' KENRIC', 'CATIWA', '20-050123', 'BS in Computer Engineering', 3, '0q4ygoinUq', 'No'),
(13, 'STEFFI RAE', 'ERICE', '20-051114', 'BS in Computer Engineering', 3, '9RgamIrStn', 'No'),
(14, 'REGINA JANE', 'GARNACE', '20-051116', 'BS in Computer Engineering', 3, 'Hijmakn1g5', 'No'),
(15, 'JASMIN ', 'GENOVEA', '20-050237', 'BS in Computer Engineering', 3, 'kVhmyn2K2B', 'No'),
(16, 'JOHN EMAN', 'LIBED', '20-051237', 'BS in Computer Engineering', 3, 'rtTbrfO8U5', 'No'),
(17, 'DAVE', 'LORENZO', '20-050182', 'BS in Computer Engineering', 3, 'YYx1fGk80f', 'No'),
(18, 'MARIA RUEDEN', 'MANGAOIL', '20-051120', 'BS in Computer Engineering', 3, 'nDP2syIwxY', 'No'),
(19, 'VINCENT ', 'MORATAL', '20-050063', 'BS in Computer Engineering', 3, 'hI1CI51vUf', 'No'),
(20, 'DHEZERIEH', 'PADILLA', '20-051025', 'BS in Computer Engineering', 3, '2bcCvb9gY0', 'No'),
(21, ' JOHN ISA', 'PALACIO', '20-050978', 'BS in Computer Engineering', 3, 'bv6FR3zY5v', 'No'),
(22, 'DIDREY NICOLE', 'PALALAY', '20-050034', 'BS in Computer Engineering', 3, 'NLk9IPowU2', 'No'),
(23, 'DALE', 'PANGANIBAN', '20-051012', 'BS in Computer Engineering', 3, 'PlQ3Jamy58', 'No'),
(24, 'ELDWIN JANLORD', 'PASION', '20-051017', 'BS in Computer Engineering', 3, '5khP6PdC4H', 'No'),
(25, 'MC KEVIN', 'PAULINO', '20-051122', 'BS in Computer Engineering', 3, 'nKH6yhss1h', 'No'),
(26, 'DEXTER JOHN', 'PERDIDO', '20-051092', 'BS in Computer Engineering', 3, 'ye4WXOZ38C', 'No'),
(27, 'SELWYNE CHRISTIAN', 'PONCE', '20-050146', 'BS in Computer Engineering', 3, 'tRAlmkptXA', 'No'),
(28, 'CARL DAVEN', 'QUIMOYOG', '20-051236', 'BS in Computer Engineering', 3, 'IgH6VqHjRe', 'No'),
(29, 'EUGENE VHER', 'RANGCAPAN', '20-051105', 'BS in Computer Engineering', 3, '38alnUzTK1', 'No'),
(30, 'FRANCES MICAH', 'RAYOAN', '20-051096', 'BS in Computer Engineering', 3, 'EypIfzZHo8', 'No'),
(31, 'LANZ', 'SALMO', '20-050028', 'BS in Computer Engineering', 3, 'FXwslIPNg1', 'No'),
(32, 'DON ANGELO', 'SARABIA', '20-051024', 'BS in Computer Engineering', 3, 'Vp6EON6bqg', 'No'),
(33, 'EDRILLE MAE', 'SINAMPAGA', '20-051136', 'BS in Computer Engineering', 3, 'hP6TqG1x94', 'No'),
(34, 'AEAN GABRIELLE', 'TAYAWA', '20-050174', 'BS in Computer Engineering', 3, 'jVU93A15V8', 'No'),
(35, 'JANDEL JADE', 'TEJADA', '20-051126', 'BS in Computer Engineering', 3, 'oQvNFUiYWc', 'No'),
(36, 'ARLEIGH ANGELO', 'BAGAOISAN', '20-051135', 'BS in Computer Engineering', 3, 'nw73ndNSlI', 'No'),
(42, 'Joshua', 'Abellano', '20-123456', 'BS in Mechanical Engineering', 1, 'D8J1Xh9fat', 'No'),
(43, 'Jed', 'Paz', '20-234567', 'BS in Electronics Engineering', 1, '6eimgksXRt', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `student_number` varchar(11) NOT NULL,
  `President` varchar(50) DEFAULT NULL,
  `FirstYearRepresentative` varchar(50) DEFAULT NULL,
  `ThirdYearRepresentative` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`student_number`, `President`, `FirstYearRepresentative`, `ThirdYearRepresentative`) VALUES
('20051113', '155', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `election_state`
--
ALTER TABLE `election_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `election_title`
--
ALTER TABLE `election_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`student_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `election_state`
--
ALTER TABLE `election_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `election_title`
--
ALTER TABLE `election_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
