-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2025 at 05:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lumora`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `designer_name` varchar(100) NOT NULL,
  `designer_image` varchar(255) DEFAULT NULL,
  `appointment_type` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `designer_name`, `designer_image`, `appointment_type`, `appointment_date`, `appointment_time`, `customer_name`, `email`, `phone`, `special_requests`, `created_at`) VALUES
(1, 'Aurora Vélour', NULL, 'Custom Garment Fitting', '2025-08-22', '22:37:00', 'yashshree', 'mane@gmail.com', '123-45-678', 'hii', '2025-08-18 17:03:58'),
(2, 'Celeste Marlowe', 'designerimages/designer2.jpg', 'In-person Styling', '2025-08-16', '13:39:00', 'yashshree', 'm.yashshree7@gmail.com', '973848279', 'HEY', '2025-08-18 17:10:10'),
(3, 'Liora Beaumont', 'designerimages/designer3.jpg', 'Virtual Consultation', '2025-07-31', '20:53:00', 'yashshree', 'mane@gmail.com', '973848279', 'hello', '2025-08-24 15:21:27');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `size` varchar(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `product_name`, `product_price`, `quantity`, `size`, `user_id`) VALUES
(77, 101, 'Test Product', 500.00, 2, 'M', 1),
(80, 81, 'Leather Handbag', 120.00, 1, 'M', 3),
(81, 82, 'Classic Sunglasses', 45.00, 1, 'M', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `address`, `phone`, `total_price`, `created_at`, `status_id`) VALUES
(3, 2, 'yashshree', 'digha', '123-45-678', 1598.00, '2025-08-18 12:08:32', 1),
(4, 3, 'mansi', 'ghansoli', '973848279', 1598.00, '2025-08-18 12:10:49', 1),
(5, 3, 'yashshree', 'san', '973848279', 799.00, '2025-08-18 14:42:32', 1),
(6, 3, 'yashshree', 'nagar', '8104608640813', 799.00, '2025-08-18 14:49:32', 1),
(7, 3, 'yashshree', 'nagar', '973848279', 799.00, '2025-08-18 14:51:25', 1),
(8, 3, 'yashshree', 'den', '123-45-678', 799.00, '2025-08-18 14:56:33', 1),
(9, 3, 'yashshree', 'den', '123-45-678', 799.00, '2025-08-18 15:00:28', 1),
(10, 3, 'yashshree', 'ramangar', '973848279', 2397.00, '2025-08-18 15:15:50', 1),
(11, 3, 'yashshree', 'san', '123-45-678', 3197.00, '2025-08-18 18:55:46', 1),
(12, 3, 'yashshree', 'san', '123-45-678', 2588.00, '2025-08-18 19:55:14', 1),
(13, 3, 'yashshree', 'jogoub', '123-45-678', 1299.00, '2025-08-18 20:14:35', 1),
(14, 3, 'yashshree', 'rome', '123-45-678', 1399.00, '2025-08-19 10:24:53', 1),
(15, 3, 'yashshree', 'france', '123-45-678', 176.00, '2025-08-19 12:13:14', 1),
(16, 2, 'yashshree', 'thane ', '123', 4289.00, '2025-08-24 16:45:25', 1),
(17, 2, 'yashshree', 'hey', '123', 120.00, '2025-08-24 16:47:19', 1),
(18, 2, 'yashshree', 'gouglj', '973848279', 45.00, '2025-08-24 16:53:21', 1),
(19, 2, 'yashshree', 'thane', '973848279', 3399.00, '2025-08-24 17:07:10', 1),
(20, 2, 'yashshree', 'thane', '8356098528', 45.00, '2025-08-25 07:36:48', 1),
(21, 2, 'yashshree', 'thane', '973848279', 93.00, '2025-08-25 08:12:19', 1),
(22, 2, 'yashshree', 'thane', '973848279', 2199.00, '2025-08-25 14:02:29', 1),
(23, 3, 'mansi', 'thnae', '973848279', 1519.00, '2025-08-25 14:06:46', 1),
(24, 2, 'yashshree', 'kalyan', '28463963', 79.00, '2025-08-25 14:13:16', 1),
(25, 2, 'yashshree', 'kalyan', '973848279', 2546.00, '2025-08-25 14:21:07', 1),
(26, 2, 'yashshree', 'thane', '8356098528', 35.00, '2025-08-25 14:43:23', 1),
(27, 2, 'yashshree', 'thane', '8356098528', 65.00, '2025-08-25 14:49:08', 1),
(28, 2, 'yashshree', 'thane', '8356098528', 72.00, '2025-08-25 14:49:41', 1),
(29, 2, 'yashshree', 'thane', '8356098528', 110.00, '2025-08-25 15:02:26', 1),
(30, 2, 'yashshree', 'thane', '+918356098528', 39.00, '2025-08-25 15:05:40', 1),
(31, 2, 'yashshree', 'navi mumbai', '+918356098528', 1399.00, '2025-08-25 15:10:07', 1),
(32, 2, 'mansi', 'ghansoli', '+919892351789', 1299.00, '2025-08-25 15:11:37', 1),
(33, 2, 'Harsha', 'kalyan', '+917841029307', 110.00, '2025-08-25 15:16:04', 1),
(34, 2, 'yashshree', 'digha', '+918356098528', 2399.00, '2025-08-25 15:21:42', 1),
(35, 2, 'yashshree', 'digha', '+918356098528', 2399.00, '2025-08-25 15:23:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `size`, `quantity`, `price`) VALUES
(3, 3, 11, 'Brown Formal Shirt', NULL, 1, 799.00),
(4, 3, 10, 'Red Formal Shirt', NULL, 1, 799.00),
(5, 4, 7, 'Pink Formal Shirt', NULL, 1, 799.00),
(6, 4, 8, 'Blue Formal Shirt', NULL, 1, 799.00),
(7, 5, 9, 'Grey Formal Shirt', NULL, 1, 799.00),
(8, 6, 12, 'Plain Grey Formal Shirt', NULL, 1, 799.00),
(9, 7, 12, 'Plain Grey Formal Shirt', NULL, 1, 799.00),
(10, 8, 7, 'Pink Formal Shirt', NULL, 1, 799.00),
(11, 9, 8, 'Blue Formal Shirt', NULL, 1, 799.00),
(12, 10, 8, 'Grey Formal Shirt', NULL, 3, 799.00),
(13, 11, 9, 'Blue Formal Shirt', NULL, 1, 799.00),
(14, 11, 8, 'Grey Formal Shirt', NULL, 1, 799.00),
(15, 11, 13, 'Pink Bodycon Dress – slim, figure-hugging party wear', NULL, 1, 1599.00),
(16, 12, 14, 'Blue Bodycon Dress – slim, figure-hugging party wear', NULL, 1, 1699.00),
(17, 12, 20, 'Pastel Green Blossom Clutch', NULL, 1, 889.00),
(18, 13, 29, 'Violet Bloom Ankle Sandals', NULL, 1, 1299.00),
(19, 14, 26, 'Crimson Bloom Heels', NULL, 1, 1399.00),
(20, 15, 82, 'Classic Sunglasses', NULL, 1, 45.00),
(21, 15, 80, 'Women\'s Casual Sneakers', NULL, 1, 59.00),
(22, 15, 88, 'Green Twist Halter Neck Cape', NULL, 1, 72.00),
(23, 16, 79, 'Summer Floral Dress', NULL, 1, 199.00),
(24, 16, 91, 'Black & Gold Embroidered Corset Top', NULL, 1, 1499.00),
(25, 16, 88, 'Green Twist Halter Neck Cape', NULL, 1, 72.00),
(26, 16, 81, 'Leather Handbag', NULL, 1, 120.00),
(27, 16, 137, 'Dark Wash Belted Bodycon Denim Dress', 'M', 1, 2399.00),
(28, 17, 81, 'Leather Handbag', 'M', 1, 120.00),
(29, 18, 82, 'Classic Sunglasses', 'M', 1, 45.00),
(30, 19, 122, 'Winter Warmth 2', 'M', 1, 3399.00),
(31, 20, 82, 'Classic Sunglasses', NULL, 1, 45.00),
(32, 21, 89, 'Square Neck Peplum Top', 'M', 1, 48.00),
(33, 21, 82, 'Classic Sunglasses', 'M', 1, 45.00),
(34, 22, 114, 'Vacation Outfit 2', 'M', 1, 2199.00),
(35, 23, 30, 'Midnight Rose Party Sandals', NULL, 1, 1399.00),
(36, 23, 81, 'Leather Handbag', NULL, 1, 120.00),
(37, 24, 85, 'Satin Slip Midi Dress', NULL, 1, 79.00),
(38, 25, 89, 'Square Neck Peplum Top', NULL, 1, 48.00),
(39, 25, 23, 'Lavender Blossom Hand Clutch', 'M', 1, 899.00),
(40, 25, 18, 'Green Bodycon Dress – slim, figure-hugging party wear', NULL, 1, 1599.00),
(41, 26, 83, 'Women\'s Cotton Shirt', NULL, 1, 35.00),
(42, 27, 87, 'Strappy Pencil Heel Sandals', NULL, 1, 65.00),
(43, 28, 88, 'Green Twist Halter Neck Cape', NULL, 1, 72.00),
(44, 29, 90, 'Solid Color Waistcoat & Pant', NULL, 1, 110.00),
(45, 30, 86, 'Gold Layered Necklace Set', NULL, 1, 39.00),
(46, 31, 26, 'Crimson Bloom Heels', NULL, 1, 1399.00),
(47, 32, 92, 'White Printed Square-Neck Corset Top', 'M', 1, 1299.00),
(48, 33, 90, 'Solid Color Waistcoat & Pant', NULL, 1, 110.00),
(49, 34, 115, 'Vacation Outfit 3', NULL, 1, 2399.00),
(50, 35, 115, 'Vacation Outfit 3', NULL, 1, 2399.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Delivered'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rating` decimal(2,1) DEFAULT 4.0,
  `offer` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `rating`, `offer`, `category`) VALUES
(7, 'Pink Formal Shirt', 799.00, 'categories/category-images/formalwear-circle-images/formalshirts-product-images/img1.jpg', 4.2, '', 'FormalWear'),
(8, 'Grey Formal Shirt', 799.00, 'categories/category-images/formalwear-circle-images/formalshirts-product-images/img2.jpg', 4.3, '', 'FormalWear'),
(9, 'Blue Formal Shirt', 799.00, 'categories/category-images/formalwear-circle-images/formalshirts-product-images/img3.jpg', 4.1, '', 'FormalWear'),
(10, 'Red Formal Shirt', 799.00, 'categories/category-images/formalwear-circle-images/formalshirts-product-images/img4.jpg', 4.4, '', 'FormalWear'),
(11, 'Brown Formal Shirt', 799.00, 'categories/category-images/formalwear-circle-images/formalshirts-product-images/img5.jpg', 4.0, '', 'FormalWear'),
(12, 'Plain Grey Formal Shirt', 799.00, 'categories/category-images/formalwear-circle-images/formalshirts-product-images/img6.jpg', 4.2, '', 'FormalWear'),
(13, 'Pink Bodycon Dress – slim, figure-hugging party wear', 1599.00, 'categories/category-images/dresses-circle-images/dresses-product-images/bodycon1.jpg', 4.3, '', 'Dresses'),
(14, 'Blue Bodycon Dress – slim, figure-hugging party wear', 1699.00, 'categories/category-images/dresses-circle-images/dresses-product-images/bodycon2.jpg', 4.4, '', 'Dresses'),
(15, 'Black Bodycon Dress – slim, figure-hugging party wear', 1799.00, 'categories/category-images/dresses-circle-images/dresses-product-images/bodycon3.jpg', 4.5, '', 'Dresses'),
(16, 'Olive Bodycon Dress – slim, figure-hugging party wear', 1499.00, 'categories/category-images/dresses-circle-images/dresses-product-images/bodycon4.jpg', 4.2, '', 'Dresses'),
(17, 'Brown Bodycon Dress – slim, figure-hugging party wear', 1699.00, 'categories/category-images/dresses-circle-images/dresses-product-images/bodycon5.jpg', 4.1, '', 'Dresses'),
(18, 'Green Bodycon Dress – slim, figure-hugging party wear', 1599.00, 'categories/category-images/dresses-circle-images/dresses-product-images/bodycon6.jpg', 4.3, '', 'Dresses'),
(19, 'Golden Floral Embroidered Clutch', 849.00, 'categories/category-images/bags-circle-images/clutch-product-images/clutch1.jpg', 4.3, '', 'Handbags'),
(20, 'Pastel Green Blossom Clutch', 889.00, 'categories/category-images/bags-circle-images/clutch-product-images/clutch2.jpg', 4.2, '', 'Handbags'),
(21, 'Pink Ethnic Embroidered Clutch', 999.00, 'categories/category-images/bags-circle-images/clutch-product-images/clutch3.jpg', 4.4, '', 'Handbags'),
(22, 'Golden Butterfly Floral Clutch', 999.00, 'categories/category-images/bags-circle-images/clutch-product-images/clutch4.jpg', 4.5, '', 'Handbags'),
(23, 'Lavender Blossom Hand Clutch', 899.00, 'categories/category-images/bags-circle-images/clutch-product-images/clutch5.jpg', 4.3, '', 'Handbags'),
(24, 'Elegant Ivory Pearl Clutch', 1099.00, 'categories/category-images/bags-circle-images/clutch-product-images/clutch6.jpg', 4.6, '', 'Handbags'),
(25, 'White Rose Lace Sandals', 1299.00, 'categories/category-images/footwear-circle-images/sandal-product-images/sandals1.jpg', 4.4, '', 'Footwear'),
(26, 'Crimson Bloom Heels', 1399.00, 'categories/category-images/footwear-circle-images/sandal-product-images/sandals2.jpg', 4.5, '', 'Footwear'),
(27, 'Blush Petal Stiletto Sandals', 1499.00, 'categories/category-images/footwear-circle-images/sandal-product-images/sandals3.jpg', 4.6, '', 'Footwear'),
(28, 'Orchid Blossom Block Heels', 1349.00, 'categories/category-images/footwear-circle-images/sandal-product-images/sandals4.jpg', 4.3, '', 'Footwear'),
(29, 'Violet Bloom Ankle Sandals', 1299.00, 'categories/category-images/footwear-circle-images/sandal-product-images/sandals5.jpg', 4.2, '', 'Footwear'),
(30, 'Midnight Rose Party Sandals', 1399.00, 'categories/category-images/footwear-circle-images/sandal-product-images/sandals6.jpg', 4.5, '', 'Footwear'),
(79, 'Summer Floral Dress', 199.00, 'arrival-images/img1.jpg', 4.5, '20% OFF', 'New Arrival'),
(80, 'Women\'s Casual Sneakers', 59.00, 'arrival-images/img2.jpg', 4.2, '20% OFF', 'New Arrival'),
(81, 'Leather Handbag', 120.00, 'arrival-images/img3.jpg', 4.4, '15% OFF', 'New Arrival'),
(82, 'Classic Sunglasses', 45.00, 'arrival-images/img4.jpg', 4.1, 'Buy 1 Get 1 50% Off', 'New Arrival'),
(83, 'Women\'s Cotton Shirt', 35.00, 'arrival-images/img5.jpg', 4.0, '10% OFF', 'New Arrival'),
(84, 'Women\'s Office Blazer', 89.00, 'arrival-images/img6.jpg', 4.3, '25% OFF', 'New Arrival'),
(85, 'Satin Slip Midi Dress', 79.00, 'arrival-images/img7.jpg', 4.5, '15% OFF', 'New Arrival'),
(86, 'Gold Layered Necklace Set', 39.00, 'arrival-images/img8.jpg', 4.2, '20% OFF', 'New Arrival'),
(87, 'Strappy Pencil Heel Sandals', 65.00, 'arrival-images/img9.jpg', 4.4, '65% OFF', 'New Arrival'),
(88, 'Green Twist Halter Neck Cape', 72.00, 'arrival-images/img10.jpg', 4.3, '10% OFF', 'New Arrival'),
(89, 'Square Neck Peplum Top', 48.00, 'arrival-images/img11.jpg', 4.2, '20% OFF', 'New Arrival'),
(90, 'Solid Color Waistcoat & Pant', 110.00, 'arrival-images/img12.jpg', 4.6, '30% OFF', 'New Arrival'),
(91, 'Black & Gold Embroidered Corset Top', 1499.00, 'categories/category-images/casualtops-circle-images/corsettop-product-images/corsettop1.jpg', 4.7, '', 'CasualTops'),
(92, 'White Printed Square-Neck Corset Top', 1299.00, 'categories/category-images/casualtops-circle-images/corsettop-product-images/corsettop2.jpg', 4.5, '', 'CasualTops'),
(93, 'Blue Handblock Printed Corset Top', 1399.00, 'categories/category-images/casualtops-circle-images/corsettop-product-images/corsettop3.jpg', 4.6, '', 'CasualTops'),
(94, 'White & Blue Abstract Print Corset Top', 1599.00, 'categories/category-images/casualtops-circle-images/corsettop-product-images/corsettop4.jpg', 4.8, '', 'CasualTops'),
(95, 'Beige Floral Printed Corset Top', 1349.00, 'categories/category-images/casualtops-circle-images/corsettop-product-images/corsettop5.jpg', 4.4, '', 'CasualTops'),
(96, 'Yellow Floral Embroidered Corset Top', 1499.00, 'categories/category-images/casualtops-circle-images/corsettop-product-images/corsettop6.jpg', 4.7, '', 'CasualTops'),
(97, 'Wedding Dress 1', 2999.00, 'ocassionimages/ocassion-category-images/wedding-products-img/wedding1.jpg', 4.8, '20% OFF', 'Wedding'),
(98, 'Wedding Dress 2', 3299.00, 'ocassionimages/ocassion-category-images/wedding-products-img/wedding2.jpg', 4.7, '15% OFF', 'Wedding'),
(99, 'Wedding Dress 3', 2799.00, 'ocassionimages/ocassion-category-images/wedding-products-img/wedding3.jpg', 4.6, '10% OFF', 'Wedding'),
(100, 'Wedding Dress 4', 3499.00, 'ocassionimages/ocassion-category-images/wedding-products-img/wedding4.jpg', 4.9, '25% OFF', 'Wedding'),
(101, 'Wedding Dress 5', 2599.00, 'ocassionimages/ocassion-category-images/wedding-products-img/wedding5.jpg', 4.5, '30% OFF', 'Wedding'),
(102, 'Wedding Dress 6', 2899.00, 'ocassionimages/ocassion-category-images/wedding-products-img/wedding6.jpg', 4.7, '18% OFF', 'Wedding'),
(103, 'Summer Vibes 1', 1499.00, 'ocassionimages/ocassion-category-images/summer-products-img/summer1.jpg', 4.4, '10% OFF', 'Summer'),
(104, 'Summer Vibes 2', 1699.00, 'ocassionimages/ocassion-category-images/summer-products-img/summer2.jpg', 4.5, '12% OFF', 'Summer'),
(105, 'Summer Vibes 3', 1599.00, 'ocassionimages/ocassion-category-images/summer-products-img/summer3.jpg', 4.6, '15% OFF', 'Summer'),
(106, 'Summer Vibes 4', 1799.00, 'ocassionimages/ocassion-category-images/summer-products-img/summer4.jpg', 4.7, '20% OFF', 'Summer'),
(107, 'Summer Vibes 5', 1899.00, 'ocassionimages/ocassion-category-images/summer-products-img/summer5.jpg', 4.5, '18% OFF', 'Summer'),
(108, 'Summer Vibes 6', 1999.00, 'ocassionimages/ocassion-category-images/summer-products-img/summer6.jpg', 4.8, '22% OFF', 'Summer'),
(109, 'Runway Look 1', 3999.00, 'ocassionimages/ocassion-category-images/runway-products-img/runway1.jpg', 4.9, '25% OFF', 'Runway'),
(110, 'Runway Look 2', 4199.00, 'ocassionimages/ocassion-category-images/runway-products-img/runway2.jpg', 4.8, '20% OFF', 'Runway'),
(111, 'Runway Look 3', 3899.00, 'ocassionimages/ocassion-category-images/runway-products-img/runway3.jpg', 4.7, '15% OFF', 'Runway'),
(112, 'Runway Look 4', 4499.00, 'ocassionimages/ocassion-category-images/runway-products-img/runway4.jpg', 4.9, '30% OFF', 'Runway'),
(113, 'Vacation Outfit 1', 1999.00, 'ocassionimages/ocassion-category-images/vacation-products-img/vacation1.jpg', 4.5, '10% OFF', 'Vacation'),
(114, 'Vacation Outfit 2', 2199.00, 'ocassionimages/ocassion-category-images/vacation-products-img/vacation2.jpg', 4.6, '12% OFF', 'Vacation'),
(115, 'Vacation Outfit 3', 2399.00, 'ocassionimages/ocassion-category-images/vacation-products-img/vacation3.jpg', 4.7, '15% OFF', 'Vacation'),
(116, 'Vacation Outfit 4', 2499.00, 'ocassionimages/ocassion-category-images/vacation-products-img/vacation4.jpg', 4.8, '18% OFF', 'Vacation'),
(117, 'Party Perfect 1', 2799.00, 'ocassionimages/ocassion-category-images/party-products-img/party1.jpg', 4.6, '15% OFF', 'Party'),
(118, 'Party Perfect 2', 2999.00, 'ocassionimages/ocassion-category-images/party-products-img/party2.jpg', 4.7, '18% OFF', 'Party'),
(119, 'Party Perfect 3', 2699.00, 'ocassionimages/ocassion-category-images/party-products-img/party3.jpg', 4.5, '12% OFF', 'Party'),
(120, 'Party Perfect 4', 2899.00, 'ocassionimages/ocassion-category-images/party-products-img/party4.jpg', 4.8, '20% OFF', 'Party'),
(121, 'Winter Warmth 1', 3199.00, 'ocassionimages/ocassion-category-images/winter-products-img/winter1.jpg', 4.6, '15% OFF', 'Winter'),
(122, 'Winter Warmth 2', 3399.00, 'ocassionimages/ocassion-category-images/winter-products-img/winter2.jpg', 4.7, '18% OFF', 'Winter'),
(123, 'Winter Warmth 3', 3599.00, 'ocassionimages/ocassion-category-images/winter-products-img/winter3.jpg', 4.8, '20% OFF', 'Winter'),
(124, 'Winter Warmth 4', 3799.00, 'ocassionimages/ocassion-category-images/winter-products-img/winter4.jpg', 4.5, '22% OFF', 'Winter'),
(125, 'Winter Warmth 5', 3499.00, 'ocassionimages/ocassion-category-images/winter-products-img/winter5.jpg', 4.7, '25% OFF', 'Winter'),
(126, 'Winter Warmth 6', 3699.00, 'ocassionimages/ocassion-category-images/winter-products-img/winter6.jpg', 4.9, '30% OFF', 'Winter'),
(127, 'Gold Flat Snake Chain Necklace', 749.00, 'categories/category-images/accessories-circle-images/necklace-product-images/necklace1.jpg', 4.6, '', 'Necklace'),
(128, 'Layered Pearl & Gold Necklace Set', 799.00, 'categories/category-images/accessories-circle-images/necklace-product-images/necklace2.jpg', 4.4, '', 'Necklace'),
(129, 'Minimalist Rectangular Bar Pendant Necklace', 699.00, 'categories/category-images/accessories-circle-images/necklace-product-images/necklace3.jpg', 4.5, '', 'Necklace'),
(130, 'Infinity Symbol Gold Necklace', 699.00, 'categories/category-images/accessories-circle-images/necklace-product-images/necklace4.jpg', 4.3, '', 'Necklace'),
(131, 'Heart Outline Gold Necklace', 649.00, 'categories/category-images/accessories-circle-images/necklace-product-images/necklace5.jpg', 4.2, '', 'Necklace'),
(132, 'Dainty Solitaire Pendant Gold Necklace', 599.00, 'categories/category-images/accessories-circle-images/necklace-product-images/necklace6.jpg', 4.1, '', 'Necklace'),
(133, 'Black Corset Flare Denim Dress', 1899.00, 'categories/category-images/denim-circle-images/dress-product-images/dress1.jpg', 4.6, '', 'Denim Dress'),
(134, 'Strappy Sky Blue Denim Bodycon Dress', 2199.00, 'categories/category-images/denim-circle-images/dress-product-images/dress2.jpg', 4.7, '', 'Denim Dress'),
(135, 'Classic Indigo Maxi Denim Dress', 2799.00, 'categories/category-images/denim-circle-images/dress-product-images/dress3.jpg', 4.8, '', 'Denim Dress'),
(136, 'Light Wash Summer Flare Denim Dress', 1699.00, 'categories/category-images/denim-circle-images/dress-product-images/dress4.jpg', 4.4, '', 'Denim Dress'),
(137, 'Dark Wash Belted Bodycon Denim Dress', 2399.00, 'categories/category-images/denim-circle-images/dress-product-images/dress5.jpg', 4.6, '', 'Denim Dress'),
(138, 'Frayed Corset Mini Denim Dress', 1999.00, 'categories/category-images/denim-circle-images/dress-product-images/dress6.jpg', 4.5, '', 'Denim Dress'),
(139, 'Black Wrap Mini Skirt', 799.00, 'categories/category-images/bottomwear-circle-images/skirts-product-images/skirts1.jpg', 4.4, '', 'Skirts'),
(140, 'Brown Faux Leather Mini Skirt', 1099.00, 'categories/category-images/bottomwear-circle-images/skirts-product-images/skirts5.jpg', 4.7, '', 'Skirts'),
(141, 'Black Pleated Skater Skirt', 849.00, 'categories/category-images/bottomwear-circle-images/skirts-product-images/skirts3.jpg', 4.5, '', 'Skirts'),
(142, 'Black Buttoned A-Line Mini Skirt', 899.00, 'categories/category-images/bottomwear-circle-images/skirts-product-images/skirts4.jpg', 4.5, '', 'Skirts'),
(143, 'Grey Pencil Mini Skirt', 899.00, 'categories/category-images/bottomwear-circle-images/skirts-product-images/skirts2.jpg', 4.6, '', 'Skirts'),
(144, 'Black High-Slit Maxi Skirt', 1299.00, 'categories/category-images/bottomwear-circle-images/skirts-product-images/skirts6.jpg', 4.6, '', 'Skirts');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `review`, `rating`, `created_at`) VALUES
(1, 'yashshree', 'loved the quality!', 5, '2025-08-18 17:21:56'),
(3, 'mansi', 'I bought a pair of high-waist jeans and they are my new favorite! Great quality and super comfortable for daily wear', 5, '2025-08-18 17:25:43'),
(4, 'harsha', 'The cocktail dress I ordered was stunning! The fabric feels luxurious and the fit was just perfect. Totally worth it.', 5, '2025-08-18 17:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'yashshree', 'mane@gmail.com', '1234', 'user', '2025-08-18 06:41:37'),
(3, 'mansi', 'mansi@example.com', '5678', 'user', '2025-08-18 10:45:59'),
(4, 'Admin', 'admin@lumora.com', 'admin123', 'admin', '2025-08-24 16:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`) VALUES
(37, 3, 137, '2025-08-20 05:25:57'),
(41, 3, 81, '2025-08-22 06:26:00'),
(46, 2, 82, '2025-08-24 15:19:14'),
(47, 2, 85, '2025-08-24 15:19:23'),
(48, 2, 137, '2025-08-24 15:20:44'),
(49, 2, 114, '2025-08-24 15:41:14'),
(51, 2, 88, '2025-08-24 16:53:07'),
(52, 2, 122, '2025-08-24 17:06:54'),
(53, 2, 89, '2025-08-25 07:45:24'),
(54, 3, 82, '2025-08-25 14:06:23'),
(55, 3, 88, '2025-08-25 14:11:46'),
(56, 2, 23, '2025-08-25 14:20:33'),
(57, 2, 92, '2025-08-25 15:10:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_status` (`status_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_wishlist` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_status` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
