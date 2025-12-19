-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 17, 2025 at 01:32 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_task_emp`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `leave_days` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `from_date`, `to_date`, `leave_days`, `reason`, `created_at`) VALUES
(1, 3, '2025-12-19', '2025-12-19', 1, 'For Personal reason', '2025-12-17 04:30:47'),
(2, 3, '2025-12-23', '2025-12-23', 1, 'guiuhgi', '2025-12-17 04:32:36'),
(3, 3, '2026-01-02', '2026-01-02', 1, 'rtrft', '2025-12-17 04:34:38'),
(5, 3, '2026-01-03', '2026-01-07', 3, 'weekend', '2025-12-17 04:37:16'),
(6, 2, '2025-12-18', '2025-12-18', 1, 'Resan ofr aps', '2025-12-17 06:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `start_date`, `end_date`, `created_by`, `created_at`) VALUES
(1, 'Project1', 'testdata', '2025-12-17', '2025-12-20', 1, '2025-12-17 03:59:52'),
(2, 'Project2', 'project2 description', '2025-12-04', '2025-12-06', 1, '2025-12-17 04:16:21'),
(3, 'Project3', 'project3 description', '2025-12-19', '2026-01-31', 1, '2025-12-17 06:39:15'),
(4, 'Project4', 'for backend changes', '2025-12-26', '2025-12-31', 1, '2025-12-17 11:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `priority` enum('Low','Medium','High') DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `project_id`, `assigned_to`, `priority`, `status`, `created_by`, `created_at`) VALUES
(1, 'task1', 'task1 description', 1, 2, 'Low', 'Pending', 1, '2025-12-17 04:10:43'),
(2, 'Task2', 'task2 description', 2, 3, 'High', 'In Progress', 1, '2025-12-17 04:17:07'),
(3, 'Task3', 'test3 description', 2, 2, 'Medium', 'Completed', 1, '2025-12-17 04:47:35'),
(4, 'Task4', 'task4 desctipion', 2, 2, 'Medium', 'Pending', 1, '2025-12-17 04:47:54'),
(5, 'Task5', 'tewst5 des', 1, 2, 'Medium', 'Pending', 1, '2025-12-17 05:22:29'),
(6, 'Task6', 'test6 descripton', 2, 3, 'Low', 'In Progress', 1, '2025-12-17 05:22:48'),
(7, 'Tasdk7', 'taskt7 description', 2, 2, 'High', 'In Progress', 1, '2025-12-17 06:02:50'),
(8, 'Task8', 'tatk8 descirption', 2, 2, 'High', 'Pending', 1, '2025-12-17 06:03:16'),
(9, 'Tasktoedit', 'edit the content of page', 3, 3, 'Medium', 'Pending', 1, '2025-12-17 06:39:54'),
(10, 'TaskBackendchanges', 'Changes in backend', 4, 3, 'High', 'Pending', 1, '2025-12-17 11:28:31'),
(11, 'Taskforpaginate', 'test paginate', 4, 3, 'Medium', 'Pending', 1, '2025-12-17 11:29:00'),
(12, 'Taskforcomments', 'Comment message', 4, 2, 'Medium', 'Pending', 1, '2025-12-17 12:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE `task_comments` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_comments`
--

INSERT INTO `task_comments` (`id`, `task_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 2, 1, 'Need to complete immediately', '2025-12-17 04:17:30'),
(2, 1, 2, 'completed in two days', '2025-12-17 04:19:48'),
(3, 2, 3, 'Yes complete it soon', '2025-12-17 04:22:05'),
(4, 2, 1, 'ok update it', '2025-12-17 04:27:10'),
(5, 2, 3, 'ok update it', '2025-12-17 04:27:35'),
(6, 2, 3, 'yes sir final stage\r\n', '2025-12-17 04:28:49'),
(7, 2, 1, 'ok do it', '2025-12-17 04:29:01'),
(8, 2, 3, 'yes sir final stage\r\n', '2025-12-17 04:29:05'),
(9, 2, 1, 'ok', '2025-12-17 04:29:37'),
(10, 11, 1, 'Task to complete within 3 days when started', '2025-12-17 12:25:03'),
(11, 12, 1, 'Hi, when to start the comment', '2025-12-17 12:25:56'),
(12, 12, 2, 'ok 3 days to start', '2025-12-17 12:26:22'),
(13, 12, 1, 'ok inform it when starts', '2025-12-17 12:26:45'),
(14, 12, 2, 'ok', '2025-12-17 12:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','employee') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@yopmail.com', '$2y$10$06zWfBDUL4b4yv2mVTicW.C7qoGgAX/JIF4ZuqywTj52qceN9NvzK', 'admin', '2025-12-17 03:18:08'),
(2, 'user1', 'user1@yopmail.com', '$2y$10$6Tou3L2U.WWScw8tV2fuEuvGA/7Jj//9Umm1f8IOB0MY/0fFughci', 'employee', '2025-12-17 04:02:17'),
(3, 'user2', 'user2@yopmail.com', '$2y$10$i71tW1eWlDqHxLYzp88smu.h5AbTIKbmSTXWZQxtqmc9mOywKJLZi', 'employee', '2025-12-17 04:15:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_comments`
--
ALTER TABLE `task_comments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `task_comments`
--
ALTER TABLE `task_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
