
USE `todo-rocks-migrate`;

-- Dumping structure for table todo-rocks-migrate.lists
CREATE TABLE IF NOT EXISTS `lists` (
  `listID` varchar(10) NOT NULL,
  `listName` varchar(50) DEFAULT NULL,
  `createdOn` datetime DEFAULT current_timestamp(),
  `updatedOn` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userID` int(11) DEFAULT NULL,
  `private` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`listID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table todo-rocks-migrate.lists: ~41 rows (approximately)
INSERT INTO `lists` (`listID`, `listName`, `createdOn`, `updatedOn`, `userID`, `private`) VALUES
	('11x0qu1e', 'lala', '2022-10-23 00:54:28', '2022-10-23 00:54:28', NULL, 0),
	('1a5tw1q', 'Todo', '2022-09-15 19:10:52', '2022-09-15 19:10:52', NULL, 0),
	('23mzm37', 'test', '2023-01-18 15:55:13', '2023-01-18 15:55:13', NULL, 0),
	('2coydjat', 'مقاضي', '2022-09-03 17:23:13', '2022-09-03 17:23:13', NULL, 0),
	('2kp0b0p', 'SALAMON', '2022-08-14 00:01:03', '2022-08-14 00:01:03', NULL, 0),
	('2nuo1x', 'Groceries', '2022-08-25 18:50:49', '2023-06-04 22:12:55', NULL, 0),
	('5y0u9a', 'Salmeen Binmahfooz', '2022-08-14 00:55:22', '2022-08-14 00:55:22', NULL, 0),
	('66jjqa', 'تسوق', '2022-08-14 19:46:19', '2022-08-14 19:46:19', NULL, 0),
	('6bd3tpsl', 'Bakr to do list', '2022-08-14 17:53:58', '2022-08-14 17:53:58', NULL, 0),
	('7tfkgg', 'test', '2022-08-14 22:55:35', '2022-08-14 22:55:35', NULL, 0),
	('8eb0wx', 'minecraft', '2022-09-11 01:18:56', '2022-09-11 01:18:56', NULL, 0),
	('9azbxfc', 'test', '2023-01-29 21:37:27', '2023-01-29 21:37:27', NULL, 0),
	('9lma7ya', 'Gym', '2022-10-04 12:49:01', '2022-10-04 12:49:01', NULL, 0),
	('bpaxv85j', 'Barakat', '2022-08-14 19:38:48', '2022-08-14 19:38:48', NULL, 0),
	('cem4fwf', 'Groceries', '2022-09-02 21:30:28', '2022-09-02 21:30:28', NULL, 0),
	('d02atnw4', 'Bakr to do list', '2022-08-14 17:53:57', '2022-08-14 17:53:57', NULL, 0),
	('ff2jix1w', 'test', '2022-12-18 02:21:20', '2022-12-18 02:21:20', NULL, 0),
	('geqzvj', 'ok', '2022-10-17 13:51:36', '2022-10-17 13:51:36', NULL, 0),
	('jrk5sdx', 'test', '2023-05-22 23:33:01', '2023-05-22 23:33:01', NULL, 0),
	('ktrxeuq3', '23132', '2022-10-07 11:58:11', '2022-10-07 11:58:11', NULL, 0),
	('ku3n9b', 'Digital', '2023-04-02 17:56:38', '2023-04-02 17:56:38', NULL, 0),
	('lmomwo22', 'bongo', '2023-01-30 20:38:08', '2023-01-30 20:38:08', NULL, 0),
	('lssk613', 'khoja', '2022-08-14 17:34:36', '2022-08-14 17:34:36', NULL, 0),
	('m5nswsj', 'Saving up for', '2023-05-27 20:22:08', '2023-05-27 20:22:08', NULL, 0),
	('n68jns', 'Salmeen Binmahfooz', '2022-08-14 00:19:10', '2022-08-14 00:19:10', NULL, 0),
	('nxmtb6', 'testing shit please thanks', '2023-01-03 18:59:10', '2023-01-03 18:59:10', NULL, 0),
	('qx8w5vw', 'Groceries', '2022-08-14 22:54:16', '2022-08-14 22:54:16', NULL, 0),
	('qxlo3tv', 'C', '2022-12-17 23:14:06', '2022-12-17 23:14:06', NULL, 0),
	('r0e6r4dt', 'Salmeen Binmahfooz', '2022-08-14 00:15:47', '2022-08-14 00:15:47', NULL, 0),
	('rnvk291f', 'Test', '2022-09-26 01:38:13', '2022-09-26 01:38:13', NULL, 0),
	('sdehres', 'Projects', '2022-10-04 20:29:43', '2022-10-04 20:29:43', NULL, 0),
	('srmi7fo2', 'Aelin', '2022-09-14 17:38:12', '2022-09-14 17:38:12', NULL, 0),
	('ulallhn5', 'test', '2023-03-05 02:17:25', '2023-03-05 02:17:25', NULL, 0),
	('vb0ixbcw', 'Aelin', '2022-09-14 17:37:44', '2022-09-14 17:37:44', NULL, 0),
	('wzkarch', 'MyList', '2022-08-14 01:15:11', '2022-08-14 01:15:11', NULL, 0),
	('xere02', 'Car upgrades/changes', '2022-09-02 17:53:19', '2022-09-02 17:53:19', NULL, 0),
	('xyg1511j', 'To do', '2022-08-14 02:17:07', '2022-08-14 02:17:07', NULL, 0),
	('yjhclmuv', 'Travel list', '2022-09-26 01:17:27', '2022-09-26 01:17:27', NULL, 0),
	('yml049y', 'a', '2022-10-12 18:16:43', '2022-10-12 18:16:43', NULL, 0),
	('z1x1uhnb', 'PC Upgrades', '2022-09-01 11:28:17', '2022-09-01 11:28:17', NULL, 0),
	('z37oq236', 'Todo.rocks rewrite', '2023-05-28 21:44:57', '2023-05-28 21:44:57', NULL, 0);

-- Dumping structure for table todo-rocks-migrate.list_items
CREATE TABLE IF NOT EXISTS `list_items` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `listID` varchar(10) NOT NULL,
  `item` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `checked` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`itemID`),
  KEY `FK_list_items_lists` (`listID`),
  CONSTRAINT `FK_list_items_lists` FOREIGN KEY (`listID`) REFERENCES `lists` (`listID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table todo-rocks-migrate.list_items: ~57 rows (approximately)
INSERT INTO `list_items` (`itemID`, `listID`, `item`, `description`, `dueDate`, `checked`) VALUES
	(32, '2kp0b0p', 'CIFcnKo8bQA=::0c6fce1eb1ef89df94efd1b2f4a6f202', 'd0tkgx9QMsD7::8883567ad6fdcaeb7c54aab6ca13067c', '2022-08-14', 1),
	(33, 'r0e6r4dt', 'Fz5s/ILEsiyX::a1c294f4fc915a1c9fdf9824e3f61990', '0f1YLQhZm/kr::bf8bc70a68be28fe166ce3b1083126f7', '2022-08-14', 0),
	(34, 'xyg1511j', '0NNm/2ss::dad91b77259b8615e1ee4ba37b77c06c', 'tO57+cTEbdtLkRI=::bab8c8d50651cf0d0dd1ea8c639ecce5', '2022-08-14', 0),
	(35, 'lssk613', '/eEtnG1An3pdH4chKlJUVw==::9aed70ed7f90751356a155294e6a5462', 'oPe5/fLgUYJBdnCb7/R9R3F8n2jnphtdEzOXHipMK7+J3RJtDtzsy5SfpDla7+ElCuCMcJCAYko=::429f47e5a0733d7e238bb7b849cf5f69', '2022-08-18', 0),
	(36, '66jjqa', 'ITsZD8bUo+TNvg==::ddb8204dd662dc40cc3c3e6e958df436', 'vNc=::039f2ab79dc299e0486849fe4e3740b0', '2022-08-14', 0),
	(37, 'qx8w5vw', 'dnQDWZACOAJW::0d1c01da1c607200ca677716dfbaf456', 'kCflqldzYH0X::e6ff7a5b382b591b02ad6667f6519fe9', '2022-08-15', 0),
	(42, 'z1x1uhnb', 'Q8qJiPptRTWepNs97/B2ei18Yw==::5d9fc3def978a4a2d18a3f0077ee8d47', NULL, NULL, 1),
	(43, 'z1x1uhnb', 'BDrdfd32ifX7Z6UISg==::ebfc9804ba97feb02f3aed9546727111', NULL, NULL, 1),
	(44, 'z1x1uhnb', 'MtYCgLPBjcLRAkrDO/eYBkS6HWhXi6IEfDvEDA==::d2b5de0b4186c4f9158e59f6704b78a9', NULL, NULL, 0),
	(45, 'z1x1uhnb', 'iZTIFXmZvSPwWaLA97vG/bo=::7de2e4c34307a51a5b2f6cc10d295498', NULL, NULL, 0),
	(46, 'z1x1uhnb', 'Ii8vuoyc+LIlcB0vn7n8mw==::a471235ce9b8fc610a56991bf808b830', NULL, NULL, 1),
	(47, 'z1x1uhnb', 'ytlmomUqIaGZcYjJILR0m0ZRY8uTwhLUhE6upifXPphlAudL::d9940cf6097cc393b18902f4d6e31d0d', NULL, NULL, 1),
	(48, 'xere02', 'fZNG2lxW7CsR/XIyTWFahG1YHH0=::238504158675cafd2a24f76612fab1c7', NULL, NULL, 1),
	(49, 'xere02', 'UyCpAutXhQi/4KWy0RRbyj0SQjnbLrBu9/uk5B08I/QjCa7pt94=::d1f2aef5c3c5ae9a4befe4ff6f02268c', NULL, NULL, 1),
	(50, 'xere02', 'eWIFBww0E3YfY2s7rJSLYHrjBQ==::882e2cd616d7f8b0ac6a1e36649212b9', NULL, NULL, 0),
	(52, 'xere02', 'lLGkuR6vL70GCA==::5338d14380fd6c4d6a01917d4a22878b', NULL, NULL, 0),
	(53, 'cem4fwf', 't4N6sb/W858=::28dcc41e7fc792bdbe0ba90443d5cad7', NULL, '2022-09-14', 0),
	(54, '2coydjat', 'ppfvV9E09B3sLB0P::f7847bdde10651205210e9a3d3120f9f', NULL, '2022-09-11', 0),
	(56, '8eb0wx', 'JiW2zNXcZmM8WZRue7AEZkFRypDkyQ==::01e55728ca8aea45b4a76a1907973026', NULL, NULL, 0),
	(57, '8eb0wx', 'PMNg0lPzxxI/Gislt4Cre9OlCdXW+DFGAK9FvWvNd7AyDoFC::9ae370c1975c106358f2ff18af011f16', NULL, NULL, 0),
	(58, '8eb0wx', 'YHj9KMEpMH+edaioro6pMiW50g==::472fc7fb15e8e02351540e36a79828d0', NULL, NULL, 0),
	(60, 'srmi7fo2', '7xcG5kjkn631::a74ef1a19244c15791dcddaab87cd660', 'Mq8bpTZr::28c042f42731f651201dea7683f80d9b', '2022-09-23', 0),
	(61, 'yjhclmuv', '+0Gk7A==::2514b59108c20734d40e08bbe28a7271', NULL, NULL, 0),
	(62, 'sdehres', 'Ug/kAnt0kTIaODheVA==::c8dc1a7a03b52ddfdec88ce3c6a2af7b', NULL, NULL, 0),
	(63, 'sdehres', 'apKqNwJSG+f/wpZnDQc=::db8cf26fe0cd302817c537ae478124aa', NULL, NULL, 0),
	(64, 'sdehres', 'f4AXJYJdzRSpcT3FBrIzzw==::be2cc05c19468e7704d639fdfda4f926', NULL, NULL, 0),
	(66, 'sdehres', 'M7P4gOuke9Y+A0XzJwT8Ksxx7g3W+w==::68591fc2b23e79c1d4c51e26afa26ce9', NULL, NULL, 0),
	(67, 'sdehres', 'lqg4p9lcbWzCQQ==::6de2813751c89f0046f734683d88543a', NULL, NULL, 0),
	(68, 'ktrxeuq3', 'XfsjhnC6::b2508c9bfb1353cefdbe30fe546015ae', 'C/cqUYAY::7cd09f567ca916eba4569815a79a8015', '2022-10-07', 0),
	(69, 'xere02', 'sDdptUzq::0fe9e201b5aaef0931e8f6ef7f6dd1a1', NULL, NULL, 1),
	(70, 'xere02', 'ECd1IZhZww==::f247322dacabb80dfceffd7dd0af7dee', NULL, NULL, 1),
	(72, 'sdehres', 'fVnDM9oI53ErumSCEkK3kbjlF+UyOOjpGw==::ba47144792cc2d5abc56409f440d872c', NULL, NULL, 0),
	(73, '23mzm37', 'Q9iPiAs=::9212db5843f13454918ca8d45db0f108', 'A0o=::206c4495112e1685cdd7f110ded4764e', NULL, 0),
	(74, 'xere02', 'f1oIojM1oZw=::38206fb8c203281b72c307b1390730a9', NULL, NULL, 0),
	(75, 'xere02', 'Huw5nuNFl/+f::0d97e541612536a8b6952e0b91446603', NULL, NULL, 0),
	(76, 'xere02', 'W7RYHMsP/SWnqKwLbg==::634e4d587301922d7fdb391169f387e0', NULL, NULL, 0),
	(77, 'xere02', 'IuLxBeqqfHWz::500b8ca18a3e97edc75e43ef5d6f6ec1', NULL, NULL, 0),
	(78, 'xere02', '+Nfcyg==::86ef9a64a47bb3207f48b09e0dee3f9b', NULL, NULL, 0),
	(79, 'xere02', 'I6+j5oyTWA==::2562073c140a6284ae1c730383e9ea0f', NULL, NULL, 0),
	(81, 'm5nswsj', 'vZgYrbdjr0PSsxE4olc=::38fc12be2fbb00614e05c174afee4fcd', 'o6vCicY3pg==::42b61b02e4e6c947045897bbc5b74d2f', '2023-09-30', 0),
	(82, 'm5nswsj', 'HM/NVrc1XglT/JS274Y=::c1136b3050ee780145edfc0214e8dc5e', 'cyPXzIuRsQ==::27e958dd0fadc8d710dfaaf215f898a0', '2024-02-27', 0),
	(84, 'z37oq236', '/6A+a8SUjHxctT827Co=::91ccb964eb49ea1b15728e0272898255', NULL, NULL, 1),
	(85, 'z37oq236', 'jBT2RdxHwoy4BktzvuJ4oZs/5TzbKWY=::c9cfa0f9fd374d189565b59f112ff0dd', NULL, NULL, 1),
	(86, 'z37oq236', 'UgcR21YOqGfHeRxSpiZaBHS5FF4=::c842cc25874b8eead52d78ffc5352890', NULL, NULL, 1),
	(87, 'z37oq236', '5qwt/F/NQycLDhlNc/KRzXXrAII=::8d5cbc81236c8f40cd5ca337b232c1d5', NULL, NULL, 1),
	(88, 'z37oq236', 'KTB/dX2hM3KDF2cSP3TOJqZHXRoN629oJIZjq1CuLVsTIYb080SO::0ed9f2542bc458bf312bcb523ecbcb58', NULL, NULL, 1),
	(90, 'z37oq236', 'Uh0y7Lx7q/xyjnMBnWvUW6tdDElbQJCmihSz1Okp::0846f487552a89a418c24449f5235d7f', NULL, NULL, 1),
	(91, 'z37oq236', '0exioEA/lPiCozNwWZy5PkUf8CGKwyrLaFg7UtIYwmrgj59NKw==::c54d014a2292a0952a75009e62c7d09e', NULL, NULL, 1),
	(92, 'z37oq236', '6fVUEn4ok+WZTblpowq8/olmsu93poJw64kkw7cBV9MG+eI=::36f8328191ca6c51682f58c4ab2a2ab4', NULL, NULL, 1),
	(93, 'z37oq236', 'vjmQ6mcIZSIUhu+WtCLb::8bf30cf1d780474df816334362fdc75f', NULL, NULL, 0),
	(94, 'z37oq236', 'Mk6ssbaMxCPRTXPjmm7E::56959da9c00296faf300e54552c28fa3', NULL, NULL, 1),
	(95, 'z37oq236', 'hAtiSMB8g8Pq1ut6qhnV3q0=::d09230e45121484aef3e4b8b0fe8a081', 'RuFiXZC9nQC4VfCAfk3rSv2bQOFEGsHHwzHBEN/EDoWVPFw4GVzJwE/RaSUgU5ZrUBq6CHYpdlAC9YsXOkfoT7zc8w==::8bd0130195c5cbc0a083acf1c3ebfe84', NULL, 1),
	(96, 'z37oq236', 'r4Bzq9fQEa/iioJ2T3943owvFA==::bd3fe49615cdbc36a253ef86ccb41cf4', NULL, NULL, 0),
	(97, 'z37oq236', '4W50j0WPEWycWjMYYFliIbeo::d83a58f65efcbe1842b3068eb901adb9', NULL, NULL, 1),
	(98, 'z37oq236', 'MACdj+bjFRMn5nnHkjwxcO1a4/hGG07NTxc=::3767d6792bdfcfbf85a8f289a0a5ee08', NULL, NULL, 0),
	(99, 'z37oq236', 'Xn8mLAoxiOQ+qURqRxhtoNQZ4vyLEGJaYO2TFPgpC3JYvQ==::020963d94e86bbc9390d87c6b270f114', NULL, NULL, 1);

-- Dumping structure for trigger todo-rocks-migrate.update_list_update_time_on_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER update_list_update_time_on_delete
	AFTER DELETE ON list_items FOR EACH ROW
		UPDATE lists SET updatedOn=NOW() WHERE listID=OLD.listID//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger todo-rocks-migrate.update_list_update_time_on_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER update_list_update_time_on_insert
	AFTER INSERT ON list_items FOR EACH ROW
	
		UPDATE lists SET updatedOn=NOW() WHERE listID=NEW.listID//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger todo-rocks-migrate.update_list_update_time_on_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER update_list_update_time_on_update
	AFTER UPDATE ON list_items FOR EACH ROW
		UPDATE lists SET updatedOn=NOW() WHERE listID=NEW.listID//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
