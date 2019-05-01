-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2019 at 06:52 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BibilographyManager`
--

-- --------------------------------------------------------

--
-- Table structure for table `libraryTable`
--

CREATE TABLE `libraryTable` (
  `libraryID` int(11) UNSIGNED NOT NULL,
  `libraryName` text COLLATE utf8_unicode_ci,
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5;

--
-- libraryTable data `libraryTable`
--

INSERT INTO `libraryTable` (`libraryID`, `libraryName`, `userID`) VALUES
(1,'library1',2),
(2,'libraryTest',2),
(3,'library3',3),
(4,'library4',4);

-- --------------------------------------------------------

--
-- Table structure for table `referenceTable`
--

CREATE TABLE `referenceTable` (
  `referenceID` int(11) UNSIGNED NOT NULL,
  `entryType` text COLLATE utf8_unicode_ci,
  `author` text COLLATE utf8_unicode_ci,
  `bookTitle` text COLLATE utf8_unicode_ci,
  `editor` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci,
  `journal` text COLLATE utf8_unicode_ci,
  `publisher` text COLLATE utf8_unicode_ci,
  `year` text COLLATE utf8_unicode_ci,
  `volume` text COLLATE utf8_unicode_ci,
  `libraryID` int(11) UNSIGNED DEFAULT '0',
  `defaultLibrary` tinyint(1) NOT NULL DEFAULT '0',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL,
  `shareLibraryID` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17;

--
-- referenceTable data `referenceTable`
--

INSERT INTO `referenceTable` (`referenceID`, `entryType`, `author`, `bookTitle`, `editor`, `title`, `journal`, `publisher`, `year`, `volume`, `libraryID`, `defaultLibrary`, `isDelete`, `userID`, `sharelibraryID`) VALUES
(1, 'sharelibrary1,3,2', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 1, '1,3,2'),
(2, 'sharelibrary3,2', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 2, '3,2'),
(3, 'sharelibrary2,1', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 3, '2,1'),
(4, 'sharelibrary23', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 4, '2,3'),
(5, 'sharelibrary1', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 4, '1'),
(6, 'sharelibrary13', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 2, '1,3'),
(7, 'sharelibrary23', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 3, '2,3'),
(8, 'sharelibrary3', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 1, '3'),
(9, 'sharelibrary23', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 1, '2,3'),
(10, 'sharelibrary1', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 2, '1'),
(11, 'sharelibrary13', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 4, '1,3'),
(12, 'sharelibrary13', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 3, '1,3'),
(13, 'sharelibrary3', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 1, '3'),
(14, 'sharelibrary23', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 2, '2,3'),
(15, 'sharelibrary23', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 4, '2,3'),
(16, 'sharelibrary3', 'AAAA', 'BBBB', 'CCCC', 'DDDD', 'EEEEE', 'FFFFF', '2019', '01', 1, 1, 0, 3, '3');

-- --------------------------------------------------------

--
-- Table structure for table `shareLibraryTable`
--

CREATE TABLE `shareLibraryTable` (
  `libraryID` int(11) UNSIGNED NOT NULL,
  `libraryName` text COLLATE utf8_unicode_ci,
  `userID` int(11) UNSIGNED DEFAULT '0',
  `shareUser` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4;

--
-- sharelibraryTable data `sharelibraryTable`
--

INSERT INTO `sharelibraryTable` (`libraryID`, `libraryName`, `userID`, `shareUser`) VALUES
(1,'sharelibrary1',2,'2,3'),
(2,'sharelibrary2_Test',3,'3,4'),
(3,'sharelibrary3',4,'4,1'),
(4,'sharelibrary4',1,'1,2');
-- --------------------------------------------------------

--
-- Table structure for table `userTable`
--

CREATE TABLE `userTable` (
  `userID` int(10) UNSIGNED NOT NULL,
  `firstName` text COLLATE utf8_unicode_ci,
  `lastName` text COLLATE utf8_unicode_ci,
  `email` text COLLATE utf8_unicode_ci,
  `password` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5;

--
-- Dumping data for table `userTable`
--

INSERT INTO `userTable` (`userID`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'user1', 'user1lastname', 'smotke93@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(2, 'user2', 'user2lastname', 'abc@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(3, 'user3', 'user3lastname', 'xyz@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(4, 'user4', 'user4lastname', 'cxyz@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `libraryTable`
--
ALTER TABLE `libraryTable`
  ADD PRIMARY KEY (`libraryID`);

--
-- Indexes for table `referenceTable`
--
ALTER TABLE `referenceTable`
  ADD PRIMARY KEY (`referenceID`);

--
-- Indexes for table `shareLibraryTable`
--
ALTER TABLE `shareLibraryTable`
  ADD PRIMARY KEY (`libraryID`);

--
-- Indexes for table `userTable`
--
ALTER TABLE `userTable`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `libraryTable`
--
ALTER TABLE `libraryTable`
  MODIFY `libraryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referenceTable`
--
ALTER TABLE `referenceTable`
  MODIFY `referenceID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shareLibraryTable`
--
ALTER TABLE `shareLibraryTable`
  MODIFY `libraryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userTable`
--
ALTER TABLE `userTable`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
