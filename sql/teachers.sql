-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 10:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heis`
--

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `experience_details` longtext NOT NULL,
  `publications` int(11) NOT NULL,
  `publications_details` longtext NOT NULL,
  `conferences` int(11) NOT NULL,
  `conferences_details` longtext NOT NULL,
  `seminars` int(11) NOT NULL,
  `seminars_details` longtext NOT NULL,
  `workshops` int(11) NOT NULL,
  `workshops_details` longtext NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `hec_university` text NOT NULL,
  `serving_institute` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `research_interest` varchar(1000) NOT NULL,
  `coveringLetter` text DEFAULT NULL,
  `CV` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fname`, `lname`, `designation`, `experience`, `experience_details`, `publications`, `publications_details`, `conferences`, `conferences_details`, `seminars`, `seminars_details`, `workshops`, `workshops_details`, `email`, `city`, `gender`, `address`, `password`, `phone`, `qualification`, `specialization`, `hec_university`, `serving_institute`, `department`, `research_interest`, `coveringLetter`, `CV`, `created_at`, `updated_at`) VALUES
(1, 'asad', 'ali asjad', 'dummy desgination', 3, 'dummy experience details', 2, 'dummy publications details', 2, 'dummy conference detials', 2, 'dummy seminars details', 2, 'dummy workshops details', 'testing@gmail.com', 'Lahore City Lahore', 'Female', 'Lahore', '$2y$10$RA2MXlsWQj9GHZSyPU2OvO/kuuAh4.AL.6D1x6a40QPIt5JLRlQGe', '+9233554487412', 'BSCS', 'Computer Sciecne', 'Aga Khan University', 'Agha Khan University Institute', 'Computer Science Department', 'dummy research interests', 'Dear Hiring Manager,\r\n\r\nI am writing to express my interest in the position of [Job Title] at [Compa ny Name]. With a strong background in [Your Field] and [Number] years of experience in [Specific Skill or Area], I am confident in my ability to contribute effectively to your team.\r\n\r\nThroughout my career, I have demonstrated a commitment to excellence and a passion for [Specific Industry or Field]. My experience includes [Brief Overview of Experience or Achievements]. I am particularly proud of [Specific Accomplishment or Project].\r\n\r\nI am impressed by [Company Name]\'s innovative approach to [Industry or Field]. I am eager to bring my skills in [Specific Skill or Area] to your organization and contribute to [Specific Goal or Project].\r\n\r\nThank you for considering my application. I look forward to the opportunity to discuss how my background, skills, and enthusiasm can benefit [Company Name].\r\n\r\nSincerely,\r\n[Your Name]', NULL, '2024-04-08 06:38:13', '2024-04-12 20:39:15'),
(2, 'qasim', 'shahid', 'professor', 5, 'experience details', 3, 'publications details added', 5, 'conferences details added', 4, 'seminars details added', 7, 'workshops details added', 'testing1@gmail.com', 'Lahore', 'Female', 'Lahore', '$2y$10$e36P.9MEBcJMZATOR8nvz.bF7dxREN0b9FIpZDj7dOnxVCaZce3YW', '+923558874125', 'Ph.d in computer science', 'Data Werehouse', 'National University of Sciences and Technology', 'NUST IT Department', 'Computer Science & IT Department', 'Computer Science, Data Werehouse, Data Mining, Artificial Intelligence', 'covering letter added', NULL, '2024-04-08 06:50:24', '2024-04-09 18:08:10'),
(4, 'muhammad', 'ramzan', 'professor', 5, 'experience details', 3, 'publications details added', 5, 'conferences details added', 4, 'seminars details added', 7, 'workshops details added', 'testing1@gmail.com', 'Lahore', 'Female', 'Lahore', '$2y$10$e36P.9MEBcJMZATOR8nvz.bF7dxREN0b9FIpZDj7dOnxVCaZce3YW', '+923558874125', 'Ph.d in computer science', 'Data Werehouse', 'National University of Sciences and Technology', 'NUST IT Department', 'Computer Science & IT Department', 'Computer Science, Data Werehouse, Data Mining, Artificial Intelligence', 'covering letter added', NULL, '2024-04-08 06:50:24', '2024-04-09 18:08:10'),
(5, 'Imran', 'Shahid', 'Assistant Professor', 4, ' 4 years experience in Teaching Biology', 1, 'details of publications', 2, 'details of conferences', 3, 'details of seminars', 4, 'details of workshop', 'imran@hotmail.com', 'Sheikhupura', 'Male', 'Main Sheikhupura Rd Lahore', '$2y$10$/UabLRctHoYUTWHdk8pZGemuucDirDc1Ckzcr4hV3METYLbxopaWK', '+923445587954', 'M.Phil in Biology', 'Human Heart', 'University of Karachi', 'Karachi Institute of Human Sciences', 'Biology', 'Human Heart, Blood Vessels', 'covering letter', NULL, '2024-04-12 05:55:58', '2024-04-12 05:59:19'),
(6, 'first name', 'last name', 'designation', 45, 'experience details has been entered', 1, 'publications details', 2, 'conferences details', 3, 'seminars details', 4, 'workshops details', 'imranshahid@hotmail.com', 'Karachi', 'Male', 'Karachi City Multan City Multan', '$2y$10$Xfzc6FarcANJyjPe3B/Fqu8ttQOEOT5GtoDLk6ikj334.P5C/6gqe', '+923224498745', 'qualifications', 'specializations', 'Aga Khan University', 'serving institute', 'departments', 'research interests', 'covering letter', NULL, '2024-04-12 07:32:58', '2024-04-12 19:52:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
