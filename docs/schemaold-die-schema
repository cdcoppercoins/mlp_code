-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2026 at 11:38 AM
-- Server version: 5.7.44
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `copperco_copperco`
--

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `itemID` int(8) UNSIGNED NOT NULL,
  `date` varchar(4) NOT NULL DEFAULT '',
  `mint` varchar(4) NOT NULL DEFAULT '',
  `denom` varchar(8) NOT NULL DEFAULT '',
  `service` varchar(8) NOT NULL DEFAULT '',
  `grade1` varchar(4) NOT NULL DEFAULT '',
  `grade2` varchar(8) NOT NULL DEFAULT '',
  `price` double(8,2) DEFAULT NULL,
  `bids` varchar(4) NOT NULL DEFAULT '',
  `closed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notes` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `die`
--

CREATE TABLE `die` (
  `die_id` varchar(15) NOT NULL DEFAULT '',
  `date_id` varchar(8) NOT NULL DEFAULT '',
  `die_date` varchar(4) NOT NULL DEFAULT '',
  `die_mint` char(1) NOT NULL DEFAULT '',
  `die_denom` char(2) NOT NULL DEFAULT '1',
  `die_type` char(2) NOT NULL DEFAULT '',
  `die_num` char(3) NOT NULL DEFAULT '',
  `die_prof` int(1) NOT NULL DEFAULT '0',
  `die_class` varchar(50) NOT NULL DEFAULT '',
  `die_rating` int(1) NOT NULL DEFAULT '0',
  `die_coneca` varchar(15) NOT NULL DEFAULT '',
  `die_wexler` varchar(15) NOT NULL DEFAULT '',
  `die_cpg` varchar(15) NOT NULL DEFAULT '',
  `die_crawford` varchar(15) NOT NULL DEFAULT '',
  `die_notes` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='select die_id, die_coneca, die_wexler from die where die_date = ''1962'' and die_mint = ''d''';

-- --------------------------------------------------------

--
-- Table structure for table `die_cross`
--

CREATE TABLE `die_cross` (
  `seq` int(11) NOT NULL,
  `year` int(4) UNSIGNED NOT NULL DEFAULT '0',
  `mint` char(1) NOT NULL DEFAULT '0',
  `wex` int(3) UNSIGNED ZEROFILL NOT NULL DEFAULT '000',
  `vv` int(3) UNSIGNED ZEROFILL NOT NULL DEFAULT '000',
  `cc` int(3) UNSIGNED ZEROFILL NOT NULL DEFAULT '000',
  `fs` int(3) UNSIGNED ZEROFILL NOT NULL DEFAULT '000'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Cross references working between all die systems.';

-- --------------------------------------------------------

--
-- Table structure for table `die_images`
--

CREATE TABLE `die_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `relative_path` varchar(512) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` enum('new','assigned','done','skipped') NOT NULL DEFAULT 'new',
  `skipped_reason` varchar(255) DEFAULT NULL,
  `assigned_to` varchar(64) DEFAULT NULL,
  `assigned_at` datetime DEFAULT NULL,
  `caption` text,
  `notes` text,
  `ai_suggestion` text,
  `captioned_at` datetime DEFAULT NULL,
  `captioned_by` varchar(64) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_seen_at` datetime DEFAULT NULL,
  `missing` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `die_info`
--

CREATE TABLE `die_info` (
  `die_id` varchar(12) NOT NULL DEFAULT '',
  `die_class` varchar(20) NOT NULL DEFAULT '',
  `star_rating` char(1) NOT NULL DEFAULT '',
  `die_notes` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faqindex` int(10) UNSIGNED NOT NULL,
  `faqcat` varchar(25) NOT NULL DEFAULT '',
  `faqquestion` text,
  `faqanswer` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `glossary`
--

CREATE TABLE `glossary` (
  `term` varchar(30) NOT NULL DEFAULT '',
  `define` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade` varchar(6) NOT NULL DEFAULT '',
  `grade_notes` blob,
  `grade_1` blob,
  `grade_2` blob,
  `grade_3` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `date_id` varchar(8) NOT NULL DEFAULT '',
  `guide_date` varchar(4) NOT NULL DEFAULT '',
  `guide_denom` varchar(4) NOT NULL DEFAULT '',
  `guide_history` text NOT NULL,
  `guide_o_grading` text NOT NULL,
  `guide_r_grading` text NOT NULL,
  `guide_year_notes` text NOT NULL,
  `guide_pocket_change` text NOT NULL,
  `guide_the_proof` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imageCaptions`
--

CREATE TABLE `imageCaptions` (
  `filename` varchar(50) NOT NULL,
  `caption` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers_eds`
--

CREATE TABLE `markers_eds` (
  `dieId` varchar(17) NOT NULL DEFAULT '',
  `obverseMarkers` text NOT NULL,
  `reverseMarkers` text NOT NULL,
  `dateAdded` date NOT NULL DEFAULT '0000-00-00',
  `credit` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers_eds_old`
--

CREATE TABLE `markers_eds_old` (
  `dieId` varchar(17) NOT NULL DEFAULT '',
  `obverseMarkers` text NOT NULL,
  `reverseMarkers` text NOT NULL,
  `dateAdded` date NOT NULL DEFAULT '0000-00-00',
  `credit` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers_lds`
--

CREATE TABLE `markers_lds` (
  `dieId` varchar(17) NOT NULL DEFAULT '',
  `obverseMarkers` text NOT NULL,
  `reverseMarkers` text NOT NULL,
  `dateAdded` date NOT NULL DEFAULT '0000-00-00',
  `credit` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers_lds_old`
--

CREATE TABLE `markers_lds_old` (
  `dieId` varchar(17) NOT NULL DEFAULT '',
  `obverseMarkers` text NOT NULL,
  `reverseMarkers` text NOT NULL,
  `dateAdded` date NOT NULL DEFAULT '0000-00-00',
  `credit` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers_mds`
--

CREATE TABLE `markers_mds` (
  `dieId` varchar(17) NOT NULL DEFAULT '',
  `obverseMarkers` text NOT NULL,
  `reverseMarkers` text NOT NULL,
  `dateAdded` date NOT NULL DEFAULT '0000-00-00',
  `credit` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers_mds_old`
--

CREATE TABLE `markers_mds_old` (
  `dieId` varchar(17) NOT NULL DEFAULT '',
  `obverseMarkers` text NOT NULL,
  `reverseMarkers` text NOT NULL,
  `dateAdded` date NOT NULL DEFAULT '0000-00-00',
  `credit` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mint`
--

CREATE TABLE `mint` (
  `date_id` varchar(8) NOT NULL DEFAULT '',
  `mint_proof` int(1) NOT NULL DEFAULT '0',
  `mint_mint` char(2) NOT NULL DEFAULT '',
  `mint_mintage` bigint(15) NOT NULL DEFAULT '0',
  `mint_mint_class` int(2) NOT NULL DEFAULT '0',
  `mint_circ_class` int(2) DEFAULT NULL,
  `mint_population` varchar(6) DEFAULT NULL,
  `mint_type` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `die_id` varchar(15) NOT NULL DEFAULT '',
  `state_eds_o` text,
  `state_eds_r` text,
  `state_eds_images` char(2) NOT NULL DEFAULT '0',
  `eds_added` varchar(8) DEFAULT NULL,
  `eds_credit` varchar(20) DEFAULT NULL,
  `state_mds_o` text,
  `state_mds_r` text,
  `state_mds_images` char(2) NOT NULL DEFAULT '0',
  `mds_added` varchar(8) DEFAULT NULL,
  `mds_credit` varchar(20) DEFAULT NULL,
  `state_lds_o` text,
  `state_lds_r` text,
  `state_lds_images` char(2) NOT NULL DEFAULT '0',
  `lds_added` varchar(8) DEFAULT NULL,
  `lds_credit` varchar(20) DEFAULT NULL,
  `f_value` varchar(8) NOT NULL DEFAULT '0',
  `vf_value` varchar(8) NOT NULL DEFAULT '',
  `ef_value` varchar(8) NOT NULL DEFAULT '',
  `au_value` varchar(8) NOT NULL DEFAULT '',
  `unc_value` varchar(8) NOT NULL DEFAULT '',
  `bu_value` varchar(8) NOT NULL DEFAULT '',
  `gem_value` varchar(8) NOT NULL DEFAULT '',
  `pr63_value` varchar(8) NOT NULL DEFAULT '',
  `pr65_value` varchar(8) NOT NULL DEFAULT '',
  `pr67_value` varchar(8) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `die`
--
ALTER TABLE `die`
  ADD PRIMARY KEY (`die_id`),
  ADD KEY `date_id` (`date_id`);

--
-- Indexes for table `die_cross`
--
ALTER TABLE `die_cross`
  ADD KEY `Index 1` (`seq`,`mint`,`year`);

--
-- Indexes for table `die_images`
--
ALTER TABLE `die_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_relative_path` (`relative_path`),
  ADD KEY `idx_status_assigned` (`status`,`assigned_at`),
  ADD KEY `idx_status_id` (`status`,`id`),
  ADD KEY `idx_assigned_to` (`assigned_to`),
  ADD KEY `idx_missing` (`missing`),
  ADD KEY `idx_updated_at` (`updated_at`),
  ADD KEY `idx_captioned_by` (`captioned_by`);

--
-- Indexes for table `die_info`
--
ALTER TABLE `die_info`
  ADD PRIMARY KEY (`die_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faqindex`);

--
-- Indexes for table `glossary`
--
ALTER TABLE `glossary`
  ADD PRIMARY KEY (`term`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`grade`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`date_id`);

--
-- Indexes for table `imageCaptions`
--
ALTER TABLE `imageCaptions`
  ADD PRIMARY KEY (`filename`);

--
-- Indexes for table `markers_eds`
--
ALTER TABLE `markers_eds`
  ADD PRIMARY KEY (`dieId`);

--
-- Indexes for table `markers_eds_old`
--
ALTER TABLE `markers_eds_old`
  ADD PRIMARY KEY (`dieId`);

--
-- Indexes for table `markers_lds`
--
ALTER TABLE `markers_lds`
  ADD PRIMARY KEY (`dieId`);

--
-- Indexes for table `markers_lds_old`
--
ALTER TABLE `markers_lds_old`
  ADD PRIMARY KEY (`dieId`);

--
-- Indexes for table `markers_mds`
--
ALTER TABLE `markers_mds`
  ADD PRIMARY KEY (`dieId`);

--
-- Indexes for table `markers_mds_old`
--
ALTER TABLE `markers_mds_old`
  ADD PRIMARY KEY (`dieId`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`die_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `itemID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `die_cross`
--
ALTER TABLE `die_cross`
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `die_images`
--
ALTER TABLE `die_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faqindex` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;
