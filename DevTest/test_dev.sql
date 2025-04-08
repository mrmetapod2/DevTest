-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 10:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `idCountries` int(11) NOT NULL,
  `CountriesName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`idCountries`, `CountriesName`) VALUES
(2, 'Algeria'),
(1, 'Argentina'),
(3, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `modes_of_transport`
--

CREATE TABLE `modes_of_transport` (
  `idModesOfTransport` int(11) NOT NULL,
  `ModesOfTransportName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modes_of_transport`
--

INSERT INTO `modes_of_transport` (`idModesOfTransport`, `ModesOfTransportName`) VALUES
(1, 'air'),
(2, 'land'),
(3, 'sea');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `idTickets` int(11) NOT NULL,
  `TicketName` varchar(45) NOT NULL,
  `TicketType` int(11) NOT NULL DEFAULT 1,
  `ModeOfTransport` int(11) NOT NULL,
  `CountryOrigin` int(11) NOT NULL,
  `CountryDestination` int(11) NOT NULL,
  `User_UserID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Document` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`idTickets`, `TicketName`, `TicketType`, `ModeOfTransport`, `CountryOrigin`, `CountryDestination`, `User_UserID`, `Status`, `Document`) VALUES
(10, 'aaa', 1, 1, 2, 2, 9, 1, 'uploads/ticket_67f58716d14612.77234926.pdf'),
(11, 'aaa', 1, 1, 2, 2, 9, 1, 'uploads/ticket_67f5891b997c64.00022039.pdf'),
(12, 'aaa', 1, 1, 2, 2, 9, 1, 'uploads/ticket_67f5895366fa76.42700530.pdf'),
(13, 'aaa', 1, 1, 2, 2, 9, 1, 'uploads/ticket_67f58966643008.67627284.pdf'),
(14, 'aaa', 1, 1, 2, 2, 9, 1, 'uploads/ticket_67f5896ad70867.45538102.pdf'),
(15, 'aaa', 1, 1, 2, 2, 9, 1, 'uploads/ticket_67f5896f494908.65512509.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_status`
--

CREATE TABLE `ticket_status` (
  `idTicketStatus` int(11) NOT NULL,
  `TicketStatusName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_status`
--

INSERT INTO `ticket_status` (`idTicketStatus`, `TicketStatusName`) VALUES
(3, 'completed'),
(2, 'In progress'),
(1, 'New');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE `ticket_type` (
  `TicketTypeID` int(11) NOT NULL,
  `TicketTypeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_type`
--

INSERT INTO `ticket_type` (`TicketTypeID`, `TicketTypeName`) VALUES
(1, '1'),
(2, '2'),
(3, '3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserPass` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserTypes_idType` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `UserPass`, `UserEmail`, `UserTypes_idType`) VALUES
(1, 'aaa', 'bugingi', 'wa@gmail.com', 1),
(4, 'waeo', 'Pewds007.', 'haha@gmail.com', 1),
(6, 'waeo', '$2y$10$dDrJbskgyTolEWnEIiczA.50ViTNYQGfBKbYRdXfqp9RipCvCm9/u', 'haha@gmail.com', 1),
(7, 'MARIO', '$2y$10$byRBe8qYnJJo3qPvPaEROOrDkRUpxlOMJ6Al6gaTCl7We8WPJi/qC', 'ganga@gmail.com', 2),
(8, 'MARIO', '$2y$10$As3fow2TGuYBM3F64iaYf.FWuiBAcAPb22Sdw7EDiTuqi.yrLHtzS', 'gaga@gmail.com', 2),
(9, 'Aboi', '$2y$10$kdxiI675bcYRcKBApFDpUO9NOMsQrTc37omTO7BFD8akVDV2DyN/.', 'hectormzacrias@gmail.com', 1),
(10, 'mau mau', '$2y$10$9Jd/WwbUpuf3ueI9i/lpEuovAkUafxkWjt4qxcCba4221PbtTtD5.', 'miami@gmail.com', 2),
(11, 'Golgo', '$2y$10$rN6FfPdkgLiLQ0C9jd62g.E9.WHhJL9eZXUzSXaI7ukwfaaZ3FT0G', 'kuro@gmail.com', 1),
(12, 'Gyaru', '$2y$10$WMT9pm9S7DHIgtEGhyb4UOhChu93TCtONbhZar.UOq6aOpxT4gvwG', 'gau@gmail.com', 2),
(13, 'gaolang', '$2y$10$2dCrwkg/dC.0HZton.KyaeR4G9mWlx8YRoFGg1FWbD759Ls2OKpQ6', 'na@gmail.com', 2),
(14, 'gaolang', '$2y$10$rF9kyrnAVanofmZlw80qyuvedLW68zhlGD8pt1N4bhRWm699xN3j.', 'na@gmail.com', 2),
(15, 'ago', '$2y$10$WQ2a3iIv/.uYR/c6zpVkT.xspMNYJxxZQ6Tpf6V33k.xSg7hNn99K', 'ho@gmail.com', 2),
(16, 'ago', '$2y$10$tTfawr3YBDFoeKSBR3a41.8c56DhflKTYZY7JA9F2EDBVpHkAKK8q', 'ho@gmail.com', 2),
(17, 'ago', '$2y$10$h5JN01BIhJ6jfjtPh4i9rOM/IdsX3z6uwWu.bOnUhAwqdfDW8m20a', 'ho@gmail.com', 2),
(18, 'ago', '$2y$10$2DsT1uPiCtW5am1RDlnILuO4ri0xlN7eM9m15tce2rds6WWwXYeou', 'ho@gmail.com', 2),
(19, 'ago', '$2y$10$HApDUp5W.n3QRFHNuZQFtOTnuKJsjWuC4HpnfSq5JkTQT6knyzerW', 'ho@gmail.com', 2),
(20, 'maozedong', '$2y$10$O5CTULSTdpEn6oOVo4jsr.WQGLFDoBudvDBhN3AO1sbAUoZ7Htqaq', 'ma@gmail.com', 2),
(21, 'gao', '$2y$10$8VEtFR4DAU1FNX7Jir7JQ.T/68V9wBJtu0ygjBs/a5deWEFtAPxbG', 'ma@gmail.com', 1),
(22, 'gao', '$2y$10$HsgNzAgUXeW904CvyJwOVOdzDI68nbhBcln.RNB9wI//kBi1nA0.i', 'ma@gmail.com', 1),
(23, 'gao', '$2y$10$OIexVgMPtqz1Cys33x8fGOH1qNgEFSXIuc9yw0HuDVtACMo4gprDW', 'ma@gmail.com', 1),
(24, 'gao', '$2y$10$tC3kLvS45Xrr20KlGpPtruohdsQHrxMf1/Gh//RGh9NkrpKDsqMBO', 'ma@gmail.com', 1),
(25, 'gao', '$2y$10$L7alvj9JP6FxSv0G9PuU9OFabzloaXWfGxtFcb/mDP7RP31.YJuva', 'ma@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `idType` int(11) NOT NULL,
  `TypeName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`idType`, `TypeName`) VALUES
(2, 'Agente'),
(1, 'Usuario');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`idCountries`),
  ADD UNIQUE KEY `idCountries_UNIQUE` (`idCountries`),
  ADD UNIQUE KEY `CountriesName_UNIQUE` (`CountriesName`);

--
-- Indexes for table `modes_of_transport`
--
ALTER TABLE `modes_of_transport`
  ADD PRIMARY KEY (`idModesOfTransport`),
  ADD UNIQUE KEY `idModesOfTransport_UNIQUE` (`idModesOfTransport`),
  ADD UNIQUE KEY `ModesOfTransportName_UNIQUE` (`ModesOfTransportName`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idTickets`),
  ADD UNIQUE KEY `idTickets_UNIQUE` (`idTickets`),
  ADD KEY `fk_Tickets_ModesOfTransport1_idx` (`ModeOfTransport`),
  ADD KEY `fk_Tickets_Countries1_idx` (`CountryOrigin`),
  ADD KEY `fk_Tickets_Countries2_idx` (`CountryDestination`),
  ADD KEY `fk_Tickets_User1_idx` (`User_UserID`),
  ADD KEY `fk_Tickets_TicketStatus1_idx` (`Status`),
  ADD KEY `TicketType` (`TicketType`);

--
-- Indexes for table `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`idTicketStatus`),
  ADD UNIQUE KEY `idTicketStatus_UNIQUE` (`idTicketStatus`),
  ADD UNIQUE KEY `TicketStatusName_UNIQUE` (`TicketStatusName`);

--
-- Indexes for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`TicketTypeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID_UNIQUE` (`UserID`),
  ADD KEY `fk_User_UserTypes_idx` (`UserTypes_idType`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`idType`),
  ADD UNIQUE KEY `idType_UNIQUE` (`idType`),
  ADD UNIQUE KEY `TypeName_UNIQUE` (`TypeName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `idCountries` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modes_of_transport`
--
ALTER TABLE `modes_of_transport`
  MODIFY `idModesOfTransport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idTickets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `idTicketStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_Tickets_Countries1` FOREIGN KEY (`CountryOrigin`) REFERENCES `countries` (`idCountries`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_Countries2` FOREIGN KEY (`CountryDestination`) REFERENCES `countries` (`idCountries`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_ModesOfTransport1` FOREIGN KEY (`ModeOfTransport`) REFERENCES `modes_of_transport` (`idModesOfTransport`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_TicketStatus1` FOREIGN KEY (`Status`) REFERENCES `ticket_status` (`idTicketStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_User1` FOREIGN KEY (`User_UserID`) REFERENCES `user` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`TicketType`) REFERENCES `ticket_type` (`TicketTypeID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_UserTypes` FOREIGN KEY (`UserTypes_idType`) REFERENCES `user_types` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
