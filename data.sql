-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2012 at 05:58 PM
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
('07/30/2012 - 04:52pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 04:52pm', '', 'purchase_orders.php', '1', '1'),
('07/30/2012 - 04:52pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 04:52pm', '', 'customers.php', '1', '1'),
('07/30/2012 - 04:52pm', '', 'invoice.php', '1', '1'),
('07/30/2012 - 04:50pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 04:50pm', '', 'purchase_orders.php', '1', '1'),
('07/30/2012 - 04:49pm', '', 'invoice.php', '1', '1'),
('07/30/2012 - 04:49pm', '', 'scheduler.php', '1', '1'),
('07/30/2012 - 04:49pm', '', 'work_orders.php', '1', '1'),
('07/30/2012 - 04:49pm', '', 'estimates.php', '1', '1'),
('07/30/2012 - 04:49pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 04:49pm', '', 'customers.php', '1', '1'),
('07/30/2012 - 04:49pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 04:49pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 04:45pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 04:44pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 04:43pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 03:57pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 03:57pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 03:56pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 03:51pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 03:51pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 03:50pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 03:47pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 03:07pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 03:02pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 03:00pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 02:55pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 02:53pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 02:49pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 02:48pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 02:45pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 02:43pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 02:38pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 02:38pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 02:37pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 02:16pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 02:15pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 12:25pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 12:22pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 12:22pm', '', 'purchase_orders.php', '1', '1'),
('07/30/2012 - 12:20pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 12:19pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 12:18pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 12:15pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 12:14pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 12:13pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 12:12pm', '', 'purchase_orders.php', '1', '1'),
('07/30/2012 - 11:51am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:50am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:47am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:45am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:29am', '', 'admin.php', '1', '1'),
('07/30/2012 - 11:29am', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:29am', '', 'purchase_orders.php', '1', '1'),
('07/30/2012 - 11:29am', '', 'invoice.php', '1', '1'),
('07/30/2012 - 11:29am', '', 'scheduler.php', '1', '1'),
('07/30/2012 - 11:29am', '', 'work_orders.php', '1', '1'),
('07/30/2012 - 11:29am', '', 'estimates.php', '1', '1'),
('07/30/2012 - 11:29am', '', 'customers.php', '1', '1'),
('07/30/2012 - 11:28am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:24am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:23am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:22am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:12am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:11am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:08am', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:08am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:07am', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:07am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:06am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:05am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:04am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:02am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:59am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:54am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:53am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:52am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:40am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:39am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:38am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:37am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:26am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:16am', '', 'invoice.php', '1', '1'),
('07/30/2012 - 10:15am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 10:15am', '', 'admin.php', '1', '1'),
('07/30/2012 - 10:14am', '', 'customers.php', '1', '1'),
('07/30/2012 - 10:14am', '', 'work_orders.php', '1', '1'),
('07/30/2012 - 10:11am', '', 'admin.php', '1', '1'),
('07/30/2012 - 09:18am', '', 'admin.php', '1', '1'),
('07/30/2012 - 09:17am', '', 'admin.php', '1', '1'),
('07/30/2012 - 09:15am', '', 'admin.php', '1', '1'),
('07/30/2012 - 09:10am', '', 'admin.php', '1', '1'),
('07/30/2012 - 09:02am', '', 'admin.php', '1', '1'),
('07/30/2012 - 08:48am', '', 'admin.php', '1', '1'),
('07/30/2012 - 08:47am', '', 'admin.php', '1', '1'),
('07/30/2012 - 08:46am', '', 'admin.php', '1', '1'),
('07/30/2012 - 08:43am', '', 'admin.php', '1', '1'),
('07/30/2012 - 08:42am', '', 'admin.php', '1', '1'),
('07/30/2012 - 08:42am', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 01:42pm', '', 'Logged In', '1', '1'),
('07/27/2012 - 11:05pm', '', 'customers.php', '1', '1'),
('07/27/2012 - 09:21pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 09:21pm', '', 'estimates.php', '1', '1'),
('07/27/2012 - 05:03pm', '', 'admin.php', '1', '1'),
('07/27/2012 - 04:57pm', '', 'admin.php', '1', '1'),
('07/27/2012 - 04:54pm', '', 'admin.php', '1', '1'),
('07/27/2012 - 04:22pm', '', 'customers.php', '1', '1'),
('07/27/2012 - 04:22pm', '', 'accounting.php', '1', '1'),
('07/27/2012 - 04:22pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:18pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:18pm', '', 'invoice.php', '1', '1'),
('07/27/2012 - 04:18pm', '', 'scheduler.php', '1', '1'),
('07/27/2012 - 04:18pm', '', 'work_orders.php', '1', '1'),
('07/27/2012 - 04:18pm', '', 'estimates.php', '1', '1'),
('07/27/2012 - 04:18pm', '', 'dashboard.php', '1', '1'),
('07/27/2012 - 04:18pm', '', 'customers.php', '1', '1'),
('07/27/2012 - 04:18pm', '', 'admin.php', '1', '1'),
('07/27/2012 - 04:17pm', '', 'accounting.php', '1', '1'),
('07/27/2012 - 04:17pm', '', 'scheduler.php', '1', '1'),
('07/27/2012 - 04:17pm', '', 'invoice.php', '1', '1'),
('07/27/2012 - 04:17pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:16pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:15pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:14pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:13pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:11pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:08pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:07pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:06pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:05pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:03pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 04:01pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 03:59pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 03:39pm', '', 'accounting.php', '1', '1'),
('07/27/2012 - 03:38pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 03:38pm', '', 'dashboard.php', '1', '1'),
('07/27/2012 - 03:38pm', '', 'accounting.php', '1', '1'),
('07/27/2012 - 03:07pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 02:55pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 02:53pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 02:32pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 02:32pm', '', 'invoice.php', '1', '1'),
('07/27/2012 - 02:30pm', '', 'customers.php', '1', '1'),
('07/27/2012 - 02:02pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 02:01pm', '', 'accounting.php', '1', '1'),
('07/27/2012 - 02:01pm', '', 'invoice.php', '1', '1'),
('07/27/2012 - 02:01pm', '', 'scheduler.php', '1', '1'),
('07/27/2012 - 02:01pm', '', 'work_orders.php', '1', '1'),
('07/27/2012 - 02:01pm', '', 'estimates.php', '1', '1'),
('07/27/2012 - 02:01pm', '', 'customers.php', '1', '1'),
('07/27/2012 - 02:01pm', '', 'dashboard.php', '1', '1'),
('07/27/2012 - 02:01pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 02:00pm', '', 'invoice.php', '1', '1'),
('07/27/2012 - 02:00pm', '', 'scheduler.php', '1', '1'),
('07/27/2012 - 02:00pm', '', 'work_orders.php', '1', '1'),
('07/27/2012 - 02:00pm', '', 'estimates.php', '1', '1'),
('07/27/2012 - 02:00pm', '', 'customers.php', '1', '1'),
('07/27/2012 - 02:00pm', '', 'accounting.php', '1', '1'),
('07/27/2012 - 02:00pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:59pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:58pm', '', 'accounting.php', '1', '1'),
('07/27/2012 - 01:57pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:56pm', '', 'dashboard.php', '1', '1'),
('07/27/2012 - 01:56pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:50pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:47pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:46pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:45pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:43pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:40pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:39pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:31pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:30pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:22pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:09pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:08pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:07pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:06pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:05pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:04pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:02pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 01:00pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 12:26pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 12:12pm', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 11:45am', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 11:44am', '', 'customers.php', '1', '1'),
('07/27/2012 - 11:44am', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'dashboard.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'admin.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'customers.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'estimates.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'work_orders.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'scheduler.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'invoice.php', '1', '1'),
('07/27/2012 - 11:42am', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 11:41am', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 11:18am', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 11:18am', '', 'estimates.php', '1', '1'),
('07/27/2012 - 11:17am', '', 'purchase_orders.php', '1', '1'),
('07/27/2012 - 11:17am', '', 'estimates.php', '1', '1'),
('07/27/2012 - 11:17am', '', 'admin.php', '1', '1'),
('07/27/2012 - 11:14am', '', 'admin.php', '1', '1'),
('07/27/2012 - 11:14am', '', 'customers.php', '1', '1'),
('07/27/2012 - 11:14am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 10:35am', '', 'dashboard.php', '1', '1'),
('07/27/2012 - 10:34am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 10:32am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 09:22am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 09:22am', '', 'invoice.php', '1', '1'),
('07/27/2012 - 09:22am', '', 'work_orders.php', '1', '1'),
('07/27/2012 - 08:53am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 08:49am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 08:47am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 08:42am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 08:38am', '', 'accounting.php', '1', '1'),
('07/27/2012 - 08:35am', '', 'accounting.php', '1', '1'),
('07/26/2012 - 11:05pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 11:05pm', '', 'invoice.php', '1', '1'),
('07/26/2012 - 11:05pm', '', 'customers.php', '1', '1'),
('07/26/2012 - 11:04pm', '', 'dashboard.php', '1', '1'),
('07/26/2012 - 11:04pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 11:04pm', '', 'invoice.php', '1', '1'),
('07/26/2012 - 11:04pm', '', 'scheduler.php', '1', '1'),
('07/26/2012 - 11:04pm', '', 'work_orders.php', '1', '1'),
('07/26/2012 - 11:04pm', '', 'estimates.php', '1', '1'),
('07/26/2012 - 11:04pm', '', 'customers.php', '1', '1'),
('07/26/2012 - 11:04pm', '', 'admin.php', '1', '1'),
('07/26/2012 - 11:01pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 11:01pm', '', 'customers.php', '1', '1'),
('07/26/2012 - 10:59pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 10:59pm', '', 'invoice.php', '1', '1'),
('07/26/2012 - 10:59pm', '', 'scheduler.php', '1', '1'),
('07/26/2012 - 10:59pm', '', 'work_orders.php', '1', '1'),
('07/26/2012 - 10:59pm', '', 'estimates.php', '1', '1'),
('07/26/2012 - 10:59pm', '', 'dashboard.php', '1', '1'),
('07/26/2012 - 10:58pm', '', 'customers.php', '1', '1'),
('07/26/2012 - 10:57pm', '', 'admin.php', '1', '1'),
('07/26/2012 - 10:55pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 10:53pm', '', 'dashboard.php', '1', '1'),
('07/26/2012 - 10:51pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 03:10pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 02:50pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 02:49pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 02:47pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:34pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:34pm', '', 'estimates.php', '1', '1'),
('07/26/2012 - 01:34pm', '', 'customers.php', '1', '1'),
('07/26/2012 - 01:34pm', '', 'invoice.php', '1', '1'),
('07/26/2012 - 01:34pm', '', 'scheduler.php', '1', '1'),
('07/26/2012 - 01:34pm', '', 'work_orders.php', '1', '1'),
('07/26/2012 - 01:28pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:27pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:26pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:26pm', '', 'invoice.php', '1', '1'),
('07/26/2012 - 01:25pm', '', 'scheduler.php', '1', '1'),
('07/26/2012 - 01:25pm', '', 'invoice.php', '1', '1'),
('07/26/2012 - 01:25pm', '', 'work_orders.php', '1', '1'),
('07/26/2012 - 01:25pm', '', 'estimates.php', '1', '1'),
('07/26/2012 - 01:25pm', '', 'dashboard.php', '1', '1'),
('07/26/2012 - 01:24pm', '', 'scheduler.php', '1', '1'),
('07/26/2012 - 01:24pm', '', 'work_orders.php', '1', '1'),
('07/26/2012 - 01:23pm', '', 'work_orders.php', '1', '1'),
('07/26/2012 - 01:23pm', '', 'dashboard.php', '1', '1'),
('07/26/2012 - 01:23pm', '', 'customers.php', '1', '1'),
('07/26/2012 - 01:23pm', '', 'scheduler.php', '1', '1'),
('07/26/2012 - 01:18pm', '', 'work_orders.php', '1', '1'),
('07/26/2012 - 01:18pm', '', 'estimates.php', '1', '1'),
('07/26/2012 - 01:18pm', '', 'customers.php', '1', '1'),
('07/26/2012 - 01:15pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:12pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:10pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:10pm', '', 'admin.php', '1', '1'),
('07/26/2012 - 01:09pm', '', 'accounting.php', '1', '1'),
('07/26/2012 - 01:09pm', '', 'invoice.php', '1', '1'),
('07/26/2012 - 01:09pm', '', 'scheduler.php', '1', '1'),
('07/26/2012 - 01:09pm', '', 'work_orders.php', '1', '1'),
('07/26/2012 - 01:09pm', '', 'estimates.php', '1', '1'),
('07/26/2012 - 01:09pm', '', 'dashboard.php', '1', '1'),
('07/26/2012 - 01:09pm', '', 'customers.php', '1', '1'),
('07/30/2012 - 09:19pm', '', 'customers.php', '1', '1'),
('07/30/2012 - 09:19pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 09:19pm', '', 'purchase_orders.php', '1', '1'),
('07/30/2012 - 09:19pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 09:21pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 09:51pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 09:55pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:14pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:17pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:22pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:24pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:25pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:26pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:27pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:38pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:39pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:41pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 10:59pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:00pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:02pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:39pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:41pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:44pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:45pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:46pm', '', 'admin.php', '1', '1'),
('07/30/2012 - 11:46pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:46pm', '', 'customers.php', '1', '1'),
('07/30/2012 - 11:46pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:47pm', '', 'invoice.php', '1', '1'),
('07/30/2012 - 11:47pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:47pm', '', 'purchase_orders.php', '1', '1'),
('07/30/2012 - 11:48pm', '', 'invoice.php', '1', '1'),
('07/30/2012 - 11:48pm', '', 'dashboard.php', '1', '1'),
('07/30/2012 - 11:48pm', '', 'work_orders.php', '1', '1'),
('07/30/2012 - 11:48pm', '', 'estimates.php', '1', '1'),
('07/30/2012 - 11:48pm', '', 'scheduler.php', '1', '1'),
('07/30/2012 - 11:49pm', '', 'purchase_orders.php', '1', '1'),
('07/30/2012 - 11:49pm', '', 'accounting.php', '1', '1'),
('07/30/2012 - 11:50pm', '', 'admin.php', '1', '1'),
('07/31/2012 - 08:02am', '', 'admin.php', '1', '1'),
('07/31/2012 - 08:02am', '', 'customers.php', '1', '1'),
('07/31/2012 - 08:02am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:04am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 08:04am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:09am', '', 'admin.php', '1', '1'),
('07/31/2012 - 08:10am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:12am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:23am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:24am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:35am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:36am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:37am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:38am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:39am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:40am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:41am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:47am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:50am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 08:58am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:11am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:12am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:14am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:19am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:20am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:20am', '', 'admin.php', '1', '1'),
('07/31/2012 - 09:20am', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 09:21am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:30am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:32am', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 09:33am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:35am', '', 'admin.php', '1', '1'),
('07/31/2012 - 09:35am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:47am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:56am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:57am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 09:59am', '', 'customers.php', '1', '1'),
('07/31/2012 - 10:12am', '', 'estimates.php', '1', '1'),
('07/31/2012 - 10:12am', '', 'work_orders.php', '1', '1'),
('07/31/2012 - 10:12am', '', 'scheduler.php', '1', '1'),
('07/31/2012 - 10:12am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 10:12am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 10:12am', '', 'accounting.php', '1', '1'),
('07/31/2012 - 10:14am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 10:45am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 10:45am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 10:48am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 10:50am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 10:52am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 10:53am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 10:54am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 10:55am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:21am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:24am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 11:29am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:39am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:41am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:42am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 11:42am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:43am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:44am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:46am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:48am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:50am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:51am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:52am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:54am', '', 'invoice.php', '1', '1'),
('07/31/2012 - 11:54am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 11:57am', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 12:02pm', '', 'accounting.php', '1', '1'),
('07/31/2012 - 12:02pm', '', 'invoice.php', '1', '1'),
('07/31/2012 - 12:02pm', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 12:02pm', '', 'admin.php', '1', '1'),
('07/31/2012 - 12:02pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:07pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:07pm', '', 'purchase_orders.php', '1', '1'),
('07/31/2012 - 12:07pm', '', 'invoice.php', '1', '1'),
('07/31/2012 - 12:08pm', '', 'invoice.php', '1', '1'),
('07/31/2012 - 12:08pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:15pm', '', 'invoice.php', '1', '1'),
('07/31/2012 - 12:15pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:16pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:17pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:18pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:21pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:22pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:23pm', '', 'estimates.php', '1', '1'),
('07/31/2012 - 12:23pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:24pm', '', 'estimates.php', '1', '1'),
('07/31/2012 - 12:25pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:26pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:31pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:37pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:38pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:39pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:40pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:41pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:42pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:43pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:44pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:45pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:46pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:47pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:55pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:56pm', '', 'dashboard.php', '1', '1'),
('07/31/2012 - 12:57pm', '', 'dashboard.php', '1', '1');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`cont_id`, `blong`, `firstname`, `lastname`, `title`, `email`, `phone`, `fax`, `active`, `isprime`, `saasid`) VALUES
(20, '21', 'Mary', 'Smith', 'Employee', 'mary@mail.com', '345.435.4353', '435.345.4353', 'true', 'false', '1'),
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
  `sched_stat` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `base_type` varchar(255) NOT NULL,
  `estprice` varchar(255) NOT NULL,
  `duedate` varchar(40) NOT NULL,
  `servicedate` varchar(40) NOT NULL,
  `inv_release_date` varchar(255) NOT NULL,
  `posit` varchar(255) NOT NULL,
  `timset` varchar(255) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `recurring` varchar(50) NOT NULL,
  `assignedtech` varchar(255) NOT NULL,
  `clipo` varchar(255) NOT NULL,
  `payment_terms` text NOT NULL,
  `notes` text NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `doc_type` varchar(255) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `active` varchar(100) NOT NULL,
  `rowstate` varchar(20) NOT NULL,
  `ispaid` varchar(50) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `core_docs`
--

INSERT INTO `core_docs` (`doc_id`, `company_name`, `company_id`, `location`, `value`, `issue_date`, `follow_up`, `days_left`, `salesman`, `valid_untill`, `status`, `sched_stat`, `contact_name`, `base_type`, `estprice`, `duedate`, `servicedate`, `inv_release_date`, `posit`, `timset`, `duration`, `priority`, `recurring`, `assignedtech`, `clipo`, `payment_terms`, `notes`, `created_by`, `doc_type`, `saasid`, `active`, `rowstate`, `ispaid`, `attachment`) VALUES
(33, '', '10', '14', '2,743.75', '07/31/2012', 'undefined', '-15552', '1', 'undefined', 'won', '', '17', 'undefined', '2,743.75', '', '', '', '', '', '', '', '', '', '32', '', '', '1', 'invoice', '1', 'true', 'used', '', ''),
(32, '', '50', '', '576.00', '07/17/2012', '07/17/2012', '', '', '07/17/2012', 'open', '', '', 'rental', '576.00', '', '', '', '', '', '', '', '', '', '', '', 'test', '', 'po', '1', 'true', 'used', '', ''),
(30, '', '21', '12', '686.25', '07/31/2012', '08/22/2012', '22', '2', '08/22/2012', 'pending', '', '20', 'sales', '686.25', '', '', '', '', '', '', '', '', '', '', '', '', '2', 'estimate', '1', 'true', 'used', '', ''),
(29, '', '8', '10', '845.44', '07/31/2012', '08/23/2012', '23', '1', '08/23/2012', 'won', 'set', '15', 'sales', '845.44', '07/27/2012', '07/27/2012', '07/26/2012', '247', '12:00pm', '2', 'Moderate', 'true', '4', '32', 'They will pay when completed', 'This is going to be a simple job.', '1', 'invoice', '1', 'true', 'used', '', ''),
(34, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'po', '1', '', 'unused', '', '');

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
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(90) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `phone` varchar(70) NOT NULL,
  `att_grp` varchar(255) NOT NULL,
  `active` varchar(20) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `sessid` varchar(255) NOT NULL,
  `isowner` varchar(255) NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `core_users`
--

INSERT INTO `core_users` (`usr_id`, `fname`, `lname`, `usrtyp`, `usrname`, `usrpass`, `address`, `city`, `state`, `zip`, `phone`, `att_grp`, `active`, `saasid`, `sessid`, `isowner`) VALUES
(1, 'Jason', 'Cotton', 'admin', 'jason@customsoftwarelab.com', 'access1300', '5676 W Busy ST', 'Oklahoma City', 'OK', '73034', '434.333.7775', '3', 'true', '1', '4949itjbji59igje9ifjJJGJ$9ogijneijinh', 'true'),
(2, 'William', 'Doe', 'salesman', 'william@mail.com', 'passit', '454 W East Creek', 'Edmond', 'OK', '73034', '223.343.5532', '4', 'true', '1', '34t8uvrngujrgfni4i9e3c9j9ijvi', 'false'),
(3, 'John', 'Doe', 'tech', 'john@mail.com', 'openit', '', '', '', '', '', '', 'true', '1', '45ty56ty56h56y56yrt5gt', 'false'),
(4, 'Greg', 'Lastname', 'tech', 'greg@mail.com', 'getinside', '', '', '', '', '', '', 'true', '1', 'efgiohnrhg9ih4hhf9hw9rehfg9hjrgrijg', 'false'),
(5, 'Jeff', 'Swope', 'employee', 'jeff@customsoftwarelab.com', '12345abc', '1234 East Rd', 'FT Worth', 'TX', '76101', '', '6', 'true', '1', '234t43t54y65y56y56u657u3erg', 'false'),
(6, 'Alice', 'Smith', 'employee', 'alice@mail.com', 'gogetit', '1234 W Creek St', 'Edmond', 'OK', '73034', '123.323.5456', '3', 'false', '1', '43e2e797e4e003c49b773ca7e0a2d43c', 'false'),
(7, 'Booby', 'Fisher', 'tech', 'bobby@mail.com', '123456789', '1234 W Nowhere LN ', 'Who Knows', 'AL', '56565', '232.232.4454', '3', 'true', '1', '5e494bb09c34cded897970c272611bcc', 'false');

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
  `bill_term` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `active` varchar(20) NOT NULL,
  `rowstate` varchar(40) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `resalelicense`, `resalecertex`, `certiofins`, `companyname`, `address1`, `address2`, `city`, `state`, `zip`, `county`, `issamebill`, `billaddress1`, `billaddress2`, `billcity`, `billstate`, `billzip`, `bill_term`, `notes`, `active`, `rowstate`, `saasid`) VALUES
(22, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'unused', '1'),
(21, '1233', '09/18/2012', '11/07/2012', 'Arrested Development', '1234 Knowledge Way', '', 'Edmond', 'OK', '73033', 'Oklahoma', 'true', '', '', '', 'AL', '', '60', 'This is a smooth client.', 'true', 'used', '1'),
(10, '456546', '05/02/2012', '05/30/2012', 'One Love', '345 W East Ave', '', 'Edmond', 'OK', '73034', 'Oklahoma', 'true', '', '', '', 'AL', '', '', '', 'true', 'used', '1'),
(9, '67676767', '05/14/2012', '05/23/2012', 'Tank Inc', '6780 W Port Ave', '7890 Ridge Ave', 'Oklahoma City', 'OK', '73033', 'Oklahoma', 'false', '3454 East Creek ST', '3454 East Creek ST', 'Edmond', 'OK', '73034', '60', 'Neat client''s as well.', 'true', 'used', '1'),
(8, '345345345', '09/12/2012', '09/12/2012', 'Custom Software Lab', '1234 W East Ave', '', 'Edmond', 'OK', '73034', 'Oklahoma', 'true', '', '', '', 'AL', '', '30', 'This is a very neat client.', 'true', 'used', '1');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `doc_items`
--

INSERT INTO `doc_items` (`itm_id`, `tru_id`, `sku`, `item_dec`, `item_name`, `item_price`, `is_tax`, `quant`, `doc_id`, `itmtyp`, `saasid`) VALUES
(140, '4', '56564-UJFU', 'This is a pressure cap.', 'Pressure Cap', '123.22', 'true', '2', '24', 'product', '1'),
(139, '2', '', 'We will set things up for you.', 'Rig Setup', '80.00', 'false', '10', '23', 'service', '1'),
(131, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '1', '20', 'product', '1'),
(127, '2', '', 'We will set things up for you.', 'Rig Setup', '80.00', 'false', '16', '19', 'service', '1'),
(138, '6', '45654-90DS', 'Replacement top for RST models ', 'Container Top', '100.00', 'true', '1', '23', 'product', '1'),
(132, '3', '456465-RGFR', 'This is where the trash goes.', 'Receptacle', '2500.00', 'true', '1', '20', 'product', '1'),
(133, '2', '', 'We will set things up for you.', 'Rig Setup', '80.00', 'false', '4', '20', 'service', '1'),
(137, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '1', '23', 'product', '1'),
(125, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '5', '19', 'product', '1'),
(141, '6', '45654-90DS', 'Replacement top for RST models ', 'Container Top', '100.00', 'true', '1', '24', 'product', '1'),
(142, '7', '', 'We inspect receptacles every month', 'Monthly Inspection', '150.00', 'false', '3', '24', 'service', '1'),
(143, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '1', '25', 'product', '1'),
(144, '5', '3453-345FQ', 'Contains all liquids that may spill out.', 'Fluid Cap', '290.00', 'true', '1', '25', 'product', '1'),
(145, '7', '', 'We inspect receptacles every month', 'Monthly Inspection', '150.00', 'false', '3', '25', 'service', '1'),
(146, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '1', '22', 'product', '1'),
(147, '6', '45654-90DS', 'Replacement top for RST models ', 'Container Top', '100.00', 'true', '2', '22', 'product', '1'),
(148, '2', '', 'We will set things up for you.', 'Rig Setup', '80.00', 'false', '5', '22', 'service', '1'),
(156, '2', '', 'We will set things up for you.', 'Rig Setup', '80.00', 'false', '2', '29', 'service', '1'),
(155, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '1', '29', 'product', '1'),
(163, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '1', '30', 'product', '1'),
(159, '1', '3434-45453TG', 'This is a companctor gear set..', 'Compactor Gear Set', '576.00', 'true', '1', '32', 'product', '1'),
(162, '3', '456465-RGFR', 'This is where the trash goes.', 'Receptacle', '2500.00', 'true', '1', '33', 'product', '1');

-- --------------------------------------------------------

--
-- Table structure for table `group_tab`
--

CREATE TABLE IF NOT EXISTS `group_tab` (
  `grp_id` int(255) NOT NULL AUTO_INCREMENT,
  `grp_name` varchar(200) NOT NULL,
  `customer_access` varchar(200) NOT NULL,
  `estimate_access` varchar(200) NOT NULL,
  `workorder_access` varchar(200) NOT NULL,
  `scheduler_access` varchar(200) NOT NULL,
  `invoice_access` varchar(200) NOT NULL,
  `purchase_access` varchar(200) NOT NULL,
  `accounting_access` varchar(200) NOT NULL,
  `admin_access` varchar(200) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `active` varchar(200) NOT NULL,
  PRIMARY KEY (`grp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `group_tab`
--

INSERT INTO `group_tab` (`grp_id`, `grp_name`, `customer_access`, `estimate_access`, `workorder_access`, `scheduler_access`, `invoice_access`, `purchase_access`, `accounting_access`, `admin_access`, `saasid`, `active`) VALUES
(3, 'Jason''s Group', 'true,true,true', 'true,false,false', 'true,true,false', 'true,true,false', 'true,false,false', 'false,false,false', 'false,false,false', 'false,false,false', '1', 'true'),
(4, 'Basic Group', 'true,true,false', 'true,true,false', 'true,true,false', 'true,true,false', 'true,false,false', 'false,false,false', 'false,false,false', 'false,false,false', '1', 'true'),
(5, 'No Read Access', 'false,false,false', 'false,false,false', 'false,false,false', 'false,false,false', 'false,false,false', 'false,false,false', 'false,false,false', 'false,false,false', '1', 'true'),
(6, 'Read Access', 'true,false,false', 'true,false,false', 'true,false,false', 'true,false,false', 'true,false,false', 'true,false,false', 'true,false,false', 'true,false,false', '1', 'true'),
(7, 'Intern Access', 'true,false,false', 'false,false,false', 'true,false,false', 'true,false,false', 'false,false,false', 'false,false,false', 'false,false,false', 'false,false,false', '1', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE IF NOT EXISTS `invoice_payments` (
  `pay_id` int(255) NOT NULL AUTO_INCREMENT,
  `inv_num` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `checknum` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `bankset` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`pay_id`, `inv_num`, `date`, `checknum`, `amount`, `bankset`, `notes`, `saasid`) VALUES
(7, '29', '07/26/2012', '1232', '845.44', '43', 'Client Payment', '1');

-- --------------------------------------------------------

--
-- Table structure for table `journal_entry`
--

CREATE TABLE IF NOT EXISTS `journal_entry` (
  `jor_id` int(255) NOT NULL AUTO_INCREMENT,
  `memo` text NOT NULL,
  `glacct` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `debit` varchar(255) NOT NULL,
  `memo2` text NOT NULL,
  `glacct2` varchar(255) NOT NULL,
  `vendor2` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `dateset` varchar(255) NOT NULL,
  PRIMARY KEY (`jor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `journal_entry`
--


-- --------------------------------------------------------

--
-- Table structure for table `ledger_tabs`
--

CREATE TABLE IF NOT EXISTS `ledger_tabs` (
  `glid` int(255) NOT NULL AUTO_INCREMENT,
  `fld1` text NOT NULL,
  `fld2` text NOT NULL,
  `fld3` text NOT NULL,
  `fld4` text NOT NULL,
  `addressset` varchar(255) NOT NULL,
  `fld5` text NOT NULL,
  `fld6` text NOT NULL,
  `fld7` text NOT NULL,
  `fld8` text NOT NULL,
  `fld9` text NOT NULL,
  `fld10` text NOT NULL,
  `fld11` text NOT NULL,
  `ven_address2` varchar(255) NOT NULL,
  `ven_coied` varchar(255) NOT NULL,
  `ven_cowed` varchar(255) NOT NULL,
  `vencon_fname` varchar(255) NOT NULL,
  `vencon_lname` varchar(255) NOT NULL,
  `vencon_email` varchar(255) NOT NULL,
  `vencon_phone` varchar(255) NOT NULL,
  `vencon_fax` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_vend` varchar(255) NOT NULL,
  `subacct` varchar(255) NOT NULL,
  `dubsub` varchar(255) NOT NULL,
  `active` varchar(10) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `added_date` int(11) NOT NULL,
  PRIMARY KEY (`glid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `ledger_tabs`
--

INSERT INTO `ledger_tabs` (`glid`, `fld1`, `fld2`, `fld3`, `fld4`, `addressset`, `fld5`, `fld6`, `fld7`, `fld8`, `fld9`, `fld10`, `fld11`, `ven_address2`, `ven_coied`, `ven_cowed`, `vencon_fname`, `vencon_lname`, `vencon_email`, `vencon_phone`, `vencon_fax`, `type`, `is_vend`, `subacct`, `dubsub`, `active`, `saasid`, `added_date`) VALUES
(47, 'Water Dept', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'expense', '', '44', '', 'true', '1', 0),
(44, 'Bills', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'expense', '', 'none', '', 'true', '1', 0),
(45, 'OGE', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'expense', '', '44', '', 'true', '1', 0),
(46, 'Phone and Cable', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'expense', '', '44', '', 'true', '1', 0),
(43, 'Main Account', '', '123.322.2323', '1710.54', '1234 Park Way', '', 'OK', 'Edmond', '73034', '3434-34343-333434', '43545-4545', '100', '', '', '', '', '', '', '', '', 'bank', '', 'none', '', 'true', '1', 0),
(50, 'Cupsx', '34343', '', '', '123 E Creek ST', '', 'OK', 'Edmond', '73034', '', '', '', '12345 W East Ave', '123', '456', 'Jason', 'Cotton', 'jason@customsoftwarelab.com', '123.433.3434', '234.343.3434', 'expense', 'true', 'none', '', 'true', '1', 0),
(53, 'Visa', '30', '07/31/2012', '1200.50', '2323-2323-2323', '30', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'loan', '', '52', '', 'true', '1', 0),
(52, 'Credit Cards', '', '07/31/2012', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'loan', '', 'none', '', 'true', '1', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locid`, `blong`, `address1`, `address2`, `city`, `state`, `zip`, `county`, `taxs`, `active`, `saasid`) VALUES
(12, '21', '101 Parkway Ave', '', 'New York', 'NY', '45444', 'York', '4,5', 'true', '1'),
(13, '9', '5656 East Red Ave', '', 'LA', 'CA', '90210', 'LA', '4,5', 'true', '1'),
(14, '10', '1234 Open Way ST', '', 'Norman', 'OK', '98893', 'Norman', '1', 'true', '1'),
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
  `cost` varchar(255) NOT NULL,
  `rental` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `min` varchar(255) NOT NULL,
  `max` varchar(255) NOT NULL,
  `tie_prod` text NOT NULL,
  `active` varchar(12) NOT NULL,
  `item_typ` varchar(20) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`items_ids`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `productservi`
--

INSERT INTO `productservi` (`items_ids`, `item_name`, `sku`, `decs`, `status`, `inventory`, `price`, `cost`, `rental`, `vendor`, `min`, `max`, `tie_prod`, `active`, `item_typ`, `saasid`) VALUES
(1, 'Compactor Gear Set', '3434-45453TG', 'This is a companctor gear set..', 'In Stock', '5378', '576.00', '200.00', '', '50', '1', '900', '', 'true', 'product', '1'),
(2, 'Rig Setup', '', 'We will set things up for you.', 'In Stock', '', '80.00', '', '', '', '', '', '', 'true', 'service', '1'),
(3, 'Receptacle', '456465-RGFR', 'This is where the trash goes.', 'In Stock', '20', '2500.00', '900.00', '', 'none', '20', '500', '', 'true', 'product', '1'),
(4, 'Pressure Cap', '56564-UJFU', 'This is a pressure cap.', 'In Stock', '41', '123.22', '99.00', '', 'none', '4', '67', '', 'true', 'product', '1'),
(5, 'Fluid Cap', '3453-345FQ', 'Contains all liquids that may spill out.', 'In Stock', '561', '290.00', '100.00', '120.00', '2', '6', '100', '', 'true', 'product', '1'),
(6, 'Container Top', '45654-90DS', 'Replacement top for RST models ', 'In Stock', '36', '100.00', '50.00', '', 'none', '10', '1000', '', 'true', 'product', '1'),
(7, 'Monthly Inspection', '', 'We inspect receptacles every month', 'In Stock', '', '150.00', '', '', '', '', '', '', 'true', 'service', '1'),
(9, 'Test Products', '454-123-6767R', 'This is a test product', 'In Stock', '45', '40.00', '23.00', '10.00', '2', '1', '900', '1,3,4,5', 'true', 'product', '1'),
(15, 'Computer Service', '', 'This is program service.', 'In Stock', '', '150.00', '', '', '', '', '', '', 'false', 'service', '1'),
(14, 'sddsf', '324234-234234', 'hi there', 'In Stock', '1', '20.00', '12.00', '5.00', '2', '1', '434', '5,6', 'false', 'product', '1'),
(16, 'Check Service', '', 'This is a dialog test.', 'In Stock', '', '20.00', '', '', '', '', '', '', 'false', 'service', '1');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_out`
--

CREATE TABLE IF NOT EXISTS `revenue_out` (
  `rev_id` int(255) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`rev_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `revenue_out`
--

INSERT INTO `revenue_out` (`rev_id`, `month`, `year`, `amount`, `saasid`) VALUES
(1, '06', '2012', '5,590.00', '1'),
(2, '05', '2012', '3,000.90', '1');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tax_table`
--

INSERT INTO `tax_table` (`tax_id`, `tax_name`, `state`, `percent`, `county`, `active`, `saasid`) VALUES
(1, 'OKC Sales Tax', 'OK', '9.75', 'Oklahoma', 'true', '1'),
(2, 'Edmond Tax', 'OK', '9.25', 'Oklahoma', 'true', '1'),
(3, 'Guthrie Sales', 'OK', '7.95', 'Logan', 'true', '1'),
(4, 'Tulsa Sales', 'OK', '9.56', 'Tulsa', 'true', '1'),
(5, 'New York Tax', 'New York', '9.58', 'York', 'true', '1'),
(6, 'My Tax', 'OK', '5.6', 'My County', 'true', '1'),
(7, 'Cool Tax', 'AR', '5.4', 'monogt', 'false', '1');

-- --------------------------------------------------------

--
-- Table structure for table `transandpays`
--

CREATE TABLE IF NOT EXISTS `transandpays` (
  `pyid` int(255) NOT NULL AUTO_INCREMENT,
  `date` varchar(45) NOT NULL,
  `numtype` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `memo` text NOT NULL,
  `gl_act` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `direct` varchar(255) NOT NULL,
  `deposit` varchar(255) NOT NULL,
  `paidby` varchar(255) NOT NULL,
  `paytype` varchar(255) NOT NULL,
  `ref_id` varchar(255) NOT NULL,
  `jorn_num` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `terms` varchar(255) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `ispay` varchar(255) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  PRIMARY KEY (`pyid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=192 ;

--
-- Dumping data for table `transandpays`
--

INSERT INTO `transandpays` (`pyid`, `date`, `numtype`, `name`, `memo`, `gl_act`, `payment`, `direct`, `deposit`, `paidby`, `paytype`, `ref_id`, `jorn_num`, `vendor`, `terms`, `due_date`, `status`, `ispay`, `saasid`) VALUES
(183, '07/26/2012', 'CHECK', '', 'Submited Payment', '47', '34.90', '182', '', '43', 'check', '', '', '', '', '', '', 'true', '1'),
(182, '07/26/2012', 'Submitted Bill', '', '', '47', '234.90', '', '', '', '', '45664', '', '', 'Net 15', '07/31/2012', 'open', '', '1'),
(181, '07/26/2012', 'DEP', 'Starting Balance', 'This is the starting Balance ', '43', '', '', '900.00', '', 'deposit', '', '', '', '', '', '', 'true', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `ven_id` int(255) NOT NULL AUTO_INCREMENT,
  `gl_id` varchar(255) NOT NULL,
  `ven_name` varchar(100) NOT NULL,
  `ven_address` varchar(200) NOT NULL,
  `ven_address2` varchar(200) NOT NULL,
  `ven_city` varchar(100) NOT NULL,
  `ven_state` varchar(100) NOT NULL,
  `ven_zip` varchar(6) NOT NULL,
  `ven_coied` varchar(255) NOT NULL,
  `ven_cowed` varchar(255) NOT NULL,
  `vencon_fname` varchar(100) NOT NULL,
  `vencon_lname` varchar(100) NOT NULL,
  `vencon_email` varchar(200) NOT NULL,
  `vencon_phone` varchar(16) NOT NULL,
  `vencon_fax` varchar(16) NOT NULL,
  `saasid` varchar(255) NOT NULL,
  `active` varchar(12) NOT NULL,
  PRIMARY KEY (`ven_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`ven_id`, `gl_id`, `ven_name`, `ven_address`, `ven_address2`, `ven_city`, `ven_state`, `ven_zip`, `ven_coied`, `ven_cowed`, `vencon_fname`, `vencon_lname`, `vencon_email`, `vencon_phone`, `vencon_fax`, `saasid`, `active`) VALUES
(1, '456456456', 'James Doe', '3465 W Way Ave', '', 'Edmond', 'OK', '73034', '06/25/2015', '06/13/2018', 'Jane', 'Doe', 'jane@email.com', '123.323.2322', '', '1', 'false'),
(2, '34534534545', 'Vend Inc', '123 W East Rd', '', 'Oklahoma City', 'OK', '73334', '06/15/2012', '06/20/2012', 'Kelly', 'Doe', 'kelly@mail.com', '123.323.2323', '', '1', 'true');
