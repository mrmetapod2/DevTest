-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 11:26 PM
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
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `idDocument` int(11) NOT NULL,
  `documentLocation` varchar(255) NOT NULL,
  `idTicket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserPass` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserTypes_idType` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`idDocument`),
  ADD KEY `ticketDocument` (`idTicket`);

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
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `idDocument` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modes_of_transport`
--
ALTER TABLE `modes_of_transport`
  MODIFY `idModesOfTransport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idTickets` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `idTicketStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `ticketDocument` FOREIGN KEY (`idTicket`) REFERENCES `tickets` (`idTickets`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_Tickets_Countries1` FOREIGN KEY (`CountryOrigin`) REFERENCES `countries` (`idCountries`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_Countries2` FOREIGN KEY (`CountryDestination`) REFERENCES `countries` (`idCountries`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_ModesOfTransport1` FOREIGN KEY (`ModeOfTransport`) REFERENCES `modes_of_transport` (`idModesOfTransport`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_TicketStatus1` FOREIGN KEY (`Status`) REFERENCES `ticket_status` (`idTicketStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_User1` FOREIGN KEY (`User_UserID`) REFERENCES `user` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_UserTypes` FOREIGN KEY (`UserTypes_idType`) REFERENCES `user_types` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
