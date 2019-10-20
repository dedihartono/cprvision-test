-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2019 at 05:01 PM
-- Server version: 10.4.7-MariaDB-1:10.4.7+maria~xenial
-- PHP Version: 7.1.32-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Y3BydmlzaW9u`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_product`
--

CREATE TABLE `m_product` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_product`
--

INSERT INTO `m_product` (`id`, `name`, `image`) VALUES
(1, 'The Offfical Ubuntu Book', 'https://images-na.ssl-images-amazon.com/images/I/61fThKn1tFL._SX382_BO1,204,203,200_.jpg'),
(2, 'Quantum Computer Science', 'https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/lrg/9780/5218/9780521876582.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `t_submission`
--

CREATE TABLE `t_submission` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_submission`
--

INSERT INTO `t_submission` (`id`, `product_id`, `user_id`, `created_at`, `quantity`) VALUES
(1, 1, 1, '2019-10-18 14:00:00', 5),
(2, 1, 2, '2019-10-20 03:00:00', 10),
(3, 2, 1, '2019-10-21 08:00:00', 50),
(4, 2, 2, '2019-10-20 16:14:35', 50),
(5, 1, 2, '2019-10-20 16:14:35', 90),
(6, 2, 2, '2019-10-20 16:19:23', 0),
(7, 1, 2, '2019-10-20 16:19:23', 0),
(8, 2, 2, '2019-10-20 16:19:42', 0),
(9, 1, 2, '2019-10-20 16:19:42', 0),
(10, 2, 2, '2019-10-20 16:20:11', 0),
(11, 1, 2, '2019-10-20 16:20:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pin` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pin`) VALUES
(1, 1234),
(2, 1235);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_product`
--
ALTER TABLE `m_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_submission`
--
ALTER TABLE `t_submission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_relation_id` (`user_id`),
  ADD KEY `m_product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_product`
--
ALTER TABLE `m_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_submission`
--
ALTER TABLE `t_submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_submission`
--
ALTER TABLE `t_submission`
  ADD CONSTRAINT `m_product_id` FOREIGN KEY (`product_id`) REFERENCES `m_product` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_relation_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
