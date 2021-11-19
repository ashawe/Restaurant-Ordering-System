-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2021 at 10:31 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ros`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `name`, `price`, `photo`, `description`) VALUES
(1, 'Veg Pizza', 9, 'pizz.jpg', 'Veg Pizza with capsicum, onion, tomato and olives'),
(2, 'Pepperonni Pizza', 10, 'pizz.jpg', 'Pepperonni Pizza with capsicum, onion, tomato, olives and Pepperonni'),
(3, 'Cheese Pizza', 7, 'pizz.jpg', 'Pizza with cheese on it. Thats it'),
(4, 'Fried Rice', 9, 'rice.jpg', 'Vegetarian Fried Rice. Contains Eggs.'),
(5, 'Pepsi Can', 5, 'pepsi.jpg', 'Pepsi.'),
(6, 'Coca Cola', 50, 'coke.jpeg', 'Buy Pepsi Instead. Offcial Sponsor of Maryland Athletics.'),
(7, 'Veg Burger', 8, 'burg.jpeg', 'Vegetarian Burger with Potato Tikki instead of beef.'),
(8, 'Milk', 3, 'milk.jpeg', 'Straight from a cow.'),
(9, 'Coffee', 4, 'coffee.jpg', 'Milk is straight from a cow. We will provide coffee satche seperately. :)'),
(10, 'Noodles', 7, 'noo.jpg', 'Authentic Noodles.');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(15) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(15) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `suggestion` varchar(500) DEFAULT NULL,
  `table_number` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_status`, `phone_number`, `suggestion`, `table_number`, `time`) VALUES
(13, 'ACCEPTED', '1231231231', NULL, 5, '2021-11-17 04:23:02'),
(14, 'PREPARING', '1231234561', NULL, 1, '2021-11-17 17:32:48'),
(15, 'PLACED', '1231231234', NULL, 2, '2021-11-17 17:46:46'),
(16, 'PLACED', '1111231231', NULL, 10, '2021-11-17 17:52:01'),
(17, 'COMPLETED', '9999999999', NULL, 112, '2021-11-17 19:50:24'),
(18, 'COMPLETED', '9119119911', NULL, 7, '2021-11-18 00:15:42'),
(19, 'COMPLETED', '1123123456', NULL, 1, '2021-11-18 14:21:20'),
(20, 'COMPLETED', '9898980987', 'REAL', 1, '2021-11-18 14:32:29'),
(21, 'COMPLETED', '1231231231', 'NoiCe', 1, '2021-11-19 20:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_mapping`
--

CREATE TABLE `order_mapping` (
  `mapping_id` int(15) NOT NULL,
  `order_id` int(15) NOT NULL,
  `food_id` int(15) NOT NULL,
  `quantity` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_mapping`
--

INSERT INTO `order_mapping` (`mapping_id`, `order_id`, `food_id`, `quantity`) VALUES
(1, 13, 1, 3),
(2, 13, 3, 1),
(3, 13, 5, 1),
(4, 14, 1, 1),
(5, 14, 3, 1),
(6, 15, 1, 2),
(7, 16, 1, 2),
(8, 17, 2, 5),
(9, 17, 5, 2),
(10, 17, 6, 1),
(11, 17, 8, 1),
(12, 18, 5, 1),
(13, 18, 8, 1),
(14, 19, 1, 3),
(15, 19, 2, 5),
(16, 19, 5, 1),
(18, 21, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(15) NOT NULL,
  `food_id` int(15) NOT NULL,
  `rating` int(1) NOT NULL,
  `review` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `food_id`, `rating`, `review`) VALUES
(5, 5, 4, 'don\'t like the logo'),
(7, 5, 4, ''),
(8, 5, 5, ''),
(9, 1, 5, 'The best pizza I\'ve eaten so far!'),
(10, 2, 5, 'Really tasty. Must try.'),
(11, 5, 5, 'UMD Athletics! Lessgooo!'),
(13, 1, 3, 'NoicE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email_id` varchar(100) NOT NULL,
  `password` char(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `first_login` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email_id`, `password`, `role`, `first_login`) VALUES
('admin@mail.com', '$2y$10$dNYVtiJjuJxSUHZDp.LNCuYhGEfM.Mtv2WH4g.sAJXYh5CZcjGYOy', 'ADMIN', 0),
('chef@mail.com', '$2y$10$4G80jmzJEUiQBZcLBZN26urEV7f0do49Z4Dgld6A2elk5fSu7YVai', 'CHEF', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_mapping`
--
ALTER TABLE `order_mapping`
  ADD PRIMARY KEY (`mapping_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_mapping`
--
ALTER TABLE `order_mapping`
  MODIFY `mapping_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_mapping`
--
ALTER TABLE `order_mapping`
  ADD CONSTRAINT `order_mapping_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_mapping_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
