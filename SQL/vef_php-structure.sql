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

 Date: 08/12/2024 18:24:20
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
-- Table structure for transfer_tipo_reserva
-- ----------------------------
DROP TABLE IF EXISTS `transfer_tipo_reserva`;
CREATE TABLE `transfer_tipo_reserva`  (
  `id_tipo_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `Descripción` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_tipo_reserva`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

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
-- Table structure for transfer_zona
-- ----------------------------
DROP TABLE IF EXISTS `transfer_zona`;
CREATE TABLE `transfer_zona`  (
  `id_zona` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_zona`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
