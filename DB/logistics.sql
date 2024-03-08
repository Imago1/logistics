-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 01:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `founded_date` date DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `industry`, `address`, `city`, `state`, `country`, `email`, `phone`, `website`, `description`, `founded_date`, `logo`) VALUES
(1, 'Българска Логистична Компания1233', 'Logistics', 'ул. Логистика 10', 'София', NULL, 'България', 'info@logistics.bg', '+359 2 123 45678', 'https://www.logistics.bg/', 'Лидер в областта на логистиката в България, предлагаща комплексни решения за транспорт и складиране.', '2000-01-01', 'https://example.com/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `office` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `company_id`, `office`, `name`, `position`, `email`, `phone`) VALUES
(9, 1, 'Headquarters', 'Иван Иванов', 'Manager', 'ivan@example.com', '+359 2 123 4567'),
(10, 1, 'Headquarters', 'Петър Петров', 'Assistant Manager', 'petar@example.com', '+359 2 987 6543'),
(11, 1, 'Warehouse', 'Георги Георгиев', 'Warehouse Supervisor', 'georgi@example.com', '+359 2 111 2222'),
(12, 1, 'Warehouse', 'Мария Маринова', 'Warehouse Clerk', 'maria@example.com', '+359 2 333 4444'),
(13, 1, 'Customer Service123', 'Стефан Стефанов', 'Customer Service Representative', 'stefan@example.com', '+359 2 555 6666');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `company_id`, `name`, `address`, `city`, `country`, `phone`, `email`) VALUES
(2, 1, 'Warehouse', 'ул. Складова 5', 'София', 'България', '+359 2 987 6543', 'warehouse@logistics.bg'),
(3, 1, 'Customer Service', 'ул. Обслужвана 10', 'София', 'България', '+359 2 111 2222', 'customerservice@logistics.bg'),
(4, 1, 'Regional Office 1', 'бул. Регионален 15', 'Пловдив', 'България', '+359 32 333 4444', 'regional1@logistics.bg'),
(5, 1, 'Regional Office 2', 'бул. Регионален 25', 'Варна', 'България', '+359 52 555 6666', 'regional2@logistics.bg');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delivery_type` enum('home','office') NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `sender_id`, `sender`, `receiver`, `address`, `delivery_type`, `weight`, `price`, `timestamp`) VALUES
(11, 3, 'John Doe', 'Jane Smith', 'ул. Главна 1', 'office', 2.50, 0, '2024-03-05 23:07:56'),
(12, 3, 'Alice Johnson', 'Bob Brown', 'ул. Складова 5', 'office', 1.80, 0, '2024-03-05 23:07:56'),
(13, 4, 'Mary Lee', 'David Wilson', 'ул. Обслужвана 10', 'office', 3.20, 0, '2024-03-05 23:07:56'),
(14, 4, 'Emily Davis', 'Michael Taylor', 'бул. Регионален 15', 'office', 2.00, 0, '2024-03-05 23:07:56'),
(17, 3, 'test', 'test', 'test', 'home', 2.70, 0, '2024-03-05 23:22:55'),
(18, 1, 'Sarah Martinez123', 'James Anderson', 'бул. Регионален 25', 'office', 2.50, 0, '2024-03-05 23:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pass`, `role`, `timestamp`) VALUES
(1, 'test@test.bg', '$2y$10$7Q0X7GFzSNx5b8j4vv0tKeKZGs3dxmU/QnwaV1GOazhotI49iw/8q', '50', '2024-03-03 11:37:05'),
(2, 'admin@gmail.com', '$2y$10$7Q0X7GFzSNx5b8j4vv0tKeKZGs3dxmU/QnwaV1GOazhotI49iw/8q', '99', '2024-03-03 11:39:28'),
(3, 'test@test1.bg', '$2y$10$7Q0X7GFzSNx5b8j4vv0tKeKZGs3dxmU/QnwaV1GOazhotI49iw/8q', '1', '2024-03-03 11:37:05'),
(4, 'test@test2.bg', '$2y$10$7Q0X7GFzSNx5b8j4vv0tKeKZGs3dxmU/QnwaV1GOazhotI49iw/8q', '1', '2024-03-03 11:37:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `offices`
--
ALTER TABLE `offices`
  ADD CONSTRAINT `offices_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
