-- RBAC Migration Script
USE `toan_kogi_revenue`;

-- 1. Create LGAs table
CREATE TABLE IF NOT EXISTS `lgas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Create Units table
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lga_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL UNIQUE,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`lga_id`) REFERENCES `lgas`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Modify Users (Admins/Agents) table
ALTER TABLE `users` 
  ADD COLUMN `lga_id` int(11) DEFAULT NULL AFTER `role`,
  ADD COLUMN `unit_id` int(11) DEFAULT NULL AFTER `lga_id`,
  MODIFY COLUMN `role` enum('superadmin', 'lga_admin', 'unit_admin', 'agent') NOT NULL DEFAULT 'agent';

-- 4. Add constraints to Users table
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_lga` FOREIGN KEY (`lga_id`) REFERENCES `lgas`(`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_user_unit` FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL;

-- 5. Modify Members (Operators) table to link to IDs
ALTER TABLE `members`
  ADD COLUMN `lga_id` int(11) DEFAULT NULL AFTER `phone`,
  ADD COLUMN `unit_id` int(11) DEFAULT NULL AFTER `lga_id`;

-- 6. Add constraints to Members table
ALTER TABLE `members`
  ADD CONSTRAINT `fk_member_lga` FOREIGN KEY (`lga_id`) REFERENCES `lgas`(`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_member_unit` FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL;

-- 7. Seed initial LGAs (Sample data for Kogi state)
INSERT INTO `lgas` (`name`, `code`) VALUES 
('Lokoja', 'LKJ'),
('Okene', 'OKN'),
('Adavi', 'ADV'),
('Ajaokuta', 'AJK'),
('Dekina', 'DKN'),
('Idah', 'IDH'),
('Kabba/Bunu', 'KBB'),
('Ankpa', 'ANK');

-- 8. Seed initial Units (Sample data for Lokoja)
INSERT INTO `units` (`lga_id`, `name`, `code`) VALUES 
(1, 'Central Motor Park', 'CMP-01'),
(1, 'Ganaja Junction', 'GNJ-01'),
(2, 'Okene Main Market', 'OMM-01');

-- 9. Update existing Super Admin to ensure role is correct
UPDATE `users` SET `role` = 'superadmin' WHERE `username` = 'admin';
