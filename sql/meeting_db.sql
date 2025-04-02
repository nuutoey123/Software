-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 08:56 PM
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
-- Database: `meeting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `booking_date` date NOT NULL,
  `time_slot` varchar(50) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `sub_department_id` int(11) DEFAULT NULL,
  `meeting_topic` varchar(255) DEFAULT NULL,
  `meeting_detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `customer_name`, `customer_phone`, `booking_date`, `time_slot`, `department_id`, `sub_department_id`, `meeting_topic`, `meeting_detail`) VALUES
(33, 1, 'dxkfewz', 'qwdqwdqwd', '2025-04-16', '09:00 - 12:00', 8, 23, NULL, NULL),
(34, 1, 'dxkfewz', '0936380002', '2025-04-03', '09:00 - 12:00', 8, 23, NULL, NULL),
(35, 1, 'ภานุวัฒน์', '0936380002', '2025-04-03', '13:00 - 16:00', 2, 5, NULL, NULL),
(36, 1, 'ธนไชย โลกเลื่อง', '0943301218', '2025-04-09', '09:00 - 12:00', NULL, 12, 'การเลือกตั้ง', 'คุยประเด็นเกี่ยวกับการเลือกตั้ง');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'กองสวัสดิการสังคม'),
(2, 'กองทรัพยากรธรรมชาติและสิ่งแวดล้อม'),
(3, 'สำนักช่าง'),
(4, 'กองผังเมือง'),
(5, 'สำนักปลัดองค์การบริหารส่วนจังหวัด'),
(6, 'สำนักงานเลขานุการ อบจ.'),
(7, 'กองสาธารณสุข'),
(8, 'กองการศึกษา ศาสนา และวัฒนธรรม'),
(9, 'กองยุทธศาสตร์และงบประมาณ'),
(10, 'สำนักคลัง');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `equipment` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `size`, `equipment`, `image`) VALUES
(1, 'ห้องขนาดเล็ก 105', '2-4 ท่าน', 'โปรเจ็กเตอร์ 1 ปลั๊กพ่วง 1', 'room1-4.jpg,room1-5.jpg'),
(2, 'ห้องขนาดเล็ก 106', '4-6 ท่าน', 'จอทีวี 1 โปรเจ็กเตอร์ 1', 'room2-1.jpg,room2-2.jpg,room2-3.jpg,room2-4.jpg,room2-5.jpg,room2-6.jpg,room2-7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_departments`
--

CREATE TABLE `sub_departments` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_departments`
--

INSERT INTO `sub_departments` (`id`, `department_id`, `name`) VALUES
(1, 1, 'ฝ่ายสังคมสงเคราะห์'),
(2, 1, 'ฝ่ายกิจการสตรี และคนชรา'),
(3, 1, 'ฝ่ายส่งเสริมสวัสดิการสังคม'),
(4, 1, 'ฝ่ายพัฒนาชุมชน'),
(5, 2, 'ฝ่ายทรัพยากรธรรมชาติ'),
(6, 2, 'ฝ่ายสิ่งแวดล้อม'),
(7, 3, 'ส่วนจัดกรรมสิทธิ์การก่อสร้าง'),
(8, 3, 'ส่วนพัฒนาโครงสร้างพื้นฐาน'),
(9, 3, 'ส่วนการโยธา'),
(10, 3, 'ฝ่ายบริหารงานทั่วไป'),
(11, 4, 'ฝ่ายวางผังเมือง'),
(12, 4, 'ฝ่ายปฏิบัติการผังเมือง'),
(13, 5, 'ฝ่ายบริหารงานทั่วไป'),
(14, 5, 'ฝ่ายปกครอง'),
(15, 5, 'ฝ่ายส่งเสริมการท่องเที่ยว'),
(16, 6, 'ฝ่ายการประชุม'),
(17, 6, 'ฝ่ายกิจการสภา'),
(18, 6, 'ฝ่ายกิจการคณะผู้บริหาร'),
(19, 7, 'ฝ่ายบริหารงานสาธารณสุข'),
(20, 7, 'ฝ่ายป้องกันและควบคุมโรค'),
(21, 7, 'ฝ่ายส่งเสริมสาธารณสุข'),
(22, 7, 'รพ.สต.ในสังกัด อบจ.'),
(23, 8, 'ฝ่ายบริหารการศึกษา'),
(24, 8, 'ฝ่ายส่งเสริมการศึกษา ศาสนา และวัฒนธรรม'),
(25, 8, 'สถานศึกษาในสังกัด อบจ.'),
(26, 9, 'ฝ่ายวิเคราะห์นโยบายและแผน'),
(27, 9, 'ฝ่ายงบประมาณ'),
(28, 9, 'ฝ่ายตรวจติดตามและประเมินผล'),
(29, 9, 'ฝ่ายประชาสัมพันธ์'),
(30, 10, 'ส่วนบริหารการคลัง'),
(31, 10, 'ส่วนบริหารงานพัสดุ'),
(32, 10, 'ฝ่ายบริหารงานทั่วไป');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `time_range` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `time_range`) VALUES
(1, '09:00 - 12:00'),
(2, '13:00 - 16:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '2025-03-06 14:31:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_departments`
--
ALTER TABLE `sub_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_departments`
--
ALTER TABLE `sub_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_departments`
--
ALTER TABLE `sub_departments`
  ADD CONSTRAINT `sub_departments_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
