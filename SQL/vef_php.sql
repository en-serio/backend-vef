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

 Date: 01/12/2024 18:04:25
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
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (21, 'Victor', 'Requena', 'Gallego', 689240824, 'victor_rg33@hotmail.com', '2024-11-14 19:34:06', '2024-12-01 16:36:42', 'victor', '$2y$10$p0GQE//ughuf7qfNph5OBul.5EkfEgGDgsAZCP/k8Q5BfhN4rI1QO', 1, '48015426M');
INSERT INTO `cliente` VALUES (24, 'Elena', 'L&oacute;pez', 'Estremera', 6666666, 'uwu@gmail.com', '2024-11-15 18:36:09', '2024-11-15 18:36:09', 'uwu', '$2y$10$egqKJ93F3qjYGiz1JQWvWO85gn9wJN5IjS.2v4ojM8nwL/gy1QSe.', 1, '');
INSERT INTO `cliente` VALUES (27, 'Victor', 'Requena', 'Gallego', 689240824, 'a@a.com', '2024-11-16 13:58:01', '2024-11-16 13:58:01', 'a@a.com', 'o2hGLSwj', 1, '');
INSERT INTO `cliente` VALUES (28, 'Victor', 'Requena', 'Gallego', 689240824, 'a@aaaaa.com', '2024-11-16 14:07:02', '2024-11-16 14:07:02', 'a@aaaaa.com', 'nxx81oaY', 1, '');
INSERT INTO `cliente` VALUES (29, 'Victor', 'Requena', 'Gallego', 689240824, 'asdasda@aaaaa.com', '2024-11-16 14:12:20', '2024-11-16 14:12:20', 'asdasda@aaaaa.com', 'CB52mqXG', 3, '');
INSERT INTO `cliente` VALUES (32, 'Víctor', 'Requena', 'Gallego', 689240824, 'victor@testfinal.com', '2024-11-16 00:00:00', '2024-11-21 22:18:12', 'victor@aidea.cat', '6GXghbC6', 3, '');
INSERT INTO `cliente` VALUES (33, 'Albertin', 'Gjsjf', 'Djfjg', 689240824, 'vic@cvif.com', '2024-11-16 19:16:24', '2024-11-16 19:16:24', 'Gjfkg', '$2y$10$AzDTotir3ey6bJntg/r.puwjHOMAJwtJKrMynM3i7Ykceil6R12na', 1, '-');
INSERT INTO `cliente` VALUES (34, 'ferran', 'calpe', 'romero', 658893677, 'ferran.calpe@gmail.com', '2024-11-16 19:22:07', '2024-11-16 19:22:07', 'ferran90', '$2y$10$Bj8YvBUDjylsZNgEaHUu6ebaBumTA95Mm8A9hv2FclRHT/1lITPAO', 1, '-');
INSERT INTO `cliente` VALUES (35, 'ferran', 'cliente', 'clientote', 685939822, 'ferran.cliente@gmail.com', '2024-11-16 00:00:00', '2024-11-16 00:00:00', 'ferran.cliente@gmail.com', 'mBNPJMuh', 3, '47398201g');
INSERT INTO `cliente` VALUES (36, 'Ckfkv', 'Dnfmvl', 'Ckfkeme', 658956832, 'vincifo@vjdnr.com', '2024-11-17 00:00:00', '2024-11-17 00:00:00', 'vincifo@vjdnr.com', 'd^fwJA29', 3, 'Fketoro');
INSERT INTO `cliente` VALUES (37, 'Iris', 'Rodriguez', 'Ortiz', 618412258, 'iris__08@hotmail.com', '2024-11-17 13:28:36', '2024-11-17 13:28:36', 'iris9923', '$2y$10$Qy5ZQIXH8TbsVaOMhb6INeXrRj5jEWZtJTBSx8QTgGKoaQqIJWipG', 3, '-');
INSERT INTO `cliente` VALUES (38, 'gus', 'Gustin', 'Gustirrin&iacute;n', 655456455, 'gustic@gmail.com', '2024-11-20 13:24:44', '2024-11-20 13:24:44', 'gustik', '$2y$10$S3.xkAJ6R9CETJRIppljnOT.xF66tAbs6m5yFKlVcZyPWAUvM.fqW', 3, '-');
INSERT INTO `cliente` VALUES (39, 'Alfonsin', 'alfonsito', 'algon', 655454545, 'alfonso@gmail.com', '2024-11-20 13:25:41', '2024-11-20 13:25:41', 'alfonsin', '$2y$10$f3wFMVbOPQj5OmGR3bHeYePGXKvnxWCW/JVDryggdeTAZEW8Mz/L6', 3, '-');
INSERT INTO `cliente` VALUES (40, 'alberto', 'ruiz', 'gallardon', 65544542, 'hola@hotmail.com', '2024-11-20 18:09:35', '2024-11-20 18:09:35', 'hola', '$2y$10$lx.j6lvnLanmnpd8NUnNl.NkRi.BCPpgFZxHEKyn0BaXt1FNZVhu6', 3, '-');
INSERT INTO `cliente` VALUES (41, 'Marta', 'Garrido', 'Vidal', 686808713, 'martaa.gv@hotmail.com', '2024-11-21 22:18:41', '2024-11-21 22:18:41', 'Martagarridov', '$2y$10$71u9V9y.T3uO5Wwa3J0uIO/IMKgPU24ieB8SVOKmG92UVx631j.em', 3, '-');
INSERT INTO `cliente` VALUES (42, '5243', '2453', '25345', 977123456, '554@kk.uk', '2024-11-22 00:00:00', '2024-11-22 00:00:00', '554@kk.uk', 'JDe7(1TN', 3, '53425');
INSERT INTO `cliente` VALUES (43, 'usuaUno', 'apeuno', 'apedos', 685920013, 'fcalper@gmail.com', '2024-11-25 20:39:00', '2024-11-25 20:39:00', 'usuaUno', '$2y$10$EzrZ1SGLJP6/R9rkFcskgOTrtXvPemUsqqLCdrsLUzyT7nKB.peTK', 3, '-');
INSERT INTO `cliente` VALUES (44, 'UsauUno', 'apeuno', 'apedos', 685928232, 'fcalper@uoc.edu', '2024-11-25 00:00:00', '2024-11-25 00:00:00', 'fcalper@uoc.edu', 'DEmh#T!u', 3, '49823118P');
INSERT INTO `cliente` VALUES (45, 'Andrea', 'Sua', 'Merced', 684891192, 'AsuaMer@gmail.com', '2024-11-30 00:00:00', '2024-11-30 00:00:00', 'AsuaMer@gmail.com', 'ythQmPfZ', 3, '48912309G');

-- ----------------------------
-- Table structure for tranfer_hotel
-- ----------------------------
DROP TABLE IF EXISTS `tranfer_hotel`;
CREATE TABLE `tranfer_hotel`  (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_zona` int(11) NULL DEFAULT NULL,
  `Comision` int(11) NULL DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `idCliente` int(100) NULL DEFAULT NULL,
  `nombre_hotel` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `direccion_hotel` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'nom',
  PRIMARY KEY (`id_hotel`) USING BTREE,
  INDEX `FK_HOTEL_ZONA`(`id_zona` ASC) USING BTREE,
  INDEX `FK_cliente`(`idCliente` ASC) USING BTREE,
  CONSTRAINT `FK_cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tranfer_hotel_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `transfer_zona` (`id_zona`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tranfer_hotel
-- ----------------------------
INSERT INTO `tranfer_hotel` VALUES (29, 1, 10, NULL, 27, 'Hotel Belvedere', 'C/ Madrid 15');
INSERT INTO `tranfer_hotel` VALUES (30, 1, 10, NULL, 27, 'Hotel Balearia', 'C/ francisco miguel guti 15');
INSERT INTO `tranfer_hotel` VALUES (31, 1, 10, NULL, 27, 'Hotel Luxury Balear', 'C/ Roberto de Hasta 22');
INSERT INTO `tranfer_hotel` VALUES (32, 1, 10, 'victor@aidea.cat', 32, 'Hotel Moada', 'C/ Leonel Messi 5');
INSERT INTO `tranfer_hotel` VALUES (33, 1, 10, NULL, 27, 'Hotel Best cadency', 'C/ Diagonal 23');
INSERT INTO `tranfer_hotel` VALUES (34, 1, 10, NULL, 27, 'Hotel Sagasti', 'C/ Donosti 99');
INSERT INTO `tranfer_hotel` VALUES (35, 1, 10, NULL, 27, 'Hotel hemeroteca', 'Avenida diagonal 544');
INSERT INTO `tranfer_hotel` VALUES (36, 1, 10, NULL, 27, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (37, 1, 10, NULL, 27, 'Hotel Regente Aragón', 'C/ de les Coques 5');
INSERT INTO `tranfer_hotel` VALUES (38, 1, 10, NULL, 27, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (39, 1, 10, NULL, 27, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (40, 1, 10, NULL, 27, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (41, 1, 10, NULL, 27, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (42, 1, 10, 'ferran.cliente@gmail.com', 35, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (43, 1, 10, NULL, 21, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (44, 1, 10, 'vincifo@vjdnr.com', 36, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (45, 1, 10, NULL, 27, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (46, 1, 10, NULL, 21, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (47, 1, 10, NULL, 21, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (48, 1, 10, NULL, 21, 'Hotel Cesar', 'Boulevard 505');
INSERT INTO `tranfer_hotel` VALUES (49, 1, 10, NULL, 21, 'Hotel Cesar', 'Boulevard 505');
INSERT INTO `tranfer_hotel` VALUES (50, 1, 10, NULL, 21, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (51, 1, 10, NULL, 21, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (52, 1, 10, NULL, 21, 'Luxor', 'Calle amargura');
INSERT INTO `tranfer_hotel` VALUES (53, 1, 10, NULL, 21, 'Hotel Minguito', 'Charlie');
INSERT INTO `tranfer_hotel` VALUES (54, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (55, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (56, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (57, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (58, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (59, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (60, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (61, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (62, 1, 10, NULL, 21, 'Hotel Madagascar', 'Calle lujúria');
INSERT INTO `tranfer_hotel` VALUES (63, 1, 10, NULL, 21, 'Hotal dumpbass', 'Calle diagonal');
INSERT INTO `tranfer_hotel` VALUES (64, 1, 10, '554@kk.uk', 42, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (65, 1, 10, NULL, 42, 'Hotel Hysperia', 'Avenida principe de asturias 66');
INSERT INTO `tranfer_hotel` VALUES (66, 1, 10, NULL, 21, 'Monterrey', 'Calle espigón');
INSERT INTO `tranfer_hotel` VALUES (67, 1, 10, 'fcalper@uoc.edu', 44, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (68, 1, 10, NULL, 44, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (69, 1, 10, NULL, 44, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (70, 1, 10, 'AsuaMer@gmail.com', 45, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (71, 1, 10, NULL, 45, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (72, 1, 10, NULL, 44, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (73, 1, 10, NULL, 21, 'Hotel Drogba', 'Ulritch direction');
INSERT INTO `tranfer_hotel` VALUES (74, 1, 10, NULL, 21, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (75, 1, 10, NULL, 21, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (76, 1, 10, NULL, 21, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (77, 1, 10, NULL, 21, 'Hotel Familia', 'C/ de los póstulos, 230 S/N');
INSERT INTO `tranfer_hotel` VALUES (78, 2, 111, 'victor', NULL, 'fasdfasdf', '234234');
INSERT INTO `tranfer_hotel` VALUES (79, 2, 111, 'victor', NULL, 'fasdfasdf', '234234');
INSERT INTO `tranfer_hotel` VALUES (80, 2, 111, 'victor', NULL, 'fasdfasdf', '234234');
INSERT INTO `tranfer_hotel` VALUES (81, 2, 11, 'victor', NULL, 'Hotel C&aacute;ceres', 'C/ Castellana 542');
INSERT INTO `tranfer_hotel` VALUES (82, 2, 11, 'victor', NULL, 'Hotel C&aacute;ceres', 'C/ Castellana 542');
INSERT INTO `tranfer_hotel` VALUES (83, 16, 11, 'victor', NULL, '12312', '1231233');
INSERT INTO `tranfer_hotel` VALUES (84, 2, 11, 'victor', NULL, 'Hotel C&aacute;ceres', 'C/ diagonal 544');
INSERT INTO `tranfer_hotel` VALUES (85, 2, 11, 'victor', NULL, 'Hotel C&aacute;ceres', 'C/ diagonal 544');
INSERT INTO `tranfer_hotel` VALUES (86, 3, 22, 'victor', NULL, 'Hotel miguelin', 'C/ alberto 55');
INSERT INTO `tranfer_hotel` VALUES (87, 1, 112, 'victor', NULL, 'Hotel C&aacute;ceres', 'C/ Castellana 542');
INSERT INTO `tranfer_hotel` VALUES (88, 1, 10, NULL, 21, 'Hotel Belvedere', 'C/ Madrid 15');

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
  CONSTRAINT `transfer_precios_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `tranfer_hotel` (`id_hotel`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `transfer_precios_ibfk_2` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_precios
-- ----------------------------
INSERT INTO `transfer_precios` VALUES (1, 1, 30, 50);
INSERT INTO `transfer_precios` VALUES (6, 50, 62, 200);
INSERT INTO `transfer_precios` VALUES (7, 51, 63, 100);
INSERT INTO `transfer_precios` VALUES (8, 52, 64, 100);
INSERT INTO `transfer_precios` VALUES (9, 53, 65, 100);
INSERT INTO `transfer_precios` VALUES (10, 54, 66, 100);
INSERT INTO `transfer_precios` VALUES (11, 55, 67, 100);
INSERT INTO `transfer_precios` VALUES (12, 56, 68, 100);
INSERT INTO `transfer_precios` VALUES (13, 57, 69, 100);
INSERT INTO `transfer_precios` VALUES (14, 58, 70, 100);
INSERT INTO `transfer_precios` VALUES (15, 59, 71, 100);
INSERT INTO `transfer_precios` VALUES (16, 60, 72, 200);
INSERT INTO `transfer_precios` VALUES (17, 61, 73, 100);
INSERT INTO `transfer_precios` VALUES (18, 62, 74, 200);
INSERT INTO `transfer_precios` VALUES (19, 63, 75, 200);
INSERT INTO `transfer_precios` VALUES (20, 64, 76, 200);
INSERT INTO `transfer_precios` VALUES (21, 65, 77, 100);
INSERT INTO `transfer_precios` VALUES (22, 66, 88, 200);

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
  CONSTRAINT `transfer_reservas_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `tranfer_hotel` (`id_hotel`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `transfer_reservas_ibfk_3` FOREIGN KEY (`id_tipo_reserva`) REFERENCES `transfer_tipo_reserva` (`id_tipo_reserva`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transfer_reservas_ibfk_4` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_reservas
-- ----------------------------
INSERT INTO `transfer_reservas` VALUES (42, 'EIDXG', 88, 3, 'victor_rg33@hotmail.com', '2024-12-01 00:00:00', '2024-12-01 00:00:00', 1, '2024-12-20', '12:30:00', 'FL7654', 'Barcelona', '15:00:00', '2024-12-24', 5, 66, 'FL854', '11:00:00');

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
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_zona
-- ----------------------------
INSERT INTO `transfer_zona` VALUES (1, 'Barcelona');
INSERT INTO `transfer_zona` VALUES (2, 'Madrid');
INSERT INTO `transfer_zona` VALUES (3, 'Valencia');
INSERT INTO `transfer_zona` VALUES (7, 'Gijon');
INSERT INTO `transfer_zona` VALUES (16, 'Baleares');

SET FOREIGN_KEY_CHECKS = 1;
