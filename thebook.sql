-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2021 at 10:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `user_name` varchar(225) NOT NULL,
  `user_password` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`user_name`, `user_password`) VALUES
('Admin Staff', 'admin123'),
('Ko Ko Kyaw', 'kkk123');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_ID` varchar(225) NOT NULL DEFAULT '_ ',
  `author_Name` varchar(225) NOT NULL DEFAULT '_'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_ID`, `author_Name`) VALUES
('AUT0001', 'Dagon Taya'),
('AUT0002', 'Jurnal Kyaw Ma Ma Lay'),
('AUT0003', 'Mya Than Tint'),
('AUT0004', 'Khin Khin Htoo'),
('AUT0006', 'Min Lu'),
('AUT0007', 'Tekkatho Phone Naing'),
('AUT0008', 'Markus Zusak'),
('AUT0009', 'Chit Oo Nyo'),
('AUT0005', 'Jue'),
('AUT0010', 'A Kyi Taw'),
('AUT0011', 'Mark Manson'),
('AUT0012', 'Stan Lee');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_ID` varchar(225) NOT NULL,
  `book_Title` varchar(1500) NOT NULL,
  `author_ID` varchar(225) NOT NULL,
  `category_ID` varchar(225) NOT NULL,
  `language` varchar(225) NOT NULL,
  `publish_date` date NOT NULL,
  `book_cover` varchar(2500) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_ID`, `book_Title`, `author_ID`, `category_ID`, `language`, `publish_date`, `book_cover`, `price`) VALUES
('BOK00005', 'The Book Thief', 'AUT0008', 'CAT0006', 'English', '2007-04-28', 'f093ec3729fc52226ada73bee1f384b9.jpg', 7000),
('BOK00002', 'Yote Pone Lwar', 'AUT0001', 'CAT0006', 'Myanmar', '2018-02-14', 'Yote-pone-lwar-dagon.png', 45000),
('BOK00003', 'Shwe Linn Yone', 'AUT0002', 'CAT0016', 'Myanmar', '2016-02-14', 'unknown.jpg', 6000),
('BOK00004', 'A Lin Gar Di Pa Chit Thu', 'AUT0009', 'CAT0009', 'Myanmar', '2012-03-21', '41786829.jpg', 7000),
('BOK00001', 'Doh Khit Ko Yout Ya Myi', 'AUT0001', 'CAT0006', 'Myanmar', '2018-03-16', 'doh-khit-ko=dagon.png', 5000),
('BOK00006', 'Lay Lwint Thu', 'AUT0003', 'CAT0009', 'Myanmar', '2021-01-07', 'COB10400.jpg', 4500),
('BOK00007', 'A Lwan Thit', 'AUT0006', 'CAT0009', 'Myanmar', '2020-12-03', 'COB9653.jpg', 4800),
('BOK00008', 'Thone Loon Tin', 'AUT0004', 'CAT0011', 'Myanmar', '2021-05-17', 'cmhl_1000000075620_1_hero.jpg', 4500),
('BOK00009', 'Kya Ma Chit Taw Naing Ngan', 'AUT0005', 'CAT0016', 'Myanmar', '2020-01-08', 'kyamachit0218512.jpg', 4300),
('BOK00010', 'Twe Chin Hla Pe', 'AUT0005', 'CAT0009', 'Myanmar', '2018-08-23', 'twechinhlap.jpg', 3800),
('BOK00011', 'Tha Khoe', 'AUT0010', 'CAT0017', 'Myanmar', '2020-09-22', 'thakhoe.jpg', 4600),
('BOK00012', 'Bwar Tay... Bwar Tay...', 'AUT0010', 'CAT0017', 'Myanmar', '2013-07-17', 'BwarTay.jpg', 3900),
('BOK00013', 'Ka Way Pyo Ni Dann', 'AUT0010', 'CAT0017', 'Myanmar', '2011-12-14', 'unknown.jpg', 3800),
('BOK00014', 'Ee Myay Mha The', 'AUT0007', 'CAT0016', 'Myanmar', '2018-07-11', 'EeMyayMhaThe.jpg', 4300),
('BOK00015', 'Nyi Ma Lay Yal Soe Yein Mi Tal', 'AUT0007', 'CAT0016', 'Myanmar', '2011-09-29', 'unknown.jpg', 4400),
('BOK00016', 'Nyan San Pote Sar', 'AUT0006', 'CAT0002', 'Myanmar', '2017-07-05', 'NyanSanPoteSar.jpg', 4000),
('BOK00017', 'The Subtle Art of Not Giving A F*ck', 'AUT0011', 'CAT0016', 'English', '2019-03-18', 'artofas5552.jpg', 6500),
('BOK00018', 'Everything Is F*cked', 'AUT0011', 'CAT0016', 'English', '2020-06-10', 'everyfvj.jpg', 6300),
('BOK00019', 'The Happy Prince: and Other Stories', 'AUT0008', 'CAT0011', 'English', '2007-10-18', 'unknown.jpg', 0),
('BOK00020', 'Amazing Spider-Man 1963 - vol. 1 #1', 'AUT0012', 'CAT0003', 'English', '1963-06-18', 'spider152452.jpg', 12500),
('BOK00021', 'Avengers: The Ultimate Guide', 'AUT0012', 'CAT0003', 'Myanmar', '2005-07-04', 'adva5656535.jpg', 13500),
('BOK00022', 'Ultimate X-Men', 'AUT0012', 'CAT0003', 'English', '1996-11-14', 'advanojp4694.jpg', 12500);

-- --------------------------------------------------------

--
-- Table structure for table `book_sale`
--

CREATE TABLE `book_sale` (
  `sale_ID` varchar(225) NOT NULL,
  `sale_date` date NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_sale`
--

INSERT INTO `book_sale` (`sale_ID`, `sale_date`, `total_quantity`, `total_price`) VALUES
('ORD20211208/1', '2021-12-08', 6, 34000),
('SAL20211208/2', '2021-12-08', 3, 15500),
('SAL20211208/3', '2021-12-08', 5, 27500),
('SAL20211214/1', '2021-12-14', 1, 12500),
('SAL20211215/1', '2021-12-15', 1, 3800),
('SAL20211215/2', '2021-12-15', 2, 25000),
('SAL20211215/3', '2021-12-15', 2, 17800);

-- --------------------------------------------------------

--
-- Table structure for table `book_sale_detail`
--

CREATE TABLE `book_sale_detail` (
  `sale_ID` varchar(225) NOT NULL,
  `book_ID` varchar(225) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_sale_detail`
--

INSERT INTO `book_sale_detail` (`sale_ID`, `book_ID`, `quantity`, `price`) VALUES
('ORD20211208/1', 'BOK00001', 2, 5000),
('ORD20211208/1', 'BOK00003', 1, 6000),
('ORD20211208/1', 'BOK00004', 2, 5500),
('ORD20211208/1', 'book_ID', 1, 7000),
('SAL20211208/2', 'BOK00001', 2, 5000),
('SAL20211208/2', 'BOK00004', 1, 5500),
('SAL20211208/3', 'BOK00004', 5, 5500),
('SAL20211214/1', 'BOK00022', 1, 12500),
('SAL20211215/1', 'BOK00010', 1, 3800),
('SAL20211215/2', 'BOK00022', 2, 12500),
('SAL20211215/3', 'BOK00009', 1, 4300),
('SAL20211215/3', 'BOK00021', 1, 13500);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_ID` varchar(225) NOT NULL DEFAULT '_ ',
  `category_Name` varchar(225) NOT NULL DEFAULT '_'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_ID`, `category_Name`) VALUES
('CAT0001', 'Action and Adventure'),
('CAT0002', 'Classics'),
('CAT0003', 'Comic Book'),
('CAT0004', 'Detective and Mystery'),
('CAT0005', 'Fantasy'),
('CAT0006', 'Historical Fiction'),
('CAT0007', 'Horror'),
('CAT0008', 'Literary Fiction'),
('CAT0009', 'Romance'),
('CAT0010', 'Science Fiction (Sci-Fi)'),
('CAT0011', 'Short Stories'),
('CAT0012', 'Suspense and Thrillers'),
('CAT0013', 'Biographies and Autobiographies'),
('CAT0014', 'Cookbooks'),
('CAT0015', 'Poetry'),
('CAT0016', 'Knowledge'),
('CAT0017', 'Comedy');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_ID` varchar(225) NOT NULL,
  `order_date` date NOT NULL,
  `customer_name` varchar(225) NOT NULL,
  `phone_number` varchar(225) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `order_address` varchar(1500) NOT NULL,
  `remark` varchar(1500) NOT NULL,
  `order_status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_ID`, `order_date`, `customer_name`, `phone_number`, `email`, `order_address`, `remark`, `order_status`) VALUES
('ORD20211208/1', '2021-12-08', 'asdasdasd', '124124124', '', 'asdasdasdasd', '', 'complete'),
('ORD20211209/1', '2021-12-09', 'kokokyaw', '098765', '', 'asdasdasd', '', 'complete'),
('ORD20211209/2', '2021-12-09', 'W8Ben-integration-2021-08-31', '091245648485', 'APRIL@SIT.STARTINPOINT.COM', '115A COMMONWEALTH DRIVE', 'No asjidhaiuoshnpkasdyf hsnd fsdfipsh dfohsd s dsd sd ', 'complete'),
('ORD20211209/3', '2021-12-09', 'aaaaaa', '000000000', 'sdfafsdfsdf@asfas', 'asdasdasdasdasd asdasdasda  sdasdasdasdasdas', 'asdasdasdasdasd asdasdasda  sdasdasdasdasdas asdasdasdasdasd asdasdasda  sdasdasdasdasdas asdasdasdasdasd asdasdasda  sdasdasdasdasdas', 'complete'),
('ORD20211210/1', '2021-12-10', 'ko ko kyaw', '09780397242', 'kokuawasdas@gmail.com', 'YGN', 'Plz Deliver before 26th April.', 'complete'),
('ORD20211215/1', '2021-12-15', 'Ko Ko Kyaw', '09251881848', '', '115A COMMONWEALTH DRIVE', '', 'request'),
('ORD20211215/2', '2021-12-15', 'W8Ben-integration-2021-08-31', '6666666666', 'APRIL@SIT.STARTINPOINT.COM', '115A COMMONWEALTH DRIVE', '', 'request'),
('ORD20211215/3', '2021-12-15', 'W8Ben-integration-2021-08-31', '6666666666', 'APRIL@SIT.STARTINPOINT.COM', '115A COMMONWEALTH DRIVE', '', 'complete'),
('ORD20211215/4', '2021-12-15', 'KKKKK', '855885485', '', 'asdasdasdasdads', '', 'claim'),
('ORD20211215/5', '2021-12-15', 'Testr', '98085951', '', 'YGN', '', 'complete'),
('ORD20211215/6', '2021-12-15', 'kkkkkkkkkk', '09564665', '', 'MDY', '', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_ID` varchar(225) NOT NULL,
  `book_ID` varchar(225) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_ID`, `book_ID`, `quantity`, `price`) VALUES
('ORD20211208/1', 'BOK00003', 1, '6000'),
('ORD20211208/1', 'BOK00001', 1, '5000'),
('ORD20211209/1', 'BOK00001', 1, '5000'),
('ORD20211209/1', 'BOK00003', 1, '6000'),
('ORD20211209/2', 'book_ID', 1, '7000'),
('ORD20211209/2', 'BOK00004', 1, '5500'),
('ORD20211209/3', 'BOK00001', 1, '5000'),
('ORD20211209/3', 'BOK00003', 1, '6000'),
('ORD20211210/1', 'book_ID', 1, '7000'),
('ORD20211215/1', 'BOK00022', 4, '12500'),
('ORD20211215/2', 'BOK00001', 1, '5000'),
('ORD20211215/4', 'BOK00003', 1, '6000'),
('ORD20211215/4', 'BOK00011', 1, '4600'),
('ORD20211215/5', 'BOK00002', 1, '45000'),
('ORD20211215/5', 'BOK00016', 1, '4000'),
('ORD20211215/5', 'BOK00021', 1, '13500'),
('ORD20211215/6', 'BOK00007', 1, '4800'),
('ORD20211215/6', 'BOK00016', 1, '4000');

-- --------------------------------------------------------

--
-- Table structure for table `order_id_autogenerate`
--

CREATE TABLE `order_id_autogenerate` (
  `code` varchar(225) NOT NULL,
  `count_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_id_autogenerate`
--

INSERT INTO `order_id_autogenerate` (`code`, `count_no`) VALUES
('20211208', 1),
('20211209', 3),
('20211210', 1),
('20211215', 6);

-- --------------------------------------------------------

--
-- Table structure for table `sale_id_autogenerate`
--

CREATE TABLE `sale_id_autogenerate` (
  `code` varchar(225) NOT NULL,
  `count_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_id_autogenerate`
--

INSERT INTO `sale_id_autogenerate` (`code`, `count_no`) VALUES
('20211208', 3),
('20211214', 1),
('20211215', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
