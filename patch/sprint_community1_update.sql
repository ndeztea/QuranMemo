
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