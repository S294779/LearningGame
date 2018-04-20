-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2018 at 04:07 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phaser_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `phaser_games`
--

CREATE TABLE `phaser_games` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `game_image` varchar(100) NOT NULL,
  `game_desc` text NOT NULL,
  `notify_new_version` enum('Yes','No') NOT NULL,
  `download_num` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_display` enum('Yes','No') NOT NULL,
  `episode_main_url` varchar(255) NOT NULL,
  `sounds` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phaser_games`
--

INSERT INTO `phaser_games` (`id`, `name`, `game_image`, `game_desc`, `notify_new_version`, `download_num`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_display`, `episode_main_url`, `sounds`) VALUES
(1, 'Drawing game', '1522486222.jpg', '<p>Drawing game</p>', 'Yes', 0, '2018-03-18 12:23:05', '2018-03-31 14:35:23', 1, 0, 'Yes', '/phaser-game/drawing-level-maintain', '{\"game_default_sound\":\"default-sound-1522486223.mp3\",\"pick_star_sound\":\"star-1522486223.mp3\"}'),
(2, 'Letter Finding Game', '1522486259.jpg', '<p>sdfsd</p>', 'Yes', 0, '2018-03-18 22:09:41', '2018-03-31 14:35:59', 1, 0, 'Yes', '/phaser-game/letter-finding-level-maintain', '{\"game_default_sound\":\"default-sound-1522486259.mp3\",\"pick_star_sound\":\"star-1522486259.mp3\"}');

-- --------------------------------------------------------

--
-- Table structure for table `phaser_game_episode`
--

CREATE TABLE `phaser_game_episode` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `episode_name` varchar(255) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `episode_datas` text,
  `episode_desc` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phaser_game_episode`
--

INSERT INTO `phaser_game_episode` (`id`, `game_id`, `episode_name`, `level`, `episode_datas`, `episode_desc`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'a', 1, '{\"curve_color\":\"0xff0000\",\"drag_point_coordinates\":{\"1st\":[[499,149],[353,159],[337,358],[490,258]],\"2nd\":[[499,151],[494,248],[509,292],[551,297]]},\"game_id\":\"1\",\"background_img\":\"1522486286.jpg\"}', '<p>sdfsdfsd</p>', '2018-03-18 12:44:28', '2018-03-31 14:36:28', 1, 1),
(2, 1, 'b', 1, '{\"curve_color\":\"0xff0000\",\"drag_point_coordinates\":{\"1st\":[[501,193],[503,240],[504,371],[503,432]],\"2nd\":[[509,314],[651,294],[633,449],[514,431]]},\"background_img\":\"1521396941.jpg\"}', '<p>sdfdsfds</p>', '2018-03-18 18:40:21', '2018-03-23 07:04:38', 1, 1),
(16, 2, 'Find Letter \'m\'', 1, '{\"background_img\":\"1522486356.jpg\",\"choice_options\":[\"m\",\"m\",\"m\",\"a\",\"c\",\"m\",\"y\",\"j\",\"m\",\"Q\",\"m\",\"L\"],\"correct_answers\":[\"m\",\"m\",\"m\",\"m\",\"m\",\"m\"],\"command_sound\":\"1523550598.mp3\"}', '<p>This is game for finding letter a from moving letters.</p>', '2018-03-19 00:04:40', '2018-04-13 00:33:45', 1, 1),
(17, 2, 'Find Letter \'k\'', 4, '{\"background_img\":\"1521397495.jpg\",\"choice_options\":[\"k\",\"c\",\"x\",\"k\",\"z\",\"h\",\"h\",\"h\",\"k\",\"h\",\"k\",\"y\"],\"correct_answers\":[\"k\",\"k\",\"k\",\"k\"],\"command_sound\":\"1523556879.mp3\"}', '<p>k</p>', '2018-03-19 00:09:55', '2018-04-13 00:33:46', 1, 1),
(18, 2, 'Find Letter \'i\'', 2, '{\"background_img\":\"1523505262.jpg\",\"choice_options\":{\"0\":\"a\",\"1\":\"c\",\"2\":\"i\",\"3\":\"i\",\"4\":\"i\",\"6\":\"i\"},\"correct_answers\":[\"i\",\"i\",\"i\",\"i\"],\"command_sound\":\"1523555200.mp3\"}', '<p>I</p>', '2018-03-19 00:26:45', '2018-04-13 00:33:46', 1, 1),
(20, 1, 'c', NULL, '{\"curve_color\":\"0xff0000\",\"drag_point_coordinates\":{\"1st\":[[500,198],[323,186],[325,425],[500,400]]},\"background_img\":\"1521596131.jpg\"}', '<p>fdyrtd</p>', '2018-03-21 07:20:31', '2018-03-23 07:04:38', 1, 0),
(21, 1, 'd', NULL, '{\"curve_color\":\"0xff0000\",\"drag_point_coordinates\":{\"1st\":[[507,195],[502,265],[502,348],[505,391]],\"2nd\":[[505,300],[348,278],[351,406],[503,391]]},\"background_img\":\"1521596194.jpg\"}', '<p>yrtuiy</p>', '2018-03-21 07:21:34', '2018-03-23 07:04:38', 1, 0),
(22, 1, 'e', NULL, '{\"curve_color\":\"0xff80c0\",\"drag_point_coordinates\":{\"1st\":[[485,209],[381,150],[269,476],[500,379]],\"2nd\":[[503,207],[500,200],[560,390],[393,272]]},\"background_img\":\"1521596334.jpg\"}', '<p>eryhg</p>\r\n<p>&nbsp;</p>', '2018-03-21 07:23:53', '2018-03-23 07:04:38', 1, 0),
(23, 2, 'Find Letter \'a\'', 1, '{\"choice_options\":[\"a\",\"z\",\"g\",\"k\",\"s\",\"i\",\"c\",\"t\",\"u\",\"x\",\"a\",\"g\"],\"correct_answers\":[\"a\",\"a\"],\"command_sound\":\"1523553234.mp3\"}', '<p>For Find letter \"a\"</p>', '2018-04-12 22:45:07', '2018-04-13 00:33:45', 1, 1),
(24, 2, 'Find Letter \'s\'', 1, '{\"choice_options\":[\"x\",\"s\",\"f\",\"s\",\"l\",\"m\",\"g\",\"z\",\"o\",\"s\",\"s\",\"s\"],\"correct_answers\":[\"s\",\"s\",\"s\",\"s\",\"s\"],\"command_sound\":\"1523553943.mp3\"}', '<p>Letter s</p>', '2018-04-12 23:05:03', '2018-04-13 00:33:45', 1, 1),
(25, 2, 'Find the letter t', 1, '{\"choice_options\":[\"t\",\"j\",\"t\",\"v\",\"n\",\"e\",\"w\",\"t\",\"r\",\"t\",\"u\",\"y\"],\"correct_answers\":[\"t\",\"t\",\"t\",\"t\"],\"command_sound\":\"1523556108.mp3\"}', '<p>T</p>', '2018-04-12 23:08:45', '2018-04-13 00:33:45', 1, 1),
(26, 2, 'Find Letter \'d\'', 2, '{\"choice_options\":[\"d\",\"a\",\"d\",\"b\",\"d\",\"z\",\"g\",\"d\",\"r\",\"d\",\"c\",\"d\"],\"correct_answers\":[\"d\",\"d\",\"d\",\"d\",\"d\",\"d\"],\"command_sound\":\"1523558951.mp3\"}', '<p>d</p>', '2018-04-12 23:34:10', '2018-04-13 00:34:11', 1, 1),
(27, 2, 'Find Letter \'f\'', 2, '{\"choice_options\":[\"f\",\"g\",\"d\",\"f\",\"x\",\"q\",\"g\",\"f\",\"l\",\"p\",\"f\",\"m\"],\"correct_answers\":[\"f\",\"f\",\"f\",\"f\"],\"command_sound\":\"1523556078.mp3\"}', '<p>f</p>', '2018-04-12 23:38:03', '2018-04-13 00:33:45', 1, 1),
(28, 2, 'Find Letter \'n\'', 2, '{\"choice_options\":[\"n\",\"x\",\"n\",\"m\",\"n\",\"a\",\"n\",\"o\",\"u\",\"n\",\"b\",\"t\"],\"correct_answers\":[\"n\",\"n\",\"n\",\"n\",\"n\"],\"command_sound\":\"1523556088.mp3\"}', '<p>n</p>', '2018-04-12 23:39:50', '2018-04-13 00:33:45', 1, 1),
(29, 2, 'Find Letter \'p\'', 2, '{\"choice_options\":[\"p\",\"b\",\"p\",\"b\",\"d\",\"a\",\"u\",\"p\",\"h\",\"p\",\"m\",\"f\"],\"correct_answers\":[\"p\",\"p\",\"p\",\"p\"],\"command_sound\":\"1523555979.mp3\"}', '<p>p</p>', '2018-04-12 23:44:39', '2018-04-13 00:33:45', 1, 0),
(30, 2, 'Find Letter \'o\'', 3, '{\"choice_options\":[\"o\",\"d\",\"b\",\"o\",\"j\",\"b\",\"h\",\"o\",\"v\",\"k\",\"o\",\"n\"],\"correct_answers\":[\"o\",\"o\",\"o\",\"o\"],\"command_sound\":\"1523556263.mp3\"}', '<p>o</p>', '2018-04-12 23:49:23', '2018-04-13 00:33:46', 1, 0),
(31, 2, 'Find Letter \'e\'', 3, '{\"choice_options\":[\"e\",\"a\",\"e\",\"e\",\"w\",\"t\",\"z\",\"e\",\"x\",\"e\",\"j\",\"e\"],\"correct_answers\":[\"e\",\"e\",\"e\",\"e\",\"e\",\"e\"],\"command_sound\":\"1523556359.mp3\"}', '<p>e</p>', '2018-04-12 23:50:59', '2018-04-13 00:33:46', 1, 0),
(32, 2, 'Find Letter \'g\'', 3, '{\"choice_options\":[\"a\",\"y\",\"g\",\"g\",\"v\",\"x\",\"j\",\"g\",\"l\",\"g\",\"g\",\"z\"],\"correct_answers\":[\"g\",\"g\",\"g\",\"g\",\"g\"],\"command_sound\":\"1523556462.mp3\"}', '<p>g</p>', '2018-04-12 23:52:42', '2018-04-13 00:33:46', 1, 0),
(33, 2, 'Find Letter \'r\'', 3, '{\"choice_options\":[\"y\",\"o\",\"b\",\"x\",\"r\",\"p\",\"u\",\"a\",\"r\",\"r\",\"j\",\"r\"],\"correct_answers\":[\"r\",\"r\",\"r\",\"r\"],\"command_sound\":\"1523556598.mp3\"}', '<p>r</p>', '2018-04-12 23:54:58', '2018-04-13 00:33:46', 1, 0),
(34, 2, 'Find Letter \'h\'', 3, '{\"choice_options\":[\"n\",\"h\",\"v\",\"h\",\"n\",\"u\",\"i\",\"h\",\"n\",\"h\",\"x\",\"k\"],\"correct_answers\":[\"h\",\"h\",\"h\",\"h\"],\"command_sound\":\"1523556678.mp3\"}', '<p>h</p>', '2018-04-12 23:56:18', '2018-04-13 00:33:46', 1, 0),
(35, 2, 'Find Letter \'c\'', 4, '{\"choice_options\":[\"f\",\"e\",\"g\",\"c\",\"e\",\"j\",\"e\",\"c\",\"c\",\"g\",\"c\",\"s\"],\"correct_answers\":[\"c\",\"c\",\"c\",\"c\"],\"command_sound\":\"1523556981.mp3\"}', '<p>c</p>', '2018-04-13 00:01:21', '2018-04-13 00:33:46', 1, 0),
(36, 2, 'Find Letter \'u\'', 4, '{\"choice_options\":{\"0\":\"u\",\"1\":\"a\",\"2\":\"v\",\"3\":\"l\",\"4\":\"v\",\"5\":\"p\",\"6\":\"v\",\"7\":\"u\",\"9\":\"w\",\"10\":\"k\",\"11\":\"m\"},\"correct_answers\":[\"u\",\"u\"],\"command_sound\":\"1523557061.mp3\"}', '<p>u</p>', '2018-04-13 00:02:41', '2018-04-13 00:33:46', 1, 0),
(37, 2, 'Find Letter \'b\'', 4, '{\"choice_options\":[\"b\",\"t\",\"b\",\"v\",\"b\",\"k\",\"p\",\"b\",\"p\",\"u\",\"c\",\"m\"],\"correct_answers\":[\"b\",\"b\",\"b\",\"b\"],\"command_sound\":\"1523557158.mp3\"}', '<p>b</p>', '2018-04-13 00:04:18', '2018-04-13 00:33:46', 1, 0),
(38, 2, 'Find Letter \'l\'', 5, '{\"choice_options\":[\"i\",\"j\",\"l\",\"i\",\"p\",\"g\",\"h\",\"l\",\"a\",\"o\",\"t\",\"l\"],\"correct_answers\":[\"l\",\"l\",\"l\"],\"command_sound\":\"1523557307.mp3\"}', '<p>l</p>', '2018-04-13 00:06:47', '2018-04-13 00:33:46', 1, 0),
(39, 2, 'Find Letter \'j\'', 5, '{\"choice_options\":[\"k\",\"j\",\"j\",\"l\",\"p\",\"j\",\"i\",\"i\",\"j\",\"l\",\"t\",\"n\"],\"correct_answers\":[\"j\",\"j\",\"j\",\"j\"],\"command_sound\":\"1523558049.mp3\"}', '<p>j</p>', '2018-04-13 00:19:09', '2018-04-13 00:33:46', 1, 0),
(40, 2, 'Find Letter \'y\'', 5, '{\"choice_options\":[\"y\",\"j\",\"g\",\"q\",\"y\",\"m\",\"g\",\"a\",\"y\",\"p\",\"v\",\"y\"],\"correct_answers\":[\"y\",\"y\",\"y\",\"y\"],\"command_sound\":\"1523558173.mp3\"}', '<p>y</p>', '2018-04-13 00:21:13', '2018-04-13 00:33:46', 1, 0),
(41, 2, 'Find Letter \'v\'', 5, '{\"choice_options\":[\"u\",\"v\",\"c\",\"v\",\"m\",\"b\",\"a\",\"r\",\"v\",\"k\",\"f\",\"i\"],\"correct_answers\":[\"v\",\"v\",\"v\"],\"command_sound\":\"1523558275.mp3\"}', '<p>v</p>', '2018-04-13 00:22:55', '2018-04-13 00:33:46', 1, 0),
(42, 2, 'Find Letter \'w\'', 6, '{\"choice_options\":[\"w\",\"z\",\"w\",\"m\",\"c\",\"o\",\"x\",\"m\",\"p\",\"k\",\"h\",\"w\"],\"correct_answers\":[\"w\",\"w\",\"w\"],\"command_sound\":\"1523558403.mp3\"}', '<p>w</p>', '2018-04-13 00:25:03', '2018-04-13 00:33:47', 1, 0),
(43, 2, 'Find Letter \'z\'', 6, '{\"choice_options\":[\"z\",\"s\",\"d\",\"h\",\"z\",\"z\",\"g\",\"t\",\"z\",\"s\",\"n\",\"r\"],\"correct_answers\":[\"z\",\"z\",\"z\",\"z\"],\"command_sound\":\"1523558730.mp3\"}', '<p>z</p>', '2018-04-13 00:30:30', '2018-04-13 00:33:47', 1, 0),
(44, 2, 'Find Letter \'x\'', 6, '{\"choice_options\":[\"a\",\"t\",\"u\",\"x\",\"q\",\"y\",\"u\",\"x\",\"t\",\"w\",\"p\",\"x\"],\"correct_answers\":[\"x\",\"x\",\"x\"],\"command_sound\":\"1523558807.mp3\"}', '<p>x</p>', '2018-04-13 00:31:47', '2018-04-13 00:33:46', 1, 0),
(45, 2, 'Find Letter \'q\'', 6, '{\"choice_options\":[\"q\",\"k\",\"d\",\"c\",\"m\",\"q\",\"p\",\"q\",\"v\",\"y\",\"z\",\"r\"],\"correct_answers\":[\"q\",\"q\",\"q\"],\"command_sound\":\"1523558896.mp3\"}', '<p>q</p>', '2018-04-13 00:33:16', '2018-04-13 00:33:46', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phaser_student_progress`
--

CREATE TABLE `phaser_student_progress` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `submitted_answers` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phaser_student_progress`
--

INSERT INTO `phaser_student_progress` (`id`, `student_id`, `game_id`, `level_id`, `episode_id`, `submitted_answers`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, 16, '[\"m\",\"m\",\"m\",\"m\",\"m\",\"m\"]', '2018-04-13 00:34:45', '2018-04-13 00:34:45'),
(2, 4, 2, 1, 23, '[\"a\",\"a\"]', '2018-04-13 00:34:51', '2018-04-13 00:34:51'),
(3, 4, 2, 1, 24, '[\"s\",\"s\",\"s\",\"s\",\"s\"]', '2018-04-13 00:34:58', '2018-04-13 00:34:58'),
(4, 4, 2, 1, 25, '[\"t\",\"t\",\"t\",\"t\"]', '2018-04-13 00:35:04', '2018-04-13 00:35:04'),
(5, 4, 2, 2, 18, '[\"i\",\"i\",\"i\",\"i\"]', '2018-04-13 00:35:10', '2018-04-13 00:35:10'),
(6, 4, 2, 2, 26, '[\"d\",\"d\",\"d\",\"d\",\"d\",\"d\"]', '2018-04-13 00:35:19', '2018-04-13 00:35:19'),
(7, 4, 2, 2, 27, '[\"f\",\"f\",\"f\",\"f\"]', '2018-04-13 00:35:31', '2018-04-13 00:35:31'),
(8, 4, 2, 2, 28, '[\"n\",\"n\",\"n\",\"n\",\"n\"]', '2018-04-13 00:35:39', '2018-04-13 00:35:39'),
(9, 4, 2, 2, 29, '[\"p\",\"p\",\"p\",\"p\"]', '2018-04-13 00:35:47', '2018-04-13 00:35:47'),
(10, 4, 2, 3, 30, '[\"o\",\"o\",\"o\",\"o\"]', '2018-04-13 00:35:55', '2018-04-13 00:35:55'),
(11, 4, 2, 3, 31, '[\"e\",\"e\",\"e\",\"e\",\"e\",\"e\"]', '2018-04-13 00:36:05', '2018-04-13 00:36:05'),
(12, 4, 2, 3, 32, '[\"g\",\"g\",\"g\",\"g\",\"g\"]', '2018-04-13 00:36:12', '2018-04-13 00:36:12'),
(13, 4, 2, 3, 33, '[\"r\",\"r\",\"r\",\"r\"]', '2018-04-13 00:36:19', '2018-04-13 00:36:19'),
(14, 4, 2, 3, 34, '[\"h\",\"h\",\"h\",\"h\"]', '2018-04-13 00:36:26', '2018-04-13 00:36:26'),
(15, 4, 2, 4, 17, '[\"k\",\"k\",\"k\",\"k\"]', '2018-04-13 00:36:34', '2018-04-13 00:36:34'),
(16, 4, 2, 4, 35, '[\"c\",\"c\",\"c\",\"c\"]', '2018-04-13 00:36:41', '2018-04-13 00:36:41'),
(17, 4, 2, 4, 36, '[\"u\",\"u\"]', '2018-04-13 00:36:47', '2018-04-13 00:36:47'),
(18, 4, 2, 4, 37, '[\"b\",\"b\",\"b\",\"b\"]', '2018-04-13 00:36:57', '2018-04-13 00:36:57'),
(19, 4, 2, 5, 38, '[\"l\",\"l\",\"l\"]', '2018-04-13 00:37:03', '2018-04-13 00:37:03'),
(20, 4, 2, 5, 39, '[\"j\",\"j\",\"j\",\"j\"]', '2018-04-13 00:37:15', '2018-04-13 00:37:15'),
(21, 4, 2, 5, 40, '[\"y\",\"y\",\"y\",\"y\"]', '2018-04-13 00:37:21', '2018-04-13 00:37:21'),
(22, 4, 2, 5, 41, '[\"v\",\"v\",\"v\"]', '2018-04-13 00:37:27', '2018-04-13 00:37:27'),
(23, 4, 2, 6, 42, '[\"w\",\"w\",\"w\"]', '2018-04-13 00:37:35', '2018-04-13 00:37:35'),
(24, 4, 2, 6, 43, '[\"z\",\"z\",\"z\",\"z\"]', '2018-04-13 00:37:49', '2018-04-13 00:37:49'),
(25, 4, 2, 6, 44, '[\"x\",\"x\",\"x\"]', '2018-04-13 00:37:56', '2018-04-13 00:37:56'),
(26, 4, 2, 6, 45, '[\"q\",\"q\",\"q\"]', '2018-04-13 00:38:04', '2018-04-13 00:38:04'),
(27, 9, 2, 1, 16, '[\"m\",\"m\",\"m\",\"m\",\"m\",\"m\"]', '2018-04-13 00:44:43', '2018-04-13 00:44:43'),
(28, 9, 2, 1, 23, '[\"a\",\"a\"]', '2018-04-13 00:44:51', '2018-04-13 00:44:51'),
(29, 9, 2, 1, 24, '[\"s\",\"s\",\"s\",\"s\",\"s\"]', '2018-04-13 00:44:58', '2018-04-13 00:44:58'),
(30, 9, 2, 1, 25, '[\"t\",\"t\",\"t\",\"t\"]', '2018-04-13 00:45:06', '2018-04-13 00:45:06'),
(31, 9, 2, 2, 18, '[\"i\",\"i\",\"i\",\"i\"]', '2018-04-13 00:45:12', '2018-04-13 00:45:12'),
(32, 9, 2, 2, 26, '[\"d\",\"d\",\"d\",\"d\",\"d\",\"d\"]', '2018-04-13 00:45:21', '2018-04-13 00:45:21'),
(33, 9, 2, 2, 27, '[\"f\",\"f\",\"f\",\"f\"]', '2018-04-13 00:45:29', '2018-04-13 00:45:29'),
(34, 9, 2, 2, 28, '[\"n\",\"n\",\"n\",\"n\",\"n\"]', '2018-04-13 00:45:37', '2018-04-13 00:45:37'),
(35, 9, 2, 2, 29, '[\"p\",\"p\",\"p\",\"p\"]', '2018-04-13 00:45:44', '2018-04-13 00:45:44'),
(36, 9, 2, 3, 30, '[\"o\",\"o\",\"o\",\"o\"]', '2018-04-13 00:45:51', '2018-04-13 00:45:51'),
(37, 9, 2, 3, 31, '[\"e\",\"e\",\"e\",\"e\",\"e\",\"e\"]', '2018-04-13 00:46:01', '2018-04-13 00:46:01'),
(38, 9, 2, 3, 32, '[\"g\",\"g\",\"g\",\"g\",\"g\"]', '2018-04-13 00:46:10', '2018-04-13 00:46:10'),
(39, 9, 2, 3, 33, '[\"r\",\"r\",\"r\",\"r\"]', '2018-04-13 00:46:17', '2018-04-13 00:46:17'),
(40, 9, 2, 3, 34, '[\"h\",\"h\",\"h\",\"h\"]', '2018-04-13 00:46:25', '2018-04-13 00:46:25'),
(41, 9, 2, 4, 17, '[\"k\",\"k\",\"k\",\"k\"]', '2018-04-13 00:46:34', '2018-04-13 00:46:34'),
(42, 9, 2, 4, 35, '[\"c\",\"c\",\"c\",\"c\"]', '2018-04-13 00:46:40', '2018-04-13 00:46:40'),
(43, 9, 2, 4, 36, '[\"u\",\"u\"]', '2018-04-13 00:46:46', '2018-04-13 00:46:46'),
(44, 9, 2, 4, 37, '[\"b\",\"b\",\"b\",\"b\"]', '2018-04-13 00:47:03', '2018-04-13 00:47:03'),
(45, 9, 2, 5, 38, '[\"l\",\"l\",\"l\"]', '2018-04-13 00:47:10', '2018-04-13 00:47:10'),
(46, 9, 2, 5, 39, '[\"j\",\"j\",\"j\",\"j\"]', '2018-04-13 00:47:19', '2018-04-13 00:47:19'),
(47, 9, 2, 5, 40, '[\"y\",\"y\",\"y\",\"y\"]', '2018-04-13 00:47:36', '2018-04-13 00:47:36'),
(48, 9, 2, 5, 41, '[\"v\",\"v\",\"v\"]', '2018-04-13 00:47:42', '2018-04-13 00:47:42'),
(49, 9, 2, 6, 42, '[\"w\",\"w\",\"w\"]', '2018-04-13 00:47:49', '2018-04-13 00:47:49'),
(50, 9, 2, 6, 43, '[\"z\",\"z\",\"z\",\"z\"]', '2018-04-13 00:47:58', '2018-04-13 00:47:58'),
(51, 9, 2, 6, 44, '[\"x\",\"x\",\"x\"]', '2018-04-13 00:48:04', '2018-04-13 00:48:04'),
(52, 9, 2, 6, 45, '[\"q\",\"q\",\"q\"]', '2018-04-13 00:48:13', '2018-04-13 00:48:13'),
(53, 7, 2, 1, 16, '[\"m\",\"m\",\"m\",\"m\",\"m\",\"m\"]', '2018-04-13 00:54:13', '2018-04-13 00:54:13'),
(54, 7, 2, 1, 23, '[\"a\",\"a\"]', '2018-04-13 00:54:18', '2018-04-13 00:54:18'),
(55, 7, 2, 1, 24, '[\"s\",\"s\",\"s\",\"s\",\"s\"]', '2018-04-13 00:54:28', '2018-04-13 00:54:28'),
(56, 7, 2, 1, 25, '[\"t\",\"t\",\"t\",\"t\"]', '2018-04-13 00:54:35', '2018-04-13 00:54:35'),
(57, 7, 2, 2, 18, '[\"i\",\"i\",\"i\",\"i\"]', '2018-04-13 00:54:41', '2018-04-13 00:54:41'),
(58, 7, 2, 2, 26, '[\"d\",\"d\",\"d\",\"d\",\"d\",\"d\"]', '2018-04-13 00:54:50', '2018-04-13 00:54:50'),
(59, 7, 2, 2, 27, '[\"f\",\"f\",\"f\",\"f\"]', '2018-04-13 00:55:00', '2018-04-13 00:55:00'),
(60, 7, 2, 2, 28, '[\"n\",\"n\",\"n\",\"n\",\"n\"]', '2018-04-13 00:55:13', '2018-04-13 00:55:13'),
(61, 7, 2, 2, 29, '[\"p\",\"p\",\"p\",\"p\"]', '2018-04-13 00:55:20', '2018-04-13 00:55:20'),
(62, 7, 2, 3, 30, '[\"o\",\"o\",\"o\",\"o\"]', '2018-04-13 00:55:27', '2018-04-13 00:55:27'),
(63, 7, 2, 3, 31, '[\"e\",\"e\",\"e\",\"e\",\"e\",\"e\"]', '2018-04-13 00:55:36', '2018-04-13 00:55:36'),
(64, 7, 2, 3, 32, '[\"g\",\"g\",\"g\",\"g\",\"g\"]', '2018-04-13 00:55:47', '2018-04-13 00:55:47'),
(65, 7, 2, 3, 33, '[\"r\",\"r\",\"r\",\"r\"]', '2018-04-13 00:55:53', '2018-04-13 00:55:53'),
(66, 7, 2, 3, 34, '[\"h\",\"h\",\"h\",\"h\"]', '2018-04-13 00:56:09', '2018-04-13 00:56:09'),
(67, 7, 2, 4, 17, '[\"k\",\"k\",\"k\",\"k\"]', '2018-04-13 00:56:18', '2018-04-13 00:56:18'),
(68, 7, 2, 4, 35, '[\"c\",\"c\",\"c\",\"c\"]', '2018-04-13 00:56:30', '2018-04-13 00:56:30'),
(69, 7, 2, 4, 36, '[\"u\",\"u\"]', '2018-04-13 00:56:37', '2018-04-13 00:56:37'),
(70, 7, 2, 4, 37, '[\"b\",\"b\",\"b\",\"b\"]', '2018-04-13 00:56:49', '2018-04-13 00:56:49'),
(71, 7, 2, 5, 38, '[\"l\",\"l\",\"l\"]', '2018-04-13 00:56:58', '2018-04-13 00:56:58'),
(72, 7, 2, 5, 39, '[\"j\",\"j\",\"j\",\"j\"]', '2018-04-13 00:57:12', '2018-04-13 00:57:12'),
(73, 7, 2, 5, 40, '[\"y\",\"y\",\"y\",\"y\"]', '2018-04-13 00:57:23', '2018-04-13 00:57:23'),
(74, 7, 2, 5, 41, '[\"v\",\"v\",\"v\"]', '2018-04-13 00:57:35', '2018-04-13 00:57:35'),
(75, 7, 2, 6, 42, '[\"w\",\"w\",\"w\"]', '2018-04-13 00:57:42', '2018-04-13 00:57:42'),
(76, 7, 2, 6, 43, '[\"z\",\"z\",\"z\",\"z\"]', '2018-04-13 00:57:48', '2018-04-13 00:57:48'),
(77, 7, 2, 6, 44, '[\"x\",\"x\",\"x\"]', '2018-04-13 00:57:54', '2018-04-13 00:57:54'),
(78, 7, 2, 6, 45, '[\"q\",\"q\",\"q\"]', '2018-04-13 00:58:05', '2018-04-13 00:58:05'),
(79, 13, 2, 1, 16, '[\"m\",\"m\",\"m\",\"m\",\"m\",\"m\"]', '2018-04-13 01:07:30', '2018-04-13 01:07:30'),
(80, 13, 2, 1, 23, '[\"a\",\"a\"]', '2018-04-13 01:07:35', '2018-04-13 01:07:35'),
(81, 13, 2, 1, 24, '[\"s\",\"s\",\"s\",\"s\",\"s\"]', '2018-04-13 01:07:45', '2018-04-13 01:07:45'),
(82, 13, 2, 1, 25, '[\"t\",\"t\",\"t\",\"t\"]', '2018-04-13 01:07:52', '2018-04-13 01:07:52'),
(83, 13, 2, 2, 18, '[\"i\",\"i\",\"i\",\"i\"]', '2018-04-13 01:07:59', '2018-04-13 01:07:59'),
(84, 13, 2, 2, 26, '[\"d\",\"d\",\"d\",\"d\",\"d\",\"d\"]', '2018-04-13 01:08:07', '2018-04-13 01:08:07'),
(85, 13, 2, 2, 27, '[\"f\",\"f\",\"f\",\"f\"]', '2018-04-13 01:08:15', '2018-04-13 01:08:15'),
(86, 13, 2, 2, 28, '[\"n\",\"n\",\"n\",\"n\",\"n\"]', '2018-04-13 01:08:21', '2018-04-13 01:08:21'),
(87, 13, 2, 2, 29, '[\"p\",\"p\",\"p\",\"p\"]', '2018-04-13 01:08:34', '2018-04-13 01:08:34'),
(88, 13, 2, 3, 30, '[\"o\",\"o\",\"o\",\"o\"]', '2018-04-13 01:08:40', '2018-04-13 01:08:40'),
(89, 13, 2, 3, 31, '[\"e\",\"e\",\"e\",\"e\",\"e\",\"e\"]', '2018-04-13 01:08:48', '2018-04-13 01:08:48'),
(90, 13, 2, 3, 32, '[\"g\",\"g\",\"g\",\"g\",\"g\"]', '2018-04-13 01:08:56', '2018-04-13 01:08:56'),
(91, 13, 2, 3, 33, '[\"r\",\"r\",\"r\",\"r\"]', '2018-04-13 01:09:03', '2018-04-13 01:09:03'),
(92, 13, 2, 3, 34, '[\"h\",\"h\",\"h\",\"h\"]', '2018-04-13 01:09:12', '2018-04-13 01:09:12'),
(93, 13, 2, 4, 17, '[\"k\",\"k\",\"k\",\"k\"]', '2018-04-13 01:09:22', '2018-04-13 01:09:22'),
(94, 13, 2, 4, 35, '[\"c\",\"c\",\"c\",\"c\"]', '2018-04-13 01:09:30', '2018-04-13 01:09:30'),
(95, 13, 2, 4, 36, '[\"u\",\"u\"]', '2018-04-13 01:09:37', '2018-04-13 01:09:37'),
(96, 13, 2, 4, 37, '[\"b\",\"b\",\"b\",\"b\"]', '2018-04-13 01:09:46', '2018-04-13 01:09:46'),
(97, 13, 2, 5, 38, '[\"l\",\"l\",\"l\"]', '2018-04-13 01:09:54', '2018-04-13 01:09:54'),
(98, 13, 2, 5, 39, '[\"j\",\"j\",\"j\",\"j\"]', '2018-04-13 01:10:00', '2018-04-13 01:10:00'),
(99, 13, 2, 5, 40, '[\"y\",\"y\",\"y\",\"y\"]', '2018-04-13 01:10:07', '2018-04-13 01:10:07'),
(100, 13, 2, 5, 41, '[\"v\",\"v\",\"v\"]', '2018-04-13 01:10:14', '2018-04-13 01:10:14'),
(101, 13, 2, 6, 42, '[\"w\",\"w\",\"w\"]', '2018-04-13 01:10:22', '2018-04-13 01:10:22'),
(102, 13, 2, 6, 43, '[\"z\",\"z\",\"z\",\"z\"]', '2018-04-13 01:10:30', '2018-04-13 01:10:30'),
(103, 13, 2, 6, 44, '[\"x\",\"x\",\"x\"]', '2018-04-13 01:10:37', '2018-04-13 01:10:37'),
(104, 13, 2, 6, 45, '[\"q\",\"q\",\"q\"]', '2018-04-13 01:10:43', '2018-04-13 01:10:43'),
(105, 6, 1, 1, 1, '[]', '2018-04-13 02:26:56', '2018-04-13 02:26:56'),
(106, 6, 1, 1, 2, '[]', '2018-04-13 02:27:05', '2018-04-13 02:27:05'),
(107, 5, 2, 1, 16, '[\"m\",\"m\",\"m\",\"m\",\"m\",\"m\"]', '2018-04-13 07:22:20', '2018-04-13 07:22:20'),
(108, 5, 2, 1, 23, '[\"a\",\"a\"]', '2018-04-13 07:22:24', '2018-04-13 07:22:24'),
(109, 5, 2, 1, 24, '[\"s\",\"s\",\"s\",\"s\",\"s\"]', '2018-04-13 07:22:33', '2018-04-13 07:22:33'),
(110, 5, 2, 1, 25, '[\"t\",\"t\",\"t\",\"t\"]', '2018-04-13 07:22:42', '2018-04-13 07:22:42'),
(111, 5, 2, 2, 18, '[\"i\",\"i\",\"i\",\"i\"]', '2018-04-13 07:22:50', '2018-04-13 07:22:50'),
(112, 5, 2, 2, 26, '[\"d\",\"d\",\"d\",\"d\",\"d\",\"d\"]', '2018-04-13 07:23:02', '2018-04-13 07:23:02'),
(113, 5, 2, 2, 27, '[\"f\",\"f\",\"f\",\"f\"]', '2018-04-13 07:23:09', '2018-04-13 07:23:09'),
(114, 5, 2, 2, 28, '[\"n\",\"n\",\"n\",\"n\",\"n\"]', '2018-04-13 07:23:21', '2018-04-13 07:23:21'),
(115, 5, 2, 2, 29, '[\"p\",\"p\",\"p\",\"p\"]', '2018-04-13 07:23:29', '2018-04-13 07:23:29'),
(116, 4, 1, 1, 1, '[]', '2018-04-13 07:48:42', '2018-04-13 07:48:42'),
(117, 5, 1, 1, 1, '[]', '2018-04-13 07:49:48', '2018-04-13 07:49:48'),
(118, 4, 1, 1, 2, '[]', '2018-04-13 07:50:09', '2018-04-13 07:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `sys_admins`
--

CREATE TABLE `sys_admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `sys_admins`
--

INSERT INTO `sys_admins` (`id`, `name`, `email`, `profile_pic`, `phone`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '1.png', '4354353', 1, '$2y$10$ov45eR9.EwwE8fhXXoQu8eqlXnZj6Tp046UXgaTYb7Y0HTXTwMbjO', 'j0PdueIr7yZ05L1NbruKqJLCUTzZnwBHDH4qjK45O71Vk7W0htps0WOaH48J', '2017-04-08 06:10:09', '2018-04-12 19:43:47'),
(2, 'dgdgd', 'dgd@gfsdfsdf.gdfgdfg', '', '', 0, '$2y$10$.1dFKpOYr91no6vRmMv2suIyonoqUvmKq1pN5OEV6WeiryJ9AVT06', NULL, '2018-02-12 19:45:41', '2018-02-12 19:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `sys_migrations`
--

CREATE TABLE `sys_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `sys_password_resets`
--

CREATE TABLE `sys_password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `timezone` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`id`, `name`, `email`, `phone`, `profile_pic`, `password`, `remember_token`, `created_at`, `updated_at`, `group_id`, `timezone`, `status`) VALUES
(4, 'Kalcy', 'admin@gmail.com', '', '1523564434.jpg', '$2y$10$qGyIMzOgIRjZHwHozIhLre5vNqVSVj0wI7s2Mz5SH.HGvjmCyFVuW', NULL, '2018-03-17 11:21:42', '2018-04-12 20:20:34', NULL, NULL, 1),
(5, 'Ryab', 'sdfsd@sdfsdf.sdfdsfds', '', '1523564456.jpg', '$2y$10$4Q6Olz5Ua1Fq0XOYMfsJVOKl8RIULiamBR8XGv5EvoZv0bT4sAKJS', NULL, '2018-03-17 11:46:21', '2018-04-12 20:20:57', NULL, NULL, 1),
(6, 'Seraika', 'sdfsd@sdfs.sdfsdfsd', '', '1523564520.jpg', '$2y$10$KRYq/uKYGOrm9gpY5t.RFe5nUoCAu4AncFg4m7Vb9KXN0tCe/Gy9m', NULL, '2018-03-17 11:47:12', '2018-04-12 20:22:00', NULL, NULL, 1),
(7, 'rtreter', 'sfsdf@sdfdsfds.sdfdsf', '', '1523564533.jpg', '$2y$10$qYGlw8TZMaL8kkJGmx1.kOkP2s4zO9iygUXnZ5kZN/1uWyd7T.Ijm', NULL, '2018-03-18 00:14:14', '2018-04-12 20:22:13', NULL, NULL, 1),
(8, 'dgdfgd', 'dgdf@sdfds.sdfsdfds', '', '1523564559.jpg', '$2y$10$g78Z7fdiSymJ.El1reV0C.ysLmi0C8zfIH4.8cyWgpjRsV9oJLoyW', NULL, '2018-03-18 00:14:49', '2018-04-12 20:22:39', NULL, NULL, 1),
(9, 'dgdfgd', 'dgdf@sdfds.sdfsdfds', '', '1523564566.jpg', '$2y$10$I1epVWph8OHL.pLzJ34K9OY7lsqf8egg89lgYrvhAhPIS.38UzCmS', NULL, '2018-03-18 00:18:02', '2018-04-12 20:22:47', NULL, NULL, 1),
(10, 'sfsd', 'sdfsds@sdfdsf.sdfsdfsd', '', '1523564573.jpg', '$2y$10$nWkWjMdS0YZ9aymzABvpe.jh8/5.lgdkeNqPMm51z7eUHQGwg0PVi', NULL, '2018-03-18 00:42:30', '2018-04-12 20:22:53', NULL, NULL, 0),
(11, 'wsfsdfs', 'adad@sfsdf.sdfdsfds', '', '1523564581.jpg', '$2y$10$0ppNIBNeQNIbmD7TbH6RreKEEDdiDVrLHGOsJfMjN3.HqT1S9IJdm', NULL, '2018-03-18 00:42:57', '2018-04-12 20:23:01', NULL, NULL, 1),
(12, 'wesrfrewrew', 'asdfasdas@safdasdsa.asdsadsa', '', '1523564589.jpg', '$2y$10$17iOV/8/bEfTnyCVRlCx/uZBVmupEnZzZZQmDl2VNw4A7NL5vGAy2', NULL, '2018-03-18 00:43:27', '2018-04-12 20:23:10', NULL, NULL, 1),
(13, 'sdfsdfsd', 'adada@awdaa.asdasdsa', '', '1523564596.jpg', '$2y$10$keGOAyB2U0U50kyv2z1xk.pn5Xk00RmGNlHkye4CX64CJTHIqCMae', NULL, '2018-03-18 00:43:56', '2018-04-12 20:23:16', NULL, NULL, 1),
(14, 'sfsfsd', 'sfsdfsd@sfsdfsd.sdfsdfs', '', '1523564602.jpg', '$2y$10$KDOB35C9E1u8KUwCzVbdzux1FxnuKxCSZOfbA1S/oHSG6gxZqlC8K', NULL, '2018-03-18 00:44:38', '2018-04-12 20:23:22', NULL, NULL, 1),
(15, 'eerter', 'sfsd@fsdfs.sdfsdfs', '', '1523564608.jpg', '$2y$10$TjGPC8G89AsU4fG61WThSehoTehJ8/s/dP4rtxI7/SaFePJO/m7aW', NULL, '2018-03-18 00:48:57', '2018-04-12 20:23:28', NULL, NULL, 1),
(16, 'sdffs', 'sdfsdfsd@sdfsdfs.sdfsdfs', '', '1523564615.jpg', '$2y$10$rTcyqmoNJCHB217W.jQvLO3O51R43q3uMBX09jbjEPbqEuHXSKPG6', NULL, '2018-03-18 00:49:39', '2018-04-12 20:23:35', NULL, NULL, 1),
(17, 'sffd', 'sdfsdfds@sdfsdfsd.sdfsdfs', '', '1523564620.jpg', '$2y$10$GbGPeVf9mbadPuecZHDGoOjjhQ4Pm85O9ZyPwP/Yg9y8fZswV2ni.', NULL, '2018-03-18 00:50:15', '2018-04-12 20:23:41', NULL, NULL, 1),
(18, 'asdsas', 'asdada@sdfsdfsd.sdfsdfs', '', '1523564626.jpg', '$2y$10$dsh4x7FZw3p.N85z8js3q.YGpUPeLyDPBHh35Jx3PsPFI8kGRILIe', NULL, '2018-03-18 00:51:57', '2018-04-12 20:23:46', NULL, NULL, 1),
(19, 'qwerwrwe', 'werwrwe@sdfsdfsd.fsdfsdf', '', '1523564632.jpg', '$2y$10$20rV0aZuq2bHggwbmIZ2H.a0tnTYHtgEDhfpBozEToUKyVAXaIDfm', NULL, '2018-03-18 00:56:39', '2018-04-12 20:23:52', NULL, NULL, 0),
(20, 'sfdsdfsd', 'sdfsdfsd@fsdfsdfs.sdfsdfsd', '', '1523564638.jpg', '$2y$10$yO2/GwmbF/F7fUPmdFUVu.uOk9KqYOjXh8O6LtXIvGodX2xOW2XuC', NULL, '2018-03-18 00:57:23', '2018-04-12 20:23:59', NULL, NULL, 0),
(21, 'sdfdfsd', 'sdfdsfds@fsdfsdf.sdfdsfsd', '', '1523564646.jpg', '$2y$10$P3ltgquPYnpPq/QcPA0DLeyyMLNvLoebwQFJkNGfm9d7oAz0M82x.', NULL, '2018-03-18 00:57:48', '2018-04-12 20:24:06', NULL, NULL, 1),
(22, 'sfsdfsd', 'sdfdsfsd@sfsdfsd.sdfsdfs', '', '1523564651.jpg', '$2y$10$pCDoqk0dwLsQRhdkbsd9Ju2gNOdGtjW4eE/LwDLPztbTLIuCiIMXW', NULL, '2018-03-18 00:58:30', '2018-04-12 20:24:11', NULL, NULL, 0),
(23, 'sdfsdfsd', 'sdfsdfds@asdfsaa.sfsasdfds', '', '1523564657.jpg', '$2y$10$kJj.xisPyS7v6HYisisUwucHC9Y.WdMsVHn.z2uHWH71e1.Hd6ZGu', NULL, '2018-03-18 00:58:55', '2018-04-12 20:24:17', NULL, NULL, 1),
(24, 'sdfsdfsdf', 'sdfsdfs@dfsadas.sdfsdfds', '', '1523564663.jpg', '$2y$10$GEsG/vxIPcAXi92fs6O3FeGouOEsQZxM6Wy8Dggxm/.xFihhu/D/q', NULL, '2018-03-18 00:59:20', '2018-04-12 20:24:24', NULL, NULL, 1),
(25, 'dssfsd', 'sdfsd@dsfsdfsd.sdfsdfsd', '', '1523564671.jpg', '$2y$10$.2OfuRueucMtlAYi12I1de73cit/HzA9R4AM1E3B.it8ZENTSx8E2', NULL, '2018-03-18 00:59:57', '2018-04-12 20:24:31', NULL, NULL, 1),
(26, 'qweqwewq', 'qwewqeq@dsfsdf.sdfdsf', '', '1523564680.jpg', '$2y$10$/MswgUDlAZVgfFpUAcjS8ORt5FX9dypzPUDy/MbhyS9XZJ2VoCQfO', NULL, '2018-03-18 01:00:19', '2018-04-12 20:24:40', NULL, NULL, 1),
(27, 'sdfdsfs', 'sdfsdfds@sdfsdf.sdfdsfds', '', '1523564687.jpg', '$2y$10$o6lP0eiYWFhUiTwY37xTd.Td26H9k3/gzE/EEd9jpvigUe0WPuxke', NULL, '2018-03-18 01:00:40', '2018-04-12 20:24:47', NULL, NULL, 1),
(28, 'sdfdsfsfs', 'dsfsdfsd@hfghfghjgf.sdgdgdfgfd', '', '1523564694.jpg', '$2y$10$WOpNdusT02R0.Ls.szJ6leIR/SVRZo5dd2WNk57gZN9wN2J5eIjM6', NULL, '2018-03-18 01:01:12', '2018-04-12 20:24:54', NULL, NULL, 1),
(29, 'dsfgdsfds', 'sdfsdfds@sdfdsfsd.sdfdsfds', '', '1523564700.jpg', '$2y$10$nq4ZZjiOL4.2TbmatkVdZ.7XS5wmVJMLM35J/dcZ5cZUcISaoc8X.', NULL, '2018-03-18 01:01:42', '2018-04-12 20:25:00', NULL, NULL, 1),
(30, 'sdfdsfdsfsd', NULL, NULL, '1523566457.jpg', '$2y$10$ov4F6jyQAKuWV37AIOx75egoElGMgtCnPErI8NscE.1Z2oiXIR.OK', NULL, '2018-04-12 20:54:17', '2018-04-12 20:54:17', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_token`
--

CREATE TABLE `sys_user_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_user_token`
--

INSERT INTO `sys_user_token` (`id`, `user_id`, `user_token`) VALUES
(1, 4, 'Ui8NU4IiFbL8FYYcveqaVmE1C2uZbQdLyt6pOQhW20WlSVjnZJXYjz1ArIRGc4se'),
(2, 5, 'cqCDmzdYndgCEmtxuxvNFjplM6ESeMCm7tR9yLTApJOPiK3faxnD4j5P7RNl4ack'),
(3, 6, '1aI4TJmD01ghK4fttGB1gXvPVrOpWspCNuqJSrYZyZ0ebm6nDywORXBW2t9axlx6'),
(4, 7, 'DTgvArMFqmHPS5gbgF1pM2exYjp3CbSKdsqQPNp1ROuRmsNz0z7JU4BG3iI45ZDm'),
(5, 9, '9N5TgoRfscwCL4mnY7VgR1AygeFUvmmi2kALswhln4o25F0wnKRoMvkvdfmv3Tiz'),
(6, 10, 'FmMp2B9jb2MoZ8eATAeKmzsCzCB9DiHV0N5hh6uwVBp58y7psnOMp5PYfAThuRiQ'),
(7, 11, 'Ep2Wuk6S026GpF7A1x2JAxpi2fATMH6sF2emkxF62B3d8tmrB9YDQ3c1Q6OSfb8B'),
(8, 12, 'xjiEbrhSjuYnbvhG68JKTtmUlvg3FiQg5QRWHdES2wh7ktfruSrSfeGWVrXJDM1f'),
(9, 13, 'syGSklUZ6RSHV7eQxwmplitDPEaaj6d9Y6b14TRrU89erYVxQ4LGjw3MP6RWYFd6'),
(10, 14, 'etJFy0pwzXmrXszfYGMT4SLebJftukXQ3qb5sZyihgtwLmVhKsXMBesJYImY6KSY'),
(11, 15, 'NUcr5odggjaJpQ6mXkDkMa7HCTgknQjWpofZAD3eMKJYSdGMsnawFRAH53EmAxQY'),
(12, 16, '7tMwZA4fNZXQzpPvmOGaYsqhhqmREe9dlcANQ5OQdHhcEbSDwDk0CrraLoOd8PWq'),
(13, 17, '509AnR52Mv2di0bdCUGIXBprZgHbVZL3CXwN3NmmrlvvkmNhSxFF7JxuVSHtFUjt'),
(14, 18, 'Ic2vwTs4XTVOSlseVszfJf9cH81zsVoEnQTKRutyoYooFQIKrLX2FNkyJlhwiQS7'),
(15, 19, 'zBccW4BQAqCXDLXgwuqdb0QCHrXjImlQSfAT3Q21IqKTShAFaDx7in1z6rR2jtLV'),
(16, 20, 'C577NkcP7KUShu4c38F62DPvmyOOZG5xV5VJGOnpj7LXx8AD0g1sQgI6OIWAx7fh'),
(17, 21, '2xgxVpSUH8dpSTRKQMxZa76FRr3Ur9URWnvpMuj7fnpcWTljy57U3C1LoEooYX9w'),
(18, 22, 'WDpCHdcb51hD05hPGNJgh71QrhLxlKkfgl8M7X55gulbjyFzBCqon3mDRiDKMZr9'),
(19, 23, 'pVTuUjPi3fCOp7gaR6cTzkuQUUozY0QwOk7BoyJPfJsHtcpLWMUBtsboU5APm2YI'),
(20, 24, 'UKP4HLn5iTkYMJiZsEAtKLyuH3yD2IW7eqoxbC6kSRbwpxYgJujzUWJP79Dpdk8h'),
(21, 25, 'abdDdNS1LqBJiJRglACH03tJRFz67xR8tNAMLn0lG0vbfGxgsbcOIcHQ9jWSS50z'),
(22, 26, 'aeZ5McSsIUPdXP9W8wTp1Y9ljrYSsvX1U5SrssWtGJHbo3E7ILvFm3WzYugskLz9'),
(23, 27, 'opnUEu3ChdGHWjQqun9JkYH8C5I23OiXSvqgLWyRUdXtEK9R4xqJ4z6gmTEHrWBK'),
(24, 28, 'MY2V8jk6TEDYo6h5xvSKD6znvUv7YzcfCfzNLBkPXLTuSY5wDhLsG2vnLWEQxpdr'),
(25, 29, 'w8lMvpqxSVqo7wx0pKzCRPYNHmers6Gx29l0HjgWqAfWzcSBoQyJWga1lFE46o7r'),
(30, 0, 'HEaQ1JcKSN9ozGjQOQw7sZUeJAyk7nFdbuzK46LrrmjcK23dd1MZgskNy4n9SWN8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phaser_games`
--
ALTER TABLE `phaser_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phaser_game_episode`
--
ALTER TABLE `phaser_game_episode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phaser_student_progress`
--
ALTER TABLE `phaser_student_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_admins`
--
ALTER TABLE `sys_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_migrations`
--
ALTER TABLE `sys_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_password_resets`
--
ALTER TABLE `sys_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_user_token`
--
ALTER TABLE `sys_user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phaser_games`
--
ALTER TABLE `phaser_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phaser_game_episode`
--
ALTER TABLE `phaser_game_episode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `phaser_student_progress`
--
ALTER TABLE `phaser_student_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `sys_admins`
--
ALTER TABLE `sys_admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sys_migrations`
--
ALTER TABLE `sys_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_password_resets`
--
ALTER TABLE `sys_password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sys_user_token`
--
ALTER TABLE `sys_user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
