-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 06:07 AM
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
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` varchar(1000) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `room_id` varchar(10) NOT NULL,
  `num_people` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `day_amount` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `room_id`, `num_people`, `check_in_date`, `check_out_date`, `day_amount`, `total_price`, `booking_date`) VALUES
('1', '5', '1', 2, '2024-03-07', '2024-03-09', 2, 10000, '2024-03-08 10:56:24'),
('2', '5', '1', 1, '2024-03-13', '2024-03-14', 1, 5000, '2024-03-08 14:22:22'),
('3', '2', '2', 1, '2024-03-08', '2024-03-10', 2, 5400, '2024-03-08 15:32:54'),
('4', '2', '4', 2, '2024-03-09', '2024-03-10', 1, 2500, '2024-03-08 18:08:39'),
('5', '3', '10', 1, '2024-03-10', '2024-03-12', 2, 12000, '2024-03-09 04:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_id` varchar(10) NOT NULL,
  `detail` varchar(10000) NOT NULL,
  `facility` varchar(10000) NOT NULL,
  `max_people` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'available',
  `img` varchar(1000) DEFAULT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `type_id`, `detail`, `facility`, `max_people`, `price`, `status`, `img`, `create_at`) VALUES
('1', 'cat room (2เตียง 45ตารางเมตร)', '2', 'พบกับความสะดวกสบายในห้องพักขนาดกว้างขวาง 45 ตารางเมตร ที่มาพร้อมกับระบบปรับอากาศทันสมัย และห้องน้ำส่วนตัวที่ออกแบบมาเพื่อความเป็นส่วนตัว', 'โคมไฟ ทีวี โต๊ะและเก้าอี้อำนวยความสะดวก ตู้เก็บของ', 2, 5000, 'available', 'room1.jpg', '2024-03-07'),
('10', 'cat room (2เตียง 25ตารางเมตร)', '2', 'ขอเชิญคุณมาสัมผัสกับห้องพักที่มีขนาด 25 ตารางเมตร ที่ให้ความอบอุ่นและสว่างไสว ที่นี่คุณจะได้พบกับเตียงที่จัดวางอย่างเป็นระเบียบและตกแต่งภายในที่เรียบหรู ชวนให้ผู้เข้าพักได้สัมผัสกับความสะดวกสบายและการพักผ่อนที่ผ่อนคลาย ห้องพักของเราพร้อมต้อนรับคุณด้วยความอบอุ่นและบรรยากาศที่เหมาะสำหรับการฟื้นฟูจิตใจ มาร่วมสร้างความทรงจำที่ไม่รู้ลืมไปกับเราที่นี่', 'โต๊ะและเก้าอี้อำนวยความสะดวก', 2, 6000, 'available', 'room10.jpg', '2024-03-08'),
('2', 'bird room (1เตียง 25ตารางเมตร)', '1', 'สัมผัสประสบการณ์การพักผ่อนในห้องพักที่อบอุ่นและเป็นส่วนตัว ด้วยพื้นที่ใช้สอย 25 ตารางเมตร ที่ออกแบบมาอย่างลงตัว ห้องนี้มาพร้อมกับระบบปรับอากาศที่ทันสมัย และมีการแบ่งสัดส่วนระหว่างห้องน้ำและห้องนอนอย่างชัดเจน เพื่อให้คุณได้พักผ่อนอย่างเต็มที่โดยไม่ถูกรบกวน', 'ทีวี โต๊ะและเก้าอี้อำนวยความสะดวก', 1, 2700, 'available', 'room2.jpg', '2024-03-07'),
('3', 'cat room (2เตียง 30ตารางเมตร)', '2', 'เชิญคุณเข้าสู่ห้องพักที่เต็มไปด้วยความสงบและความอบอุ่นที่มีขนาด 30 ตารางเมตร ที่นี่คุณจะได้พบกับเตียงนุ่มนวลสองเตียงที่รอให้คุณได้พักผ่อน และหน้าต่างขนาดใหญ่ที่เปิดรับแสงแดดอ่อนโยน เพื่อสร้างบรรยากาศที่เหมาะสำหรับการฟื้นฟูร่างกายและจิตใจ นอกจากนี้ ห้องนั่งเล่นที่แยกออกมายังเป็นพื้นที่ที่สมบูรณ์แบบสำหรับการผ่อนคลาย พร้อมด้วยห้องน้ำส่วนตัวที่มอบความเป็นส่วนตัวและความสะดวกสบายในทุกๆ วันของการเข้าพักของคุณ', 'ทีวี โต๊ะและเก้าอี้อำนวยความสะดวก ทีวี โซฟา ', 2, 5700, 'available', 'room3.jpg', '2024-03-08'),
('4', 'cat room (1เตียง 25ตารางเมตร)', '2', 'เข้ามาสัมผัสกับห้องพักที่เต็มไปด้วยความสงบและความหรูหราทีมี่ขนาด 25 ตารางเมตร ที่นี่คุณจะได้พักผ่อนในห้องที่มีแสงสว่างธรรมชาติส่องผ่าน พร้อมทิวทัศน์ที่ติดกับสระว่ายน้ำ ที่จะทำให้ทุกวันของคุณพิเศษยิ่งขึ้น ขอเชิญคุณมาสัมผัสประสบการณ์ที่ไม่เหมือนใคร ที่ห้องพักของเราที่เต็มไปด้วยความสงบและความหรูหรา', 'ทีวี โต๊ะและเก้าอี้อำนวยความสะดวก ทีวี wifi-free ', 2, 2500, 'available', 'room4.jpg', '2024-03-08'),
('5', 'cat room (1เตียง 50ตารางเมตร)', '2', 'ขอเชิญคุณมาสัมผัสกับห้องพักขนาด 50 ตารางเมตรที่เต็มไปด้วยความสงบและความหรูหรา ที่นี่คุณจะได้พักผ่อนในห้องที่มีแสงสว่างธรรมชาติส่องผ่าน พร้อมทิวทัศน์ที่สวยงาม ที่จะทำให้ทุกวันของคุณพิเศษยิ่งขึ้น ขอเชิญคุณมาสัมผัสประสบการณ์ที่ไม่เหมือนใคร', 'ทีวี โซฟา ทีวี wifi-free ห้องครัว', 2, 3000, 'available', 'room5.jpg', '2024-03-08'),
('6', 'elephant room (10เตียง 100ตารางเมตร)', '4', 'ขอเชิญคุณมาสัมผัสกับความสะดวกสบายและความอบอุ่นในห้องพักของเราที่สามารถรองรับผู้เข้าพักได้ถึง 10 คนและมีขนาดห้องถึง 100 ตารางเมตร ที่นี่คุณจะได้พบกับเตียงที่ออกแบบมาเพื่อความสบาย พร้อมทั้งพื้นที่ที่เหมาะสำหรับการพักผ่อนร่วมกับครอบครัวหรือกลุ่มเพื่อน ไม่ว่าจะเป็นการเฉลิมฉลองพิเศษหรือการพักผ่อนแบบส่วนตัว เราพร้อมให้บริการคุณด้วยห้องพักที่เต็มไปด้วยความสะดวกสบายและบรรยากาศที่อบอุ่น มาร่วมสร้างความทรงจำที่ไม่รู้ลืมไปกับเราที่นี่', 'โต๊ะวางของ', 10, 10000, 'available', 'room6.jpg', '2024-03-08'),
('7', 'bird room (1เตียง 25ตารางเมตร)', '1', 'ขอเชิญคุณมาสัมผัสกับห้องพักที่มีขนาด 25 ตารางเมตรที่อบอุ่นและหรูหรา พร้อมทิวทัศน์ติดทะเล ที่จะทำให้ทุกวันของคุณพิเศษยิ่งขึ้น ขอเชิญคุณมาสัมผัสประสบการณ์ที่ไม่เหมือนใคร', 'ทีวี โคมไฟ', 2, 10000, 'available', 'room7.jpg', '2024-03-08'),
('8', 'bird room (1เตียง 25ตารางเมตร)', '1', 'เปิดประตูเข้าสู่ห้องพักที่มีขนาด 20 ตารางเมตร เต็มไปด้วยความสงบและความอบอุ่น ที่นี่คุณจะได้พบกับเตียงนุ่มนวลที่จัดวางอย่างเป็นระเบียบ และการตกแต่งภายในที่เรียบหรู ที่จะช่วยให้คุณผ่อนคลายและฟื้นฟูจิตใจ ห้องพักของเราพร้อมต้อนรับคุณด้วยความสะดวกสบายและบรรยากาศที่อบอุ่น ที่จะทำให้ทุกวันของการพักผ่อนของคุณเป็นวันที่พิเศษ', 'โคมไฟ ทีวี โต๊ะและเก้าอี้อำนวยความสะดวก', 1, 2500, 'available', 'room8.jpg', '2024-03-08'),
('9', 'lion room (4เตียง 50ตารางเมตร)', '3', 'ขอเชิญคุณมาสัมผัสกับห้องพักที่ออกแบบมาอย่างลงตัวสำหรับ 4 คนและมีขนาดถึง 50 ตารางเมตร ที่นี่คุณจะได้พบกับความสะดวกสบายในห้องพักที่มีระบบปรับอากาศ พร้อมห้องน้ำส่วนตัวที่ตั้งอยู่ใกล้เคียง ทุกองค์ประกอบถูกออกแบบมาเพื่อให้คุณได้พักผ่อนอย่างเต็มที่ ไม่ว่าจะเป็นการเดินทางมาเพื่อธุรกิจหรือการพักผ่อน ห้องพักของเราพร้อมต้อนรับคุณด้วยความอบอุ่นและความสะดวกสบายที่คุณคู่ควรได้รับ.', 'ทีวี โต๊ะและเก้าอี้อำนวยความสะดวก', 4, 4000, 'available', 'room9.jpg', '2024-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `type_room`
--

CREATE TABLE `type_room` (
  `id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `type_room`
--

INSERT INTO `type_room` (`id`, `name`) VALUES
('1', 'standard'),
('2', 'elite'),
('3', 'superior'),
('4', 'master');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `role` varchar(5) NOT NULL DEFAULT 'user',
  `create_at` date NOT NULL DEFAULT current_timestamp(),
  `img` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `phone`, `fname`, `lname`, `role`, `create_at`, `img`) VALUES
('1', 'admin@hotmail.com', '0123', '0123456789', 'admin', 'minad', 'admin', '2024-03-05', 'admin.png'),
('2', 'user1@hotmail.com', '123456', '0283891835', 'Fname1', 'Lname1', 'user', '2024-03-05', NULL),
('3', 'user2@hotmail.com', '0123', '0895384235', 'Fname2', 'Lname2', 'user', '2024-03-05', NULL),
('4', 'user4@hotmail.com', '0246', '0321456788', 'Fname4', 'Lname4', 'user', '2024-03-05', NULL),
('5', 'chirawat.yana@hotmail.com', '4321', '0950385384', 'จีรวัฒน์', 'ญานะ', 'user', '2024-03-06', 'undertale.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_room`
--
ALTER TABLE `type_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
