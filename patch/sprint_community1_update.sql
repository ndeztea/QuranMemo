
--
-- Table structure for table `memo_target`
--

DROP TABLE IF EXISTS `memo_target`;
CREATE TABLE `memo_target` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `surah_start` int(11) NOT NULL,
  `ayat_start` int(11) NOT NULL,
  `ayat_end` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `note` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memo_target`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `memo_target`
--
ALTER TABLE `memo_target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memo_target`
--
ALTER TABLE `memo_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `memo_target` ADD `record` VARCHAR(100) NULL AFTER `note`;


-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2016 at 12:50 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_qurannote`
--

-- --------------------------------------------------------

--
-- Table structure for table `memo_target_correction`
--

CREATE TABLE `memo_target_correction` (
  `id` int(11) NOT NULL,
  `id_memo_target` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `correction` text NOT NULL,
  `note` text,
  `status` int(11) DEFAULT '0',
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memo_target_correction`
--
ALTER TABLE `memo_target_correction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_memo_target` (`id_memo_target`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memo_target_correction`
--
ALTER TABLE `memo_target_correction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `memo_target` ADD `count_correction` INT NOT NULL AFTER `record`;

ALTER TABLE `users`  ADD `last_login` DATETIME NULL;

ALTER TABLE `users` ADD `gender` VARCHAR(1) NOT NULL AFTER `name`;



