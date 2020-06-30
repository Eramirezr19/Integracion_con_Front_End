-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2020 at 04:30 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agendaphp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `fecha_final` date NOT NULL,
  `hora_final` time NOT NULL,
  `dia_completo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `user_id`, `titulo`, `fecha_inicio`, `hora_inicio`, `fecha_final`, `hora_final`, `dia_completo`) VALUES
(4, 2, 'Reunión equipo', '2020-06-29', '07:00:00', '2020-06-29', '08:30:00', 0),
(5, 2, 'Revision de jerarquías', '2020-07-03', '07:00:00', '2020-07-03', '09:30:00', 0),
(7, 2, 'Continuar capacitacion', '2020-07-08', '00:00:00', '0000-00-00', '00:00:00', 0),
(8, 9, 'Cita médica', '2020-06-30', '09:30:00', '2020-06-30', '11:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `apellido` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `psw` varchar(256) NOT NULL,
  `fecha_nacimiento` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `email`, `psw`, `fecha_nacimiento`) VALUES
(2, 'Esteban', 'Ramirez', 'eramirezing@gmail.com', '$2y$10$gpZvInmM62P9JNUtIu49lOoeyn/Qvv9TflebkE0MlXSrulnJVzMHq', '2020-06-02'),
(9, 'Cristina', 'Solano', 'crisoma@gmail.com', '$2y$10$Eb7bTrtPVyNqcquIjThIB.VYA.4qx5bnB8xjwxPAvo4BtbNFfsAja', '2020-06-08'),
(10, 'Alejandro', 'Ramirez', 'aleranger22@gmail.com', '$2y$10$rhypwlBv//IbHatULK1MWuiNovyPlsNUXEXTMd32aMlGrgunBNvSy', '2020-06-08'),
(19, 'Maria', 'Solano', 'crista@gmail.com', '$2y$10$9gRfZpRuzOaCuLc17xIrxeWElxlHUvfgVcLUe6Q/d4lhP1RC8BCO2', '2020-06-09'),
(23, 'Mario', 'Guzman', 'mario@gmail.com', '$2y$10$XLiX7skTn8LDUME.hlFMjO13vDXp9W26BxjG3wlfsBKLP.j4P9yv2', '2020-06-08'),
(24, 'Randall', 'Poveda', 'randall@gmail.com', '$2y$10$inN.ul1IlJN9XiZrktaLLOw3fJlzXKvF7NV9xLMi.lWlAxYL2iUPe', '2016-06-02'),
(30, 'Gonzalo', 'Garita', 'ggarita@gmail.com', '$2y$10$fZifdOhJ8.ipvT7juqPoxunBT/.5KdAD9m.i8yitb/m6OkFvqCwXu', '2020-06-01'),
(34, 'Cristiano', 'Ronaldo', 'mail@gmail.com', '$2y$10$oZcYvYUy1.txiuJXo/Gz0OLR.z/ht3ntiUouzcim9E3A5UCNz7WUy', '2020-06-10'),
(38, 'Carolina', 'Solano', 'casolano@gmail.com', '$2y$10$f8iYd2Hl92MFTKW6rs4rCOKzHdpqlVwkwyhe8QWdEc1Fo3UsMn4pu', '2020-06-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relacion_evento_usuario` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `relacion_evento_usuario` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
