-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 07:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talent_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `Name` char(50) NOT NULL,
  `Dep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `Name`, `Dep_id`) VALUES
(4, 'novel', 1),
(5, 'oil_painting', 3),
(6, 'sand_painting', 3),
(7, 'clothes', 2),
(8, 'accessory', 2),
(9, 'food_photography', 4),
(10, 'wedding_photography', 4),
(11, 'dublag', 5),
(12, 'books_voiceover', 5),
(13, 'Melinda Petersen', 3);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Id` int(11) NOT NULL,
  `Comment_date` datetime NOT NULL,
  `Comment_content` varchar(1000) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `Name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `Name`) VALUES
(1, 'writing'),
(2, 'handmade'),
(3, 'painting'),
(4, 'photography'),
(5, 'voiceover');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `Id` int(11) NOT NULL,
  `Title` char(100) NOT NULL,
  `Content` varchar(1000) NOT NULL,
  `Time` datetime NOT NULL,
  `t_work id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registeration`
--

CREATE TABLE `registeration` (
  `id` int(11) NOT NULL,
  `First_name` char(15) NOT NULL,
  `Last_name` char(15) NOT NULL,
  `Email` char(100) NOT NULL,
  `Password` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `Name`) VALUES
(1, 'Manager'),
(2, 'Admin'),
(3, 'Talent'),
(4, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `talent_work`
--

CREATE TABLE `talent_work` (
  `id` int(11) NOT NULL,
  `Name` char(50) NOT NULL,
  `Content` varchar(1000) NOT NULL,
  `Image` char(200) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `talent_work`
--

INSERT INTO `talent_work` (`id`, `Name`, `Content`, `Image`, `User_id`, `Cat_id`) VALUES
(22, 'Ginger Ellis', '1642653925983150498.jpg', '1642653925725799299.png', 12, 12),
(23, 'Ira Barrett', '1642653936773372187.jpg', '1642653936614248744.jpg', 12, 7),
(24, 'Ira Barrett', '16426542431156863569.jpg', '16426542431312491236.jpg', 12, 7),
(25, 'Ira Barrett', '1642654483936168447.jpg', '16426544831169021406.jpg', 12, 7),
(26, 'Ira Barrett', '16426546471051928678.jpg', '164265464718565572.jpg', 12, 7),
(27, 'Ira Barrett', '16426546962116954210.jpg', '1642654696158741317.jpg', 12, 7),
(28, 'Ira Barrett', '1642655222179393573.jpg', '16426552221753177918.jpg', 12, 7),
(29, 'Ira Barrett', '1642655249649018117.jpg', '1642655249673060107.jpg', 12, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` char(50) NOT NULL,
  `Email` char(50) NOT NULL,
  `Password` char(20) NOT NULL,
  `Profile_Picture` char(100) NOT NULL,
  `Role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `Email`, `Password`, `Profile_Picture`, `Role_id`) VALUES
(8, 'Honorato Obrien', 'resijum@mailinator.com', 'f3ed11bbdb94fd9ebdef', '1642653812737687085.jpg', 2),
(9, 'Bernard Hernandez', 'vobowat@mailinator.com', 'f3ed11bbdb94fd9ebdef', '1642653825773990925.jpg', 3),
(10, 'Clark Curtis', 'relyk@mailinator.com', 'f3ed11bbdb94fd9ebdef', '1642653833741783897.png', 1),
(11, 'Brynne Pennington', 'pesel@mailinator.com', 'f3ed11bbdb94fd9ebdef', '16426538411932235409.jpg', 1),
(12, 'Ariel Cross', 'qitu@mailinator.com', 'f3ed11bbdb94fd9ebdef', '1642653851848717203.jpg', 3),
(13, 'Daphne Preston', 'pufige@mailinator.com', 'f3ed11bbdb94fd9ebdef', '16426538651273220721.jpg', 2),
(14, 'Mohamed', 'moh@yahoo.com', '25f9e794323b453885f5', '1642660761780734930.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE `user_contacts` (
  `Id` int(11) NOT NULL,
  `Phone` char(20) NOT NULL,
  `Whatsapp` char(20) NOT NULL,
  `Youtube` char(100) NOT NULL,
  `Instagram` char(100) NOT NULL,
  `Facebook` char(100) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_dept`
--

CREATE TABLE `user_dept` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Dep_id` (`Dep_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `t_work id` (`t_work id`);

--
-- Indexes for table `registeration`
--
ALTER TABLE `registeration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `talent_work`
--
ALTER TABLE `talent_work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `Dep_id` (`Cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Role_id` (`Role_id`);

--
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `user_dept`
--
ALTER TABLE `user_dept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registeration`
--
ALTER TABLE `registeration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `talent_work`
--
ALTER TABLE `talent_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_dept`
--
ALTER TABLE `user_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `cat_dep_rel` FOREIGN KEY (`Dep_id`) REFERENCES `department` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `post_com_rel` FOREIGN KEY (`post_id`) REFERENCES `post` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_work_rel` FOREIGN KEY (`t_work id`) REFERENCES `talent_work` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `talent_work`
--
ALTER TABLE `talent_work`
  ADD CONSTRAINT `cat_work_rel` FOREIGN KEY (`cat_id`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `use_work_rel` FOREIGN KEY (`User_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_role_rel` FOREIGN KEY (`Role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD CONSTRAINT `user_con_rel` FOREIGN KEY (`User_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_dept`
--
ALTER TABLE `user_dept`
  ADD CONSTRAINT `dept_relation` FOREIGN KEY (`dept_id`) REFERENCES `department` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_relation` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
