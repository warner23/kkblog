-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql1006.mochahost.com:3306
-- Generation Time: Jan 02, 2021 at 05:37 PM
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
Table structure for table `comments`
--


CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `posted_by_name` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `postTime` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `posted_by`, `posted_by_name`, `comment`, `postTime`) VALUES
(1, 13, 30, 'warner', 'awesome', '2021-01-02 22:33:28');


-- --------------------------------------------------------

--
-- 
Table structure for table `css`
--

CREATE TABLE `css` (
  `id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `css`
--

INSERT INTO `css` (`id`, `page`, `href`) VALUES
(1, 'index', 'resources/css/style.css'),
(2, 'index', 'resources/css/carousal.css'),
(3, 'register', 'resources/css/style.css'),
(4, 'register', 'resources/css/carousal.css'),
(5, 'single', 'resources/css/style.css'),
(6, 'single', 'resources/css/carousal.css'),
(7, 'login', 'resources/css/style.css'),
(8, 'login', 'resources/css/carousal.css');

-- --------------------------------------------------------

--
-- 
Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `page`, `name`, `content`) VALUES
(1, 'index', 'viewport', 'width=device-width, initial-scale=1.0'),
(2, 'register', 'viewport', 'width=device-width, initial-scale=1.0'),
(3, 'single', 'viewport', 'width=device-width, initial-scale=1.0'),
(4, 'login', 'viewport', 'width=device-width, initial-scale=1.0');

-- --------------------------------------------------------

--
-- 
Table structure for table `posts`
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
-- Table structure for table `scripts`
--

CREATE TABLE `scripts` (
  `id` int(11) NOT NULL,
  `src` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scripts`
--

INSERT INTO `scripts` (`id`, `src`, `page`) VALUES
(1, 'resources/js/JQuery.js', 'register'),
(2, 'resources/js/JQuery.js', 'login'),
(3, 'resources/js/JQuery.js', 'single'),
(4, 'resources/js/JQuery.js', 'index');

-- --------------------------------------------------------

--
-- 
Table structure for table `site`
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
  `use_only_cookie` varchar(255) NOT NULL,
  `redirect` varchar(255) NOT NULL,
  `mail_confirm_required` enum('true','false') NOT NULL DEFAULT 'false',
  `register_confirm` varchar(255) NOT NULL,
  `reg_pass_reset` varchar(255) NOT NULL,
  `login_fingerprint` enum('true','false') NOT NULL DEFAULT 'false',
  `max_login_attempts` int(11) NOT NULL,
  `redirect_after_login` varchar(255) NOT NULL,
  `password_encryption` varchar(255) NOT NULL,
  `encryption_cost` int(11) NOT NULL,
  `sha512_iterations` int(11) NOT NULL,
  `password_salt` varchar(255) NOT NULL,
  `reset_key_life` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `root_path`, `base_url`, `db_host`, `db_username`, `db_pass`, `db_name`, `db_port`, `db_type`, `contact_email`, `secure_session`, `http_only`, `regenerate_id`, `use_only_cookie`, `redirect`, `mail_confirm_required`, `register_confirm`, `reg_pass_reset`, `login_fingerprint`, `max_login_attempts`, `redirect_after_login`, `password_encryption`, `encryption_cost`, `sha512_iterations`, `password_salt`, `reset_key_life`) VALUES
(1, 'Inspire Blog', 'https://wicms.uk/WIBacksites/kkblog/', 'https://wicms.uk/WIBacksites/kkblog', 'localhost', 'root', '', 'blog', '', 'mysql', '', 'true', 'true', 'false', 'true', 'index.php', 'false', 'confirm', '50', 'false', 3, 'index.php', 'bcrypt', 13, 0, '776133225aacf7340b1e16.05737503', 60);

-- --------------------------------------------------------

--
-- 
Table structure for table `topics`
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
  `confirmed` varchar(255) NOT NULL,
  `confirmation_key` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `confirmed`, `confirmation_key`, `created_at`) VALUES
(22, 1, 'John Carter', 'jc9787@ja.com', '$2y$10$OeaKJKjAD6zn7tL386Q7ReTjAoTgefuOJ33AeGROuT7Y.2oyjnA2a', '', '', '2020-09-05 11:27:44'),
(23, 1, 'Dev', 'dev65@gmail.com', '$2y$10$Nxp839huX9vhBrSPwzjDs.Yeow2adJgyjiBrDIHs8YYDMZNM6VLAW', '', '', '2020-09-05 11:40:28'),
(24, 0, 'Jay', 'jaycc@h.com', '$2y$10$1P8Zfa0lbo8q/i9.1LOnuOAp9JHO/JbEEA0UxaHG7DKA9a3JKxr5m', '', '', '2020-09-07 19:25:55'),
(30, 0, 'warner', 'warner23@hotmail.com', '$2a$13$776133225aacf7340b1e1ufy6U9oWRCAb.XG6Ie2C4H1DYtvxFHbC', 'Y', '165529560a6cfebb57882b26fd228bbe', '2021-01-02 05:00:00');

-- --------------------------------------------------------

--
-- 
Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role`) VALUES
(1, 'User'),
(2, 'VIP'),
(3, 'Moderator'),
(4, 'Developer'),
(5, 'Administrator'),
(6, 'Head Administrator'),
(7, 'Owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `css`
--
ALTER TABLE `css`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `scripts`
--
ALTER TABLE `scripts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `css`
--
ALTER TABLE `css`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `scripts`
--
ALTER TABLE `scripts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
