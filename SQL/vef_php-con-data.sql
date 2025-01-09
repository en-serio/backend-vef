/*
 Navicat Premium Dump SQL

 Source Server         : Developer2
 Source Server Type    : MariaDB
 Source Server Version : 101108 (10.11.8-MariaDB-0ubuntu0.24.04.1)
 Source Host           : dev2.aidea.cat:3306
 Source Schema         : vef_php

 Target Server Type    : MariaDB
 Target Server Version : 101108 (10.11.8-MariaDB-0ubuntu0.24.04.1)
 File Encoding         : 65001

 Date: 08/12/2024 18:24:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` timestamp NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `nombreUsuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rol` int(10) NOT NULL,
  `dni` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idCliente`, `email`, `nombreUsuario`) USING BTREE,
  INDEX `idCliente`(`idCliente` ASC) USING BTREE,
  INDEX `telefono`(`telefono` ASC) USING BTREE,
  INDEX `nombreComplet`(`nombre` ASC) USING BTREE,
  INDEX `nomUsuario`(`nombreUsuario` ASC) USING BTREE,
  INDEX `email`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (21, 'Victor', 'Requena', 'Gallego', 689240824, 'victor_rg33@hotmail.com', '2024-11-14 19:34:06', '2024-12-07 14:47:49', 'victor', '$2y$10$J/fHgklW0RP0nbFu.1QWBeKuWXhMKRiZpE5Etzbsp0erWKxRw6Lp2', 1, '48015426m');
INSERT INTO `cliente` VALUES (24, 'Elena', 'Lopez', 'Estremera', 6666666, 'uwu@gmail.com', '2024-11-15 18:36:09', '2024-12-08 17:50:10', 'uwu', '$2y$10$egqKJ93F3qjYGiz1JQWvWO85gn9wJN5IjS.2v4ojM8nwL/gy1QSe.', 2, '');
INSERT INTO `cliente` VALUES (27, '123123', '123123', '1231231', 123123123, 'a@a.com', '2024-11-16 13:58:01', '2024-12-07 13:15:13', 'a@a.com', 'o2hGLSwj', 2, '123123123');
INSERT INTO `cliente` VALUES (28, 'Gilberto', 'López', 'Guzmán', 68854521, 'info@hoteltest.com', '2024-11-16 14:07:02', '2024-12-08 17:50:59', 'a@aaaaa.com', 'nxx81oaY', 2, '');
INSERT INTO `cliente` VALUES (29, 'sadfasdf', 'asdfasdf', 'adsfasdf', 123123123, 'asdasda@aaaaa.com', '2024-11-16 14:12:20', '2024-12-05 13:22:10', 'asdasda@aaaaa.com', 'CB52mqXG', 3, '123123123');
INSERT INTO `cliente` VALUES (32, 'José', 'Contoso', 'Sanz', 622121212, 'info@hotelmajestic.com', '2024-11-16 00:00:00', '2024-12-08 17:57:39', 'majestic', '$10$J/fHgklW0RP0nbFu.1QWBeKuWXhMKRiZpE5Etzbsp0erWKxRw6Lp2', 2, '');
INSERT INTO `cliente` VALUES (33, 'Albertin', 'Gjsjf', 'Djfjg', 689240824, 'vic@cvif.com', '2024-11-16 19:16:24', '2024-11-16 19:16:24', 'Gjfkg', '$2y$10$AzDTotir3ey6bJntg/r.puwjHOMAJwtJKrMynM3i7Ykceil6R12na', 1, '-');
INSERT INTO `cliente` VALUES (34, 'ferran', 'calpe', 'romero', 658893677, 'ferran.calpe@gmail.com', '2024-11-16 19:22:07', '2024-11-16 19:22:07', 'ferran90', '$2y$10$Bj8YvBUDjylsZNgEaHUu6ebaBumTA95Mm8A9hv2FclRHT/1lITPAO', 1, '-');
INSERT INTO `cliente` VALUES (35, 'ferran', 'cliente', 'clientote', 685939822, 'ferran.cliente@gmail.com', '2024-11-16 00:00:00', '2024-11-16 00:00:00', 'ferran.cliente@gmail.com', 'mBNPJMuh', 3, '47398201g');
INSERT INTO `cliente` VALUES (36, 'Ckfkv', 'Dnfmvl', 'Ckfkeme', 658956832, 'vincifo@vjdnr.com', '2024-11-17 00:00:00', '2024-12-07 13:15:30', 'vincifo@vjdnr.com', 'd^fwJA29', 2, 'Fketoro');
INSERT INTO `cliente` VALUES (37, 'Iris', 'Rodriguez', 'Ortiz', 618412258, 'iris__08@hotmail.com', '2024-11-17 13:28:36', '2024-11-17 13:28:36', 'iris9923', '$2y$10$Qy5ZQIXH8TbsVaOMhb6INeXrRj5jEWZtJTBSx8QTgGKoaQqIJWipG', 3, '-');
INSERT INTO `cliente` VALUES (38, 'gus', 'Gustin', 'Gustirrin&iacute;n', 655456455, 'gustic@gmail.com', '2024-11-20 13:24:44', '2024-11-20 13:24:44', 'gustik', '$2y$10$S3.xkAJ6R9CETJRIppljnOT.xF66tAbs6m5yFKlVcZyPWAUvM.fqW', 3, '-');
INSERT INTO `cliente` VALUES (39, 'Alfonsin', 'alfonsito', 'algon', 655454545, 'alfonso@gmail.com', '2024-11-20 13:25:41', '2024-12-07 13:15:35', 'alfonsin', '$2y$10$f3wFMVbOPQj5OmGR3bHeYePGXKvnxWCW/JVDryggdeTAZEW8Mz/L6', 2, '-');
INSERT INTO `cliente` VALUES (40, 'alberto', 'ruiz', 'gallardon', 65544542, 'hola@hotmail.com', '2024-11-20 18:09:35', '2024-11-20 18:09:35', 'hola', '$2y$10$lx.j6lvnLanmnpd8NUnNl.NkRi.BCPpgFZxHEKyn0BaXt1FNZVhu6', 3, '-');
INSERT INTO `cliente` VALUES (41, 'Marta', 'Garrido', 'Vidal', 686808713, 'martaa.gv@hotmail.com', '2024-11-21 22:18:41', '2024-12-07 17:47:41', 'Martagarridov', '$2y$10$mv8o9rNEzMzv9jAkMJkGsOnQ/A1GuccRQRvEkBqih627w3Yk6OlK.', 2, '74565485');
INSERT INTO `cliente` VALUES (42, '5243', '2453', '25345', 977123456, '554@kk.uk', '2024-11-22 00:00:00', '2024-11-22 00:00:00', '554@kk.uk', 'JDe7(1TN', 3, '53425');
INSERT INTO `cliente` VALUES (43, 'usuaUno', 'apeuno', 'apedos', 685920013, 'fcalper@gmail.com', '2024-11-25 20:39:00', '2024-11-25 20:39:00', 'usuaUno', '$2y$10$EzrZ1SGLJP6/R9rkFcskgOTrtXvPemUsqqLCdrsLUzyT7nKB.peTK', 3, '-');
INSERT INTO `cliente` VALUES (44, 'UsauUno', 'apeuno', 'apedos', 685928232, 'fcalper@uoc.edu', '2024-11-25 00:00:00', '2024-11-25 00:00:00', 'fcalper@uoc.edu', 'DEmh#T!u', 3, '49823118P');
INSERT INTO `cliente` VALUES (45, 'Andrea', 'Sua', 'Merced', 684891192, 'AsuaMer@gmail.com', '2024-11-30 00:00:00', '2024-11-30 00:00:00', 'AsuaMer@gmail.com', 'ythQmPfZ', 3, '48912309G');
INSERT INTO `cliente` VALUES (46, 'Albertito', 'Ruiz', 'Gilberto', 689240824, 'alberto@aidea.cat', '2024-12-01 19:01:33', '2024-12-01 20:03:02', 'Albertin2', '$2y$10$3yNQrGWDo.euApk9vF4wneImrVJBtICrMsJz1lg3QqoyZL9GCA4a2', 1, '-');
INSERT INTO `cliente` VALUES (47, 'Alberto', 'Gil', 'Rubio', 688785641, 'albertogil@gmail.com', '2024-12-01 00:00:00', '2024-12-01 00:00:00', 'albertogil@gmail.com', 'GfGmtPiU', 3, '32295847B');
INSERT INTO `cliente` VALUES (48, 'Ferran', 'Ant&eacute;s', 'Per&oacute;n', 694312902, 'ferran.asp@gmail.com', '2024-12-02 09:15:06', '2024-12-02 09:15:06', 'Ferran Ant&eacute;s', '$2y$10$CrSgnzWeVVHyOVoBiTaWWO1forjdqhF/ALdlarNHH2PxZEw5q068a', 3, '-');
INSERT INTO `cliente` VALUES (49, 'Jose', 'Contoso', 'Rodríguez', 677665542, 'j.contoso@gmail.com', '2024-12-02 00:00:00', '2024-12-02 00:00:00', 'j.contoso@gmail.com', 'o#L2mMiG', 3, '5469569M');
INSERT INTO `cliente` VALUES (50, 'Juan', 'Serrano', 'Oviedo', 689201241, 'JuanSO@gmail.com', '2024-12-02 13:26:14', '2024-12-02 20:39:19', 'Juan_O', '$2y$10$SCrDBN8zjQzIdCEIcrOnhOhfmwF.gXXtbPsB44.9ap1v1TmH75n/6', 3, '-');
INSERT INTO `cliente` VALUES (51, 'Andrea', 'Quiñonero', 'Tachón', 611492901, 'AndreaQuiTa@yahoo.es', '2024-12-02 00:00:00', '2024-12-02 00:00:00', 'AndreaQuiTa@yahoo.es', 'It4pwvqw', 3, 'LAB48021');
INSERT INTO `cliente` VALUES (52, 'Sergio', 'Martinez', 'Parera', 611492901, 'Sergito101@hotmail.com', '2024-12-02 00:00:00', '2024-12-02 00:00:00', 'Sergito101@hotmail.com', '44#$k5mz', 3, 'RDF3928');
INSERT INTO `cliente` VALUES (53, 'Miranda', 'Sousa', 'Castillos', 691029309, 'Miranda.Sousa@gmail.com', '2024-12-02 00:00:00', '2024-12-02 00:00:00', 'Miranda.Sousa@gmail.com', 'b%6a5Zpr', 3, 'LEX0928');
INSERT INTO `cliente` VALUES (54, 'Borja', 'Mulleras', 'Vinzia', 666555444, 'bmulleras@uoc.edu', '2024-12-02 20:57:15', '2024-12-02 20:57:15', 'bmulleras', '$2y$10$nazWMIDVqG7oz7evdzY9.etuxxdbf21vWjZHVJ/f4cH22oeeHovXC', 1, '-');
INSERT INTO `cliente` VALUES (55, 'Andr&eacute;s', 'Martinez', 'S&aacute;nchez', 693920019, 'andres.mart@gmail.com', '2024-12-02 21:03:54', '2024-12-02 21:03:54', 'AMart', '$2y$10$.innInvc5G6QH8dNVPMqS.2Ci5LDIjiSzH6su6uOBhPvnJUhPcR2a', 3, '-');
INSERT INTO `cliente` VALUES (56, 'Josema', 'Yuste', 'Yustin', 685454532, 'josemayuste@hotmail.com', '2024-12-02 21:19:49', '2024-12-02 21:22:07', 'josemi', '$2y$10$OZnyrZLrMoH/4MtJU6kkB./TPsrf2ehX24ITHuDrI8iLpgjfQiN/.', 3, '55545658W');
INSERT INTO `cliente` VALUES (57, '123123', '123123', '123123', 123123123, '123123@a.com', '2024-12-05 00:00:00', '2024-12-05 00:00:00', '123123@a.com', '%2(yUS*d', 3, '123123');
INSERT INTO `cliente` VALUES (58, 'Cliente', 'Test', 'Test', 666554477, 'clientetest@cliente.com', '2024-12-05 14:42:46', '2024-12-07 18:31:58', 'clientetest', '$2y$10$TRewLbLdsElGKtee65NfS.YHWAUyqhyzMUFo377GGhjKa9yUjljT6', 3, '8846548');
INSERT INTO `cliente` VALUES (59, 'Jose', 'Contoso', 'Mijoso', 654454545, 'jose.contoso@gmail.com', '2024-12-07 00:00:00', '2024-12-07 17:49:17', 'jose.contoso@gmail.com', '6L5WxEn$', 3, '42215426B');
INSERT INTO `cliente` VALUES (60, 'Alberto', 'Rollo', 'Hernandez', 658585858, 'a.rollo@hotmail.com', '2024-12-07 00:00:00', '2024-12-07 17:51:29', 'a.rollo@hotmail.com', 'QPVK0(Gx', 3, '456789MG');
INSERT INTO `cliente` VALUES (61, 'Juan', 'Ruiz', 'Ruiz', 654221252, 'info@hoteltavascan.com', '2024-12-08 16:52:45', '2024-12-08 16:52:45', 'Tavascan', '$2y$10$Is0pP39n7dYBb/50WcCt3eFBSFTP4XFjLxvsd1/Fuj1vEQphVpc4m', 2, '-');

-- ----------------------------
-- Table structure for hoteles
-- ----------------------------
DROP TABLE IF EXISTS `hoteles`;
CREATE TABLE `hoteles`  (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_hotel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `direccion_hotel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_zona` int(11) NULL DEFAULT NULL,
  `comision` decimal(10, 2) NOT NULL,
  `idCliente` int(11) NOT NULL,
  PRIMARY KEY (`id_hotel`) USING BTREE,
  INDEX `id_zona`(`id_zona` ASC) USING BTREE,
  INDEX `id_cliente`(`idCliente` ASC) USING BTREE,
  CONSTRAINT `hoteles_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `transfer_zona` (`id_zona`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `hoteles_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hoteles
-- ----------------------------
INSERT INTO `hoteles` VALUES (1, 'Hotel Tavascan', 'C/ de los pollos 54', 1, 12.00, 61);
INSERT INTO `hoteles` VALUES (4, 'Hotel Luxury', 'C/ Apostol 56', 2, 15.00, 21);
INSERT INTO `hoteles` VALUES (5, 'Hotel Best', 'Avenida Paraiso 156', 1, 12.00, 21);
INSERT INTO `hoteles` VALUES (6, 'Hotel Hilton', 'Avenida Madagascar 154', 16, 15.00, 41);
INSERT INTO `hoteles` VALUES (7, 'Hotel Luxury', 'C/ Tramuntana 1', 1, 20.00, 41);
INSERT INTO `hoteles` VALUES (8, 'Hotel Majestic', 'C/ Llevant del nord 87', 20, 30.00, 32);
INSERT INTO `hoteles` VALUES (9, 'Hotel Imperial', 'C/ Barlovento', 20, 30.00, 39);
INSERT INTO `hoteles` VALUES (15, 'Hotel Misco', 'Cojones n&uacute;mero 3', 19, 500.00, 24);
INSERT INTO `hoteles` VALUES (16, 'Hotel Luxury', 'C/ de los pollos 54', 16, 12.00, 39);

-- ----------------------------
-- Table structure for tranfer_hotel
-- ----------------------------
DROP TABLE IF EXISTS `tranfer_hotel`;
CREATE TABLE `tranfer_hotel`  (
  `id_tranfer_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_hotel` int(11) NOT NULL,
  `id_zona` int(11) NULL DEFAULT NULL,
  `Comision` int(11) NULL DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `idCliente` int(100) NULL DEFAULT NULL,
  `nombre_hotel` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `direccion_hotel` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'nom',
  PRIMARY KEY (`id_tranfer_hotel`) USING BTREE,
  INDEX `FK_HOTEL_ZONA`(`id_zona` ASC) USING BTREE,
  INDEX `FK_cliente`(`idCliente` ASC) USING BTREE,
  INDEX `usuario`(`usuario` ASC) USING BTREE,
  INDEX `nombre_hotel`(`nombre_hotel` ASC) USING BTREE,
  INDEX `id_hotel`(`id_hotel` ASC) USING BTREE,
  CONSTRAINT `FK_cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tranfer_hotel_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `transfer_zona` (`id_zona`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 202 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tranfer_hotel
-- ----------------------------
INSERT INTO `tranfer_hotel` VALUES (189, 1, 1, 12, NULL, 27, 'Hotel Tavascan', 'C/ de los pollos 54');
INSERT INTO `tranfer_hotel` VALUES (190, 1, 1, 12, NULL, 27, 'Hotel Tavascan', 'C/ de los pollos 54');
INSERT INTO `tranfer_hotel` VALUES (191, 1, 1, 12, NULL, 27, 'Hotel Tavascan', 'C/ de los pollos 54');
INSERT INTO `tranfer_hotel` VALUES (192, 1, 1, 12, NULL, 27, 'Hotel Tavascan', 'C/ de los pollos 54');
INSERT INTO `tranfer_hotel` VALUES (193, 7, 1, 20, NULL, 21, 'Hotel Luxury', 'C/ Tramuntana 1');
INSERT INTO `tranfer_hotel` VALUES (194, 9, 20, 30, NULL, 58, 'Hotel Imperial', 'C/ Barlovento');
INSERT INTO `tranfer_hotel` VALUES (195, 5, 1, 12, NULL, 21, 'Hotel Best', 'Avenida Paraiso 156');
INSERT INTO `tranfer_hotel` VALUES (196, 1, 1, 12, NULL, 58, 'Hotel Tavascan', 'C/ de los pollos 54');
INSERT INTO `tranfer_hotel` VALUES (197, 5, NULL, 12, 'jose.contoso@gmail.com', 59, 'Hotel Best', 'Avenida Paraiso 156');
INSERT INTO `tranfer_hotel` VALUES (198, 5, 1, 12, NULL, 59, 'Hotel Best', 'Avenida Paraiso 156');
INSERT INTO `tranfer_hotel` VALUES (199, 5, NULL, 12, 'a.rollo@hotmail.com', 60, 'Hotel Best', 'Avenida Paraiso 156');
INSERT INTO `tranfer_hotel` VALUES (200, 5, 1, 12, NULL, 60, 'Hotel Best', 'Avenida Paraiso 156');
INSERT INTO `tranfer_hotel` VALUES (201, 8, 20, 30, NULL, 58, 'Hotel Majestic', 'C/ Llevant del nord 87');

-- ----------------------------
-- Table structure for transfer_precios
-- ----------------------------
DROP TABLE IF EXISTS `transfer_precios`;
CREATE TABLE `transfer_precios`  (
  `id_precios` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehiculo` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `Precio` double NOT NULL,
  PRIMARY KEY (`id_precios`) USING BTREE,
  INDEX `FK_PRECIOS_HOTEL`(`id_hotel` ASC) USING BTREE,
  INDEX `FK_PRECIOS_VEHICULO`(`id_vehiculo` ASC) USING BTREE,
  CONSTRAINT `transfer_precios_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hoteles` (`id_hotel`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `transfer_precios_ibfk_2` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_precios
-- ----------------------------
INSERT INTO `transfer_precios` VALUES (42, 88, 1, 100);
INSERT INTO `transfer_precios` VALUES (43, 89, 7, 200);
INSERT INTO `transfer_precios` VALUES (44, 90, 9, 100);
INSERT INTO `transfer_precios` VALUES (45, 91, 5, 100);
INSERT INTO `transfer_precios` VALUES (46, 92, 1, 200);
INSERT INTO `transfer_precios` VALUES (47, 93, 5, 100);
INSERT INTO `transfer_precios` VALUES (48, 94, 5, 100);
INSERT INTO `transfer_precios` VALUES (49, 95, 5, 100);
INSERT INTO `transfer_precios` VALUES (50, 96, 5, 100);
INSERT INTO `transfer_precios` VALUES (51, 97, 8, 100);

-- ----------------------------
-- Table structure for transfer_reservas
-- ----------------------------
DROP TABLE IF EXISTS `transfer_reservas`;
CREATE TABLE `transfer_reservas`  (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `localizador` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_hotel` int(11) NULL DEFAULT NULL COMMENT 'Es el hotel que realiza la reserva',
  `id_tipo_reserva` int(11) NOT NULL,
  `email_cliente` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_destino` int(11) NOT NULL,
  `fecha_entrada` date NULL DEFAULT NULL,
  `hora_entrada` time NULL DEFAULT NULL,
  `numero_vuelo_entrada` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `origen_vuelo_entrada` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `hora_vuelo_salida` time NULL DEFAULT current_timestamp(),
  `fecha_vuelo_salida` date NULL DEFAULT NULL,
  `num_viajeros` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `numero_vuelo_vuelta` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `hora_recogida` time NULL DEFAULT NULL,
  PRIMARY KEY (`id_reserva`) USING BTREE,
  INDEX `FK_RESERVAS_DESTINO`(`id_destino` ASC) USING BTREE,
  INDEX `FK_RESERVAS_HOTEL`(`id_hotel` ASC) USING BTREE,
  INDEX `FK_RESERVAS_TIPO`(`id_tipo_reserva` ASC) USING BTREE,
  INDEX `FK_RESERVAS_VEHICULO`(`id_vehiculo` ASC) USING BTREE,
  CONSTRAINT `transfer_reservas_ibfk_1` FOREIGN KEY (`id_destino`) REFERENCES `tranfer_hotel` (`id_zona`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `transfer_reservas_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `tranfer_hotel` (`id_hotel`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transfer_reservas_ibfk_3` FOREIGN KEY (`id_tipo_reserva`) REFERENCES `transfer_tipo_reserva` (`id_tipo_reserva`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transfer_reservas_ibfk_4` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 71 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_reservas
-- ----------------------------
INSERT INTO `transfer_reservas` VALUES (63, 'wj7ZP', 1, 1, 'a@a.com', '2024-12-05 00:00:00', '2024-12-05 00:00:00', 1, '2024-12-22', '12:12:00', '123123', '123123', NULL, NULL, 2, 88, NULL, NULL);
INSERT INTO `transfer_reservas` VALUES (64, 'JkxAb', 1, 3, 'victor_rg33@hotmail.com', '2024-12-05 00:00:00', '2024-12-05 14:39:44', 1, '2024-12-20', '10:00:00', 'FLY765', 'Barcelona', '04:00:00', '2025-01-05', 5, 89, 'FLY943', '12:00:00');
INSERT INTO `transfer_reservas` VALUES (65, 'Qbm7B', 1, 1, 'clientetest@cliente.com', '2024-12-05 00:00:00', '2024-12-07 18:32:23', 20, '2025-05-16', '07:00:00', 'FLY5544', 'Madrid', NULL, NULL, 1, 90, NULL, NULL);
INSERT INTO `transfer_reservas` VALUES (66, 'RzJX3', 5, 2, 'victor_rg33@hotmail.com', '2024-12-07 00:00:00', '2024-12-07 00:00:00', 1, NULL, NULL, NULL, 'N/A', '15:00:00', '2024-12-15', 5, 91, 'AG5449', '19:00:00');
INSERT INTO `transfer_reservas` VALUES (67, 'KZJkB', 1, 3, 'clientetest@cliente.com', '2024-12-07 00:00:00', '2024-12-07 00:00:00', 1, '2025-01-15', '11:00:00', 'YT653', 'Lanzarote', '16:00:00', '2025-01-22', 5, 92, 'T534', '11:00:00');
INSERT INTO `transfer_reservas` VALUES (68, 'xMSRX', 5, 2, 'jose.contoso@gmail.com', '2024-12-07 00:00:00', '2024-12-07 00:00:00', 1, NULL, NULL, NULL, 'N/A', '21:00:00', '2024-12-12', 10, 94, 'BGR43', '16:00:00');
INSERT INTO `transfer_reservas` VALUES (69, 'rnzn2', 5, 2, 'a.rollo@hotmail.com', '2024-12-07 00:00:00', '2024-12-07 00:00:00', 1, NULL, NULL, NULL, 'N/A', '16:00:00', '2024-12-16', 1, 96, 'TIEI43', '11:00:00');
INSERT INTO `transfer_reservas` VALUES (70, 'HPcJz', 8, 1, 'clientetest@cliente.com', '2024-12-07 00:00:00', '2024-12-07 00:00:00', 20, '2024-12-30', '12:00:00', 'asdfasdf', 'ertesdf', NULL, NULL, 50, 97, NULL, NULL);

-- ----------------------------
-- Table structure for transfer_tipo_reserva
-- ----------------------------
DROP TABLE IF EXISTS `transfer_tipo_reserva`;
CREATE TABLE `transfer_tipo_reserva`  (
  `id_tipo_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `Descripción` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_tipo_reserva`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_tipo_reserva
-- ----------------------------
INSERT INTO `transfer_tipo_reserva` VALUES (1, 'ida');
INSERT INTO `transfer_tipo_reserva` VALUES (2, 'vuelta');
INSERT INTO `transfer_tipo_reserva` VALUES (3, 'ida y vuelta');

-- ----------------------------
-- Table structure for transfer_vehiculo
-- ----------------------------
DROP TABLE IF EXISTS `transfer_vehiculo`;
CREATE TABLE `transfer_vehiculo`  (
  `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `idCliente` int(100) NOT NULL,
  PRIMARY KEY (`id_vehiculo`) USING BTREE,
  INDEX `FK_idCliente_Vehiculo`(`idCliente` ASC) USING BTREE,
  CONSTRAINT `FK_idCliente_Vehiculo` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 98 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_vehiculo
-- ----------------------------
INSERT INTO `transfer_vehiculo` VALUES (1, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (2, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (3, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (4, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (5, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (6, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (7, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (8, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (9, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (10, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (11, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (12, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (13, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (14, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (15, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (16, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (17, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (18, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (19, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (20, 'Transfer vendido', 32);
INSERT INTO `transfer_vehiculo` VALUES (21, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (22, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (23, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (24, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (25, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (26, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (27, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (28, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (29, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (30, 'Transfer vendido', 35);
INSERT INTO `transfer_vehiculo` VALUES (31, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (32, 'Transfer vendido', 36);
INSERT INTO `transfer_vehiculo` VALUES (33, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (34, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (35, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (36, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (37, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (38, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (39, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (40, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (41, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (42, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (43, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (44, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (45, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (46, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (47, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (48, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (49, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (50, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (51, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (52, 'Transfer vendido', 42);
INSERT INTO `transfer_vehiculo` VALUES (53, 'Transfer vendido', 42);
INSERT INTO `transfer_vehiculo` VALUES (54, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (55, 'Transfer vendido', 44);
INSERT INTO `transfer_vehiculo` VALUES (56, 'Transfer vendido', 44);
INSERT INTO `transfer_vehiculo` VALUES (57, 'Transfer vendido', 44);
INSERT INTO `transfer_vehiculo` VALUES (58, 'Transfer vendido', 45);
INSERT INTO `transfer_vehiculo` VALUES (59, 'Transfer vendido', 45);
INSERT INTO `transfer_vehiculo` VALUES (60, 'Transfer vendido', 44);
INSERT INTO `transfer_vehiculo` VALUES (61, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (62, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (63, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (64, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (65, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (66, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (67, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (68, 'Transfer vendido', 47);
INSERT INTO `transfer_vehiculo` VALUES (69, 'Transfer vendido', 47);
INSERT INTO `transfer_vehiculo` VALUES (70, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (71, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (72, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (73, 'Transfer vendido', 49);
INSERT INTO `transfer_vehiculo` VALUES (74, 'Transfer vendido', 50);
INSERT INTO `transfer_vehiculo` VALUES (75, 'Transfer vendido', 50);
INSERT INTO `transfer_vehiculo` VALUES (76, 'Transfer vendido', 50);
INSERT INTO `transfer_vehiculo` VALUES (77, 'Transfer vendido', 50);
INSERT INTO `transfer_vehiculo` VALUES (78, 'Transfer vendido', 51);
INSERT INTO `transfer_vehiculo` VALUES (79, 'Transfer vendido', 52);
INSERT INTO `transfer_vehiculo` VALUES (80, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (81, 'Transfer vendido', 53);
INSERT INTO `transfer_vehiculo` VALUES (82, 'Transfer vendido', 50);
INSERT INTO `transfer_vehiculo` VALUES (83, 'Transfer vendido', 56);
INSERT INTO `transfer_vehiculo` VALUES (84, 'Transfer vendido', 29);
INSERT INTO `transfer_vehiculo` VALUES (85, 'Transfer vendido', 57);
INSERT INTO `transfer_vehiculo` VALUES (86, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (87, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (88, 'Transfer vendido', 27);
INSERT INTO `transfer_vehiculo` VALUES (89, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (90, 'Transfer vendido', 58);
INSERT INTO `transfer_vehiculo` VALUES (91, 'Transfer vendido', 21);
INSERT INTO `transfer_vehiculo` VALUES (92, 'Transfer vendido', 58);
INSERT INTO `transfer_vehiculo` VALUES (93, 'Transfer vendido', 59);
INSERT INTO `transfer_vehiculo` VALUES (94, 'Transfer vendido', 59);
INSERT INTO `transfer_vehiculo` VALUES (95, 'Transfer vendido', 60);
INSERT INTO `transfer_vehiculo` VALUES (96, 'Transfer vendido', 60);
INSERT INTO `transfer_vehiculo` VALUES (97, 'Transfer vendido', 58);

-- ----------------------------
-- Table structure for transfer_viajeros
-- ----------------------------
DROP TABLE IF EXISTS `transfer_viajeros`;
CREATE TABLE `transfer_viajeros`  (
  `id_viajero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `apellido1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `apellido2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `codigoPostal` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ciudad` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `pais` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_viajero`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_viajeros
-- ----------------------------

-- ----------------------------
-- Table structure for transfer_zona
-- ----------------------------
DROP TABLE IF EXISTS `transfer_zona`;
CREATE TABLE `transfer_zona`  (
  `id_zona` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_zona`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_zona
-- ----------------------------
INSERT INTO `transfer_zona` VALUES (1, 'Palma');
INSERT INTO `transfer_zona` VALUES (2, 'Tramuntana');
INSERT INTO `transfer_zona` VALUES (3, 'Nord');
INSERT INTO `transfer_zona` VALUES (16, 'Llevant');
INSERT INTO `transfer_zona` VALUES (19, 'Migjorn');
INSERT INTO `transfer_zona` VALUES (20, 'Pla');

SET FOREIGN_KEY_CHECKS = 1;
