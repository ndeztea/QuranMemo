
CREATE TABLE `juz` (
  `id` int(11) NOT NULL,
  `juz_indo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `juz_arabic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `page` int(11) NOT NULL,
  `id_surah` int(11) NOT NULL,
  `ayat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `juz`
--

INSERT INTO `juz` (`id`, `juz_indo`, `juz_arabic`, `page`, `id_surah`, `ayat`) VALUES
(1, 'Alif-Lam-Mim', 'الف لام میم', 1, 1, 1),
(2, 'Sayaq?l', 'سيقول السفهاء', 22, 2, 142),
(3, 'Tilka -r-rusul', 'تلك الرسل', 42, 2, 253),
(4, 'Lan Tana Lu', 'لن تنالوا البر', 62, 3, 93),
(5, 'W-al-muḥṣanāt', 'والمحصنات', 82, 4, 24),
(6, 'Lā yuẖibbu-llāh', 'لا يحب الله', 102, 4, 148),
(7, ' Wa ʾidha samiʿū', 'وإذا سمعو', 121, 5, 82),
(8, 'Wa law ʾannanā', 'ولو أننا نزلنا', 142, 6, 111),
(9, 'Qāl al-malāʾ', 'قال الملأ', 162, 7, 88),
(10, 'W-aʿlamū', 'واعلموا', 182, 0, 0),
(11, 'Yaʾtadhirūna', 'يعتذرون', 0, 0, 0),
(12, 'Wa mā min dābbah', 'ومامن دابة', 0, 0, 0),
(13, 'Wa mā ʾubarriʾu', 'وما أبرئ نفسي', 0, 0, 0),
(14, 'Ruba Maʾ', 'الف لام را', 0, 0, 0),
(15, 'Subḥāna -lladhi', 'سبحان', 0, 0, 0),
(16, 'Qāla ʾa-lam', 'قال ألم', 0, 0, 0),
(17, 'Aqtaraba li-n-nās', 'اقترب للناس', 0, 0, 0),
(18, ' Qad ʾaflaḥa', 'قد أفلح', 0, 0, 0),
(19, 'Wa-qāla -lladhīna', 'وقال الذين لا يرجون', 0, 0, 0),
(20, 'Am-man khalaq', 'فما كان جواب قومه', 0, 0, 0),
(21, 'Utlu ma uhiya', 'ولا تجادلوا', 0, 0, 0),
(22, 'Wa-man yaqnut', 'ومن يقنت', 0, 0, 0),
(23, 'Wa-mā-liya', 'وما أنزلنا', 0, 0, 0),
(24, 'Fa-man ʾaẓlamu', 'فمن أظلم', 0, 0, 0),
(25, 'ʾIlaihi yuraddu', 'إليه يرد', 0, 0, 0),
(26, 'Ḥāʾ Mīm', 'خاـمیم', 0, 0, 0),
(27, 'Qāla fa-mā khatbukum', 'قال فما خطبكم', 0, 0, 0),
(28, 'Qad samiʿa -llāhu', 'قد سمع', 0, 0, 0),
(29, 'Tabāraka -lladhi', 'تبارك', 0, 0, 0),
(30, 'ʿAmma', 'عمّ', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `juz`
--
ALTER TABLE `juz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);
