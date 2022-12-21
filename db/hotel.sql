-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 11:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_hotel`
--

CREATE TABLE `d_hotel` (
  `id` int(11) NOT NULL,
  `code` varchar(36) NOT NULL DEFAULT uuid(),
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT concat(replace(trim(lcase(`name`)),' ','-'),'-',uuid_short()),
  `description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `star` int(11) NOT NULL DEFAULT 1,
  `status` varchar(50) NOT NULL DEFAULT 'act_active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `d_hotel`
--

INSERT INTO `d_hotel` (`id`, `code`, `name`, `slug`, `description`, `address`, `img`, `star`, `status`, `created_at`) VALUES
(1, '69c9afe5-7b3e-11ed-82ba-0242ac110002', 'Lorin Hotel', 'lorin-hotel-100091296953139211', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Cibinong, Bogor', 'lorin.jpg', 2, 'act_active', '2022-12-14 09:16:22'),
(2, '69d0225f-7b3e-11ed-82ba-0242ac110002', 'Bigland Hotel', 'bigland-hotel-100091296953139212', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Jakarta', 'bigland.jpg', 3, 'act_active', '2022-12-14 09:16:22'),
(3, '69d3f991-7b3e-11ed-82ba-0242ac110002', 'OYO 911 Syariah', 'oyo-911-syariah-100091296953139213', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Bandung', 'oyo.jpg', 4, 'act_active', '2022-12-14 09:16:22'),
(4, '69d74dbb-7b3e-11ed-82ba-0242ac110002', 'The Sultan Hotel', 'the-sultan-hotel-100091296953139214', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Semarang', 'sultan.jpg', 1, 'act_active', '2022-12-14 09:16:22'),
(5, '69da52b8-7b3e-11ed-82ba-0242ac110002', 'The Ritz Calton', 'the-ritz-calton-100091296953139215', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Jakarta', 'ritz.jpeg', 5, 'act_active', '2022-12-14 09:16:22'),
(6, '69de1b66-7b3e-11ed-82ba-0242ac110002', 'Ibis Kalimantan', 'ibis-kalimantan-100091296953139216', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Tangerang', 'ibis.webp', 3, 'act_active', '2022-12-14 09:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `d_hotel_room`
--

CREATE TABLE `d_hotel_room` (
  `id` int(11) NOT NULL,
  `code` varchar(36) NOT NULL DEFAULT uuid(),
  `hotel` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT concat(replace(trim(lcase(`name`)),' ','-'),'-',uuid_short()),
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'act_active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `d_hotel_room`
--

INSERT INTO `d_hotel_room` (`id`, `code`, `hotel`, `name`, `slug`, `description`, `img`, `price`, `status`, `created_at`) VALUES
(1, 'ce319003-7b3e-11ed-82ba-0242ac110002', '69c9afe5-7b3e-11ed-82ba-0242ac110002', 'Standard Room', 'standard-room-100091296953139219', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'lorin-standard.png', 200000, 'act_active', '2022-12-14 09:19:10'),
(2, 'ce35fda1-7b3e-11ed-82ba-0242ac110002', '69c9afe5-7b3e-11ed-82ba-0242ac110002', 'Superior Room', 'superior-room-100091296953139220', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'lorin-superior.png', 500000, 'act_active', '2022-12-14 09:19:10'),
(3, '029ea17e-7b3f-11ed-82ba-0242ac110002', '69d0225f-7b3e-11ed-82ba-0242ac110002', 'Deluxe Room', 'deluxe-room-100091296953139221', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'bigland-deluxe.png', 300000, 'act_active', '2022-12-14 09:20:38'),
(4, '02a205cc-7b3f-11ed-82ba-0242ac110002', '69d0225f-7b3e-11ed-82ba-0242ac110002', 'Twin Room', 'twin-room-100091296953139222', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'bigland-twin.png', 350000, 'act_active', '2022-12-14 09:20:38'),
(5, '2847f7ca-7b3f-11ed-82ba-0242ac110002', '69d3f991-7b3e-11ed-82ba-0242ac110002', 'Single Room', 'single-room-100091296953139223', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'oyo-single.png', 150000, 'act_active', '2022-12-14 09:21:41'),
(6, '284aedeb-7b3f-11ed-82ba-0242ac110002', '69d3f991-7b3e-11ed-82ba-0242ac110002', 'Double Room', 'double-room-100091296953139224', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'oyo-double.png', 250000, 'act_active', '2022-12-14 09:21:41'),
(7, '57bbd68e-7b3f-11ed-82ba-0242ac110002', '69d74dbb-7b3e-11ed-82ba-0242ac110002', 'Family Room', 'family-room-100091296953139225', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sultan-family.png', 1500000, 'act_active', '2022-12-14 09:23:01'),
(8, '57be4c1b-7b3f-11ed-82ba-0242ac110002', '69d74dbb-7b3e-11ed-82ba-0242ac110002', 'Junior Suite', 'junior-suite-100091296953139226', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sultan-junior.png', 2000000, 'act_active', '2022-12-14 09:23:01'),
(9, '7ba8edb9-7b3f-11ed-82ba-0242ac110002', '69da52b8-7b3e-11ed-82ba-0242ac110002', 'Twin Room', 'twin-room-100091296953139227', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'ritz-twin.png', 550000, 'act_active', '2022-12-14 09:24:01'),
(10, '7bad1b00-7b3f-11ed-82ba-0242ac110002', '69da52b8-7b3e-11ed-82ba-0242ac110002', 'Single Room', 'single-room-100091296953139228', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'ritz-single.png', 750000, 'act_active', '2022-12-14 09:24:01'),
(11, 'b488cda2-7b3f-11ed-82ba-0242ac110002', '69de1b66-7b3e-11ed-82ba-0242ac110002', 'Superior Room', 'superior-room-100091296953139229', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'ibis-superior.png', 345000, 'act_active', '2022-12-14 09:25:36'),
(12, 'b48c55f7-7b3f-11ed-82ba-0242ac110002', '69de1b66-7b3e-11ed-82ba-0242ac110002', 'Deluxe Room', 'deluxe-room-100091296953139230', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'ibis-deluxe.png', 450000, 'act_active', '2022-12-14 09:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `d_hotel_room_number`
--

CREATE TABLE `d_hotel_room_number` (
  `id` int(11) NOT NULL,
  `code` varchar(36) NOT NULL DEFAULT uuid(),
  `room` varchar(36) NOT NULL,
  `number` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'act_active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `d_hotel_room_number`
--

INSERT INTO `d_hotel_room_number` (`id`, `code`, `room`, `number`, `status`, `created_at`) VALUES
(1, 'cd6104a2-7b47-11ed-82ba-0242ac110002', '029ea17e-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(2, 'cd61176d-7b47-11ed-82ba-0242ac110002', '02a205cc-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(3, 'cd611b6e-7b47-11ed-82ba-0242ac110002', '2847f7ca-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(4, 'cd611d8e-7b47-11ed-82ba-0242ac110002', '284aedeb-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(5, 'cd611fb2-7b47-11ed-82ba-0242ac110002', '57bbd68e-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(6, 'cd612306-7b47-11ed-82ba-0242ac110002', '57be4c1b-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(7, 'cd633d59-7b47-11ed-82ba-0242ac110002', '7ba8edb9-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(8, 'cd633f29-7b47-11ed-82ba-0242ac110002', '7bad1b00-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(9, 'cd634211-7b47-11ed-82ba-0242ac110002', 'b488cda2-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(10, 'cd6343a8-7b47-11ed-82ba-0242ac110002', 'b48c55f7-7b3f-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(11, 'cd6345ad-7b47-11ed-82ba-0242ac110002', 'ce319003-7b3e-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(12, 'cd634717-7b47-11ed-82ba-0242ac110002', 'ce35fda1-7b3e-11ed-82ba-0242ac110002', '1A', 'act_active', '2022-12-14 10:23:32'),
(16, 'dcef6e97-7b47-11ed-82ba-0242ac110002', '029ea17e-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(17, 'dcef7539-7b47-11ed-82ba-0242ac110002', '02a205cc-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(18, 'dcef7d5c-7b47-11ed-82ba-0242ac110002', '2847f7ca-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(19, 'dcef8232-7b47-11ed-82ba-0242ac110002', '284aedeb-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(20, 'dcef83cc-7b47-11ed-82ba-0242ac110002', '57bbd68e-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(21, 'dcef8822-7b47-11ed-82ba-0242ac110002', '57be4c1b-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(22, 'dcef8970-7b47-11ed-82ba-0242ac110002', '7ba8edb9-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(23, 'dcef8d73-7b47-11ed-82ba-0242ac110002', '7bad1b00-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(24, 'dcef8f00-7b47-11ed-82ba-0242ac110002', 'b488cda2-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(25, 'dcef9025-7b47-11ed-82ba-0242ac110002', 'b48c55f7-7b3f-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(26, 'dcef9153-7b47-11ed-82ba-0242ac110002', 'ce319003-7b3e-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(27, 'dcef927c-7b47-11ed-82ba-0242ac110002', 'ce35fda1-7b3e-11ed-82ba-0242ac110002', '2B', 'act_active', '2022-12-14 10:23:58'),
(31, 'e38ddaf3-7b47-11ed-82ba-0242ac110002', '029ea17e-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(32, 'e38de5f8-7b47-11ed-82ba-0242ac110002', '02a205cc-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(33, 'e38de8d0-7b47-11ed-82ba-0242ac110002', '2847f7ca-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(34, 'e38dead3-7b47-11ed-82ba-0242ac110002', '284aedeb-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(35, 'e38dee10-7b47-11ed-82ba-0242ac110002', '57bbd68e-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(36, 'e38df424-7b47-11ed-82ba-0242ac110002', '57be4c1b-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(37, 'e38df5c0-7b47-11ed-82ba-0242ac110002', '7ba8edb9-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(38, 'e38df6a8-7b47-11ed-82ba-0242ac110002', '7bad1b00-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(39, 'e38df7a4-7b47-11ed-82ba-0242ac110002', 'b488cda2-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(40, 'e38df87b-7b47-11ed-82ba-0242ac110002', 'b48c55f7-7b3f-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(41, 'e38df951-7b47-11ed-82ba-0242ac110002', 'ce319003-7b3e-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09'),
(42, 'e38dfa2b-7b47-11ed-82ba-0242ac110002', 'ce35fda1-7b3e-11ed-82ba-0242ac110002', '3C', 'act_active', '2022-12-14 10:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `d_order`
--

CREATE TABLE `d_order` (
  `id` int(11) NOT NULL,
  `code` varchar(36) NOT NULL DEFAULT uuid(),
  `room` varchar(36) NOT NULL,
  `room_number` varchar(36) DEFAULT NULL,
  `user` varchar(36) NOT NULL,
  `payment` varchar(36) NOT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `booking_date` date NOT NULL DEFAULT curdate(),
  `duration` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'bo_pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `d_user`
--

CREATE TABLE `d_user` (
  `id` int(11) NOT NULL,
  `code` varchar(36) NOT NULL DEFAULT uuid(),
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'act_active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `d_user`
--

INSERT INTO `d_user` (`id`, `code`, `role`, `name`, `username`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(5, '310ad94f-80b8-11ed-9a4a-e01877ca154d', 'ADMIN', 'Administrator', 'admin2', NULL, '$2y$10$skhRQE7kMSdAtEBPFBgE0.3qXDjD69JfT/P7WyovIlSICuqpo1eY6', 'act_active', '2022-12-20 22:46:57', NULL),
(6, '97282f46-80b8-11ed-9a4a-e01877ca154d', 'ADMIN', 'Administrator', 'admin', 'admin@gmail.com', '$2y$10$d5PHs/YyXJCva31ptiPYe.Pe1VsfVvp4YDZalwfbR9VdMZQdGlMry', 'act_active', '2022-12-20 22:49:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_data`
--

CREATE TABLE `m_data` (
  `id` int(11) NOT NULL,
  `for` varchar(20) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `m_data`
--

INSERT INTO `m_data` (`id`, `for`, `code`, `name`, `created_at`) VALUES
(1, 'payment_method', 'payment_cash', 'Tunai', '2022-12-13 23:36:59'),
(2, 'payment_method', 'payment_transfer', 'Transfer', '2022-12-13 23:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `m_role`
--

CREATE TABLE `m_role` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `m_role`
--

INSERT INTO `m_role` (`id`, `code`, `name`, `created_at`) VALUES
(1, 'ADMIN', 'Administrator', '2022-12-13 22:23:14'),
(2, 'USER', 'User', '2022-12-13 22:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `m_status`
--

CREATE TABLE `m_status` (
  `id` int(11) NOT NULL,
  `for` varchar(20) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `m_status`
--

INSERT INTO `m_status` (`id`, `for`, `code`, `name`, `created_at`) VALUES
(1, 'activation', 'act_active', 'Aktif', '2022-12-13 22:35:06'),
(2, 'activation', 'act_inactive', 'Non-aktif', '2022-12-13 22:35:06'),
(3, 'booking', 'bo_pending', 'Pending', '2022-12-13 23:34:25'),
(4, 'booking', 'bo_success', 'Berhasil', '2022-12-13 23:34:25'),
(5, 'booking', 'bo_finish', 'Selesai', '2022-12-13 23:34:25'),
(6, 'booking', 'bo_failed', 'Gagal', '2022-12-13 23:34:25'),
(7, 'booking', 'bo_cancel', 'Batal', '2022-12-13 23:34:25'),
(8, 'booking', 'bo_booked', 'Booked', '2022-12-14 10:16:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_hotel`
--
ALTER TABLE `d_hotel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `d_hotel_status_fk` (`status`);

--
-- Indexes for table `d_hotel_room`
--
ALTER TABLE `d_hotel_room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `d_hotel_room_status_fk` (`status`),
  ADD KEY `d_hotel_room_hotel_fk` (`hotel`);

--
-- Indexes for table `d_hotel_room_number`
--
ALTER TABLE `d_hotel_room_number`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `d_hotel_room_number_room_fk` (`room`),
  ADD KEY `d_hotel_room_number_status_fk` (`status`);

--
-- Indexes for table `d_order`
--
ALTER TABLE `d_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `d_order_room_fk` (`room`),
  ADD KEY `d_order_payment_fk` (`payment`),
  ADD KEY `d_order_status_fk` (`status`),
  ADD KEY `d_order_user_fk` (`user`),
  ADD KEY `d_order_room_number_fk` (`room_number`);

--
-- Indexes for table `d_user`
--
ALTER TABLE `d_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `d_user_role_fk` (`role`),
  ADD KEY `d_user_status_fk` (`status`);

--
-- Indexes for table `m_data`
--
ALTER TABLE `m_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `m_role`
--
ALTER TABLE `m_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `m_status`
--
ALTER TABLE `m_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_hotel`
--
ALTER TABLE `d_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `d_hotel_room`
--
ALTER TABLE `d_hotel_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `d_hotel_room_number`
--
ALTER TABLE `d_hotel_room_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `d_order`
--
ALTER TABLE `d_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `d_user`
--
ALTER TABLE `d_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_data`
--
ALTER TABLE `m_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_role`
--
ALTER TABLE `m_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_status`
--
ALTER TABLE `m_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_hotel`
--
ALTER TABLE `d_hotel`
  ADD CONSTRAINT `d_hotel_status_fk` FOREIGN KEY (`status`) REFERENCES `m_status` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `d_hotel_room`
--
ALTER TABLE `d_hotel_room`
  ADD CONSTRAINT `d_hotel_room_hotel_fk` FOREIGN KEY (`hotel`) REFERENCES `d_hotel` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `d_hotel_room_status_fk` FOREIGN KEY (`status`) REFERENCES `m_status` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `d_hotel_room_number`
--
ALTER TABLE `d_hotel_room_number`
  ADD CONSTRAINT `d_hotel_room_number_room_fk` FOREIGN KEY (`room`) REFERENCES `d_hotel_room` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `d_hotel_room_number_status_fk` FOREIGN KEY (`status`) REFERENCES `m_status` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `d_order`
--
ALTER TABLE `d_order`
  ADD CONSTRAINT `d_order_payment_fk` FOREIGN KEY (`payment`) REFERENCES `m_data` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `d_order_room_fk` FOREIGN KEY (`room`) REFERENCES `d_hotel_room` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `d_order_room_number_fk` FOREIGN KEY (`room_number`) REFERENCES `d_hotel_room_number` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `d_order_status_fk` FOREIGN KEY (`status`) REFERENCES `m_status` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `d_order_user_fk` FOREIGN KEY (`user`) REFERENCES `d_user` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `d_user`
--
ALTER TABLE `d_user`
  ADD CONSTRAINT `d_user_role_fk` FOREIGN KEY (`role`) REFERENCES `m_role` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `d_user_status_fk` FOREIGN KEY (`status`) REFERENCES `m_status` (`code`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
