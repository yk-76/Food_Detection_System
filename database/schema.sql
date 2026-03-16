-- Create database
CREATE DATABASE IF NOT EXISTS food_detection;
USE food_detection;

-- Users table
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` VARCHAR(50) NOT NULL,
  `UserName` VARCHAR(100) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `Email` VARCHAR(100) NOT NULL,
  `DateOfBirth` DATE NOT NULL,
  `Gender` VARCHAR(10) NOT NULL,
  `ProfilePic` LONGTEXT DEFAULT NULL,
  `PhoneNo` VARCHAR(20) NOT NULL,
  `CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qr_token` VARCHAR(255) DEFAULT NULL,
  `reset_token_hash` VARCHAR(255) DEFAULT NULL,
  `reset_token_expires_at` DATETIME DEFAULT NULL,
  `Role` VARCHAR(10) DEFAULT 'user',
  `qr_code_path` LONGBLOB DEFAULT NULL,
  `RememberMe` VARCHAR(255) DEFAULT NULL,
  `last_login` DATETIME DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `UserName` (`UserName`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Food results table
CREATE TABLE IF NOT EXISTS `food_result` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` VARCHAR(50) NOT NULL,
  `food_items` LONGTEXT NOT NULL CHECK (JSON_VALID(`food_items`)),
  `health_assessment` TEXT DEFAULT NULL,
  `recommendation_text` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_food_user` (`user_id`),
  CONSTRAINT `fk_food_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
