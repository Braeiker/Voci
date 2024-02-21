-- migrations.sql

-- Create the database if it doesn't exist already
CREATE DATABASE IF NOT EXISTS `your_database_name`;

-- Use the database
USE `your_database_name`;

-- Create the 'books' table
CREATE TABLE IF NOT EXISTS `books` (
    `ISBN` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Author` VARCHAR(250) NOT NULL,
    `Title` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP()
);

-- Insert sample data
INSERT INTO `books` (`Author`, `Title`) VALUES
('Author1', 'Title1'),
('Author2', 'Title2'),
('Author3', 'Title3');
