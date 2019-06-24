-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 03 mei 2019 om 15:44
-- Serverversie: 10.1.38-MariaDB
-- PHP-versie: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testphp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `adressen`
--

CREATE TABLE `adressen` (
  `adresId` int(11) NOT NULL,
  `straat` varchar(30) NOT NULL,
  `huisnr` int(11) NOT NULL,
  `bus` text NOT NULL,
  `gemeenteId` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `adressen`
--

INSERT INTO `adressen` (`adresId`, `straat`, `huisnr`, `bus`, `gemeenteId`) VALUES
(1, 'teststraat', 5, '', '2'),
(2, 'straat', 5, '', '2'),
(3, 'straat', 5, '', '2'),
(14, 'azazaz', 50, '', '2'),
(15, 'azazaz', 50, '', '2'),
(16, 'azazaz', 50, '', '2'),
(17, 'azazaz', 50, '', '2'),
(18, 'azazaz', 50, '', '2'),
(19, 'azazaz', 50, '', '2'),
(20, 'straatnaam', 5, '', '2'),
(21, 'straatnaam', 5, '', '2'),
(22, 'straatnaam', 5, '', '2'),
(23, 'hkhjkhjkh', 5, '', '2'),
(24, 'teststraat', 5, '', '7'),
(25, 'teststraat', 5, '', '7'),
(26, 'teststraat', 5, '', '7'),
(27, 'teststraat', 5, '', '7'),
(28, 'straat2', 2, 'abcde', '29'),
(29, 'terzerzerz', 2, 'abcde', '29'),
(30, 'terzerzerz', 2, 'abcde', '29'),
(31, 'terzerzerz', 2, 'abcde', '29'),
(32, 'terzerzerz', 2, 'abcde', '29'),
(33, 'terzerzerz', 2, 'abcde', '29'),
(34, 'terzerzerz', 2, 'abcde', '29'),
(35, 'straat', 5, 'a', '29'),
(36, 'straat', 5, 'a', '29'),
(37, 'stratstraat', 55, 'abcdefgh', '6'),
(38, 'stratstraat', 55, 'abcdefgh', '6'),
(39, 'stratstraat', 55, 'abcdefgh', '6'),
(40, 'straaaaat', 1, 'a', '2'),
(41, 'straaaaat', 1, 'a', '2'),
(42, 'teststraat', 5, '', '2'),
(43, 'teststraat', 5, '', '2'),
(44, 'str', 4, 'a', '2'),
(45, 'straat', 147, '', '5'),
(46, 'straat', 147, '', '5'),
(47, 'straat', 0, '3', '29'),
(48, 're', 0, 'c', '2'),
(49, 're', 0, 'c', '2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellijnen`
--

CREATE TABLE `bestellijnen` (
  `bestellijnId` int(11) NOT NULL,
  `bestelId` int(11) NOT NULL,
  `pizzaId` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `lijnTotaal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestellijnen`
--

INSERT INTO `bestellijnen` (`bestellijnId`, `bestelId`, `pizzaId`, `aantal`, `lijnTotaal`) VALUES
(97, 23, 5, 1, '12.50'),
(98, 24, 2, 2, '18.00'),
(99, 24, 3, 1, '8.50'),
(100, 25, 5, 3, '37.50'),
(101, 26, 1, 4, '37.00'),
(102, 26, 7, 1, '13.56'),
(103, 26, 4, 1, '10.00'),
(105, 27, 1, 1, '9.25');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `totaalPrijs` decimal(5,2) NOT NULL,
  `orderTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sessionKey` varchar(100) DEFAULT NULL,
  `isClosed` tinyint(4) DEFAULT '0',
  `isDelivered` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`bestelId`, `userId`, `totaalPrijs`, `orderTime`, `sessionKey`, `isClosed`, `isDelivered`) VALUES
(23, 43, '12.50', '2019-05-03 10:03:15', NULL, 1, 1),
(24, 41, '26.50', '2019-05-03 10:26:12', NULL, 1, 0),
(25, 43, '37.50', '2019-05-03 10:47:46', NULL, 1, 1),
(26, 44, '60.56', '2019-05-03 11:00:28', NULL, 1, 0),
(27, NULL, '9.25', '2019-05-03 12:48:54', '8f08analh5ka46b99aro0ha0ha', 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gemeentes`
--

CREATE TABLE `gemeentes` (
  `gemeenteId` int(11) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `postcode` int(11) NOT NULL,
  `leveringMogelijk` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gemeentes`
--

INSERT INTO `gemeentes` (`gemeenteId`, `naam`, `postcode`, `leveringMogelijk`) VALUES
(2, 'Brugge', 8000, 1),
(5, 'Waardamme', 8020, 1),
(6, 'Oostkamp', 8020, 0),
(7, 'Sint-michiels', 8200, 0),
(8, 'Sint-andries', 8200, 0),
(9, 'Veldegem_new', 8210, 1),
(10, 'Zedelgem', 8210, 0),
(11, 'Loppem', 8210, 0),
(12, 'Aartrijke', 8211, 0),
(13, 'Westkapelle', 8300, 0),
(14, 'Knokke', 8300, 0),
(15, 'Knokke-Heist', 8300, 0),
(16, 'Ramskapelle', 8301, 0),
(17, 'Heist-aan-zee', 8301, 0),
(18, 'Sint-kruis', 8310, 0),
(19, 'Assebroek', 8310, 0),
(20, 'Damme', 8340, 0),
(21, 'Moerkerke', 8340, 0),
(23, 'Oostkerke', 8340, 0),
(24, 'Sijsele', 8340, 0),
(25, 'Lapscheure', 8340, 0),
(26, 'Blankenberge', 8370, 0),
(27, 'Uitkerke', 8370, 0),
(28, 'Meetkerke', 8377, 0),
(29, 'Zuienkerke', 8377, 1),
(30, 'Houtave', 8377, 0),
(31, 'Nieuwmunster', 8377, 0),
(32, 'Dudzele', 8380, 0),
(33, 'Zeebrugge', 8380, 0),
(34, 'Lissewege', 8380, 0),
(35, 'Oostende', 8400, 0),
(36, 'Stene', 8400, 0),
(37, 'Zandvoorde', 8400, 0),
(38, 'Klemskerke', 8420, 0),
(39, 'De haan', 8420, 0),
(40, 'Wenduine', 8420, 0),
(41, 'Vlissegem', 8421, 0),
(42, 'Middelkerke', 8430, 0),
(43, 'Wilskerke', 8431, 0),
(44, 'Leffinge', 8432, 0),
(45, 'Mannekensvere', 8433, 0),
(46, 'Schore', 8433, 0),
(47, 'Sint-Pieters-Kapelle', 8433, 0),
(48, 'Slijpe', 8433, 0),
(49, 'Westende', 8434, 0),
(50, 'Lombardsijde', 8434, 0),
(51, 'Bredene', 8450, 0),
(52, 'Westkerke', 8460, 0),
(53, 'Oudenburg', 8460, 0),
(54, 'Ettelgem', 8460, 0),
(55, 'Roksem', 8460, 0),
(56, 'Snaaskerke', 8470, 0),
(57, 'Gistel', 8470, 0),
(58, 'Zevekote', 8470, 0),
(59, 'Moere', 8470, 0),
(60, 'Eernegem', 8480, 0),
(61, 'Bekegem', 8480, 0),
(62, 'Ichtegem', 8480, 0),
(63, 'Zerkegem', 8490, 0),
(64, 'Snellegem', 8490, 0),
(65, 'Varsenare', 8490, 0),
(66, 'Stalhille', 8490, 0),
(67, 'Jabbeke', 8490, 0),
(68, 'Kortrijk', 8500, 0),
(69, 'Bissegem', 8501, 0),
(70, 'Heule', 8501, 0),
(71, 'Marke', 8510, 0),
(72, 'Bellegem', 8510, 0),
(73, 'Kooigem', 8510, 0),
(74, 'Rollegem', 8510, 0),
(75, 'Aalbeke', 8511, 0),
(76, 'Kuurne', 8520, 0),
(77, 'Harelbeke', 8530, 0),
(78, 'Bavikhove', 8531, 0),
(79, 'Hulste', 8531, 0),
(80, 'Deerlijk', 8540, 0),
(81, 'Zwevegem', 8550, 0),
(82, 'Heestert', 8551, 0),
(83, 'Moen', 8552, 0),
(84, 'Otegem', 8553, 0),
(85, 'Sint-denijs', 8554, 0),
(86, 'Moorsele', 8560, 0),
(87, 'Gullegem', 8560, 0),
(88, 'Wevelgem', 8560, 0),
(89, 'Ingooigem', 8570, 0),
(90, 'Gijzelbrechtegem', 8570, 0),
(91, 'Vichte', 8570, 0),
(92, 'Anzegem', 8570, 0),
(93, 'Kaster', 8572, 0),
(94, 'Tiegem', 8573, 0),
(95, 'Avelgem', 8580, 0),
(96, 'Waarmaarde', 8581, 0),
(97, 'Kerkhove', 8581, 0),
(98, 'Outrijve', 8582, 0),
(99, 'Bossuit', 8583, 0),
(100, 'Spiere', 8587, 0),
(101, 'Spiere-Helkijn', 8587, 0),
(102, 'Helkijn', 8587, 0),
(104, 'Sint-jacobs-kapelle', 8600, 0),
(105, 'Beerst', 8600, 0),
(106, 'Leke', 8600, 0),
(107, 'Oudekapelle', 8600, 0),
(108, 'Woumen', 8600, 0),
(109, 'Nieuwkapelle', 8600, 0),
(110, 'Lampernisse', 8600, 0),
(111, 'Kaaskerke', 8600, 0),
(112, 'Pervijze', 8600, 0),
(113, 'Diksmuide', 8600, 0),
(114, 'Esen', 8600, 0),
(115, 'Oostkerke', 8600, 0),
(116, 'Vladslo', 8600, 0),
(117, 'Stuivekenskerke', 8600, 0),
(118, 'Driekapellen', 8600, 0),
(119, 'Kortemark', 8610, 0),
(120, 'Handzame', 8610, 0),
(121, 'Werken', 8610, 0),
(122, 'Zarren', 8610, 0),
(123, 'Sint-joris', 8620, 0),
(124, 'Ramskapelle', 8620, 0),
(125, 'Nieuwpoort', 8620, 0),
(126, 'Vinkem', 8630, 0),
(127, 'Wulveringem', 8630, 0),
(128, 'Houtem', 8630, 0),
(129, 'Eggewaartskapelle', 8630, 0),
(130, 'Booitshoeke', 8630, 0),
(131, 'Veurne', 8630, 0),
(132, 'Steenkerke', 8630, 0),
(133, 'Zoutenaaie', 8630, 0),
(134, 'De Moeren', 8630, 0),
(135, 'Bulskamp', 8630, 0),
(136, 'Avekapelle', 8630, 0),
(137, 'Oostvleteren', 8640, 0),
(138, 'Vleteren', 8640, 0),
(139, 'Westvleteren', 8640, 0),
(140, 'Woesten', 8640, 0),
(141, 'Reninge', 8647, 0),
(142, 'Lo', 8647, 0),
(143, 'Noordschote', 8647, 0),
(144, 'Lo-Reninge', 8647, 0),
(145, 'Pollinkhove', 8647, 0),
(146, 'Klerken', 8650, 0),
(147, 'Merkem', 8650, 0),
(148, 'Houthulst', 8650, 0),
(149, 'De panne', 8660, 0),
(150, 'Adinkerke', 8660, 0),
(151, 'Oostduinkerke', 8670, 0),
(152, 'Wulpen', 8670, 0),
(153, 'Koksijde', 8670, 0),
(154, 'Bovekerke', 8680, 0),
(155, 'Koekelare', 8680, 0),
(156, 'Zande', 8680, 0),
(157, 'Oeren', 8690, 0),
(158, 'Alveringem', 8690, 0),
(159, 'Hoogstade', 8690, 0),
(160, 'Sint-Rijkers', 8690, 0),
(161, 'Gijverinkhove', 8691, 0),
(162, 'Leisele', 8691, 0),
(163, 'Stavele', 8691, 0),
(164, 'Beveren-aan-de-ijzer', 8691, 0),
(165, 'Izenberge', 8691, 0),
(166, 'Aarsele', 8700, 0),
(167, 'Schuiferskapelle', 8700, 0),
(168, 'Kanegem', 8700, 0),
(169, 'Tielt', 8700, 0),
(170, 'Ooigem', 8710, 0),
(171, 'Sint-Baafs-Vijve', 8710, 0),
(172, 'Wielsbeke', 8710, 0),
(173, 'Oeselgem', 8720, 0),
(174, 'Wakken', 8720, 0),
(175, 'Markegem', 8720, 0),
(176, 'Dentergem', 8720, 0),
(177, 'Oedelem', 8730, 0),
(178, 'Beernem', 8730, 0),
(179, 'Sint-Joris', 8730, 0),
(180, 'Egem', 8740, 0),
(181, 'Pittem', 8740, 0),
(182, 'Wingene', 8750, 0),
(183, 'Zwevezele', 8750, 0),
(184, 'Ruiselede', 8755, 0),
(185, 'Meulebeke', 8760, 0),
(186, 'Ingelmunster', 8770, 0),
(187, 'Oostrozebeke', 8780, 0),
(188, 'Waregem', 8790, 0),
(189, 'Beveren', 8791, 0),
(190, 'Desselgem', 8792, 0),
(191, 'Sint-Eloois-Vijve', 8793, 0),
(192, 'Rumbeke', 8800, 0),
(193, 'Beveren', 8800, 0),
(194, 'Roeselare', 8800, 0),
(195, 'Oekene', 8800, 0),
(196, 'Lichtervelde', 8810, 0),
(197, 'Torhout', 8820, 0),
(198, 'Gits', 8830, 0),
(199, 'Hooglede', 8830, 0),
(200, 'Staden', 8840, 0),
(201, 'Westrozebeke', 8840, 0),
(202, 'Oostnieuwkerke', 8840, 0),
(203, 'Ardooie', 8850, 0),
(204, 'Koolskamp', 8851, 0),
(205, 'Lendelede', 8860, 0),
(206, 'Izegem', 8870, 0),
(207, 'Emelgem', 8870, 0),
(208, 'Kachtem', 8870, 1),
(209, 'Ledegem', 8880, 0),
(210, 'Rollegem-kapelle', 8880, 0),
(211, 'Sint-eloois-winkel', 8880, 0),
(212, 'Dadizele', 8890, 0),
(213, 'Moorslede', 8890, 0),
(214, 'Ieper', 8900, 0),
(215, 'Sint-jan', 8900, 0),
(216, 'Dikkebus', 8900, 0),
(217, 'Brielen', 8900, 0),
(218, 'Voormezele', 8902, 0),
(219, 'Hollebeke', 8902, 0),
(220, 'Zillebeke', 8902, 0),
(221, 'Boezinge', 8904, 0),
(222, 'Zuidschote', 8904, 0),
(223, 'Elverdinge', 8906, 0),
(224, 'Vlamertinge', 8908, 0),
(225, 'Bikschote', 8920, 0),
(226, 'Langemark', 8920, 0),
(227, 'Langemark-Poelkapelle', 8920, 0),
(228, 'Poelkapelle', 8920, 0),
(229, 'Rekkem', 8930, 0),
(230, 'Menen', 8930, 0),
(231, 'Lauwe', 8930, 0),
(232, 'Geluwe', 8940, 0),
(233, 'Wervik', 8940, 0),
(234, 'Heuvelland', 8950, 0),
(235, 'Nieuwkerke', 8950, 0),
(236, 'Dranouter', 8951, 0),
(237, 'Wulvergem', 8952, 0),
(238, 'Wijtschate', 8953, 0),
(239, 'Westouter', 8954, 0),
(240, 'Kemmel', 8956, 0),
(241, 'Mesen', 8957, 0),
(242, 'Loker', 8958, 0),
(243, 'Poperinge', 8970, 0),
(244, 'Reningelst', 8970, 0),
(245, 'Proven', 8972, 0),
(246, 'Krombeke', 8972, 0),
(247, 'Roesbrugge-haringe', 8972, 0),
(248, 'Watou', 8978, 0),
(249, 'Zandvoorde', 8980, 0),
(250, 'Zonnebeke', 8980, 0),
(251, 'Beselare', 8980, 0),
(252, 'Passendale', 8980, 0),
(253, 'Geluveld', 8980, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ingredienten`
--

CREATE TABLE `ingredienten` (
  `ingredientId` int(11) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `omschr` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ingredienten`
--

INSERT INTO `ingredienten` (`ingredientId`, `naam`, `omschr`) VALUES
(1, 'dunne bodem', NULL),
(2, 'tomatensaus', NULL),
(3, 'paprika', NULL),
(4, 'tomatenschijfjes', NULL),
(5, 'paprika', NULL),
(6, 'kerstomaat', NULL),
(7, 'ui', NULL),
(8, 'ham', NULL),
(9, 'mozzarella', NULL),
(10, 'gruyère', NULL),
(11, 'blauwe schimmelkaas', NULL),
(12, 'pikante saus', NULL),
(13, 'ananas', NULL),
(14, 'champignon', NULL),
(15, 'oesterzwam', NULL),
(16, 'kip', NULL),
(17, 'dikke bodem', NULL),
(18, 'aardappel', NULL),
(19, 'Chorizo', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pizzaingredienten`
--

CREATE TABLE `pizzaingredienten` (
  `pizzaIngredientId` int(11) NOT NULL,
  `pizzaId` int(11) NOT NULL,
  `ingredientId` int(11) NOT NULL,
  `aantal` decimal(3,0) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `pizzaingredienten`
--

INSERT INTO `pizzaingredienten` (`pizzaIngredientId`, `pizzaId`, `ingredientId`, `aantal`) VALUES
(31, 2, 1, '1'),
(32, 2, 3, '1'),
(33, 2, 2, '1'),
(34, 2, 8, '1'),
(35, 2, 13, '1'),
(36, 2, 7, '1'),
(37, 3, 1, '1'),
(38, 3, 2, '1'),
(39, 3, 10, '1'),
(40, 3, 6, '1'),
(104, 5, 13, '1'),
(105, 5, 11, '1'),
(106, 5, 14, '1'),
(107, 5, 1, '1'),
(108, 5, 10, '1'),
(109, 5, 6, '1'),
(110, 5, 9, '1'),
(111, 5, 15, '1'),
(112, 5, 3, '1'),
(113, 5, 4, '1'),
(114, 5, 7, '1'),
(115, 4, 1, '1'),
(116, 4, 3, '1'),
(117, 4, 2, '1'),
(118, 4, 14, '1'),
(119, 4, 6, '1'),
(120, 4, 7, '1'),
(121, 1, 1, '1'),
(122, 1, 2, '1'),
(123, 1, 11, '1'),
(124, 1, 9, '1'),
(125, 1, 10, '1'),
(133, 7, 1, '1'),
(134, 7, 10, '1'),
(135, 7, 8, '1'),
(136, 7, 16, '1'),
(137, 7, 12, '1'),
(138, 7, 2, '1'),
(139, 7, 7, '1'),
(140, 7, 19, '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pizzas`
--

CREATE TABLE `pizzas` (
  `pizzaId` int(11) NOT NULL,
  `naam` varchar(40) NOT NULL,
  `omschr` varchar(200) NOT NULL,
  `prijs` decimal(10,2) DEFAULT NULL,
  `promoprijs` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `pizzas`
--

INSERT INTO `pizzas` (`pizzaId`, `naam`, `omschr`, `prijs`, `promoprijs`) VALUES
(1, 'Pizza Quattro Formaggio', 'vier kazen', '9.25', '9.25'),
(2, 'Pizza Hawaii', 'ananas', '9.00', NULL),
(3, 'Pizza Margarita', 'kaas+tomaat', '8.50', NULL),
(4, 'Pizza Vegetarisch', 'Pizza zonder vlees', '10.00', '10.00'),
(5, 'Pizza Deluxe', 'Tomaat,4 kazen,ansjovis,olijven,paprika, champignon en kappertjes en look', '12.50', '10.50'),
(7, 'Pizza Meat', 'Pizza met vlees', '13.56', '13.56');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `voornaam` varchar(20) NOT NULL,
  `adresId` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `superuser` tinyint(4) NOT NULL DEFAULT '0',
  `isTijdelijkeUser` tinyint(4) NOT NULL DEFAULT '0',
  `paswoord` varchar(40) DEFAULT NULL,
  `telefoon` varchar(15) DEFAULT NULL,
  `korting` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userId`, `naam`, `voornaam`, `adresId`, `email`, `superuser`, `isTijdelijkeUser`, `paswoord`, `telefoon`, `korting`) VALUES
(2, 'istrator', 'admin', 1, 'admin@admin.be', 1, 0, 'ede38c19e862585744024ef14700bfa7', NULL, 0),
(42, 'blab', 'bla', 46, NULL, 0, 1, NULL, NULL, 0),
(43, 'testuser2', 'testuservoornaam', 47, 'testuser2@test.be', 0, 0, 'e148628bd40430bb01c4200af5529d8c', '1324', 0),
(44, 'test', 'testuservoornaam', 48, NULL, 0, 1, NULL, NULL, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `adressen`
--
ALTER TABLE `adressen`
  ADD PRIMARY KEY (`adresId`);

--
-- Indexen voor tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  ADD PRIMARY KEY (`bestellijnId`);

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelId`);

--
-- Indexen voor tabel `gemeentes`
--
ALTER TABLE `gemeentes`
  ADD PRIMARY KEY (`gemeenteId`);

--
-- Indexen voor tabel `ingredienten`
--
ALTER TABLE `ingredienten`
  ADD PRIMARY KEY (`ingredientId`);

--
-- Indexen voor tabel `pizzaingredienten`
--
ALTER TABLE `pizzaingredienten`
  ADD PRIMARY KEY (`pizzaIngredientId`);

--
-- Indexen voor tabel `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`pizzaId`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `adressen`
--
ALTER TABLE `adressen`
  MODIFY `adresId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT voor een tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  MODIFY `bestellijnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `gemeentes`
--
ALTER TABLE `gemeentes`
  MODIFY `gemeenteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT voor een tabel `ingredienten`
--
ALTER TABLE `ingredienten`
  MODIFY `ingredientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT voor een tabel `pizzaingredienten`
--
ALTER TABLE `pizzaingredienten`
  MODIFY `pizzaIngredientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT voor een tabel `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `pizzaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
