-- Migration to add passport_image to members table
USE `toan_kogi_revenue`;

ALTER TABLE `members` 
ADD COLUMN `passport_image` varchar(255) DEFAULT NULL AFTER `status`;
