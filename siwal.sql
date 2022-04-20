-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2021 a las 08:37:43
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siwal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

CREATE TABLE `caja_chica` (
  `idCajaChica` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Monto` int(11) NOT NULL,
  `Concepto` varchar(45) NOT NULL,
  `Tipo_concepto` varchar(45) NOT NULL,
  `FirmaDirectora` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caja_chica`
--

INSERT INTO `caja_chica` (`idCajaChica`, `Fecha`, `Monto`, `Concepto`, `Tipo_concepto`, `FirmaDirectora`) VALUES
(1, '0000-00-00', 5000, 'pago de dentista ', 'familiar', 'jlkjlk'),
(2, '0000-00-00', 5000, 'pago de dentista ', 'familiar', 'jlkjlk'),
(3, '0000-00-00', 5000, 'pago de dentista ', 'familiar', 'jlkjlk'),
(4, '0000-00-00', 5000, 'pago de dentista ', 'familiar', '4444'),
(5, '0000-00-00', 1502030, 'pagos para el perro ', 'Mafalda', 'asdasd'),
(6, '0000-00-00', 10000, 'Don martin', 'Para su carro', 'elpoder'),
(7, '2021-08-05', 50, 'Don garra', 'MaÃ­z', 'elpoder'),
(8, '0000-00-00', 16, 'Don perea', 'Fertilizante', 'el poder'),
(9, '2021-08-08', 1502030, 'Cliente realizÃ³ un pago mensual', 'nÃºmero de venta: ', 'sdasd'),
(10, '2021-08-08', 1502030, 'Cliente realizÃ³ un pago mensual', 'No. venta: 12', '4444'),
(11, '2021-08-11', 0, 'Proceso de la empresa', 'Nueva venta', 'sdf'),
(12, '2021-08-11', 0, 'Proceso de la empresa', 'Nueva venta', 'sdf'),
(13, '2021-08-11', 10000, 'Proceso de la empresa', 'Nueva venta', 'sdf'),
(14, '2021-08-11', 10000, 'Proceso de la empresa', 'Nueva venta', 'sdf'),
(15, '2021-08-11', 10000, 'Proceso de la empresa', 'Nueva venta', 'sdf'),
(16, '2021-08-11', 5000, 'compra de carros', 'Empresa', 'sdasd'),
(17, '2021-08-11', 5000, 'Cliente realizÃ³ un pago mensual', 'No. venta: 12', 'jlkjlk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `ApellidoPaterno` varchar(45) NOT NULL,
  `ApellidoMaterno` varchar(45) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Celular` int(11) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Calle` varchar(45) NOT NULL,
  `Numero` varchar(45) NOT NULL,
  `Fraccionamiento` varchar(45) NOT NULL,
  `CP` int(11) NOT NULL,
  `Municipio` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Identificacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`, `Telefono`, `Celular`, `Correo`, `Calle`, `Numero`, `Fraccionamiento`, `CP`, `Municipio`, `Estado`, `Identificacion`) VALUES
(1, 'Hank', 'SHREDER', 'SHREDER', 929999, 2147483647, 'Hanna@gmail.com', 'Rio', '209', 'Guadalupe', 98068, 'Zacatecas', 'Zacatecas', '4586s');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comision`
--

CREATE TABLE `comision` (
  `idComicion` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_Empleado` int(11) NOT NULL,
  `Monto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `FirmaEmpleado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratoscancelados`
--

CREATE TABLE `contratoscancelados` (
  `idContratosCancelados` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `Penalizacion` int(11) NOT NULL,
  `FIrma_cliente` varchar(45) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `Puesto` varchar(45) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `ApellidoPaterno` varchar(45) NOT NULL,
  `ApellidoMaterno` varchar(45) NOT NULL,
  `FechaNacimiento` varchar(45) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Celular` text NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `FechaIngreso` varchar(45) NOT NULL,
  `Calle` varchar(45) NOT NULL,
  `Numero` varchar(45) NOT NULL,
  `Colonia` varchar(45) NOT NULL,
  `CP` int(11) NOT NULL,
  `Municipio` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `Puesto`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`, `FechaNacimiento`, `Telefono`, `Celular`, `Correo`, `FechaIngreso`, `Calle`, `Numero`, `Colonia`, `CP`, `Municipio`, `Estado`) VALUES
(110, 'Administrador', 'Owen', 'Luna', 'RamÃ­rez', '1992-05-07', 9206050, '4921296794', 'hebraudio@gmail.com', '2021-05-05', 'Rio juchipila ', '209', 'Zacatecas', 98064, 'Zacatecas', 'Zacatecas'),
(113, 'Secretaria', 'MarÃ­a', 'Martinez', 'Lazaro', '2015-05-22', 9256050, '4921296794', 'hebraudio@gmail.com', '2021-05-12', 'RÃ­o Juchipila', '502', 'HidrÃ¡ulica', 98068, 'Valparaiso', 'Zacatecas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE `expediente` (
  `id_expediente` int(11) NOT NULL,
  `id_Empleado` int(11) NOT NULL,
  `CURP` varchar(45) NOT NULL,
  `RFC` varchar(45) NOT NULL,
  `Seguro` varchar(45) NOT NULL,
  `Grado_estudios` varchar(45) NOT NULL,
  `Identificacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `idNomina` int(11) NOT NULL,
  `id_Empleado` int(11) NOT NULL,
  `Dias_laborados` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `pago_final` int(11) NOT NULL,
  `Firma` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPagos` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Monto` int(11) NOT NULL,
  `FirmaDirectora` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idPagos`, `idVenta`, `Fecha`, `Monto`, `FirmaDirectora`) VALUES
(21, 12, '2021-07-17', 45, 'kj'),
(23, 42, '2021-07-27', 10000, 'asd'),
(59, 12, '2021-07-30', 5000, 'jlkjlk'),
(60, 12, '2021-07-30', 5000, 'jlkjlk'),
(61, 12, '2021-07-30', 5000, 'jlkjlk'),
(65, 12, '2021-07-30', 5000, 'jlkjlk'),
(66, 12, '2021-07-30', 0, ''),
(67, 12, '2021-07-30', 5000, 'jlkjlk'),
(68, 42, '2021-07-27', 10000, 'asd'),
(69, 42, '2021-07-27', 10000, 'asd'),
(70, 42, '2021-07-27', 10000, 'asd'),
(71, 46, '2021-08-06', 5000000, 'sdfsdf'),
(72, 12, '2021-08-08', 1502030, 'sdasd'),
(73, 12, '2021-08-08', 1502030, '4444'),
(74, 47, '2021-08-11', 10, 'sdf'),
(75, 48, '2021-08-11', 10000, 'sdf'),
(76, 49, '2021-08-11', 10000, 'sdf'),
(77, 50, '2021-08-11', 10000, 'sdf'),
(78, 51, '2021-08-11', 10000, 'sdf'),
(79, 12, '2021-08-11', 5000, 'jlkjlk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `Puesto` varchar(45) NOT NULL,
  `Salario` int(11) NOT NULL,
  `Comicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`Puesto`, `Salario`, `Comicion`) VALUES
('Administrador', 1400, 0),
('Secretaria', 1400, 5000),
('vendedor', 1400, 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE `referencias` (
  `id_referencia` int(11) NOT NULL,
  `id_Empleado` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido_paterno` varchar(45) NOT NULL,
  `Apellido_Materno` varchar(45) NOT NULL,
  `Celular` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terrenos`
--

CREATE TABLE `terrenos` (
  `idTerreno` int(11) NOT NULL,
  `Estatus` varchar(45) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Superficie` decimal(45,0) NOT NULL,
  `alNoreste` decimal(45,0) NOT NULL,
  `alNoroeste` decimal(45,0) NOT NULL,
  `alSureste` decimal(45,0) NOT NULL,
  `alSuroeste` decimal(45,0) NOT NULL,
  `Municipio` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Fraccionamiento` varchar(45) NOT NULL,
  `Fraccion` varchar(45) NOT NULL,
  `Manzana` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `terrenos`
--

INSERT INTO `terrenos` (`idTerreno`, `Estatus`, `Precio`, `Superficie`, `alNoreste`, `alNoroeste`, `alSureste`, `alSuroeste`, `Municipio`, `Estado`, `Fraccionamiento`, `Fraccion`, `Manzana`) VALUES
(1, 'Disponible', 110000, '0', '0', '0', '0', '0', 'f', 'f', 'f', 'f', 'f'),
(2, 'Disponible', 0, '0', '0', '0', '0', '0', 'f', 'f', 'f', 'f', 'f'),
(2222, 'Vendido', 3, '3', '3', '3', '3', '3', '3', '3', '3', '3', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testigos`
--

CREATE TABLE `testigos` (
  `idTestigo` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `apellidoPaterno` varchar(45) NOT NULL,
  `apellidoMaterno` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `id_Empleado` int(11) NOT NULL,
  `Usuario` varchar(45) NOT NULL,
  `contra` varchar(45) NOT NULL,
  `Puesto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `id_Empleado`, `Usuario`, `contra`, `Puesto`) VALUES
(2, 110, 'admin', '123', 'Administrador'),
(9, 113, 'Secretaria', 'secretaria123', 'Secretaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idTerreno` int(11) NOT NULL,
  `Enganche` int(11) NOT NULL,
  `Apartado` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Mensualidades` int(11) NOT NULL,
  `Estatus` varchar(45) NOT NULL,
  `FirmaCliente` varchar(45) NOT NULL,
  `FirmaTestigo` varchar(45) NOT NULL,
  `FirmaDirectora` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idVenta`, `idEmpleado`, `idCliente`, `idTerreno`, `Enganche`, `Apartado`, `Fecha`, `Mensualidades`, `Estatus`, `FirmaCliente`, `FirmaTestigo`, `FirmaDirectora`) VALUES
(12, 113, 1, 1, 54, 454, '2021-07-17', 4, 'Vendido', '4', '4', '4'),
(13, 113, 1, 1, 54, 454, '2021-07-17', 4, 'Vendido', '4', '4', '4'),
(42, 113, 1, 2222, 10000, 0, '2021-07-27', 25, 'Vendido', 'asd', 'asd', 'asd'),
(46, 113, 1, 1, 5000000, 500000000, '2021-08-06', 24, 'Vendido', 'sdfsdf', 'sdfsdf', 'sdfsdf'),
(47, 113, 1, 2222, 10, 0, '2021-08-11', 25, 'Vendido', 'sdf', 'sdf', 'sdf'),
(48, 113, 1, 2222, 10000, 0, '2021-08-11', 25, 'Vendido', 'sdf', 'sdf', 'sdf'),
(49, 113, 1, 2222, 10000, 0, '2021-08-11', 25, 'Vendido', 'sdf', 'sdf', 'sdf'),
(50, 113, 1, 2222, 10000, 0, '2021-08-11', 25, 'Vendido', 'sdf', 'sdf', 'sdf'),
(51, 113, 1, 2222, 10000, 0, '2021-08-11', 25, 'Vendido', 'sdf', 'sdf', 'sdf');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  ADD PRIMARY KEY (`idCajaChica`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `comision`
--
ALTER TABLE `comision`
  ADD PRIMARY KEY (`idComicion`,`id_venta`,`id_Empleado`),
  ADD KEY `fk_Comicion_Ventas1_idx` (`id_venta`,`id_Empleado`);

--
-- Indices de la tabla `contratoscancelados`
--
ALTER TABLE `contratoscancelados`
  ADD PRIMARY KEY (`idContratosCancelados`,`id_venta`),
  ADD KEY `fk_ContratosCancelados_Ventas1_idx` (`id_venta`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`,`Puesto`),
  ADD KEY `fk_Empleados_Puesto1_idx` (`Puesto`);

--
-- Indices de la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id_expediente`,`id_Empleado`),
  ADD KEY `fk_Expediente_Empleados1_idx` (`id_Empleado`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`idNomina`,`id_Empleado`),
  ADD KEY `fk_Nomina_Empleados1_idx` (`id_Empleado`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPagos`,`idVenta`),
  ADD KEY `fk_Pagos_Ventas1_idx` (`idVenta`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`Puesto`);

--
-- Indices de la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD PRIMARY KEY (`id_referencia`,`id_Empleado`),
  ADD KEY `fk_Referencias_Empleados_idx` (`id_Empleado`);

--
-- Indices de la tabla `terrenos`
--
ALTER TABLE `terrenos`
  ADD PRIMARY KEY (`idTerreno`);

--
-- Indices de la tabla `testigos`
--
ALTER TABLE `testigos`
  ADD PRIMARY KEY (`idTestigo`,`idCliente`),
  ADD KEY `fk_Testigos_Clientes1_idx` (`idCliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`,`id_Empleado`),
  ADD KEY `fk_Usuarios_Empleados1_idx` (`id_Empleado`) USING BTREE,
  ADD KEY `fk_Usuarios_Puesto1_idx` (`Puesto`) USING BTREE;

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`,`idEmpleado`,`idCliente`,`idTerreno`),
  ADD KEY `fk_Ventas_Empleados1_idx` (`idEmpleado`),
  ADD KEY `fk_Ventas_Clientes1_idx` (`idCliente`),
  ADD KEY `fk_Ventas_Terrenos1_idx` (`idTerreno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  MODIFY `idCajaChica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comision`
--
ALTER TABLE `comision`
  MODIFY `idComicion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratoscancelados`
--
ALTER TABLE `contratoscancelados`
  MODIFY `idContratosCancelados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `expediente`
--
ALTER TABLE `expediente`
  MODIFY `id_expediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `idNomina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `referencias`
--
ALTER TABLE `referencias`
  MODIFY `id_referencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `terrenos`
--
ALTER TABLE `terrenos`
  MODIFY `idTerreno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2223;

--
-- AUTO_INCREMENT de la tabla `testigos`
--
ALTER TABLE `testigos`
  MODIFY `idTestigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comision`
--
ALTER TABLE `comision`
  ADD CONSTRAINT `fk_Comicion_Ventas1` FOREIGN KEY (`id_venta`,`id_Empleado`) REFERENCES `ventas` (`idVenta`, `idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contratoscancelados`
--
ALTER TABLE `contratoscancelados`
  ADD CONSTRAINT `fk_ContratosCancelados_Ventas1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`idVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_Empleados_Puesto1` FOREIGN KEY (`Puesto`) REFERENCES `puesto` (`Puesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD CONSTRAINT `fk_Expediente_Empleados1` FOREIGN KEY (`id_Empleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `fk_Nomina_Empleados1` FOREIGN KEY (`id_Empleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_Pagos_Ventas1` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`idVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD CONSTRAINT `fk_Referencias_Empleados` FOREIGN KEY (`id_Empleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `testigos`
--
ALTER TABLE `testigos`
  ADD CONSTRAINT `fk_Testigos_Clientes1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Usuarios_Empleados1` FOREIGN KEY (`id_Empleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_Puesto1` FOREIGN KEY (`Puesto`) REFERENCES `puesto` (`Puesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_Ventas_Clientes1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ventas_Empleados1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ventas_Terrenos1` FOREIGN KEY (`idTerreno`) REFERENCES `terrenos` (`idTerreno`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
