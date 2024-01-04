-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2024 at 06:01 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_me`
--

DROP TABLE IF EXISTS `about_me`;
CREATE TABLE IF NOT EXISTS `about_me` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `image` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_me`
--

INSERT INTO `about_me` (`id`, `image`, `description`) VALUES
(1, 'image.jpg', 'As a Coding Instructor, I evaluated student performance, provided academic guidance, and taught various programming languages. In my role as a Jr. Web Developer, I collaborated on the systems development lifecycle, modernized codebases, and designed user-friendly interfaces. My proficiency spans front-end and back-end development, including HTML, CSS, JavaScript, PHP, and SQL. My commitment to versatility and continuous improvement is evident in my experiences');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

DROP TABLE IF EXISTS `details`;
CREATE TABLE IF NOT EXISTS `details` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `resume` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `email`, `phone_number`, `resume`) VALUES
(1, 'wahabtlais@gmail.com', '+96170428794', 'resume.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `image`) VALUES
(16, 'WooxTravel ', 'This website is designed to help you explore various countries and cities, and book flights conveniently.', 'project-16.png'),
(3, 'Portfolio', 'Portfolio website showcasing my work in 3D graphics and animations, created using Three.js, React.js, and Tailwind CSS.', 'WHPortfolio.png'),
(5, 'Blogify', 'Blog website with an admin panel that allows you to create, manage, and control your blog posts and user', 'project-3.png'),
(15, 'Marketing Agency', 'Marketing Agency website, meticulously crafted with HTML, CSS, and JavaScript.', 'project-5.png');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `percentage` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `title`, `class`, `percentage`) VALUES
(4, 'HTML', 'html', '90%'),
(6, 'JavaScript', 'js', '60%'),
(5, 'CSS', 'css', '80%');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

DROP TABLE IF EXISTS `social_links`;
CREATE TABLE IF NOT EXISTS `social_links` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `social_name` varchar(50) NOT NULL,
  `social_url` varchar(2000) NOT NULL,
  `social_icon` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `social_name`, `social_url`, `social_icon`) VALUES
(3, 'Instagram', 'https://instagram.com/hussien_tlais?igshid=MzRlODBiNWFlZA==', 'uil uil-instagram'),
(2, 'LinkedIn', 'https://www.linkedin.com/in/wahab-tlais-25bba2249/?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app', 'uil uil-linkedin-alt'),
(4, 'GitHub', 'https://github.com/wahabtlais/', 'uil uil-github-alt');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
