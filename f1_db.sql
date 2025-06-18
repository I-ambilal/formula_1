-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 04:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE Database: `f1_db`;
--

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_rank` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `team` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `podiums` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `grands_prix_entered` int(11) DEFAULT NULL,
  `world_championships` int(11) DEFAULT NULL,
  `highest_race_finish` varchar(20) DEFAULT NULL,
  `highest_grid_position` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `driver_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_rank`, `name`, `team`, `country`, `podiums`, `points`, `grands_prix_entered`, `world_championships`, `highest_race_finish`, `highest_grid_position`, `date_of_birth`, `place_of_birth`, `driver_image`) VALUES
(1, 'Lando Norris', 'McLaren', 'United Kingdom', 34, 176, 137, 0, '1', 1, '0000-00-00', 'Bristol, England', 'uploads/norris.jpeg'),
(2, 'Oscar Piastri', 'McLaren', 'Australia', 18, 186, 55, 0, '1', 1, '0000-00-00', 'Melbourne, Australia', 'uploads/piastri.jpeg'),
(3, 'Max Verstappen', 'Red Bull Racing', 'Netherlands', 116, 137, 218, 4, '1', 1, '0000-00-00', 'Hasselt, Belgium', 'uploads/verstappen.jpeg'),
(4, 'George Russell', 'Mercedes', 'United Kingdom', 19, 111, 137, 0, '1', 1, '0000-00-00', 'King’s Lynn, England', 'uploads/russell.jpeg'),
(5, 'Charles Leclerc', 'Ferrari', 'Monaco', 46, 94, 156, 0, '1', 1, '0000-00-00', 'Monte Carlo, Monaco', 'uploads/leclerc.jpeg'),
(6, 'Lewis Hamilton', 'Ferrari', 'United Kingdom', 202, 71, 365, 7, '1', 1, '0000-00-00', 'Stevenage, England', 'uploads/hamilton.jpeg'),
(7, 'Kimi Antonelli', 'Mercedes', 'Italy', 0, 48, 9, 0, '4', 3, '0000-00-00', 'Bologna, Italy', 'uploads/antonelli.jpeg'),
(8, 'Alexander Albon', 'Williams', 'Thailand', 2, 42, 0, 0, '3', 4, '0000-00-00', 'London, England', 'uploads/albon.jpeg'),
(9, 'Isack Hadjar', 'Racing Bulls', 'France', 0, 21, 0, 0, '6', 0, '0000-00-00', 'Paris area, France', 'uploads/hadjar.jpeg'),
(10, 'Esteban Ocon', 'Haas', 'France', 0, 20, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/ocon.jpeg'),
(11, 'Nico Hülkenberg', 'Sauber (Kick)', 'Germany', 0, 16, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/hulkenberg.jpeg'),
(12, 'Lance Stroll', 'Aston Martin', 'Canada', 0, 14, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/stroll.jpeg'),
(13, 'Carlos Sainz', 'Williams', 'Spain', 0, 12, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/sainz.jpeg'),
(14, 'Pierre Gasly', 'Alpine', 'France', 0, 11, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/gasly.jpeg'),
(15, 'Yuki Tsunoda', 'Red Bull Racing', 'Japan', 0, 10, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/tsunoda.jpeg'),
(16, 'Oliver Bearman', 'Haas', 'United Kingdom', 0, 6, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/bearman.jpeg'),
(17, 'Liam Lawson', 'Racing Bulls', 'New Zealand', 0, 4, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/lawson-racing-bulls.jpeg'),
(18, 'Fernando Alonso', 'Aston Martin', 'Spain', 0, 2, 0, 2, '1', 0, '0000-00-00', 'Unknown', 'uploads/alonso.jpeg'),
(19, 'Gabriel Bortoleto', 'Sauber (Kick)', 'Brazil', 0, 0, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/bortoleto.jpeg'),
(20, 'Jack Doohan', 'Alpine', 'Australia', 0, 0, 0, 0, '0', 0, '0000-00-00', 'Unknown', 'uploads/doohan.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `f1_teams`
--

CREATE TABLE `f1_teams` (
  `id` int(11) NOT NULL,
  `ranking` int(11) DEFAULT NULL,
  `full_team_name` varchar(255) DEFAULT NULL,
  `base` varchar(255) DEFAULT NULL,
  `team_chief` varchar(255) DEFAULT NULL,
  `technical_chief` varchar(255) DEFAULT NULL,
  `chassis` varchar(255) DEFAULT NULL,
  `power_unit` varchar(255) DEFAULT NULL,
  `first_team_entry` int(11) DEFAULT NULL,
  `world_championships` int(11) DEFAULT NULL,
  `highest_race_finish` varchar(255) DEFAULT NULL,
  `pole_positions` int(11) DEFAULT NULL,
  `fastest_laps` int(11) DEFAULT NULL,
  `team_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `f1_teams`
--

INSERT INTO `f1_teams` (`id`, `ranking`, `full_team_name`, `base`, `team_chief`, `technical_chief`, `chassis`, `power_unit`, `first_team_entry`, `world_championships`, `highest_race_finish`, `pole_positions`, `fastest_laps`, `team_image`) VALUES
(1, 4, 'Red Bull Racing', 'Milton Keynes, UK', 'Christian Horner', 'Pierre Waché', 'RB20', 'Honda RBPT', 2005, 6, '1', 101, 98, 'uploads/red-bull-racing.jpeg'),
(2, 1, 'Mercedes-AMG Petronas F1 Team', 'Brackley, UK', 'Toto Wolff', 'Mike Elliott', 'W15', 'Mercedes', 2010, 8, '1', 135, 99, 'uploads/mercedes.jpeg'),
(3, 5, 'Scuderia Ferrari', 'Maranello, Italy', 'Frédéric Vasseur', 'Enrico Cardile', 'SF-24', 'Ferrari', 1950, 16, '1', 243, 259, 'uploads/ferrari.jpeg'),
(4, 2, 'McLaren F1 Team', 'Woking, UK', 'Andrea Stella', 'Peter Prodromou', 'MCL38', 'Mercedes', 1966, 8, '1', 156, 164, 'uploads/mclaren.jpeg'),
(5, 6, 'Aston Martin Aramco F1 Team', 'Silverstone, UK', 'Mike Krack', 'Dan Fallows', 'AMR24', 'Mercedes', 2021, 0, '2', 0, 1, 'uploads/aston-martin.jpeg'),
(6, 7, 'BWT Alpine F1 Team', 'Enstone, UK', 'Bruno Famin', 'Matt Harman', 'A524', 'Renault', 1986, 2, '1', 20, 15, 'uploads/alpine.jpeg'),
(7, 8, ' Visa Cash App Racing Bulls Formula One Team', 'Faenza, Italy', 'Laurent Mekies', 'Jody Egginton', 'VCARB 01', 'Honda RBPT', 2006, 0, '1', 1, 1, 'uploads/racing-bulls.jpeg'),
(8, 9, 'Stake F1 Team Kick Sauber', 'Hinwil, Switzerland', 'Alessandro Alunni Bravi', 'James Key', 'C44', 'Ferrari', 1993, 0, '1', 1, 1, 'uploads/kick-sauber.jpeg'),
(9, 10, 'Haas F1 Team', 'Kannapolis, USA', 'Ayao Komatsu', 'Simone Resta', 'VF-24', 'Ferrari', 2016, 0, '4', 0, 2, 'uploads/haas.jpeg'),
(10, 3, 'Williams Racing', 'Grove, UK', 'James Vowles', 'Pat Fry', 'FW46', 'Mercedes', 1977, 9, '1', 128, 133, 'uploads/williams.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE `races` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `race_date` date NOT NULL,
  `race_flag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`id`, `name`, `location`, `race_date`, `race_flag`) VALUES
(2, 'Canadian GP', 'Circuit Gilles Villeneuve', '2025-06-14', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbpaMvjOL7rmfxGRk_A01xNMZ9VfLkR3q0wQ&s'),
(3, 'Austrian GP', 'Red Bull Ring', '2025-06-29', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Flag_of_Austria.svg/800px-Flag_of_Austria.svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `usersinfo`
--

CREATE TABLE `usersinfo` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `Age` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersinfo`
--

INSERT INTO `usersinfo` (`id`, `first_name`, `last_name`, `Gender`, `Age`, `Email`, `Password`) VALUES
(1, 'bilal', 'Mahmood', 'Male', 22, 'bilal@gmail.com', '$2y$10$Gpl5Ps7/AxFSfZMHSwdOKezyaYP.14JZL0qiJzFLI4Rg.UsGcnIPO'),
(2, 'aasal', 'chuhan', 'Male', 19, 'aasaal@gmail.com', '$2y$10$eTkStqHX0u/H3V8OhXdtCueM5iefjO.e2jTWyWoW20kg27OrwL9PG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_rank`);

--
-- Indexes for table `f1_teams`
--
ALTER TABLE `f1_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersinfo`
--
ALTER TABLE `usersinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `f1_teams`
--
ALTER TABLE `f1_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usersinfo`
--
ALTER TABLE `usersinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
