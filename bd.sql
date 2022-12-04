-- Adminer 4.8.1 MySQL 8.0.31-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `crud_mvc_php` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `crud_mvc_php`;

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date_register` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `product` (`id`, `name`, `date_register`) VALUES
(1,	'Product 1',	NOW()),
(2,	'Product 2',	NOW());

DROP TABLE IF EXISTS `provider`;
CREATE TABLE `provider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date_register` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `provider` (`id`, `name`, `date_register`) VALUES
(1,	'Fornecedor 1',	NOW()),
(2,	'Fornecedor 2',	NOW());

DROP TABLE IF EXISTS `provider_product`;
CREATE TABLE `provider_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_provider` int NOT NULL,
  `id_product` int NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `date_register` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provider` (`id_provider`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `provider_product_ibfk_3` FOREIGN KEY (`id_provider`) REFERENCES `provider` (`id`),
  CONSTRAINT `provider_product_ibfk_4` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `provider_product` (`id`, `id_provider`, `id_product`, `value`, `date_register`) VALUES
(1,	1,	1,	100.00,	NOW()),
(2,	2,	2,	100.00,	NOW());

-- 2022-12-04 13:51:52