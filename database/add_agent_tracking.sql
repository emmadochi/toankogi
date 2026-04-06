-- Migration to add added_by to members table
USE `toan_kogi_revenue`;

ALTER TABLE `members` 
ADD COLUMN `added_by` int(11) DEFAULT NULL AFTER `status`,
ADD CONSTRAINT `fk_member_added_by` FOREIGN KEY (`added_by`) REFERENCES `users`(`id`) ON DELETE SET NULL;
