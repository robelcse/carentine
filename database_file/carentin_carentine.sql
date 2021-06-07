-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2021 at 04:47 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carentin_carentine`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked_ip`
--

CREATE TABLE `blocked_ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocked_ip`
--

INSERT INTO `blocked_ip` (`id`, `ip`, `date`) VALUES
(5, '103.106.185.36', '2020-06-01'),
(4, '103.106.185.36', '2020-06-01'),
(6, '103.106.185.36', '2020-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `helper_helpee`
--

CREATE TABLE `helper_helpee` (
  `id` int(11) NOT NULL,
  `helper_phone` varchar(255) NOT NULL,
  `helpee_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `helper_helpee`
--

INSERT INTO `helper_helpee` (`id`, `helper_phone`, `helpee_phone`) VALUES
(10, '0468410540', '0468410555');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `postcode` varchar(25) NOT NULL,
  `state` int(11) NOT NULL,
  `emergency` int(11) NOT NULL DEFAULT 0,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `post_type` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `rated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userid`, `user_type`, `description`, `address`, `suburb`, `postcode`, `state`, `emergency`, `time`, `status`, `post_type`, `phone`, `rated`) VALUES
(37, 29, 'buyer', 'want to help 1', '', '', '2913', 1, 0, '2020-05-25 11:19', 'closed', 'wanttohelp', '0468410540', 1),
(38, 24, 'buyer', 'want to help 2', '', '', '2913', 1, 0, '2020-05-25 11:19', 'open', 'wanttohelp', '0468410111', 0),
(39, 25, 'buyer', 'want to help 3', '', '', '2154', 2, 0, '2020-05-25 11:19', 'open', 'wanttohelp', '0468410222', 0),
(40, 26, 'seller', 'want help 1', '', '', '2913', 1, 0, '2020-05-25 11:19', 'open', 'wanthelp', '0468410333', 0),
(41, 27, 'seller', 'want help 2', '', '', '2913', 1, 0, '2020-05-25 11:19', 'open', 'wanthelp', '0468410444', 0),
(42, 28, 'seller', 'want help 3', '', '', '2154', 2, 0, '2020-05-25 11:19', 'closed', 'wanthelp', '0468410555', 1),
(44, 29, 'seller', 'want help - Emergency', '', 'castle hill', '2154', 2, 1, '2020-05-25 14:13', 'closed', 'wanthelp', '0468410540', 0),
(45, 29, 'buyer', 'want to help - duplicate', '', 'castle hill', '2154', 2, 0, '2020-05-25 14:15', 'closed', 'wanttohelp', '0468410540', 0),
(46, 29, 'seller', '', 'House 10A, 123123, 123123, 123123', 'Rawalpindi', '46000', 3, 1, '2020-05-28 19:09', 'open', 'wanthelp', '0468410540', 0),
(47, 29, 'buyer', 'Thanks!!', 'House 10A, 123123, 123123, 123123', 'Rawalpindi', '46000', 8, 0, '2020-05-28 19:10', 'open', 'wanttohelp', '0468410540', 0),
(48, 30, 'seller', '', '', '', '2154', 2, 1, '2020-05-29 15:55', 'open', 'wanthelp', '0468410540', 0),
(49, 30, 'seller', '', '', '', '2154', 2, 0, '2020-05-29 16:06', 'open', 'wanthelp', '0468410540', 0),
(50, 30, 'seller', '', '', '', '2154', 2, 0, '2020-05-29 16:06', 'closed', 'wanthelp', '0468410540', 1),
(51, 30, 'seller', '', '', '', '2154', 2, 0, '2020-05-29 16:09', 'closed', 'wanthelp', '0468410540', 0),
(52, 30, 'seller', '', '', '', '2154', 2, 0, '2020-05-29 16:10', 'open', 'wanthelp', '0468410540', 0),
(53, 30, 'seller', '', '', '', '2154', 2, 0, '2020-05-29 16:26', 'open', 'wanthelp', '0468410540', 0),
(56, 32, 'seller', 'final test', '', '', '2155', 2, 0, '2020-06-09 17:47', 'open', 'wanthelp', '0468410540', 0),
(57, 24, 'seller', 'Qui perferendis irur', 'Banglamotor,Ramna', 'Dhaka', '1217', 1, 1, '2021-01-05 21:41', 'open', 'wanthelp', '0468410111', 0),
(58, 24, 'seller', 'Eum tempor nisi eos ', '58 Second Parkway', 'Maxime recusandae Q', '47629', 3, 1, '2021-01-05 21:44', 'open', 'wanthelp', '0468410111', 0),
(59, 24, 'seller', 'Ad dolorum blanditii', 'Banglamotor,Ramna', 'Dhaka', '1217', 6, 1, '2021-01-05 21:49', 'open', 'wanthelp', '0468410111', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `reviewer_phone` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `postphone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `postid`, `reviewer_phone`, `rating`, `comment`, `postphone`) VALUES
(5, 42, '0468410540', 5, 'Good', '0468410555'),
(6, 37, '0468410555', 5, '', '0468410540'),
(7, 50, '0468410555', 4, 'Good', '0468410540');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Australian Capital Territory'),
(2, 'New South Wales'),
(3, 'Northern Territory'),
(4, 'Queensland'),
(5, 'South Australia'),
(6, 'Tasmania'),
(7, 'Victoria'),
(8, 'Western Australia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ranking` varchar(255) NOT NULL,
  `fraud` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `password`, `ranking`, `fraud`, `type`) VALUES
(24, '0468410111', '166111', '', 0, ''),
(25, '0468410222', '166222', '', 0, ''),
(26, '0468410333', '166333', '', 0, ''),
(27, '0468410444', '166444', '', 0, ''),
(28, '0468410555', '166555', '', 0, ''),
(31, '03345446487', '380116', '', 0, ''),
(32, '0468410540', '199471', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked_ip`
--
ALTER TABLE `blocked_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `helper_helpee`
--
ALTER TABLE `helper_helpee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
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
-- AUTO_INCREMENT for table `blocked_ip`
--
ALTER TABLE `blocked_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `helper_helpee`
--
ALTER TABLE `helper_helpee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
