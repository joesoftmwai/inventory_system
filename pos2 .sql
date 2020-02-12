-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2020 at 08:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `time`) VALUES
(15, 'Lampshade Lights', '2020-01-11 23:01:39'),
(16, 'Chandelier Lights', '2020-01-11 23:02:24'),
(17, 'Recessed Lights', '2020-01-11 23:03:57'),
(18, 'Pendannt Lights', '2020-01-11 23:04:26'),
(19, 'Sconce Lights', '2020-01-11 23:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `document_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `purchases` int(11) NOT NULL DEFAULT 0,
  `last_purchase` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `document_id`, `email`, `phone`, `address`, `date_of_birth`, `purchases`, `last_purchase`, `date`) VALUES
(2, 'Daniel', 34562822, 'daniel@gmail.com', '(254) 792-774267', '58 Main Street Nakuru', '1997-01-09', 17, '2020-01-06 23:58:23', '2019-10-02 08:01:39'),
(5, 'Gabriel', 37927755, 'gabriel@gmail.com', '(254) 788-336542', 'Exit 12 karen-ngong', '2000-02-03', 12, '2019-10-23 01:22:40', '2019-10-10 11:46:25'),
(6, 'Kenny', 3452462, 'kenny@gmail.com', '(353) 482-836846', 'haile sellasies av - lane d5', '2000-02-03', 20, '2019-10-20 00:12:01', '2019-10-11 10:58:11'),
(7, 'Hezron', 34298363, 'hezronkaringa@gmail.com', '(254) 776-254374', 'DOminion house d5', '1992-09-08', 0, '0000-00-00 00:00:00', '2020-01-11 23:57:07'),
(8, 'Moses', 827748949, 'moses@gmail.com', '(254) 785-323456', 'cabral street', '2000-01-05', 2, '2020-01-12 03:14:45', '2020-01-11 23:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `buying_price` float DEFAULT NULL,
  `selling_price` text DEFAULT NULL,
  `sales` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `code`, `description`, `image`, `stock`, `buying_price`, `selling_price`, `sales`, `date`) VALUES
(91, 15, '1501', 'Lampshade', 'views/img/products/1501/781.jpg', 19, 1200, '1500', 1, '2020-01-12 00:14:45'),
(92, 15, '1502', 'Lampshade', 'views/img/products/1502/314.jpg', 30, 1500, '1875', 0, '2020-01-12 00:04:37'),
(93, 15, '1503', 'Lampshade', 'views/img/products/1503/964.jpg', 30, 900, '1125', 0, '2020-01-12 00:05:31'),
(94, 19, '1901', 'Sconce', 'views/img/products/1901/407.jpg', 50, 900, '1080', 0, '2020-01-12 00:05:14'),
(95, 18, '1801', 'Pedannt', 'views/img/products/1801/741.jpg', 100, 1200, '1440', 0, '2020-01-12 00:04:56'),
(96, 17, '1701', 'Recessed', 'views/img/products/1701/183.jpg', 25, 700, '805', 0, '2020-01-12 00:04:11'),
(98, 19, '1902', 'Sconce', 'views/img/products/1902/279.jpg', 35, 1500, '1770', 0, '2020-01-12 00:03:32'),
(99, 19, '1903', 'Sconce', 'views/img/products/1903/379.jpg', 19, 1000, '1200', 1, '2020-01-14 07:53:36'),
(100, 18, '1802', 'Pedannt', 'views/img/products/1802/826.jpg', 26, 1700, '2040', 2, '2020-01-12 00:14:45'),
(101, 18, '1803', 'Pedannt', 'views/img/products/1803/360.jpg', 20, 900, '1260', 0, '2020-01-12 00:02:30'),
(102, 17, '1702', 'Recessed', 'views/img/products/1702/800.jpg', 60, 500, '700', 0, '2020-01-12 00:02:12'),
(103, 15, '1505', 'Lampshade', 'views/img/products/1505/631.jpg', 70, 1300, '1690', 0, '2020-01-12 00:00:57'),
(104, 15, '1506', 'Lampshade', 'views/img/products/1506/260.jpg', 30, 40, '56', 0, '2020-01-12 00:00:36'),
(105, 15, '1507', 'Lampshade', 'views/img/products/1507/291.jpg', 20, 200, '250', 0, '2020-01-12 00:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `tax` float NOT NULL,
  `net_price` float NOT NULL,
  `total` float NOT NULL,
  `payment_method` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `code`, `client_id`, `seller_id`, `products`, `tax`, `net_price`, `total`, `payment_method`, `date`) VALUES
(36, 10001, 8, 46, '[{\"id\":\"100\",\"description\":\"Pedannt\",\"quantity\":\"1\",\"stock\":\"26\",\"price\":\"2040\",\"total\":\"2040\"},{\"id\":\"91\",\"description\":\"Lampshade\",\"quantity\":\"1\",\"stock\":\"19\",\"price\":\"1500\",\"total\":\"1500\"}]', 0, 3540, 3540, 'Cash', '2020-01-12 00:14:45'),
(37, 10002, 6, 46, '[{\"id\":\"99\",\"description\":\"Sconce\",\"quantity\":\"1\",\"stock\":\"19\",\"price\":\"1200\",\"total\":\"1200\"}]', 0, 1200, 1200, 'DB-2835584', '2020-01-12 00:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `profile` text NOT NULL,
  `picture` text NOT NULL,
  `status` int(11) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `username`, `password`, `profile`, `picture`, `status`, `last_login`) VALUES
(46, 'Joseph Mwai', 'Joesoft', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 'Administrator', 'views/img/users/Joesoft/162.png', 1, '2020-01-14 09:09:39'),
(53, 'Mary Bae', 'Mary', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 'Special', 'views/img/users/Mary/912.png', 1, '2019-10-22 17:05:37'),
(56, 'Hezron Karinga', 'Hezo', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 'Special', 'views/img/users/Hezo/813.jpg', 1, '0000-00-00 00:00:00'),
(57, 'Josh Kronke', 'Josh', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 'Special', 'views/img/users/Josh/937.png', 1, '0000-00-00 00:00:00'),
(58, 'Daniel', 'Maish', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 'Special', 'views/img/users/Maish/925.png', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `profile` text NOT NULL,
  `picture` text NOT NULL,
  `status` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `profile`, `picture`, `status`, `last_login`, `date`) VALUES
(1, 'user administator', 'admin', '1234', 'Administrator', '', 1, '0000-00-00 00:00:00', '2019-09-21 10:36:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
