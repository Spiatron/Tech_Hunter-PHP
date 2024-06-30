-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 05:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techhunter`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `image_url`) VALUES
(15, 'K55 PRO Gaming Keyboard', 'K55 RGB PRO Gaming Keyboard', 15000, 1, '../public/images/catlog/keyboard.webp'),
(17, 'ASUS  Strix GeForce RTX 4080', 'ASUS ROG Strix GeForce RTX 4080 16GB GDDR6X OC Edition Gaming Graphics Card', 498000, 1, '../public/images/catlog/image-removebg-preview-7.webp'),
(18, 'Razer Goliathus Mouse Pad', 'Razer Goliathus Mouse Pad', 1500, 1, '../public/images/catlog/Razer-MousePad-8-removebg-preview.webp'),
(19, 'AUKEY XL MOUSE PAD', 'AUKEY XL MOUSE PAD', 1500, 1, '../public/images/catlog/aukey-removebg-preview.webp'),
(20, 'BOOST CHEETAH PRO WHITE', 'BOOST CHEETAH PRO WHITE', 11000, 1, '../public/images/catlog/1.webp'),
(21, 'EASE EOC250W Case with PSU', 'EASE EOC250W Case with PSU', 11500, 1, '../public/images/catlog/1-28.webp'),
(24, 'ASUS TUF GT501 CASE (WHITE Edition)', 'ASUS TUF GT501 Mid Tower GAMING CASE (WHITE Edition)', 45000, 1, '../public/images/catlog/P_setting_xxx_0_90_end_500-removebg-preview.webp'),
(25, 'Asus ROG Gaming Case (Black)', 'Asus ROG Strix Helios GX601 RGB Mid-Tower Computer Case (Black)', 85000, 1, '../public/images/catlog/h525-removebg-preview-5-1.webp'),
(26, 'ASUS ROG ATX Gaming Case', 'ASUS ROG HYPERION GR701 Full-Tower E-ATX Gaming Case', 142000, 1, '../public/images/catlog/h732-removebg-preview-10.webp'),
(27, 'REDRAGON H120 GAMING HEADSET', 'REDRAGON H120 ARES WIRED GAMING HEADSET', 3300, 1, '../public/images/catlog/red-removebg-preview.webp'),
(28, 'ARCTIS NOVA 1', 'ARCTIS NOVA 1', 25000, 1, '../public/images/catlog/arctis_nova_1_white_pdp_img_buy_06.png__1920x1080_crop-fit_optimize_subsampling-2.webp'),
(29, 'Asus Prime H610M-K D4', 'Asus Prime H610M-K D4', 26000, 1, '../public/images/catlog/Asus-Prime-H610M-K-D4-Price-in-Pakistan-removebg-preview.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', '', 'admin', 'admin'),
(2, 'ahsan', 'ahsanhafeez506@gmail.com', '786pakistan', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product_unique` (`user_id`,`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
