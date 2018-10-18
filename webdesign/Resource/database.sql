SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS `student18` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `student18`;

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(6) unsigned NOT NULL,
  `sender_name` varchar(30) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(6) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(41) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(95) NOT NULL,
  `city` varchar(35) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `feedback`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `user_id` int(6) unsigned NOT NULL AUTO_INCREMENT;
