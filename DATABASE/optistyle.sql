-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2025 at 02:36 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optistyle`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Super Admin', 'admin@optistyle.com', '$2y$10$OX8CLFHVu0xCR3UrY1kM3eSioMxVsAOlpRzOjW4v4UzkaZlp2FAki', '2025-11-20 17:45:33'),
(2, 'Manager Lens', 'manager@optistyle.com', '$2y$10$adminpass', '2025-11-20 17:45:33'),
(3, 'Stock Incharge', 'stock@optistyle.com', '$2y$10$adminpass', '2025-11-20 17:45:33'),
(4, 'Order Supervisor', 'orders@optistyle.com', '$2y$10$adminpass', '2025-11-20 17:45:33'),
(5, 'Support Lead', 'support@optistyle.com', '$2y$10$adminpass', '2025-11-20 17:45:33'),
(6, 'admin', 'admin123@gmail.com', 'admin@123', '2025-11-20 18:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `status`, `created_at`) VALUES
(1, 1, 'ACTIVE', '2025-11-20 17:45:33'),
(2, 2, 'ACTIVE', '2025-11-20 17:45:33'),
(3, 3, 'ACTIVE', '2025-11-20 17:45:33'),
(4, 4, 'INACTIVE', '2025-11-20 17:45:33'),
(5, 5, 'INACTIVE', '2025-11-20 17:45:33'),
(6, 12, 'INACTIVE', '2025-11-20 17:58:11'),
(7, 12, 'INACTIVE', '2025-11-21 09:49:51'),
(8, 12, 'INACTIVE', '2025-11-22 09:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `cart_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cart_item_id`),
  KEY `cart_id` (`cart_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, '1499.00'),
(2, 1, 3, 2, '1299.00'),
(3, 2, 2, 1, '1699.00'),
(4, 3, 4, 1, '999.00'),
(5, 3, 5, 1, '2499.00'),
(6, 6, 4, 1, '999.00'),
(7, 7, 1, 1, '1499.00'),
(8, 8, 1, 4, '1499.00'),
(9, 8, 3, 1, '1299.00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'Eyeglasses', 'Premium prescription eyeglasses with stylish frames'),
(2, 'Sunglasses', 'UV-protected sunglasses with polarized lenses'),
(3, 'Computer Glasses', 'Anti-blue light glasses for eye protection'),
(4, 'Kids Eyewear', 'Durable glasses for children'),
(5, 'Premium Collection', 'High-end luxury eyewear');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`message_id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Rohan Mehta', 'rohan@gmail.com', '9876541230', 'Need help with my order delivery', '2025-11-20 17:45:34'),
(2, 'Aditi Desai', 'aditi@gmail.com', '9685741230', 'Product enquiry', '2025-11-20 17:45:34'),
(3, 'Mukesh Jain', 'mukeshjain@gmail.com', '9874512360', 'Want to return a product', '2025-11-20 17:45:34'),
(4, 'Tara Kapoor', 'tara@gmail.com', '9234567810', 'Thanks for great service!', '2025-11-20 17:45:34'),
(5, 'John Thomas', 'john@gmail.com', '9765432180', 'Do you offer student discount?', '2025-11-20 17:45:34'),
(6, 'Dip ', 'dip1213@gmail.com', NULL, 'The products are very nice.I love it!', '2025-11-22 09:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_agents`
--

DROP TABLE IF EXISTS `delivery_agents`;
CREATE TABLE IF NOT EXISTS `delivery_agents` (
  `agent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_agents`
--

INSERT INTO `delivery_agents` (`agent_id`, `name`, `phone`, `area`) VALUES
(1, 'E-Cart Rider 1', '9000010000', 'Ahmedabad'),
(2, 'E-Cart Rider 2', '9000020000', 'Delhi'),
(3, 'E-Cart Rider 3', '9000030000', 'Mumbai'),
(4, 'E-Cart Rider 4', '9000040000', 'Bengaluru'),
(5, 'E-Cart Rider 5', '9000050000', 'Jaipur');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`inventory_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `product_id`, `quantity`) VALUES
(1, 1, 35),
(2, 2, 25),
(3, 3, 59),
(4, 4, 29),
(5, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(10) DEFAULT 'COD',
  `status` enum('PENDING','SHIPPED','DELIVERED','CANCELLED') DEFAULT 'PENDING',
  `placed_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `ship_name` varchar(100) DEFAULT NULL,
  `ship_phone` varchar(15) DEFAULT NULL,
  `ship_city` varchar(100) DEFAULT NULL,
  `ship_state` varchar(100) DEFAULT NULL,
  `ship_pincode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `payment_method`, `status`, `placed_at`, `ship_name`, `ship_phone`, `ship_city`, `ship_state`, `ship_pincode`) VALUES
(1, 1, '2798.00', 'COD', 'PENDING', '2025-11-20 17:45:34', 'Raj Patel', '9876543210', 'Ahmedabad', 'Gujarat', '380015'),
(2, 2, '1699.00', 'COD', 'SHIPPED', '2025-11-20 17:45:34', 'Priya Sharma', '9123456780', 'Delhi', 'Delhi', '110054'),
(3, 3, '3498.00', 'COD', 'DELIVERED', '2025-11-20 17:45:34', 'Aakash Verma', '9898989898', 'Mumbai', 'Maharashtra', '400001'),
(4, 4, '999.00', 'COD', 'CANCELLED', '2025-11-20 17:45:34', 'Sneha Kapoor', '9988776655', 'Bengaluru', 'Karnataka', '560001'),
(5, 5, '2499.00', 'COD', 'PENDING', '2025-11-20 17:45:34', 'Harshit Singh', '9090909090', 'Jaipur', 'Rajasthan', '302001'),
(6, 12, '999.00', 'COD', 'DELIVERED', '2025-11-20 17:58:21', 'dip', '9909869820', 'Ahmedabad ', 'Gujarat ', '02763'),
(7, 12, '1499.00', 'COD', 'DELIVERED', '2025-11-21 09:49:56', 'dip', '9909869820', 'Ahmedabad ', 'Gujarat ', '02763'),
(8, 12, '7295.00', 'COD', 'DELIVERED', '2025-11-22 09:16:17', 'dip', '9909869820', 'Ahmedabad ', 'Gujarat ', '02763');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, '1499.00'),
(2, 1, 3, 1, '1299.00'),
(3, 2, 2, 1, '1699.00'),
(4, 3, 5, 1, '2499.00'),
(5, 4, 4, 1, '999.00'),
(6, 6, 4, 1, '999.00'),
(7, 7, 1, 1, '1499.00'),
(8, 8, 1, 4, '1499.00'),
(9, 8, 3, 1, '1299.00');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `right_sph` decimal(5,2) DEFAULT NULL,
  `left_sph` decimal(5,2) DEFAULT NULL,
  `pd` decimal(5,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`prescription_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_id`, `user_id`, `right_sph`, `left_sph`, `pd`, `created_at`) VALUES
(1, 1, '-1.25', '-1.00', '62.50', '2025-11-20 17:45:34'),
(2, 2, '-2.00', '-1.75', '63.00', '2025-11-20 17:45:34'),
(3, 3, '-0.75', '-0.50', '61.50', '2025-11-20 17:45:34'),
(4, 4, '-3.00', '-2.75', '64.00', '2025-11-20 17:45:34'),
(5, 5, '-1.50', '-1.25', '62.00', '2025-11-20 17:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `frame_shape` varchar(50) DEFAULT NULL,
  `frame_material` varchar(50) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `description`, `price`, `frame_shape`, `frame_material`, `image`, `is_active`, `created_at`) VALUES
(1, 1, 'AirFlex Black Rim', 'Featherlight black rim eyeglass frame', '1499.00', 'Round', 'TR90', 'airflex_black.png', 1, '2025-11-20 17:45:33'),
(2, 2, 'Wayfarer UV Pro', 'Classic wayfarer sunglasses with UV protection', '1699.00', 'Wayfarer', 'Polycarbonate', 'wayfarer_uv.png', 1, '2025-11-20 17:45:33'),
(3, 3, 'BlueX Shield', 'Anti-blue light computer glasses', '1299.00', 'Rectangle', 'Metal', 'bluex_shield.png', 1, '2025-11-20 17:45:33'),
(4, 4, 'Kiddo Soft Pink', 'Kids eyewear soft pink frame', '999.00', 'Oval', 'Flexible Rubber', 'kiddo_pink.png', 1, '2025-11-20 17:45:33'),
(5, 5, 'Royal Gold Metal', 'Premium gold metal frame', '2499.00', 'Aviator', 'Stainless Steel', 'royal_gold.png', 1, '2025-11-20 17:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 5, 'Amazing frame! Very lightweight.', '2025-11-20 17:45:34'),
(2, 2, 2, 4, 'Stylish sunglasses, totally worth it.', '2025-11-20 17:45:34'),
(3, 3, 3, 5, 'Perfect for work-from-home.', '2025-11-20 17:45:34'),
(4, 4, 4, 4, 'Kids glasses are soft and safe.', '2025-11-20 17:45:34'),
(5, 5, 5, 5, 'Premium quality. Looks very classy.', '2025-11-20 17:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

DROP TABLE IF EXISTS `shipments`;
CREATE TABLE IF NOT EXISTS `shipments` (
  `shipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `status` enum('ASSIGNED','OUT_FOR_DELIVERY','DELIVERED','RETURNED') DEFAULT 'ASSIGNED',
  `assigned_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`shipment_id`),
  KEY `order_id` (`order_id`),
  KEY `agent_id` (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`shipment_id`, `order_id`, `agent_id`, `status`, `assigned_at`, `delivered_at`) VALUES
(1, 1, 1, 'ASSIGNED', '2025-11-20 17:45:34', NULL),
(2, 2, 2, 'OUT_FOR_DELIVERY', '2025-11-20 17:45:34', NULL),
(3, 3, 3, 'DELIVERED', '2025-11-20 17:45:34', NULL),
(4, 4, 4, 'RETURNED', '2025-11-20 17:45:34', NULL),
(5, 5, 5, 'ASSIGNED', '2025-11-20 17:45:34', NULL),
(6, 6, NULL, 'ASSIGNED', '2025-11-20 17:58:21', NULL),
(7, 7, NULL, 'ASSIGNED', '2025-11-21 09:49:56', NULL),
(8, 8, NULL, 'ASSIGNED', '2025-11-22 09:16:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `city`, `state`, `pincode`, `created_at`) VALUES
(1, 'Raj Patel', 'rajpatel@gmail.com', '$2y$10$dummyhashedpass', '9876543210', 'Ahmedabad', 'Gujarat', '380015', '2025-11-20 17:42:53'),
(2, 'Priya Sharma', 'priya.sharma@gmail.com', '$2y$10$dummyhashedpass', '9123456780', 'Delhi', 'Delhi', '110054', '2025-11-20 17:42:53'),
(3, 'Aakash Verma', 'aakashv01@gmail.com', '$2y$10$dummyhashedpass', '9898989898', 'Mumbai', 'Maharashtra', '400001', '2025-11-20 17:42:53'),
(4, 'Sneha Kapoor', 'sneha.kapoor@gmail.com', '$2y$10$dummyhashedpass', '9988776655', 'Bengaluru', 'Karnataka', '560001', '2025-11-20 17:42:53'),
(5, 'Harshit Singh', 'harshit.singh@gmail.com', '$2y$10$dummyhashedpass', '9090909090', 'Jaipur', 'Rajasthan', '302001', '2025-11-20 17:42:53'),
(6, 'Raj Patel', 'raj.patel1@gmail.com', '$2y$10$dummyhashedpass', '9876543210', 'Ahmedabad', 'Gujarat', '380015', '2025-11-20 17:45:33'),
(7, 'Priya Sharma', 'priya.sharma01@gmail.com', '$2y$10$dummyhashedpass', '9123456780', 'Delhi', 'Delhi', '110054', '2025-11-20 17:45:33'),
(8, 'Aakash Verma', 'aakash.verma02@gmail.com', '$2y$10$dummyhashedpass', '9898989898', 'Mumbai', 'Maharashtra', '400001', '2025-11-20 17:45:33'),
(9, 'Sneha Kapoor', 'sneha.kapoor03@gmail.com', '$2y$10$dummyhashedpass', '9988776655', 'Bengaluru', 'Karnataka', '560001', '2025-11-20 17:45:33'),
(10, 'Harshit Singh', 'harshit.singh04@gmail.com', '$2y$10$dummyhashedpass', '9090909090', 'Jaipur', 'Rajasthan', '302001', '2025-11-20 17:45:33'),
(12, 'dip', 'dip1213@gmail.com', '$2y$10$TLXiTb0poB61bsgb87d37udQ0qfcOo1WyE8YnuvVtOWdpwcEMxeE6', '9909869820', 'Ahmedabad ', 'Gujarat ', '02763', '2025-11-20 17:57:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
