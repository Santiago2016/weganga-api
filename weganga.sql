-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2016 at 04:06 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weganga`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `client_interest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `description`, `provider_id`, `client_interest_id`) VALUES
(1, 'Pullovers', 'Pullovers for any class of men', NULL, NULL),
(3, 'Shoes', 'Good shoes for men and women', NULL, NULL),
(4, 'moda', 'articulos de moda fashion', NULL, NULL),
(5, 'categoria nueva', 'todos los productos nuevos', NULL, NULL),
(6, 'chancletas', 'todas las chancletas mas algo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categorys_offers`
--

CREATE TABLE `categorys_offers` (
  `categorys_id` int(11) NOT NULL,
  `offers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorys_offers`
--

INSERT INTO `categorys_offers` (`categorys_id`, `offers_id`) VALUES
(1, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `clients_offers`
--

CREATE TABLE `clients_offers` (
  `clients_id` int(11) NOT NULL,
  `offers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients_offers`
--

INSERT INTO `clients_offers` (`clients_id`, `offers_id`) VALUES
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `impuestos`
--

CREATE TABLE `impuestos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `tasaimpuesto` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `impuestos`
--

INSERT INTO `impuestos` (`id`, `name`, `description`, `tasaimpuesto`) VALUES
(1, 'impuesto 1', 'descripcion impuesto 1 mas algo', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `descuento` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantrequest` bigint(20) NOT NULL,
  `conditions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moreinfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `enddate` datetime NOT NULL,
  `cost` double NOT NULL,
  `rebaja1` double NOT NULL,
  `rebaja2` double NOT NULL,
  `rebaja3` double NOT NULL,
  `rebaja4` double NOT NULL,
  `rebaja5` double NOT NULL,
  `rebaja6` double NOT NULL,
  `rebaja7` double NOT NULL,
  `rebaja8` double NOT NULL,
  `rebaja9` double NOT NULL,
  `rebaja10` double NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `place`, `date`, `descuento`, `description`, `cantrequest`, `conditions`, `moreinfo`, `provider_id`, `enddate`, `cost`, `rebaja1`, `rebaja2`, `rebaja3`, `rebaja4`, `rebaja5`, `rebaja6`, `rebaja7`, `rebaja8`, `rebaja9`, `rebaja10`, `estado`) VALUES
(2, 'reloj', 'Santiago de Cuba', '2016-12-05 20:37:11', 0, 'relojes de marca', 0, 'tiene que comprar 20', 'la que me de la gana', 4, '2017-02-23 20:37:11', 57, 56, 54, 51, 48, 44, 40, 35, 30, 25, 20, 'APROBADA'),
(3, 'tablet', 'La Habana', '2016-12-05 21:13:02', 0, 'una tablet blanca marca samsung', 0, 'pagar por adelantado', 'toda la que quieras', 4, '2017-02-23 21:13:02', 89, 88, 87, 85, 82, 78, 72, 67, 61, 54, 47, 'PENDIENTE'),
(4, 'camisa', 'Madrid', '2016-12-05 21:17:26', 0, 'una camisa elegante', 0, 'buenasa', 'cualquiera', 4, '2017-02-23 21:17:26', 56, 55, 53, 50, 47, 43, 39, 35, 31, 27, 23, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desciption` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `desciption`) VALUES
(1, 'regla promocion 1', 'descripcion de la regla de promocion 1 mas algo');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `quantity`, `offer_id`, `date`, `client_id`) VALUES
(2, 1, 3, '2009-12-06 01:28:07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `delivery` tinyint(1) NOT NULL,
  `quantity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopcars`
--

CREATE TABLE `shopcars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shopcars`
--

INSERT INTO `shopcars` (`id`, `name`, `description`) VALUES
(1, 'regla carrito 1', 'descripcion de la regla de carrito 1 mas algo');

-- --------------------------------------------------------

--
-- Table structure for table `tadministrators`
--

CREATE TABLE `tadministrators` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tadministrators`
--

INSERT INTO `tadministrators` (`id`) VALUES
(5);

-- --------------------------------------------------------

--
-- Table structure for table `tclients`
--

CREATE TABLE `tclients` (
  `id` int(11) NOT NULL,
  `dni` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tclients`
--

INSERT INTO `tclients` (`id`, `dni`) VALUES
(3, 91090247300);

-- --------------------------------------------------------

--
-- Table structure for table `tproviders`
--

CREATE TABLE `tproviders` (
  `id` int(11) NOT NULL,
  `dni` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tproviders`
--

INSERT INTO `tproviders` (`id`, `dni`) VALUES
(4, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `tusers`
--

CREATE TABLE `tusers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigopostal` bigint(20) NOT NULL,
  `discr1` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tusers`
--

INSERT INTO `tusers` (`id`, `username`, `password`, `role`, `nombre`, `apellidos`, `direccion`, `email`, `telefono`, `codigopostal`, `discr1`) VALUES
(3, 'camilo', '9nsKog8dMlM/s0wg2abXMKq1KfreQL95UkXlOXbdRKZ2FRRP9d54WeQjykGC3F5KTboGRaidakerPSkygKgn7w==', 'ROLE_CLIENTE', 'Camilo', 'Berenguer Perez', 'cccasa', 'camiloberenguer@gmail.com', '54539762', 90100, 'tclients'),
(4, 'jesus', 'wqdFKo8fsBA/4R/7Ac7oIlUD+muPfcXx2ePuOwN+t1zl5JrSB9Iidmf1dX61v8Gr32mUnMcWgM8QhTdBgkMqBA==', 'ROLE_VENDEDOR', 'Jesus', 'Roig Peix', 'cccasa hjbasj', 'jesus@gmail.com', '53687818', 90100, 'tproviders'),
(5, 'otro', '9nsKog8dMlM/s0wg2abXMKq1KfreQL95UkXlOXbdRKZ2FRRP9d54WeQjykGC3F5KTboGRaidakerPSkygKgn7w==', 'ROLE_ADMIN', 'Otro', 'Otro Otro', 'cccasa sadasd ', 'otro@gmail.com', '53687818', 90100, 'tadministrators');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_759AF397A53A8AA` (`provider_id`),
  ADD KEY `IDX_759AF3975BDEDAB2` (`client_interest_id`);

--
-- Indexes for table `categorys_offers`
--
ALTER TABLE `categorys_offers`
  ADD PRIMARY KEY (`categorys_id`,`offers_id`),
  ADD KEY `IDX_4A74D4C3A96778EC` (`categorys_id`),
  ADD KEY `IDX_4A74D4C3A090B42E` (`offers_id`);

--
-- Indexes for table `clients_offers`
--
ALTER TABLE `clients_offers`
  ADD PRIMARY KEY (`clients_id`,`offers_id`),
  ADD KEY `IDX_DF91D0C0AB014612` (`clients_id`),
  ADD KEY `IDX_DF91D0C0A090B42E` (`offers_id`);

--
-- Indexes for table `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DDEA0111A53A8AA` (`provider_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_82F3B40753C674EE` (`offer_id`),
  ADD KEY `IDX_82F3B40719EB6921` (`client_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AA405F4053C674EE` (`offer_id`),
  ADD KEY `IDX_AA405F4019EB6921` (`client_id`);

--
-- Indexes for table `shopcars`
--
ALTER TABLE `shopcars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tadministrators`
--
ALTER TABLE `tadministrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tclients`
--
ALTER TABLE `tclients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tproviders`
--
ALTER TABLE `tproviders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tusers`
--
ALTER TABLE `tusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shopcars`
--
ALTER TABLE `shopcars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tusers`
--
ALTER TABLE `tusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorys`
--
ALTER TABLE `categorys`
  ADD CONSTRAINT `FK_759AF3975BDEDAB2` FOREIGN KEY (`client_interest_id`) REFERENCES `tclients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_759AF397A53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `tproviders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categorys_offers`
--
ALTER TABLE `categorys_offers`
  ADD CONSTRAINT `FK_4A74D4C3A090B42E` FOREIGN KEY (`offers_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4A74D4C3A96778EC` FOREIGN KEY (`categorys_id`) REFERENCES `categorys` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients_offers`
--
ALTER TABLE `clients_offers`
  ADD CONSTRAINT `FK_DF91D0C0A090B42E` FOREIGN KEY (`offers_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DF91D0C0AB014612` FOREIGN KEY (`clients_id`) REFERENCES `tclients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `FK_DDEA0111A53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `tproviders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `FK_82F3B40719EB6921` FOREIGN KEY (`client_id`) REFERENCES `tclients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_82F3B40753C674EE` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_AA405F4019EB6921` FOREIGN KEY (`client_id`) REFERENCES `tclients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AA405F4053C674EE` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tadministrators`
--
ALTER TABLE `tadministrators`
  ADD CONSTRAINT `FK_8D72B480BF396750` FOREIGN KEY (`id`) REFERENCES `tusers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tclients`
--
ALTER TABLE `tclients`
  ADD CONSTRAINT `FK_D09CB109BF396750` FOREIGN KEY (`id`) REFERENCES `tusers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tproviders`
--
ALTER TABLE `tproviders`
  ADD CONSTRAINT `FK_18048D2DBF396750` FOREIGN KEY (`id`) REFERENCES `tusers` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
