-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 08:52 PM
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
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `a_name` varchar(20) NOT NULL,
  `a_date` date DEFAULT NULL CHECK (`a_date` > '2023-01-01'),
  `a_username` varchar(20) NOT NULL,
  `a_password` varchar(10) NOT NULL CHECK (char_length(`a_password`) <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `a_name`, `a_date`, `a_username`, `a_password`) VALUES
(1, 'shiv', '2023-02-01', 'shiv@0369', 'shiv0'),
(2, 'vedant', '2023-03-15', 'vedant@0369', 'veda3'),
(3, 'milan', '2023-04-21', 'milan@0369', 'mila6'),
(4, 'meet', '2024-02-03', 'meet@0369', 'meet9'),
(5, 'darshan', '2024-03-16', 'darshan@0369', 'dars0'),
(6, 'yash', '2024-04-22', 'yash@0369', 'yash3'),
(7, 'shreyash', '2025-05-19', 'shreyash@0369', 'shre6'),
(8, 'aman', '2023-06-10', 'aman@0369', 'aman9'),
(9, 'chintu', '2024-05-20', 'chintu@0369', 'chin0'),
(10, 'ayush', '2025-07-11', 'aysuh@0369', 'ayus3');

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `advisor_id` int(11) NOT NULL,
  `advisorname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisor_phone` char(10) DEFAULT NULL,
  `advisor_email` varchar(25) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`advisor_id`, `advisorname`, `advisor_phone`, `advisor_email`, `admin_id`, `std_id`) VALUES
(21, 'anand', '0369456789', 'anand@gmail.com', 1, 11),
(22, 'vinit', '1234509876', 'vinit@gmail.com', 2, 12),
(23, 'dhruv', '6789012345', 'dhruv@gmail.com', 3, 13),
(24, 'milan', '0987612345', 'milan@gmail.com', 4, 14),
(25, 'samu', '3456712987', 'samu@gmail.com', 5, 15),
(26, 'shyam', '7845312095', 'shyam@gmail.com', 6, 16),
(27, 'dhaval', '8674501235', 'dhaval@gmail.com', 7, 17),
(28, 'piku', '4321567890', 'piku@gmail.com', 8, 18),
(29, 'pruthvi', '2890519846', 'pruthvi@gmail.com', 9, 19),
(30, 'yagnik', '7654312098', 'yagnik@gmail.com', 10, 20),
(31, 'yash', '7894561234', 'yash@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attend_id` int(11) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '2024-01-01',
  `sub_id` int(11) DEFAULT NULL,
  `status` enum('Present','Absent') DEFAULT 'Absent',
  `course_id` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attend_id`, `instructor_id`, `admin_id`, `std_id`, `date`, `sub_id`, `status`, `course_id`) VALUES
(0, NULL, NULL, 11, '2024-11-23', 64, 'Absent', NULL),
(91, 81, 1, 11, '2024-01-01', 61, 'Absent', 31),
(92, 82, 2, 12, '2024-01-01', 62, 'Absent', 32),
(93, 83, 3, 13, '2024-01-01', 63, 'Absent', 33),
(94, 84, 4, 14, '2024-01-01', 64, 'Absent', 34),
(95, 85, 5, 15, '2024-01-01', 65, 'Absent', 35),
(96, 86, 6, 16, '2024-01-01', 66, 'Absent', 36),
(97, 87, 7, 17, '2024-01-01', 67, 'Absent', 37),
(98, 88, 8, 18, '2024-01-01', 68, 'Absent', 38),
(99, 89, 9, 19, '2024-01-01', 69, 'Absent', 39),
(100, 90, 10, 20, '2024-01-01', 70, 'Absent', 40);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_rewards`
--

CREATE TABLE `attendance_rewards` (
  `total_points` int(11) DEFAULT 0,
  `last_updated` date DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_rewards`
--

INSERT INTO `attendance_rewards` (`total_points`, `last_updated`, `std_id`) VALUES
(120, '2024-11-21', 11),
(130, '2024-11-22', 12),
(140, '2024-11-22', 13),
(90, '2024-11-22', 14),
(180, '2024-11-22', 15),
(100, '2024-11-22', 16),
(190, '2024-11-22', 17),
(110, '2024-11-22', 18),
(150, '2024-11-22', 19),
(120, '2024-11-22', 11),
(40, '2024-11-22', NULL),
(50, '2024-11-22', NULL),
(10, '2024-11-22', NULL),
(10, '2024-11-22', 11),
(10, '2024-11-22', 12),
(10, '2024-11-22', 14),
(10, '2024-11-22', 15),
(10, '2024-11-22', 17),
(10, '2024-11-22', 18),
(10, '2024-11-22', 20),
(10, '2024-11-22', 11),
(10, '2024-11-22', 12),
(10, '2024-11-22', 13),
(10, '2024-11-22', 16),
(10, '2024-11-22', 18),
(10, '2024-11-22', 20),
(10, '2024-11-23', 11),
(10, '2024-11-23', 13),
(10, '2024-11-23', 15),
(10, '2024-11-23', 17),
(10, '2024-11-23', 19);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_name` varchar(50) DEFAULT NULL,
  `course_credit` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `amount` decimal(11,0) DEFAULT NULL,
  `video_link` varchar(255) NOT NULL,
  `course_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_name`, `course_credit`, `admin_id`, `dept_id`, `amount`, `video_link`, `course_id`) VALUES
('computer science', 100, 1, 41, 12000, 'https://youtu.be/oz9cEqFynHU?si=C7UROxlFmI6T5b5n', 31),
('business administration', 105, 2, 42, 10000, 'https://youtu.be/yYX4bvQSqbo?si=QJsKKvFe8-OCg1Nl', 32),
('mechanical engineering', 129, 3, 43, 9000, 'https://youtu.be/4i1MUWJoI0U?si=iDXdC5ZZ9kaZjHnB', 33),
('psychology', 110, 4, 44, 20000, 'https://youtu.be/R-sVnmmw6WY?si=KKY-5cHzKdCz4Uoe', 34),
('electrical engineering', 112, 5, 45, 15000, 'https://youtu.be/8oQOrjaFyN8?si=EXQEH1SSZWOmWed2', 35),
('enviornmental science', 115, 6, 46, 12000, 'https://youtu.be/9dAcEBXAFoo?si=X7LUPLXVxMRy4nKz', 36),
('information technology', 117, 7, 47, 25000, 'https://youtu.be/inWWhr5tnEA?si=DvAmb9gtvcm4MDTx', 37),
('economics', 120, 8, 48, 9000, 'https://youtu.be/VXfJwZORMCc?si=WghBUpJ3qLV3-JAW', 38),
('law', 123, 9, 49, 30000, 'https://youtu.be/jsTB7gSfDPI?si=pVTWApEpzcMBQ0aI', 39),
('marketing', 125, 10, 50, 11000, 'https://youtu.be/yv2cp1fmSt0?si=Wn2KwzCjnCiid4Yr', 40),
('DBMS', NULL, NULL, NULL, 100, '', 41),
('C', NULL, NULL, NULL, 200, '', 42);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `deptname` varchar(50) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `deptname`, `admin_id`) VALUES
(41, 'department of computer science', 1),
(42, 'department of business administration', 2),
(43, 'department of mechanical engineering', 3),
(44, 'department of psychology', 4),
(45, 'department of electrical engineering', 5),
(46, 'department of enviornmental science', 6),
(47, 'department of information technology', 7),
(48, 'department of economics', 8),
(49, 'department of law', 9),
(50, 'department of marketing', 10);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `sub_id` int(11) DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`sub_id`, `std_id`) VALUES
(61, 11),
(62, 12),
(63, 13),
(64, 14),
(65, 15),
(66, 16),
(67, 17),
(68, 18),
(69, 19),
(70, 20);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `evaluation_id` int(11) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `std_id` int(11) NOT NULL,
  `subject` varchar(25) DEFAULT NULL,
  `score` int(25) DEFAULT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `date_evaluated` date DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `course_id` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `instructor_id`, `std_id`, `subject`, `score`, `remarks`, `date_evaluated`, `sub_id`, `course_id`) VALUES
(101, 81, 11, 'data structures and algor', 78, 'Course Material is helpful', '2024-11-02', 61, 31),
(102, 82, 12, 'Financial Accounting', 50, 'Needs to improve engagement with students.', '2024-11-15', 62, 32),
(103, 83, 13, 'Thermodynamics', 40, 'Provides clear explanations and examples.', '2024-11-30', 63, 33),
(104, 84, 14, 'Cognitive Psychology', 70, 'Encourages class participation and discussion.', '2024-11-19', 64, 34),
(105, 85, 15, 'Circuit Analysis', 57, 'Feedback on assignments is timely and constructive.', '2024-11-12', 65, 35),
(106, 86, 16, 'Ecology', 98, 'Shows enthusiasm and passion for teaching.', '2024-11-14', 66, 36),
(107, 87, 17, 'Network Security', 95, 'Utilizes diverse teaching methods effectively.', '2024-11-15', 67, 37),
(108, 88, 18, 'Microeconomics', 70, 'Maintains a positive classroom environment.', '2024-11-08', 68, 38),
(109, 89, 19, 'Constitutional Law', 64, 'Should incorporate more real-world applications.', '2024-11-19', 69, 39),
(110, 90, 20, 'Consumer Behavior', 62, 'Overall, an effective and supportive instructor.', '2024-11-20', 70, 40),
(111, NULL, 13, 'Ecology', 10, 'Excellent', '2024-11-21', NULL, NULL),
(112, NULL, 15, 'Ecology', 20, 'I don\'t like it', '2024-11-22', NULL, NULL),
(113, NULL, 11, 'Financial Accounting', 50, 'Good', '2024-11-22', NULL, NULL),
(114, NULL, 16, 'Financial Accounting', 2, 'superb', '2024-11-23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `examname` varchar(50) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `total_marks` int(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `course_id` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `examname`, `instructor_id`, `sub_id`, `duration`, `total_marks`, `date`, `course_id`) VALUES
(71, 'Data Structures and Algorithms', 81, 61, 60, 100, '2024-05-01', 31),
(72, 'Financial Accounting', 82, 62, 60, 100, '2024-05-02', 32),
(73, 'Thermodynamics', 83, 63, 60, 100, '2024-05-03', 33),
(74, 'Cognitive Psychology', 84, 64, 60, 100, '2024-05-04', 34),
(75, 'Circuit Analysis', 85, 65, 60, 100, '2024-05-05', 35),
(76, 'Ecology', 86, 66, 60, 100, '2024-05-06', 36),
(77, 'Network Security', 87, 67, 60, 100, '2024-05-07', 37),
(78, 'Microeconomics', 88, 68, 60, 100, '2024-05-08', 38),
(79, 'Constitutional Law', 89, 69, 60, 100, '2024-05-09', 39),
(80, 'Consumer Behavior', 90, 70, 60, 100, '2024-05-10', 40),
(92, 'database management system', NULL, NULL, NULL, 100, '2024-11-22', 41),
(93, 'C programming 1', NULL, NULL, NULL, 100, '2024-11-22', 42);

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `score` int(11) DEFAULT 0,
  `completion_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `std_id`, `exam_id`, `score`, `completion_time`) VALUES
(1, 11, 71, 0, '0000-00-00 00:00:00'),
(2, 12, 72, 0, '0000-00-00 00:00:00'),
(3, 13, 73, 0, '0000-00-00 00:00:00'),
(4, 14, 74, 0, '0000-00-00 00:00:00'),
(5, 15, 75, 0, '0000-00-00 00:00:00'),
(6, 16, 76, 0, '0000-00-00 00:00:00'),
(7, 17, 77, 0, '0000-00-00 00:00:00'),
(8, 18, 78, 0, '0000-00-00 00:00:00'),
(9, 19, 79, 0, '0000-00-00 00:00:00'),
(10, 20, 80, 0, '0000-00-00 00:00:00'),
(12, 11, 71, 4, '2024-11-20 23:17:23'),
(13, 20, 71, 4, '2024-11-20 23:38:16'),
(15, 20, 72, 0, '2024-11-21 01:19:30'),
(16, 20, 71, 4, '2024-11-21 15:09:22'),
(17, 20, 93, 0, '2024-11-21 22:34:48'),
(18, 20, 71, 1, '2024-11-21 22:35:41'),
(19, 20, 72, 2, '2024-11-22 14:16:02'),
(20, 20, 71, 0, '2024-11-22 17:14:27'),
(21, 20, 72, 0, '2024-11-22 17:16:26'),
(22, 20, 71, 4, '2024-11-23 15:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `give`
--

CREATE TABLE `give` (
  `exam_id` int(11) DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `give`
--

INSERT INTO `give` (`exam_id`, `std_id`) VALUES
(71, 11),
(72, 12),
(73, 13),
(74, 14),
(75, 15),
(76, 16),
(77, 17),
(78, 18),
(79, 19),
(80, 20);

-- --------------------------------------------------------

--
-- Table structure for table `has`
--

CREATE TABLE `has` (
  `sub_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `has`
--

INSERT INTO `has` (`sub_id`, `instructor_id`) VALUES
(61, 81),
(62, 82),
(63, 83),
(64, 84),
(65, 85),
(66, 86),
(67, 87),
(68, 88),
(69, 89),
(70, 90);

-- --------------------------------------------------------

--
-- Table structure for table `include`
--

CREATE TABLE `include` (
  `sub_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructor_id` int(11) NOT NULL,
  `instructorname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instphone` char(10) DEFAULT NULL,
  `insemail` varchar(50) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `notification_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `i_username` varchar(25) DEFAULT NULL,
  `i_password` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_id`, `instructorname`, `instphone`, `insemail`, `admin_id`, `notification_id`, `dept_id`, `i_username`, `i_password`) VALUES
(81, 'dr.chirag patel', '1234509876', 'chirag@gmail.com', 1, 111, 41, 'chirag@123', 'chirag369'),
(82, 'dr.suhrad patel', '2345167890', 'suhrad@gmail.com', 2, 112, 42, 'suhard@123', 'suhard369'),
(83, 'dr.sarvam kakdiya', '0987612345', 'sarvam@gmail.com', 3, 113, 43, 'sarvam@123', 'sarvam369'),
(84, 'dr.akshay pandya', '6543217890', 'akshay@gmail.com', 4, 114, 44, 'akshay@123', 'akshay369'),
(85, 'dr.sharad sapariya', '4567890123', 'sharad@gmail.com', 5, 115, 45, 'sharad@123', 'sharad369'),
(86, 'dr.harsh jariwala', '9876512340', 'harsh@gmail.com', 6, 116, 46, 'harsh@123', 'harsh369'),
(87, 'dr.raidu jaggad', '7689054321', 'raidu@gmail.com', 7, 117, 47, 'raidu@123', 'raidu369'),
(88, 'dr.kush bhopal', '8907654321', 'kush@gmail.com', 8, 118, 48, 'kush@123', 'kush369'),
(89, 'dr.dev panchal', '3214576590', 'dev@gmail.com', 9, 119, 49, 'dev@123', 'dev369'),
(90, 'dr.rudra desai', '5432109876', 'rudra@gmail.com', 10, 120, 50, 'rudra@123', 'rudra369'),
(91, 'dr. milan rajani', '1236549875', 'milan12@gmail.com', NULL, NULL, NULL, NULL, NULL),
(92, 'dr. ayush', '125465328', 'ayush@gmail.com', NULL, NULL, NULL, NULL, NULL),
(93, 'dr.shiv jariwala', '1236549875', 'shiv@gmail.com', NULL, NULL, NULL, NULL, NULL),
(94, 'veda', '7878787878', 'veda@gmail.com', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructor_data`
--

CREATE TABLE `instructor_data` (
  `id` int(11) NOT NULL,
  `instructor_name` varchar(100) DEFAULT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `advisor_name` varchar(100) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `advisor_id` int(11) DEFAULT NULL,
  `course_credit` int(11) DEFAULT NULL,
  `course_id` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_data`
--

INSERT INTO `instructor_data` (`id`, `instructor_name`, `subject_name`, `advisor_name`, `instructor_id`, `sub_id`, `advisor_id`, `course_credit`, `course_id`) VALUES
(11, 'dr.chirag patel', 'data structures and algorithms', 'anand', 81, 61, 21, 100, 31),
(12, 'dr.suhrad patel', 'financial accounting', 'vinit', 82, 62, 22, 105, 32),
(13, 'dr.sarvam kakdiya', 'thermodynamics', 'dhruv', 83, 63, 23, 129, 33),
(14, 'dr.akshay pandya', 'cognitive psychology', 'milan', 84, 64, 24, 110, 34),
(15, 'dr.sharad sapariya', 'circuit analysis', 'samu', 85, 65, 25, 112, 35),
(16, 'dr.harsh jariwala', 'ecology', 'shyam', 86, 66, 26, 115, 36),
(17, 'dr.raidu jaggad', 'network security', 'dhaval', 87, 67, 27, 117, 37),
(18, 'dr.kush bhopal', 'microeconomics', 'piku', 88, 68, 28, 120, 38),
(19, 'dr.dev panchal', 'constitutional law', 'pruthvi', 89, 69, 29, 123, 39),
(20, 'dr.rudra desai', 'consumer behavior', 'yagnik', 90, 70, 30, 125, 40);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(11) NOT NULL,
  `std_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `paymentdate` datetime DEFAULT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiry_date` varchar(5) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `course_id` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `std_id`, `amount`, `paymentdate`, `card_number`, `expiry_date`, `cvv`, `course_id`) VALUES
(51, 11, 12000.00, '2024-11-14 09:30:00', '', '', '', 31),
(52, 12, 10000.00, '2024-11-14 10:00:00', '', '', '', 32),
(53, 13, 9000.00, '2024-11-14 11:00:00', '', '', '', 33),
(54, 14, 20000.00, '2024-11-14 12:00:00', '', '', '', 34),
(55, 15, 15000.00, '2024-11-14 13:00:00', '', '', '', 35),
(56, 16, 12000.00, '2024-11-14 14:00:00', '', '', '', 36),
(57, 17, 25000.00, '2024-11-14 15:00:00', '', '', '', 37),
(58, 18, 9000.00, '2024-11-14 16:00:00', '', '', '', 38),
(59, 19, 30000.00, '2024-11-14 17:00:00', '', '', '', 39),
(60, 20, 11000.00, '2024-11-14 18:00:00', '', '', '', 40),
(63, NULL, 12000.00, '2024-11-15 23:47:53', '111', '111', '220', NULL),
(65, NULL, 12000.00, '2024-11-15 23:54:16', '111', '111', '220', NULL),
(66, NULL, 12000.00, '2024-11-15 23:55:02', '111', '111', '220', NULL),
(80, NULL, 9000.00, '2024-11-16 23:38:21', '323', '26', '656', NULL),
(81, NULL, 12000.00, '2024-11-16 23:42:49', '111', '343', '563', NULL),
(82, NULL, 9000.00, '2024-11-16 23:43:41', '112', '344', '212', NULL),
(83, NULL, 9000.00, '2024-11-16 23:44:07', '112', '344', '212', NULL),
(87, NULL, 20000.00, '2024-11-17 00:08:00', '113', '55', '356', NULL),
(92, NULL, 20000.00, '2024-11-17 00:13:37', '113', '55', '356', NULL),
(93, NULL, 20000.00, '2024-11-17 00:19:21', '113', '55', '356', NULL),
(94, NULL, 20000.00, '2024-11-17 00:19:31', '111', '223', '564', NULL),
(95, NULL, 20000.00, '2024-11-17 00:19:59', '111', '223', '564', NULL),
(96, NULL, 12000.00, '2024-11-17 01:08:45', '326', '455', '484', NULL),
(97, NULL, 12000.00, '2024-11-17 02:40:40', '453', 'bvdfb', 'fwr', NULL),
(98, NULL, 9000.00, '2024-11-20 21:08:47', '322', '121', '354', NULL),
(99, NULL, 9000.00, '2024-11-20 23:55:13', '112', '32', '422', NULL),
(100, NULL, 20000.00, '2024-11-21 00:01:08', '222', '65', '98', NULL),
(101, NULL, 15000.00, '2024-11-21 00:02:16', '111', '223', '453', NULL),
(102, NULL, 15000.00, '2024-11-21 00:10:42', '111', '333', '453', NULL),
(103, NULL, 15000.00, '2024-11-21 00:15:49', '121', '353', '634', NULL),
(104, NULL, 9000.00, '2024-11-21 00:20:38', '124', '232', '454', NULL),
(105, NULL, 9000.00, '2024-11-21 00:23:01', '434', '252', '534', NULL),
(106, NULL, 20000.00, '2024-11-21 00:33:46', '122', '342', '553', NULL),
(107, NULL, 15000.00, '2024-11-21 00:56:17', '123', '4234', '545', NULL),
(108, NULL, 10000.00, '2024-11-21 01:03:39', '223', '443', '523', NULL),
(109, NULL, 12000.00, '2024-11-21 15:07:53', '113', '443', '554', NULL),
(110, NULL, 20000.00, '2024-11-21 16:37:04', '22', '33', '45', NULL),
(111, NULL, 20000.00, '2024-11-21 19:55:00', '222', '888', '334', NULL),
(112, NULL, 30000.00, '2024-11-21 19:58:36', '999', '999', '999', NULL),
(113, NULL, 9000.00, '2024-11-21 20:16:00', '369', '36', '369', NULL),
(114, NULL, 11000.00, '2024-11-21 20:18:37', '220', '232', '434', NULL),
(115, NULL, 12000.00, '2024-11-21 22:41:02', '123', '443', '542', 31),
(116, NULL, 12000.00, '2024-11-21 22:42:19', '123', '443', '542', 31),
(117, NULL, 12000.00, '2024-11-21 22:43:32', '123', '443', '542', 31),
(118, NULL, 10000.00, '2024-11-22 14:15:18', '111', '231', '231', 32),
(119, NULL, 12000.00, '2024-11-22 17:09:04', '222', '443', '545', 31),
(120, NULL, 12000.00, '2024-11-22 17:26:31', '333', 'ww', 'aa', 31),
(121, NULL, 12000.00, '2024-11-23 15:05:52', '145', '254', '352', 31),
(122, NULL, 12000.00, '2024-11-23 15:19:46', '1324', '534', '756', 31);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_1` text NOT NULL,
  `option_2` text NOT NULL,
  `option_3` text NOT NULL,
  `option_4` text NOT NULL,
  `correct_option` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_option`) VALUES
(1, 71, 'What is the time complexity of binary search?', 'O(n)', 'O(n^2)', 'O(log n)', 'O(n log n)', 3),
(2, 71, 'Which data structure uses LIFO?', 'Queue', 'Stack', 'Heap', 'Graph', 2),
(3, 71, 'What is the best case time complexity of QuickSort?', 'O(n)', 'O(n^2)', 'O(n log n)', 'O(log n)', 3),
(4, 71, 'Which traversal method uses a stack?', 'Breadth-First Search', 'Depth-First Search', 'Inorder Traversal', 'Level Order Traversal', 2),
(5, 71, 'Which of the following is not a linear data structure?', 'Array', 'Stack', 'Queue', 'Graph', 4),
(6, 71, 'What is the height of a complete binary tree with n nodes?', 'log n', 'n', 'n/2', 'log(n+1)', 1),
(7, 71, 'Which algorithm is used to find the shortest path in a graph?', 'Dijkstra', 'Prim', 'Kruskal', 'Bellman-Ford', 1),
(8, 71, 'What does a hash table use to store data?', 'Stack', 'Heap', 'Hash function', 'Graph', 3),
(9, 71, 'What is the worst-case time complexity of inserting into a binary search tree?', 'O(1)', 'O(n)', 'O(log n)', 'O(n log n)', 2),
(10, 71, 'What is the time complexity of searching in an array?', 'O(1)', 'O(n)', 'O(log n)', 'O(n^2)', 2),
(11, 72, 'What is the primary objective of financial accounting?', 'To provide financial reports', 'To track taxes', 'To track inventory', 'To measure economic growth', 1),
(12, 72, 'Which statement shows a company’s financial position at a specific date?', 'Balance Sheet', 'Income Statement', 'Cash Flow Statement', 'Trial Balance', 1),
(13, 72, 'What is the equation for Assets?', 'Liabilities + Equity', 'Revenue - Expenses', 'Assets - Liabilities', 'Revenue + Equity', 1),
(14, 72, 'Which is a current asset?', 'Building', 'Cash', 'Land', 'Equipment', 2),
(15, 72, 'What does GAAP stand for?', 'General Accepted Audit Practices', 'Generally Accepted Accounting Principles', 'Global Accounting Analysis Procedures', 'Government Approved Accounting Practices', 2),
(16, 72, 'Which account type is recorded on the income statement?', 'Liabilities', 'Assets', 'Revenue', 'Owner’s Equity', 3),
(17, 72, 'What is recorded in a journal entry?', 'Accounts affected', 'Amount', 'Date', 'All of the above', 4),
(18, 72, 'What is depreciation?', 'Increase in asset value', 'Decrease in asset value over time', 'Purchase of an asset', 'Sale of an asset', 2),
(19, 72, 'What is the term for money owed by a company?', 'Liabilities', 'Revenue', 'Equity', 'Assets', 1),
(20, 72, 'What does a trial balance ensure?', 'Assets match liabilities', 'Debit equals credit', 'Revenue equals expenses', 'Cash equals equity', 2),
(21, 73, 'What does the first law of thermodynamics state?', 'Energy cannot be created or destroyed', 'Entropy always increases', 'Temperature and pressure are constant', 'Heat flows from cold to hot', 1),
(22, 73, 'Which is an example of an intensive property?', 'Volume', 'Mass', 'Temperature', 'Energy', 3),
(23, 73, 'What is the unit of entropy?', 'J/K', 'Pa', 'N/m', 'W', 1),
(24, 73, 'Which process occurs at constant pressure?', 'Isobaric', 'Isochoric', 'Isothermal', 'Adiabatic', 1),
(25, 73, 'What is the measure of disorder in a system?', 'Energy', 'Entropy', 'Temperature', 'Enthalpy', 2),
(26, 73, 'Which gas law relates pressure and volume?', 'Boyle’s Law', 'Charles’s Law', 'Avogadro’s Law', 'Ideal Gas Law', 1),
(27, 73, 'What is the Carnot efficiency?', 'Ratio of work to heat input', 'Efficiency of an ideal engine', 'Ratio of heat output to input', 'None of the above', 2),
(28, 73, 'Which cycle is used in refrigerators?', 'Otto', 'Diesel', 'Rankine', 'Carnot', 4),
(29, 73, 'What is latent heat?', 'Heat required for phase change', 'Heat at constant temperature', 'Heat in thermal equilibrium', 'Heat transfer by conduction', 1),
(30, 73, 'What is the SI unit of heat energy?', 'Watt', 'Kelvin', 'Joule', 'Newton', 3),
(31, 74, 'What is cognitive psychology focused on?', 'Behavioral changes', 'Mental processes', 'Brain anatomy', 'Social interaction', 2),
(32, 74, 'What is the capacity of short-term memory?', '5-9 items', '10-15 items', '1-2 items', 'Unlimited', 1),
(33, 74, 'What is the process of transferring information to long-term memory?', 'Encoding', 'Decoding', 'Processing', 'Retrieval', 1),
(34, 74, 'Who proposed the theory of cognitive development?', 'Freud', 'Piaget', 'Skinner', 'Watson', 2),
(35, 74, 'What is selective attention?', 'Focusing on one task', 'Ignoring all stimuli', 'Processing all stimuli', 'Remembering past events', 1),
(36, 74, 'What does the Stroop Effect demonstrate?', 'Color perception', 'Interference in cognitive processes', 'Memory capacity', 'Problem-solving skills', 2),
(37, 74, 'What type of memory involves recalling facts?', 'Episodic', 'Procedural', 'Semantic', 'Implicit', 3),
(38, 74, 'What is a schema?', 'Mental framework', 'Memory block', 'Cognitive bias', 'Problem-solving step', 1),
(39, 74, 'What is problem-solving in cognitive psychology?', 'Trial and error', 'Cognitive shortcuts', 'Goal-directed thinking', 'Random guessing', 3),
(40, 74, 'What is cognitive dissonance?', 'Conflict in mental processes', 'Emotional imbalance', 'Behavioral disruption', 'Memory loss', 1),
(41, 75, 'What is Ohm’s law?', 'V = IR', 'P = VI', 'E = MC^2', 'I = V/R', 1),
(42, 75, 'What is the unit of resistance?', 'Ohm', 'Ampere', 'Volt', 'Watt', 1),
(43, 75, 'What is Kirchhoff’s Voltage Law?', 'Sum of currents = 0', 'Sum of voltages = 0', 'Product of voltages = 1', 'Product of currents = 1', 2),
(44, 75, 'What does a capacitor store?', 'Current', 'Charge', 'Voltage', 'Power', 2),
(45, 75, 'What is the equivalent resistance of two resistors in series?', 'Sum of resistances', 'Product of resistances', 'Reciprocal of resistances', 'None', 1),
(46, 75, 'What is the function of an inductor?', 'Stores energy in a magnetic field', 'Stores energy in an electric field', 'Regulates voltage', 'Provides current', 1),
(47, 75, 'What is the unit of capacitance?', 'Farad', 'Henry', 'Ohm', 'Watt', 1),
(48, 75, 'What is the formula for power in a circuit?', 'P = VI', 'P = I^2R', 'P = V^2/R', 'All of the above', 4),
(49, 75, 'What is the impedance in an AC circuit?', 'Combination of resistance and reactance', 'Resistance only', 'Reactance only', 'Voltage and current', 1),
(50, 75, 'What is the current through a short circuit?', 'Zero', 'Infinite', 'Depends on resistance', 'Depends on power', 2),
(51, 76, 'What does ecology study?', 'Ecosystems and organisms', 'Chemical reactions', 'Animal behavior', 'Plant anatomy', 1),
(52, 76, 'What is a producer in an ecosystem?', 'Herbivore', 'Plant', 'Carnivore', 'Decomposer', 2),
(53, 76, 'Which gas is most important for photosynthesis?', 'Carbon dioxide', 'Oxygen', 'Nitrogen', 'Hydrogen', 1),
(54, 76, 'What is a food chain?', 'Linear sequence of energy flow', 'Web of interactions', 'Cycle of resources', 'Population distribution', 1),
(55, 76, 'What is biodiversity?', 'Variety of life in an area', 'Amount of biomass', 'Number of predators', 'Rate of reproduction', 1),
(56, 76, 'What is the main cause of deforestation?', 'Farming', 'Urbanization', 'Climate change', 'All of the above', 4),
(57, 76, 'What is the primary consumer in a food chain?', 'Carnivore', 'Herbivore', 'Omnivore', 'Decomposer', 2),
(58, 76, 'Which ecosystem has the highest biodiversity?', 'Desert', 'Rainforest', 'Grassland', 'Tundra', 2),
(59, 76, 'What is an abiotic factor?', 'Sunlight', 'Animals', 'Plants', 'Microbes', 1),
(60, 76, 'What is carrying capacity?', 'Maximum population an environment can sustain', 'Minimum population required for survival', 'Average population growth', 'Rate of reproduction', 1),
(61, 77, 'What is a firewall used for?', 'Filtering network traffic', 'Encrypting data', 'Routing packets', 'Detecting hardware issues', 1),
(62, 77, 'What does SSL stand for?', 'Secure Sockets Layer', 'Secure Software Level', 'Secure System Link', 'System Security Layer', 1),
(63, 77, 'What is phishing?', 'Email scam', 'Network attack', 'Spyware', 'System crash', 1),
(64, 77, 'Which protocol is used for secure file transfer?', 'FTP', 'HTTP', 'SFTP', 'SMTP', 3),
(65, 77, 'What does a VPN provide?', 'Data encryption', 'Secure remote access', 'IP masking', 'All of the above', 4),
(66, 77, 'What is a brute force attack?', 'Guessing passwords', 'Blocking a system', 'Sending spam emails', 'Monitoring a network', 1),
(67, 77, 'What is the purpose of encryption?', 'Securing data', 'Filtering traffic', 'Increasing bandwidth', 'Routing packets', 1),
(68, 77, 'Which layer does HTTPS operate on?', 'Transport', 'Application', 'Network', 'Data Link', 2),
(69, 77, 'What is a Trojan?', 'Malware disguised as legitimate software', 'Virus', 'Spyware', 'Worm', 1),
(70, 77, 'What is multi-factor authentication?', 'Using two or more authentication methods', 'Using a single password', 'Encrypting login data', 'Blocking unauthorized users', 1),
(71, 78, 'What is microeconomics?', 'Study of the economy as a whole', 'Study of individual markets', 'Study of production systems', 'Study of global trade', 2),
(72, 78, 'What does demand refer to?', 'The desire to buy goods', 'Willingness to pay for goods', 'Quantity of goods supplied', 'Goods available in the market', 2),
(73, 78, 'What is the law of supply?', 'Supply increases as price increases', 'Supply decreases as price increases', 'Supply and price are unrelated', 'Supply is constant', 1),
(74, 78, 'What is equilibrium price?', 'Price where demand equals supply', 'Lowest market price', 'Highest market price', 'Price set by the government', 1),
(75, 78, 'What is elasticity of demand?', 'Change in demand due to price change', 'Change in price due to demand', 'Constant demand', 'Price stability', 1),
(76, 78, 'What is opportunity cost?', 'Cost of the next best alternative', 'Cost of producing goods', 'Cost of capital investment', 'Cost of taxes', 1),
(77, 78, 'What is a monopoly?', 'Single seller in a market', 'Multiple buyers in a market', 'Competition among many sellers', 'Government-controlled market', 1),
(78, 78, 'What is marginal cost?', 'Cost of producing one more unit', 'Total cost of production', 'Fixed cost', 'Variable cost', 1),
(79, 78, 'What is a normal good?', 'Demand increases as income increases', 'Demand decreases as income increases', 'Demand remains constant', 'Demand is unrelated to income', 1),
(80, 78, 'What is a substitute good?', 'A good used instead of another', 'A good used with another', 'A good not related to another', 'A good produced at a lower cost', 1),
(81, 79, 'What is the primary purpose of a constitution?', 'Set rules for government', 'Enforce taxes', 'Create laws', 'Control citizens', 1),
(82, 79, 'What is the supreme law of the land?', 'The constitution', 'Legislative acts', 'Judicial rulings', 'Executive orders', 1),
(83, 79, 'What is the separation of powers?', 'Division of power between branches', 'Power concentrated in one branch', 'Decentralization of laws', 'None of the above', 1),
(84, 79, 'What is judicial review?', 'Power of courts to interpret laws', 'Creation of laws by courts', 'Approval of laws by courts', 'Enforcement of laws by courts', 1),
(85, 79, 'Which branch interprets the constitution?', 'Judicial', 'Legislative', 'Executive', 'Federal', 1),
(86, 79, 'What is a fundamental right?', 'Basic rights guaranteed by the constitution', 'Rights granted by the government', 'Privileges for elected officials', 'None of the above', 1),
(87, 79, 'What is the purpose of checks and balances?', 'Prevent abuse of power', 'Consolidate power', 'Accelerate lawmaking', 'Eliminate bureaucracy', 1),
(88, 79, 'What is federalism?', 'Division of power between central and state governments', 'Centralized government control', 'Local government autonomy', 'No government interference', 1),
(89, 79, 'What is the rule of law?', 'Everyone is subject to the law', 'Law is optional for some', 'Laws are only for officials', 'None of the above', 1),
(90, 79, 'Who has the power to amend the constitution?', 'Legislature', 'Judiciary', 'Executive', 'Citizens', 1),
(91, 80, 'What is consumer behavior?', 'Study of how consumers make decisions', 'Study of market trends', 'Analysis of product pricing', 'Analysis of advertising strategies', 1),
(92, 80, 'What influences consumer behavior?', 'Cultural factors', 'Social factors', 'Personal factors', 'All of the above', 4),
(93, 80, 'What is a need?', 'A state of felt deprivation', 'A luxury item', 'An unnecessary desire', 'None of the above', 1),
(94, 80, 'What is a want?', 'A specific product that fulfills a need', 'A basic necessity', 'A legal requirement', 'An unavoidable demand', 1),
(95, 80, 'What is cognitive dissonance?', 'Discomfort after making a decision', 'Satisfaction with a purchase', 'Impulse buying', 'Planned purchasing', 1),
(96, 80, 'What is impulse buying?', 'Unplanned purchase', 'Planned purchase', 'Expensive purchase', 'Group purchase', 1),
(97, 80, 'What is post-purchase behavior?', 'Actions after buying a product', 'Decision before buying', 'Analysis of needs', 'Comparison of options', 1),
(98, 80, 'What is brand loyalty?', 'Preference for a specific brand', 'Switching between brands', 'Disinterest in brands', 'None of the above', 1),
(99, 80, 'What is market segmentation?', 'Dividing a market into groups of consumers', 'Merging markets', 'Selling products to all consumers', 'None of the above', 1),
(100, 80, 'What is buyer’s remorse?', 'Regret after a purchase', 'Excitement before buying', 'Satisfaction with a product', 'Hesitation before buying', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `notification_id` int(11) DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receive`
--

INSERT INTO `receive` (`notification_id`, `std_id`) VALUES
(111, 11),
(112, 12),
(113, 13),
(114, 14),
(115, 15),
(116, 16),
(117, 17),
(118, 18),
(119, 19),
(120, 20);

-- --------------------------------------------------------

--
-- Table structure for table `r_write`
--

CREATE TABLE `r_write` (
  `evaluation_id` int(11) DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `r_write`
--

INSERT INTO `r_write` (`evaluation_id`, `std_id`) VALUES
(102, 12),
(103, 13),
(104, 14),
(105, 15),
(106, 16),
(107, 17),
(108, 18),
(109, 19),
(110, 20);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `timings` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `timings`) VALUES
(121, NULL),
(122, NULL),
(123, NULL),
(124, NULL),
(125, NULL),
(126, NULL),
(127, NULL),
(128, NULL),
(129, NULL),
(130, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(11) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `s_phone` char(10) DEFAULT NULL CHECK (`s_phone` regexp '^\\+?[0-9]{10,15}$'),
  `s_address` varchar(50) DEFAULT NULL,
  `s_email` varchar(25) DEFAULT NULL CHECK (`s_email` like '%_@__%.__%'),
  `s_username` varchar(20) NOT NULL,
  `s_password` varchar(10) DEFAULT NULL,
  `advisor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `f_name`, `l_name`, `s_phone`, `s_address`, `s_email`, `s_username`, `s_password`, `advisor_id`) VALUES
(11, 'suhard', 'patel', '1234567890', '2000 bay area blvd', 'suhard@gmail.com', 'suhard12', 'suha0123', 21),
(12, 'parth', 'purohit', '9876543211', '123 spring st', 'parth@gmail.com', 'parth0369', 'part3', 22),
(13, 'purvajeet', 'patel', '6875214569', '35 gemini st', 'puru@gmail.com', 'puru0369', 'puru6', 23),
(14, 'tanmay', 'das', '8754962543', '354 boss st', 'tanmay@gmail.com', 'tanmay0369', 'tanm9', 24),
(15, 'kishan', 'seth', '9856254367', '28 kesar st', 'kishan@gmail.com', 'kishan0369', 'kish0', 25),
(16, 'pritesh', 'rajani', '5478265318', '29 shreeji st', 'pritesh@gmail.com', 'pritesh0369', 'prit3', 26),
(17, 'rohan', 'devre', '8765349582', '34 cove st', 'rohan@gmail.com', 'rohan0369', 'rohn6', 27),
(18, 'keval', 'jadav', '7865256325', '17 avd st', 'keval@gmail.com', 'keval0369', 'keva9', 28),
(19, 'anant', 'soni', '7874823964', '29 bakrol st', 'anant@gmail.com', 'anant0369', 'anan0', 29),
(20, 'yash', 'yadav', '9033277025', '03 lake st', 'yash@gmail.com', 'yash0369', 'yash3', 30),
(33, 'Krunal', 'Parekh', '9033277058', '1 lakhaji park', 'krunal@gmail.com', 'krunal@12', 'krunal@123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `std_id`, `sub_id`) VALUES
(1, 11, 61),
(2, 12, 62),
(3, 13, 63),
(4, 14, 64),
(5, 15, 65),
(6, 16, 66),
(7, 17, 67),
(8, 18, 68),
(9, 19, 69),
(10, 20, 70);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `subname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `course_id` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `subname`, `admin_id`, `course_id`) VALUES
(61, 'data structures and algorithms', 1, 31),
(62, 'financial accounting', 2, 32),
(63, 'thermodynamics', 3, 33),
(64, 'cognitive pschology', 4, 34),
(65, 'circuit analysis', 5, 35),
(66, 'ecology', 6, 36),
(67, 'network security', 7, 37),
(68, 'micreconomics', 8, 38),
(69, 'consitutional law', 9, 39),
(70, 'consumer behavior', 10, 40),
(71, 'database management system', NULL, 41),
(72, 'c programming 1', NULL, 42);

-- --------------------------------------------------------

--
-- Table structure for table `teach`
--

CREATE TABLE `teach` (
  `instructor_id` int(11) DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teach`
--

INSERT INTO `teach` (`instructor_id`, `std_id`) VALUES
(81, 11),
(82, 12),
(83, 13),
(84, 14),
(85, 15),
(86, 16),
(87, 17),
(88, 18),
(89, 19),
(90, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`advisor_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `fk_advisor_student` (`std_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attend_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `fk_std_id` (`std_id`),
  ADD KEY `fk_sub_id` (`sub_id`),
  ADD KEY `fk_courseid` (`course_id`);

--
-- Indexes for table `attendance_rewards`
--
ALTER TABLE `attendance_rewards`
  ADD KEY `fk_std` (`std_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `fkstd_id` (`std_id`),
  ADD KEY `fksub_id` (`sub_id`),
  ADD KEY `fk_coreid` (`course_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `fk_subject_id` (`sub_id`),
  ADD KEY `fkid` (`course_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `give`
--
ALTER TABLE `give`
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `has`
--
ALTER TABLE `has`
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `include`
--
ALTER TABLE `include`
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructor_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `notification_id` (`notification_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `instructor_data`
--
ALTER TABLE `instructor_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `advisor_id` (`advisor_id`),
  ADD KEY `fkcid` (`course_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `fkcd` (`course_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD KEY `notification_id` (`notification_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `r_write`
--
ALTER TABLE `r_write`
  ADD KEY `evaluation_id` (`evaluation_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`),
  ADD KEY `advisor_id` (`advisor_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `fk_course_id` (`course_id`);

--
-- Indexes for table `teach`
--
ALTER TABLE `teach`
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advisor`
--
ALTER TABLE `advisor`
  MODIFY `advisor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `instructor_data`
--
ALTER TABLE `instructor_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisor`
--
ALTER TABLE `advisor`
  ADD CONSTRAINT `advisor_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_advisor_student` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_courseid` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_std_id` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sub_id` FOREIGN KEY (`SUB_ID`) REFERENCES `subject` (`sub_id`);

--
-- Constraints for table `attendance_rewards`
--
ALTER TABLE `attendance_rewards`
  ADD CONSTRAINT `attendance_rewards_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_std` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_coreid` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkstd_id` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`),
  ADD CONSTRAINT `fksub_id` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subject_id` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkid` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `give`
--
ALTER TABLE `give`
  ADD CONSTRAINT `give_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `give_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `has`
--
ALTER TABLE `has`
  ADD CONSTRAINT `has_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `has_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `include`
--
ALTER TABLE `include`
  ADD CONSTRAINT `include_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructor_ibfk_2` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructor_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor_data`
--
ALTER TABLE `instructor_data`
  ADD CONSTRAINT `fkcid` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructor_data_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructor_data_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructor_data_ibfk_3` FOREIGN KEY (`advisor_id`) REFERENCES `advisor` (`advisor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fkcd` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `receive`
--
ALTER TABLE `receive`
  ADD CONSTRAINT `receive_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receive_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_write`
--
ALTER TABLE `r_write`
  ADD CONSTRAINT `r_write_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluation` (`evaluation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `r_write_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`advisor_id`) REFERENCES `advisor` (`advisor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_courses_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teach`
--
ALTER TABLE `teach`
  ADD CONSTRAINT `teach_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teach_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
