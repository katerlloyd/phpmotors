-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 07:03 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(6, 'Jannik', 'Zima', 'test2@test.com', '$2y$10$r6Hrr2sAaZKzLNd.UAu.0uWUk1mI40GFe1gkaSboFKBZ/PtFC0oBS', '1', NULL),
(7, 'Senic', 'Zraja', 'test3@test.com', '$2y$10$uNy1xW/tlo2gSZgyhUXzRuy8NJ1JMOKvPUwlmJjAI/DMuBd9f8cKe', '1', NULL),
(8, 'Admin', 'User', 'admin@cse340.net', '$2y$10$0mfGt8GRe62wXF2qE0mOjOzAO/7OOdhFyg0jQRF1D9/A59qH1rGEe', '3', NULL),
(9, 'Kate', 'Lloyd', 'test@test.com', '$2y$10$J8DOjqv3BCBNlayWdi/HEOt3PXzbyBhgV9axpkdJwrZgcF8E.RjiC', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(11) UNSIGNED NOT NULL,
  `invId` int(11) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(9, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2022-03-15 20:47:52', 1),
(10, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2022-03-15 20:47:52', 1),
(11, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2022-03-15 20:48:35', 1),
(12, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2022-03-15 20:48:35', 1),
(13, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2022-03-15 20:49:07', 1),
(14, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2022-03-15 20:49:07', 1),
(15, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2022-03-15 20:49:20', 1),
(16, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2022-03-15 20:49:20', 1),
(17, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2022-03-15 20:49:45', 1),
(18, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2022-03-15 20:49:45', 1),
(19, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2022-03-15 20:49:58', 1),
(20, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2022-03-15 20:49:58', 1),
(21, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2022-03-15 20:50:22', 1),
(22, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2022-03-15 20:50:22', 1),
(23, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2022-03-15 20:50:55', 1),
(24, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2022-03-15 20:50:55', 1),
(25, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2022-03-15 20:51:09', 1),
(26, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2022-03-15 20:51:09', 1),
(27, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2022-03-15 20:51:22', 1),
(28, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2022-03-15 20:51:22', 1),
(29, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2022-03-15 20:51:49', 1),
(30, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2022-03-15 20:51:49', 1),
(31, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2022-03-15 20:51:59', 1),
(32, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2022-03-15 20:51:59', 1),
(33, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2022-03-15 20:52:09', 1),
(34, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2022-03-15 20:52:10', 1),
(35, 15, 'hot-dog.jpg', '/phpmotors/images/vehicles/hot-dog.jpg', '2022-03-15 20:54:20', 1),
(36, 15, 'hot-dog-tn.jpg', '/phpmotors/images/vehicles/hot-dog-tn.jpg', '2022-03-15 20:54:20', 1),
(39, 1, 'jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '2022-03-15 20:56:06', 1),
(40, 1, 'jeep-wrangler-tn.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '2022-03-15 20:56:06', 1),
(41, 32, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2022-03-15 21:06:23', 1),
(42, 32, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2022-03-15 21:06:23', 1),
(43, 31, 'car.png', '/phpmotors/images/vehicles/car.png', '2022-03-15 21:12:19', 0),
(44, 31, 'car-tn.png', '/phpmotors/images/vehicles/car-tn.png', '2022-03-15 21:12:19', 0),
(47, 32, 'car3.png', '/phpmotors/images/vehicles/car3.png', '2022-03-15 21:15:51', 0),
(48, 32, 'car3-tn.png', '/phpmotors/images/vehicles/car3-tn.png', '2022-03-15 21:15:51', 0),
(49, 1, 'car4.jpg', '/phpmotors/images/vehicles/car4.jpg', '2022-03-16 16:58:49', 0),
(50, 1, 'car4-tn.jpg', '/phpmotors/images/vehicles/car4-tn.jpg', '2022-03-16 16:58:49', 0),
(51, 1, 'car2.jpg', '/phpmotors/images/vehicles/car2.jpg', '2022-03-16 18:06:26', 0),
(52, 1, 'car2-tn.jpg', '/phpmotors/images/vehicles/car2-tn.jpg', '2022-03-16 18:06:26', 0),
(53, 1, 'car10.jpg', '/phpmotors/images/vehicles/car10.jpg', '2022-03-16 18:31:47', 0),
(54, 1, 'car10-tn.jpg', '/phpmotors/images/vehicles/car10-tn.jpg', '2022-03-16 18:31:47', 0),
(55, 31, 'car8.jpg', '/phpmotors/images/vehicles/car8.jpg', '2022-03-16 18:32:38', 1),
(56, 31, 'car8-tn.jpg', '/phpmotors/images/vehicles/car8-tn.jpg', '2022-03-16 18:32:38', 1),
(57, 31, 'car9.jpg', '/phpmotors/images/vehicles/car9.jpg', '2022-03-16 18:32:49', 0),
(58, 31, 'car9-tn.jpg', '/phpmotors/images/vehicles/car9-tn.jpg', '2022-03-16 18:32:49', 0),
(59, 31, 'car6.jpg', '/phpmotors/images/vehicles/car6.jpg', '2022-03-16 18:33:00', 0),
(60, 31, 'car6-tn.jpg', '/phpmotors/images/vehicles/car6-tn.jpg', '2022-03-16 18:33:00', 0),
(61, 32, 'car11.jpg', '/phpmotors/images/vehicles/car11.jpg', '2022-03-16 18:33:13', 0),
(62, 32, 'car11-tn.jpg', '/phpmotors/images/vehicles/car11-tn.jpg', '2022-03-16 18:33:13', 0),
(63, 32, 'car7.jpg', '/phpmotors/images/vehicles/car7.jpg', '2022-03-16 18:33:29', 0),
(64, 32, 'car7-tn.jpg', '/phpmotors/images/vehicles/car7-tn.jpg', '2022-03-16 18:33:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(11) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/images/vehicles/jeep-wrangler.jpg', '/images/vehicles/jeep-wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/images/vehicles/ford-modelt.jpg', '/images/vehicles/ford-modelt-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/images/vehicles/lambo-Adve.jpg', '/images/vehicles/lambo-Adve-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/images/vehicles/monster.jpg', '/images/vehicles/monster-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/images/vehicles/ms.jpg', '/images/vehicles/ms-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/images/vehicles/bat.jpg', '/images/vehicles/bat-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/images/vehicles/mm.jpg', '/images/vehicles/mm-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/images/vehicles/fire-truck.jpg', '/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/images/vehicles/crown-vic.jpg', '/images/vehicles/crown-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/images/vehicles/camaro.jpg', '/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/images/vehicles/escalade.jpg', '/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/images/vehicles/hummer.jpg', '/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/images/vehicles/aerocar.jpg', '/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/images/vehicles/fbi.jpg', '/images/vehicles/fbi-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/images/vehicles/hot-dog.jpg', '/images/vehicles/hot-dog-tn.jpg', '35000', 1, 'Brown', 2),
(31, 'Ford', 'Focus', 'A car', '/images/vehicles/no-image.png', '/images/vehicles/no-image-tn.png', '4000', 3, 'Blue', 2),
(32, 'DMC', 'Delorean', 'This car is almost too futuristic with its 3 cup holders, superman doors, and fuzzy dice!', '/images/vehicles/delorean.jpg', '/images/vehicles/delorean-tn.jpg', '100000', 1, 'Silver', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `InvId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `InvId`, `clientId`) VALUES
(18, 'This is a new review.', '2022-03-23 16:34:30', 1, 8),
(21, 'Here are the words of the sage: chocolate is good.', '2022-03-24 17:20:42', 1, 8),
(23, 'This is the best car I have ever driven. You should buy it.', '2022-03-30 19:32:20', 31, 8),
(24, 'This thing works surprisingly well for its dubious appearance.', '2022-04-01 16:01:55', 5, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`InvId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`InvId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
