-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 11:29 AM
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
-- Table structure for table `billing_tbl`
--

CREATE TABLE `billing_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `phoneno` varchar(12) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `order_notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing_tbl`
--

INSERT INTO `billing_tbl` (`id`, `user_id`, `firstname`, `lastname`, `country`, `address`, `city`, `postcode`, `phoneno`, `email`, `order_notes`) VALUES
(3, 46, 'John Jacob', 'Dimaya', 'Philippines', 'Parklane General Trias Cavite', 'Cavite', '4044', '09605656273', 'johnjacobdimaya2021@gmail.com', 'Paki ingatan please.');

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
  `qty` bigint(20) DEFAULT 1,
  `price` bigint(20) DEFAULT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(19, 7, 'IMG-7-2024-01-07-06-10-48-PM.jpg', 'Fresh Senorita, 1 Quantity, 1 Kilo. ', 95, '50', 'Banana', 'QSGF7G', '2024-01-07 18:10:48', 'John Jacob Dimaya'),
(20, 7, 'IMG-7-2024-01-07-06-12-32-PM.jpg', 'Kyoho Grapes, 1 Quantity 1 Kilo.', 42, '200', 'Grapes', 'S7FFML', '2024-01-07 18:12:32', 'John Jacob Dimaya'),
(21, 7, 'IMG-7-2024-01-07-06-17-13-PM.jpg', 'Sweet Indian Mango, 1 Quantity 1 Kilo.', 63, '70', 'Mango', 'VCSJ5W', '2024-01-07 18:17:13', 'John Jacob Dimaya'),
(22, 7, 'IMG-7-2024-01-07-06-21-35-PM.jpg', 'Fresh WaterMelon', 14, '90', 'WaterMelon', 'TZ7FTR', '2024-01-07 18:21:35', 'John Jacob Dimaya'),
(23, 7, 'IMG-7-2024-01-07-06-56-25-PM.jpg', 'Apple 1 Quantity, 1 Kilo', 89, '153', 'Apple', '3EQ1K8', '2024-01-07 18:56:25', 'John Jacob Dimaya'),
(24, 9, 'IMG-9-2024-01-07-07-02-00-PM.jpg', 'Meat Per Kilo', 98, '180', 'Pork Meat', 'IH005F', '2024-01-07 19:02:00', 'John Jacob Dimaya'),
(25, 10, 'IMG-10-2024-01-07-10-43-35-PM.png', 'Kang kong chips', 29, '100', 'KKK Original', 'PAQ1YN', '2024-01-07 22:43:35', 'Patrick John Fajaro'),
(26, 11, 'IMG-11-2024-01-13-11-45-22-AM.jpg', 'Alfonso Platinum is a full golden colour, clear and bright, with hints of fruits, ginger and honey and with a soft and good length grape wine spirit finish. Outstanding in mixed drinks, it is also excellent in a snifter or in a glass with abundant ice.', 48, '500', 'Alfonso Platinum', '693X4H', '2024-01-13 11:45:22', 'John Jacob Dimaya');

-- --------------------------------------------------------

--
-- Table structure for table `products_tbl`
--

CREATE TABLE `products_tbl` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
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

INSERT INTO `products_tbl` (`id`, `seller_id`, `product_name`, `product_type`, `description`, `min_stock`, `added_by`, `date_added`) VALUES
(7, 43, 'Fruits', 'Food', 'Healthy Fruits', 100, 'John Jacob Dimaya', '2024-01-07 12:16:41'),
(9, 43, 'Fresh Meat', 'Food', 'High Quality Meats', 300, 'John Jacob Dimaya', '2024-01-07 19:00:53'),
(10, 45, 'Chips', 'Food', 'Crispy Chips', 200, 'Patrick John Fajaro', '2024-01-07 22:40:42'),
(11, 43, 'Drinks', 'Food', 'Alcoholic Drinks', 250, 'John Jacob Dimaya', '2024-01-13 10:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `sales_tbl`
--

CREATE TABLE `sales_tbl` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stocks_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `brand_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `date_purchased` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_tbl`
--

INSERT INTO `sales_tbl` (`id`, `product_id`, `stocks_id`, `customer_id`, `brand_name`, `qty`, `price`, `customer_name`, `status`, `date_purchased`) VALUES
(1, 3, 9, NULL, 'Chicken Thighs', 5, '200', 'Jancis  Discarga', 'Pending', '2024-01-06 14:39:51'),
(2, 3, 4, NULL, 'Green Apple', 1, '50', 'Jancis  Discarga', 'Pending', '2024-01-06 14:39:51'),
(3, 2, 2, NULL, 'Fuji sApple', 1, '50', 'Jancis  Discarga', 'Pending', '2024-01-06 14:49:29'),
(4, 2, 2, NULL, 'Fuji sApple', 2, '50', 'Jancis  Discarga', 'Pending', '2024-01-06 16:04:40'),
(5, 3, 4, NULL, 'Green Apple', 5, '50', 'Jancis  Discarga', 'Pending', '2024-01-06 16:39:58'),
(6, 6, 11, NULL, 'Korean quality sweatshirts', 5, '250', 'Jancis  Discarga', 'Pending', '2024-01-06 16:48:33'),
(7, 3, 8, NULL, 'A3 Wagyu', 1, '3000', 'Jancis  Discarga', 'Pending', '2024-01-06 17:00:37'),
(8, 3, 13, NULL, 'Chinese Collar SweatShirt', 2, '300', 'Jancis  Discarga', 'Pending', '2024-01-06 17:39:13'),
(9, 3, 6, NULL, '6 Piece Chicken', 2, '350', 'Jancis  Discarga', 'Pending', '2024-01-07 09:06:26'),
(36, 3, 14, NULL, 'Zesto Apple', 1, '15', 'Jancis  Discarga', 'Pending', '2024-01-07 10:46:11'),
(37, 3, 13, NULL, 'Chinese Collar SweatShirt', 1, '300', 'Jancis  Discarga', 'Pending', '2024-01-07 10:46:11'),
(38, 3, 14, NULL, 'Zesto Apple', 5, '15', 'Jancis  Discarga', 'Pending', '2024-01-07 10:48:00'),
(39, 3, 13, NULL, 'Chinese Collar SweatShirt', 2, '300', 'Jancis  Discarga', 'Pending', '2024-01-07 10:48:00'),
(40, 5, 14, NULL, 'Zesto Apple', 4, '15', 'Jancis  Discarga', 'Pending', '2024-01-07 11:06:21'),
(41, 5, 14, NULL, 'Zesto Apple', 1, '15', 'Jancis  Discarga', 'Pending', '2024-01-07 11:07:58'),
(42, 5, 14, NULL, 'Zesto Apple', 1, '15', 'Jancis  Discarga', 'Pending', '2024-01-07 11:09:36'),
(43, 5, 14, NULL, 'Zesto Apple', 8, '15', 'Jancis  Discarga', 'Pending', '2024-01-07 11:09:42'),
(44, 8, 15, NULL, 'Otaku Pants', 10, '250', 'Johna Grace Doctora', 'Shipped', '2024-01-07 12:45:27'),
(45, 8, 16, NULL, 'Curduroy Pants', 5, '350', 'Johna Grace Doctora', 'Shipped', '2024-01-07 12:45:27'),
(46, 8, 16, NULL, 'Curduroy Pants', 5, '350', 'Johna Grace Doctora', 'Shipped', '2024-01-07 12:49:55'),
(47, 8, 16, NULL, 'Curduroy Pants', 5, '350', 'Johna Grace Doctora', 'Shipped', '2024-01-07 12:50:45'),
(48, 7, 16, NULL, 'Curduroy Pants', 5, '350', 'Johna Grace Doctora', 'Shipped', '2024-01-07 12:52:00'),
(49, 7, 17, NULL, 'Apple', 10, '20', 'Johna Grace Doctora', 'Shipped', '2024-01-07 12:52:00'),
(50, 10, 25, NULL, 'KKK Original', 5, '100', 'John Jacob Dimaya', 'Pending', '2024-01-08 21:30:33'),
(51, 7, 25, NULL, 'KKK Original', 1, '100', 'John Jacob Dimaya', 'Shipped', '2024-01-09 18:48:42'),
(52, 7, 19, NULL, 'Banana', 1, '50', 'John Jacob Dimaya', 'Pending', '2024-01-09 18:48:42'),
(53, 7, 22, NULL, 'WaterMelon', 1, '90', 'John Jacob Dimaya', 'Pending', '2024-01-09 18:48:42'),
(54, 7, 19, NULL, 'Banana', 1, '50', 'Marco Jerome  Gador', 'Pending', '2024-01-09 18:55:12'),
(55, 7, 20, NULL, 'Grapes', 1, '200', 'Marco Jerome  Gador', 'Pending', '2024-01-09 18:55:13'),
(56, 7, 24, NULL, 'Pork Meat', 1, '180', 'Marco Jerome  Gador', 'Pending', '2024-01-09 18:55:13'),
(57, 7, 22, NULL, 'WaterMelon', 1, '90', 'Marco Jerome  Gador', 'Pending', '2024-01-09 18:55:13'),
(58, 7, 21, NULL, 'Mango', 1, '70', 'Marco Jerome  Gador', 'Pending', '2024-01-09 18:55:13'),
(59, 9, 24, NULL, 'Pork Meat', 1, '180', 'Marco Jerome  Gador', 'Pending', '2024-01-09 18:56:56'),
(60, 10, 25, NULL, 'KKK Original', 1, '100', 'John Jacob Dimaya', 'Pending', '2024-01-10 22:02:28'),
(61, 7, 22, NULL, 'WaterMelon', 1, '90', 'John Jacob Dimaya', 'Pending', '2024-01-11 11:27:45'),
(62, 7, 19, NULL, 'Banana', 1, '50', 'John Jacob Dimaya', 'Pending', '2024-01-11 11:33:38'),
(63, 7, 20, NULL, 'Grapes', 1, '200', 'John Jacob Dimaya', 'Pending', '2024-01-11 11:33:38'),
(64, 10, 19, NULL, 'Banana', 1, '50', 'John Jacob Dimaya', 'Pending', '2024-01-11 11:40:14'),
(65, 10, 25, NULL, 'KKK Original', 5, '100', 'John Jacob Dimaya', 'Pending', '2024-01-11 11:40:14'),
(66, 7, 21, NULL, 'Mango', 2, '70', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:31:34'),
(67, 7, 23, NULL, 'Apple', 2, '153', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:31:34'),
(68, 7, 21, NULL, 'Mango', 1, '70', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:32:25'),
(69, 7, 23, NULL, 'Apple', 1, '153', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:32:25'),
(70, 7, 21, NULL, 'Mango', 1, '70', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:34:48'),
(71, 7, 23, NULL, 'Apple', 5, '153', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:34:49'),
(72, 10, 21, NULL, 'Mango', 3, '70', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:39:17'),
(73, 10, 23, NULL, 'Apple', 5, '153', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:39:17'),
(74, 10, 25, NULL, 'KKK Original', 3, '100', 'John Jacob Dimaya', 'Pending', '2024-01-11 13:39:17'),
(75, 7, 21, NULL, 'Mango', 1, '70', 'Marco Jerome  Gador', 'Pending', '2024-01-11 13:44:22'),
(76, 7, 19, NULL, 'Banana', 1, '50', 'Marco Jerome  Gador', 'Pending', '2024-01-11 13:44:22'),
(77, 7, 22, NULL, 'WaterMelon', 2, '90', 'Marco Jerome  Gador', 'Pending', '2024-01-11 13:44:22'),
(78, 11, 26, NULL, 'Alfonso Platinum', 1, '500', 'John Jacob Dimaya', 'Pending', '2024-01-13 12:58:09'),
(79, 7, 23, NULL, 'Apple', 1, '153', 'Marco Jerome  Gador', 'Pending', '2024-01-13 14:25:23'),
(80, 11, 26, NULL, 'Alfonso Platinum', 1, '500', 'Marco Jerome  Gador', 'Pending', '2024-01-13 14:27:20'),
(81, 7, 21, NULL, 'Mango', 1, '70', 'Marco Jerome  Gador', 'Pending', '2024-01-13 22:49:08'),
(82, 7, 22, NULL, 'WaterMelon', 1, '90', 'Marco Jerome  Gador', 'Pending', '2024-01-13 22:51:19'),
(83, 7, 20, NULL, 'Grapes', 5, '200', 'Marco Jerome  Gador', 'Pending', '2024-01-14 14:12:55'),
(84, 10, 25, NULL, 'KKK Original', 1, '100', 'Marco Jerome  Gador', 'Pending', '2024-01-16 12:41:26'),
(85, 10, 25, NULL, 'KKK Original', 1, '100', 'Marco Jerome  Gador', 'Pending', '2024-01-16 13:01:44'),
(86, 10, 25, NULL, 'KKK Original', 1, '100', 'Marco Jerome  Gador', 'Pending', '2024-01-16 13:09:46'),
(87, 10, 20, 46, 'Grapes', 1, '200', 'Marco Jerome  Gador', 'Pending', '2024-01-21 18:09:13'),
(88, 10, 25, 46, 'KKK Original', 1, '100', 'Marco Jerome  Gador', 'Pending', '2024-01-21 18:09:13'),
(89, 10, 25, 46, 'KKK Original', 2, '100', 'Marco Jerome  Gador', 'Pending', '2024-01-21 18:26:42');

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
  `image` text DEFAULT NULL,
  `storename` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `firstname`, `lastname`, `middlename`, `email`, `password`, `verify_token`, `account_type`, `access`, `image`, `storename`, `created_at`) VALUES
(43, 'John Jacob', 'Dimaya', 'Ruiz', 'johnjacobdimaya0@gmail.com', '817b3ae38cbe924db0ba853912232d9b', '5e0b5f1227045dd39a6a06ed50ed393b', 'business', 'seller', 'IMG-43-2024-01-21-11-22-36-AM.jpg', 'Daddas', '2024-01-21 03:22:36'),
(45, 'Patrick John', 'Fajaro', 'Farado', 'johnjacobdimaya2022@gmail.com', '817b3ae38cbe924db0ba853912232d9b', 'f645ce0bf3c9539c2c0f590c8537391f', 'business', 'seller', 'IMG-45-2024-01-07-10-48-17-PM.png', 'KKK', '2024-01-08 13:42:59'),
(46, 'Marco Jerome ', 'Gador', 'Faker', 'johnjacobdimaya2021@gmail.com', '817b3ae38cbe924db0ba853912232d9b', '54a3bcc1ab76e2125a4c3426c3ab80e3', 'personal', 'customer', NULL, NULL, '2024-01-21 05:30:01'),
(47, 'Aaron ', 'Eva', 'Doctora', 'futaro.uesugi19@gmail.com', '817b3ae38cbe924db0ba853912232d9b', 'cd51d7e292d573091bf6c40cacac0b5c', 'business', 'admin', NULL, NULL, '2024-01-16 10:07:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_tbl`
--
ALTER TABLE `billing_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `productitems_tbl_ibfk_1` (`product_id`);

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
-- AUTO_INCREMENT for table `billing_tbl`
--
ALTER TABLE `billing_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `members_tbl`
--
ALTER TABLE `members_tbl`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productitems_tbl`
--
ALTER TABLE `productitems_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products_tbl`
--
ALTER TABLE `products_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_tbl`
--
ALTER TABLE `billing_tbl`
  ADD CONSTRAINT `billing_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD CONSTRAINT `cart_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members_tbl`
--
ALTER TABLE `members_tbl`
  ADD CONSTRAINT `members_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`id`);

--
-- Constraints for table `productitems_tbl`
--
ALTER TABLE `productitems_tbl`
  ADD CONSTRAINT `productitems_tbl_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
