USE `toan_kogi_revenue`;

-- 1. Create Settings table
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL UNIQUE,
  `setting_value` text,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed default settings
INSERT IGNORE INTO `settings` (`setting_key`, `setting_value`) VALUES 
('registration_fee', '2000'),
('paystack_public_key', ''),
('paystack_secret_key', ''),
('main_account_number', ''),
('main_bank_code', '');

-- 2. Modify Units table for Paystack Split Payments
ALTER TABLE `units`
  ADD COLUMN `bank_name` varchar(150) DEFAULT NULL AFTER `code`,
  ADD COLUMN `bank_code` varchar(20) DEFAULT NULL AFTER `bank_name`,
  ADD COLUMN `account_number` varchar(50) DEFAULT NULL AFTER `bank_code`,
  ADD COLUMN `subaccount_code` varchar(100) DEFAULT NULL AFTER `account_number`;
