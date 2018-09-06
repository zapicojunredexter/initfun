-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2018 at 09:16 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `initfun`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(1) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `owner_id`, `categories_name`, `categories_active`) VALUES
(11, 2, 'Bread', 1),
(12, 2, 'Cake', 1),
(13, 3, 'Pastry', 1),
(14, 2, 'Cake Rolls', 1),
(15, 2, 'Cookies', 1),
(18, 2, 'Pasalubongs', 1),
(19, 10, 'sweets', 1),
(22, 123, 'test category name', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(12) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `middle_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `city_address` varchar(100) NOT NULL,
  `permanent_address` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `wallet` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `city_address`, `permanent_address`, `phone_number`, `email`, `password`, `wallet`) VALUES
(1, 'Josh', 'Escoto', 'Angeles', 'Male', '1997-03-13', 'Buatis Lusaran Cebu City', 'Buatis Lusaran Cebu City', '213213213', 'exam@gmeel.com', '200820e3227815ed1756a6b531e7e0d2', '-27.12'),
(2, 'John', 'Else', 'Arch', 'Female', '1997-12-03', 'em@gmail.com', 'Buatis Lusaran Cebu City', '9282292829', 'em@gmail.com', '200820e3227815ed1756a6b531e7e0d2', '0.00'),
(3, 'Josh', 'Else', 'Doe', 'Female', '1997-03-18', 'buatis', 'buatis', '123213123', 'em1@gmail.com', '200820e3227815ed1756a6b531e7e0d2', '0.00'),
(4, 'Josh', 'Escoto', 'Angeles', 'Male', '1986-03-18', 'Buatis Lusaran Cebu City', 'balagtas street cebu city', '09226186854', 'ange@gmail.com', '200820e3227815ed1756a6b531e7e0d2', '910.73'),
(5, 'Rascel', 'Maglasang', 'Batiancila', 'Female', '1997-10-03', 'Talamban Cebu City', 'Talamban Cebu City', '092261868542', 'rascel@gmail.com', '200820e3227815ed1756a6b531e7e0d2', '1000.00'),
(6, 'Junre Dexter', 'Yutico', 'Zapico', 'Male', '1997-07-17', 'isagani street cebu', 'isagani street cebu', '12345678', 'zapicojunredexter@yahoo.com', '36e759659121dc7b67bb65ed20f54bea', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `order_status`, `owner_id`) VALUES
(65, '2018-05-21', 'sdfadfa', 'fasdfasd', '12.00', '1.56', '13.56', '0', '13.56', '15', '-1.44', 2, 1, 1, 3),
(193, '2018-05-22', 'Josh Angeles', '09226186854', '24', '3.12', '27.12', '0', '27.12', '50.00', '22.88', 3, 1, 1, 3),
(194, '2018-05-22', 'Josh Angeles', '09226186854', '12', '1.56', '13.56', '0', '13.56', '22.88', '9.32', 3, 1, 1, 2),
(195, '2018-05-23', 'KIM', '091512312412', '520.00', '67.60', '587.60', '0', '587.60', '1000', '-412.40', 2, 1, 1, 8),
(196, '2018-05-23', 'Josh Angeles', '09226186854', '22', '2.86', '24.86', '0', '24.86', '500.00', '475.14', 3, 1, 1, 2),
(197, '2018-05-23', 'Josh Angeles', '09226186854', '5', '0.65', '5.65', '0', '5.65', '475.14', '469.49', 3, 1, 1, 2),
(198, '2018-05-23', 'Josh Angeles', '09226186854', '260', '33.8', '293.8', '0', '293.8', '469.49', '175.69', 3, 1, 1, 8),
(199, '2018-05-23', 'Richly Kwong', '09229898398', '68.00', '8.84', '76.84', '0', '76.84', '80', '3.16', 2, 1, 1, 2),
(200, '2018-05-23', 'Josh Angeles', '09226186854', '50', '6.5', '56.5', '0', '56.5', '1000.00', '943.5', 3, 1, 1, 2),
(201, '2018-05-23', 'Josh Angeles', '09226186854', '10', '1.3', '11.3', '0', '11.3', '943.50', '932.2', 3, 1, 1, 2),
(202, '2018-05-23', 'Josh Angeles', '09226186854', '11', '1.43', '12.43', '0', '12.43', '932.20', '919.77', 3, 1, 1, 2),
(203, '2018-05-23', 'Josh Angeles', '09226186854', '8', '1.04', '9.04', '0', '9.04', '919.77', '910.73', 3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT '0',
  `scheduled_delivery` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`, `scheduled_delivery`) VALUES
(12, 65, 22, '1', '12', '12.00', 1, ''),
(106, 193, 22, '2', '24', '27.12', 1, ''),
(107, 194, 24, '1', '12', '13.56', 1, ''),
(108, 195, 40, '2', '260', '520.00', 1, ''),
(109, 196, 30, '2', '22', '24.86', 1, ''),
(110, 197, 36, '1', '5', '5.65', 1, ''),
(111, 198, 40, '1', '260', '293.8', 1, ''),
(112, 199, 41, '4', '17', '68.00', 1, ''),
(113, 200, 29, '5', '50', '56.5', 1, ''),
(114, 201, 28, '1', '10', '11.3', 1, ''),
(115, 202, 30, '1', '11', '12.43', 1, ''),
(116, 203, 31, '1', '8', '9.04', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `rate`, `active`) VALUES
(28, 'Buko Pie', '../assests/images/initfun/323515b04cc069e2a8.jpg', 2, 11, '29', '10', 1),
(29, 'Cheese Bread', '../assests/images/initfun/288445b04cc1889d5b.jpg', 2, 11, '25', '10', 1),
(30, 'Empanadas', '../assests/images/initfun/44695b04cc2993756.jpg', 2, 11, '27', '11', 1),
(31, 'Ensaymada', '../assests/images/initfun/176745b04cc3bdfdee.jpg', 2, 11, '29', '8', 1),
(32, 'Hopia', '../assests/images/initfun/85715b04cc532f34b.jpg', 2, 11, '30', '6', 1),
(33, 'Egg and Oil', '../assests/images/initfun/275445b04cc86a383a.jpg', 2, 12, '10', '250', 1),
(34, 'Teramisu Cake Roll', '../assests/images/initfun/204655b04cca68a331.jpg', 2, 14, '5', '270', 1),
(35, 'Egg White Only', '../assests/images/initfun/101985b04cccb855d7.jpg', 2, 12, '4', '200', 1),
(36, 'Caramel Delite', '../assests/images/initfun/231275b04cce347834.png', 2, 15, '29', '5', 1),
(37, 'Toffee Tastic', '../assests/images/initfun/105645b04ccf5504ff.jpg', 2, 15, '20', '6', 1),
(38, 'Jelly Roll', '../assests/images/initfun/183475b04cd96be4af.jpg', 3, 13, '30', '190', 1),
(39, 'Egg White', '../assests/images/initfun/199765b04cdb425f92.jpg', 3, 13, '10', '180', 1),
(40, 'White Cake', '../assests/images/initfun/304795b04e583f31f2.jpg', 8, 17, '2', '260', 1),
(41, 'Dried Mangoes', '../assests/images/initfun/290935b050c06346da.jpg', 2, 18, '17', '17', 1),
(42, 'candy', '../assests/images/initfun/1935846245b7e486a82ad5.jpg', 10, 19, '5', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT '0',
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `account_expiration` varchar(20) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_admin`, `first_name`, `middle_name`, `last_name`, `gender`, `phone_number`, `date_of_birth`, `address`, `username`, `password`, `email`, `brand_id`, `account_expiration`) VALUES
(1, 1, '', '', '', '', '', '0000-00-00', '', 'initfunadmin', '200820e3227815ed1756a6b531e7e0d2', '', 1, '-'),
(2, 0, 'Shammy', 'Shady', 'Rock', 'Male', '099292992', '1984-02-02', 'Balagtas street', 'shamrock', '200820e3227815ed1756a6b531e7e0d2', 'shammy.shamrock@gmail.com', 2, '2018-08-31'),
(3, 0, 'Max', 'Imum', 'Well', 'Male', '09299292', '1985-10-02', 'Talamban, Cebu City', 'max', '200820e3227815ed1756a6b531e7e0d2', 'max.max@gmail.com', 3, '-'),
(7, 0, 'Josua', 'Escoto', 'Angeles', 'Male', '09226186854', '1997-03-03', 'Balagtas Street Cebu City', 'Gardenia', '', 'josh.gardenia@gmail.com', 0, '-'),
(8, 0, 'Victor', 'Villacorta', 'Tabanag', 'Male', '0912314123123', '1995-05-19', 'Sanciangko st. Cebu City', 'victortabanag', '912ec803b2ce49e4a541068d495ab570', 'victor@gmail.com', 0, '-'),
(9, 0, 'JOsua', 'Escoto', 'Apus', 'Male', '9209202922', '1997-04-03', 'balagtas street cebu city', 'gardenia', '200820e3227815ed1756a6b531e7e0d2', 'gardenia1@gmail.com', 0, '-'),
(10, 0, 'Junre Dexter', 'Yutico', 'Zapico', 'Male', '12345679', '1997-06-17', 'mybakery', 'junredexterzapico@yahoo.com', '36e759659121dc7b67bb65ed20f54bea', 'junredexterzapico@yahoo.com', 0, '2019-03-06'),
(11, 0, '', '', '', '', '', '0000-00-00', '', 'root', '', '', 0, '-'),
(12, 0, 'qwe', 'qwe', 'qwe', 'Male', 'qwe', '2018-09-06', 'qwe', 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'qwe@sada.co', 0, '2018-09-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
