-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2017 at 01:25 AM
-- Server version: 5.5.28
-- PHP Version: 5.6.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `student18`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(6) unsigned NOT NULL,
  `sender_name` varchar(30) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `sender_message` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `sender_name`, `sender_email`, `sender_message`, `send_date`) VALUES
(1, 'example ', 'example@example.com', 'example message', '2017-02-27 12:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(6) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_image` varchar(500) NOT NULL,
  `product_price` double NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`) VALUES
(1, 'Baron Fight', 'product/art1/akali_vs_baron.jpg', 10, 10),
(2, 'Project fiora', 'product/art1/fiona.png', 12, 10),
(3, 'Project Leona', 'product/art1/leona.jpg', 15, 10),
(4, 'Team Fight', 'product/art1/morgana_vs_ahri.jpg', 13, 10),
(5, 'Team Graves', 'product/art1/team_graves.jpg', 15, 20),
(6, 'Team Builder', 'product/art1/teambuilder.jpg', 19.99, 10),
(7, 'Project Yasuo', 'product/art1/yasuo.png', 15, 10),
(8, 'Project Zed', 'product/art1/zed.jpg', 15, 10),
(9, 'Project yi', 'product/art1/project_yi.jpg', 20, 10);

-- --------------------------------------------------------
--
-- Table structure for table `upload`
--
CREATE TABLE IF NOT EXISTS `upload`(
  `product_sn` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Product ID',
  `product_title` varchar(255) NOT NULL COMMENT 'Product Title',
  `product_description` text NOT NULL COMMENT 'Product Description',
  `Product_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)


-- --------------------------------------------------------
--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(6) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(95) NOT NULL,
  `city` varchar(35) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `phone`, `address`, `city`, `postcode`, `join_date`) VALUES
(1, 'testing1', 'ac250e4a00ff3144ae7689f0d23e8b26d06aa929', 'testing@test.com', 'testing', 'testing', '0', 'testing', 'testing', 'testing', '2017-02-03 15:29:21'),
(2, 'madlunitic', '0b2be469b5c9f12c57e4ddd6d621b93affa21683', 'vaaticrom@gmail.com', 'Matthew', 'Harris', '0', 'test', 'test', 'ls165ab', '2017-02-03 15:37:49'),
(18, 'testing3', 'e0a56a88c41f712d460ff97c54a499641685762b', 'testing4@testing.com', 'testing4', 'testing4', '0', 'testing4', 'testing4', 'testing4', '2017-02-07 13:21:53'),
(12, 'bananas', '7c222fb2927d828af22f592134e8932480637c0d', 'bananusm@o2.pl', 'Matt', 'Baran', '0', '12 Athlone Grove', 'Leeds', 'LS12 1UD', '2017-02-07 11:57:53'),
(33, 'testing7', '47f35f2106f6f9c57ab03774d439e2a788ef6e94', 'testing7@testing7.com', 'testing7', 'testing7', '011387678', 'testing7', 'testing7', 'testing7', '2017-03-06 15:06:30'),
(32, 'zero924305', '7a789957da6ea0bc22c8687ca812fddd5c57a0ee', 'zero924305@gmail.com', 'Altino', 'CHONG', '07472262538', '488, SPEN LANE', 'LEEDS', 'LS16 6JB', '2017-03-06 12:27:32'),
(31, 'testing4', 'b88c908d8e751d64ab883639f04944f2a365db83', 'testing4@testing4.com', 'testing4', 'testing4', '0129312739', 'testing4', 'testing4', 'testing4', '2017-02-27 15:16:47'),
(30, 'testing2', '596b29ec9afea9e461a20610d150939b9c399d93', 'testing2@testing2.com', 'testing2', 'testing2', '07472262538', '488 spen lane', 'leeds', 'ls16 6jb', '2017-02-26 04:40:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`product_sn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
