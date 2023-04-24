-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-04-2023 a las 23:51:30
-- Versión del servidor: 10.11.2-MariaDB
-- Versión de PHP: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app_bank`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `id_customer_id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `balance` double NOT NULL,
  `activation` datetime NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`id`, `id_customer_id`, `number`, `balance`, `activation`, `city`, `country`, `active`) VALUES
(1, 1, '123412341234', -100000, '2023-04-24 17:56:00', 'Cartagena', 'Colombia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idnumber` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`id`, `name`, `idnumber`, `phone`, `age`, `address`, `city`, `occupation`, `active`) VALUES
(1, 'Cristian', '1.023.999.999', '+57 312 4109315', 26, 'Calle 30a #69 79', 'Medellín', 'Desarrollador full-stack', 1),
(4, 'Cristian Prueba', '1.023.999.999', '+57 312 4109315', 26, 'Calle 30a #69 79', 'Medellín', 'Desarrollador full-stack', 1),
(5, 'Cristian Prueba', '1.023.999.999', '+57 312 4109315', 26, 'Calle 30a #69 79', 'Medellín', 'Desarrollador full-stack', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Pendiente'),
(2, 'Aprobada'),
(3, 'Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `id_customer_id` int(11) NOT NULL,
  `id_account_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `trade_name` varchar(255) NOT NULL,
  `current_balance` double NOT NULL,
  `final_balance` double NOT NULL,
  `id_status_id` int(11) NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `transactions`
--

INSERT INTO `transactions` (`id`, `id_customer_id`, `id_account_id`, `created`, `trade_name`, `current_balance`, `final_balance`, `id_status_id`, `value`) VALUES
(1, 1, 1, '2023-04-24 23:18:44', 'Pago Seguro SAS', 500000, 300000, 2, 200000),
(2, 1, 1, '2023-04-24 23:45:31', 'Pago Seguro SAS', 100000, 80000, 1, 20000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idnumber` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `idnumber`, `phone`, `age`) VALUES
(1, 'cristian@example.com', '[]', '$2y$13$uTRY9/BA1zO2q59RhZ/E6.dnE9a8s/kiyDK.xHrsqTDdsTJXlEiBe', 'Cristian Anzola', '1.023.999.999', '+57 312 4109315', 26),
(3, 'cristian1@example.com', '[]', '$2y$13$5xdaG.BTUiNhR6qeup/05O3BOiALpedk3GxTzlTnjht4yxnpPmAHW', 'Cristian Anzola', '1.023.999.999', '+57 312 4109315', 26);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CAC89EAC8B870E04` (`id_customer_id`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EAA81A4C8B870E04` (`id_customer_id`),
  ADD KEY `IDX_EAA81A4C3EE1DF6D` (`id_account_id`),
  ADD KEY `IDX_EAA81A4CEBC2BC9A` (`id_status_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `FK_CAC89EAC8B870E04` FOREIGN KEY (`id_customer_id`) REFERENCES `customer` (`id`);

--
-- Filtros para la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `FK_EAA81A4C3EE1DF6D` FOREIGN KEY (`id_account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `FK_EAA81A4C8B870E04` FOREIGN KEY (`id_customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_EAA81A4CEBC2BC9A` FOREIGN KEY (`id_status_id`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
