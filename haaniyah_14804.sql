-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 06:30 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haaniyah_14804`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL,
  `Department Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentID`, `Department Name`) VALUES
(1, 'Sales '),
(2, 'Accounts'),
(3, 'Executive');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `JobID` int(11) NOT NULL,
  `First Name` varchar(20) NOT NULL,
  `Last Name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `Email Address` varchar(75) NOT NULL,
  `Contact Number` int(11) NOT NULL,
  `Account Number` int(20) NOT NULL,
  `Hire Date` date NOT NULL,
  `Salary` int(11) NOT NULL,
  `Total Commission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `DepartmentID`, `JobID`, `First Name`, `Last Name`, `password`, `Email Address`, `Contact Number`, `Account Number`, `Hire Date`, `Salary`, `Total Commission`) VALUES
(1000, 3, 4, 'Haaniyah', 'Muhammad ', '1000', 'haaniyah@hmm.com', 305341232, 678973637, '2021-02-01', 2000000, 0),
(1010, 2, 3, 'Zohaib', 'Khan', '1010', 'zohaib@hmm.com', 305357732, 547489021, '2021-02-10', 400000, 0),
(1020, 1, 1, 'Ahnaa', 'Shoaib', '1020', 'ahnaa@hmm.com', 300342032, 637783930, '2021-02-05', 400000, 0),
(1021, 1, 2, 'Muneeza', 'Muhammad ', '1021', 'muneezamundia@gmail.com', 332341232, 89053682, '2021-04-22', 50000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `incentive plan`
--

CREATE TABLE `incentive plan` (
  `IncentivePlanID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Plan Name` varchar(50) NOT NULL,
  `Commencement Time` date NOT NULL,
  `Commission Base` int(11) NOT NULL,
  `Quota` int(11) NOT NULL,
  `isPlanApproved` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incentive plan`
--

INSERT INTO `incentive plan` (`IncentivePlanID`, `ProductID`, `Plan Name`, `Commencement Time`, `Commission Base`, `Quota`, `isPlanApproved`) VALUES
(45, 3, 'Colourpop Lip Pencil Plan', '2021-03-01', 5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `JobID` int(11) NOT NULL,
  `Job Title` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`JobID`, `Job Title`) VALUES
(1, 'Head of Sales '),
(2, 'Salesperson'),
(3, 'Payable Manager'),
(4, 'CEO');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `SaleID` int(11) NOT NULL,
  `IncentivePlanID` int(11) NOT NULL,
  `Commission Amount` int(11) NOT NULL,
  `isCommissionApproved` int(1) NOT NULL,
  `isConfirmationEmailSent` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `SaleID`, `IncentivePlanID`, `Commission Amount`, `isCommissionApproved`, `isConfirmationEmailSent`) VALUES
(1, 1, 45, 175, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Product Name` varchar(70) NOT NULL,
  `Unit Price` int(11) NOT NULL,
  `Product Category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Product Name`, `Unit Price`, `Product Category`) VALUES
(3, 'Colourpop Lip Pencil', 700, 'lips'),
(4, 'Too Faced Born This Way Concealer', 4500, 'face'),
(5, 'Morphe Jaclyn Hill Palette Volume 2', 5000, 'eyes ');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `SaleID` int(11) NOT NULL,
  `EmployeeID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Unit Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Sale Time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`SaleID`, `EmployeeID`, `ProductID`, `Unit Price`, `Quantity`, `Sale Time`) VALUES
(1, 1021, 3, 700, 5, '2021-04-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `DepartmentID` (`DepartmentID`),
  ADD KEY `JobID` (`JobID`);

--
-- Indexes for table `incentive plan`
--
ALTER TABLE `incentive plan`
  ADD PRIMARY KEY (`IncentivePlanID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`JobID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `SaleID` (`SaleID`),
  ADD KEY `IncentivePlanID` (`IncentivePlanID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`SaleID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1022;

--
-- AUTO_INCREMENT for table `incentive plan`
--
ALTER TABLE `incentive plan`
  MODIFY `IncentivePlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `JobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
