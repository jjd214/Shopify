-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 11:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE `cart_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_tbl`
--

INSERT INTO `cart_tbl` (`id`, `user_id`, `item_id`, `product_id`, `item_name`, `qty`, `price`, `added_at`) VALUES
(16, 44, 17, 7, 'Apple', 10, 20, '2024-01-07 12:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `members_tbl`
--

CREATE TABLE `members_tbl` (
  `member_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `member_since` date DEFAULT NULL,
  `membership_status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productitems_tbl`
--

CREATE TABLE `productitems_tbl` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` varchar(11) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `batch_number` varchar(6) DEFAULT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `added_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productitems_tbl`
--

INSERT INTO `productitems_tbl` (`id`, `product_id`, `product_image`, `description`, `qty`, `price`, `vendor_name`, `batch_number`, `added_at`, `added_by`) VALUES
(2, 2, NULL, NULL, 5, '50', 'Fuji sApple', NULL, '2023-12-12 11:35:58', 'John Jacob Dimaya'),
(4, 3, NULL, NULL, 20, '50', 'Green Apple', 'x1sfcB', '2023-12-12 14:08:24', 'John Jacob Dimaya'),
(5, 2, NULL, NULL, 1, '50', 'Green Apple', 'x1sfcs', '2023-12-12 14:27:15', 'John Jacob Dimaya'),
(6, 3, NULL, NULL, 20, '350', '6 Piece Chicken', 'HY2DLO', '2023-12-12 14:39:04', 'John Jacob Dimaya'),
(7, 2, NULL, NULL, 50, '35', 'Apple Juice', 'KD3ZL9', '2023-12-12 14:48:09', 'John Jacob Dimaya'),
(8, 3, NULL, NULL, 15, '3000', 'A3 Wagyu', '7V9T4F', '2023-12-12 14:54:05', 'John Jacob Dimaya'),
(9, 3, NULL, NULL, 10, '200', 'Chicken Thighs', 'BHC2CF', '2023-12-12 14:57:49', 'John Jacob Dimaya'),
(11, 6, NULL, NULL, 10, '250', 'Korean quality sweatshirts', 'VRO8XV', '2024-01-06 16:44:41', 'Jancis  Discarga'),
(12, 6, NULL, NULL, 10, '50', 'Korean quality sweatshirts with Hoodie', 'FG5Y9Q', '2024-01-06 16:47:30', 'Jancis  Discarga'),
(13, 3, 'IMG-3-2024-01-06-05-23-03-PM.jpg', NULL, 0, '300', 'Chinese Collar SweatShirt', 'GA98N6', '2024-01-06 17:23:03', 'Jancis  Discarga'),
(14, 5, 'IMG-5-2024-01-06-11-01-58-PM.jpg', NULL, 0, '15', 'Zesto Apple', 'LFEXEV', '2024-01-06 23:01:58', 'Jancis  Discarga'),
(15, 8, 'IMG-8-2024-01-07-12-30-36-PM.jpg', 'High quality maong pants for womens.', 40, '250', 'Otaku Pants', '6ZXNR8', '2024-01-07 12:30:36', 'John Jacob Dimaya'),
(16, 8, 'IMG-8-2024-01-07-12-35-47-PM.jpg', 'Baggy Pants', 0, '350', 'Curduroy Pants', 'E06YJS', '2024-01-07 12:35:47', 'John Jacob Dimaya'),
(17, 7, 'IMG-7-2024-01-07-12-37-57-PM.jpeg', 'Fresh Apples', 90, '20', 'Apple', '30WHU4', '2024-01-07 12:37:57', 'John Jacob Dimaya'),
(18, 8, 'IMG-8-2024-01-07-01-02-43-PM.jpg', 'High Quality Pants', 50, '280', 'Denim Pants', '0JK4UX', '2024-01-07 13:02:43', 'John Jacob Dimaya');

-- --------------------------------------------------------

--
-- Table structure for table `products_tbl`
--

CREATE TABLE `products_tbl` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `min_stock` int(11) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_tbl`
--

INSERT INTO `products_tbl` (`id`, `product_name`, `product_type`, `description`, `min_stock`, `added_by`, `date_added`) VALUES
(2, 'Apple', 'Food', 'lorem ipsum', 5, NULL, '2023-12-12 10:40:49'),
(3, 'A5 Wagyu Meat', 'Food', 'Most expensive meat', 5, NULL, '2023-12-12 11:39:15'),
(4, 'Shirt', 'Clothing', 'Otaku ', 100, NULL, '2023-12-14 15:35:27'),
(5, 'Juice', 'Food', 'qweasdasd', 100, NULL, '2024-01-03 17:19:55'),
(6, 'Sweat Shirts', 'Clothing', 'lorem ipsum', 100, NULL, '2024-01-06 16:43:28'),
(7, 'Fruits', 'Food', 'Healthy Fruits', 100, 'John Jacob Dimaya', '2024-01-07 12:16:41'),
(8, 'Pants', 'Clothing', 'High Quality Pants', 50, 'John Jacob Dimaya', '2024-01-07 12:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `sales_tbl`
--

CREATE TABLE `sales_tbl` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stocks_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `date_purchased` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_tbl`
--

INSERT INTO `sales_tbl` (`id`, `product_id`, `stocks_id`, `brand_name`, `qty`, `price`, `customer_name`, `date_purchased`) VALUES
(1, 3, 9, 'Chicken Thighs', 5, '200', 'Jancis  Discarga', '2024-01-06 14:39:51'),
(2, 3, 4, 'Green Apple', 1, '50', 'Jancis  Discarga', '2024-01-06 14:39:51'),
(3, 2, 2, 'Fuji sApple', 1, '50', 'Jancis  Discarga', '2024-01-06 14:49:29'),
(4, 2, 2, 'Fuji sApple', 2, '50', 'Jancis  Discarga', '2024-01-06 16:04:40'),
(5, 3, 4, 'Green Apple', 5, '50', 'Jancis  Discarga', '2024-01-06 16:39:58'),
(6, 6, 11, 'Korean quality sweatshirts', 5, '250', 'Jancis  Discarga', '2024-01-06 16:48:33'),
(7, 3, 8, 'A3 Wagyu', 1, '3000', 'Jancis  Discarga', '2024-01-06 17:00:37'),
(8, 3, 13, 'Chinese Collar SweatShirt', 2, '300', 'Jancis  Discarga', '2024-01-06 17:39:13'),
(9, 3, 6, '6 Piece Chicken', 2, '350', 'Jancis  Discarga', '2024-01-07 09:06:26'),
(36, 3, 14, 'Zesto Apple', 1, '15', 'Jancis  Discarga', '2024-01-07 10:46:11'),
(37, 3, 13, 'Chinese Collar SweatShirt', 1, '300', 'Jancis  Discarga', '2024-01-07 10:46:11'),
(38, 3, 14, 'Zesto Apple', 5, '15', 'Jancis  Discarga', '2024-01-07 10:48:00'),
(39, 3, 13, 'Chinese Collar SweatShirt', 2, '300', 'Jancis  Discarga', '2024-01-07 10:48:00'),
(40, 5, 14, 'Zesto Apple', 4, '15', 'Jancis  Discarga', '2024-01-07 11:06:21'),
(41, 5, 14, 'Zesto Apple', 1, '15', 'Jancis  Discarga', '2024-01-07 11:07:58'),
(42, 5, 14, 'Zesto Apple', 1, '15', 'Jancis  Discarga', '2024-01-07 11:09:36'),
(43, 5, 14, 'Zesto Apple', 8, '15', 'Jancis  Discarga', '2024-01-07 11:09:42'),
(44, 8, 15, 'Otaku Pants', 10, '250', 'Johna Grace Doctora', '2024-01-07 12:45:27'),
(45, 8, 16, 'Curduroy Pants', 5, '350', 'Johna Grace Doctora', '2024-01-07 12:45:27'),
(46, 8, 16, 'Curduroy Pants', 5, '350', 'Johna Grace Doctora', '2024-01-07 12:49:55'),
(47, 8, 16, 'Curduroy Pants', 5, '350', 'Johna Grace Doctora', '2024-01-07 12:50:45'),
(48, 7, 16, 'Curduroy Pants', 5, '350', 'Johna Grace Doctora', '2024-01-07 12:52:00'),
(49, 7, 17, 'Apple', 10, '20', 'Johna Grace Doctora', '2024-01-07 12:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `verify_token` varchar(100) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `access` varchar(100) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `firstname`, `lastname`, `middlename`, `email`, `password`, `verify_token`, `account_type`, `access`, `created_at`) VALUES
(43, 'John Jacob', 'Dimaya', 'Ruiz', 'johnjacobdimaya0@gmail.com', '817b3ae38cbe924db0ba853912232d9b', '5e0b5f1227045dd39a6a06ed50ed393b', 'business', 'seller', '2024-01-07 03:54:40'),
(44, 'Johna Grace', 'Doctora', 'Doctowra', 'johnjacobdimaya2021@gmail.com', '817b3ae38cbe924db0ba853912232d9b', 'd1b8e18e4ba7728b2b944a32a1830716', 'personal', 'customer', '2024-01-07 04:44:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cart_tbl_ibfk_3` (`item_id`),
  ADD KEY `cart_tbl_ibfk_2` (`product_id`);

--
-- Indexes for table `members_tbl`
--
ALTER TABLE `members_tbl`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `productitems_tbl`
--
ALTER TABLE `productitems_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products_tbl`
--
ALTER TABLE `products_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_id` (`stocks_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `members_tbl`
--
ALTER TABLE `members_tbl`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productitems_tbl`
--
ALTER TABLE `productitems_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products_tbl`
--
ALTER TABLE `products_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD CONSTRAINT `cart_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_tbl_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `productitems_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members_tbl`
--
ALTER TABLE `members_tbl`
  ADD CONSTRAINT `members_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`id`);

--
-- Constraints for table `productitems_tbl`
--
ALTER TABLE `productitems_tbl`
  ADD CONSTRAINT `productitems_tbl_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  ADD CONSTRAINT `sales_tbl_ibfk_1` FOREIGN KEY (`stocks_id`) REFERENCES `productitems_tbl` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
