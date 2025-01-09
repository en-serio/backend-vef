/*
 Navicat Premium Dump SQL

 Source Server         : Developer2
 Source Server Type    : MariaDB
 Source Server Version : 101108 (10.11.8-MariaDB-0ubuntu0.24.04.1)
 Source Host           : dev2.aidea.cat:3306
 Source Schema         : laravel_vef

 Target Server Type    : MariaDB
 Target Server Version : 101108 (10.11.8-MariaDB-0ubuntu0.24.04.1)
 File Encoding         : 65001

 Date: 09/01/2025 23:12:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cancelled_at` int(11) NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (4, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (5, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (6, '0001_01_01_000002_create_jobs_table', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
INSERT INTO `password_reset_tokens` VALUES ('ensees21@outlook.com', '$2y$12$vLYQQo5a3wsest0lSjHROOTK/8NXwcDNH3P54VF5mIoX1PJsqBebm', '2024-12-25 01:04:38');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('lFIoMeP1pDXY4Jl4DJ4prn6tmtc32V4YgyR84NAt', 2, NULL, '104.28.88.130', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Mobile/15E148 Safari/604.1', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMTlXT0tqTkR5cE8wanhpVjNqRnUxNk1VNXpxajFFRm1SMUhVRVBZWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9kZXYyLmFpZGVhLmNhdDo4MDAwL3Byb2R1Y3RvMy9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6Mzoicm9sIjtzOjE6IjIiO3M6MjoiaWQiO2k6Mjt9', 1736453912);
INSERT INTO `sessions` VALUES ('pNkPZfR8baaGmP0ikW1zFA5qYeBVUdAbuDyHupaj', 25, NULL, '213.195.104.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNGFYMWVTZlRyNTJDaWJQT2U2dDVyOUtjb3pFc2JURzI0OW9qanVuayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9kZXYyLmFpZGVhLmNhdDo4MDAwL3Byb2R1Y3RvMy9jcmVhclRyYW5zZmVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjU7czozOiJyb2wiO3M6MToiMSI7czoyOiJpZCI7aToyNTt9', 1736458109);
INSERT INTO `sessions` VALUES ('zP1EgCFQoZQTJtrDngeZVUz8a3Ue490OAPuueGKF', 2, NULL, '91.126.179.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNmhvTDljelFzZEJKczdkYWx1NXhYTTN2a2d2T2Jrb0J4dWV5TmtJQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9kZXYyLmFpZGVhLmNhdDo4MDAwL3Byb2R1Y3RvMy9jcmVhclRyYW5zZmVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjM6InJvbCI7czoxOiIxIjtzOjI6ImlkIjtpOjI7fQ==', 1736460424);

-- ----------------------------
-- Table structure for transfer_hotel
-- ----------------------------
DROP TABLE IF EXISTS `transfer_hotel`;
CREATE TABLE `transfer_hotel`  (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_zona` int(11) NULL DEFAULT NULL,
  `Comision` int(11) NULL DEFAULT NULL,
  `usuario` int(11) NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `nombre_hotel` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `direccion_hotel` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_hotel`) USING BTREE,
  INDEX `FK_HOTEL_ZONA`(`id_zona` ASC) USING BTREE,
  CONSTRAINT `FK_HOTEL_ZONA` FOREIGN KEY (`id_zona`) REFERENCES `transfer_zona` (`id_zona`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_hotel
-- ----------------------------
INSERT INTO `transfer_hotel` VALUES (5, 1, 11, 10, NULL, 'Hotel Arroyo 2', 'C/Girona 89, Barcelona');
INSERT INTO `transfer_hotel` VALUES (6, 2, 5, 1, NULL, 'Hotel Nova Barcelona', 'Calle Floridablanca 32, Barcelona');
INSERT INTO `transfer_hotel` VALUES (7, 2, 14, 1, NULL, 'AL Sud', 'sud');
INSERT INTO `transfer_hotel` VALUES (8, 2, 16, 1, NULL, 'NORTE', 'al norte');
INSERT INTO `transfer_hotel` VALUES (9, 3, 12, 1, NULL, 'al este', 'al este');
INSERT INTO `transfer_hotel` VALUES (10, 4, 11, 1, NULL, 'Al Oeste', 'oeste');
INSERT INTO `transfer_hotel` VALUES (11, 1, 11, 10, NULL, 'norteCl', 'norte');
INSERT INTO `transfer_hotel` VALUES (12, 2, 24, 10, NULL, 'sudCL', 'sucd');
INSERT INTO `transfer_hotel` VALUES (13, 3, 7, 10, NULL, 'esteCL', 'este');
INSERT INTO `transfer_hotel` VALUES (14, 4, 16, 10, NULL, 'oeste cl', 'oeste');
INSERT INTO `transfer_hotel` VALUES (15, 1, 5, 2, NULL, 'Hotel hesperia', 'C/ migueli');

-- ----------------------------
-- Table structure for transfer_precios
-- ----------------------------
DROP TABLE IF EXISTS `transfer_precios`;
CREATE TABLE `transfer_precios`  (
  `id_precios` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehiculo` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  PRIMARY KEY (`id_precios`) USING BTREE,
  UNIQUE INDEX `id_precios`(`id_precios` ASC) USING BTREE,
  INDEX `FK_PRECIOS_HOTEL`(`id_hotel` ASC) USING BTREE,
  INDEX `FK_PRECIOS_VEHICULO`(`id_vehiculo` ASC) USING BTREE,
  CONSTRAINT `FK_PRECIOS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `transfer_hotel` (`id_hotel`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_PRECIOS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_precios
-- ----------------------------
INSERT INTO `transfer_precios` VALUES (1, 1, 11, 111);
INSERT INTO `transfer_precios` VALUES (2, 1, 12, 124);
INSERT INTO `transfer_precios` VALUES (3, 1, 13, 107);
INSERT INTO `transfer_precios` VALUES (4, 1, 14, 116);
INSERT INTO `transfer_precios` VALUES (5, 1, 15, 105);

-- ----------------------------
-- Table structure for transfer_reservas
-- ----------------------------
DROP TABLE IF EXISTS `transfer_reservas`;
CREATE TABLE `transfer_reservas`  (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `localizador` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_hotel` int(11) NULL DEFAULT NULL COMMENT 'Es el hotel que realiza la reserva',
  `id_tipo_reserva` int(11) NOT NULL,
  `email_cliente` int(11) NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL DEFAULT current_timestamp(),
  `id_destino` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `numero_vuelo_entrada` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `origen_vuelo_entrada` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `hora_vuelo_salida` time NOT NULL,
  `fecha_vuelo_salida` date NOT NULL,
  `num_viajeros` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  PRIMARY KEY (`id_reserva`) USING BTREE,
  INDEX `FK_RESERVAS_DESTINO`(`id_destino` ASC) USING BTREE,
  INDEX `FK_RESERVAS_HOTEL`(`id_hotel` ASC) USING BTREE,
  INDEX `FK_RESERVAS_TIPO`(`id_tipo_reserva` ASC) USING BTREE,
  INDEX `FK_RESERVAS_VEHICULO`(`id_vehiculo` ASC) USING BTREE,
  CONSTRAINT `FK_RESERVAS_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `transfer_hotel` (`id_hotel`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_RESERVAS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `transfer_hotel` (`id_hotel`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_RESERVAS_TIPO` FOREIGN KEY (`id_tipo_reserva`) REFERENCES `transfer_tipo_reserva` (`id_tipo_reserva`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_RESERVAS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_reservas
-- ----------------------------
INSERT INTO `transfer_reservas` VALUES (20, 'JhwtD', 6, 1, 10, '2024-12-30 00:34:22', '2024-12-30 00:34:22', 6, '2025-01-05', '05:37:00', 'ASDF1234', 'BARCELONA', '00:00:00', '1980-01-01', 2, 1);
INSERT INTO `transfer_reservas` VALUES (21, 'Xa7vB', 5, 2, 11, '2024-12-30 00:36:10', '2024-12-30 00:36:10', 5, '1980-01-01', '06:40:00', 'ASDF1234', 'Aeropuerto Local', '07:40:00', '2025-01-28', 5, 2);
INSERT INTO `transfer_reservas` VALUES (22, 'KEt6I', 5, 1, 13, '2025-01-01 23:01:21', '2025-01-01 23:01:21', 5, '2025-02-08', '05:00:00', 'ASDF1234', 'BARCELONA', '00:00:00', '1980-01-01', 2, 1);
INSERT INTO `transfer_reservas` VALUES (23, '5hcYm', 5, 2, 13, '2025-01-01 23:01:21', '2025-01-01 23:01:21', 5, '1980-01-01', '05:55:00', 'ASDF1234', 'Aeropuerto Local', '04:00:00', '2025-02-13', 2, 1);
INSERT INTO `transfer_reservas` VALUES (24, '3XCo8', 7, 1, 13, '2025-01-01 23:18:19', '2025-01-01 23:18:19', 7, '2025-03-18', '03:20:00', 'ASDF1234', 'BARCELONA', '00:00:00', '1980-01-01', 2, 1);
INSERT INTO `transfer_reservas` VALUES (25, 'bL4Wy', 7, 2, 13, '2025-01-01 23:18:19', '2025-01-01 23:18:19', 7, '1980-01-01', '00:22:00', 'ASDF1234', 'Aeropuerto Local', '00:23:00', '2025-05-09', 2, 1);
INSERT INTO `transfer_reservas` VALUES (26, 'svJm4', 9, 1, 10, '2025-01-01 23:19:04', '2025-01-01 23:19:04', 9, '2025-05-21', '04:18:00', 'ASDF1234', 'BARCELONA', '00:00:00', '1980-01-01', 1, 1);
INSERT INTO `transfer_reservas` VALUES (27, 'Ixxe5', 9, 2, 10, '2025-01-01 23:19:04', '2025-01-01 23:19:04', 9, '1980-01-01', '00:21:00', 'ASDF1234', 'Aeropuerto Local', '00:21:00', '2025-09-02', 1, 1);
INSERT INTO `transfer_reservas` VALUES (28, 'V0YcY', 7, 1, 14, '2025-01-01 23:19:55', '2025-01-01 23:19:55', 11, '2025-02-05', '00:23:00', 'ASDF1234', 'BARCELONA', '00:00:00', '1980-01-01', 5, 2);
INSERT INTO `transfer_reservas` VALUES (29, 'QEQh5', 11, 2, 14, '2025-01-01 23:19:55', '2025-01-01 23:19:55', 11, '1980-01-01', '06:19:00', 'ASDF1234', 'Aeropuerto Local', '04:19:00', '2025-03-05', 5, 2);
INSERT INTO `transfer_reservas` VALUES (30, '2MUE0', 12, 1, 11, '2025-01-01 23:20:49', '2025-01-01 23:20:49', 12, '2025-03-27', '00:23:00', 'ASDF1234', 'BARCELONA', '00:00:00', '1980-01-01', 4, 1);
INSERT INTO `transfer_reservas` VALUES (31, 'Sbe2O', 12, 2, 11, '2025-01-01 23:20:49', '2025-01-01 23:20:49', 12, '1980-01-01', '00:20:00', 'ASDF1234', 'Aeropuerto Local', '00:26:00', '2025-04-04', 4, 1);
INSERT INTO `transfer_reservas` VALUES (32, 'ZxIOB', 5, 1, 15, '2025-01-09 18:31:06', '2025-01-09 18:31:06', 5, '2025-03-12', '12:23:00', 'aefasdfa', 'asdfasdf', '00:00:00', '1980-01-01', 2, 1);
INSERT INTO `transfer_reservas` VALUES (33, '9rhD5', 8, 1, 16, '2025-01-09 19:06:35', '2025-01-09 19:06:35', 8, '2222-03-12', '12:23:00', 'sdfasd', 'sdasdf', '00:00:00', '1980-01-01', 2, 1);
INSERT INTO `transfer_reservas` VALUES (34, 'bJeRC', 5, 1, 17, '2025-01-09 19:08:21', '2025-01-09 19:08:21', 5, '2025-02-12', '15:30:00', 'F45984', 'Barcelona', '00:00:00', '1980-01-01', 5, 2);

-- ----------------------------
-- Table structure for transfer_tipo_reserva
-- ----------------------------
DROP TABLE IF EXISTS `transfer_tipo_reserva`;
CREATE TABLE `transfer_tipo_reserva`  (
  `id_tipo_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `Descripción` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_tipo_reserva`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_tipo_reserva
-- ----------------------------
INSERT INTO `transfer_tipo_reserva` VALUES (1, 'Aeropuerto - Hotel');
INSERT INTO `transfer_tipo_reserva` VALUES (2, 'Hotel - Aeropuerto');
INSERT INTO `transfer_tipo_reserva` VALUES (3, 'Ida y Vuelta');

-- ----------------------------
-- Table structure for transfer_vehiculo
-- ----------------------------
DROP TABLE IF EXISTS `transfer_vehiculo`;
CREATE TABLE `transfer_vehiculo`  (
  `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `Descripción` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email_conductor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `plazas` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_vehiculo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_vehiculo
-- ----------------------------
INSERT INTO `transfer_vehiculo` VALUES (1, 'Seat Leon negro, 4 plazas', 'con@a.com', '1234', 4);
INSERT INTO `transfer_vehiculo` VALUES (2, 'Furgon', 'conduce@a.com', '1234', 6);
INSERT INTO `transfer_vehiculo` VALUES (3, 'furgon adaptado personas con movilidad reducida', 'conred@a.com', '1234', 5);

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
  `telefono` int(10) NULL DEFAULT NULL,
  `dni` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_viajero`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_viajeros
-- ----------------------------
INSERT INTO `transfer_viajeros` VALUES (10, 'Prueba', 'Serrano', 'Esquen', 'calle piruleta 123', '08036', 'Barcelona', 'España', 'pr@pr.com', '$2y$12$SYg8B21EhIDt6SAHSq7/YeSCTTJIN4rcAVRYNnzNnX6/P90hKqBzC', 123456789, '12345678N');
INSERT INTO `transfer_viajeros` VALUES (11, 'Cliente', 'Serrano', 'Esquen', 'calle piruleta 123', '08036', 'Barcelona', 'España', 'a@a.com', '$2y$12$zMeVrs.FCJXJi8GMKhKbK.5pZ7jHMZkdDHwwVCNn7vhcW4.TmJLSW', 123456789, '12345678N');
INSERT INTO `transfer_viajeros` VALUES (12, 'Enrique', 'Serrano', 'Esquen', 'calle piruleta 123', '08036', 'Barcelona', 'España', 'ie@ie.com', '$2y$12$D4Abps7ULJLSmCeS9QeBa.wLmh4P718qseO/vjNb.4AUcWnjgkn/.', 123456789, '12345678N');
INSERT INTO `transfer_viajeros` VALUES (13, 'Enrique', 'Serrano', 'Esquen', 'calle piruleta 123', '08036', 'Barcelona', 'España', 'i@i.com', '$2y$12$mNswhmAyRbaLMv8jXNfmAu/O4l5BrXELqePemgLAZ44xJOHcUK0ca', 123456789, '12345678N');
INSERT INTO `transfer_viajeros` VALUES (14, 'Prueba', 'Serrano', 'Esquen', 'calle piruleta 123', '08036', 'Barcelona', 'España', 'asd@asd.com', '$2y$12$ZkB2bpuq.w61XL3BqH1Whu2NDAAaRC.98R4JqZWjMehil05n0z8NS', 666666666, '12345678N');
INSERT INTO `transfer_viajeros` VALUES (15, 'asdfa', 'asdfasd', 'fasdf', 'asdfasdfasd', '45645', 'adsfasdf', 'asdfasdf', 'alberto.gonzalez@yahoo.es', '$2y$12$3qnYmee6FSaP7YKt45slJ.7CG/SXNdgF3pOsOC3xrzlIEJ2OiW7l2', 654654654, '12345678d');
INSERT INTO `transfer_viajeros` VALUES (16, 'Victor', 'resters', 'Gallego', 'adsfasdf', '45678', 'adsfasdf', 'asdfasdf', 'test@test.com', '$2y$12$a8sApDqUfTsdXkrKcii.ceS7dqzhUS/eFb65b7hVCNZ/lkEPW9il6', 654654654, '12345678d');
INSERT INTO `transfer_viajeros` VALUES (17, 'Victor', 'Requena', 'Gallego', 'Calle falsa 123', '45678', 'Salou', 'España', 'victor_rg33@hotmail.com', '$2y$12$ld4Rjq/MLoPaf9VXD5/Vhe3J4Rhzwbbst1GZCuwxvckPfbE00g6si', 654654654, '12345678t');
INSERT INTO `transfer_viajeros` VALUES (18, 'Alberto', 'Contoso', 'Ferrido', 'Calle malaga', '45678', 'Malaga', 'España', 'alcon@gmail.com', '$2y$12$nR4KzyWVkViLH/e4p3g11eJGxk4c2Q4477hvZ7HdLmTjG7eS9q78.', 654784578, '12345678r');

-- ----------------------------
-- Table structure for transfer_zona
-- ----------------------------
DROP TABLE IF EXISTS `transfer_zona`;
CREATE TABLE `transfer_zona`  (
  `id_zona` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_zona`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transfer_zona
-- ----------------------------
INSERT INTO `transfer_zona` VALUES (1, 'Norte');
INSERT INTO `transfer_zona` VALUES (2, 'Sur');
INSERT INTO `transfer_zona` VALUES (3, 'Este');
INSERT INTO `transfer_zona` VALUES (4, 'Oeste');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_viajero` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Enrique', 'Pastor', 'Pastor', 'ensees21@outlook.com', NULL, '$2y$12$lwxffvmT6KcQweJ/h25w8.ZKJhqdIA1gyTbmcidVki8ddFbivc9I2', '1', 0, NULL, '2024-12-22 21:03:22', '2025-01-09 17:22:02');
INSERT INTO `users` VALUES (2, 'victor', 'Requena', 'Gallego', 'victor_rg33@hotmail.com', NULL, '$2y$12$U5AGZCygUtVeovz6QQ116O1ERjGasI9s6u8pbua62N8QAjDZ9Dv9i', '1', 0, 'UARaX2PpGXaRr9FFaubqtT9BDy0DTXxO3r3a9M8x8SHvI6i9WkJcU2dz0j6T', '2024-12-30 17:50:04', '2025-01-09 19:10:44');
INSERT INTO `users` VALUES (10, 'Alex', 'Pastor', 'Pastor', 'e@e.com', NULL, '$2y$12$yp/sJCvIbuYSqOCkhdbfYOFiPFePQ484SOLJSQviF0k.LSW0/Catu', '2', 0, NULL, '2024-12-30 00:20:16', '2024-12-30 00:20:16');
INSERT INTO `users` VALUES (11, 'Cliente', 'Pastor', 'Pastor', 'a@a.com', NULL, '$2y$12$gP6fYPuCsFICsBCMoRXTeekOAwjuqdgs2sS49uozWl0V.sn/N3ln6', '3', 11, NULL, '2024-12-30 00:20:31', '2024-12-30 00:36:10');
INSERT INTO `users` VALUES (12, 'Prueba', 'Pastor', 'Pastor', 'pr@pr.com', NULL, '$2y$12$N21eE9Q0f8EhDDIguu1IbOlUKdvRgoDMPRKSoYLi6Mz9nlirohZnq', '3', 10, NULL, '2024-12-30 00:34:22', '2024-12-30 00:34:22');
INSERT INTO `users` VALUES (13, 'Enrique', 'Pastor', 'Pastor', 'ie@ie.com', NULL, '$2y$12$CgFV96PM.XX3wHY9bHtNCO0H7aKX3obvY8EhtABGR/CfQOpb4m4wC', '3', 12, NULL, '2025-01-01 22:50:25', '2025-01-01 22:50:25');
INSERT INTO `users` VALUES (14, 'Enrique', 'Pastor', 'Pastor', 'i@i.com', NULL, '$2y$12$w0V2jp40dapClOg6UNyG8O12Z5vrWRJtMXqR//Ec9MJBoEUcv0yuq', '3', 13, NULL, '2025-01-01 22:54:28', '2025-01-01 22:54:28');
INSERT INTO `users` VALUES (15, 'Prueba', 'Pastor', 'Pastor', 'asd@asd.com', NULL, '$2y$12$ZkB2bpuq.w61XL3BqH1Whu2NDAAaRC.98R4JqZWjMehil05n0z8NS', '3', 14, NULL, '2025-01-01 23:19:55', '2025-01-01 23:19:55');
INSERT INTO `users` VALUES (16, 'asd', 'Pastor', 'Pastor', 'asd@aaaaa.com', NULL, '$2y$12$WQVxTY2aETaBX3QQjZCZLuyvlprsVXWIX86m.RTyxfCd9.o8JLuKi', '3', 0, NULL, '2025-01-03 16:08:10', '2025-01-03 16:08:10');
INSERT INTO `users` VALUES (17, 'qqq', 'Pastor', 'Pastor', 'qqq@qqq', NULL, '$2y$12$R4hJWu0i3Qg9X.Xs8ZS.neKNmYErX.D97lZptbieizA1OaMaK4mOm', '3', 0, NULL, '2025-01-03 18:05:51', '2025-01-03 18:05:51');
INSERT INTO `users` VALUES (25, 'Ferran', 'Calpe', 'romero', 'ferran.calpe@gmail.com', NULL, '$2y$12$fdPo2y8/OzSMhy6I7A6x2O9hWB./qzFtNea283gFJIzsYtnrAq8sS', '1', 0, NULL, '2025-01-06 21:18:41', '2025-01-06 21:18:41');

SET FOREIGN_KEY_CHECKS = 1;
