-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2022 at 01:09 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(5, 13, 2, 2),
(8, 14, 1, 1),
(9, 14, 10, 1),
(10, 14, 21, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `extra` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `image`, `extra`) VALUES
(1, 'Blankets & throws', 'blankets.PNG', 'Soft and Luxurious'),
(2, 'Mattresses', 'Mattresses.png', 'Get a super soft cloud-like sleep.'),
(3, 'Duvet covers sets', 'duvetcover.webp', 'Your bedding says a lot about you!'),
(4, 'Duvets', 'duvet.png', 'what you need for a comfortable night’s sleep.'),
(5, 'Pillows', 'pillows.jpg', 'Back, side, hug-your-pillow sleepers, we have pillows for everyone!'),
(6, 'Sheets', 'sheets.png', 'With our soft sheets your good night is guaranteed.');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int NOT NULL,
  `coupon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `discount` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_name`, `discount`, `count`) VALUES
(1, 'orange', 20, 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `total_price` int NOT NULL,
  `user_id` int NOT NULL,
  `order_date` datetime NOT NULL,
  `order_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `order_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `postal_code` int NOT NULL,
  `coupon_id` int DEFAULT NULL,
  `order_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `total_price`, `user_id`, `order_date`, `order_address`, `order_phone`, `postal_code`, `coupon_id`, `order_city`) VALUES
(2, 1, 13, '2022-10-04 00:00:00', 'amman', '0782222111', 44252, 1, 'Amman'),
(3, 1, 13, '2022-10-04 00:00:00', 'amman', '0782222111', 44252, 1, 'Amman'),
(4, 1, 13, '2022-10-04 00:00:00', 'amman', '0782222111', 12345, 1, 'Amman'),
(5, 1, 13, '2022-10-04 00:00:00', 'amman', '0782222111', 1234, 1, 'Amman'),
(6, 1, 13, '2022-10-04 00:00:00', 'amman', '0782222111', 12345, 1, 'Amman'),
(7, 1, 13, '2022-10-04 00:00:00', 'amman', '0782222111', 8899, 1, 'Amman'),
(8, 1, 13, '2022-10-04 00:00:00', 'amman', 'awajnah', 6678, 1, 'Amman'),
(9, 1, 13, '2022-10-04 00:00:00', 'amman', '0782222111', 1245, 1, 'Amman'),
(10, 1, 13, '2022-10-05 00:00:00', 'amman', '0782222111', 1000, 1, 'Amman'),
(11, 1, 13, '2022-10-05 00:00:00', 'asdas', '0782222111', 10000, 1, 'sadsad');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_id` int NOT NULL,
  `unit_price` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int NOT NULL,
  `description` text NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `category_id` int NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `offers` tinyint NOT NULL DEFAULT '0',
  `new_arrive` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `description`, `image1`, `image2`, `image3`, `category_id`, `discount`, `offers`, `new_arrive`) VALUES
(1, 'Throw, pale pink, 130x170 cm', 32, 'This light pink knitted throw in acrylic and cotton is nice to wrap around you to feel cosy on the balcony or on the sofa indoors. A lovely and warming splash of colour that feels soft against your skin.', 'Picture37.jpg', 'Picture25.jpg', 'Picture26.jpg', 1, 15, 1, 1),
(2, 'Throw, dark green, 130x170 cm', 10, 'When all you want is something in the sofa to cuddle up in. INGRUN throw is lightweight and warm, so you might decide to keep it on even when you get up. The dark green tones soften up any place in your home.', 'Picture27.jpg', 'Picture28.jpg', 'Picture29.jpg', 1, 25, 1, 1),
(3, 'Throw, red-brown/white, 130x170 cm', 35, 'Here’s something cosy to wrap yourself into as the season gets colder. This throw is made from stain-resistant and super soft wool in a blush tone that instantly adds warmth to the room.', 'Picture30.jpg', 'Picture31.jpg', 'Picture32.jpg', 1, 5, 1, 1),
(4, 'Throw, off-white, 120x160 cm', 4, 'Super-soft, easy-care fleece throw in off-white made from recycled polyester. Keeps you cosy on chilly evenings whether you’re cuddling in the sofa or need an extra layer of warmth while eating al fresco.', 'Picture33.jpg', 'Picture34.jpg', 'Picture35.jpg', 1, 0, 0, 1),
(5, 'Throw, black, 120x160 cm', 25, 'Wonderfully warm throw with fluffy faux fur on one side and smooth velvet on the other – both made of recycled polyester. Created with Swedish House Mafia, just like the matching OBEGRÄNSAD cushion cover.', 'Picture36.jpg', 'Picture37.jpg', 'Picture39.jpg', 1, 0, 0, 0),
(6, 'Throw, grey, 120x160 cm', 4, 'Wrap this striped throw over your legs as you sit down in your favourite armchair. Or bring it on the next picnic – the fleece material makes it easy to carry and you can machine wash it.', 'Picture40.jpg', 'Picture41.jpg', 'Picture42.jpg', 1, 0, 0, 0),
(7, 'Pouffe/mattress, foldable', 119, 'Kids love being on a soft mattress on the floor – this one is great for tumbling, lounging or hanging out with friends. When it’s time to tidy up just fold it and tuck it away under SLÄKT bed.', 'Picture43.jpg', 'Picture44.jpg', 'Picture45.jpg', 2, 0, 0, 0),
(8, 'Foam mattress, firm/light blue, 80x200 cm', 50, 'This basic firm foam mattress is 10 cm high. Resilient foam is combined with a soft layer of wadding.', 'Picture46.jpg', 'Picture47.jpg', 'Picture48.jpg', 2, 0, 0, 0),
(9, 'Foam mattress, firm/white, 160x200 cm', 399, 'A firm 20 cm high foam mattress with 3 layers of comfort and support. A washable cover and a top layer of high-resilience foam combined with memory foam and comfort zones for even body weight distribution.', 'Picture49.jpg', 'Picture50.jpg', 'Picture51.jpg', 2, 0, 0, 0),
(10, 'Pocket sprung mattress, extra firm/natural, 180x200 cm', 749, 'An extra-firm 26 cm high mattress with pocket springs and natural materials. Even distribution of body weight by comfort zones, softer support around hips and shoulders – and natural latex to add comfort.', 'Picture52.jpg', 'Picture53.jpg', 'Picture54.jpg', 2, 0, 0, 0),
(11, 'Pocket sprung mattress, firm/light blue, 180x200 cm', 259, 'A firm 24 cm high mattress with individual pocket springs. Even distribution of body weight by comfort zones offers softer support for hips and shoulders. A thick layer of foam adds to the comfort.', 'Picture55.jpg', 'Picture56.jpg', 'Picture57.jpg', 2, 0, 0, 0),
(12, 'Sprung mattress, extra firm/light blue, 90x200 cm', 79, 'A straightforward 17 cm high spring mattress. It´s extra-firm with Bonnell springs, while a layer of foam on top and wadding in the cover provide cushioning.', 'Picture58.jpg', 'Picture59.jpg', 'Picture60.jpg', 2, 50, 1, 1),
(13, 'Duvet cover and 2 pillowcases, white/blue, 240x220/50x80 cm', 79, 'Looking for easy-care and non-shrink bed textiles that resist wrinkling? Then this blend of recycled polyester and sustainably grown cotton might be just the thing for you.', 'Picture61.jpg', 'Picture62.jpg', 'Picture63.jpg', 3, 0, 0, 0),
(14, 'Duvet cover and 2 pillowcases, white/blue, 240x220/50x80 cm', 15, 'Looking for easy-care and non-shrink bed textiles that resist wrinkling? Then this blend of polyester and sustainably grown cotton might be just the thing for you.', 'Picture64.jpg', 'Picture65.jpg', 'Picture66.jpg', 3, 0, 0, 0),
(15, 'Duvet, warm, 240x220 cm', 119, 'A warm, lightweight duvet with ultra-soft comfort. The hollow polyester fibre filling is a fluff-lover’s dream, surrounded by dobby woven cotton fabric that adds to the sense of luxury and well-being.', 'Picture67.jpg', 'Picture68.jpg', NULL, 4, 0, 0, 0),
(16, 'Duvet, extra warm, 150x200 cm', 69, 'A cosy duvet with stitched inner walls that retain the heat for extra warmth. The cotton fabric and 90% feather/10% down filling give a snug and crisp feel.', 'Picture69.jpg', 'Picture70.jpg', NULL, 4, 0, 0, 0),
(17, 'Ergonomic pillow, side/back sleeper, 41x71 cm', 49, 'One side gives optimal support for side sleeping and the other for back sleeping. The cushioning memory foam is like a surprisingly supportive cloud that keeps the same comfy temperature all night.', 'Picture71.jpg', 'Picture72.jpg', NULL, 6, 0, 0, 0),
(18, 'Ergonomic pillow, side/back sleeper, 50x80 cm', 15, 'This ergonomic pillow provides cradling comfort and lasting resilience thanks to the shredded memory foam inside. A flexible companion that accommodates most sleeping styles.', 'Picture73.jpg', 'Picture74.jpg', 'Picture75.jpg', 6, 0, 0, 0),
(19, 'Ergonomic pillow, side/back sleeper, 41x70 cm', 39, 'This ergonomic pillow provides cradling comfort and lasting resilience thanks to the shredded memory foam inside. A flexible companion that accommodates most sleeping styles.', 'Picture76.jpg', 'Picture77.jpg', NULL, 6, 10, 1, 1),
(20, 'Sheet, white, 240x260 cm', 35, 'RÖNNVECKMAL sheets and pillowcases are of high-quality cotton percale. They feel cool, dry and crisp against the skin and the extra high thread count means they will last for many sweet dreams.', 'Picture78.jpg', 'Picture79.jpg', NULL, 5, 0, 0, 0),
(21, 'Fitted sheet, beige/dark grey, 160x200 cm', 20, 'This fitted sheet with classic paisley pattern in soft tones is made from sustainably sourced cotton and viscose. The material blend helps maintain an even temperature and keeps you comfy all night.', 'Picture80.jpg', 'Picture81.jpg', NULL, 5, 0, 0, 1),
(22, 'Fitted sheet, light pink, 160x200 cm', 18, 'Cotton is a soft, natural material that breathes, absorbs moisture and feels comfortable against your skin. Also, our cotton is sustainably grown. So you can sleep well – with a clean conscience.', 'Picture82.jpg', 'Picture83.jpg', 'Picture84.jpg', 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `address`, `phone`, `email`, `password`, `is_admin`, `city`) VALUES
(13, 'Ahemd', 'Khaleds', 'amman', '0782222111', 'ahmed@gmail.com', '01230123', 1, 'Amman'),
(14, 'Yousef', 'Khaled', 'Amman , Khalda', '+962781234567', 'yousef@gmail.com', '01230123Yousef#', 0, 'Amman'),
(15, 'Waad', 'Awajnah', 'Amman', '+962781234123', 'waad@gmail.com', '01230123Waad#', 0, 'Amman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
