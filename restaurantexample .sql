-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2025 at 08:08 PM
-- Server version: 8.2.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantexample`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `CustomerID` int NOT NULL,
  `CustomerFName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CustomerLName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PhoneNo` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`CustomerID`),
  UNIQUE KEY `customers_phoneno_unique` (`PhoneNo`),
  KEY `customers_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `CustomerFName`, `CustomerLName`, `PhoneNo`, `Address`, `Email`, `user_id`) VALUES
(22, 'omar', 'abdelmoniem', '01556480411', '36 mansheia tawabiq', 'commandaaa@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `EmployeeID` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `EmployeeName` varchar(30) DEFAULT NULL,
  `EmployeePosition` varchar(10) DEFAULT NULL,
  `Phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_time_login` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`EmployeeID`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `user_id`, `EmployeeName`, `EmployeePosition`, `Phone`, `first_time_login`) VALUES
(26, 26, 'Ahmed ehab', 'DB manager', '01556480411', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `category`, `available`, `image`) VALUES
(1, 'Margherita Pizza', 'Classic cheese and tomato pizza', 8.99, 'Pizza', 1, NULL),
(2, 'Pepperoni Pizza', 'Spicy pepperoni with mozzarella', 9.99, 'Pizza', 1, NULL),
(3, 'Caesar Salad', 'Crisp romaine lettuce with Caesar dressing', 6.50, 'Salad', 1, NULL),
(4, 'Grilled Chicken Sandwich', 'Grilled chicken breast on a toasted bun', 7.75, 'Sandwich', 1, NULL),
(5, 'Spaghetti Bolognese', 'Pasta with rich meat sauce', 10.25, 'Pasta', 1, NULL),
(6, 'Mushroom Risotto', 'Creamy risotto with mushrooms and parmesan', 9.50, 'Rice', 1, NULL),
(7, 'Fish Tacos', 'Grilled fish with slaw and chipotle mayo', 8.25, 'Seafood', 1, NULL),
(8, 'Beef Burger', 'Juicy beef patty with lettuce and tomato', 9.75, 'Burger', 1, NULL),
(9, 'Tomato Soup', 'Fresh tomato soup with basil', 4.99, 'Soup', 1, NULL),
(10, 'Chocolate Lava Cake', 'Warm chocolate cake with gooey center', 5.50, 'Dessert', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item_restaurant`
--

DROP TABLE IF EXISTS `menu_item_restaurant`;
CREATE TABLE IF NOT EXISTS `menu_item_restaurant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint UNSIGNED NOT NULL,
  `menu_item_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_restaurant` (`restaurant_id`),
  KEY `fk_menu_item` (`menu_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu_item_restaurant`
--

INSERT INTO `menu_item_restaurant` (`id`, `restaurant_id`, `menu_item_id`) VALUES
(1, 1, 4),
(2, 1, 8),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(6, 2, 3),
(7, 3, 6),
(8, 3, 7),
(9, 3, 9),
(10, 4, 5),
(11, 4, 6),
(12, 4, 9),
(13, 5, 10),
(14, 88, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_04_23_202935_create_users_table_with_account_types', 1),
(2, '2025_04_24_124619_create_customers_table', 1),
(3, '2025_04_24_135038_add_user_id_to_customers_table', 1),
(4, '2025_04_24_212137_create_restaurants_table', 1),
(5, '2025_04_24_220733_create_menu_items_table', 1),
(6, '2025_04_24_220850_create_reservations_table', 1),
(7, '2025_04_24_220930_create_orders_table', 1),
(8, '2025_04_24_232700_create_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivery_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_restaurant_id_foreign` (`restaurant_id`),
  KEY `orders_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `restaurant_id`, `user_id`, `total_amount`, `status`, `delivery_address`, `created_at`, `updated_at`) VALUES
(10, 3, 22, 28.50, 'pending', '36 mansheia tawabiq', '2025-04-27 16:12:12', '2025-04-27 16:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `guests` int NOT NULL,
  `special_requests` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_restaurant_id_foreign` (`restaurant_id`),
  KEY `reservations_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `restaurant_id`, `user_id`, `date`, `time`, `guests`, `special_requests`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 22, '2025-04-28', '07:00:00', 3, 'none', 'pending', '2025-04-27 16:12:48', '2025-04-27 16:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
CREATE TABLE IF NOT EXISTS `restaurants` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cuisine_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_hours` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `price_range` int DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `delivery_available` tinyint(1) DEFAULT NULL,
  `takeout_available` tinyint(1) NOT NULL DEFAULT '0',
  `reservation_available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurants_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `description`, `cuisine_type`, `address`, `city`, `state`, `postal_code`, `phone`, `email`, `website`, `opening_hours`, `rating`, `price_range`, `featured`, `image`, `latitude`, `longitude`, `delivery_available`, `takeout_available`, `reservation_available`, `created_at`, `updated_at`, `employee_id`) VALUES
(1, 'Schamberger and Sons Eatery', 'Since 1985, we\'ve been serving juicy, hand-pattied burgers on toasted buns with all the fixings. Our secret? Fresh never-frozen beef, locally-sourced ingredients, and a grill that\'s seen over 3 million burgers.', 'Sandwich', '91550 Violet Summit Suite 729', 'East Orlo', 'New Jersey', '82483', '437-518-3655', 'hagenes.rosario@example.com', 'http://towne.org/', '9:00 AM - 10:00 PM', 1.2, 4, 0, 'restaurants/restaurant2.png', 43.7838040, 13.2748840, 0, 1, 1, '2025-04-25 06:42:18', '2025-04-25 06:42:18', NULL),
(2, 'Pizza Express', '100% grass-fed beef from neighboring ranches, organic veggies from local farms, and buns baked fresh daily. Taste the difference that ethical sourcing makes in every bite.', 'Pizza', '1891 Klocko Road Suite 965', 'Quigleyton', 'Indiana', '10644-2815', '+1-501-709-2342', 'jevon.brown@example.com', 'http://www.jast.com/debitis-possimus-omnis-nostrum', '10:00 AM - 12:00 AM', 3.4, 3, 1, 'restaurants/restaurant3.jpg', -2.6898730, 11.1869670, 1, 1, 1, '2025-04-25 06:42:18', '2025-04-25 06:42:18', NULL),
(3, 'Sea Pirates', 'Yo Ho Ho and a barrel of fish cuisine, been around the block, selling only the freshest fish!', 'Sea Food', '46748 Connor Alley Apt. 895', 'Lake Paulchester', 'Montana', '04899', '(439) 286-0766', 'gziemann@example.net', 'http://ziemann.com/', '11:00 AM - 11:00 PM', 1.2, 2, 0, 'restaurants/restaurant4.jpg', 39.3587170, 121.5744260, 1, 1, 1, '2025-04-25 06:42:18', '2025-04-25 06:42:18', NULL),
(4, 'Ling Ling Bing', 'A world tour in Asian cuisine form - try our \'Tokyo Teriyaki\', \'Mexican Fiesta\', or \'Parisian Brie\' creations. Every month features a new international special', 'Asian', '950 Eldridge Street Apt. 752', 'Jackshire', 'Tennessee', '70647', '224.298.5656', 'elena.okeefe@example.net', 'http://schmidt.com/optio-itaque-nostrum-odio-ea-eum', '10:00 AM - 12:00 AM', 4.1, 1, 1, 'restaurants/restaurant5.jpg', -73.1883460, -5.6147560, 1, 1, 1, '2025-04-25 06:42:18', '2025-04-25 06:42:18', NULL),
(5, 'Velvet Velour', 'Consequatur eos occaecati deserunt molestiae. Dolor provident provident repellendus iure. Ullam distinctio et rem blanditiis voluptates hic eveniet ipsa. Veritatis qui repellendus aliquam quas. Ducimus iusto et ex eligendi ipsam et.', 'Dessert', '28034 Emil Shores Suite 441', 'Marcelleton', 'Delaware', '23111', '+1.247.610.0940', 'sigmund12@example.org', 'http://www.reynolds.com/', '11:00 AM - 11:00 PM', 2.6, 1, 0, 'restaurants/restaurant6.jpg', 29.7267700, -50.8226960, 0, 1, 1, '2025-04-25 06:42:18', '2025-04-25 06:42:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_employee`
--

DROP TABLE IF EXISTS `restaurant_employee`;
CREATE TABLE IF NOT EXISTS `restaurant_employee` (
  `restaurant_id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`restaurant_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurant_employee`
--

INSERT INTO `restaurant_employee` (`restaurant_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 26, '2025-04-27 19:01:33', '2025-04-27 19:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_restaurant_id_foreign` (`restaurant_id`),
  KEY `reviews_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` enum('employee','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `account_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(26, 'Ahmed ehab', 'baba@gmail.com', NULL, '$2y$10$DFJ8gSzEU7276woCrm.7gesN.FJ/xzQSh7zZc9HcVvwKwr1XJu97.', 'employee', NULL, '2025-04-27 16:00:24', '2025-04-27 16:00:24'),
(22, 'omar hamed abdelmoniem', 'commandaaa@gmail.com', NULL, '$2y$10$.89NtTlqavDfUOQ2gl3SL.dzV81onrC1ZEB7C8e8daAOI8loKWy72', 'customer', NULL, '2025-04-27 11:41:05', '2025-04-27 11:41:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
