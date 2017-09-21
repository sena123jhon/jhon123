-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generaci√≥n: 15-03-2017 a las 14:59:39
-- Versi√≥n del servidor: 10.1.10-MariaDB
-- Versi√≥n de PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicaciones`
--

CREATE TABLE `aplicaciones` (
  `idaplicaciones` mediumint(9) NOT NULL,
  `fechaaplicaciones` date NOT NULL,
  `marcaempleadaaplicaciones` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `idtipoaplicacion` tinyint(4) NOT NULL,
  `idarbolaplicaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aplicaciones`
--

INSERT INTO `aplicaciones` (`idaplicaciones`, `fechaaplicaciones`, `marcaempleadaaplicaciones`, `idtipoaplicacion`, `idarbolaplicaciones`) VALUES
(1, '2016-11-02', 'yara', 67, 9),
(3, '2017-02-02', 'fertilmax', 67, 1),
(4, '2017-02-09', 'fertilmax max', 78, 10),
(8, '2017-02-15', 'yara', 78, 9),
(14, '2017-02-22', 'cal nitrificada', 67, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arbol`
--

CREATE TABLE `arbol` (
  `idarbol` int(11) NOT NULL,
  `alturaarbol` smallint(6) NOT NULL,
  `cantidadderamasarbol` tinyint(4) NOT NULL,
  `idfincaarbol` smallint(3) NOT NULL,
  `idterrenoarbol` tinyint(3) NOT NULL,
  `idvariedadesarbol` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arbol`
--

INSERT INTO `arbol` (`idarbol`, `alturaarbol`, `cantidadderamasarbol`, `idfincaarbol`, `idterrenoarbol`, `idvariedadesarbol`) VALUES
(1, 125, 73, 203, 4, 3),
(2, 210, 50, 200, 2, 2),
(3, 88, 33, 205, 1, 2),
(9, 78, 23, 203, 8, 2),
(10, 0, 0, 123, 1, 1),
(11, 123, 12, 205, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ataque`
--

CREATE TABLE `ataque` (
  `idataque` mediumint(9) NOT NULL,
  `fechadeataque` date NOT NULL,
  `idenfermedadesataque` tinyint(4) NOT NULL,
  `idarbolataque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ataque`
--

INSERT INTO `ataque` (`idataque`, `fechadeataque`, `idenfermedadesataque`, `idarbolataque`) VALUES
(1, '2016-11-02', 3, 3),
(2, '2016-11-03', 2, 1),
(4, '2017-02-02', 6, 9),
(5, '2017-02-09', 1, 2),
(8, '2017-03-03', 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `idauditoria` mediumint(9) NOT NULL,
  `fechaauditoria` date NOT NULL,
  `idusuarioauditorias` mediumint(9) NOT NULL,
  `descripcionauditoria` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`idauditoria`, `fechaauditoria`, `idusuarioauditorias`, `descripcionauditoria`) VALUES
(1, '2016-11-09', 1, 'Agrego podas'),
(2, '2017-02-15', 1, 'Elimino finca'),
(3, '2017-02-15', 1, 'Modifico foliacion'),
(4, '2017-03-14', 2, 'modifico enfermedades'),
(5, '2017-03-14', 2, 'modifico aplicaciones'),
(6, '2017-03-14', 2, 'modifico arbol'),
(7, '2017-03-14', 2, 'inserto arbol'),
(8, '2017-03-14', 2, 'modifico arbol'),
(9, '2017-03-14', 2, 'modifico podas'),
(10, '2017-03-14', 2, 'modifico produccion'),
(11, '2017-03-14', 2, 'modifico roles'),
(12, '2017-03-14', 2, 'modifico roles'),
(13, '2017-03-14', 2, 'modifico enfermedades'),
(14, '2017-03-14', 2, 'modifico variedades'),
(15, '2017-03-15', 2, 'modifico roles'),
(16, '2017-03-15', 2, 'modifico roles'),
(17, '2017-03-15', 2, 'modifico roles'),
(18, '2017-03-15', 2, 'modifico roles'),
(19, '2017-03-15', 2, 'modifico roles'),
(20, '2017-03-15', 2, 'modifico roles'),
(21, '2017-03-15', 2, 'modifico roles'),
(22, '2017-03-15', 2, 'modifico usuario'),
(23, '2017-03-15', 2, 'modifico usuario'),
(24, '2017-03-15', 2, 'modifico usuario'),
(25, '2017-03-15', 2, 'modifico usuario'),
(26, '2017-03-15', 2, 'modifico usuario'),
(27, '2017-03-15', 2, 'modifico usuario'),
(28, '2017-03-15', 2, 'modifico usuario'),
(29, '2017-03-15', 2, 'modifico usuario'),
(30, '2017-03-15', 2, 'modifico usuario'),
(31, '2017-03-15', 2, 'modifico roles'),
(32, '2017-03-15', 2, 'modifico roles'),
(33, '2017-03-15', 2, 'modifico roles'),
(34, '2017-03-15', 2, 'modifico usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades`
--

CREATE TABLE `enfermedades` (
  `idenfermedades` tinyint(3) NOT NULL,
  `nombreenfermedades` varchar(70) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `enfermedades`
--

INSERT INTO `enfermedades` (`idenfermedades`, `nombreenfermedades`) VALUES
(1, 'picudo'),
(2, 'mosca de la fruta'),
(3, 'hormigas'),
(6, 'barrenador tallos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finca`
--

CREATE TABLE `finca` (
  `idfinca` smallint(3) NOT NULL,
  `areafinca` mediumint(3) NOT NULL,
  `msnmfinca` smallint(3) NOT NULL,
  `nombrefinca` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacionfinca` point NOT NULL,
  `propietariofinca` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `finca`
--

INSERT INTO `finca` (`idfinca`, `areafinca`, `msnmfinca`, `nombrefinca`, `ubicacionfinca`, `propietariofinca`) VALUES
(123, 52361, 1919, 'los potreritos', '\0\0\0\0\0\0\0Ã|?Å@≠lÚñkR¿', 'edgar ariza'),
(124, 1234, 5436, 'el everest', '\0\0\0\0\0\0\0àªzô@^⁄pX\ZoR¿', 'jhon Freddy ardila'),
(198, 65410, 1919, 'El freijobal', '\0\0\0\0\0\0\0àªzô@^⁄pX\ZoR¿', 'maria flores'),
(200, 4562, 2321, 'la loma', '\0\0\0\0\0\0\0àªzô@^⁄pX\ZoR¿', 'Pedro Paramo'),
(201, 7500, 2001, 'Buena Vista', '\0\0\0\0\0\0\0àªzô@^⁄pX\ZoR¿', 'Pedro Paramo'),
(202, 13457, 1737, 'Buena Vista', '\0\0\0\0\0\0\0àªzô@^⁄pX\ZoR¿', 'Pedro Parra'),
(203, 15647, 1896, 'El polleral', '\0\0\0\0\0\0\0àªzô@^⁄pX\ZoR¿', 'Luis Garzon'),
(205, 4445, 1867, 'ojo de agua', '\0\0\0\0\0\0\0àªzô@^⁄pX\ZoR¿', 'ernesto ardila v');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floracion`
--

CREATE TABLE `floracion` (
  `idfloracion` mediumint(9) NOT NULL,
  `cantidadflores` smallint(4) UNSIGNED NOT NULL,
  `fechafloracion` date NOT NULL,
  `idarbolfloracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `floracion`
--

INSERT INTO `floracion` (`idfloracion`, `cantidadflores`, `fechafloracion`, `idarbolfloracion`) VALUES
(2, 110, '2016-11-01', 3),
(3, 126, '2016-11-03', 9),
(4, 256, '2017-02-11', 1),
(5, 123, '2017-02-11', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foliacion`
--

CREATE TABLE `foliacion` (
  `idfoliacion` mediumint(9) NOT NULL,
  `fechadeanalicisfoliacion` date NOT NULL,
  `areadehojafoliacion` smallint(6) NOT NULL,
  `numerodehojasfoliacion` smallint(6) NOT NULL,
  `idarbolfoliacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `foliacion`
--

INSERT INTO `foliacion` (`idfoliacion`, `fechadeanalicisfoliacion`, `areadehojafoliacion`, `numerodehojasfoliacion`, `idarbolfoliacion`) VALUES
(1, '2016-11-15', 124, 500, 1),
(2, '2016-11-11', 333, 444, 2),
(4, '2017-02-03', 162, 316, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `podas`
--

CREATE TABLE `podas` (
  `idpodas` mediumint(9) NOT NULL,
  `tipopodas` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fechapodas` date NOT NULL,
  `idarbolpodas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `podas`
--

INSERT INTO `podas` (`idpodas`, `tipopodas`, `fechapodas`, `idarbolpodas`) VALUES
(1, 'produccion', '2016-11-01', 3),
(2, 'formacion de arbol', '2016-11-09', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `idproduccion` mediumint(9) NOT NULL,
  `kilosdesechosproduccion` tinyint(4) NOT NULL,
  `kilosterceraproduccion` tinyint(4) NOT NULL,
  `kilossegundaproduccion` tinyint(4) NOT NULL,
  `kilosprimeraproduccion` tinyint(4) NOT NULL,
  `idarbolproduccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `produccion`
--

INSERT INTO `produccion` (`idproduccion`, `kilosdesechosproduccion`, `kilosterceraproduccion`, `kilossegundaproduccion`, `kilosprimeraproduccion`, `idarbolproduccion`) VALUES
(1, 0, 10, 20, 127, 1),
(2, 1, 15, 44, 59, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idroles` tinyint(3) NOT NULL,
  `nombreroles` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `arbolroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `fincaroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `podasroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `produccionroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `floracionroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `foliacionroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `enfermedadesroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `ataqueroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `variedadesroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `terrenoroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `aplicacionesroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `tipoaplicacionroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `usuarioroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `auditoriaroles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `tiposuelosroles` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `rolesroles` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idroles`, `nombreroles`, `arbolroles`, `fincaroles`, `podasroles`, `produccionroles`, `floracionroles`, `foliacionroles`, `enfermedadesroles`, `ataqueroles`, `variedadesroles`, `terrenoroles`, `aplicacionesroles`, `tipoaplicacionroles`, `usuarioroles`, `auditoriaroles`, `tiposuelosroles`, `rolesroles`) VALUES
(1, 'agricultor', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'r', 'r'),
(2, 'ADMINISTRADOR', 'crud', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'crud', 'CRUD', 'CRUD', 'CRUD', 'crud', 'crud'),
(3, 'PROPIETARIO', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'crud', 'crud'),
(11, 'operador', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'cr', 'r', 'crud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terreno`
--

CREATE TABLE `terreno` (
  `idterreno` tinyint(3) NOT NULL,
  `presentaerocion` tinyint(1) NOT NULL,
  `phterreno` decimal(5,3) NOT NULL,
  `idtiposuelo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `terreno`
--

INSERT INTO `terreno` (`idterreno`, `presentaerocion`, `phterreno`, `idtiposuelo`) VALUES
(1, 0, '5.600', 1),
(2, 1, '8.000', 2),
(3, 1, '6.000', 3),
(4, 1, '7.000', 3),
(8, 0, '5.000', 3),
(34, 1, '1.300', 3),
(35, 1, '1.205', 2),
(36, 1, '1.000', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoaplicacion`
--

CREATE TABLE `tipoaplicacion` (
  `idtipoaplicacion` tinyint(3) NOT NULL,
  `nombretipoaplicacion` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `tipohervicida` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `tipofungicida` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `tipoabono` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `nombrefungicida` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `nombrehervicida` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `nombreabono` varchar(55) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoaplicacion`
--

INSERT INTO `tipoaplicacion` (`idtipoaplicacion`, `nombretipoaplicacion`, `tipohervicida`, `tipofungicida`, `tipoabono`, `nombrefungicida`, `nombrehervicida`, `nombreabono`) VALUES
(45, 'control de hormigas', 'no', 'quimico', 'no', 'lorsban', 'no', 'no'),
(67, 'mantenimiento', 'quimico', 'organico', 'quimico', 'lorsban', 'glifosato', 'yara'),
(78, 'control de plagas', 'organico', 'quimico', 'no', 'rafaga', 'no', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposuelos`
--

CREATE TABLE `tiposuelos` (
  `idtiposuelos` tinyint(4) NOT NULL,
  `nombrestiposuelos` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tiposuelos`
--

INSERT INTO `tiposuelos` (`idtiposuelos`, `nombrestiposuelos`) VALUES
(1, 'Franco'),
(2, 'Arcilloso'),
(3, 'Arenoso'),
(10, 'FrancoArenoso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` mediumint(9) NOT NULL,
  `nombreusuario` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `correousuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `claveusuario` varbinary(64) NOT NULL,
  `fecharegistrousuario` date NOT NULL,
  `fechaultimaclave` date NOT NULL,
  `celularusuario` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `idrolusuario` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombreusuario`, `correousuario`, `claveusuario`, `fecharegistrousuario`, `fechaultimaclave`, `celularusuario`, `idrolusuario`) VALUES
(1, 'juan', 'ju@s.co', 0x62323231643964626230383361376633333432386437633261336333313938616539323536313464373032313065323837313663636161376364346464623739, '2016-11-01', '2016-11-03', '3213214569', 1),
(2, 'pedro paramo', 'pedro@pa.co', 0x62323231643964626230383361376633333432386437633261336333313938616539323536313464373032313065323837313663636161376364346464623739, '2017-03-22', '2017-01-31', '3335558888', 1),
(3, 'carlos', 'carlos@c.co', 0x38643936396565663665636164336332396133613632393238306536383663663063336635643561383661666633636131323032306339323361646336633932, '2017-03-14', '0000-00-00', '3214568274', 1),
(8, 'jhon', 'jsardila90@misena.edu.co', 0x31333064363739316530646533363837333531313737356463636163363461643765663534623036636264373035346237666564613330336536343564626237, '2017-03-15', '0000-00-00', '3133402731', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variedades`
--

CREATE TABLE `variedades` (
  `idvariedades` tinyint(3) NOT NULL,
  `nombrevariedades` varchar(70) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `variedades`
--

INSERT INTO `variedades` (`idvariedades`, `nombrevariedades`) VALUES
(1, 'ica roja'),
(2, 'regional roja'),
(3, 'blanca'),
(4, 'silvestres');

--
-- √çndices para tablas volcadas
--

--
-- Indices de la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  ADD PRIMARY KEY (`idaplicaciones`),
  ADD KEY `idtipoaplicacion` (`idtipoaplicacion`),
  ADD KEY `idarbolaplicacion` (`idarbolaplicaciones`);

--
-- Indices de la tabla `arbol`
--
ALTER TABLE `arbol`
  ADD PRIMARY KEY (`idarbol`),
  ADD KEY `idfincaarbol` (`idfincaarbol`),
  ADD KEY `idterrenoarbol` (`idterrenoarbol`),
  ADD KEY `idvariedadesarbol` (`idvariedadesarbol`);

--
-- Indices de la tabla `ataque`
--
ALTER TABLE `ataque`
  ADD PRIMARY KEY (`idataque`),
  ADD KEY `idenfermedadAtaque` (`idenfermedadesataque`),
  ADD KEY `idarbolataque` (`idarbolataque`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`idauditoria`),
  ADD KEY `idusuarioauditorias` (`idusuarioauditorias`);

--
-- Indices de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  ADD PRIMARY KEY (`idenfermedades`);

--
-- Indices de la tabla `finca`
--
ALTER TABLE `finca`
  ADD PRIMARY KEY (`idfinca`);

--
-- Indices de la tabla `floracion`
--
ALTER TABLE `floracion`
  ADD PRIMARY KEY (`idfloracion`),
  ADD KEY `idarbolfloracion` (`idarbolfloracion`);

--
-- Indices de la tabla `foliacion`
--
ALTER TABLE `foliacion`
  ADD PRIMARY KEY (`idfoliacion`),
  ADD KEY `idarbolfoliacion` (`idarbolfoliacion`);

--
-- Indices de la tabla `podas`
--
ALTER TABLE `podas`
  ADD PRIMARY KEY (`idpodas`),
  ADD KEY `idarbolpodas` (`idarbolpodas`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`idproduccion`),
  ADD KEY `idarbolProduccion` (`idarbolproduccion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`);

--
-- Indices de la tabla `terreno`
--
ALTER TABLE `terreno`
  ADD PRIMARY KEY (`idterreno`),
  ADD KEY `idtiposuelo` (`idtiposuelo`);

--
-- Indices de la tabla `tipoaplicacion`
--
ALTER TABLE `tipoaplicacion`
  ADD PRIMARY KEY (`idtipoaplicacion`);

--
-- Indices de la tabla `tiposuelos`
--
ALTER TABLE `tiposuelos`
  ADD PRIMARY KEY (`idtiposuelos`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idusuario` (`idrolusuario`);

--
-- Indices de la tabla `variedades`
--
ALTER TABLE `variedades`
  ADD PRIMARY KEY (`idvariedades`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  MODIFY `idaplicaciones` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `arbol`
--
ALTER TABLE `arbol`
  MODIFY `idarbol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `ataque`
--
ALTER TABLE `ataque`
  MODIFY `idataque` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `idauditoria` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  MODIFY `idenfermedades` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `finca`
--
ALTER TABLE `finca`
  MODIFY `idfinca` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT de la tabla `floracion`
--
ALTER TABLE `floracion`
  MODIFY `idfloracion` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `foliacion`
--
ALTER TABLE `foliacion`
  MODIFY `idfoliacion` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `podas`
--
ALTER TABLE `podas`
  MODIFY `idpodas` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `idproduccion` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idroles` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `terreno`
--
ALTER TABLE `terreno`
  MODIFY `idterreno` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `tipoaplicacion`
--
ALTER TABLE `tipoaplicacion`
  MODIFY `idtipoaplicacion` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT de la tabla `tiposuelos`
--
ALTER TABLE `tiposuelos`
  MODIFY `idtiposuelos` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `variedades`
--
ALTER TABLE `variedades`
  MODIFY `idvariedades` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  ADD CONSTRAINT `aplicaciones_ibfk_1` FOREIGN KEY (`idarbolaplicaciones`) REFERENCES `arbol` (`idarbol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aplicaciones_ibfk_2` FOREIGN KEY (`idtipoaplicacion`) REFERENCES `tipoaplicacion` (`idtipoaplicacion`);

--
-- Filtros para la tabla `arbol`
--
ALTER TABLE `arbol`
  ADD CONSTRAINT `arbol_ibfk_3` FOREIGN KEY (`idterrenoarbol`) REFERENCES `terreno` (`idterreno`),
  ADD CONSTRAINT `arbol_ibfk_4` FOREIGN KEY (`idvariedadesarbol`) REFERENCES `variedades` (`idvariedades`),
  ADD CONSTRAINT `fk_arbolidfinca` FOREIGN KEY (`idfincaarbol`) REFERENCES `finca` (`idfinca`);

--
-- Filtros para la tabla `ataque`
--
ALTER TABLE `ataque`
  ADD CONSTRAINT `ataque_ibfk_1` FOREIGN KEY (`idarbolataque`) REFERENCES `arbol` (`idarbol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`idusuarioauditorias`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `floracion`
--
ALTER TABLE `floracion`
  ADD CONSTRAINT `floracion_ibfk_1` FOREIGN KEY (`idarbolfloracion`) REFERENCES `arbol` (`idarbol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `foliacion`
--
ALTER TABLE `foliacion`
  ADD CONSTRAINT `foliacion_ibfk_1` FOREIGN KEY (`idarbolfoliacion`) REFERENCES `arbol` (`idarbol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `podas`
--
ALTER TABLE `podas`
  ADD CONSTRAINT `podas_ibfk_1` FOREIGN KEY (`idarbolpodas`) REFERENCES `arbol` (`idarbol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `terreno`
--
ALTER TABLE `terreno`
  ADD CONSTRAINT `terreno_ibfk_1` FOREIGN KEY (`idtiposuelo`) REFERENCES `tiposuelos` (`idtiposuelos`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idrolusuario`) REFERENCES `roles` (`idroles`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
