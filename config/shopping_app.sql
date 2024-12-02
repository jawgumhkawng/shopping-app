-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 07:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(10, 'Shoe', 'shoes', '2023-11-01 16:16:49', '2023-09-24 12:09:52'),
(11, 'Shirt', 't shirt', '2023-11-02 16:16:58', '2023-09-24 14:12:09'),
(12, 'Bag', 'back bag', '2023-11-04 16:17:05', '2023-09-24 14:12:22'),
(13, 'jean', 'jean labu', '2023-11-05 16:17:11', '2023-11-04 22:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(7, '18', 'nawnaw', 'jaw20009@gmail.com', 'jjkkjj', 'hello', '2023-11-04'),
(8, '4', 'jawgum', 'jaw20008@gmail.com', 'tsawra', 'grai tsawra dik ai yaw tsaw', '2023-11-04'),
(9, '3', 'mr.bosco', 'jaw20007@gmail.com', 'aten grai na ai', 'hpa na wa mi aten dai ram na ai re ma?', '2023-11-04'),
(10, '2', 'jaw gum hkawng', 'qqqq@gmail.com', 'nothing', 'why do you spent my time', '2023-11-04'),
(11, '4', 'jawgum', 'jaw20008@gmail.com', 'what happen in kachin', 'Kachins are Jinghpaw, Maru (Lawngwaw), Lashi (Lachit), Zaiwa (Azi), Rawang, Lisu (some books mention Yodwin) and five other sub-groups. These six major groups, including five other different sub-groups, are together known as Kachins. They have same tradit', '2023-11-04'),
(12, '19', 'mr nhkum naw', 'jaw20010@gmail.com', 'hpa pi nk,a tsun sai wa re', 'Most of the Kachins live in their own land. They had a separate country before the British Rule, but then it became a part of Burma after the Rule. Total area of the Kachinland measures about 33,903 square miles, located between 23o-3\' to 28o - 29\' N Lati', '2023-11-04'),
(13, '3', 'mr.bosco', 'jaw20007@gmail.com', 'what happen in myanmar', 'myanmar militry coup !!', '2023-11-04'),
(14, '19', 'mr nhkum naw', 'jaw20010@gmail.com', 'jawgumhkawng', 'i am jaw gum hkawng,\r\ni am a web developer in myanmar', '2023-11-04'),
(15, '19', 'mr nhkum naw', 'jaw20010@gmail.com', 'a web dev in myanmar', 'i\'m web developer in myanmar.i also use PHP programming language.i professionally in php,javascript,laravel', '2023-11-04'),
(16, '3', 'mr.bosco', 'jaw20007@gmail.com', 'tsaw', 'tsaw ai yaw ra ai yaw ', '2023-11-05'),
(17, '20', 'nhkum wa', 'jaw20020@gmail.com', 'nice', 'this website is really work', '2023-11-05'),
(18, '21', 'bosco', 'jaw20021@gmail.com', '(SE) byin mayu ai lam', 'ngai (SE) software engineer byin mayu ai gara hku di ra na rai ta ? tsun dan yu rit le. gara hku shakut ra na rai? gara language hpe grau ahkyek ai hku shakut galaw ra na rai ta?(SE) hte jpn nreai tim sgp de sa mayu ai. dai de gaw (SE) madang rejang shata shabrai grau lu ai da.', '2023-11-06'),
(19, '22', 'web developer', 'jaw20022@gmail.com', 'hello admin', 'i hope  you are well.Please give 50% promotions', '2023-11-06'),
(20, '23', 'jeam', 'jaw20023@gmail.com', 'hey guy', 'are you ok.are you killing me right now?', '2023-11-06'),
(21, '24', 'jhon', 'jaw20024@gmail.com', 'lama mi  tsun dan na', 'jinghpaw mung dan shanglawt asuya ni a lam re', '2023-11-06'),
(22, '23', 'jeam', 'jaw20023@gmail.com', 'jjj', 'welcome', '2023-11-06'),
(23, '18', 'nawnaw', 'jaw20009@gmail.com', 'ggg', 'g&g', '2023-11-07'),
(24, '4', 'jawgum', 'jaw20008@gmail.com', 'nothing', 'hha hah', '2023-12-06'),
(25, '4', 'jawgum', 'jaw20008@gmail.com', '555', '5555', '2024-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(9, 'shoe', 'ngai mung chye hpa mi re', 10, 20, 400000, 'p1.jpg', '2023-11-01 16:12:47', '2023-10-29 11:04:37'),
(10, 'shoess', 'din ai baw re da hpa mi re ngai gaw nchye', 10, 296, 54000, 'p7.jpg', '2023-11-02 16:12:57', '2023-10-29 11:05:17'),
(11, 'Shoe', 'nchye law nchye law hpa hkum sa aw tsun', 10, 256, 59000, 'p6.jpg', '2023-11-04 16:13:07', '2023-10-29 11:05:55'),
(12, 'kyet din', 'tsawm ntsawm gaw myi hte yu na galaw u', 10, 0, 78000, 'e-p1.png', '2023-11-05 16:13:20', '2023-10-29 11:06:42'),
(14, 'bost', 'hkum sha she', 10, 48, 50000, 'exclusive.jpg', '2023-11-03 16:13:56', '2023-10-29 11:18:39'),
(15, 'shirt01', 'grai hpun pyaw ai baw re..', 11, 30, 3400, 'OIP (1).jpg', '2023-11-03 16:14:18', '2023-10-29 15:49:08'),
(16, 'shirt02', 'nsam ma grai tsawm ai re', 11, 18, 3400, 'OIP.jpg', '2023-11-04 16:15:46', '2023-10-29 15:49:47'),
(17, 'shirt03', 'hpa mi mari yang mari na myit', 11, 8, 4600, 'OIP (2).jpg', '2023-11-04 16:16:00', '2023-10-29 15:50:31'),
(18, 'bag', 'ndai mung grai manu dan ai baw re nu awa ni e', 12, 27, 4400, 'OIP (10).jpg', '2023-11-06 16:15:36', '2023-10-29 15:51:11'),
(19, 'bag01', 'ok sha re yaw tsaw tsaw ra ia sauyil jhklg hkjhisy hkjahd kj oi; as hkh ash;kloi iuy;khasd yjkh yahhdk kjhau;ioy kjhb;gh;oiu jga ', 12, -3, 5400, 'OIP (13).jpg', '2023-11-02 16:13:46', '2023-10-29 15:51:42'),
(20, 'bag03', 'hpa nre yawng la mu', 12, 20, 55000, 'OIP (7).jpg', '2023-11-01 16:14:46', '2023-10-29 15:52:10'),
(21, 'shoes05', 'Din baw wa re.', 10, 13, 2500, 'p2.jpg', '2023-11-05 16:14:07', '2023-11-05 21:41:41'),
(22, 'jean01', 'labu re. mai bu hkawm ai', 13, 5, 3200, 'download (1).jpg', '2023-11-01 16:14:34', '2023-11-05 23:01:32'),
(23, 'jean02', 'bu ai baw re..hpun ai baw gaw nre', 13, 15, 3100, 'OIP (18).jpg', '2023-11-06 16:13:35', '2023-11-05 23:02:13'),
(24, 'jean03', 'grai bu pyaw ai re', 13, 14, 3000, 'OIP (15).jpg', '2023-11-06 16:11:54', '2023-11-05 23:02:50'),
(25, 'jean04', 'mahsa shahku hte  htuk manu ai re', 13, 14, 3400, 'OIP (17).jpg', '2023-11-05 16:12:15', '2023-11-05 23:03:42'),
(26, 'jean05', 'labu shan grai hpun pyaw ai baw re', 13, -1, 3470, 'OIP (16).jpg', '2023-11-04 16:12:34', '2023-11-05 23:04:30'),
(27, 'bag02', 'nhpye re , mari la na hpye hkawm mu', 12, 18, 3100, 'OIP (11).jpg', '2023-11-02 16:15:24', '2023-11-06 08:59:22'),
(28, 'bag04', 'backbag', 12, 9, 3400, 'OIP (14).jpg', '2023-11-03 16:15:10', '2023-11-06 09:00:11'),
(29, 'bag05', 'bags', 12, 1, 2200, 'OIP (12).jpg', '2023-11-01 16:14:57', '2023-11-06 09:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order`
--

CREATE TABLE `sale_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_order`
--

INSERT INTO `sale_order` (`id`, `user_id`, `total_price`, `order_date`) VALUES
(20, 3, 10800, '2023-11-05 03:27:07'),
(21, 3, 15000, '2023-11-05 16:19:36'),
(22, 3, 13800, '2023-11-05 16:27:15'),
(23, 3, 2500, '2023-11-05 16:40:23'),
(24, 3, 2500, '2023-11-05 17:05:24'),
(25, 3, 8800, '2023-11-05 17:06:46'),
(26, 3, 3400, '2023-11-05 17:09:05'),
(27, 3, 4600, '2023-11-05 17:10:18'),
(28, 3, 59400, '2023-11-05 17:14:57'),
(29, 3, 17600, '2023-11-05 17:27:37'),
(30, 3, 13200, '2023-11-05 17:29:49'),
(31, 3, 13200, '2023-11-05 17:39:49'),
(32, 3, 936000, '2023-11-05 17:44:32'),
(33, 20, 42810, '2023-11-05 18:17:28'),
(34, 20, 42810, '2023-11-05 18:17:43'),
(35, 20, 42810, '2023-11-05 18:20:03'),
(36, 20, 3100, '2023-11-05 18:20:40'),
(37, 20, 267400, '2023-11-05 18:21:28'),
(38, 21, 286940, '2023-11-06 03:25:46'),
(39, 21, 3200, '2023-11-06 03:27:11'),
(40, 22, 26000, '2023-11-06 08:54:04'),
(41, 22, 3400, '2023-11-06 08:58:26'),
(42, 23, 31230, '2023-11-06 09:01:40'),
(48, 23, 3400, '2023-11-06 11:26:49'),
(49, 23, 313900, '2023-11-06 11:32:41'),
(50, 18, 385000, '2023-11-07 05:40:41'),
(51, 18, 692800, '2023-11-07 05:42:22'),
(52, 26, 50000, '2024-01-02 05:03:16'),
(53, 3, 12400, '2024-01-02 05:04:02'),
(54, 4, 11340, '2024-06-27 11:36:24'),
(55, 4, 2200, '2024-06-27 18:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_detail`
--

CREATE TABLE `sale_order_detail` (
  `id` int(11) NOT NULL,
  `sale_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_order_detail`
--

INSERT INTO `sale_order_detail` (`id`, `sale_order_id`, `product_id`, `quantity`, `order_date`) VALUES
(19, 20, 19, 2, '2023-11-05 03:27:07'),
(20, 21, 21, 6, '2023-11-05 16:19:36'),
(21, 22, 17, 3, '2023-11-05 16:27:15'),
(22, 23, 21, 1, '2023-11-05 16:40:23'),
(23, 24, 21, 1, '2023-11-05 17:05:24'),
(24, 25, 18, 2, '2023-11-05 17:06:46'),
(25, 26, 16, 1, '2023-11-05 17:09:05'),
(26, 27, 17, 1, '2023-11-05 17:10:18'),
(27, 28, 19, 11, '2023-11-05 17:14:57'),
(28, 29, 18, 4, '2023-11-05 17:27:37'),
(29, 30, 18, 3, '2023-11-05 17:29:49'),
(30, 31, 18, 3, '2023-11-05 17:39:49'),
(31, 32, 12, 12, '2023-11-05 17:44:32'),
(32, 33, 26, 3, '2023-11-05 18:17:28'),
(33, 33, 25, 2, '2023-11-05 18:17:28'),
(34, 33, 23, 1, '2023-11-05 18:17:28'),
(35, 33, 21, 1, '2023-11-05 18:17:28'),
(36, 33, 17, 2, '2023-11-05 18:17:28'),
(37, 33, 19, 2, '2023-11-05 18:17:28'),
(38, 34, 26, 3, '2023-11-05 18:17:43'),
(39, 34, 25, 2, '2023-11-05 18:17:43'),
(40, 34, 23, 1, '2023-11-05 18:17:43'),
(41, 34, 21, 1, '2023-11-05 18:17:43'),
(42, 34, 17, 2, '2023-11-05 18:17:43'),
(43, 34, 19, 2, '2023-11-05 18:17:43'),
(44, 35, 26, 3, '2023-11-05 18:20:03'),
(45, 35, 25, 2, '2023-11-05 18:20:03'),
(46, 35, 23, 1, '2023-11-05 18:20:03'),
(47, 35, 21, 1, '2023-11-05 18:20:03'),
(48, 35, 17, 2, '2023-11-05 18:20:03'),
(49, 35, 19, 2, '2023-11-05 18:20:03'),
(50, 36, 23, 1, '2023-11-05 18:20:40'),
(51, 37, 22, 12, '2023-11-05 18:21:28'),
(52, 37, 20, 4, '2023-11-05 18:21:28'),
(53, 37, 24, 3, '2023-11-05 18:21:28'),
(54, 38, 22, 2, '2023-11-06 03:25:46'),
(55, 38, 23, 1, '2023-11-06 03:25:46'),
(56, 38, 21, 3, '2023-11-06 03:25:46'),
(57, 38, 17, 3, '2023-11-06 03:25:46'),
(58, 38, 11, 4, '2023-11-06 03:25:46'),
(59, 38, 18, 3, '2023-11-06 03:25:46'),
(60, 38, 26, 2, '2023-11-06 03:25:46'),
(61, 39, 22, 1, '2023-11-06 03:27:11'),
(62, 40, 28, 3, '2023-11-06 08:54:05'),
(63, 40, 24, 3, '2023-11-06 08:54:05'),
(64, 40, 15, 2, '2023-11-06 08:54:05'),
(65, 41, 25, 1, '2023-11-06 08:58:26'),
(66, 42, 26, 9, '2023-11-06 09:01:40'),
(67, 43, 29, 3, '2023-11-06 09:07:30'),
(68, 43, 10, 4, '2023-11-06 09:07:30'),
(69, 44, 29, 2, '2023-11-06 11:21:27'),
(70, 48, 28, 1, '2023-11-06 11:26:49'),
(71, 49, 29, 5, '2023-11-06 11:32:41'),
(72, 49, 16, 3, '2023-11-06 11:32:41'),
(73, 49, 21, 3, '2023-11-06 11:32:41'),
(74, 49, 25, 3, '2023-11-06 11:32:41'),
(75, 49, 20, 5, '2023-11-06 11:32:41'),
(76, 50, 20, 7, '2023-11-07 05:40:41'),
(77, 51, 28, 21, '2023-11-07 05:42:22'),
(78, 51, 25, 10, '2023-11-07 05:42:22'),
(79, 51, 16, 11, '2023-11-07 05:42:22'),
(80, 51, 14, 11, '2023-11-07 05:42:22'),
(81, 52, 14, 1, '2024-01-02 05:03:16'),
(82, 53, 27, 4, '2024-01-02 05:04:02'),
(83, 54, 18, 1, '2024-06-27 11:36:24'),
(84, 54, 26, 2, '2024-06-27 11:36:24'),
(85, 55, 29, 1, '2024-06-27 18:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `work` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `address`, `phone`, `work`, `role`, `created_at`, `updated_at`) VALUES
(2, 'jaw gum hkawng', 'qqqq@gmail.com', '$2y$10$bmK3.4Yl2DuNnZRJZ5./Je/JXVf0gJHtmlFU2.Ejx7dz2olBAWepa', 'Screenshot_20230706_182616.jpg', 'npt', '097876865565', 'web developer', 0, '2023-09-23 16:50:45', '2023-09-23 21:21:57'),
(3, 'mr.bosco', 'jaw20007@gmail.com', '$2y$10$XYNUVcqBDILB46yGKdQWLuB0cxnU8kpw00MACd8NwKMVNd0cHFANa', 'FB_IMG_1687272874984.jpg', 'mkn', '097867875', 'web developer', 1, '2023-09-24 10:22:56', '2023-09-24 14:53:49'),
(4, 'jawgum', 'jaw20008@gmail.com', '$2y$10$dYELv7JO2xbLLyYGcp/CDuA2ne7ckJVq.WTPXIVJzdqFg/Z/ga62O', '3EC268BF0E8FF07F2FC0F62844DD671F1920jpg.0.jpg', 'gfdfjhg', '98099789', 'kklkjh', 1, '0000-00-00 00:00:00', '2023-10-26 14:18:06'),
(5, 'jawgumhkawngN', 'jawgumhkawng@gmail.com', '$2y$10$FV0S1uqIvY8Ytc6HGYbBO.jUjD6fE3MBvB32Tqf/BHevP1rtFaaOC', '3EC268BF0E8FF07F2FC0F62844DD671F1920jpg.0 (1).jpg', 'ghg', '087978987967', 'dfgdf', 0, '0000-00-00 00:00:00', '2023-10-26 14:24:20'),
(7, 'nawnaw', 'bosconaw@gmail.com', '$2y$10$SUWUIB/ZmLc4SqJrDLcvMe8MGa1rI7xJjW4R1KweFUbTVNh3ynPnG', '3EC268BF0E8FF07F2FC0F62844DD671F1920jpg.0.jpg', 'edfrgd', '089705476546', 'dfgs', 0, '0000-00-00 00:00:00', '2023-10-27 11:01:06'),
(9, 'nawnaw', 'nawnawnhkum@gmail.com', '$2y$10$wuZi4P9fE2Hy6MifdSXVCur5IZJZ8HLhRh7sv7H.zVDipSzA3VXIm', '3EC268BF0E8FF07F2FC0F62844DD671F1920jpg.0.jpg', 'dfgeds', '097456745', 'dfged', 0, '0000-00-00 00:00:00', '2023-10-27 11:07:27'),
(18, 'nawnaw', 'jaw20009@gmail.com', '$2y$10$E.n4MhgTpfwbwEc11IY98Otcp/hUU.nDkOxPyCN1KpSAu6d1auxs6', 'FB_IMG_1652964181315.jpg', 'myitkyina', '0988877665', 'student', 0, '2023-11-04 09:59:52', '2023-11-04 09:59:52'),
(19, 'mr nhkum naw', 'jaw20010@gmail.com', '$2y$10$gMrjphCnf21MAFpLzNFbVOL7eNW0HmPbsYrAVjZiamMQvePsDmnv2', '1663488675778jpg.0.jpg', 'myitkyina,kachin st,myanmar', '089567574545', 'web dev', 1, '2023-11-04 15:19:00', '2023-11-04 15:19:00'),
(20, 'nhkum wa', 'jaw20020@gmail.com', '$2y$10$MQLs45gnb9v8p0lumNshpe.8tbf/IgGw3YJyZd/KRJXKtw/25//9i', 'FB_IMG_1670772548295.jpg', 'tamwe tsp,ygn, Myanmar', '09770482958', 'web dev', 1, '2023-11-05 23:44:40', '2023-11-05 23:44:40'),
(21, 'bosco', 'jaw20021@gmail.com', '$2y$10$alFh4/tORjJVjLMPzRz4S.EdkoF5FewHUTTJ/GixzxCQ.4V8x/LE6', 'FB_IMG_1670772546023.jpg', 'kamaing', '0988775785', 'software engineer', 0, '2023-11-06 08:41:22', '2023-11-06 08:41:22'),
(22, 'web developer', 'jaw20022@gmail.com', '$2y$10$LupZ6s6ztCVKcveaCDi8juy1CO/jL5iZa5quB7iC0Jny27RdOd4QS', 'FB_IMG_1670772621142.jpg', 'manchester,UK', '0987675744', 'web dev', 0, '2023-11-06 14:22:56', '2023-11-06 14:22:56'),
(23, 'jeam', 'jaw20023@gmail.com', '$2y$10$Hzm0Y/iL/tB3gT8LyAU6dufHD8/NUUKIcyY9cdVdcif9rN/h3Ova6', 'FB_IMG_1670772642319.jpg', 'yangon,myanmar', '0987857456343', 'senior web developer', 1, '2023-11-06 14:30:47', '2023-11-06 14:30:47'),
(24, 'jhon', 'jaw20024@gmail.com', '$2y$10$TX2W7ydoo95T1alNH.aNhe/MDV1lkP8ronK2xul8P6dWMyKasUd7W', 'FB_IMG_1670772567287.jpg', 'myitkyina,kachin state', '09775754433', 'junior web developer', 0, '2023-11-06 14:36:36', '2023-11-06 14:36:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_order`
--
ALTER TABLE `sale_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_order_detail`
--
ALTER TABLE `sale_order_detail`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sale_order`
--
ALTER TABLE `sale_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sale_order_detail`
--
ALTER TABLE `sale_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
