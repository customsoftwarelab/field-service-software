-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2012 at 09:22 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `acsdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_monitor`
--

CREATE TABLE IF NOT EXISTS `access_monitor` (
  `accessstart` varchar(255) NOT NULL,
  `accessend` varchar(255) NOT NULL,
  `page_view` varchar(255) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `usrid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_monitor`
--

INSERT INTO `access_monitor` (`accessstart`, `accessend`, `page_view`, `saasid`, `usrid`) VALUES
('05/15/2012 - 09:23am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:21am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:17am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:11am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:10am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:25am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:27am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:28am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:37am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:42am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:43am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:44am', '', 'customers.php', '1', '1'),
('05/15/2012 - 09:45am', '', 'customers.php', '1', '1'),
('05/15/2012 - 10:08am', '', 'customers.php', '1', '1'),
('05/15/2012 - 10:09am', '', 'customers.php', '1', '1'),
('05/15/2012 - 10:10am', '', 'customers.php', '1', '1'),
('05/15/2012 - 10:11am', '', 'customers.php', '1', '1'),
('05/15/2012 - 10:35am', '', 'customers.php', '1', '1'),
('05/15/2012 - 10:47am', '', 'customers.php', '1', '1'),
('05/15/2012 - 10:53am', '', 'customers.php', '1', '1'),
('05/15/2012 - 10:55am', '', 'customers.php', '1', '1'),
('05/15/2012 - 11:04am', '', 'customers.php', '1', '1'),
('05/15/2012 - 11:05am', '', 'customers.php', '1', '1'),
('05/15/2012 - 11:05am', '', 'dashboard.php', '1', '1'),
('05/15/2012 - 05:36pm', '', 'Logged In', '1', '1'),
('05/15/2012 - 12:36pm', '', 'dashboard.php', '1', '1'),
('05/15/2012 - 12:36pm', '', 'customers.php', '1', '1'),
('05/15/2012 - 12:57pm', '', 'customers.php', '1', '1'),
('05/15/2012 - 12:58pm', '', 'dashboard.php', '1', '1'),
('05/15/2012 - 12:58pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 03:45pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:45pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 03:45pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 03:44pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:43pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:43pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 03:35pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 03:35pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:28pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:27pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:26pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:23pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:23pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 03:23pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 03:22pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 03:22pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 03:22pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:21pm', '', 'work_orders.php', '1', '1'),
('05/30/2012 - 03:16pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 03:12pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 03:12pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 03:11pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 03:11pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 03:10pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 02:56pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 02:52pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 02:51pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 02:50pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 02:32pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 02:22pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 01:13pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:59pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:58pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:57pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:57pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:55pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:52pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:51pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:51pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:50pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:42pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:42pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:37pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:37pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:36pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:36pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:35pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:35pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:34pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:34pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:33pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:32pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:26pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:25pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:25pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:16pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:16pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 12:15pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:07pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:06pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:01pm', '', 'estimates.php', '1', '1'),
('05/30/2012 - 12:01pm', '', 'customers.php', '1', '1'),
('05/30/2012 - 11:07am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 11:04am', '', 'customers.php', '1', '1'),
('05/30/2012 - 11:04am', '', 'dashboard.php', '1', '1'),
('05/30/2012 - 11:04am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 11:02am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 11:02am', '', 'customers.php', '1', '1'),
('05/30/2012 - 11:01am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:58am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:58am', '', 'customers.php', '1', '1'),
('05/30/2012 - 10:57am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:56am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:50am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:49am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:45am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:44am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:43am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:43am', '', 'customers.php', '1', '1'),
('05/30/2012 - 10:42am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:42am', '', 'customers.php', '1', '1'),
('05/30/2012 - 10:41am', '', 'customers.php', '1', '1'),
('05/30/2012 - 10:41am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:40am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:36am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:36am', '', 'customers.php', '1', '1'),
('05/30/2012 - 10:35am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:34am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:29am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:28am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:24am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:21am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 10:21am', '', 'customers.php', '1', '1'),
('05/30/2012 - 09:34am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 09:25am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 09:20am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 09:12am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 09:11am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 09:07am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 09:07am', '', 'customers.php', '1', '1'),
('05/30/2012 - 09:06am', '', 'customers.php', '1', '1'),
('05/30/2012 - 09:06am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 09:05am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 09:03am', '', 'estimates.php', '1', '1'),
('05/30/2012 - 08:24am', '', 'estimates.php', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `cont_id` int(255) NOT NULL AUTO_INCREMENT,
  `blong` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `active` varchar(12) NOT NULL,
  `isprime` varchar(12) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`cont_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`cont_id`, `blong`, `firstname`, `lastname`, `title`, `email`, `phone`, `fax`, `active`, `isprime`, `saasid`) VALUES
(19, '21', 'Bob', 'Doe', 'Employee', 'bob@mail.com', '343.545.4545', '454.454.5454', 'true', 'true', '1'),
(18, '21', 'Jason', 'Cotton', 'Owner', 'jason@customsoftwarelab.com', '345.345.4354', '..', 'true', 'false', '1'),
(17, '10', 'Jeez', 'Lastname', 'Owner', 'jeez@mail.com', '344.345.3454', '..', 'true', 'true', '1'),
(15, '8', 'David', 'Lason', 'Owner', 'david@customsoftwarelab.com', '345.645.6456', '..', 'true', 'true', '1'),
(16, '9', 'John', 'Doe', 'Owner', 'john@email.com', '456.456.4564', '345.345.3453', 'true', 'true', '1'),
(14, '8', 'Jason', 'Cotton', 'Employee', 'jason@customsoftwarelab.com', '123.243.3434', '..', 'true', 'false', '1');

-- --------------------------------------------------------

--
-- Table structure for table `core_docs`
--

CREATE TABLE IF NOT EXISTS `core_docs` (
  `doc_id` int(255) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `company_id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `issue_date` varchar(50) NOT NULL,
  `follow_up` varchar(255) NOT NULL,
  `days_left` varchar(100) NOT NULL,
  `salesman` varchar(255) NOT NULL,
  `valid_untill` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `base_type` varchar(255) NOT NULL,
  `estprice` varchar(255) NOT NULL,
  `payment_terms` text NOT NULL,
  `notes` text NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `doc_type` varchar(255) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `active` varchar(100) NOT NULL,
  `rowstate` varchar(20) NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `core_docs`
--

INSERT INTO `core_docs` (`doc_id`, `company_name`, `company_id`, `location`, `value`, `issue_date`, `follow_up`, `days_left`, `salesman`, `valid_untill`, `status`, `contact_name`, `base_type`, `estprice`, `payment_terms`, `notes`, `created_by`, `doc_type`, `saasid`, `active`, `rowstate`) VALUES
(19, '', '21', '12', '2,231.75', '05/30/2012', '06/28/2012', '29', '1', '06/28/2012', 'won', '19', 'sales', '2,231.75', 'They will pay when they want to...', 'I don''t like the fact that they will pay when they want to..', '1', 'workorder', '1', 'true', 'used'),
(20, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'estimate', '1', '', 'unused');

-- --------------------------------------------------------

--
-- Table structure for table `core_doc_attachments`
--

CREATE TABLE IF NOT EXISTS `core_doc_attachments` (
  `att_id` int(255) NOT NULL AUTO_INCREMENT,
  `attog_id` varchar(255) NOT NULL,
  `att_name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `attyp` varchar(100) NOT NULL,
  `attdoc_id` varchar(255) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `core_doc_attachments`
--


-- --------------------------------------------------------

--
-- Table structure for table `core_users`
--

CREATE TABLE IF NOT EXISTS `core_users` (
  `usr_id` int(255) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `usrtyp` varchar(50) NOT NULL,
  `usrname` varchar(100) NOT NULL,
  `usrpass` varchar(100) NOT NULL,
  `active` varchar(20) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `sessid` varchar(255) NOT NULL,
  `isowner` varchar(255) NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `core_users`
--

INSERT INTO `core_users` (`usr_id`, `fname`, `lname`, `usrtyp`, `usrname`, `usrpass`, `active`, `saasid`, `sessid`, `isowner`) VALUES
(1, 'Jason', 'Cotton', 'admin', 'jason@customsoftwarelab.com', 'access1300', 'true', '1', '4949itjbji59igje9ifjJJGJ$9ogijneijinh', 'true'),
(2, 'William', 'Doe', 'salesman', 'william@mail.com', 'passit', 'true', '1', '34t8uvrngujrgfni4i9e3c9j9ijvi', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `cust_id` int(255) NOT NULL AUTO_INCREMENT,
  `resalelicense` varchar(255) NOT NULL,
  `resalecertex` varchar(20) NOT NULL,
  `certiofins` varchar(255) NOT NULL,
  `companyname` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `county` varchar(100) NOT NULL,
  `issamebill` varchar(20) NOT NULL,
  `billaddress1` varchar(100) NOT NULL,
  `billaddress2` varchar(100) NOT NULL,
  `billcity` varchar(100) NOT NULL,
  `billstate` varchar(100) NOT NULL,
  `billzip` varchar(6) NOT NULL,
  `notes` text NOT NULL,
  `active` varchar(20) NOT NULL,
  `rowstate` varchar(40) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `resalelicense`, `resalecertex`, `certiofins`, `companyname`, `address1`, `address2`, `city`, `state`, `zip`, `county`, `issamebill`, `billaddress1`, `billaddress2`, `billcity`, `billstate`, `billzip`, `notes`, `active`, `rowstate`, `saasid`) VALUES
(22, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'unused', '1'),
(21, '1233', '09/18/2012', '11/07/2012', 'Arrested Development', '1234 Knowledge Way', '', 'Edmond', 'OK', '73033', 'Oklahoma', 'true', '', '', '', 'AL', '', 'This is a smooth client.', 'true', 'used', '1'),
(10, '456546', '05/02/2012', '05/30/2012', 'One Love', '345 W East Ave', '', 'Edmond', 'OK', '73034', 'Oklahoma', 'true', '', '', '', 'AL', '', '', 'true', 'used', '1'),
(9, '67676767', '05/14/2012', '05/23/2012', 'Tank Inc', '6780 W Port Ave', '7890 Ridge Ave', 'Oklahoma City', 'OK', '73033', 'Oklahoma', 'false', '3454 East Creek ST', '3454 East Creek ST', 'Edmond', 'OK', '73034', 'Neat client''s as well.', 'true', 'used', '1'),
(8, '345345345', '09/12/2012', '09/12/2012', 'Custom Software Lab', '1234 W East Ave', '', 'Edmond', 'OK', '73034', 'Oklahoma', 'true', '', '', '', 'AL', '', 'This is a very neat client.', 'true', 'used', '1');

-- --------------------------------------------------------

--
-- Table structure for table `doc_items`
--

CREATE TABLE IF NOT EXISTS `doc_items` (
  `itm_id` int(255) NOT NULL AUTO_INCREMENT,
  `tru_id` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `item_dec` text NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_price` varchar(255) NOT NULL,
  `is_tax` varchar(12) NOT NULL,
  `quant` varchar(200) NOT NULL,
  `doc_id` varchar(255) NOT NULL,
  `itmtyp` varchar(200) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`itm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

--
-- Dumping data for table `doc_items`
--

INSERT INTO `doc_items` (`itm_id`, `tru_id`, `sku`, `item_dec`, `item_name`, `item_price`, `is_tax`, `quant`, `doc_id`, `itmtyp`, `saasid`) VALUES
(127, '2', '', 'We will set things up for you.', 'Rig Setup', '80.00', 'false', '15', '19', 'service', '1'),
(125, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '1', '19', 'product', '1'),
(126, '5', '3453-345FQ', 'Contains all liquids that may spill out.', 'Fluid Cap', '290.00', 'true', '1', '19', 'product', '1');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `locid` int(11) NOT NULL AUTO_INCREMENT,
  `blong` varchar(255) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(7) NOT NULL,
  `county` varchar(100) NOT NULL,
  `taxs` text NOT NULL,
  `active` varchar(20) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`locid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locid`, `blong`, `address1`, `address2`, `city`, `state`, `zip`, `county`, `taxs`, `active`, `saasid`) VALUES
(12, '21', '101 Parkway Ave', '', 'New York', 'NY', '45444', 'York', '4,5', 'true', '1'),
(13, '9', '5656 East Red Ave', '', 'LA', 'CA', '90210', 'LA', '4,5', 'true', '1'),
(11, '9', '8976 Villa Ave', '', 'Stillwater', 'OK', '73323', 'Payne', '1,2', 'true', '1'),
(10, '8', '678 East Aves', '', 'Edmond', 'OK', '73034', 'Oklahoma', '1,2', 'true', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productservi`
--

CREATE TABLE IF NOT EXISTS `productservi` (
  `items_ids` int(255) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `decs` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `inventory` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `active` varchar(12) NOT NULL,
  `item_typ` varchar(20) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`items_ids`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `productservi`
--

INSERT INTO `productservi` (`items_ids`, `item_name`, `sku`, `decs`, `status`, `inventory`, `price`, `active`, `item_typ`, `saasid`) VALUES
(1, 'Compactor Gear Set', '3434-45453TG', 'This is a companctor gear set..', 'In Stock', '5391', '576.00', 'true', 'product', '1'),
(2, 'Rig Setup', '', 'We will set things up for you.', 'In Stock', '', '80.00', 'true', 'service', '1'),
(3, 'Receptacle', '456465-RGFR', 'This is where the trash goes.', 'In Stock', '192', '2500.00', 'true', 'product', '1'),
(4, 'Pressure Cap', '56564-UJFU', 'This is a pressure cap.', 'In Stock', '47', '123.22', 'true', 'product', '1'),
(5, 'Fluid Cap', '3453-345FQ', 'Contains all liquids that may spill out.', 'In Stock', '564', '290.00', 'true', 'product', '1'),
(6, 'Container Top', '45654-90DS', 'Replacement top for RST models ', 'In Stock', '42', '100.00', 'true', 'product', '1'),
(7, 'Monthly Inspection', '', 'We inspect receptacles every month', 'In Stock', '', '150.00', 'true', 'service', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tax_table`
--

CREATE TABLE IF NOT EXISTS `tax_table` (
  `tax_id` int(255) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `percent` varchar(50) NOT NULL,
  `county` varchar(255) NOT NULL,
  `active` varchar(20) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tax_table`
--

INSERT INTO `tax_table` (`tax_id`, `tax_name`, `state`, `percent`, `county`, `active`, `saasid`) VALUES
(1, 'OKC Sales Tax', 'OK', '9.75', 'Oklahoma', 'true', '1'),
(2, 'Edmond Tax', 'OK', '9.25', 'Oklahoma', 'true', '1'),
(3, 'Guthrie Sales', 'OK', '7.95', 'Logan', 'true', '1'),
(4, 'Tulsa Sales', 'OK', '9.56', 'Tulsa', 'true', '1'),
(5, 'New York Tax', 'New York', '9.58', 'York', 'true', '1');
