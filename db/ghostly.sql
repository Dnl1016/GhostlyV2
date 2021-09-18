-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2021 a las 14:58:41
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ghostly`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`, `estado`) VALUES
(1, 'Pantalones', 1),
(2, 'Zapatos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `idColor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`idColor`, `nombre`) VALUES
(1, 'Rojo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleproductos`
--

CREATE TABLE `detalleproductos` (
  `idDetalleProducto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `imagenUno` varchar(200) DEFAULT NULL,
  `imagenDos` varchar(200) DEFAULT NULL,
  `imagenTres` varchar(200) DEFAULT NULL,
  `idTalla` int(10) NOT NULL,
  `idColor` int(10) NOT NULL,
  `idProducto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleproductos`
--

INSERT INTO `detalleproductos` (`idDetalleProducto`, `nombre`, `cantidad`, `imagenUno`, `imagenDos`, `imagenTres`, `idTalla`, `idColor`, `idProducto`) VALUES
(5, 'Zapatos Adidas Rojos', 330, 'ImagenUno_Zapatos Adidas Rojos', 'ImagenDos_Zapatos Adidas Rojos', 'ImagenTres_Zapatos Adidas Rojos', 1, 1, 6),
(6, 'Zapatos Adidas Rojos 2', 70, 'ImagenUno_Zapatos Adidas Rojos 2', 'ImagenDos_Zapatos Adidas Rojos 2', 'ImagenTres_Zapatos Adidas Rojos 2', 1, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `idEntrada` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaEntrada` datetime NOT NULL,
  `idDetalleProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`idEntrada`, `cantidad`, `fechaEntrada`, `idDetalleProducto`) VALUES
(14, 10, '2021-09-10 11:09:14', 5),
(15, 20, '2021-09-10 11:09:31', 6),
(16, 20, '2021-09-10 11:09:50', 5),
(17, 50, '2021-09-10 11:09:19', 6),
(18, 300, '2021-09-10 11:09:19', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idPersona` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `nombre`, `apellido`, `cedula`, `correo`, `direccion`, `telefono`) VALUES
(1, 'Jorge Asdrubal', 'Ortega Gonzalez', 1000444493, 'jaog.11.2003@gmail.com', 'cra 62 #52-120', '3116519569'),
(2, 'Jorge Asdrubal', 'Asdrubal', 1234567890, '1234567890@gmail.com', 'Cra 65 #52-120, Cantares de riachuelo Apto 801', '+573128882626'),
(3, 'Jorge', '321312', 2147483647, 'sjidao@gmail.com', 'Cra 65 #52-120, Cantares de riachuelo Apto 801', '3116519569');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `cantidad`, `estado`, `genero`, `fechaRegistro`, `idCategoria`) VALUES
(6, 'Zapatos Adidas', 400, 1, 'M', '2021-09-10', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombre`, `estado`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `idTalla` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`idTalla`, `nombre`) VALUES
(1, 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contrasena`, `estado`, `idPersona`, `idRol`) VALUES
(1, 'asdrubal1107', '6fead90aa061349b9874d904c108b59c79d12d76', 1, 1, 1),
(6, 'asdrual1107', '6fead90aa061349b9874d904c108b59c79d12d76', 1, 2, 1),
(7, 'administrador', '6fead90aa061349b9874d904c108b59c79d12d76', 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fechaVenta` date NOT NULL,
  `valor` float NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`idColor`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `detalleproductos`
--
ALTER TABLE `detalleproductos`
  ADD PRIMARY KEY (`idDetalleProducto`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `idTalla` (`idTalla`),
  ADD KEY `idColor` (`idColor`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`idEntrada`),
  ADD KEY `idDetalleProducto` (`idDetalleProducto`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idPersona`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `idCategoria` (`idCategoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`idTalla`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `idPersona` (`idPersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `idColor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalleproductos`
--
ALTER TABLE `detalleproductos`
  MODIFY `idDetalleProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `idTalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleproductos`
--
ALTER TABLE `detalleproductos`
  ADD CONSTRAINT `detalleproductos_ibfk_1` FOREIGN KEY (`idTalla`) REFERENCES `tallas` (`idTalla`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleproductos_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleproductos_ibfk_3` FOREIGN KEY (`idColor`) REFERENCES `colores` (`idColor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`idDetalleProducto`) REFERENCES `detalleproductos` (`idDetalleProducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
