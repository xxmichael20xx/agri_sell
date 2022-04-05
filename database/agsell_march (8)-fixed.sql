-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 09:26 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agsell_march`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notification`
--

CREATE TABLE `admin_notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_type` tinytext NOT NULL,
  `action_description` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_notification`
--

INSERT INTO `admin_notification` (`id`, `user_id`, `action_type`, `action_description`, `created_at`, `updated_at`) VALUES
(1, 3, 'Product addition', 'Added nah wholesale to the products list', '2022-03-21 15:56:37', '2022-03-21 23:56:37'),
(2, 3, 'Product addition', 'Added 53353fdaf to the products list', '2022-03-21 16:18:33', '2022-03-22 00:18:33'),
(3, 3, 'Product addition', 'Added 44553 regular product add to the products list', '2022-03-21 16:20:29', '2022-03-22 00:20:29'),
(4, 3, 'Product addition', 'Added 5353 to the products list', '2022-03-21 16:23:36', '2022-03-22 00:23:36'),
(5, 3, 'Product addition', 'Added 44553 regular product add to the products list', '2022-03-21 16:24:46', '2022-03-22 00:24:46'),
(6, 3, 'Product addition', 'Added 424224 kinu crops to the products list', '2022-03-21 16:32:07', '2022-03-22 00:32:07'),
(7, 3, 'Product addition', 'Added 422dasd to the products list', '2022-03-21 16:33:01', '2022-03-22 00:33:01'),
(8, 3, 'Product addition', 'Added 5647 to the products list', '2022-03-21 16:41:56', '2022-03-22 00:41:56'),
(9, 3, 'Product addition', 'Added 24422 to the products list', '2022-03-21 17:26:30', '2022-03-22 01:26:30'),
(10, 3, 'Product addition', 'Added wholesale only to the products list', '2022-03-21 17:53:11', '2022-03-22 01:53:11'),
(11, 3, 'Product addition', 'Added with wholesale to the products list', '2022-03-21 17:55:50', '2022-03-22 01:55:50'),
(12, 3, 'Product addition', 'Added 24422 to the products list', '2022-03-21 19:33:35', '2022-03-22 03:33:35'),
(13, 3, 'Product addition', 'Added 53353fdaf to the products list', '2022-03-21 19:42:20', '2022-03-22 03:42:20'),
(14, 3, 'Product addition', 'Added prod lkanina to the products list', '2022-03-21 19:48:40', '2022-03-22 03:48:40'),
(15, 3, 'Product addition', 'Added produkltdsa to the products list', '2022-03-21 23:01:11', '2022-03-22 07:01:11'),
(16, 3, 'Product addition', 'Added 244224 to the products list', '2022-03-21 23:40:05', '2022-03-22 07:40:05'),
(17, 3, 'Product addition', 'Added 245255 to the products list', '2022-03-22 02:36:34', '2022-03-22 10:36:34'),
(18, 3, 'Product addition', 'Added yung may variation knina to the products list', '2022-03-22 02:59:24', '2022-03-22 10:59:24'),
(19, 3, 'Product addition', 'Added 5335 to the products list', '2022-03-22 03:05:42', '2022-03-22 11:05:42'),
(20, 3, 'Product addition', 'Added 53535353553 to the products list', '2022-03-22 03:07:31', '2022-03-22 11:07:31'),
(21, 3, 'Product addition', 'Added 424 to the products list', '2022-03-22 04:33:11', '2022-03-22 12:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Crops', 'crops', '2020-03-07 07:10:58', '2020-03-07 07:10:58'),
(2, NULL, 2, 'Vegetables', 'vegetables', '2020-03-07 07:11:36', '2020-03-07 07:11:36'),
(3, NULL, 3, 'Fruits', 'fruits', '2020-03-14 02:02:06', '2020-03-14 02:02:06'),
(4, NULL, 4, 'Livestocks', 'livestocks', '2020-03-14 02:02:28', '2020-03-14 02:02:41'),
(5, NULL, 1, 'Seeds', 'Seeds', NULL, NULL),
(6, NULL, 1, 'Grains', 'Grains', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coins_refund_requests`
--

CREATE TABLE `coins_refund_requests` (
  `id` int(11) NOT NULL,
  `cust_user_id` int(11) NOT NULL,
  `emp_user_id` int(11) NOT NULL,
  `refund_id` tinytext NOT NULL,
  `amount` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coins_top_up`
--

CREATE TABLE `coins_top_up` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `trans_id` text DEFAULT NULL,
  `coins_trans_type` varchar(255) NOT NULL DEFAULT 'gcash',
  `invalid_reason` text NOT NULL,
  `reference_id` tinytext NOT NULL,
  `approved_by_user_id` tinytext NOT NULL,
  `remarks` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_proof` tinytext NOT NULL,
  `value` bigint(20) NOT NULL,
  `time_reflected` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coins_top_up`
--

INSERT INTO `coins_top_up` (`id`, `user_id`, `trans_id`, `coins_trans_type`, `invalid_reason`, `reference_id`, `approved_by_user_id`, `remarks`, `created_at`, `updated_at`, `image_proof`, `value`, `time_reflected`) VALUES
(1, 1, 'TRY35', 'gcash', '', 'COINS6225a2fca92dd', '56', '1', '2022-03-07 06:15:24', '2022-03-15 06:49:30', 'coinsTopUp\\March2022\\16466337246225a2fca5993-coinsTopUp.jpg', 43535, '2022-03-07 06:15:24'),
(2, 1, '53dsad', 'paymaya', 'incorrect_reference_num', 'COINS6229cd0ab1c41', '', '0', '2022-03-10 10:03:54', '2022-03-15 01:05:00', 'coinsTopUp\\March2022\\16469066346229cd0aaeacf-coinsTopUp.PNG', 45535, '2022-03-10 10:03:54'),
(3, 1, '4647', 'rem_centers', '', 'COINS622f6de08897a', '56', '1', '2022-03-14 16:31:28', '2022-03-15 06:34:51', 'coinsTopUp\\March2022\\1647275488622f6de085be4-coinsTopUp.jpg', 544, '2022-03-14 16:31:28'),
(4, 1, 'AET25', 'gcash', '', 'COINS622f6ec8cfc55', '56', '1', '2022-03-14 16:35:20', '2022-03-15 07:10:46', 'coinsTopUp\\March2022\\1647275720622f6ec8cd0cf-coinsTopUp.webp', 665758, '2022-03-14 16:35:20'),
(5, 1, 'dasf920', 'gcash', 'incorrect_reference_num', 'COINS622fe5971e395', '', '0', '2022-03-15 01:02:15', '2022-03-15 01:08:01', 'coinsTopUp\\March2022\\1647306135622fe5971b2e9-coinsTopUp.jpg', 500, '2022-03-15 01:02:15'),
(6, 1, '4242', 'paymaya', 'wrong_information', 'COINS6231d6b663fd3', '', '0', '2022-03-16 12:23:18', '2022-03-16 12:38:47', 'coinsTopUp\\March2022\\16474333986231d6b660836-coinsTopUp.jpg', 4242, '2022-03-16 12:23:18'),
(7, 1, '4224A', 'gcash', 'wrong details', 'COINS6231da249e001', '', '0', '2022-03-16 12:37:56', '2022-03-16 13:00:19', 'coinsTopUp\\March2022\\16474342766231da249aa51-coinsTopUp.jpg', 424, '2022-03-16 12:37:56'),
(8, 1, 'ART23456', 'paymaya', '', 'COINS6231ded237233', '', '2', '2022-03-16 12:57:54', '2022-03-16 12:57:54', 'coinsTopUp\\March2022\\16474354746231ded233a9a-coinsTopUp.jpg', 424242, '2022-03-16 12:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `coins_top_up_employee`
--

CREATE TABLE `coins_top_up_employee` (
  `id` int(11) NOT NULL,
  `employee_code` tinytext NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coins_top_up_employee`
--

INSERT INTO `coins_top_up_employee` (`id`, `employee_code`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'COINS_ARFCDAFFA', 55, '2022-01-17 00:09:02', '2022-01-17 00:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `coins_top_up_emp_entry`
--

CREATE TABLE `coins_top_up_emp_entry` (
  `id` int(11) NOT NULL,
  `cust_user_id` bigint(20) NOT NULL,
  `emp_user_id` bigint(20) NOT NULL,
  `cust_trans_id` tinytext NOT NULL,
  `coins_trans_type` varchar(255) NOT NULL DEFAULT 'none',
  `is_approved` varchar(255) DEFAULT NULL,
  `value` bigint(20) NOT NULL,
  `status` varchar(255) DEFAULT 'encoded',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coins_transaction`
--

CREATE TABLE `coins_transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `order_reference_number` tinytext NOT NULL,
  `time_conducted` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaction_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coins_transaction`
--

INSERT INTO `coins_transaction` (`id`, `user_id`, `value`, `order_reference_number`, `time_conducted`, `transaction_type`) VALUES
(1, 1, 146, 'AGRIREF-622dbdec29181', '2022-03-13 09:49:36', 'Item orders'),
(2, 1, 0, 'AGRIREF-622e98f817e0f', '2022-03-14 01:24:41', 'Item orders'),
(3, 1, 137, 'AGRIREF-622ecd06e6b44', '2022-03-14 05:05:31', 'Item orders'),
(4, 1, 0, 'AGRIREF-622ed7cb5454f', '2022-03-14 05:52:20', 'Item orders'),
(5, 1, 0, 'AGRIREF-6232c56d79aa4', '2022-03-17 05:22:14', 'Item orders'),
(6, 1, 95, 'AGRIREF-6232c6a92f3d7', '2022-03-17 05:27:52', 'Item orders');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commenter_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commenter_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 1,
  `child_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `commenter_id`, `commenter_type`, `guest_name`, `guest_email`, `commentable_type`, `commentable_id`, `comment`, `approved`, `child_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1', 'App\\User', NULL, NULL, 'App\\Product', '3', 'fsffdsfdsf', 1, NULL, NULL, '2022-03-13 08:58:47', '2022-03-13 09:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `type`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, '10off', '10OFF', 'DISCOUNT', '100', 'TEST', '2021-08-21 15:11:19', '2021-08-21 15:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `deliverystaff`
--

CREATE TABLE `deliverystaff` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `rider_id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vehicle_used` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliverystaff`
--

INSERT INTO `deliverystaff` (`id`, `user_id`, `rider_id`, `password`, `vehicle_used`, `status`) VALUES
(1, 82, 'AGRIDER621ec88e5f854', '', 'testing2', ''),
(3, 87, 'AGRIDER622ee16c6ffda', '424242', 'Tricycle 4 by 4', '');

-- --------------------------------------------------------

--
-- Table structure for table `deliverytransaction`
--

CREATE TABLE `deliverytransaction` (
  `id` int(11) NOT NULL,
  `shop_id` tinytext NOT NULL,
  `transaction_id` tinytext NOT NULL,
  `amount_paid` tinytext NOT NULL,
  `commission` tinytext NOT NULL,
  `status` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invalid_id_reasons`
--

CREATE TABLE `invalid_id_reasons` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invalid_id_reasons`
--

INSERT INTO `invalid_id_reasons` (`id`, `slug`, `display_name`, `description`) VALUES
(1, 'incorrect_details', 'Incorrect details', 'Some of the inserted data to registration does not match to the valid id.'),
(3, 'unclear_id', 'Unclear ID', 'The information in the ID is not readable. So it cannot be verified.'),
(4, 'fake_id', 'Fake id', 'The ID used is valid but the ID is counterfeit.'),
(5, 'not_id', 'Not an ID', 'The image used is not valid and does not showing a proof of identity.');

-- --------------------------------------------------------

--
-- Table structure for table `invalid_sell_reg_reasons`
--

CREATE TABLE `invalid_sell_reg_reasons` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `slug` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invalid_sell_reg_reasons`
--

INSERT INTO `invalid_sell_reg_reasons` (`id`, `name`, `slug`) VALUES
(1, 'wrong_amount', 'Wrong payment proof amount'),
(2, 'not_payment_form', 'Not a payment form'),
(3, 'fake_payment_form', 'Fake payment form'),
(4, 'not_init', 'Not initialized'),
(5, 'invalid_payment_details', 'Invalid payment details');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-02-10 16:10:11', '2020-02-10 16:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2020-02-10 16:10:11', '2020-02-10 16:10:11', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 4, '2020-02-10 16:10:11', '2021-08-21 17:05:53', 'voyager.media.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 2, '2020-02-10 16:10:11', '2020-02-10 16:10:11', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 8, '2020-02-10 16:10:11', '2021-08-29 04:24:10', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2020-02-10 16:10:11', '2021-08-21 04:54:25', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2020-02-10 16:10:11', '2021-08-21 04:54:25', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2020-02-10 16:10:11', '2021-08-21 04:54:25', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2020-02-10 16:10:11', '2021-08-21 04:54:25', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 9, '2020-02-10 16:10:11', '2021-08-29 04:24:10', 'voyager.settings.index', NULL),
(11, 1, 'Categories', '', '_self', 'voyager-categories', NULL, NULL, 6, '2020-02-10 16:10:14', '2021-08-29 04:23:57', 'voyager.categories.index', NULL),
(14, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 5, '2020-02-10 16:10:14', '2021-08-21 04:54:25', 'voyager.hooks', NULL),
(15, 1, 'Orders', '', '_self', 'voyager-buy', NULL, NULL, 10, '2020-02-10 16:22:34', '2021-08-21 17:05:38', 'voyager.orders.index', NULL),
(16, 1, 'Shops', '', '_self', 'voyager-shop', '#000000', NULL, 11, '2020-02-19 09:15:37', '2021-08-21 17:05:38', 'voyager.shops.index', 'null'),
(17, 1, 'Products', '', '_self', 'voyager-bag', '#000000', NULL, 12, '2020-02-19 09:18:39', '2021-08-21 17:05:38', 'voyager.products.index', 'null'),
(22, 1, 'Seller Registration Fees', '', '_self', 'voyager-company', '#000000', NULL, 5, '2021-08-20 22:35:46', '2021-08-21 17:05:53', 'voyager.seller-registration-fee.index', 'null'),
(26, 1, 'User Valid Ids', '', '_self', 'voyager-credit-cards', '#000000', NULL, 3, '2021-08-21 15:28:54', '2021-08-21 17:07:14', 'voyager.user-valid-ids.index', 'null'),
(30, 1, 'Users', '', '_self', 'voyager-person', '#000000', NULL, 7, '2021-08-29 04:15:58', '2021-08-29 05:34:35', 'voyager.users.index', 'null'),
(31, 1, 'Coins Top Ups', '', '_self', 'voyager-wallet', '#000000', NULL, 13, '2021-10-01 16:44:40', '2021-10-06 18:00:05', 'voyager.coins-top-up.index', 'null'),
(34, 1, 'Supported Towns', '', '_self', NULL, NULL, NULL, 14, '2021-10-23 01:16:09', '2021-10-23 01:16:09', 'voyager.supported-towns.index', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_01_01_000000_create_pages_table', 1),
(6, '2016_01_01_000000_create_posts_table', 1),
(7, '2016_02_15_204651_create_categories_table', 1),
(8, '2016_05_19_173453_create_menu_table', 1),
(9, '2016_10_21_190000_create_roles_table', 1),
(10, '2016_10_21_190000_create_settings_table', 1),
(11, '2016_11_30_135954_create_permission_table', 1),
(12, '2016_11_30_141208_create_permission_role_table', 1),
(13, '2016_12_26_201236_data_types__add__server_side', 1),
(14, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(15, '2017_01_14_005015_create_translations_table', 1),
(16, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(17, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(18, '2017_04_11_000000_alter_post_nullable_fields_table', 1),
(19, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(20, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(21, '2017_08_05_000000_add_group_to_settings_table', 1),
(22, '2017_11_26_013050_add_user_role_relationship', 1),
(23, '2017_11_26_015000_create_user_roles_table', 1),
(24, '2018_03_11_000000_add_user_settings', 1),
(25, '2018_03_14_000000_add_details_to_data_types_table', 1),
(26, '2018_03_16_000000_make_settings_value_nullable', 1),
(27, '2019_08_19_000000_create_failed_jobs_table', 1),
(28, '2020_02_01_064736_create_shops_table', 1),
(29, '2020_02_02_070326_create_products_table', 1),
(30, '2020_02_06_174602_create_orders_table', 1),
(31, '2020_02_06_181800_create_order_items_table', 1),
(32, '2020_03_14_095509_create_product_categories_table', 1),
(33, '2020_04_04_090325_create_coupons_table', 1),
(34, '2020_08_15_170110_create_sub_orders_table', 1),
(35, '2020_08_15_170139_create_sub_order_items_table', 1),
(36, '2020_08_15_175106_create_transactions_table', 1),
(37, '2020_10_31_170002_create_attributes_table', 1),
(38, '2020_10_31_170037_create_attribute_values_table', 1),
(39, '2020_10_31_170931_add_attribute_column_to_products_table', 1),
(40, '2021_02_16_174739_add_paypal_order_id_to_orders_table', 1),
(41, '2018_06_30_113500_create_comments_table', 2),
(42, '2021_09_16_222808_create_ratings_table', 3),
(43, '2022_01_21_121245_create_otps_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notification_table`
--

CREATE TABLE `notification_table` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `frm_user_id` bigint(20) NOT NULL,
  `notification_title` tinytext NOT NULL,
  `notification_txt` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_seen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification_table`
--

INSERT INTO `notification_table` (`id`, `user_id`, `frm_user_id`, `notification_title`, `notification_txt`, `created_at`, `updated_at`, `is_seen`) VALUES
(1, 1, 1, 'OTP agricoins verification', 'You spend: 0in your agricoins wallet', '2022-03-14 04:58:10', '2022-03-14 04:58:10', 'yes'),
(2, 0, 1, 'OTP agricoins verification', 'You spend: 137in your agricoins wallet', '2022-03-14 05:05:31', '2022-03-14 05:05:31', ''),
(3, 1, 1, 'OTP agricoins verification for AGRIREF-622ecb8a62c59', 'Agri coins payment denied', '2022-03-14 05:11:42', '2022-03-14 05:11:42', 'yes'),
(4, 0, 1, 'OTP agricoins verification', 'You spend: 0in your agricoins wallet', '2022-03-14 05:52:20', '2022-03-14 05:52:20', ''),
(5, 1, 1, 'OTP agricoins verification for AGRIREF-622ed920f1e62', 'Agri coins payment denied', '2022-03-14 06:49:21', '2022-03-14 06:49:21', 'yes'),
(6, 0, 1, 'Seller registration fee status', 'Your shop is approved you may now open<br>your shop in the <a class=\"btn btn-primary\" href=\"/sellerpanel\">Seller panel</a>', '2022-03-14 14:04:56', '2022-03-14 14:04:56', ''),
(7, 1, 1, 'OTP agricoins verification for AGRIREF-622f5bdcefbd1', 'Agri coins payment denied', '2022-03-14 15:29:15', '2022-03-14 15:29:15', 'yes'),
(8, 1, 1, 'OTP agricoins verification for AGRIREF-622f5c802b747', 'Agri coins payment denied', '2022-03-14 15:29:15', '2022-03-14 15:29:15', 'yes'),
(9, 1, 1, 'OTP agricoins verification for AGRIREF-622f5f646943b', 'Agri coins payment denied', '2022-03-14 15:30:05', '2022-03-14 15:30:05', 'yes'),
(10, 1, 1, 'OTP agricoins verification for AGRIREF-622f6234b9ed6', 'Agri coins payment denied', '2022-03-14 15:42:14', '2022-03-14 15:42:14', 'yes'),
(11, 1, 1, 'OTP agricoins verification for AGRIREF-622f62c3b22c0', 'Agri coins payment denied', '2022-03-14 15:45:17', '2022-03-14 15:45:17', 'yes'),
(12, 1, 1, 'OTP agricoins verification for AGRIREF-622f64329ae67', 'Agri coins payment denied', '2022-03-14 16:31:13', '2022-03-14 16:31:13', 'yes'),
(13, 1, 1, 'OTP agricoins verification for AGRIREF-622f64329ae67', 'Agri coins payment denied', '2022-03-14 16:31:13', '2022-03-14 16:31:13', 'yes'),
(14, 1, 1, 'OTP agricoins verification for AGRIREF-622f648065620', 'Agri coins payment denied', '2022-03-14 16:31:13', '2022-03-14 16:31:13', 'yes'),
(15, 1, 2, 'Coins top up for COINS622f6de08897a', '<br>Your coins top up for the value 544<br>PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.</br>', '2022-03-15 01:02:43', '2022-03-15 01:02:43', 'yes'),
(16, 1, 2, 'Coins top up for COINS622f6ec8cfc55', '<br>Your coins top up for the value 665758<br>PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.</br>', '2022-03-15 01:02:43', '2022-03-15 01:02:43', 'yes'),
(17, 84, 1, 'Seller registration fee status', 'Your shop is approved you may now open<br>your shop in the <a class=\"btn btn-primary\" href=\"/sellerpanel\">Seller panel</a>', '2022-03-14 21:35:10', '2022-03-14 21:35:10', ''),
(18, 76, 1, 'Seller registration fee status', 'Your shop is approved you may now open<br>your shop in the <a class=\"btn btn-primary\" href=\"/sellerpanel\">Seller panel</a>', '2022-03-14 21:35:41', '2022-03-14 21:35:41', ''),
(19, 0, 1, 'Seller registration fee status', 'Invalid seller amount please register your shop again', '2022-03-14 23:28:29', '2022-03-14 23:28:29', ''),
(20, 69, 1, 'Seller registration fee status', 'Your shop is approved you may now open<br>your shop in the <a class=\"btn btn-primary\" href=\"/sellerpanel\">Seller panel</a>', '2022-03-15 00:13:07', '2022-03-15 00:13:07', ''),
(21, 0, 1, 'Seller registration fee status', 'Invalid seller amount please register your shop again', '2022-03-15 00:14:00', '2022-03-15 00:14:00', ''),
(22, 1, 2, 'Coins top up for COINS622fe5971e395', '<br>Your coins top up for the value 500<br>PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.</br>', '2022-03-15 01:02:43', '2022-03-15 01:02:43', 'yes'),
(23, 56, 2, 'Coins top up for COINS622f6de08897a', '<br>Coins top up for <br>COINS622f6de08897a<br>is completed', '2022-03-15 06:41:51', '2022-03-15 06:41:51', ''),
(24, 1, 2, 'Coins top up for COINS622f6de08897a', '<br>Coins top up for <br>COINS622f6de08897a<br>is completed', '2022-03-15 06:46:49', '2022-03-15 06:46:49', 'yes'),
(25, 1, 2, 'Coins top up for COINS6225a2fca92dd', '<br>Coins top up for <br>COINS6225a2fca92dd<br>is completed', '2022-03-15 07:02:40', '2022-03-15 07:02:40', 'yes'),
(26, 1, 2, 'Coins top up for COINS622f6ec8cfc55', '<br>Coins top up for <br>COINS622f6ec8cfc55<br>is completed', '2022-03-16 03:06:05', '2022-03-16 03:06:05', 'yes'),
(27, 86, 1, 'Seller registration fee status', 'Your shop is approved you may now open<br>your shop in the <a class=\"btn btn-primary\" href=\"/sellerpanel\">Seller panel</a>', '2022-03-16 05:29:39', '2022-03-16 05:29:39', ''),
(28, 0, 1, 'Seller registration fee status', 'Invalid seller amount please register your shop again', '2022-03-16 05:54:08', '2022-03-16 05:54:08', ''),
(29, 1, 1, 'Seller registration fee status', 'Invalid seller amount please register your shop again <br>Reason: ', '2022-03-16 06:53:35', '2022-03-16 06:53:35', 'yes'),
(30, 1, 1, 'Seller registration fee status', 'Invalid seller amount please register your shop again <br>Reason: ', '2022-03-16 06:53:35', '2022-03-16 06:53:35', 'yes'),
(31, 1, 1, 'Seller registration fee status', 'Invalid seller amount please register your shop again <br>Reason: ', '2022-03-16 12:04:23', '2022-03-16 12:04:23', 'yes'),
(32, 87, 1, 'Seller registration fee status', 'Your shop is approved you may now open<br>your shop in the <a class=\"btn btn-primary\" href=\"/sellerpanel\">Seller panel</a>', '2022-03-16 12:20:29', '2022-03-16 12:20:29', 'yes'),
(33, 87, 1, 'Seller registration fee status', 'Your shop is approved you may now open<br>your shop in the <a class=\"btn btn-primary\" href=\"/sellerpanel\">Seller panel</a>', '2022-03-16 12:20:29', '2022-03-16 12:20:29', 'yes'),
(34, 87, 1, 'Seller registration fee status', 'Your shop is approved you may now open<br>your shop in the <a class=\"btn btn-primary\" href=\"/sellerpanel\">Seller panel</a>', '2022-03-16 12:20:29', '2022-03-16 12:20:29', 'yes'),
(35, 1, 2, 'Coins top up for COINS6231d6b663fd3', '<br>Your coins top up for the value 4242<br>PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.</br>', '2022-03-16 12:37:34', '2022-03-16 12:37:34', 'yes'),
(36, 1, 2, 'Coins top up for COINS6231da249e001', '<br>Your coins top up for the value 424<br>PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.</br>', '2022-03-16 12:39:19', '2022-03-16 12:39:19', 'yes'),
(37, 1, 2, 'Coins top up for COINS6231d6b663fd3', '<br>Your coins top up for the value <br>PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.</br>', '2022-03-16 12:39:19', '2022-03-16 12:39:19', 'yes'),
(38, 1, 2, 'Coins top up for COINS6231d6b663fd3', '<br>Your coins top up for failed invalid reason: </br>wrong_information', '2022-03-16 12:43:24', '2022-03-16 12:43:24', 'yes'),
(39, 1, 2, 'Coins top up for COINS6231ded237233', '<br>Your coins top up for the value 424242<br>PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.</br>', '2022-03-16 13:01:12', '2022-03-16 13:01:12', 'yes'),
(40, 1, 2, 'Coins top up for COINS6231da249e001', '<br>Your coins top up for failed invalid reason: </br>wrong details', '2022-03-16 13:01:12', '2022-03-16 13:01:12', 'yes'),
(41, 0, 1, 'OTP agricoins verification', 'You spend: 0in your agricoins wallet', '2022-03-17 05:22:14', '2022-03-17 05:22:14', ''),
(42, 0, 1, 'OTP agricoins verification', 'You spend: 95in your agricoins wallet', '2022-03-17 05:27:52', '2022-03-17 05:27:52', ''),
(43, 1, 1, 'OTP agricoins verification for AGRIREF-6232c89ecb1e8', 'Agri coins payment denied', '2022-03-17 05:35:49', '2022-03-17 05:35:49', '');

-- --------------------------------------------------------

--
-- Table structure for table `orderdeliverystatus`
--

CREATE TABLE `orderdeliverystatus` (
  `id` bigint(20) NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `name` tinytext NOT NULL,
  `display_name` tinytext NOT NULL,
  `description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdeliverystatus`
--

INSERT INTO `orderdeliverystatus` (`id`, `status_id`, `name`, `display_name`, `description`) VALUES
(1, 1, 'pending', 'Pending', 'Seller is preparing to ship your parce'),
(2, 2, 'manifested', 'Order confirmed', 'Seller is preparing to ship your order'),
(3, 3, 'pickup_by_rider', 'Picked up by rider success', 'Order has been picked up by courier'),
(4, 4, 'on_out_for_delivery', 'On out for delivery', 'Order is out for delivery'),
(5, 5, 'completed', 'Completed', 'Order has been delivered'),
(6, 6, 'delivery_failed', 'Delivery failed', 'Delivery attempt was unsuccessful'),
(7, 7, 'cancelled', 'Cancelled order', 'Order has been cancelled'),
(8, 8, 'notdelivery', 'Not delivery', 'Not delivery');

-- --------------------------------------------------------

--
-- Table structure for table `orderpickupstatus`
--

CREATE TABLE `orderpickupstatus` (
  `id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `display_name` tinytext NOT NULL,
  `description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderpickupstatus`
--

INSERT INTO `orderpickupstatus` (`id`, `status_id`, `name`, `display_name`, `description`) VALUES
(1, 1, 'pending', 'Pending', 'Your pickup is pending'),
(2, 2, 'ready_to_pick_up', 'Ready to pick up', 'Your order is ready to pickup'),
(3, 3, 'cancelled', 'Cancelled', 'Your order is cancelled'),
(4, 4, 'not_pickup', '', 'Not pickup'),
(5, 5, 'completed', 'Completed', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rider_id` bigint(20) DEFAULT 1,
  `status` enum('pending','processing','completed','decline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `grand_total` double(8,2) NOT NULL,
  `item_count` int(11) NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `payment_method` enum('cash_on_delivery','paypal','stripe','card','agrisell_coins') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash_on_delivery',
  `agrisell_coins_payment_status` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zipcode` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_barangay` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_fee` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paypal_orderid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agcoins_transid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_town` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pick_up` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderstatushist`
--

CREATE TABLE `orderstatushist` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `sold_per` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `types` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_weight` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `variation_id` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` int(11) NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT 0,
  `no_times_generated` int(11) NOT NULL DEFAULT 0,
  `no_times_attempted` int(11) NOT NULL DEFAULT 0,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Hello World', 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.', '<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', 'pages/page1.jpg', 'hello-world', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2020-02-10 16:10:14', '2020-02-10 16:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sellersamp@agrisell.com', '$2y$10$u9tbeWpH220HxRC/RCfeJu1AhNjYd1rD/MUZTCPVCoIFcLc.0iw0K', '2021-12-10 19:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `pre_orders`
--

CREATE TABLE `pre_orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pre_order_id` tinytext NOT NULL,
  `customer_user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `pre_order_date` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `pre_order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `is_pick_up` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `cover_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_cover_img` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`product_attributes`)),
  `sale_pct_deduction` float DEFAULT NULL,
  `whole_sale_pct_deduction` float DEFAULT NULL,
  `is_sale` tinyint(4) DEFAULT 0,
  `net_weight` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_whole_sale` tinyint(4) DEFAULT NULL,
  `whole_sale_min_qty` int(11) DEFAULT NULL,
  `stocks` int(11) DEFAULT 1,
  `is_pre_sale` int(11) DEFAULT 0,
  `pre_sale_deadline` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `cover_img`, `secondary_cover_img`, `shop_id`, `created_at`, `updated_at`, `product_attributes`, `sale_pct_deduction`, `whole_sale_pct_deduction`, `is_sale`, `net_weight`, `is_whole_sale`, `whole_sale_min_qty`, `stocks`, `is_pre_sale`, `pre_sale_deadline`, `sold_by`) VALUES
(1, 3, '5647', '65', 0.00, 'products//March2022//16478809166238aad405daf-product.jpg', 'products//March2022//16478809166238aad405daf-product.jpg,', 1, '2022-03-21 16:41:56', '2022-03-21 16:41:56', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 0, NULL, NULL),
(2, 1, '24422', '2424', 0.00, 'products//March2022//16478835906238b5463202e-product.jpg', 'products//March2022//16478835906238b5463202e-product.jpg,products//March2022//16478835906238b54632754-product.jpg,', 1, '2022-03-21 17:26:30', '2022-03-21 17:26:30', 'null', 0, NULL, NULL, '', NULL, NULL, 1, NULL, NULL, NULL),
(3, 2, 'wholesale only', '4224', 0.00, 'products//March2022//16478851916238bb8727f08-product.jpg', 'products//March2022//16478851916238bb8727f08-product.jpg,products//March2022//16478851916238bb87287ed-product.jpg,', 1, '2022-03-21 17:53:11', '2022-03-21 17:53:11', 'null', 0, NULL, NULL, '', NULL, 42, 1, 0, NULL, NULL),
(4, 1, 'with wholesale', '25', 0.00, 'products//March2022//16478853506238bc2638d64-product.jpg', 'products//March2022//16478853506238bc2638d64-product.jpg,products//March2022//16478853506238bc2639b9a-product.jpg,', 1, '2022-03-21 17:55:50', '2022-03-21 17:55:50', 'null', 0, NULL, NULL, '', NULL, 13, 1, NULL, NULL, NULL),
(5, 1, '24422', '42', 0.00, 'products//March2022//16478912156238d30f4af91-product.jpg', 'products//March2022//16478912156238d30f4af91-product.jpg,', 1, '2022-03-21 19:33:35', '2022-03-21 19:33:35', 'null', 0, NULL, NULL, '', NULL, NULL, 1, NULL, NULL, NULL),
(6, 1, '53353fdaf', '87878', 0.00, 'products//March2022//16478917406238d51c39fcb-product.jpg', 'products//March2022//16478917406238d51c39fcb-product.jpg,', 1, '2022-03-21 19:42:20', '2022-03-21 19:42:20', 'null', 0, NULL, NULL, '', NULL, 6, 1, NULL, NULL, NULL),
(7, 3, 'prod lkanina', 'lorem ipsum', 0.00, 'products//March2022//16478921206238d698e4a77-product.jpg', 'products//March2022//16478921206238d698e4a77-product.jpg,', 1, '2022-03-21 19:48:40', '2022-03-21 19:48:40', 'null', 0, NULL, NULL, '', NULL, 2, 1, NULL, NULL, NULL),
(8, 2, 'produkltdsa', '4224', 0.00, 'products//March2022//1647903671623903b7a5213-product.jpg', 'products//March2022//1647903671623903b7a5213-product.jpg,', 1, '2022-03-21 23:01:11', '2022-03-21 23:01:11', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 0, NULL, NULL),
(9, 1, '4242', '24242424', 0.00, NULL, NULL, 1, '2022-03-21 23:35:43', '2022-03-21 23:35:43', 'null', 0, NULL, 0, '', NULL, NULL, 1, NULL, NULL, NULL),
(10, 2, '244224', '44', 0.00, 'products//March2022//164790600562390cd58ac47-product.jpg', 'products//March2022//164790600562390cd58ac47-product.jpg,products//March2022//164790600562390cd58b666-product.jpg,', 1, '2022-03-21 23:40:05', '2022-03-21 23:40:05', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 0, NULL, NULL),
(11, 1, '245255', '522552525', 0.00, NULL, NULL, 1, '2022-03-22 02:34:51', '2022-03-22 02:34:51', 'null', 0, NULL, 0, '', NULL, NULL, 1, NULL, NULL, NULL),
(12, 1, '245255', '522552525', 0.00, NULL, NULL, 1, '2022-03-22 02:36:34', '2022-03-22 02:36:34', 'null', 0, NULL, 0, '', NULL, NULL, 1, NULL, NULL, NULL),
(13, 1, 'yung may variation knina', '422424', 0.00, NULL, NULL, 1, '2022-03-22 02:53:43', '2022-03-22 02:53:43', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 1, NULL, NULL),
(14, 1, 'yung may variation knina', '422424', 0.00, NULL, NULL, 1, '2022-03-22 02:54:27', '2022-03-22 02:54:27', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 1, NULL, NULL),
(15, 1, 'yung may variation knina', '422424', 0.00, NULL, NULL, 1, '2022-03-22 02:54:35', '2022-03-22 02:54:35', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 1, NULL, NULL),
(16, 1, 'yung may variation knina', '422424', 0.00, NULL, NULL, 1, '2022-03-22 02:55:03', '2022-03-22 02:55:03', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 1, NULL, NULL),
(17, 1, 'yung may variation knina', '422424', 0.00, NULL, NULL, 1, '2022-03-22 02:55:18', '2022-03-22 02:55:18', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 1, NULL, NULL),
(18, 1, 'yung may variation knina', '422424', 0.00, NULL, NULL, 1, '2022-03-22 02:59:24', '2022-03-22 02:59:24', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 1, NULL, NULL),
(19, 1, '5335', '53', 0.00, 'products//March2022//164791834262393d069d182-product.jpg', 'products//March2022//164791834262393d069d182-product.jpg,', 1, '2022-03-22 03:05:42', '2022-03-22 03:05:42', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 1, NULL, NULL),
(20, 1, '53535353553', '5353', 0.00, 'products//March2022//164791845162393d736f7d2-product.jpg', 'products//March2022//164791845162393d736f7d2-product.jpg,', 1, '2022-03-22 03:07:31', '2022-03-22 03:07:31', 'null', 0, NULL, NULL, '', NULL, NULL, 1, NULL, NULL, NULL),
(21, 1, '424', '4242', 0.00, 'products//March2022//164792355662395164c570d-product.jpg', 'products//March2022//164792355662395164c570d-product.jpg,products//March2022//164792355662395164c63b1-product.jpg,', 1, '2022-03-22 04:32:36', '2022-03-22 04:32:36', 'null', 0, NULL, NULL, '', NULL, NULL, 1, 0, NULL, NULL),
(22, 1, '424', '4242', 0.00, 'products//March2022//1647923591623951870aac0-product.jpg', 'products//March2022//1647923591623951870aac0-product.jpg,products//March2022//1647923591623951870b1eb-product.jpg,', 1, '2022-03-22 04:33:11', '2022-03-22 04:33:11', 'null', 0, NULL, NULL, '', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `product_id` tinytext NOT NULL,
  `color` tinytext NOT NULL,
  `size` tinytext NOT NULL,
  `size_add_price` tinytext NOT NULL,
  `size_available_qty` tinytext NOT NULL,
  `net_weight` tinytext NOT NULL,
  `sold_per` tinytext NOT NULL,
  `sold_per_qty` tinytext NOT NULL,
  `sold_per_price` tinytext NOT NULL,
  `types` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2022-03-21 16:41:56', '2022-03-21 16:41:56'),
(2, 2, 1, '2022-03-21 17:26:30', '2022-03-21 17:26:30'),
(3, 3, 2, '2022-03-21 17:53:11', '2022-03-21 17:53:11'),
(4, 4, 1, '2022-03-21 17:55:50', '2022-03-21 17:55:50'),
(5, 5, 1, '2022-03-21 19:33:35', '2022-03-21 19:33:35'),
(6, 6, 1, '2022-03-21 19:42:20', '2022-03-21 19:42:20'),
(7, 7, 3, '2022-03-21 19:48:40', '2022-03-21 19:48:40'),
(8, 8, 2, '2022-03-21 23:01:11', '2022-03-21 23:01:11'),
(9, 10, 2, '2022-03-21 23:40:05', '2022-03-21 23:40:05'),
(10, 12, 1, '2022-03-22 02:36:34', '2022-03-22 02:36:34'),
(11, 12, 1, '2022-03-22 02:36:34', '2022-03-22 02:36:34'),
(12, 18, 5, '2022-03-22 02:59:24', '2022-03-22 02:59:24'),
(13, 18, 5, '2022-03-22 02:59:24', '2022-03-22 02:59:24'),
(14, 19, 2, '2022-03-22 03:05:42', '2022-03-22 03:05:42'),
(15, 19, 2, '2022-03-22 03:05:42', '2022-03-22 03:05:42'),
(16, 20, 1, '2022-03-22 03:07:31', '2022-03-22 03:07:31'),
(17, 20, 1, '2022-03-22 03:07:31', '2022-03-22 03:07:31'),
(18, 22, 1, '2022-03-22 04:33:11', '2022-03-22 04:33:11'),
(19, 22, 1, '2022-03-22 04:33:11', '2022-03-22 04:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_monitoring_logs`
--

CREATE TABLE `product_monitoring_logs` (
  `id` int(11) NOT NULL,
  `sub_order_item_id` tinytext NOT NULL,
  `status` tinytext NOT NULL,
  `user_id` int(11) NOT NULL,
  `images` tinytext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_pricing_additionals`
--

CREATE TABLE `product_pricing_additionals` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `size` int(11) NOT NULL,
  `sold_per` int(11) NOT NULL,
  `types` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_refund_request`
--

CREATE TABLE `product_refund_request` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `refund_request_msg` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `slug` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variation_name` tinytext NOT NULL,
  `variation_price_per` int(11) DEFAULT NULL,
  `variation_min_qty_wholesale` int(11) DEFAULT 0,
  `variation_quantity` int(11) DEFAULT NULL,
  `variation_net_weight` varchar(10) DEFAULT NULL,
  `variation_net_weight_unit` varchar(50) DEFAULT NULL,
  `variation_sold_per` varchar(50) DEFAULT 'kilo',
  `variation_wholesale_price_per` varchar(50) DEFAULT '1',
  `is_variation_wholesale` varchar(10) NOT NULL,
  `is_variation_wholesale_only` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `variation_name`, `variation_price_per`, `variation_min_qty_wholesale`, `variation_quantity`, `variation_net_weight`, `variation_net_weight_unit`, `variation_sold_per`, `variation_wholesale_price_per`, `is_variation_wholesale`, `is_variation_wholesale_only`) VALUES
(1, 1, 'Regular', 5456, 0, 56, '65', 'kilogram', 'kilo', '1', 'no', ''),
(2, 2, 'Regular', 422424, 0, 24244, '244', 'gram', 'kilo', '1', 'no', ''),
(3, 3, 'Regular', 2, 21, 12, '42', 'gram', 'kilo', '42', 'yes', 'yes'),
(4, 4, 'Regular', 424, 13, 4, '24', 'kilogram', 'kilo', '14', 'yes', 'no'),
(5, 5, 'Regular', 24, 0, 24, '2', 'kilogram', 'kilo', '1', 'no', ''),
(6, 6, 'Regular', 767, 6, 878, '24', 'kilogram', 'kilo', '767', 'yes', 'yes'),
(7, 7, 'Regular', 65, 2, 53, '1', 'kilogram', 'kilo', '65', 'yes', 'yes'),
(8, 8, 'Regular', 424, 0, 42, '24', 'gram', 'kilo', '1', 'no', ''),
(9, 10, 'Regular', 2147483647, 0, 64, '46', 'gram', 'kilo', '1', 'no', ''),
(10, 12, '2442', 4242, NULL, 24, '4224', 'kilogram', 'kilo', '1', 'no', ''),
(11, 12, '42', 42, NULL, 42, '42', 'kilogram', 'kilo', '1', 'no', ''),
(12, 17, '4224', 24, 42, 42, '42', 'kilogram', 'kilo', '24', 'yes', 'yes'),
(13, 18, '4224', 24, 42, 42, '42', 'kilogram', 'kilo', '24', 'yes', 'yes'),
(14, 18, '424224', 4224, 24, 4224, '42', 'kilogram', 'kilo', '42', 'yes', 'no'),
(15, 19, '53', 5335, 53, 35, '53', 'kilogram', 'kilo', '53', 'yes', 'no'),
(16, 20, '5353355', 535, NULL, 5353, '535335', 'gram', 'kilo', '1', 'no', ''),
(17, 20, '53355353', 533535, 3535, 3535, '5335', 'gram', 'kilo', '3535', 'yes', 'no'),
(18, 22, '424224', 424224, NULL, 4224, '42', 'gram', 'kilo', '1', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_vars`
--

CREATE TABLE `product_vars` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `retail_id` int(11) NOT NULL,
  `wholesale_id` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `is_pre_sale` varchar(11) NOT NULL,
  `pre_sale_deadline` varchar(11) NOT NULL,
  `variation_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prod_refund_statuses`
--

CREATE TABLE `prod_refund_statuses` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `slug` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prod_refund_statuses`
--

INSERT INTO `prod_refund_statuses` (`id`, `name`, `slug`) VALUES
(1, 'wrong_products', 'Wrong product'),
(2, 'product_wrong_qty', 'Wrong quantity of product'),
(3, 'product_defect', 'Product defect'),
(4, 'rotten_product', 'Product rotten(nabubulok na product)');

-- --------------------------------------------------------

--
-- Table structure for table `quantity_is_sold_per`
--

CREATE TABLE `quantity_is_sold_per` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `slug` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `rateable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rateable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_reason_product`
--

CREATE TABLE `refund_reason_product` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `slug` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `refund_request_products`
--

CREATE TABLE `refund_request_products` (
  `id` int(11) NOT NULL,
  `refund_ref_id` tinytext NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `image_proofs` tinytext NOT NULL,
  `order_item_id` tinytext NOT NULL,
  `product_id` int(11) NOT NULL,
  `refund_reason_prod_txt` tinytext NOT NULL,
  `prod_refund_status_id` int(11) NOT NULL DEFAULT 3,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refund_request_products`
--

INSERT INTO `refund_request_products` (`id`, `refund_ref_id`, `user_id`, `order_id`, `image_proofs`, `order_item_id`, `product_id`, `refund_reason_prod_txt`, `prod_refund_status_id`, `created_at`, `updated_at`) VALUES
(1, 'REFUND-6216c7213295d', 1, 7, 'product_refunds//February2022//16456599376216c72131cc4-product.jpg,product_refunds//February2022//16456599376216c721322b0-product.jfif,', '2', 3, '53535fdsf', 1, '2022-02-23 23:45:37', '2022-03-01 04:08:30'),
(2, 'REFUND-621d9e03deeb7', 1, 11, 'product_refunds//March2022//1646108163621d9e03ddc1a-product.jpg,product_refunds//March2022//1646108163621d9e03de336-product.jpg,product_refunds//March2022//1646108163621d9e03de81b-product.jpg,', '4', 2, 'dafdgfdg detailye', 1, '2022-03-01 04:16:03', '2022-03-01 04:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2020-02-10 16:10:11', '2020-02-10 16:10:11'),
(2, 'user', 'Normal User', '2020-02-10 16:10:11', '2020-02-10 16:10:11'),
(3, 'seller', 'Seller', '2020-02-19 09:25:16', '2020-02-19 09:25:16'),
(4, 'notseller', 'Seller Pending', '2021-08-19 05:50:40', '2021-08-19 05:50:40'),
(5, 'rider', 'delivery man', '2021-10-17 14:06:48', '2021-10-17 14:06:48'),
(6, 'CoinsTopUpEmployee', 'Coins Top Up Employee', '2022-01-17 07:10:12', '2022-01-17 07:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `seller_payment_reg_rem`
--

CREATE TABLE `seller_payment_reg_rem` (
  `id` int(10) UNSIGNED NOT NULL,
  `remarks` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seller_payment_reg_rem`
--

INSERT INTO `seller_payment_reg_rem` (`id`, `remarks`) VALUES
(1, 'paid'),
(3, 'invalid'),
(4, 'for verification');

-- --------------------------------------------------------

--
-- Table structure for table `seller_registration_fee`
--

CREATE TABLE `seller_registration_fee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `payment_proof` tinytext NOT NULL,
  `status` tinytext NOT NULL,
  `invalid_reason_id_status` bigint(20) NOT NULL DEFAULT 4,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_seen` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings\\August2021\\hSR2KDNYe3N6LUFd4nhk.png', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', 'settings\\August2021\\sQQe0rggLqer81SZpKnq.jpeg', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Agrisell admin and seller panel', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Powered by Laravel Voyager', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_fee_table_matrix`
--

CREATE TABLE `shipping_fee_table_matrix` (
  `id` int(11) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `shop_address` varchar(50) NOT NULL,
  `shipping_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_fee_table_matrix`
--

INSERT INTO `shipping_fee_table_matrix` (`id`, `customer_address`, `shop_address`, `shipping_fee`) VALUES
(1, 'Agno', 'Agno', 60),
(2, 'Agno', 'Aguilar', 240),
(3, 'Agno', 'Alcala', 300),
(4, 'Agno', 'Anda', 140),
(5, 'Agno', 'Asingan', 300),
(6, 'Agno', 'Balungao', 340),
(7, 'Agno', 'Bani', 100),
(8, 'Agno', 'Basista', 260),
(9, 'Agno', 'Bautista', 300),
(10, 'Agno', 'Bayambang', 280),
(11, 'Agno', 'Binalonan', 300),
(12, 'Agno', 'Binmaley', 220),
(13, 'Agno', 'Bolinao', 120),
(14, 'Agno', 'Bugallon', 200),
(15, 'Agno', 'Burgos', 90),
(16, 'Agno', 'Calasiao', 280),
(17, 'Agno', 'Dasol', 120),
(18, 'Agno', 'Infanta', 160),
(19, 'Agno', 'Labrador', 120),
(20, 'Agno', 'Laoac', 280),
(21, 'Agno', 'Lingayen', 200),
(22, 'Agno', 'Mabini', 120),
(23, 'Agno', 'Malasiqui', 260),
(24, 'Agno', 'Manaoag', 260),
(25, 'Agno', 'Mangaldan', 240),
(26, 'Agno', 'Mangatarem', 220),
(27, 'Agno', 'Mapandan', 260),
(28, 'Agno', 'Natividad', 340),
(29, 'Agno', 'Pozorrubio', 260),
(30, 'Agno', 'Rosales', 300),
(31, 'Agno', 'San Fabian', 260),
(32, 'Agno', 'San Jacinto', 260),
(33, 'Agno', 'San Manuel', 320),
(34, 'Agno', 'San Nicolas', 340),
(35, 'Agno', 'San Quintin', 340),
(36, 'Agno', 'Santa Barbara', 260),
(37, 'Agno', 'Santa Maria', 300),
(38, 'Agno', 'Santo Tomas', 320),
(39, 'Agno', 'Sison', 300),
(40, 'Agno', 'Sual', 140),
(41, 'Agno', 'Tayug', 320),
(42, 'Agno', 'Umingan', 340),
(43, 'Agno', 'Urbiztondo', 260),
(44, 'Agno', 'Villasis', 280),
(45, 'Agno', 'Dagupan', 220),
(46, 'Agno', 'Alaminos', 120),
(47, 'Agno', 'San Carlos', 240),
(48, 'Agno', 'Urdaneta', 270),
(49, 'Aguilar', 'Agno', 240),
(50, 'Aguilar', 'Aguilar', 60),
(51, 'Aguilar', 'Alcala', 160),
(52, 'Aguilar', 'Anda', 260),
(53, 'Aguilar', 'Asingan', 240),
(54, 'Aguilar', 'Balungao', 240),
(55, 'Aguilar', 'Bani', 220),
(56, 'Aguilar', 'Basista', 140),
(57, 'Aguilar', 'Bautista', 180),
(58, 'Aguilar', 'Bayambang', 140),
(59, 'Aguilar', 'Binalonan', 220),
(60, 'Aguilar', 'Binmaley', 120),
(61, 'Aguilar', 'Bolinao', 240),
(62, 'Aguilar', 'Bugallon', 100),
(63, 'Aguilar', 'Burgos', 220),
(64, 'Aguilar', 'Calasiao', 160),
(65, 'Aguilar', 'Dasol', 240),
(66, 'Aguilar', 'Infanta', 160),
(67, 'Aguilar', 'Labrador', 60),
(68, 'Aguilar', 'Laoac', 200),
(69, 'Aguilar', 'Lingayen', 120),
(70, 'Aguilar', 'Mabini', 200),
(71, 'Aguilar', 'Malasiqui', 180),
(72, 'Aguilar', 'Manaoag', 180),
(73, 'Aguilar', 'Mangaldan', 160),
(74, 'Aguilar', 'Mangatarem', 120),
(75, 'Aguilar', 'Mapandan', 180),
(76, 'Aguilar', 'Natividad', 300),
(77, 'Aguilar', 'Pozorrubio', 200),
(78, 'Aguilar', 'Rosales', 200),
(79, 'Aguilar', 'San Fabian', 180),
(80, 'Aguilar', 'San Jacinto', 180),
(81, 'Aguilar', 'San Manuel', 240),
(82, 'Aguilar', 'San Nicolas', 260),
(83, 'Aguilar', 'San Quintin', 300),
(84, 'Aguilar', 'Santa Barbara', 180),
(85, 'Aguilar', 'Santa Maria', 220),
(86, 'Aguilar', 'Santo Tomas', 180),
(87, 'Aguilar', 'Sison', 200),
(88, 'Aguilar', 'Sual', 160),
(89, 'Aguilar', 'Tayug', 260),
(90, 'Aguilar', 'Umingan', 260),
(91, 'Aguilar', 'Urbiztondo', 120),
(92, 'Aguilar', 'Villasis', 200),
(93, 'Aguilar', 'Dagupan', 140),
(94, 'Aguilar', 'Alaminos', 180),
(95, 'Aguilar', 'San Carlos', 140),
(96, 'Aguilar', 'Urdaneta', 200),
(97, 'Alcala', 'Agno', 300),
(98, 'Alcala', 'Aguilar', 180),
(99, 'Alcala', 'Alcala', 60),
(100, 'Alcala', 'Anda', 200),
(101, 'Alcala', 'Asingan', 120),
(102, 'Alcala', 'Balungao', 100),
(103, 'Alcala', 'Bani', 300),
(104, 'Alcala', 'Basista', 100),
(105, 'Alcala', 'Bautista', 80),
(106, 'Alcala', 'Bayambang', 120),
(107, 'Alcala', 'Binalonan', 140),
(108, 'Alcala', 'Binmaley', 140),
(109, 'Alcala', 'Bolinao', 320),
(110, 'Alcala', 'Bugallon', 160),
(111, 'Alcala', 'Burgos', 280),
(112, 'Alcala', 'Calasiao', 140),
(113, 'Alcala', 'Dasol', 320),
(114, 'Alcala', 'Infanta', 360),
(115, 'Alcala', 'Labrador', 180),
(116, 'Alcala', 'Laoac', 140),
(117, 'Alcala', 'Lingayen', 160),
(118, 'Alcala', 'Mabini', 280),
(119, 'Alcala', 'Malasiqui', 120),
(120, 'Alcala', 'Manaoag', 130),
(121, 'Alcala', 'Mangaldan', 160),
(122, 'Alcala', 'Mangatarem', 160),
(123, 'Alcala', 'Mapandan', 140),
(124, 'Alcala', 'Natividad', 140),
(125, 'Alcala', 'Pozorrubio', 160),
(126, 'Alcala', 'Rosales', 90),
(127, 'Alcala', 'San Fabian', 180),
(128, 'Alcala', 'San Jacinto', 140),
(129, 'Alcala', 'San Manuel', 140),
(130, 'Alcala', 'San Nicolas', 160),
(131, 'Alcala', 'San Quintin', 160),
(132, 'Alcala', 'Santa Barbara', 140),
(133, 'Alcala', 'Santa Maria', 120),
(134, 'Alcala', 'Santo Tomas', 100),
(135, 'Alcala', 'Sison', 160),
(136, 'Alcala', 'Sual', 220),
(137, 'Alcala', 'Tayug', 120),
(138, 'Alcala', 'Umingan', 140),
(139, 'Alcala', 'Urbiztondo', 120),
(140, 'Alcala', 'Villasis', 80),
(141, 'Alcala', 'Dagupan', 160),
(142, 'Alcala', 'Alaminos', 240),
(143, 'Alcala', 'San Carlos', 140),
(144, 'Alcala', 'Urdaneta', 100),
(145, 'Anda', 'Agno', 140),
(146, 'Anda', 'Aguilar', 260),
(147, 'Anda', 'Alcala', 320),
(148, 'Anda', 'Anda', 60),
(149, 'Anda', 'Asingan', 320),
(150, 'Anda', 'Balungao', 340),
(151, 'Anda', 'Bani', 100),
(152, 'Anda', 'Basista', 260),
(153, 'Anda', 'Bautista', 320),
(154, 'Anda', 'Bayambang', 280),
(155, 'Anda', 'Binalonan', 340),
(156, 'Anda', 'Binmaley', 240),
(157, 'Anda', 'Bolinao', 100),
(158, 'Anda', 'Bugallon', 220),
(159, 'Anda', 'Burgos', 160),
(160, 'Anda', 'Calasiao', 260),
(161, 'Anda', 'Dasol', 180),
(162, 'Anda', 'Infanta', 240),
(163, 'Anda', 'Labrador', 200),
(164, 'Anda', 'Laoac', 300),
(165, 'Anda', 'Lingayen', 220),
(166, 'Anda', 'Mabini', 180),
(167, 'Anda', 'Malasiqui', 280),
(168, 'Anda', 'Manaoag', 300),
(169, 'Anda', 'Mangaldan', 260),
(170, 'Anda', 'Mangatarem', 280),
(171, 'Anda', 'Mapandan', 280),
(172, 'Anda', 'Natividad', 360),
(173, 'Anda', 'Pozorrubio', 300),
(174, 'Anda', 'Rosales', 320),
(175, 'Anda', 'San Fabian', 300),
(176, 'Anda', 'San Jacinto', 280),
(177, 'Anda', 'San Manuel', 340),
(178, 'Anda', 'San Nicolas', 360),
(179, 'Anda', 'San Quintin', 360),
(180, 'Anda', 'Santa Barbara', 280),
(181, 'Anda', 'Santa Maria', 340),
(182, 'Anda', 'Santo Tomas', 340),
(183, 'Anda', 'Sison', 300),
(184, 'Anda', 'Sual', 180),
(185, 'Anda', 'Tayug', 340),
(186, 'Anda', 'Umingan', 380),
(187, 'Anda', 'Urbiztondo', 280),
(188, 'Anda', 'Villasis', 340),
(189, 'Anda', 'Dagupan', 240),
(190, 'Anda', 'Alaminos', 140),
(191, 'Anda', 'San Carlos', 260),
(192, 'Anda', 'Urdaneta', 300),
(193, 'Asingan', 'Agno', 300),
(194, 'Asingan', 'Aguilar', 220),
(195, 'Asingan', 'Alcala', 120),
(196, 'Asingan', 'Anda', 320),
(197, 'Asingan', 'Asingan', 60),
(198, 'Asingan', 'Balungao', 100),
(199, 'Asingan', 'Bani', 280),
(200, 'Asingan', 'Basista', 160),
(201, 'Asingan', 'Bautista', 140),
(202, 'Asingan', 'Bayambang', 160),
(203, 'Asingan', 'Binalonan', 100),
(204, 'Asingan', 'Binmaley', 160),
(205, 'Asingan', 'Bolinao', 320),
(206, 'Asingan', 'Bugallon', 200),
(207, 'Asingan', 'Burgos', 280),
(208, 'Asingan', 'Calasiao', 140),
(209, 'Asingan', 'Dasol', 320),
(210, 'Asingan', 'Infanta', 360),
(211, 'Asingan', 'Labrador', 200),
(212, 'Asingan', 'Laoac', 100),
(213, 'Asingan', 'Lingayen', 160),
(214, 'Asingan', 'Mabini', 280),
(215, 'Asingan', 'Malasiqui', 120),
(216, 'Asingan', 'Manaoag', 110),
(217, 'Asingan', 'Mangaldan', 140),
(218, 'Asingan', 'Mangatarem', 200),
(219, 'Asingan', 'Mapandan', 110),
(220, 'Asingan', 'Natividad', 110),
(221, 'Asingan', 'Pozorrubio', 100),
(222, 'Asingan', 'Rosales', 100),
(223, 'Asingan', 'San Fabian', 140),
(224, 'Asingan', 'San Jacinto', 120),
(225, 'Asingan', 'San Manuel', 90),
(226, 'Asingan', 'San Nicolas', 120),
(227, 'Asingan', 'San Quintin', 120),
(228, 'Asingan', 'Santa Barbara', 120),
(229, 'Asingan', 'Santa Maria', 80),
(230, 'Asingan', 'Santo Tomas', 140),
(231, 'Asingan', 'Sison', 120),
(232, 'Asingan', 'Sual', 220),
(233, 'Asingan', 'Tayug', 120),
(234, 'Asingan', 'Umingan', 140),
(235, 'Asingan', 'Urbiztondo', 160),
(236, 'Asingan', 'Villasis', 100),
(237, 'Asingan', 'Dagupan', 140),
(238, 'Asingan', 'Alaminos', 240),
(239, 'Asingan', 'San Carlos', 140),
(240, 'Asingan', 'Urdaneta', 80),
(241, 'Balungao', 'Agno', 300),
(242, 'Balungao', 'Aguilar', 240),
(243, 'Balungao', 'Alcala', 100),
(244, 'Balungao', 'Anda', 340),
(245, 'Balungao', 'Asingan', 120),
(246, 'Balungao', 'Balungao', 60),
(247, 'Balungao', 'Bani', 300),
(248, 'Balungao', 'Basista', 140),
(249, 'Balungao', 'Bautista', 120),
(250, 'Balungao', 'Bayambang', 140),
(251, 'Balungao', 'Binalonan', 140),
(252, 'Balungao', 'Binmaley', 160),
(253, 'Balungao', 'Bolinao', 340),
(254, 'Balungao', 'Bugallon', 240),
(255, 'Balungao', 'Burgos', 300),
(256, 'Balungao', 'Calasiao', 180),
(257, 'Balungao', 'Dasol', 340),
(258, 'Balungao', 'Infanta', 380),
(259, 'Balungao', 'Labrador', 200),
(260, 'Balungao', 'Laoac', 140),
(261, 'Balungao', 'Lingayen', 180),
(262, 'Balungao', 'Mabini', 300),
(263, 'Balungao', 'Malasiqui', 120),
(264, 'Balungao', 'Manaoag', 160),
(265, 'Balungao', 'Mangaldan', 180),
(266, 'Balungao', 'Mangatarem', 200),
(267, 'Balungao', 'Mapandan', 160),
(268, 'Balungao', 'Natividad', 140),
(269, 'Balungao', 'Pozorrubio', 160),
(270, 'Balungao', 'Rosales', 80),
(271, 'Balungao', 'San Fabian', 180),
(272, 'Balungao', 'San Jacinto', 160),
(273, 'Balungao', 'San Manuel', 140),
(274, 'Balungao', 'San Nicolas', 120),
(275, 'Balungao', 'San Quintin', 110),
(276, 'Balungao', 'Santa Barbara', 160),
(277, 'Balungao', 'Santa Maria', 110),
(278, 'Balungao', 'Santo Tomas', 140),
(279, 'Balungao', 'Sison', 160),
(280, 'Balungao', 'Sual', 240),
(281, 'Balungao', 'Tayug', 300),
(282, 'Balungao', 'Umingan', 110),
(283, 'Balungao', 'Urbiztondo', 160),
(284, 'Balungao', 'Villasis', 100),
(285, 'Balungao', 'Dagupan', 190),
(286, 'Balungao', 'Alaminos', 260),
(287, 'Balungao', 'San Carlos', 160),
(288, 'Balungao', 'Urdaneta', 120),
(289, 'Bani', 'Agno', 100),
(290, 'Bani', 'Aguilar', 220),
(291, 'Bani', 'Alcala', 280),
(292, 'Bani', 'Anda', 100),
(293, 'Bani', 'Asingan', 280),
(294, 'Bani', 'Balungao', 300),
(295, 'Bani', 'Bani', 60),
(296, 'Bani', 'Basista', 240),
(297, 'Bani', 'Bautista', 280),
(298, 'Bani', 'Bayambang', 260),
(299, 'Bani', 'Binalonan', 300),
(300, 'Bani', 'Binmaley', 200),
(301, 'Bani', 'Bolinao', 100),
(302, 'Bani', 'Bugallon', 180),
(303, 'Bani', 'Burgos', 120),
(304, 'Bani', 'Calasiao', 220),
(305, 'Bani', 'Dasol', 140),
(306, 'Bani', 'Infanta', 180),
(307, 'Bani', 'Labrador', 160),
(308, 'Bani', 'Laoac', 260),
(309, 'Bani', 'Lingayen', 180),
(310, 'Bani', 'Mabini', 140),
(311, 'Bani', 'Malasiqui', 240),
(312, 'Bani', 'Manaoag', 240),
(313, 'Bani', 'Mangaldan', 220),
(314, 'Bani', 'Mangatarem', 230),
(315, 'Bani', 'Mapandan', 240),
(316, 'Bani', 'Natividad', 340),
(317, 'Bani', 'Pozorrubio', 260),
(318, 'Bani', 'Rosales', 280),
(319, 'Bani', 'San Fabian', 250),
(320, 'Bani', 'San Jacinto', 240),
(321, 'Bani', 'San Manuel', 300),
(322, 'Bani', 'San Nicolas', 340),
(323, 'Bani', 'San Quintin', 340),
(324, 'Bani', 'Santa Barbara', 240),
(325, 'Bani', 'Santa Maria', 300),
(326, 'Bani', 'Santo Tomas', 300),
(327, 'Bani', 'Sison', 280),
(328, 'Bani', 'Sual', 140),
(329, 'Bani', 'Tayug', 300),
(330, 'Bani', 'Umingan', 340),
(331, 'Bani', 'Urbiztondo', 240),
(332, 'Bani', 'Villasis', 280),
(333, 'Bani', 'Dagupan', 210),
(334, 'Bani', 'Alaminos', 100),
(335, 'Bani', 'San Carlos', 220),
(336, 'Bani', 'Urdaneta', 260),
(337, 'Basista', 'Agno', 240),
(338, 'Basista', 'Aguilar', 140),
(339, 'Basista', 'Alcala', 100),
(340, 'Basista', 'Anda', 280),
(341, 'Basista', 'Asingan', 160),
(342, 'Basista', 'Balungao', 140),
(343, 'Basista', 'Bani', 240),
(344, 'Basista', 'Basista', 60),
(345, 'Basista', 'Bautista', 110),
(346, 'Basista', 'Bayambang', 110),
(347, 'Basista', 'Binalonan', 160),
(348, 'Basista', 'Binmaley', 100),
(349, 'Basista', 'Bolinao', 260),
(350, 'Basista', 'Bugallon', 140),
(351, 'Basista', 'Burgos', 240),
(352, 'Basista', 'Calasiao', 100),
(353, 'Basista', 'Dasol', 260),
(354, 'Basista', 'Infanta', 300),
(355, 'Basista', 'Labrador', 140),
(356, 'Basista', 'Laoac', 160),
(357, 'Basista', 'Lingayen', 110),
(358, 'Basista', 'Mabini', 220),
(359, 'Basista', 'Malasiqui', 110),
(360, 'Basista', 'Manaoag', 120),
(361, 'Basista', 'Mangaldan', 120),
(362, 'Basista', 'Mangatarem', 110),
(363, 'Basista', 'Mapandan', 110),
(364, 'Basista', 'Natividad', 190),
(365, 'Basista', 'Pozorrubio', 160),
(366, 'Basista', 'Rosales', 130),
(367, 'Basista', 'San Fabian', 150),
(368, 'Basista', 'San Jacinto', 130),
(369, 'Basista', 'San Manuel', 150),
(370, 'Basista', 'San Nicolas', 190),
(371, 'Basista', 'San Quintin', 190),
(372, 'Basista', 'Santa Barbara', 100),
(373, 'Basista', 'Santa Maria', 160),
(374, 'Basista', 'Santo Tomas', 140),
(375, 'Basista', 'Sison', 160),
(376, 'Basista', 'Sual', 170),
(377, 'Basista', 'Tayug', 160),
(378, 'Basista', 'Umingan', 180),
(379, 'Basista', 'Urbiztondo', 90),
(380, 'Basista', 'Villasis', 120),
(381, 'Basista', 'Dagupan', 110),
(382, 'Basista', 'Alaminos', 180),
(383, 'Basista', 'San Carlos', 110),
(384, 'Basista', 'Urdaneta', 120),
(385, 'Bautista', 'Agno', 300),
(386, 'Bautista', 'Aguilar', 180),
(387, 'Bautista', 'Alcala', 80),
(388, 'Bautista', 'Anda', 340),
(389, 'Bautista', 'Asingan', 120),
(390, 'Bautista', 'Balungao', 120),
(391, 'Bautista', 'Bani', 300),
(392, 'Bautista', 'Basista', 110),
(393, 'Bautista', 'Bautista', 60),
(394, 'Bautista', 'Bayambang', 100),
(395, 'Bautista', 'Binalonan', 160),
(396, 'Bautista', 'Binmaley', 180),
(397, 'Bautista', 'Bolinao', 320),
(398, 'Bautista', 'Bugallon', 180),
(399, 'Bautista', 'Burgos', 300),
(400, 'Bautista', 'Calasiao', 140),
(401, 'Bautista', 'Dasol', 320),
(402, 'Bautista', 'Infanta', 360),
(403, 'Bautista', 'Labrador', 200),
(404, 'Bautista', 'Laoac', 160),
(405, 'Bautista', 'Lingayen', 160),
(406, 'Bautista', 'Mabini', 280),
(407, 'Bautista', 'Malasiqui', 120),
(408, 'Bautista', 'Manaoag', 160),
(409, 'Bautista', 'Mangaldan', 160),
(410, 'Bautista', 'Mangatarem', 160),
(411, 'Bautista', 'Mapandan', 160),
(412, 'Bautista', 'Natividad', 160),
(413, 'Bautista', 'Pozorrubio', 180),
(414, 'Bautista', 'Rosales', 100),
(415, 'Bautista', 'San Fabian', 180),
(416, 'Bautista', 'San Jacinto', 160),
(417, 'Bautista', 'San Manuel', 160),
(418, 'Bautista', 'San Nicolas', 170),
(419, 'Bautista', 'San Quintin', 170),
(420, 'Bautista', 'Santa Barbara', 140),
(421, 'Bautista', 'Santa Maria', 140),
(422, 'Bautista', 'Santo Tomas', 120),
(423, 'Bautista', 'Sison', 200),
(424, 'Bautista', 'Sual', 200),
(425, 'Bautista', 'Tayug', 140),
(426, 'Bautista', 'Umingan', 160),
(427, 'Bautista', 'Urbiztondo', 120),
(428, 'Bautista', 'Villasis', 100),
(429, 'Bautista', 'Dagupan', 160),
(430, 'Bautista', 'Alaminos', 250),
(431, 'Bautista', 'San Carlos', 130),
(432, 'Bautista', 'Urdaneta', 120),
(433, 'Bayambang', 'Agno', 260),
(434, 'Bayambang', 'Aguilar', 140),
(435, 'Bayambang', 'Alcala', 120),
(436, 'Bayambang', 'Anda', 300),
(437, 'Bayambang', 'Asingan', 150),
(438, 'Bayambang', 'Balungao', 140),
(439, 'Bayambang', 'Bani', 260),
(440, 'Bayambang', 'Basista', 90),
(441, 'Bayambang', 'Bautista', 100),
(442, 'Bayambang', 'Bayambang', 60),
(443, 'Bayambang', 'Binalonan', 180),
(444, 'Bayambang', 'Binmaley', 140),
(445, 'Bayambang', 'Bolinao', 280),
(446, 'Bayambang', 'Bugallon', 140),
(447, 'Bayambang', 'Burgos', 260),
(448, 'Bayambang', 'Calasiao', 120),
(449, 'Bayambang', 'Dasol', 280),
(450, 'Bayambang', 'Infanta', 320),
(451, 'Bayambang', 'Labrador', 160),
(452, 'Bayambang', 'Laoac', 150),
(453, 'Bayambang', 'Lingayen', 140),
(454, 'Bayambang', 'Mabini', 260),
(455, 'Bayambang', 'Malasiqui', 110),
(456, 'Bayambang', 'Manaoag', 150),
(457, 'Bayambang', 'Mangaldan', 130),
(458, 'Bayambang', 'Mangatarem', 110),
(459, 'Bayambang', 'Mapandan', 130),
(460, 'Bayambang', 'Natividad', 180),
(461, 'Bayambang', 'Pozorrubio', 190),
(462, 'Bayambang', 'Rosales', 120),
(463, 'Bayambang', 'San Fabian', 150),
(464, 'Bayambang', 'San Jacinto', 150),
(465, 'Bayambang', 'San Manuel', 180),
(466, 'Bayambang', 'San Nicolas', 180),
(467, 'Bayambang', 'San Quintin', 220),
(468, 'Bayambang', 'Santa Barbara', 120),
(469, 'Bayambang', 'Santa Maria', 140),
(470, 'Bayambang', 'Santo Tomas', 130),
(471, 'Bayambang', 'Sison', 190),
(472, 'Bayambang', 'Sual', 180),
(473, 'Bayambang', 'Tayug', 160),
(474, 'Bayambang', 'Umingan', 180),
(475, 'Bayambang', 'Urbiztondo', 110),
(476, 'Bayambang', 'Villasis', 120),
(477, 'Bayambang', 'Dagupan', 140),
(478, 'Bayambang', 'Alaminos', 220),
(479, 'Bayambang', 'San Carlos', 110),
(480, 'Bayambang', 'Urdaneta', 130),
(481, 'Binalonan', 'Agno', 300),
(482, 'Binalonan', 'Aguilar', 240),
(483, 'Binalonan', 'Alcala', 140),
(484, 'Binalonan', 'Anda', 340),
(485, 'Binalonan', 'Asingan', 100),
(486, 'Binalonan', 'Balungao', 140),
(487, 'Binalonan', 'Bani', 300),
(488, 'Binalonan', 'Basista', 160),
(489, 'Binalonan', 'Bautista', 160),
(490, 'Binalonan', 'Bayambang', 180),
(491, 'Binalonan', 'Binalonan', 60),
(492, 'Binalonan', 'Binmaley', 160),
(493, 'Binalonan', 'Bolinao', 300),
(494, 'Binalonan', 'Bugallon', 200),
(495, 'Binalonan', 'Burgos', 300),
(496, 'Binalonan', 'Calasiao', 140),
(497, 'Binalonan', 'Dasol', 320),
(498, 'Binalonan', 'Infanta', 360),
(499, 'Binalonan', 'Labrador', 200),
(500, 'Binalonan', 'Laoac', 90),
(501, 'Binalonan', 'Lingayen', 170),
(502, 'Binalonan', 'Mabini', 280),
(503, 'Binalonan', 'Malasiqui', 140),
(504, 'Binalonan', 'Manaoag', 100),
(505, 'Binalonan', 'Mangaldan', 120),
(506, 'Binalonan', 'Mangatarem', 240),
(507, 'Binalonan', 'Mapandan', 120),
(508, 'Binalonan', 'Natividad', 140),
(509, 'Binalonan', 'Pozorrubio', 100),
(510, 'Binalonan', 'Rosales', 130),
(511, 'Binalonan', 'San Fabian', 140),
(512, 'Binalonan', 'San Jacinto', 120),
(513, 'Binalonan', 'San Manuel', 90),
(514, 'Binalonan', 'San Nicolas', 140),
(515, 'Binalonan', 'San Quintin', 140),
(516, 'Binalonan', 'Santa Barbara', 130),
(517, 'Binalonan', 'Santa Maria', 100),
(518, 'Binalonan', 'Santo Tomas', 160),
(519, 'Binalonan', 'Sison', 110),
(520, 'Binalonan', 'Sual', 220),
(521, 'Binalonan', 'Tayug', 120),
(522, 'Binalonan', 'Umingan', 160),
(523, 'Binalonan', 'Urbiztondo', 160),
(524, 'Binalonan', 'Villasis', 110),
(525, 'Binalonan', 'Dagupan', 140),
(526, 'Binalonan', 'Alaminos', 260),
(527, 'Binalonan', 'San Carlos', 160),
(528, 'Binalonan', 'Urdaneta', 100),
(529, 'Binmaley', 'Agno', 210),
(530, 'Binmaley', 'Aguilar', 130),
(531, 'Binmaley', 'Alcala', 140),
(532, 'Binmaley', 'Anda', 240),
(533, 'Binmaley', 'Asingan', 160),
(534, 'Binmaley', 'Balungao', 180),
(535, 'Binmaley', 'Bani', 180),
(536, 'Binmaley', 'Basista', 100),
(537, 'Binmaley', 'Bautista', 150),
(538, 'Binmaley', 'Bayambang', 130),
(539, 'Binmaley', 'Binalonan', 160),
(540, 'Binmaley', 'Binmaley', 60),
(541, 'Binmaley', 'Bolinao', 220),
(542, 'Binmaley', 'Bugallon', 100),
(543, 'Binmaley', 'Burgos', 200),
(544, 'Binmaley', 'Calasiao', 90),
(545, 'Binmaley', 'Dasol', 220),
(546, 'Binmaley', 'Infanta', 270),
(547, 'Binmaley', 'Labrador', 220),
(548, 'Binmaley', 'Laoac', 140),
(549, 'Binmaley', 'Lingayen', 80),
(550, 'Binmaley', 'Mabini', 190),
(551, 'Binmaley', 'Malasiqui', 110),
(552, 'Binmaley', 'Manaoag', 120),
(553, 'Binmaley', 'Mangaldan', 100),
(554, 'Binmaley', 'Mangatarem', 150),
(555, 'Binmaley', 'Mapandan', 110),
(556, 'Binmaley', 'Natividad', 200),
(557, 'Binmaley', 'Pozorrubio', 140),
(558, 'Binmaley', 'Rosales', 150),
(559, 'Binmaley', 'San Fabian', 120),
(560, 'Binmaley', 'San Jacinto', 110),
(561, 'Binmaley', 'San Manuel', 180),
(562, 'Binmaley', 'San Nicolas', 200),
(563, 'Binmaley', 'San Quintin', 220),
(564, 'Binmaley', 'Santa Barbara', 120),
(565, 'Binmaley', 'Santa Maria', 160),
(566, 'Binmaley', 'Santo Tomas', 200),
(567, 'Binmaley', 'Sison', 140),
(568, 'Binmaley', 'Sual', 140),
(569, 'Binmaley', 'Tayug', 180),
(570, 'Binmaley', 'Umingan', 200),
(571, 'Binmaley', 'Urbiztondo', 100),
(572, 'Binmaley', 'Villasis', 140),
(573, 'Binmaley', 'Dagupan', 80),
(574, 'Binmaley', 'Alaminos', 160),
(575, 'Binmaley', 'San Carlos', 100),
(576, 'Binmaley', 'Urdaneta', 130),
(577, 'Bolinao', 'Agno', 120),
(578, 'Bolinao', 'Aguilar', 240),
(579, 'Bolinao', 'Alcala', 300),
(580, 'Bolinao', 'Anda', 100),
(581, 'Bolinao', 'Asingan', 320),
(582, 'Bolinao', 'Balungao', 340),
(583, 'Bolinao', 'Bani', 90),
(584, 'Bolinao', 'Basista', 260),
(585, 'Bolinao', 'Bautista', 300),
(586, 'Bolinao', 'Bayambang', 280),
(587, 'Bolinao', 'Binalonan', 320),
(588, 'Bolinao', 'Binmaley', 220),
(589, 'Bolinao', 'Bolinao', 60),
(590, 'Bolinao', 'Bugallon', 220),
(591, 'Bolinao', 'Burgos', 150),
(592, 'Bolinao', 'Calasiao', 240),
(593, 'Bolinao', 'Dasol', 160),
(594, 'Bolinao', 'Infanta', 220),
(595, 'Bolinao', 'Labrador', 180),
(596, 'Bolinao', 'Laoac', 300),
(597, 'Bolinao', 'Lingayen', 210),
(598, 'Bolinao', 'Mabini', 160),
(599, 'Bolinao', 'Malasiqui', 270),
(600, 'Bolinao', 'Manaoag', 280),
(601, 'Bolinao', 'Mangaldan', 260),
(602, 'Bolinao', 'Mangatarem', 260),
(603, 'Bolinao', 'Mapandan', 270),
(604, 'Bolinao', 'Natividad', 360),
(605, 'Bolinao', 'Pozorrubio', 300),
(606, 'Bolinao', 'Rosales', 320),
(607, 'Bolinao', 'San Fabian', 280),
(608, 'Bolinao', 'San Jacinto', 270),
(609, 'Bolinao', 'San Manuel', 320),
(610, 'Bolinao', 'San Nicolas', 360),
(611, 'Bolinao', 'San Quintin', 360),
(612, 'Bolinao', 'Santa Barbara', 260),
(613, 'Bolinao', 'Santa Maria', 340),
(614, 'Bolinao', 'Santo Tomas', 340),
(615, 'Bolinao', 'Sison', 300),
(616, 'Bolinao', 'Sual', 160),
(617, 'Bolinao', 'Tayug', 340),
(618, 'Bolinao', 'Umingan', 360),
(619, 'Bolinao', 'Urbiztondo', 260),
(620, 'Bolinao', 'Villasis', 300),
(621, 'Bolinao', 'Dagupan', 240),
(622, 'Bolinao', 'Alaminos', 130),
(623, 'Bolinao', 'San Carlos', 240),
(624, 'Bolinao', 'Urdaneta', 290),
(625, 'Bugallon', 'Agno', 200),
(626, 'Bugallon', 'Aguilar', 110),
(627, 'Bugallon', 'Alcala', 180),
(628, 'Bugallon', 'Anda', 240),
(629, 'Bugallon', 'Asingan', 180),
(630, 'Bugallon', 'Balungao', 60),
(631, 'Bugallon', 'Bani', 190),
(632, 'Bugallon', 'Basista', 170),
(633, 'Bugallon', 'Bautista', 180),
(634, 'Bugallon', 'Bayambang', 140),
(635, 'Bugallon', 'Binalonan', 200),
(636, 'Bugallon', 'Binmaley', 100),
(637, 'Bugallon', 'Bolinao', 220),
(638, 'Bugallon', 'Bugallon', 60),
(639, 'Bugallon', 'Burgos', 200),
(640, 'Bugallon', 'Calasiao', 120),
(641, 'Bugallon', 'Dasol', 220),
(642, 'Bugallon', 'Infanta', 260),
(643, 'Bugallon', 'Labrador', 100),
(644, 'Bugallon', 'Laoac', 180),
(645, 'Bugallon', 'Lingayen', 90),
(646, 'Bugallon', 'Mabini', 180),
(647, 'Bugallon', 'Malasiqui', 130),
(648, 'Bugallon', 'Manaoag', 160),
(649, 'Bugallon', 'Mangaldan', 140),
(650, 'Bugallon', 'Mangatarem', 120),
(651, 'Bugallon', 'Mapandan', 150),
(652, 'Bugallon', 'Natividad', 260),
(653, 'Bugallon', 'Pozorrubio', 160),
(654, 'Bugallon', 'Rosales', 190),
(655, 'Bugallon', 'San Fabian', 160),
(656, 'Bugallon', 'San Jacinto', 150),
(657, 'Bugallon', 'San Manuel', 220),
(658, 'Bugallon', 'San Nicolas', 260),
(659, 'Bugallon', 'San Quintin', 300),
(660, 'Bugallon', 'Santa Barbara', 160),
(661, 'Bugallon', 'Santa Maria', 220),
(662, 'Bugallon', 'Santo Tomas', 180),
(663, 'Bugallon', 'Sison', 180),
(664, 'Bugallon', 'Sual', 140),
(665, 'Bugallon', 'Tayug', 240),
(666, 'Bugallon', 'Umingan', 290),
(667, 'Bugallon', 'Urbiztondo', 140),
(668, 'Bugallon', 'Villasis', 180),
(669, 'Bugallon', 'Dagupan', 120),
(670, 'Bugallon', 'Alaminos', 160),
(671, 'Bugallon', 'San Carlos', 140),
(672, 'Bugallon', 'Urdaneta', 160),
(673, 'Burgos', 'Agno', 100),
(674, 'Burgos', 'Aguilar', 220),
(675, 'Burgos', 'Alcala', 280),
(676, 'Burgos', 'Anda', 160),
(677, 'Burgos', 'Asingan', 300),
(678, 'Burgos', 'Balungao', 300),
(679, 'Burgos', 'Bani', 120),
(680, 'Burgos', 'Basista', 240),
(681, 'Burgos', 'Bautista', 280),
(682, 'Burgos', 'Bayambang', 260),
(683, 'Burgos', 'Binalonan', 300),
(684, 'Burgos', 'Binmaley', 200),
(685, 'Burgos', 'Bolinao', 160),
(686, 'Burgos', 'Bugallon', 190),
(687, 'Burgos', 'Burgos', 60),
(688, 'Burgos', 'Calasiao', 220),
(689, 'Burgos', 'Dasol', 90),
(690, 'Burgos', 'Infanta', 130),
(691, 'Burgos', 'Labrador', 160),
(692, 'Burgos', 'Laoac', 270),
(693, 'Burgos', 'Lingayen', 180),
(694, 'Burgos', 'Mabini', 110),
(695, 'Burgos', 'Malasiqui', 250),
(696, 'Burgos', 'Manaoag', 260),
(697, 'Burgos', 'Mangaldan', 240),
(698, 'Burgos', 'Mangatarem', 240),
(699, 'Burgos', 'Mapandan', 250),
(700, 'Burgos', 'Natividad', 260),
(701, 'Burgos', 'Pozorrubio', 360),
(702, 'Burgos', 'Rosales', 300),
(703, 'Burgos', 'San Fabian', 260),
(704, 'Burgos', 'San Jacinto', 240),
(705, 'Burgos', 'San Manuel', 320),
(706, 'Burgos', 'San Nicolas', 360),
(707, 'Burgos', 'San Quintin', 360),
(708, 'Burgos', 'Santa Barbara', 240),
(709, 'Burgos', 'Santa Maria', 320),
(710, 'Burgos', 'Santo Tomas', 300),
(711, 'Burgos', 'Sison', 280),
(712, 'Burgos', 'Sual', 140),
(713, 'Burgos', 'Tayug', 320),
(714, 'Burgos', 'Umingan', 340),
(715, 'Burgos', 'Urbiztondo', 240),
(716, 'Burgos', 'Villasis', 290),
(717, 'Burgos', 'Dagupan', 220),
(718, 'Burgos', 'Alaminos', 110),
(719, 'Burgos', 'San Carlos', 220),
(720, 'Burgos', 'Urdaneta', 260),
(721, 'Calasiao', 'Agno', 240),
(722, 'Calasiao', 'Aguilar', 160),
(723, 'Calasiao', 'Alcala', 140),
(724, 'Calasiao', 'Anda', 260),
(725, 'Calasiao', 'Asingan', 140),
(726, 'Calasiao', 'Balungao', 160),
(727, 'Calasiao', 'Bani', 220),
(728, 'Calasiao', 'Basista', 110),
(729, 'Calasiao', 'Bautista', 140),
(730, 'Calasiao', 'Bayambang', 120),
(731, 'Calasiao', 'Binalonan', 140),
(732, 'Calasiao', 'Binmaley', 90),
(733, 'Calasiao', 'Bolinao', 260),
(734, 'Calasiao', 'Bugallon', 120),
(735, 'Calasiao', 'Burgos', 220),
(736, 'Calasiao', 'Calasiao', 60),
(737, 'Calasiao', 'Dasol', 240),
(738, 'Calasiao', 'Infanta', 300),
(739, 'Calasiao', 'Labrador', 120),
(740, 'Calasiao', 'Laoac', 140),
(741, 'Calasiao', 'Lingayen', 100),
(742, 'Calasiao', 'Mabini', 210),
(743, 'Calasiao', 'Malasiqui', 100),
(744, 'Calasiao', 'Manaoag', 120),
(745, 'Calasiao', 'Mangaldan', 110),
(746, 'Calasiao', 'Mangatarem', 130),
(747, 'Calasiao', 'Mapandan', 110),
(748, 'Calasiao', 'Natividad', 200),
(749, 'Calasiao', 'Pozorrubio', 130),
(750, 'Calasiao', 'Rosales', 140),
(751, 'Calasiao', 'San Fabian', 120),
(752, 'Calasiao', 'San Jacinto', 100),
(753, 'Calasiao', 'San Manuel', 160),
(754, 'Calasiao', 'San Nicolas', 200),
(755, 'Calasiao', 'San Quintin', 200),
(756, 'Calasiao', 'Santa Barbara', 90),
(757, 'Calasiao', 'Santa Maria', 160),
(758, 'Calasiao', 'Santo Tomas', 160),
(759, 'Calasiao', 'Sison', 160),
(760, 'Calasiao', 'Sual', 160),
(761, 'Calasiao', 'Tayug', 180),
(762, 'Calasiao', 'Umingan', 180),
(763, 'Calasiao', 'Urbiztondo', 220),
(764, 'Calasiao', 'Villasis', 120),
(765, 'Calasiao', 'Dagupan', 100),
(766, 'Calasiao', 'Alaminos', 180),
(767, 'Calasiao', 'San Carlos', 90),
(768, 'Calasiao', 'Urdaneta', 140),
(769, 'Dasol', 'Agno', 120),
(770, 'Dasol', 'Aguilar', 240),
(771, 'Dasol', 'Alcala', 300),
(772, 'Dasol', 'Anda', 180),
(773, 'Dasol', 'Asingan', 310),
(774, 'Dasol', 'Balungao', 320),
(775, 'Dasol', 'Bani', 140),
(776, 'Dasol', 'Basista', 260),
(777, 'Dasol', 'Bautista', 300),
(778, 'Dasol', 'Bayambang', 280),
(779, 'Dasol', 'Binalonan', 320),
(780, 'Dasol', 'Binmaley', 220),
(781, 'Dasol', 'Bolinao', 180),
(782, 'Dasol', 'Bugallon', 220),
(783, 'Dasol', 'Burgos', 110),
(784, 'Dasol', 'Calasiao', 240),
(785, 'Dasol', 'Dasol', 60),
(786, 'Dasol', 'Infanta', 120),
(787, 'Dasol', 'Labrador', 180),
(788, 'Dasol', 'Laoac', 300),
(789, 'Dasol', 'Lingayen', 200),
(790, 'Dasol', 'Mabini', 130),
(791, 'Dasol', 'Malasiqui', 270),
(792, 'Dasol', 'Manaoag', 280),
(793, 'Dasol', 'Mangaldan', 260),
(794, 'Dasol', 'Mangatarem', 260),
(795, 'Dasol', 'Mapandan', 270),
(796, 'Dasol', 'Natividad', 360),
(797, 'Dasol', 'Pozorrubio', 290),
(798, 'Dasol', 'Rosales', 320),
(799, 'Dasol', 'San Fabian', 280),
(800, 'Dasol', 'San Jacinto', 260),
(801, 'Dasol', 'San Manuel', 340),
(802, 'Dasol', 'San Nicolas', 360),
(803, 'Dasol', 'San Quintin', 360),
(804, 'Dasol', 'Santa Barbara', 270),
(805, 'Dasol', 'Santa Maria', 340),
(806, 'Dasol', 'Santo Tomas', 320),
(807, 'Dasol', 'Sison', 300),
(808, 'Dasol', 'Sual', 160),
(809, 'Dasol', 'Tayug', 360),
(810, 'Dasol', 'Umingan', 360),
(811, 'Dasol', 'Urbiztondo', 270),
(812, 'Dasol', 'Villasis', 300),
(813, 'Dasol', 'Dagupan', 240),
(814, 'Dasol', 'Alaminos', 130),
(815, 'Dasol', 'San Carlos', 240),
(816, 'Dasol', 'Urdaneta', 290),
(817, 'Infanta', 'Agno', 160),
(818, 'Infanta', 'Aguilar', 160),
(819, 'Infanta', 'Alcala', 340),
(820, 'Infanta', 'Anda', 220),
(821, 'Infanta', 'Asingan', 340),
(822, 'Infanta', 'Balungao', 360),
(823, 'Infanta', 'Bani', 190),
(824, 'Infanta', 'Basista', 300),
(825, 'Infanta', 'Bautista', 340),
(826, 'Infanta', 'Bayambang', 340),
(827, 'Infanta', 'Binalonan', 360),
(828, 'Infanta', 'Binmaley', 260),
(829, 'Infanta', 'Bolinao', 200),
(830, 'Infanta', 'Bugallon', 260),
(831, 'Infanta', 'Burgos', 130),
(832, 'Infanta', 'Calasiao', 290),
(833, 'Infanta', 'Dasol', 120),
(834, 'Infanta', 'Infanta', 60),
(835, 'Infanta', 'Labrador', 240),
(836, 'Infanta', 'Laoac', 340),
(837, 'Infanta', 'Lingayen', 260),
(838, 'Infanta', 'Mabini', 180),
(839, 'Infanta', 'Malasiqui', 320),
(840, 'Infanta', 'Manaoag', 320),
(841, 'Infanta', 'Mangaldan', 300),
(842, 'Infanta', 'Mangatarem', 300),
(843, 'Infanta', 'Mapandan', 320),
(844, 'Infanta', 'Natividad', 420),
(845, 'Infanta', 'Pozorrubio', 340),
(846, 'Infanta', 'Rosales', 360),
(847, 'Infanta', 'San Fabian', 320),
(848, 'Infanta', 'San Jacinto', 320),
(849, 'Infanta', 'San Manuel', 380),
(850, 'Infanta', 'San Nicolas', 420),
(851, 'Infanta', 'San Quintin', 420),
(852, 'Infanta', 'Santa Barbara', 320),
(853, 'Infanta', 'Santa Maria', 380),
(854, 'Infanta', 'Santo Tomas', 380),
(855, 'Infanta', 'Sison', 340),
(856, 'Infanta', 'Sual', 200),
(857, 'Infanta', 'Tayug', 400),
(858, 'Infanta', 'Umingan', 410),
(859, 'Infanta', 'Urbiztondo', 310),
(860, 'Infanta', 'Villasis', 340),
(861, 'Infanta', 'Dagupan', 280),
(862, 'Infanta', 'Alaminos', 180),
(863, 'Infanta', 'San Carlos', 290),
(864, 'Infanta', 'Urdaneta', 330),
(865, 'Labrador', 'Agno', 160),
(866, 'Labrador', 'Aguilar', 120),
(867, 'Labrador', 'Alcala', 180),
(868, 'Labrador', 'Anda', 200),
(869, 'Labrador', 'Asingan', 180),
(870, 'Labrador', 'Balungao', 200),
(871, 'Labrador', 'Bani', 160),
(872, 'Labrador', 'Basista', 140),
(873, 'Labrador', 'Bautista', 200),
(874, 'Labrador', 'Bayambang', 160),
(875, 'Labrador', 'Binalonan', 200),
(876, 'Labrador', 'Binmaley', 100),
(877, 'Labrador', 'Bolinao', 180),
(878, 'Labrador', 'Bugallon', 110),
(879, 'Labrador', 'Burgos', 160),
(880, 'Labrador', 'Calasiao', 120),
(881, 'Labrador', 'Dasol', 180),
(882, 'Labrador', 'Infanta', 240),
(883, 'Labrador', 'Labrador', 60),
(884, 'Labrador', 'Laoac', 170),
(885, 'Labrador', 'Lingayen', 80),
(886, 'Labrador', 'Mabini', 140),
(887, 'Labrador', 'Malasiqui', 150),
(888, 'Labrador', 'Manaoag', 160),
(889, 'Labrador', 'Mangaldan', 130),
(890, 'Labrador', 'Mangatarem', 130),
(891, 'Labrador', 'Mapandan', 140),
(892, 'Labrador', 'Natividad', 250),
(893, 'Labrador', 'Pozorrubio', 150),
(894, 'Labrador', 'Rosales', 190),
(895, 'Labrador', 'San Fabian', 160),
(896, 'Labrador', 'San Jacinto', 140),
(897, 'Labrador', 'San Manuel', 210),
(898, 'Labrador', 'San Nicolas', 250),
(899, 'Labrador', 'San Quintin', 260),
(900, 'Labrador', 'Santa Barbara', 140),
(901, 'Labrador', 'Santa Maria', 220),
(902, 'Labrador', 'Santo Tomas', 200),
(903, 'Labrador', 'Sison', 210),
(904, 'Labrador', 'Sual', 90),
(905, 'Labrador', 'Tayug', 230),
(906, 'Labrador', 'Umingan', 240),
(907, 'Labrador', 'Urbiztondo', 140),
(908, 'Labrador', 'Villasis', 180),
(909, 'Labrador', 'Dagupan', 120),
(910, 'Labrador', 'Alaminos', 120),
(911, 'Labrador', 'San Carlos', 120),
(912, 'Labrador', 'Urdaneta', 170),
(913, 'Mabini', 'Agno', 120),
(914, 'Mabini', 'Aguilar', 210),
(915, 'Mabini', 'Alcala', 260),
(916, 'Mabini', 'Anda', 160),
(917, 'Mabini', 'Asingan', 270),
(918, 'Mabini', 'Balungao', 290),
(919, 'Mabini', 'Bani', 140),
(920, 'Mabini', 'Basista', 220),
(921, 'Mabini', 'Bautista', 260),
(922, 'Mabini', 'Bayambang', 260),
(923, 'Mabini', 'Binalonan', 280),
(924, 'Mabini', 'Binmaley', 190),
(925, 'Mabini', 'Bolinao', 160),
(926, 'Mabini', 'Bugallon', 170),
(927, 'Mabini', 'Burgos', 110),
(928, 'Mabini', 'Calasiao', 210),
(929, 'Mabini', 'Dasol', 130),
(930, 'Mabini', 'Infanta', 180),
(931, 'Mabini', 'Labrador', 150),
(932, 'Mabini', 'Laoac', 260),
(933, 'Mabini', 'Lingayen', 170),
(934, 'Mabini', 'Mabini', 60),
(935, 'Mabini', 'Malasiqui', 240),
(936, 'Mabini', 'Manaoag', 240),
(937, 'Mabini', 'Mangaldan', 220),
(938, 'Mabini', 'Mangatarem', 220),
(939, 'Mabini', 'Mapandan', 240),
(940, 'Mabini', 'Natividad', 340),
(941, 'Mabini', 'Pozorrubio', 260),
(942, 'Mabini', 'Rosales', 280),
(943, 'Mabini', 'San Fabian', 240),
(944, 'Mabini', 'San Jacinto', 230),
(945, 'Mabini', 'San Manuel', 280),
(946, 'Mabini', 'San Nicolas', 340),
(947, 'Mabini', 'San Quintin', 340),
(948, 'Mabini', 'Santa Barbara', 230),
(949, 'Mabini', 'Santa Maria', 300),
(950, 'Mabini', 'Santo Tomas', 290),
(951, 'Mabini', 'Sison', 260),
(952, 'Mabini', 'Sual', 120),
(953, 'Mabini', 'Tayug', 320),
(954, 'Mabini', 'Umingan', 340),
(955, 'Mabini', 'Urbiztondo', 230),
(956, 'Mabini', 'Villasis', 280),
(957, 'Mabini', 'Dagupan', 200),
(958, 'Mabini', 'Alaminos', 100),
(959, 'Mabini', 'San Carlos', 210),
(960, 'Mabini', 'Urdaneta', 250),
(961, 'Malasiqui', 'Agno', 260),
(962, 'Malasiqui', 'Aguilar', 160),
(963, 'Malasiqui', 'Alcala', 120),
(964, 'Malasiqui', 'Anda', 280),
(965, 'Malasiqui', 'Asingan', 120),
(966, 'Malasiqui', 'Balungao', 120),
(967, 'Malasiqui', 'Bani', 240),
(968, 'Malasiqui', 'Basista', 90),
(969, 'Malasiqui', 'Bautista', 110),
(970, 'Malasiqui', 'Bayambang', 100),
(971, 'Malasiqui', 'Binalonan', 140),
(972, 'Malasiqui', 'Binmaley', 110),
(973, 'Malasiqui', 'Bolinao', 270),
(974, 'Malasiqui', 'Bugallon', 150),
(975, 'Malasiqui', 'Burgos', 240),
(976, 'Malasiqui', 'Calasiao', 100),
(977, 'Malasiqui', 'Dasol', 270),
(978, 'Malasiqui', 'Infanta', 310),
(979, 'Malasiqui', 'Labrador', 160),
(980, 'Malasiqui', 'Laoac', 120),
(981, 'Malasiqui', 'Lingayen', 120),
(982, 'Malasiqui', 'Mabini', 240),
(983, 'Malasiqui', 'Malasiqui', 60),
(984, 'Malasiqui', 'Manaoag', 110),
(985, 'Malasiqui', 'Mangaldan', 110),
(986, 'Malasiqui', 'Mangatarem', 140),
(987, 'Malasiqui', 'Mapandan', 100),
(988, 'Malasiqui', 'Natividad', 170),
(989, 'Malasiqui', 'Pozorrubio', 140),
(990, 'Malasiqui', 'Rosales', 110),
(991, 'Malasiqui', 'San Fabian', 140),
(992, 'Malasiqui', 'San Jacinto', 120),
(993, 'Malasiqui', 'San Manuel', 150),
(994, 'Malasiqui', 'San Nicolas', 150),
(995, 'Malasiqui', 'San Quintin', 170),
(996, 'Malasiqui', 'Santa Barbara', 90),
(997, 'Malasiqui', 'Santa Maria', 130),
(998, 'Malasiqui', 'Santo Tomas', 140),
(999, 'Malasiqui', 'Sison', 180),
(1000, 'Malasiqui', 'Sual', 180),
(1001, 'Malasiqui', 'Tayug', 140),
(1002, 'Malasiqui', 'Umingan', 160),
(1003, 'Malasiqui', 'Urbiztondo', 110),
(1004, 'Malasiqui', 'Villasis', 90),
(1005, 'Malasiqui', 'Dagupan', 110),
(1006, 'Malasiqui', 'Alaminos', 200),
(1007, 'Malasiqui', 'San Carlos', 100),
(1008, 'Malasiqui', 'Urdaneta', 110),
(1009, 'Manaoag', 'Agno', 260),
(1010, 'Manaoag', 'Aguilar', 180),
(1011, 'Manaoag', 'Alcala', 130),
(1012, 'Manaoag', 'Anda', 280),
(1013, 'Manaoag', 'Asingan', 110),
(1014, 'Manaoag', 'Balungao', 150),
(1015, 'Manaoag', 'Bani', 240),
(1016, 'Manaoag', 'Basista', 130),
(1017, 'Manaoag', 'Bautista', 140),
(1018, 'Manaoag', 'Bayambang', 140),
(1019, 'Manaoag', 'Binalonan', 100),
(1020, 'Manaoag', 'Binmaley', 120),
(1021, 'Manaoag', 'Bolinao', 280),
(1022, 'Manaoag', 'Bugallon', 160),
(1023, 'Manaoag', 'Burgos', 260),
(1024, 'Manaoag', 'Calasiao', 100),
(1025, 'Manaoag', 'Dasol', 270),
(1026, 'Manaoag', 'Infanta', 320),
(1027, 'Manaoag', 'Labrador', 150),
(1028, 'Manaoag', 'Laoac', 80),
(1029, 'Manaoag', 'Lingayen', 160),
(1030, 'Manaoag', 'Mabini', 240),
(1031, 'Manaoag', 'Malasiqui', 110),
(1032, 'Manaoag', 'Manaoag', 60),
(1033, 'Manaoag', 'Mangaldan', 90),
(1034, 'Manaoag', 'Mangatarem', 170),
(1035, 'Manaoag', 'Mapandan', 80),
(1036, 'Manaoag', 'Natividad', 160),
(1037, 'Manaoag', 'Pozorrubio', 80),
(1038, 'Manaoag', 'Rosales', 130),
(1039, 'Manaoag', 'San Fabian', 100),
(1040, 'Manaoag', 'San Jacinto', 80),
(1041, 'Manaoag', 'San Manuel', 110),
(1042, 'Manaoag', 'San Nicolas', 150),
(1043, 'Manaoag', 'San Quintin', 160),
(1044, 'Manaoag', 'Santa Barbara', 100),
(1045, 'Manaoag', 'Santa Maria', 120),
(1046, 'Manaoag', 'Santo Tomas', 170),
(1047, 'Manaoag', 'Sison', 110),
(1048, 'Manaoag', 'Sual', 180),
(1049, 'Manaoag', 'Tayug', 130),
(1050, 'Manaoag', 'Umingan', 190),
(1051, 'Manaoag', 'Urbiztondo', 140),
(1052, 'Manaoag', 'Villasis', 110),
(1053, 'Manaoag', 'Dagupan', 100),
(1054, 'Manaoag', 'Alaminos', 210),
(1055, 'Manaoag', 'San Carlos', 70),
(1056, 'Manaoag', 'Urdaneta', 90),
(1057, 'Mangaldan', 'Agno', 240),
(1058, 'Mangaldan', 'Aguilar', 160),
(1059, 'Mangaldan', 'Alcala', 160),
(1060, 'Mangaldan', 'Anda', 260),
(1061, 'Mangaldan', 'Asingan', 130),
(1062, 'Mangaldan', 'Balungao', 150),
(1063, 'Mangaldan', 'Bani', 220),
(1064, 'Mangaldan', 'Basista', 120),
(1065, 'Mangaldan', 'Bautista', 150),
(1066, 'Mangaldan', 'Bayambang', 140),
(1067, 'Mangaldan', 'Binalonan', 120),
(1068, 'Mangaldan', 'Binmaley', 100),
(1069, 'Mangaldan', 'Bolinao', 260),
(1070, 'Mangaldan', 'Bugallon', 130),
(1071, 'Mangaldan', 'Burgos', 230),
(1072, 'Mangaldan', 'Calasiao', 90),
(1073, 'Mangaldan', 'Dasol', 270),
(1074, 'Mangaldan', 'Infanta', 300),
(1075, 'Mangaldan', 'Labrador', 130),
(1076, 'Mangaldan', 'Laoac', 100),
(1077, 'Mangaldan', 'Lingayen', 110),
(1078, 'Mangaldan', 'Mabini', 260),
(1079, 'Mangaldan', 'Malasiqui', 110),
(1080, 'Mangaldan', 'Manaoag', 90),
(1081, 'Mangaldan', 'Mangaldan', 60),
(1082, 'Mangaldan', 'Mangatarem', 160),
(1083, 'Mangaldan', 'Mapandan', 80),
(1084, 'Mangaldan', 'Natividad', 180),
(1085, 'Mangaldan', 'Pozorrubio', 100),
(1086, 'Mangaldan', 'Rosales', 160),
(1087, 'Mangaldan', 'San Fabian', 100),
(1088, 'Mangaldan', 'San Jacinto', 80),
(1089, 'Mangaldan', 'San Manuel', 140),
(1090, 'Mangaldan', 'San Nicolas', 180),
(1091, 'Mangaldan', 'San Quintin', 180),
(1092, 'Mangaldan', 'Santa Barbara', 90),
(1093, 'Mangaldan', 'Santa Maria', 140),
(1094, 'Mangaldan', 'Santo Tomas', 200),
(1095, 'Mangaldan', 'Sison', 110),
(1096, 'Mangaldan', 'Sual', 160),
(1097, 'Mangaldan', 'Tayug', 160),
(1098, 'Mangaldan', 'Umingan', 210),
(1099, 'Mangaldan', 'Urbiztondo', 130),
(1100, 'Mangaldan', 'Villasis', 130),
(1101, 'Mangaldan', 'Dagupan', 80),
(1102, 'Mangaldan', 'Alaminos', 190),
(1103, 'Mangaldan', 'San Carlos', 120),
(1104, 'Mangaldan', 'Urdaneta', 110),
(1105, 'Mangatarem', 'Agno', 250),
(1106, 'Mangatarem', 'Aguilar', 120),
(1107, 'Mangatarem', 'Alcala', 140),
(1108, 'Mangatarem', 'Anda', 260),
(1109, 'Mangatarem', 'Asingan', 200),
(1110, 'Mangatarem', 'Balungao', 200),
(1111, 'Mangatarem', 'Bani', 220),
(1112, 'Mangatarem', 'Basista', 110),
(1113, 'Mangatarem', 'Bautista', 150),
(1114, 'Mangatarem', 'Bayambang', 110),
(1115, 'Mangatarem', 'Binalonan', 240),
(1116, 'Mangatarem', 'Binmaley', 150),
(1117, 'Mangatarem', 'Bolinao', 260),
(1118, 'Mangatarem', 'Bugallon', 120),
(1119, 'Mangatarem', 'Burgos', 260),
(1120, 'Mangatarem', 'Calasiao', 130),
(1121, 'Mangatarem', 'Dasol', 260),
(1122, 'Mangatarem', 'Infanta', 300),
(1123, 'Mangatarem', 'Labrador', 140),
(1124, 'Mangatarem', 'Laoac', 240),
(1125, 'Mangatarem', 'Lingayen', 130),
(1126, 'Mangatarem', 'Mabini', 230),
(1127, 'Mangatarem', 'Malasiqui', 140),
(1128, 'Mangatarem', 'Manaoag', 170),
(1129, 'Mangatarem', 'Mangaldan', 160),
(1130, 'Mangatarem', 'Mangatarem', 60),
(1131, 'Mangatarem', 'Mapandan', 160),
(1132, 'Mangatarem', 'Natividad', 260),
(1133, 'Mangatarem', 'Pozorrubio', 250),
(1134, 'Mangatarem', 'Rosales', 190),
(1135, 'Mangatarem', 'San Fabian', 200),
(1136, 'Mangatarem', 'San Jacinto', 180),
(1137, 'Mangatarem', 'San Manuel', 210),
(1138, 'Mangatarem', 'San Nicolas', 260),
(1139, 'Mangatarem', 'San Quintin', 240),
(1140, 'Mangatarem', 'Santa Barbara', 140),
(1141, 'Mangatarem', 'Santa Maria', 220),
(1142, 'Mangatarem', 'Santo Tomas', 140),
(1143, 'Mangatarem', 'Sison', 210),
(1144, 'Mangatarem', 'Sual', 170),
(1145, 'Mangatarem', 'Tayug', 200),
(1146, 'Mangatarem', 'Umingan', 240),
(1147, 'Mangatarem', 'Urbiztondo', 90),
(1148, 'Mangatarem', 'Villasis', 160),
(1149, 'Mangatarem', 'Dagupan', 140),
(1150, 'Mangatarem', 'Alaminos', 200),
(1151, 'Mangatarem', 'San Carlos', 110),
(1152, 'Mangatarem', 'Urdaneta', 160),
(1153, 'Mapandan', 'Agno', 260),
(1154, 'Mapandan', 'Aguilar', 160),
(1155, 'Mapandan', 'Alcala', 130),
(1156, 'Mapandan', 'Anda', 280),
(1157, 'Mapandan', 'Asingan', 120),
(1158, 'Mapandan', 'Balungao', 150),
(1159, 'Mapandan', 'Bani', 240),
(1160, 'Mapandan', 'Basista', 120),
(1161, 'Mapandan', 'Bautista', 140),
(1162, 'Mapandan', 'Bayambang', 130),
(1163, 'Mapandan', 'Binalonan', 110),
(1164, 'Mapandan', 'Binmaley', 110),
(1165, 'Mapandan', 'Bolinao', 260),
(1166, 'Mapandan', 'Bugallon', 150),
(1167, 'Mapandan', 'Burgos', 240),
(1168, 'Mapandan', 'Calasiao', 100),
(1169, 'Mapandan', 'Dasol', 260),
(1170, 'Mapandan', 'Infanta', 310),
(1171, 'Mapandan', 'Labrador', 150),
(1172, 'Mapandan', 'Laoac', 90),
(1173, 'Mapandan', 'Lingayen', 120),
(1174, 'Mapandan', 'Mabini', 220),
(1175, 'Mapandan', 'Malasiqui', 100),
(1176, 'Mapandan', 'Manaoag', 80),
(1177, 'Mapandan', 'Mangaldan', 80),
(1178, 'Mapandan', 'Mangatarem', 160),
(1179, 'Mapandan', 'Mapandan', 60),
(1180, 'Mapandan', 'Natividad', 160),
(1181, 'Mapandan', 'Pozorrubio', 100),
(1182, 'Mapandan', 'Rosales', 140),
(1183, 'Mapandan', 'San Fabian', 100),
(1184, 'Mapandan', 'San Jacinto', 80),
(1185, 'Mapandan', 'San Manuel', 120),
(1186, 'Mapandan', 'San Nicolas', 160),
(1187, 'Mapandan', 'San Quintin', 170),
(1188, 'Mapandan', 'Santa Barbara', 90),
(1189, 'Mapandan', 'Santa Maria', 130),
(1190, 'Mapandan', 'Santo Tomas', 180),
(1191, 'Mapandan', 'Sison', 120),
(1192, 'Mapandan', 'Sual', 180),
(1193, 'Mapandan', 'Tayug', 140),
(1194, 'Mapandan', 'Umingan', 190),
(1195, 'Mapandan', 'Urbiztondo', 140),
(1196, 'Mapandan', 'Villasis', 110),
(1197, 'Mapandan', 'Dagupan', 100),
(1198, 'Mapandan', 'Alaminos', 200),
(1199, 'Mapandan', 'San Carlos', 120),
(1200, 'Mapandan', 'Urdaneta', 90),
(1201, 'Natividad', 'Agno', 340),
(1202, 'Natividad', 'Aguilar', 260),
(1203, 'Natividad', 'Alcala', 140),
(1204, 'Natividad', 'Anda', 360),
(1205, 'Natividad', 'Asingan', 110),
(1206, 'Natividad', 'Balungao', 120),
(1207, 'Natividad', 'Bani', 340),
(1208, 'Natividad', 'Basista', 190),
(1209, 'Natividad', 'Bautista', 170),
(1210, 'Natividad', 'Bayambang', 180),
(1211, 'Natividad', 'Binalonan', 140),
(1212, 'Natividad', 'Binmaley', 220),
(1213, 'Natividad', 'Bolinao', 360),
(1214, 'Natividad', 'Bugallon', 260),
(1215, 'Natividad', 'Burgos', 330),
(1216, 'Natividad', 'Calasiao', 200),
(1217, 'Natividad', 'Dasol', 360),
(1218, 'Natividad', 'Infanta', 400),
(1219, 'Natividad', 'Labrador', 220),
(1220, 'Natividad', 'Laoac', 140),
(1221, 'Natividad', 'Lingayen', 220),
(1222, 'Natividad', 'Mabini', 320),
(1223, 'Natividad', 'Malasiqui', 170),
(1224, 'Natividad', 'Manaoag', 130),
(1225, 'Natividad', 'Mangaldan', 180),
(1226, 'Natividad', 'Mangatarem', 260),
(1227, 'Natividad', 'Mapandan', 160),
(1228, 'Natividad', 'Natividad', 60),
(1229, 'Natividad', 'Pozorrubio', 160),
(1230, 'Natividad', 'Rosales', 120),
(1231, 'Natividad', 'San Fabian', 180),
(1232, 'Natividad', 'San Jacinto', 170),
(1233, 'Natividad', 'San Manuel', 130),
(1234, 'Natividad', 'San Nicolas', 110),
(1235, 'Natividad', 'San Quintin', 90),
(1236, 'Natividad', 'Santa Barbara', 180),
(1237, 'Natividad', 'Santa Maria', 100),
(1238, 'Natividad', 'Santo Tomas', 180),
(1239, 'Natividad', 'Sison', 160),
(1240, 'Natividad', 'Sual', 260),
(1241, 'Natividad', 'Tayug', 90),
(1242, 'Natividad', 'Umingan', 100),
(1243, 'Natividad', 'Urbiztondo', 200),
(1244, 'Natividad', 'Villasis', 140),
(1245, 'Natividad', 'Dagupan', 190),
(1246, 'Natividad', 'Alaminos', 270),
(1247, 'Natividad', 'San Carlos', 200),
(1248, 'Natividad', 'Urdaneta', 150),
(1249, 'Pozorrubio', 'Agno', 280),
(1250, 'Pozorrubio', 'Aguilar', 200),
(1251, 'Pozorrubio', 'Alcala', 160),
(1252, 'Pozorrubio', 'Anda', 300),
(1253, 'Pozorrubio', 'Asingan', 100),
(1254, 'Pozorrubio', 'Balungao', 160),
(1255, 'Pozorrubio', 'Bani', 260),
(1256, 'Pozorrubio', 'Basista', 160),
(1257, 'Pozorrubio', 'Bautista', 160),
(1258, 'Pozorrubio', 'Bayambang', 180),
(1259, 'Pozorrubio', 'Binalonan', 100),
(1260, 'Pozorrubio', 'Binmaley', 130),
(1261, 'Pozorrubio', 'Bolinao', 280),
(1262, 'Pozorrubio', 'Bugallon', 160),
(1263, 'Pozorrubio', 'Burgos', 280),
(1264, 'Pozorrubio', 'Calasiao', 130),
(1265, 'Pozorrubio', 'Dasol', 300),
(1266, 'Pozorrubio', 'Infanta', 340),
(1267, 'Pozorrubio', 'Labrador', 170),
(1268, 'Pozorrubio', 'Laoac', 110),
(1269, 'Pozorrubio', 'Lingayen', 140),
(1270, 'Pozorrubio', 'Mabini', 260),
(1271, 'Pozorrubio', 'Malasiqui', 140),
(1272, 'Pozorrubio', 'Manaoag', 80),
(1273, 'Pozorrubio', 'Mangaldan', 120),
(1274, 'Pozorrubio', 'Mangatarem', 130),
(1275, 'Pozorrubio', 'Mapandan', 100),
(1276, 'Pozorrubio', 'Natividad', 150),
(1277, 'Pozorrubio', 'Pozorrubio', 60),
(1278, 'Pozorrubio', 'Rosales', 140),
(1279, 'Pozorrubio', 'San Fabian', 110),
(1280, 'Pozorrubio', 'San Jacinto', 90),
(1281, 'Pozorrubio', 'San Manuel', 110),
(1282, 'Pozorrubio', 'San Nicolas', 150),
(1283, 'Pozorrubio', 'San Quintin', 150),
(1284, 'Pozorrubio', 'Santa Barbara', 130),
(1285, 'Pozorrubio', 'Santa Maria', 110),
(1286, 'Pozorrubio', 'Santo Tomas', 100),
(1287, 'Pozorrubio', 'Sison', 80),
(1288, 'Pozorrubio', 'Sual', 200),
(1289, 'Pozorrubio', 'Tayug', 120),
(1290, 'Pozorrubio', 'Umingan', 160),
(1291, 'Pozorrubio', 'Urbiztondo', 170),
(1292, 'Pozorrubio', 'Villasis', 120),
(1293, 'Pozorrubio', 'Dagupan', 120),
(1294, 'Pozorrubio', 'Alaminos', 230),
(1295, 'Pozorrubio', 'San Carlos', 160),
(1296, 'Pozorrubio', 'Urdaneta', 100),
(1297, 'Rosales', 'Agno', 300),
(1298, 'Rosales', 'Aguilar', 200),
(1299, 'Rosales', 'Alcala', 90),
(1300, 'Rosales', 'Anda', 330),
(1301, 'Rosales', 'Asingan', 100),
(1302, 'Rosales', 'Balungao', 80),
(1303, 'Rosales', 'Bani', 280),
(1304, 'Rosales', 'Basista', 120),
(1305, 'Rosales', 'Bautista', 110),
(1306, 'Rosales', 'Bayambang', 120),
(1307, 'Rosales', 'Binalonan', 130),
(1308, 'Rosales', 'Binmaley', 150),
(1309, 'Rosales', 'Bolinao', 310),
(1310, 'Rosales', 'Bugallon', 190),
(1311, 'Rosales', 'Burgos', 280),
(1312, 'Rosales', 'Calasiao', 140),
(1313, 'Rosales', 'Dasol', 320),
(1314, 'Rosales', 'Infanta', 360),
(1315, 'Rosales', 'Labrador', 190),
(1316, 'Rosales', 'Laoac', 120),
(1317, 'Rosales', 'Lingayen', 170),
(1318, 'Rosales', 'Mabini', 280),
(1319, 'Rosales', 'Malasiqui', 110),
(1320, 'Rosales', 'Manaoag', 130),
(1321, 'Rosales', 'Mangaldan', 150),
(1322, 'Rosales', 'Mangatarem', 160),
(1323, 'Rosales', 'Mapandan', 120),
(1324, 'Rosales', 'Natividad', 120),
(1325, 'Rosales', 'Pozorrubio', 140),
(1326, 'Rosales', 'Rosales', 60),
(1327, 'Rosales', 'San Fabian', 170),
(1328, 'Rosales', 'San Jacinto', 150),
(1329, 'Rosales', 'San Manuel', 120),
(1330, 'Rosales', 'San Nicolas', 130),
(1331, 'Rosales', 'San Quintin', 120),
(1332, 'Rosales', 'Santa Barbara', 130),
(1333, 'Rosales', 'Santa Maria', 90),
(1334, 'Rosales', 'Santo Tomas', 120),
(1335, 'Rosales', 'Sison', 140),
(1336, 'Rosales', 'Sual', 220),
(1337, 'Rosales', 'Tayug', 100),
(1338, 'Rosales', 'Umingan', 120),
(1339, 'Rosales', 'Urbiztondo', 140),
(1340, 'Rosales', 'Villasis', 80),
(1341, 'Rosales', 'Dagupan', 160),
(1342, 'Rosales', 'Alaminos', 240),
(1343, 'Rosales', 'San Carlos', 140),
(1344, 'Rosales', 'Urdaneta', 90),
(1345, 'San Fabian', 'Agno', 260),
(1346, 'San Fabian', 'Aguilar', 200),
(1347, 'San Fabian', 'Alcala', 160),
(1348, 'San Fabian', 'Anda', 290),
(1349, 'San Fabian', 'Asingan', 140),
(1350, 'San Fabian', 'Balungao', 180),
(1351, 'San Fabian', 'Bani', 260),
(1352, 'San Fabian', 'Basista', 160),
(1353, 'San Fabian', 'Bautista', 180),
(1354, 'San Fabian', 'Bayambang', 160),
(1355, 'San Fabian', 'Binalonan', 140),
(1356, 'San Fabian', 'Binmaley', 120),
(1357, 'San Fabian', 'Bolinao', 280),
(1358, 'San Fabian', 'Bugallon', 160),
(1359, 'San Fabian', 'Burgos', 260),
(1360, 'San Fabian', 'Calasiao', 120),
(1361, 'San Fabian', 'Dasol', 280),
(1362, 'San Fabian', 'Infanta', 320),
(1363, 'San Fabian', 'Labrador', 160),
(1364, 'San Fabian', 'Laoac', 120),
(1365, 'San Fabian', 'Lingayen', 130),
(1366, 'San Fabian', 'Mabini', 240),
(1367, 'San Fabian', 'Malasiqui', 140),
(1368, 'San Fabian', 'Manaoag', 100),
(1369, 'San Fabian', 'Mangaldan', 100),
(1370, 'San Fabian', 'Mangatarem', 200),
(1371, 'San Fabian', 'Mapandan', 100),
(1372, 'San Fabian', 'Natividad', 190),
(1373, 'San Fabian', 'Pozorrubio', 140),
(1374, 'San Fabian', 'Rosales', 160),
(1375, 'San Fabian', 'San Fabian', 60),
(1376, 'San Fabian', 'San Jacinto', 90),
(1377, 'San Fabian', 'San Manuel', 150),
(1378, 'San Fabian', 'San Nicolas', 190),
(1379, 'San Fabian', 'San Quintin', 190),
(1380, 'San Fabian', 'Santa Barbara', 120),
(1381, 'San Fabian', 'Santa Maria', 150),
(1382, 'San Fabian', 'Santo Tomas', 190),
(1383, 'San Fabian', 'Sison', 130),
(1384, 'San Fabian', 'Sual', 190),
(1385, 'San Fabian', 'Tayug', 170),
(1386, 'San Fabian', 'Umingan', 210),
(1387, 'San Fabian', 'Urbiztondo', 160),
(1388, 'San Fabian', 'Villasis', 140),
(1389, 'San Fabian', 'Dagupan', -60),
(1390, 'San Fabian', 'Alaminos', -60),
(1391, 'San Fabian', 'San Carlos', -60),
(1392, 'San Fabian', 'Urdaneta', -60),
(1393, 'San Jacinto', 'Agno', 250),
(1394, 'San Jacinto', 'Aguilar', 170),
(1395, 'San Jacinto', 'Alcala', 140),
(1396, 'San Jacinto', 'Anda', 280),
(1397, 'San Jacinto', 'Asingan', 130),
(1398, 'San Jacinto', 'Balungao', 150),
(1399, 'San Jacinto', 'Bani', 230),
(1400, 'San Jacinto', 'Basista', 130),
(1401, 'San Jacinto', 'Bautista', 160),
(1402, 'San Jacinto', 'Bayambang', 150),
(1403, 'San Jacinto', 'Binalonan', 120),
(1404, 'San Jacinto', 'Binmaley', 110),
(1405, 'San Jacinto', 'Bolinao', 280),
(1406, 'San Jacinto', 'Bugallon', 140),
(1407, 'San Jacinto', 'Burgos', 240),
(1408, 'San Jacinto', 'Calasiao', 110),
(1409, 'San Jacinto', 'Dasol', 260),
(1410, 'San Jacinto', 'Infanta', 300),
(1411, 'San Jacinto', 'Labrador', 140),
(1412, 'San Jacinto', 'Laoac', 110),
(1413, 'San Jacinto', 'Lingayen', 120),
(1414, 'San Jacinto', 'Mabini', 220),
(1415, 'San Jacinto', 'Malasiqui', 120),
(1416, 'San Jacinto', 'Manaoag', 80),
(1417, 'San Jacinto', 'Mangaldan', 80),
(1418, 'San Jacinto', 'Mangatarem', 160),
(1419, 'San Jacinto', 'Mapandan', 80),
(1420, 'San Jacinto', 'Natividad', 170),
(1421, 'San Jacinto', 'Pozorrubio', 90),
(1422, 'San Jacinto', 'Rosales', 130),
(1423, 'San Jacinto', 'San Fabian', 90),
(1424, 'San Jacinto', 'San Jacinto', 60),
(1425, 'San Jacinto', 'San Manuel', 130),
(1426, 'San Jacinto', 'San Nicolas', 180),
(1427, 'San Jacinto', 'San Quintin', 180),
(1428, 'San Jacinto', 'Santa Barbara', 100),
(1429, 'San Jacinto', 'Santa Maria', 140),
(1430, 'San Jacinto', 'Santo Tomas', 190),
(1431, 'San Jacinto', 'Sison', 100),
(1432, 'San Jacinto', 'Sual', 180),
(1433, 'San Jacinto', 'Tayug', 150),
(1434, 'San Jacinto', 'Umingan', 190),
(1435, 'San Jacinto', 'Urbiztondo', 140),
(1436, 'San Jacinto', 'Villasis', 120),
(1437, 'San Jacinto', 'Dagupan', 90),
(1438, 'San Jacinto', 'Alaminos', 200),
(1439, 'San Jacinto', 'San Carlos', 130),
(1440, 'San Jacinto', 'Urdaneta', 100),
(1441, 'San Manuel', 'Agno', 300),
(1442, 'San Manuel', 'Aguilar', 240),
(1443, 'San Manuel', 'Alcala', 140),
(1444, 'San Manuel', 'Anda', 340),
(1445, 'San Manuel', 'Asingan', 90),
(1446, 'San Manuel', 'Balungao', 130),
(1447, 'San Manuel', 'Bani', 300),
(1448, 'San Manuel', 'Basista', 180),
(1449, 'San Manuel', 'Bautista', 160),
(1450, 'San Manuel', 'Bayambang', 180),
(1451, 'San Manuel', 'Binalonan', 90),
(1452, 'San Manuel', 'Binmaley', 180),
(1453, 'San Manuel', 'Bolinao', 340),
(1454, 'San Manuel', 'Bugallon', 90),
(1455, 'San Manuel', 'Burgos', 300),
(1456, 'San Manuel', 'Calasiao', 160),
(1457, 'San Manuel', 'Dasol', 340),
(1458, 'San Manuel', 'Infanta', 380),
(1459, 'San Manuel', 'Labrador', 220),
(1460, 'San Manuel', 'Laoac', 100),
(1461, 'San Manuel', 'Lingayen', 180),
(1462, 'San Manuel', 'Mabini', 300),
(1463, 'San Manuel', 'Malasiqui', 180),
(1464, 'San Manuel', 'Manaoag', 110),
(1465, 'San Manuel', 'Mangaldan', 140),
(1466, 'San Manuel', 'Mangatarem', 260),
(1467, 'San Manuel', 'Mapandan', 120),
(1468, 'San Manuel', 'Natividad', 130),
(1469, 'San Manuel', 'Pozorrubio', 110),
(1470, 'San Manuel', 'Rosales', 120),
(1471, 'San Manuel', 'San Fabian', 160),
(1472, 'San Manuel', 'San Jacinto', 130),
(1473, 'San Manuel', 'San Manuel', 60),
(1474, 'San Manuel', 'San Nicolas', 130),
(1475, 'San Manuel', 'San Quintin', 130),
(1476, 'San Manuel', 'Santa Barbara', 140),
(1477, 'San Manuel', 'Santa Maria', 110),
(1478, 'San Manuel', 'Santo Tomas', 180),
(1479, 'San Manuel', 'Sison', 120),
(1480, 'San Manuel', 'Sual', 240),
(1481, 'San Manuel', 'Tayug', 120),
(1482, 'San Manuel', 'Umingan', 140);
INSERT INTO `shipping_fee_table_matrix` (`id`, `customer_address`, `shop_address`, `shipping_fee`) VALUES
(1483, 'San Manuel', 'Urbiztondo', 180),
(1484, 'San Manuel', 'Villasis', 120),
(1485, 'San Manuel', 'Dagupan', 150),
(1486, 'San Manuel', 'Alaminos', 260),
(1487, 'San Manuel', 'San Carlos', 170),
(1488, 'San Manuel', 'Urdaneta', 110),
(1489, 'San Nicolas', 'Agno', 340),
(1490, 'San Nicolas', 'Aguilar', 260),
(1491, 'San Nicolas', 'Alcala', 140),
(1492, 'San Nicolas', 'Anda', 360),
(1493, 'San Nicolas', 'Asingan', 120),
(1494, 'San Nicolas', 'Balungao', 120),
(1495, 'San Nicolas', 'Bani', 320),
(1496, 'San Nicolas', 'Basista', 200),
(1497, 'San Nicolas', 'Bautista', 180),
(1498, 'San Nicolas', 'Bayambang', 180),
(1499, 'San Nicolas', 'Binalonan', 140),
(1500, 'San Nicolas', 'Binmaley', 200),
(1501, 'San Nicolas', 'Bolinao', 360),
(1502, 'San Nicolas', 'Bugallon', 240),
(1503, 'San Nicolas', 'Burgos', 340),
(1504, 'San Nicolas', 'Calasiao', 200),
(1505, 'San Nicolas', 'Dasol', 360),
(1506, 'San Nicolas', 'Infanta', 400),
(1507, 'San Nicolas', 'Labrador', 240),
(1508, 'San Nicolas', 'Laoac', 140),
(1509, 'San Nicolas', 'Lingayen', 220),
(1510, 'San Nicolas', 'Mabini', 320),
(1511, 'San Nicolas', 'Malasiqui', 180),
(1512, 'San Nicolas', 'Manaoag', 160),
(1513, 'San Nicolas', 'Mangaldan', 180),
(1514, 'San Nicolas', 'Mangatarem', 260),
(1515, 'San Nicolas', 'Mapandan', 160),
(1516, 'San Nicolas', 'Natividad', 110),
(1517, 'San Nicolas', 'Pozorrubio', 150),
(1518, 'San Nicolas', 'Rosales', 120),
(1519, 'San Nicolas', 'San Fabian', 190),
(1520, 'San Nicolas', 'San Jacinto', 170),
(1521, 'San Nicolas', 'San Manuel', 130),
(1522, 'San Nicolas', 'San Nicolas', 60),
(1523, 'San Nicolas', 'San Quintin', 110),
(1524, 'San Nicolas', 'Santa Barbara', 180),
(1525, 'San Nicolas', 'Santa Maria', 100),
(1526, 'San Nicolas', 'Santo Tomas', 180),
(1527, 'San Nicolas', 'Sison', 160),
(1528, 'San Nicolas', 'Sual', 260),
(1529, 'San Nicolas', 'Tayug', 110),
(1530, 'San Nicolas', 'Umingan', 120),
(1531, 'San Nicolas', 'Urbiztondo', 200),
(1532, 'San Nicolas', 'Villasis', 140),
(1533, 'San Nicolas', 'Dagupan', 200),
(1534, 'San Nicolas', 'Alaminos', 300),
(1535, 'San Nicolas', 'San Carlos', 200),
(1536, 'San Nicolas', 'Urdaneta', 160),
(1537, 'San Quintin', 'Agno', 340),
(1538, 'San Quintin', 'Aguilar', 260),
(1539, 'San Quintin', 'Alcala', 140),
(1540, 'San Quintin', 'Anda', 380),
(1541, 'San Quintin', 'Asingan', 120),
(1542, 'San Quintin', 'Balungao', 130),
(1543, 'San Quintin', 'Bani', 340),
(1544, 'San Quintin', 'Basista', 180),
(1545, 'San Quintin', 'Bautista', 160),
(1546, 'San Quintin', 'Bayambang', 180),
(1547, 'San Quintin', 'Binalonan', 140),
(1548, 'San Quintin', 'Binmaley', 200),
(1549, 'San Quintin', 'Bolinao', 360),
(1550, 'San Quintin', 'Bugallon', 240),
(1551, 'San Quintin', 'Burgos', 340),
(1552, 'San Quintin', 'Calasiao', 200),
(1553, 'San Quintin', 'Dasol', 360),
(1554, 'San Quintin', 'Infanta', 400),
(1555, 'San Quintin', 'Labrador', 240),
(1556, 'San Quintin', 'Laoac', 140),
(1557, 'San Quintin', 'Lingayen', 220),
(1558, 'San Quintin', 'Mabini', 320),
(1559, 'San Quintin', 'Malasiqui', 150),
(1560, 'San Quintin', 'Manaoag', 160),
(1561, 'San Quintin', 'Mangaldan', 180),
(1562, 'San Quintin', 'Mangatarem', 240),
(1563, 'San Quintin', 'Mapandan', 160),
(1564, 'San Quintin', 'Natividad', 90),
(1565, 'San Quintin', 'Pozorrubio', 160),
(1566, 'San Quintin', 'Rosales', 120),
(1567, 'San Quintin', 'San Fabian', 190),
(1568, 'San Quintin', 'San Jacinto', 170),
(1569, 'San Quintin', 'San Manuel', 160),
(1570, 'San Quintin', 'San Nicolas', 110),
(1571, 'San Quintin', 'San Quintin', 60),
(1572, 'San Quintin', 'Santa Barbara', 180),
(1573, 'San Quintin', 'Santa Maria', 100),
(1574, 'San Quintin', 'Santo Tomas', 180),
(1575, 'San Quintin', 'Sison', 160),
(1576, 'San Quintin', 'Sual', 270),
(1577, 'San Quintin', 'Tayug', 90),
(1578, 'San Quintin', 'Umingan', 80),
(1579, 'San Quintin', 'Urbiztondo', 200),
(1580, 'San Quintin', 'Villasis', 160),
(1581, 'San Quintin', 'Dagupan', 200),
(1582, 'San Quintin', 'Alaminos', 300),
(1583, 'San Quintin', 'San Carlos', 200),
(1584, 'San Quintin', 'Urdaneta', 140),
(1585, 'Santa Barbara', 'Agno', 240),
(1586, 'Santa Barbara', 'Aguilar', 160),
(1587, 'Santa Barbara', 'Alcala', 140),
(1588, 'Santa Barbara', 'Anda', 260),
(1589, 'Santa Barbara', 'Asingan', 120),
(1590, 'Santa Barbara', 'Balungao', 160),
(1591, 'Santa Barbara', 'Bani', 230),
(1592, 'Santa Barbara', 'Basista', 110),
(1593, 'Santa Barbara', 'Bautista', 140),
(1594, 'Santa Barbara', 'Bayambang', 120),
(1595, 'Santa Barbara', 'Binalonan', 130),
(1596, 'Santa Barbara', 'Binmaley', 100),
(1597, 'Santa Barbara', 'Bolinao', 260),
(1598, 'Santa Barbara', 'Bugallon', 140),
(1599, 'Santa Barbara', 'Burgos', 240),
(1600, 'Santa Barbara', 'Calasiao', 100),
(1601, 'Santa Barbara', 'Dasol', 260),
(1602, 'Santa Barbara', 'Infanta', 300),
(1603, 'Santa Barbara', 'Labrador', 140),
(1604, 'Santa Barbara', 'Laoac', 110),
(1605, 'Santa Barbara', 'Lingayen', 110),
(1606, 'Santa Barbara', 'Mabini', 220),
(1607, 'Santa Barbara', 'Malasiqui', 90),
(1608, 'Santa Barbara', 'Manaoag', 100),
(1609, 'Santa Barbara', 'Mangaldan', 90),
(1610, 'Santa Barbara', 'Mangatarem', 150),
(1611, 'Santa Barbara', 'Mapandan', 90),
(1612, 'Santa Barbara', 'Natividad', 160),
(1613, 'Santa Barbara', 'Pozorrubio', 120),
(1614, 'Santa Barbara', 'Rosales', 140),
(1615, 'Santa Barbara', 'San Fabian', 120),
(1616, 'Santa Barbara', 'San Jacinto', 100),
(1617, 'Santa Barbara', 'San Manuel', 140),
(1618, 'Santa Barbara', 'San Nicolas', 160),
(1619, 'Santa Barbara', 'San Quintin', 180),
(1620, 'Santa Barbara', 'Santa Barbara', 60),
(1621, 'Santa Barbara', 'Santa Maria', 130),
(1622, 'Santa Barbara', 'Santo Tomas', 180),
(1623, 'Santa Barbara', 'Sison', 150),
(1624, 'Santa Barbara', 'Sual', 170),
(1625, 'Santa Barbara', 'Tayug', 140),
(1626, 'Santa Barbara', 'Umingan', 200),
(1627, 'Santa Barbara', 'Urbiztondo', 120),
(1628, 'Santa Barbara', 'Villasis', 110),
(1629, 'Santa Barbara', 'Dagupan', 100),
(1630, 'Santa Barbara', 'Alaminos', 190),
(1631, 'Santa Barbara', 'San Carlos', 100),
(1632, 'Santa Barbara', 'Urdaneta', 100),
(1633, 'Santa Maria', 'Agno', 310),
(1634, 'Santa Maria', 'Aguilar', 220),
(1635, 'Santa Maria', 'Alcala', 120),
(1636, 'Santa Maria', 'Anda', 340),
(1637, 'Santa Maria', 'Asingan', 80),
(1638, 'Santa Maria', 'Balungao', 90),
(1639, 'Santa Maria', 'Bani', 290),
(1640, 'Santa Maria', 'Basista', 160),
(1641, 'Santa Maria', 'Bautista', 130),
(1642, 'Santa Maria', 'Bayambang', 140),
(1643, 'Santa Maria', 'Binalonan', 100),
(1644, 'Santa Maria', 'Binmaley', 160),
(1645, 'Santa Maria', 'Bolinao', 320),
(1646, 'Santa Maria', 'Bugallon', 200),
(1647, 'Santa Maria', 'Burgos', 300),
(1648, 'Santa Maria', 'Calasiao', 160),
(1649, 'Santa Maria', 'Dasol', 320),
(1650, 'Santa Maria', 'Infanta', 360),
(1651, 'Santa Maria', 'Labrador', 200),
(1652, 'Santa Maria', 'Laoac', 110),
(1653, 'Santa Maria', 'Lingayen', 180),
(1654, 'Santa Maria', 'Mabini', 280),
(1655, 'Santa Maria', 'Malasiqui', 130),
(1656, 'Santa Maria', 'Manaoag', 120),
(1657, 'Santa Maria', 'Mangaldan', 140),
(1658, 'Santa Maria', 'Mangatarem', 220),
(1659, 'Santa Maria', 'Mapandan', 130),
(1660, 'Santa Maria', 'Natividad', 100),
(1661, 'Santa Maria', 'Pozorrubio', 130),
(1662, 'Santa Maria', 'Rosales', 90),
(1663, 'Santa Maria', 'San Fabian', 150),
(1664, 'Santa Maria', 'San Jacinto', 130),
(1665, 'Santa Maria', 'San Manuel', 90),
(1666, 'Santa Maria', 'San Nicolas', 80),
(1667, 'Santa Maria', 'San Quintin', 120),
(1668, 'Santa Maria', 'Santa Barbara', 130),
(1669, 'Santa Maria', 'Santa Maria', 60),
(1670, 'Santa Maria', 'Santo Tomas', 140),
(1671, 'Santa Maria', 'Sison', 130),
(1672, 'Santa Maria', 'Sual', 240),
(1673, 'Santa Maria', 'Tayug', 80),
(1674, 'Santa Maria', 'Umingan', 130),
(1675, 'Santa Maria', 'Urbiztondo', 170),
(1676, 'Santa Maria', 'Villasis', 100),
(1677, 'Santa Maria', 'Dagupan', 160),
(1678, 'Santa Maria', 'Alaminos', 260),
(1679, 'Santa Maria', 'San Carlos', 160),
(1680, 'Santa Maria', 'Urdaneta', 100),
(1681, 'Santo Tomas', 'Agno', 320),
(1682, 'Santo Tomas', 'Aguilar', 180),
(1683, 'Santo Tomas', 'Alcala', 100),
(1684, 'Santo Tomas', 'Anda', 340),
(1685, 'Santo Tomas', 'Asingan', 160),
(1686, 'Santo Tomas', 'Balungao', 140),
(1687, 'Santo Tomas', 'Bani', 360),
(1688, 'Santo Tomas', 'Basista', 160),
(1689, 'Santo Tomas', 'Bautista', 120),
(1690, 'Santo Tomas', 'Bayambang', 132),
(1691, 'Santo Tomas', 'Binalonan', 160),
(1692, 'Santo Tomas', 'Binmaley', 190),
(1693, 'Santo Tomas', 'Bolinao', 340),
(1694, 'Santo Tomas', 'Bugallon', 190),
(1695, 'Santo Tomas', 'Burgos', 300),
(1696, 'Santo Tomas', 'Calasiao', 180),
(1697, 'Santo Tomas', 'Dasol', 320),
(1698, 'Santo Tomas', 'Infanta', 360),
(1699, 'Santo Tomas', 'Labrador', 200),
(1700, 'Santo Tomas', 'Laoac', 160),
(1701, 'Santo Tomas', 'Lingayen', 200),
(1702, 'Santo Tomas', 'Mabini', 300),
(1703, 'Santo Tomas', 'Malasiqui', 150),
(1704, 'Santo Tomas', 'Manaoag', 170),
(1705, 'Santo Tomas', 'Mangaldan', 150),
(1706, 'Santo Tomas', 'Mangatarem', 140),
(1707, 'Santo Tomas', 'Mapandan', 180),
(1708, 'Santo Tomas', 'Natividad', 180),
(1709, 'Santo Tomas', 'Pozorrubio', 170),
(1710, 'Santo Tomas', 'Rosales', 120),
(1711, 'Santo Tomas', 'San Fabian', 200),
(1712, 'Santo Tomas', 'San Jacinto', 180),
(1713, 'Santo Tomas', 'San Manuel', 180),
(1714, 'Santo Tomas', 'San Nicolas', 180),
(1715, 'Santo Tomas', 'San Quintin', 180),
(1716, 'Santo Tomas', 'Santa Barbara', 180),
(1717, 'Santo Tomas', 'Santa Maria', 140),
(1718, 'Santo Tomas', 'Santo Tomas', 60),
(1719, 'Santo Tomas', 'Sison', 60),
(1720, 'Santo Tomas', 'Sual', 240),
(1721, 'Santo Tomas', 'Tayug', 150),
(1722, 'Santo Tomas', 'Umingan', 170),
(1723, 'Santo Tomas', 'Urbiztondo', 160),
(1724, 'Santo Tomas', 'Villasis', 110),
(1725, 'Santo Tomas', 'Dagupan', 210),
(1726, 'Santo Tomas', 'Alaminos', 260),
(1727, 'Santo Tomas', 'San Carlos', 170),
(1728, 'Santo Tomas', 'Urdaneta', 150),
(1729, 'Sison', 'Agno', 280),
(1730, 'Sison', 'Aguilar', 300),
(1731, 'Sison', 'Alcala', 160),
(1732, 'Sison', 'Anda', 310),
(1733, 'Sison', 'Asingan', 110),
(1734, 'Sison', 'Balungao', 160),
(1735, 'Sison', 'Bani', 270),
(1736, 'Sison', 'Basista', 160),
(1737, 'Sison', 'Bautista', 170),
(1738, 'Sison', 'Bayambang', 190),
(1739, 'Sison', 'Binalonan', 110),
(1740, 'Sison', 'Binmaley', 140),
(1741, 'Sison', 'Bolinao', 300),
(1742, 'Sison', 'Bugallon', 180),
(1743, 'Sison', 'Burgos', 270),
(1744, 'Sison', 'Calasiao', 140),
(1745, 'Sison', 'Dasol', 300),
(1746, 'Sison', 'Infanta', 340),
(1747, 'Sison', 'Labrador', 180),
(1748, 'Sison', 'Laoac', 100),
(1749, 'Sison', 'Lingayen', 150),
(1750, 'Sison', 'Mabini', 260),
(1751, 'Sison', 'Malasiqui', 150),
(1752, 'Sison', 'Manaoag', 110),
(1753, 'Sison', 'Mangaldan', 110),
(1754, 'Sison', 'Mangatarem', 240),
(1755, 'Sison', 'Mapandan', 110),
(1756, 'Sison', 'Natividad', 160),
(1757, 'Sison', 'Pozorrubio', 80),
(1758, 'Sison', 'Rosales', 140),
(1759, 'Sison', 'San Fabian', 130),
(1760, 'Sison', 'San Jacinto', 100),
(1761, 'Sison', 'San Manuel', 120),
(1762, 'Sison', 'San Nicolas', 160),
(1763, 'Sison', 'San Quintin', 200),
(1764, 'Sison', 'Santa Barbara', 140),
(1765, 'Sison', 'Santa Maria', 120),
(1766, 'Sison', 'Santo Tomas', 180),
(1767, 'Sison', 'Sison', 60),
(1768, 'Sison', 'Sual', 200),
(1769, 'Sison', 'Tayug', 140),
(1770, 'Sison', 'Umingan', 180),
(1771, 'Sison', 'Urbiztondo', 210),
(1772, 'Sison', 'Villasis', 120),
(1773, 'Sison', 'Dagupan', 140),
(1774, 'Sison', 'Alaminos', 240),
(1775, 'Sison', 'San Carlos', 180),
(1776, 'Sison', 'Urdaneta', 110),
(1777, 'Sual', 'Agno', 140),
(1778, 'Sual', 'Aguilar', 160),
(1779, 'Sual', 'Alcala', 220),
(1780, 'Sual', 'Anda', 170),
(1781, 'Sual', 'Asingan', 220),
(1782, 'Sual', 'Balungao', 240),
(1783, 'Sual', 'Bani', 130),
(1784, 'Sual', 'Basista', 170),
(1785, 'Sual', 'Bautista', 220),
(1786, 'Sual', 'Bayambang', 200),
(1787, 'Sual', 'Binalonan', 230),
(1788, 'Sual', 'Binmaley', 120),
(1789, 'Sual', 'Bolinao', 160),
(1790, 'Sual', 'Bugallon', 120),
(1791, 'Sual', 'Burgos', 130),
(1792, 'Sual', 'Calasiao', 160),
(1793, 'Sual', 'Dasol', 160),
(1794, 'Sual', 'Infanta', 200),
(1795, 'Sual', 'Labrador', 100),
(1796, 'Sual', 'Laoac', 200),
(1797, 'Sual', 'Lingayen', 120),
(1798, 'Sual', 'Mabini', 120),
(1799, 'Sual', 'Malasiqui', 180),
(1800, 'Sual', 'Manaoag', 190),
(1801, 'Sual', 'Mangaldan', 160),
(1802, 'Sual', 'Mangatarem', 170),
(1803, 'Sual', 'Mapandan', 180),
(1804, 'Sual', 'Natividad', 270),
(1805, 'Sual', 'Pozorrubio', 200),
(1806, 'Sual', 'Rosales', 220),
(1807, 'Sual', 'San Fabian', 180),
(1808, 'Sual', 'San Jacinto', 180),
(1809, 'Sual', 'San Manuel', 240),
(1810, 'Sual', 'San Nicolas', 270),
(1811, 'Sual', 'San Quintin', 280),
(1812, 'Sual', 'Santa Barbara', 180),
(1813, 'Sual', 'Santa Maria', 240),
(1814, 'Sual', 'Santo Tomas', 240),
(1815, 'Sual', 'Sison', 220),
(1816, 'Sual', 'Sual', 60),
(1817, 'Sual', 'Tayug', 240),
(1818, 'Sual', 'Umingan', 280),
(1819, 'Sual', 'Urbiztondo', 180),
(1820, 'Sual', 'Villasis', 210),
(1821, 'Sual', 'Dagupan', 140),
(1822, 'Sual', 'Alaminos', 90),
(1823, 'Sual', 'San Carlos', 160),
(1824, 'Sual', 'Urdaneta', 200),
(1825, 'Tayug', 'Agno', 320),
(1826, 'Tayug', 'Aguilar', 160),
(1827, 'Tayug', 'Alcala', 260),
(1828, 'Tayug', 'Anda', 340),
(1829, 'Tayug', 'Asingan', 90),
(1830, 'Tayug', 'Balungao', 100),
(1831, 'Tayug', 'Bani', 300),
(1832, 'Tayug', 'Basista', 160),
(1833, 'Tayug', 'Bautista', 140),
(1834, 'Tayug', 'Bayambang', 150),
(1835, 'Tayug', 'Binalonan', 110),
(1836, 'Tayug', 'Binmaley', 180),
(1837, 'Tayug', 'Bolinao', 340),
(1838, 'Tayug', 'Bugallon', 240),
(1839, 'Tayug', 'Burgos', 310),
(1840, 'Tayug', 'Calasiao', 180),
(1841, 'Tayug', 'Dasol', 340),
(1842, 'Tayug', 'Infanta', 360),
(1843, 'Tayug', 'Labrador', 210),
(1844, 'Tayug', 'Laoac', 120),
(1845, 'Tayug', 'Lingayen', 190),
(1846, 'Tayug', 'Mabini', 300),
(1847, 'Tayug', 'Malasiqui', 140),
(1848, 'Tayug', 'Manaoag', 140),
(1849, 'Tayug', 'Mangaldan', 160),
(1850, 'Tayug', 'Mangatarem', 230),
(1851, 'Tayug', 'Mapandan', 140),
(1852, 'Tayug', 'Natividad', 90),
(1853, 'Tayug', 'Pozorrubio', 130),
(1854, 'Tayug', 'Rosales', 100),
(1855, 'Tayug', 'San Fabian', 160),
(1856, 'Tayug', 'San Jacinto', 140),
(1857, 'Tayug', 'San Manuel', 110),
(1858, 'Tayug', 'San Nicolas', 110),
(1859, 'Tayug', 'San Quintin', 110),
(1860, 'Tayug', 'Santa Barbara', 140),
(1861, 'Tayug', 'Santa Maria', 90),
(1862, 'Tayug', 'Santo Tomas', 160),
(1863, 'Tayug', 'Sison', 140),
(1864, 'Tayug', 'Sual', 240),
(1865, 'Tayug', 'Tayug', 60),
(1866, 'Tayug', 'Umingan', 100),
(1867, 'Tayug', 'Urbiztondo', 180),
(1868, 'Tayug', 'Villasis', 110),
(1869, 'Tayug', 'Dagupan', 170),
(1870, 'Tayug', 'Alaminos', 260),
(1871, 'Tayug', 'San Carlos', 180),
(1872, 'Tayug', 'Urdaneta', 110),
(1873, 'Umingan', 'Agno', 350),
(1874, 'Umingan', 'Aguilar', 240),
(1875, 'Umingan', 'Alcala', 140),
(1876, 'Umingan', 'Anda', 380),
(1877, 'Umingan', 'Asingan', 130),
(1878, 'Umingan', 'Balungao', 110),
(1879, 'Umingan', 'Bani', 320),
(1880, 'Umingan', 'Basista', 180),
(1881, 'Umingan', 'Bautista', 160),
(1882, 'Umingan', 'Bayambang', 160),
(1883, 'Umingan', 'Binalonan', 160),
(1884, 'Umingan', 'Binmaley', 200),
(1885, 'Umingan', 'Bolinao', 360),
(1886, 'Umingan', 'Bugallon', 260),
(1887, 'Umingan', 'Burgos', 340),
(1888, 'Umingan', 'Calasiao', 190),
(1889, 'Umingan', 'Dasol', 360),
(1890, 'Umingan', 'Infanta', 400),
(1891, 'Umingan', 'Labrador', 240),
(1892, 'Umingan', 'Laoac', 180),
(1893, 'Umingan', 'Lingayen', 220),
(1894, 'Umingan', 'Mabini', 340),
(1895, 'Umingan', 'Malasiqui', 160),
(1896, 'Umingan', 'Manaoag', 180),
(1897, 'Umingan', 'Mangaldan', 200),
(1898, 'Umingan', 'Mangatarem', 220),
(1899, 'Umingan', 'Mapandan', 200),
(1900, 'Umingan', 'Natividad', 100),
(1901, 'Umingan', 'Pozorrubio', 190),
(1902, 'Umingan', 'Rosales', 120),
(1903, 'Umingan', 'San Fabian', 220),
(1904, 'Umingan', 'San Jacinto', 200),
(1905, 'Umingan', 'San Manuel', 150),
(1906, 'Umingan', 'San Nicolas', 120),
(1907, 'Umingan', 'San Quintin', 84),
(1908, 'Umingan', 'Santa Barbara', 200),
(1909, 'Umingan', 'Santa Maria', 110),
(1910, 'Umingan', 'Santo Tomas', 190),
(1911, 'Umingan', 'Sison', 190),
(1912, 'Umingan', 'Sual', 280),
(1913, 'Umingan', 'Tayug', 100),
(1914, 'Umingan', 'Umingan', 60),
(1915, 'Umingan', 'Urbiztondo', 200),
(1916, 'Umingan', 'Villasis', 130),
(1917, 'Umingan', 'Dagupan', 200),
(1918, 'Umingan', 'Alaminos', 300),
(1919, 'Umingan', 'San Carlos', 200),
(1920, 'Umingan', 'Urdaneta', 150),
(1921, 'Urbiztondo', 'Agno', 260),
(1922, 'Urbiztondo', 'Aguilar', 120),
(1923, 'Urbiztondo', 'Alcala', 120),
(1924, 'Urbiztondo', 'Anda', 280),
(1925, 'Urbiztondo', 'Asingan', 180),
(1926, 'Urbiztondo', 'Balungao', 160),
(1927, 'Urbiztondo', 'Bani', 240),
(1928, 'Urbiztondo', 'Basista', 90),
(1929, 'Urbiztondo', 'Bautista', 120),
(1930, 'Urbiztondo', 'Bayambang', 90),
(1931, 'Urbiztondo', 'Binalonan', 180),
(1932, 'Urbiztondo', 'Binmaley', 110),
(1933, 'Urbiztondo', 'Bolinao', 260),
(1934, 'Urbiztondo', 'Bugallon', 120),
(1935, 'Urbiztondo', 'Burgos', 240),
(1936, 'Urbiztondo', 'Calasiao', 100),
(1937, 'Urbiztondo', 'Dasol', 300),
(1938, 'Urbiztondo', 'Infanta', 310),
(1939, 'Urbiztondo', 'Labrador', 140),
(1940, 'Urbiztondo', 'Laoac', 150),
(1941, 'Urbiztondo', 'Lingayen', 120),
(1942, 'Urbiztondo', 'Mabini', 220),
(1943, 'Urbiztondo', 'Malasiqui', 110),
(1944, 'Urbiztondo', 'Manaoag', 140),
(1945, 'Urbiztondo', 'Mangaldan', 130),
(1946, 'Urbiztondo', 'Mangatarem', 90),
(1947, 'Urbiztondo', 'Mapandan', 130),
(1948, 'Urbiztondo', 'Natividad', 200),
(1949, 'Urbiztondo', 'Pozorrubio', 160),
(1950, 'Urbiztondo', 'Rosales', 140),
(1951, 'Urbiztondo', 'San Fabian', 160),
(1952, 'Urbiztondo', 'San Jacinto', 140),
(1953, 'Urbiztondo', 'San Manuel', 190),
(1954, 'Urbiztondo', 'San Nicolas', 210),
(1955, 'Urbiztondo', 'San Quintin', 200),
(1956, 'Urbiztondo', 'Santa Barbara', 110),
(1957, 'Urbiztondo', 'Santa Maria', 170),
(1958, 'Urbiztondo', 'Santo Tomas', 160),
(1959, 'Urbiztondo', 'Sison', 210),
(1960, 'Urbiztondo', 'Sual', 180),
(1961, 'Urbiztondo', 'Tayug', 180),
(1962, 'Urbiztondo', 'Umingan', 200),
(1963, 'Urbiztondo', 'Urbiztondo', 60),
(1964, 'Urbiztondo', 'Villasis', 140),
(1965, 'Urbiztondo', 'Dagupan', 120),
(1966, 'Urbiztondo', 'Alaminos', 200),
(1967, 'Urbiztondo', 'San Carlos', 80),
(1968, 'Urbiztondo', 'Urdaneta', 140),
(1969, 'Villasis', 'Agno', 290),
(1970, 'Villasis', 'Aguilar', 190),
(1971, 'Villasis', 'Alcala', 80),
(1972, 'Villasis', 'Anda', 310),
(1973, 'Villasis', 'Asingan', 100),
(1974, 'Villasis', 'Balungao', 90),
(1975, 'Villasis', 'Bani', 270),
(1976, 'Villasis', 'Basista', 120),
(1977, 'Villasis', 'Bautista', 100),
(1978, 'Villasis', 'Bayambang', 140),
(1979, 'Villasis', 'Binalonan', 110),
(1980, 'Villasis', 'Binmaley', 140),
(1981, 'Villasis', 'Bolinao', 260),
(1982, 'Villasis', 'Bugallon', 180),
(1983, 'Villasis', 'Burgos', 270),
(1984, 'Villasis', 'Calasiao', 120),
(1985, 'Villasis', 'Dasol', 300),
(1986, 'Villasis', 'Infanta', 340),
(1987, 'Villasis', 'Labrador', 180),
(1988, 'Villasis', 'Laoac', 100),
(1989, 'Villasis', 'Lingayen', 160),
(1990, 'Villasis', 'Mabini', 260),
(1991, 'Villasis', 'Malasiqui', 90),
(1992, 'Villasis', 'Manaoag', 110),
(1993, 'Villasis', 'Mangaldan', 130),
(1994, 'Villasis', 'Mangatarem', 170),
(1995, 'Villasis', 'Mapandan', 110),
(1996, 'Villasis', 'Natividad', 130),
(1997, 'Villasis', 'Pozorrubio', 140),
(1998, 'Villasis', 'Rosales', 80),
(1999, 'Villasis', 'San Fabian', 140),
(2000, 'Villasis', 'San Jacinto', 120),
(2001, 'Villasis', 'San Manuel', 120),
(2002, 'Villasis', 'San Nicolas', 140),
(2003, 'Villasis', 'San Quintin', 140),
(2004, 'Villasis', 'Santa Barbara', 120),
(2005, 'Villasis', 'Santa Maria', 100),
(2006, 'Villasis', 'Santo Tomas', 130),
(2007, 'Villasis', 'Sison', 140),
(2008, 'Villasis', 'Sual', 210),
(2009, 'Villasis', 'Tayug', 130),
(2010, 'Villasis', 'Umingan', 130),
(2011, 'Villasis', 'Urbiztondo', 140),
(2012, 'Villasis', 'Villasis', 60),
(2013, 'Villasis', 'Dagupan', 140),
(2014, 'Villasis', 'Alaminos', 240),
(2015, 'Villasis', 'San Carlos', 130),
(2016, 'Villasis', 'Urdaneta', 80),
(2017, 'Dagupan', 'Agno', 220),
(2018, 'Dagupan', 'Aguilar', 140),
(2019, 'Dagupan', 'Alcala', 160),
(2020, 'Dagupan', 'Anda', 240),
(2021, 'Dagupan', 'Asingan', 140),
(2022, 'Dagupan', 'Balungao', 160),
(2023, 'Dagupan', 'Bani', 210),
(2024, 'Dagupan', 'Basista', 120),
(2025, 'Dagupan', 'Bautista', 160),
(2026, 'Dagupan', 'Bayambang', 140),
(2027, 'Dagupan', 'Binalonan', 140),
(2028, 'Dagupan', 'Binmaley', 80),
(2029, 'Dagupan', 'Bolinao', 240),
(2030, 'Dagupan', 'Bugallon', 120),
(2031, 'Dagupan', 'Burgos', 220),
(2032, 'Dagupan', 'Calasiao', 80),
(2033, 'Dagupan', 'Dasol', 240),
(2034, 'Dagupan', 'Infanta', 280),
(2035, 'Dagupan', 'Labrador', 110),
(2036, 'Dagupan', 'Laoac', 120),
(2037, 'Dagupan', 'Lingayen', 110),
(2038, 'Dagupan', 'Mabini', 200),
(2039, 'Dagupan', 'Malasiqui', 110),
(2040, 'Dagupan', 'Manaoag', 100),
(2041, 'Dagupan', 'Mangaldan', 80),
(2042, 'Dagupan', 'Mangatarem', 160),
(2043, 'Dagupan', 'Mapandan', 100),
(2044, 'Dagupan', 'Natividad', 200),
(2045, 'Dagupan', 'Pozorrubio', 110),
(2046, 'Dagupan', 'Rosales', 150),
(2047, 'Dagupan', 'San Fabian', 110),
(2048, 'Dagupan', 'San Jacinto', 90),
(2049, 'Dagupan', 'San Manuel', 150),
(2050, 'Dagupan', 'San Nicolas', 200),
(2051, 'Dagupan', 'San Quintin', 210),
(2052, 'Dagupan', 'Santa Barbara', 100),
(2053, 'Dagupan', 'Santa Maria', 160),
(2054, 'Dagupan', 'Santo Tomas', 210),
(2055, 'Dagupan', 'Sison', 140),
(2056, 'Dagupan', 'Sual', 140),
(2057, 'Dagupan', 'Tayug', 160),
(2058, 'Dagupan', 'Umingan', 200),
(2059, 'Dagupan', 'Urbiztondo', 120),
(2060, 'Dagupan', 'Villasis', 140),
(2061, 'Dagupan', 'Dagupan', 60),
(2062, 'Dagupan', 'Alaminos', 160),
(2063, 'Dagupan', 'San Carlos', 110),
(2064, 'Dagupan', 'Urdaneta', 120),
(2065, 'Alaminos', 'Agno', 120),
(2066, 'Alaminos', 'Aguilar', 170),
(2067, 'Alaminos', 'Alcala', 230),
(2068, 'Alaminos', 'Anda', 140),
(2069, 'Alaminos', 'Asingan', 240),
(2070, 'Alaminos', 'Balungao', 140),
(2071, 'Alaminos', 'Bani', 100),
(2072, 'Alaminos', 'Basista', 190),
(2073, 'Alaminos', 'Bautista', 250),
(2074, 'Alaminos', 'Bayambang', 220),
(2075, 'Alaminos', 'Binalonan', 240),
(2076, 'Alaminos', 'Binmaley', 150),
(2077, 'Alaminos', 'Bolinao', 130),
(2078, 'Alaminos', 'Bugallon', 150),
(2079, 'Alaminos', 'Burgos', 110),
(2080, 'Alaminos', 'Calasiao', 180),
(2081, 'Alaminos', 'Dasol', 140),
(2082, 'Alaminos', 'Infanta', 180),
(2083, 'Alaminos', 'Labrador', 110),
(2084, 'Alaminos', 'Laoac', 220),
(2085, 'Alaminos', 'Lingayen', 140),
(2086, 'Alaminos', 'Mabini', 100),
(2087, 'Alaminos', 'Malasiqui', 200),
(2088, 'Alaminos', 'Manaoag', 210),
(2089, 'Alaminos', 'Mangaldan', 180),
(2090, 'Alaminos', 'Mangatarem', 200),
(2091, 'Alaminos', 'Mapandan', 200),
(2092, 'Alaminos', 'Natividad', 300),
(2093, 'Alaminos', 'Pozorrubio', 220),
(2094, 'Alaminos', 'Rosales', 240),
(2095, 'Alaminos', 'San Fabian', 210),
(2096, 'Alaminos', 'San Jacinto', 200),
(2097, 'Alaminos', 'San Manuel', 260),
(2098, 'Alaminos', 'San Nicolas', 290),
(2099, 'Alaminos', 'San Quintin', 290),
(2100, 'Alaminos', 'Santa Barbara', 190),
(2101, 'Alaminos', 'Santa Maria', 270),
(2102, 'Alaminos', 'Santo Tomas', 260),
(2103, 'Alaminos', 'Sison', 220),
(2104, 'Alaminos', 'Sual', 110),
(2105, 'Alaminos', 'Tayug', 260),
(2106, 'Alaminos', 'Umingan', 300),
(2107, 'Alaminos', 'Urbiztondo', 200),
(2108, 'Alaminos', 'Villasis', 260),
(2109, 'Alaminos', 'Dagupan', 160),
(2110, 'Alaminos', 'Alaminos', 60),
(2111, 'Alaminos', 'San Carlos', 170),
(2112, 'Alaminos', 'Urdaneta', 220),
(2113, 'San Carlos', 'Agno', 260),
(2114, 'San Carlos', 'Aguilar', 110),
(2115, 'San Carlos', 'Alcala', 140),
(2116, 'San Carlos', 'Anda', 260),
(2117, 'San Carlos', 'Asingan', 150),
(2118, 'San Carlos', 'Balungao', 160),
(2119, 'San Carlos', 'Bani', 200),
(2120, 'San Carlos', 'Basista', 90),
(2121, 'San Carlos', 'Bautista', 140),
(2122, 'San Carlos', 'Bayambang', 100),
(2123, 'San Carlos', 'Binalonan', 160),
(2124, 'San Carlos', 'Binmaley', 100),
(2125, 'San Carlos', 'Bolinao', 240),
(2126, 'San Carlos', 'Bugallon', 140),
(2127, 'San Carlos', 'Burgos', 220),
(2128, 'San Carlos', 'Calasiao', 100),
(2129, 'San Carlos', 'Dasol', 240),
(2130, 'San Carlos', 'Infanta', 290),
(2131, 'San Carlos', 'Labrador', 120),
(2132, 'San Carlos', 'Laoac', 140),
(2133, 'San Carlos', 'Lingayen', 100),
(2134, 'San Carlos', 'Mabini', 210),
(2135, 'San Carlos', 'Malasiqui', 100),
(2136, 'San Carlos', 'Manaoag', 130),
(2137, 'San Carlos', 'Mangaldan', 120),
(2138, 'San Carlos', 'Mangatarem', 110),
(2139, 'San Carlos', 'Mapandan', 120),
(2140, 'San Carlos', 'Natividad', 200),
(2141, 'San Carlos', 'Pozorrubio', 150),
(2142, 'San Carlos', 'Rosales', 140),
(2143, 'San Carlos', 'San Fabian', 150),
(2144, 'San Carlos', 'San Jacinto', 130),
(2145, 'San Carlos', 'San Manuel', 150),
(2146, 'San Carlos', 'San Nicolas', 200),
(2147, 'San Carlos', 'San Quintin', 200),
(2148, 'San Carlos', 'Santa Barbara', 100),
(2149, 'San Carlos', 'Santa Maria', 160),
(2150, 'San Carlos', 'Santo Tomas', 180),
(2151, 'San Carlos', 'Sison', 170),
(2152, 'San Carlos', 'Sual', 160),
(2153, 'San Carlos', 'Tayug', 180),
(2154, 'San Carlos', 'Umingan', 190),
(2155, 'San Carlos', 'Urbiztondo', 80),
(2156, 'San Carlos', 'Villasis', 130),
(2157, 'San Carlos', 'Dagupan', 110),
(2158, 'San Carlos', 'Alaminos', 180),
(2159, 'San Carlos', 'San Carlos', 60),
(2160, 'San Carlos', 'Urdaneta', 130),
(2161, 'Urdaneta', 'Agno', 270),
(2162, 'Urdaneta', 'Aguilar', 190),
(2163, 'Urdaneta', 'Alcala', 100),
(2164, 'Urdaneta', 'Anda', 300),
(2165, 'Urdaneta', 'Asingan', 80),
(2166, 'Urdaneta', 'Balungao', 110),
(2167, 'Urdaneta', 'Bani', 260),
(2168, 'Urdaneta', 'Basista', 130),
(2169, 'Urdaneta', 'Bautista', 120),
(2170, 'Urdaneta', 'Bayambang', 130),
(2171, 'Urdaneta', 'Binalonan', 90),
(2172, 'Urdaneta', 'Binmaley', 130),
(2173, 'Urdaneta', 'Bolinao', 290),
(2174, 'Urdaneta', 'Bugallon', 170),
(2175, 'Urdaneta', 'Burgos', 260),
(2176, 'Urdaneta', 'Calasiao', 120),
(2177, 'Urdaneta', 'Dasol', 290),
(2178, 'Urdaneta', 'Infanta', 340),
(2179, 'Urdaneta', 'Labrador', 170),
(2180, 'Urdaneta', 'Laoac', 90),
(2181, 'Urdaneta', 'Lingayen', 140),
(2182, 'Urdaneta', 'Mabini', 260),
(2183, 'Urdaneta', 'Malasiqui', 110),
(2184, 'Urdaneta', 'Manaoag', 90),
(2185, 'Urdaneta', 'Mangaldan', 110),
(2186, 'Urdaneta', 'Mangatarem', 170),
(2187, 'Urdaneta', 'Mapandan', 90),
(2188, 'Urdaneta', 'Natividad', 150),
(2189, 'Urdaneta', 'Pozorrubio', 110),
(2190, 'Urdaneta', 'Rosales', 90),
(2191, 'Urdaneta', 'San Fabian', 130),
(2192, 'Urdaneta', 'San Jacinto', 100),
(2193, 'Urdaneta', 'San Manuel', 110),
(2194, 'Urdaneta', 'San Nicolas', 140),
(2195, 'Urdaneta', 'San Quintin', 140),
(2196, 'Urdaneta', 'Santa Barbara', 100),
(2197, 'Urdaneta', 'Santa Maria', 100),
(2198, 'Urdaneta', 'Santo Tomas', 130),
(2199, 'Urdaneta', 'Sison', 110),
(2200, 'Urdaneta', 'Sual', 200),
(2201, 'Urdaneta', 'Tayug', 110),
(2202, 'Urdaneta', 'Umingan', 150),
(2203, 'Urdaneta', 'Urbiztondo', 140),
(2204, 'Urdaneta', 'Villasis', 80),
(2205, 'Urdaneta', 'Dagupan', 120),
(2206, 'Urdaneta', 'Alaminos', 220),
(2207, 'Urdaneta', 'San Carlos', 130),
(2208, 'Urdaneta', 'Urdaneta', 60),
(2209, 'Laoac', 'Agno', 280),
(2210, 'Laoac', 'Aguilar', 200),
(2211, 'Laoac', 'Alcala', 140),
(2212, 'Laoac', 'Anda', 320),
(2213, 'Laoac', 'Asingan', 100),
(2214, 'Laoac', 'Balungao', 140),
(2215, 'Laoac', 'Bani', 260),
(2216, 'Laoac', 'Basista', 140),
(2217, 'Laoac', 'Bautista', 160),
(2218, 'Laoac', 'Bayambang', 170),
(2219, 'Laoac', 'Binalonan', 90),
(2220, 'Laoac', 'Binmaley', 130),
(2221, 'Laoac', 'Bolinao', 320),
(2222, 'Laoac', 'Bugallon', 180),
(2223, 'Laoac', 'Burgos', 260),
(2224, 'Laoac', 'Calasiao', 120),
(2225, 'Laoac', 'Dasol', 280),
(2226, 'Laoac', 'Infanta', 340),
(2227, 'Laoac', 'Labrador', 170),
(2228, 'Laoac', 'Laoac', 60),
(2229, 'Laoac', 'Lingayen', 140),
(2230, 'Laoac', 'Mabini', 260),
(2231, 'Laoac', 'Malasiqui', 120),
(2232, 'Laoac', 'Manaoag', 80),
(2233, 'Laoac', 'Mangaldan', 100),
(2234, 'Laoac', 'Mangatarem', 240),
(2235, 'Laoac', 'Mapandan', 90),
(2236, 'Laoac', 'Natividad', 140),
(2237, 'Laoac', 'Pozorrubio', 100),
(2238, 'Laoac', 'Rosales', 120),
(2239, 'Laoac', 'San Fabian', 120),
(2240, 'Laoac', 'San Jacinto', 100),
(2241, 'Laoac', 'San Manuel', 100),
(2242, 'Laoac', 'San Nicolas', 140),
(2243, 'Laoac', 'San Quintin', 140),
(2244, 'Laoac', 'Santa Barbara', 110),
(2245, 'Laoac', 'Santa Maria', 110),
(2246, 'Laoac', 'Santo Tomas', 160),
(2247, 'Laoac', 'Sison', 100),
(2248, 'Laoac', 'Sual', 200),
(2249, 'Laoac', 'Tayug', 120),
(2250, 'Laoac', 'Umingan', 180),
(2251, 'Laoac', 'Urbiztondo', 160),
(2252, 'Laoac', 'Villasis', 110),
(2253, 'Laoac', 'Dagupan', 120),
(2254, 'Laoac', 'Alaminos ', 220),
(2255, 'Laoac', 'Urdaneta', 90),
(2256, 'Laoac', 'San Carlos', 140),
(2257, 'Lingayen', 'Agno', 100),
(2258, 'Lingayen', 'Aguilar', 110),
(2259, 'Lingayen', 'Alcala', 160),
(2260, 'Lingayen', 'Anda', 220),
(2261, 'Lingayen', 'Asingan', 160),
(2262, 'Lingayen', 'Balungao', 200),
(2263, 'Lingayen', 'Bani', 180),
(2264, 'Lingayen', 'Basista', 120),
(2265, 'Lingayen', 'Bautista', 160),
(2266, 'Lingayen', 'Bayambang', 140),
(2267, 'Lingayen', 'Binalonan', 180),
(2268, 'Lingayen', 'Binmaley', 80),
(2269, 'Lingayen', 'Bolinao', 200),
(2270, 'Lingayen', 'Bugallon', 90),
(2271, 'Lingayen', 'Burgos', 180),
(2272, 'Lingayen', 'Calasiao', 100),
(2273, 'Lingayen', 'Dasol', 210),
(2274, 'Lingayen', 'Infanta', 270),
(2275, 'Lingayen', 'Labrador', 90),
(2276, 'Lingayen', 'Laoac', 140),
(2277, 'Lingayen', 'Lingayen', 60),
(2278, 'Lingayen', 'Mabini', 180),
(2279, 'Lingayen', 'Malasiqui', 120),
(2280, 'Lingayen', 'Manaoag', 130),
(2281, 'Lingayen', 'Mangaldan', 110),
(2282, 'Lingayen', 'Mangatarem', 130),
(2283, 'Lingayen', 'Mapandan', 120),
(2284, 'Lingayen', 'Natividad', 220),
(2285, 'Lingayen', 'Pozorrubio', 140),
(2286, 'Lingayen', 'Rosales', 160),
(2287, 'Lingayen', 'San Fabian', 140),
(2288, 'Lingayen', 'San Jacinto', 120),
(2289, 'Lingayen', 'San Manuel', 190),
(2290, 'Lingayen', 'San Nicolas', 220),
(2291, 'Lingayen', 'San Quintin', 220),
(2292, 'Lingayen', 'Santa Barbara', 120),
(2293, 'Lingayen', 'Santa Maria', 180),
(2294, 'Lingayen', 'Santo Tomas', 200),
(2295, 'Lingayen', 'Sison', 160),
(2296, 'Lingayen', 'Sual', 120),
(2297, 'Lingayen', 'Tayug', 190),
(2298, 'Lingayen', 'Umingan', 240),
(2299, 'Lingayen', 'Urbiztondo', 120),
(2300, 'Lingayen', 'Villasis', 160),
(2301, 'Lingayen', 'Dagupan', 90),
(2302, 'Lingayen', 'Alaminos ', 140),
(2303, 'Lingayen', 'Urdaneta', 140),
(2304, 'Lingayen', 'San Carlos', 100);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_approved` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rating` double(8,2) DEFAULT NULL,
  `shop_avatar` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_bg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg',
  `shopFeeBalance` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `user_id`, `is_active`, `description`, `date_approved`, `rating`, `shop_avatar`, `shop_bg`, `shopFeeBalance`, `created_at`, `updated_at`) VALUES
(1, 'Maharlika Shopee', 3, 1, 'Ang maharlika goods ay isang agrisell store na galing villasis na nagbebenta ng sariwang gulay at prutas.', '2022-03-15 04:40:31', NULL, 'users/default.png', 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2021-07-16 20:39:03', '2022-01-09 21:06:28'),
(15, 'teslershop', 58, 1, 'dasddsa', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-01-31 17:14:46', '2022-01-31 17:14:46'),
(17, 'Vison\'', 4, 1, 'Farms', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-02-17 05:13:04', '2022-02-17 05:13:04'),
(18, 'Henry shop', 62, 1, 'Farm industry', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-02-17 07:19:22', '2022-02-17 07:19:22'),
(19, 'HENS', 63, 1, 'JONES STORE', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-02-18 04:53:44', '2022-02-18 04:53:44'),
(20, 'AnthonyMaritesBananaShop', 64, 1, 'ashdhf akdkf', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-02-18 07:22:42', '2022-02-18 07:22:42'),
(21, 'VitaCrops', 66, 1, 'Fresh Fruits and Veggies', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-02-18 22:47:26', '2022-02-18 22:47:26'),
(22, 'Via\'s Farm', 68, 1, 'fresh vegetables', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-02-19 11:20:56', '2022-02-19 11:20:56'),
(26, 'nikolai', 85, 1, 'TRex', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-03-10 09:10:47', '2022-03-10 09:10:47'),
(27, 'dsadsad', 75, 1, 'dsa', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-03-10 09:40:30', '2022-03-10 09:40:30'),
(28, 'd4355dsad', 72, 1, '24dsaffdaf', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-03-10 09:43:02', '2022-03-10 09:43:02'),
(31, 'Polski', 88, 1, 'Que Marivloso shop con produktos al muchos caledad', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-03-14 07:05:23', '2022-03-14 07:09:13'),
(32, 'Trojan', 89, 1, '34fsdfsfdff', '2022-03-15 04:40:31', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-03-14 14:04:13', '2022-03-14 14:04:56'),
(34, 'fdaf', 87, 1, '5255335434343', '2022-03-16 00:16:32', NULL, NULL, 'shop_banner\\November2021\\1635816165618092e56981c-shop_banner.jpg', NULL, '2022-03-16 12:14:52', '2022-03-16 12:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `sub_orders`
--

CREATE TABLE `sub_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) NOT NULL DEFAULT 8,
  `shipping_fee` bigint(20) NOT NULL DEFAULT 0,
  `pick_up_status_id` bigint(20) NOT NULL DEFAULT 4,
  `is_pick_up` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processing','completed','decline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `grand_total` double(8,2) NOT NULL,
  `item_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_order_items`
--

CREATE TABLE `sub_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supported_towns`
--

CREATE TABLE `supported_towns` (
  `id` int(11) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `town_name` varchar(50) NOT NULL,
  `shipping_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supported_towns`
--

INSERT INTO `supported_towns` (`id`, `zip_code`, `town_name`, `shipping_fee`) VALUES
(1, 2408, 'Agno', 115),
(2, 2415, 'Aguilar', 50),
(3, 2404, 'Alaminos', 65),
(4, 2425, 'Alcala', 75),
(5, 2405, 'Anda', 65),
(6, 2439, 'Asingan', 115),
(7, 2442, 'Balungao', 50),
(8, 2407, 'Bani', 140),
(9, 2422, 'Basista', 50),
(10, 2424, 'Bautista', 50),
(11, 2423, 'Bayambang', 100),
(12, 2436, 'Binalonan', 50),
(13, 2417, 'Binmaley', 65),
(14, 2406, 'Bolinao', 65),
(15, 2416, 'Bugallon', 75),
(16, 2410, 'Burgos', 100),
(17, 2418, 'Calasiao', 75),
(18, 2400, 'Dagupan City', 120),
(19, 2411, 'Dasol', 65),
(20, 2412, 'Infanta', 140),
(21, 2402, 'Labrador', 115),
(22, 2437, 'Laoac', 100),
(23, 2401, 'Lingayen', 75),
(24, 2409, 'Mabini', 100),
(25, 2421, 'Malasiqui', 100),
(26, 2430, 'Manaoag', 140),
(27, 2432, 'Mangaldan', 50),
(28, 2413, 'Mangatarem', 115),
(29, 2429, 'Mapandan', 100),
(30, 2446, 'Natividad', 75),
(31, 2435, 'Pozorrubio', 115),
(32, 2441, 'Rosales', 120),
(33, 2420, 'San Carlos City', 140),
(34, 2433, 'San Fabian', 120),
(35, 2431, 'San Jacinto', 115),
(36, 2438, 'San Manuel', 75),
(37, 2447, 'San Nicolas', 100),
(38, 2444, 'San Quintin', 75),
(39, 2419, 'Santa Barbara', 50),
(40, 2440, 'Santa Maria', 120),
(41, 2426, 'Santo Tomas', 75),
(42, 2434, 'Sison', 75),
(43, 2403, 'Sual', 75),
(44, 2445, 'Tayug', 115),
(45, 2443, 'Umingan', 65),
(46, 2414, 'Urbiztondo', 100),
(47, 2428, 'Urdaneta', 120),
(48, 2427, 'Villasis', 115);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_order_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_paid` double(8,2) NOT NULL,
  `commission` double(8,2) NOT NULL,
  `status` enum('pending','processing','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trans_hist`
--

CREATE TABLE `trans_hist` (
  `id` int(11) NOT NULL,
  `user_id_slave` varchar(255) NOT NULL DEFAULT '1',
  `remarks` tinytext NOT NULL,
  `trans_ref_id` tinytext NOT NULL,
  `trans_type` tinytext NOT NULL,
  `amount` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id_master` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trans_hist`
--

INSERT INTO `trans_hist` (`id`, `user_id_slave`, `remarks`, `trans_ref_id`, `trans_type`, `amount`, `created_at`, `updated_at`, `user_id_master`) VALUES
(1, '1', 'User order', 'AGRIREF-6238c62da4a18', 'Order', '1026', '2022-03-21 18:38:37', '2022-03-21 18:38:37', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsdefaultPassword` tinyint(1) DEFAULT NULL,
  `Coins` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Pangasinan',
  `town` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Pangasinan',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bday` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_accepted_user_tos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `user_name`, `avatar`, `email_verified_at`, `password`, `IsdefaultPassword`, `Coins`, `address`, `barangay`, `town`, `province`, `mobile`, `bday`, `is_accepted_user_tos`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'agrisell2077@gmail.com', '', 'users/default.png', '2020-02-08 12:42:53', '$2a$12$faeb2fatllxt11u/mpPvceSXoS1Ns10fy6p7BGLLaURTr58DffPHK', 0, NULL, 'fdafdf', 'Amamperez', 'Villasis', 'Pangasinan', NULL, '', 'no', 'W1Kj3q98GFkJa6smuJydryjQjAxofS3l53MzWmlFeuFqtBvb6vNPcomLktuO', NULL, '2020-02-08 12:42:53', '2021-08-28 12:05:19'),
(3, 3, 'Apolinario Gabriel', 'sellersamp@agrisell.com', '', 'users/default.png', '2020-02-10 00:16:34', '$2a$12$faeb2fatllxt11u/mpPvceSXoS1Ns10fy6p7BGLLaURTr58DffPHK', 0, NULL, '3050 Pearcy Avenue', 'Amamperez', 'Villasis', 'Pangasinan', '535553', '2021-09-21', 'no', NULL, NULL, '2020-02-10 00:16:34', '2021-07-16 12:39:03'),
(56, 6, '(CTE)Hernan Gomez', 'coins@agrisell.com', 'Coins Top Up employee', 'users/default.png', '2022-01-16 15:10:25', '$2a$12$ZDbrT0Z6Oz48AaFMrJKG7eeo2wqZzKgH/od3zCLm5YOpfw.oj.UHW', NULL, NULL, NULL, 'Pangasinan', 'Villasis', 'Pangasinan', '09709798897', '2021-11-10', 'yes', NULL, NULL, NULL, NULL),
(57, 6, '(CTE)Moly Gomez', 'junelolz41@gmail.com', 'null', 'users/default.png', '2022-01-24 23:19:07', '$2a$12$GaiQ0rAfUyejTOnlAvm3GeX8Aidz/Hv3lBRGH9hKUl751E1pFs43a\n', 1, NULL, '6trt 656g', 'Pita', 'Infanta', 'Pangasinan', '5563356', '2022-01-27', 'yes', NULL, NULL, '2022-01-24 23:17:45', '2022-01-24 23:19:07'),
(58, 4, 'Macrro S Roms', 'ixawjwmkutdbkgpyeu@kvhrw.com', 'null', 'users/default.png', '2022-01-31 09:14:35', '$2y$10$u9FjaUs6nUETX2Un3H.sOe9leWZBa8ZmzMGBfoGp.Rgx87tgrPxwC', 1, NULL, '54 adss', 'San Pascual', 'Burgos', 'Pangasinan', '555555', '2022-02-15', 'yes', NULL, NULL, '2022-01-31 09:14:14', '2022-01-31 09:14:46'),
(59, 3, '3553 A gfsdg', 'eyhtfassvzkeprsgbv@nvhrw.com', 'null', 'users/default.png', '2022-02-07 08:14:41', '$2y$10$ujxutIB0Y88/./oDhsDV6.74RWLh776ljpVOUiNG4A9l8tw4uYl6u', 1, NULL, 'Art', 'Polong', 'Bugallon', 'Pangasinan', '455555', '2022-02-09', 'yes', NULL, NULL, '2022-02-07 08:14:14', '2022-02-07 08:20:18'),
(60, 2, 'fdsf fds fds', 'atfcdndrbqembiuaww@nthrl.com', 'null', 'users/default.png', '2022-02-10 10:59:09', '$2y$10$eeuDUXNRuU5Izb53q74Jm.sY8jCTIuhHn1dzyu60oKVk8Qp/g8bAm', 1, NULL, 'atfcdndrbqembiuaww@nthrl.com', 'Zone III', 'Tayug', 'Pangasinan', '55555555', '2022-03-01', 'yes', NULL, NULL, '2022-02-10 10:58:40', '2022-03-17 04:00:52'),
(61, 2, 'Pamela M. Dela Cruz', 'zbkkhgulffdnkospyj@bvhrs.com', 'null', 'users/default.png', '2022-02-16 22:00:27', '$2y$10$LDHJEZr8H4drmPKCzZ6.mOqoYAAejtmrw8jD6I4cfP2VR2lAo8cku', 1, NULL, 'Pob.West Asingan', 'Poblacion West', 'Asingan', 'Pangasinan', '09123161721', '2022-02-25', 'yes', NULL, NULL, '2022-02-16 21:59:01', '2022-02-16 22:00:27'),
(62, 4, 'Henry  A. Cavallero', 'yimom11082@goonby.com', 'null', 'users/default.png', '2022-02-16 22:08:12', '$2y$10$Rb0iFXMTz3B99B6r62Qjuu7gZ.AqMBHJ5B16DBCk/ZWcywzG.rAqC', 1, NULL, 'San Vicente Este Pangasinan', 'San Vicente Este', 'Asingan', 'Pangasinan', '09124161721', '2022-01-04', 'yes', NULL, NULL, '2022-02-16 22:07:06', '2022-02-16 23:19:22'),
(63, 4, 'Henry Jones C Calvero', 'vwrooipojajqeepxel@kvhrs.com', 'null', 'users/default.png', '2022-02-17 20:43:41', '$2y$10$fDlYCyvsDGWfCrPCvSv1guAgcpeTNRefOJgZjN2WGv3vXdD4za7pa', 1, NULL, 'Poblacion east', 'Pindangan East', 'Alcala', 'Pangasinan', '09053318914', '1999-04-13', 'yes', NULL, NULL, '2022-02-17 20:43:19', '2022-02-17 20:53:44'),
(64, 3, 'Elai', 'cuizonlailanie7@gmail.com', 'null', 'users/default.png', '2022-02-17 21:23:20', '$2y$10$GsUidElDXocOGtgIKFIybuhtSKAQU4leq01ccs6Jh0mYfgnVfRR0C', 1, NULL, '504', 'Amamperez', 'Villasis', 'Pangasinan', '09126800924', '2000-01-16', 'yes', NULL, NULL, '2022-02-17 21:22:51', '2022-02-17 23:40:57'),
(65, 2, 'Anthony', 'danilodorado@ucu.edu.ph', 'null', 'users/default.png', NULL, '$2y$10$.1aRNCAT9ShnpHecV099D.sTsuUBAMO4RLC3ILFLt0LdSYngWZCOK', 1, NULL, '607', 'Bayaoas', 'Urdaneta', 'Pangasinan', '09123422564', '2000-07-17', 'yes', NULL, NULL, '2022-02-17 23:18:20', '2022-02-17 23:18:20'),
(66, 3, 'Test D. Name', 'aprilrosegarciac001@gmail.com', 'null', 'users/default.png', '2022-02-18 14:46:38', '$2y$10$9lJFh48R/PjudHPvmW34pekVq3sGEQpC0DBi6ACvPlXHFQOYIG1pe', 1, NULL, '1122', 'San Juan', 'Umingan', 'Pangasinan', '09067283618', '2000-08-31', 'yes', NULL, NULL, '2022-02-18 14:39:11', '2022-02-18 14:48:54'),
(67, 2, 'Yna   Bautista', 'ynabautista62@gmail.com', 'null', 'users/default.png', NULL, '$2y$10$2vq2SoBXWZsaalOXsfoUl.W6m7S5.43DMQxIjofZ2u4dV4LT5WwMC', 1, NULL, 'Poblacion east', 'San Leon', 'Umingan', 'Pangasinan', '09053318914', '1999-04-13', 'yes', NULL, NULL, '2022-02-19 03:15:38', '2022-02-19 03:15:38'),
(68, 3, 'La Roche', 'iavmwotttxcenkxxjj@bvhrk.com', 'null', 'users/default.png', '2022-02-19 03:19:27', '$2y$10$oRbF00bJY4EN3M5ybKASduXI7vKft5ploPaJjhquWmQR4lRJXpXKy', 1, NULL, 'Poblacion east', 'Pasibi East', 'Urbiztondo', 'Pangasinan', '09053318914', '1999-04-13', 'yes', NULL, NULL, '2022-02-19 03:19:09', '2022-02-19 03:25:39'),
(69, 3, 'Test D. delacruz', 'fyhxbcbfbvalnsemup@kvhrs.com', 'null', 'users/default.png', '2022-02-19 03:40:43', '$2y$10$.7vm9vhUDYOpsaM1hJD/7OgCUnPoqdsVwM6cEV9XW1pv/ViwKRXQi', 1, NULL, '8', NULL, 'Santa Barbara', 'Pangasinan', '0', '2000-09-09', 'yes', NULL, NULL, '2022-02-19 03:39:20', '2022-03-15 00:13:07'),
(71, 2, 'Mikaelo S Bolivares', 'kcjbivhkkfjpfnhqqf@kvhrr.com', 'null', 'users/default.png', NULL, '$2y$10$9CoJHGr6HbffTwD/AhRmPu1KLRqBmS/YwMJ9KDOwJI.2OYIyQi7X2', 1, NULL, '34 White street', NULL, 'Urbiztondo', 'Pangasinan', '535355353', '2022-02-27', 'no', NULL, NULL, '2022-02-25 13:58:25', '2022-02-25 13:58:25'),
(72, 4, 'fadfdfa S gfsdg', 'jijadi2628@spruzme.com', 'null', 'users/default.png', '2022-02-25 14:08:03', '$2y$10$x8j45lr13GSb8UPZV7Nsbe7UQU2W52dbzQ8BRGGOhgpeqb9VEEgRW', 1, NULL, 'GH RTSSD', NULL, 'Umingan', 'Pangasinan', '5555555', '2022-02-27', 'yes', NULL, NULL, '2022-02-25 14:07:13', '2022-03-10 01:43:02'),
(73, 2, 'dst F gfgd', 'gijecos817@ishop2k.com', 'null', 'users/default.png', NULL, '$2y$10$BoAwRtbftB4GT3ap2hplX.LEEqFMa1/l8F0hqqLejpQ1z8oSlSA4W', 1, NULL, 'Art 4335fdaf', NULL, 'Umingan', 'Pangasinan', '5555555', '2022-02-27', 'no', NULL, NULL, '2022-02-25 14:13:38', '2022-02-25 14:13:38'),
(74, 2, 'dfsdffsdf 45 fdsff', 'medin92906@spruzme.com', 'null', 'users/default.png', NULL, '$2y$10$OY58d3Ai1SIkmRZRRMpRD.CV4uY9w6QA3s8zZnUkkAksFM7gQv4EK', 1, NULL, 'medin92906@spruzme.com', NULL, 'Umingan', 'Pangasinan', '6566666', '2022-02-27', 'no', NULL, NULL, '2022-02-25 14:40:37', '2022-02-25 14:40:37'),
(75, 4, 'Mikaelo 35535 Bolivares', 'cilariy990@shackvine.com', 'null', 'users/default.png', '2022-03-02 02:03:49', '$2y$10$mihv60gx/EPQRytCPpOrwuOPUxPQWgOHAq61Ljn4.xBH4pat/SKMO', 1, NULL, '53535', NULL, 'Urdaneta', 'Pangasinan', '53533', '2022-02-27', 'no', NULL, NULL, '2022-02-25 14:44:23', '2022-03-10 01:40:30'),
(76, 3, 'Mikaelo S Dasaf', 'rofamec685@submic.com', 'null', 'users/default.png', '2022-02-15 17:48:53', '$2y$10$nECYD96pPpOqGNyYywyhceH/ChVCovi7z5Wo6jp/HYmInH/YB0i6C', 1, NULL, '53535', NULL, 'Urdaneta', 'Pangasinan', '53533', '2022-02-28', 'yes', NULL, NULL, '2022-02-25 15:19:41', '2022-03-14 21:35:41'),
(77, 2, 'Sau A Paulo', 'faxewin621@submic.com', 'null', 'users/default.png', NULL, '$2y$10$j2LZyj08goZzxUABBZYjSeEB5szpBWFvO5jaDu5.UiH/aH4VLqZIi', 1, NULL, '34 kIA', NULL, 'Urdaneta', 'Pangasinan', '44444', '2022-02-27', 'no', NULL, NULL, '2022-02-25 17:36:47', '2022-02-25 17:36:47'),
(82, 5, 'testing2', '43345435@gfag.com', NULL, 'users/default.png', '2022-02-19 03:40:43', '$2y$10$6Xil9ZqW6o17.Hafdx.SMuj6S3iufF3kwHYlBhH0ZUgbsI/DNibKW', NULL, NULL, 'not defined', 'Amamperez', 'Villasis', 'Pangasinan', 'testing2', '2021-11-10', 'yes', NULL, NULL, '2022-03-01 17:29:50', '2022-03-01 17:29:50'),
(84, 3, 'TestingShop T testshop2', 'agselles@tutanota.com', 'null', 'users/default.png', '2022-03-02 00:20:49', '$2y$10$NXXZogbBziajXCYFWkJtNumJBaCgbtd.tpqxW4SGo3Uq.qAGcj2Hm', 1, NULL, '43 ADds', 'Santa Rosa', 'Umingan', 'Pangasinan', '4252552525', '2022-03-03', 'yes', NULL, NULL, '2022-03-02 00:20:24', '2022-03-14 21:35:10'),
(85, 4, 'Mikaelo 52 425', 'jyunbenavokyaxxuzi@kvhrr.com', 'null', 'users/default.png', '2022-03-10 01:09:49', '$2y$10$N6gjexw6aq.urqBAoSsbMOZ6bV9owgxYBa3.KAzMTCkGFR8Wwaaau', 1, NULL, 'jyunbenavokyaxxuzi@kvhrr.com', 'Pinmilapil', NULL, NULL, '5335355335', '2022-03-11', 'yes', NULL, NULL, '2022-03-10 01:08:50', '2022-03-10 01:10:47'),
(86, 3, 'Mikaelo R Bolivar', 'wayecit132@shopxda.com', 'null', 'users/default.png', '2022-03-16 00:51:34', '$2y$10$0ZiA9fzciAga8BPtAMOqp.wyFdWT0H89YYzqZCmsQddID6COcfK.y', 1, NULL, '45 Trikes', 'Sugcong', 'Urdaneta', NULL, '55555555', '2022-03-18', 'yes', NULL, NULL, '2022-03-16 00:49:46', '2022-03-16 05:29:38'),
(87, 3, 'Mikaelo A Adsuara', 'fiwiko3291@siberpay.com', 'null', 'users/default.png', '2022-03-16 11:51:56', '$2y$10$VvrPO.qZVDlu6lS/P9BSjuj5lRVplejhQdtCiJhhsfq/yfO3pR4.q', 1, NULL, 'Hola Art', 'San Miguel', 'Calasiao', NULL, '5555555', '2022-03-18', 'yes', NULL, NULL, '2022-03-16 11:51:18', '2022-03-16 12:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_valid_ids`
--

CREATE TABLE `user_valid_ids` (
  `id` int(10) UNSIGNED NOT NULL,
  `valid_id_path` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_valid` int(11) DEFAULT NULL,
  `user_email` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `invalid_reason_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_valid_ids`
--

INSERT INTO `user_valid_ids` (`id`, `valid_id_path`, `is_valid`, `user_email`, `user_id`, `invalid_reason_id`) VALUES
(1, 'user-valid-ids\\March2022\\1646209224621f28c8be6c6-valid_id.jpg', 0, 'agselles@tutanota.com', 84, 3),
(2, 'user-valid-ids\\March2022\\16469033306229c022569eb-valid_id.PNG', 2, 'jyunbenavokyaxxuzi@kvhrr.com', 85, 1),
(3, 'user-valid-ids\\March2022\\1647220164622e95c42a589-valid_id.webp', 2, 'ayrwwzhzrggreittok@kvhrs.com', 86, 1),
(5, 'user-valid-ids\\March2022\\1647266608622f4b3008e90-valid_id.jpg', 2, 'porelo9167@snece.com', 89, 1),
(6, 'user-valid-ids\\March2022\\16473917866231342a72000-valid_id.webp', 2, 'wayecit132@shopxda.com', 86, 1),
(7, 'user-valid-ids\\March2022\\16474314786231cf3632ced-valid_id.jpg', 2, 'fiwiko3291@siberpay.com', 87, 1);

-- --------------------------------------------------------

--
-- Table structure for table `variaton_retail`
--

CREATE TABLE `variaton_retail` (
  `id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `sold_per` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notification`
--
ALTER TABLE `admin_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `coins_refund_requests`
--
ALTER TABLE `coins_refund_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coins_top_up`
--
ALTER TABLE `coins_top_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coins_top_up_employee`
--
ALTER TABLE `coins_top_up_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coins_top_up_emp_entry`
--
ALTER TABLE `coins_top_up_emp_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coins_transaction`
--
ALTER TABLE `coins_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commenter_id_commenter_type_index` (`commenter_id`,`commenter_type`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_child_id_foreign` (`child_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverystaff`
--
ALTER TABLE `deliverystaff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invalid_id_reasons`
--
ALTER TABLE `invalid_id_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invalid_sell_reg_reasons`
--
ALTER TABLE `invalid_sell_reg_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_table`
--
ALTER TABLE `notification_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdeliverystatus`
--
ALTER TABLE `orderdeliverystatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `orderpickupstatus`
--
ALTER TABLE `orderpickupstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `rider_id` (`rider_id`),
  ADD KEY `rider_id_2` (`rider_id`);

--
-- Indexes for table `orderstatushist`
--
ALTER TABLE `orderstatushist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pre_orders`
--
ALTER TABLE `pre_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_monitoring_logs`
--
ALTER TABLE `product_monitoring_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_pricing_additionals`
--
ALTER TABLE `product_pricing_additionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `prod_refund_statuses`
--
ALTER TABLE `prod_refund_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quantity_is_sold_per`
--
ALTER TABLE `quantity_is_sold_per`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_rateable_type_rateable_id_index` (`rateable_type`,`rateable_id`),
  ADD KEY `ratings_rateable_id_index` (`rateable_id`),
  ADD KEY `ratings_rateable_type_index` (`rateable_type`),
  ADD KEY `ratings_user_id_foreign` (`user_id`);

--
-- Indexes for table `refund_request_products`
--
ALTER TABLE `refund_request_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `seller_payment_reg_rem`
--
ALTER TABLE `seller_payment_reg_rem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_registration_fee`
--
ALTER TABLE `seller_registration_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `shipping_fee_table_matrix`
--
ALTER TABLE `shipping_fee_table_matrix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shops_user_id_foreign` (`user_id`);

--
-- Indexes for table `sub_orders`
--
ALTER TABLE `sub_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_orders_order_id_foreign` (`order_id`),
  ADD KEY `orderstatus` (`status_id`),
  ADD KEY `sub_orders_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `sub_order_items`
--
ALTER TABLE `sub_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_order_items_sub_order_id_foreign` (`sub_order_id`),
  ADD KEY `sub_order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `supported_towns`
--
ALTER TABLE `supported_towns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_sub_order_id_foreign` (`sub_order_id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `trans_hist`
--
ALTER TABLE `trans_hist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- Indexes for table `user_valid_ids`
--
ALTER TABLE `user_valid_ids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_valid_ids_user_id_index` (`user_email`(255));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_notification`
--
ALTER TABLE `admin_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coins_refund_requests`
--
ALTER TABLE `coins_refund_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coins_top_up`
--
ALTER TABLE `coins_top_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coins_top_up_employee`
--
ALTER TABLE `coins_top_up_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coins_top_up_emp_entry`
--
ALTER TABLE `coins_top_up_emp_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coins_transaction`
--
ALTER TABLE `coins_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliverystaff`
--
ALTER TABLE `deliverystaff`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invalid_id_reasons`
--
ALTER TABLE `invalid_id_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invalid_sell_reg_reasons`
--
ALTER TABLE `invalid_sell_reg_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notification_table`
--
ALTER TABLE `notification_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `orderdeliverystatus`
--
ALTER TABLE `orderdeliverystatus`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderpickupstatus`
--
ALTER TABLE `orderpickupstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderstatushist`
--
ALTER TABLE `orderstatushist`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pre_orders`
--
ALTER TABLE `pre_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_monitoring_logs`
--
ALTER TABLE `product_monitoring_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_pricing_additionals`
--
ALTER TABLE `product_pricing_additionals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `prod_refund_statuses`
--
ALTER TABLE `prod_refund_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quantity_is_sold_per`
--
ALTER TABLE `quantity_is_sold_per`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_request_products`
--
ALTER TABLE `refund_request_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seller_payment_reg_rem`
--
ALTER TABLE `seller_payment_reg_rem`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_registration_fee`
--
ALTER TABLE `seller_registration_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shipping_fee_table_matrix`
--
ALTER TABLE `shipping_fee_table_matrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2305;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sub_orders`
--
ALTER TABLE `sub_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_order_items`
--
ALTER TABLE `sub_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supported_towns`
--
ALTER TABLE `supported_towns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_hist`
--
ALTER TABLE `trans_hist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `user_valid_ids`
--
ALTER TABLE `user_valid_ids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rider` FOREIGN KEY (`rider_id`) REFERENCES `deliverystaff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
