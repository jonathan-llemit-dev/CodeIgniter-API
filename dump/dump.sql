-- Create the database
CREATE DATABASE IF NOT EXISTS `testing`;

-- Use the database
USE `testing`;

-- Create the table
CREATE TABLE IF NOT EXISTS `tbl_sample` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `age` INT NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
);
