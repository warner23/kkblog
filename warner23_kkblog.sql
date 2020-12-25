-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql1006.mochahost.com:3306
-- Generation Time: Dec 25, 2020 at 02:28 PM
-- Server version: 5.6.38
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warner23_kkblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `topic_id`, `title`, `image`, `body`, `published`, `created_at`) VALUES
(13, 23, 1, 'One day your life flash before your eyes', '1602917352_8FF.jpg', 'This is a sample post nnhhh', 1, '2020-09-04 20:41:22'),
(14, 23, 3, 'Wedding is simple', '1602917359_24I.jpg', 'sampleand', 1, '2020-09-04 20:44:58'),
(15, 23, 5, 'Updated section', '1602917368_33182_wallpaper280.jpg', 'samp', 1, '2020-09-04 20:45:17'),
(16, 23, 6, 'Fruits', '1602917376_25.jpg', 'addd', 1, '2020-09-04 20:45:33'),
(17, 23, 4, 'Testing', '1602917383_6.JPG', 'dreee', 1, '2020-09-04 20:45:54'),
(18, 23, 1, 'Character', '1602917397_47M.jpg', 'sample oneand1234ghfgg', 1, '2020-09-05 11:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `root_path` varchar(255) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `db_host` varchar(255) NOT NULL,
  `db_username` varchar(255) NOT NULL,
  `db_pass` varchar(255) NOT NULL,
  `db_name` varchar(255) NOT NULL,
  `db_port` varchar(255) NOT NULL,
  `db_type` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `secure_session` varchar(255) NOT NULL,
  `http_only` varchar(255) NOT NULL,
  `regenerate_id` varchar(255) NOT NULL,
  `use_only_cookie` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site`
--



INSERT INTO `site` (`id`, `name`, `root_path`, `base_url`, `db_host`, `db_username`, `db_pass`, `db_name`, `db_port`, `db_type`, `contact_email`, `secure_session`, `http_only`, `regenerate_id`, `use_only_cookie`) VALUES

(1, 'Inspire Blog', 'https://wicms.uk/WIBacksites/kkblog/', 'https://wicms.uk/WIBacksites/kkblog', 'localhost', `root`,'', 'blog', '', 'mysql', '', 'true', 'true', 'false', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(1, 'Life', 'test hhhhjhg'),
(3, 'Quotes', 'data'),
(4, 'Fiction', 'data'),
(5, 'Biography', 'data'),
(6, 'Motivation', 'data'),
(7, 'Inspiration', 'GKLKK'),
(8, 'abi', 'sda');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `created_at`) VALUES
(22, 1, 'John Carter', 'jc9787@ja.com', '$2y$10$OeaKJKjAD6zn7tL386Q7ReTjAoTgefuOJ33AeGROuT7Y.2oyjnA2a', '2020-09-05 11:27:44'),
(23, 1, 'Dev', 'dev65@gmail.com', '$2y$10$Nxp839huX9vhBrSPwzjDs.Yeow2adJgyjiBrDIHs8YYDMZNM6VLAW', '2020-09-05 11:40:28'),
(24, 0, 'Jay', 'jaycc@h.com', '$2y$10$1P8Zfa0lbo8q/i9.1LOnuOAp9JHO/JbEEA0UxaHG7DKA9a3JKxr5m', '2020-09-07 19:25:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
