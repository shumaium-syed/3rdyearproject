
--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, 'mothers day cake', '3DcAM01', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img\\mothercake.PNG', 1200.00),
(2, 'Noodles Cake Frenzy.', 'USB02', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img', 1000.00),
(3, 'Cherry Chocolicious', 'ab12cd', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img', 1300.00),
(4, 'Bride ToBe', 'LPN45', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img', 1800.00),
(5, 'We bare bear Cake', 'gh56fg', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img', 1500.00),
(6, 'Monster Cake Especial', 'wedr34', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img', 1200.00),
(7, 'Shark Frenzy', 'tyhu78', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img', 1400.00),
(8, 'Its a girl!', 'fg6789er', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img', 1000.00),
(9, 'Eid Mubarak!', 'iku89yt', 'C:\\Users\\HP USER\\Desktop\\Bakers\\assets\\img', 700.00);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;
